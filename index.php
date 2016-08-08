<?
$headpath = $_SERVER['DOCUMENT_ROOT'].'/';
$htmlpath = 'http://'.$_SERVER['HTTP_HOST'].'/';

//load country
	$no_country=file($headpath.'no_county.txt');
	$reader = new XMLReader();
	$reader->open($headpath.'countries.xml');
	$item = array();
	$n=0;//


	while ($reader->read()) {
    	switch ($reader->nodeType) {
        	case (XMLReader::ELEMENT):

            	if ($reader->localName == 'countries') {
				
					
                	$item = array();
                	while ($reader->read()){
                    	if ($reader->nodeType == XMLReader::ELEMENT) {
                        	$name = strtolower($reader->localName);
                        	while ($reader->moveToNextAttribute()){

                            	$item[$name]['__attribs'][$reader->localName] = $reader->value;
                        	}
                        	$reader->read();
                        	if (isset($item[$name]) && is_array($item[$name])){
                            	$item[$name]['value'] = $reader->value;
                        	}else
                            	$item[$name] = $reader->value;
 
                    	}
                    	if ($reader->nodeType == XMLReader::END_ELEMENT && $reader->localName == 'countries')
                        	break;
                	}
                			
					$countr[$n] = array();
					$flag_no_country=0;
					for ($i=0; $i < count($no_country); $i++) { 
						if (trim($no_country[$i]) == trim($item[code])) {
							$flag_no_country++;

						}
					}
					if ($flag_no_country == 0) {
						$countr[$n] = $item; 
				
						$n++;
					}
					
			    }
    	}
	}
//load country

if(isset($_GET['strana'])){
    $country = $_GET['strana'];

    //Load routes
    	$reader = new XMLReader();
		$reader->open($headpath.'xmlcountry/'.trim($country).'.xml');
		$item = array();
		$n=0;//


		while ($reader->read()) {
    		switch ($reader->nodeType) {
        		case (XMLReader::ELEMENT):

            		if ($reader->localName == 'routes') {
				
					
                	$item = array();
                	while ($reader->read()){
                    	if ($reader->nodeType == XMLReader::ELEMENT) {
                        	$name = strtolower($reader->localName);
                        	while ($reader->moveToNextAttribute()){

                            	$item[$name]['__attribs'][$reader->localName] = $reader->value;
                        	}
                        	$reader->read();
                        	if (isset($item[$name]) && is_array($item[$name])){
                            	$item[$name]['value'] = $reader->value;
                        	}else
                            	$item[$name] = $reader->value;
 
                    	}
                    	if ($reader->nodeType == XMLReader::END_ELEMENT && $reader->localName == 'routes')
                        	break;
                	}
                			
					$routes[$n] = array();
					$routes[$n] = $item; 
				
					$n++;
			    }
    		}
		}
    	//Load routes
    if(isset($_GET['gorod'])){
    	$city = $_GET['gorod'];
    	for($i=0;$i<count($routes);$i++){
    		if (trim($routes[$i][airline_iata]).'-'.trim($routes[$i][departure_airport_iata]).'-'.trim($routes[$i][arrival_airport_iata]) == trim($city)) {
    			$airline_iata = trim($routes[$i][airline_iata]);
    			$departure_airport_iata = trim($routes[$i][departure_airport_iata]);
    			$departure_name_airport = trim($routes[$i][departure_name_airport]);
    			$departure_coordinates_lon = trim($routes[$i][departure_coordinates_lon]);
    			$departure_coordinates_lat = trim($routes[$i][departure_coordinates_lat]);
    			$departure_country_code = trim($routes[$i][departure_country_code]);
    			$departure_country_name = trim($routes[$i][departure_country_name]);
    			$departure_city_code = trim($routes[$i][departure_city_code]);
    			$departure_city_name = trim($routes[$i][departure_city_name]);
    			$arrival_airport_iata = trim($routes[$i][arrival_airport_iata]);
    			$arrival_name_airport = trim($routes[$i][arrival_name_airport]);
    			$arrival_coordinates_lon = trim($routes[$i][arrival_coordinates_lon]);
    			$arrival_coordinates_lat = trim($routes[$i][arrival_coordinates_lat]);
    			$arrival_country_code = trim($routes[$i][arrival_country_code]);
    			$arrival_country_name = trim($routes[$i][arrival_country_name]);
    			$arrival_city_code = trim($routes[$i][arrival_city_code]);
    			$arrival_city_name = trim($routes[$i][arrival_city_name]);
    			$planes = trim($routes[$i][planes]);
    			$plane_name = trim($routes[$i][plane_name]);
    		}
    	}
    	$file_airlanes = file_get_contents($headpath."airlines.json");
		$arr_airlanes = json_decode($file_airlanes, true); 
		for ($y=0; $y < count($arr_airlanes); $y++) { 
			if ($arr_airlanes[$y][iata] == $airline_iata) {
				$name_airlines = $arr_airlanes[$y][name];
			}
		}
		$near1_latitude=$departure_coordinates_lat+1.3;
		$near2_latitude=$departure_coordinates_lat-1.3;
		$near1_longitude=$departure_coordinates_lon+1.3;
		$near2_longitude=$departure_coordinates_lon-1.3;
		$t=0;
		for($z=0;$z<count($routes);$z++){
			if($routes[$z][departure_coordinates_lat]<$near1_latitude && $routes[$z][departure_coordinates_lat]>$near2_latitude && $routes[$z][departure_coordinates_lon]<$near1_longitude && $routes[$z][departure_coordinates_lon]>$near2_longitude && $airline_iata!=$routes[$z][airline_iata]){
				$near_routes[$t]=$routes[$z];
				$t++;
			}
		}
    	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Cheapest airline tickets to <? echo $arrival_city_name; ?> from <? echo $departure_city_name; ?> | <? echo $name_airlines; ?></title>

		<meta name="geo.placename" content="<? echo $departure_city_name; ?>, <? echo $departure_country_code; ?>" />
		<meta name="geo.position" content="<? echo $departure_coordinates_lat; ?>;<? echo $departure_coordinates_lon; ?>" />
		<meta name="geo.region" content="<? echo $departure_country_code; ?>-<? echo $departure_city_code; ?>" />
		<meta name="ICBM" content="<? echo $departure_coordinates_lat; ?>,<? echo $departure_coordinates_lon; ?>" />
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
		<style>
        	#map-canvas { 
				height: 400px;
			}
    	</style>

	</head>

	<body>
		
		<div id="site-content">
			
			<header class="site-header wow fadeInDown">
				<div class="container">
					<div class="header-content">
						<div class="branding">
							<a href="<? echo $htmlpath; ?>"><img src="<? echo $htmlpath; ?>images/logo.png" alt="Airline Tickets Worldwide" class="logo"></a>
							<h1 class="site-title">Airline Tickets to <? echo $arrival_city_name; ?></h1>
							
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
						<a href="<? echo $htmlpath; ?><? echo $arrival_country_code; ?>/"><span><? echo $arrival_country_name; ?></span></a>
						<i class="fa fa-arrow-circle-o-right"></i>
						<span><? echo $arrival_city_name; ?></span>
					</nav>
				</div>
			</header> <!-- .site-header -->

			<main class="content">
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="col-md-9 wow fadeInLeft">
								<h2 class="block-title-avia">Cheap Plane Tickets</h2>
								<?
									/*
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, "http://api.travelpayouts.com/v1/prices/cheap?currency=USD&origin=".$departure_city_code."&destination=".$arrival_city_code);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
									curl_setopt($ch, CURLOPT_HEADER, FALSE);
									curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Access-Token: 3baa7aaa2104fd0b53182d6359c995f2"));
									$response = curl_exec($ch);
									curl_close($ch);

									//var_dump($response);
									$arr_planes = json_decode($response, true); 
									*/
									//if(count($arr_planes[data][$arrival_city_code])!=0){
									$time_filter = false;
									if($time_filter){
										for($i=0;$i<count($arr_planes[data][$arrival_city_code]);$i++){
											for ($y=0; $y < count($arr_airlanes); $y++) { 
												
												if ($arr_airlanes[$y][iata] == $arr_planes[data][$arrival_city_code][$i][airline]) {
													$name_airlines = $arr_airlanes[$y][name];
												}
											}

								?>
								<div class="row">	
									<div class="col-sm-1 wow fadeInLeft block-single-avia">
										<img alt="<? echo $departure_country_name; ?>" src="<? echo $htmlpath; ?>imgcountry/<? echo $departure_country_code; ?>.png" class="img-responsive">
									</div>
									<div class="col-sm-2 wow fadeInLeft block-single-avia">
										<h2><? echo $departure_city_name; ?></h2>
									</div>
									<div class="col-sm-3 wow fadeInLeft block-single-avia-img">
										<?
										if (file_exists($htmlpath.'airline_logos/'.trim($arr_planes[data][$arrival_city_code][$i][airline]).'@2x.png')) {
										?>

										<img alt="<? echo $name_airlines; ?>" src="<? echo $htmlpath; ?>airline_logos/<? echo $arr_planes[data][$arrival_city_code][$i][airline]; ?>@2x.png" class="img-responsive">
										<?
										}
										else{
										?>
										<h4><? echo $name_airlines; ?></h4>
										<?
										}
										?>
										
									</div>
									<div class="col-sm-1 wow fadeInLeft block-single-avia-img">
										<img alt="<? echo $plane_name; ?>" title="<? echo $plane_name; ?>" src="<? echo $htmlpath; ?>images/plane.png" class="img-responsive">
									</div>
									<div class="col-sm-2 wow fadeInLeft block-single-avia">
										<h2><? echo $arrival_city_name; ?></h2>
									</div>
									<div class="col-sm-1 wow fadeInLeft block-single-avia">
										<img alt="<? echo $arrival_country_name; ?>" src="<? echo $htmlpath; ?>imgcountry/<? echo $arrival_country_code; ?>.png" class="img-responsive">
									</div>
									<div class="col-sm-2 wow fadeInLeft block-single-avia">
										<?
										if(strlen($arr_planes[data][$arrival_city_code][$i][price])>0){
										?>
										<h2><i class="fa fa-usd"></i><? echo $arr_planes[data][$arrival_city_code][$i][price]; ?></h2>
										<?
										}
										?>
									</div>
								</div>

								<?

										}
								?>
									
								<div class="row">
									<div class="col-md-12 wow fadeInLeft block-find-avia">
										<a href="<? echo $htmlpath; ?>flights/"><img alt="more details" src="<? echo $htmlpath; ?>images/more_details.png" class="img-responsive"></a>
									</div>
								</div>
								<?
									}
									else{
										for ($y=0; $y < count($arr_airlanes); $y++) { 
												
												if ($arr_airlanes[$y][iata] == $airline_iata) {
													$name_airlines = $arr_airlanes[$y][name];
												}
											}
								?>
								<div class="row">
									<span class="hidden-xs">
										<div class="col-sm-1 wow fadeInLeft block-single-avia">
											<img alt="<? echo $departure_country_name; ?>" src="<? echo $htmlpath; ?>imgcountry/<? echo $departure_country_code; ?>.png" class="img-responsive">
										</div>
									</span>
									<div class="col-sm-3 wow fadeInLeft block-single-avia">
										<h2><? echo $departure_city_name; ?></h2>
									</div>
									<span class="visible-xs-block">
										<div class="col-md-3 wow fadeInLeft block-single-avia">
											<i class="fa fa-long-arrow-down"></i>
										</div>
									</span>
									<span class="hidden-xs">
										<div class="col-sm-3 wow fadeInLeft block-single-avia-img">
										<?
										if (file_exists($headpath.'airline_logos/'.trim($airline_iata).'@2x.png')) {
										?>
										
											<img alt="<? echo $name_airlines; ?>" src="<? echo $htmlpath; ?>airline_logos/<? echo $airline_iata; ?>@2x.png" class="img-responsive">
										<?
										}
										else{
										?>
											<h3><? echo $name_airlines; ?></h3>

										<?
										}
										?>
											
										</div>
										<div class="col-sm-1 wow fadeInLeft block-single-avia-img">
											<img alt="<? echo $plane_name; ?>" title="<? echo $plane_name; ?>" src="<? echo $htmlpath; ?>images/plane.png" class="img-responsive">
										</div>
									</span>
									<div class="col-sm-3 wow fadeInLeft block-single-avia">
										<h2><? echo $arrival_city_name; ?></h2>
									</div>
									<span class="hidden-xs">
										<div class="col-sm-1 wow fadeInLeft block-single-avia">
											<img alt="<? echo $arrival_country_name; ?>" src="<? echo $htmlpath; ?>imgcountry/<? echo $arrival_country_code; ?>.png" class="img-responsive">
										</div>
									</span>
								</div>
								<div class="row">
									<div class="col-md-12 wow fadeInLeft block-find-avia">
										<a href="<? echo $htmlpath; ?>flights/"><img alt="more details" src="<? echo $htmlpath; ?>images/more_details.png" class="img-responsive"></a>
									</div>
								</div>
								
								<?
									}
								?>

								<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
								<script>
									var map;
									function initialize() {
										var myLatlng = new google.maps.LatLng(<? echo $departure_coordinates_lat ?>, <? echo $departure_coordinates_lon ?>);
										var mapOptions = {
										zoom: 10,
										center: new google.maps.LatLng(<? echo $departure_coordinates_lat ?>, <? echo $departure_coordinates_lon ?>)
										};
										map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
										var marker = new google.maps.Marker({
											position: myLatlng,
											map: map,
											title: 'Cheapest airline tickets to <? echo $arrival_city_name; ?> from <? echo $departure_city_name ?>, <? echo $departure_country_code ?>',
										});
									}
									google.maps.event.addDomListener(window, 'load', initialize);
								</script>
								
								
				
								<p>We know how difficult to find best day to purchase airline tickets when you need it.</p>

								<p>Are you from <? echo $departure_city_name; ?> <? echo $departure_country_name; ?>? We want to help.</p>

								<p>Getting a plane ticket to <? echo $cur_country; ?> has never been easier and can be done in just few minutes by full out the form <a href="<? echo $htmlpath; ?>flights/"><b>FLIGHTS</b></a>.</p>

								<p>Simply fill out an application on our site, and wait just a few minutes as we search our vast network of cheapest plane tickets to your needs.</p>

								<div id="map-canvas"></div>	
								<?
								if (count($near_routes)>0) {
								?>
								<p>We cover related airline routes from <? echo $departure_city_name; ?>:</p>
								<div class="related-routes">
								<?
								for($i=0;$i<count($near_routes);$i++){

								?>
									<a href="<? echo $htmlpath; ?><? echo trim($near_routes[$i][arrival_country_code]); ?>/<? echo  trim($near_routes[$i][airline_iata]).'-'.trim($near_routes[$i][departure_airport_iata]).'-'.trim($near_routes[$i][arrival_airport_iata]) ?>/" title="Plane tickets to <? echo trim($near_routes[$i][arrival_city_name]) ?> from <? echo trim($near_routes[$i][departure_city_name]) ?>" class="wow fadeInRight"><? echo trim($near_routes[$i][departure_city_name]) ?> <i class="fa fa-long-arrow-right"></i> <? echo trim($near_routes[$i][arrival_city_name]) ?></a>	
								<?

								}
								?>
								</div>
								<?
									}
								?>
							</div>
							<div class="col-md-2 col-md-push-1 wow fadeInRight">
								
								<?
								for($i=0;$i<count($countr);$i++){

								?>
								<a href="<? echo $htmlpath; ?><? echo trim($countr[$i][code]) ?>/" title="Airline tickets to <? echo trim($countr[$i][name]) ?>" class="boxed-link"><? echo trim($countr[$i][name]) ?></a>	
								<?

								}
								?>
								

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
    	<?
    }
    else{
    	for($i=0;$i<count($countr);$i++){
    		if (trim($countr[$i][code]) == trim($country)) {
    			$cur_country = trim($countr[$i][name]);
    		}
    	}
    	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Cheapest airline tickets to <? echo $cur_country; ?></title>
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
							<h1 class="site-title">Airline Tickets to <? echo $cur_country; ?></h1>
							
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
						<a href="<? echo $htmlpath; ?>"><span>Home</span></a> &rarr;
						<span><? echo $cur_country; ?></span>
					</nav>
				</div>
			</header> <!-- .site-header -->

			<main class="content">
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="col-md-9 wow fadeInLeft">

								<h2 class="block-title-avia">Buy airline tickets to <? echo $cur_country; ?></h2>
								
								
				
								<p>We know how difficult to find best day to purchase airline tickets when you need it.</p>

								<p>We want to help.</p>

								<p>Getting a plane ticket to <? echo $cur_country; ?> has never been easier and can be done in just few minutes by full out the form <a href="<? echo $htmlpath; ?>flights/"><b>FLIGHTS</b></a>.</p>

								<p>Simply fill out an application on our site, and wait just a few minutes as we search our vast network of cheapest plane tickets to your needs.</p>

								<p>We cover following airline routes to <? echo $cur_country; ?>:</p>

								<div class="routes-links">
								<?
								for($i=0;$i<count($routes);$i++){

								?>
								<a href="<? echo $htmlpath; ?><? echo trim($routes[$i][arrival_country_code]); ?>/<? echo  trim($routes[$i][airline_iata]).'-'.trim($routes[$i][departure_airport_iata]).'-'.trim($routes[$i][arrival_airport_iata]) ?>/" title="Plane tickets to <? echo trim($routes[$i][arrival_city_name]) ?> from <? echo trim($routes[$i][departure_city_name]) ?>" class="wow fadeInRight"><? echo trim($routes[$i][departure_city_name]) ?> <i class="fa fa-long-arrow-right"></i> <? echo trim($routes[$i][arrival_city_name]) ?></a>	
								<?

								}
								?>
								</div>
							</div>
							<div class="col-md-2 col-md-push-1 wow fadeInRight">
								
								<?
								for($i=0;$i<count($countr);$i++){

								?>
								<a href="<? echo $htmlpath; ?><? echo trim($countr[$i][code]) ?>/" title="Airline tickets to <? echo trim($countr[$i][name]) ?>" class="boxed-link"><? echo trim($countr[$i][name]) ?></a>	
								<?

								}
								?>
								

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
<?
    }
}
else{
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Cheapest Airline Tickets</title>
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

	<body class="slider-collapse">
		
		<div id="site-content">
			
			<header class="site-header wow fadeInDown">
				<div class="container">
					<div class="header-content">
						<div class="branding">
							<a href="<? echo $htmlpath; ?>"><img src="<? echo $htmlpath; ?>images/logo.png" alt="Airline Tickets Worldwide" class="logo"></a>
							<h1 class="site-title">Cheap Airline Tickets</h1>
							
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
				</div>
			</header> <!-- .site-header -->

			<main class="content">
				<div class="slider">
					<ul class="slides">
						<li data-background="<? echo $htmlpath; ?>dummy/avia-slide-1.jpg">
							<div class="container">
								<div class="slide-caption col-md-4">
									<h2 class="slide-title">Airline Tickets Worldwide</h2>
									<p>Our services are designed to help you find a cheapest airline tickets. AirlineTicketsWorldwide.org has a large number of airlines in our network, and we are confident that we can assist you in obtaining the best time to buy plane tickets.</p>
								</div>
							</div>
						</li>
						<li data-background="<? echo $htmlpath; ?>dummy/avia-slide-2.jpg">
							<div class="container">
								<div class="slide-caption col-md-4">
									<h2 class="slide-title">Inexpensive Plane Tickets</h2>
									<p>At AirlineTicketsWorldwide.org we pride ourselves on working with airlines that are fair and honest. Our main goal is to provide you with a great experience when searching for a plane ticket. All airlines in our network are required by law to follow all of the rules and regulations related to airlines.</p>
									
								</div>
							</div>
						</li>
						<li data-background="<? echo $htmlpath; ?>dummy/avia-slide-3.jpg">
							<div class="container">
								<div class="slide-caption col-md-4">
									<h2 class="slide-title">International Airline Tickets</h2>
									<p>Using AirlineTicketsWorldwide.org is 100% free to you - we do not charge any fees for our services. When you use AirlineTicketsWorldwide.org you will save time and money. All you have to do is provide us with basic information and we will instantly search our network of airlines to find you the plane ticket.</p>
								</div>
							</div>
						</li>
					</ul>
					<div class="flexslider-controls">
						<div class="container">
							<ol class="flex-control-nav">
								<li><a>1</a></li>
								<li><a>2</a></li>
								<li><a>3</a></li>
							</ol>
						</div>
					</div>
				</div>

				<div class="fullwidth-block features-section">
					<div class="container">
						<div class="filter-links">

							<?
								for($i=0;$i<count($countr);$i++){

							?>
								<a href="<? echo $htmlpath; ?><? echo trim($countr[$i][code]) ?>/" title="Airline tickets to <? echo trim($countr[$i][name]) ?>" class="wow fadeInRight"><? echo trim($countr[$i][name]) ?></a>	
							<?

								}
							?>
							
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
<?
}
?>