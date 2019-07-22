<?php
if(isset($_GET['ordernumber']))
{
 require_once 'classes/main.class.php';
 $mainClsObj = mainClass ::getInstance();

 $product_total = 60.00; // shipping cost that will be added to the product cost
 $orders = array(
 
    "order_no" => $_GET['ordernumber']
 );    
  $products_order = $mainClsObj->getData("tb_order", $orders);   
    
  foreach($products_order as $order)
  {      
     $product_total += $order['product_price'] * $order['product_quantity'];
  }
  

  $getBillingIdArr = array(
  
       "order_id" => $products_order[0]['id']
  
  );    
    $getBillingid = $mainClsObj->getData("tb_order_billing", $getBillingIdArr);
    $getShippingid = $mainClsObj->getData("tb_order_shipping", $getBillingIdArr);
    $getCustomerId = $mainClsObj->getData("tb_order_customer", $getBillingIdArr);      
    
  $getBillingAddArr = array(
  
       "id" => $getBillingid[0]['billing_id']
  
  );    
    $getBillingInfo = $mainClsObj->getData("tb_billing", $getBillingAddArr);  
    
   $getShippingAddArr = array(
  
       "id" => $getShippingid[0]['shipping_id']
  
  );    
    $getShippingInfo = $mainClsObj->getData("tb_shipping", $getShippingAddArr);

    $getCustomerArr = array(
  
       "id" => $getCustomerId[0]['customer_id']
  
  );    
    $getCustomerInfo = $mainClsObj->getData("tb_customer", $getCustomerArr); 
    
    $mainClsObj->sendMailtoCustomer($products_order, $getShippingInfo);
    $mainClsObj->sendMailtoAdmin($products_order, $getShippingInfo, $getBillingInfo, $getCustomerInfo);
}
?>
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

<!-- Mirrored from moonhtml.onaz.io/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:31 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Shopping Cart || Bells and Whistles</title>
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
<!-- Shop Sideabr Product Container
============================================ -->
<div class="pages cart-page">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="cart-page-container fix">
					<!-- Cart Page Tab List -->
					<div class="cart-page-tablist text-center">
						<ul>
							<li class="active"><a class="active" href="#shopping-cart" data-toggle="tab"><span class="number">1</span> <p>Shopping Cart</p></a></li>
							<li><a href="#check-out" data-toggle="tab" onclick="checkCartISEmpty(<?php echo count($_SESSION['products']);?>)"><span class="number">2</span> <p>Check Out</p></a></li>
							<li><a href="#order-complete" data-toggle="tab" onclick="checkCartISEmpty(<?php echo count($_SESSION['products']);?>)"><span class="number">3</span> <p>Order Complete</p></a></li>
						</ul>
					</div>
					<!-- Cart Page Tab Container -->
					<div class="tab-content">
						<!-- Cart Page Tab -->
						<div class="tab-pane active" id="shopping-cart">
							<div class="cart-page-title text-center"><h1>Shopping Cart</h1></div>
							
								<div class="table-responsive">
									<fieldset>
										<table class="table-cart data-table table" id="shopping-cart-table">
											<thead>
												<tr>
													<th>Items</th>
													<th>Price</th>
													<th>Quantity</th>
													<th>Total</th>
													<th>Remove</th>
												</tr>
											</thead>
											<tbody>
                                            <?php  
                                            if(count($_SESSION["products"]) > 0)
                                            {
                                            $sub_total = 0;    
                                            foreach($_SESSION["products"] as $key)
                                            {
                                                $prod_name = str_replace(" ", "-", $key['product_name']);
                                                $prod_total = $key['product_price'] * $key['product_quantity'];
                                            ?>    
												<tr>
													<td><div class="cart-items fix">
														<a href="#" class="cart-image"><img src="img/cart-product/1.jpg" alt="" /></a>
														<div class="cart-item-content fix">
															<h3 class="title"><a href="#"><?php echo ucwords($key['product_name']);?></a></h3>
															<span>Size : <strong>M</strong></span>
															<span>Color : <strong><?php echo $key['product_color'];?></strong></span>
														</div>
													</div></td>
													<td><span class="cart-price">&#2547; <?php echo number_format((float)round($key['product_price']), 2, '.', '');?></span></td>
													<!-- inclusive price starts here -->
													<td><div class="cart-qty"><input maxlength="99" class="input-cart-qty" value="<?php echo $key['product_quantity'];?>"></div></td>
													<!--Sub total starts here -->
													<td ><span class="cart-total-price">&#2547; <?php echo number_format((float)round($prod_total), 2, '.', ''); ?></span></td>
													<td><a href="javascript:;" class="cart-remove remove-item" onclick="removeItem('<?php echo $prod_name;?>');" ><i class="mo-cross-rounde"></i></a></td>
                                                    <input type="hidden" value="<?php echo $prod_name;?>" />
												</tr>
                                                <?php 
                                                 $sub_total = $sub_total + $prod_total;
                                                
                                                 }
                                                 $grand_total = $sub_total + 60.00;
                                            }
                                            else
                                            {
                                                echo "<tr><td colspan='5' align='center'><h3 style='text-align:center;'>Your cart is empty</h3></td></tr>";
                                            }
                                                ?>
												
											</tbody>
										</table>
									</fieldset>
								</div>
								<div class="row">
									<div class="col-md-7 col-xs-12">
										<div class="row">
											<div class="col-sm-6">
												<div class="shipping-cost">
													<!-- No shipping cost calculation -->
												</div>
											</div>
											<div class="col-sm-6">
												<div class="coupon-discount">
													<h3 class="title">Coupon Discount</h3>
													<div class="coupon-wrapper">
														<p>Enter your coupon code if you have one</p>
														<div class="input-box">
															<input type="text" placeholder="Enter your code here!" />
														</div>
														<input type="submit" value="Apply Coupon" />
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-5 col-xs-12">
										<div class="payment-details">
											<h3 class="title">Payment Details</h3>
											<div class="payment-wrapper">
												<div class="subtotal fix">
													<p class="float-left">Subtotal</p>
													<span class="float-right subTotal">&#2547; <?php echo number_format((float)round($sub_total), 2, '.', '');?> </span>
												</div>
												<div class="shipping fix">
													<p class="float-left">Shipping</p>
													<span class="float-right">&#2547; 60.00</span>
												</div>
												<div class="grandtotal fix">
													<p class="float-left">Grand total</p>
													<span class="float-right grandTotal">&#2547; <?php echo number_format((float)round($grand_total), 2, '.', '');?></span>
												</div>
												<div class="procced-checkout text-center"><button class="checkout-btn" id="checkout-btn" value="<?php echo count($_SESSION['products']);?>">Proceed to Checkout</button></div>
												
											</div>
										</div>
									</div>
								</div>
							
						</div>
						<!-- Cart Page Tab -->
                        
						<div class="tab-pane" id="check-out">
							<div class="cart-page-title cart-page-title-2 text-center"><h1>Checkout</h1><p>Personal Information and Payment</p></div>
							<div class="row">
                              <div class="col-md-6 col-xs-12">
									<div class="billing-details">
										<div class="cart-page-title"><h1>Billing Details</h1></div>
										<div class="checkout-form">
											<form action="inc/saveOrder.php" method="post" id="billing-details" class="moon-form">
												<div class="input-box"><input type="text" name="fName" id="fName" value="First Name *" onfocus="(this.value == 'First Name *') && (this.value = '')" onblur="(this.value == '') && (this.value ='First Name *')"  /></div>
												<div class="input-box"><input type="text" name="lName" id="lName" value="Last Name *" onfocus="(this.value == 'Last Name *') && (this.value = '')" onblur="(this.value == '') && (this.value ='Last Name *')"  /></div>
												<div class="input-box"><input type="text" name="email" id="email" value="Email Address *" onfocus="(this.value == 'Email Address *') && (this.value = '')" onblur="(this.value == '') && (this.value ='Email Address *')" /></div>
												<div class="input-box"><input type="text" name="phone" id="phone" value="Phone *" onfocus="(this.value == 'Phone *') && (this.value = '')" onblur="(this.value == '') && 
                                                (this.value ='Phone *')" /></div>
												<div class="input-box">
													<select name="country" id="country">
														<option value="Bangladesh">Bangladesh</option>
													</select>
												</div>
                                                <div class="input-box">
													<select name="district" id="district">
														<option value="Dhaka">Dhaka</option>
														<option value="Chattogram">Chattogram</option>
                                                        <option value="Barisal">Barisal</option>
                                                        <option value="Khulna">Khulna</option>
                                                        <option value="Mymensingh">Mymensingh</option>
                                                        <option value="Rajshahi">Rajshahi</option>
                                                        <option value="Rangpur">Rangpur</option>
                                                        <option value="Sylhet">Sylhet</option>
													</select>
												</div>
                                                <div class="input-box"><input type="text" name="zip" id="zip" value="Postcode *" onfocus="(this.value == 'Postcode *') && (this.value = '')" onblur="(this.value == '') && (this.value ='Postcode *')" /></div>
												<div class="input-box"><textarea name="address" id="address" rows="4" value="Address *" onfocus="(this.value == 'Address *') && (this.value = '')" onblur="(this.value == '') && (this.value ='Address *')">Address *</textarea></div>
											</form>
										</div>
									</div>
									<div class="shipping-details">
										<div class="cart-page-title"><h1><a href="#shipping-form" class="collapsed" data-toggle="collapse"><span class="check-box"></span>Ship to Different Addrress?</a></h1></div>
										<div class="checkout-form">
											<div id="shipping-form" class="collapse moon-form">
												<form method="post" action="inc/saveOrder.php" id="shipping-details">
													<div class="input-box"><input type="text" name="sfName" id="sfName" placeholder="First Name *" /></div>
													<div class="input-box"><input type="text" name="slName" id="slName" placeholder="Last Name *" /></div>
													<div class="input-box"><input type="text" name="sEmail" id="sEmail" placeholder="Email Address *" /></div>
													<div class="input-box"><input type="text" name="sPhone" id="sPhone" placeholder="Phone *" /></div>
													<div class="input-box">
													<select name="scountry" id="scountry">
														<option value="Bangladesh">Bangladesh</option>
													</select>
												</div>
                                                <div class="input-box">
													<select name="sdistrict" id="sdistrict">
														<option value="Dhaka">Dhaka</option>
														<option value="Chattogram">Chattogram</option>
                                                        <option value="Barisal">Barisal</option>
                                                        <option value="Khulna">Khulna</option>
                                                        <option value="Mymensingh">Mymensingh</option>
                                                        <option value="Rajshahi">Rajshahi</option>
                                                        <option value="Rangpur">Rangpur</option>
                                                        <option value="Sylhet">Sylhet</option>
													</select>
												</div>
													<div class="input-box"><input type="text" name="szip" id="szip" placeholder="Postcode *" /></div>
													<div class="input-box"><textarea name="saddress" id="saddress" rows="4" placeholder="Address *"></textarea></div>
													<div class="input-box"><textarea name="custom" id="custom" rows="4" placeholder="Include custom requirements for this order"></textarea></div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="order-details">
										<div class="cart-page-title"><h1>Your Order</h1></div>
										<div class="table-responsive">
											<fieldset>
												<table class="order-pro-table table" id="order-pro-table">
													<thead>
														<tr>
															<th><p class="product text-left">Product</p></th>
															<th><p class="total text-right">Total</p></th>
														</tr>
													</thead>
													<tbody>
                                                    <?php
                                                      $sub_total = 0;    
                                                        foreach($_SESSION["products"] as $key)
                                                        {
                                                            $prod_name = str_replace(" ", "-", $key['product_name']);
                                                            $prod_total = $key['product_price'] * $key['product_quantity'];  
                                                       
                                                        ?>
														<tr>
															<td><h3 class="title text-left"><?php echo ucwords($key['product_name']);?> x <?php echo $key['product_quantity'];?></td>
															<td ><span class="total-price text-right">&#2547; <?php echo number_format((float)round($prod_total), 2, '.', '');?></span></td>
														</tr>
														<?php 
                                                         $sub_total = $sub_total + $prod_total;
                                                        } 
                                                          $grand_total = $sub_total + 60.00;
                                                        ?>
													</tbody>
													<tfoot>
														<tr>
															<td><p class="cart-total-title text-left">Cart Subtotal <br />Shipping & Handling</p></td>
															<td><span class="cart-total text-right">&#2547; <?php echo number_format((float)round($sub_total), 2, '.', '');?></span><p class="shipping-charge text-right">&#2547; 60.00</p></td>
														</tr>
														<tr>
															<td><p class="vat text-left">Vat</p></td>
															<td><span class="vat-total text-right">&#2547; 0.00 </span></td>
														</tr>
														<tr>
															<td><h3 class="grand-total-title text-left">Grand Total</h3></td>
															<td><span class="grand-total text-right">&#2547; <?php echo number_format((float)round($grand_total), 2, '.', '');?></span></td>
														</tr>
													</tfoot>
												</table>
											</fieldset>
										</div>
										<div class="cart-page-title payment-title"><h1>Payment Method</h1></div>
										<div class="payment-methods fix">
											<div class="single-payment cheque">
												<button class="select-btn active" value="bKash"><span class="check-box"></span>Cash on Delivery</button>
												<p>Please check your product before you pay to the delivery person. Once received, it will not be refundable. </p>
											</div>
											<div class="single-payment paypal">
												<button class="select-btn" value="COD"><span class="check-box"></span>bKash Payment</button>
												<p>For bKash payment, we will contact you and provide you the bkash number. Full payment has to be made before we ship your product.</p>
											</div>
											
										</div>
										<div class="place-order text-center">
											<button class="place-order-btn">Place Order</button>
										</div>
									</div>
								</div>
                              </div>
						</div>
                                                   
						<!-- Cart Page Tab -->
						<div class="tab-pane" id="order-complete">
							<div class="order-complete-mgs text-center">
								<p>Thank you. Your Order Has been Received.</p>
							</div>
							<div class="order-information text-center fix">
								<div class="single">
									<span>Order No</span>
									<h4><?php if(isset($_GET['ordernumber'])) echo $_GET['ordernumber'];?></h4>
								</div>
								<div class="single">
									<span>Date</span>
									<h4><?php echo date("F j, Y");?></h4>
								</div>
								<div class="single">
									<span>Total</span>
									<h4>&#2547; <?php echo number_format((float)round($product_total), 2, '.', ''); ?></h4>
								</div>
								<div class="single">
									<span>Payment Method</span>
									<h4><?php echo ($products_order[0]['payment'] == 'COD') ?  "Cash on Delivery" : "bKash";?></h4>
								</div>
							</div>
							<div class="row" style="margin-left:20px;">
								<div class="col-md-6 col-xs-12">
									<div class="order-details order-details-complete">
										<div class="cart-page-title"><h1>Order Details</h1></div>
										<div class="table-responsive">
											<fieldset>
												<table class="order-pro-table table" id="order-pro-table-2">
													<thead>
														<tr>
															<th><p class="product text-left">Product</p></th>
															<th><p class="total text-right">Total</p></th>
														</tr>
													</thead>
													<tbody>
                                                     <?php
                                                       $sub_total = 0;    
                                                       foreach($products_order as $order)
                                                       {   
                                                          $sub_total += $order['product_price'] * $order['product_quantity'];    
                                                       ?>   
														<tr>
															<td><h3 class="title text-left"><?php echo $order['product_name']; ?> x <?php echo $order['product_quantity']; ?></h3></td>
															<td ><span class="total-price text-right">&#2547; <?php echo number_format((float)$order['product_price'], 2, '.', ''); ?></span></td>
														</tr>
                                                        <?php } ?>       
												     </tbody>
													<tfoot>
														<tr>
															<td><p class="cart-total-title text-left">Cart Subtotal <br />Shipping & Handling</p></td>
															<td><span class="cart-total text-right">&#2547; <?php echo number_format((float)round($sub_total), 2, '.', ''); ?></span><p class="shipping-charge text-right">&#2547; 60.00</p></td>
														</tr>
														<tr>
															<td><p class="vat text-left">Vat</p></td>
															<td><span class="vat-total text-right">&#2547; 0.00</span></td>
														</tr>
														<tr>
															<td><h3 class="grand-total-title text-left">Grand Total</h3></td>
															<td><span class="grand-total text-right">&#2547; <?php echo number_format((float)round($product_total), 2, '.', ''); ?></span></td>
														</tr>
													</tfoot>
												</table>
											</fieldset>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="coustomer-details">
										<div class="order-com-title"><h1>Customer Details</h1></div>
										<div class="content">
											<ul>
												<li><span>Name :</span><?php echo $getCustomerInfo[0]['name'];?></li>
												<li><span>Email :</span><?php echo $getCustomerInfo[0]['email'];?></li>
												<li><span>Telephone :</span><?php echo $getBillingInfo[0]['phone'];?></li>
											</ul>
										</div>
									</div>
									<div class="billing-address">
										<div class="order-com-title"><h1>Billing Address</h1></div>
										<div class="content">
											<h4><?php echo $getBillingInfo[0]['first_name'];?> <?php echo $getBillingInfo[0]['last_name'];?></h4>
											<p><?php echo $getBillingInfo[0]['address'];?> <br /><?php echo $getBillingInfo[0]['district'];?> <?php echo $getBillingInfo[0]['zip'];?>, <?php echo $getBillingInfo[0]['country'];?> </p>
											<p>Phone : <?php echo $getBillingInfo[0]['phone'];?></p>
										</div>
									</div>
									<div class="billing-address shipping-address">
										<div class="order-com-title"><h1>Shipping Address</h1></div>
										<div class="content">
											<h4><?php echo $getShippingInfo[0]['first_name'];?> <?php echo $getShippingInfo[0]['last_name'];?></h4>
											<p><?php echo $getShippingInfo[0]['address'];?> <br /><?php echo $getShippingInfo[0]['district'];?> <?php echo $getShippingInfo[0]['zip'];?>, <?php echo $getShippingInfo[0]['country'];?> </p>
											<p>Phone : <?php echo $getShippingInfo[0]['phone'];?></p>
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

<!-- Mirrored from moonhtml.onaz.io/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2019 12:27:35 GMT -->
</html>