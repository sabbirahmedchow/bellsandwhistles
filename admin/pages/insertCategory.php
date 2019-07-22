<?php
session_start();
require_once '../classes/main.class.php';
$mainClsObj = mainClass ::getInstance();
    
$table = 'tb_category'; //table name
$catName = $_REQUEST['cat_name'];
$catNameUrl = strtolower($catName);
$catUrl = str_replace(" ", "-", $catNameUrl);
$catImage = $_REQUEST['cat_image'];
$catParent = $_REQUEST['cat_parent'];
$category = array(
       
      "name" => $catName,
      "category_url" => $catUrl,
      "category_image" => $catImage,
      "parent" => $catParent
  );
//echo "<script>console.log('" . json_encode($category) . "');</script>";
try {
  
  $insertRow = $mainClsObj->saveData($table,$category);
  echo 1; 
} catch(Exception $e){
$is_error = 1;
echo $e;
}
?>