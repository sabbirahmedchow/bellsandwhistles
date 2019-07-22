<?php
session_start();
$str = " ";
require_once '../classes/main.class.php';
$mainClsObj = mainClass ::getInstance();
    
$table = 'tb_category'; //table name
$catId = $_REQUEST['cat_id'];

$category = array(
       
    "parent" => $catId
  );
//echo "<script>console.log('" . json_encode($category) . "');</script>";
try {
  
  $subCat = $mainClsObj->getData($table,$category);
  $str = '<select class="form-control" id="subCat" name="subCat">';
  $str .= '<option value="">Select</option>';    
  foreach($subCat as $sub)
  {

    $str .= '<option value="'.$sub['id'].'">'.$sub['name'].'</option>';
      
  }
    $str .='</select>';
  echo $str; 
} catch(Exception $e){
$is_error = 1;
echo $e;
}
?>