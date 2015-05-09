<?php
class Model{

  //private $engine;

  public  $data; //returned var
  
  function __construct($engine,$action,$user){
    
	$this->data = $this->get_data($engine,$action,$user);
	
	
	
  }
  
  
  private function get_data($engine,$action,$user){
  

   
	//get the specific data

	if(isset($_COOKIE['login_data'])){ //if user is logged in
	
	    $token = $engine->generate_token(); //generate token
	
		$login_data = unserialize($_COOKIE['login_data']); //unserialize login data
		
		//check if visited profile is admin
		
		//print_r($login_data);
		
		//add pages ad default
		if(empty($action)) $action = 'pages';
		
		 
		if(isset($login_data['name']) && ($login_data['name'] == $engine->get['user']) && (isset($_SESSION['name']) and $_SESSION['name'] == $login_data['name'])){ //check if the session is same with cookie
		
	
		
			switch($action){
		 
		
		 
			 case 'general':
			 
			 
			 //echo $login_data['main_module'];
			 
			 //load_main module
			 $main_mod = mysql_fetch_assoc($engine->query("Select main_module,status,analytic_id,domain from users where id = '{$login_data['id']}' limit 1",true));
			 
			 $main_module = $main_mod['main_module'];
			 
			 //load confirmation tag
			 
			 $confirmation_tag = file_exists($_SERVER['DOCUMENT_ROOT']."/engine/data/confirmation_tags/{$login_data['id']}/tag.html") ? file_get_contents($_SERVER['DOCUMENT_ROOT']."/engine/data/confirmation_tags/{$login_data['id']}/tag.html") : '';
			 
			 
			 //load modules
			  $load_modules  = $engine->query("Select * from modules where (account = '{$login_data['id']}' or account = '0') and type = '1'",true);
	
	          $modules = array();
			  
			  
			  while($row  = mysql_fetch_assoc($load_modules)){
			   $modules[$row['id']] = $row;
			   $modules[$row['id']]['selected'] = $row['id'] == $main_module ? 'selected' : ''; 
			  }
			  
			  if($main_module > 0){
				  //get module
				   $data = mysql_fetch_assoc($engine->query("Select file,data,id from modules where id = '$main_module'  limit 1",true));
				  
				  //get the html
				  ob_start();
					include($_SERVER['DOCUMENT_ROOT']."/engine/modules/preinstalled/{$data['file']}/admin.php");
					$html = ob_get_contents();
				  ob_end_clean();
					  
			  }else{
			   $html = "Please select the main module to be displayed on this page.";
			  }
			  
			  $array = array('status'   	   =>'done',
							 'token'     	           =>$token,
							 'user'     	               =>$login_data,
							 'modules'   	       =>$modules,
							 'main_m'    	       =>$html,
							 'main_id'    	       =>$main_module,
							 'status'    	           =>$main_mod['status'],
							 'analytic'  	           =>$main_mod['analytic_id'],
							 'domain'                =>$main_mod['domain'],
							 'confirmation_tag'=>$confirmation_tag);
			 
			 
			  return $array;
			 
			 
			 break; 
			 
			 case 'pages':
			  
			  // load pages
			  $array_pages = array();
			  
              $query = $engine->query("Select id,title,hits,`index` from pages where user_id = '{$login_data['id']}'",true);			  
			  
			  while($row  = mysql_fetch_assoc($query))
			   $array_pages[] = $row;
			   
			   

			   

			  //load data for chart
			  $array_chart = array();
			  
			  foreach($array_pages as $key=>$value)
			   array_push($array_chart,array($value['title'],(int)$value['hits'] < 1 ? 1 : (int)$value['hits'])); 
	
			  
			  $array_chart = json_encode($array_chart);
			  
			  
			  //load modules
			  $array_modules = array('created'      =>array(),
			                         'preinstalled' => array());
			  
			  $load_modules  = $engine->query("Select * from modules where account = '{$login_data['id']}' or account = '0'",true);

			  while($row = mysql_fetch_assoc($load_modules))
			  {
			   if($row['type'] == 0)
			   {
				$array_modules['created'][$row['id']]            = $row;
			    $array_modules['created'][$row['id']]['class']   = 'default' ; //add class
			   }
			   else
			   {
			    $array_modules['preinstalled'][$row['id']]          = $row;
			    $array_modules['preinstalled'][$row['id']]['class'] = '' ; //add class
			   }
			  }
			  
			  
			  //load designs
			  
			  $array_designs = array();
			  
			  $query_designs = $engine->query("Select * from designs where user_id = '{$login_data['id']}'",true);
			  
			  while($row = mysql_fetch_assoc($query_designs))
			   $array_designs[] = $row;
			   
			 
	
			  
			  
			  
			  $array = array('status' =>'done',
							 'token'  => $token,
							 'user'   => $login_data,
							 'pages'  => $array_pages,
							 'modules'=> $array_modules,
							 'chart'  => $array_chart,
							 'designs'=> $array_designs);
			 
			 
			  return $array;
			 
			 
			 break;			
			 
			 case 'modules':
			 
			  $array_modules = array('preinstalled'=> array(),
			                         'created'     => array());
			  
			  $load_modules  = $engine->query("Select * from modules where account = '{$login_data['id']}' or account = '0'",true);
	
	          
			  //load for sub admin
			  if($login_data['rank'] == 1){
				  
				  $modules = json_decode($login_data['settings'],true);
				  
				  $modules = $modules['modules'];
				  
				  while($row = mysql_fetch_assoc($load_modules))
				  {
				   
				  
				   if($row['type'] == 0 && (isset($modules[$row['id']]) && $modules[$row['id']] == 1)) //if he is allowed to see this module
					$array_modules['created'][$row['id']] = $row;
				   else
					if(isset($modules[$row['id']]) && $modules[$row['id']] == 1)
					 $array_modules['preinstalled'][$row['id']] = $row;
				  }
			
              }else{//admin
				
				
				  
				  while($row = mysql_fetch_assoc($load_modules))
				  {
		  
				   if($row['type'] == 0)
					$array_modules['created'][$row['id']] = $row;
				   else
					 $array_modules['preinstalled'][$row['id']] = $row;
				  }
				
			  }
			  
			  $array = array('modules'=>$array_modules,
			                 'status'=>'done',
							 'token' =>$token,
							 'user'  => $login_data);
			 
			 
			  return $array;
			 
			 
			 break;
			 
		
			 
			 
			 case 'account_settings':
			    
				//print_r($login_data);
				
				$load_data = mysql_fetch_assoc($engine->query("Select email,password from users where id ='{$login_data['id']}' limit 1",true));
			 
			    if(is_array($load_data) && count($load_data) > 0)
				{
					$array = array('token' => $token,
								   'status'=>'done',
								   'data'  => $load_data,
								   'user'  => $login_data);
	            }
				else
				{
                    $array = array('token' =>$token,
								   'status'=>'error');
                }								   
			 
			 
			   return $array;
			 break;
			 
	         //============================== users
			 
			 case 'manage_users':
		        
			   
			   //load users
			   
			   $array_users = array();
			   
               $load_users  = $engine->query("Select * from users where rank = '1' and parent = '{$login_data['id']}'",true);			
               
			   while($row   = mysql_fetch_assoc($load_users))
			    $array_users[] = $row;
                     			   
			   //load modules
			   $array_modules = array();
			   
			   $load_mod      = $engine->query("Select * from modules where account = '{$login_data['id']}' or account = '0'",true);
			   
			   while($row     = mysql_fetch_assoc($load_mod))
			    $array_modules[] = $row;
			   
			   // pages
			   $array_pages = array('modules','design');
			   
			   
			   //groups
			   $array_groups    = array();
			   
			   $load_group      = $engine->query("Select * from groups where user_id = '{$login_data['id']}'",true);
			   
			   while($row     = mysql_fetch_assoc($load_group))
			    $array_groups[] = $row;
				
			   
			   
			   return array('status' => 'done',
			                'token'  => $token,
							'user'   => $login_data,
							'users'  => $array_users,
							'modules'=> $array_modules,
							'pages'  => $array_pages,
							'groups' => $array_groups);
			 
			 break;
			 
			 
			 case 'create_design':
			 
			   return array('status'=>'done',
			                'token' => $token,
							'user'  => $login_data);
			 
			  
			  
			 
			 break;
			
			case 'manage_designs':
		     
			 //load modules
			   $array_modules = array();
			   
			   $load_mod      = $engine->query("Select * from modules where account = '{$login_data['id']}' or account = '0'",true);
			   
			   while($row     = mysql_fetch_assoc($load_mod))
			    $array_modules[] = $row;
			
			 //load designs
			  $design_array = array();
			  
			  $design_query = $engine->query("Select * from designs where user_id = '{$login_data['id']}'",true);
			  
			  
			  while($row = mysql_fetch_assoc($design_query))
			   $design_array[] = $row;
			
			 
			 //load templates
			 
			  $directory = $_SERVER['DOCUMENT_ROOT'].'/engine/templates/';
			  $templates = array();
			  
			  $open_directory = opendir($directory);
			 
			  while(false !== ($entry = readdir($open_directory))){
			   
			   if(strlen($entry) > 2){
			    
				//load configuration file
				
			    $ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/engine/templates/'.$entry.'/settings.ini');
				
				
				//check if it's allready installed
				$installed = 0;
				
				foreach($design_array  as $key=>$value){
				 
				  if($value['name'] == $entry)
                    $installed = 1;				
				}
			    
				
				array_push($templates,array('name'     =>$entry,
				                            'image'    =>'/view_thumb/'.$entry,
											'preview'  =>'/engine/templates/'.$entry.'/index.html',
											'type'     =>$ini['type'],
											'installed'=>$installed));
			   
			   }
			 }
			 
			  return array('status'   =>'done',
			               'token'    =>$token,
						   'user'     =>$login_data,
						   'designs'  =>$design_array,
						   'templates'=>$templates,
						   'modules'  =>$array_modules);
			
			break;
			
			
			case 'manage_files':
			
			 //recursive function
			 
			 $array_files = array();
			 
			 $root = $_SERVER['DOCUMENT_ROOT']."/engine/data/users_files/{$login_data['id']}";
		
			 
			 if(!file_exists($root)) mkdir($root);
			 
			 $dir = opendir($root);
			 

			  
			  while(false !== ($entry = readdir($dir))){
			  
			  $extension = end(explode('.',$entry));
			   
			   if(str_replace('.','',$entry) != '')
			     $array_files[] = array('name'=>$entry,'extension'=> $extension,'link'=>"/getfile/{$login_data['id']}/{$entry}");
			 }
			 
			 //print_r($array_files);
			 return array('status'=>'done',
			              'token' =>$token,
						  'list'  =>$array_files,
						  'user'  =>$login_data);
			 
			
			
			break;
		
		    }
			
		 }	
		
		else
		{
		 $engine->logout(); //logout if user try to access another account
         exit();
		}
   }
   else //user is not logget in
    return array('login'=>false);
  }

}


?>