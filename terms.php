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
		
		<title>Terms of Use</title>

		
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
						<span>Terms of Use</span>
					</nav>
				</div>
			</header> <!-- .site-header -->

			<main class="content">
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="col-md-12 wow fadeInLeft">
								<h2 class="block-title-avia">Terms of Use</h2>
								<h4>What AirlineTicketsWorldwide.org does for you</h4>
								<p>AirlineTicketsWorldwide.org operates a number of web sites allowing you to search for airline tickets.</p>
								<p>Every time you submit a search request, AirlineTicketsWorldwide.org contacts a number of our partners – including, but not limited to, service providers, airlines, hotels, travel agencies [collectively referred to as Our Partners] – to provide us with a list of available options; then we sort out the results and present them to you. You can search, filter and browse the results until you find a suitable option and click on the corresponding record. At that time you are redirected to Our Partner and all your further interactions take place with them, not Go Travel.</p>
								<h4>What AirlineTicketsWorldwide.org doesn’t do for you</h4>
								<p><b>AirlineTicketsWorldwide.org doesn’t sell tickets / bookings / etc</b>. Our service only allows you to search for travel products, but you pay directly to Our Partners on their web sites. Hence, if you have questions, suggestions or service inquiries, please forward them directly to Our Partner. All mentions of Our Partners, including their trademarks and logos, are made for information purposes only.</p>
								<p><b>AirlineTicketsWorldwide.org doesn’t recommend any tickets / bookings over other tickets / bookings</b>. Our service provides the comparison tool and the information we collect from Our Partners. All decisions are yours.</p>
								<h4>What AirlineTicketsWorldwide.org doesn’t want you to do</h4>
								<p>If you’re under 13 – using the web site without your parent’s or guardian’s supervision.</p>
								<p>Running automated search queries on our servise. This may affect the operation of our service and make other users unhappy. This also includes spam and requests aimed at or likely to impair the performance and operation of the service.</p>
								<h4>If you think AirlineTicketsWorldwide.org has done something wrong</h4>
								<p>Intellectual Property Infringement. If you think our service has infringed on your Intellectual Property, please send us a detailed explanation to legal@airlineticketsworldwide.org, and we’ll review it within the reasonable time frame.</p>
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