<?
$headpath = $_SERVER['DOCUMENT_ROOT'].'/';
$htmlpath = 'http://'.$_SERVER['HTTP_HOST'].'/';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Cheapest airline tickets</title>

		
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,700" rel="stylesheet" type="text/css">
		<link href="<? echo $htmlpath; ?>fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="<? echo $htmlpath; ?>css/animate.min.css">
		<link rel="stylesheet" href="<? echo $htmlpath; ?>style.css">
		<link rel="stylesheet" href="<? echo $htmlpath; ?>avia.css">
		
		<!--[if lt IE 9]>
		<script src="<? echo $htmlpath; ?>js/ie-support/html5.js"></script>
		<script src="<? echo $htmlpath; ?>js/ie-support/respond.js"></script>
		<![endif]-->
		<link rel="shortcut icon" type="image/x-icon"  href="<? echo $htmlpath; ?>images/favicon.ico">

	</head>

	<body>
		
		<div id="site-content">
			
			<header class="site-header wow fadeInDown">
				<div class="container">
					<div class="header-content">
						<div class="branding">
							<a href="<? echo $htmlpath; ?>"><img src="<? echo $htmlpath; ?>images/logo.png" alt="Airline Tickets Worldwide" class="logo"></a>
							<h1 class="site-title">Airline Tickets Worldwide</h1>
							
						</div>
						
						<nav class="main-navigation">
							<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
							<ul class="menu">
								<li class="menu-item"><a href="<? echo $htmlpath; ?>flights/">Flights</a></li>
								<li class="menu-item"><a href="<? echo $htmlpath; ?>contact/">Contact</a></li>
							</ul>
						</nav>
						
						<div class="social-links">
							<div class="addthis_sharing_toolbox"></div>
						</div>
					</div>
					<nav class="breadcrumbs">
						<a href="<? echo $htmlpath; ?>"><span>Home</span></a> <i class="fa fa-arrow-circle-o-right"></i>
						<span>Flights</span>
					</nav>
				</div>
			</header> <!-- .site-header -->

			<main class="content">
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="col-md-12 wow fadeInLeft block-find-avia">
								<h2 class="block-title-avia">Cheap Plane Tickets</h2>
								<span class="visible-xs-block">
									<script charset="utf-8" src="//www.travelpayouts.com/widgets/af4f8c78f7fe463f34ff269961417ec4.js?v=417" async></script>
								</span>
								<span class="hidden-xs">
									<script charset="utf-8" src="//www.travelpayouts.com/widgets/30a4c16f629c7eb84b59f3afa6a2ebc1.js?v=417" async></script>
								</span>
								
							</div>
							
						</div>
					</div>

				</div>

				

			</main> <!-- .content -->

			<footer class="site-footer wow fadeInUp">
				
				<div class="footer-bottom">
					<div class="container">
						<div class="branding pull-left">
							<img src="<? echo $htmlpath; ?>images/logo-footer.png" alt="Airline Tickets Worldwide" class="logo">
							<h1 class="site-title"><a href="<? echo $htmlpath; ?>">Airline Tickets Worldwide</a></h1>
							
						</div>
						<div class="footer-menu pull-right">
							<p><a href="<? echo $htmlpath; ?>terms/">Terms of Use</a> <a href="<? echo $htmlpath; ?>privacy/">Privacy &amp; Cookies</a></p>
							<p>Copyright 2015. All right reserved</p>
							<p class="block-counter-avia"><!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.5;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script><!--/LiveInternet--></p>
						</div>
						
					</div>
				</div>
				
			</footer> <!-- .site-footer -->


		</div> <!-- #site-content -->
		<script src="<? echo $htmlpath; ?>js/jquery-1.11.1.min.js"></script>
		<script src="<? echo $htmlpath; ?>js/min/plugins-min.js"></script>
		<script src="<? echo $htmlpath; ?>js/min/app-min.js"></script>
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553372fc132ff7bd" async="async"></script>

	</body>

</html>