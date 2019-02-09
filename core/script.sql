SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema appeventos
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `appeventos` ;

-- -----------------------------------------------------
-- Schema appeventos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `appeventos` DEFAULT CHARACTER SET utf8 ;
USE `appeventos` ;

-- -----------------------------------------------------
-- Table `appeventos`.`Local`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `appeventos`.`Local` ;

CREATE TABLE IF NOT EXISTS `appeventos`.`Local` (
  `idLocal` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `categoria` VARCHAR(150) NOT NULL,
  `direccion` VARCHAR(150) NOT NULL,
  `telefono` INT(9) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idLocal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appeventos`.`Evento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `appeventos`.`Evento` ;

CREATE TABLE IF NOT EXISTS `appeventos`.`Evento` (
  `idEvento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `tipo` VARCHAR(150) NOT NULL,
  `fecha` DATE NOT NULL,
  `descripcion` VARCHAR(256) NULL,
  `lugar` VARCHAR(150) NOT NULL,
  `Local_idLocal` INT NOT NULL,
  PRIMARY KEY (`idEvento`, `Local_idLocal`),
  CONSTRAINT `fk_Evento_Local`
    FOREIGN KEY (`Local_idLocal`)
    REFERENCES `appeventos`.`Local` (`idLocal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
 
