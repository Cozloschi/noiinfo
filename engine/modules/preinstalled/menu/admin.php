<?php
function sortArrayByArray(Array $array, Array $orderArray) {
    $ordered = array();
    foreach($orderArray as $key=>$value) {
        if(array_key_exists($value['id'],$array)) {
		    //if page still exists
			
			if(isset($array[$value['id']])){
				
				$checked       = $value['visible'];
				$ordered[$key] = $array[$value['id']];
				$ordered[$key]['visible'] = $checked;
				unset($array[$value['id']]);
			
            }
		
        }
    }
    return $ordered + $array;
}

 $data = mysql_fetch_assoc($engine->query("Select * from menu_modul where user_id = '{$login_data['id']}'",true));
 
 
 //id list
 //$id_list    = '';
 $data_modul = unserialize($data['data']);
 
 
 
 $load_pages   = $engine->query("Select title,id from pages where user_id = '{$login_data['id']}'",true);
   
 while($row    = mysql_fetch_assoc($load_pages))
 {
  $array_pages[$row['id']] = $row; 
  
  $array_pages[$row['id']]['visible'] = 0;
 } 
  
 

  
 $array_pages = sortArrayByArray($array_pages,$data_modul);
 
 
 

 //$array_pages =  array_unique($array_pages);
 

?>



<script type='text/javascript'>
 $(document).ready(function(){
  $('ul.menu_sortable').sortable();
  
//==================================== menu 



$(document).on('click','button.save_menu',function(){
 
  event.preventDefault();
  //console.log('asdada');
  
  var obj = {};
  
  $('ul.menu_sortable').find('li').each(function(e){
  
   obj[e] = {'id'     :$(this).attr('data-id'),
             'title'  :$(this).find('span.text_menu').text(),
			 'visible':$(this).find('input[name=visible]').is(':checked') ? 'checked' : ''};
	
	
  
  });
  
  var id = $('img.back_module.p').length > 0 ? $('img.back_module.p').attr('data-id') : $('img.main_module').attr('data-id');
  
  var req_obj = {'token' :token,
                 'data'  :JSON.stringify(obj),
				 'action':'save_menu',
				 'id'    :id};
  
  var $saved = $(this);
  
  $saved.text('Loading..');
  
  $.post('/../engine/modules/preinstalled/handler.php',req_obj,function(response){
    
	if(response.status == 'done'){

	 
	 $saved.text('Done');
	 
	 token = response.token;
	 
	}else
	{
	 $saved.text('Try again');
	}
    
  },'JSON');

});
  
  
 });
</script>

<form>
<ul class='menu_sortable'>
  <?php foreach($array_pages as $key=>$value): ?>
				    
	<li data-id="<?=$value['id']?>"><span class='right'> Visible <input type='checkbox' name='visible' <?=$value['visible']?> /> </span><span class='text_menu'><?=$value['title']?></span></li>
				   
  <?php endforeach; ?>
</ul> 			 

<button class='save_menu'>Save menu</button>
</form>