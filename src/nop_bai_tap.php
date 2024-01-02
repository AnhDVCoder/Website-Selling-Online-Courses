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
	if (!$permission == 1 OR !$permission == 2) {
		header("location: khoa_hoc.php");
	}
	$id_bai_hoc = $_GET['id_bai_hoc'];
?>

<?php
	$DLfromListBH = getDLfromlist_bai_hoc($connect, $id_bai_hoc);
	if (mysqli_num_rows($DLfromListBH) > 0) {
		$DLBH = mysqli_fetch_assoc($DLfromListBH);
		$id_khoa_hoc_LBH = $DLBH['ID_khoa_hoc'];
		$ten_bai_hoc_LBH = $DLBH['Ten_bai_hoc'];
		$video_type_LBH = $DLBH['video_type'];
		$video_path_LBH = $DLBH['Video_path'];
		$de_bai_path_LBH = $DLBH['De_bai_path'];
		$noi_dung_LBH = $DLBH['noi_dung'];
	}

	$SQL = "
			SELECT *
			FROM bai_hoc_da_nop
			WHERE id_bai_hoc = ".$id_bai_hoc." AND username = '".$username."'";

	$Query = mysqli_query($connect, $SQL);
	if (mysqli_num_rows($Query) > 0) {
		$DL = mysqli_fetch_assoc($Query);
		$thoi_gian_nop_DLNB = $DL['thoi_gian_nop'];
		$bai_nop_path_DLNB = $DL['bai_nop_path'];
	}
	else{
		$thoi_gian_nop_DLNB = "";
		$bai_nop_path_DLNB = "";
	}

	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nộp bài tập</title>
	<!-- Begin bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<!-- End bootstrap cdn -->
	<link rel="stylesheet" href="../css/style.php">
</head>
<style type="text/css">
	dl, ol, ul {
		margin-bottom: 0px;
		text-align: center;
	}

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
<body>
	<?php include 'header.php'; ?>
	<main style="min-height: 100vh; max-width: 100%;">
		<div class="d-flex justify-content-center">
		<form action="" method="POST" class="w-50" enctype="multipart/form-data">
			<h1 style="margin-top: 45px;">Nộp bài học</h1>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Tên bài học</label>
			  <input type="text" class="form-control" id="ten_bai_hoc" name="ten_bai_hoc" disabled="disabled" value="<?php echo $ten_bai_hoc_LBH ?>">
			</div>

			<div class="mb-3">
				<label for="video" class="form-label">Bài tập được làm trong cùng 1 file có điền số bài </label><br>
                <h2>Nộp bài tập tại đây </h2>
			  <label for="file_de_bai" class="form-label">Chọn file bài tập 
			  	<?php 
			  		if($bai_nop_path_DLNB != ""){ 
			  			echo "
			  				<a href='".$bai_nop_path_DLNB."'>Bài tập đã nộp</a> 
			  				<p>Thời gian: ".$thoi_gian_nop_DLNB."</p>";
			  			};
			  		?></label>
			  <input type="file" class="form-control" id="file_de_bai" name="file_bai_nop" value="hehe">

				
			</div>


			<input type="submit" class="btn btn-primary" name="saveBaiTap" value="Lưu">
			<a href="chi_tiet_khoa_hoc.php?id_khoa_hoc=<?php echo $id_khoa_hoc_LBH ?>&id_bai_hoc=<?php echo $id_bai_hoc ?>" class="btn btn-primary">Trở lại</a>

<?php
	$kq = "<br>";
	// $SQL1 = "SELECT ID_bai_hoc FROM list_bai_hoc WHERE ID_khoa_hoc = ".$id_khoa_hoc." ORDER BY ID_bai_hoc DESC";
	// 	$Query1 = mysqli_query($connect, $SQL1);

	// 	$DATA = mysqli_fetch_assoc($Query1);
	// 	$id_bai_hoc_moi_nhat = $DATA['ID_bai_hoc'];
	// 	$id_bai_hoc = $id_bai_hoc_moi_nhat + 1;

	if (isset($_POST['saveBaiTap'])) {
			$ten_file_bai_nop = $_FILES['file_bai_nop']['name'];
			if ($ten_file_bai_nop == "") {
				$bai_nop_path = $bai_nop_path_DLNB;
				if($bai_nop_path == ""){
					$flag3 = false;
				}
				else{
					$flag3 = true;
				}
				
			}
			else{
				$path = strtolower(pathinfo($ten_file_bai_nop, PATHINFO_EXTENSION));
				$tmp_file = $_FILES['file_bai_nop']['tmp_name'];
				if (!file_exists("../khoa_hoc/".$id_khoa_hoc_LBH."/".$id_bai_hoc."/bai_tap/".$username)) {
    				mkdir("../khoa_hoc/".$id_khoa_hoc_LBH."/".$id_bai_hoc."/bai_tap/".$username , 0777, true);
				}
				$SaveFile = move_uploaded_file($tmp_file, "../khoa_hoc/".$id_khoa_hoc_LBH."/".$id_bai_hoc."/bai_tap/".$username."/".$username.".".$path);
				$bai_nop_path = "../khoa_hoc/".$id_khoa_hoc_LBH."/".$id_bai_hoc."/bai_tap/".$username."/".$username.".".$path;
				$flag3 = true;
			}

		if ($flag3 == true) {
			$thoi_gian_nop = date('Y-m-d H:i:s');
			$SQL_insert = "INSERT INTO bai_hoc_da_nop (id_bai_hoc, username, thoi_gian_nop, bai_nop_path) VALUES('".$id_bai_hoc."', '".$username."', '".$thoi_gian_nop."', '".$bai_nop_path."')";
			$SQL_update = "UPDATE bai_hoc_da_nop SET id_bai_hoc ='".$id_bai_hoc."', username ='".$username."', thoi_gian_nop ='".$thoi_gian_nop."', bai_nop_path ='".$bai_nop_path."' WHERE username ='".$username."'";
			if($bai_nop_path_DLNB == ""){
				$SQL = $SQL_insert;
			}
			else{
				$SQL = $SQL_update;
			}
			if(!mysqli_query($connect, $SQL)){
				echo "Lỗi cập nhật!";
			}
			else{
				echo "<br><div class = 'thongbao'>Cập nhật bài nộp thành công!</div>";
			}
			;
			
		}
		else{
			echo "<div class='error'>".$kq."</div>";
		}
		
	}
?>
		</form>
		</div>
	</main>

</body>

	
</html>