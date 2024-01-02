-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for cuoikyweb
CREATE DATABASE IF NOT EXISTS `cuoikyweb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cuoikyweb`;

-- Dumping structure for table cuoikyweb.bai_hoc_da_nop
CREATE TABLE IF NOT EXISTS `bai_hoc_da_nop` (
  `id_bai_hoc` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `thoi_gian_nop` datetime NOT NULL,
  `bai_nop_path` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  KEY `FK_bai_hoc_da_nop_list_bai_hoc` (`id_bai_hoc`),
  KEY `FK_bai_hoc_da_nop_information` (`username`),
  CONSTRAINT `FK_bai_hoc_da_nop_information` FOREIGN KEY (`username`) REFERENCES `information` (`username`),
  CONSTRAINT `FK_bai_hoc_da_nop_list_bai_hoc` FOREIGN KEY (`id_bai_hoc`) REFERENCES `list_bai_hoc` (`ID_bai_hoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuoikyweb.bai_hoc_da_nop: ~0 rows (approximately)

-- Dumping structure for table cuoikyweb.ho_tro
CREATE TABLE IF NOT EXISTS `ho_tro` (
  `id_y_kien` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tieu_de` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `noi_dung` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `noi_dung_phan_hoi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT '0',
  `thoi_gian` datetime DEFAULT NULL,
  PRIMARY KEY (`id_y_kien`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table cuoikyweb.ho_tro: ~6 rows (approximately)
INSERT INTO `ho_tro` (`id_y_kien`, `username`, `tieu_de`, `noi_dung`, `noi_dung_phan_hoi`, `trang_thai`, `thoi_gian`) VALUES
	(1, 'anhdv181', 'adad', 'ádasasd', NULL, 1, NULL),
	(2, 'anhdv181', 'adad', 'ádasasd', NULL, 1, NULL),
	(3, 'anhdv181', 'ăd', 'ădawdawdwd', 'hehe', 0, NULL),
	(4, 'user18', 'Test', '123', 'hello', 1, '2023-11-28 20:50:59'),
	(5, 'user2', 'Hỗ trợ mua khóa học', 'Em không mua khóa học như nào, vui lòng giúp đỡ', 'Hiện tại tính năng đang phát triển, em vui lòng chờ vài ngày, rất xin lỗi em nhiều', 0, '2023-11-29 10:38:20'),
	(6, 'user2', 'Hỗ trợ xem khóa học', 'Xem không biết xem khóa học đã mua kiểu gì, vui lòng giúp', 'trang chủ, ấn xem', 1, '2023-11-29 10:40:35');

-- Dumping structure for table cuoikyweb.information
CREATE TABLE IF NOT EXISTS `information` (
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '../images/avatars/default.jpg',
  `permission` int NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table cuoikyweb.information: ~22 rows (approximately)
INSERT INTO `information` (`username`, `password`, `fullname`, `email`, `gender`, `avatar`, `permission`) VALUES
	('admin', '12345678', 'Quản trị', 'anhdv181@icloud.com', 'Nam', '../images/avatars/default.jpg', 2),
	('AnhDV181', '12345678', 'Doãn Việt Anh', 'vanhhd2002@gmail.com', 'Nam', '../images/avatars/AnhDV181.png', 2),
	('user18', '12345678', 'Người dùng 18', 'user18@gmail.com', 'Nam', '../images/avatars/user18.png', 1),
	('user19', '12345678', 'Người dùng 19', 'user19@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user2', '12345678', 'Người dùng 2', 'user2@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user20', '12345678', 'Người dùng 20', 'user20@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user21', '12345678', 'Người dùng 21', 'user21@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user22', '12345678', 'Người dùng 22', 'user22@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user23', '12345678', 'Người dùng 23', 'user23@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user24', '12345678', 'Người dùng 24', 'user24@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user25', '12345678', 'Người dùng 25', 'user25@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user26', '12345678', 'Người dùng 26', 'user26@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user27', '12345678', 'Người dùng 27', 'user27@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user28', '12345678', 'Người dùng 28', 'user28@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user29', '12345678', 'Người dùng 29', 'user29@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user3', '12345678', 'Người dùng 3', 'user3@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user30', '12345678', 'Người dùng 30', 'user30@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user4', '12345678', 'Người dùng 4', 'user4@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user5', '12345678', 'Người dùng 5', 'user5@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user6', '12345678', 'Người dùng 6', 'user6@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user7', '87654321', 'Người dùng 7', '123mimac191@gmail.com', 'Nam', '../images/avatars/default.jpg', 1),
	('user8', '22223333', 'Nguyễn Văn 10', 'user181@gmail.com', 'Nữ', '../images/avatars/user8.png', 1),
	('user9', '12345678', 'Người dùng 9', 'trinh5420@gmail.com', 'Nam', '../images/avatars/default.jpg', 1);

-- Dumping structure for table cuoikyweb.khoa_hoc
CREATE TABLE IF NOT EXISTS `khoa_hoc` (
  `id_khoa_hoc` int NOT NULL AUTO_INCREMENT,
  `ten_khoa_hoc` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ten_tac_gia` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `luot_xem` int DEFAULT '0',
  `thumbnail` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '../images/default.jpg',
  `tags` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mo_ta` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `ngay_tao` date NOT NULL DEFAULT '2023-01-01',
  `gia` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_khoa_hoc`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table cuoikyweb.khoa_hoc: ~5 rows (approximately)
INSERT INTO `khoa_hoc` (`id_khoa_hoc`, `ten_khoa_hoc`, `ten_tac_gia`, `luot_xem`, `thumbnail`, `tags`, `mo_ta`, `ngay_tao`, `gia`) VALUES
	(2, 'Lập trình JavaScript cơ bản', 'AnhDV', 160, '../images/thumbnail/2.jpg', '', 'Đây là khóa học lập trình JS cơ bản, very cơ bản, không học được thì chịu', '2023-01-01', 800000),
	(3, 'Lập trình JavaScript nâng cao', 'Việt Hưng', 131, '../images/thumbnail/3.jpg', '', 'Đây là khóa học lập trình JS cơ bản, very cơ bản, không học được thì chịu', '2023-01-01', 1200000),
	(4, 'Lập trình C++ cơ bản', 'Khang An', 67, '../images/thumbnail/4.jpg', '', '', '2023-01-01', 600000),
	(6, 'MySQL Cơ bản', 'Vanh', 2, '../images/thumbnail/6.jpg', '', '', '2023-01-01', 900000),
	(29, 'khóa học 2', 'Doãn Việt Anh', 17, '../images/default.jpg', '', '', '2023-01-01', 0);

-- Dumping structure for table cuoikyweb.khoa_hoc_da_mua
CREATE TABLE IF NOT EXISTS `khoa_hoc_da_mua` (
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_khoa_hoc` int NOT NULL,
  `ngay_mua` date DEFAULT NULL,
  KEY `username` (`username`),
  KEY `id_khoa_hoc` (`id_khoa_hoc`),
  CONSTRAINT `FK_khoa_hoc_da_mua_information` FOREIGN KEY (`username`) REFERENCES `information` (`username`),
  CONSTRAINT `FK_khoa_hoc_da_mua_khoa_hoc` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuoikyweb.khoa_hoc_da_mua: ~1 rows (approximately)
INSERT INTO `khoa_hoc_da_mua` (`username`, `id_khoa_hoc`, `ngay_mua`) VALUES
	('user8', 2, NULL),
	('AnhDV181', 4, NULL);

-- Dumping structure for table cuoikyweb.khoa_hoc_phan_loai
CREATE TABLE IF NOT EXISTS `khoa_hoc_phan_loai` (
  `ID_khoa_hoc` int NOT NULL,
  `ID_phan_loai` int NOT NULL,
  KEY `ID_khoa_hoc` (`ID_khoa_hoc`),
  KEY `FK_khoa_hoc_phan_loai_list_phan_loai` (`ID_phan_loai`),
  CONSTRAINT `FK__khoa_hoc` FOREIGN KEY (`ID_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`),
  CONSTRAINT `FK_khoa_hoc_phan_loai_list_phan_loai` FOREIGN KEY (`ID_phan_loai`) REFERENCES `list_phan_loai` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuoikyweb.khoa_hoc_phan_loai: ~5 rows (approximately)
INSERT INTO `khoa_hoc_phan_loai` (`ID_khoa_hoc`, `ID_phan_loai`) VALUES
	(4, 8),
	(3, 9),
	(6, 8),
	(2, 8),
	(29, 9);

-- Dumping structure for table cuoikyweb.list_bai_hoc
CREATE TABLE IF NOT EXISTS `list_bai_hoc` (
  `ID_khoa_hoc` int NOT NULL,
  `ID_bai_hoc` int NOT NULL AUTO_INCREMENT,
  `Ten_bai_hoc` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `video_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `Video_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `De_bai_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `noi_dung` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`ID_bai_hoc`),
  KEY `ID_khoa_hoc` (`ID_khoa_hoc`),
  CONSTRAINT `list_bai_hoc_ibfk_1` FOREIGN KEY (`ID_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table cuoikyweb.list_bai_hoc: ~19 rows (approximately)
INSERT INTO `list_bai_hoc` (`ID_khoa_hoc`, `ID_bai_hoc`, `Ten_bai_hoc`, `video_type`, `Video_path`, `De_bai_path`, `noi_dung`) VALUES
	(2, 14, 'Cài đặt môi trường', 'link', 'https://www.youtube.com/embed/efI98nT8Ffo', '../khoa_hoc/2/Bai1.pdf', NULL),
	(2, 16, 'Sử dụng JavaScript với HTML', 'link', 'https://www.youtube.com/embed/W0vEUmyvthQ', '../khoa_hoc/2/Bai15.pdf', NULL),
	(4, 17, 'Giới Thiệu khóa học C++', 'link', 'https://www.youtube.com/embed/Da1tpV9TMU0', '../khoa_hoc/4/Bai17.pdf', NULL),
	(3, 19, 'IIFE trong Javascript', 'link', 'https://www.youtube.com/embed/N-3GU1F1UBY', '../khoa_hoc/3/Bai1.pdf', ''),
	(2, 21, 'Khai báo biến', 'link', 'https://www.youtube.com/embed/CLbx37dqYEI', '../khoa_hoc/2/Bai17.pdf', NULL),
	(2, 22, 'Comments', 'link', 'https://www.youtube.com/embed/xRpXBEq6TOY', '../khoa_hoc/2/Bai22.pdf', NULL),
	(4, 23, 'Cài đặt Dev - C++', 'link', 'https://www.youtube.com/embed/9_uoKY0AwqE', '../khoa_hoc/4/Bai18.pdf', NULL),
	(4, 24, 'Hướng dẫn sử dụng Dev - C++', 'link', 'https://www.youtube.com/embed/vFhKEYRBmVY', '../khoa_hoc/4/Bai24.pdf', NULL),
	(4, 25, 'Biến và nhập xuất dữ liệu 2', 'link', 'https://www.youtube.com/embed/Z5O6pxQm6II', '../khoa_hoc/4/Bai25.pdf', '<p><i>Biến, hằng giống như những chiếc hộp có tên riêng mà chúng ta có thể để dữ liệu vào và mang ra mỗi khi chúng ta cần sử dụng. Biến khác hằng ở chỗ giá trị lưu trữ trong biến có thể thay đổi trong quá trình thực hiện chương trình; còn giá thị của hằng thì được định nghĩa ngay từ đầu chương trình, không thay đổi trong suốt quá trình thực hiện chương trình.</i></p><p><i>Hehe</i></p><p>&nbsp;</p><p><i>Hoho</i></p><p><i><strong>Xin chào</strong></i></p>'),
	(4, 26, 'Kiểu dữ liệu thường gặp', 'link', 'https://www.youtube.com/embed/qpIautEyv2s', '../khoa_hoc/4/Bai26.pdf', NULL),
	(3, 27, 'Scope trong Javascript', 'link', 'https://www.youtube.com/embed/5N8vz_VmszE', '../khoa_hoc/3/Bai20.pdf', NULL),
	(3, 28, 'Closure trong Javascript ', 'link', 'https://www.youtube.com/embed/xtQtGKL0NCI', '../khoa_hoc/3/Bai28.pdf', NULL),
	(3, 29, 'Hoisting trong Javascript', 'link', 'https://www.youtube.com/embed/3MLhU1DrUxM', '../khoa_hoc/3/Bai29.pdf', NULL),
	(6, 36, 'Cài đặt MySQL Server & MySQL Workbench', 'link', 'https://www.youtube.com/embed/BYwb50Xbf8s', '../khoa_hoc/6/Bai1.pdf', NULL),
	(6, 37, 'Cài đặt Microsoft SQL Server 2019', 'link', 'https://www.youtube.com/embed/WZZkDdklVlk', '../khoa_hoc/6/Bai37.pdf', NULL),
	(6, 38, 'CSDL quan hệ và Hệ quản trị CSDL', 'link', 'https://www.youtube.com/embed/InUDwfsGG4A', '../khoa_hoc/6/Bai38.pdf', NULL),
	(6, 39, 'Tạo vs Xóa Database bằng câu truy vấn SQL', 'link', 'https://www.youtube.com/embed/DGXCp-iajEg', '../khoa_hoc/6/Bai39.pdf', NULL),
	(6, 40, 'Tạo và xóa bảng bằng câu truy vấn SQL', 'link', 'https://www.youtube.com/embed/l2ODvlsKu5Q', '../khoa_hoc/6/Bai40.exe', NULL),
	(6, 41, 'Tạo và xóa bảng bằng câu truy vấn SQL', 'link', 'https://www.youtube.com/embed/l2ODvlsKu5Q', '../khoa_hoc/6/Bai41.pdf', NULL);

-- Dumping structure for table cuoikyweb.list_phan_loai
CREATE TABLE IF NOT EXISTS `list_phan_loai` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuoikyweb.list_phan_loai: ~6 rows (approximately)
INSERT INTO `list_phan_loai` (`ID`, `name`, `description`) VALUES
	(1, 'test', ''),
	(6, 'THPT', 'Phân loại này nhằm gán vào những khóa học dành cho khối THPT'),
	(7, 'THCS', 'Phân loại này nhằm gán vào những khóa học dành cho khối THCS'),
	(8, 'co-ban', ''),
	(9, 'nang-cao', ''),
	(10, 'TH', '');

-- Dumping structure for table cuoikyweb.quen_mat_khau
CREATE TABLE IF NOT EXISTS `quen_mat_khau` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` int NOT NULL,
  `dtime_start` datetime NOT NULL,
  `dtime_end` datetime NOT NULL,
  `status` tinyint NOT NULL,
  KEY `FK_quen_mat_khau_information` (`username`),
  CONSTRAINT `FK_quen_mat_khau_information` FOREIGN KEY (`username`) REFERENCES `information` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuoikyweb.quen_mat_khau: ~16 rows (approximately)
INSERT INTO `quen_mat_khau` (`email`, `username`, `code`, `dtime_start`, `dtime_end`, `status`) VALUES
	('user20@gmail.com', 'user20', 779862, '2023-12-30 22:28:16', '2023-12-31 13:07:33', 0),
	('user20@gmail.com', 'user20', 383166, '2023-12-31 11:57:56', '2023-12-31 13:07:33', 0),
	('user20@gmail.com', 'user20', 802165, '2023-12-31 11:58:54', '2023-12-31 13:07:33', 0),
	('user20@gmail.com', 'user20', 293225, '2023-12-31 11:59:14', '2023-12-31 13:07:33', 0),
	('user2@gmail.com', 'user2', 929976, '2023-12-31 13:27:33', '2023-12-31 13:43:00', 0),
	('user20@gmail.com', 'user20', 137951, '2023-12-31 14:12:33', '2023-12-31 14:22:33', 0),
	('vanhhd2002@gmail.com', 'AnhDV181', 994660, '2023-12-31 14:14:25', '2023-12-31 14:24:25', 0),
	('vanhhd2002@gmail.com', 'AnhDV181', 290893, '2023-12-31 14:18:28', '2023-12-31 14:28:28', 0),
	('vanhhd2002@gmail.com', 'AnhDV181', 749249, '2023-12-31 14:18:29', '2023-12-31 14:28:29', 0),
	('vanhhd2002@gmail.com', 'AnhDV181', 268208, '2023-12-31 14:34:20', '2023-12-31 14:44:20', 0),
	('trinh5420@gmail.com', 'user9', 626786, '2023-12-31 14:39:27', '2023-12-31 14:49:27', 0),
	('trinh5420@gmail.com', 'user9', 124852, '2023-12-31 14:41:40', '2023-12-31 14:51:40', 0),
	('123mimac191@gmail.com', 'user7', 920026, '2023-12-31 15:09:14', '2023-12-31 15:19:14', 0),
	('123mimac191@gmail.com', 'user7', 340486, '2023-12-31 15:11:42', '2023-12-31 15:21:42', 0),
	('123mimac191@gmail.com', 'user7', 685165, '2023-12-31 15:17:09', '2023-12-31 15:20:00', 0),
	('123mimac191@gmail.com', 'user7', 113804, '2023-12-31 15:20:10', '2023-12-31 15:30:10', 0);

-- Dumping structure for table cuoikyweb.save_bh
CREATE TABLE IF NOT EXISTS `save_bh` (
  `ID_BH` int DEFAULT NULL,
  `Save` int DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cuoikyweb.save_bh: ~2 rows (approximately)
INSERT INTO `save_bh` (`ID_BH`, `Save`, `username`) VALUES
	(123, 1, ''),
	(123, 1, '');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
