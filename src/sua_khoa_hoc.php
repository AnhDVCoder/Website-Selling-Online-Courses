<?php
	include '../connectdb.php';
	include '../function.php';

	session_start();
	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];

	if (!isset($_SESSION['fullname'])) {
		header("location: DN.php");
		die();
	}
	
	$permission = getPermission($connect, $username);

	if (!$permission == 2) {
		header("location: khoa_hoc.php");
		die();
	}

	$id_khoa_hoc = $_GET['id_khoa_hoc'];
	
	

	

	$SQL = "SELECT ten_khoa_hoc, ten_tac_gia, thumbnail, tags, mo_ta FROM khoa_hoc WHERE id_khoa_hoc =".$id_khoa_hoc;
	$list_khoa_hoc = mysqli_query($connect, $SQL);
	$data = mysqli_fetch_assoc($list_khoa_hoc);
	$ten_khoa_hoc = $data['ten_khoa_hoc'];
	$ten_tac_gia = $data['ten_tac_gia'];
	$thumbnail_path = $data['thumbnail'];
	$tags = $data['tags'];
	$mo_ta = $data['mo_ta'];

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="../css/style.php">
	<link rel="stylesheet" href="../css/them_khoa_hoc_css.php">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<title></title>
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
<body>
	<?php include 'header.php'; ?>
	<main style="min-height: 100vh; max-width: 100%;">
		<div class="d-flex justify-content-center">
		<form action="" method="POST" class="w-50" enctype="multipart/form-data">
			<br>
			<h3>Sửa khóa học</h3>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Tên khóa học</label>
			  <input type="text" class="form-control" name="ten_khoa_hoc" value="<?php echo $ten_khoa_hoc ?>">
			</div>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Người hướng dẫn</label>
			  <input type="text" class="form-control" name="ten_tac_gia" value='<?php echo $ten_tac_gia ?>'>
			</div>


			<div class="mb-3">
			  <label for="thumbnail" class="form-label">Thumbnail</label>
			  <a href="<?php echo $thumbnail_path ?>" download>Image</a>
			  <input type="file" class="form-control" name="thumbnail">
			</div>


			<div class="mb-3">
				<div id="list1" class="dropdown-check-list" tabindex="100">
					<span class="anchor">Chọn phân loại</span>
				  	<ul class="items">
				  		<?php
							$num_rows = 0;
							
							// echo $DLFromKH_PL;
				  			$SQL = "
					   		SELECT ID, name
					   		FROM list_phan_loai
					   				";
					   		$DLFromlistPL = mysqli_query($connect, $SQL);
					   		if (mysqli_num_rows($DLFromlistPL) > 0) {
								$i = 1;
								while($listPL = mysqli_fetch_assoc($DLFromlistPL)) {
									echo "
									<li><input type='checkbox' name='phan_loai[]' value='".$listPL['ID']."'
										";

										$SQL1 = "
								  			SELECT *
											FROM khoa_hoc_phan_loai
											WHERE ID_khoa_hoc = ".$id_khoa_hoc." AND ID_phan_loai = ".$listPL['ID'];

										$result = mysqli_query($connect, $SQL1);
										$num_rows = mysqli_num_rows($result);
										if ($num_rows > 0) {
											echo "checked";
										};

									 	echo ">".$listPL['name']."</li>";
									
								}
							}
				  		?>

				  	</ul>
				</div>
			</div>

			<div class="mb-3">
			  <label for="mo_ta" class="form-label">Mô tả</label>
			  <textarea id="mo_ta_text" class="form-control" name="mo_ta" rows="5" cols="50"><?php echo $mo_ta ?></textarea>
			</div>

			<input type="submit" class="btn btn-primary" name="save" value="Lưu">
			<a href="quan_ly_khoa_hoc.php" class="btn btn-primary">Trở lại</a>
			<br>
			<br>
			<!-- <a href="quan_ly_khoa_hoc.php"> -->
				<!-- <input type="submit" class="btn btn-primary" name="delete" value="Xóa"> -->
			<!-- </a> -->
			
			<!-- <input type="submit" class="btn btn-primary" name="hidden" value="Ẩn"> -->
			<!-- <input type="submit" class="btn btn-primary" name="show" value="Hiện"> -->
			

<?php
	$kq = "<br>";
	// if (isset($_POST['delete'])) {
	// 	// header("Location: quan_ly_khoa_hoc.php");
	// 	$SQL = "DELETE FROM khoa_hoc_phan_loai WHERE ID_khoa_hoc =".$id_khoa_hoc;
	// 	$Query = mysqli_query($connect, $SQL);
	// 	$SQL = "DELETE FROM list_bai_hoc WHERE ID_khoa_hoc =".$id_khoa_hoc;
	// 	$Query = mysqli_query($connect, $SQL);
	// 	$SQL = "DELETE FROM khoa_hoc WHERE id_khoa_hoc =".$id_khoa_hoc;
	// 	$Query = mysqli_query($connect, $SQL);
	// 	echo "<br><div class = 'thongbao'>Xóa thành công!</div>";
	// }

	// if (isset($_POST['hidden'])) {
	// 	$SQL = "UPDATE khoa_hoc SET hidden = 1 WHERE id_khoa_hoc =".$id_khoa_hoc;
	// 	$Query = mysqli_query($connect, $SQL);
	// }

	// if (isset($_POST['show'])) {
	// 	$SQL = "UPDATE khoa_hoc SET hidden = 0 WHERE id_khoa_hoc =".$id_khoa_hoc;
	// 	$Query = mysqli_query($connect, $SQL);
	// }

	if (isset($_POST['save'])) {
		if ($_POST['ten_khoa_hoc'] == "") {
			$kq.= "- Bạn chưa nhập tên khóa học!<br>";
			$flag1 = false;
		}
		else{
			$ten_khoa_hoc = $_POST['ten_khoa_hoc'];
			$flag1 = true;
		}

		if ($_POST['ten_tac_gia'] == "") {
			$kq.= "- Bạn chưa nhập tên tác giả!<br>";
			$flag2 = false;
		}
		else{
			$ten_tac_gia = $_POST['ten_tac_gia'];
			$flag2 = true;
		}

		$categories = $_POST['phan_loai'];

		$mo_ta = $_POST['mo_ta'];
		if($_POST['mo_ta'] != ""){
			$mo_ta = ltrim(rtrim($_POST['mo_ta'], " "), " ");
		}

		$tags = $_POST['tags'];
		if ($tags != "") {
			$tags = "";
			$temp = explode(",", $_POST['tags']);
			for($i = 0; $i < count($temp); $i++){
				$temp[$i] = ltrim(rtrim($temp[$i], " "), " ");
				$tags .= $temp[$i].", ";
			}
		}

		
		$ten_file_thumbnail = $_FILES['thumbnail']['name'];
		if ($ten_file_thumbnail == "") {

			$flag3 = true;
		}
		else{
			$path = strtolower(pathinfo($ten_file_thumbnail, PATHINFO_EXTENSION));
			$allow = array('gif', 'png', 'jpg');
			if (!in_array($path, $allow)) {
    			$kq.= "Chỉ cho phép định dạng gif, png, jpg!<br>";
				$flag3 = false;
			}

			else{
				$tmp_file = $_FILES['thumbnail']['tmp_name'];
				$SaveFile = move_uploaded_file($tmp_file, "../images/thumbnail/".$id_khoa_hoc.".".$path);
				$thumbnail_path = "../images/thumbnail/".$id_khoa_hoc.".".$path;
				$flag3 = true;
			}
		}

		if ($flag1 == true && $flag2 == true && $flag3 == true) {
			updateKhoa_hoc($connect, $ten_khoa_hoc, $ten_tac_gia, $thumbnail_path, $id_khoa_hoc, $tags, $mo_ta);
			$SQL = "DELETE FROM khoa_hoc_phan_loai WHERE id_khoa_hoc =".$id_khoa_hoc;
			mysqli_query($connect, $SQL);
			foreach ($categories as $value) {
				$Query = mysqli_query($connect, "INSERT INTO khoa_hoc_phan_loai (ID_khoa_hoc, ID_phan_loai) VALUES('".$id_khoa_hoc."', '".$value."')");
			}
			echo "<br><div class = 'thongbao'>Sửa thành công!</div>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
		else{
			echo "<div class='error'>".$kq."</div>";
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