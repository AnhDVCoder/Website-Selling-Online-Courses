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
    	<br>
    	<p id='title_1' style="height: 15px; width: 100% ">Khóa học đã mua</p>
    	<br>
	    <div id="list_item" style="min-height: 300px;">
	    	
	    	
	    	<!-- <form method='GET' action=''>
	    		<input type="hidden" name="id_khoa_hoc">
	    		<input type='submit' name='BtnXem' value="Vào xem">
	    	</form> -->
	    	<?php
	    		$SQL = "SELECT * FROM khoa_hoc AS KH JOIN khoa_hoc_da_mua AS KHDM ON KH.id_khoa_hoc = KHDM.id_khoa_hoc WHERE KHDM.username = '".$username."' ORDER BY KHDM.ngay_mua DESC";
	    		// $SQL = "SELECT * FROM khoa_hoc";
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
<!-- 	        <div id='item' style="
					    position: relative;
					    width: 19%;
					">
			    <a href='khoa_hoc.php' style="
				    position: absolute;
				    top: 35%;
				    left: 7%;
				">
            		<i class="fa fa-plus fa-5x" aria-hidden="true" id ='imgthumbnail' ></i>
            	</a>
            	<p><button class='button'>Thêm khóa học</button></p>
            	<p style="width: 100%;"></p>
            	
    		</div> -->
    		<div id='item'>
			    <a href='khoa_hoc.php' >
            		<i class="fa fa-plus fa-5x" aria-hidden="true" id ='plus_icon' style="color: orange;"></i>
            	</a>
            	<p><a href='khoa_hoc.php'><button class='button' id='btn1' style="color: darkred; background-color: transparent; border: 1px solid; " >Thêm khóa học</button></a></p>
            	<!-- <p style="width: 100%;"></p> -->
            	
    		</div>
	    </div>
    </div>

    
</body>
    <?php  
    include "footer.php"; ?>
</html>