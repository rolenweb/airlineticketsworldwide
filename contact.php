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
		
		<title>Contact</title>

		
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
						<span>Contact</span>
					</nav>
				</div>
			</header> <!-- .site-header -->

			<main class="content">
				<div class="fullwidth-block">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-md-push-3 wow fadeInLeft">
								<h2 class="block-find-avia">Contact us</h2>
            <?php
                 $error    = ''; // сообщение об ошибке
                 $name     = ''; // имя отправителя
                 $email    = ''; // email отправителя
                 $subject  = ''; // тема
                 $message  = ''; // сообщение
               	 $spamcheck = ''; // проверка на спам

            if(isset($_POST['send']))
            {
                 $name     = $_POST['name'];
                 $email    = $_POST['email'];
                 $subject  = $_POST['subject'];
                 $message  = $_POST['message'];
               	 $spamcheck = $_POST['spamcheck'];

                if(trim($name) == '')
                {
                    $error = '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation"></i> <span class="sr-only">Error:</span> Enter a valid name</div>';
                }
            	    else if(trim($email) == '')
                {
                    $error = '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation"></i> <span class="sr-only">Error:</span> Enter a valid email address</div>';
                }
                else if(!isEmail($email))
                {
                    $error = '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation"></i> </span> <span class="sr-only">Error:</span> Enter a valid email address</div>';
                }
            	    if(trim($subject) == '')
                {
                    $error = '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation"></i> <span class="sr-only">Error:</span> Enter a valid subject</div>';
                }
            	else if(trim($message) == '')
                {
                    $error = '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation"></i> <span class="sr-only">Error:</span> Enter a valid message</div>';
                }
	          	else if(trim($spamcheck) == '')
	            {
	            	$error = '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation"></i> <span class="sr-only">Error:</span> Enter a valid SPAMCHECK</div>';
	            }
	          	else if(trim($spamcheck) != '5')
	            {
	            	$error = '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation"></i> <span class="sr-only">Error:</span> Enter a valid SPAMCHECK</div><div class="errormsg">Check for spam: You entered an incorrect result! 2 + 3 = ???</div>';
	            }
                if($error == '')
                {
                    if(get_magic_quotes_gpc())
                    {
                        $message = stripslashes($message);
                    }

                 
                    // Обязательно укажите здесь Email на который должны приходить письма
                    $to      = "rolenweb@yandex.ru";

                
                    // [Сообщение через контактную форму] - тема сообщения - можете поменять на любую.
               

                    $subject = '[Airline Tickets Worldwide] : ' . $subject;

                    // сообщение 
                    $msg     = "From : $name \r\ne-Mail : $email \r\nSubject : $subject \r\n\n" . "Message : \r\n$message";

                    mail($to, $subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n");
            ?>

                  
                  <h4 class="bg-success block-find-avia">Your message has been sent. Thank you!</h4>
                  


            <?php
                }
            }

            if(!isset($_POST['send']) || $error != '')
            {
            ?>

            
            
            <?=$error;?>

            				<form  method="post" name="contFrm" id="contFrm" action="" class="contact-form">

            			
            					<input name="name" id="name" type="text" placeholder="Your Name..." value="<?=$name;?>">

            					<input name="email" id="email" type="text" placeholder="Email" value="<?=$email;?>">

            					<input name="subject" id="subject" type="text" placeholder="Subject" value="<?=$subject;?>">

                 				<textarea name="message" id="message" placeholder="Message..."><?=$message;?></textarea>

								<input name="spamcheck" id="spamcheck" type="text" placeholder="Check for spam: 2 + 3 =" value="<?=$spamcheck;?>">

            			
                 				<input name="send" id="send" type="submit" class="button" value="Send Message">

            				</form>

            
            <?php
            }

            function isEmail($email)
            {
                return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
                        ,$email));
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