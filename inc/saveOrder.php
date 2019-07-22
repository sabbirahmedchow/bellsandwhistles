<?php
session_start();
error_reporting(0);

require_once '../classes/main.class.php';
$mainClsObj = mainClass ::getInstance();

$orderNumber = "BW ". $mainClsObj->generateRand(6);

extract($_POST, EXTR_PREFIX_SAME, "wddx"); // extract each item from POST array

$billing_f_name = $fName;
$billing_l_name = $lName;
$billing_email = $email;
$billing_phone = $phone;
$billing_country = $country;
$billing_district = $district;
$billing_zip = $zip;
$billing_address = $address;

$billingArr = array(

     "first_name" => $billing_f_name,
     "last_name" => $billing_l_name,
     "email" => $billing_email,
     "phone" => $billing_phone,
     "country" => $billing_country,
     "district" => $billing_district,
     "zip" => $billing_zip,
     "address" => $billing_address
);

$billing_id = $mainClsObj->saveData("tb_billing",$billingArr);

if($sfName == '')
{
    $sfName = $fName;
    $slName = $lName;
    $sEmail = $email;
    $sPhone = $phone;
    $scountry = $country;
    $sdistrict = $district;
    $szip = $zip;
    $saddress = $address; 
}

$shippingArr = array(

     "first_name" => $sfName,
     "last_name" => $slName,
     "email" => $sEmail,
     "phone" => $sPhone,
     "country" => $scountry,
     "district" => $sdistrict,
     "zip" => $szip,
     "address" => $saddress,
     "special_instruction" => $custom
);
$shipping_id = $mainClsObj->saveData("tb_shipping",$shippingArr);

foreach($_SESSION['products'] as $products)
{
    
  $prodArr = array(
   
      "order_no" => $orderNumber,
      "product_name" => $products['product_name'],
      "product_quantity" => $products['product_quantity'],
      "product_price" => $products['product_price'],
      "product_color" => ucwords($products['product_color']),
      "product_size" => "XL",
      "payment" => $_GET['payment']
      
  );   
$order_id = $mainClsObj->saveData("tb_order",$prodArr);
$orderbillingrelArr = array(

      "order_id" => $order_id,
      "billing_id" => $billing_id
);    
$mainClsObj->saveData("tb_order_billing",$orderbillingrelArr);    

$ordershippingrelArr = array(

      "order_id" => $order_id,
      "shipping_id" => $shipping_id
);    
$mainClsObj->saveData("tb_order_shipping",$ordershippingrelArr);
    
$ordercustomerrelArr = array(

      "order_id" => $order_id,
      "customer_id" => $_SESSION['user_id']
);    
$mainClsObj->saveData("tb_order_customer",$ordercustomerrelArr);    
}    
session_destroy();
header("location: ../cart.php?ordernumber=".$orderNumber."#order-complete");
?>