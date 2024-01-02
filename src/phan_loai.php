<?php
	include '../connectdb.php';
	include '../function.php';

	session_start();
	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];
	$permission = getPermission($connect, $username);
	

	if (!isset($_SESSION['fullname'])) {
		header("location: DN.php");
	}

	if ($_SESSION['permission'] != 2) {
		header("location: khoa_hoc.php");
	}
?>
<!DOCTYPE html>
<html>
<style type="text/css">
	.thongbao{
		width: 100%;
		border: 1px;
		height: 50px;
		font-size: 20px;

		padding-top: 10px;
		text-align: center;
		box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
		background: lightgreen;
	}
	.error{
		width: 100%;
		border: 1px;
		height: auto;
		font-size: 20px;
		padding-left: 10px;
		padding-bottom: 20px;
/*		text-align: center;*/
		box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
		background: red;
	}
	#col-1 {
		  position: relative;
		  width: 40%;
		  float: left;
		  height: 100%;
		  z-index: 5
	}

	#col-2 {
		  position: relative;
		  width: 60%;
		  float: left;
		  height: 100%;
		  z-index: 5
	}
</style>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="../css/style.php">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../css/gioi_thieu_css.php">
	<link rel="stylesheet" href="../css/quan_li_user_css.php">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Giới thiệu</title>
<body>
	<?php include 'header.php'; ?>
	<main style="min-height: 100vh; max-width: 100%;">
		<div id="col-1">
			<div class="d-flex justify-content-center">
				<form action="" method="POST" class="w-50" enctype="multipart/form-data">
					<br>
					<h3>Thêm phân loại</h3>

					<div class="mb-3">
					  <label for="ten_bai_tap" class="form-label">Tên phân loại</label>
					  <input type="text" class="form-control" name="ten_phan_loai" placeholder="Nhập tên phân loại">
					</div>

					<div class="mb-3">
					  <label for="mo_ta" class="form-label">Mô tả</label>
					  <textarea id="mo_ta_text" class="form-control" name="mo_ta" rows="5" cols="50"></textarea>
					</div>



					<input type="submit" class="btn btn-primary" name="save" value="Lưu">
					<a href="khoa_hoc.php" class="btn btn-primary">Trở lại</a>

		<?php
			$kq = "<br>";
			if (isset($_POST['save'])) {
				if ($_POST['ten_phan_loai'] == "") {
					$kq.= "- Bạn chưa nhập tên phân loại!<br>";
					$flag1 = false;
				}
				else{

					$ten_phan_loai = $_POST['ten_phan_loai'];
					$SQL = "SELECT name FROM list_phan_loai WHERE name = '".$ten_phan_loai."'";
					$check = mysqli_query($connect, $SQL);
					if (mysqli_num_rows($check) > 0) {
						$kq.= "- Tên phân loại đã tồn tại!<br>";
						$flag1 = false;
					}
					else{
						$flag1 = true;
					}	


				}

				$mo_ta = $_POST['mo_ta'];
				if($_POST['mo_ta'] != ""){
					$mo_ta = ltrim(rtrim($_POST['mo_ta'], " "), " ");
				}

				if ($flag1 == true) {
					$SQL = "INSERT INTO list_phan_loai (name, description) VALUES('".$ten_phan_loai."', '".$mo_ta."')";
					$Query = mysqli_query($connect, $SQL);
					echo "<br><div class = 'thongbao'>Thêm thành công!</div>";
				}
				else{
					echo "<div class='error'>".$kq."</div>";
				}
				
			}
		?>
				</form>
			</div>
		</div>
		<br>
		<div id="col-2">
			<div class="box1">
				<br>
				<div class="box2">
					<div class="box3" style="overflow-x:auto;">
						<table id="users">
						  	<tr>
							    <th>STT</th>
							    <th>Tên phân loại</th>
							    <th width="40%">Mô tả</th>
							    <th>Chức năng</th>
							</tr>
							<div class="list_user_item" id="scroll">
	<?php  
		$SQL = "
				SELECT *
				FROM list_phan_loai";

		$DLFromlistPL = mysqli_query($connect, $SQL);
		if (mysqli_num_rows($DLFromlistPL) > 0) {
			$i = 1;
			while($listPL = mysqli_fetch_assoc($DLFromlistPL)) {
		    		echo "
		    			<tr>
		    				<td>".$i."</td>
		    				<td>".$listPL['name']."</td>
		    				<td>".$listPL['description']."</td>
		    				<td>
		    					<a href='xoa_phan_loai.php?phan_loai_del=".$listPL['ID']."'>Xóa</a>
		    				</td>
		    			</tr>";
		    			$i++;
		    }
		}
	?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php include "footer.php" ?>
</body>
</html>