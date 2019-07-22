<?php
require_once('classes/class.phpmailer.php');

require_once 'classes/main.class.php';
$mainClsObj = mainClass ::getInstance();

$newPass = $_REQUEST['newPass'];
$email = $_REQUEST['email'];

$mainClsObj->changeUserPass($email,$newPass);