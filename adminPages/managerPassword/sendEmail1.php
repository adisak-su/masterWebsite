<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
require("class.phpmailer.php");

$mail = new PHPMailer();

$body = "ทดสอบการส่งอีเมล์ภาษาไทย UTF-8 ผ่าน SMTP Server ด้วย PHPMailer.";

$mail->CharSet = "utf-8";
$mail->isSMTP(); // Set mailer to use SMTP
$mail->SMTPDebug = 2;
$mail->SMTPAuth = true; // Enable smtp authentication
// $mail->SMTPSecure = 'tls'; // Enable "tls" encryption, "ssl" also accepted
// $mail->SMTPSecure = 'tls'; // Enable "tls" encryption, "ssl" also accepted
$mail->SMTPSecure = "ssl"; // Enable "tls" encryption, "ssl" also accepted

$mail->Host = "smtp.gmail.com";  // SMTP server "smtp.yourdomain.com" หรือ TLS/SSL : hostname ใสชื่อโฮสหรือ ns : "nsx.nakhonitech.com"
$mail->Port = 465; // พอร์ท SMTP 25  / SSL: 465 or 587 / TLS: 587
$mail->Username = "a.supatanasinkasem@gmail.com"; // account SMTP
$mail->Password = "ijecyfzmnyfiunkz"; // รหัสผ่าน SMTP


    // $passwordSend = "xhxtnqnxbcciktlf"; // Windows
    // $passwordSend = "wylecmxnhxahewuu"; // xampp
    // $passwordSend = "dhytipqahrdfegad"; // Windows  // sendmail
    // $passwordSend = "rgfriopuzmditeny"; // Windows  // sendmail 


/*
$mail->CharSet = "utf-8";
$mail->IsSMTP();    // set mailer to use SMTP
$mail->SMTPDebug  = 2;
$mail->Host = "smtp.gmail.com";  // specify main and backup server
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = $emailSend;  // SMTP username
$mail->Password = $passwordSend; // SMTP password
//        $mail->Port = 587;
$mail->Port = 465;
$mail->SMTPSecure = 'tls';
*/
// $mail->IsSMTP();    // set mailer to use SMTP
//         $mail->Host = "smtp.gmail.com";  // specify main and backup server
//         $mail->SMTPAuth = true;     // turn on SMTP authentication
//         $mail->Username = $emailSend;  // SMTP username
//         $mail->Password = $passwordSend; // SMTP password
//         $mail->Port = 587;
//         $mail->SMTPSecure = 'tls';



$mail->SetFrom("a.supatanasinkasem@gmail.com", "Adisak");
$mail->AddReplyTo("a.supatanasinkasem@gmail.com", "Adisak");
$mail->Subject = "ทดสอบ PHPMailer.";

$mail->MsgHTML($body);

$mail->AddAddress("adisak.55555@gmail.com", "recipient1"); // ผู้รับคนที่หนึ่ง
// $mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ผู้รับคนที่สอง

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>
/*


$mail = new PHPMailer();
        $mail->CharSet = "utf-8";
        $mail->IsSMTP();    // set mailer to use SMTP
        $mail->SMTPDebug  = 2;
        $mail->Host = "smtp.gmail.com";  // specify main and backup server
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = $emailSend;  // SMTP username
        $mail->Password = $passwordSend; // SMTP password
//        $mail->Port = 587;
        $mail->Port = 465;
        $mail->SMTPSecure = 'tls';

// global $emailSend = ;
// global $passwordSend;
// global $emailName;

$emailName = "a.supatanasinkasem@gmail.com";
$emailSend = "a.supatanasinkasem@gmail.com";
$passwordSend = "rgfriopuzmditeny"; // Windows  // sendmail 

$passwordSend = "ijecyfzmnyfiunkz"; // Windows  // sendmail 


    $passwordSend = "dhytipqahrdfegad"; // Windows  // sendmail
    $passwordSend = "rgfriopuzmditeny"; // Windows  // sendmail 

    $passwordSend = "ijecyfzmnyfiunkz"; // Windows  // sendmail



$data = file_get_contents( "php://input" ); //$data is now the string '[1,2,3]';
//echo $data;
$data = json_decode( $data ); 
//print_r ($data);
//echo count($data);

// $email = $data->email;
// $message = $data->message;
// $message = str_replace(":*:","&nbsp;",$message);
// $message = nl2br($message);

$email = "adisak.55555@gmail.com";
$message = "รายงานการตรวจสภาพบ้านครั้งที่ XXXX";

echo sendFile($email,$message);
exit();

function sendFile($email,$message,$file="",$home="",$checkListName="")
{
    global $emailSend;
    global $passwordSend;
    global $emailName;
    $name = "aaaa";
    // $ccAddress = $home['ccEmail'];
    $mess = "";
    try {
        $mail = new PHPMailer();
        $mail->CharSet = "utf-8";
        $mail->IsSMTP();    // set mailer to use SMTP
        $mail->Host = "smtp.gmail.com";  // specify main and backup server
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = $emailSend;  // SMTP username
        $mail->Password = $passwordSend; // SMTP password
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';

        $mail->From = $emailSend;
        $mail->FromName = $emailName;
        $mail->AddAddress($email, $name);

        // if($ccAddress!=""){
        //     $ccAddress = explode(",",$ccAddress);
        //     foreach ($ccAddress as $address) {
        //         $mail->AddCC ($address);
        //     }
        // }
        $mail->AddReplyTo($emailSend,$emailName);
        $mail->Subject = "รายงานการตรวจสภาพบ้านครั้งที่";
        // $mail->addAttachment($file);
        $mail->Body    = $message;
        $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

        if (!$mail->Send())
            $mess = "Mailer Error $emailSend : " . $mail->ErrorInfo;
        else
            $mess = "OK";
    } catch (Exception $e) {
        $mess = "Mailer Exception $emailSend : " . $e->getMessage();
    }

    return $mess;
}
?>
*/