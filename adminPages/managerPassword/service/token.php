<?php

//เรียกใช้ Library สำหรับ JWT

include_once('../../../vendor/autoload.php');

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;



// include("../../../jwt/JWT.php");
// include("../../../jwt/Key.php");
// include("../../../jwt/ExpiredException.php");

// use \Firebase\JWT\ExpiredException;
// use \Firebase\JWT\JWT;
// use \Firebase\JWT\Key;

//สร้าง function สำหรับ สร้าง Json Web Token โดยรับ String user
function encode_jwt($user)
{   //กำหนด key สำหรับ encode jwt
    $key = "my_JWT_key";
    //สร้าง object ข้อมูลสำหรับทำ jwt
    $payload = array(
        "user" => $user,
        "date_time" => date("Y-m-d H:i:s"), //กำหนดวันเวลาที่สร้าง
        // 'iat' => 1356999524,
        // 'nbf' => 1357000000,
        'iat' => time(),
        'exp' => time() + 2, // 1 ชม. 60*60
        // 'exp' => time() + 3600, // 1 ชม. 60*60
    );
    //สร้าง JWT สำหรับ object ข้อมูล
    // $jwt = JWT::encode($payload, $key);
    $jwt = JWT::encode($payload, $key, 'HS256');
    // $jwt = JWT::encode($payload, $key, "");
    // $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    //เพื่อความปลาดภัยยิ่งขึ้นเมื่อได้ JWT แล้วควรเข้ารหัสอีกชั้นหนึ่ง
    $jwt = encrypt_decrypt($jwt, "encrypt");
    // return token ที่สร้าง
    return $jwt;
}
//สร้าง function สำหรับอ่านข้อมูล User จาก JWT ( Token )
function decode_jwt($jwt)
{
    //กำหนด key สำหรับ decode jwt โดย
    $key = "my_JWT_key";
    try {
        //ถอดรหัส token
        $jwt = encrypt_decrypt($jwt, "decrypt");
        //decode token ให้เป็นข้อมูล user
        // $payload = JWT::decode($jwt, $key, array('HS256'));
        // $payload = JWT::decode($jwt, $key);
        $payload = JWT::decode($jwt, new Key($key, 'HS256'));
        // $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

    } catch (Exception $e) {   //กรณี Token ไม่ถูกต้องจะ return false
        // echo $e;
        return ["status"=>false,"message"=>$e->getMessage()];
        // return false;
    }

    //return ข้อมูล user กลับไป
    return ["status"=>true,"message"=>(array)$payload];
    // return  (array)$payload;
}
// function  สำหรับเข้ารหัส และถอดรหัส token เพื่อความปลอดภัย
function encrypt_decrypt($str, $action)
{
    $key = 'my_openssl_KEY';
    $iv_key = 'my_iv_KEY';
    $method = "AES-256-CBC";
    $iv = substr(md5($iv_key), 0, 16);
    $output = "";

    if ($action == "encrypt") {
        $output = openssl_encrypt($str, $method, $key, 0, $iv);
    } else if ($action == "decrypt") {
        $output = openssl_decrypt($str, $method, $key, 0, $iv);
    }

    return $output;
}
//รับ action  จาก client ว่าต้องการรับ token หรือ
$action = $_POST["action"];
// client ต้องการรับ token
if ($action == "get_token") {
    $user = $_POST["user"]; //รับข้อมูล User จาก client
    echo encode_jwt($user); //ส่ง token ไปให้ client
}
// client ต้องการ decode token ( อ่านข้อมูล user จาก token )
if ($action == "get_user") {
    $token = $_POST["token"]; //รับ token จาก client
    $jwt = decode_jwt($token); //decode ข้อมูล user จาก toekn ที่ client ส่งมา

    if (!$jwt["status"]) //แสดงว่า token ไม่ถูกต้อง
    {
        $err = array();
        // echo $jwt;
        $err["msg"] = $jwt["message"];
        // $err["msg"] = json_encode($jwt);
        
        echo json_encode($err);
    } else {   //ส่งข้อมูล user จาก token ที่ client ส่งมากลับไปในรูปแบบ json
        $jwt["message"]["time"] = time();
        echo  json_encode($jwt["message"]);
    }


    // if (!$jwt) //แสดงว่า token ไม่ถูกต้อง
    // {
    //     $err = array();
    //     // echo $jwt;
    //     $err["msg"] = "Wrong Token !!!";
    //     $err["msg"] = json_encode($jwt);
        
    //     echo json_encode($err);
    // } else {   //ส่งข้อมูล user จาก token ที่ client ส่งมากลับไปในรูปแบบ json
    //     $jwt["time"] = time();
    //     echo  json_encode($jwt);
    // }
}
