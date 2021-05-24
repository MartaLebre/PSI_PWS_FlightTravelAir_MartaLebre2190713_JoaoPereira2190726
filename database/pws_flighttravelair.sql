-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24-Maio-2021 às 13:49
-- Versão do servidor: 8.0.22
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pws_flighttravelair`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aeroports`
--

DROP TABLE IF EXISTS `aeroports`;
CREATE TABLE IF NOT EXISTS `aeroports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `morada` varchar(45) DEFAULT NULL,
  `nif` int DEFAULT NULL,
  `telefone` int DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nif_UNIQUE` (`nif`),
  UNIQUE KEY `telefone_UNIQUE` (`telefone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `id` int NOT NULL AUTO_INCREMENT,
  `precoVoo` int DEFAULT NULL,
  `idAeroporto` int NOT NULL,
  PRIMARY KEY (`id`,`idAeroporto`),
  KEY `fk_Flights_Aeroports_idx` (`idAeroporto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `planes`
--

DROP TABLE IF EXISTS `planes`;
CREATE TABLE IF NOT EXISTS `planes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `referencia` varchar(6) DEFAULT NULL,
  `lotacao` int DEFAULT NULL,
  `tipoAviao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `planescales`
--

DROP TABLE IF EXISTS `planescales`;
CREATE TABLE IF NOT EXISTS `planescales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nrPassageiros` int DEFAULT NULL,
  `idEscala` int NOT NULL,
  `idAviao` int NOT NULL,
  PRIMARY KEY (`id`,`idEscala`,`idAviao`),
  KEY `fk_PlaneScales_Scales1_idx` (`idEscala`),
  KEY `fk_PlaneScales_Planes1_idx` (`idAviao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `scales`
--

DROP TABLE IF EXISTS `scales`;
CREATE TABLE IF NOT EXISTS `scales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dataHoraOrigem` datetime DEFAULT NULL,
  `dataHoraDestino` datetime DEFAULT NULL,
  `distancia` int DEFAULT NULL,
  `idAeroportoOrigem` int NOT NULL,
  `idAeroportoDestino` int NOT NULL,
  `idVoo` int NOT NULL,
  PRIMARY KEY (`id`,`idAeroportoOrigem`,`idAeroportoDestino`,`idVoo`),
  KEY `fk_Scales_Aeroports1_idx` (`idAeroportoOrigem`),
  KEY `fk_Scales_Aeroports2_idx` (`idAeroportoDestino`),
  KEY `fk_Scales_Flights1_idx` (`idVoo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `precoFinal` int DEFAULT NULL,
  `dataHoraCompra` datetime DEFAULT NULL,
  `checkin` tinyint DEFAULT NULL,
  `idVooIda` int NOT NULL,
  `idVooVolta` int NOT NULL,
  `idUtilizador` int NOT NULL,
  PRIMARY KEY (`id`,`idVooIda`,`idVooVolta`,`idUtilizador`),
  KEY `fk_Tickets_Flights1_idx` (`idVooIda`),
  KEY `fk_Tickets_Flights2_idx` (`idVooVolta`),
  KEY `fk_Tickets_Users1_idx` (`idUtilizador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomeCompleto` varchar(255) DEFAULT NULL,
  `morada` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` int DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `perfil` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `telefone_UNIQUE` (`telefone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `fk_Flights_Aeroports` FOREIGN KEY (`idAeroporto`) REFERENCES `aeroports` (`id`);

--
-- Limitadores para a tabela `planescales`
--
ALTER TABLE `planescales`
  ADD CONSTRAINT `fk_PlaneScales_Planes1` FOREIGN KEY (`idAviao`) REFERENCES `planes` (`id`),
  ADD CONSTRAINT `fk_PlaneScales_Scales1` FOREIGN KEY (`idEscala`) REFERENCES `scales` (`id`);

--
-- Limitadores para a tabela `scales`
--
ALTER TABLE `scales`
  ADD CONSTRAINT `fk_Scales_Aeroports1` FOREIGN KEY (`idAeroportoOrigem`) REFERENCES `aeroports` (`id`),
  ADD CONSTRAINT `fk_Scales_Aeroports2` FOREIGN KEY (`idAeroportoDestino`) REFERENCES `aeroports` (`id`),
  ADD CONSTRAINT `fk_Scales_Flights1` FOREIGN KEY (`idVoo`) REFERENCES `flights` (`id`);

--
-- Limitadores para a tabela `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_Tickets_Flights1` FOREIGN KEY (`idVooIda`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `fk_Tickets_Flights2` FOREIGN KEY (`idVooVolta`) REFERENCES `flights` (`id`),
  ADD CONSTRAINT `fk_Tickets_Users1` FOREIGN KEY (`idUtilizador`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
