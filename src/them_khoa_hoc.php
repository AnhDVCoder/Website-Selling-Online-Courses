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
	
	

	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Thêm khóa học</title>

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
			<h3>Thêm khóa học</h3>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Tên khóa học</label>
			  <input type="text" class="form-control" name="ten_khoa_hoc" placeholder="Nhập tên khóa học">
			</div>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Người hướng dẫn</label>
			  <input type="text" class="form-control" name="ten_tac_gia" value='<?php echo $fullname ?>'>
			</div>

			<div class="mb-3">
			  <label for="ten_bai_tap" class="form-label">Giá khóa học</label>
			  <input type="number" class="form-control" name="gia" placeholder="Nhập giá khóa học" min="0" value="0">
			</div>


			<div class="mb-3">
			  <label for="thumbnail" class="form-label">Thumbnail</label>
			  <input type="file" class="form-control" name="thumbnail">
			</div>

<!-- 			<div class="mb-3">
			  <label for="tags" class="form-label">Tags</label>
			  <input type="text" class="form-control" name="tags">
			</div> -->
			<div class="mb-3">
				<div id="list1" class="dropdown-check-list" tabindex="100">
					<span class="anchor">Chọn phân loại</span>
				  	<ul class="items">
				  		<?php
				  			$SQL = "
					   		SELECT ID, name
					   		FROM list_phan_loai
					   				";
					   		$DLFromlistPL = mysqli_query($connect, $SQL);
					   		if (mysqli_num_rows($DLFromlistPL) > 0) {
								$i = 1;
								while($listPL = mysqli_fetch_assoc($DLFromlistPL)) {
									echo "
									<li><input type='checkbox' name='phan_loai[]' value='".$listPL['ID']."'>".$listPL['name']."</li>
										";
								}
							}
				  		?>
				  	</ul>
				</div>
			</div>
			<div class="mb-3">
			  <label for="mo_ta" class="form-label">Mô tả</label>
			  <!-- <textarea id="mo_ta_text" class="form-control" name="mo_ta" rows="5" cols="50"></textarea> -->
			  <textarea id="editor" name="editor"></textarea>
			</div>



			<input type="submit" class="btn btn-primary" name="save" value="Lưu">
			<a href="quan_ly_khoa_hoc.php" class="btn btn-primary">Trở lại</a>

<?php
	$kq = "<br>";

	$id_khoa_hoc_moi_nhat = getIDkhoa_hocmoinhat($connect);

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
			$kq.= "- Bạn chưa nhập tên người hướng dẫn!<br>";
			$flag2 = false;
		}
		else{
			$ten_tac_gia = $_POST['ten_tac_gia'];
			$flag2 = true;
		}

		if ($_POST['gia'] == NULL) {
			$kq.= "- Bạn chưa nhập giá khóa học!<br>";
			$flag5 = false;
		}
		else{
			$gia = $_POST['gia'];
			$flag5 = true;
		}

		// if ($_POST['tags'] == "") {
		// 		$tags = $_POST['tags'];
		// }
		// else{
		// 	$tags = "";
		// 	$temp = explode(",", $_POST['tags']);
		// 	for($i = 0; $i < count($temp); $i++){
		// 		$temp[$i] = ltrim(rtrim($temp[$i], " "), " ");
		// 		$tags .= $temp[$i].", ";
		// 	}
		// }

		if(isset($_POST['phan_loai'])){
			$categories = $_POST['phan_loai'];
			$flag4 = true;
		}
		else{
			$flag4 = false;
		}
		

		$mo_ta = $_POST['editor'];
		if($_POST['editor'] != ""){
			$mo_ta = ltrim(rtrim($_POST['editor'], " "), " ");
		}
		

		$ten_file_thumbnail = $_FILES['thumbnail']['name'];
		if ($ten_file_thumbnail == "") {
			$thumbnail_path = "../images/default.jpg";
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
				$id_khoa_hoc = $id_khoa_hoc_moi_nhat + 1;
				$tmp_file = $_FILES['thumbnail']['tmp_name'];
				$SaveFile = move_uploaded_file($tmp_file, "../images/thumbnail/".$id_khoa_hoc.".".$path);
				$thumbnail_path = "../images/thumbnail/".$id_khoa_hoc.".".$path;
				$flag3 = true;
				
			}
		}	

		if ($flag1 == true && $flag2 == true && $flag3 == true && $flag5 == true) {
			$dtime = date('Y-m-d H:i:s');
			$id_khoa_hoc = $id_khoa_hoc_moi_nhat + 1;
			insertKhoa_hoc($connect, $ten_khoa_hoc, $ten_tac_gia, $thumbnail_path, $mo_ta, $dtime, $gia);
			if($flag4 == true){
				foreach ($categories as $value) {
				$Query = mysqli_query($connect, "INSERT INTO khoa_hoc_phan_loai (ID_khoa_hoc, ID_phan_loai) VALUES(".$id_khoa_hoc.", ".$value.")");
				}
				// print_r($categories);
			}
			if (!file_exists("../khoa_hoc/".$id_khoa_hoc)) {
    				mkdir("../khoa_hoc/".$id_khoa_hoc, 0777, true);
			}		
			
			echo "<br><div class = 'thongbao'>Thêm thành công!</div>";
		}
		else{
			echo "<div class='error'>".$kq."</div>";
		}
		
	}
?>
		</form>
		</div>
	</main>
			<script src="ckeditor5-build-classic/ckeditor.js"></script>

<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>
	<?php include "footer.php" ?>
</body>

<script src="them_khoa_hoc.js"></script>
</html>