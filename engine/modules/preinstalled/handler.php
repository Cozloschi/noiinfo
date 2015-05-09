<?php
session_start();
if(isset($_COOKIE['login_data'])){

  include($_SERVER['DOCUMENT_ROOT'].'/engine/engine.php');

  //prepare engine
  $engine = new Engine($_GET,$_POST);
	
  $token_req = isset($_GET['token']) ? $_GET['token'] : $_POST['token'];
  
  $login_data = unserialize($_COOKIE['login_data']);
  

  
  if(isset($_SESSION['token']) && $token_req == $_SESSION['token']){ // token is correct
	

	
	//load params
	$id     = isset($engine->post['id']) ? $engine->post['id'] : $engine->get['id'];
	
	$switch = isset($engine->post['action']) ? $engine->post['action'] : $engine->get['action'];
	
	//generate new token to send
	$token  = $engine->generate_token();
	
	
	//load data
	$data_module = mysql_fetch_assoc($engine->query("Select * from modules where id = '{$engine->post['id']}' limit 1",true));
    
	
    if(count($data_module) > 0){
	 include($_SERVER['DOCUMENT_ROOT']."/engine/modules/preinstalled/{$data_module['file']}/requests.php");
    }else{
	 echo json_encode(array('status'=>'error','token'=>$token));
	}
	
  }
  else echo "incorrect token";
}


?>