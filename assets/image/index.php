<?php
require_once("../service/configServer.php");
require_once('common.php');
require_once("commonProducts.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/favicons/shop.webmanifest?<?php echo time(); ?>">
    <link rel="mask-icon" href="../assets/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="../assets/img/favicons/favicon.ico">

    <link rel="stylesheet" href="css/4.6.2-bootstrap.min.css">
    <link rel='stylesheet' href='css/uicons-bold-rounded.css'>
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="autoWord.css">
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="root.css?<?php echo time(); ?>">

    <style>
        @media (min-width: 414px) {

            /* iPhone */
            .grid-container1 {
                display: grid;
                grid-template-columns: 33% 33% 33%;
            }
        }

        @media (min-width: 736px) {

            /* iPhone */
            .grid-container1 {
                display: grid;
                grid-template-columns: 25% 25% 25% 25%;
            }
        }

        #iframTable {
            width: var(--iframeTable-width);
            max-width: var(--iframeTable-width);
            height: var(--iframeTable-height);
            max-height: var(--iframeTable-height);
        }

        #iframeData {
            width: var(--iframeData-width);
            max-width: var(--iframeData-width);
            height: var(--iframeData-height);
            max-height: var(--iframeData-height);
        }

        body {
            margin-top: var(--body-top);
            margin-bottom: var(--body-bottom);
            height: var(--body-height);
        }

        /* styles.css */
        /* CSS */
        .button-71 {
            /* background-color: #0078d0; */
            border: 0;
            border-radius: 56px;
            /* color: #fff; */
            cursor: pointer;
            display: inline-block;
            /* font-family: system-ui,-apple-system,system-ui,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",sans-serif;
        font-size: 18px; */
            font-weight: 600;
            outline: 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: all .3s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-71:before {
            background-color: initial;
            background-image: linear-gradient(#fff 0, rgba(255, 255, 255, 0) 100%);
            /* border-radius: 125px; */
            border-radius: 125px 125px 0px 0px;
            content: "";
            height: 50%;
            left: 5%;
            opacity: .5;
            position: absolute;
            top: 0;
            transition: all .3s;
            width: 95%;
        }

        .button-71:hover {
            box-shadow: rgba(255, 255, 255, .2) 0 3px 15px inset, rgba(0, 0, 0, .1) 0 3px 5px, rgba(0, 0, 0, .1) 0 10px 13px;
            transform: scale(1.05);
        }

        .button-71 {
            padding-left: 16px;
            padding-right: 16px;
            /* min-width: 100%;
            max-width: 100%; */
            width: 100%;
        }

        .btn1 {
            border: 0;
            border-radius: 56px;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-weight: 800;
            outline: 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: all .3s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        img .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .btn:hover {
            box-shadow: rgba(255, 255, 255, .2) 0 3px 15px inset, rgba(0, 0, 0, .1) 0 3px 5px, rgba(0, 0, 0, .1) 0 10px 13px;
            transform: scale(1.05);
        }

        .shadow {
            /* box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset; */
            /* box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px; */
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px inset;
        }

        .card {
            border-radius: 10%;
        }
    </style>

    <title><?php echo $shopName; ?></title>
</head>

<body style="background-color:white">
    <div id="loading">
        <img id="loading-image" src="vendor/loader.gif" alt="Loading..." />
    </div>

    <div id="idbody" class="row" style="margin:0px;padding: 0px;background-color:white;">
        <div id="bodyleft" class="col-12" style="background-color:white;">
            <div class="row" id="iframeDataSize" style="padding: 0px;padding-top: 5px;"></div>
            <div class="row responsive-iframeData grid-container" id="iframeData" style="padding-top: 0px;">
                <?php
                foreach ($datas as $data) {
                ?>
                    <div style="padding: 5px;">
                        <div class="card shadow" style="" data-toggle="modal" data-target="#calculatorModal" data-name="<?php echo $data["name"]; ?>" data-id="<?php echo $data["id"]; ?>" data-image="<?php echo $data["image"]; ?>" data-idmode="add">

                            <img class="card-img-top" style="border-radius: 10%;" src="<?php echo $data["image"]; ?>" width=100% alt="<?php echo $data["name"]; ?>">

                            <div class="card-footer bg-transparent text-center myfontsizecard string-clip" style="padding:0px;border:0px;"><?php echo $data["name"]; ?></div>
                        </div>
                    </div>
                <?php } ?>
                <div style="padding: 5px;">
                    <div id="otherID" class="card shadow" style="" data-toggle="modal" data-target="#calculatorModal" data-name="<?php echo $otherProduct["name"]; ?>" data-id="<?php echo $otherProduct["id"]; ?>" data-image="<?php echo $otherProduct["image"]; ?>" data-idmode="add">
                        <img class="card-img-top" style="border-radius: 10%;" src="<?php echo $otherProduct["image"]; ?>" width=100% alt="อื่นๆ">
                        <div class="card-footer bg-transparent text-center myfontsizecard" style="padding:0px;border:0px;">อื่นๆ</div>
                    </div>
                </div>


            </div>
        </div>
        <div id="bodyright" class="col-12 display-screen" style="background-color:white;">
            <div class="row bg-while" id="iframeTableSize" style="padding: 0px; padding-top: 5px;"></div>
            <div id="iframTable" class="row responsive-iframe bg-white" style="padding-right: 0px; display:inline-block;">
                <div class='row' style='padding:5px; margin-left:0px; margin-right:0px; justify-content: space-between;'>
                    <div><button id="btnTableDecSize" class="btn btn-primary button-71" style="padding:0px; width:40px;height:40px;" onclick="tableDecSize();"><i class="fa fa-2x fa-minus"></i></button></div>
                    <div><button id="btnTableIncSize" class="btn btn-primary button-71" style="padding:0px; width:40px;height:40px;" onclick="tableIncSize();"><i class="fa fa-2x fa-plus"></i></button></div>
                </div>
                <table id="tableProduct" width="100%" class="font-list tableSize">
                    <thead>
                        <tr class="border-line" style="background-color:lightblue;">
                            <th style='padding:5px;' width=100%>
                                <div class='row' style='padding-left:5px; padding-right:5px; margin-left:0px; margin-right:0px; justify-content: space-between;'>
                                    <div>รายการ</div>
                                    <div>ราคา</div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="bodyList">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- header -->
    <?php //showHeader(); 
    ?>
    <?php showHeaderLine(); ?>


    <!-- footer -->
    <?php showFooter(""); ?>

    <!-- Modal confirmModal -->
    <?php //showConfirmModal("confirmStartModal", "เริ่มการขายใหม่ ?", "startSale();"); 
    ?>
    <?php //showConfirmModal("confirmSaveModal", "ยืนยันการบันทึกข้อมูล ?", "saveDataSale();"); 
    ?>

    <?php showConfirmModal("confirmStartModal", "เริ่มการขายใหม่ ?", "startSale();", "btn-success", "ใช่! เริ่มขายใหม่"); ?>

    <?php showConfirmModal("confirmSaveModal", "ยืนยันการบันทึกข้อมูล ?", "saveDataSale();", "btn-success", "ใช่! บันทึกเลย"); ?>

    <!-- Modal Toast -->
    <?php showToast(); ?>

    <!-- Modal -->
    <?php showCalculatorModal(); ?>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->

    <script src="js/3.3.1.jquery.min.js"></script>
    <script src="js/4.6.2.bootstrap.bundle.min.js"></script>

    <script src="autoWord.js?<?php echo time(); ?>"></script>

    <script src="common.js?<?php echo time(); ?>"></script>
    <script src="commonNoQty.js?<?php echo time(); ?>"></script>

    <script src="inputfit.js?1234"></script>

    <script>
        var r = document.querySelector(':root');
        $("#loading").hide();

        // function saveDB() {
        //     alert("saveDB");
        // }

        cardSize = $('.myfontsizecard').css('font-size')
        tableSize = $('.tableSize').css('font-size');
        frameLeft = 9;
        scaleSize = 4;

        setCalculatorModal();
        clearCalculatorModal();
        getAutoWord();

        //alert($('#header').css('top'));
        var htmlFixedHeader = $('#header').css('top');

        $(window).on("orientationchange", function() {
            setTimeout(function() {
                setFrame();
            }, 500);
        });

        window.addEventListener("pageshow", function(event) {
            var historyTraversal = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
            if (historyTraversal) {
                // Handle page restore.
                getLocalStorage();
                setSale();
            }
        });

        $(document).ready(function() {
            $("*").dblclick(function(e) {
                //e.preventDefault();
            });
            //alert("width:"+screen.width+" height:"+screen.height);

            //      checkOS();
            OS = checkPlatform();
            if (OS != "Android") {
                $("#realtime").hide();
            }

            getLocalStorage();
            if (!products) {
                startSale();
            }
            setSale();
            setFrame();
            setTableSize();

            $("#loading").hide();
        });

        function setFrame() {
            heightScreen = (window.innerHeight > 0) ? window.innerHeight : screen.height;
            widthScreen = (window.innerWidth > 0) ? window.innerWidth : screen.width;

            heightHeader = $('#header').outerHeight(true);
            heightFooter = $('#footer').outerHeight(true);
            heightIdbody = heightScreen;

            height = heightScreen - heightHeader - heightFooter - 5;

            var position = $('#footer').position().top;

            var heightHeader = $('#header').outerHeight(true);
            var heightFooter = $('#footer').outerHeight(true) + 10;
            r.style.setProperty('--body-top', heightHeader + "px");
            r.style.setProperty('--body-bottom', heightFooter + "px");
            r.style.setProperty('--body-height', heightIdbody + "px");

            // $('#idbody').css({
            //     'padding-top': $('#header').outerHeight(true),
            //     'padding-bottom': $('#footer').outerHeight(true),
            //     'height': heightIdbody,
            //     // 'zindex': 0,
            // });
            width = $('#iframeTableSize').outerWidth(true) + 25;
            r.style.setProperty('--iframeTable-width', width + "px");
            r.style.setProperty('--iframeTable-height', height + "px");


            // $('#iframTable').css({
            //     'width': width,
            //     'height': height,
            //     'max-height': height
            // });
            width = $('#iframeDataSize').outerWidth(true) + 30;
            r.style.setProperty('--iframeData-width', width + "px");
            r.style.setProperty('--iframeData-height', height + "px");
            // $('#iframeData').css({
            //     'width': width,
            //     'max-width': width,
            //     'height': height,
            //     'max-height': height
            // });

            /*
            inputFontSize = $('#delPrice').css('font-size');
            //alert(inputFontSize);
            $('#price').css('font-size', inputFontSize);
            setFontPrice("");
            setFontPrice(priceText);
            $('.input-container').css('height', $('#delPrice').css('height'));
            $('#backspace').css('max-height', $('#delPrice').css('height'));
            */
            //alert(1);
        }

        function change() {
            if (countProduct == 0) {
                showToast("ยังไม่มีรายการสินค้า!!!");
                return;
            }
            changeToProduct();
        }

        function showTableProduct() {
            myhtml = "";
            for (i = 0; i < products.length; i++) {
                if (products[i]) {
                    prod = products[i];

                    button = '<button class=" btn-primary btn-block" style="padding:0px; border: none;" data-toggle="modal" data-target="#calculatorModal" data-name="' + prod.name + '" data-id="' + prod.id + '" data-price="' + prod.price + '" data-idmode="edit">';

                    myhtml += "<tr class='border-line text-white bg-primary'>";

                    myhtml += "<td width=100%>";
                    myhtml += button;

                    myhtml += "<div class='row' style='padding-left:5px; padding-right:5px; margin-left:0px; margin-right:0px; justify-content: space-between;'>"
                    myhtml += "<div class='text-left' style='max-width:75%'>" + prod.name + "</div>";
                    myhtml += "<div style='margin-left: auto; margin-right: 0;'><div>" + prod.price + "</div></div>";
                    myhtml += "</div>";

                    myhtml += "</button>";
                    myhtml += "</td></tr>";
                }
            }

            resize = `<div class='row' style='padding:5px; margin-left:0px; margin-right:0px; justify-content: space-between;'>
                    <div><button id="btnFrameIncSize" class='btn btn-primary button-71' style='padding:0px;width:40px;height:40px;' onclick='frameIncSize();'><i class='fa fa-2x fa-angle-double-left'></i></button></div>
                    <div><button id="btnFrameDecSize" class='btn btn-primary button-71' style='padding:0px;width:40px;height:40px;' onclick='frameDecSize();'><i class='fa fa-2x fa-angle-double-right'></i></button></div>
                </div>`;

            myhtml += "<tr style='background-color:lightblue;'><td>" + resize + "</td></tr>";

            //myhtml += "<tr style='background-color:lightblue;'><td>&nbsp;</td></tr>";
            $("#bodyList").html(myhtml);
        }
    </script>
</body>
</html>