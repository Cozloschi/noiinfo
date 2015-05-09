	<header>

		<nav>
		
		 <div class='responsive'> </div>

			<ul>

			    <li><a class='hauptseiten' href='/page/<?=$data['user']['id']?>/'>WEBSITE</a></li>
				<li><a class='hauptseiten' href='/admin/<?=$data['user']['name']?>/general'>GENERAL</a></li>
				<li class='home'><a href="#" class="hauptseiten">PAGES</a></li>
				<li class='jobs'><a href="#" class="jobs">USERS</a></li>
				<li class='agb'><a href="#" class="kontakt">CONTENT</a></li>
				<li><a href="#" class="logout">LOG OUT</a></li>
			</ul>
			<img src='/../resources/images/logo.jpg' class='logo' />
		</nav>
		

	</header>
	<div class='home menu_content'>
 
     <div class='center_div'>
	 
      <div class='left_menu_content'>
       <ul>
	    <li><a href='/admin/<?=$data['user']['name']?>/pages'>Pages</a></li>
	    <li><a href='/admin/<?=$data['user']['name']?>/modules'>Modules</a></li> 
	   <ul>
	  </div>
	  
	  <div class='right_menu_content'>
       Create and edit pages. Manage and create modules to build pages with. Modules are page sections preinstalled or created( costum HTML )
      </div>
	  
 	 </div>
	</div>
	<div class='agb menu_content'>
 
     <div class='center_div'>
	 
      <div class='left_menu_content'>
       <ul>
	    <li><a href='/admin/<?=$data['user']['name']?>/manage_designs'>Manage Designs</a></li>
	    <li><a href='/admin/<?=$data['user']['name']?>/manage_files'>Manage Files </a></li>

	   
	   <ul>
	  </div>
	  
	  <div class='right_menu_content'>
Create and install designs for your pages. Within this section you can add and create templates for your pages and also change upload static files for created templates. </div>
	  
 	 </div>
	</div>	
	

	
	<div class='jobs menu_content'>
 
     <div class='center_div'>
	 
      <div class='left_menu_content'>
       <ul>
	    <li><a href='/admin/<?=$data['user']['name']?>/account_settings'> Account Settings</a></li>
	    <li><a href='/admin/<?=$data['user']['name']?>/manage_users'> Manage Users</a></li>

	   
	   <ul>
	  </div>
	  
	  <div class='right_menu_content'>
Manage users and your account settings. Within this section you can create accounts and add them specific permissions. </div>
	  
 	 </div>
	</div>