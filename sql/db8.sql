-- MySQL Script generated by MySQL Workbench
-- Sun 14 Oct 2018 14:19:36 CEST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema default_schema
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`profiles_employees`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`profiles_employees` ;

CREATE TABLE IF NOT EXISTS `mydb`.`profiles_employees` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(255) NULL DEFAULT NULL,
  `dateofbirth` DATE NULL DEFAULT NULL,
  `picture` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`roles` ;

CREATE TABLE IF NOT EXISTS `mydb`.`roles` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(256) NOT NULL DEFAULT '',
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users` ;

CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(128) NOT NULL DEFAULT '',
  `lname` VARCHAR(256) NOT NULL DEFAULT '',
  `email` VARCHAR(256) NOT NULL DEFAULT '',
  `mobile` VARCHAR(20) NULL DEFAULT '+31 (0) 6 ',
  `lastLogin` DATE NULL DEFAULT '2000-01-31' COMMENT 'YYYY-MM-DD',
  `roles_id` INT(11) UNSIGNED NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `rememberMeToken` VARCHAR(255) NOT NULL,
  `forgotPasswordToken` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`, `roles_id`),
  INDEX `fk_users_roles_idx` (`roles_id` ASC) ,
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`roles_id`)
    REFERENCES `mydb`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `mydb`.`profiles_kids`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`profiles_kids` ;

CREATE TABLE IF NOT EXISTS `mydb`.`profiles_kids` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(256) NULL DEFAULT NULL,
  `dateofbirth` DATE NOT NULL DEFAULT '2000-01-31' COMMENT 'YYYY-MM-DD',
  `reason` VARCHAR(1024) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`profiles_doctors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`profiles_doctors` ;

CREATE TABLE IF NOT EXISTS `mydb`.`profiles_doctors` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(256) NULL DEFAULT NULL,
  `dateofbirth` DATE NOT NULL DEFAULT '2000-01-31' COMMENT 'YYYY-MM-DD',
  `proficiency` VARCHAR(1024) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`profiles_parents_caretakers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`profiles_parents_caretakers` ;

CREATE TABLE IF NOT EXISTS `mydb`.`profiles_parents_caretakers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(256) NULL DEFAULT NULL,
  `dateofbirth` DATE NULL DEFAULT '2000-01-31' COMMENT 'YYYY-MM-DD',
  `picture` VARCHAR(1024) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`profiles` ;

CREATE TABLE IF NOT EXISTS `mydb`.`profiles` (
  `users_id` INT(11) UNSIGNED NOT NULL,
  `profiles_doctors_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  `profiles_kids_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  `profiles_employees_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  `profiles_parents_caretakers_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`users_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`careforschemas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`careforschemas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`careforschemas` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_start` DATE NULL DEFAULT '2000-01-31' COMMENT 'YYYY-MM-DD',
  `date_review` DATE NULL DEFAULT '2000-01-31' COMMENT 'YYYY-MM-DD',
  `name` VARCHAR(255) NULL DEFAULT 'behandelplan',
  `extra` VARCHAR(1024) NULL DEFAULT NULL,
  `profiles_doctors_id` INT(11) UNSIGNED NULL,
  `profiles_kids_id` INT(11) UNSIGNED NULL,
  `profiles_parents_caretakers_id` INT(11) UNSIGNED NULL,
  `parent_has_permission` TINYINT NULL,
  `kid_has_permission` TINYINT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`events` ;

CREATE TABLE IF NOT EXISTS `mydb`.`events` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_event` DATE NULL DEFAULT '2000-01-31' COMMENT 'YYYY-MM-DD',
  `eventname` VARCHAR(128) NOT NULL DEFAULT '',
  `pictures` VARCHAR(5024) NULL DEFAULT '',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`day2dayinformation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`day2dayinformation` ;

CREATE TABLE IF NOT EXISTS `mydb`.`day2dayinformation` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATE NULL DEFAULT '2000-01-31' COMMENT 'YYYY-MM-DD',
  `description` VARCHAR(1024) NULL DEFAULT '',
  `title` VARCHAR(255) NOT NULL,
  `profiles_employees_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `profiles_employees_id`),
  INDEX `fk_day2dayinformation_profiles_employees1_idx` (`profiles_employees_id` ASC) ,
  CONSTRAINT `fk_day2dayinformation_profiles_employees1`
    FOREIGN KEY (`profiles_employees_id`)
    REFERENCES `mydb`.`profiles_employees` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`comments` ;

CREATE TABLE IF NOT EXISTS `mydb`.`comments` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(256) NULL DEFAULT NULL,
  `votes` INT(11) NULL DEFAULT '0',
  `events_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  `day2dayinformation_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  `day2dayinformation_profiles_owners_id` INT(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_events1_idx` (`events_id` ASC) ,
  INDEX `fk_comments_day2dayinformation1_idx` (`day2dayinformation_id` ASC, `day2dayinformation_profiles_owners_id` ASC) ,
  CONSTRAINT `fk_comments_events1`
    FOREIGN KEY (`events_id`)
    REFERENCES `mydb`.`events` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_day2dayinformation1`
    FOREIGN KEY (`day2dayinformation_id`)
    REFERENCES `mydb`.`day2dayinformation` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
