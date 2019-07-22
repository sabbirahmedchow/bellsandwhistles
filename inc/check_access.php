<?php
session_start();
error_reporting(0);

require_once '../classes/main.class.php';
$mainClsObj = mainClass ::getInstance();

 $check_user = $mainClsObj->isValidUser($_POST['username'], $_POST['pass']);
  //$check_user = $obj->checkLoginAccess($_POST['login-username'], $_POST['login-password']);
 
 //exit;
//echo "asassa".$check_user;
//echo "Location:http://".$_SERVER['SERVER_NAME']."/gmvincorp/admin/index.php";
if($check_user == 1)
{
  $getUserInfo = $mainClsObj->getUserInformation($_POST['username']); 
  $_SESSION['user_id'] = $getUserInfo[0]['id'];    
  $_SESSION['fullname'] = $getUserInfo[0]['name'];        
  $_SESSION['user_email'] = $_POST['username'];
  $_SESSION['user_pass'] = $_POST['pass'];
  echo 1;
}
elseif($check_user == "not active user")
{
    echo "Your account is not activated yet. Please contact us for activation.";
}
else
{
  echo "Your email address or password doesn't match.";  
}    
//else if($check_user_type > 1)
//  {   
//   
//    $_SESSION['user_email'] = $_POST['login-username'];
//    $_SESSION['user_pass'] = $_POST['login-password'];
//    $_SESSION['user_type'] = 2;   
//    $_SESSION['user_id'] = $check_user;
//    header("Location:https://www.gmvincorp.com/user/index.php");
//   
//  }
//else if($check_user_type == '')
//  {
//     header("Location: https://www.gmvincorp.com/my-account.php?login=0");
//}  
//  else
//  {
//    //echo $res;
//    
//    if($res != '')
//    {
//     header("Location: https://www.gmvincorp.com/my-account.php?result=$res");
//     
//    }
//    else
//    {    
//     header("Location: https://www.gmvincorp.com/my-account.php?login=0");
//    }
//  }
