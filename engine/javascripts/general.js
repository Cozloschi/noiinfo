//token


$(document).ready(function(){
	 
	  /* design jquery */
	  
	   var not_first_time = 0;
	   var last_class = '';
	   
	   
	   setInterval(function(){
	    last_class = '';
		not_first_time = 0;
	   },500);
	   
	   
	   //substr chars
	   if($(window).width() < 970){
	    $('div.right_menu_content').text($('div.right_menu_content').text().substr(0,200)+'..');
		
	   }
	  
	  
	   $(document).on('mouseover','nav ul li',function(){
	    
		
	    if($(this).attr('class')){
			var classe = $(this).attr('class').split(' ')[0];
			
			if(last_class != classe && $(window).width() > 970)
			{
				last_class = classe;
				
				console.log(classe);
				
				$('div.menu_content.show').removeClass('show');
				
				
				//first time or not
				var time = not_first_time == 1 ? 300 : 0;
				
				var $saved = $(this);
				//give time to animation
				setTimeout(function(){
					if($saved.hasClass(classe))
					 $('div.menu_content.'+classe).addClass('show');
					else
					 $('div.menu_content.'+classe).removeClass('show');
				   
				},time);
			   
			   not_first_time = 1;
			}
		 }
	   });
	   
	   $(document).on('mouseleave','div.center_div',function(){
	   
	    $('div.menu_content').removeClass('show');
	   });
	   
	   $(document).on('click','div.responsive',function(){
	    
		 if(!$('nav ul').hasClass('show'))
		  $('nav ul').addClass('show');
		 else 
		  $('nav ul').removeClass('show');
	    
	   });
	   
	   
	   //responsive
	   $(document).on('click','nav ul li a',function(e){
	    
		 if($(window).width() < 970){
		  
		  e.preventDefault();
		  
		  var classe = $(this).parent('li').attr('class').split(' ')[0];
		  
		  console.log(classe);
		  
		  $('ul.show').removeClass('show');
		  
		  $('div.menu_content.'+classe).addClass('show');
		  
		 
		 }
		 
	   });
	   
	   
	   
	 
	 });