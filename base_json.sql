-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jul-2023 às 21:03
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `base_json`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `amigo`
--

CREATE TABLE `amigo` (
  `id` int(11) NOT NULL,
  `username_de` varchar(40) NOT NULL,
  `usaername_para` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `amigo`
--

INSERT INTO `amigo` (`id`, `username_de`, `usaername_para`, `status`) VALUES
(16, 'otaviano', 'savioomio', 1),
(17, 'otaviano', 'mirandinha', 1),
(32, 'mirandinha', 'user2', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `coluna`
--

CREATE TABLE `coluna` (
  `nome_col` varchar(30) NOT NULL,
  `id` int(11) NOT NULL,
  `quadro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cria`
--

CREATE TABLE `cria` (
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `quadro_id` int(11) NOT NULL,
  `usuario_nome_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadro`
--

CREATE TABLE `quadro` (
  `id` int(11) NOT NULL,
  `nome_qua` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ranking`
--

CREATE TABLE `ranking` (
  `usuario_nome_usuario` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ranking_amigos`
--

CREATE TABLE `ranking_amigos` (
  `usuarios_amigos` varchar(45) NOT NULL,
  `ranking_usuario_nome_usuario` varchar(20) NOT NULL,
  `ranking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ranking_geral`
--

CREATE TABLE `ranking_geral` (
  `todosOsusuarios` varchar(20) NOT NULL,
  `ranking_usuario_nome_usuario` varchar(20) NOT NULL,
  `ranking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefa`
--

CREATE TABLE `tarefa` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `praso` datetime NOT NULL,
  `coluna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(40) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `prenome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `pontos` smallint(11) NOT NULL,
  `rec_senha` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`username`, `senha`, `email`, `prenome`, `sobrenome`, `pontos`, `rec_senha`) VALUES
('lenjar', 'c340e4845bc4f9cf9f28d6bcd2e31e68', 'rafa@gmail.com', 'Rafa', 'Gomes', 0, NULL),
('mirandinha', '4d9cb7a511c6f91c59281da6b82487e9', 'jeovanamiranda218@gmail.com', 'Jeovana', 'Miranda', 0, NULL),
('otaviano', '8d93c8a196a1d63c95815dffd7eb788f', 'otavio@gmail.com', 'Otavio', 'sei lá ', 0, NULL),
('savioomio', 'dec0974a34112b8f75423f0c235bcb0e', 'saviopessoaafonso@gmail.com', 'Sávio', 'Pessôa Afonso', 0, 'NULL'),
('user1', 'd41d8cd98f00b204e9800998ecf8427e', 'user1@example.com', 'John', 'Doe', 0, NULL),
('user2', 'd41d8cd98f00b204e9800998ecf8427e', 'user2@example.com', 'Jane', 'Smith', 0, NULL),
('user3', 'd41d8cd98f00b204e9800998ecf8427e', 'user3@example.com', 'Michael', 'Johnson', 0, NULL),
('user4', 'd41d8cd98f00b204e9800998ecf8427e', 'user4@example.com', 'Emily', 'Brown', 0, NULL),
('user5', 'd41d8cd98f00b204e9800998ecf8427e', 'user5@example.com', 'David', 'Wilson', 0, NULL),
('user6', 'd41d8cd98f00b204e9800998ecf8427e', 'user6@example.com', 'Sarah', 'Davis', 0, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `amigo`
--
ALTER TABLE `amigo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_has_usuario_usuario2_idx` (`usaername_para`),
  ADD KEY `fk_usuario_has_usuario_usuario1_idx` (`username_de`);

--
-- Índices para tabela `coluna`
--
ALTER TABLE `coluna`
  ADD PRIMARY KEY (`id`,`quadro_id`),
  ADD KEY `fk_coluna_quadro1_idx` (`quadro_id`);

--
-- Índices para tabela `cria`
--
ALTER TABLE `cria`
  ADD PRIMARY KEY (`quadro_id`,`usuario_nome_usuario`),
  ADD KEY `fk_cria_usuario1_idx` (`usuario_nome_usuario`);

--
-- Índices para tabela `quadro`
--
ALTER TABLE `quadro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`usuario_nome_usuario`,`id`);

--
-- Índices para tabela `ranking_amigos`
--
ALTER TABLE `ranking_amigos`
  ADD PRIMARY KEY (`ranking_usuario_nome_usuario`,`ranking_id`);

--
-- Índices para tabela `ranking_geral`
--
ALTER TABLE `ranking_geral`
  ADD PRIMARY KEY (`ranking_usuario_nome_usuario`,`ranking_id`);

--
-- Índices para tabela `tarefa`
--
ALTER TABLE `tarefa`
  ADD PRIMARY KEY (`id`,`coluna_id`),
  ADD KEY `fk_tarefa_coluna_idx` (`coluna_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `nome_usuario_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `amigo`
--
ALTER TABLE `amigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `coluna`
--
ALTER TABLE `coluna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `quadro`
--
ALTER TABLE `quadro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tarefa`
--
ALTER TABLE `tarefa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario1` FOREIGN KEY (`username_de`) REFERENCES `usuario` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario2` FOREIGN KEY (`usaername_para`) REFERENCES `usuario` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `coluna`
--
ALTER TABLE `coluna`
  ADD CONSTRAINT `fk_coluna_quadro1` FOREIGN KEY (`quadro_id`) REFERENCES `quadro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `cria`
--
ALTER TABLE `cria`
  ADD CONSTRAINT `fk_cria_quadro1` FOREIGN KEY (`quadro_id`) REFERENCES `quadro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cria_usuario1` FOREIGN KEY (`usuario_nome_usuario`) REFERENCES `usuario` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `fk_ranking_usuario1` FOREIGN KEY (`usuario_nome_usuario`) REFERENCES `usuario` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ranking_amigos`
--
ALTER TABLE `ranking_amigos`
  ADD CONSTRAINT `fk_ranking_amigos_ranking1` FOREIGN KEY (`ranking_usuario_nome_usuario`,`ranking_id`) REFERENCES `ranking` (`usuario_nome_usuario`, `id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ranking_geral`
--
ALTER TABLE `ranking_geral`
  ADD CONSTRAINT `fk_ranking_geral_ranking1` FOREIGN KEY (`ranking_usuario_nome_usuario`,`ranking_id`) REFERENCES `ranking` (`usuario_nome_usuario`, `id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tarefa`
--
ALTER TABLE `tarefa`
  ADD CONSTRAINT `fk_tarefa_coluna` FOREIGN KEY (`coluna_id`) REFERENCES `coluna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
