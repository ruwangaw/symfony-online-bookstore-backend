SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sympho_online_bookstore
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `sympho_online_bookstore` ;
CREATE SCHEMA IF NOT EXISTS `sympho_online_bookstore` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sympho_online_bookstore` ;

-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`mst_book_categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`mst_book_categories` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`mst_book_categories` (
  `id` INT(11) UNSIGNED NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `code` CHAR(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`mst_book_categories` (`id` ASC);

CREATE UNIQUE INDEX `code_UNIQUE` ON `sympho_online_bookstore`.`mst_book_categories` (`code` ASC);


-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`books`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`books` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`books` (
  `id` INT(11) UNSIGNED NOT NULL,
  `isbn` VARCHAR(45) NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `price` DECIMAL(10,2) UNSIGNED NOT NULL,
  `cover_image` BLOB NULL,
  `category` INT(11) UNSIGNED NOT NULL,
  `created_at` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `book_category_foreign_key_1`
    FOREIGN KEY (`category`)
    REFERENCES `sympho_online_bookstore`.`mst_book_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`books` (`id` ASC);

CREATE UNIQUE INDEX `isbn_UNIQUE` ON `sympho_online_bookstore`.`books` (`isbn` ASC);

CREATE INDEX `book_category_foreign_key_1_idx` ON `sympho_online_bookstore`.`books` (`category` ASC);


-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`user` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`user` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
PACK_KEYS = 1;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`user` (`id` ASC);

CREATE UNIQUE INDEX `username_UNIQUE` ON `sympho_online_bookstore`.`user` (`username` ASC);


-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`shopping_cart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`shopping_cart` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`shopping_cart` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user` INT(11) UNSIGNED NOT NULL,
  `total_amount` DECIMAL(10,2) UNSIGNED ZEROFILL NOT NULL,
  `discount_amount` DECIMAL(10,2) ZEROFILL UNSIGNED NOT NULL,
  `gross_amount` DECIMAL(10,2) UNSIGNED ZEROFILL NOT NULL,
  `created_at` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `shopping_cart_user_foreign_key`
    FOREIGN KEY (`user`)
    REFERENCES `sympho_online_bookstore`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`shopping_cart` (`id` ASC);

CREATE INDEX `shopping_cart_user_foreign_key_idx` ON `sympho_online_bookstore`.`shopping_cart` (`user` ASC);


-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`shopping_cart_books`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`shopping_cart_books` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`shopping_cart_books` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shopping_cart` INT(11) UNSIGNED NOT NULL,
  `book` INT(11) UNSIGNED NOT NULL,
  `item_count` INT(11) ZEROFILL UNSIGNED NOT NULL,
  `calculated_price` DECIMAL(10,2) ZEROFILL UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `shopping_cart_froeign_key_1`
    FOREIGN KEY (`shopping_cart`)
    REFERENCES `sympho_online_bookstore`.`shopping_cart` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `book_foreign_key_2`
    FOREIGN KEY (`book`)
    REFERENCES `sympho_online_bookstore`.`books` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`shopping_cart_books` (`id` ASC);

CREATE INDEX `shopping_cart_froeign_key_1_idx` ON `sympho_online_bookstore`.`shopping_cart_books` (`shopping_cart` ASC);

CREATE INDEX `book_foreign_key_2_idx` ON `sympho_online_bookstore`.`shopping_cart_books` (`book` ASC);


-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`book_discounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`book_discounts` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`book_discounts` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book` INT(11) UNSIGNED NULL,
  `book_category` INT(11) UNSIGNED NULL,
  `minimum_books_count` INT(11) ZEROFILL UNSIGNED NOT NULL,
  `coupon_discount` INT(1) ZEROFILL NULL,
  `coupon_code` VARCHAR(10) NULL,
  `discount_percentage` DECIMAL(10,2) UNSIGNED ZEROFILL NOT NULL,
  `starts_at` VARCHAR(45) NOT NULL,
  `ends_at` VARCHAR(45) NOT NULL,
  `active` INT(1) NOT NULL,
  `created_at` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `book_discounts_book_foreign_key_1`
    FOREIGN KEY (`book`)
    REFERENCES `sympho_online_bookstore`.`books` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `book_discounts_books_category_foreign_key_2`
    FOREIGN KEY (`book_category`)
    REFERENCES `sympho_online_bookstore`.`mst_book_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`book_discounts` (`id` ASC);

CREATE INDEX `book_discounts_book_foreign_key_1_idx` ON `sympho_online_bookstore`.`book_discounts` (`book` ASC);

CREATE INDEX `book_discounts_books_category_foreign_key_2_idx` ON `sympho_online_bookstore`.`book_discounts` (`book_category` ASC);


-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`shoppint_cart_discounts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`shoppint_cart_discounts` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`shoppint_cart_discounts` (
  `id` INT(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `shopping_cart` INT(11) UNSIGNED NOT NULL,
  `discount` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `shopping_cart_discount_discount_foreign_key_1`
    FOREIGN KEY (`discount`)
    REFERENCES `sympho_online_bookstore`.`book_discounts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `shopping_cart_discount_shopping_cart_foreign_key_2`
    FOREIGN KEY (`shopping_cart`)
    REFERENCES `sympho_online_bookstore`.`shopping_cart` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`shoppint_cart_discounts` (`id` ASC);

CREATE INDEX `shopping_cart_discount_discount_foreign_key_1_idx` ON `sympho_online_bookstore`.`shoppint_cart_discounts` (`discount` ASC);

CREATE INDEX `shopping_cart_discount_shopping_cart_foreign_key_2_idx` ON `sympho_online_bookstore`.`shoppint_cart_discounts` (`shopping_cart` ASC);


-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`mst_invoice_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`mst_invoice_status` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`mst_invoice_status` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `code` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`mst_invoice_status` (`id` ASC);

CREATE UNIQUE INDEX `code_UNIQUE` ON `sympho_online_bookstore`.`mst_invoice_status` (`code` ASC);


-- -----------------------------------------------------
-- Table `sympho_online_bookstore`.`invoice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sympho_online_bookstore`.`invoice` ;

CREATE TABLE IF NOT EXISTS `sympho_online_bookstore`.`invoice` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `shopping_cart` INT(11) UNSIGNED NOT NULL,
  `txn_at` VARCHAR(45) NULL,
  `receipt_status` INT(11) UNSIGNED NOT NULL,
  `paid_amount` INT(11) UNSIGNED ZEROFILL NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `invoice_shopping_cart_foreign_key_1`
    FOREIGN KEY (`shopping_cart`)
    REFERENCES `sympho_online_bookstore`.`shopping_cart` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `invoice_receipt_status_foreign_key_2`
    FOREIGN KEY (`receipt_status`)
    REFERENCES `sympho_online_bookstore`.`mst_invoice_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `sympho_online_bookstore`.`invoice` (`id` ASC);

CREATE INDEX `invoice_shopping_cart_foreign_key_1_idx` ON `sympho_online_bookstore`.`invoice` (`shopping_cart` ASC);

CREATE INDEX `invoice_receipt_status_foreign_key_2_idx` ON `sympho_online_bookstore`.`invoice` (`receipt_status` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `sympho_online_bookstore`.`mst_book_categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `sympho_online_bookstore`;
INSERT INTO `sympho_online_bookstore`.`mst_book_categories` (`id`, `name`, `code`) VALUES (1, 'Fiction', 'FIC');
INSERT INTO `sympho_online_bookstore`.`mst_book_categories` (`id`, `name`, `code`) VALUES (2, 'Children', 'CHD');
INSERT INTO `sympho_online_bookstore`.`mst_book_categories` (`id`, `name`, `code`) VALUES (3, 'Fantasy', 'FAN');
INSERT INTO `sympho_online_bookstore`.`mst_book_categories` (`id`, `name`, `code`) VALUES (4, 'Contemporary', 'CON');
INSERT INTO `sympho_online_bookstore`.`mst_book_categories` (`id`, `name`, `code`) VALUES (5, 'Adventure', 'ADV');
INSERT INTO `sympho_online_bookstore`.`mst_book_categories` (`id`, `name`, `code`) VALUES (6, 'Romance', 'ROM');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sympho_online_bookstore`.`book_discounts`
-- -----------------------------------------------------
START TRANSACTION;
USE `sympho_online_bookstore`;
INSERT INTO `sympho_online_bookstore`.`book_discounts` (`id`, `book`, `book_category`, `minimum_books_count`, `coupon_discount`, `coupon_code`, `discount_percentage`, `starts_at`, `ends_at`, `active`, `created_at`) VALUES (1, NULL, 2, 5, 0, NULL, 10.00, '2021-05-01', '2021-05-31', 1, '2021-05-01');
INSERT INTO `sympho_online_bookstore`.`book_discounts` (`id`, `book`, `book_category`, `minimum_books_count`, `coupon_discount`, `coupon_code`, `discount_percentage`, `starts_at`, `ends_at`, `active`, `created_at`) VALUES (2, NULL, NULL, 10, 0, NULL, 5.00, '2021-05-01', '2021-05-31', 1, '2021-05-01');
INSERT INTO `sympho_online_bookstore`.`book_discounts` (`id`, `book`, `book_category`, `minimum_books_count`, `coupon_discount`, `coupon_code`, `discount_percentage`, `starts_at`, `ends_at`, `active`, `created_at`) VALUES (3, NULL, NULL, NULL, 1, 'RU00000001', 15.00, '2021-05-01', '2021-05-31', 1, '2021-05-01');

COMMIT;

