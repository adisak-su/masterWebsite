<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <?php include "../includes/apple-meta.php"; ?>

    <!-- Boxicons -->
    <link href="../../plugins/boxicons/css/boxicons.min.css" rel="stylesheet">
    <script src="../../plugins/boxicons/dist/boxicons.js"></script>

    <link rel="stylesheet" href="../../plugins/jquery-ui/jquery-ui.css">

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
                    <div id="touch" style="width: 100px; height:100px;background-color:brown;">
                    </div>
                    <img id="imgtouch" src="../../assets/image/store.png" style="width: 100px; height:100px;">
                    </img>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../../plugins/jquery/jquery.min.js"></script>

    <script src="../../plugins/jquery-ui/jquery-ui.js"></script>
    <script src="../../assets/js/jquery.ui.touch.js?<?php echo time(); ?>"></script>
    <!-- <script src="../../assets/js/jquery.ui.touch-punch.min.js"></script> -->

    <script src="../includes/scriptSidebar.js?<?php echo time(); ?>"></script>

    <script>
        $('#touch').draggable();
        // $("#imgtouch").draggable();
    </script>
    <!-- <script>$('#imgtouch').draggable();</script> -->


    <script>
        // $( "#touch" ).selectable();
        // $("#touch").simulateMouseEvent();
        function startup() {
            const el = document.getElementById("imgtouch");
            el.addEventListener("touchstart", handleStart);
            el.addEventListener("touchend", handleEnd);
            // el.addEventListener("touchcancel", handleCancel);
            // el.addEventListener("touchmove", handleMove);
            // log("Initialized.");
        }

        function handleStart(event) {
            event.
        }
        function handleEnd(event) {
            
        }

        document.addEventListener("DOMContentLoaded", startup);

    </script>
</body>

</html>