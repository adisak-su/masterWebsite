<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "apple-meta.php"; ?>

    <!-- Boxicons -->
    <!-- <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'> -->
    <link href='plugins/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <script src="plugins/boxicons/dist/boxicons.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="styleRoot.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">

    <title>My Store</title>

</head>

<body>
    <!-- SIDEBAR -->
    <?php include "sidebard.php"; ?>

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <?php include "navbar.php"; ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>My Store</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="index.php">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="assets/js/3.6.0.jquery.min.js"></script>

    <script src="scriptSidebar.js?<?php echo time(); ?>"></script>
    <script>
        
    </script>
</body>

</html>