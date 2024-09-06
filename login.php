<?php
require_once("service/configData.php");
session_start(); //ประกาศ การใช้งาน session
session_destroy(); // ลบตัวแปร session ทั้งหมด
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login || <?php echo $shopName; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicons -->

    <?php include_once('favicons.php'); ?>
    <?php include_once('startScreen.php'); ?>

    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/inputGroup.css?<?php echo time(); ?>">

    <style>
    </style>
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
                        <form id="formData" style="font-size: 1.25rem;">
                            <div class="card-body" style="border-bottom:1px solid rgba(0,0,0,.125)">

                                <!-- <div class="form-group">
                                <div class="input-group">
                                    <input class="input" required type="text" id="username" name="username" value="admin">
                                    <label class="label" for="username">&ensp;ชื่อผู้ใช้&ensp;</label>
                                </div>
                            </div> -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="input" required type="email" id="email" name="email" value="adisak.55555@gmail.com">
                                        <label class="label" for="email">&ensp;Email&ensp;</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="input" required type="password" id="password" name="password" value="1234">
                                        <label class="label" for="password">&ensp;รหัสผ่าน&ensp;</label>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button name="submit" class="btn btn-primary btn-block" style="max-width:50%" type="submit" name="LoginBT" id="LoginBT">เข้าสู่ระบบ</button>
                                    <a href="adminPages/managerPassword/index_forget.php">ลืมรหัสผ่าน</a>
                                </div>

                                <!-- <div class="d-flex justify-content-between align-items-center" style="border-top:1px solid rgba(0,0,0,.125)">
                                    <button name="submit" class="btn btn-primary btn-block" style="max-width:50%" type="submit" name="LoginBT" id="LoginBT">เข้าสู่ระบบ</button>
                                    <a href="adminPages/managerPassword/index_forget.php">ลืมรหัสผ่าน</a>
                                </div> -->
                                <!-- <div class="d-flex" style="justify-content: center;margin-top:16px;">
                                <button name="submit" class="btn btn-primary btn-block" style="max-width:50%" type="submit" name="LoginBT" id="LoginBT">เข้าสู่ระบบ</button>
                            </div> -->
                            </div>
                            <footer class="text-secondary text-center">
                                <!-- <div class="d-flex justify-content-between align-items-center">
                                    <button name="submit" class="btn btn-primary btn-block" style="max-width:50%" type="submit" name="LoginBT" id="LoginBT">เข้าสู่ระบบ</button>
                                    <a href="adminPages/managerPassword/index_forget.php">ลืมรหัสผ่าน</a>
                                </div> -->
                            </footer>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- SCRIPTS -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script src="plugins/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            /**
             * Form Login Ajax
             */
            $("#formData").submit(function(e) {
                e.preventDefault();
                toastr.success('เข้าสู่ระบบเรียบร้อย');
                setTimeout(() => {
                    window.location.href = 'adminPages/dashboard';
                }, 1000);
            });
            // $("#formData").submit(function(e) {
            //     e.preventDefault();

            //     $("#LoginBT").prop('disabled', true);
            //     $.ajax({
            //         type: "POST",
            //         url: "service/login.php",
            //         data: $('#formData').serialize()
            //     }).done(function(resp) {
            //         if (resp.status) {
            //             toastr.success('เข้าสู่ระบบเรียบร้อย');
            //             setTimeout(() => {
            //                 window.location.href = 'index.php'
            //             }, 1000);
            //         } else {
            //             message = `${resp.message}`;
            //             Swal.fire({
            //                 text: message,
            //                 icon: 'error',
            //                 timer: 3000,
            //                 confirmButtonColor: "#D33",
            //                 confirmButtonText: 'ปิด',
            //             });
            //             $("#LoginBT").prop('disabled', false);
            //         }
            //     }).fail(function(error) {
            //         Swal.fire({
            //             text: error.message,
            //             icon: 'error',
            //             timer: 5000,
            //             confirmButtonColor: "#D33",
            //             confirmButtonText: 'ปิด',
            //         });
            //         message = `${error.responseJSON.message}`;
            //         toastr.error(message, {
            //             timeOut: 2000,
            //             closeOnHover: true
            //         });
            //         $("#LoginBT").prop('disabled', false);
            //     })
            // })
        })
    </script>

</body>

</html>