<?php
session_start();
$str = " ";
require_once 'classes/main.class.php';
$mainClsObj = mainClass ::getInstance();
    
$table = 'tb_customer'; //table name
$custImage = $_REQUEST['cust_image'];

$cond = array(
       
    "id" => $_SESSION['user_id']
  );
$data = array(
    "pro_pic" => $custImage 
);
//echo "<script>console.log('" . json_encode($category) . "');</script>";
try {
      
    $mainClsObj->updateData($table,$data,$cond);

} catch(Exception $e){
$is_error = 1;
echo $e;
}
?>