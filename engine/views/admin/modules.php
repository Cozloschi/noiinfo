<!DOCTYPE html>
<html>
<head>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/header-part.php'); ?>
<script type="text/javascript" src="/../engine/external_scripts/html_editor/src/wysiwyg.js"></script>
<script type="text/javascript" src="/../engine/external_scripts/html_editor/src/wysiwyg-editor.js"></script>
<!-- github.io delivers wrong content-type - but you may want to include FontAwesome in 'wysiwyg-editor.css' -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="/../engine/external_scripts/html_editor/src/wysiwyg-editor.css" />
<script type="text/javascript">
$(document).ready(function(){
    // Full featured editor
  
   var index = 0; 
   var element = 'textarea#editor1';
   $(element).wysiwyg({
   
	classes: 'some-more-classes',
            // 'selection'|'top'|'top-selection'|'bottom'|'bottom-selection'
            toolbar: index == 0 ? 'top-selection' : (index == 1 ? 'bottom' : 'selection'),
            buttons: {
                // Dummy-HTML-Plugin
                dummybutton1: index != 1 ? false : {
                    html: $('<input id="submit" type="button" value="bold" />').click(function(){
                                // We simply make 'bold'
                                if( $(element).wysiwyg('shell').getSelectedHTML() )
                                    $(element).wysiwyg('shell').bold();
                                else
                                    alert( 'Please selection some text' );
                            }),
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                // Dummy-Button-Plugin
                dummybutton2: index != 1 ? false : {
                    title: 'Dummy',
                    image: '\uf1e7',
                    click: function( $button ) {
                            alert('Do something');
                           },
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                buttonname: {
					title: 'CODE',
					// How should the button look like?
					image:'<img src="/../resources/images/code.png" style="height:18px">',

					// What should the button do?
					popup: function( $popup, $button ) { },
					click: function( $button ) {
					 //console.log($(this));
					 
					 if(typeof $button.attr('data-type') === 'undefined' || $button.attr('data-type') == 'html'){
					  
					  $('textarea#editor1').show().text( $(element).wysiwyg('shell').getHTML());
					  $('div.wysiwyg-editor,div.wysiwyg-placeholder').hide();
					  $button.attr('data-type','code');
					 
					 }else{
		              $('textarea#editor1').hide();
					  $('div.wysiwyg-editor').show().html($('textarea#editor1').text());
					  //$('div.wysiwyg-placeholder').show();
					  $button.attr('data-type','html');
					 }
					
					},
					// Where should the button be placed?
					showstatic: true, // on the static toolbar
					showselection: false // on selection toolbar
				},
                insertimage: {
                    title: 'Insert image',
                    image: '\uf030', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                insertlink: {
                    title: 'Insert link',
                    image: '\uf08e' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                // Fontname plugin
                fontname: index == 1 ? false : {
                    title: 'Font',
                    image: '\uf031', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            var list_fontnames = {
                                    // Name : Font
                                    'Arial, Helvetica' : 'Arial,Helvetica',
                                    'Verdana'          : 'Verdana,Geneva',
                                    'Georgia'          : 'Georgia',
                                    'Courier New'      : 'Courier New,Courier',
                                    'Times New Roman'  : 'Times New Roman,Times'
                                };
                            var $list = $('<div/>').addClass('wysiwyg-toolbar-list')
                                                   .attr('unselectable','on');
                            $.each( list_fontnames, function( name, font ){
                                var $link = $('<a/>').attr('href','#')
                                                    .css( 'font-family', font )
                                                    .html( name )
                                                    .click(function(event){
													    //console.log($(element));
                                                        $(element).wysiwyg('shell').fontName(font).closePopup();
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                           },
                    //showstatic: true,    // wanted on the toolbar
                    showselection: index == 0 ? true : false    // wanted on selection
                },
                // Fontsize plugin
                fontsize: index == 1 ? false : {
                    title: 'Size',
                    image: '\uf034', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            var list_fontsizes = {
                                // Name : Size
                                'Huge'    : 7,
                                'Larger'  : 6,
                                'Large'   : 5,
                                'Normal'  : 4,
                                'Small'   : 3,
                                'Smaller' : 2,
                                'Tiny'    : 1
                            };
                            var $list = $('<div/>').addClass('wysiwyg-toolbar-list')
                                                   .attr('unselectable','on');
                            $.each( list_fontsizes, function( name, size ){
                                var $link = $('<a/>').attr('href','#')
                                                    .css( 'font-size', (8 + (size * 3)) + 'px' )
                                                    .html( name )
                                                    .click(function(event){
                                                        $(element).wysiwyg('shell').fontSize(size).closePopup();
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                           }
                    //showstatic: true,    // wanted on the toolbar
                    //showselection: true    // wanted on selection
                },
                // Header plugin
                header: index != 1 ? false : {
                    title: 'Header',
                    image: '\uf1dc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            var list_headers = {
                                    // Name : Font
                                    'Header 1'     : '<h1>',
                                    'Header 2'     : '<h2>',
                                    'Header 3'     : '<h3>',
                                    'Header 4'     : '<h4>',
                                    'Header 5'     : '<h5>',
                                    'Header 6'     : '<h6>',
                                    'Preformatted' : '<pre>'
                                };
                            var $list = $('<div/>').addClass('wysiwyg-toolbar-list')
                                                   .attr('unselectable','on');
                            $.each( list_headers, function( name, format ){
                                var $link = $('<a/>').attr('href','#')
                                                     .css( 'font-family', format )
                                                     .html( name )
                                                     .click(function(event){
                                                        $(element).wysiwyg('shell').format(format).closePopup();
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                           }
                    //showstatic: true,    // wanted on the toolbar
                    //showselection: false    // wanted on selection
                },
                bold: {
                    title: 'Bold (Ctrl+B)',
                    image: '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'b'
                },
                italic: {
                    title: 'Italic (Ctrl+I)',
                    image: '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'i'
                },
                underline: {
                    title: 'Underline (Ctrl+U)',
                    image: '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'u'
                },
                strikethrough: {
                    title: 'Strikethrough (Ctrl+S)',
                    image: '\uf0cc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 's'
                },
                forecolor: {
                    title: 'Text color',
                    image: '\uf1fc' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                highlight: {
                    title: 'Background color',
                    image: '\uf043' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                alignleft: index != 0 ? false : {
                    title: 'Left',
                    image: '\uf036', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                aligncenter: index != 0 ? false : {
                    title: 'Center',
                    image: '\uf037', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                alignright: index != 0 ? false : {
                    title: 'Right',
                    image: '\uf038', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                alignjustify: index != 0 ? false : {
                    title: 'Justify',
                    image: '\uf039', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                subscript: index == 1 ? false : {
                    title: 'Subscript',
                    image: '\uf12c', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: true    // wanted on selection
                },
                superscript: index == 1 ? false : {
                    title: 'Superscript',
                    image: '\uf12b', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: true    // wanted on selection
                },
                indent: index != 0 ? false : {
                    title: 'Indent',
                    image: '\uf03c', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                outdent: index != 0 ? false : {
                    title: 'Outdent',
                    image: '\uf03b', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                orderedList: index != 0 ? false : {
                    title: 'Ordered list',
                    image: '\uf0cb', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                unorderedList: index != 0 ? false : {
                    title: 'Unordered list',
                    image: '\uf0ca', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                removeformat: {
                    title: 'Remove format',
                    image: '\uf12d' // <img src="path/to/image.png" width="16" height="16" alt="" />
                }
            },
            // Submit-Button
            submit: {
                title: 'Submit',
                image: '\uf00c' // <img src="path/to/image.png" width="16" height="16" alt="" />
            },
            // Other properties
            dropfileclick: 'Drop image or click',
            placeholderUrl: 'www.example.com',
            maxImageSize: [600,200]
});



	 

	
	//
	

});
</script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
</head>
<body>
 <?php include($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/menu-part.php'); ?>
	<section>
	 
	  <div class='right'>
	    <div>
		 <h4>What means <i>preinstalled</i> or <i>created</i> module?</h4>
		 <p> <strong> Created module </strong> is actually a HTML code that you create and put on the page.<br /><br />
		 <strong> Preinstalled module </strong> is actually a admin panel for a specific preinstalled module such as forum,menu,blog and so on..
		  </p>
		</div>
	    
	   
	    <div >
		 <h4 style='margin:0px'>Info</h4>
		 
		 <p><strong>To manage created modules</strong>:<br />
		 1. Click 'Edit Module' button <br />
		 2. Edit module<br /> <br />
		 
		 <strong>To create a new module</strong> you need to click 'Create new module' button. <br /><br />
	 
         <strong>To administrate a preinstalled module</strong> you need to click the 'Show admin panel' button.	 
		 </p>
		</div>
	
		

	  </div>
		<div class="news modules">
			<h4><img src='/../resources/images/back_button.png'  title='Go Back' style='float:left' class='button back_module c tooltip' /> <img src='/../resources/images/add.png' class='button add_modules right tooltip' title='Create new module' style='margin-right:0px;display:inline-block' />Manage Created Modules</h4>
			
			
			<form class='general_form'>
			 
     
			
			 <ul class='select_module c'>
			  <?php if(count($data['modules']['created']) > 0){ ?>  
			  <?php foreach($data['modules']['created'] as $key=>$value): ?>
			   <li data-id='<?=$value['id']?>'><img alt='Edit Module' title='Edit Module' style='display:block' class='right edit_module_c button tooltip' src='/../resources/images/edit.png' /><span class='text_m' style='color:#000000'><?=$value['title']?></span></li>
			  <?php endforeach; ?>
			  <?php }else{ echo "<p>You have no modules. Create modules using '+' button.</p>"; } ?>
			 </ul>
			 
			 <div class='show_page_form c'>
			   <input type='text' name='module_name' placeholder='Module Name' />
			
			   <textarea id="editor1" name="editor" placeholder="Type your text here..."></textarea>
			
			  <button class='delete_module right' style='margin-top:10px'> Delete module</button>
			  <button class='add_module'>Save Module</button>
			 </div>
			</form>
			

			
		</div>
		
		<div class="news">
			<h4><img src='/../resources/images/back_button.png'  title='Go Back' style='float:left' class='button back_module p tooltip' />Manage Preinstalled modules</h4>
			 
			 <ul class='module_list p'>
			  
			  <?php foreach($data['modules']['preinstalled'] as $key=>$value): ?>
			   <li data-id='<?=$value['id']?>'><img alt='Show Admin Panel' title='Show Admin Panel' style='display:block' class='right edit_module_p button tooltip' src='/../resources/images/edit.png' /> <?=$value['title']?> </li>
			  <?php endforeach; ?>
			 
			 </ul>
			 
			 <div class='preinstalled_holder'>
			 
			 
			 </div>
			
		</div>
		
	
	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
</body>
</html>