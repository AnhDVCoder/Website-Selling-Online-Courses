<?php
	date_default_timezone_set('Asia/Ho_Chi_Minh');  
	include '../connectdb.php';
	include '../function.php';
	session_start();

if (!isset($_SESSION['fullname'])) {
		header("location: DN.php");
	}
	
	$username = $_SESSION['username'];
	$fullname = $_SESSION['fullname'];
	
	$permission = getPermission($connect, $username);
	if (!$permission == 2) {
		header("location: khoa_hoc.php");
	}

	$id_bai_hoc = $_GET['id_bai_hoc'];
	$usernameCB = $_GET['username'];
	$SQL = "
			SELECT * 
			FROM list_bai_hoc AS LBH
			JOIN bai_hoc_da_nop AS BHDN
			ON LBH.ID_bai_hoc = BHDN.id_bai_hoc
			WHERE BHDN.id_bai_hoc = ".$id_bai_hoc." AND BHDN.username = '".$usernameCB."'";

	$Query = mysqli_query($connect, $SQL);
	$DL = mysqli_fetch_assoc($Query);
	$ten_bai_hoc = $DL['Ten_bai_hoc'];
	$bai_tap_path = $DL['De_bai_path'];
	$bai_nop_path = $DL['bai_nop_path'];
	$diem = $DL['diem'];
	
	

	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chấm điểm</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="../css/style.php">
	<link rel="stylesheet" href="../css/them_khoa_hoc_css.php">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	

</head>
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
</style>
<?php
	

?>
<body>
	<?php include 'header.php'; ?>
	<main style="min-height: 100vh; max-width: 100%;">
		<div class="d-flex justify-content-center">
		<form action="" method="POST" class="w-50" enctype="multipart/form-data">
			<br>
			<h3>Chấm điểm</h3>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Học viên</label>
			  <input type="text" class="form-control" name="ten_khoa_hoc" placeholder="Nhập tên khóa học" value="<?php echo $usernameCB ?>" disabled="disabled">
			</div>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Tên bài học</label>
			  <input type="text" class="form-control" name="ten_khoa_hoc" placeholder="Nhập tên khóa học" value="<?php echo $ten_bai_hoc ?>" disabled="disabled">
			</div>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">File bài tập đã giao</label>
			  <p class="form-control" name="ten_tac_gia" value=''><a href="<?php echo $bai_tap_path ?>">Đề bài bài tập</a></p>
			</div>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">File bài tập học viên nộp</label>
			  <p class="form-control" name="ten_tac_gia" value=''><a href="<?php echo $bai_nop_path ?>">Bài tập học viên nộp</a></p>
			</div>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Chấm điểm (0 - 10)</label>
			  <input type="number" class="form-control" name="diem" placeholder="Nhập điểm" min="0" value="<?php echo $diem  ?>" max="10">
			</div>


			<input type="submit" class="btn btn-primary" name="save" value="Lưu">
			<a href="kiem_tra_bai_tap.php?id_bai_hoc=<?php echo $id_bai_hoc ?>" class="btn btn-primary">Trở lại</a>

<?php
	$kq = "<br>";

	if (isset($_POST['save'])) {
		if ($_POST['diem'] == NULL) {
			$kq.= "- Bạn chưa nhập điểm!<br>";
		}
		else{
			$diem = $_POST['diem'];
			$SQL = "UPDATE bai_hoc_da_nop SET diem = ".$diem." WHERE id_bai_hoc = ".$id_bai_hoc." AND username = '".$usernameCB."'";
			if(mysqli_query($connect, $SQL)){
				echo "<br><div class = 'thongbao'>Chấm điểm thành công!</div>";
			}
			else{
				echo "Lỗi";
			}
			
		}
	}
?>
		</form>
		</div>
	</main>
	<?php include "footer.php" ?>
</body>

<script src="them_khoa_hoc.js"></script>
</html>