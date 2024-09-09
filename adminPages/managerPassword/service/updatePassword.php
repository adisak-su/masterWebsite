<?php
require_once("../../../service/connect.php");

header('Content-Type: application/json');
http_response_code(200);

try {
	$DB = new Database();
	$conn = $DB->connect();
	$conn->beginTransaction();

	if (!empty($_POST['adminID']) && !empty($_POST['password']) && !empty($_POST['passwordNew'])) {

		$adminID = $_POST['adminID'];
		$password = $_POST['password'];
		$passwordNew = $_POST['passwordNew'];
		$email = $_POST['email'];
		$algorithm = PASSWORD_DEFAULT;
		$passwordHash = password_hash($passwordNew, $algorithm);

		$params = array(
			'adminID' => $adminID,
			// 'password' => $password
		);

		$sql = "SELECT * FROM $tb_admins WHERE adminID = :adminID";
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if (count($result) > 0) {
			$item = $result[0];
			$passwordOld = $result[0]["password"];
			if (password_verify($password, $passwordOld)) {
				$params = array(
					'adminID' => $adminID,
					'email' => $email,
					'passwordHash' => $passwordHash,
					'time' => date("Y-m-d H:i:s")
				);
		
				$sql = "UPDATE $tb_admins SET email=:email,password=:passwordHash,updated_at=:time WHERE adminID=:adminID";
				$stmt = $conn->prepare($sql);
				$stmt->execute($params);
		
				$response = [
					'status' => true,
					'message' => "UPDATE Success"
				];
			}
			else {
				$response = [
					'status' => false,
					'message' => "Password ไม่ถูกต้อง!!!"
				];
			}
		}

	} else {
		$response = [
			'status' => false,
			'message' => "Data require!!!"
		];
	}
	$conn->commit();
} catch (PDOException $ex) {
	http_response_code(500);
	$response = [
		'status' => false,
		'message' => json_encode($ex)
	];
	$conn->rollBack();
} catch (Exception $ex) {
	http_response_code(500);
	$response = [
		'status' => false,
		'message' => json_encode($ex)
	];
	$conn->rollBack();
}

echo json_encode($response);
