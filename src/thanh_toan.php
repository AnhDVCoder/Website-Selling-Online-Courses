<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');  
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
        header("location: DN.php");
    }

    if(!isset($_GET['id_khoa_hoc'])){
        header("location: khoa_hoc.php");
    }
    else{
        $id_khoa_hoc = $_GET['id_khoa_hoc'];
        $SQL = "SELECT * FROM khoa_hoc WHERE id_khoa_hoc =".$id_khoa_hoc;
        $DLFromKH = mysqli_query($connect, $SQL);
        if (mysqli_num_rows($DLFromKH) > 0) {
            $listKH = mysqli_fetch_assoc($DLFromKH);
            $tenKH = $listKH['ten_khoa_hoc'];
            $tenNHD = $listKH['ten_tac_gia'];
            $giaKH = $listKH['gia'];

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="../css/style_tim_kiem.css">
    <link rel="stylesheet" href="../css/style.php">
    <!-- <h1 class='logo'></h1> -->
    
</head>
<body>
    <?php include 'header.php'; ?>


  <main role="main">
    
    <div class="container mt-4">
        <div class="boxx" style="width: 200px;">
            <?php
            // $id_khoa_hoc = 1;
            // $username = "anhdv";

            $noidung = $id_khoa_hoc."KH".$username;
            
            // echo $dem;
            // $gia = 1000000;
            $qr = "https://qr.sepay.vn/img?acc=67893158888&bank=TPBank&amount=".$giaKH."&des=".$noidung;
            echo "<img src='".$qr."' title='Ngân hàng TPBank, STK: 6789.315.8888, Chủ tài khoản: Doãn Việt Anh'/>";
            echo "<br><br>Ngân hàng: Tiên Phong Bank<br>Số tài khoản 6789 315 8888<br>Chủ tài khoản: Doãn Việt Anh<br>Số tiền: ".number_format($giaKH)."đ<br>Nội dung: ".$noidung;
        ?>
        </div>
        <div class="boxx1">
            <form class="needs-validation" name="frmthanhtoan" method="post"
            action="">
            <input type="hidden" name="kh_tendangnhap" value="dnpcuong">

            <div class="py-5 text-center">
                <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                <h2>Thanh toán</h2>
            </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Giỏ hàng</span>
                        <br>
                        <br>
                        <span class="badge badge-secondary badge-pill"></span>
                    </h4>
                    <ul class="list-group mb-3">
                        <input type="hidden" name="sanphamgiohang[1][sp_ma]" value="2">
                        <input type="hidden" name="sanphamgiohang[1][gia]" value="11800000.00">
                        <input type="hidden" name="sanphamgiohang[1][soluong]" value="2">

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div style="width: 500px;">
                                <h5 class="my-0">Tên khóa học: <?php echo $tenKH  ?></h5>
                                <br>
                                <h5 class="my-0">Người hướng dẫn: <?php echo $tenNHD  ?></h5>
                                <!-- <p>Người hướng dẫn: <?php echo $tenNHD  ?></p> -->
                                <!-- <small class="text-muted"></small> -->
                            </div>
                            <span class="text-muted"></span>
                        </li>
                        <input type="hidden" name="sanphamgiohang[2][sp_ma]" value="4">
                        <input type="hidden" name="sanphamgiohang[2][gia]" value="14990000.00">
                        <input type="hidden" name="sanphamgiohang[2][soluong]" value="8">

                        
                    </ul>

                </div>
                <div class="col-md-8 order-md-1">
                    



                    <hr class="mb-4">
                    
                </div>
                
                <div class="row" >
                  <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnDatHang">Thanh toán</button>
              </div>

            </div>

        </form>
        <?php
            $dtime_start = date('Y-m-d H:i:s');
            if(isset($_POST['btnDatHang'])){
                $SQL = "SELECT username FROM khoa_hoc_da_mua WHERE id_khoa_hoc =".$id_khoa_hoc." AND username = '".$username."'"; 
                if(mysqli_num_rows(mysqli_query($connect, $SQL)) > 0){
                    echo "Bạn đã mua khóa học này rồi!";
                }
                else{
                    $SQL = "INSERT INTO khoa_hoc_da_mua (username, id_khoa_hoc, ngay_mua) VALUES ('".$username."', $id_khoa_hoc, '".$dtime_start."')";
                    if(!mysqli_query($connect, $SQL)){
                        echo "Mua không thành công, vui lòng thử lại!";
                    }
                    else{
                        echo "Mua hàng thành công!";
                    }
                }
                
            }
        ?>
        </div>
        
        
        

    </div>
    <!-- End block content -->

</main>
       
      
</body>
</html>