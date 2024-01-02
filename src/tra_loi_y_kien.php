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
    <title>Phản hồi ý kiến</title>
   <link rel="stylesheet" href="../css/style.php">
   <link rel="stylesheet" href="../css/tra_loi_y_kien-css.php">
</head>
<body>
    <?php include 'header.php'; ?>
	<!-- <br> -->
    <?php
        $SQL = "
                SELECT *
                FROM ho_tro
                WHERE id_y_kien = ".$_GET['id_y_kien'];
        $DLFromYK = mysqli_query($connect, $SQL);
        if (mysqli_num_rows($DLFromYK) > 0) {
            $YK = mysqli_fetch_assoc($DLFromYK);
        }        
                        
    ?>
	<div class="box1">
		<br>
		<div class="box2">
            <div class="phan-hoi" >
                <h1>Chi tiết nội dung</h1> 
            </div>

            <div class="box3">
                <?php echo $YK['noi_dung']; ?>
            </div>

            <div class="box-phan-hoi">
                <form method="POST" action="">
                <div>
                    <h1>Phản hồi</h1>
                    <textarea name="box-tra-loi" class="box-tra-loi" cols="30" rows="10"></textarea>     
                </div>
            </div>
            
            <div class="gui">
                <h3><input type="submit" class="btn btn-primary" name="send" value="Gửi"></h3>
                </form>
            </div>
            <?php  
                if(isset($_POST['send'])){
                    $noi_dung_phan_hoi = $_POST['box-tra-loi'];
                    $SQL = "UPDATE ho_tro SET noi_dung_phan_hoi ='".$noi_dung_phan_hoi."' WHERE id_y_kien ='".$_GET['id_y_kien']."'";
                           if (!$Query = mysqli_query($connect, $SQL)) {
                            echo "Lỗi SQL";
                           };
                }
            ?>
		</div>
		<br>
	</div>
    
</body>
</html>