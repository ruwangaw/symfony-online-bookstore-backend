-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.23 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for sympho_online_bookstore
DROP DATABASE IF EXISTS `sympho_online_bookstore`;
CREATE DATABASE IF NOT EXISTS `sympho_online_bookstore` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sympho_online_bookstore`;

-- Dumping structure for table sympho_online_bookstore.books
DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) unsigned NOT NULL,
  `isbn` varchar(45) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `cover_image` varchar(800) DEFAULT NULL,
  `category` int(11) unsigned NOT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`category`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `isbn_UNIQUE` (`isbn`),
  KEY `book_category_foreign_key_1_idx` (`category`),
  CONSTRAINT `book_category_foreign_key_1` FOREIGN KEY (`category`) REFERENCES `mst_book_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sympho_online_bookstore.books: ~4 rows (approximately)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `isbn`, `title`, `price`, `cover_image`, `category`, `created_at`) VALUES
	(1, '9781509878345', 'THE NUMBERS GAME', 1350.00, '', 1, '2021-5-19'),
	(2, '9781789890549', 'FANTASTIC ANIMAL FACTS', 1560.00, '', 2, '2021-5-19'),
	(3, '9781529022759', 'THE THIRTEENTH FAIRY A NEVER AFTER TALE', 1195.00, '', 1, '2021-5-19'),
	(4, '9781472260086', 'ART MATTERS', 1700.00, '', 4, '2021-5-19');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Dumping structure for table sympho_online_bookstore.book_discounts
DROP TABLE IF EXISTS `book_discounts`;
CREATE TABLE IF NOT EXISTS `book_discounts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book_category` int(11) unsigned DEFAULT NULL,
  `minimum_books_count` int(11) unsigned zerofill NOT NULL,
  `coupon_discount` int(1) unsigned zerofill DEFAULT NULL,
  `coupon_code` varchar(10) DEFAULT NULL,
  `discount_percentage` decimal(10,2) unsigned zerofill NOT NULL,
  `starts_at` varchar(45) NOT NULL,
  `ends_at` varchar(45) NOT NULL,
  `active` int(1) NOT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `book_discounts_books_category_foreign_key_2_idx` (`book_category`),
  CONSTRAINT `book_discounts_books_category_foreign_key_2` FOREIGN KEY (`book_category`) REFERENCES `mst_book_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table sympho_online_bookstore.book_discounts: ~3 rows (approximately)
/*!40000 ALTER TABLE `book_discounts` DISABLE KEYS */;
INSERT INTO `book_discounts` (`id`, `book_category`, `minimum_books_count`, `coupon_discount`, `coupon_code`, `discount_percentage`, `starts_at`, `ends_at`, `active`, `created_at`) VALUES
	(1, 2, 00000000005, 0, NULL, 00000010.00, '2021-05-01', '2021-05-31', 1, '2021-05-01'),
	(2, NULL, 00000000010, 0, NULL, 00000005.00, '2021-05-01', '2021-05-31', 1, '2021-05-01'),
	(3, NULL, 00000000015, 1, 'RU00000001', 00000015.00, '2021-05-01', '2021-05-31', 1, '2021-05-01');
/*!40000 ALTER TABLE `book_discounts` ENABLE KEYS */;

-- Dumping structure for table sympho_online_bookstore.invoice
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shopping_cart` int(11) unsigned NOT NULL,
  `txn_at` varchar(45) DEFAULT NULL,
  `receipt_status` int(11) unsigned NOT NULL,
  `paid_amount` int(11) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`,`receipt_status`,`shopping_cart`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `invoice_shopping_cart_foreign_key_1_idx` (`shopping_cart`),
  KEY `invoice_receipt_status_foreign_key_2_idx` (`receipt_status`),
  CONSTRAINT `invoice_receipt_status_foreign_key_2` FOREIGN KEY (`receipt_status`) REFERENCES `mst_invoice_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `invoice_shopping_cart_foreign_key_1` FOREIGN KEY (`shopping_cart`) REFERENCES `shopping_cart` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sympho_online_bookstore.invoice: ~0 rows (approximately)
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;

-- Dumping structure for table sympho_online_bookstore.mst_book_categories
DROP TABLE IF EXISTS `mst_book_categories`;
CREATE TABLE IF NOT EXISTS `mst_book_categories` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` char(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sympho_online_bookstore.mst_book_categories: ~6 rows (approximately)
/*!40000 ALTER TABLE `mst_book_categories` DISABLE KEYS */;
INSERT INTO `mst_book_categories` (`id`, `name`, `code`) VALUES
	(1, 'Fiction', 'FIC'),
	(2, 'Children', 'CHD'),
	(3, 'Fantasy', 'FAN'),
	(4, 'Contemporary', 'CON'),
	(5, 'Adventure', 'ADV'),
	(6, 'Romance', 'ROM');
/*!40000 ALTER TABLE `mst_book_categories` ENABLE KEYS */;

-- Dumping structure for table sympho_online_bookstore.mst_invoice_status
DROP TABLE IF EXISTS `mst_invoice_status`;
CREATE TABLE IF NOT EXISTS `mst_invoice_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `code` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table sympho_online_bookstore.mst_invoice_status: ~6 rows (approximately)
/*!40000 ALTER TABLE `mst_invoice_status` DISABLE KEYS */;
INSERT INTO `mst_invoice_status` (`id`, `name`, `code`) VALUES
	(1, 'Created', 'CRE'),
	(2, 'Payment Pending', 'PEN'),
	(3, 'Partially Paid', 'PAR'),
	(4, 'Paid', 'PAD'),
	(5, 'Receipt Printed', 'RRI'),
	(6, 'Reprint', 'REP');
/*!40000 ALTER TABLE `mst_invoice_status` ENABLE KEYS */;

-- Dumping structure for table sympho_online_bookstore.shopping_cart
DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) unsigned NOT NULL,
  `total_amount` decimal(10,2) unsigned zerofill NOT NULL,
  `discount_amount` decimal(10,2) unsigned zerofill NOT NULL,
  `gross_amount` decimal(10,2) unsigned zerofill NOT NULL,
  `created_at` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `shopping_cart_user_foreign_key_idx` (`user`),
  CONSTRAINT `shopping_cart_user_foreign_key` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sympho_online_bookstore.shopping_cart: ~99 rows (approximately)
/*!40000 ALTER TABLE `shopping_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopping_cart` ENABLE KEYS */;

-- Dumping structure for table sympho_online_bookstore.shopping_cart_books
DROP TABLE IF EXISTS `shopping_cart_books`;
CREATE TABLE IF NOT EXISTS `shopping_cart_books` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `shopping_cart` int(11) unsigned NOT NULL,
  `book` int(11) unsigned NOT NULL,
  `item_count` int(11) unsigned zerofill NOT NULL,
  `calculated_price` decimal(10,2) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `shopping_cart_froeign_key_1_idx` (`shopping_cart`),
  KEY `book_foreign_key_2_idx` (`book`),
  CONSTRAINT `book_foreign_key_2` FOREIGN KEY (`book`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `shopping_cart_froeign_key_1` FOREIGN KEY (`shopping_cart`) REFERENCES `shopping_cart` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sympho_online_bookstore.shopping_cart_books: ~0 rows (approximately)
/*!40000 ALTER TABLE `shopping_cart_books` DISABLE KEYS */;
/*!40000 ALTER TABLE `shopping_cart_books` ENABLE KEYS */;

-- Dumping structure for table sympho_online_bookstore.shoppint_cart_discounts
DROP TABLE IF EXISTS `shoppint_cart_discounts`;
CREATE TABLE IF NOT EXISTS `shoppint_cart_discounts` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `shopping_cart` int(11) unsigned NOT NULL,
  `discount` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `shopping_cart_discount_discount_foreign_key_1_idx` (`discount`),
  KEY `shopping_cart_discount_shopping_cart_foreign_key_2_idx` (`shopping_cart`),
  CONSTRAINT `shopping_cart_discount_discount_foreign_key_1` FOREIGN KEY (`discount`) REFERENCES `book_discounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `shopping_cart_discount_shopping_cart_foreign_key_2` FOREIGN KEY (`shopping_cart`) REFERENCES `shopping_cart` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table sympho_online_bookstore.shoppint_cart_discounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `shoppint_cart_discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `shoppint_cart_discounts` ENABLE KEYS */;

-- Dumping structure for table sympho_online_bookstore.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=1;

-- Dumping data for table sympho_online_bookstore.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `username`) VALUES
	(1, 'Ruwan Gawarammana', 'RuGawarammana');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
