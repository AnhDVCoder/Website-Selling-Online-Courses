<?php
    include '../connectdb.php';
    include '../function.php';
    session_start();

if (!isset($_SESSION['fullname'])) {
        header("location: DN.php");
    }
    
    $username = $_SESSION['username'];
    $fullname = $_SESSION['fullname']; 

    $permission = $_SESSION['permission'];
?>

<!DOCTYPE html>
<html lang="vi" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tìm kiếm</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style_tim_kiem.php">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- Font awesome -->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Custom css - Các file css do chúng ta tự viết -->
    <link rel="stylesheet" href="../css/style_tim_kiem.css" type="text/css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main role="main">
        <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
        <div class="container mt-4">
            <form name="frmTimKiem" method="GET" action="">
                <h1 class="text-center">Tìm kiếm sản phẩm</h1>
                <div class="row">
                    <div class="col col-md-12">
                        <h5 class="text-center">Cung cấp kiến thức nền tảng về Lập trình, Thiết kế Web, Cơ sở dữ liệu
                        </h5>
                        <h5 class="text-center">Giúp các bạn có niềm tin, hành trang kiến thức vững vàng trên con đường
                            trở
                            thành Nhà phát triển Phần mềm</h5>
                        
                    </div>
                </div>
                <div class="row">
                    <aside class="col-sm-4">
                        <p>Bộ lọc </p>
                        <div class="card">
                            <article class="card-group-item">
                                <div class="filter-content">
                                    <div class="card-body">
                                        <div class="custom-control custom-checkbox">
                                            <span class="float-right badge badge-light round"></span>
                                            <input type="radio" class="custom-control-input"
                                                name="search_type" value="keyword" id="chk-nhasanxuat-1" checked>
                                            <label class="custom-control-label" for="chk-nhasanxuat-1">Từ khóa</label>
                                            <span class="float-right badge badge-light round"></span>
                                            <input type="radio" class="custom-control-input"
                                                name="search_type" value="tag" id="chk-nhasanxuat-2">
                                            <label class="custom-control-label" for="chk-nhasanxuat-2">Thẻ</label>
                                        </div> <!-- form-check.// -->
                                    </div>
                                </div>
                            </article>

                            <!-- Tìm kiếm theo tên khóa học -->
                            <article class="card-group-item">
                                <div class="filter-content">
                                    <div class="card-body">
                                        <input class="form-control" type="text" placeholder="Nhập từ khóa cần tìm"
                                            aria-label="Search" name="name">
                                            <br>
                                    </div>
                                </div>
                            </article>
                            <article>
                                <select name="price" id="cs" style="width: 15%;">
                                    <option value="0">Chọn khoảng giá</option>
                                    <option value="1">Miễn phí</option>
                                    <option value="2">Dưới 1 triệu</option>
                                    <option value="3">Từ 1 - 2 triệu</option>
                                    <option value="4">Từ 2 - 5 triệu</option>
                                    <option value="5">Trên 5 triệu</option>
                                </select>
                            </article>
                            <article class="card-group-item">
                                <div class="filter-content">
                                    <div class="card-body">
                                        <input type="submit" class="btn btn-primary btn-lg" name="search" value="Tìm kiếm">
                                        <a href="tim_kiem.php" class="btn btn-primary btn-lg">Xóa bộ lọc</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </aside>

                    <div class="col-sm-8 mt-2">
                        <div id="list_item">
                            
                        
                        <?php
                            $kq =  "";
                            // $SQL_AND = "";
                            $SQL_KG = "";
                            
                            
                            if (isset($_GET['search'])) {

                                if($_GET['name'] == "" AND $_GET['price'] == 0){
                                    $kq =  "Bạn chưa nhập từ khóa cần tìm";
                                    $flag1 = false;
                                }
                                else{
                                    $flag1 = true;
                                    $khoang_gia = $_GET['price'];
                                    if($khoang_gia == 1){
                                        $SQL_KG = "KH.gia = 0 AND ";
                                    }
                                    elseif($khoang_gia == 2){
                                        $SQL_KG = "KH.gia > 0 AND KH.gia < 1000000 AND ";
                                    }
                                    elseif($khoang_gia == 3){
                                        $SQL_KG = "KH.gia >= 1000000 AND KH.gia <= 2000000 AND ";
                                    }
                                    elseif($khoang_gia == 4){
                                        $SQL_KG = "KH.gia BETWEEN 2000000 AND 5000000 AND ";
                                    }
                                    elseif($khoang_gia == 5){
                                        $SQL_KG = "KH.gia > 5000000 AND ";
                                    }
                                    $search_string = $_GET['name'];
                                    

                                    if(isset($_GET['search_type'])){
                                        $search_type = $_GET['search_type'];
                                        if($search_type == "tag"){
                                            $SQL = "
                                                    SELECT * 
                                                    FROM khoa_hoc AS KH 
                                                    JOIN khoa_hoc_phan_loai AS KHPL
                                                    ON KH.id_khoa_hoc = KHPL.ID_khoa_hoc
                                                    JOIN list_phan_loai AS LPL 
                                                    ON KHPL.ID_phan_loai = LPL.ID
                                                    WHERE ".$SQL_KG." LPL.name LIKE '%".$search_string."%'";
                                        }
                                        else{
                                            $SQL = "
                                                    SELECT * 
                                                    FROM khoa_hoc AS KH
                                                    WHERE ".$SQL_KG." (KH.ten_khoa_hoc LIKE '%".$search_string."%' OR mo_ta LIKE '%".$search_string."%')";
                                        }
                                    }
                                    else{
                                        $SQL = "
                                                SELECT * 
                                                FROM khoa_hoc AS KH
                                                WHERE ".$SQL_KG." (KH.ten_khoa_hoc LIKE '%".$search_string."%' OR mo_ta LIKE '%".$search_string."%')";
                                    }
                                }


                                


                                if($flag1 == true){

                                    $DLFromKhoa_hoc = mysqli_query($connect, $SQL);
                                    $count = mysqli_num_rows($DLFromKhoa_hoc);
                                    // echo $count;
                                    if ($count > 0) {
                                        $i = 1;
                                        while($listKH = mysqli_fetch_assoc($DLFromKhoa_hoc)) {
                                            echo "
                                            <div id='item'>
                                                <a href='"; 
                                                $SQL = "SELECT username FROM khoa_hoc_da_mua WHERE id_khoa_hoc = ".$listKH['id_khoa_hoc']." AND username = '".$username."'";
                                                if (mysqli_num_rows(mysqli_query($connect, $SQL)) > 0) {
                                                    echo "chi_tiet_khoa_hoc";
                                                }
                                                else{
                                                    echo "mo_ta";
                                                };
                                                echo ".php?id_khoa_hoc=".$listKH['id_khoa_hoc']."'>
                                                    <img src='".$listKH['thumbnail']."' id = 'imgthumbnail'><br>
                                                </a>
                                                <p>".$listKH['ten_khoa_hoc']."</p>
                                                <br>
                                                <p> Giá: ".number_format($listKH['gia'])." VNĐ</p>
                                                <br>
                                                <p style='color:gray'><i class='fa fa-eye' aria-hidden='true'></i> ".$listKH['luot_xem']." Lượt xem</p>
                                                <br>
                                                <a class='button' href='";
                                                if (mysqli_num_rows(mysqli_query($connect, $SQL)) > 0) {
                                                    echo "chi_tiet_khoa_hoc";
                                                }
                                                else{
                                                    echo "mo_ta";
                                                };
                                                echo ".php?id_khoa_hoc=".$listKH['id_khoa_hoc']."'>
                                                    <p>";
                                                if (mysqli_num_rows(mysqli_query($connect, $SQL)) > 0) {
                                                    echo "Vào học";
                                                }
                                                else{
                                                    echo "Vào xem";
                                                };   
                                                echo "</p>
                                                </a>
                                            </div>
                                        ";



                                        }
                                    }
                                    else{
                                            echo "Không tìm thấy khóa học nào!";
                                        }
                                }
                                
                               
                                echo $kq;
                            }
                                
                                
                            
                        ?>
                        
                        </div>
                    </div>
                </div> <!-- row.// -->
            </form>
        </div>
        <!-- End block content -->
    </main>


<?php include "footer.php" ?>
</body>

</html>