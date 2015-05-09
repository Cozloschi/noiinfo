<!DOCTYPE html>
<html>
<head>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/header-part.php'); ?>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type='text/javascript'>
$(function() {
    $( "ul.module_list" ).sortable({
      connectWith: "ul.holder_modules,ul.holder_modules.left"
    }).disableSelection();    
	
	$( "ul.holder_modules" ).sortable({
      connectWith: "ul.module_list",
	  cancel: 'li.fixed'
    }).disableSelection();
  });
</script>

<!-- Google charts -->
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

	  
	  
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(<?=$data['chart']?>);

        // Set chart options
        var options = {pieHole:0.1,pieSliceText: 'label',legend:'none',animation:{duration: 1000,easing: 'out'}};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
		
		//setinterval 20 s
		/*var interval = setInterval(function(){
		 
		 $.get('/requests/',{'action':'data_chart','token':token},function(response){
		  
		  if(response.status == 'done'){
		   
		   token = response.token;
		   
		   //parse
		   response.chart = JSON.parse(response.chart);
		   console.log(response.chart);
		   $.each(response.chart,function(index,value){
		    data.setValue(index,1,value[1]);
		   });
		   
		   chart.draw(data,options); //redraw the chart
		   
		  }else{
		   
		   token = response.token;
		   
		   clearInterval(interval);
		  
		  }
		 
		 },'JSON');
		
		},20000);*/
      }
    </script>
<head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/menu-part.php'); ?>
	<section>
	 
	  <div class='right'>
	   
	    <div>
		 <h4 style='margin:0px'>Info</h4>
		 <p><strong>To edit a page:</strong><br/ >
		  1. Click 'Edit Page' button; <br />
		  2. Edit forms. <br /><br />
		  
		  <strong>To create a page </strong> you need to click 'Add a new page' button, and follow those steps.<br /><br/>
		  
		  <strong>To delete a page: </strong><br />
		  1. Click 'Edit page' button;<br/>
		  2. Click  'Remove Page' button;<br /><br />
		
		  <strong>You can see realtime pagehits</strong> watching <strong>Page Hits</strong> section. <br /></br />
		  
		  Analyze your pages seo properties using '<strong>Seo Analyzer</strong>'.
		
		</div>
	
		

		
	  </div>
		<div class="news pages">
			<h4 class='pages'><img src='/../resources/images/back_button.png' title='Go Back' class='back_button_page tooltip' /> <img src='/../resources/images/add.png' title='Add a new page' class='add_page right tooltip' /> Manage Pages</h4>
			
		    <form class='general_form'>
		     <?php if(count($data['pages']) > 0){?>
			  <ul class='select_page' name='select_page'> 
			       
			   <?php foreach($data['pages'] as $key=>$value): ?>
			    <li data-t='<?=$value['t']?>' data-id='<?=$value['id']?>'><span class='right'><img title='Edit Page' class='edit_page tooltip' alt='Edit Page' src='/../resources/images/edit.png' /></span><span class='title' style='color:#444444'><?=$value['title']?></span> <?php if($value['index'] == 1): echo '<img alt="Index Page" title="Index Page" class="index tooltip" src="/../resources/images/star.png" />'; endif; ?></li>
			   <?php endforeach;?>
			  </ul>
			 <?php }else { echo '<p class="no_page">You have no pages, use the button "+" to create one.</p>'; }?>
			  <div class='show_page_form'>
			    <select name='index_page'><option value='' disabled selected>Index Page?</option>
				                          <option value='0'>No</option>
										  <option value='1'>Yes</option></select><br />
				
				
				<div class='header_section'><span class='title'>SEO</span>
					<input type='text' name='title' placeholder='Page Title' />
					<input type='text' name='keywords' placeholder='Page Keywords[keyword1,keyword2,keyword3...]' />
					<textarea name='description' maxlenght='250' placeholder='Page description'></textarea><br /><br />
				</div>
				
				<div class='header_section'><span class='title'>Select Page Design </span>
				  
				  <ul class='designs_page'>
                  <?php foreach($data['designs'] as $key=>$value): ?>
				    
					<li ><input type='radio' name='designs' data-t='<?=$value['t']?>' created='<?=$value['created']?>' design-value='<?=$value['type']?>' value='<?=$value['id']?>' /><?=$value['name']?></li>
				   
				  <?php endforeach; ?>
				  </ul>
				</div>
				
				<div class='header_section'><span class='title'>Module list</span>
					<ul class='module_list'>
					
					 <?php foreach($data['modules']['preinstalled'] as $key=>$value): ?>
					  <li class='<?=$value['class']?>' data-id='<?=$value['id']?>'><?=$value['title']?></li>
					 <?php endforeach; ?>
					
					
					 <?php foreach($data['modules']['created'] as $key=>$value): ?>
					  <li class='<?=$value['class']?>' data-id='<?=$value['id']?>'><?=$value['title']?></li>
					 <?php endforeach; ?>
					 
					</ul>
				</div>
				
			    <div class='modules_holder'>
					<ul class='holder_modules'>
					
					
					
					</ul>
			    </div>
				<button class='remove_page right' style='display:none;margin-top:12px'>Remove Page</button>
			    <button class='add_page'>Create Page</button>
			
			  </div>
			</form>
			
		</div>
		
		<div class="news hide_mobile" style='padding:0px'>
		    <h4 style='padding:35px 35px 0px 35px;margin-bottom:0px'>Page Hits</h4>
			<div id="chart_div" style='width:660px;height:500px;margin:auto;'></div>
		</div>
		
		
		<div class='news' style='display:none'>
		 
		  <h4>Seo Analyzer</h4>
		  
		  in progress
		</div>
		
	
	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
</body>
</html>