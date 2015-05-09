<?php
//include the model file
include($_SERVER['DOCUMENT_ROOT'].'/engine/models/action_model.php');

class Controller{

 private $model;
 
 
 function __construct($engine,$action){
   
   $this->model = new Model($engine,$action); //load model
   $this->controller($engine,$action); //call controller function
  
 }

 
 private function controller($engine,$action){
   

   echo $this->model->data; //return the data
 
 }
}
 