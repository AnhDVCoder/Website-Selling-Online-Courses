<?php
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');  
    include '../connectdb.php';
    include '../function.php';

    $SQL = "UPDATE quen_mat_khau SET status = 0 WHERE dtime_end < NOW()";
    mysqli_query($connect, $SQL);
    

//PHPMailer
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/new_forgot_css.php">
</head>
<body>
    <div class="wrapper">
        <div class="container">

            <div class="title-section">
                <h2 class="title">Quên mật khẩu ?</h2>
                <!-- <p class="para">Nhập email của bạn :</p> -->
            </div>

            <form action="" method="POST">
                <div class="input-group">
                    <lable class="lable-title">Nhập email của bạn ở đây : </lable>
                    <input type="email" name="email" placeholder="Nhập email...">
                    
                </div>
                <div class="input-group">
                    <button class="submit-btn" name="send" type="submit">Gửi mã</button>
                </div>
                <div class="input-group">
                    <lable class="lable-title">Nhập code nhận được ở đây  : </lable>
                    <input type="text" name="code" placeholder="Nhập code...">
                    
                </div>
                <div class="">
                    <button class="submit-btn" name="confirm" type="submit">xác nhận</button>
                </div>
            </form>
            <div>
                <!-- <a href="">chưa nhận được mã ?</a> -->
                <a href="DN.php">quay lại</a>
            </div>
            

        </div>
    </div>
</body>
</html>

<?php
    $kq = "";
    $flag1 = false;
    $username = "";
    if(isset($_POST['send'])){
        $dtime_start = date('Y-m-d H:i:s');
        $i = strtotime("+10 minutes");
        $dtime_end = date('Y-m-d H:i:s', $i);
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            if(trim($email) == ""){
                // $kq .= "Bạn chưa nhập Email!";
                echo "
                    <script>
                        function myFunction() {
                        alert('Bạn chưa nhập Email!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // $kq .= "Email không hợp lệ!";
                echo "
                    <script>
                        function myFunction() {
                        alert('Email không hợp lệ!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";
                $flag1 = false;
            }
            else{
                $SQL = "SELECT email FROM information WHERE email = '".$email."'";
                $check = mysqli_query($connect, $SQL);
                if(mysqli_num_rows($check) == 0){
                    // $kq .= "Email này không tồn tại!";
                    echo "
                    <script>
                        function myFunction() {
                        alert('Email này không tồn tại!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";
                    $flag1 = false;
                }
                else{
                    $flag1 = true;
                    
                }
            }
        }

        if($flag1 == true){
            $SQL = "SELECT username FROM information WHERE email ='".$email."'";
            $DL = mysqli_query($connect, $SQL);
            $listDL = mysqli_fetch_assoc($DL);
            $username = $listDL['username'];
            $code = rand(100000,999999);

            $SQL = "INSERT INTO quen_mat_khau (email, username, code, dtime_start, dtime_end, status) VALUES('".$email."', '".$username."', '".$code."', '".$dtime_start."', '".$dtime_end."', 1)";
            $insert = mysqli_query($connect, $SQL);
            if(!quenMatKhau($connect, $email, $code)){
                // echo "Không gửi được mã xác thực!";
                echo "
                    <script>
                        function myFunction() {
                        alert('Đã gửi mã xác thực!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";
            }
            else{
                echo "
                    <script>
                        function myFunction() {
                        alert('Không gửi được mã xác thực! Vui lòng kiểm tra lại!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";
            }
            
        }


        
        
        $flag2 = false;

        if($flag2 == true){
            
        }
        if($flag1 == true){
            
        }
        echo $kq;
        
    }

    if(isset($_POST['confirm'])){
        if(isset($_POST['code']) == NULL){
            // $kq .= "Bạn chưa nhập mã xác nhận!";
            echo "
                <script>
                    function myFunction() {
                    alert('Bạn chưa nhập mã xác nhận!');
                    }
                </script>
                <body onload='myFunction()'></body>";
            $Cflag1 = false;
        }
        elseif(strlen($_POST['code']) != 6){
            // $kq .= "Mã xác nhận không hợp lệ!";
            echo "
                <script>
                    function myFunction() {
                    alert('Mã xác nhận không hợp lệ!');
                    }
                </script>
                <body onload='myFunction()'></body>";
            $Cflag1 = false;
        }
        else{
            $code = $_POST['code'];
            $Cflag1 = true;
        }


        if (isset($_POST['email']) == "") {
            // $kq .= "Email không được để trống!";
            echo "
                <script>
                    function myFunction() {
                    alert('Email không được để trống!');
                    }
                </script>
                <body onload='myFunction()'></body>";
            $Cflag2 = false;
        }
        elseif (!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
            // $kq .= "Email không hợp lệ!";
            echo "
                <script>
                    function myFunction() {
                    alert('Email không hợp lệ!');
                    }
                </script>
                <body onload='myFunction()'></body>";
            $Cflag2 = false;
        }
        else{
            $email = $_POST['email'];
            $SQL = "SELECT email FROM information WHERE email = '".$email."'";
            $check = mysqli_query($connect, $SQL);
            if(mysqli_num_rows($check) == 0){
                // $kq .= "Email này không tồn tại!";
                echo "
                    <script>
                        function myFunction() {
                        alert('Email này không tồn tại!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";
                $Cflag2 = false;
            }
            else{
                $Cflag2 = true;
            }
        }

        $SQL = "SELECT COUNT(dtime_start) AS count FROM quen_mat_khau WHERE DATE(dtime_start) = '".date('Y-m-d')."' AND email = '".$email."'";
        $DL = mysqli_query($connect, $SQL);
        if(mysqli_num_rows($DL) > 0){
            $listDL = mysqli_fetch_assoc($DL);
            $count = $listDL['count'];
            if($count > 5){
                // $kq .= "Bạn đã yêu cầu quên mật khẩu quá số lần trong hôm nay! Vui lòng thử lại tiếp vào ngày mai!";
                echo "
                    <script>
                        function myFunction() {
                        alert('Bạn đã yêu cầu quên mật khẩu quá số lần trong hôm nay! Vui lòng thử lại tiếp vào ngày mai!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";
            }
        }



        if($Cflag1 == true && $Cflag2 == true){
            $SQL = "SELECT code, dtime_start FROM quen_mat_khau WHERE email = '".$email."' AND status = 1 ORDER BY dtime_start DESC LIMIT 1";
            $DL = mysqli_query($connect, $SQL);
            if(mysqli_num_rows($DL) == 0){
                // $kq .= "Tài khoản này chưa gửi yêu cầu quên mật khẩu!";
                echo "
                    <script>
                        function myFunction() {
                        alert('Tài khoản này chưa gửi yêu cầu quên mật khẩu!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";

            }
            else{
                $listDL = mysqli_fetch_assoc($DL);
                $DBcode = $listDL['code'];
                $DBtime = $listDL['dtime'];
                if($code != $DBcode){
                    // $kq .= "Mã xác nhận không đúng!";
                    echo "
                    <script>
                        function myFunction() {
                        alert('Mã xác nhận không đúng!');
                        }
                    </script>
                    <body onload='myFunction()'></body>";
                }
                else{
                    $SQL = "UPDATE quen_mat_khau SET status = 0 WHERE email = '".$email."'";
                    mysqli_query($connect, $SQL);
                    $SQL = "SELECT username FROM information WHERE email = '".$email."'";
                    $DL = mysqli_query($connect, $SQL);
                    $listDL = mysqli_fetch_assoc($DL);
                    $username = $listDL['username'];
                    $_SESSION['usernameRP'] = $username;
                    header("location: reset_mat_khau.php");
                }
            }
        }   
        
        echo $kq;
    }
?>
<script type="text/javascript">
    function test() {
        alert("Test");
    }
</script>