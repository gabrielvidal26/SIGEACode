-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 08-Fev-2018 às 04:44
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigea`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(280) NOT NULL,
  `dataini` date NOT NULL,
  `datafim` date NOT NULL,
  `proprietario` int(11) NOT NULL,
  `nome_img` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `interesse`
--

CREATE TABLE `interesse` (
  `id_interesse` int(11) NOT NULL,
  `id_eve` int(11) NOT NULL,
  `id_usu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `palestra`
--

CREATE TABLE `palestra` (
  `id_palestra` int(11) NOT NULL,
  `tema` text NOT NULL,
  `data` date NOT NULL,
  `horaini` time(4) NOT NULL,
  `horafim` time(4) NOT NULL,
  `palestrante` text NOT NULL,
  `id_evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(18) NOT NULL,
  `aut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `usuario`, `email`, `senha`, `aut`) VALUES
(3, 'Ayrton R Melo', 'ayrton', 'ayrtonmelorj2@gmail.com', 'faeterj', 1),
(5, 'Gabriel Vidal', 'gabriel', 'gabrielvidal21@gmail.com', 'faeterj', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interesse`
--
ALTER TABLE `interesse`
  ADD PRIMARY KEY (`id_interesse`),
  ADD KEY `fk_e1` (`id_eve`),
  ADD KEY `fk_u1` (`id_usu`);

--
-- Indexes for table `palestra`
--
ALTER TABLE `palestra`
  ADD PRIMARY KEY (`id_palestra`),
  ADD KEY `id_evento_fk1` (`id_evento`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `interesse`
--
ALTER TABLE `interesse`
  MODIFY `id_interesse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `palestra`
--
ALTER TABLE `palestra`
  MODIFY `id_palestra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `interesse`
--
ALTER TABLE `interesse`
  ADD CONSTRAINT `fk_e1` FOREIGN KEY (`id_eve`) REFERENCES `evento` (`id`),
  ADD CONSTRAINT `fk_u1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `palestra`
--
ALTER TABLE `palestra`
  ADD CONSTRAINT `id_evento_fk1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
