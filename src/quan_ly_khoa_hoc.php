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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khóa học</title>
    <link rel="stylesheet" href="../css/style.php">
    <link rel="stylesheet" href="../css/admin_style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
</head>
<body>

    <?php include 'header.php'; ?>
	<div class="box1">
		<br>
		<div class="box2">
			<div id="xem_them" style="width: auto;">
				<a href="them_khoa_hoc.php" class='btn-ql' style="color: black;">Thêm khóa học</a>
				<a href="khoa_hoc.php" class='btn-ql' style="color: black;">Quay lại</a>
			</div>
<div  class="box3" style="overflow-x:auto;">
<table id="users">
  	<tr>
	    <th>STT</th>
	    <th>Tên khóa học</th>
	    <th>Người hướng dẫn</th>
	    <th>Giá tiền</th>
	    <th>Số bài học</th>
	    <th>Chỉnh sửa</th>
	</tr>

	<?php  
		$SQL = "
				SELECT *
				FROM khoa_hoc
				ORDER BY id_khoa_hoc";

		$DLFromKH = mysqli_query($connect, $SQL);
		if (mysqli_num_rows($DLFromKH) > 0) {
			$i = 1;
			while($listKH = mysqli_fetch_assoc($DLFromKH)) {
		    		echo "
		    			<tr>
		    				<td>".$i."</td>

                                
		    				<td>".$listKH['ten_khoa_hoc']."</td>
		    				<td>".$listKH['ten_tac_gia']."</td>
                            <td>".$listKH['gia']."</td>
                            <td><a class='btn-ql' href='quan_ly_bai_hoc.php?id_khoa_hoc=".$listKH['id_khoa_hoc']."'>";
                            $SQL = '
                            	SELECT COUNT(ID_bai_hoc) AS COUNT
                            	FROM list_bai_hoc
                            	WHERE ID_khoa_hoc = '.$listKH['id_khoa_hoc'];

                            $DLFromLBH = mysqli_query($connect, $SQL);
                            $listLBH = mysqli_fetch_assoc($DLFromLBH);
                            echo $listLBH['COUNT'];
	                            
                            echo "</a></td>
		    				
		    				<form method='POST' action=''>
		    				
		    				<td>
		    					<a class='btn-ql' href='sua_khoa_hoc.php?id_khoa_hoc=".$listKH['id_khoa_hoc']."'>Sửa</a>
		    					<a class='btn-ql' href='xoa_khoa_hoc.php?id_khoa_hoc=".$listKH['id_khoa_hoc']."'>Xóa</a>
		    				</td>
		    				</form>

		    				
		    			</tr>";
		    			$i++;
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