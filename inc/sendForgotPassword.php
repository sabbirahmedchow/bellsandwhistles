<?php
require_once('classes/class.phpmailer.php');

require_once 'classes/main.class.php';
$mainClsObj = mainClass ::getInstance();

$email = $_REQUEST['email'];

$pass = $mainClsObj->getUserPass($email);

if($pass == 1)
{
$subject = "Password change request from AVE Petroleum";
$body = "<table border='0' width='100%' cellspacing='5' cellpadding='4'>
        <tr><td align='left'><img src='img/logo.png' alt='AVE Petroleum' title='AVE Petroleum' width='420' height='113' border='0' align='left' /></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='left'><b>AVE Petroleum</b><br/>sponsored by MILES LUBRICANTS LLC<br/>66 MARINE STREET<br/>FARMINGDALE, NY 11735<br/>(877)683-8086<br/>support@avepetroleum.com<br/>www.avepetroleum.com</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Hi,<br/><br/> Please follow the link below to set a new password  
<br/><br/><a href='https://www.avepetroleum.com/setNewPassword.php?email=$email' target='_blank' style='cursor:pointer;'>Set your new password.</a><br/><br/>Thank You.</td></tr></table>";

$sendTo = $email;
        //$sendTo = "sabbir@riseuplabs.com";
     //error_log("SendTo = $sendTo");

        $mail             = new PHPMailer();

        //$mail->IsSMTP(); // telling the class to use SMTP

        
        
        // Advanced setup with fall-back SMTP Server
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";  
        //$mail->SMTPKeepAlive = true;
        $mail->Host = 'smppout.secureserver.net';
        $mail->Port = 80;
//        $mail->User = "support@milesoil.us";
//        $mail->Password = "Miles2013@";

        $mail->SetFrom("info@milesoil.us", "AVE Petroleum");
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $address = "";
        
        if($sendTo != null){
            $address = $sendTo;
        } 
        
//        error_log("mail address is =$address");
        
        // $mail->AddAddress($address, "Mahbubur Rahman");
        $mail->AddAddress($address);
        //$mail->AddAddress("sabbirahmedchowdhury@gmail.com");
        
//        error_log("Subject is = $subject");
//        error_log("Body is = $body");
        try {
//            error_log("Subject is (2nd Time) = $subject");
            $mail->Subject = (string)$subject;
//            error_log("Subject is (3rd Time)= $subject");
            $mail->MsgHTML($body);
               
             
            
            $mail->Send();  
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
        echo true;
}

    

       //return true;   
       
       ?>

