<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$data['seo']['description']?>">
    <meta name="keywords" content="<?=$data['seo']['keywords']?>">
    <meta name="author" content="">
	<link rel="icon" type="image/x-icon"  href="/../engine/data/favicons/<?=$data['user_id']?>/favicon.ico">


    <title><?=$data['seo']['title']?></title>

    <!-- Bootstrap Core CSS -->
    <link href="/engine/templates/grayscale/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/engine/templates/grayscale/css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/engine/templates/grayscale/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <?php  echo $data['modules']['fixed']['Menu']['content']; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading"><?=$data['data']['title']?></h1>
                        <p class="intro-text"><?=$data['data']['mini_desc']?></p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- modules -->
	<section id="about" class="container content-section ">
	<?php foreach($data['modules']['center'] as $key=>$value): ?>
	
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2><?=$value['title']?></h2>
                
			     <div id='text'><?=$value['content']?></div>	
			</div>
        </div>

	<?php endforeach; ?>
    </section>





    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p><?=$data['data']['copyright']?></p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="/engine/templates/grayscale/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/engine/templates/grayscale/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/engine/templates/grayscale/js/jquery.easing.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="/engine/templates/grayscale/js/grayscale.js"></script>
<?php if(!empty($data['analytic'])): ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?=$data['analytic']?>', 'auto');
  ga('send', 'pageview');

</script>
<?php endif;?>
</body>

</html>
