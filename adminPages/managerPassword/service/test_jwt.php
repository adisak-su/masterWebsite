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

function jwtEncode($data,$key) {
    $payload = array(
        'iat' => time(),
        'exp' => time() + 3600, // 1 ชม.
        'data' => $data
    );
    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
}
function jwtDecode($jwt,$key) {
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
    return $decoded;
}

?>
