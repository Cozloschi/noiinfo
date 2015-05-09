<?php
 $id = $engine->get['user'];
 
 $data = mysql_fetch_assoc($engine->query("Select data from menu_modul where user_id = '$id' limit 1",true));
 
 $array = unserialize($data['data']);
 


?>
 <?php foreach($array as $key=>$value): ?>
  <?php if($value['visible'] == 'checked'):?>
   <li><a href="/page/<?=$id?>/<?=$engine->seo_title($value['title'])?>"><?=$value['title']?></a></li>
  <?php endif; ?>
 <?php endforeach; ?>

