<?php
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
error_reporting(0);
session_start();
if(isset($_GET['logout']))
{
    session_destroy();
    header('location: index.php');
}
$total_price = 0;

  require_once 'classes/main.class.php';
  $mainClsObj = mainClass ::getInstance(); 
    
  $condArr = array(
     "parent" => 0
  );    
    
  $getAllCategory = $mainClsObj->getData("tb_category", $condArr);
?>

<!-- Header Top
============================================ -->
<div class="header-top">
	<div class="container">
		<div class="row">
			<!-- Header Top Left -->
			<div class="header-top-left col-sm-6">
				<ul class="header-login-reg float-left">
                    <?php if(!isset($_SESSION['user_id']))
                    {
                    ?>  
					<li><a href="login/">Log in</a></li>
					<li><a href="register/">Register</a></li>
                    <?php
                    }
                    else
                    {
                     
                    ?>
                    <li><a href="myaccount/">My Account</a></li>
                    <li><a href="#">My Orders</a></li>
                    <li><a href="wishlist/">My Wishlist</a></li>
					<li><a href="?logout=y">Logout</a></li>
                    <?php } ?>
				</ul>
			</div> 
			<!-- Header Top Right -->
			<div class="header-top-right col-sm-6">
				<ul class="language-currency float-right">
					
                    <li><a>Currency - BDT</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- Header Bottom
============================================ -->
<div class="header-bottom">
	<div class="container">
		<div class="row">
			<!-- Header Logo -->
			<div class="logo col-sm-4 col-xs-5"><a href=""><img src="img/logo.png" alt="logo" /></a></div>
			<!-- Main Menu -->
			<div class="main-menu col-md-7 hidden-sm hidden-xs">
				<nav>
					<ul>
						<li <?php if($uri_segments[2] == "index.php" || $uri_segments[2] == "") echo 'class="active"';?>><a href="">Home</a>
							
						</li>
						<li <?php if($uri_segments[2] == "shop") echo 'class="active"';?>><a href="shop/">shop</a>
							<!-- Mega Menu -->
                              
							<div class="mega-menu mega-menu1">
                                <?php
                                foreach($getAllCategory as $category)
                                {
                                 if($category['name'] != 'Exclusive Gift') 
                                 {
                                ?>      
								<div class="megamenu-column megamenu-column1">
									<ul>
                                       
										<li><a href="<?php echo $category['category_url'];?>"><?php echo $category['name'];?></a></li>
                                        <?php
                                         $condSubArr = array(
                                            "parent" => $category['id']
                                         );     
                                         $getAllSubCategory = $mainClsObj->getData("tb_category", $condSubArr);
                                        foreach($getAllSubCategory as $subcategory)
                                        {
                                        ?>    
										<li><a href="<?php echo $category['category_url']."/".$subcategory['category_url'];?>"><?php echo $subcategory['name'];?></a></li>
										<?php } ?>
									</ul>
								</div>
								<?php } } ?>
								<div class="megamenu-column megamenu-column2">
									<a href="exclusive-gift" class="menu-image"><img src="img/menu-image.png" alt="Exclusive Gifts" /></a>
								</div>
							</div>
						</li>
						<li><a href="#">about</a></li>
						<li <?php if($uri_segments[2] == "cart") echo 'class="active"';?>><a href="cart/">cart</a></li>
						<li <?php if($uri_segments[2] == "contact") echo 'class="active"';?>><a href="contact/">contact</a></li>
					</ul>
				</nav>
			</div>
			<!-- Header Search & Cart -->
			<div class="search-cart col-md-3 col-md-offset-0 col-sm-5 col-sm-offset-3 col-xs-7">
				<!-- Header Cart -->
				<div class="header-cart float-right">
					<button class="cart-btn"><i class="mo-cart"></i>
                        <span class="cart-number">
                        <?php 
                            if(isset($_SESSION["products"])){
                                echo count($_SESSION["products"]); 
                            }else{
                                echo 0; 
                            }
                        ?>
                        </span>
                    </button>
                   
					<div class="headercart-wrapper product-view" id="cart-load">
                    <?php 
                      if(isset($_SESSION["products"]) && count($_SESSION["products"]) > 0){
                    ?>
						<h2>Shopping Cart</h2>
						<ul class="products">
                        <?php 
                        foreach($_SESSION["products"] as $key)
                        {
                            $prod_name = str_replace(" ", "-", $key['product_name']);
                        ?>
                            <li>
								<a href="#" class="image float-left"><img src="img/header-cart/<?php echo $key['product_thumb'];?>" alt="" /></a>
								<div class="content fix">
									<h3><a href="#"><?php echo ucwords($key['product_name']);?></a></h3>
									<span>Color: <?php echo $key['product_color'];?></span>
									<p class="price">&#2547; <?php echo $key['product_price'];?> x <?php echo $key['product_quantity'];?></p>
								</div>
								<a href="javascript:;" class="remove remove-item" onclick="removeItem('<?php echo $prod_name;?>');"><i class="mo-cross-rounde"></i></a>
							</li>
                         <?php 
                               $unit_price = $key['product_price'] * $key['product_quantity'];
                               $total_price =  $total_price + $unit_price;
                            
                        }  ?>        
							
						</ul>
						<div class="total-price text-center fix">
							<p>Total</p>
							<span>&#2547; <?php echo number_format((float)$total_price, 2, '.', ''); ?></span>
						</div>
						
						<div class="cart-footer text-center fix"><a href="cart.php">View Cart</a></div>
					
                    <?php 
                     }
                     else
                     {
                    ?>
                      <h2>Shopping Cart</h2>
                        <ul class="products">
							<li>
								<span style="text-align:center; font-weight:bold; width:100%;">Your cart is empty.</span>
                            </li>
                        </ul>
                    
                    <div class="total-price text-center fix">
							<p>Total</p>
							<span>&#2547; 0.00</span>
						</div>
                        
                    <?php
                    }
                    ?>
                        </div>
				</div>
				<!-- Header Search -->
				<div class="header-search float-right">
					<button class="search-btn"><i class="mo-search"></i></button>
					<form action="#" class="search-form">
						<input type="text" placeholder="Search..." />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Mobile Menu
============================================ -->
<div class="mobile-menu hidden-lg hidden-md fix">
	<nav>
		<ul>
			<li><a href="/">Home</a>
				<!-- Sub Menu -->
				
			</li>
			<li><a href="shop/">shop</a>
				<ul>
                    <?php
                    foreach($getAllCategory as $category)
                    {
                     
                    ?>    
					<li><a href="<?php echo $category['category_url'];?>"><?php echo $category['name'];?></a>
						<ul>
                            <?php
                            $condSubArr = array(
                               "parent" => $category['id']
                            );     
                            $getAllSubCategory = $mainClsObj->getData("tb_category", $condSubArr);
                            foreach($getAllSubCategory as $subcategory)
                            {
                            ?>    
							<li><a href="<?php echo $category['category_url']."/".$subcategory['category_url'];?>"><?php echo $subcategory['name'];?></a></li>
							<?php } ?>
						</ul>
					</li>
                    <?php } ?>
					
				</ul>
			</li>
			<li><a href="#">about</a></li>
			<li><a href="cart/">cart</a></li>
			<li><a href="contact/">contact</a></li>
		</ul>
	</nav>
</div>