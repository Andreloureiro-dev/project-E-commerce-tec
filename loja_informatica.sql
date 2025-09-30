-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Jul-2025 às 13:15
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja_informatica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE `encomendas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `morada` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `total_encomenda` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `encomendas`
--

INSERT INTO `encomendas` (`id`, `nome`, `data_nascimento`, `morada`, `email`, `total_encomenda`) VALUES
(8, 'André teste', '1998-05-12', 'Rua dos matinhos', 'teste@gmail.com', 2800.00),
(9, 'André teste', '1998-05-12', 'Rua dos matinhos', 'teste@gmail.com', 5798.00),
(10, 'André teste', '1998-01-17', 'Rua dos matinhos', 'teste@gmail.com', 800.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `categoria`, `quantidade`, `preco`, `imagem`) VALUES
(1, 'Samsung Zfol6', 'telemovel', 8, 2000.00, 'src/img/samsung.webp\r\n'),
(2, 'Iphone13', 'telemovel', 0, 1000.00, 'src/img/iphone13.webp\r\n'),
(3, 'Iphone14', 'telemovel', 5, 1299.00, 'src/img/iphone14.webp\r\n'),
(4, 'Desktop NVIDIA', 'computador', 1, 1600.00, 'src/img/Desktop1.webp'),
(5, 'Desktop ASUS', 'computador', 2, 1000.00, 'src/img/Desktop2.jpg'),
(6, 'Desktop HP', 'computador', 3, 899.00, 'src/img/Desktop3.webp'),
(7, 'Portátil HP', 'portatil', 2, 800.00, 'src/img/Portatil1.webp'),
(8, 'Portátil ASUS', 'portatil', 2, 1500.00, 'src/img/Portatil2.webp'),
(9, 'Portátil HP', 'portatil', 1, 500.00, 'src/img/Portatil3.webp'),
(10, 'Macbook PRO', 'portatil', 1, 3000.00, 'src/img/Macbook1.webp'),
(11, 'Macbook AIR \"16\"', 'portatil', 2, 1400.00, 'src/img/Macbook2.webp'),
(12, 'Macbook AIR \"13\"', 'portatil', 1, 900.00, 'src/img/Macbook3.webp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$LClkF2F6R8g5dYm3OcqndOMwO1b8794F0FwMCJ5naIhbIiTi1lKVK');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `encomendas`
--
ALTER TABLE `encomendas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
