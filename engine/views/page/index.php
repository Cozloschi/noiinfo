<!DOCTYPE html>
<html>
<head>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/engine/views/admin/header-part.php'); ?>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<head>
<body>
	<section style='margin-top:10px'>
	 
	
		
		
		<?php foreach($data['modules'] as $key=>$value): ?>
			<div class="news" style='width:100%'>
				<?php if($value['type'] == 0): ?>
				  <h4><?=$value['title']?></h4>
				<?php endif; ?>
				<?=$value['content']?>
			</div>
	    <?php endforeach; ?>
		
	
	</section>
		
<footer>
&copy; Cozy 2015.
</footer>
</body>
</html>