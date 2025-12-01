-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01/12/2025 às 12:20
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdaulas`
--
CREATE DATABASE IF NOT EXISTS `bdaulas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bdaulas`;

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `lista_professor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `lista_professor` (IN `profsigla` VARCHAR(10), IN `siglacurso` VARCHAR(10), IN `serie` VARCHAR(5))   BEGIN
    SELECT 
    	componente.materia AS Materia,
        componente.Sigmateria AS SiglaMateria,
        componente.serie AS Serie,
        professor.nome AS Professor,
        professor.sigla AS SiglaProf
    FROM componente
    INNER JOIN professor 
        ON componente.id_professor = professor.id_professor
    WHERE professor.sigla = profsigla
      AND componente.curso = siglacurso
      AND componente.serie = serie;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `componente`
--

DROP TABLE IF EXISTS `componente`;
CREATE TABLE IF NOT EXISTS `componente` (
  `id_componente` int NOT NULL AUTO_INCREMENT,
  `materia` varchar(100) NOT NULL,
  `Sigmateria` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `serie` varchar(2) NOT NULL,
  `curso` varchar(100) NOT NULL,
  `id_professor` int DEFAULT NULL,
  PRIMARY KEY (`id_componente`),
  KEY `id_professor` (`id_professor`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `componente`
--

INSERT INTO `componente` (`id_componente`, `materia`, `Sigmateria`, `serie`, `curso`, `id_professor`) VALUES
(1, 'Interfaces Web II', 'INW', '2ª', 'IFI', 1),
(2, 'Desenvolvimento Dispositivo Movel', 'DDM', '2ª', 'IFI', 2),
(3, 'Computação em Nuvem para web I', 'CNW', '2ª', 'IFI', 2),
(4, 'Sistemas Web I', 'SWE', '2ª', 'IFI', 1),
(6, 'Banco de Dados', 'BD', '2ª', 'IFI', 1),
(5, 'Programação e Algoritmos', 'PRM', '1ª', 'IFI', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id_professor` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sigla` varchar(3) NOT NULL,
  PRIMARY KEY (`id_professor`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome`, `sigla`) VALUES
(1, 'Luis Carlos dos Santos', 'LCS'),
(2, 'Rafael Russi Zamboni', 'RRZ'),
(3, 'Rosa Mitiko Shimizu', 'RMS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
