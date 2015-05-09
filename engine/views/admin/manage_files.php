<!DOCTYPE html>
<html>
<head>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/header-part.php'); ?>

<head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/menu-part.php'); ?>
	<section>
	 
	  <div class='right'>
	   
	    <div>
		 <h4 style='margin:0px'>Info</h4>
		 <p>Within this section you can upload static files used for your created designs or any other file, and get a <strong>public</strong> link to them.</p>
		
		</div>
	
		

		
	  </div>
		<div class="news pages" >
		 <h3>Upload files</h3>
        <form class='upload' data-id="<?=$data['user']['id']?>" method='post' action='/requests' target='iframe' enctype="multipart/form-data">
			<input id='upload' type='file' name='fileToUpload' />
		    <input type='hidden' value='<?=$data['token']?>' name='token' />
			<input type='hidden' value='upload_file' name='action' />
		</form>
		
		<iframe name='iframe' id='iframe' style='display:none' > </iframe>


		<ul class='files_list'>
		 <?php foreach($data['list'] as $key=>$value): ?>
		  <li data-name="<?=$value['name']?>"><img src='/../resources/images/delete.png' class='right tooltip delete_file' style='height:16px;padding:4px;margin-top:4px' title='Delete this file' /><img src='/../resources/images/clipboard.png' style='height:16px;padding:4px;margin-top:4px;margin-right:10px;' class='right tooltip-interactive' title='<?=$value['link']?>' /><img src='/../resources/images/extensions/<?=$value['extension']?>.PNG' class='extension' /><?=$value['name']?> </li>
		 <?php endforeach; ?>
		
	    </ul>
		</div>
		
	
	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
</body>
</html>