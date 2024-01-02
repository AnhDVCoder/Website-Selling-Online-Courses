<?php
	include '../connectdb.php';
	include '../function.php';
	

	

	session_start();
	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];
	$permission = $_SESSION['permission'];

	if (!isset($_SESSION['fullname'])) {
		header("location: DN.php");
	}

	if(!isset($_GET['id_khoa_hoc'])){
		header("location: khoa_hoc.php");
	}
	

	$id_khoa_hoc = $_GET['id_khoa_hoc'];

	$SQL = "SELECT username FROM khoa_hoc_da_mua WHERE id_khoa_hoc = ".$id_khoa_hoc;
	if (mysqli_num_rows(mysqli_query($connect, $SQL)) == 0) {
		header("location: mo_ta.php?id_khoa_hoc=".$id_khoa_hoc);
	}

	$DLKhoaHoc = getDLfromKhoaHoc($connect, $id_khoa_hoc);
	if (mysqli_num_rows($DLKhoaHoc) > 0) {
        $list_DL_khoahoc = mysqli_fetch_assoc($DLKhoaHoc);
        $ten_khoa_hoc = $list_DL_khoahoc['ten_khoa_hoc'];
        $thumbnail_path = $list_DL_khoahoc['thumbnail'];
        // $tags = $list_DL_khoahoc['tags'];
        $mo_ta = $list_DL_khoahoc['mo_ta'];
    }


	$video_type = "none";
	$ten_bai_hoc = "Khóa học ".$ten_khoa_hoc;
	$diem = -2;
	if (isset($_GET['id_bai_hoc'])) {
		$id_bai_hoc = $_GET['id_bai_hoc'];
		$QueryTTBH = LayBaiHoc($connect, $id_khoa_hoc, $id_bai_hoc);
		if (mysqli_num_rows($QueryTTBH) > 0) {

	        $list_bai_hoc = mysqli_fetch_assoc($QueryTTBH);
	        $ten_bai_hoc = $list_bai_hoc['Ten_bai_hoc'];
	        $video_type = $list_bai_hoc['video_type'];
			$video_path = $list_bai_hoc['Video_path'];
			$de_bai_path = $list_bai_hoc['De_bai_path'];
		}

		$SQL = "SELECT diem FROM bai_hoc_da_nop WHERE id_bai_hoc = ".$id_bai_hoc." AND username = '".$username."'";
		$Query = mysqli_query($connect, $SQL);
		if(mysqli_num_rows($Query) > 0){
			$DL = mysqli_fetch_assoc($Query);
			$diem = $DL['diem'];
		}
	}
	

	$luot_xem = countLuotXem($connect, $id_khoa_hoc);


	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Xem khóa học</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="../css/style.php">
	<link rel="stylesheet" href="../css/chi_tiet_bai_hoc_css.php">
	<!-- <link rel="stylesheet" href="../css/content-styles-css.php"> -->
	<link rel="stylesheet" href="../css/content-styles.css" type="text/css">
	

	<title></title>
</head>
<style type="text/css">
	body{
		 background: lightgray;

	}



</style>
<body>
	<?php include 'header.php'; ?>

	<div class="box1">
		<br>
		<div class="box2">
			<div id="video">
				<?php
					if ($video_type == "link") {
						echo "<iframe src='".$video_path."' width='100%' height='500px'></iframe>";
					}
					elseif ($video_type == "upload"){
						echo "
							<video width='100%' height='500px' controls>
		  						<source src='".$video_path."'>
							</video>
						";
					}
					elseif ($video_type == "none"){
						
						echo "<img src='".$thumbnail_path."' width='100%' height='100%'>";
					}
				?>
				
				
				
			</div>
			<div id="list_bai_tap">
				<div class="title">Danh sách bài học</div>
				<ul class="list_bai_tap_item" id="scroll">
					<?php
						$QueryListBH = ListBaiHoc($connect, $id_khoa_hoc);

						if (mysqli_num_rows($QueryListBH) > 0) {
			            	while($ListBH = mysqli_fetch_assoc($QueryListBH)) {
					    		echo "
					    			
					    			
						    			<a href='chi_tiet_khoa_hoc.php?id_khoa_hoc=".$id_khoa_hoc."&id_bai_hoc=".$ListBH['ID_bai_hoc']."' id ='listBH'><li>
						    			
							    			".$ListBH['Ten_bai_hoc']; 
							    			echo "
								    		
					    				</li></a>
					    			
					    			
					    		";
					    	}
					    }
					?>


					
				</ul>
			</div>
		</div>
		<br>
		<hr>
		<div class="box3">
			<div style="width: 70%;height: 100%; display: inline-block;">
				<br>
				<h1 id="tenBaiHoc"><?php echo $ten_bai_hoc; ?><a href="#"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a></h1>
				
				<br>
				<div class="ck-content">
				<?php
					if(isset($_GET['id_bai_hoc'])){
						$SQL = "
								SELECT noi_dung
								FROM list_bai_hoc
								WHERE id_bai_hoc =".$_GET['id_bai_hoc'];
						$Query = mysqli_query($connect, $SQL);
						$DLBH = mysqli_fetch_assoc($Query);
						echo $DLBH['noi_dung'];




					}
					else{
						echo $mo_ta;

					}
					
				?>
				</div>
			</div>
			<div style="width: 30%;height: 100%; display: inline-block;position: absolute;padding-left: 25px;">
				<table id="users" 
					<?php 
						if(!isset($_GET['id_bai_hoc'])){
							echo "style='display: none;'";
						}
					?>>
					<tr>
						<th>Bài tập</th>
						<th>Nộp bài</th>
						<th>Điểm</th>
					</tr>
					<tr>
						<td><a href="<?php echo $de_bai_path ?>" download>File bài tập</a></td>
						<td><a href="nop_bai_tap.php?id_bai_hoc=<?php echo $id_bai_hoc ?>">Nộp tại đây</a></td>
						<td>
							<?php  
								if($diem < 0){
									echo "Chưa có điểm";
								}
								else{
									echo $diem;
								}
							?>
						</td>

					</tr>

				</table>
			</div>
		
		</div>
		
		<br>


		<hr>
	</div>
	<br>
	<div>
		Tags: 
			<?php
				$SQL = "SELECT ID_phan_loai FROM khoa_hoc_phan_loai WHERE ID_khoa_hoc = ".$id_khoa_hoc;
				$DL = mysqli_query($connect, $SQL);
				if (mysqli_num_rows($DL) > 0) {
			        while($listDL = mysqli_fetch_assoc($DL)) {
			        	$SQL = "SELECT name FROM list_phan_loai WHERE ID = ".$listDL['ID_phan_loai'];
			        	$listDL = mysqli_fetch_assoc(mysqli_query($connect, $SQL));
			        	echo "<a href='tim_kiem.php?search_type=tag&name=".$listDL['name']."&price=0&search=Tìm+kiếm'>".$listDL['name']."</a> ";

			        }
			    }

			?>
		</div>
	<br>
	<?php include "footer.php" ?>
</body>
	
</html>