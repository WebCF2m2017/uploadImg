-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mvc_5
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mvc_5` ;

-- -----------------------------------------------------
-- Schema mvc_5
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mvc_5` DEFAULT CHARACTER SET utf8 ;
USE `mvc_5` ;

-- -----------------------------------------------------
-- Table `mvc_5`.`droits`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvc_5`.`droits` ;

CREATE TABLE IF NOT EXISTS `mvc_5`.`droits` (
  `iddroits` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `leDroit` VARCHAR(45) NULL,
  `poster` TINYINT(1) NULL DEFAULT 1 COMMENT 'peut poster des images à son nom',
  `supprimer` TINYINT(1) NULL DEFAULT 0 COMMENT 'peut supprimer ses images',
  `modifier` TINYINT(1) NULL DEFAULT 1 COMMENT 'peut modifier ses images (titre et desc)',
  `posterTous` TINYINT(1) NULL DEFAULT 0 COMMENT 'Peut poster au nom de n\'importe qui',
  `modifierTous` TINYINT(1) NULL DEFAULT 0 COMMENT 'Peut modifier tous les images (titre et description)',
  `supprimerTous` TINYINT(1) NULL DEFAULT 0 COMMENT 'Peut supprimer les images de tout le monde',
  PRIMARY KEY (`iddroits`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `leDroit_UNIQUE` ON `mvc_5`.`droits` (`leDroit` ASC);


-- -----------------------------------------------------
-- Table `mvc_5`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvc_5`.`users` ;

CREATE TABLE IF NOT EXISTS `mvc_5`.`users` (
  `idusers` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(80) NULL,
  `pwd` VARCHAR(128) NULL,
  `droits_iddroits` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idusers`),
  CONSTRAINT `fk_users_droits1`
    FOREIGN KEY (`droits_iddroits`)
    REFERENCES `mvc_5`.`droits` (`iddroits`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `login_UNIQUE` ON `mvc_5`.`users` (`login` ASC);

CREATE INDEX `fk_users_droits1_idx` ON `mvc_5`.`users` (`droits_iddroits` ASC);


-- -----------------------------------------------------
-- Table `mvc_5`.`images`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvc_5`.`images` ;

CREATE TABLE IF NOT EXISTS `mvc_5`.`images` (
  `idimages` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(80) NOT NULL,
  `desc` VARCHAR(300) NOT NULL,
  `nom` VARCHAR(50) NOT NULL,
  `largeOrigine` SMALLINT UNSIGNED NOT NULL,
  `hautOrigine` SMALLINT UNSIGNED NOT NULL,
  `users_idusers` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idimages`),
  CONSTRAINT `fk_images_users1`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `mvc_5`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `url_UNIQUE` ON `mvc_5`.`images` (`nom` ASC);

CREATE INDEX `fk_images_users1_idx` ON `mvc_5`.`images` (`users_idusers` ASC);


-- -----------------------------------------------------
-- Table `mvc_5`.`categ`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvc_5`.`categ` ;

CREATE TABLE IF NOT EXISTS `mvc_5`.`categ` (
  `idcateg` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `intitule` VARCHAR(45) NULL,
  PRIMARY KEY (`idcateg`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `intitule_UNIQUE` ON `mvc_5`.`categ` (`intitule` ASC);


-- -----------------------------------------------------
-- Table `mvc_5`.`images_has_categ`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvc_5`.`images_has_categ` ;

CREATE TABLE IF NOT EXISTS `mvc_5`.`images_has_categ` (
  `images_idimages` INT UNSIGNED NOT NULL,
  `categ_idcateg` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`images_idimages`, `categ_idcateg`),
  CONSTRAINT `fk_images_has_categ_images`
    FOREIGN KEY (`images_idimages`)
    REFERENCES `mvc_5`.`images` (`idimages`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_images_has_categ_categ1`
    FOREIGN KEY (`categ_idcateg`)
    REFERENCES `mvc_5`.`categ` (`idcateg`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_images_has_categ_categ1_idx` ON `mvc_5`.`images_has_categ` (`categ_idcateg` ASC);

CREATE INDEX `fk_images_has_categ_images_idx` ON `mvc_5`.`images_has_categ` (`images_idimages` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
