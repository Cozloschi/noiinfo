<?php
  $data = mysql_fetch_assoc($engine->query("Select * from guestbook_modul where user_id = '{$login_data['id']}'",true));
  
  //convert json to array
  $array = json_decode($data['data']);
  
  echo "<table class='guestboook'>";
  foreach($array as $key=>$value){
   
   echo "<tr><td></td><td></td><td></td></tr>";
  
  }
  echo "</table>";

?>