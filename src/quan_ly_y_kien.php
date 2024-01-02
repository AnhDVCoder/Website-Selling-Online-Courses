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
    <title>Quản lý ý kiến</title>
    <link rel="stylesheet" href="../css/style.php">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

    <?php include 'header.php'; ?>
	<div class="box1">
		<br>
		<div class="box2">

<div  class="box3" style="overflow-x:auto;">
<table id="users">
  	<tr>
	    <th><?php echo date('Y-m-d H:i:s') ?></th>
	    <th>Tên tài khoản </th>
	    <th>Tiêu đề </th>
	    <th>Thời gian</th>
	    <th>Đã xem</th>
        <th>Phản hồi</th>
	    
	</tr>
	<?php  
		$SQL = "
				SELECT *
				FROM ho_tro
				ORDER BY thoi_gian DESC";

		$DLFromHT = mysqli_query($connect, $SQL);
		if (mysqli_num_rows($DLFromHT) > 0) {
			$i = 1;
			while($listYK = mysqli_fetch_assoc($DLFromHT)) {
		    		echo "
		    			<tr>
		    				<td>1</td>
		    				<td>".$listYK['username']."</td>
		    				<td>".$listYK['tieu_de']."</td>
                            <td>".$listYK['thoi_gian']."</td>
                            <td>
                            	<form method='POST' action=''>";
                    if ($listYK['trang_thai'] == 0) {
                    	echo "<input type='checkbox' onchange='this.form.submit()' name='".$listYK['id_y_kien']."' value='1'>";
                    }
                    else{
                    	echo "<input type='checkbox' onchange='this.form.submit()' name='".$listYK['id_y_kien']."'value='1'  checked>";
                    }

                    if(isset($_POST[$listYK['id_y_kien']])){
                    	if($_POST[$listYK['id_y_kien']] == 1){
                    		$SQL = "UPDATE ho_tro SET trang_thai = 1 WHERE id_y_kien ='".$listYK['id_y_kien']."'";
                    		if (!$Query = mysqli_query($connect, $SQL)) {
					       		echo "Lỗi SQL";
					       }
                    	}
                	}
                   	echo "
                            	</form>
                            </td>
		    				<form method='POST' action=''>
		    				
		    				<td>
		    					<a class='btn-ql' href='tra_loi_y_kien.php?id_y_kien=".$listYK['id_y_kien']."'>Phản hồi</a>
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