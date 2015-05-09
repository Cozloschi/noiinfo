<!DOCTYPE html>
<html>
<head>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/header-part.php'); ?>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/menu-part.php'); ?>
	<section>
	 
	  <div class='right'>
	   
	    <div>
		 <h4 style='margin:0px'>Info</h4>
		 <p>Use <b>General Settings</b> to turn off your website, or to link it to Google Analytics or Google Webmaster tools. Also you can upload your favicon.<br /><br />
		 Use <b>Main Module</b> to add your most used module to admin panel index page. This way you can have fast access to your website.
		 </p>
		</div>
	
		

		
	  </div>
		<div class="news pages">
			<h4 class='pages'>General Settings</h4>
			
		    <form  method='post' action='/requests' style='padding-bottom:30px' data-id='<?=$data['user']['id']?>' target='iframe' enctype="multipart/form-data" class='favicon'>
			  <img src='/../engine/data/favicons/<?=$data['user']['id']?>/favicon.ico' class='favicon' style='float:right;width:16px'/>Upload favicon
		      <input type='file' name='favicon' value='Upload favicon' />
			  <input type='hidden' name='action' value='upload_favicon' />
			  <input type='hidden' name='token' value='<?=$token?>' />
			  <iframe name='iframe' style='display:none' id='iframe'> </iframe>
			</form>
			
			<form class='settings' style='margin-top:10px'>
			 <ul class='general_list'> 
			   <li> Website status  <span class='right' style='width:125px;display:block;'> <span class='float:left'>ON<input style='width:15px;' value='on' type='radio' name='website_status' <?php if($data['status'] == 1) echo 'checked'; ?> /></span> <span style='margin-left:20px'>OFF<input style='width:15px' value='off' type='radio' name='website_status' <?php if($data['status'] == 0) echo 'checked'; ?> /></span></span></li>
			   <li> Website Domain <input type='text' old-data='<?=$data['domain']?>' name='domain' style='width:40%;float:right;' placeholder='www.example.com' value='<?=$data['domain']?>' /></li>
			   <li> Google Analytic TRACKING ID: <input type='text' style='width:40%;float:right' value='<?=$data['analytic']?>' placeholder='TRACKING ID' name='analytic' /></li>
			   <li> Google Webmaster tools meta tag: <input type='text' style='width:40%;float:right' value='<?=$data['confirmation_tag']?>' name='meta_tag' placeholder='CONFIRMATION META TAG' /></li>
			   
			 </ul>
			 <button class='send_general_sett'>Save Settings</button>
			</form>
			
		</div>
		
		
		<div class='news' style='position:relative'>
		 <h4>Main Module <img src='/../resources/images/list.png' style='float:right;padding:5px;display:block;' data-id="<?=$data['main_id']?>" class='button tooltip main_module' title='Change displayed module' /></h4>
		 <div class='list_holder'>
			 <ul class='modules_list_general'>
              <?php foreach($data['modules'] as $key=>$value): ?>
			   <li data-id="<?=$value['id']?>"><img class='right <?=$value['selected']?> main_module'  src='/../resources/images/check.png' title='Selected' /><?=$value['title']?></li>
			  <?php endforeach; ?>
			 </ul>
		 </div>
		 <div class='principal_module_holder'>
		  <?=$data['main_m']?>
		 </div>
		
		</div>
		

		
	
	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
</body>
</html>