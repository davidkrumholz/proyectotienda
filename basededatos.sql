-- MySQL Script generated by MySQL Workbench
-- Fri Apr 27 12:07:19 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `id_usuarios` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `apellidoPaterno` VARCHAR(50) NOT NULL,
  `apellidoMaterno` VARCHAR(50) NOT NULL,
  `fechanac` DATE NULL,
  `email` VARCHAR(100) NULL,
  `direccion` VARCHAR(150) NOT NULL,
  `ciudad` VARCHAR(100) NOT NULL,
  `colonia` VARCHAR(50) NOT NULL,
  `estado` VARCHAR(50) NOT NULL,
  `codpos` VARCHAR(10) NOT NULL,
  `pais` VARCHAR(50) NOT NULL,
  `numtarjeta` DECIMAL(16,0) NULL,
  `clave` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id_usuarios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`productos` (
  `id_productos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `foto` VARCHAR(45) NULL,
  `precio` DOUBLE NOT NULL,
  `cantidad_almacen` INT NULL,
  `fabricante` VARCHAR(45) NULL,
  `origen` VARCHAR(45) NULL,
  PRIMARY KEY (`id_productos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`historial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`historial` (
  `id_historial` INT NOT NULL AUTO_INCREMENT,
  `id_usuarios` INT NULL,
  `id_productos` INT NULL,
  `compra` INT NULL,
  `cantidad` INT NULL,
  PRIMARY KEY (`id_historial`),
  INDEX `id_usuarios_idx` (`id_usuarios` ASC),
  INDEX `id_productos_idx` (`id_productos` ASC),
  CONSTRAINT `id_usuarios`
    FOREIGN KEY (`id_usuarios`)
    REFERENCES `mydb`.`usuarios` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_productos`
    FOREIGN KEY (`id_productos`)
    REFERENCES `mydb`.`productos` (`id_productos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`carrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carrito` (
  `id_carrito` INT NOT NULL AUTO_INCREMENT,
  `id_usuarios` INT NULL,
  `id_productos` INT NULL,
  `cantidad` INT NULL,
  PRIMARY KEY (`id_carrito`),
  INDEX `id_usuario_idx` (`id_usuarios` ASC),
  INDEX `id_productos_idx` (`id_productos` ASC),
  CONSTRAINT `id_usuarios_fk`
    FOREIGN KEY (`id_usuarios`)
    REFERENCES `mydb`.`usuarios` (`id_usuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_productos_fk`
    FOREIGN KEY (`id_productos`)
    REFERENCES `mydb`.`productos` (`id_productos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `mydb` ;

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`view1` (`id` INT);

-- -----------------------------------------------------
-- View `mydb`.`view1`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`view1`;
USE `mydb`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;