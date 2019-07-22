<?php
error_reporting(0);
session_start();

####################### Add product to cart and increase quantity if the product is already in the cart############################
if(isset($_POST["action"]))
{
  
 foreach($_POST as $key => $value){
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //create a new product array 
	}
    
    if(isset($_SESSION["products"][$new_product['product_name']]))  //if session var already exist
			
	{
                
        $_SESSION["products"][$new_product['product_name']]['product_quantity']++;  //unset old item
	}			
    else
    {        
    while(!isset($_SESSION["products"][$new_product['product_name']]) && $_SESSION["products"][$new_product['product_name']] != $_POST['product_name']){ 
        
		
        $new_product["product_name"] = $_POST['product_name'];
		$new_product["product_price"] = $_POST['product_price'];
        $new_product["product_color"] = $_POST['product_color'];
        $new_product["product_thumb"] = $_POST['product_thumb'];
        $new_product["product_quantity"] = 1;
		
	
		
		$_SESSION["products"][$new_product['product_name']] = $new_product;	//update products with new item array	
	}
    }
    	
    
	//die(json_encode(array('items'=>$total_items))); //output json
   
}

######################## Increase or decrease the number of product in a cart based on increament or decreament operator########################
if(isset($_GET["cart_action"]))
{
    $prodName = str_replace("-", " ", $_GET["product_name"]);
    if(isset($_SESSION["products"][$prodName]) && $_GET["cart_action"] == "inc")  //if session var already exist
			
	{
                
        $_SESSION["products"][$prodName]['product_quantity']++;  //increase quantity
	}	
    else
    {
        $_SESSION["products"][$prodName]['product_quantity']--; //decrease quantity
    }
    
    
  
//    else
//    {        
//    while(!isset($_SESSION["products"][$new_product['product_name']]) && $_SESSION["products"][$new_product['product_name']] != $_POST['product_name']){ 
//        
//		
//        $new_product["product_name"] = $_POST['product_name'];
//		$new_product["product_price"] = $_POST['product_price'];
//        $new_product["product_color"] = $_POST['product_color'];
//        $new_product["product_thumb"] = $_POST['product_thumb'];
//        $new_product["product_quantity"] = 1;
//		
//	
//		
//		$_SESSION["products"][$new_product['product_name']] = $new_product;	//update products with new item array	
//	}
   // }
    	
    
	//die(json_encode(array('items'=>$total_items))); //output json
   
}

################ show total number of product in the cart ###################
if(isset($_GET["total_product"]) && $_GET["total_product"] == 1)
{
    $total_items = count($_SESSION["products"]); //count total items
    echo $total_items;
}

############### Change total product price in the cart based on quantity change #################
if(isset($_GET['chngTotalPrice']))
{
   $prodName = str_replace("-", " ", $_GET["product_name"]);
   $unit_price = $_SESSION["products"][$prodName]['product_price'] *  $_SESSION["products"][$prodName]['product_quantity'];
   $total_price =  $total_price + $unit_price;
   echo "&#2547; ".number_format((float)$total_price, 2, '.', '');  
}

############### Change sub total price #################
if(isset($_GET['chngSubTotalPrice']))
{
   $sub_total = 0;
   foreach($_SESSION["products"] as $key)
   {
    $unit_price = $key['product_price'] * $key['product_quantity'];   
    $sub_total = $sub_total + $unit_price;   
   }
   echo "&#2547; ".number_format((float)$sub_total, 2, '.', ''); 
}

############### Change grand total price #################
if(isset($_GET['chngGrandTotalPrice']))
{
   $grand_total = 0;
   foreach($_SESSION["products"] as $key)
   {
    $unit_price = $key['product_price'] * $key['product_quantity'];   
    $sub_total = $sub_total + $unit_price;   
   }
    $grand_total = $sub_total + 60;
   echo "&#2547; ".number_format((float)$grand_total, 2, '.', ''); 
}

################## list products in checkout page ######################
if(isset($_GET['checkout_cart']) && $_GET['checkout_cart'] == 1)
{
$checkout_cart='<thead>
  <tr>
	<th><p class="product text-left">Product</p></th>
	<th><p class="total text-right">Total</p></th>
		</tr>
		</thead>
		<tbody>';
        
            $sub_total = 0;    
              foreach($_SESSION["products"] as $key)
                {
                   $prod_name = str_replace(" ", "-", $key['product_name']);
                   $prod_total = $key['product_price'] * $key['product_quantity'];  
                                                       
                   
				$checkout_cart .='<tr>
				<td><h3 class="title text-left">'. ucwords($key['product_name']) .' x '. $key['product_quantity'].'</td>
				<td ><span class="total-price text-right">&#2547; '. number_format((float)$prod_total, 2, '.', '').'</span></td>
				</tr>';
				
                 $sub_total = $sub_total + $prod_total;
                 } 
                 $grand_total = $sub_total + 60.00;
              
				$checkout_cart .='</tbody>
				<tfoot>
				<tr>
				<td><p class="cart-total-title text-left">Cart Subtotal <br />Shipping & Handling</p></td>
				<td><span class="cart-total text-right">&#2547; '. number_format((float)$sub_total, 2, '.', '').'</span><p class="shipping-charge text-right">&#2547; 60.00</p></td>
				</tr>
				<tr>
					<td><p class="vat text-left">Vat</p></td>
					<td><span class="vat-total text-right">&#2547; 0.00 </span></td>
				</tr>
				<tr>
				<td><h3 class="grand-total-title text-left">Grand Total</h3></td>
				<td><span class="grand-total text-right">&#2547; '. number_format((float)$grand_total, 2, '.', '').'</span></td>
				</tr>
				</tfoot>';
                
              echo $checkout_cart;
}

################## list products in cart ###################
if(isset($_GET["load_cart"]) && $_GET["load_cart"] == 1)
{
    $total_price = 0;
	if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){ //if we have session variable
        
        $cart_box = '<h2>Shopping Cart</h2>
						<ul class="products">';
                        
                        foreach($_SESSION["products"] as $key)
                        {
                            $prod_name = str_replace(" ", "-", $key['product_name']);
                            $cart_box .='<li>
								<a href="#" class="image float-left"><img src="img/header-cart/'.$key['product_thumb'].'" alt="" /></a>
								<div class="content fix">
									<h3><a href="#">'.ucwords($key['product_name']).'</a></h3>
									<span>Color: '. $key['product_color'].'</span>
									<p class="price">&#2547; '.$key['product_price'].' x '. $key['product_quantity'].'</p>
								</div>
								<a href="javascript:;" class="remove remove-item" onclick=\'removeItem("'.ltrim($prod_name).'");\'><i class="mo-cross-rounde"></i></a>
							</li>';
                        
                               $unit_price = $key['product_price'] * $key['product_quantity'];
                               $total_price =  $total_price + $unit_price;
                            
                        }
							
						$cart_box .='</ul>
						<div class="total-price text-center fix">
							<p>Total</p>
							<span>&#2547; '. number_format((float)$total_price, 2, '.', '') .'</span>
						</div>
						<div class="cart-footer text-center fix"><a href="cart.php">View Cart</a></div>
					</div>';
        
        
		//die($cart_box); //exit and output content
	}else{
		$cart_box = '<h2>Shopping Cart</h2>
                        <ul class="products">
							<li>
								<span style="text-align:center; font-weight:bold; width:100%;">Your cart is empty.</span>
                            </li>
                        </ul>
                    
                    <div class="total-price text-center fix">
							<p>Total</p>
							<span>&#2547; 0.00</span>
						</div>';
	}
    echo $cart_box;
}

################# remove item from shopping cart ################
if(isset($_GET["product_remove"]))
{
	//$product_name   = filter_var($_GET["product_remove"], FILTER_SANITIZE_STRING); //get the product code to remove
    $prodName = str_replace("-", " ", $_GET["product_remove"]);
	unset($_SESSION["products"][$prodName]);
	
	
 	$total_items = count($_SESSION["products"]);
	//die(json_encode(array('items'=>$total_items)));
}
?>