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

<head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-143068071-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-143068071-1');
    </script>

	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Bells and Whistles || One stop place for all kind of products and accessories</title>
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
    
         <!-- jQuery 1.12.0
    ============================================ -->
    <script src="js/vendor/jquery-1.12.3.min.js"></script>
      <!-- Ajax Function files to send data through AJAX
     ======================================================-->
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
<!-- Home 1 Slider
============================================ -->
<div class="home-slider-wrapper">
	<div id="revslider2" class="rev_slider">
		<ul>
			<li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off"  data-title="Slide1">
				 <!-- MAIN BACKGROUND IMAGE -->
				 <img src="img/home-3-slider/bg-1.jpg"  alt="">
				 <!-- CAPTION 1 -->
				 <div class="tp-caption sfl caption1"
					data-x="450" 
					data-y="250"
					data-speed="800"
					data-start="500"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"
					style="font-size: 100px;
					line-height: 100px;
					color: #182342;
					font-family: Playfair Display;
					font-weight: 700;
					font-style: italic;
					letter-spacing: -.25px;"
					>Men's<br/>Collection </div>
				 <!-- CAPTION 2 -->
				 <a href="#" class="tp-caption sfb caption2 shop-now"
					data-x="475" 
					data-y="559"
					data-speed="800"
					data-start="1000"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"
					style="font-size: 18px;
					line-height: 46px;
					color: #272727;
					letter-spacing: -.25px;
					border: 2px solid #272727;
					padding: 0 43px;
					text-transform: uppercase;"
					>Shop now</a>
				 <!-- LAYER NR. 1 -->
				 <div class="tp-caption sfr layer1"
					data-x="1115" 
					data-y="74"
					data-speed="800"
					data-start="2500"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"><img src="img/home-2-slider/man1.png"  alt=""></div>
				 <!-- LAYER NR. 2 -->
				 <div class="tp-caption sfr layer2" 
					data-x="890" 
					data-y="82"
					data-speed="800"
					data-start="1800"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"><img src="img/home-2-slider/man2.png"  alt=""></div>
			</li>
			<li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off"  data-title="Slide1">
				 <!-- MAIN BACKGROUND IMAGE -->
				 <img src="img/home-2-slider/bg-1.jpg"  alt="">
				 <!-- CAPTION 1 -->
				 <div class="tp-caption sfl caption1"
					data-x="450" 
					data-y="250"
					data-speed="800"
					data-start="500"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"
					style="font-size: 100px;
					line-height: 100px;
					color: #182342;
					font-family: Playfair Display;
					font-weight: 700;
					font-style: italic;
					letter-spacing: -.25px;"
					>Women's <br />Collection</div>
				 <!-- CAPTION 2 -->
				 <a href="#" class="tp-caption sfb caption2 shop-now"
					data-x="475" 
					data-y="559"
					data-speed="800"
					data-start="1000"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"
					style="font-size: 18px;
					line-height: 46px;
					color: #272727;
					letter-spacing: -.25px;
					border: 2px solid #272727;
					padding: 0 43px;
					text-transform: uppercase;"
					>Shop now</a>
				 <!-- LAYER NR. 1 -->
				 <div class="tp-caption sfr layer1"
					data-x="1115" 
					data-y="74"
					data-speed="800"
					data-start="2500"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"><img src="img/home-2-slider/layer1.png"  alt=""></div>
				 <!-- LAYER NR. 2 -->
				 <div class="tp-caption sfr layer2" 
					data-x="830" 
					data-y="82"
					data-speed="800"
					data-start="1800"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"><img src="img/home-2-slider/layer2.png"  alt=""></div>
			</li>
            <li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="off"  data-title="Slide1">
				 <!-- MAIN BACKGROUND IMAGE -->
				 <img src="img/home-1-slider/bg-1.jpg"  alt="">
				 <!-- LAYER NR. 1 -->
				 <div class="tp-caption sfb layer1"				
					data-x="435" 
					data-y="199"
					data-speed="800"
					data-start="1000"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"><img src="img/home-1-slider/bells.png"  alt=""></div>
				 <!-- LAYER NR. 2 -->
				 <div class="tp-caption sfb layer2" 							
					data-x="975" 
					data-y="78"
					data-speed="800"
					data-start="1500"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"><img src="img/home-1-slider/layer2.png"  alt=""></div>
				 <!-- LAYER NR. 3 -->
				 <div class="tp-caption sfb layer3" 							
					data-x="480" 
					data-y="-133" 				
					data-speed="800"
					data-start="2000"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"><img src="img/home-1-slider/layer3.png"  alt=""></div>
				 <!-- LAYER NR. 4 -->
				 <div class="tp-caption sfb layer4" 							
					data-x="1200" 
					data-y="415" 
					data-speed="800"
					data-start="2500"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"><img src="img/home-1-slider/whistles.png"  alt=""></div>
				 <!-- LAYER NR. 5 -->
				 <div class="tp-caption sfb layer5" 
					data-x="284" 
					data-y="550" 
					data-speed="800"
					data-start="3000"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"
					style="
					  color: #fff;
					  font-family: 'Playfair Display',serif;
					  font-size: 62px;
					  font-style: italic;
					  font-weight: 700;
					  letter-spacing: -1.5px;
					  line-height: 62px;
					">Exclusive Collection</div>
				 <!-- LAYER NR. 6 -->
				 <a href="#" class="shop-now tp-caption sfb layer6"
					data-x="385" 
					data-y="636" 
					data-speed="800"
					data-start="3500"
					data-easing="easeInOutExpo"
					data-elementdelay="0.1"
					data-endelementdelay="0.1"
					data-endspeed="300"
					style="
					  border: 2px solid #fff;
					  color: #fff;
					  display: block;
					  font-size: 18px;
					  line-height: 46px;
					  padding: 0 40px;
					  text-align: center;
					  text-transform: uppercase;
					">Shop now</a>
			</li>
		</ul>				
	</div>
</div>
    <div class="promo-products"></div>
<!-- Promo Product
============================================ -->
<!--
<div class="promo-products">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="promo-pro-container">
					<div class="row">
						<!-- Promo Product Text 
						<div class="promo-pro-text col-lg-3 col-md-4 col-sm-6">
							<div class="wrap">
								<span class="promo-label">Sale</span>
								<h2>Christmas <br /> Sales</h2>
								<h4>Up To 70 % off <br />on selected items</h4>
								<a href="#">Shop Now</a>
							</div>
						</div>
						<!-- Promo Product Slider 
						<div class="promo-pro-slider col-lg-9 col-md-8 col-sm-6">
							<!-- Single Promo Product 
							<div class="sin-promo-product fix">
								<!-- Product Image
								<div class="promo-pro-image">
									<a href="#"><img src="img/promo-product/1.jpg" alt="product" /></a>
									<!-- Product Hover Content 
									<div class="pro-hover fix">
										<!-- Product Hover Action 
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
									</div>
								</div>
								<!-- Product Content 
								<div class="promo-pro-content">
									<div class="title-cat float-left fix">
										<h3><a href="#">Leather Watch</a></h3>
										<a href="#" class="pro-cat float-left">Accessories</a>
									</div>
									<div class="price float-right fix">
										<p class="new">$ 149</p>
										<p class="old">$ 215</p>
									</div>
								</div>
							</div>
							<!-- Single Promo Product 
							<div class="sin-promo-product fix">
								<!-- Product Image 
								<div class="promo-pro-image">
									<a href="#"><img src="img/promo-product/2.jpg" alt="product" /></a>
									<!-- Product Hover Content 
									<div class="pro-hover fix">
										<!-- Product Hover Action 
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
									</div>
								</div>
								<!-- Product Content 
								<div class="promo-pro-content">
									<div class="title-cat float-left fix">
										<h3><a href="#">Catalyst Polarized</a></h3>
										<a href="#" class="pro-cat float-left">Accessories</a>
									</div>
									<div class="price float-right fix">
										<p class="new">$ 79</p>
										<p class="old">$ 140</p>
									</div>
								</div>
							</div>
							<!-- Single Promo Product 
							<div class="sin-promo-product fix">
								<!-- Product Image 
								<div class="promo-pro-image">
									<a href="#"><img src="img/promo-product/3.jpg" alt="product" /></a>
									<!-- Product Hover Content 
									<div class="pro-hover fix">
										<!-- Product Hover Action 
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
									</div>
								</div>
								<!-- Product Content 
								<div class="promo-pro-content">
									<div class="title-cat float-left fix">
										<h3><a href="#">Rico Gloves</a></h3>
										<a href="#" class="pro-cat float-left">Accessories</a>
									</div>
									<div class="price float-right fix">
										<p class="new">$ 125</p>
										<p class="old">$ 186</p>
									</div>
								</div>
							</div>
							<!-- Single Promo Product 
							<div class="sin-promo-product fix">
								<!-- Product Image 
								<div class="promo-pro-image">
									<a href="#"><img src="img/promo-product/2.jpg" alt="product" /></a>
									<!-- Product Hover Content
									<div class="pro-hover fix">
										<!-- Product Hover Action 
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
									</div>
								</div>
								<!-- Product Content 
								<div class="promo-pro-content">
									<div class="title-cat float-left fix">
										<h3><a href="#">Catalyst Polarized</a></h3>
										<a href="#" class="pro-cat float-left">Accessories</a>
									</div>
									<div class="price float-right fix">
										<p class="new">$ 79</p>
										<p class="old">$ 140</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->
<!-- Tab Products
============================================ -->
<div class="tab-product tab-product-2">
	<div class="container">
		<div class="row">
			<!-- Product Tab List -->
			<div class="col-xs-12 text-center">
				<ul class="pro-tab-list">
					<li class="active"><a href="#new-arrival" data-toggle="tab">New Arrival</a></li>
					<li><a href="#best-seller" data-toggle="tab">Best Seller</a></li>
					<li><a href="#most-wanted" data-toggle="tab">Most Wanted</a></li>
				</ul>
			</div>
			<!-- Product Tab Content Container -->
			<div class="pro-tab-content-container tab-content col-md-12 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-12">
				<!-- Product Tab -->
				<div class="pro-tab tab-pane active row" id="new-arrival">
					<div class="new-arrival-slider tab-pro-slider product-slider">
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/1.jpg" alt="product" /></a>
									<span class="pro-label great-deal">great deals</span>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left" href="javascript:;" title="Add to Cart" onclick="addtoCart('baby lion', 34.95, 'Red', '1.jpg');"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right" title="Add to Wishlist" onclick="addtoWishlist(1, <?php echo $_SESSION['user_id'];?>);"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Stripped Wool</a></h3>
										<p class="price float-right">$ 46</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Mens wear</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/2.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left" href="javascript:;" onclick="addtoCart('new shirt', 35.00, 'blue', '2.jpg');"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Cotton Maflar</a></h3>
										<p class="price float-right">$ 15</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Trendy </a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/3.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Goldy Head Pair</a></h3>
										<p class="price float-right">$ 99</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Gadget</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/4.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Wooland Shoe</a></h3>
										<p class="price float-right">$ 25</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Mens wear</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/5.jpg" alt="product" /></a>
									<span class="pro-label great-deal">great deals</span>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Stripped Wool</a></h3>
										<p class="price float-right">$ 46</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Mens wear</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Product Tab -->
				<div class="pro-tab tab-pane row" id="best-seller">
					<div class="best-seller tab-pro-slider product-slider">
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/5.jpg" alt="product" /></a>
									<span class="pro-label great-deal">great deals</span>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Stripped Wool</a></h3>
										<p class="price float-right">$ 46</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Mens wear</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/6.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Settle Jute Bag</a></h3>
										<p class="price float-right">$ 256</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Utilites</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/7.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Binchotan Mask</a></h3>
										<p class="price float-right">$ 99</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Beauty</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/8.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Dolce Scarf</a></h3>
										<p class="price float-right">$ 25</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Fashion</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/9.jpg" alt="product" /></a>
									<span class="pro-label great-deal">great deals</span>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Backel’s Skin Gel</a></h3>
										<p class="price float-right">$ 46</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Mens Beauty</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Product Tab -->
				<div class="pro-tab tab-pane row" id="most-wanted">
					<div class="most-wanted-slider tab-pro-slider product-slider">
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/9.jpg" alt="product" /></a>
									<span class="pro-label great-deal">great deals</span>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Backel’s Skin Gel</a></h3>
										<p class="price float-right">$ 46</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Mens Beauty</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/10.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Cowboy Hat</a></h3>
										<p class="price float-right">$ 256</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Skinny Fit </a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/11.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Jamaica Sweater</a></h3>
										<p class="price float-right">$ 99</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Womens wear</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/12.jpg" alt="product" /></a>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Addidas Leather</a></h3>
										<p class="price float-right">$ 25</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Mens shoe</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Single Product -->
						<div class="col-sm-12">
							<div class="sin-product sin-product-2">
								<!-- Product Image -->
								<div class="pro-image">
									<a href="#"><img src="img/product/1.jpg" alt="product" /></a>
									<span class="pro-label great-deal">great deals</span>
									<!-- Product Hover Content -->
									<div class="pro-hover fix">
										<!-- Product Hover Action -->
										<div class="pro-hover-action animated text-center">
											<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
											<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
										</div>
										<!-- Product Hover Options -->
										<div class="pro-hover-option">
											<!-- product Size -->
											<div class="pro-size fix">
												<h4>Sizes:</h4>
												<ul>
													<li>s</li>
													<li>xs</li>
													<li>m</li>
													<li>l</li>
													<li>xl</li>
													<li>xxl</li>
												</ul>
											</div>
											<!-- product Color -->
											<div class="pro-color fix">
												<h4>Colors:</h4>
												<ul>
													<li class="blue">b</li>
													<li class="orange">o</li>
													<li class="green">g</li>
													<li class="purple">p</li>
													<li class="pink">p</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Product Content -->
								<div class="pro-content">
									<div class="top fix">
										<h3><a href="#">Stripped Wool</a></h3>
										<p class="price float-right">$ 46</p>
									</div>
									<div class="bottom fix">
										<a href="#" class="pro-cat float-left">Mens wear</a>
										<div class="ratting float-right">
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
											<i class="mo-star star active"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Offers Banner 2
============================================ -->
<div class="offers-banner-2">
	<div class="container">
		<div class="row">
			<div class="offer-2-content col-lg-6 col-md-8 col-sm-12 text-center">
				<div class="top-content">
					<h3>Enjoy your Vacation with</h3>
					<h1>Cool Sunglasses</h1>
					<p>A perfect blend of style, comfort &amp; affordable price. They’re sure to make those around you go green with envy. </p>
				</div>
				<div class="bottom-content">
					<h3>From</h3>
					<h1 class="price">&#2547; 550.00</h1>
					<a href="#">See Collections</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Top Rated Product
============================================ -->
<div class="top-product">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="section-title text-center"><h1>Top Rated Product</h1></div>
			</div>
		</div>
		<div class="row">
			<!-- Single Product -->
			<div class="col-lg-3 col-md-4 col-md-offset-0 col-sm-5 col-sm-offset-1">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/5.jpg" alt="product" /></a>
						<span class="pro-label great-deal">great deals</span>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Stripped Wool</a></h3>
							<p class="price float-right">$ 46</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Mens wear</a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Single Product -->
			<div class="col-lg-3 col-md-4 col-sm-5">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/6.jpg" alt="product" /></a>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Settle Jute Bag</a></h3>
							<p class="price float-right">$ 256</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Utilites</a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star"></i>
								<i class="mo-star star"></i>
								<i class="mo-star star"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Single Product -->
			<div class="col-lg-3 col-md-4 col-md-offset-0 col-sm-5 col-sm-offset-1">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/7.jpg" alt="product" /></a>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Binchotan Mask</a></h3>
							<p class="price float-right">$ 99</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Beauty</a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star"></i>
								<i class="mo-star star"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Single Product -->
			<div class="col-lg-3 col-md-4 col-sm-5">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/8.jpg" alt="product" /></a>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Dolce Scarf</a></h3>
							<p class="price float-right">$ 25</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Fashion</a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Single Product -->
			<div class="col-lg-3 col-md-4 col-md-offset-0 col-sm-5 col-sm-offset-1">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/9.jpg" alt="product" /></a>
						<span class="pro-label great-deal">great deals</span>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Backel’s Skin Gel</a></h3>
							<p class="price float-right">$ 46</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Mens Beauty</a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Single Product -->
			<div class="col-lg-3 col-md-4 col-sm-5">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/10.jpg" alt="product" /></a>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Cowboy Hat</a></h3>
							<p class="price float-right">$ 256</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Skinny Fit </a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star"></i>
								<i class="mo-star star"></i>
								<i class="mo-star star"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Single Product -->
			<div class="col-lg-3 col-md-4 col-md-offset-0 col-sm-5 col-sm-offset-1">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/11.jpg" alt="product" /></a>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Jamaica Sweater</a></h3>
							<p class="price float-right">$ 99</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Womens wear</a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star"></i>
								<i class="mo-star star"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Single Product -->
			<div class="col-lg-3 col-md-4 col-sm-5">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/12.jpg" alt="product" /></a>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Addidas Leather</a></h3>
							<p class="price float-right">$ 25</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Mens shoe</a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star"></i>
							</div>
						</div>
					</div>
				</div>
			</div><!-- Single Product -->
			<div class="hidden-lg col-md-4 hidden-sm ">
				<div class="sin-product sin-product-2">
					<!-- Product Image -->
					<div class="pro-image">
						<a href="#"><img src="img/product/13.jpg" alt="product" /></a>
						<!-- Product Hover Content -->
						<div class="pro-hover fix">
							<!-- Product Hover Action -->
							<div class="pro-hover-action animated text-center">
								<button class="add-cart pro-action float-left"><i class="mo-cart"></i></button>
								<button class="wishlist pro-action float-right"><i class="mo-heart"></i></button>
							</div>
							<!-- Product Hover Options -->
							<div class="pro-hover-option">
								<!-- product Size -->
								<div class="pro-size fix">
									<h4>Sizes:</h4>
									<ul>
										<li>s</li>
										<li>xs</li>
										<li>m</li>
										<li>l</li>
										<li>xl</li>
										<li>xxl</li>
									</ul>
								</div>
								<!-- product Color -->
								<div class="pro-color fix">
									<h4>Colors:</h4>
									<ul>
										<li class="blue">b</li>
										<li class="orange">o</li>
										<li class="green">g</li>
										<li class="purple">p</li>
										<li class="pink">p</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Product Content -->
					<div class="pro-content">
						<div class="top fix">
							<h3><a href="#">Seqkl Watch</a></h3>
							<p class="price float-right">$ 119</p>
						</div>
						<div class="bottom fix">
							<a href="#" class="pro-cat float-left">Accssories</a>
							<div class="ratting float-right">
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
								<i class="mo-star star active"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<!-- Offers area
============================================ -->
<div class="offers-area-2">
	<div class="container">
        
		<div class="row">
            <div class="col-sm-12">
				<div class="section-title text-center"><h1>Exclusive Collections and Gifts</h1></div>
			</div>
			<div class="col-md-3 col-md-offset-0 col-sm-5 col-sm-offset-1">
				<div class="single-offer-2 offer-1">
					<a href="exclusive-gift"><img src="img/offers-2/1.jpg" alt="" /></a>
					<div class="content">
						<h1>Pendants</h1>
						<p>2019 women collections</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-5">
				<div class="single-offer-2 offer-2">
					
					<div class="content">
						<h1>Classic</h1>
						<p>Collections</p>
					</div>
                    <a href="exclusive-gift"><img src="img/offers-2/2.jpg" alt="" /></a>
				</div>
			</div>
			<div class="col-md-6 col-md-offset-0 col-sm-10 col-sm-offset-1">
				<div class="single-offer-2 offer-3">
					
                    <a href="exclusive-gift">
						<img src="img/offers-2/3.jpg" alt="" />
						<img class="secondary" src="img/offers-2/4.png" alt="" />
					</a>
					<div class="content">
						<h1>Game Of Thrones <br />Melisandre Asshai <br />Necklaces</h1>
						<div class="price fix">
							<p class="new">&#2547; 250.00</p>
							<!--p class="old">$ 265</p-->
						</div>
						<a href="exclusive-gift">Shop now</a>
					</div>		
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

<script type="text/javascript">function add_chatinline(){var hccid=27244050;var nt=document.createElement("script");nt.async=true;nt.src="https://mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
add_chatinline(); </script>
    <script type="text/javascript" src="https://www.mylivechat.com/chatwidget.aspx?hccid=27244050"></script>
</body>

<!-- Mirrored from moonhtml.onaz.io/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:02 GMT -->
</html>