$(document).ready(function(){
 //load tv.php
 var reports ;
 if(localStorage['reports'])
  reports = localStorage['reports'];
 else 
  reports = '';

 //DOCUMENT COOKIES
if(document.cookie.search('login_user')> -1){
	
	$.get('/engine/views/page/login_menu.php',function(response){
		$('div.right_side').prepend(response);
	});
}else{
	
	$.get('/engine/views/page/login.php',function(response){
		$('div.right_side').prepend(response);
	});
	
	$('button.favorite').remove();
}
  
if(window.location.href.split('/')[3].length > 0){ 
 $.get('/engine/external_scripts/tv.php',function(response){
	 $('div.program_holder').html(response); 
 });
}
 //click right side
 
 $(document).on('click','.program_holder a',function(){
	 
		event.preventDefault();
		
		var hr= $(this).attr('href');
	
		
		var href = hr.split('?').length  > 0 ? hr.split('?')[1] : '';
		
		//console.log(href);
		
		 $.get('/engine/external_scripts/tv.php?'+href,function(response){
			$('div.program_holder').html(response); 
		});
	 
 });

 
 $(document).on('click','span.source a',function(){
	 
	 event.preventDefault();
		
	 
	 	//load and insert data source
	var seo = $(this).attr('data-load');
	
	$.get('/engine/data/html/'+seo+'.html',function(response){
		 
		 $('div.code_holder').html(response);
		 
		 check_ie();
		 
	});
	 
	 
	 
 });
 
 //show_list
 $(document).on('click','span.category',function(){
      
 	  $s =  $(this).parent('li').find('div.sources');
	  
	  if($s.is(':hidden'))
        $s.show();
	  else{
		 //check for other
		 $('div.sources').each(function(){
			 if(!$(this).is(':hidden')) 
				  $(this).hide();
		 });
		 
		 $s.hide();
	  }
 });
 
 // user settings
 // login
 $(document).on('click','button.login_user',function(){
	  
	 event.preventDefault();
	 
	 var obj = {email: $('input[name=email]').val(),
	                 pass  : $('input[name=password]').val(),
					 action: 'login_user',
					 token : ''};
	 var $saved = $(this);
	 $saved.text('Loading..');
	 
	 if(obj.email.length > 2 && obj.pass.length > 2)
	 {															
  
	   $.post('/requests',obj,function(response){
	   	  
		  if(response.status == 'done'){
			  
			  $saved.text('Redirecting..');
			  
			  window.location = window.location.href;
			  
		  }else{
			  
			  $saved.text('Try again');
			  
		  }
		 
	   },'JSON');
	 }
	 else{
		 $saved.text('Complete all forms.');
		 
	 }
 }); 
 
 // register
 $(document).on('click','button.register_user',function(){
	  
	 event.preventDefault();
	 
	 var obj = {email: $('input[name=email]').val(),
	                 pass  : $('input[name=password]').val(),
					 action: 'register_user',
					 'token' : ''};
	 var $saved = $(this);

    	 $saved.text('Loading..');
	 
	 if(obj.email.length > 2 && obj.pass.length > 2)
	 {
	   $.post('/requests',obj,function(response){
		  
		  if(response.status == 'done'){
			  
			  $saved.text('Redirecting..');
			  
			  window.location = window.location.href;
			  
		  }else{
			  
			  $saved.text('Try again');
			  
		  }
		 
	   },'JSON');
	 }
	 else{
		 $saved.text('Complete all forms.');
		 
	 }
 });
 
 
 $(document).on('click','button[name=change_email]',function(){
	 
	   event.preventDefault();
		var obj  = {token : token, action : 'change_email',email  : $('input[name=email]').val()};
	  
	    var $saved = $(this);
		$saved.text('Loading..');
	
		$.post('/requests',obj,function(response){
			
			if(response.status == 'done'){
				$saved.text('Done');
			}
	        else{
				
				if(response.status == 'error')
				 $saved.text('Error');
			   else
				 $saved.text('Select another email');
			}	

			token = response.token;
		},'JSON');
	
	
 });

 
 $(document).on('click','button[name=change_password]',function(){
	event.preventDefault();
			var obj = {'token':token,
			                action : 'change_password_user',
							new_password : $('input[name=password_new]').val(),
							old_password  : $('input[name=password_old]').val() };
			
			var $saved = $(this);
			
			$saved.text('Loading..');
			
			$.post('/requests',obj,function(response){
				
				if(response.status == 'done'){
					$saved.text('Done');
				}else{
					$saved.text('Error');
				}
				
				
				token = response.token;
			},'JSON');
		
 });
 
 function buttons_data(){
 //add buttons data 
  var seo_name = window.location.href.length[window.location.href.split('/').length -1];
 
  $('button.favorite,button.report').attr('data-class',seo_name);
 }
 
 function check_ie(){
	 if(typeof ie !== 'undefined' && !ie){
		 
		 var html = $('div.code_holder').html();
		 
	     var link  = $(html).find('param[name=SopAddress]').attr('value');
		 var name = $(html).find('param[name=ChannelName]').attr('value');
		 
		 $('div.code_holder').html('<a href="'+link+'">Open '+name+' in sopcast<a>');
		 
	 }
 }
 
 check_ie();
 
 
 $(document).on('click','button.favorite',function(){
	 
	 var $saved = $(this);
	 
	 $saved.text('Loading..');
	 
	 var name = $(this).attr('data-class') || window.location.href.split('/')[window.location.href.split('/').length -1];
	 
	 var obj = {action : 'favorite',
	                 token  : '',
					 name  : name };
	 
	 //console.log(obj);
	 $.post('/requests',obj,function(response){
		 
		 if(response.status == 'done'){
			 $saved.text('Done');
		 }else{
			 if(response.status == 'exists')
				  $saved.text('Already exists, remove?').removeClass('favorite').addClass('remove_favorite');
			  else 
				  $saved.text('Error');	
		 }
		 
	 },'JSON');
	 
 });
 $(document).on('click','button.remove_favorite',function(){
	 var name = $(this).attr('data-class') || window.location.href.split('/')[window.location.href.split('/').length -1];
	 
     var obj = {token : '',
	                  action:'remove_favorite',
					  name : name};
     var $saved = $(this);
	 
	 $saved.text('Loading..');
     $.post('/requests',obj,function(response){
		 
		  if(response.status == 'done'){
			  $saved.text('Done');
		  }else{
			  $saved.text('Error');
		  }
		 
	 },'JSON');	
    	
	 
 });
 
 //logout
 $(document).on('click','a.logout',function(){
	
    event.preventDefault();

	var obj = {token: '',
	                action: 'logout_user'};
					
	$(this).text('Loading..');				
	$.post('/requests',obj,function(response){
		window.location = window.location.href;
	});
	 
 });
 
 //change category
 $(document).on('change','select[name=select_category]',function(){
                                               
		var obj = {'action': 'load_grid',
		                 category:$(this).val(),
						 'token' : ''};
		                                                       
		$.get('/requests',obj,function(response){
			                                                                                
			$('ul.index').find('li').each(function(){                        
				$(this).remove();                                                
			});	                                             
                                                               
			                                                 
			var data = response.data;
			$.each(data,function(index,val){
			  var $html = '<li data-category="'+val.category+'"><a href="/ch/'+val.seo_name+'">'+val.title+'<img src="'+val.name+'" class="img_channel"></a></li>';
		                                  
		      $('ul.index').prepend($html);
			});	                                                           
		});                                                            
	                                                        
	                                                     
 });
	 
	 /*
   if($(this).val() == 'all'){
	   $('ul.index li').each(function(){
		  $(this).show(); 
	   });
   }else{
	   //show all
	   $('ul.index li').each(function(){
		  $(this).show(); 
	   });
	   $('ul.index li[data-category='+$(this).val()+']').each(function(){
		   $(this).hide();
	   }); 
	  */  
   
	
 
 
 //report 
 $(document).on('click','button.report',function(){
	 
    var name = $(this).attr('data-class') || window.location.href.split('/')[window.location.href.split('/').length -1];
   
    if(reports.search(','+name) > -1 && reports != ''){
		$(this).text('Already Reported');
	}else{
		
		var $saved = $(this);
		
		$saved.text("Loading");
		
		var obj = {action:'report',
		                 token:'',
						 name:name};
		
		$.post('/requests',obj,function(response){
			
			if(response.status =='done'){
				
				$saved.text('Done');
				
				localStorage['reports'] += ','+name;
				reports = localStorage['reports'];
			}else{
				$saved.text('Error');
			}
			
			
		},'JSON');
		
	}
 });
 
 
 
 
 
});

