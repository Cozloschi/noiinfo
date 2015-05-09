<?php
//include the model file
include($_SERVER['DOCUMENT_ROOT'].'/engine/models/admin_model.php');

class Controller{

 private $model;
 
 
 function __construct($engine,$action,$user){

   $this->model = new Model($engine,$action,$user); //load model for a specific user
   $this->controller($engine,$action); //call controller function

 }

 
 private function controller($engine,$action){

   $data  = $this->model->data; //get data from model
   $token = $engine->generate_token(); //generate token
   
   $page  = $_SERVER['DOCUMENT_ROOT']."/engine/views/admin/{$action}.php";
   $not_f = $_SERVER['DOCUMENT_ROOT']."/engine/views/404.php";
   
 
 
   //load content or login 
   if(isset($_COOKIE['login_data']))
    if(file_exists($page)) //search for page
     include($page);
    else
	 include($not_f); // page not foud
   else
    include($_SERVER['DOCUMENT_ROOT']."/engine/views/admin/login.php");
	
 }
 






}


?>