<?php
require_once("../../../service/connect.php");

include_once('../../../vendor/autoload.php');
require_once("jwtToken.php");

header('Content-Type: application/json');
http_response_code(200);

try {
	$DB = new Database();
	$conn = $DB->connect();

	if (!empty($_POST['email']) && !empty($_POST['token']) && !empty($_POST['passwordNew'])) {
		$token = $_POST['token'];
		// print_r($token);
		$dataJWT = jwtDecode($token);
		if ($dataJWT['status']) {
			$email = $dataJWT['message']['data']->email;
			// $email = $_POST['email'];
			// $key = $_POST['token'];
			$passwordNew = $_POST['passwordNew'];
			$algorithm = PASSWORD_DEFAULT;
			$passwordHash = password_hash($passwordNew, $algorithm);

			$params = array(
				'email' => $email,
				// 'password' => $password
			);

			$sql = "SELECT * FROM $tb_admins WHERE email = :email";
			$stmt = $conn->prepare($sql);
			$stmt->execute($params);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if (count($result) > 0) {
				$params = array(
					'email' => $email,
					'passwordHash' => $passwordHash,
					'time' => date("Y-m-d H:i:s")
				);

				$sql = "UPDATE $tb_admins SET password=:passwordHash,updated_at=:time WHERE email=:email";
				$stmt = $conn->prepare($sql);
				$stmt->execute($params);

				$response = [
					'status' => true,
					'message' => "UPDATE Success"
				];
			} else {
				$response = [
					'status' => false,
					'message' => "Email ผู้ใช้งานไม่พบ!!!"
				];
			}
		} else {
			$response = [
				'status' => false,
				'message' => $dataJWT['message'],
			];
		}

		// $email = $_POST['email'];
		// $key = $_POST['key'];
		// $passwordNew = $_POST['passwordNew'];
		// $algorithm = PASSWORD_DEFAULT;
		// $passwordHash = password_hash($passwordNew, $algorithm);

		// $params = array(
		// 	'email' => $email,
		// 	// 'password' => $password
		// );

		// $sql = "SELECT * FROM $tb_admins WHERE email = :email";
		// $stmt = $conn->prepare($sql);
		// $stmt->execute($params);
		// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// if (count($result) > 0) {
		// 	$item = $result[0];
		// 	if (password_verify($email, $key)) {
		// 		$params = array(
		// 			'email' => $email,
		// 			'passwordHash' => $passwordHash,
		// 			'time' => date("Y-m-d H:i:s")
		// 		);

		// 		$sql = "UPDATE $tb_admins SET password=:passwordHash,updated_at=:time WHERE email=:email";
		// 		$stmt = $conn->prepare($sql);
		// 		$stmt->execute($params);

		// 		$response = [
		// 			'status' => true,
		// 			'message' => "UPDATE Success"
		// 		];
		// 	} else {
		// 		$response = [
		// 			'status' => false,
		// 			'message' => "Key ไม่ถูกต้อง!!!"
		// 		];
		// 	}
		// } else {
		// 	$response = [
		// 		'status' => false,
		// 		'message' => "Email ผู้ใช้งานไม่พบ!!!"
		// 	];
		// }
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
		'message' => "PDOException" . json_encode($ex)
	];
} catch (Exception $ex) {
	http_response_code(500);
	$response = [
		'status' => false,
		'message' => "Exception" . json_encode($ex)
	];
}

echo json_encode($response);
