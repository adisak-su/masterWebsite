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

    <style>
        .taphold {
            background-color: powderblue;
        }
    </style>

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
                    <div>
                        <button onMouseDown="popupMenu();" onMouseUp="stopTime();">click</button>
                    </div>

                    <div ontouchstart="popupMenu();" ontouchend="stopTime();" style="height: 200px;width: 50%;background-color: powderblue;">
                    </div>
                    <div class="box" style="height: 200px;width: 50%;" ontaphold="divtapholdHandler(this)">
                    </div>
                    <div ontouchstart="popupMenu();" ontouchend="stopTime();" style="height: 200px;width: 50%;background-color: powderblue;">

                        <img src="assets/image/store.png" style="touch-action: none;width:30%" />


                    </div>
                    <div ontouchstart="popupMenu(event);" ontouchend="stopTime();" style="height: 200px;width: 50%;background-color: powderblue;">
                        <img src="assets/image/store.png" style="--webkit-touch-callout: none; width:30%" />
                    </div>

                    <img src="assets/image/store.png" style="width:30%" ontouch="alert('click');"  ontouchstart="popupMenu(event);" ontouchend="stopTime();"  />
                    <img src="assets/image/store.png" style="width:30%" onTouch="alert('onTouch');"  />

                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="assets/js/3.6.0.jquery.min.js"></script>

    <script src="scriptSidebar.js?<?php echo time(); ?>"></script>
    <script>
        let start;

        function popupMenu(event) {

            //alert(1);
            //event = tmp.event();
            event.preventDefault();
            event.stopImmediatePropagation();
            start = setTimeout(function() {
                alert(2);
            }, 3000);
        }

        function stopTime() {
            clearTimeout(start);
        }

        function divtapholdHandler(event) {
            //alert(1);
            //event.preventDefault();
            // event.stopImmediatePropagation();


            $(event.target).addClass("taphold");
        }

        $(function() {
            $("div.box").bind("taphold", tapholdHandler);

            function tapholdHandler(event) {
                //alert(1);
                //event.preventDefault();
                // event.stopImmediatePropagation();


                $(event.target).addClass("taphold");
            }
        });

        $(function() {
            $("img").bind("taphold", tapholdHandler);

            function tapholdHandler(event) {
                alert(1);
                event.preventDefault();
                event.stopImmediatePropagation();


                //$( event.target ).addClass( "taphold" );
            }
        });

        jQuery("img").on("taphold", function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
        })
        jQuery("img").on("ontouchstart", function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
        })
    </script>
</body>

</html>