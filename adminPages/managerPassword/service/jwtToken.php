<?php
include_once('../../../vendor/autoload.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = 'my secert key';
// $data = array(
//     'id' => 1,
//     'name' => 'Puwanai Sangphon',
//     'email' => 'puwanai.sangphon@gmail.com'
// );
// $payload = array(
//     'iss' => 'https://puwanai.com',
//     'aud' => 'https://puwanai.com',
//     'iat' => time(),
//     'exp' => time() + 3600, // 1 ชม.
//     'data' => $data
// );

function jwtEncode($data,$time) {
    global $key;
    try {
        // decode token ให้เป็นข้อมูล user
        $payload = array(
            'data' => $data,
            'iat' => time(),
            'exp' => time() + $time,
        );
        $jwt = JWT::encode($payload, $key, 'HS256');
        return ["status"=>true,"message"=>$jwt];

    } catch (Exception $e) {   //กรณี Token ไม่ถูกต้องจะ return false
        // echo $e;
        return ["status"=>false,"message"=>$e->getMessage()];
        // return false;
    }
    // $jwt = JWT::encode($payload, $key, 'HS256');
    // return $jwt;
}
function jwtDecode($jwt) {
    global $key;

    try {
        // decode token ให้เป็นข้อมูล user
        $payload = JWT::decode($jwt, new Key($key, 'HS256'));
        return ["status"=>true,"message"=>(array)$payload];

    } catch (Exception $e) {   //กรณี Token ไม่ถูกต้องจะ return false
        // echo $e;
        if($e->getMessage() == "Expired token") {
            return ["status"=>false,"message"=>"ไม่สามารถใช้งานได้เนื่องจากเกินเวลาที่กำหนด!!!"];
            // $response = [
            //     'status' => false,
            //     'message' => "ไม่สามารถใช้งานได้เนื่องจากเกินเวลาที่กำหนด!!!",
            // ];
        }
        return ["status"=>false,"message"=>$e->getMessage()];
        // return false;
    }

    //return ข้อมูล user กลับไป
    // return ["status"=>true,"message"=>(array)$payload];

    // $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    // return $decoded;
}

?>
