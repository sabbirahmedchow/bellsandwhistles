<?php
session_start();
$str = " ";
require_once 'classes/main.class.php';
$mainClsObj = mainClass ::getInstance();
    
$table = 'tb_customer'; //table name

$cond = array(
       
    "id" => $_SESSION['user_id']
  );

//echo "<script>console.log('" . json_encode($category) . "');</script>";
try {
      
    $mainClsObj->updateData($table,$_REQUEST,$cond);

} catch(Exception $e){
$is_error = 1;
echo $e;
}
?>