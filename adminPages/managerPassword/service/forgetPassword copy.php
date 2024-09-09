<?php
require_once("../../../service/connect.php");

try {
	$DB = new Database();
	$conn = $DB->connect();
	$conn->beginTransaction();

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
			// $item = $result[0];
			// $params = array(
			// 	'username' => $username,
			// 	'passwordHash' => $passwordHash,
			// 	'time' => date("Y-m-d H:i:s")
			// );

			// $sql = "UPDATE $tb_admins SET password=:passwordHash,updated_at=:time WHERE username=:username";
			// $stmt = $conn->prepare($sql);
			// $stmt->execute($params);

			$response = [
				'status' => true,
				'message' => $emailHash
			];
		}
		else {
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
	$conn->commit();
} catch (PDOException $ex) {
	$response = [
		'status' => false,
		'message' => json_encode($ex)
	];
	$conn->rollBack();
} catch (Exception $ex) {
	$response = [
		'status' => false,
		'message' => json_encode($ex)
	];
	$conn->rollBack();
}

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($response, 200);
