//==============================effects 
//check if something is empty
function check_empty(obj){
	  
	      //check for empty modules
		  //var sw = 0;
		  
		  $.each(obj,function(index,value){
		  
		   console.log(value);
		   
		   if(value == '')
		    return true;
		  
		  });
		  
		  return false;
	  
	  }
//add loading section 
function add_loading_section(i){
 
 var $news = $('div.news').eq(i);
 
 var deta = {'height':$news.height(),
             'width' :$news.width()};
 
 $news.prepend("<div class='loading_div' style='width:"+deta.width+"px;height:"+deta.height+"px'> </div>");

}

function remove_loading_section(i){
 
 var $news = $('div.news').eq(i);
 
 $news.find('div.loading_div').remove();
 
}


//serialized designs
var serialized_designs = '';


$(document).ready(function(){ //================================================ on document ready


function login_admin(){ //change login admin

   if(!$('button.login.admin').hasClass('send_password'))
   {
    //modify h4
    $('h4').text('Forgot Password');
    
    $('button.lost_password').text('Login').addClass('add_login').removeClass('lost_password');
   
    $('button.login.admin').text('Send password').addClass('send_password');
   
    $('input[type=password]').slideUp(150);
   
    $('div.logi.admin_login').animate({'height':'-=60px'},250);
  }
  else
  {
      //modify h4
    $('h4').text('Login');
    
    $('button.add_login').text('Lost password?').removeClass('add_login').addClass('lost_password');
   
    $('button.login.admin').text('Login').removeClass('send_password');
   
    $('input[type=password]').show(150);
   
    $('div.logi.admin_login').animate({'height':'+=60px'},150);
  
  
  }
}

//login forgot password
 $(document).on('click','button.lost_password',function(){
   
   login_admin();
   
 });
 
 $(document).on('click','button.add_login',function(){
   
   login_admin();
  
 });
 
/* page effects */
 
 function create_page_effect(div){
  
   $div_page_form = $(div);
   
   
   if($div_page_form.is(':hidden')){ //only if it's hidden
   
       $div_page_form.fadeIn('fast');
        
	}
 
 }
 
 
 //show add page
 $(document).on('click','img.add_page',function(){
   
     add_loading_section(0);
	 
	 $('ul.select_page,p.no_page').hide();
     
     //buttons
	 $('img.add_page').hide();
	 $('img.back_button_page').show();
	 
	 var $show_page_form = $('div.show_page_form');
  
  	 //add a page
	 $('button.remove_page').hide();
	 $show_page_form.find('input:not("[type=radio]")').val(''); //remove any data
	 $show_page_form.find('textarea').text('');
	 $show_page_form.find('button').eq(1).addClass('add_page').removeClass('edit_page').text('Create page').show();
	 
	 create_page_effect('div.show_page_form');
	 
	 remove_loading_section(0);
 
 
 
 });
 
 //show add module
 $(document).on('click','img.add_modules',function(){
  
     add_loading_section(0);
	 
	 $('ul.select_module.c').hide();
     
     //buttons
	 $('img.add_modules').hide();
	 $('img.back_module.c').show();
  
     var $show_page_form = $('div.show_page_form.c');
  
  
  	 $show_page_form.find('input').val(''); //remove any data
	 //$show_page_form.find('textarea').text('');
	 $show_page_form.find('button').eq(1).addClass('add_module').removeClass('edit_module').text('Create module');
	 
	 $('button.delete_module').hide();
	 
	 remove_loading_section(0);
	 
	 create_page_effect('div.show_page_form');
 
 });
 
//==================================== back button ============================/
 //pages
 $(document).on('click','img.back_button_page',function(){
 

  $('div.show_page_form').hide(); //hide current
  
  $('ul.select_page,p.no_page').show();
  
  $('img.back_button_page').hide(); //hide back button
  
  $('img.add_page').show();//show add button
 
 });
 
 //modules created
 
 $(document).on('click','img.back_module.c',function(){
 

  $('div.show_page_form.c').hide(); //hide current
  
  $('ul.select_module.c').show();
  
  $('img.back_module.c').hide(); //hide back button
  
  $('img.add_modules').show();//show add button
 
 });

//modules preinstalled

 $(document).on('click','img.back_module.p',function(){
  
  $('div.preinstalled_holder').hide();
  $('ul.module_list.p').show();
  
  $(this).hide();
 
 });
 
 
//manage users
 $(document).on('click','img.back_button_users',function(){
  
  $('form.users').show();
  $('div.edit_user_holder').hide();
  
  $(this).hide();
 
 });
 
 
//manage groups
 
 $(document).on('click','img.back_button_groups',function(){
  
  $('div.group_list').show();
  $('div.show_group').hide();
  
  $(this).hide();
 
 });
 
//manage created designs
 
 $(document).on('click','img.created_design',function(){
  
  $('ul.select_design').show();
  $('div.show_edit_design').hide();
  
  //reverse buttons
  $('button.add_design').removeClass('add_design').addClass('save_design').text('Save design');
  $('button.delete_design').show();
  
  $('img.add_design_img').show();
  
  
  $(this).hide();
 
 });
 
 //manage installed designs
 
 $(document).on('click','img.installed_designs',function(){
  
  $('ul.installed_designs').show();
  $('div.template_admin_holder').hide();
  
  $(this).hide();
 
 });
 
 // open pagebuilder
 
 $(document).on('click','a.pagebuilder',function(){
   
   event.preventDefault();
   
   //action data
   if(!$('img.button.created_design').is(':hidden')){ //add new
    $('div.controll').find('div.close').attr('data-action',0);
    $('button.delete_design_p').hide();
   }

   
   
   $('div.background,div.container-fluid').show();
   
   //hide html code
   $('select[name=design_type],div.CodeMirror').hide();
  
 });
 
 
 //================select page action
 $(document).on('click','img.edit_page',function(){

    //effects
    
	var $show_page_form = $('div.show_page_form');
   
	$show_page_form.find('button').eq(1).removeClass('add_page').addClass('edit_page').text('Edit page');
	$('button.remove_page').show();
	
	 
	//add back button
	$('img.back_button_page').show();   

   
   var obj = {'token' :token,
              'action':'select_page',
			  'id'    : $(this).parent('span').parent('li').attr('data-id')};
			  
   
   add_loading_section(0);
   
   //clear old modules
   $('ul.holder_modules').each(function(){ //clear all
   
	   $(this).find('li').each(function(){
		
		var id   = $(this).attr('data-id');
		var name = $(this).text();
		$(this).remove();
		
		$('ul.module_list').prepend('<li class="default ui-sortable-handle" data-id="'+id+'">'+name+'</li>');
		
	   
	   });
   });  
   
   //make the request here
   $.get('/requests/',obj,function(response){
   
    
    //console.log(response);
	
	if(response.status == 'done'){
	
	    //remove page list and add back button
		
		$('ul.select_page').hide();
		
		
		//add back button attribute
		
		$('img.back_button_page').attr('data-id',response.id);
        
        remove_loading_section(0);
       		
		token = response.token;
		
		//effects
		create_page_effect('div.show_page_form');
		
		if(response.index == 1)
		 $('select[name=index_page]').find('option[value=1]').attr('selected',true);
		else 
		 $('select[name=index_page]').find('option[value=0]').attr('selected',true);
		
		
		//add page design select
		$('input[value='+response.design_id+'][type=radio]').attr('checked',true).attr('select','selected');
		
		
		//add page design

		 $.get('/engine/data/designs_type/'+response.design+'.html',function(response_html){
		  
		  $('div.modules_holder').html(response_html);
		  

			
			response.modules = JSON.parse(response.modul);
			


			
			//console.log(response.modules);
		
			$.each(response.modules,function(index_class,val_class){
		
				$.each(val_class,function(index,val){
				 
				
				 var $li_list = $('ul.module_list').find('[data-id='+val+']'); //get the ul from list
				 
				 var name     = $li_list.text();
				
				 if(name != ''){
				  if(index_class !== 'fixed')
					$('ul.holder_modules.'+index_class).append('<li data-id="'+val+'">'+name+'</li>');
				  else
					$('ul.holder_modules.center').append('<li class="fixed" data-id="'+val+'">'+name+'</li>');
				 }
				 //remove from list
				 $li_list.remove();
				 
				});
			});	
		 
		 });
		 
		
		//add data to forms
		$('input[name=title]').val(response.title);
		
		$('input[name=keywords]').val(response.keyw);
		
		$('textarea[name=description]').text(response.desc);
		
   
   
    }
   },'JSON');
   

  
  
 
 });
 //select module action
 $(document).on('click','img.edit_module_c',function(){
 

   
   var obj = {'token' :token,
              'action':'select_module',
			  'id'    : $(this).parent('li').attr('data-id')};
			  
   var $saved = $(this);
   
   //add loading
   add_loading_section(0);
   

   
   
   //make the request here
   $.get('/requests/',obj,function(response){
    
	token = response.token;
    
	
	
	
	//console.log(response);
    if(response.status == 'done'){ //everything is ok
		
	   //effects
	   //show edit page selector
	   
	   var $show_page_form = $('div.show_page_form.c');
	 
	   $show_page_form.find('button').eq(1).removeClass('add_module').addClass('edit_module').text('Save module');
	   $('button.delete_module').fadeIn('fast');
	   
	   //hide module list
	   $('ul.select_module.c').hide();
		
		
		//remove loading
		remove_loading_section(0);
		
		//add data to back button
		$('img.back_module.c').attr('data-id',obj.id).attr('data-file',response.data.file).show();
		
		//hide list
        $('ul.select_module_c').hide();
	 	
		//change data
		$('input[name=module_name]').val(response.data.title);
		
		//add first name
		$('input[name=module_name]').attr('first-name',response.data.title);
		
		//add to container
		$('div.wysiwyg-editor').html(response.data.html);
		
		//console.log(response.data.html);
		$('button.edit_module').attr('data-id',$saved.val()); // add data to button
		$('button.delete_module').attr('data-id',$saved.val()); // add data to button
		
		//effects
		create_page_effect('div.show_page_form');
        
	}
   
   },'JSON');

  
 
 
 });
 
/*===========================================      actions            =====================*/

 //admin login.
 $('button.admin.login').click(function(){
 
      event.preventDefault();
	  
	  if(!$(this).hasClass('send_password')){ //normal login
	  
		  var $saved = $(this);
			  $saved.text('Loading..');
			  
		  var obj = {"email" :$('input[name=login_email]').val(),
					 "pass"  :$('input[name=login_password]').val(),
					 "action":"login_admin",
					 "token" :token};
		  
	 
		  $.get('/requests/',obj,function(response){
	  
			setTimeout(function(){
			 
			 $saved.text('Login');
			
			},4000);
				
			if(response.status == 'incorrect')
			 $saved.text('Try again !');
			else
			{
			 $saved.text('Redirecting...');
			 window.location = window.location.href;
			}
			token = response.token;
			

		  },'JSON');
		  
	  
	  } 
	  else //send password 
	  {
	  
	   var $saved = $(this);
	   
	   $saved.text('Loading..');
	   
	   var obj = {'email' :$('input[name=login_email]').val(),
	              'token' :token,
				  'action':'forgot_password'};
	  
	   $.get('/requests/',obj,function(response){
	  
			setTimeout(function(){
			 
		      	 login_admin();
			
			},4000);
				
			if(response.status == 'incorrect')
			 $saved.text('Try again later!');
			else
			 $saved.text('Done!');
			
			token = response.token;
			

		  },'JSON');
	  
	  }
	  
      
 });
 
 
 //******* ================================================ pages
 $(document).on('click','button.add_page',function(){
 
  event.preventDefault(); //prevent form send
  
  var $saved = $(this);
  var modules = {'left'  :{},
                 'right' :{},
				 'center':{}};
  
  //add left module
  $('ul.holder_modules.right').find('li').each(function(index){
    
	 modules.right[index] = $(this).attr('data-id');
  });
  
  //add right module
  $('ul.holder_modules.left').find('li').each(function(index){
    
	 modules.left[index] = $(this).attr('data-id');
  });
  
  //center module
  $('ul.holder_modules.center').find('li').each(function(index){
   
    modules.center[index] = $(this).attr('data-id');
  });
  
  
  //check for empty modules
  var sw = 0;
  $.each(modules,function(index,val){
  
   if(typeof val == 'object'){
    
	 $.each(val,function(index,val2){
	 console.log(val2);
	  if(val2.length > 0)
	   sw = 1;
	 });
   
   }
  
  });
  
  if(sw == 0 && !$('ul.holder_modules').is(':hidden')){
   
   $saved.text('Add a module');
   return; //add a module
  
  }


  modules = JSON.stringify(modules);
  
  var obj = {'title'      :$('input[name=title]').val(),
             'keywords'   :$('input[name=keywords]').val(),
			 'description':$('textarea[name=description]').val(),
			 'action'     :'add_page',
			 'index'      :$('select[name=index_page]').val(),
			 'token'      :token,
			 'modules'    :modules,
			 'design'     :$('input[name=designs][type=radio][select=selected]').val()};


  
  if(check_empty(obj))
   {
    $saved.text('Complete all forms');
	return;
   }
  
  


  $saved.text('Loading..');
			 
  $.post('/requests/',obj,function(response){
   
    token = response.token;
	
	if(response.status == 'done'){
	 
	 $saved.text('Done !');
	 
	 $saved.attr('data',response.href);
	
	}
	
  },'JSON');
 
 });
   
  //remove page 
 $(document).on('click','button.remove_page',function(){
  
  event.preventDefault();
  
  var $saved = $(this);
  $saved.text('Loading..');
  
  var obj = {'id'    :$('img.back_button_page').attr('data-id'),
             'token' :token,
			 'action':'delete_page'};
 
  $.post('/requests/',obj,function(response){
   
   if(response.status == 'done'){
    
	$saved.text('Done, refreshing..');
	window.location = window.location.href;
   
   }else{
    $saved.text('Error');
   }
   
   token = response.token;
   
  },'JSON');
 
 });
   
  //save page
  $(document).on('click','button.edit_page',function(){
  
    event.preventDefault();
   
	  var modules = {'left'  :{},
					 'right' :{},
					 'center':{},
					 'fixed' :{}};
	  
	  //add left module
	  $('ul.holder_modules.right').find('li').each(function(index){
		if(!$(this).hasClass('fixed'))
		 modules.right[index] = $(this).attr('data-id');
	    else
		 modules.fixed[$(this).text()] = $(this).attr('data-id');
	  });
	  
	  //add right module
	  $('ul.holder_modules.left').find('li').each(function(index){
		if(!$(this).hasClass('fixed'))
		 modules.left[index] = $(this).attr('data-id');
	    else
		 modules.fixed[$(this).text()] = $(this).attr('data-id');
	  });
	  
	  //center module
	  $('ul.holder_modules.center').find('li').each(function(index){
	   if(!$(this).hasClass('fixed'))
		modules.center[index] = $(this).attr('data-id');
	  else
		 modules.fixed[$(this).text()] = $(this).attr('data-id');
	  });
	  
	  

	  var old_modules = modules;
	  
	  
	  modules = JSON.stringify(modules);
	
	

	 
	 
	
     
     var obj = {'id'         :$('img.back_button_page').attr('data-id'),
	            'title'      :$('input[name=title]').val(),
	            'keywords'   :$('input[name=keywords]').val(),
				'description':$('textarea[name=description').val(),
				'index'      :$('select[name=index_page]').val(),
				'design'     :$('input[name=designs][type=radio][select=selected]').val(),
				'action'     :'save_page',
				'token'      :token,
				'modules'    :modules};
				
			
 	 //modify list
	 
	 //modify title
	 $('ul.select_page').find('li[data-id='+obj.id+']').find('span.title').text(obj.title);
	 
	 //modify index
	 
			
	var $saved = $(this);
    $saved.text('Loading..');	
	
	//check
	if(obj.design == 0)
	 {
	  $saved.text('Select Design');
	  return;
	 }
	

	
				
    $.post('/requests/',obj,function(response){
	
	 if(response.status == 'done'){
	  $saved.text('Done');

	 }
	
 	token = response.token;
	},'JSON');
  
  });
  
  
 
 /*=================modules==================*/
 //send module created

  $(document).on('click','button.add_module',function(){
	  
	  event.preventDefault();
	  
	  var html = $('div.wysiwyg-editor').html();
	  
	  var name = $('input[name=module_name]').val();
	  
	  var index = $('select[name=index_page]').val();
	  
	  var $saved = $(this);
	  
	  if(name != '' && html != ''){
	  
		  var obj = { 'html'   : html,
					  'name'   : name,
					  'token'  : token,
					  'index'  : index,
					  'action' : 'add_module'};
					 
		  
		  $saved.text('Loading..');
		  
		  $.post('/requests/',obj,function(response){
		   
		   token = response.token;   
			  
		   if(response.status == 'done'){
		   
			$saved.text('Done');
		   }
		   else
		   {
			$saved.text('Try again!');
		   }
		  },'JSON');
	  }
	  else
	   $saved.text('Complete all forms.');
	
	});

  //remove module
  $(document).on('click','button.delete_module',function(){
    
	event.preventDefault();
   
    var $saved = $(this);
 
 
    $saved.text('Loading..'); 
	
	var obj = {'action':'delete_module',
	           'token' :token, 
			   'id'    :$('img.back_module.c').attr('data-id'),
			   'file'  :$('img.back_module.c').attr('data-file')};
			   
			   
	$.post('/requests/',obj,function(response){
	 
	 if(response.status == 'done'){
	  
	  token = response.token;
	  $saved.text('Done,refreshing..');
	  window.location = window.location.href;
	 
	 }
	 else
	 {
	  
	  token = response.token;
	  $saved.text('Error');
	 
	 }
	
	},'JSON');
  
  });
  
  //edit module created
  $(document).on('click','button.edit_module',function(){
  
    event.preventDefault();
	
	  var html = $('div.wysiwyg-editor').html();
	 
	  var code = $('textarea#editor1').val();
	  var $button = $('a.wysiwyg-toolbar-icon[title=CODE]');
	  
	   
	  var name = $('input[name=module_name]').val();
	  
	  console.log($button.attr('data-type'));
	 
	  
	  var first = $('input[name=module_name]').attr('first-name');
	  
	  var $saved = $(this);
	  
	  if(name != '' && html != ''){
	  
		  var obj = { 'first'  : first,
					  'html'   : typeof $button.attr('data-type') === 'undefined' || $button.attr('data-type') == 'html' ? html : code ,
					  'name'   : name,
					  'token'  : token,
					  'action' : 'edit_module',
					  'id'     : $('img.back_module.c').attr('data-id')};
					 
		 //console.log(code);
		  
		  $saved.text('Loading..');
		  
		  $.post('/requests/',obj,function(response){
		  
		   
		   token = response.token;   
			  
		   if(response.status == 'done'){
		   
			$saved.text('Done');
			
			//modify ul list
			$('ul.select_module.c li[data-id='+obj.id+']').find('span.text_m').text(obj.name);
			
		   }
		   else
		   {
			$saved.text('Try again!');
		   }
		  },'JSON');
	  }
	  else
	   $saved.text('Complete all forms.');
  
  });
  
/*=== modules preinstalled */

//select module preinstalled
$(document).on('click','img.edit_module_p',function(){
 

  var obj = {action:'select_preinstalled_module',
             token :token,
			 id    :$(this).parent('li').attr('data-id')};
	 
  //add loading
  add_loading_section(1);
 
    
  $.get('/requests/',obj,function(response){
    
	
	remove_loading_section(1);//remove loading
	
	if(response.status == 'done'){
	
	 token = response.token;
	 
	 //hide list
	 $('ul.module_list.p').hide();
	 
	 //show back button
	 $('img.back_module.p').show().attr('data-id',obj.id);
	 
	 $('div.preinstalled_holder').html(response.data).show();
	
	 
	}else{
	 
	 token = response.token;
	
	}
    
  },'JSON');
 
});
	
 

/* ============== users =================*/

//save settings
$(document).on('click','button.save_settings',function(){
 
  event.preventDefault();
  
  var obj = {token : token,
             email : $('input[name=email]').val(),
			 name  : $('input[name=user]').val(),
			 action: 'general_sett_user'};
			 
			 
  var $saved = $(this);
  
  $saved.text('Loading..');
			 
  $.post('/requests/',obj,function(response){
    
	if(response.status == 'done'){
	 
	  $saved.text('Logging out..');
	  
	  window.location = '/admin/'+obj.name+'/'+window.location.href.split('/')[window.location.href.split('/').length-1]; //refresh
	  
	  token = response.token;//add token
	}
	else
	{
	 if(response.status == 'error'){

	  $saved.text('Try again.');
      token = response.token;
	
	 }
	 
	 if(response.status == 'other_email'){
	  
	  $saved.text('Select another email.');
	  token = response.token;
	 }
	 
	 if(response.status == 'other_name'){
	  
	  $saved.text('Select another name.');
	  token = response.token;
	 
	 }
	 
	 
	}
	
	
  },'JSON');
			  
});

//new_password
$(document).on('click','button.save_password',function(){
 
 event.preventDefault();
 
 var obj = {password   : $('input[name=password]').val(),
            re_password: $('input[name=re_password]').val(),
			action     : 'save_password',
			token      : token};
		
 var $saved = $(this);
 		
 if(obj.password != obj.re_password){ //if passwords are not the same
  
   $(this).text('Passwords do not match');
    
  return;
 }
 else{ //if everything is ok
 
 if(obj.password.length < 3) //password is too short
 {
   $saved.text('Too short..');
   return;
 }
  $saved.text('Loading..'); //add loading message
  
  $.post('/requests/',obj,function(response){
   
    if(response.status == 'done'){
	  
	  $saved.text('Done');
	
	}
	else
	{ 
	
	 $saved.text('Try again'); 
	  
	}
   
  },'JSON');
 
 }


});

// manage users 
//delete user
$(document).on('click','span.right.delete',function(){
 
  $(this).addClass('active').text('Confirm?');

});

$(document).on('click','span.right.delete.active',function(){
  
  var $saved = $(this);
  $saved.text('Loading..');
  
  var obj = {'id'    :$(this).attr('data-id'),
             'action':'delete_user',
			 'token' : token};
			 
  $.post('/requests/',obj,function(response){
    
	if(response.status == 'done'){
	 
	 token = response.token;
	 
	 $saved.parent('div').fadeOut('fast');
	
	}
    else
	{
	 $saved.text('Try again');
	}
  },'JSON');
 
});
			 
//edit user			 

$(document).on('click','span.right.edit',function(){
  
  var $saved = $(this);
  
  $('div.edit_user_holder').find('button').text('Edit user').removeClass('add_user').addClass('edit_user').text('Save user');
  
  add_loading_section(0);
  
  
  //show back button
  $('img.back_button_users').show();
  

  
  $saved.text("Loading").addClass('active');
  
  var obj = {'action':'show_edit',
             'id'    :$(this).attr('data-id'),
             'token' :token};
 
  $.get('/requests/',obj,function(response){
  
   if(response.status == 'done'){
   
    //hide old forms
    $('form.users').hide();
    
	$('div.edit_user_holder').show();
    
	$saved.removeClass('active').text('Edit');
	
	var data = JSON.parse(response.data);
	
	 $('input[name=edit_email]').val(data.email);
	 $('input[name=edit_password]').val(data.password);
	 $('button.edit_user').attr('data-id',data.id);
     $('select[name=user_group]').find('option[value='+data.group+']').attr('selected',true);	 
	
	remove_loading_section(0);
	
	token = response.token;
   
   }
   else
    $saved.text('Error');
  },'JSON');  
});

// save edit user
$(document).on('click','button.edit_user',function(){
 
 event.preventDefault();
 
 var obj = {'action':'save_user',
            'id'    :$(this).attr('data-id'),
			'token' :token,
            'email' :$('input[name=edit_email]').val(),
			'pass'  :$('input[name=edit_password]').val(),
			'group' :$('select[name=user_group]').val()};
			
 var $saved = $(this);
 
 $saved.text('Loading..');
 
 $.post('/requests/',obj,function(response){
  
  if(response.status == 'done'){
   
   $saved.text('Done');
   
   token = response.token;
   
   setTimeout(function(){
   
     $('div.edit_user_holder').fadeOut('fast');
    
   },5000);
   
  }
  else
  {
   $saved.text('Error');
  }
 
 },'JSON');
});
  
//add user
$(document).on('click','span.add_user',function(){
 
 $('div.edit_user_holder').fadeIn('fast').find('button').addClass('add_user').removeClass('edit_user').text('Add user');
 
 $('form.users').hide();
 
 //show button
 $('img.back_button_users').show();
 
});


$(document).on('click','button.add_user',function(){
  event.preventDefault();
 
  var obj = {'email'   :$('input[name=edit_email]').val(),
             'password':$('input[name=edit_password]').val(),
			 'action'  :'add_user',
			 'token'   :token};
			 
  var $saved = $(this);
  $saved.text('Loading..');
  
  $.post('/requests/',obj,function(response){
   
   if(response.status == 'done'){
    
	token = response.token
	
	$saved.text('Done');
	
	//add user
	$('form.users').append("<div class='edit_user'><span data-id='"+response.id+"' style='cursor:pointer' class='right delete'>Delete</span><span data-id='"+response.id+"' style='margin-right:10px;cursor:pointer;' class='right edit'>Edit</span><span class='name'>"+obj.email+"</span></div>");
	

   
   }else{
    
	$saved.text('Error');
   
   }
  
  },'JSON');

});


//==================================== manage groups

//delete group confirm
$(document).on('click','span.delete_group',function(){
  
  $(this).addClass('active').text('Confirm?').addClass('delete_group_confirmed').removeClass('delete_group');
 
});

$(document).on('click','span.delete_group_confirmed',function(){
  
  var obj = {'action':'delete_group',
             'token' : token,
			 'id'    : $(this).attr('data-id')};
			 
  var $saved = $(this);
  
  $saved.text('Loading');
  
  $.post('/requests/',obj,function(response){
   
   if(response.status == 'done'){
    
	$saved.parent('div.group_list').fadeOut('fast');
   
   }
   else
   {
    $saved.text('Error');
   }
   
   token = response.token;
  
  },'JSON');
 
});

$(document).on('click','span.edit_group',function(){

$(this).addClass('active');

add_loading_section(1);

$('img.back_button_groups').show(); 	
  

 
 var $saved = $(this);
 
 $saved.text('Loading');
 
 var obj = {'id'    : $(this).attr('data-id'),
            'token' :token,
			'action':'load_group'};

 $.get('/requests/',obj,function(response){
  
  $('div.show_group').show();
 

 
  if(response.status == 'done'){
   
   $saved.text('Edit').removeClass('active');
   
   //append data
   $('input[name=group_name]').val(response.data.name);
   
   //console.log(response);
   //console.log(response.data.settings.modules);
   //parse data
   var settings = response.data.settings != 'undefined' ? JSON.parse(response.data.settings) : {};
   
   //console.log(settings);
   
   $.each(settings.modules,function(key,value){
      if(value == 1)
	   $('input[data-id='+key+']').attr('checked',true);
   
   //change button
   $('div.show_group').find('button').attr('data-id',$saved.attr('data-id')).text('Edit Group').removeClass('add_group').addClass('edit_group');
   
   $('div.group_list').hide();
   
   remove_loading_section(1);
   
   });
  
  }else{
   $saved.text('Error');
  }
  

  
  token = response.token;
   
  console.log(token);
 },'JSON');
});

//save group
$(document).on('click','button.edit_group',function(){
  
  
  event.preventDefault();
 
 var settings = {'modules':{}};
  $('div.module_list').each(function(){
   
   settings['modules'][$(this).find('input').attr('data-id')] =  $(this).find('input').is(':checked') ? 1 : 0;
  });
  
  settings = JSON.stringify(settings);
 
 var obj = {'id'    : $(this).attr('data-id'),
            'sett'  : settings,
			'name'  : $('input[name=group_name]').val(),
			'action': 'save_group',
			'token' :token};
			
 var $saved = $(this);
 
 $saved.text('Loading');
 
 $.post('/requests/',obj,function(response){
   
   if(response.status =='done'){
    
	$saved.text('Done');
	
	
	//add new title
	$('span.edit_group[data-id='+obj.id+']').next('span.title').text(obj.name);
   
   }else{
    $saved.text('Error');
   }
    
   token = response.token;
 },'JSON');

});

//add group show

$(document).on('click','span.add_group',function(){
 
 $('div.show_group').fadeIn('fast');
 $('div.show_group').find('button').removeClass('edit_group').addClass('add_group').text('Add group');
 
 $('div.group_list').hide();
 $('img.back_button_groups').show();
 
 //clear val
 $('input[name=group_name]').val('');
 
 $('div.module_list').each(function(){
  
  if($(this).find('input').is(':checked'))
   $(this).find('input').removeAttr('checked');
 
 });

});

//add group
$(document).on('click','button.add_group',function(){
 
  event.preventDefault();
  
  var $saved = $(this);
  
  $saved.text('Loading');
  
  var settings = {'modules':{}};
  $('div.module_list').each(function(){
   
   settings['modules'][$(this).find('input').attr('data-id')] =  $(this).find('input').is(':checked') ? 1 : 0;
  });
  
  settings = JSON.stringify(settings);
  
  var obj = {'action':'add_group',
             'token' : token,
			 'name'  : $('input[name=group_name]').val(),
			 'sett'  : settings};
			 
  $.post('/requests/',obj,function(response){
   
   if(response.status == 'done'){
    $saved.text('Done');
	
	//append
	var new_el = '<div class="group_list"><span data-id="'+response.insert_id+'" class="delete_group right">Delete </span> <span data-id="'+response.insert_id+'" style="margin-right:10px;" class="edit_group right">Edit</span> <span class="title">'+obj.name+'</span></div>';
	
	$('div.form_list').append(new_el);
	
   }else{
   
    $saved.text('Error');
   }
   
   token = response.token;
  
  },'JSON');

});



//=================================== Design

//add desgins button
$(document).on('click','img.add_design_img',function(){
 
 $('img.created_design').show();
 $('ul.select_design').hide();
 $('div.show_edit_design').show();
 
 //show htmleditor
 $('select[name=design_type],div.CodeMirror').show();
 
 $('button.save_design').removeClass('save_design').addClass('add_design').text('Create Design');
 
 $('div.show_edit_design').find('p').show();
 
 //clear content
 editor.setValue('');
 $('input[name=design_name]').val('');
 
 
 $('button.delete_design').hide();
 
 
 $(this).hide();

});

$(document).on('click','button.add_design',function(){
 
 event.preventDefault();
  
 var $saved = $(this);
 
 
 $(this).text('Loading..');
 
 var obj = {'action':'add_design',
            'token' : token,
			'code'  : serialized_designs == '' ? editor.getValue() : serialized_designs,
			't'     : serialized_designs == '' ? 0 : 1,
			'type'  : $('select[name=design_type]').val(),
			'name'  : $('input[name=design_name]').val()};
 
 $.post('/requests/',obj,function(response){
  
  if(response.status == 'done'){
   
   $saved.text('Done');   
   
   //add to list
   $('ul.select_design').append(" <li data-id='"+response.id+"'><img alt='Edit Design' title='Edit Design' src='/../resources/images/edit.png' class='right button edit_created_design' style='display:block;margin-right:0px;padding:2px;' />"+obj.name+"</li>");   
 
  }
  else
   $saved.text('Error');
   
  token = response.token;
 
 },'JSON');
			

});


$(document).on('click','button.delete_design',function(){

 event.preventDefault();
 
 
 var obj = {'token' :token,
            'action':'delete_design',
			'id'    :$('img.created_design').attr('data-id')};
	
 var $saved = $(this);
 
 $saved.text('Loading..'); 
			
 $.post('/requests',obj,function(response){
  
  if(response.status == 'done'){
  
   $saved.text('Done !');
  
   $('ul.select_design').find('li[data-id='+obj.id+']').remove();
  
   setTimeout(function(){
   
    $('img.created_design').trigger('click'); //go back
  
   },2000);
  
  }else{
   
   $saved.text('Error');
  
  }
  
  token = response.token;
 },'JSON');

});


//select design
$(document).on('click','img.edit_created_design',function(){

 var $saved = $(this);
 if($saved.parent('li').attr('data-t') == '1'){ //open website builder using params
 
   add_loading_section(0);
   
   var obj = {action   : 'load_design_pagebuilder',
              token    : token,
			  id       : $saved.parent('li').attr('data-id')};
	
   $.get('/requests',obj,function(response){
    
	if(response.status == 'done'){
	
	 widgets_2 = JSON.parse(response.modules);
	 designs   = JSON.parse(response.design);
	// design_options = designs;
	 $('a.pagebuilder').trigger('click');
	 
	 $('div.controll').find('div.close').attr('data-action',obj.id);
	 
	 
	 //load new data
	 $('button.load_grid').trigger('click');
	}
	
	token = response.token;
	remove_loading_section(0);
   
   },'JSON');
  
 
 }
 else{ //html page
	 $('div.show_edit_design').show();
	 
	 add_loading_section(0);
	 
	 var obj = {'action':'select_design',
				'id'    : $(this).parent('li').attr('data-id'),
				'token' : token};
				
	 $('img.created_design').attr('data-id',obj.id);
				
	 $.get('/requests/',obj,function(response){
	   
	   if(response.status == 'done'){
		
		//hide list
		$('ul.select_design').hide();
	   
		//show back button
		$('img.created_design').show();
	   
		//append data
		$('input[name=design_name]').val(response.name).attr('data-name',response.name);
		
		$('select[name=design_type]').find('option[value='+response.type+']').attr('selected',true);
		
		editor.setValue(response.code);
		
		$('div.show_edit_design').find('p').hide();
	   
	   }
	   
	   remove_loading_section(0);
	  
	  
	  token = response.token;
	  
	 },'JSON');

 }
});
//save design

$(document).on('click','button.save_design',function(){
 
 event.preventDefault();
 
 var $saved = $(this);
 
 $saved.text('Loading..');
 
 var obj = {'title' :$('input[name=design_name]').val(),
            'type'  :$('select[name=design_type]').val(),
			'code'  :editor.getValue(),
			'o_name':$('input[name=design_name]').attr('data-name'),
			'id'    :$('img.created_design').attr('data-id'),
			'action':'save_design',
			'token' : token};
			
 $.post('/requests/',obj,function(response){
  
  if(response.status == 'done'){
   
   $saved.text('Done');
   
   //add new name
   $('input[name=design_name]').attr('data-name',obj.title); //add new old name
  
  }
  else{
   $saved.text('Error');
  
  }
 
  token = response.token;
 
 },'JSON');

});

//change design style
$(document).on('click','input[name=designs]',function(){
 
 $('input[name=designs][select=selected]').removeAttr('select');
 
 $(this).attr('select','selected');
 


 var id       = $(this).val()
 var type     = $(this).attr('design-value');
 
 
 var $saved = $(this);
     add_loading_section(0);
 $.get('/engine/data/designs_type/'+type+'.html',function(response){
  
  //remove selected modules and pur then to list
  $('div.modules_holder').find('ul').each(function(){
   
   $(this).find('li').each(function(){
     
	 $('ul.module_list').append('<li class="default ui-sortable-handle" data-id="'+$(this).attr('data-id')+'">'+$(this).text()+'</li>');
	 $(this).remove();
	
   });
   
   if($saved.attr('created') == '0'){
   

	
	$.get('/requests',{token:token,id:$saved.val(),action:'load_design_options',name:$saved.parent('li').text()},function(response){
	 
	 if(response.status == 'done'){

	   var options = JSON.parse(response.data);
	   if(typeof options.enable_module != 'undefined' && options.enable_module == '1')
	    //$('ul.holder_modules').sortable( "disable" )
	   
	   if(typeof options.fixed_module != 'undefined'){
	    var id = $("ul.module_list li:contains('"+options.fixed_module+"')").attr('data-id');
		$("ul.module_list li:contains('"+options.fixed_module+"')").remove();
		
		$('ul.holder_modules').prepend('<li class="fixed" data-id="'+id+'">'+options.fixed_module+'</li>');
		
		//sortable
			$( "ul.holder_modules" ).sortable({
			  connectWith: "ul.module_list",
			  cancel: 'li.fixed'
			},"appendTo" ).disableSelection();
		
	   }
	 }
	 
	 token = response.token;
	 
	 remove_loading_section(0);
	 

	
	},'JSON');
	
   }
  
  });
  
  $('div.modules_holder').html(response);
  remove_loading_section(0);
 	  //hide modules if t == 1
	 
	 if($saved.attr('data-t') == '1')
	   $('div.modules_holder').hide();
	 else
	   $('div.modules_holder').show();
	  
 });
 
 
});



// =================== templates

//install design
$(document).on('click','span.install',function(){
 
  var obj = {action:'install_template',
             name  : $(this).attr('data'),
			 token : token};
	
  var $saved = $(this);	
  
  $saved.text('Installing..');
 
  $.post('/requests/',obj,function(response){
   
   if(response.status == 'done'){
     
	 $saved.text('Installed');
	 
	 //$('select[name=installed_designs]').append('<option value="'+response.insert_id+'">'+obj.name+'</option>');
	 
   }
   else{
     
	 $saved.text('Error');
	
   }
   
   token = response.token;
  
  },'JSON');

});

//uninstall design
$(document).on('click','span.uninstall',function(){
 
 var obj = {'token' :token,
            'name'  :$(this).attr('data'),
			'action':'uninstall_template'};
			
			
 var $saved = $(this);
			
 $.post('/requests/',obj,function(response){
  
   if(response.status == 'done'){
    
	$saved.text('Uninstalled'); //remove
	
	$('select[name=installed_designs]').find('option').each(function(){
	  
	  if($(this).val().split('-')[1] == obj.name)
	   $(this).remove();
	 
	});
   
   }else{
    
	$saved.text('Error');
   
   }
  
  token = response.token;
 },'JSON');

});


//add admin to installed designs
$(document).on('click','img.edit_installed_design',function(){

  add_loading_section(1);
  
  var name = $(this).parent('li').attr('data').split('-')[1];
  var id   = $(this).parent('li').attr('data').split('-')[0];
  
  var obj = {'name'  :name,
             'id'    :id,
			 'action':'load_template_admin',
			 'token' :token};
  
  $.get('/requests/',obj,function(response){
  
   $('ul.installed_designs').hide();
   
   //show back button
   $('img.installed_designs').show().attr('data-id',id);

   remove_loading_section(1);
  
   $('div.template_admin_holder').show().html(response.html);
  
   token = response.token;
  },'JSON');

});

//save template
$(document).on('click','button.save_template',function(){
 
  event.preventDefault();
 
  var id = $('img.installed_designs').attr('data-id');
  
  var data = {};
  
  //collect all data
  $('div.template_admin_holder form').find('input,textarea,select').each(function(){
   
    data[$(this).attr('name')] = $(this).val();
  
  });
  
  var obj = {'action':'save_template',
             'token' : token,
			 'id'    : id,
			 'data'  : JSON.stringify(data)};
  
  var $saved = $(this);
  $saved.text('Loading..');
			 
  $.post('/requests/',obj,function(response){
   
   if(response.status == 'done'){
    
	$saved.text('Done');
    
   }else{
    
	$saved.text('Error');
   
   }
   
   token = response.token;
  
  },'JSON');
});

$('form.search').submit(function(){
  event.preventDefault(); //stop form from sending
});

//search template

$(document).on('keyup','input.search',function(e){


 
 var key = e.keyCode || e.which;
 
 if(key == 13){
  

  
  var val = $(this).val();
  
  var obj = {action:'search_template',
             token : token,
			 key   : val};
			 
  add_loading_section(2);
 
  $.get('/requests',obj,function(response){
   
   if(response.status == 'done'){
   
    if(response.templates.length > 0){
	
	$holder =  $('div.designs_holder');
	
	$holder.html(''); //clear holder
	
    $.each(response.templates,function(key,template){
	
	 template.preview = template.preview.replace(/\\(.)/mg, "$1");
	 template.image = template.image.replace(/\\(.)/mg, "$1");
	
	 var installed = template.installed == 1 ? "<span class='uninstall'  data='"+template.name+"'>Uninstall</span>" :"<span class='install'  data='"+template.name+"'>Install</span>";
	 
	 
	 $holder.append("<div class='template'><span class='template_name'>"+template.name+"</span><img src='"+template.image+"'>"+installed+"<a target='_blank' href='"+template.preview+"'><span class='preview'>Preview</span></a></div>");
				
  
	});
	}else{
	  $holder.html("<p> No results. </p>");
	 
	}
   
   }

   
   remove_loading_section(2);
   
   token = response.token;
  
  },'JSON');
  
 
 
 }

});


//====================== file manager==================//

$(document).on('change','input#upload',function(){
 
 $('form.upload').submit();
 
 add_loading_section(0);

});

//delete file
$(document).on('click','img.delete_file',function(){
  
  var name = $(this).parent('li').attr('data-name');
  
  $(this).parent('li').fadeOut('fast');
  
  var obj = {'action':'delete_file',
             'token' : token,
			 'file'  : name};
			 
  $.post('/requests',obj,function(response){
   
   token = response.token;
  
  },'JSON');
 
});

/*=================================== gneneral settings ============================== */

$(document).on('click','img.main_module',function(){

 if($('ul.modules_list_general').is(':hidden'))
  $('ul.modules_list_general').show();
 else
  $('ul.modules_list_general').hide();
  
});

//add module
$(document).on('click','ul.modules_list_general li',function(){
  
  var id = $(this).attr('data-id');
  
  if(!$(this).find('img').hasClass('selected')){
  
	  //add id to image
	  $('img.main_module').attr('data-id',id);
	  
	  //remove old selected
	  $('img.main_module.selected').removeClass('selected');
	  //add new one
	  $(this).find('img').addClass('selected');
	  
	  $(this).parent('ul').hide();
	  
	  
	  add_loading_section(1);
	  
	  var obj = {'action':'select_preinstalled_module',
				 'token' : token,
				 'id'    : id,
				 'update': 1};
				 
	  $.get('/requests',obj,function(response){
	   
	   if(response.status == 'done'){
		
		$('div.principal_module_holder').html(response.data);
		
		remove_loading_section(1);
		
	   
	   }
	   
	   token = response.token;
	  
	  },'JSON');
   }	 
});



//=================================== general
$(document).on('change','input[name=favicon]',function(){

  add_loading_section(0);
  
  $('form.favicon').submit();
 
});

$(document).on('click','button.send_general_sett',function(){

 event.preventDefault;

 var $saved = $(this);
 
// var obj = {'status':
 
});


//save general settings

$(document).on('click','button.send_general_sett',function(){
 
  event.preventDefault();
  
  var $saved = $(this);
  
  $saved.text('Loading..');
  
  var obj = {'status'  :$('input[name=website_status]:checked').val(),
             'analytic':$('input[name=analytic]').val(),
			 'meta_tag':$('input[name=meta_tag]').val(),
			 'action'  :'update_general_settings',
			 'domain'  : $('input[name=domain]').val() == $('input[name=domain]').attr('old-data') ? false : $('input[name=domain]').val(),
			 'token'   :token};
			 
  $.post('/requests',obj,function(response){
   
   if(response.status == 'done'){
    
	$saved.text('Done');
	
   }else{
    
	$saved.text('Error');
   
   }
   
   token = response.token
   
  },'JSON');
 
 
});

// ================================== logout
$(document).on('click','a.logout',function(){
  
  event.preventDefault();
  
  var obj = {'action':'logout',
             'token' :token};
			 
  var $saved = $(this);
  
  $saved.text('Loading');
  
  $.post('/requests/',obj,function(response){
   
   if(response.status == 'done'){
    
	token = response.token;
    
	$saved.text('Redirecting');
	
	window.location = window.location.href;
	
   }
  },'JSON');

});

});


//done upload
function upload_file(action,file,token){

  //add token
  token = token;
  
  var ext  = file.split('.')[file.split('.').length-1];
  var name = file.replace(ext,'');
  var id = $('form.upload').attr('data-id');

 
  switch(action){
   
   case 1: 
    
	remove_loading_section(0);
	$('ul.files_list').append("<li data-name='"+file+"'><img src='/../resources/images/delete.png' class='right tooltip delete_file' style='height:16px;padding:4px;margin-top:4px' title='Delete this file' /><img src='/../resources/images/clipboard.png' style='height:16px;padding:4px;margin-top:4px;margin-right:10px;' class='right tooltip' title='/getfile/"+id+"/"+name+ext+"' /><img src='/../resources/images/extensions/"+ext+".PNG' class='extension' /> "+name+ext+"</li>");
	
   break;
   
   default:
    remove_loading_section(0);
	
 
  
   
  
  
  }
 
}
//done upload favicon
function upload_favicon(action,file,token){

  //add token
  token = token;
  
  var ext  = file.split('.')[file.split('.').length-1];
  var name = file.replace(ext,'');
  var id = $('form.favicon').attr('data-id');

 
  switch(action){
   
   case 1: 
    
	remove_loading_section(0);
    $('img.favicon').attr('src','/../engine/data/favicons/'+id+'/favicon.ico?'+new Date().getTime());
   break;
   
   default:
    remove_loading_section(0);
   
  
  
  }
 
}
