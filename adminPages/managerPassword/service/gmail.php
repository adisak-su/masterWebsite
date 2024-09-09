<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
// date_default_timezone_set('Etc/UTC');
date_default_timezone_set('Asia/Bangkok');

// require '../PHPMailerAutoload.php';

require("class.phpmailer.php");
require("class.smtp.php");
// require("class.pop3.php");

$admin_email = "a.supatanasinkasem@gmail.com";
$admin_name = "Adisak Supatanasinkasem";

//Create a new PHPMailer instance
$mail = new PHPMailer;

$mail->CharSet = "UTF-8";

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
// $mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $admin_email; //"a.supatanasinkasem@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "ijecyfzmnyfiunkz";

//Set who the message is to be sent from
$mail->setFrom('a.supatanasinkasem@gmail.com', 'First Last');
$mail->setFrom($admin_email, $admin_name);

//Set an alternative reply-to address
$mail->addReplyTo('a.supatanasinkasem@gmail.com', 'First Last');
$mail->addReplyTo($admin_email, $admin_name);
//Set who the message is to be sent to
$mail->addAddress('adisak.55555@gmail.com', 'User Receive');

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$body = "ทดสอบการส่งอีเมล์ภาษาไทย UTF-8 ผ่าน SMTP Server ด้วย PHPMailer.";
$body = "-<img src='https://shopping.pp2831.com/images/213-1690690887.jpg' />";

$mail->msgHTML($body);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');
$mail->addAttachment('https://shopping.pp2831.com/images/213-1690690887.jpg');


//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
