<?php
	include '../connectdb.php';
	include '../function.php';
	

	session_start();
	if(isset($_SESSION['fullname'])){
		$fullname = $_SESSION['fullname'];
		$username = $_SESSION['username'];
		$permission = $_SESSION['permission'];
	}
	else{
		$fullname = "Khach";
		$username = "user";
		$permission = 0;
	}
	

	$id_khoa_hoc = $_GET['id_khoa_hoc'];
	$DLKhoaHoc = getDLfromKhoaHoc($connect, $id_khoa_hoc);
	if (mysqli_num_rows($DLKhoaHoc) > 0) {
        $list_DL_khoahoc = mysqli_fetch_assoc($DLKhoaHoc);
        $ten_khoa_hoc = $list_DL_khoahoc['ten_khoa_hoc'];
        $thumbnail_path = $list_DL_khoahoc['thumbnail'];
        $tenNHD = $list_DL_khoahoc['ten_tac_gia'];
        $tags = $list_DL_khoahoc['tags'];
        $giaKH = $list_DL_khoahoc['gia'];
        $mo_ta = $list_DL_khoahoc['mo_ta'];
    }


	$video_type = "none";
	$ten_bai_hoc = "Khóa học ".$ten_khoa_hoc;
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
	}
	

	$luot_xem = countLuotXem($connect, $id_khoa_hoc);


	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Khóa học</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" href="../css/style.php">
	<link rel="stylesheet" href="../css/chi_tiet_bai_hoc_css.php">
    <link rel="stylesheet" href="../css/mo_ta_css.php">
	

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
						// echo "<iframe src='".$thumbnail_path."' width='100%' height='100%'></iframe>";
					}
				?>
				
				
				
			</div>
			<div id="list_bai_tap">
				<a href="thanh_toan.php?id_khoa_hoc=<?php echo $id_khoa_hoc;?>"><button class="title"> Mua khóa học</button></a>
				<ul class="list_bai_tap_item" id="scroll">
                    <div class="item-1">
                        Tên Khóa học : <?php echo $ten_khoa_hoc  ?>
                    </div>
                    <div class="item-1">
                        Tác giả : <?php echo $tenNHD  ?>
                    </div>
                    <div class="item-1">
                       Giá tiền : <?php echo number_format($giaKH)." VNĐ"  ?>
                    </div>
                    <div class="item-1">
                        Số lượng bài học: <?php  
                        	$SQL = "SELECT COUNT(ID_bai_hoc) AS count FROM list_bai_hoc WHERE ID_khoa_hoc = ".$id_khoa_hoc;
                        	$Query = mysqli_query($connect, $SQL);
                        	$DLBH = mysqli_fetch_assoc($Query);
                        	echo $DLBH['count'];
                        ?>
                    </div>
                    <div class="item-1">
                       chúc bạn học vui vẻ !!!
                    </div>
                    
					
				</ul>
			</div>
		</div>
		<br>
		<hr>
		<div class="box3">
			<br>
			<h1 id="tenBaiHoc"><?php echo $ten_bai_hoc; ?><a href="#"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a></h1>
			
			<br>
			<?php
				if(isset($_GET['id_bai_hoc'])){
					$SQL = "
							SELECT mo_ta
							FROM list_bai_hoc
							WHERE id_bai_hoc =".$_GET['id_bai_hoc'];
					$Query = mysqli_query($connect, $SQL);
					$DLBH = mysqli_fetch_assoc($Query);
					echo $DLBH['mo_ta'];




				}
				else{
					echo $mo_ta;
				}

				
				
			?>
			<div class="item-2">
                Mô tả: đây là khóa học cơ bản về c++
                <br>
                <button id="myBtn" >quay lại đầu trang
                    <script>
                        window.onscroll = function() {scrollFunction()};
                        function scrollFunction() {
                         
                        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100  ) {
                        document.getElementById("myBtn").style.display = "block";
                        } else {
                        document.getElementById("myBtn").style.display = "none";
                        }
                        }
                         
                        document.getElementById('myBtn').addEventListener("click", function(){
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
                        });
                        </script>
                </button>
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