<?php
    session_start();
    include '../connectdb.php';
    if (!isset($_SESSION['usernameRP'])) {
        header("location: DN.php");
    }
    else{
        $username = $_SESSION['username'];
    }
    // $username = "user8";

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
                <h2 class="title">Đổi mật khẩu </h2>    
                <!-- <p class="para">Nhập email của bạn :</p> -->
            </div>

            <form action="" method="POST">
                <div class="input-group">
                    <lable class="lable-title">Nhập mật khẩu của bạn ở đây : </lable>   
                    <input type="password" name="password1" placeholder="Nhập mật khẩu...">
                    
                </div>
                <!-- <div class="input-group">
                    <button class="submit-btn" type="submit">Gửi mã</button>
                </div> -->
                <div class="input-group">
                    <lable class="lable-title">Nhập lại mật khẩu được ở đây  : </lable>
                    <input type="password" name="password2" placeholder="Nhập lại mật khẩu...">
                    
                </div>
                <div class="input-group">
                    <button class="submit-btn" name="submit" type="submit" >xác nhận</button>
                </div>
            </form>
            <!-- <div>
                <a href="">chưa nhận được mã ?</a>
                <a href="">quay lại</a>
            </div>
             -->

        </div>
    </div>
</body>
</html>

<?php
    // echo "test";
    $kq = "";
    if(isset($_POST['submit'])){
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if ($password1 == "" || $password2 == "") {
            // $kq .= "Vui lòng điền đầy đủ mật khẩu!";
            echo "
            <script>
                function myFunction() {
                alert('Vui lòng điền đầy đủ mật khẩu!');
                }
            </script>
            <body onload='myFunction()'></body>";
            $flag1 = false;
        }
        elseif (strlen($password1) < 8 || strlen($password2) < 8) {
            // $kq .= "Mật khẩu phải dài từ 8 ký tự trở lên!";
            $flag1 = false;
            echo "
            <script>
                function myFunction() {
                alert('Mật khẩu phải dài từ 8 ký tự trở lên!');
                }
            </script>
            <body onload='myFunction()'></body>";
        }
        elseif ($password1 != $password2) {
            // $kq .= "Vui lòng điền mật khẩu khớp nhau!";
            $flag1 = false;
            echo "
            <script>
                function myFunction() {
                alert('Vui lòng điền mật khẩu khớp nhau!');
                }
            </script>
            <body onload='myFunction()'></body>";
        }
        else{
            $flag1 = true;
            $SQL = "UPDATE information SET password = '".$password1."' WHERE username = '".$username."'";
            mysqli_query($connect, $SQL);
            // echo "Đổi mật khẩu thành công!";
            echo "
            <script>
                function myFunction() {
                alert('Đổi mật khẩu thành công!');
                }
            </script>
            <body onload='myFunction()'></body>";
            
            sleep(10);
            header("location: DN.php");
        }
        echo $kq;




    }

?>
<script type="text/javascript">
    function test() {
        alert("Test");
    }
</script>