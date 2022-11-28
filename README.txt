Projeto Interdisciplinar - APS/BD/PW

Olá! Seja bem-vindo ao projeto interdisciplinar La Cafezito desevolvido pelos alunos do 2°DS Novotec AMS:
- Lucas Pontes Soares
- Pedro Henrique Botelho
- Pedro Ramos de Lima

Primeiramente para executar o nosso projeto você deverá importar o nosso banco de dados para o phpmyadmin.
- Você pode fazer isso acessando a pasta no projeto 'banco->cafe.sql', e assim importando o aquivo .sql
- Ou você também pode colar e executar o código do sql do nosso banco.

Área de adiministrador:
Para acessar o login de administrador do projeto La Cafezito são necessários:
- Email: contatoLaCafezito@gmail.com
- Senha: admin1452

Segue o código sql do banco de dados:

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Nov-2022 às 23:06
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cafe`
--
CREATE DATABASE IF NOT EXISTS `cafe` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cafe`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE `administradores` (
  `id` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'LaCafezito', 'contatoLaCafezito@gmail.com', '474338aa9e2ec5b7459f30c5ed55863f');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `img`) VALUES
(1, 'lucas', 'lucas@gmail.com', '202cb962ac59075b964b07152d234b70', '1.png'),
(2, 'thiago', 'thiago@gmail.com', '202cb962ac59075b964b07152d234b70', '2.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cremes`
--

CREATE TABLE `cremes` (
  `id` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `preco` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cremes`
--

INSERT INTO `cremes` (`id`, `nome`, `preco`) VALUES
(1, 'chantilly', '0.50'),
(2, 'leite', '0.70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Em análise',
  `bairro` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `preco` varchar(10) NOT NULL,
  `DataCompra` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_user`, `estado`, `bairro`, `rua`, `numero`, `complemento`, `preco`, `DataCompra`) VALUES
(9, 1, 'entregando', 'Jardim América', 'Abdala Abujanrra', '288', '', '6.2', '2022-11-14 00:00:00'),
(10, 1, 'em produção', 'Jardim Europa', 'Machado', '256', '', '4', '2022-11-14 15:11:36'),
(32, 2, 'Em análise', 'Jacinto', 'Perino', '375', '', '6.5', '2022-11-23 10:41:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_complementos`
--

CREATE TABLE `pedidos_complementos` (
  `id` int(5) NOT NULL,
  `id_pedido` int(5) NOT NULL,
  `id_tamanho` int(5) NOT NULL,
  `id_tipo` int(5) NOT NULL,
  `id_temperatura` int(5) NOT NULL,
  `id_sabor` int(5) NOT NULL,
  `id_creme` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos_complementos`
--

INSERT INTO `pedidos_complementos` (`id`, `id_pedido`, `id_tamanho`, `id_tipo`, `id_temperatura`, `id_sabor`, `id_creme`) VALUES
(6, 9, 2, 2, 2, 2, 2),
(7, 10, 1, 2, 1, 1, 1),
(16, 32, 2, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sabores`
--

CREATE TABLE `sabores` (
  `id` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `preco` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sabores`
--

INSERT INTO `sabores` (`id`, `nome`, `preco`) VALUES
(1, 'acucar', '0.50'),
(2, 'sem acucar', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tamanhos`
--

CREATE TABLE `tamanhos` (
  `id` int(5) NOT NULL,
  `unidade` varchar(10) NOT NULL,
  `preco` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tamanhos`
--

INSERT INTO `tamanhos` (`id`, `unidade`, `preco`) VALUES
(1, '200ml', '2.55'),
(2, '500ml', '4.50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `temperaturas`
--

CREATE TABLE `temperaturas` (
  `id` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `temperaturas`
--

INSERT INTO `temperaturas` (`id`, `nome`) VALUES
(1, 'quente'),
(2, 'gelado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos`
--

CREATE TABLE `tipos` (
  `id` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `preco` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipos`
--

INSERT INTO `tipos` (`id`, `nome`, `preco`) VALUES
(1, 'expresso', '1.00'),
(2, 'cappuccino', '1.00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cremes`
--
ALTER TABLE `cremes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos_complementos`
--
ALTER TABLE `pedidos_complementos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sabores`
--
ALTER TABLE `sabores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tamanhos`
--
ALTER TABLE `tamanhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `temperaturas`
--
ALTER TABLE `temperaturas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `cremes`
--
ALTER TABLE `cremes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `pedidos_complementos`
--
ALTER TABLE `pedidos_complementos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `sabores`
--
ALTER TABLE `sabores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tamanhos`
--
ALTER TABLE `tamanhos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `temperaturas`
--
ALTER TABLE `temperaturas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
