<?php

if(isset($_POST['submit'])){
    $firstname= $_POST['firstname'];
    $name= $_POST['name'];
    $email= $_POST['email'];
    $website= $_POST['website'];
    $project= $_POST['project'];
    $themessage= $_POST['themessage'];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Mail server configuration
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->AuthType = 'LOGIN';
    $mail->Username = 'myemail@gmail.com';
    $mail->Password = 'mypassword';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    // Recipients
    $mail->SetFrom('me@mydomain.com', 'my name');
    $mail->AddAddress('me@mydomain.com', 'my name');
    $mail->AddReplyTo($_POST['email']);

    // Content
    $mail->IsHTML(true);
    $mail->Subject = 'Contact form on alainpicard.ca';
    //$mail->Body = 'Send HTML Email using SMTP in PHP, This is a test email I’m sending using SMTP mail server with PHPMailer.';
    
    $mail->Body = <<<EOT
    <strong>First Name</strong>: {$_POST['firstname']} <br>
    <strong>Name</strong>: {$_POST['name']} <br>
    <strong>Email</strong>: {$_POST['email']} <br>
    <strong>Website</strong>: {$_POST['website']} <br>
    <strong>Project</strong>: {$_POST['project']} <br>
    <strong>Message</strong>: {$_POST['themessage']} <br>
    EOT;

    //$mail->send();
    //echo 'Message has been sent!';

    if ($mail->Send()) { 
        header('Location: index.html');            
    }

} catch (Exception $e){
    echo 'Message could not be sent. Error: ', $mail->ErrorInfo;
}
?>
