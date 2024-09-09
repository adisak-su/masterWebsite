<?php
require_once('../authen.php');
require_once("../../service/configData.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta data -->
    <?php include_once('../includes/meta.php'); ?>
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
    <title>เปลี่ยน Password ผู้ดูแลระบบ | <?php echo $shopName; ?></title>
    <!-- Favicons -->
    <?php include_once('../../includes/pagesFavicons.php'); ?>
    <!-- stylesheet -->
    <?php include_once('../../includes/pagesStylesheet.php'); ?>

</head>

<body class="hold-transition sidebar-mini dark-mode">
    <div class="wrapper">
        <?php include_once('../includes/sidebar.php') ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5 class="m-0 text-dark">เปลี่ยน Password ผู้ใช้งาน</h5>
                        </div>
                        <!-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">ผู้ดูแลระบบ</a></li>
                                <li class="breadcrumb-item active">เพิ่มข้อมูล</li>
                            </ol>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <!--
                                <div class="card-header">
                                    <h3 class="card-title" style="line-height: 2.1rem;">เพิ่มผู้ดูแล</h3>
                                    <a href="index.php" class="btn btn-warning float-right">กลับ</a>
                                </div>
                                -->
                                <form id="formData" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-row">

                                            <input type="hidden" class="form-control" name="adminID" id="adminID" value="<?php echo $_SESSION['adminID']; ?>" placeholder="ชื่อจริง" required>
                                            <div class="form-group col-sm-6">
                                                <label for="email">Email ผู้ใช้งาน</label>
                                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" placeholder="email ผู้ใช้งาน" required>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="password">รหัสผ่าน</label>
                                                <input type="password" class="form-control" name="password" id="password" value="" placeholder="รหัสผ่าน" required>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="passwordNew">รหัสผ่านใหม่</label>
                                                <input type="password" class="form-control" name="passwordNew" id="passwordNew" value="" placeholder="รหัสผ่าน" required>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="passwordConfirm">ยืนยันรหัสผ่านใหม่</label>
                                                <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm" value="" placeholder="รหัสผ่าน" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('../includes/footer.php') ?>
        <?php include_once('../../includes/loading.php') ?>

    </div>
    <!-- SCRIPTS -->
    <?php include_once('../../includes/pagesScript.php') ?>
    <?php include_once('../../includes/myScript.php') ?>

    <script>
        $(document).ready(function() {
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
                        url: 'service/updatePassword.php',
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