<?php
require("class.phpmailer.php");
require("class.smtp.php");

require_once("../../../service/connect.php");
require_once("../../../service/configData.php");
include_once('../../../vendor/autoload.php');
require_once("jwtToken.php");

// require("validateEmail.php");


header('Content-Type: application/json');
http_response_code(200);
$jwtTime = 300; // 60 วินาที * 5 นาที

try {
	$DB = new Database();
	$conn = $DB->connect();

	if (!empty($_POST['email'])) {

		$email = $_POST['email'];
		$algorithm = PASSWORD_DEFAULT;
		$emailHash = password_hash($email, $algorithm);

		$params = array(
			'email' => $email,
			// 'password' => $password
		);

		$sql = "SELECT * FROM $tb_admins WHERE email = :email";
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if (count($result) > 0) {
			// $email = "adisak@gmail.com";
			$emailJWT = jwtEncode(array("email" => $email), $jwtTime);
			if ($emailJWT['status']) {
				$response = [
					'status' => true,
					'message' => $emailJWT['message']
				];
				if (sendMail($email, $result[0]['firstName'], $emailJWT['message'])) {
					$response = [
						'status' => true,
						'message' => "Send Mail"
					];
				} else {
					$response = [
						'status' => true,
						'message' => $emailJWT['message']
					];
				}
			} else {
				$response = [
					'status' => false,
					'message' => $emailJWT['message']
				];
			}
			// $response = [
			// 	'status' => true,
			// 	'message' => $emailJWT
			// ];
			// if(validateEmail($email)) {
			// if (sendMail($email, $result[0]['firstName'], $emailHash)) {
			// 	$response = [
			// 		'status' => true,
			// 		'message' => "Send Mail"
			// 	];
			// } else {
			// 	$response = [
			// 		'status' => true,
			// 		'message' => $emailHash
			// 	];
			// }
			// }

			// else {
			// 	$response = [
			// 		'status' => true,
			// 		'message' => $emailHash
			// 	];
			// }
		} else {
			$response = [
				'status' => false,
				'message' => "Email ผู้ใช้งานไม่พบ!!!"
			];
		}
	} else {
		$response = [
			'status' => false,
			'message' => "Data require!!!"
		];
	}
} catch (PDOException $ex) {
	http_response_code(500);
	$response = [
		'status' => false,
		'message' => json_encode($ex)
	];
} catch (Exception $ex) {
	http_response_code(500);
	$response = [
		'status' => false,
		'message' => json_encode($ex)
	];
}
function sendMail($email_receive, $name_receive, $emailHash)
{
	global $shopName;
	global $hostForSendMail;
	try {
		// 'index_reset.php?email=' + $("#email").val() + '&key=' + resp.message);
		// $hostForSendMail = "https://shopping.pp2831.com";
		// $hostForSendMail = "http://localhost/shopping";

		$admin_email = "a.supatanasinkasem@gmail.com";
		$admin_name = "Admin  $shopName";
		$link = "$hostForSendMail/adminPages/managerPassword/index_reset.php?email=$email_receive&key=$emailHash";
		$link = "$hostForSendMail/adminPages/managerPassword/index_reset.php?token=$emailHash";

		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		$mail->CharSet = "UTF-8";
		// $mail->Encoding = 'base64';


		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;

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
		// $mail->setFrom('a.supatanasinkasem@gmail.com', 'First Last');
		$mail->setFrom($admin_email, $admin_name);

		//Set an alternative reply-to address
		// $mail->addReplyTo('a.supatanasinkasem@gmail.com', 'First Last');
		$mail->addReplyTo($admin_email, $admin_name);
		//Set who the message is to be sent to
		// $mail->addAddress('adisak.55555@gmail.com', 'User Receive');
		$mail->addAddress($email_receive, $name_receive);

		// $mail->addAddress("a@gmail.com", $name_receive);

		//Set the subject line
		$mail->Subject = "$shopName ได้ทำการส่ง link ในการเปลี่ยน Password";

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$body = "ระบบได้ทำการส่ง link ในการเปลี่ยน Password ผู้ใช้งานสามารถกด link ที่รูปภาพเพื่อทำการเปลี่ยน Password ได้เลยครับ <br><br>";
		$body .= "<a href='$link'><img src='https://shopping.pp2831.com/assets/img/reset-password.jpg' style='border-radius:16px;' /></a>";

		$mail->msgHTML($body);

		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';

		//Attach an image file
		// $mail->addAttachment('images/phpmailer_mini.png');
		// $mail->addAttachment('https://shopping.pp2831.com/images/213-1690690887.jpg');


		//send the message, check for errors
		if (!$mail->send()) {

			return false;
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			return true;
			return ["status" => true, "message" => ""];
			echo "Message sent!";
		}
	} catch (Exception $error) {
		return false;
		echo $error;
	}
}

echo json_encode($response);
