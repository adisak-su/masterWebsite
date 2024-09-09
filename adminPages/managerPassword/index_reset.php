<?php
// require_once('../authen.php');
require_once("../../service/configData.php");

include_once('../../vendor/autoload.php');
require_once("service/jwtToken.php");

// if (!empty($_REQUEST['email']) && !empty($_REQUEST['key'])) {
if (!empty($_REQUEST['token'])) {
    // $email = "AAA";
    $token = $_REQUEST['token'];
    // print_r($token);

    $dataJWT = jwtDecode($token);
    if ($dataJWT['status']) {
        // print_r($dataJWT);
        // $dataJWT['message']['email'];
        $email = $dataJWT['message']['data']->email;
        // print_r($email);
    }
    // if ($dataJWT['status']) {
    // }
}

// function jwtDecode($jwt)
// {
//     global $key;

//     try {
//         // decode token ให้เป็นข้อมูล user
//         $payload = JWT::decode($jwt, new Key($key, 'HS256'));
//         return ["status" => true, "message" => (array)$payload];
//     } catch (Exception $e) {   //กรณี Token ไม่ถูกต้องจะ return false
//         // echo $e;
//         return ["status" => false, "message" => $e->getMessage()];
//         // return false;
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta data -->
    <?php include_once('../includes/meta.php'); ?>
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
    <title>Reset Password ผู้ดูแลระบบ | <?php echo $shopName; ?></title>
    <!-- Favicons -->
    <?php include_once('../../includes/pagesFavicons.php'); ?>
    <!-- stylesheet -->
    <?php include_once('../../includes/pagesStylesheet.php'); ?>
    <link rel="stylesheet" href="../../assets/css/inputGroup.css?<?php echo time(); ?>">
</head>

<body>
    <div class="bg">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6">
                    <?php if ($dataJWT['status']) { ?>
                        <div class="card shadow p-3">
                            <div class="card-header">
                                <h3 class="text-center font-weight-bold"><?php echo $shopName; ?></h3>
                            </div>
                            <div class="card-body">
                                <h4 class="m-0 text-dark text-center">Reset Password</h4>
                                <form id="formData" style="font-size: 1.25rem; margin-top: 24px;">
                                    <input type="hidden" class="form-control" name="token" id="token" value="<?php echo $token; ?>" required>
                                    <input type="hidden" class="form-control" name="email" id="email" value="<?php echo $email ?>" autocomplete="off" placeholder="email" required>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="input" required type="text" id="_email" name="_email" value="<?php echo $email ?>" autocomplete="off" required disabled>
                                            <!-- <label class="label" for="_email">&ensp;E-mail ผู้ใช้งาน&ensp;</label> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="input" required type="password" id="passwordNew" name="passwordNew" value="" autocomplete="off" required>
                                            <label class="label" for="passwordNew">&ensp;รหัสผ่าน&ensp;</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="input" required type="password" id="passwordConfirm" name="passwordConfirm" value="" autocomplete="off" required>
                                            <label class="label" for="passwordConfirm">&ensp;ยืนยันรหัสผ่าน&ensp;</label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="../../login.php" class="btn btn-secondary">ยกเลิก</a>
                                        <button type="submit" class="btn btn-primary" name="submit">ส่งข้อมูล</button>
                                    </div>
                                    <!-- <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary" name="submit">ส่งข้อมูล</button>
                            </div> -->
                                </form>
                            </div>
                            <footer class="text-secondary text-center">
                            </footer>
                        </div>
                    <?php } else { ?>
                        <div class="card shadow p-3">
                            <div class="card-header">
                                <h3 class="text-center font-weight-bold"><?php echo $shopName; ?></h3>
                            </div>
                            <div class="card-body">
                                <h4 class="m-0 text-dark text-center">Reset Password</h4>
                                <h4 class="m-0 mt-4 text-dark text-center text-red"><?php echo $dataJWT['message']; ?></h4>
                            </div>
                            <footer class="text-secondary text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="../../login.php" class="btn btn-secondary">ยกเลิก</a>
                                    <!-- <button type="submit" class="btn btn-primary" name="submit">ส่งข้อมูล</button> -->
                                </div>
                            </footer>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <?php include_once('../../includes/loading.php') ?>
    </div>
    <!-- SCRIPTS -->
    <?php include_once('../../includes/pagesScript.php') ?>
    <?php include_once('../../includes/myScript.php') ?>

    <script>
        $(document).ready(function() {
            $("body").removeClass("dark-mode");
            loaderScreen("hide");
            $('#formData').on('submit', function(e) {
                e.preventDefault();
                // alert($("#passwordNew").val() + " : " + $("#passwordConfirm").val() );
                if ($("#passwordNew").val() != $("#passwordConfirm").val()) {
                    Swal.fire({
                        text: 'เกิดข้อผิดพลาด : รหัสผ่านใหม่ไม่ตรงกัน',
                        icon: 'warning',
                        confirmButtonText: 'ตกลง',
                    });
                } else {
                    loaderScreen("show");
                    $.ajax({
                        type: 'POST',
                        url: 'service/resetPassword.php',
                        data: new FormData(this),
                        cache: false,
                        contentType: false,
                        processData: false,
                        method: 'POST'
                    }).done(function(resp) {
                        loaderScreen("hide");
                        if (resp.status) {
                            Swal.fire({
                                text: 'แก้ไข้ข้อมูลเรียบร้อย',
                                icon: 'success',
                                timer: 1500,
                                confirmButtonText: 'ตกลง',
                            }).then((result) => {
                                location.assign('../logout.php');
                            });
                        } else {
                            Swal.fire({
                                text: 'เกิดข้อผิดพลาด : ' + resp.message,
                                icon: 'warning',
                                confirmButtonText: 'ตกลง',
                            });
                        }
                    }).fail(function(resp) {
                        loaderScreen("hide");
                        Swal.fire({
                            text: 'เกิดข้อผิดพลาด : ' + resp.message,
                            icon: 'warning',
                            confirmButtonText: 'ตกลง',
                        });
                    })
                }
            });
        });
    </script>

</body>

</html>