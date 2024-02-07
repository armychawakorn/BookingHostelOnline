-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for hostel
CREATE DATABASE IF NOT EXISTS `hostel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `hostel`;

-- Dumping structure for table hostel.food
CREATE TABLE IF NOT EXISTS `food` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสอาหาร',
  `FoodName` varchar(200) NOT NULL COMMENT 'ชื่ออาหาร',
  `Description` longtext DEFAULT NULL COMMENT 'รายละเอียดอาหาร',
  `Price` int(11) NOT NULL DEFAULT 0 COMMENT 'ราคา',
  `Picture` longtext NOT NULL COMMENT 'รูป',
  `IsActive` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะ',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table hostel.member
CREATE TABLE IF NOT EXISTS `member` (
  `Username` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `Password` varchar(255) NOT NULL COMMENT 'พาสเวิร์ด',
  `FirstName` varchar(50) NOT NULL COMMENT 'ชื่อ',
  `LastName` varchar(50) NOT NULL COMMENT 'นามสกุล',
  `Email` varchar(150) NOT NULL COMMENT 'e-mail',
  `Mobile` varchar(50) NOT NULL COMMENT 'เบอร์โทร',
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่ลงทะเบียน',
  `IsActive` bit(1) NOT NULL COMMENT 'สถานะ',
  PRIMARY KEY (`Username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table hostel.bed
CREATE TABLE IF NOT EXISTS `bed` (
  `BedID` varchar(50) NOT NULL COMMENT 'หมายเลขเตียง',
  `RoomName` varchar(50) DEFAULT NULL COMMENT 'ชื่อห้อง',
  `MaxGuest` int(11) NOT NULL COMMENT 'จำนวนคนสูงสุดในเตียงนั้นๆ',
  `RoomType` varchar(50) NOT NULL COMMENT 'ประเภทห้อง',
  `Picture` varchar(1024) DEFAULT NULL COMMENT 'รูปภาพเตียง',
  `Price` int(11) NOT NULL COMMENT 'ราคา',
  `IsActivate` int(11) DEFAULT NULL COMMENT 'สถานะเตียง',
  PRIMARY KEY (`BedID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table hostel.booking
CREATE TABLE IF NOT EXISTS `booking` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับการจอง',
  `BookingCode` varchar(255) DEFAULT NULL COMMENT 'รหัสuuidการจอง',
  `BedId` varchar(50) DEFAULT NULL COMMENT 'หมายเลขเตียง',
  `MemberId` varchar(50) NOT NULL DEFAULT '' COMMENT 'หมายเลขลูกค้า',
  `BookingDate` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่จอง',
  `CheckInDate` datetime NOT NULL COMMENT 'วันที่เข้าพัก',
  `CheckOutDate` datetime NOT NULL COMMENT 'วันที่ออก',
  `BookingStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะการจอง',
  `Message` varchar(1000) NOT NULL COMMENT 'ช่องใส่ข้อความ',
  PRIMARY KEY (`Id`),
  KEY `Index 3` (`BookingCode`),
  KEY `FK_booking_bed` (`BedId`),
  KEY `FK_booking_member` (`MemberId`) USING BTREE,
  CONSTRAINT `FK_booking_bed` FOREIGN KEY (`BedId`) REFERENCES `bed` (`BedID`),
  CONSTRAINT `FK_booking_member` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table hostel.bookingdetail
CREATE TABLE IF NOT EXISTS `bookingdetail` (
  `BookingCode` varchar(255) NOT NULL COMMENT 'รหัสuuidการจอง',
  `BedId` varchar(50) NOT NULL DEFAULT '' COMMENT 'หมายเลขเตียง',
  `CheckInDate` datetime NOT NULL COMMENT 'วันที่เข้าพัก',
  `CheckOutDate` datetime NOT NULL COMMENT 'วันที่ออก',
  PRIMARY KEY (`BookingCode`) USING BTREE,
  KEY `FK_bookingdetail_bed` (`BedId`),
  CONSTRAINT `FK_bookingdetail_bed` FOREIGN KEY (`BedId`) REFERENCES `bed` (`BedID`),
  CONSTRAINT `FK_bookingdetail_booking` FOREIGN KEY (`BookingCode`) REFERENCES `booking` (`BookingCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table hostel.bookingmeal
CREATE TABLE IF NOT EXISTS `bookingmeal` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับการสั่ง',
  `BookingCode` varchar(255) NOT NULL COMMENT 'รหัสuuidการจอง',
  `FoodId` int(11) NOT NULL DEFAULT 0 COMMENT 'เลขอาหาร',
  `MemberId` varchar(50) NOT NULL COMMENT 'ลูกค้าที่สั่ง',
  `Status` int(11) NOT NULL COMMENT 'สถานะ',
  `Time` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่สั่ง',
  PRIMARY KEY (`Id`),
  KEY `FK_bookingmeal_member` (`MemberId`) USING BTREE,
  KEY `FK_bookingmeal_bookingdetail` (`BookingCode`),
  KEY `FK_bookingmeal_foods` (`FoodId`) USING BTREE,
  CONSTRAINT `FK_bookingmeal_bookingdetail` FOREIGN KEY (`BookingCode`) REFERENCES `bookingdetail` (`BookingCode`) ON DELETE CASCADE,
  CONSTRAINT `FK_bookingmeal_foods` FOREIGN KEY (`FoodId`) REFERENCES `food` (`Id`),
  CONSTRAINT `FK_bookingmeal_member` FOREIGN KEY (`MemberId`) REFERENCES `member` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table hostel.systemuser
CREATE TABLE IF NOT EXISTS `systemuser` (
  `Username` varchar(45) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `Password` varchar(255) NOT NULL COMMENT 'พาสเวิร์ด',
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
