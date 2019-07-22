<?php
session_start();
require_once 'classes/main.class.php';
$mainClsObj = mainClass ::getInstance();
    
$table = 'tb_product_review'; //table name
$rate = $_REQUEST['rate'];
$product_id = $_REQUEST['prod_id'];

$rating = array(
       
  "rating" => $rate,
  "product_id" => $product_id   
  );

try {

   $mainClsObj->saveData($table,$rating); 
   return true;  
       
} catch(Exception $e){
$is_error = 1;
echo $is_error;
}
?>