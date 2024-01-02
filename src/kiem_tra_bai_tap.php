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
	if(!isset($_GET['id_bai_hoc'])){
		header("location: khoa_hoc.php");
	}
	$id_bai_hoc = $_GET['id_bai_hoc'];

	$SQL = "SELECT ID_khoa_hoc FROM list_bai_hoc WHERE id_bai_hoc =".$id_bai_hoc;
	$Query = mysqli_query($connect, $SQL);
	$DL = mysqli_fetch_assoc($Query);
	$id_khoa_hoc = $DL['ID_khoa_hoc'];
	
	
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
    <title>Danh sách bài nộp</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>     
<body>

    <?php include 'header.php'; ?>
	<!-- <br> -->
	<div class="box1">
		<br>
		<div class="box2">
			<div id="xem_them" style="width: auto;">
				
				<a href="quan_ly_bai_hoc.php?id_khoa_hoc=<?php echo $id_khoa_hoc ?>" class='btn-ql' style="color: black;">Quay lại</a>
			</div>

<div  class="box3" style="overflow-x:auto;">
<table id="users">
  	<tr>
	    <th>STT</th>
	    <th>Tên tài khoản </th>
	    <th>Tên người dùng </th>
	    <th>Thời gian nộp </th>
	    <th>Điểm</th>
        <th>Chức năng</th>
	    
	</tr>

	
	<?php  
		$SQL = "
				SELECT *
				FROM bai_hoc_da_nop AS BHDN
				JOIN information AS INFO
				ON BHDN.username = INFO.username
				WHERE BHDN.id_bai_hoc = ".$id_bai_hoc." 
				ORDER BY BHDN.thoi_gian_nop DESC";

		$DL = mysqli_query($connect, $SQL);
		if (mysqli_num_rows($DL) > 0) {
			$i = 1;
			while($listNB = mysqli_fetch_assoc($DL)) {
				if ($listNB['diem'] < 0) {
					$diem = "Chưa chấm";
				}
				else{
					$diem = $listNB['diem'];
				}
				echo " 
	    			<tr>
	    				<td>".$i."</td>
	    				<td>".$listNB['username']."</td>
	    				<td>".$listNB['fullname']."</td>

                        <td>".$listNB['thoi_gian_nop']."</td>
                        <td>".$diem."</td> 
	    				<td><a href='".$listNB['bai_nop_path']."'>Tải về</a> / <a href='cham_diem_bai_tap.php?id_bai_hoc=".$id_bai_hoc."&username=".$listNB['username']."'>Chấm điểm</a></td>
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