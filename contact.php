<!doctype html>
<?php
if($_SERVER['HTTP_HOST'] == "localhost")
{
?>
<base href="http://localhost/bells&whistles/">
<?}
else
{
?> 
<base href="http://www.bellsandwhistles.com.bd/">
<?php } ?>
<html class="no-js" lang="en-US">

<!-- Mirrored from moonhtml.onaz.io/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:28:00 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Contact Us || Bells and Whistles</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Fav Icon
	============================================ -->
	<link id="favicon" rel="icon" type="image/png" href="img/favicon.ico" />
	<!-- Google web fonts
	============================================ -->
	<link href='https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700italic,900italic,900,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<!-- Style Import CSS
	============================================ -->
	<link rel="stylesheet" type="text/css" href="css/custom-style.css" />
	<!-- RS-slider CSS
	============================================ -->
	<link rel="stylesheet" type="text/css" href="lib/rs-plugin/css/settings.css" media="screen" />
	
	<!-- Modernizr JS
	============================================ -->
	<script src="js/vendor/modernizr-2.8.3.min.js"></script>
	<script src="js/ajax_functions.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php include("header.php"); ?>
<!-- Shop Page Banner
============================================ -->
<div class="contact-banner">
	<img src="img/contact-banner.jpg" alt="" />
</div>
<!-- Shop Sideabr Product Container
============================================ -->
<div class="contact-page pages">
	<div class="container">
		<div class="row">
			<div class="contact-form col-md-8">
				<h2>Contact</h2>
				<p>Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, </p>
				<form id="contact-form" action="#" class="moon-form">
					<div class="input-box">
						<input type="text" name="name" placeholder="Name">
					</div>
					<div class="input-box">
						<input type="text" name="email" placeholder="Email">
					</div>
					<div class="input-box">
						<input type="text" name="subject" placeholder="Subject">
					</div>
					<div class="input-box">
						<textarea rows="5" placeholder="Message" id="contact-message" name="message"></textarea>
					</div>
					<div class="input-box">
						<input type="submit" value="Submit">
					</div>
				</form>
			</div>
			<div class="contact-map col-md-4">
				<h2>Location</h2>
				<div id="contact-map"></div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>

<!-- jQuery 1.12.0
============================================ -->
<script src="js/vendor/jquery-1.12.3.min.js"></script>
<!-- Bootstrap JS
============================================ -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MeanMenu JS
============================================ -->
<script type="text/javascript" src="js/jquery.meanmenu.min.js"></script>
<!-- Slick Carousel JS
============================================ -->
<script type="text/javascript" src="js/slick.min.js"></script>
<!-- RS-Plugin JS
============================================ -->
<script type="text/javascript" src="lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>   
<script type="text/javascript" src="lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="lib/rs-plugin/rs.home.js"></script>
<!-- Scrollup JS
============================================ -->
<script type="text/javascript" src="js/jquery.scrollup.min.js"></script>
<!-- jQuery UI JS
============================================ -->
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<!-- Tree View JS
============================================ -->
<script type="text/javascript" src="js/jquery.treeview.js"></script>
<!-- Nice Scroll JS
============================================ -->
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<!-- WOW JS
============================================ -->
<script type="text/javascript" src="js/wow.min.js"></script>
<!-- Google Map APi
============================================ -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFUjwypDXB-Z3N1IVro4pM7tQon2KjbtY"></script>
<script>
	new WOW().init();
</script>
<!-- Main JS
============================================ -->
<script type="text/javascript" src="js/main.js"></script>
<script>
	function initialize() {
	  var mapOptions = {
		zoom: 14,
		scrollwheel: false,
		center: new google.maps.LatLng(23.875854, 90.379547)
	  };
	  var map = new google.maps.Map(document.getElementById('contact-map'),
		  mapOptions);
	  var marker = new google.maps.Marker({
		position: map.getCenter(),
		animation: google.maps.Animation.BOUNCE,
		map: map
	  });
	}
	google.maps.event.addDomListener(window, 'load', initialize);				
</script>
</body>

<!-- Mirrored from moonhtml.onaz.io/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:28:05 GMT -->
</html>