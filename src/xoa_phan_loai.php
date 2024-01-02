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
	$phan_loai_del = $_GET['phan_loai_del'];

	$SQL = "DELETE FROM list_phan_loai WHERE ID = '"."$phan_loai_del"."'"; 
	if (!$Query = mysqli_query($connect, $SQL)) {
		echo "Lỗi SQL";
	}
	else{
		header("location: phan_loai.php");
	}
	

?>