/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `cybershop` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cybershop`;

CREATE TABLE IF NOT EXISTS `activity_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `activity_status` (`id`, `status`) VALUES
	(1, 'Active'),
	(2, 'Deactive');

CREATE TABLE IF NOT EXISTS `admin` (
  `role` varchar(10) NOT NULL,
  `admin_email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `admin` (`role`, `admin_email`, `password`, `fname`, `lname`) VALUES
	('admin', 'cybershopAdmin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hex ', 'Op');

CREATE TABLE IF NOT EXISTS `blocked_status` (
  `id` int NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `blocked_status` (`id`, `status`) VALUES
	(0, 'UnBlocked'),
	(1, 'Blocked');

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_brand_category1_idx` (`category_id`),
  CONSTRAINT `fk_brand_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `brand` (`id`, `name`, `category_id`) VALUES
	(1, 'Apple', 1),
	(2, 'Samsung', 1),
	(3, 'Huawei', 1),
	(4, 'Apple', 2),
	(5, 'Asus', 2),
	(6, 'Acer', 2),
	(7, 'Apple watch', 3),
	(8, 'Samsung Watch', 3),
	(9, 'Asus', 4),
	(10, 'Dell', 4),
	(11, 'Logitech', 5),
	(12, 'Razer', 5),
	(13, 'Oppo', 1),
	(14, 'Nokia', 1),
	(15, 'Microsoft', 2),
	(16, 'Dell', 2),
	(17, 'Garmin', 3),
	(18, 'Acer', 4),
	(19, 'Viotek', 4);

CREATE TABLE IF NOT EXISTS `cansell` (
  `id` int NOT NULL AUTO_INCREMENT,
  `can` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `cansell` (`id`, `can`) VALUES
	(1, 'yes'),
	(2, 'no');

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) NOT NULL,
  `product_id` int NOT NULL,
  `qty` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  KEY `fk_cart_product1_idx` (`product_id`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `category` (`id`, `type`) VALUES
	(1, 'Mobile Phone'),
	(2, 'Laptop'),
	(3, 'Smart Watches'),
	(4, 'Monitor'),
	(5, 'Keyboards & Mouse');

CREATE TABLE IF NOT EXISTS `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `color` (`id`, `name`) VALUES
	(1, 'Black'),
	(2, 'White'),
	(3, 'Gray/Silver'),
	(4, 'Gold'),
	(5, 'Blue'),
	(6, 'Red'),
	(7, 'Purple'),
	(8, 'Yellow'),
	(9, 'Orange'),
	(10, 'Green'),
	(11, 'Pink'),
	(12, 'Coral Pink'),
	(13, 'Rose Gold'),
	(14, 'Nebula Purple'),
	(15, 'Ocean Depths'),
	(16, 'Lilac Purple'),
	(17, 'Green and Phantom Blue'),
	(18, 'Venom Black');

CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `condition` (`id`, `status`) VALUES
	(1, 'Brand New'),
	(2, 'New Open Box'),
	(3, 'Used'),
	(4, 'Used-Poor Condition');

CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_admin_email` varchar(45) DEFAULT NULL,
  `sender_user_email` varchar(45) DEFAULT NULL,
  `receiver_admin_email` varchar(45) DEFAULT NULL,
  `receiver_user_email` varchar(45) DEFAULT NULL,
  `message` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_conversations_user1_idx` (`sender_user_email`),
  KEY `fk_conversations_user2_idx` (`receiver_user_email`),
  KEY `fk_conversations_admin1_idx` (`sender_admin_email`),
  KEY `fk_conversations_admin2_idx` (`receiver_admin_email`),
  CONSTRAINT `fk_conversations_admin1` FOREIGN KEY (`sender_admin_email`) REFERENCES `admin` (`admin_email`),
  CONSTRAINT `fk_conversations_admin2` FOREIGN KEY (`receiver_admin_email`) REFERENCES `admin` (`admin_email`),
  CONSTRAINT `fk_conversations_user1` FOREIGN KEY (`sender_user_email`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_conversations_user2` FOREIGN KEY (`receiver_user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province1_idx` (`province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `district` (`id`, `name`, `province_id`) VALUES
	(1, 'Kandy', 1),
	(2, 'Matale', 1),
	(3, 'Nuwara Eliya', 1),
	(4, 'Anuradhapura', 2),
	(5, 'Polonnaruwa', 2),
	(6, 'Jaffna', 3),
	(7, 'Kilinochchi', 3),
	(8, 'Mannar', 3),
	(9, 'Vavuniya', 3),
	(10, 'Mullativu', 3),
	(11, 'Alambil', 3),
	(12, 'Ampara', 4),
	(13, 'Batticaloa', 4),
	(14, 'Trincomalee', 4),
	(15, 'Kurunagala', 5),
	(16, 'Puttalam', 5),
	(17, 'Galle', 6),
	(18, 'Hambanthota', 6),
	(19, 'Mathara', 6),
	(20, 'Badulla', 7),
	(21, 'Monaragala', 7),
	(22, 'Kegalle', 8),
	(23, 'Rathnapura', 8),
	(24, 'Colombo', 9),
	(25, 'Gampaha', 9),
	(26, 'Kaluthara', 9);

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) NOT NULL,
  `product_id` int NOT NULL,
  `review` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `friend_lists` (
  `user_email` varchar(45) NOT NULL,
  `friend_email` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_email`,`friend_email`),
  KEY `fk_friend_lists_user1_idx` (`user_email`),
  KEY `fk_friend_lists_user2_idx` (`friend_email`),
  CONSTRAINT `fk_friend_lists_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_friend_lists_user2` FOREIGN KEY (`friend_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `gender` (`id`, `type`) VALUES
	(1, 'Male'),
	(2, 'Female');

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(45) DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `qty` int DEFAULT NULL,
  `total` double DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `brand_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_model_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_model_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `model` (`id`, `name`, `brand_id`) VALUES
	(1, 'iPhone 11', 1),
	(2, 'iPhone 11 Pro', 1),
	(3, 'iPhone 11 Pro Max', 1),
	(4, 'iPhone 12', 1),
	(5, 'iPhone 12 Pro', 1),
	(6, 'iPhone 13', 1),
	(7, 'iPhone 13 Pro', 1),
	(8, 'iPhone 14 Pro', 1),
	(9, 'Galaxy S22 Pro', 2),
	(10, 'Watch 4', 8),
	(11, 'Macbook Pro', 4),
	(12, 'iPhone 8 ', 1),
	(13, 'Surface Pro', 15),
	(14, 'Macbook Air', 4),
	(15, 'Inspiron', 16),
	(16, 'ROG Zephyrus G14', 5),
	(17, 'Series 6', 7),
	(18, 'Series 7', 7),
	(19, 'Series 5', 7),
	(20, 'Tactix Delta', 17),
	(21, 'Fenix 6', 17),
	(22, 'ED320QR S', 18),
	(23, 'Predator', 18),
	(24, 'Rog swift', 9),
	(25, 'ED8j', 19),
	(26, 'G Pro Mechanical', 11),
	(28, 'G512', 11);

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `context` varchar(150) NOT NULL,
  `news` varchar(45) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `price` varchar(45) NOT NULL,
  `qty` varchar(45) NOT NULL,
  `cost` varchar(45) DEFAULT NULL,
  `small_desc` text NOT NULL,
  `desc` text NOT NULL,
  `color_id` int NOT NULL,
  `model_id` int NOT NULL,
  `condition_id` int NOT NULL,
  `activity_status_id` int NOT NULL,
  `dateTime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_user1_idx` (`user_email`),
  KEY `fk_product_condition1_idx` (`condition_id`),
  KEY `fk_product_color1_idx` (`color_id`),
  KEY `fk_product_activity_status1_idx` (`activity_status_id`),
  KEY `fk_product_model1_idx` (`model_id`),
  CONSTRAINT `fk_product_activity_status1` FOREIGN KEY (`activity_status_id`) REFERENCES `activity_status` (`id`),
  CONSTRAINT `fk_product_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `fk_product_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `product` (`id`, `user_email`, `title`, `price`, `qty`, `cost`, `small_desc`, `desc`, `color_id`, `model_id`, `condition_id`, `activity_status_id`, `dateTime`) VALUES
	(12, 'cybershopofficial23@gmail.com', 'Apple iPhone 11 Unlocked', '330', '100', '10', 'Unlocked 64GB 128GB 256GB | Verizon AT&T T-Mobile | Very Good', '“Phones are 100% tested and work like new. All orders include the Apple iPhone 11 (color and GB you choose from drop down list), wall charging block, and MFI Certified Lightning USB cable. Battery health tested and is a minimum of 80%+. VERY GOOD- Shows some limited use with light scratches on front/back and possible wear on edges. All units tested and work perfectly!”\r\nTouchscreen, 3G Data Capable, 4G Data Capable, 4K Video Recording, Accelerometer, Barometer, Camera, Color Screen, Fingerprint Sensor, Front Camera, Geotagging, Music Player, Proximity Sensor, Rear Camera', 1, 1, 1, 1, '2022-12-05 00:00:00'),
	(13, 'cybershopofficial23@gmail.com', 'Apple iPhone 12 PRO', '510', '100', '50', '128GB 256GB | Unlocked Verizon T-Mobile AT&T | Very Good', '“Phones are tested and work like new. All orders include the Apple iPhone 12 PRO Unlocked (color and GB you choose from drop down list), wall charging block, and MFI Certified Lightning USB cable. Battery health tested and is a minimum of 80%+. VERY GOOD- Shows some limited use with light scratches on front/back and possible wear on edges. All units tested and work perfectly!”', 1, 5, 1, 1, '2022-12-05 18:04:34'),
	(14, 'cybershopofficial23@gmail.com', 'Apple iPhone 8+', '115', '100', '10', '64GB/128GB/256GB Smartphone Verizon Unlocked T-Mobile AT&T', '“Device is in good condition with moderate wear. Device will include some scuffing to the frame/body of the device as well as a few scratches on the glass. Device is 100% functional with a clean ESN and backed by our 30 day warranty.”', 1, 12, 2, 1, '2022-12-05 18:06:49'),
	(15, 'cybershopofficial23@gmail.com', 'Apple iPhone 11', '309.99', '100', '15', '64GB - Factory Unlocked - Good Condition Good - Refurbished', '“Fully tested and restored to factory settings by our in house technicians. - Good – This product is in good cosmetic condition, there will be signs of wear which may include scratches, visible scuffs and/or screen discoloration but nothing that will impair functionality. Battery health will be a minimum of 80%. The item has been fully tested, restored to factory settings and is in excellent working order.”', 1, 1, 2, 1, '2022-12-05 18:08:26'),
	(16, 'cybershopofficial23@gmail.com', 'Apple iPhone 11', '20', '98', '5', '64GB 128GB 256GB - Unlocked Smartphone - Excellent - Grade A', '3D Depth Camera, 3D Depth Sensor, 4K Video Recording, 8K Video Recording, Accelerometer, Ambient Light Sensor, Dual Rear Cameras, Email, Web, Facial Recognition, iMessage, 3G data, 4G Data, Liquid Retina HD display, True Tone display', 1, 1, 3, 1, '2022-12-05 18:10:17'),
	(26, 'cybershopofficial23@gmail.com', 'Apple MacBook Air', '10', '96', '10', 'Apple MacBook Air Touch ID Core i5 1.6GHz 13 16GB 512GB SSD Space Gray (2018).\r\n\r\nIn perfect condition. Selling because I was gifted another laptop.', 'Up to 15 hours wireless web\r\nUp to 18 hours Apple TV app movie playback\r\nBuilt-in 49.9‑watt‑hour lithium‑polymer battery\r\n30W USB-C Power Adapter\r\n\r\nTwo Thunderbolt / USB 4 ports with support for:\r\n\r\nCharging\r\nDisplayPort\r\nThunderbolt 3 (up to 40Gb/s)\r\nUSB 4 (up to 40Gb/s)\r\nUSB 3.1 Gen 2 (up to 10Gb/s)\r\n3.5 mm head', 2, 14, 1, 1, '2022-12-06 20:49:13'),
	(31, 'cybershopofficial23@gmail.com', 'iPhone 14', '40', '99', '10', 'The iPhone 13 Pro is Apples smaller premium iPhone with a 6.1 screen size and for the first time in an iPhone, it comes with a 120Hz ProMotion display for super smooth scrolling. The list of innovations includes a more capable triple camera setup, with a wide, ultra-wide and zoom cameras, as well as a LiDAR scanner.', 'Features:\r\n\r\n- Our biggest camera upgrade ever. All-new Pro camera system. Advanced low-light performance. Incredible detail with macro photography.\r\n- Cinematic mode adds shallow depth of field automatically. You can also shift focus after you shoot.\r\n- Super Retina XDR display with ProMotion. Experience a faster, brighter, more responsive display.\r\n- A15 Bionic, the world’s fastest smartphone chip.\r\n- Up to 28 hours of video playback.³ iPhone 13 Pro Max has the best battery life ever on iPhone.\r\n- Ceramic Shield is tougher than any smartphone glass. And you get dust, spill and water resistance.\r\n\r\n\r\nSpecifications:\r\n\r\n- Capacity: 8GB/128GB\r\n\r\nin the include:\r\n- USB-C to Lightning Cable\r\n\r\n', 2, 8, 1, 1, '2022-12-12 23:30:06'),
	(33, 'cybershopofficial23@gmail.com', ' Apple MacBook Pro 16', '566', '100', '12', 'NEU: Apple MacBook Pro 16 Zoll (512GB SSD, M1 Pro, 16GB) Laptop - Space Grau', 'Condition:	\r\nNew: A brand-new, unused, unopened, undamaged item in its original packaging (where packaging is ... Read moreabout the condition	\r\nFestplattenkapazität:	\r\n512 GB\r\nEAN:	\r\n0194252545782	\r\nFestplattentyp:	\r\nSSD (Solid State Drive)\r\nBesonderheiten:	\r\nBluetooth, Hintergrundbeleuchtete Tastatur, Touch ID, Force Touch Trackpad	\r\nErscheinungsjahr:	\r\n2021\r\nSSD-Festplattenkapazität:	\r\n512 GB	\r\nPassend für:	\r\nGrafikdesign\r\nProzessor:	\r\nApple M1 Pro	\r\nBetriebssystem:	\r\nmacOS 12.0, Monterey\r\nBildschirmgröße:	\r\n16,2 Zoll	\r\nHerstellernummer:	\r\nMK183D/A\r\nMarke:	\r\nApple	\r\nFarbe:	\r\nGrau\r\nModell:	\r\nMacBook Pro	\r\nMaximale Auflösung:	\r\n3456 x 2234\r\nKonnektivität:	\r\nDisplayPort, HDMI, USB-C	\r\nGrafikprozessortyp:	\r\nIntegrierte / On-Board-Grafik\r\nArbeitsspeichergröße:	\r\n16 GB	\r\nSerie:	\r\nMacBook Pro', 3, 11, 1, 1, '2022-12-13 01:21:34'),
	(34, 'cybershopofficial23@gmail.com', 'Dell P102F Inspiron 15', '455', '100', '34', 'Dell P102F Inspiron 15 500 15.6, Intel Core i5-1135G7 8GB RAM, 512GB SSD NO PWR\r\n', 'Brand:	\r\nDell	\r\nType:	\r\nNotebook/Laptop\r\nProcessor:	\r\nIntel Core i5 11th Gen.	\r\nScreen Size:	\r\n15.6 in\r\nRAM Size:	\r\n8 GB	\r\nModel:	\r\nP102F Inspiron 15 500\r\nOperating System:	\r\nWindows 10 Home	\r\nFeatures:	\r\nBluetooth, Built-in Microphone, Built-in Webcam\r\nSSD Capacity:	\r\n512 GB	\r\nStorage Type:	\r\nSSD (Solid State Drive)\r\nProcessor Speed:	\r\n2.40 GHz', 6, 15, 1, 1, '2022-12-13 01:25:06'),
	(37, 'cybershopofficial23@gmail.com', 'ASUS ROG Zephyrus G14', '920', '100', '12', 'ASUS ROG Zephyrus G14 R7 4800HS RTX 2060 16GB 512GB 120Hz Gaming Laptop  AniMe', 'Processor:	AMD Ryzen 7	\r\nScreen Size:	14 in\r\nGraphics Processing Type:	Dedicated Graphics	\r\nRAM Size:	16 GB\r\nMPN:	GA401IV-HE110T	\r\nMost Suitable For:	Casual Computing, Gaming, Graphic Design, Workstati SeriousGaming\r\nSSD Capacity:	512 GB	\r\nGPU:	NVIDIA GeForce RTX 2060\r\nBrand:	ASUS	\r\nSeries:	ROG\r\nType:	Notebook/Laptop	\r\nMaximum Resolution:	1920 x 1080\r\nModel:	ASUS ROG Zephyrus G14	\r\nOperating System:	Windows 11 Home\r\nFeatures:	10/100 LAN Card, Backlit Keyboard, Bluetooth, Built-in Microphone, Webcam, Multi-Touch Trackpad, Virtual Reality Ready	\r\nHard Drive Capacity:	512 GB\r\nStorage Type:	SSD	\r\nEAN:	Does not apply', 5, 16, 1, 1, '2022-12-13 01:33:02'),
	(38, 'cybershopofficial23@gmail.com', 'Apple Watch Series 6', '189', '100', '45', 'Apple Watch Series 6 40mm 44mm GPS + WiFi + Cellular - All Colors- Very Good', 'Model:	\r\nApple Watch Series 6	\r\nOperating System:	\r\nApple Watch OS\r\nCase Material:	\r\nAluminum	\r\nCompatible Operating System:	\r\niOS - Apple\r\nBand Material:	\r\nSilicone	\r\nSeries:	\r\nApple Watch Series 6\r\nFeatures:	\r\nGPS	\r\nNetwork:	\r\nUnlocked\r\nBand Color:	\r\nBlack, White, Pink, Red, Blue	\r\nStorage Capacity:	\r\n32 GB\r\nBrand:	\r\nApple	\r\nCase Size:	\r\n40mm,44 mm,', 4, 17, 1, 1, '2022-12-13 01:35:51'),
	(39, 'cybershopofficial23@gmail.com', 'Apple watch series 7 ', '329', '100', '34', 'Apple watch series 7 41mm 45mm GPS+Cellular Unlocked Black Blue Red Starlight', 'Model:	\r\nApple Watch Series 7	\r\nOperating System:	\r\nApple Watch OS\r\nCase Color:	\r\nGray, Blue,.	\r\nCase Material:	\r\nAluminum ,Stainless Steel\r\nCompatible Operating System:	\r\niOS - Apple	\r\nBand Material:	\r\nAluminum\r\nSeries:	\r\nApple Watch Series 7	\r\nFeatures:	\r\nGPS\r\nNetwork:	\r\nUnlocked	\r\nBand Color:	\r\nBlue, Black, White, Starlight, Red\r\nStorage Capacity:	\r\n32 GB	\r\nBrand:	\r\nApple\r\nCase Size:	\r\n41 mm,45 mm', 6, 18, 2, 1, '2022-12-13 01:39:31'),
	(40, 'cybershopofficial23@gmail.com', 'Apple Watch Series 5', '154', '100', '56', 'Apple Watch Series 5 40mm 44mm GPS + WiFi + Cellular Gold Gray Silver -Very Good', 'Model:	\r\nApple Watch Series 5	\r\nOperating System:	\r\nApple Watch OS\r\nCase Color:	\r\nGray, Rose Gold, Silver	\r\nCase Material:	\r\nAluminum\r\nCompatible Operating System:	\r\niOS - Apple	\r\nBand Material:	\r\nSilicone\r\nSeries:	\r\nApple Watch Series 5	\r\nFeatures:	\r\nAccelerometer, Always-on Display, GPS\r\nNetwork:	\r\nUnlocked	\r\nBand Color:	\r\nBlack, White, Pink\r\nStorage Capacity:	\r\n32 GB	\r\nBrand:	\r\nApple\r\nCase Size:	\r\n40mm,44 mm,', 1, 19, 1, 1, '2022-12-13 01:42:00'),
	(41, 'cybershopofficial23@gmail.com', 'Samsung Galaxy Watch 4', '104', '100', '89', 'Samsung Galaxy Watch 4 44mm WiFi + LTE 4G UNLOCKED R875 Smart Watch - Very Good', 'MPN:	\r\nSM-R875	\r\nModel Number:	\r\nSM-R870\r\nBrand:	\r\nSamsung	\r\nCase Color:	\r\nBlack, Green, Silver\r\nSeries:	\r\nSERIES 4	\r\nBand Material:	\r\nSilicone\r\nNetwork:	\r\nUnlocked	\r\nModel:	\r\nSamsung Galaxy Watch4\r\nOperating System:	\r\nWear OS	\r\nFeatures:	\r\nFitness Tracker, GPS, Heart Rate Monitor, Sleep Monitor, Water-Resistant, Wireless Charging\r\nCase Size:	\r\n44 mm	\r\nStorage Capacity:	\r\n4 GB\r\nCase Material:	\r\nAluminum	\r\nCompatible Operating System:	\r\nAndroid, iOS - Apple', 3, 10, 3, 1, '2022-12-13 01:43:42'),
	(42, 'cybershopofficial23@gmail.com', 'Garmin tactix Delta ', '399.99', '100', '45', 'Garmin tactix Delta GPS Smartwatch Sapphire 51mm Case with Black Band & Charger', 'Condition:	\r\nUsed:\r\nSeller Notes:	\r\nGarmin Smartwatch sold as seen. Does not include retail packaging such as the box or instructions. (The instructions are available online). Used watch with light scuffing to the bezel and signs of usage. None of which are visible from a 30 cm distance from the watch. Overall good condition with great battery life. This watch has been tested and is fully functional. A replacement band & USB Charger are supplied but they are not official Garmin products.\r\nPersonalised:	\r\nNo	\r\nNumber of Items in Set:	\r\n3\r\nDisplay Resolution:	\r\n280 x 280	\r\nPower Source:	\r\nElectric Cordless\r\nSize:	\r\n51 x 51 x 14.9 mm	\r\nIndoor/Outdoor:	\r\nIndoor/Outdoor\r\nCustom Bundle:	\r\nNo	\r\nMeasurement System:	\r\nDecimal & Imperial\r\nMaterial:	\r\nMetal	\r\nSet Includes:	\r\nGarmin Tactix Delta, Black Silicone Band, USB Cable\r\nFor Operating Systems:	\r\nAndroid, iOS, macOS, Other OS, Windows	\r\nMobile App:	\r\nYes\r\nType:	\r\nSmartwatch	\r\nMeasurement Provided:	\r\nCadence, Calories, Distance, Heart Rate, Resistance Level, Speed, Time, Watts\r\nBattery Life:	\r\nMore Than 7 Days	\r\nLanguage:	\r\nEnglish, French, German, Italian, Spanish\r\nDisplay Size:	\r\n51 mm	\r\nManufacturer Warranty:	\r\n3 Months\r\nBody Area:	\r\nWrist	\r\nCountry/Region of Manufacture:	\r\nUnited Kingdom\r\nItem Weight:	\r\n97 g	\r\nItem Width:	\r\n51 mm\r\nEAN:	\r\n0753759245290	\r\nBrand:	\r\nGarmin\r\nModel:	\r\nGarmin tactix Delta	\r\nMPN:	\r\n010-02357-01\r\nFeatures:	\r\nRecord Sleep, Thermometer, Stopwatch, GPS, Pedometer, Compass, Calorie Monitor, Stealth Mode, Kill Switch, Timer, Dual Grid Coordinates, Alarm, Distance Traveled, Accelerometer, Gyroscope, Smart Notifications, Night Vision Mode, Heart Rate Monitor	\r\nSport/Activity:	\r\nCycling, Skiing, Biking, Climbing, Stand Up Paddleboarding, Rowing, Kayaking, Hiking, Running & Jogging, Walking, Snowboarding, CrossFit, Swimming\r\nColour:	\r\nBlack', 2, 20, 2, 1, '2022-12-13 01:47:49'),
	(44, 'cybershopofficial23@gmail.com', 'Garmin Fenix 6', '966', '100', '45', 'Merging innovative technology with a cutting-edge design, the Fenix 6 from GARMIN offers the functions of a smartwatch and more to accommodate a fast-paced lifestyle. Features are presented in a generously sized display for enhanced readability, whilst the functions are tested to U.S. military standards to ensure durability.', 'New Season\r\n\r\nGarmin\r\nFenix 6 smartwatch\r\n\r\nMerging innovative technology with a cutting-edge design, the Fenix 6 from GARMIN offers the functions of a smartwatch and more to accommodate a fast-paced lifestyle. Features are presented in a generously sized display for enhanced readability, whilst the functions are tested to U.S. military standards to ensure durability.\r\n\r\nHighlights\r\nblack\r\nsilver-tone\r\ntitanium bracelet\r\nclasp fastening\r\ntouchscreen display\r\nbattery-operated movement\r\nGPS function\r\nstep tracker\r\nheart rate monitor\r\nsmartphone compatible\r\nThis item comes with a standard two-year warranty from the brand.\r\nComposition\r\nTitanium 100%, Glass 100%\r\n\r\nWearing\r\nThe model is 1.86 m wearing size OS\r\n\r\nThe model is also styled with: Acne Studios chunky-knit long-sleeved jumper, Prada cropped straight-leg jeans\r\nProduct IDs\r\nFARFETCH ID: 19175212\r\n\r\nBrand style ID: 0100215823', 1, 21, 1, 1, '2022-12-16 00:03:22'),
	(46, 'cybershopofficial23@gmail.com', 'Acer ED320QR', '186', '100', '78', 'Acer ED320QR S 31.5 165 Hz Full HD LED Curved Gaming LCD Monitor', 'Condition:	New: A brand-new, unused, unopened, undamaged item in its original packaging (where packaging is applicable). Packaging should be the same as what is found in a retail store, unless the item is handmade or was packaged by the manufacturer in non-retail packaging, such as an unprinted box or plastic bag. See the sellers listing for full details. 	\r\nUPC:	0841631195716\r\nScreen Size:	31.5 in	\r\nBrightness:	300 cdm²\r\nResponse Time:	1 ms	\r\nRefresh Rate:	165 Hz\r\nVideo Inputs:	DisplayPort	\r\nColor:	Black\r\nMPN:	UMJE0AA.S01	\r\nAspect Ratio:	16:9\r\nBrand:	Acer	\r\nMaximum Resolution:	1920 x 1080\r\nContrast Ratio:	100000000:1	\r\nModel:	Acer ED320QR Sbiipx\r\nFeatures:	Curved Screen	\r\nProduct Line:	Acer ED0', 1, 22, 3, 1, '2022-12-18 00:44:49'),
	(47, 'cybershopofficial23@gmail.com', 'Acer Predator XB273', '223', '100', '52', 'Acer Predator XB273 Xbmiprzx 27 IPS LED Monitor 240Hz, 99% sRGB Up To 0.1ms', 'Product Identifiers\r\nBrand: Acer\r\nMPN:UMHX3AAX02, UM.HX3AA.X02 UPC:0841631154973, 0193199471208\r\nModel:XB273 Xbmiprzx\r\neBay Product ID (ePID):4039288780\r\nProduct Key Features:Brightness400 cd/m²\r\nVideo Inputs:DisplayPort, HDMI Standard\r\nMost Suitable For:Gaming\r\nDisplay Type:IPS LED\r\nColor:Black\r\nResponse Time:1 ms\r\nRefresh Rate:240 Hz\r\nContrast Ratio:1000:1\r\nFeatures:Wall Mountable\r\nScreen Size:27 in\r\nAspect Ratio:16:9\r\nMaximum Resolution:1920 x 1080\r\nProduct Line: Acer Predator', 1, 23, 1, 1, '2022-12-18 00:49:26'),
	(48, 'cybershopofficial23@gmail.com', 'ASUS ROG Swift PG279Q', '169', '100', '30', 'ASUS ROG Swift PG279Q 27 165Hz WQHD IPS Gaming Monitor Black - READ DESCRIPTION', 'Condition:	Used: An item that has been used previously. The item may have some signs of cosmetic wear, but is fully operational and functions as intended. This item may be a floor model or store return that has been used. See the sellers listing for full details and description of any imperfections.\r\nScreen Size:	27 in\r\nBrightness:	350 cd/m²	\r\nResponse Time:	4 ms\r\nRefresh Rate:	165 Hz	\r\nVideo Inputs:	DisplayPort, HDMI Standard\r\nMPN:	90LM0230-B02370	\r\nMost Suitable For:	Gaming\r\nColour:	Black	\r\nAspect Ratio:	16:9\r\nBrand:	ASUS	\r\nDisplay Type:	IPS LCD\r\nMaximum Resolution:	2560 x 1440	\r\nItem Height:	507 mm\r\nContrast Ratio:	1000:1	\r\nModel:	ASUS ROG Swift PG279Q\r\nFeatures:	Built-in Speakers, USB Hub	\r\nItem Width:	620mm\r\nProduct Line:	ASUS ROG Swift', 1, 24, 1, 1, '2022-12-18 00:53:47'),
	(49, 'cybershopofficial23@gmail.com', 'VIOTEK 32 Curved Gaming', '279', '100', '12', 'VIOTEK 32 165Hz Curved Gaming Monitor 120% sRGB 2560x1440p QHD FreeSync G-SYNC', 'Condition:	New: A brand-new, unused, unopened, undamaged item in its original packaging 	\r\nScreen Size:	32 in\r\nBrightness:	250 cd/m²	\r\nEC Range:	A+++ - G\r\nRefresh Rate:	165 Hz	\r\nResponse Time:	5 ms\r\nColor:	Black	\r\nVideo Inputs:	HDMI 2.0, Mini DisplayPort, USB 2.0\r\nMPN:	VTK-GNV32DBE	\r\nMost Suitable For:	Light Gaming, Casual Computing, CCTV, Gaming\r\nAspect Ratio:	16:9	\r\nBrand:	Viotek\r\nDisplay Type:	VA LCD	\r\nEnergy Star:	A+\r\nMaximum Resolution:	2560 x 1440	\r\nManufacturer Warranty:	3 Years\r\nContrast Ratio:	3000:1	\r\nModel:	GNV32DBE\r\nFeatures:	Adaptive-Sync, Anti-Glare, Curved Screen, Headphone Jack, Slim Bezel, Tiltable, Wall Mountable, Overdrive, GAMEPLUS	\r\nUPC:	0819194021452', 6, 25, 3, 1, '2022-12-26 00:38:13'),
	(50, 'cybershopofficial23@gmail.com', 'Logitech G Pro Mechanical', '55', '100', '12', 'BrandLogitech\r\nMPN920-008290\r\nEan0097855127327\r\nGTIN0097855127327, 0783555160787\r\nUPC0783555160787\r\nModel920-008290\r\neBay Product ID (ePID)17021691094', 'Product Key Features\r\nColorBlack\r\nConnectivityUSB\r\nKeyboard LanguageEnglish\r\nFeaturesPlug & Play\r\nMaterialPlastic\r\nTypeGaming\r\nDimensions\r\nItem Length6 in.\r\nItem Height1.4 in.\r\nItem Width14.2 in.', 1, 26, 2, 1, '2023-01-15 17:23:16'),
	(51, 'cybershopofficial23@gmail.com', 'Logitech G512 RGB', '79.99', '100', '15', 'G512 is a high-performance gaming keyboard featuring your choice of advanced GX mechanical switches. Advanced gaming technology and aluminum-alloy construction make G512 simple, durable and full-featured.', 'Connection Type: USB 2.0\r\n\r\n    USB Protocol: USB 2.0\r\n    USB Ports (Built-in): Yes, 2.0\r\n    Indicator Lights (LED): 2\r\n    Backlighting: Yes, RGB per key lighting\r\n\r\n\r\nSPECIAL KEYS\r\n\r\n    Lighting Controls: FN+F5/F6/F7\r\n    Game Mode: FN+F8\r\n    Media Controls: FN+F9/F10/F11/F12\r\n    Volume Contros: FN+ PRTSC/SCRLK/PAUSE\r\n    Programmable FN keys via Logitech G HUB\r\n\r\n    REQUIREMENTS\r\n\r\n    Windows 10, Window 8.1, Windows 8, or Windows 7\r\n    USB port (for keyboard)\r\n    Second USB port (for USB passthrough port)\r\n    (Optional) Internet access for Logitech G HUB software.\r\n\r\nPART NUMBER\r\n\r\n    Carbon English layout Tactile : 920-008723', 1, 28, 1, 1, '2023-02-03 23:12:03'),
	(53, 'cybershopofficial23@gmail.com', 'Samsung Galaxy S20+', '20', '49', '12', 'Samsung Galaxy S20+ Plus 5G G986U Unlocked 128GB Good', '"Good" Condition\r\n\r\nShows signs of previous use. Surface scratches throughout. The housing may have moderate signs of use especially around the charge port and corners. With a case and screen protector(recommended), the wear is mostly unnoticeable while using the device! The screen may have a very light shadow visible on a pure white screen only at a distance of less than an arm\'s length.\r\n\r\nUnlocked\r\n\r\nModel G986U - Fully unlocked and compatible with all carriers and networks worldwide. Feel free to message us with your carrier to verify!\r\n\r\nThey\'re also fully 5G compatible with all carriers!\r\n\r\nWhat’s included with your device?\r\n\r\nYour phone comes with a brand new 2-Piece Fast Charger (Type-C Cable and Wall Block), and a sim tray removal tool.\r\n\r\n1 Year Allstate Warranty included with your purchase! .\r\n\r\nFast and Free Shipping. Expedited shipping options are also available to select at checkout.', 1, 9, 1, 1, '2023-09-10 21:31:31');

CREATE TABLE IF NOT EXISTS `product_image` (
  `path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_product_image_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_image_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `product_image` (`path`, `product_id`) VALUES
	('assets/img/Products/Apple iPhone 11 Unlocked_638de4b81ecf0.jpeg', 12),
	('assets/img/Products/Apple iPhone 11 Unlocked_638de4b81f92e.jpeg', 12),
	('assets/img/Products/Apple iPhone 11 Unlocked_638de4b8200be.jpeg', 12),
	('assets/img/Products/Apple iPhone 12 PRO_638de55ab141b.jpeg', 13),
	('assets/img/Products/Apple iPhone 12 PRO_638de55ab1bfd.jpeg', 13),
	('assets/img/Products/Apple iPhone 12 PRO_638de55ab283c.jpeg', 13),
	('assets/img/Products/Apple iPhone 8+ Plus _638de5e16b5fd.jpeg', 14),
	('assets/img/Products/Apple iPhone 8+ Plus _638de5e16c54e.jpeg', 14),
	('assets/img/Products/Apple iPhone 8+ Plus _638de5e16ccd4.jpeg', 14),
	('assets/img/Products/Apple iPhone 11_638de642c252f.jpeg', 15),
	('assets/img/Products/Apple iPhone 11_638de642c2e12.jpeg', 15),
	('assets/img/Products/Apple iPhone 11_638de642c3406.jpeg', 15),
	('assets/img/Products/Apple iPhone 11_638de6b1ee79e.png', 16),
	('assets/img/Products/Apple iPhone 11_638de6b1ef46b.png', 16),
	('assets/img/Products/Apple iPhone 11_638de6b1f00a3.jpeg', 16),
	('assets/img/Products/Apple MacBook Air_638f5d711253a.jpeg', 26),
	('assets/img/Products/iPhone 14 Pro_63976c26cf6e7.jpeg', 31),
	('assets/img/Products/iPhone 14 Pro_63976c26d01dc.jpeg', 31),
	('assets/img/Products/ Apple MacBook Pro 16_6397864645585.jpeg', 33),
	('assets/img/Products/Dell P102F Inspiron 15_6397871a711b7.jpeg', 34),
	('assets/img/Products/ASUS ROG Zephyrus G14_639788f69f22f.jpeg', 37),
	('assets/img/Products/Apple Watch Series 6_6397899feb231.jpeg', 38),
	('assets/img/Products/Apple Watch Series 6_6397899febdd7.jpeg', 38),
	('assets/img/Products/Apple Watch Series 6_6397899fec601.jpeg', 38),
	('assets/img/Products/Apple watch series 7 _63978a7b0ce3c.jpeg', 39),
	('assets/img/Products/Apple watch series 7 _63978a7b0dbbf.jpeg', 39),
	('assets/img/Products/Apple watch series 7 _63978a7b0f203.jpeg', 39),
	('assets/img/Products/Apple Watch Series 5_63978b10ab04f.jpeg', 40),
	('assets/img/Products/Apple Watch Series 5_63978b10ac483.jpeg', 40),
	('assets/img/Products/Apple Watch Series 5_63978b10acfe2.jpeg', 40),
	('assets/img/Products/Samsung Galaxy Watch 4_63978b7697ade.jpeg', 41),
	('assets/img/Products/Samsung Galaxy Watch 4_63978b7698b21.jpeg', 41),
	('assets/img/Products/Garmin tactix Delta _63978c6d31e7e.jpeg', 42),
	('assets/img/Products/Garmin tactix Delta _63978c6d330f7.jpeg', 42),
	('assets/img/Products/Garmin tactix Delta _63978c6d33e62.jpeg', 42),
	('assets/img/Products/Garmin Fenix 6_639b687280455.jpeg', 44),
	('assets/img/Products/Acer ED320QR_639e1529cb68e.jpeg', 46),
	('assets/img/Products/Acer ED320QR_639e1529ccff7.jpeg', 46),
	('assets/img/Products/Acer ED320QR_639e1529cdd5d.jpeg', 46),
	('assets/img/Products/Acer Predator XB273_639e163ebb11b.jpeg', 47),
	('assets/img/Products/ASUS ROG Swift PG279Q_639e174389466.jpeg', 48),
	('assets/img/Products/ASUS ROG Swift PG279Q_639e17438a1d0.png', 48),
	('assets/img/Products/ASUS ROG Swift PG279Q_639e17438b1ce.jpeg', 48),
	('assets/img/Products/VIOTEK 32 Curved Gaming_63a89f9d851ca.jpeg', 49),
	('assets/img/Products/VIOTEK 32 Curved Gaming_63a89f9d862b1.jpeg', 49),
	('assets/img/Products/Logitech G Pro Mechanical_63c3e92c0686e.png', 50),
	('assets/img/Products/Logitech G Pro Mechanical_63c3e92c07d16.jpeg', 50),
	('assets/img/Products/Logitech G512 RGB_63dd476ba0d25.jpeg', 51),
	('assets/img/Products/Logitech G512 RGB_63dd476ba18a5.jpeg', 51),
	('assets/img/Products/Logitech G512 RGB_63dd476ba20d7.jpeg', 51),
	('assets/img/Products/Samsung Galaxy S20+_64fde85b2c4a3.jpeg', 53);

CREATE TABLE IF NOT EXISTS `profileimage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) NOT NULL,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profileimage_user1_idx` (`user_email`),
  CONSTRAINT `fk_profileimage_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `profileimage` (`id`, `user_email`, `path`) VALUES
	(10, 'cybershopofficial23@gmail.com', 'assets/img/Profiles/CyberShop_638ebfeb17b3c.png');

CREATE TABLE IF NOT EXISTS `promo` (
  `code` varchar(50) NOT NULL DEFAULT '',
  `percent` int DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `promo` (`code`, `percent`) VALUES
	('aCeogv', 6),
	('AhxHqQ', 6),
	('biBxrq', 9),
	('dsuYaZ', 7),
	('DuoOal', 6),
	('eWEtnR', 18),
	('EzoLva', 14),
	('flYHZA', 16),
	('fPbYaT', 14),
	('fvbqpo', 6),
	('GhoEiQ', 16),
	('GKPstj', 11),
	('HFGwFd', 6),
	('Hfkdse', 11),
	('HoaaLa', 20),
	('HyTRro', 17),
	('icKpJA', 19),
	('Inlovr', 19),
	('IoIhhS', 13),
	('ItrwJy', 18),
	('JkeOkF', 9),
	('jvfzEB', 16),
	('KexlFQ', 19),
	('kfaPFp', 10),
	('kohnTs', 6),
	('KxJkfA', 18),
	('LFQEqG', 11),
	('lOspDG', 6),
	('lsFPFw', 11),
	('MblcDu', 18),
	('MKRSdg', 10),
	('mOmsph', 19),
	('mSYfgi', 16),
	('NnsjYR', 7),
	('otkgEj', 16),
	('oZDEJr', 12),
	('PdxfhY', 14),
	('pqGZKG', 9),
	('PRIboc', 16),
	('puUyrA', 17),
	('qjSEtq', 17),
	('QrnuZN', 16),
	('RNmnyJ', 19),
	('RrIVle', 14),
	('RtbpIN', 5),
	('RtbvFc', 17),
	('sfaiDj', 13),
	('SftFRz', 14),
	('tjzZck', 5),
	('UBzHWD', 13),
	('uYyfix', 18),
	('vCXeRP', 9),
	('vfgKok', 6),
	('vgRBEQ', 6),
	('vjATyc', 18),
	('vneUvs', 17),
	('wkonNR', 9),
	('WyWlKV', 7),
	('wZuofU', 6),
	('xdQrVH', 11),
	('XNUGNH', 10),
	('XPaZzH', 19),
	('xqHdsm', 10),
	('yCJVBs', 10),
	('ynKmAr', 8),
	('zbpTYS', 8),
	('ZnszUh', 19),
	('ZWUuNa', 16);

CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `province` (`id`, `name`) VALUES
	(1, 'Central'),
	(2, 'North Central'),
	(3, 'Northern'),
	(4, 'Eastern'),
	(5, 'North Western'),
	(6, 'Southern'),
	(7, 'Uva'),
	(8, 'Sabaragamuwa'),
	(9, 'Western');

CREATE TABLE IF NOT EXISTS `sell_req` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) DEFAULT NULL,
  `why` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `unblock_req` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;


CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(45) NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `mobile1` varchar(45) NOT NULL,
  `mobile2` varchar(45) NOT NULL,
  `blocked_id` int NOT NULL,
  `gender_id` int NOT NULL,
  `joined_date` datetime NOT NULL,
  `accessed` int NOT NULL,
  `vcode` varchar(45) DEFAULT NULL,
  `canSell_id` int NOT NULL,
  `tagCode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_blocked_status_idx` (`blocked_id`),
  KEY `fk_user_gender1_idx` (`gender_id`),
  KEY `fk_user_canSell1_idx` (`canSell_id`),
  CONSTRAINT `fk_user_blocked_status` FOREIGN KEY (`blocked_id`) REFERENCES `blocked_status` (`id`),
  CONSTRAINT `fk_user_canSell1` FOREIGN KEY (`canSell_id`) REFERENCES `cansell` (`id`),
  CONSTRAINT `fk_user_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `user` (`email`, `password`, `fname`, `lname`, `mobile1`, `mobile2`, `blocked_id`, `gender_id`, `joined_date`, `accessed`, `vcode`, `canSell_id`, `tagCode`) VALUES
	('cybershopofficial23@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'CyberShop', 'Official', '0761234567', '--', 0, 1, '2022-12-05 17:53:29', 75, '63b2765ea9356', 1, '#63c3eabb');

CREATE TABLE IF NOT EXISTS `useraddress` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(45) NOT NULL,
  `district_id` int NOT NULL,
  `line 1` varchar(45) DEFAULT NULL,
  `line 2` varchar(45) DEFAULT NULL,
  `postal code` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_userAddress_district1_idx` (`district_id`),
  KEY `fk_userAddress_user1_idx` (`user_email`),
  CONSTRAINT `fk_userAddress_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_userAddress_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

INSERT IGNORE INTO `useraddress` (`id`, `user_email`, `district_id`, `line 1`, `line 2`, `postal code`) VALUES
	(18, 'cybershopofficial23@gmail.com', 1, '--', '--', 0);

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wishList_user1_idx` (`user_email`),
  KEY `fk_wishList_product1_idx` (`product_id`),
  CONSTRAINT `fk_wishList_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_wishList_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3;


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
