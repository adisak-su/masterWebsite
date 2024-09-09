<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
require("class.phpmailer.php");

require_once('../models/connectDB.php');

$data = file_get_contents( "php://input" ); //$data is now the string '[1,2,3]';
//echo $data;
$data = json_decode( $data ); 
//print_r ($data);
//echo count($data);

$homeID = "";
$checkListID = "";
$checkListName = "";
$email = "";
$message = "";
$checkListAreaName = "";
$checkListAreaID = "";
$checkListNo = "";
$checkListDetail = "";
$home = "";

$homeID = $data->homeID;
$checkListID = $data->checkListID;
$checkListName = $data->checkListName;
$email = $data->email;
$message = $data->message;
$message = str_replace(":*:","&nbsp;",$message);
//$message = substr($message,1,strlen($message)-2);

$message = nl2br($message);
//$message = nl2br(str_replace("\n","\r\n",$message));

$home = getHomeByID($homeID);
$checkListDetail = getCheckListByID($checkListID);



// if (!isset($_REQUEST['homeID']) || !isset($_REQUEST['checkListID']) || !isset($_REQUEST['checkListName'])) {
//     exit;
// }
// if (isset($_REQUEST['homeID'])) {
//     $homeID = $_REQUEST['homeID'];
//     $home = getHomeByID($homeID);
// }
// if (isset($_REQUEST['checkListID'])) {
//     $checkListID = $_REQUEST['checkListID'];
//     $checkListDetail = getCheckListByID($checkListID);
// }
// if (isset($_REQUEST['checkListName'])) {
//     $checkListName = $_REQUEST['checkListName'];
// }
// if (isset($_REQUEST['email'])) {
//     $email = $_REQUEST['email'];
// }
// if (isset($_REQUEST['message'])) {
//     $message = $_REQUEST['message'];
//     if($message=="") $message = "รายงานการตรวจสภาพบ้าน";
//     else{
//         $message = substr($message,1,strlen($message)-2);
// //        $message = nl2br($message);
//         $arr= preg_split ('/\n/', $message);
//         $message = "";
//         foreach ($arr as $value) {
//             $message .= $value . "\r\n";
//         }
//         $message = nl2br($message);
//     }
// }

$homeAddress = $home["Address"];
$homeAddr="";
$checkListNo = $checkListDetail[0]["CheckListNo"];
if(strstr($homeAddress, '/'))
{
    $pos = strpos($homeAddress, '/');
    $homeAddr = substr_replace($homeAddress, '_', $pos, 1);
}
else
    $homeAddr = $homeAddress;

$file = "../images/". $checkListID  . "/Report_".$checkListNo."_Home_".$homeAddr.".pdf";

//$file = "../images/". $checkListID  . "/Report_1_Lanceo Pride Karnchana - Klong Thanon_Home_1111.pdf";
//$mess = sendFile($email,$message,$file,$home,$checkListName);

echo sendFile($email,$message,$file,$home,$checkListName);
exit();

function sendFile($email,$message,$file,$home,$checkListName)
{
    global $emailSend;
    global $passwordSend;
    global $emailName;
    $name = $home['Owner'];
    $ccAddress = $home['ccEmail'];
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

        if($ccAddress!=""){
            $ccAddress = explode(",",$ccAddress);
            foreach ($ccAddress as $address) {
                $mail->AddCC ($address);
            }
        }
        $mail->AddReplyTo($emailSend,$emailName);
        $mail->Subject = "รายงานการตรวจสภาพบ้านครั้งที่ $checkListName คุณ $name";
        $mail->addAttachment($file);
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