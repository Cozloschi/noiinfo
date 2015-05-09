<?php 
         switch($switch){
		 
            case 'save_guestbook':
			  //convert 'on' to 'checked'
			  $array = json_decode($_POST['data'],true);
			  
	
			  //print_r($array);


	
			  $data = serialize($array); // convert it to array from json, then serialize it
			  
			  
			  $query = $engine->query("Update guestbook_modul set data = '$data' where user_id = '{$login_data['id']}'",false);
               
              $included_array = array(); //returned array
			  
			  if($query)
			   $included_array = array('status'=>'done','token'=>$token);
			  else
			   $included_array = array('status'=>'error','token'=>$token);
            
			break;
		}
		
		
	    echo json_encode($included_array);
?>