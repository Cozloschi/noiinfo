<?php
if(!isset($_SESSION))
  session_start();

include($_SERVER['DOCUMENT_ROOT'].'/engine/engine.php');

class router{

  public $engine;
  


  function __construct(){
  
 
	$this->engine = new Engine($_GET,$_POST);//clear $_GET, $_POST
	

	$this->get_route($this->engine->get);
  
  }

  
  public function get_route($get){
  
    //session name

  
	//get rouute
    if(!isset($this->engine->get['route'])) $this->engine->get['route'] = 'page';
    if(!isset($this->engine->get['user']))   $this->engine->get['user'] = 1;
	
    if(!isset($this->engine->get['action']) && $this->engine->get['route'] != 'action') $this->engine->get['action'] = 'index';
	
	
	switch($this->engine->get['route']){
    
		case 'page':
		
			include($_SERVER['DOCUMENT_ROOT'].'/engine/controllers/page_controller.php');
		 
		break;
		
		case 'action':
		
			include($_SERVER['DOCUMENT_ROOT'].'/engine/controllers/action_controller.php');
		
		break;
		
		
		case 'admin':
		  
		    include($_SERVER['DOCUMENT_ROOT'].'/engine/controllers/admin_controller.php');
		
		break;
	
	}
	
    //initialize the controller
	//user 0 means admin
	
	//action get or post
	$action = isset($this->engine->get['action']) ? $this->engine->get['action'] : $this->engine->post['action'];
	

	
	$controller = new Controller($this->engine,$action,isset($this->engine->get['user']) ? $this->engine->get['user'] : 0);
  
  
  }






}
?>