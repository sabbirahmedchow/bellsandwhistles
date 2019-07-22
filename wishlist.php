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

<!-- Mirrored from moonhtml.onaz.io/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:35 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Wishlist || Bells and Whistles</title>
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
	<!-- jQuery 1.12.0
    ============================================ -->
    <script src="js/vendor/jquery-1.12.3.min.js"></script>
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
<?php include("header.php"); 
if($_REQUEST['user_id'] != '' && $_REQUEST['prod_id'] != '')
{
    require_once 'classes/main.class.php';
    $mainClsObj = mainClass ::getInstance();

    $table = 'tb_wishlist'; //table name
    $user_id = $_REQUEST['user_id'];
    $prod_id = $_REQUEST['prod_id'];

    $whislist = array(

      "product_id" => $prod_id,
      "customer_id" => $user_id
      );
    $mainClsObj->saveData($table,$whislist);
    return true;
}
?>
<!-- Shop Sideabr Product Container
============================================ -->
<div class="pages wishlist-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="cart-page-container wishlist-page-container fix">
					<div class="cart-page-title wishlist-page-title text-center"><h1>Wishlist</h1></div>
					
					<form action="#" id="cart-form">
						<div class="table-responsive">
							<fieldset>
								<table class="table-cart table-wishlist data-table table" id="shopping-cart-table">
									<thead>
										<tr>
											<th></th>
											<th>Items</th>
											<th>Price</th>
											<th>Stock Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><a href="#" class="cart-remove"><i class="mo-cross-rounde"></i></a></td>
											<td><div class="cart-items fix">
												<a href="#" class="cart-image"><img src="img/cart-product/1.jpg" alt="" /></a>
												<div class="cart-item-content fix">
													<h3 class="title"><a href="#">Popline Tops</a></h3>
													<span>Size : <strong>M</strong></span>
													<span>Color : <strong>Dark Blue</strong></span>
												</div>
											</div></td>
											<td><span class="cart-price">$ 238</span></td>
											<td ><span class="stock-status">In Stock</span></td>
											<td><div class="add-cart"><button class="add-cart-btn">Add to Cart</button></div></td>
										</tr>
										<tr>
											<td><a href="#" class="cart-remove"><i class="mo-cross-rounde"></i></a></td>
											<td><div class="cart-items fix">
												<a href="#" class="cart-image"><img src="img/cart-product/2.jpg" alt="" /></a>
												<div class="cart-item-content fix">
													<h3 class="title"><a href="#">Shanos Matte Blue</a></h3>
													<span>Size : <strong>M</strong></span>
													<span>Color : <strong>Dark Blue</strong></span>
												</div>
											</div></td>
											<td><span class="cart-price">$ 356</span></td>
											<td ><span class="stock-status">In Stock</span></td>
											<td><div class="add-cart"><button class="add-cart-btn">Add to Cart</button></div></td>
										</tr>
										<tr>
											<td><a href="#" class="cart-remove"><i class="mo-cross-rounde"></i></a></td>
											<td><div class="cart-items fix">
												<a href="#" class="cart-image"><img src="img/cart-product/3.jpg" alt="" /></a>
												<div class="cart-item-content fix">
													<h3 class="title"><a href="#">Minrova Sleep Wear</a></h3>
													<span>Size : <strong>M</strong></span>
													<span>Color : <strong>Dark Blue</strong></span>
												</div>
											</div></td>
											<td><span class="cart-price">$ 128</span></td>
											<td ><span class="stock-status">In Stock</span></td>
											<td><div class="add-cart"><button class="add-cart-btn">Add to Cart</button></div></td>
										</tr>
									</tbody>
								</table>
							</fieldset>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>

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
</body>

<!-- Mirrored from moonhtml.onaz.io/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:35 GMT -->
</html>