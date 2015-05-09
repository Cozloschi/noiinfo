<?php

class Model{

  //private $engine;

  public  $data; //returned var
  
  function __construct($engine,$action){
    
	$this->data = json_encode($this->get_data($engine,$action));
	
  }
  
  
  private function get_data($engine,$action){
  			
			
			
	$allowed_actions = array('login_admin','forgot_password');  //allowed action without login
	
	//get the specific data
	//get token from get or post
	$token_req = isset($_GET['token']) ? $_GET['token'] : $_POST['token'];
/*
	if((isset($_SESSION['login_data_copy']) && isset($_COOKIE['login_data'])) && (isset($allowed_actions[$action]) || $_SESSION['login_data_copy'] != $_COOKIE['login_data'])) //cookie changed
	 {
	  $engine->logout();
	  echo '<meta http-equiv="refresh" content="0">';
	 }

	*/
		if(/*(isset($_SESSION['token']) && $token_req == $_SESSION['token'])*/ 1== 1){ // token is correct
		 
			$token = $engine->generate_token(); //generate token
		
		    if(isset($_COOKIE['login_data'])) 
			 $login_data = unserialize($_COOKIE['login_data']); //unserialize login data
			
			//verify if session is not the same with cookie and action is different from login
			

			
			if(!((isset($_SESSION['name']) && isset($login_data['name'])) && $_SESSION['name'] == $login_data['name']) && isset($allowed_actions[$action]))
			{
			 $engine->logout();
			 exit();
			}
			
			
			switch($action){
		 
		     /*========================= admin ===================== */
		 
			 case 'login_admin':
			 
			  //print_r($engine->get);
			 
			  //query
			  $data   = $engine->query("Select id,email,name,parent,rank,`group`,main_module from users where `email` = '{$engine->get['email']}' AND `password` = '{$engine->encrypt($engine->get['pass'])}' limit 1",true);
			  

			  $number = mysql_num_rows($data);
			  
			  $assoc_data = mysql_fetch_assoc($data);
			  
			  $name   = $assoc_data['name'];//save name
			  
			  $info   = $engine->prepare_cookie_data($assoc_data);
			  
			  //print_r($assoc_data);
			  
			  if($number == 1){
			  
			   if($assoc_data['rank'] == 1){ //subuser
			    
			
			    
				$load_parent = mysql_fetch_assoc($engine->query("Select id,name from users where id = '{$assoc_data['parent']}' limit 1",true));
			    
				$load_group  = mysql_fetch_assoc($engine->query("Select settings from groups where id = '{$assoc_data['group']}' limit 1",true));
				
				$info = array('id'      =>$load_parent['id'],
				              'email'   =>$assoc_data['email'],
							  'name'    =>$load_parent['name'],
							  'settings'=>$load_group['settings'],
							  'rank'    =>1);
							  
			
							  
				//convert
				$info = $engine->prepare_cookie_data($info);
				
				//keep a copy on server
				$_SESSION['login_data_copy'] = $info;
				
				$name = $load_parent['name'];
			   }

			   setcookie('login_data',$info,time()+36000,'/');
			   
			   //add a session copy of name for protection
			   $_SESSION['name'] = $name;
			   
			   $array = array('status'=>'done',
							  'token' =>$token);
			  }else{
			  
               $array = array('status'=>'incorrect',
							  'token' =>$token);
              }			  
			 
			 break;
		
		
		     case 'forgot_password':
		
			  $array = array('status'=>'done',
						     'token' =>$token);
			
		     break;
			 
			 
			 /* ======================= pages =========================== */
			 
			 case 'add_page':
			 
			  //load data
			  $seo_name = $engine->seo_title($engine->post['title']);
			  $title    = $engine->post['title'];
			  $desc     = $engine->post['description'];
			  $keywords = $engine->post['keywords'];
			  $index    = $engine->post['index'];
			  $modules  = $_POST['modules']; //no need to protect
			  $design   = $engine->post['design'];
			  

			  
			  
			  $user_id  = $login_data['id'];
			  
			  //remove all indexe pages
			  if($index == 1)
			   $engine->query("Update pages set `index` = '0' where user_id = '$user_id'",false);
			   
			   

			  
			  
			  
			  //query add
			  $query_add = $engine->query("Insert into pages(user_id,title,description,keywords,seo_name,`index`,modules,design) values('$user_id','$title','$desc','$keywords','$seo_name','$index','$modules','$design')",false);
			  

			  if($query_add){
			  
			  	  $array = array('status'=>'done',
			                     'token' =>$token,
							     'title' =>$title);
	
			  }
			  else
			  {
			   	  $array = array('status'=>'error',
			                     'token' =>$token,
							     'title' =>$title);
			  
			  }
						  
		
			 
			 break;
			 
			 case 'delete_page':
			  
			  $id = $engine->post['id'];
			  
			  
			  $query = $engine->query("Delete from pages where id = '$id' and user_id = '{$login_data['id']}' limit 1",false);
			  
			  if($query)
			   $array = array('status'=>'done','token'=>$token);
			  else
			   $array = array('status'=>'error','token'=>$token);
			  
			 
			 
			 break;
			 
			 case 'select_page':
			 
			  $id = $engine->get['id'];
			  
			  $data_q = mysql_fetch_assoc($engine->query("Select pages.index,pages.id,pages.title,pages.modules,pages.description,pages.keywords,pages.design,designs.type from pages inner join designs on pages.design = designs.id where pages.id = '$id' limit 1",true));
			 
			  //serialize modules , transform to json
			  //print_r(unserialize($data_q['modules']));
			  
			  
              $array = array('token'    =>$token,
                             'title'    =>$data_q['title'],
							 'desc'     =>$data_q['description'],
							 'keyw'     =>$data_q['keywords'],
							 'modul'    =>$data_q['modules'],
							 'index'    =>$data_q['index'],
							 'design'   =>$data_q['type'],
							 'design_id'=>$data_q['design'],
							 'id'       =>$id,

							 'status'=>'done');
			 
			 
			 break;
			 			
			 case 'save_page': //save page
			  
			  $title       = $engine->post['title'];
			  $keywords    = $engine->post['keywords'];
			  $description = $engine->post['description'];
			  $index       = $engine->post['index'];
			  $id          = $engine->post['id'];
			  $design      = $engine->post['design'];
			  
			  $modules     = $_POST['modules']; //serialize json array
			  
			  if($index == 1){
			   //set other pages as non-index;
			   $engine->query("Update pages set `index` = '0' where user_id = '{$login_data['id']}'",false);
			   
			  }
			  
			  $query = $engine->query("Update pages set  `seo_name` = '{$engine->seo_title($title)}',`design`= '$design',`title` = '$title',`description` = '$description', `keywords` = '$keywords' , `modules` = '$modules' ,`index` = '$index' where `id` = '$id'",false);
			  
			  if($query)
			   $array = array('status'=>'done',
			                  'token' => $token);
			  else
			   $array = array('status'=>'error',
			                  'token' => $token);
			 
			 break;
			 
			 
			 
			 case 'load_design_options':
			 
			  $id   = $engine->get['id'];
			  
			  $name = $engine->get['name'];

			  $file = $_SERVER['DOCUMENT_ROOT'].'/engine/templates/'.$name.'/settings.ini';
			  
			  if(file_exists($file))
			   $array_ini = stripslashes(json_encode(parse_ini_file($file)));
			  else
			   $array_ini = stripslashes(json_encode(array()));
			   
			  $array = array('status'=>'done',
			                 'data'  =>$array_ini,
							 'token' =>$token);
			 
			 break;
			 
			 
			 /* ========================= modules ====================== */
			 
			 //=================created modules
			 case 'add_module':
			  
			   //vars
			   $name = $engine->seo_title($engine->post['name']); //generate file name
			   $title= $engine->post['name'];
			   $html = $_POST['html']; //no need to protect
			   $acco = $login_data['id'];
			   
			   
			   //create file and write data
			   $file = $_SERVER['DOCUMENT_ROOT'].'/engine/modules/created/'.$login_data['id'].'/'.$name.'.php';
			   
			   $open = fopen($file,'a');
			   
			   fwrite($open,$html);
			   
			   fclose($open);
			   
			   //query
			   $query = $engine->query("Insert into modules(title,file,account) values('$title','{$name}.php','$acco')",false);
			   
			   if($query){
			     $array = array('status'=>'done',
			                    'token' => $token);
			   }
			   else{
				 $array = array('status'=>'error',
			                    'token' => $token);
			   }
			 break;
			 
			 //delete module
			 case 'delete_module':
			 
				$id   = $engine->post['id'];
				$file = $engine->post['file'];
				
				
				//delete file
				if(file_exists($_SERVER['DOCUMENT_ROOT']."/engine/modules/created/{$login_data['id']}/{$file}"))
				 unlink($_SERVER['DOCUMENT_ROOT']."/engine/modules/created/{$login_data['id']}/{$file}");
				 
				$query = $engine->query("Delete from modules where id ='$id' and account = '{$login_data['id']}' limit 1",false);
				
				
				
				if($query)
				 $array = array('status'=>'done','token'=>$token);
				else
				 $array = array('status'=>'error','token'=>$token);
				 
			 
			 break;
			 
			 
			 case 'select_module': //select a module to edit, send data
			  
			  $id = $engine->get['id'];
			  
			  $query = $engine->query("Select title,file from modules where id = '$id' limit 1",true);
			  
			  $data  = mysql_fetch_assoc($query);
			  
			  $file  = $_SERVER['DOCUMENT_ROOT']."/engine/modules/created/{$login_data['id']}/{$data['file']}";
			  
			  $array_data = array('title'=> $data['title'],
			                      'html' => file_exists($file) ? file_get_contents($file) : '' ,
								  'file' => $data['file']);
			  
			 
			  
			  return array('token' =>$token,
			               'status'=>'done',
						   'data'  => $array_data);
			   
			 
			 break;
			 
			 
			 case 'edit_module': //save module
			   
			   //vars
			   $name = $engine->seo_title($engine->post['name']); //generate file name
			   $title= $engine->post['name'];
			   $html = $_POST['html'];
			   $id   = $engine->post['id'];
			   $fst  = $engine->post['first']; //get first name
			   
			   $file_delete = $_SERVER['DOCUMENT_ROOT'].'/engine/modules/created/'.$login_data['id'].'/'.$fst.'.php';
			   
			   if(file_exists($file_delete)) //delete old file
			    unlink($file_delete);
			   
	
			   
			   //create file and write data
			   $file = $_SERVER['DOCUMENT_ROOT'].'/engine/modules/created/'.$login_data['id'].'/'.$name.'.php';
			   
			   $open = fopen($file,'w');
			   
			   fwrite($open,$html);
			   
			   fclose($open);
			   
			   //query
			   $query = $engine->query("Update modules set title='$title', file = '{$name}.php' where id = '$id' limit 1",false);
			   
			   if($query){
			     $array = array('status'=>'done',
			                    'token' => $token);
			   }
			   else{
				 $array = array('status'=>'error',
			                    'token' => $token);
			   }
			 
			 
			 break;
			 
			 //======preinstalled modules 
			 
			 case 'select_preinstalled_module':
			 
			 
			  $id   = $engine->get['id'];
			  
			 
			  //update main module
			  if(isset($engine->get['update']))
			   $engine->query("Update users set main_module = '$id' where id = '{$login_data['id']}' limit 1",false);

			  $data = mysql_fetch_assoc($engine->query("Select file,data,id from modules where id = '{$id}'  limit 1",true));
			  
			  if(count($data) > 0){
				  //get the html
				  ob_start();
				   include($_SERVER['DOCUMENT_ROOT']."/engine/modules/preinstalled/{$data['file']}/admin.php");
				   $html = ob_get_contents();
				  ob_end_clean();
				  
				  $array = array('status' => 'done',
								 'token'  => $token,
								 'options'=> $data['data'],
								 'data'   => $html);
			 }
			 else
			 {
			      $array = array('status'=>'error','token'=>$token);//error
			 }
			 break;
			 
			 //=============================== users=============
			 
			 case 'general_sett_user':
			 
			  if($engine->post['email'] != $login_data['email'])
			  {
				  //check email
				  $query = mysql_num_rows($engine->query("Select null from users where email = '{$engine->post['email']}' limit 1",true));
				  if($query == 1){
				   
					$array = array('status'=>'other_email',
								   'token' => $token);				
				  
					
				  }
				  else{
				   
				   $engine->query("Update users set email = '{$engine->post['email']}' where id = '{$login_data['id']}' limit 1");
				  
				   $engine->logout();
				   
				  }
              }
			  
			  if($engine->post['name'] != $login_data['name'])
			  {
				  //check name
				  $query = mysql_num_rows($engine->query("Select null from users where name = '{$engine->post['name']}' limit 1",true));
					
				  if($query == 1){

				   $array = array('status'=>'other_name',
								  'token' => $token);		

				   }
				   else
				   {
				   
				     $engine->query("Update users set name = '{$engine->post['name']}' where id = '{$login_data['id']}' limit 1",true);
					
				     $engine->logout();
				   }
				   
			  }
			  
			  
			  if(!isset($array)){
			  
			    $engine->logout();
			   
			    $array = array('status'=>'done',
				               'token' => $token);
			   
			  }
			 
			 
			 
			 
			 break;
			 
			 //password
			 
			 case 'save_password':
			 
			  $password = $engine->post['password'];
			  $user     = $login_data['id'];
			  
			  //encrypt password
			  $password = $engine->encrypt($password);
			  
			  $query  = $engine->query("Update users set password = '{$password}' where id = '$id' limit 1",false);
			  
			  if($query){
			    
			    
				$array = array('status'=>'done',
				               'token' => $token);
			   
			  }
			  else
			  {
			    $array = array('status'=>'error',
				               'token' => $token);
			  }
			 
			 
			 break;
			 
			 
			 
			//====== manage users 
			
			 case 'delete_user':
			   
				$id = $engine->post['id'];
				
				$query = $engine->query("Delete from users where rank = '1' and parent = '{$login_data['id']}' and id = '$id' limit 1",false);
				
				if($query){
				 
				 $array = array('status'  =>'done',
				                'token'   =>$token);
				 
				}else{
				 $array = array('status'  =>'error',
				                'token'   => $token);
				}
			 
			 
			 break;
			 
			 
			 case 'show_edit':
			  
			   $id = $engine->get['id'];
			   
			   $data = mysql_fetch_assoc($engine->query("Select email,password,id,`group` from users where id = '$id' and rank ='1' and parent = '{$login_data['id']}' limit 1",true));
			   
			   //decrypt password
			   $data['password'] = $engine->decrypt($data['password']);
			   
			   if(count($data) > 0)
			    $array = array('status'=>'done','token'=>$token,'data'=>json_encode($data));
			   else 
				$array = array('status'=>'error','token'=>$token,'data'=>json_encode($data));
			  
			 break;
			 
			 
			 case 'save_user':
			 
			  $email    = $engine->post['email'];
			  $password = $engine->encrypt($engine->post['pass']);
			  $id       = $engine->post['id'];
			  $group    = $engine->post['group'];
			 
			  if($engine->query("Update users set `group` = '$group',email = '$email', password = '$password' where rank = '1' and parent = '{$login_data['id']}' and id='$id'",false)){
				
				$array = array('status'=>'done','token'=>$token);

              }else{

				$array = array('status'=>'error','token'=>$token);
			  }
			 
			 break;
			 
            case 'add_user':
			
			 
			 $email    = $engine->post['email'];
			 $password = $engine->encrypt($engine->post['password']);
			 
			 if($engine->query("Insert into users(email,password,rank,parent) values('$email','$password','1','{$login_data['id']}')",false)){
			  
 			   $array = array('status'=>'done','token'=>$token);
			
             }
			 else{
			 
			   $array = array('status'=>'error','token'=>$token,'id'=>mysql_insert_id());
			 }
			break;
			
			
			
			 // manage groupps
			 
			 
			case 'delete_group':
			
			  $id = $engine->post['id'];
			  
			  $query = $engine->query("Delete from groups where id = '$id' and user_id = '{$login_data['id']}' limit 1",false);
			  
			  if($query) 
			    $array = array('status'=>'done','token'=>$token);
			  else
			    $array = array('status'=>'error','token'=>$token);
			break;
			// load group
			
			case 'load_group':
			 
			 $id = $engine->get['id'];
			 
			 $data = mysql_fetch_assoc($engine->query("Select * from groups where id = '$id' and user_id = '{$login_data['id']}' limit 1",true));
			 
             if(count($data) > 0){
				
				$array = array('status'=>'done','token'=>$token,'data'=>$data);
			   
			 }else		 
				$array = array('status'=>'error','token'=>$token);
			
			break;
			 
            case 'add_group':
			
			 $name = $engine->post['name'];
			 $sett = $engine->post['sett'];
			 
			 $query = $engine->query("Insert into groups(user_id,settings,name) values('{$login_data['id']}','{$sett}','{$name}')",false);
			 if($query)
			  $array = array('status'=>'done','token'=>$token,'insert_id'=>mysql_insert_id());
			 else
			  $array = array('status'=>'error','token'=>$token);
			
			
			break;
			 
			 
			case 'save_group':
				
			  $settings = $_POST['sett']; //no need to protect
			  $id       = $engine->post['id'];
			  $name     = $engine->post['name'];

			  $data = $engine->query("Update groups set settings = '{$settings}', name = '{$name}' where id = '{$id}'",false);
              
			  if($data){
			   $array = array('status'=>'done','token'=>$token);
			  }else{
			   $array = array('status'=>'error','token'=>$token);}
			  
			break;
			//================================== logout ==================
			
			case 'logout':
			 
			 $engine->logout();
			 
			 $array = array('status'=>'done','token'=>$token);
			
			
			break;
			 
		    //=========================== chart
			case 'data_chart':
			  
			  // load pages
			  $array_pages = array();
			  
              $query = $engine->query("Select id,title,hits from pages where user_id = '{$login_data['id']}'",true);			  
			  
			  while($row  = mysql_fetch_assoc($query))
			   $array_pages[] = $row;
			   
			   

			   

			  //load data for chart
			  $array_chart = array();
			  
			  foreach($array_pages as $key=>$value)
			   array_push($array_chart,array($value['title'],(int)$value['hits'] < 1 ? 1 : (int)$value['hits'])); 
	
			  
			  $array_chart = json_encode($array_chart);
			  
			  
			  if($query)
			     $array = array('status'=>'done','token'=>$token,'chart'=>$array_chart);
			  else  
				 $array = array('status'=>'error','token'=>$token);
			    
			  
			
			break;
			
			// ================================= designs
			
			case 'add_design':
			  
			 
			   $name = $engine->post['name'];
			   $type = $engine->post['type'];
			   $file = $engine->seo_title($name);//add extension
			   $t    = $engine->post['t'];
			   
			   $code = $_POST['code']; // no need to protect
			    
			   if($t == 1){ //pagebuilder
			        
			       
				   $query = $engine->query("Insert into designs(name,file,type,user_id,created,t,data) values('$name','$file','$type','{$login_data['id']}','1','$t','$code')",false);
				   
				   if($query){
				    $array = array('status'=>'done','token'=>$token,'id'=>mysql_insert_id());
					
				   }
				   else
				    $array = array('status'=>'error','token'=>$token);
				   
			   }else{   
				   $query = $engine->query("Insert into designs(name,file,type,user_id,created,t) values('$name','$file','$type','{$login_data['id']}','1','$t')",false);
				   
				   if($query){
					
					$dir = $_SERVER['DOCUMENT_ROOT'].'/engine/data/designs/'.$login_data['id'];
					
					//create directory if not exists
					if(!file_exists($dir))
					  mkdir($dir);
					 
					//add design file
					$open = fopen($_SERVER['DOCUMENT_ROOT'].'/engine/data/designs/'.$login_data['id'].'/'.$file.'.php','w');
					
					fwrite($open,$code);
					
					fclose($open);
					
					$array = array('status'=>'done','token'=>$token,'id'=>mysql_insert_id());
				
				   
				   }
				   else
					$array = array('status'=>'error','token'=>$token);
               }				  
			
			break;
			
			
			
			//select design
			
			case 'select_design':
			 
			  $id = $engine->get['id'];
			  
			  $load = mysql_fetch_assoc($engine->query("Select * from designs where id = '$id' and user_id = '{$login_data['id']}' limit 1",true));
			  
			  if(count($load) > 0){
			  
			    //load code 
				$file = $_SERVER['DOCUMENT_ROOT']."/engine/data/designs/{$login_data['id']}/{$load['file']}.php";
				
				//echo $file;
				
				if(file_exists($file))
		 		 $code = file_get_contents($file);
			    else
				 $code = 'error';
				
				$array = array('status'=>'done','token'=>$token,'name'=>$load['name'],'code'=>$code,'type'=>$load['type']);
			   
			  }else{
			   
			   $array = array('status'=>'error','token'=>$token);
			  }
			
			break;
			
			//save design
			case 'save_design':
			
			 $id     = $engine->post['id'];
			 $type   = $engine->post['type'];
			 $code   = $engine->post['code'];
			 $name   = $engine->post['title'];
			 $o_name = $engine->post['o_name'];
			 

			 //delete old file name
			 $o_file = $_SERVER['DOCUMENT_ROOT']."/engine/data/designs/{$login_data['id']}/{$engine->seo_title($o_name)}.php";
			 $file = $_SERVER['DOCUMENT_ROOT']."/engine/data/designs/{$login_data['id']}/{$engine->seo_title($name)}.php";
			 
			 //rename file
			 if(file_exists($o_file))
			  rename($o_file,$file);
			 
			 //rewrite file
			 $open = fopen($file,'w');
			 
			 fwrite($open,$code);
			 
			 fclose($open);
			 
			 //query
			 $query = $engine->query("Update designs set name = '$name',file = '{$engine->seo_title($name)}',type = '$type' where user_id = '{$login_data['id']}' and id = '{$id}' limit 1",false);
			 if($query){
			  
			  $array = array('status'=>'done',
							 'token' => $token);
			 
			 }
			 else{
			  
			  $array = array('status'=>'error',
			                 'token' => $token);
			  
			 }
			
			break;
			
			//delete design
			
			case 'delete_design':
			 
			  $id = $engine->post['id'];
			  
			  $query = $engine->query("Delete from designs where id = '$id' and user_id = '{$login_data['id']}' limit 1",false);
			  
			  if($query){
			  
			   $array = array('status'=>'done',
			                  'token' =>$token);
			  
			  
			  }else{
			  
			   $array = array('status'=>'error',
			                  'token' =>$token);
			  
			  }
			
			
			
			break;
			
			
			//load design pagebuilder
			case 'load_design_pagebuilder':
			
			 $id = $engine->get['id'];
			 
			 $design = mysql_fetch_assoc($engine->query("Select data,design_json from designs where `t` = '1' and user_id = '{$login_data['id']}' and id = '{$id}' limit 1",true));
			 
			 if(count($design) > 0){
			  $array = array('status'=>'done','token'=>$token,'modules'=>$design['data'],'design'=>$design['design_json']);
			 }else{
			  $array = array('status'=>'error','token'=>$token);
			 }
			 
			break;
			
			
			
			//save pagebuilder
			
			case 'save_pagebuilder':
			
			 $id = $engine->post['id'];
			 $serial = $_POST['serial']; //no need to protect
			 $design = $_POST['design'];
			 
			 if($engine->query("Update designs set data = '{$serial}',design_json = '{$design}' where id = '$id' and user_id = '{$login_data['id']}'",false))
			  $array = array('status'=>'done','token'=>$token);
			 else
			  $array = array('status'=>'error','token'=>$token);
			 
			
			break;
			
			
			
			//delete pagebuilder design
			
			case 'delete_pagebuilder_design':
			
			  $id = $engine->post['id'];
			  
			  if($engine->query("Delete from designs where t = '1' and id = '{$id}' and user_id = '{$login_data['id']}' limit 1",false))
			    $array = array('status'=>'done','token'=>$token);
			  else
			    $array = array('status'=>'error','token'=>$token);
			  
			  
			
			
			break;
			
			//=================templates 
			
			case 'install_template':
			
			  // define function for creating names from filename
			  
			  function create_name_from_file($name){
			   
			   //explode _ 
			   
			   $exp = explode('.',$name);
			   
			   $name = $exp[0];
			   
			   $exp_ = explode('_',$name);
			   
			   $returned = '';
			   
			   foreach($exp as $key)
			    $returned = $key.' ';
				
			   return trim($returned);
			    
			  
			  }
			 
			
			  $name = $engine->post['name'];

			  //load modules
			  $modules_to_copy = array();
			  
			  $modules_directory = $_SERVER['DOCUMENT_ROOT'].'/engine/templates/'.$name.'/modules';
			  
			  if(file_exists($modules_directory))
			  {
			   $modules_to_copy = scandir($modules_directory);
			   
			   
			   //get the configuration file for template modules
			   $conf_file = $modules_directory.'/names.ini';
			   $conf_data = array();
			   
			   if(file_exists($conf_file))
			    $conf_data = parse_ini_file($conf_file);
			   
			   
			   //clear modules array 
			   foreach($modules_to_copy as $key=>$value){
			    if(strlen($value) < 3 || end(explode('.',$value)) !== 'html'){
				 unset($modules_to_copy[$key]);
			    }else{ // add the name specified in names.ini
				 
				 if(isset($conf_data[$modules_to_copy[$key]])){
				  $modules_to_copy[$key] = array('name'=>$conf_data[$modules_to_copy[$key]],
												 'file'=>$modules_to_copy[$key]);
												 							 
				 }
				 else
				 {
				  $modules_to_copy[$key] = array('name'=>create_name_from_file($modules_to_copy[$key]),
												 'file'=>$modules_to_copy[$key]);
				 
				 }
				} 
				  
				  
				  
			   }
			   
				//account modules directory 
			   $account_modules_dir = $_SERVER['DOCUMENT_ROOT'].'/engine/modules/created/'.$login_data['id'];
			   $query_statement = '';
				
			   //type,title,file,account,data	
			   //create module file and database query
			   

			   
			   foreach($modules_to_copy as $key=>$value){
			   

			   
			   if(isset($modules_to_copy[$key]) && is_array($value)){
			    
				 //create file 
				 
		         $saved_value = $value['file'];
				 
				 $value['file'] = str_replace('.html','.php',$account_modules_dir.'/'.$value['file']);
				 
				 $open = fopen($value['file'],'w');
				 
				 fwrite($open,file_get_contents($modules_directory.'/'.$saved_value));
				 
				 fclose($open);
				 
				 $saved_value = str_replace('.html','.php',$saved_value);
				
				 $query_statement .= $query_statement == '' ? "('0','{$value['name']}','{$saved_value}','{$login_data['id']}','{$name}')" : ",('0','{$value['name']}','{$saved_value}','{$login_data['id']}','{$name}')";
   				
			    }
			   }
			  }
			  

			  
			  
			  
			  
			  //load settings
			  $settings = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/engine/templates/'.$name.'/settings.ini');
			  
			  $query = $engine->query("Insert into designs(name,file,type,user_id,created) values('{$name}','{$name}','{$settings['type']}','{$login_data['id']}','0')",false);
			 
			  $query_modules = $engine->query("Insert into modules(type,title,file,account,data) values {$query_statement}",false);
			 
			  if($query && $query_modules){
			    
				$array = array('status'=>'done','token'=>$token,'insert_id'=>mysql_insert_id());
			    
			  }else{
			   
			    $array = array('status'=>'error','token'=>$token);
			   
			  }
			
			break;
			
			case 'uninstall_template':
			
			 $name = $engine->post['name'];
			 
			 //delete from designs
			 $query = $engine->query("Delete from designs where name = '{$name}' and user_id = '{$login_data['id']}' limit 1",false);
			 
			 //load files from modules
			 $data_l = $engine->query("Select * from modules where  account = '{$login_data['id']}' and data = '{$name}' and type = '0'",true);
			 
			 while($row = mysql_fetch_assoc($data_l)){
			   
			   $file = $_SERVER['DOCUMENT_ROOT'].'/engine/modules/created/'.$login_data['id'].'/'.$row['file'];
			   
			   if(file_exists($file))
			    unlink($file);
			  
			 }
			 
			 //delete from modules
			 $query = $engine->query("Delete from modules where  account = '{$login_data['id']}' and data = '{$name}' and type = '0'",false); 
			 
			 if($query){
			 
			   $array = array('status'=>'done',
			                  'token' => $token);
			 
			 }else{
			  
			   $array = array('status'=>'error',
			                  'token' => $token);
			  
			 }
			
			break;
			
			
			//select template admin
			
			case 'load_template_admin':
			 
			 $id  = $engine->get['id'];
			 $name= $engine->get['name']; 
			 
			 $query = $engine->query("Select * from designs where user_id = '{$login_data['id']}' and id = '{$id}' limit 1",true);
			 
			 $data  = mysql_fetch_assoc($query);
			 

			 
			 if(count($data) > 0){
			  
			  if(file_exists($_SERVER['DOCUMENT_ROOT'].'/engine/templates/'.$name.'/admin_galaxone.html'))
			  {
			   
			   $data_temp = (array)json_decode($data['data']);
			   
			   ob_start();
			    
				include($_SERVER['DOCUMENT_ROOT'].'/engine/templates/'.$name.'/admin_galaxone.html');
				
				$html = ob_get_contents();
			   
			   ob_end_clean();
			  
			  }else
			    $html = '';
				
			  if(file_exists($_SERVER['DOCUMENT_ROOT'].'/engine/templates/'.$name.'/documentation.html'))
			   $documentation = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/engine/templates/'.$name.'/documentation.html');
			  else
			   $documentation = false;
			  
			  $array = array('status'=>'done',
							 'token' => $token,
							 'html'  => $html,
							 'doc'   => $documentation);
			 
			 }else{
			 
			  $array = array('status'=>'error',
			                 'token' =>$token);
			  
			 }
			
			break;
			
			
			//save template admin
			
			case 'save_template':
			 
			 $id   = $engine->post['id'];
			 $data = $engine->post['data'];
			 
			 $query = $engine->query("Update designs set data = '{$data}' where id = '{$id}' and user_id = '{$login_data['id']}' limit 1",false);
			 
			 if($query){
			  
			  $array = array('status'=>'done',
			                 'token' => $token);
			  
			 }else{
			 
			  $array = array('status'=>'error',
			                 'token' => $token);
			 
			 }
			
			
			break;
			
			
			case 'search_template':
			
			 $key = strtolower($engine->get['key']);
			
			 //load designs
			  $desing_array = array();
			  
			  $design_query = $engine->query("Select * from designs where user_id = '{$login_data['id']}'",true);
			  
			  
			  while($row = mysql_fetch_assoc($design_query))
			   $design_array[] = $row;
			
			 
			 //load templates
			 
			  $directory = $_SERVER['DOCUMENT_ROOT'].'/engine/templates/';
			  $templates = array();
			  
			  $open_directory = opendir($directory);
			 
			  while(false !== ($entry = readdir($open_directory))){
			   
			   if(strlen($entry) > 2 && strpos(strtolower($entry),$key) !== FALSE){
			    
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
			 
			 
			 
			 $array = array('status'=>'done','token'=>$token,'templates'=>$templates);
			
			break;
			
			
			//============================upload files
			
			case 'upload_file':
			
			    $target_dir = $_SERVER['DOCUMENT_ROOT']."/engine/data/users_files/{$login_data['id']}/";
				
				//print_r($_FILES);
				
				$action = 0; //what happened ?
				
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				
				// Check if file already exists
				if (file_exists($target_file)) {
					$action = 2; //allready exists
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
					$action = 3; //file is too large
					$uploadOk = 0;
				}
				
				
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" && $imageFileType != "css" && $imageFileType != "html"
				&& $imageFileType != "txt" && $imageFileType != "rar" && $imageFileType != "zip") {
					$action = 4; //invalid extension
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					$action = 0; //error
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$action = 1; //ok
					} else {
						$action = 0; //error
					}
				}
				
				
				echo "<script type='text/javascript'>parent.upload_file({$action},'{$_FILES["fileToUpload"]["name"]}','{$token}');</script>";
				
				
				exit();
			
			break;
			
			
			case 'delete_file':
			
			 $file_path = $_SERVER['DOCUMENT_ROOT']."/engine/data/users_files/{$login_data['id']}/{$engine->post['file']}";
			 
			 if(file_exists($file_path)) 
			  unlink($file_path);
			  
			  
			 $array = array('status'=>'done',
			                'token' =>$token);
			
			break;
			
			
			//============================general
			
			case 'upload_favicon':
			
			
			 
			  $target_dir = $_SERVER['DOCUMENT_ROOT']."/engine/data/favicons/{$login_data['id']}/";
			  
			  //if directory not exists
			  if(!file_exists($target_dir))
			   mkdir($target_dir);
				
				//print_r($_FILES);
				
				$action = 0; //what happened ? (status)
				
				$target_file = $target_dir .'favicon.ico';
				
				if(file_exists($target_file))
				 unlink($target_file); // unlink file if exists 
				
				$uploadOk = 1;
				
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				
				
				// Check file size
				if ($_FILES["favicon"]["size"] > 500000) {
					$action = 3; //file is too large
					$uploadOk = 0;
				}
				
				
				// Allow certain file formats
				if($imageFileType != "ico") {
					$action = 4; //invalid extension
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					$action = 0; //error
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["favicon"]["tmp_name"], $target_file)) {
						$action = 1; //ok
					} else {
						$action = 0; //error
					}
				}
				
				
				echo "<script type='text/javascript'>parent.upload_favicon({$action},'{$_FILES["favicon"]["name"]}','{$token}');</script>";
				
				
				exit();
			
			
			
			break;
			
			
			case 'update_general_settings':
			
			  $status   = $engine->post['status'];
			  $analytic = $engine->post['analytic'];
			  $meta_tag = $engine->post['meta_tag'];
			  $domain   = $engine->post['domain'];
			  
			  $status   = $status == 'on' ? 1 : 0;
			  
			   
			  //add meta tag , create dir if not exists
			  if(!file_exists($_SERVER['DOCUMENT_ROOT']."/engine/data/confirmation_tags/{$login_data['id']}"))
			   mkdir($_SERVER['DOCUMENT_ROOT']."/engine/data/confirmation_tags/{$login_data['id']}");
			  
			  $file = $_SERVER['DOCUMENT_ROOT']."/engine/data/confirmation_tags/{$login_data['id']}/tag.html";
			  
			  $open = fopen($file,'w');
			  
			  fwrite($open,$meta_tag);
			  
			  fclose($open);
			  
			  
			  if($engine->query("Update users set status = '{$status}', analytic_id = '{$analytic}' where id = '{$login_data['id']}' limit 1",false))
			   $array = array('status'=>'done','token'=>$token);
			  else
			   $array = array('error'=>'done','token'=>$token);
			   
			   function is_valid_domain_name($domain_name)
				{
					return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
							&& preg_match("/^.{1,253}$/", $domain_name) //overall length check
							&& preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
				}
			   
			 //map the domain
			 /*
			 if(is_valid_domain_name($domain)){
			 
			    include($_SERVER['DOCUMENT_ROOT'].'/engine/external_scripts/cpanel_api/xml.php');
			                       
			    $ip       = '';
				$username = '';
				$pass     = '';
			                    
			 
				$xmlapi = new xmlapi($ip); 
				$xmlapi->set_port(2083); 
				$xmlapi->password_auth($username,$pass); 

				$xmlapi->api2_query('Park', 'park', array( 'domain' => 'newdomainname.com', 'topdomain' => 'existingdomain.com' ) ); 
			 }
			 
			*/
			break;
			
			
		}
		

		
		
		return $array;
	  
	   }
	   else //if token is incorrect
		return array('status'=>'token_false');
	
	}
  
  }




?>