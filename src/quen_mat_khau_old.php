<?php  
	include '../connectdb.php';
	include '../function.php';
	

//PHPMailer
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quên mật khẩu</title>
</head>
<body>
	<form action="" method="POST">
		<input type="text" name="email" placeholder="Nhập địa chỉ Email">
		<input type="submit" name="send" value="Gửi">
		<input type="text" name="code" placeholder="Nhập mã xác nhận">
		<input type="submit" name="confirm" value="Xác nhận">
	</form>
</body>
</html>
<?php
	
	// echo(rand(100000,999999));
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	// $d=strtotime("+10 minutes");

	$date1 = strtotime('08/22/2013');
	$date2 = strtotime('08/23/2013');
	$time1 = strtotime(date('H:i:s'));
	$time2 = strtotime(date('H:i:s'));
	echo $dayDiff=round(abs($date2 - $date1) / 60);
	echo "<br>";
	echo $minDiff=round(abs($time1 - $time2) / 60);

	$date1="30-12-1899 9:25:52 AM";
	$format = 'd-m-Y H:i:s A';
	$date = DateTime::createFromFormat($format, $date1);
	// echo $date->format('H:i:s A') . "\n";


	$SQL = "UPDATE quen_mat_khau SET status = 0 WHERE TIMESTAMPDIFF(MINUTE, dtime_end , DATE_ADD(NOW(), INTERVAL 7 HOUR)) > 10";


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
				$kq .= "Bạn chưa nhập Email!";
			}
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  				$kq .= "Email không hợp lệ!";
  				$flag1 = false;
			}
			else{
				$SQL = "SELECT email FROM information WHERE email = '".$email."'";
				$check = mysqli_query($connect, $SQL);
				if(mysqli_num_rows($check) == 0){
					$kq .= "Email này không tồn tại!";
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
				echo "Không gửi được mã xác thực!";
			}
			else{
				echo "Đã gửi mã xác thực!";
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
			$kq .= "Bạn chưa nhập mã xác nhận!";
			$Cflag1 = false;
		}
		elseif(strlen($_POST['code']) != 6){
			$kq .= "Mã xác nhận không hợp lệ!";
			$Cflag1 = false;
		}
		else{
			$code = $_POST['code'];
			$Cflag1 = true;
		}


		if (isset($_POST['email']) == "") {
			$kq .= "Email không được để trống!";
			$Cflag2 = false;
		}
		elseif (!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
  			$kq .= "Email không hợp lệ!";
  			$Cflag2 = false;
		}
		else{
			$email = $_POST['email'];
			$SQL = "SELECT email FROM information WHERE email = '".$email."'";
			$check = mysqli_query($connect, $SQL);
			if(mysqli_num_rows($check) == 0){
				$kq .= "Email này không tồn tại!";
				$Cflag2 = false;
			}
			else{
				$Cflag2 = true;
			}
		}

		$SQL = "SELECT COUNT(dtime_start) AS count FROM quen_mat_khau WHERE DATE(dtime_start) = '".date('Y-m-d')."'";
		$DL = mysqli_query($connect, $SQL);
		if(mysqli_num_rows($DL) > 0){
			$listDL = mysqli_fetch_assoc($DL);
			$count = $listDL['count'];
			if($count > 5){
				$kq .= "Bạn đã yêu cầu quên mật khẩu quá số lần trong hôm nay! Vui lòng thử lại tiếp vào ngày mai!";
			}
		}



		if($Cflag1 == true && $Cflag2 == true){
			$SQL = "SELECT code, dtime_start FROM quen_mat_khau WHERE email = '".$email."' AND status = 1 ORDER BY dtime_start DESC LIMIT 1";
			$DL = mysqli_query($connect, $SQL);
			if(mysqli_num_rows($DL) == 0){
				$kq .= "Tài khoản này chưa gửi yêu cầu quên mật khẩu!";
			}
			else{
				$listDL = mysqli_fetch_assoc($DL);
				$DBcode = $listDL['code'];
				$DBtime = $listDL['dtime'];
				if($code != $DBcode){
					$kq .= "Mã xác nhận không đúng!";
				}
				else{
					$SQL = "UPDATE quen_mat_khau SET status = 0 WHERE email = '".$email."'";
					mysqli_query($connect, $SQL);
					header("location: DN.php");
				}
			}
		}	
		
		echo $kq;
	}
?>