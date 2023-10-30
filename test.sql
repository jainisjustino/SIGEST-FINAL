-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/10/2023 às 14:05
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `test`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `dataHora` datetime DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `agenda`
--

INSERT INTO `agenda` (`id`, `paciente_id`, `nome`, `dataHora`, `email`) VALUES
(210, NULL, 'gui', '2023-10-30 08:15:00', 'fagundesguilherme583@gmail.com'),
(212, NULL, 'gui', '2023-10-31 08:15:00', 'fagundesguilherme583@gmail.com'),
(213, NULL, 'ja', '2023-10-30 08:00:00', 'jainisjustino@gmail.com'),
(214, NULL, 'ja', '2023-11-05 08:00:00', 'jainisjustino@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `dn` date NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fone` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `informacaoComplementar` text NOT NULL,
  `medicacoesUtilizadas` text NOT NULL,
  `alergiasReacoes` text NOT NULL,
  `doencaPreExistente` text NOT NULL,
  `historicoFamiliar` text NOT NULL,
  `habitos` text NOT NULL,
  `experienciaOdontologicaAnterior` text NOT NULL,
  `avaliacao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `cpf`, `rg`, `dn`, `sexo`, `email`, `fone`, `endereco`, `informacaoComplementar`, `medicacoesUtilizadas`, `alergiasReacoes`, `doencaPreExistente`, `historicoFamiliar`, `habitos`, `experienciaOdontologicaAnterior`, `avaliacao`) VALUES
(90, 'aaa', '1', '', '2011-11-11', 'Masculino', '', '11', '11', '', '', '', '', '', '', '', ''),
(91, 'gui', '1', '', '1999-11-11', 'Selecionar', 'fagundesguilherme583@gmail.com', '1', '1', '', '', '', '', '', '', '', ''),
(92, 'ja', '1', '', '1111-11-11', 'Selecionar', 'jainisjustino@gmail.com', '1', '1', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tratamento`
--

CREATE TABLE `tratamento` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `tratamentoRealizado` text DEFAULT NULL,
  `dente` varchar(255) DEFAULT NULL,
  `formaPagamento` varchar(255) DEFAULT NULL,
  `saldo` varchar(255) DEFAULT NULL,
  `documento` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `tratamento`
--

INSERT INTO `tratamento` (`id`, `paciente_id`, `data`, `tratamentoRealizado`, `dente`, `formaPagamento`, `saldo`, `documento`) VALUES
(464, 90, '2020-10-10', 'aaaaaa', '1', '1', '1', NULL),
(465, 91, '', '', '', '', '', NULL),
(466, 92, '', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `emailUsuario` varchar(200) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `emailUsuario`, `senha`) VALUES
(44, 'g', '', '11111111');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tratamento`
--
ALTER TABLE `tratamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de tabela `tratamento`
--
ALTER TABLE `tratamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=467;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`);

--
-- Restrições para tabelas `tratamento`
--
ALTER TABLE `tratamento`
  ADD CONSTRAINT `tratamento_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
