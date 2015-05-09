<!DOCTYPE html>
<html>
<head>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/header-part.php'); ?>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type='text/javascript'>
 $(document).ready(function(){
  $('ul.content_list').sortable();
 });
</script>
<head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/menu-part.php'); ?>
	<section>
	 
	  <div class='right'>
	    <div>
		 <h4 style='margin:0px'>What are users and groups?</h4>
		 
		 <p><strong>Users</strong> are accounts that you create to help you manage the website. They will have different groups and will log in from your log in page<br /><br />
		 
		 <strong> Groups </strong> are permissions. You add permissions to group to manage specific modules. You can create a group which can manage only forum, or only menu or all modules.</p> 
		</div>
	   
	    <div >
		 <h4 style='margin:0px'>Info</h4>
		 <p><strong>To add user </strong>: <br />
			1.Click 'Add user'<br />
			2.Complete forms<br />
			3.Click 'Add User'<br /><br />
		 <strong>To delete user</strong> you need to click 'Delete', and then click again to confirm action.</br ><br />
		 <strong>To edit user</strong> you need to find the user from list and click 'Edit', then edit the form above.<br /><br />
         
			
		 <strong>Manage Groups</strong>. Groups are managed same as users.<br/>
 		 </p>
		 
		</div>
	
		


		
	  </div>

			<div class="news">
				<h4><img src='/../resources/images/back_button.png' style='float:left' class='button back_button_users' /><span class='add_user right'>Add user</span>Manage users</h4>
				
				<div class='edit_user_holder' style='display:none;'>
				 <form>
				  <input type='text' name='edit_email' placeholder='Email'/>
				  <input type='password' name='edit_password' placeholder='Parola'/>
				  <select name='user_group'>
				   <option value='' selected disabled>Select Group</option>
				   <?php foreach($data['groups'] as $key=>$value):?>
				    <option value='<?=$value['id']?>'><?=$value['name']?></option>
				   <?php endforeach; ?>
				  </select>
				  <button class='edit_user' style='margin-top:10px'>Save User</button>
				 
				 </form>
				</div>
				
				<form class='users'>
				
                  <?php foreach($data['users'] as $key=>$value):?>
				   <div class='edit_user'><span data-id='<?=$value['id']?>' style='cursor:pointer' class='right delete'>Delete</span><span data-id='<?=$value['id']?>' style='margin-right:10px;cursor:pointer;' class='right edit'>Edit</span><span class='name'><?=$value['email']?></span></div>
				  <?php endforeach; ?>
				  
				  <?php if(count($data['users']) == 0):?>
				    <p>You have no users.</p>
				  <?php endif; ?>
				 
				</form>
			
			</div>
	

			<div class='news'>
			    <h4><img src='/../resources/images/back_button.png' class='button back_button_groups' style='float:left' /><span class='right add_group' style='cursor:pointer'>Add Group</span>Manage Groups </h4>
				
				<form>
				  <div class='show_group'>
				    <input type='text' name='group_name' placeholder='Group name' />
					<h4 style='margin-bottom:10px;margin-top:15px;'>Modules access</h4>
					<?php foreach($data['modules'] as $key=>$value): ?>
					 <div data-id='<?=$value['id']?>' class='module_list'><span class='access right'>Access <input type='checkbox' style='width:20px' name='access' data-id='<?=$value['id']?>' /> </span><?=$value['title']?></div>
					<?php endforeach; ?>
					
				    <button data-id='<?=$value['id']?>' class='edit_group' style='margin-top:15px;'>Edit group</button>
				  </div>
				  <div class='form_list'>
				  <?php foreach($data['groups'] as $key=>$value): ?>
				   
				   
				   <div class='group_list'><span data-id='<?=$value['id']?>' class='delete_group right'>Delete </span> <span data-id='<?=$value['id']?>' style='margin-right:10px;' class='edit_group right'>Edit</span> <span class='title'><?=$value['name']?></span></div>
				  
				  <?php endforeach; ?>
				  
				  <?php if(count($data['groups']) == 0): ?>
				   <p>You have no groups. </p>
				  <?php endif;?>
			      </div>
				</form>
			
			</div>

	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
</body>
</html>