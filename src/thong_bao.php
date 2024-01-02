<?php
    include '../connectdb.php';

    session_start();
    $fullname = $_SESSION['fullname'];
    $username = $_SESSION['username'];
    $permission = $_SESSION['permission'];
    

    if (!isset($_SESSION['fullname'])) {
        header("location: DN.php");
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo</title>
   <link rel="stylesheet" href="../css/style.php">
   <link rel="stylesheet" href="../css/tra_loi_y_kien-css.php">
</head>
<body>

    <?php include 'header.php'; ?>
	<div class="box1">
		<br>
		<div class="box2">
    
    <div class="phan-hoi" >
        <h1>phản hồi về ý kiến của bạn</h1>
        <div  class="box4" >
            <ul class="message-list">
                <?php  
                    $SQL = "
                            SELECT *
                            FROM ho_tro
                            WHERE username ='".$username."' AND noi_dung_phan_hoi != ''
                            ORDER BY id_y_kien DESC
                            ";
                    $DLFromHT = mysqli_query($connect, $SQL);
                    if (mysqli_num_rows($DLFromHT) > 0) {
                        while($listTB = mysqli_fetch_assoc($DLFromHT)) {
                            echo "<a href='thong_bao.php?id_y_kien=".$listTB['id_y_kien']."'><li>".$listTB['tieu_de']."</li></a>";
                        }
                    }
                ?>
            </ul>

    

        </div>
    </div>
<div  class="box3" >
    <?php  
        if(isset($_GET['id_y_kien'])){
            $SQL = "
                            SELECT noi_dung_phan_hoi
                            FROM ho_tro
                            WHERE id_y_kien =".$_GET['id_y_kien'];
            $DLFromHT = mysqli_query($connect, $SQL);
            $DLNDPH = mysqli_fetch_assoc($DLFromHT);
            echo "<br>";
            echo $DLNDPH['noi_dung_phan_hoi'];
        }
    ?>

</div>
		</div>
		<br>
	</div>
    
</body>
</html>