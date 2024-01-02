<?php
	function LayBaiHoc($connect, $id_khoa_hoc, $id_bai_hoc){
		$SQL = "SELECT Ten_bai_hoc, video_type, Video_path, De_bai_path
			FROM list_bai_hoc
			WHERE ID_khoa_hoc =".$id_khoa_hoc." AND ID_bai_hoc = ".$id_bai_hoc;

		$Query = mysqli_query($connect, $SQL);

		return $Query;
	}

	function ListBaiHoc($connect, $id_khoa_hoc){
		$SQL = "SELECT Ten_bai_hoc, ID_bai_hoc
			FROM list_bai_hoc
			WHERE ID_khoa_hoc =".$id_khoa_hoc;

		$Query = mysqli_query($connect, $SQL);

		return $Query;
	}

	function LinktoEmbed($txtLink){
		$arr1 = explode("=", $txtLink);
			if (in_array("https://www.youtube.com/watch?v", $arr1)) {
				$temp = $arr1[1];
				$arr2 = explode("&", $temp);
				$code = "https://www.youtube.com/embed/".$arr2[0];
			}
			else{
				// echo "else";
				$arr1 = explode("embed", $txtLink);
				if (in_array("https://www.youtube.com/", $arr1)) {
					$code = $txtLink;
				}
				else{
					// echo "Link lỗi!";
					$code = "Error";
				}
			}
		return $code;
	}

	function countLuotXem($connect, $id_khoa_hoc){
		$SQL = "SELECT luot_xem
				FROM khoa_hoc
				WHERE id_khoa_hoc =".$id_khoa_hoc;

		$Query = mysqli_query($connect, $SQL);

		if (mysqli_num_rows($Query) > 0) {
	        $data = mysqli_fetch_assoc($Query);
			$luot_xem = $data['luot_xem'];
		}

		$luot_xem = tangLuotXem($connect, $luot_xem, $id_khoa_hoc);

		return $luot_xem;
	}

	function tangLuotXem($connect, $luot_xem, $id_khoa_hoc){
		$luot_xem += 1;
		$SQL1 = "
				UPDATE khoa_hoc
				SET luot_xem =".$luot_xem."
				WHERE id_khoa_hoc =".$id_khoa_hoc;

		$Query1 = mysqli_query($connect, $SQL1);

		return $luot_xem;


	}

	function getID_bai_tap($connect, $id_khoa_hoc){
		

		return $id_bai_hoc;

	}

	function getDLfromKhoaHoc($connect, $id_khoa_hoc){
		$SQL = "
				SELECT *
				FROM khoa_hoc
				WHERE id_khoa_hoc =".$id_khoa_hoc;

		$Query = mysqli_query($connect, $SQL);
		return $Query;
	}

	function getDLfromlist_bai_hoc($connect, $id_bai_hoc){
		$SQL = "
			SELECT *
			FROM list_bai_hoc
			WHERE ID_bai_hoc =".$id_bai_hoc;

		$Query = mysqli_query($connect, $SQL);
		return $Query;
	}

	function insertDLBaiHoc($connect, $id_khoa_hoc, $ten_bai_hoc, $video_type, $video_path, $de_bai_path, $noi_dung){
		$SQL = "INSERT INTO list_bai_hoc (ID_khoa_hoc, Ten_bai_hoc, video_type, Video_path, De_bai_path, noi_dung) VALUES('".$id_khoa_hoc."', '".$ten_bai_hoc."', '".$video_type."', '".$video_path."', '".$de_bai_path."', '".$noi_dung."')";
		$Query = mysqli_query($connect, $SQL);
	}

	function updateDLBaiHoc($connect, $ten_bai_hoc, $video_type, $video_path, $de_bai_path, $id_bai_hoc, $noi_dung){
		$SQL = "UPDATE list_bai_hoc SET Ten_bai_hoc ='".$ten_bai_hoc."', video_type ='".$video_type."', Video_path ='".$video_path."', De_bai_path ='".$de_bai_path."', noi_dung ='".$noi_dung."' WHERE ID_bai_hoc =".$id_bai_hoc;
		
		if ($Query = mysqli_query($connect, $SQL)) {
			echo "Success SQL";
		}
		else{
			echo "ERROR SQL";
		}
	}

	function getPermission($connect, $username){
		$SQL = "
			SELECT permission
			FROM information
			WHERE username ='".$username."'";
		$Query = mysqli_query($connect, $SQL);
		$DATA = mysqli_fetch_assoc($Query);
		$permission = isset($DATA['permission']);

		return $permission;

	}

	function getIDkhoa_hocmoinhat($connect){
		$SQL1 = "SELECT id_khoa_hoc FROM khoa_hoc ORDER BY id_khoa_hoc DESC";
		$Query1 = mysqli_query($connect, $SQL1);

		if (mysqli_num_rows($Query1) > 0) {
			$DATA = mysqli_fetch_assoc($Query1);
			$id_khoa_hoc_moi_nhat = $DATA['id_khoa_hoc'];
		}
		else{
			$id_khoa_hoc_moi_nhat = 0;
		}

		return $id_khoa_hoc_moi_nhat;
	}

	function insertKhoa_hoc($connect, $ten_khoa_hoc, $ten_tac_gia, $thumbnail, $mo_ta, $thoi_gian, $gia){
		$SQL = "INSERT INTO khoa_hoc (ten_khoa_hoc, ten_tac_gia, thumbnail, mo_ta, ngay_tao, gia) VALUES('".$ten_khoa_hoc."', '".$ten_tac_gia."', '".$thumbnail."', '".$mo_ta."', '".$thoi_gian."', '".$gia."')";
		$Query = mysqli_query($connect, $SQL);
	}

	function updateKhoa_hoc($connect, $ten_khoa_hoc, $ten_tac_gia, $thumbnail, $id_khoa_hoc, $mo_ta, $gia){
		$SQL = "UPDATE khoa_hoc SET ten_khoa_hoc = '".$ten_khoa_hoc."', ten_tac_gia = '".$ten_tac_gia."', thumbnail = '".$thumbnail."', mo_ta = '".$mo_ta."', gia = '".$gia."' WHERE id_khoa_hoc =".$id_khoa_hoc;
		$Query = mysqli_query($connect, $SQL);
	}

	function countAnswer($connect, $id_cau_hoi){
		$SQL = "SELECT COUNT(id_cau_hoi) AS count FROM answer WHERE id_cau_hoi =".$id_cau_hoi;
		$Query = mysqli_query($connect, $SQL);

		$row = mysqli_fetch_assoc($Query);
		$count = $row['count'];

		return $count;
	}

	function getDLfromAnswer($connect, $id_cau_hoi){
		$SQL = "
			SELECT id_cau_tra_loi, cau_tra_loi
			FROM answer
			WHERE id_cau_hoi =".$id_cau_hoi;

		$Query = mysqli_query($connect, $SQL);
		return $Query;
		// , COUNT(id_cau_tra_loi) AS count
	}

	function insertRespond($connect, $id_phan_hoi, $phan_hoi){
		$SQL = "INSERT INTO respond (id_ticket, noi_dung) VALUES ('".$id_phan_hoi."', '".$phan_hoi."')";
		$Query = mysqli_query($connect, $SQL);

	}

	function setTrangThai($connect, $id_phan_hoi){
		$SQL = "UPDATE ho_tro SET trang_thai = 1 WHERE id_ticket =".$id_phan_hoi;
		$Query = mysqli_query($connect, $SQL);
	}

		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;
 
		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';

	function quenMatKhau($connect, $email, $code){
		

		$mail = new PHPMailer(true);

		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;// Enable verbose debug output
		$mail->isSMTP();// gửi mail SMTP
		$mail->Host = 'smtp.gmail.com';// Set the SMTP server to send through
		$mail->SMTPAuth = true;// Enable SMTP authentication
		$mail->Username = 'anhdv181@gmail.com';// SMTP username
		$mail->Password = 'eqfi uxgq gcuv gzla'; // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port = 587; // TCP port to connect to

		//Người gửi/nhận
		$mail->setFrom('anhdv181@gmail.com', 'Edubit');
		$mail->addAddress($email , 'User');

		// Nội dung
		$mail->isHTML(true);
		$mail->Subject = "Ma xac minh tai khoan cua ban: ".$code;
		$mail->Body = "Chung toi nhan duoc yeu cau quen mat khau cua ban!<br>- Ma xac nhan cua ban la: ".$code."<br>- Xin vui long khong chia se ma nay cho bat ky ai de tranh mat tai khoan!";
		$mail->AltBody = 'Tu Edubit';

		$mail->send();
	}
		
?>