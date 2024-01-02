<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
    <div id="menu-ngang">
        <ul>
            <li><a href="khoa_hoc.php"><img src="../images/logo.jpg" alt="" style="max-width: 80%";></a></li>
            <li><a href="gioi_thieu.php"><i class="fa fa-user" aria-hidden="true"></i> Giới thiệu</a></li>
            <li><a href="khoa_hoc.php"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Khóa học</a></li>
            <?php  
                if ($permission != 2) {
                    echo "<li><a href='lien_he.php'><i class='fa fa-comment' aria-hidden='true'></i> Liên hệ</a></li>";
                    
                }else{
                    echo "
                    <li>
                        <a href=''><i class='fa fa-user-circle-o' aria-hidden='true'></i> Quản lý</a>
                        <ul>
                            <li><a href='quan_ly_khoa_hoc.php'>Khóa học</a></li>
                            <li><a href='quan_li_user.php'>Tài khoản</a></li>
                            <li><a href='quan_ly_y_kien.php'>Ý kiến</a></li>
                            <li><a href='phan_loai.php'>Phân loại</a></li>
                        </ul>
                            
                    
                    </li>";
                }
            ?>
            
            <li><a href="tim_kiem.php"><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</a></li>           
        </ul>
        <a class="khoa_hoc_cua_toi" href="khoa_hoc_cua_toi.php" style=" 
                line-height: 50px;
                color: white;
                text-decoration: none; padding-left:180px;" >Khóa học của tôi</a>

        <ul id="menu-ngang-right">
            <li>
                <a href="">
                    <?php 
                        if(isset($_SESSION['fullname'])){
                            echo $_SESSION['fullname'];
                        }
                        else{
                            echo "Khách";
                        }
                    ?> 
                </a>

                <ul>

                    <li><a href="trang_ca_nhan.php">Trang cá nhân</a></li>
                    <li><a href="thong_bao.php">Thông báo</a></li>

                    <li id="test">
                        <form method="post">
                            <?php
                                if(isset($_SESSION['fullname'])){
                                    echo "<input type='submit' value='Đăng xuất' name='DangXuat' class='a' />";
                                }
                                else{
                                    echo "<input type='submit' value='Đăng nhập' name='DangNhap' class='a' />";
                                }
                            ?>
                            
                            <?php

                            if (isset($_POST['DangNhap'])) {
                                unset($_SESSION['fullname']); 
                                unset($_SESSION['username']);
                                unset($_SESSION['permission']);
                                header("location: dn.php");
                                die();
                            }
                            // isset($_SESSION['fullname']);
                            if (isset($_POST['DangXuat'])) {
                                unset($_SESSION['fullname']); 
                                unset($_SESSION['username']);
                                unset($_SESSION['permission']);

                                header("location: khoa_hoc.php");
                                die();
                            }
                            ?>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>