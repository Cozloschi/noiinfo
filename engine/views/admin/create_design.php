<!DOCTYPE html>
<html>
<head>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/header-part.php'); ?>

<link rel="stylesheet" href="/../engine/external_scripts/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="/../engine/external_scripts/codemirror/addon/display/fullscreen.css">
<link rel="stylesheet" href="/../engine/external_scripts/codemirror/theme/xq-light.css">
<script src="/../engine/external_scripts/codemirror/lib/codemirror.js"></script>
<script src="/../engine/external_scripts/codemirror/mode/xml/xml.js"></script>

<script src="/../engine/external_scripts/codemirror/addon/display/fullscreen.js"></script>
<script src="/../engine/external_scripts/codemirror/addon/selection/selection-pointer.js"></script>

<head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/menu-part.php'); ?>
	<section>
	 
	  <div class='right'>
	    <div>
		 <h4 style='margin:0px'>In progress</h4>
		 
		<p> </p>
		 
		</div>
	
		


		
	  </div>
		
      
			<div class="news">
				<h4>Create Design</h4>
		        
				<form>
				<input type='text' name='design_name' style='margin-bottom:10px' placeholder='Design name' />
				<select style='margin-bottom:10px' name='design_type'>
				 <option value='' selected disabled>Design Type:</option>
				 <option value='0'>Ony center collon</option>
				 <option value='1'>Center collon and left sidebar</option>
				 <option value='2'>Center collon and right sidebar</option>
				 <option value='3'>Center collong and both sidebars</option>
				</select>
				
				</select>
				<textarea id="code" name="code" style='border-top:1px solid #e0e0e0;' rows="5"></textarea>
				
				<button class='add_design' style='margin-top:10px'>Add design</button>
				</form>
				  <script>

					 
				    editor = CodeMirror.fromTextArea(document.getElementById("code"), {
					  lineNumbers: true,
					  theme: "xq-light",
					  extraKeys: {
						"F11": function(cm) {
						  cm.setOption("fullScreen", !cm.getOption("fullScreen"));
						},
						"Esc": function(cm) {
						  if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
						}
					  }
					});
				  </script>
			
			</div>
			
			<div class='news'>
			 <h4>How to use? </h4>
			 <p>You can use this section to create your own design. You can add javascript code, css and use php-vars. The platform will give you a set of arrays for you to use it as data in design.</p>
			</div>

	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
</body>
</html>