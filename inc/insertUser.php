<?php
session_start();
require_once '../classes/main.class.php';
$mainClsObj = mainClass ::getInstance();
    
$res = " ";
$table = 'tb_customer'; //table name

$fullName = $_REQUEST['name'];
$email = $_REQUEST['email'];
$code = $mainClsObj->generateRegistrationCode();
$pass = md5($_REQUEST['password']);

$user = array(
       
   "name" => $fullName,
   "email" => $email,
   "password" => $pass,
   "code"  => $code,
   "is_active" => 0
  );

$checkUser = array(
    
    "email" => $email
);

try {
  //check if the user already exists    
  $tot_user = $mainClsObj->countData($table,$checkUser);
  
  if($tot_user > 0 && $tot_user != '')
  {
     echo $res = "This email address already exist";
     return false;
  }    
 else {
     //insert the user
     $insertRow = $mainClsObj->saveData($table,$user); 
     $mainClsObj->sendRegisterEmailConfirm($insertRow, $email, $code);      
  }
    
} catch(Exception $e){
$res = "An excepion has occurred. Please try again later.";
echo $res;
}
//header("location: https://www.avepetroleum.com/userCP/index.php");
?>