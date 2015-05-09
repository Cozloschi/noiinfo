<?php
include($_SERVER['DOCUMENT_ROOT'].'/engine/connect.php');

class Engine{
 
 /* public variables */
 public $get;
 public $post;
 
 /* private variables */
 
 private $connection;
 


 function __construct($get,$post){
	
	$this->get  = $this->protect($get); //protect get params
	$this->post = $this->protect($post); //protect post params
	
	
	
	$this->connection = new Connect();
	
	if(!$this->connection->connect()) //if we can't make the connection
		exit();
 }

 /* private functions */
 
 
 /* public functions */
 

 public function protect($var){
   
    if(!is_array($var)) //if variable is not an array
	 return $var;
    else{
	
		foreach($var as $key=>$value){
		 
		 $var[$key] = $this->protect($value); //recursive, works in multi-dimensional array
		
		}
		
		return $var;
	 }
 }
 
 
 public function encrypt($var){
	
	$var = strrev($var); //reverse variable
	return base64_encode($var); //encode base 64
	
 }

 public function decrypt($var){
  
	$var = base64_decode($var);//decode variable
	return strrev($var);//reverse it
 
 }

 
 //token
 public function generate_token(){
  
   if(!isset($_SESSION)) //if session has not already started.
    session_start();
   
   $_SESSION['token'] = md5(time());
   return $_SESSION['token'];
  
 }
 
 
 //function parse cookie data
 public function prepare_cookie_data($array){
  
  return serialize($array);
   
 }
 
 
 //query log
 
 public function query($query,$bool){
   
   if(($query_data = mysql_query($query)) && !mysql_error())
    if($bool == true)
	 return $query_data;
	else
    return true;
   else
   {
    //add mysql error to log
	$file = $_SERVER['DOCUMENT_ROOT'].'/engine/data/log.txt';
	
	$open = fopen($file,'a+');
	$data = "===================".PHP_EOL." Mysql Error : ".mysql_error().PHP_EOL.date('d-m-Y').PHP_EOL.print_r($this->get,true).PHP_EOL;
	
	fwrite($open,$data);
	fclose($open);
	
	echo "sql error"; 
	
    exit();
   }
 }
 
 
 //logout
 
 public function logout(){
  
  setcookie('login_data','',time()-3600,'/');
  
  if(isset($_SESSION['name']))
   unset($_SESSION['name']);
   
  if(isset($_SESSION['login_data_copy']))
   unset($_SESSION['login_data_copy']);
  
  return;
 
 }
 
 /*================pages===================*/
 
 public function seo_title($title){
  
  return strtolower(str_replace(array(' ',','),'',$title));
 
 }
}


?>