<?php
session_start();
include('../connectdb.php');

if (isset($_SESSION['fullname'])) {
    header("location: khoa_hoc.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/DN_css.php">
  <title>Đăng ký</title>
</head>
<?php
$pattern = "/@/";
$kq_fn = '';
$kq_u = '';
$kq_p = '';
$kq_cfP = '';
$kq_e = '';
if(isset($_POST['DangKy'])){
  $flag_fn = 0;
  $flag_u = 0;
  $flag_p = 0;
  $flag_cfP = 0;
  $flag_e = 0;
  $flag_g = 0;
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cfPassword = $_POST['cfPassword'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  if ($fullname == "") {
    $kq_fn = "Họ và tên không được để trống!";
  }  else {
    $flag_fn = 1;
  }
  $SQL = "SELECT username FROM information WHERE username = '".$username."'";
  $check = mysqli_query($connect, $SQL);
  if ($username == "") {
    $kq_u = "Tên đăng nhập không được để trống!";
  } elseif($username <= 6){
    $kq_u = "Tên đăng nhập phải từ 6 chữ trở lên!";
  }elseif(mysqli_num_rows($check) > 0){
    $kq_u = "Tên đăng nhập đã tồn tại!";
  }
   else {
    $flag_u = 1;
  }
  if ($password == "") {
    $kq_p = "Mật khẩu không được để trống!";
  } elseif($password <= 8){
    $kq_p = "Mật khẩu phải từ 8 chữ trở lên!";
  } else {
    $flag_p = 1;
  }
  if ($cfPassword == "") {
    $kq_cfP = "Nhập lại mật khẩu không được để trống!";
  } elseif($cfPassword != $password){
    $kq_cfP = "Mật khẩu nhập lại không trùng khớp!";
  } else {
    $flag_cfP = 1;
  }
  if ($email == "") {
    $kq_e = "Email không được để trống!";
  } elseif(preg_match($pattern, $email, $matches)){
    $flag_e = 1;
  } else {
    $kq_e = "Email phải có @gmail.com";
  }
  if ($gender != "") {
    $flag_g = 1;
  } 
  if($flag_fn == 1 && $flag_u == 1 && $flag_p == 1 && $flag_cfP == 1 && $flag_e == 1 && $flag_g == 1) {
    $sql = "INSERT INTO information(username, password, fullname, email, gender, permission) VALUE('" . $username . "','" . $password . "','" . $fullname . "','" . $email . "','" . $gender . "','" . 0 . "')";
    if (!mysqli_query($connect, $sql)) {
      echo "Thêm vào bảng thất bại!";
    }
    else{
      header("location: DN.php");
      echo "
            <script>
                function myFunction() {
                alert('Đăng ký thành công!');
                }
            </script>
            <body onload='myFunction()'></body>";

    }
  }
}
?>
<script type="text/javascript">
    function test() {
        alert("Test");
    }
</script>

<body>
  <div class="login">
    <h2 class="nonactive"><a href="./DN.php"> Đăng nhập </a></h2>

    <h2 class="active"> Đăng kí </h2>
    <form action="" method="post">
      <span>Họ và tên</span>
      <?php if($kq_fn != ''){
        echo '<br><br>' . '<span class="error">' . $kq_fn . '</span>';
      } 
      ?>
      <input type="text" class="text" name="fullname">
      <br><br>

      <span>Tên đăng nhập</span>
      <?php if($kq_u != ''){
        echo '<br><br>' . '<span class="error">' . $kq_u . '</span>';
      } 
      ?>
      <input type="text" class="text" name="username">
      <br><br>

      <span>Mật khẩu</span>
      <?php if($kq_p != ''){
        echo '<br><br>' . '<span class="error">' . $kq_p . '</span>';
      } 
      ?>
      <input type="password" class="text" name="password">
      <br><br>

      <span>Nhập lại mật khẩu</span>
      <?php if($kq_cfP != ''){
        echo '<br><br>' . '<span class="error">' . $kq_cfP . '</span>';
      } 
      ?>
      <input type="password" class="text" name="cfPassword">
      <br><br>

      <span>email</span>
      <?php if($kq_e != ''){
        echo '<br><br>' . '<span class="error">' . $kq_e . '</span>';
      } 
      ?>
      <input type="email" class="text" name="email">
      <br><br>

      <span>giới tính</span>
      <br>
      <span>
        <input type="radio" name="gender" checked="checked" id="Nam" value="Nam">
        <label for="html">Nam</label>
        <input type="radio" name="gender" id="Nu" value="Nu">
        <label for="html">Nữ</label>
        <input type="radio" name="gender" id="Khac" value="Khac">
        <label for="html">Khác</label>
      </span>
      <br><br>


      <input type="checkbox" id="checkbox-1-1" class="custom-checkbox" />
      <label for="checkbox-1-1"></label>

      <input type="submit" class="signin" name="DangKy" value="Đăng ký">

      <hr>

      <a href="quen_mat_khau.php">Quên mật khẩu?</a>
    </form>

  </div>


</body>

</html>