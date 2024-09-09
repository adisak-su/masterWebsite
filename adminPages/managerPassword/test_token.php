<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>


<button onclick="get_token()">Get Token</button>&nbsp;<!-- ปุ่มกดรับ token -->
<button onclick="get_user_data_from_token()">Get User Data From Token</button> 
<!-- ปุ่มกดแปลง token เป็นข้อมูลผู้ใช้ -->
<div id="server_response"></div>

<script>

    var token="";
    var server="service/token.php";//server URL สำหรับรับ token และ decode token

    function get_token()//function สำหรับรับ token
    {
        $.ajax({
            url:server,
            type:"post",
            data:{action:"get_token",user:"MR.robot"},//ส่งข้อมูล user และกำหนด action เป็น get_token
            success:function(response)
            {
                //เก็บ token ไว้ในตัวแปร token
                token=response.trim();
                //แสดง token <div id="server_response"></div>
                $("#server_response").html("<b>Token:</b>"+token);
            }
        });
    }

    function get_user_data_from_token()//function สำหรับดูข้อมูล User จาก token
    {
        $.ajax({
            url:server,
            type:"post",
            data:{action:"get_user",token:token},//ส่งข้อมูล toekn และกำหนด action เป็น get_user
            success:function(response)
            {  
                //แสดงข้อมูล User จาก Token
                $("#server_response").html("<b>User Data:</b>"+response);
            }
        })
    }

</script>
</body>
</html>


