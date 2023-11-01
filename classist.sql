-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Nov-2023 às 21:02
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `classist`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alarm`
--

DROP TABLE IF EXISTS `alarm`;
CREATE TABLE IF NOT EXISTS `alarm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alarm_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipment_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alarm_status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alarm_class` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `entry_date` datetime DEFAULT NULL,
  `departure_date` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `alarm`
--

INSERT INTO `alarm` (`id`, `alarm_description`, `equipment_name`, `alarm_status`, `alarm_class`, `entry_date`, `departure_date`, `created_at`, `modified_at`) VALUES
(1, 'Alarme teste 01', 'Equipamento teste 03', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', '2023-10-31 19:45:22'),
(2, 'Alarme teste 02', 'Equipamento teste 04', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(3, 'Alarme teste 03', 'Equipamento teste 05', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(4, 'Alarme teste 04', 'Equipamento teste 06', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(5, 'Alarme teste 05', 'Equipamento teste 07', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(6, 'Alarme teste 07', 'Equipamento teste 55', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(7, 'Alarme teste 06', 'Equipamento teste 66', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(8, 'Alarme teste 08', 'Equipamento teste 88', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(9, 'Alarme teste 09', 'Equipamento teste 99', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(10, 'Alarme teste 10', 'Equipamento teste 20', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(11, 'Alarme teste 11', 'Equipamento teste 21', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(12, 'Alarme teste 23', 'Equipamento teste 23', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(13, 'Alarme teste 24', 'Equipamento teste 24', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(14, 'Alarme teste 25', 'Equipamento teste 25', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(15, 'Alarme teste 26', 'Equipamento teste 26', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(16, 'Alarme teste 27', 'Equipamento teste 27', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(17, 'Alarme teste 28', 'Equipamento teste 28', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(18, 'Alarme teste 29', 'Equipamento teste 29', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(19, 'Alarme teste 30', 'Equipamento teste 30', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(20, 'Alarme teste 12', 'Equipamento teste 22', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(21, 'Alarme teste 13', 'Equipamento teste 33', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(22, 'Alarme teste 14', 'Equipamento teste 44', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(23, 'Alarme teste 15', 'Equipamento teste 55', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(24, 'Alarme teste 16', 'Equipamento teste 66', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(25, 'Alarme teste 17', 'Equipamento teste 77', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(26, 'Alarme teste 18', 'Equipamento teste 88', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(27, 'Alarme teste 20', 'Equipamento teste 20', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(28, 'Alarme teste 21', 'Equipamento teste 21', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(29, 'Alarme teste 22', 'Equipamento teste 22', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(30, 'Alarme teste 23', 'Equipamento teste 23', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(31, 'Alarme teste 24', 'Equipamento teste 24', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(32, 'Alarme teste 25', 'Equipamento teste 25', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(33, 'Alarme teste 26', 'Equipamento teste 26', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(34, 'Alarme teste 27', 'Equipamento teste 27', 'Desativado', 'Urgente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(35, 'Alarme teste 28', 'Equipamento teste 28', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(36, 'Alarme teste 29', 'Equipamento teste 29', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(37, 'Alarme teste 30', 'Equipamento teste 30', 'Desativado', 'Emergente', NULL, NULL, '2023-10-28 17:30:10', NULL),
(38, 'Alarme teste 19', 'Equipamento teste 88', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-28 17:30:10', NULL),
(39, 'Novo alarme 02', 'Equipamento 02', 'Desativado', 'Ordinário', NULL, NULL, '2023-10-31 19:34:36', '2023-10-31 19:35:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alarms_actuated`
--

DROP TABLE IF EXISTS `alarms_actuated`;
CREATE TABLE IF NOT EXISTS `alarms_actuated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_alarm` int(11) NOT NULL,
  `alarm_status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_date` datetime DEFAULT NULL,
  `departure_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alarm_status`
--

DROP TABLE IF EXISTS `alarm_status`;
CREATE TABLE IF NOT EXISTS `alarm_status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `alarm_status`
--

INSERT INTO `alarm_status` (`id_status`, `status_name`) VALUES
(1, 'Ativado'),
(2, 'Desativado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_eqp` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `equipment`
--

INSERT INTO `equipment` (`id`, `equipment_name`, `serial_number`, `type_eqp`, `created_at`, `modified_at`) VALUES
(1, 'Equipamento 01', 'EQ-2023/10-0001', 'Tensão', '2023-10-19 17:00:01', NULL),
(2, 'Equipamento 02', 'EQ-2023/10-0002', 'Corrente', '2023-10-19 17:00:02', NULL),
(3, 'Equipamento 03', 'EQ-2023/10-0003', 'Óleo', '2023-10-19 17:00:03', NULL),
(4, 'Equipamento 04', 'EQ-2023/10-0004', 'Tensão', '2023-10-19 17:00:04', NULL),
(5, 'Equipamento 05', 'EQ-2023/10-0005', 'Corrente', '2023-10-19 17:00:05', NULL),
(6, 'Equipamento 06', 'EQ-2023/10-0006', 'Óleo', '2023-10-19 17:00:06', NULL),
(7, 'Equipamento 07', 'EQ-2023/10-0007', 'Tensão', '2023-10-19 17:00:07', NULL),
(8, 'Equipamento 08', 'EQ-2023/10-0008', 'Corrente', '2023-10-19 17:00:08', NULL),
(9, 'Equipamento 09', 'EQ-2023/10-0009', 'Óleo', '2023-10-19 17:00:09', NULL),
(10, 'Equipamento 10', 'EQ-2023/10-0010', 'Tensão', '2023-10-19 17:00:10', NULL),
(21, 'Equipamento 11', 'EQ-2023/10-0001', 'Tensão', '2023-10-29 17:00:01', NULL),
(22, 'Equipamento 12', 'EQ-2023/10-0002', 'Corrente', '2023-10-29 17:00:02', NULL),
(23, 'Equipamento 13', 'EQ-2023/10-0003', 'Óleo', '2023-10-19 17:00:03', NULL),
(24, 'Equipamento 14', 'EQ-2023/10-0004', 'Tensão', '2023-10-29 17:00:04', NULL),
(25, 'Equipamento 15', 'EQ-2023/10-0005', 'Corrente', '2023-10-29 17:00:05', NULL),
(26, 'Equipamento 16', 'EQ-2023/10-0006', 'Óleo', '2023-10-29 17:00:06', NULL),
(27, 'Equipamento 17', 'EQ-2023/10-0007', 'Tensão', '2023-10-29 17:00:07', NULL),
(28, 'Equipamento 18', 'EQ-2023/10-0008', 'Corrente', '2023-10-29 17:00:08', NULL),
(29, 'Equipamento 19', 'EQ-2023/10-0009', 'Óleo', '2023-10-29 17:00:09', NULL),
(30, 'Equipamento 20', 'EQ-2023/10-0010', 'Tensão', '2023-10-29 17:00:10', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_log`
--

DROP TABLE IF EXISTS `system_log`;
CREATE TABLE IF NOT EXISTS `system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_taken` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
