
	<link rel="stylesheet" type="text/css" href="/../resources/style/style.css">
	<title>PoolPersonal</title>
	<meta charset="UTF-8">
	<meta name='viewport' content='width=400 user-scalable=none' />
	<script type='text/javascript' src='/../engine/javascripts/jquery.js'> </script>
	<script type='text/javascript'>  token = '<?=$data['token']?>'; </script>
	<script type='text/javascript' src='/../engine/javascripts/general.js'> </script>
	<script type='text/javascript' src='/../engine/javascripts/admin.js'> </script>
	
	<!-- tooltip -->
	
	<link rel="stylesheet" type="text/css" href="/../engine/external_scripts/tooltip/css/tooltipster.css" />
    <script type="text/javascript" src="/../engine/external_scripts/tooltip/js/jquery.tooltipster.min.js"></script>

    <!-- Activate tooltip -->
	
	<script>
        $(document).ready(function() {
            $('.tooltip').tooltipster();
			$('.tooltip-interactive').tooltipster({interactive:true});
        });
    </script>