<?php
class Model{

  //private $engine;

  public  $data; //returned var
  
  function __construct($engine,$action){
    
	$this->data = $this->get_data($engine,$action);
	//print_r($this->data);
	
  }
  
  
  private function get_data($engine,$action){
  			
			
	$token = $engine->generate_token(); //generate token
		
    if(isset($_COOKIE['login_data'])) 
	 $login_data = unserialize($_COOKIE['login_data']); //unserialize login data
   
   
   
     if($action == 'index') // load index page for a specific user
	  $data_a2 = mysql_fetch_assoc($engine->query("Select users.status,users.analytic_id,pages.modules,pages.title,pages.description,pages.keywords,pages.design,pages.index,designs.file,designs.data,designs.created,designs.t,designs.design_json
												   from pages INNER JOIN designs 
												   on pages.design = designs.id 
												   INNER JOIN users
												   on pages.user_id = users.id
												   where pages.user_id = '{$engine->get['user']}' and pages.index = '1' limit 1",true)); 
	 else //load a specific page
	  $data_a2 = mysql_fetch_assoc($engine->query("Select users.status,users.analytic_id,pages.modules,pages.title,pages.description,pages.keywords,pages.design,pages.index,designs.file,designs.data,designs.created,designs.t,designs.design_json
												   from pages  INNER JOIN designs 
												   on pages.design = designs.id
												   INNER JOIN users
												   on pages.user_id = users.id
												   where pages.user_id = '{$engine->get['user']}' and  pages.seo_name = '{$action}' limit 1",true));
	 //echo $data_a2['status'];
	 //update hits
	 //print_r($data_a2);
	 //print_r(mysql_error());
	
	 //check if website is down
	 if((int)$data_a2['status'] === 0){
	  
	   echo "Website is offline.";
	   exit();
	 }
	 
	 
	 //load webmaster
	 $webmaster_file = $_SERVER['DOCUMENT_ROOT']."/engine/data/confirmation_tags/{$engine->get['user']}/tag.html";
	 $webmaster_tag  = file_exists($webmaster_file) ? file_get_contents($webmaster_file) : '';
	 
     if($action == 'index') // update for index
	  $engine->query("Update pages set hits = hits+1 where user_id = '{$engine->get['user']}' and `index` = '1' ",false); 
	 else //update a specific page
	  $engine->query("Update pages set hits = hits+1 where user_id = '{$engine->get['user']}' and  seo_name = '$action'",false);
	 
	
	 if(is_array($data_a2) && count($data_a2) > 0){
	 
	 
	
	  //load modules
      //generate list for query
	  $modules_array = array();
		  
	  $modules_list  = null;
	  
	  if($data_a2['t'] == 0){ //general module parser
		  $modules = json_decode($data_a2['modules'],true);
		  
		  //print_r($modules);
		  

		  
		  
		  
	  foreach($modules as $key=>$value)
		  {
		   
		   foreach($value as $key_sub=>$id)
		   {
			$modules_list .= $modules_list == null ? $id : ','.$id; //append to list
		   
			//append order 
			$modules_array[$id] = array('order'=>$key_sub);
		   }
		  }
	  }else{ //pagebuilder
	  
	    $modules = json_decode($data_a2['data'],true);
		
		
		
	    
		foreach($modules as $key=>$value)
		  {
		  // print_r($value);
		  
		   
		   foreach($value as $key_sub=>$val_sub)
		   {
		    
			 if($key_sub == 'id') // add id
			  $modules[$key]['id_m'] = $val_sub;
		   
		    if($key_sub == 'module'){
			
				$modules_list .= $modules_list == null ? $val_sub : ','.$val_sub; //append to list
			   
				//append order 
				$modules_array[$val_sub] = array('order'=>$key);
			}
		   }
		  }
		
	  
	  
	  }
	  
	 // print_r($modules_array);
	  
	  $query_modules = array();
	  
	  //load modules data
	  $query_modules_res = $engine->query("Select * from modules where id IN ({$modules_list})",true);
	  while($row_modules = mysql_fetch_assoc($query_modules_res))
	    $query_modules[$row_modules['id']] = $row_modules;
		
	  
	  //get all data that you need
	  foreach($query_modules as $key=>$value)
	  {
	  
	
	   
	    $query_modules[$key]['type']    = $value['type'];
		$query_modules[$key]['title']   = $value['title'];
		
		if($value['type'] == 0){
	     $query_modules[$key]['content'] = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/engine/modules/created/'.$engine->get['user'].'/'.$value['file']); //add content
        }else{
	    //append file to script
		
			//use a var
			$saved_key   = $key;
			$data_module = $query_modules[$key];
			
			ob_start();
			 include($_SERVER['DOCUMENT_ROOT'].'/engine/modules/preinstalled/'.$value['file'].'/index.php');
			 
			 $query_modules[$saved_key]['content'] = ob_get_contents();
			
			ob_end_clean();
			
		}
	
	 
	  //end modules data
	 }
	 
	//print_r($modules);

    //print_r($modules['center']);
	

	 //append  data by id
	 foreach($modules as $key=>$value){
	   foreach($value as $key_sub=>$id)
	   {
	    if($data_a2['t'] == 0){
	   
	    if(/*$key_sub == 'module' &&*/ isset($query_modules[$id]))
		if($key !== 'fixed') // fixed modules
		 $modules[$key][$key_sub] = $query_modules[$id];
		else 
		 $modules[$key][$key_sub] = $query_modules[$id];
		 
	    }else{ //pagebuilder
	   
	   
	   	 if($key_sub == 'module' && isset($query_modules[$id]))
		 $modules[$key]['module'] = $query_modules[$id];
		 
		 
	    }
	   }
	  }
	  
	//print_r($modules);
     //clear for pagebuilder , t == 1
	 

	 
	
	 if($data_a2['t'] == 1 ){
	  
	  foreach($modules as $key=>$value)
	    if(!isset($modules[$key]['module']['content']))
		 unset($modules[$key]);
		else
		 $modules[$key]['module']['content'] = utf8_encode(mysql_real_escape_string(str_replace('"','',$modules[$key]['module']['content'])));
		 
 
	  $modules = stripslashes(nl2br(json_encode($modules)));
	 }
		 
	
	

		 

	
	// print_r($data_a2);

      return array('token'   => $token,
	               'seo'     => array('title'       => $data_a2['title'],
				                      'description' => $data_a2['description'],
								      'keywords'    => $data_a2['keywords']),
				   'modules' => $modules,
				   'data'    => (array)json_decode($data_a2['data']),
				   'design'  => $data_a2['file'],
				   'created' => $data_a2['created'],
				   'type'    => $data_a2['design'],
				   'user_id' => $engine->get['user'],
				   'analytic'=> $data_a2['analytic_id'],
				   'head_tag'=> $webmaster_tag,
				   't'       => $data_a2['t'],
				   'status'  => '200', //page is ok
				   'styles'  => $data_a2['design_json']); 

	 
	 
	 
	 }else
	  return array('status'=> '404'); //page not found
	
  }
  
}



?>