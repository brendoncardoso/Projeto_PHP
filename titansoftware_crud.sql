-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.16-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para titansoftware_crud
CREATE DATABASE IF NOT EXISTS `titansoftware_crud` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `titansoftware_crud`;

-- Copiando estrutura para tabela titansoftware_crud.preco
CREATE TABLE IF NOT EXISTS `preco` (
  `idprod` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL COMMENT 'Valor',
  `valor_desc` decimal(10,2) DEFAULT NULL COMMENT 'Valor com Desconto',
  KEY `idprod` (`idprod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela titansoftware_crud.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `idprod` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(500) DEFAULT NULL COMMENT 'Nome do Produto',
  `cor` varchar(500) DEFAULT NULL COMMENT 'Cor do Desconto',
  PRIMARY KEY (`idprod`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
