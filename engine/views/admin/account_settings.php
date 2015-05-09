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
         
		 <p><strong>To edit your accout data</strong> just edit forms from 'General Settings' section, with your e-mail and username. The username will appear on your dashboard link.<br /><br />
		 
		 <strong>To edit your password </strong> just edit froms from 'Password' section.</p>
		
		</div>
	
				
	  </div>
		
		
			<div class="news">
				<h4>General Settings</h4>
				
				<form>
				
				  <input type='text' placeholder='Email' name='email' value='<?=$data['user']['email']?>' />
				  <input type='text' placeholder='User' name='user'  value='<?=$data['user']['name']?>' />
				  <button class='save_settings'> Save Settings </button>
			    
				</form>
			
			</div>
			
			<div class='news'>
			    <h4>Password </h4>
				
				<form>
				  
				  <input type='password' placeholder='Password' name='password' />
				  <input type='password' placeholder='Re-type Password' name='re_password' />
				  <button class='save_password'>Change Password</button>
			    
				</form>
			
			</div>

		
	
	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
</body>
</html>