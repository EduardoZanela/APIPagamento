-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18-Out-2016 às 02:28
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_finish`
--

CREATE TABLE `order_finish` (
  `id` int(11) NOT NULL,
  `comprador` varchar(250) COLLATE utf8_bin NOT NULL,
  `valorComprado` float NOT NULL,
  `paymentMethod` varchar(250) COLLATE utf8_bin NOT NULL,
  `idmetodo` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `order_finish`
--

INSERT INTO `order_finish` (`id`, `comprador`, `valorComprado`, `paymentMethod`, `idmetodo`) VALUES
(1, 'Comprador fixo', 2000, 'paypal', ''),
(2, 'Comprador fixo', 2000, 'paypal', ''),
(3, 'Comprador fixo', 2000, 'paypal', ''),
(4, 'Comprador fixo', 2000, 'paypal', 'EC-0R496292YN415141H'),
(5, 'Comprador fixo', 43, 'pagSeguro', '4'),
(6, 'Comprador fixo', 43, 'pagSeguro', '4'),
(7, 'Comprador fixo', 43, 'pagSeguro', '4'),
(8, 'Comprador fixo', 43, 'pagSeguro', '4'),
(9, 'Comprador fixo', 43, 'pagSeguro', '4'),
(10, 'Comprador fixo', 43, 'pagSeguro', '4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` varchar(250) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`) VALUES
(1, 'Mouse', 'mouse de precisao', 43),
(2, 'Mouse', 'mouse razer', 45),
(3, 'Mouse', 'mouse razer', 45),
(4, 'Notebook', 'notebook dell', 2000),
(5, 'Notebook', 'notebook dell', 2000),
(6, 'HeadPhone', 'headphone 7.1', 500),
(7, 'Monitor', 'monitor gamer', 900),
(8, 'Teclado', 'teclado mecanico', 3000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_finish`
--
ALTER TABLE `order_finish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_finish`
--
ALTER TABLE `order_finish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
