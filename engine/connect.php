<?php
class Connect{
	
	
	public function connect(){
	 
		 static $connection;
		 
		 // Try and connect to the database, if a connection has not been established yet
		 if(!isset($connection)) {
		
			$connection = mysql_connect('localhost','root','','galaxone');
		    mysql_select_db('galaxone',$connection);
			
		 }

		 // If connection was not successful, handle the error
		 if($connection === false) {
			
			
			
			return false; 
		 }
		 
		 return $connection;
	
	
	}
	
	




}


?>