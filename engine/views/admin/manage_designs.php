<!DOCTYPE html>
<html>
<head>
<script src="/../engine/external_scripts/codemirror/lib/codemirror.js"></script>
<script src="/../engine/external_scripts/codemirror/mode/xml/xml.js"></script>

<script src="/../engine/external_scripts/codemirror/addon/display/fullscreen.js"></script>
<script src="/../engine/external_scripts/codemirror/addon/selection/selection-pointer.js"></script>

<script> var serialized_designs; 
         var widgets = [
						{x: 0, y: 0, width: 2, height: 2},
						{x: 2, y: 0, width: 4, height: 2},
						{x: 6, y: 0, width: 2, height: 4},
						{x: 1, y: 2, width: 4, height: 2}];
		 var widgets_w= [];
		 
		 var designs = {};
		 
	     var design_options ={};
		 
	
		 </script>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/header-part.php'); ?>


<link rel="stylesheet" href="/../engine/external_scripts/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="/../engine/external_scripts/codemirror/addon/display/fullscreen.css">
<link rel="stylesheet" href="/../engine/external_scripts/codemirror/theme/xq-light.css">

<!--Grid-->
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="/../engine/external_scripts/gridster/src/gridstack.css"/>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.5.0/lodash.min.js"></script>
 <script src="http://cdnjs.cloudflare.com/ajax/libs/knockout/3.2.0/knockout-min.js"></script>
<script src="/../engine/external_scripts/gridster/src/gridstack.js"></script>

 <style type="text/css">
 
        .container-fluid{
			position:fixed;
			width:90%;
			top:5%;
			left:5%;
			background-color:#efefef;
			border:1px solid #e0e0e0;
			padding:10px 0px 0px 0px;
			box-sizing:border-box;
			min-height:90%;
			max-height:90%;
			overflow-y:scroll;
			overflow-x:hidden;
			display:block;
			z-index:230;
			
		
		}
        .grid-stack {
            background: #FFFFFF;
			overflow:auto;
			box-sizing:border-box;
			height:80%;
			display:block;
			overflow:hidden;
			margin-top:0px;
			
        }

        .grid-stack-item-content {
            color: #2c3e50;
            text-align: center;
            background-color: #18bc9c;
        }
		
		
		
		div.holder_msg{width:300px;position:absolute;background-color:#ffffff;border:1px solid #e0e0e0;right:70px;top:0px;padding:10px;box-sizing:border-box;z-index:100;font-family:RobotoRegular;display:none}
        div.holder_msg h3{font-size:17px;margin:0px;margin:5px 0px 20px 0px;}
		div.holder_msg h3 span.close_pop{float:right;color:#000000;cursor:pointer;color:#646464}
		div.holder_msg ul{padding:0px;margin:0px;list-style:none;max-height:300px;overflow:auto}
		div.holder_msg ul li{padding:5px;margin:0px;border-bottom:1px solid #efefef;}
		div.holder_msg ul li:hover{cursor:pointer;color:#000000;border-bottom:1px solid #646464}
		
		div.background{position:fixed;margin:0px;width:100%;height:100%;display:block;z-index:210;background-color:rgba(00,00,00,0.5);top:0px;left:0px;}
	    
		div.controll button{padding:5px;width:200px;margin-left:10px;font-family:RobotoRegular;color:#000000;background-color:#ffffff;border:none;border:1px solid #ffffff;color:#646464;margin-bottom:10px;}
	    
		div.controll button:hover{color:#458cce;border:1px solid #458cce;cursor:pointer;}
		
		div.space{width:100%;height:10px;display:block;background-color:#ffffff;}
		
		div.close{float:right;margin-right:10px;padding:5px 10px 5px 10px;background-color:#ffffff;border:1px solid #e0e0e0;font-family:RobotoRegular;color:#646464;}
		div.close:hover{color:#000000;border:1px solid #000000;cursor:pointer;}
	    
		button.delete_module_pagebuilder{float:right;background-color:transparent;border:none;color:#ffffff;font-family:RobotoRegular;padding:10px;cursor:pointer}
	
	
	    span.title_module{color:#ffffff;font-family:RobotoRegular;font-size:15px;display:block;margin:10px 0px 0px 10px;float:left;}
	
	    span.color_holder{width:25px;height:25px;float:right;background-color:#000000;display:block;}
	
	    ul#design_content{display:none;}
		
		img.back_design{display:none;margin-right:10px;float:left;}
		
		
		input.design_number{float:right;width:50px;padding-left:4px}
	</style>
	
	
	
<!-- color picker -->
<link rel="stylesheet" media="screen" type="text/css" href="/../engine/external_scripts/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="/../engine/external_scripts/colorpicker/js/colorpicker.js"></script>

<head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/menu-part.php'); ?>
	<section>
	 <div class='background'style='display:none' > </div>
	  <div class='right'>
	    <div class='hide_mobile'>
		  <h4 style='margin:0px'>What means created or installed designs?</h4>
		  <p>
		    A <strong>installed</strong> design is a template that you choose to install to your account. You can install a template to your account using '<strong>Install Design</strong>' section.<br /><br />
		    A <strong>created</strong> design is a template that you create with your own HTML code. Using <strong>file manager</strong> section for external files.
		  </p>
		 
		</div>
		
		<div class='hide_mobile'>
		  <h4 style='margin:0px'>How to use?</h4>
		  <p> Using this page you can install/create or manage a template for your website.<br /><br />
		  In <strong>Manage Created Designs</strong> you can modify your html for a template or you can write your own html in a new design.<br /><br />
		  In <strong>Manage Installed Designs</strong> you can access the admin panel for a specific installed theme, and customize it.</p>
		  
		  
		  
		</div>
		
		
	
		


		
	  </div>
		    <div class="container-fluid" style='display:none's>


        <div class='controll' >
            <button data-bind="click: add_new_widget">Add new module holder</button>
            <button class='save_grid' data-bind="click: save_grid">Save</button>
            <button class='delete_design_p' style='margin-left:40px'>Delete Design</button>
            <button data-bind="click: load_grid" style='display:none' class='load_grid'> load Grid</button>
			
		    <div class='holder_msg'>
			 <h3>Please select a module to add <span class='close_pop' title='Close list'> X </span></h3>
			 
			 <ul class='module_list_grid'>
			  <?php foreach($data['modules'] as $module): ?>
			  <li  data-id='<?=$module['id']?>'><?=$module['title']?></li>
			  <?php endforeach; ?>
			 </ul>
			 
			 <h3 style='margin-top:20px;margin-bottom:5px;'><img src='/../resources/images/back_button.png' class='back_design'/> Design Manager </h3>
			 
			 <ul class='design_manager_list'>
			  <li class='border'>Border </li>
			  <li class='text'>Text   </li>
			  <li class='background'>Background </li>
			  <li class='content'>Content  </li>
			 </ul>
			 
			 
			 <ul id='design_content' class='border'>
			 
			  <li><span class='color_holder border-top' data-class='border-top'> </span> Border-top :</li>
			  <li><span class='color_holder border-bottom' data-class='border-bottom'> </span> Border-bottom :</li>
			  <li><span class='color_holder border-right' data-class='border-right'> </span> Border-right :</li>
			  <li><span class='color_holder border-left' data-class='border-left'> </span> Border-left  :</li> 
			 
			 </ul>		

             <ul id='design_content' class='text'>
			  <li><span class='color_holder' data-class='color' ></span> Text Color: </li>
			  <li><input type='number'  min='10' max='20' class='design_number' data-class='font-size'/> Text size : </li>
            
			 </ul>
			  
			  
			  <ul id='design_content' class='background'>
			   <li><span class='color_holder' data-class='background-color'></span> Background Color:</li>
			  
			  </ul>
			  <ul id='design_content' class='content'>
			 
			  <li><input type='number' min='0' max='20' class='design_number' data-class='padding-top'> </span> Padding-top :</li>
			  <li><input type='number' min='0' max='20' class='design_number' data-class='padding-right'> </span> Padding-right :</li>
			  <li><input type='number' min='0' max='20' class='design_number' data-class='padding-bottom'> </span> Padding-bottom :</li>
			  <li><input type='number' min='0' max='20' class='design_number' data-class='padding-left'> </span> Padding-left :</li>
			  
			 </ul>
			
			</div>
			
			<div class='close tooltip' title='Close' data-action='0'>X</div>
        </div>
         <div class='space'> </div>
        <div class='grid_stack' style='max-height:80%' data-bind="component: {name: 'dashboard-grid', params: $data}"></div>
      

        <!--<textarea id="saved-data" cols="100" rows="20" readonly="readonly"></textarea> -->
    </div>
      
			<div class="news">
				<h4><img src='/../resources/images/add.png' class='right tooltip add_design_img' title='Create Design' /><img src='/../resources/images/back_button.png' title='Go Back' class='button created_design tooltip' style='float:left' />Manage Created Designs</h4>
		        
				<form>
				<ul class='select_design'>
			 <?php if(count($data['designs']) > 0){?>
				  <?php foreach($data['designs'] as $key=>$value): ?>
				   <?php if($value['created'] == 1):?>
				    <li data-t='<?=$value['t']?>'  data-id='<?=$value['id']?>'><img alt='Edit Design' title='Edit Design' src='/../resources/images/edit.png' class='right button edit_created_design tooltip' style='display:block;margin-right:0px;padding:2px;' /><?=$value['name']?></li>
				   <?php endif; ?>
				  <?php endforeach;?>
			 <?php }else{ echo "You have no created designs. To create one, click the '+' button."; }?>		
				</ul>
				
					<div class='show_edit_design'>
						<input type='text' name='design_name' style='margin-bottom:10px' placeholder='Design name' />
						
						<p> You can create your own HTML code using forms below or you can use page builder to create your own design. Click <a href='#' class='pagebuilder'>here</a> to open pagebuilder.</p>
						
						<select style='margin-bottom:10px' name='design_type'>
						 <option value='' selected disabled>Design Type:</option>
						 <option value='0'>Ony center collon</option>
						 <option value='1'>Center collon and left sidebar</option>
						 <option value='2'>Center collon and right sidebar</option>
						 <option value='3'>Center collong and both sidebars</option>
						</select>
						
						
						
						
						<textarea id="code" name="code" style='border-top:1px solid #e0e0e0;display:none' rows="5"></textarea>
						
						<button class='delete_design right' style='margin-top:10px'>Delete design</button>
						<button class='save_design' style='margin-top:10px'>Save design</button>
					</div>
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
			 <h4><img src='/../resources/images/back_button.png' title='Go Back' class='button installed_designs tooltip' style='float:left' />Manage Installed Designs</h4>
			 <ul class='installed_designs'>
			 <?php if(count($data['designs']) > 0){?>
			  <?php foreach($data['designs'] as $key=>$value): ?>
			   <?php if($value['created'] == 0): ?>
			    <li data='<?=$value['id']?>-<?=$value['name']?>'><img alt='Edit Design' title='Edit Design' src='/../resources/images/edit.png' class='right button edit_installed_design tooltip' style='display:block;margin-right:0px;padding:2px;' /><?=$value['name']?></li>
			   <?php endif; ?>
			  <?php endforeach;?>
			 <?php } else { echo "You have preinstalled designs."; } ?>
			 </ul>
			 
			 <div class='template_admin_holder'>
			 
			 </div>
			</div>
			
			
			<div class='news'>
			 <h4>Install Design</h4>
			 <form class='search'>
			  <input type='text' class='search' placeholder='Search [press Enter]' />
			 </form>
			 <div class='designs_holder'>

			   <?php foreach($data['templates'] as $key=>$value):?>
			    
				<div class='template'><span class='template_name'><?=$value['name']?></span><img src='<?=$value['image']?>'>
				
				<?php if($value['installed'] == 0): ?>
				 <span class='install'  data='<?=$value['name']?>'>Install</span>
				<?php endif;	?>
				
				<?php if($value['installed'] == 1):?>
				 <span class='uninstall'  data='<?=$value['name']?>'>Uninstall</span>
				<?php endif;?>
				
				<a target='_blank' href='<?=$value['preview']?>'><span class='preview'>Preview</span></a></div>
			   
			   <?php endforeach; ?>

			 </div>
			
			</div>

	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
    <script type="text/javascript">

	 var $saved;
        ko.components.register('dashboard-grid', {
            viewModel: {
                createViewModel: function (controller, componentInfo) {
                    var ViewModel = function (controller, componentInfo) {
                        var grid = null;

                        this.widgets = controller.widgets;

                        this.afterAddWidget = function (items) {
                            if (grid == null) {
                                grid = $(componentInfo.element).find('.grid-stack').gridstack({
                                    auto: false
                                }).data('gridstack');
                            }

                            var item = _.find(items, function (i) { return i.nodeType == 1 });
                            grid.add_widget(item);
                            ko.utils.domNodeDisposal.addDisposeCallback(item, function () {
                                grid.remove_widget(item);
                            });
                        };
                    };

                    return new ViewModel(controller, componentInfo);
                }
            },
            template:
                [
                    '<div class="grid-stack" data-bind="foreach: {data: widgets, afterRender: afterAddWidget}">',
                    '   <div class="grid-stack-item" data-bind="attr: {\'data-gs-x\': $data.x, \'data-gs-y\': $data.y, \'data-gs-width\': $data.width, \'data-gs-height\': $data.height, \'data-gs-auto-position\': $data.auto_position, \'data-id\': $data.module, \'id\': $data.id, \'data-name\': $data.name}">',
                    '       <div class="grid-stack-item-content"><span class="title_module">My Module</span><button class="delete_module_pagebuilder tooltip" title="Delete" data-bind="click: $root.delete_widget">X</button></div>',
                    '   </div>',
                    '</div> '
                ].join('')
        });

        $(function () {
            var Controller = function (widgets) {
                var self = this;

                this.widgets = ko.observableArray(widgets);

                this.add_new_widget = function () {
                    this.widgets.push({
                        x: 0,
                        y: 0,
                        width: Math.floor(1 + 3 * Math.random()),
                        height: Math.floor(1 + 3 * Math.random()),
                        auto_position: true,
						module:0,
						name: ''
                    });
                };
			    //this.grid = $('.grid-stack').data('gridstack');
			    this.load_grid = function () {
				 //delete all
				  //console.log(self.widgets);
				  
				  $('button.delete_module_pagebuilder').each(function(){
				   $(this).trigger('click');
				   //self.widgets.remove_widget(el);
				  });
				
				  //console.log(widgets_2);

                  $.each(widgets_2,function(index,val){
				   self.widgets.push({
                        x: val.x,
                        y: val.y,
                        width: val.width,
                        height: val.height,
                        auto_position: false,
						module:val.module,
						name  :val.name,
						id    :val.id
                    });
					//console.log(val.module);
				  });
				
                }.bind(this);
				
				 this.save_grid = function () {
                    this.serialized_data = _.map($('.grid-stack > .grid-stack-item:visible'), function (el) {
                        el = $(el);
                        var node = el.data('_gridstack_node');
                        return {
                            x: node.x,
                            y: node.y,
                            width: node.width,
                            height: node.height,
							module: el.attr('data-id'),
							name  : el.attr('data-name'),
							id    : el.attr('id')
                        };
                    }, this);
                    serialized_designs = JSON.stringify(this.serialized_data, null, '    ');
					
					var item = $('button.save_grid');
					
					//make the request
					if($('div.controll').find('div.close').attr('data-action') !== '0'){
					  
					  item.text('Loading..');
					  var obj = {id    : $('div.controll').find('div.close').attr('data-action'),
					             serial: serialized_designs,
								 action: 'save_pagebuilder',
								 design: JSON.stringify(designs),
								 token : token};
					  
					  $.post('/requests',obj,function(response){
					   
					    if(response.status == 'done'){
						  
						  item.text('Saved');
						
						}
						else{
						  item.text('Error');
						}
						
						token = response.token;
					  
					  },'JSON');
					
					}else{
					 item.text('Saved');
					 setTimeout(function(){
					  
					  item.text('Save');
					 
					 },4000);
					}
                }.bind(this);

                this.delete_widget = function (item) {
                    self.widgets.remove(item);
                };
            };



            var controller = new Controller(widgets);
            ko.applyBindings(controller);
			
			
		
			
			
			//no ko
			$(document).on('click','div.close',function(){
			  
			  $('div.container-fluid,div.background').fadeOut('fast');
			 
			});
			
			/*
			$(document).on('click','div.show',function(){
			  
			  $('div.container-fluid,div.background').fadeIn('fast');
			 
			});
			*/
			
			//popup hide
			$(document).on('click','span.close_pop',function(){
			 $('div.holder_msg').hide();
			});
			
			//popup show
			$(document).on('click','div.grid-stack-item',function(e){
			 if(!$(e.target).hasClass('delete_module_pagebuilder')){
			  $('div.holder_msg').show();
			  $saved = $(this); //make saved
			  
			  //generate id if not exists
			  if($(this).attr('id') == '' || typeof $(this).attr('id') == 'undefined'){
			   var id = 'id-'+Math.floor((Math.random() * 1000) + 1);
			   $(this).attr('id',id);
			  
			  }else
			   var id = $(this).attr('id');
			  
			  if(typeof designs[$(this).attr('id')] == 'undefined') //if it's undefined
			  designs[$(this).attr('id')] = {};
			  
			  //console.log(designs[id]);
			  //put colors
			  $('ul#design_content').each(function(){
			    
				$(this).find('li').each(function(){
				 
				 var $span = $(this).find('span');
				 
				 if($span.length == 0)
				  $span = $(this).find('input');
				 //console.log(designs[id][$span.attr('data-class')]);
				 
				 if(typeof designs[id] !== 'undefined')
				 {
				 if(typeof designs[id][$span.attr('data-class')] !== 'undefined'){
				  if($span.is('span'))
				   $span.css('background-color','#'+designs[id][$span.attr('data-class')]);
				  else
				   $span.val(designs[id][$span.attr('data-class')]);
				 }else{
				   if($span.is('span'))
				    $span.css('background-color','#000000');
				   else
				    $span.val(0);
				 }
				 }
				 else
				  $span.css('background-color','#000000');
				});
			  
			  });
			  
			  
			 }
			});
			
			
			$(document).on('click','ul.module_list_grid li',function(){
			  $('span.close_pop').trigger('click');
			  $saved.attr('data-id',$(this).attr('data-id')).attr('data-name',$(this).text());
			  $saved.find('span.title_module').text($(this).text());
			 
			});
			
			
			$(document).on('click','button.delete_design_p',function(){
			  
			  var id = $('div.close').attr('data-action');
			  
			  if(id !== 0){ // make action
			  
			    var obj = {id     : id,
				           token  : token,
						   action :'delete_pagebuilder_design'};
						   
				var $saved = $(this);
				$saved.text('Loading..');
                
                $.post('/requests',obj,function(response){
					
					if(response.status == 'done'){
					 
					 $saved.text('Done');
					 
					 $('div.close').trigger('click');
					 
					 $('ul.select_design').find('li[data-id='+id+']').remove();
					 
					}else{
					 
					 $saved.text('Error');
					
					}
					
					token = response.token;

				},'JSON');
			    
			  }
			 
			
			});
			
			
			
			
			
			
			
			
			
			
	
			
			
			//show specific design options
			
			$(document).on('click','ul.design_manager_list li',function(){
			  
			  //show back button
			  $('img.back_design').show();
			  $('ul.design_manager_list').hide();
			  $('ul#design_content.'+$(this).attr('class')).show().attr('data-display',1);
			 
			});
			
			//back
			$(document).on('click','img.back_design',function(){
			
			 $(this).hide();

			
			});
			
			$(document).on('click','img.back_design',function(){
			
			 
			 $('ul.design_manager_list').show();
			 $('ul#design_content[data-display=1],img.back_design').hide();
			
			});
			
			
			$(document).on('change','input[type=number]',function(){
			
			  designs[$saved.attr('id')][$(this).attr('data-class')] = $(this).val();
				
			});
			
			
			
	      //colorpicker
		  $('span.color_holder').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb,item) {
				$(item).css('backgroundColor', '#' + hex);
				designs[$saved.attr('id')][$(item).attr('data-class')] = hex;
				
		
			},
			onBeforeShow: function () {
			    //console.log(this);
				function rgb2hex(rgb){
				 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
				 return (rgb && rgb.length === 4) ? "#" +
				  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
				  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
				  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
				}
				
				var rgb = $(this).css('background-color');
				
		
				$(this).ColorPickerSetColor(rgb2hex(rgb));
				//console.log(this.$(this).css('background-color'));
			}
		});
			
        });
    </script>
</body>
</html>