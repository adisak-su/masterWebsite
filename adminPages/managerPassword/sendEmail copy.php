<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL ^ E_NOTICE);
require("class.phpmailer.php");

require_once('../models/connectDB.php');

$checkListName = "";
$checkListAreaName = "";
$checkListAreaID = "";
$checkListID = "";
$homeID = "";
$home = "";

if (!isset($_REQUEST['homeID']) || !isset($_REQUEST['checkListID']) || !isset($_REQUEST['checkListName'])) {
    exit;
}
if (isset($_REQUEST['homeID'])) {
    $homeID = $_REQUEST['homeID'];
    $home = getHomeByID($homeID);
}
if (isset($_REQUEST['checkListID'])) {
    $checkListID = $_REQUEST['checkListID'];
}
if (isset($_REQUEST['checkListName'])) {
    $checkListName = $_REQUEST['checkListName'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CKHome - Send Email</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Script for waitingDialog -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" />
    <script src="../bootstrap/js/jquery.min.js"></script>
  	<script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="build/bootstrap-waitingfor.js"></script>

    <script>
        function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds){
                break;
                }
            }
        }
    function sendMessage() {
        waitingDialog.show('Loading Process ...');
        sleep(500);
        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
        else {
                // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        homeID = document.getElementById('homeID').value;
        checkListID = document.getElementById('checkListID').value;
        checkListName = document.getElementById('checkListName').value;
        email = document.getElementById('email').value;
        message = document.getElementById('message').value;
        
        message = message.replace(new RegExp(" ", 'g'),":*:");
        
        //message = JSON.stringify(message);
        
        /*
        tmpparams = {
            homeID : document.getElementById('homeID').value,
            checkListID : document.getElementById('checkListID').value,
            checkListName : document.getElementById('checkListName').value,
            email : document.getElementById('email').value,
            message : message
        }
        */
        
        tmpparams = {
            homeID : homeID,
            checkListID : checkListID,
            checkListName : checkListName,
            email : email,
            message : message
        }
        



//        alert(message);
        
        
//    var newline = String.fromCharCode(13, 10);
//    alert(message.search('\\n'));
    
//    message = message.replace(new RegExp('\\n','g'), newline);
    
//        alert(message);

        url = "sendEmail_Request.php";
        xmlhttp.onreadystatechange = function() {
            if(xmlhttp.readyState == 4){
                if(xmlhttp.status == 200)  {
                    if (xmlhttp.responseText=="OK"){
                        alert("ส่งไปยัง mail เรียบร้อยแล้ว");
                        waitingDialog.hide();
                    }
                    else{
                        alert(xmlhttp.responseText);
                        waitingDialog.hide();
                    }
                }
                else{
                    alert(xmlhttp.statusText);
                    waitingDialog.hide();
                }
                waitingDialog.hide();
            }
        };
        // message = JSON.stringify(message);
        // url = url+"?homeID="+homeID+"&checkListID="+checkListID+"&checkListName="+checkListName+"&email="+email+"&message="+message;
        // xmlhttp.open("GET",url+"?homeID="+homeID+"&checkListID="+checkListID+"&checkListName="+checkListName+"&email="+email+"&message="+message,true);
        // xmlhttp.send(null);

        xmlhttp.open('POST', 'sendEmail_Request.php');
        xmlhttp.setRequestHeader('Content-type', 'application/json');
        xmlhttp.send(JSON.stringify(tmpparams)); // Make sure to stringify
        xmlhttp.onload = function() {
            // Do whatever with response
          //   alert(xmlhttp.responseText);
          // waitingDialog.hide();
        }

    }

    </script>
</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">
                ข้อมูลบ้าน
            </div>

            <div class="card-body">
                <form name="photo" enctype="multipart/form-data" action="sendEmail_Request_old.php" method="post">
                    <input type="hidden" id="homeID" name="homeID" value=<?php echo $homeID; ?>>
                    <input type="hidden" id="checkListID" name="checkListID" value=<?php echo $checkListID; ?>>
                    <input type="hidden" id="checkListName" name="checkListName" value=<?php echo $checkListName; ?>>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="Owner" class="form-control" placeholder="Owner" disabled value='<?php echo $home['Owner']; ?>'>
                            <label for="Owner">ชื่อ-นามสกุล เจ้าของบ้าน</label>
                        </div>
                    </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <div class="form-label-group">
                                    <input type="text" id="Address" class="form-control" placeholder="Address" disabled value='<?php echo $home['Address']; ?>'>
                                    <label for="Address">บ้านเลขที่</label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="form-label-group">
                                    <input type="text" id="Telephone" class="form-control" placeholder="Telephone" disabled value='<?php echo $home['Telephone']; ?>'>
                                    <label for="Telephone">เบอร์โทรศัพท์</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <div class="form-label-group">
                                    <input type="text" id="CheckList" class="form-control" placeholder="การตรวจสอบ" disabled value='<?php echo "การตรวจสอบครั้งที่ " . $checkListName; ?>'>
                                    <label for="CheckList">การตรวจสอบครั้งที่</label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="form-label-group">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="email" email value='<?php echo $home['email']; ?>'>
                                    <label for="email">email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">message:</label>
                            <textarea name="message" id="message" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <a class="btn btn-warning btn-block" href="showCheckListArea.php?homeID=<?php echo $homeID; ?>&checkListID=<?php echo $checkListID; ?>&checkListName=<?php echo $checkListName; ?>&checkListAreaID=<?php echo $checkListAreaID; ?>">ปิด</a>
                            </div>
                            <div class="col-md-4">
                                <!-- <input class="btn btn-info btn-block" type="button" name="sendMail" value="SendMail" onclick="sendMessage();" /> -->
                            </div>
                            <div class="col-md-4 form-group">
                                <input class="btn btn-info btn-block" type="button" name="sendMail" value="SendMail" onclick="sendMessage();" />
                                <!-- <input class="btn btn-info btn-block" type="submit" name="submit" value="SendMail" /> -->
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script>
        function validate_fileupload(uploadField) {
            return true;
            }

function onMessageChange() {
    var key = window.event.keyCode;

    // If the user has pressed enter
    if (key === 13) {
        document.getElementById("message").value = document.getElementById("message").value + "\n*";
        return false;
    }
    else {
        return true;
    }
}

        
        
    </script>

</body>

</html>