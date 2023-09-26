-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/09/2023 às 14:03
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
-- Banco de dados: `etreinamento`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `ID_COLABORADOR` int(11) NOT NULL,
  `NOME` text NOT NULL,
  `EMPRESA` int(11) NOT NULL,
  `CARGO` text NOT NULL,
  `HEXADECIMAL` text NOT NULL,
  `MATRICULA` text NOT NULL,
  `DEPARTAMENTO` int(11) NOT NULL,
  `STATUS_COLABORADOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `colaboradores`
--

INSERT INTO `colaboradores` (`ID_COLABORADOR`, `NOME`, `EMPRESA`, `CARGO`, `HEXADECIMAL`, `MATRICULA`, `DEPARTAMENTO`, `STATUS_COLABORADOR`) VALUES
(4, 'DIUARY ESROM', 4, 'JOVEM APRENDIZ', '77889910', '778899', 22, 0),
(6, 'TESTANDO DAO', 4, 'TESTENDO DESENVOLVEDOR', '123456', '654321', 20, 0),
(10, 'DANILO FRANCO', 4, 'DESENVOLVEDOR BACKEND', '4031721291', '789456', 24, 1),
(19, 'GABRIEL GONZAGA DE OLIVEIRA', 4, 'DESENVOLVEDOR', '2926388032', '456456123', 20, 0),
(22, 'TESTEMOVEL', 26, 'DEV', '026351', '031245', 20, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamentos`
--

CREATE TABLE `departamentos` (
  `ID_DEPARTAMENTO` int(11) NOT NULL,
  `DEPARTAMENTO` text NOT NULL,
  `STATUS_DEPARTAMENTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `departamentos`
--

INSERT INTO `departamentos` (`ID_DEPARTAMENTO`, `DEPARTAMENTO`, `STATUS_DEPARTAMENTO`) VALUES
(24, 'TI', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `ID_EMPRESA` int(11) NOT NULL,
  `EMPRESA` text NOT NULL,
  `STATUS_EMPRESA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`ID_EMPRESA`, `EMPRESA`, `STATUS_EMPRESA`) VALUES
(4, 'UDLOG', 1),
(5, 'GUIBOR', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `instrutores`
--

CREATE TABLE `instrutores` (
  `ID_INSTRUTORES` int(11) NOT NULL,
  `NOME` text NOT NULL,
  `DEPARTAMENTO` text NOT NULL,
  `STATUS_INSTRUTOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `instrutores`
--

INSERT INTO `instrutores` (`ID_INSTRUTORES`, `NOME`, `DEPARTAMENTO`, `STATUS_INSTRUTOR`) VALUES
(1, 'DANILO DE SOUSA FRANCO', '21', 1),
(2, 'DANILO FRANCO - ATUALIZADO', '20', 0),
(3, 'DANILO FRANCO', '20', 0),
(6, 'GABRIEL GONZAGA DE OLIVEIRA', '21', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_presenca`
--

CREATE TABLE `lista_presenca` (
  `ID_TREINAMENTO` int(11) NOT NULL,
  `ID_COLABORADOR` int(11) NOT NULL,
  `HORARIO_PRESENCA` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lista_presenca`
--

INSERT INTO `lista_presenca` (`ID_TREINAMENTO`, `ID_COLABORADOR`, `HORARIO_PRESENCA`) VALUES
(1, 10, '21-09-2023 15:41:21'),
(1, 10, '21-09-2023 15:42:57'),
(1, 10, '21-09-2023 15:44:13'),
(1, 10, '21-09-2023 15:44:13'),
(1, 10, '21-09-2023 15:44:13'),
(1, 10, '21-09-2023 15:44:13'),
(1, 10, '21-09-2023 15:44:20'),
(1, 10, '21-09-2023 15:46:04'),
(1, 10, '21-09-2023 15:46:42'),
(1, 10, '21-09-2023 15:46:42'),
(1, 10, '21-09-2023 15:46:43'),
(1, 10, '21-09-2023 15:46:49'),
(1, 10, '21-09-2023 15:47:54'),
(1, 10, '21-09-2023 15:47:55'),
(1, 10, '21-09-2023 15:47:55'),
(1, 10, '21-09-2023 15:47:55'),
(1, 10, '21-09-2023 15:47:55'),
(1, 10, '21-09-2023 15:47:56'),
(1, 10, '21-09-2023 15:47:56'),
(1, 10, '21-09-2023 15:51:09'),
(1, 10, '21-09-2023 16:39:22'),
(1, 10, '21-09-2023 16:58:42'),
(1, 10, '21-09-2023 17:00:07'),
(1, 10, '21-09-2023 17:06:37'),
(1, 10, '21-09-2023 17:07:01'),
(18, 10, '21-09-2023 17:08:50'),
(18, 10, '21-09-2023 17:09:29'),
(18, 18, '21-09-2023 17:13:17'),
(17, 10, '21-09-2023 21:57:53'),
(17, 19, '21-09-2023 22:02:24'),
(22, 19, '21-09-2023 22:04:41'),
(22, 10, '21-09-2023 22:05:01'),
(22, 10, '21-09-2023 17:31:04'),
(33, 10, '22-09-2023 09:35:32'),
(34, 10, '22-09-2023 17:12:24'),
(34, 19, '22-09-2023 17:12:33'),
(35, 10, '25-09-2023 13:27:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `treinamento`
--

CREATE TABLE `treinamento` (
  `ID_TREINAMENTO` int(11) NOT NULL,
  `DESCRICAO_TREINAMENTO` text NOT NULL,
  `DATA_TREINAMENTO` text NOT NULL,
  `HORARIO_TREINAMENTO` text NOT NULL,
  `INSTRUTOR` int(11) NOT NULL,
  `DEPARTAMENTO` int(11) NOT NULL,
  `CONTEUDO` text NOT NULL,
  `STATUS_TREINAMENTO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `treinamento`
--

INSERT INTO `treinamento` (`ID_TREINAMENTO`, `DESCRICAO_TREINAMENTO`, `DATA_TREINAMENTO`, `HORARIO_TREINAMENTO`, `INSTRUTOR`, `DEPARTAMENTO`, `CONTEUDO`, `STATUS_TREINAMENTO`) VALUES
(60, 'TESTE CADASTO TREINAMENTO', '2023-09-26', '17:56', 1, 24, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `LOGIN` varchar(50) NOT NULL,
  `SENHA` varchar(50) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `STATUS_USUARIO` int(11) NOT NULL,
  `SENHA_HASH` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `LOGIN`, `SENHA`, `NOME`, `EMAIL`, `STATUS_USUARIO`, `SENHA_HASH`) VALUES
(1, 'ADMIN', 'ADMIN', 'teste atualizar', 'update@update.com', 5, '$2y$10$n0hI57d4NDiK8bOLYmI90urFXOjgMrtOcO1U9Ej3CjA44Jh.q5h/6'),
(2, 'DANILO', '123456', 'Danilo Franco', 'engdanilofranco@gmail.com', 1, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`ID_COLABORADOR`),
  ADD KEY `EMPRESA` (`EMPRESA`),
  ADD KEY `DEPARTAMENTO` (`DEPARTAMENTO`);

--
-- Índices de tabela `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`ID_DEPARTAMENTO`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`ID_EMPRESA`);

--
-- Índices de tabela `instrutores`
--
ALTER TABLE `instrutores`
  ADD PRIMARY KEY (`ID_INSTRUTORES`);

--
-- Índices de tabela `lista_presenca`
--
ALTER TABLE `lista_presenca`
  ADD KEY `ID_TREINAMENTO` (`ID_TREINAMENTO`),
  ADD KEY `ID_COLABORADOR` (`ID_COLABORADOR`);

--
-- Índices de tabela `treinamento`
--
ALTER TABLE `treinamento`
  ADD PRIMARY KEY (`ID_TREINAMENTO`),
  ADD KEY `INSTRUTOR` (`INSTRUTOR`),
  ADD KEY `DEPARTAMENTO` (`DEPARTAMENTO`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `ID_COLABORADOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `ID_DEPARTAMENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `ID_EMPRESA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `instrutores`
--
ALTER TABLE `instrutores`
  MODIFY `ID_INSTRUTORES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `treinamento`
--
ALTER TABLE `treinamento`
  MODIFY `ID_TREINAMENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
