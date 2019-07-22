<?php
session_start();
require_once 'classes/main.class.php';
$mainClsObj = mainClass ::getInstance();
    
$table = 'tb_newsletter'; //table name
$nsmail = $_REQUEST['nsEmail'];


$newsletter = array(
       
  "email" => $nsmail,
   
  );

$checkEmail = array(
    
   
    "email" => $nsmail
);

try {
  $tot_email = $mainClsObj->countData($table,$checkEmail);
  
  if($tot_email > 0 && $tot_email != '')
  {
     echo "<p style='width:100%; font-weight: bold; color:#ffffff;'>This email address already exist for subscription</p>";
     return false;
  }    
 else {
     $insertRow = $mainClsObj->saveData($table,$newsletter); 
     
       
  }
  //echo "asdasds".$tot_user;
  //exit;
  //$insertRow = $mainClsObj->saveData($table,$user);
  //return true; 
} catch(Exception $e){
$is_error = 1;
echo $is_error;
}
?>