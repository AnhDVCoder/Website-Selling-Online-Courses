<?php
	include '../connectdb.php';
	include '../function.php';

	$permission = 0;


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
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.php">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Khóa học</title>
</head>

<body>
    <?php 
    	include 'header.php';
    	?>


    <div id="box">
    	<p id='title_1' style="height: 15px; width: 100% ">Khóa học nổi bật
    			<?php
    		echo "
		            		<a id='xem_them' href='tim_kiem.php?keyword_tensanpham=&keyword_nhasanxuat=8'>
		                		
		                		Xem thêm
		            		</a>
    			";
    	?>
    	</p>
	    <div id="list_item">
	    	
	    	
	    	<!-- <form method='GET' action=''>
	    		<input type="hidden" name="id_khoa_hoc">
	    		<input type='submit' name='BtnXem' value="Vào xem">
	    	</form> -->
	    	<?php
	    		$SQL = "SELECT id_khoa_hoc, ten_khoa_hoc, luot_xem, thumbnail FROM khoa_hoc ORDER BY luot_xem DESC LIMIT 4";
				$list_khoa_hoc = mysqli_query($connect, $SQL);
	    		if (mysqli_num_rows($list_khoa_hoc) > 0) {
	            	while($row = mysqli_fetch_assoc($list_khoa_hoc)) {
			    			echo "
			    			<div id='item'>
			            		<a href='"; 
			            		$SQL = "SELECT username FROM khoa_hoc_da_mua WHERE id_khoa_hoc = ".$row['id_khoa_hoc']." AND username = '".$username."'";
			            		if (mysqli_num_rows(mysqli_query($connect, $SQL)) > 0) {
			            			echo "chi_tiet_khoa_hoc";
			            		}
			            		else{
			            			echo "mo_ta";
			            		};
			            		echo ".php?id_khoa_hoc=".$row['id_khoa_hoc']."'>
			                		<img src='".$row['thumbnail']."' id = 'imgthumbnail'><br>
			                	</a>
			                	<p>".$row['ten_khoa_hoc']."</p>
			                	<br>
			                	<p style='color:gray'><i class='fa fa-eye' aria-hidden='true'></i> ".$row['luot_xem']." Lượt xem</p>
			                	<br>
			                	<a href='";
			                	if (mysqli_num_rows(mysqli_query($connect, $SQL)) > 0) {
			            			echo "chi_tiet_khoa_hoc";
			            		}
			            		else{
			            			echo "mo_ta";
			            		};
			                	echo ".php?id_khoa_hoc=".$row['id_khoa_hoc']."'> 
			                		<p><button class='button' id='btn1'>";
			                	if (mysqli_num_rows(mysqli_query($connect, $SQL)) > 0) {
			            			echo "Vào học";
			            		}
			            		else{
			            			echo "Vào xem";
			            		};	 
			                		echo "</button></p>
			                	</a>
			        		</div>
			    		";
	    			}
	    		}
	    			
	    	?>
	        
	    </div>
    </div>

    <div id="box">
    	<p id='title_1' style="height: 15px; width: 100% ">Khóa học cơ bản
    			<?php
    		echo "
		            		<a id='xem_them' href='tim_kiem.php?keyword_tensanpham=&keyword_nhasanxuat=8'>
		                		
		                		Xem thêm
		            		</a>
    			";
    	?>
    	</p>
	    <div id="list_item">
	    	
	    	
	    	<!-- <form method='GET' action=''>
	    		<input type="hidden" name="id_khoa_hoc">
	    		<input type='submit' name='BtnXem' value="Vào xem">
	    	</form> -->
	    	<?php
	    		$SQL = "SELECT KH.id_khoa_hoc, KH.ten_khoa_hoc, KH.luot_xem, KH.thumbnail FROM khoa_hoc AS KH JOIN khoa_hoc_phan_loai AS KHPL ON KH.id_khoa_hoc = KHPL.ID_khoa_hoc WHERE KHPL.ID_phan_loai = 8 ORDER BY luot_xem DESC LIMIT 4";
				$list_khoa_hoc = mysqli_query($connect, $SQL);
	    		if (mysqli_num_rows($list_khoa_hoc) > 0) {
	            	while($row = mysqli_fetch_assoc($list_khoa_hoc)) {
			    			echo "<div id='item'>
			            		<a href='chi_tiet_khoa_hoc.php?id_khoa_hoc=".$row['id_khoa_hoc']."'>
			                		<img src='".$row['thumbnail']."' id = 'imgthumbnail'><br>
			                	</a>
			                		<p>".$row['ten_khoa_hoc']."</p>
			                		<br>
			                		<p style='color:gray'><i class='fa fa-eye' aria-hidden='true'></i> ".$row['luot_xem']." Lượt xem</p>
			                		<br>
			                		<a href='chi_tiet_khoa_hoc.php?id_khoa_hoc=".$row['id_khoa_hoc']."'> 
			                		<p><button class='button' id='btn1'>Vào xem</button></p>
			                		</a>
			            		</a>
			        		</div>
			    		";
	    			}
	    		}
	    			
	    	?>
	        
	    </div>
    </div>


    <div id="box">
    	<p id='title_1' style="height: 15px; width: 100% ">Khóa học nâng cao
    			<?php
    		echo "
		            		<a id='xem_them' href='tim_kiem.php?keyword_tensanpham=&keyword_nhasanxuat=9'>
		                		
		                		Xem thêm
		            		</a>
    			";
    	?>
    	</p>
	    <div id="list_item">
	    	
	    	
	    	<!-- <form method='GET' action=''>
	    		<input type="hidden" name="id_khoa_hoc">
	    		<input type='submit' name='BtnXem' value="Vào xem">
	    	</form> -->
	    	<?php
	    		$SQL = "SELECT KH.id_khoa_hoc, KH.ten_khoa_hoc, KH.luot_xem, KH.thumbnail FROM khoa_hoc AS KH JOIN khoa_hoc_phan_loai AS KHPL ON KH.id_khoa_hoc = KHPL.ID_khoa_hoc WHERE KHPL.ID_phan_loai = 9 ORDER BY luot_xem DESC LIMIT 4";
				$list_khoa_hoc = mysqli_query($connect, $SQL);
	    		if (mysqli_num_rows($list_khoa_hoc) > 0) {
	            	while($row = mysqli_fetch_assoc($list_khoa_hoc)) {
			    			echo "<div id='item'>
			            		<a href='chi_tiet_khoa_hoc.php?id_khoa_hoc=".$row['id_khoa_hoc']."'>
			                		<img src='".$row['thumbnail']."' id = 'imgthumbnail'><br>
			                	</a>
			                		<p>".$row['ten_khoa_hoc']."</p>
			                		<br>
			                		<p style='color:gray'><i class='fa fa-eye' aria-hidden='true'></i> ".$row['luot_xem']." Lượt xem</p>
			                		<br>
			                		<a href='chi_tiet_khoa_hoc.php?id_khoa_hoc=".$row['id_khoa_hoc']."'> 
			                		<p><button class='button' id='btn1'>Vào xem</button></p>
			                		</a>
			            		</a>
			        		</div>
			    		";
	    			}
	    		}
	    			
	    	?>
	        
	    </div>
    </div>
</body>
    <?php  
    include "footer.php"; ?>
</html>