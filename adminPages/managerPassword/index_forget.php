<?php
// require_once('../authen.php');
require_once("../../service/configData.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta data -->
    <?php // include_once('../includes/meta.php'); ?>
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
    <title>Forget Password ผู้ดูแลระบบ | <?php echo $shopName; ?></title>
    <!-- Favicons -->
    <?php // include_once('../../includes/pagesFavicons.php'); ?>
    <!-- stylesheet -->
    
    <?php // include_once('../../includes/pagesStylesheet.php'); ?>


    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/favicons/favicon-32x32.png">

    <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap-4.min.css">
    <!-- <link rel="stylesheet" href="../../plugins/bootstrap-toggle/bootstrap-toggle.min.css"> -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/css/loading.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../../assets/css/style.css?<?php echo time(); ?>">

    <link rel="stylesheet" href="../../assets/css/inputGroup.css">

</head>

<body>
    <div class="bg">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow p-3">
                        <div class="card-header">
                            <h3 class="text-center font-weight-bold"><?php echo $shopName; ?></h3>
                        </div>
                        <div class="card-body">
                            <h4 class="m-0 text-dark text-center">Forget Password</h4>
                            <form id="formData" style="font-size: 1.25rem; margin-top: 24px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="input" required type="email" id="email" name="email" value="adisak.55555@gmail.com" autocomplete="off" required>
                                        <label class="label" for="email">&ensp;E-mail ผู้ใช้งาน&ensp;</label>
                                    </div>
                                    <label id="validate_email" style="display:none;color:red;"></label>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="../../login.php" class="btn btn-secondary">ยกเลิก</a>
                                    <button id="btnSend" type="submit" class="btn btn-primary" name="submit">ส่งข้อมูล</button>
                                </div>
                            </form>
                        </div>
                        <footer class="text-secondary text-center">
                        </footer>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once("../../assets/php/loading.php") ?>
    </div>
    <!-- SCRIPTS -->
    <?php // include_once('../../includes/pagesScript.php') ?>
    <?php // include_once('../../includes/myScript.php') ?>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/js/validateEmail.js?<?php echo time(); ?>"></script>
    <script src="../../assets/js/common.js?<?php echo time(); ?>"></script>

    <script>
        $('#email').validateEmail({
            validate: "validate_email",
            id_button:"btnSend",
        })

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
                    // e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: 'service/forgetPassword.php',
                        data: new FormData(this),
                        cache: false,
                        contentType: false,
                        processData: false,
                        method: 'POST'
                    }).done(function(resp) {
                        loaderScreen("hide");
                        if (resp.status) {
                            if (resp.message === "Send Mail") {
                                Swal.fire({
                                    // text: resp.message,
                                    text: 'ระบบได้ทำการส่งเมล์เรียบร้อย ผู้ใช้สามารถตั้งค่ารหัสผ่านใหม่ได้เลย',
                                    icon: 'success',
                                    timer: 5000,
                                    confirmButtonText: 'ตกลง',
                                }).then((result) => {
                                    location.assign('../../login.php');
                                });
                            } else {
                                Swal.fire({
                                    // text: resp.message,
                                    text: 'ผู้ใช้สามารถตั้งค่ารหัสผ่านใหม่ได้เลย',
                                    icon: 'success',
                                    timer: 1500,
                                    confirmButtonText: 'ตกลง',
                                }).then((result) => {
                                    // location.assign('index_reset.php?email=' + $("#email").val() + '&key=' + resp.message);
                                    location.assign('index_reset.php?token=' + resp.message);
                                });
                            }
                            // Swal.fire({
                            //     // text: resp.message,
                            //     text: 'ผู้ใช้สามารถตั้งค่ารหัสผ่านใหม่ได้เลย',
                            //     icon: 'success',
                            //     timer: 1500,
                            //     confirmButtonText: 'ตกลง',
                            // }).then((result) => {
                            //     location.assign('index_reset.php?email=' + $("#email").val() + '&key=' + resp.message);
                            // });
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