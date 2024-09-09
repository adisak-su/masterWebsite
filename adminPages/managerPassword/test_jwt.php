<?php
include_once('../../vendor/autoload.php');

// include("../../jwt/JWT.php");
// include("../../jwt/Key.php");

// use \Firebase\JWT\JWT;
// use \Firebase\JWT\Key;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            width: 100%;
            max-width: 700px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $key = 'my secert key';
        $data = array(
            'id' => 1,
            'name' => 'Puwanai Sangphon',
            'email' => 'puwanai.sangphon@gmail.com'
        );
        $payload = array(
            'iss' => 'https://puwanai.com',
            'aud' => 'https://puwanai.com',
            'iat' => time(),
            'exp' => time() + 3600, // 1 ชม.
            'data' => $data
        );

        $jwt = JWT::encode($payload, $key, 'HS256');
        echo '
        <h2 class="mt-4">Token</h2>
        <code>', $jwt, '</code>';

        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        echo '
        <h2 class="mt-4">Decode</h2>';
        echo '<pre>';
        print_r($decoded);
        echo '</pre>';
        ?>
    </div>
</body>

</html>