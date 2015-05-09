<?php
//include the model file
include($_SERVER['DOCUMENT_ROOT'].'/engine/models/page_model.php');

class Controller{

 private $model;
 
 
 function __construct($engine,$action){

   $this->model = new Model($engine,$action); //load model
   $this->controller($engine,$action); //call controller function
  
 }

 
 private function controller($engine,$action){
   
   
   
   $data = $this->model->data; //get data from model
   
   
   //you don't need controller to load
   // $login_data = unserialize($_COOKIE['login_data']);
   
   //print_r($data);
   
   if($data['status'] != 404)
   {
    if($data['t'] == 0){ // normal page
		if($data['created'] == 1) //if it's a created design
		 include($_SERVER['DOCUMENT_ROOT']."/engine/data/designs/{$data['user_id']}/{$data['design']}.php");
		else 
		 include($_SERVER['DOCUMENT_ROOT']."/engine/templates/{$data['design']}/index.php");
    }else{ //pagebuilder
	   
	   include($_SERVER['DOCUMENT_ROOT']."/engine/views/page/pagebuilder.php");
	   
	}
   }
   else  //page not found
	include($_SERVER['DOCUMENT_ROOT']."/engine/views/404.php");
 
 }
 






}


?>