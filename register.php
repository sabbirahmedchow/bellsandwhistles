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

<!-- Mirrored from moonhtml.onaz.io/single-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:57 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Create an Account || Bells and Whistles</title>
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
	
  
	<!-- jQuery 1.12.3
    ============================================ -->
    <script src="js/vendor/jquery-1.12.3.min.js"></script>
    
    <!-- Ajax Function files to send data through AJAX
     ======================================================-->
    <script src="js/ajax_functions.js"></script>
  
    
    <!-- Modernizr JS
	============================================ -->
	<script src="js/vendor/modernizr-2.8.3.min.js"></script>
	<style>
    
    </style>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    $(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#regform').offset().top
    }, 'slow');
  });
    </script>
</head>
<body>
<?php include("header.php");?>
<!-- Shop Page Banner
============================================ -->
<div class="page-banner text-center">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>Fashion is part of our culture, and it's about more than just a pretty dress" - Joan Smalls</h1>
			</div>
		</div>
	</div>
</div>
<!-- Shop Sideabr Product Container
============================================ -->
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w" id="regform" method="post" action="#">
					<span class="login100-form-title p-b-53">
						Create an Account<br/><br/>
                        <p id="confirm" style="text-align: center; font-size:14px;"></p>
					</span>

					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Full Name
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "fullname is required">
						<input class="input100" type="text" name="fullname" id="fullname" required>
						<span class="focus-input100"></span>
					</div>
                    
                    <div class="p-t-31 p-b-9">
						<span class="txt1">
							Your Email Address
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "email is required" >
						<input class="input100" type="email" name="email" id="email" required>
						<span class="focus-input100"></span>
					</div>
					                    
                    
				   <div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required" >
						<input class="input100" type="password" name="password" id="password" required>
						<span class="focus-input100"></span>
					</div>
                    
                    <div class="p-t-13 p-b-9">
						<span class="txt1">
							Confirm Password
						</span>

					</div>
                    
					<div class="wrap-input100 validate-input" data-validate = "Confirm Password is required">
						<input class="input100" type="password" name="conf_pass" id="conf_pass" required>
						<span class="focus-input100"></span>
					</div>
                    
                    <div class="checkbox">
                            <label for="newsletter">
                                  <input type="checkbox" autocomplete="off" value="1" name="toc" id="toc">
                                  I have read and agree to the <a href="#">Terms of Service</a> <sup>*</sup>
                            </label>
                          </div>
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" name="btnSignUp" id="btnSignUp">
							Sign Up
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Already have an account?
						</span>

						<a href="login/" class="txt2 bo1">
							Sign in now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php include("footer.php");?>

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
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuU_0_uLMnFM-2oWod_fzC0atPZj7dHlU"></script> -->
<script>
	new WOW().init();
</script>
<!-- Main JS
============================================ -->
<script type="text/javascript" src="js/main.js"></script>
    <!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/mainlogin.js"></script>
    <link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
</body>

<!-- Mirrored from moonhtml.onaz.io/single-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:57 GMT -->
</html>