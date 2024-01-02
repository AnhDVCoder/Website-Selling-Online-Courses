<?php
	include '../connectdb.php';
	include '../function.php';


	session_start();

	if (!isset($_SESSION['fullname'])) {
		header("location: DN.php");
	}

	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];
	$permission = getPermission($connect, $username);



	if ($_SESSION['permission'] != 2) {
		header("location: khoa_hoc.php");
	}

	$id_khoa_hoc = $_GET['id_khoa_hoc'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bài học</title>
    <link rel="stylesheet" href="../css/style.php">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

    <?php include 'header.php'; ?>
	<div class="box1">
		<br>

		<div class="box2">
			<br>
			<div id="xem_them" style="width: auto;">
				<a href="them_bai_hoc.php?id_khoa_hoc=<?php echo $id_khoa_hoc ?>" class='btn-ql'>Thêm bài học</a>
				<a href="quan_ly_khoa_hoc.php" class='btn-ql'>Quay lại</a>
			</div>
<div  class="box3" style="overflow-x:auto;">
<table id="users">
  	<tr>
	    <th>STT</th>
	    <th>Mã bài học</th>
	    <th>Tên bài học</th>
	    <th>Chỉnh sửa</th>
	</tr>

	<?php  
		$SQL = "
				SELECT *
				FROM list_bai_hoc
				WHERE ID_khoa_hoc = ".$_GET['id_khoa_hoc']."
				ORDER BY ID_bai_hoc";

		$DLFromKH = mysqli_query($connect, $SQL);
		if (mysqli_num_rows($DLFromKH) > 0) {
			$i = 1;
			while($listKH = mysqli_fetch_assoc($DLFromKH)) {
		    		echo "
		    			<tr>
		    				<td>1</td>
		    				<td>".$listKH['ID_bai_hoc']."</td>
                                
		    				<td>".$listKH['Ten_bai_hoc']."</td>
                            
		    				
		    				<form method='POST' action=''>
		    				
		    				<td>
		    					<a class='btn-ql' href='sua_bai_hoc.php?id_bai_hoc=".$listKH['ID_bai_hoc']."'>Sửa</a>
		    					<a class='btn-ql' href='xoa_bai_hoc.php?id_bai_hoc=".$listKH['ID_bai_hoc']."'>Xóa</a>
		    				</td>
		    				</form>

		    				
		    			</tr>";
		    		}
		    	}


		
	?>
	

		</div>
		</table>
</div>
		</div>
		<br>
	</div>
    
</body>
</html>