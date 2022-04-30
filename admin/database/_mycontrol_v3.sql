-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Abr-2022 às 23:58
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `_mycontrol_v3`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `matricula` varchar(300) NOT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `nome` varchar(300) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `img_path` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `matricula`, `cpf`, `nome`, `email`, `img_path`) VALUES
(1, '123456', '14364990701', 'Thiago Bastos', NULL, '1616514900_pp.jpg'),
(2, '654321', '11111111111', 'Gabriel Vieira', NULL, '1616514960_biel.jpg'),
(3, '111111', '22222222222', 'José de Aquino Vargas', NULL, ''),
(4, '222222', '33333333333', 'Mayara Mello', NULL, '1616514900_girl_female_woman_avatar-512.png'),
(5, '123123', '44444444444', 'Tiago Paradela Gurgel', 'bthiagos@gmail.com', '1614876960_ticao.jpeg'),
(6, '123455', '14364990702', 'Iago Bastos dos Santos', NULL, '1624301280_download.jpg'),
(7, '112233', '55555555555', 'Marina Camargo', NULL, '1624476420_marinex.jpg'),
(11, '444444', '77777777777', 'Daniel da Silva', NULL, '1629724440_pp.jfif'),
(14, '666666', '99999999999', 'Thiago Medeiros', NULL, '1629728460_pp (2).jfif'),
(15, '777777', '14785236975', 'Diogo Maia', NULL, '1629728580_pp (2).jfif'),
(17, '888888', '15935785212', 'Ursula Mariana', NULL, '1629730140__1.jfif'),
(25, '951159', NULL, 'Alma Russa', 'russomana@am.com', '1635350100_20210519130512_eb42f82584a838a19c5cb6b30fb840b821d0aa95533716750ce58e6a5300fe64.jpg'),
(26, '456456', '14725836902', 'Joana Carvalho', 'joana_cora@gmail.com', '1635361200_BH_LL.jpeg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunoxresponsavel`
--

CREATE TABLE `alunoxresponsavel` (
  `id` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `idresponsavel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunoxresponsavel`
--

INSERT INTO `alunoxresponsavel` (`id`, `idaluno`, `idresponsavel`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 6, 1),
(4, 5, 36),
(5, 6, 37),
(9, 5, 5),
(10, 7, 36),
(11, 7, 5),
(12, 1, 35),
(13, 6, 35);

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_email`
--

CREATE TABLE `config_email` (
  `id` int(11) NOT NULL,
  `host` varchar(200) NOT NULL,
  `porta` varchar(8) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config_email`
--

INSERT INTO `config_email` (`id`, `host`, `porta`, `usuario`, `senha`) VALUES
(1, 'mycontrol', '587', 'mycontrol', '!@&*(¨!@&*!271672671$');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_sistema`
--

CREATE TABLE `config_sistema` (
  `id` int(30) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contato` varchar(20) NOT NULL,
  `img_path` varchar(300) NOT NULL,
  `sobre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config_sistema`
--

INSERT INTO `config_sistema` (`id`, `nome`, `email`, `contato`, `img_path`, `sobre`) VALUES
(1, 'myControl - Controle Escolar', 'bthiagos@gmail.com', '+5521970027164', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `redefine_senha_temp`
--

CREATE TABLE `redefine_senha_temp` (
  `email` varchar(250) NOT NULL,
  `chave` varchar(250) NOT NULL,
  `data_criacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `redefine_senha_temp`
--

INSERT INTO `redefine_senha_temp` (`email`, `chave`, `data_criacao`) VALUES
('bthiagos@gmail.com', 'd0a0a53fa62c867e1381934d8ffad7a7', '2021-11-10 13:21:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `idaluno` int(11) NOT NULL,
  `tipo_registro` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `registros`
--

INSERT INTO `registros` (`id`, `tipo`, `idaluno`, `tipo_registro`, `data_criacao`) VALUES
(1, 'aluno', 1, 1, '2021-03-09 15:50:32'),
(2, 'aluno', 1, 2, '2021-03-09 15:50:58'),
(3, 'aluno', 1, 2, '2021-03-09 15:50:58'),
(4, 'aluno', 2, 1, '2021-03-09 15:50:58'),
(5, 'aluno', 2, 2, '2021-03-09 15:53:15'),
(6, 'aluno', 5, 1, '2021-03-09 15:53:34'),
(7, 'aluno', 5, 2, '2020-03-09 15:53:38'),
(8, 'aluno', 1, 1, '2021-03-13 22:29:34'),
(9, 'aluno', 1, 2, '2021-03-13 22:29:36'),
(10, 'aluno', 5, 1, '2021-03-13 22:29:37'),
(11, 'aluno', 5, 2, '2021-03-13 22:29:39'),
(12, 'aluno', 1, 1, '2021-03-13 22:29:41'),
(13, 'aluno', 1, 2, '2021-03-13 22:29:44'),
(14, 'aluno', 1, 1, '2021-03-13 23:47:12'),
(15, 'aluno', 1, 2, '2021-03-13 23:47:15'),
(16, 'aluno', 5, 1, '2021-03-15 21:24:13'),
(17, 'aluno', 5, 2, '2021-03-15 21:24:15'),
(18, 'aluno', 1, 1, '2021-03-15 21:24:16'),
(19, 'aluno', 1, 2, '2021-03-15 21:24:18'),
(20, 'aluno', 5, 1, '2021-03-15 21:40:31'),
(21, 'aluno', 5, 2, '2021-03-15 21:40:33'),
(22, 'aluno', 5, 1, '2021-03-16 18:44:37'),
(23, 'aluno', 5, 2, '2021-03-16 18:44:39'),
(24, 'aluno', 5, 1, '2021-03-16 18:44:42'),
(25, 'aluno', 5, 2, '2021-03-16 18:44:44'),
(26, 'aluno', 1, 1, '2021-03-16 18:44:47'),
(27, 'aluno', 1, 2, '2021-03-16 18:44:48'),
(28, 'aluno', 1, 1, '2021-03-16 18:50:56'),
(29, 'aluno', 1, 2, '2021-03-16 18:51:31'),
(30, 'aluno', 1, 1, '2021-03-16 18:51:33'),
(31, 'aluno', 1, 2, '2021-03-16 18:51:35'),
(32, 'aluno', 1, 1, '2021-03-16 18:51:37'),
(33, 'aluno', 5, 1, '2021-03-16 18:51:39'),
(34, 'aluno', 5, 2, '2021-03-16 18:51:40'),
(35, 'aluno', 5, 1, '2021-03-16 18:51:44'),
(36, 'aluno', 5, 2, '2021-03-16 18:51:46'),
(37, 'aluno', 5, 1, '2021-03-16 18:58:58'),
(38, 'aluno', 5, 2, '2021-03-16 18:59:56'),
(39, 'aluno', 5, 1, '2021-03-16 18:59:57'),
(40, 'aluno', 5, 2, '2021-03-16 18:59:58'),
(41, 'aluno', 5, 1, '2021-03-16 19:00:00'),
(42, 'aluno', 5, 2, '2021-03-16 19:00:04'),
(43, 'aluno', 1, 2, '2021-03-16 19:00:06'),
(44, 'aluno', 1, 1, '2021-03-16 19:00:08'),
(45, 'aluno', 1, 2, '2021-03-16 19:00:10'),
(46, 'aluno', 1, 1, '2021-03-16 19:01:30'),
(47, 'aluno', 1, 2, '2021-03-16 19:01:33'),
(48, 'aluno', 5, 1, '2021-03-16 19:01:36'),
(49, 'aluno', 5, 2, '2021-03-16 19:01:38'),
(50, 'aluno', 5, 1, '2021-03-16 19:01:40'),
(51, 'aluno', 5, 2, '2021-03-16 19:01:43'),
(52, 'aluno', 5, 1, '2021-03-16 19:37:55'),
(53, 'aluno', 5, 2, '2021-03-16 19:37:57'),
(54, 'aluno', 1, 1, '2021-03-16 19:38:01'),
(55, 'aluno', 1, 2, '2021-03-16 19:38:03'),
(56, 'aluno', 5, 1, '2021-03-16 19:47:16'),
(57, 'aluno', 5, 2, '2021-03-16 19:47:18'),
(58, 'aluno', 1, 1, '2021-03-16 19:47:25'),
(59, 'aluno', 1, 2, '2021-03-16 19:47:30'),
(60, 'aluno', 5, 1, '2021-03-16 19:48:24'),
(61, 'aluno', 5, 2, '2021-03-16 19:48:40'),
(62, 'aluno', 5, 1, '2021-03-16 20:18:37'),
(63, 'aluno', 5, 2, '2021-03-16 20:18:39'),
(64, 'aluno', 1, 1, '2021-03-16 20:18:41'),
(65, 'aluno', 1, 2, '2021-03-16 20:18:43'),
(66, 'aluno', 5, 1, '2021-03-17 00:23:32'),
(67, 'aluno', 5, 2, '2021-03-17 00:28:41'),
(68, 'aluno', 5, 1, '2021-03-17 00:29:07'),
(69, 'aluno', 5, 2, '2021-03-17 00:40:14'),
(70, 'aluno', 1, 1, '2021-03-17 00:46:52'),
(71, 'aluno', 1, 2, '2021-03-17 00:48:34'),
(72, 'aluno', 5, 1, '2021-03-17 00:49:21'),
(73, 'aluno', 5, 2, '2021-03-17 00:49:54'),
(74, 'aluno', 5, 1, '2021-03-17 00:50:56'),
(75, 'aluno', 5, 2, '2021-03-17 00:51:46'),
(76, 'aluno', 5, 1, '2021-03-17 00:51:48'),
(77, 'aluno', 5, 1, '2021-03-22 18:09:36'),
(78, 'aluno', 5, 2, '2021-03-22 18:09:37'),
(79, 'aluno', 1, 1, '2021-03-22 18:09:39'),
(80, 'aluno', 1, 2, '2021-03-22 18:09:42'),
(81, 'aluno', 5, 1, '2021-03-23 12:49:19'),
(82, 'aluno', 5, 2, '2021-03-23 12:49:21'),
(83, 'aluno', 1, 1, '2021-03-23 12:49:22'),
(84, 'aluno', 1, 2, '2021-03-23 12:49:24'),
(85, 'aluno', 2, 1, '2021-03-23 12:49:26'),
(86, 'aluno', 2, 2, '2021-03-23 12:49:27'),
(87, 'aluno', 1, 1, '2021-03-23 13:08:59'),
(88, 'aluno', 1, 2, '2021-03-23 13:09:01'),
(89, 'aluno', 3, 1, '2021-03-23 13:09:06'),
(90, 'aluno', 3, 2, '2021-03-23 13:09:08'),
(91, 'aluno', 4, 1, '2021-03-23 13:09:13'),
(92, 'aluno', 4, 2, '2021-03-23 13:09:16'),
(93, 'aluno', 5, 1, '2021-03-23 19:04:36'),
(94, 'aluno', 5, 2, '2021-03-23 19:04:38'),
(95, 'aluno', 1, 1, '2021-03-23 19:04:39'),
(96, 'aluno', 1, 2, '2021-03-23 19:04:41'),
(97, 'aluno', 5, 1, '2021-03-29 21:26:11'),
(98, 'aluno', 1, 1, '2021-03-29 21:26:13'),
(99, 'aluno', 2, 1, '2021-03-29 21:26:15'),
(100, 'aluno', 3, 1, '2021-03-29 21:26:17'),
(101, 'aluno', 4, 1, '2021-03-29 21:26:18'),
(102, 'aluno', 5, 1, '2021-03-30 17:48:21'),
(103, 'aluno', 1, 1, '2021-09-06 14:09:32'),
(104, 'aluno', 2, 1, '2021-03-30 17:48:29'),
(105, 'aluno', 3, 1, '2021-03-30 17:48:31'),
(106, 'aluno', 4, 1, '2021-03-30 17:48:33'),
(107, 'aluno', 1, 2, '2021-03-30 17:49:08'),
(108, 'aluno', 5, 1, '2021-04-05 18:17:14'),
(109, 'aluno', 5, 2, '2021-04-05 18:17:16'),
(110, 'aluno', 2, 1, '2021-04-05 18:17:19'),
(111, 'aluno', 2, 2, '2021-04-05 18:17:20'),
(112, 'aluno', 1, 1, '2021-04-05 18:17:24'),
(113, 'aluno', 1, 2, '2021-04-05 18:17:26'),
(114, 'aluno', 1, 1, '2021-04-05 18:29:16'),
(115, 'aluno', 5, 1, '2021-05-11 14:27:50'),
(116, 'aluno', 1, 1, '2021-05-11 14:27:54'),
(117, 'aluno', 5, 2, '2021-05-11 14:27:56'),
(118, 'aluno', 1, 2, '2021-05-11 14:27:58'),
(119, 'aluno', 2, 1, '2021-09-06 14:09:32'),
(120, 'aluno', 2, 2, '2021-05-11 16:45:57'),
(121, 'aluno', 2, 1, '2021-05-11 16:45:58'),
(122, 'aluno', 2, 2, '2021-05-11 16:46:00'),
(123, 'aluno', 6, 1, '2021-06-24 16:54:14'),
(124, 'aluno', 6, 2, '2021-06-24 16:54:16'),
(125, 'aluno', 1, 1, '2021-07-09 14:14:50'),
(126, 'aluno', 2, 1, '2021-07-09 14:14:52'),
(127, 'aluno', 3, 1, '2021-07-09 14:14:54'),
(128, 'aluno', 4, 1, '2021-07-09 14:14:55'),
(129, 'aluno', 5, 1, '2021-07-09 14:14:56'),
(130, 'aluno', 4, 2, '2021-07-09 14:14:57'),
(131, 'aluno', 3, 2, '2021-07-09 14:14:57'),
(132, 'aluno', 2, 2, '2021-07-09 14:14:58'),
(133, 'aluno', 1, 2, '2021-07-09 14:14:59'),
(134, 'aluno', 1, 1, '2021-07-09 14:15:02'),
(135, 'aluno', 2, 1, '2021-07-09 14:15:03'),
(136, 'aluno', 3, 1, '2021-07-09 14:15:04'),
(137, 'aluno', 4, 1, '2021-07-09 14:15:05'),
(138, 'aluno', 5, 2, '2021-07-09 14:15:05'),
(139, 'aluno', 5, 1, '2021-07-09 14:15:06'),
(140, 'aluno', 4, 2, '2021-07-09 14:15:07'),
(141, 'aluno', 3, 2, '2021-07-09 14:15:08'),
(142, 'aluno', 2, 2, '2021-07-09 14:15:08'),
(143, 'aluno', 1, 2, '2021-07-09 14:15:09'),
(144, 'aluno', 1, 1, '2021-07-13 16:04:19'),
(145, 'aluno', 2, 1, '2021-07-13 16:04:23'),
(146, 'aluno', 3, 1, '2021-07-13 16:04:23'),
(147, 'aluno', 4, 1, '2021-07-13 16:04:24'),
(148, 'aluno', 5, 1, '2021-07-13 16:04:25'),
(149, 'aluno', 1, 2, '2021-07-13 16:04:26'),
(150, 'aluno', 2, 2, '2021-07-13 16:04:26'),
(151, 'aluno', 3, 2, '2021-07-13 16:04:27'),
(152, 'aluno', 4, 2, '2021-07-13 16:04:28'),
(153, 'aluno', 5, 2, '2021-07-13 16:04:29'),
(154, 'aluno', 6, 1, '2021-07-13 16:04:32'),
(155, 'aluno', 7, 1, '2021-07-13 16:04:33'),
(156, 'aluno', 7, 2, '2021-07-13 16:04:34'),
(157, 'aluno', 6, 2, '2021-07-13 16:04:35'),
(158, 'aluno', 1, 1, '2021-07-14 19:12:23'),
(159, 'aluno', 1, 2, '2021-07-14 19:12:28'),
(160, 'aluno', 1, 1, '2021-07-15 15:39:01'),
(161, 'aluno', 1, 2, '2021-07-15 15:40:39'),
(162, 'aluno', 1, 1, '2021-07-15 15:44:05'),
(163, 'aluno', 1, 2, '2021-07-15 15:44:08'),
(164, 'aluno', 1, 1, '2021-07-15 15:44:10'),
(165, 'aluno', 1, 2, '2021-07-15 15:44:11'),
(166, 'aluno', 1, 1, '2021-07-15 15:44:12'),
(167, 'aluno', 1, 2, '2021-07-15 15:47:37'),
(168, 'aluno', 5, 1, '2021-07-15 15:48:51'),
(169, 'aluno', 5, 2, '2021-07-15 15:49:24'),
(294, 'aluno', 1, 1, '2021-08-16 07:00:00'),
(295, 'aluno', 1, 2, '2021-08-16 12:00:00'),
(296, 'aluno', 1, 1, '2021-08-17 07:00:00'),
(297, 'aluno', 1, 2, '2021-08-17 12:00:00'),
(298, 'aluno', 1, 1, '2021-08-18 07:00:00'),
(299, 'aluno', 1, 2, '2021-08-18 12:00:00'),
(300, 'aluno', 1, 1, '2021-08-19 07:00:00'),
(301, 'aluno', 1, 2, '2021-08-19 12:00:00'),
(302, 'aluno', 1, 1, '2021-08-20 11:35:41'),
(303, 'aluno', 6, 1, '2021-09-07 12:09:32'),
(304, 'aluno', 5, 1, '2021-08-20 11:36:33'),
(305, 'aluno', 3, 1, '2021-08-20 11:37:23'),
(306, 'aluno', 4, 1, '2021-08-20 11:37:26'),
(307, 'aluno', 2, 1, '2021-08-20 11:38:29'),
(308, 'aluno', 7, 1, '2021-08-20 11:38:45'),
(309, 'aluno', 1, 2, '2021-08-20 11:39:10'),
(347, 'aluno', 1, 1, '2021-08-30 13:51:26'),
(348, 'aluno', 6, 1, '2021-08-30 14:04:56'),
(349, 'aluno', 2, 1, '2021-08-30 14:08:22'),
(350, 'aluno', 2, 2, '2021-09-07 15:47:14'),
(376, 'aluno', 1, 1, '2021-08-31 18:11:51'),
(377, 'aluno', 1, 1, '2021-09-08 14:19:25'),
(378, 'aluno', 1, 2, '2021-09-08 14:19:26'),
(379, 'aluno', 6, 1, '2021-09-08 14:19:28'),
(380, 'aluno', 6, 2, '2021-09-08 14:19:29'),
(381, 'aluno', 5, 1, '2021-09-08 14:19:31'),
(382, 'aluno', 5, 2, '2021-09-08 14:19:32'),
(383, 'aluno', 1, 1, '2021-09-09 16:09:26'),
(384, 'aluno', 6, 1, '2021-09-09 16:09:30'),
(385, 'aluno', 5, 1, '2021-09-09 16:09:32'),
(386, 'aluno', 2, 1, '2021-09-09 16:09:33'),
(387, 'aluno', 3, 1, '2021-09-09 16:09:34'),
(388, 'aluno', 4, 1, '2021-09-09 16:09:35'),
(389, 'aluno', 1, 2, '2021-09-09 17:24:28'),
(390, 'aluno', 6, 2, '2021-09-09 17:24:30'),
(391, 'aluno', 1, 1, '2021-09-11 16:13:26'),
(392, 'aluno', 6, 1, '2021-09-11 16:13:28'),
(406, 'aluno', 1, 1, '2021-09-13 17:42:02'),
(407, 'aluno', 1, 2, '2021-09-13 17:42:45'),
(408, 'aluno', 1, 1, '2021-09-13 17:42:50'),
(409, 'aluno', 1, 2, '2021-09-13 17:43:05'),
(410, 'aluno', 1, 1, '2021-09-13 17:43:07'),
(411, 'aluno', 1, 2, '2021-09-13 17:43:37'),
(412, 'aluno', 1, 1, '2021-09-13 17:43:40'),
(413, 'aluno', 1, 2, '2021-09-13 17:43:58'),
(414, 'aluno', 1, 1, '2021-09-13 17:44:00'),
(415, 'aluno', 1, 2, '2021-09-13 17:44:02'),
(416, 'aluno', 6, 1, '2021-09-13 17:44:08'),
(417, 'aluno', 6, 2, '2021-09-13 17:46:12'),
(418, 'aluno', 3, 1, '2021-09-13 17:46:21'),
(419, 'aluno', 3, 2, '2021-09-13 17:46:22'),
(420, 'aluno', 3, 1, '2021-09-13 17:48:06'),
(421, 'aluno', 3, 2, '2021-09-13 17:48:09'),
(422, 'aluno', 3, 1, '2021-09-13 17:48:11'),
(423, 'aluno', 3, 2, '2021-09-13 17:48:12'),
(424, 'aluno', 3, 1, '2021-09-13 17:48:14'),
(425, 'aluno', 3, 2, '2021-09-13 17:48:15'),
(426, 'aluno', 3, 1, '2021-09-13 17:48:16'),
(427, 'aluno', 3, 2, '2021-09-13 17:48:17'),
(428, 'aluno', 1, 1, '2021-09-14 17:28:57'),
(429, 'aluno', 1, 2, '2021-09-14 17:28:59'),
(430, 'aluno', 5, 1, '2021-09-14 17:31:26'),
(431, 'aluno', 5, 2, '2021-09-14 17:32:01'),
(432, 'aluno', 5, 1, '2021-09-14 17:32:09'),
(433, 'aluno', 5, 2, '2021-09-14 17:32:45'),
(434, 'aluno', 5, 1, '2021-09-14 17:32:47'),
(435, 'aluno', 5, 2, '2021-09-14 17:33:01'),
(436, 'aluno', 1, 1, '2021-09-14 17:33:37'),
(437, 'aluno', 1, 2, '2021-09-14 17:34:16'),
(438, 'aluno', 1, 1, '2021-09-14 17:34:18'),
(439, 'aluno', 6, 1, '2021-09-14 17:37:04'),
(440, 'aluno', 3, 1, '2021-09-14 17:37:22'),
(441, 'aluno', 4, 1, '2021-09-14 17:37:25'),
(442, 'aluno', 4, 2, '2021-09-14 17:37:28'),
(443, 'aluno', 4, 1, '2021-09-14 17:37:29'),
(444, 'aluno', 4, 2, '2021-09-14 17:37:30'),
(445, 'aluno', 4, 1, '2021-09-14 17:37:31'),
(446, 'aluno', 5, 1, '2021-09-14 17:38:46'),
(447, 'aluno', 5, 2, '2021-09-14 17:38:49'),
(448, 'aluno', 6, 2, '2021-09-14 17:39:27'),
(449, 'aluno', 6, 1, '2021-09-14 17:39:34'),
(450, 'aluno', 5, 1, '2021-09-14 17:42:26'),
(451, 'aluno', 5, 2, '2021-09-14 17:42:28'),
(452, 'aluno', 1, 2, '2021-09-14 17:42:32'),
(453, 'aluno', 1, 1, '2021-09-14 17:42:33'),
(454, 'aluno', 1, 2, '2021-09-14 17:42:35'),
(455, 'aluno', 6, 2, '2021-09-14 17:42:38'),
(456, 'aluno', 2, 1, '2021-09-14 17:44:03'),
(457, 'aluno', 2, 2, '2021-09-14 17:44:05'),
(458, 'aluno', 2, 1, '2021-09-14 17:44:07'),
(459, 'aluno', 6, 1, '2021-09-14 17:44:15'),
(460, 'aluno', 6, 2, '2021-09-14 17:44:17'),
(461, 'aluno', 6, 1, '2021-09-14 17:44:41'),
(462, 'aluno', 6, 2, '2021-09-14 17:44:43'),
(463, 'aluno', 1, 1, '2021-09-14 17:44:45'),
(464, 'aluno', 1, 2, '2021-09-14 17:44:47'),
(465, 'aluno', 2, 2, '2021-09-14 17:45:06'),
(466, 'aluno', 2, 1, '2021-09-14 17:45:08'),
(467, 'aluno', 6, 1, '2021-09-14 17:45:11'),
(468, 'aluno', 3, 2, '2021-09-14 17:45:41'),
(469, 'aluno', 6, 2, '2021-09-14 17:48:07'),
(470, 'aluno', 3, 1, '2021-09-14 17:48:46'),
(471, 'aluno', 3, 2, '2021-09-14 17:48:49'),
(472, 'aluno', 3, 1, '2021-09-14 17:48:52'),
(473, 'aluno', 4, 2, '2021-09-14 17:49:40'),
(474, 'aluno', 4, 1, '2021-09-14 17:49:42'),
(475, 'aluno', 4, 2, '2021-09-14 17:49:43'),
(476, 'aluno', 4, 1, '2021-09-14 17:49:44'),
(477, 'aluno', 4, 2, '2021-09-14 17:49:45'),
(478, 'aluno', 1, 1, '2021-09-15 17:33:55'),
(479, 'aluno', 1, 2, '2021-09-15 17:33:56'),
(480, 'aluno', 1, 1, '2021-09-15 17:33:58'),
(481, 'aluno', 1, 2, '2021-09-15 17:33:59'),
(482, 'aluno', 1, 1, '2021-09-15 17:34:00'),
(483, 'aluno', 1, 2, '2021-09-15 17:34:01'),
(484, 'aluno', 1, 1, '2021-09-15 17:34:02'),
(485, 'aluno', 1, 2, '2021-09-15 17:34:04'),
(486, 'aluno', 1, 1, '2021-09-15 17:34:05'),
(487, 'aluno', 1, 2, '2021-09-15 17:34:06'),
(488, 'aluno', 1, 1, '2021-09-20 10:52:26'),
(489, 'aluno', 6, 1, '2021-09-20 10:52:29'),
(490, 'aluno', 5, 1, '2021-09-20 10:52:33'),
(491, 'aluno', 2, 1, '2021-09-20 10:52:39'),
(492, 'aluno', 1, 2, '2021-09-20 11:51:30'),
(493, 'aluno', 3, 1, '2021-09-20 11:51:36'),
(494, 'aluno', 2, 2, '2021-09-20 11:51:44'),
(495, 'aluno', 5, 2, '2021-09-20 11:51:46'),
(496, 'alunos', 1, 1, '2021-09-23 16:58:38'),
(497, 'alunos', 5, 1, '2021-09-23 16:58:41'),
(498, 'alunos', 2, 1, '2021-09-23 17:00:43'),
(499, 'alunos', 1, 2, '2021-09-23 17:00:46'),
(500, 'alunos', 2, 2, '2021-09-23 17:00:47'),
(501, 'alunos', 1, 1, '2021-09-23 17:17:54'),
(502, 'alunos', 1, 2, '2021-09-23 17:18:00'),
(503, 'alunos', 1, 1, '2021-09-23 17:18:07'),
(504, 'alunos', 1, 2, '2021-09-23 17:18:09'),
(505, 'alunos', 1, 1, '2021-09-23 17:18:11'),
(506, 'alunos', 1, 2, '2021-09-23 17:18:12'),
(507, 'alunos', 1, 1, '2021-09-23 17:18:13'),
(508, 'alunos', 1, 2, '2021-09-23 17:18:15'),
(509, 'alunos', 2, 1, '2021-09-23 17:18:16'),
(510, 'alunos', 2, 2, '2021-09-23 17:18:17'),
(511, 'alunos', 5, 2, '2021-09-23 17:27:01'),
(512, 'alunos', 5, 1, '2021-09-23 17:27:03'),
(513, 'alunos', 2, 1, '2021-09-23 17:45:50'),
(514, 'alunos', 2, 2, '2021-09-23 17:45:53'),
(515, 'alunos', 2, 1, '2021-09-23 17:45:54'),
(516, 'alunos', 2, 2, '2021-09-23 17:45:56'),
(517, 'alunos', 2, 1, '2021-09-23 17:45:57'),
(518, 'alunos', 2, 2, '2021-09-23 17:45:59'),
(519, 'alunos', 5, 2, '2021-09-23 17:48:17'),
(520, 'alunos', 5, 1, '2021-09-23 17:48:20'),
(521, 'alunos', 5, 2, '2021-09-23 17:48:22'),
(522, 'alunos', 5, 1, '2021-09-23 17:48:24'),
(523, 'alunos', 6, 1, '2021-09-23 17:49:52'),
(524, 'alunos', 6, 2, '2021-09-23 17:49:56'),
(525, 'alunos', 5, 2, '2021-09-23 18:02:27'),
(526, 'alunos', 5, 1, '2021-09-23 18:02:29'),
(527, 'alunos', 5, 2, '2021-09-23 18:02:31'),
(528, 'alunos', 5, 1, '2021-09-24 14:49:12'),
(529, 'alunos', 5, 2, '2021-09-24 14:49:14'),
(530, 'alunos', 1, 1, '2021-09-24 14:49:25'),
(531, 'alunos', 1, 2, '2021-09-24 14:49:26'),
(532, 'alunos', 6, 1, '2021-09-24 14:49:28'),
(533, 'alunos', 6, 2, '2021-09-24 14:49:31'),
(534, 'alunos', 1, 1, '2021-10-13 13:44:35'),
(535, 'alunos', 6, 1, '2021-10-13 13:44:38'),
(536, 'alunos', 2, 1, '2021-10-13 13:44:41'),
(537, 'alunos', 1, 2, '2021-10-13 13:45:50'),
(538, 'alunos', 6, 2, '2021-10-13 13:45:52'),
(539, 'alunos', 2, 2, '2021-10-13 13:45:54'),
(540, 'alunos', 1, 1, '2021-10-13 13:51:08'),
(541, 'alunos', 6, 1, '2021-10-13 13:51:10'),
(542, 'alunos', 1, 1, '2021-10-26 15:45:44'),
(543, 'alunos', 1, 2, '2021-10-26 15:45:54'),
(544, 'alunos', 1, 1, '2021-10-29 14:57:53'),
(545, 'alunos', 1, 2, '2021-10-29 14:57:55'),
(546, 'alunos', 1, 1, '2021-10-29 14:57:56'),
(547, 'alunos', 1, 2, '2021-10-29 14:57:58'),
(548, 'alunos', 1, 1, '2021-10-29 15:44:41'),
(549, 'alunos', 1, 2, '2021-10-29 16:27:31'),
(550, 'alunos', 1, 1, '2021-10-29 16:27:46'),
(551, 'alunos', 6, 1, '2021-10-29 16:28:46'),
(552, 'alunos', 6, 2, '2021-10-29 16:28:50'),
(553, 'alunos', 2, 1, '2021-10-29 16:32:50'),
(554, 'alunos', 1, 2, '2021-10-29 16:34:34'),
(555, 'alunos', 6, 1, '2021-10-29 16:50:33'),
(556, 'alunos', 6, 2, '2021-10-29 16:50:36'),
(557, 'alunos', 2, 2, '2021-10-29 16:58:35'),
(558, 'alunos', 1, 1, '2021-10-29 16:58:56'),
(559, 'alunos', 1, 1, '2021-11-09 15:55:01'),
(560, 'alunos', 1, 2, '2021-11-09 15:55:16'),
(561, 'alunos', 6, 1, '2021-11-09 15:55:23'),
(562, 'alunos', 1, 1, '2022-03-08 17:53:10'),
(563, 'alunos', 1, 2, '2022-03-08 17:53:13'),
(564, 'alunos', 1, 1, '2022-03-08 17:53:16'),
(565, 'alunos', 1, 2, '2022-03-08 17:53:18'),
(566, 'alunos', 1, 1, '2022-03-08 17:53:19'),
(567, 'alunos', 1, 2, '2022-03-08 17:53:21'),
(568, 'alunos', 1, 1, '2022-03-08 17:53:25'),
(569, 'alunos', 1, 2, '2022-03-08 17:53:27'),
(570, 'alunos', 1, 1, '2022-03-08 17:53:44'),
(571, 'alunos', 1, 2, '2022-03-08 17:53:45'),
(572, 'alunos', 1, 1, '2022-04-13 13:03:56'),
(573, 'alunos', 1, 2, '2022-04-13 13:04:02'),
(574, 'alunos', 1, 1, '2022-04-13 13:04:07'),
(575, 'alunos', 1, 2, '2022-04-13 13:04:11'),
(576, 'alunos', 1, 1, '2022-04-26 11:43:21'),
(577, 'alunos', 2, 1, '2022-04-26 11:43:41'),
(578, 'alunos', 2, 2, '2022-04-26 11:43:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel`
--

CREATE TABLE `responsavel` (
  `id` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `sobrenome` varchar(60) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `aceita_email` int(11) NOT NULL DEFAULT 1,
  `token` varchar(64) NOT NULL,
  `confirmado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `responsavel`
--

INSERT INTO `responsavel` (`id`, `cpf`, `nome`, `sobrenome`, `email`, `senha`, `telefone`, `aceita_email`, `token`, `confirmado`) VALUES
(1, '55555555555', 'Edson', 'dos Santos', 'edson@mycontrolapp.com', '25d55ad283aa400af464c76d713c07ad', '', 1, '', 1),
(2, '66666666666', 'Antônio', 'Dantas Vieira', 'dantas@mycontrolapp.com', '202cb962ac59075b964b07152d234b70', '', 1, '', 1),
(5, '98765432111', 'Ricardo', ' Gurgel', 'ricardo@mycontrolapp.com', '202cb962ac59075b964b07152d234b70', '', 1, '', 0),
(35, '12332112354', 'Aparecida', 'Bastos', 'cida@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, 1, '', 0),
(36, '14114114114', 'Cibele', 'Paradela', 'cibele@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, 1, '', 0),
(37, '78978978965', 'Marlene', 'Santos', 'marlene@gmail.com', '25f9e794323b453885f5181f1b624d0b', NULL, 1, '', 0),
(38, '12332112325', 'Luis', 'Inácio da Silva', 'lula@2022.com.br', '3a824154b16ed7dab899bf000b80eeee', NULL, 1, '', 0),
(39, '32165498701', 'Carlos', 'Almeida', 'contoso@testemail.com', '$2a$12$fbQZzlPXwFAYhp2D6Y5GoevSWVG9jvDmjwpQF25X2QRTxhXC9MOJy', NULL, 1, '', 0),
(96, '14364990701', 'Thiago', 'Bastos dos Santos', 'bthiagos@gmail.com', '2db0996b2ef1d2008d45379f785233eb', NULL, 1, 'e7bdfa4b8da8d2ab865f2f48dbe2e4ae', 0),
(100, '179.918.070', 'Zeca', 'Pagodinho', 'informatica@escolaedem.com.br', '$2y$10$07Zp3P9efDvqf1Q96ZVvkufTjn1nPOiXnoYMY2oTeZBpEH2xi3J9.', NULL, 1, '123456', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pessoa`
--

CREATE TABLE `tipo_pessoa` (
  `id` int(11) NOT NULL,
  `tipo_pessoa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_pessoa`
--

INSERT INTO `tipo_pessoa` (`id`, `tipo_pessoa`) VALUES
(1, 'admin'),
(2, 'colaborador'),
(3, 'responsavel'),
(4, 'aluno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 2 COMMENT '1=Admin,2=Staff,3=Responsavel,4=aluno',
  `email` varchar(200) NOT NULL,
  `aceita_email` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `tipo`, `email`, `aceita_email`) VALUES
(1, 'Administrador', 'admin', '2db0996b2ef1d2008d45379f785233eb', 1, 'admin@mycontrol.com', 1),
(2, 'João Cunha Jr', 'portaria', '2db0996b2ef1d2008d45379f785233eb', 2, 'portaria@mycontrol.com', 1),
(3, 'Thiago Bastos', 'thiago', '2db0996b2ef1d2008d45379f785233eb', 1, 'bthiagos@gmail.com', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `alunoxresponsavel`
--
ALTER TABLE `alunoxresponsavel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_aluno` (`idaluno`),
  ADD KEY `fk_id_responsavel` (`idresponsavel`);

--
-- Índices para tabela `config_email`
--
ALTER TABLE `config_email`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_alunos` (`idaluno`);

--
-- Índices para tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipo_pessoa`
--
ALTER TABLE `tipo_pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo` (`tipo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `alunoxresponsavel`
--
ALTER TABLE `alunoxresponsavel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `config_email`
--
ALTER TABLE `config_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=579;

--
-- AUTO_INCREMENT de tabela `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `tipo_pessoa`
--
ALTER TABLE `tipo_pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunoxresponsavel`
--
ALTER TABLE `alunoxresponsavel`
  ADD CONSTRAINT `fk_id_aluno` FOREIGN KEY (`idaluno`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `fk_id_responsavel` FOREIGN KEY (`idresponsavel`) REFERENCES `responsavel` (`id`);

--
-- Limitadores para a tabela `registros`
--
ALTER TABLE `registros`
  ADD CONSTRAINT `fk_id_alunos` FOREIGN KEY (`idaluno`) REFERENCES `alunos` (`id`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_pessoa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
