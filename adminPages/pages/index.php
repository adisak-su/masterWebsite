<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <?php include "../includes/apple-meta.php"; ?>

    <!-- Boxicons -->
    <link href="../../plugins/boxicons/css/boxicons.min.css" rel="stylesheet">
    <script src="../../plugins/boxicons/dist/boxicons.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="../includes/styleRoot.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">

    <title>AdminHub</title>

</head>

<body>
    <!-- SIDEBAR -->
    <?php include "../includes/sidebard.php"; ?>

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <?php include "../includes/navbar.php"; ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>My Store</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">My Store</a>
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

    <script src="../../plugins/jquery/jquery.min.js"></script>

    <script src="../includes/scriptSidebar.js?<?php echo time(); ?>"></script>
    <script>
        
    </script>
</body>

</html>