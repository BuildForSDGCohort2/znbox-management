-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Ago-2020 às 19:45
-- Versão do servidor: 10.1.10-MariaDB
-- versão do PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `znbox_stock`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact1` varchar(15) DEFAULT NULL,
  `contact2` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `observation` text,
  `user_modify` int(11) NOT NULL,
  `user_added` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `customer`
--

INSERT INTO `customer` (`id`, `name`, `contact1`, `contact2`, `email`, `website`, `address`, `observation`, `user_modify`, `user_added`, `date_added`, `date_modify`, `isDeleted`) VALUES
(1, 'Edson', '+258850375093', '+258829707047', 'edson.patricio.39@gmail.com', '', 'Av. Moçambique', 'OBS:.', 7, 7, '2020-05-31 01:17:15', '2020-06-25 14:46:00', 0),
(2, 'Magombe', '+258850375093', '', 'edson.patricio.39@gmail.com', '', 'Av. Moçambique', '', 7, 7, '2020-05-31 01:19:32', '2020-05-31 23:05:09', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enterprise`
--

CREATE TABLE `enterprise` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone1` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `phone2` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `postal_code` int(5) DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `nuit` bigint(30) DEFAULT NULL,
  `user_modify` int(11) NOT NULL,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `currency` varchar(4) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `enterprise`
--

INSERT INTO `enterprise` (`id`, `name`, `address`, `email`, `phone1`, `phone2`, `postal_code`, `logo`, `nuit`, `user_modify`, `date_modify`, `currency`) VALUES
(1, 'ZNBOX', 'Av. Moçambique', 'support@znbox.net', '+258 829707047', '+258 850375093', 1111, '8d43efb93f88574c809639704bdec6d2.png', 4674423454, 7, '2020-08-27 07:08:04', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `enterprise` mediumblob NOT NULL,
  `customer` mediumblob NOT NULL,
  `itens` mediumblob NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_due` date NOT NULL,
  `date_emitted` date NOT NULL,
  `sale` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_modify` int(11) NOT NULL,
  `user_added` int(11) NOT NULL,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '0',
  `price_sell` float NOT NULL,
  `price_purchase` float NOT NULL,
  `stock` int(11) NOT NULL,
  `observation` text,
  `user_added` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_modify` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `price`
--

INSERT INTO `price` (`id`, `isDefault`, `price_sell`, `price_purchase`, `stock`, `observation`, `user_added`, `date_added`, `date_modify`, `user_modify`, `isDeleted`) VALUES
(1, 1, 300, 200, 33, NULL, 7, '2020-02-29 16:21:23', '2020-08-08 00:25:02', 7, 0),
(7, 1, 600, 450, 31, 'Most prefered price', 7, '2020-03-07 17:01:17', '2020-03-07 17:01:17', 7, 0),
(8, 1, 600, 100, 30, '', 7, '2020-03-07 17:16:37', '2020-06-21 01:24:48', 7, 0),
(9, 0, 750, 100, 30, '', 7, '2020-03-07 17:16:47', '2020-06-21 01:24:48', 7, 0),
(10, 0, 730, 600, 33, 'OBS', 7, '2020-03-16 14:18:40', '2020-08-08 00:25:02', 7, 0),
(11, 1, 900, 600, 29, '', 7, '2020-03-18 19:13:23', '2020-03-18 19:13:23', 7, 0),
(12, 1, 6000, 0, 34, '', 7, '2020-06-21 22:50:57', '2020-06-24 18:15:17', 7, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `proforma`
--

CREATE TABLE `proforma` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `enterprise` mediumblob NOT NULL,
  `customer` mediumblob NOT NULL,
  `itens` mediumblob NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_due` date NOT NULL,
  `date_emitted` date NOT NULL,
  `sale` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_modify` int(11) NOT NULL,
  `user_added` int(11) NOT NULL,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `proforma`
--

INSERT INTO `proforma` (`id`, `number`, `enterprise`, `customer`, `itens`, `date_added`, `date_due`, `date_emitted`, `sale`, `status`, `user_modify`, `user_added`, `date_modify`) VALUES
(2, 1, 0x7b226964223a2231222c226e616d65223a225a4e424f58222c2261646472657373223a2241762e204d6f5c7530306537616d6269717565222c22656d61696c223a22737570706f7274407a6e626f782e6e6574222c2270686f6e6531223a222b32353820383239373037303437222c2270686f6e6532223a222b32353820383530333735303933222c22706f7374616c5f636f6465223a2231313131222c226c6f676f223a2238643433656662393366383835373463383039363339373034626465633664322e706e67222c226e756974223a2234363734343233343534222c22757365725f6d6f64696679223a2237222c22646174655f6d6f64696679223a22323032302d30362d32322030353a34333a3536222c2263757272656e6379223a22227d, 0x7b226964223a2231222c226e616d65223a224564736f6e222c22636f6e7461637431223a222b323538383530333735303933222c22636f6e7461637432223a222b323538383239373037303437222c22656d61696c223a226564736f6e2e706174726963696f2e333940676d61696c2e636f6d222c2277656273697465223a22222c2261646472657373223a2241762e204d6f5c7530306537616d6269717565222c226f62736572766174696f6e223a224f42533a2e222c22757365725f6d6f64696679223a2237222c22757365725f6164646564223a2237222c22646174655f6164646564223a22323032302d30352d33312030313a31373a3135222c22646174655f6d6f64696679223a22323032302d30362d32352031343a34363a3030222c22697344656c65746564223a2230227d, 0x5b7b226964223a22313137222c2273616c65223a2233222c2273746f636b223a7b226964223a223331222c226e616d65223a2241646964617320742d73686972742072656420736d616c6c222c2270726963655f73656c6c223a22323030222c2270726963655f7075726368617365223a22313530222c227175616e74697479223a2232222c2263617465676f7279223a2239222c2274797065223a2231222c2277617265686f757365223a2231222c226465736372697074696f6e223a22222c22646174655f6164646564223a22323032302d30322d32312031373a35343a3131222c22757365725f6164646564223a2237222c22646174655f6d6f64696679223a22323032302d30362d31382031313a33383a3539222c22757365725f6d6f64696679223a2237222c22697344656c65746564223a2230227d2c227175616e74697479223a2233222c2270726963655f73616c65223a22363030222c2270726963655f7075726368617365223a22343530227d2c7b226964223a22313138222c2273616c65223a2233222c2273746f636b223a7b226964223a223333222c226e616d65223a2243617020416469646173202d20736d616c6c222c2270726963655f73656c6c223a2230222c2270726963655f7075726368617365223a2230222c227175616e74697479223a223132222c2263617465676f7279223a2239222c2274797065223a2231222c2277617265686f757365223a2232222c226465736372697074696f6e223a22436170222c22646174655f6164646564223a22323032302d30322d32392031363a32313a3233222c22757365725f6164646564223a2237222c22646174655f6d6f64696679223a22323032302d30352d30352030383a35333a3333222c22757365725f6d6f64696679223a2237222c22697344656c65746564223a2230227d2c227175616e74697479223a2231222c2270726963655f73616c65223a22373330222c2270726963655f7075726368617365223a22363030227d5d, '2020-07-02 19:29:53', '2020-07-07', '2020-07-02', 3, 1, 7, 7, '2020-07-02 19:29:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `purchase_date` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `observation` text,
  `user_added` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_modify` int(11) NOT NULL,
  `isStock` tinyint(1) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `purchase`
--

INSERT INTO `purchase` (`id`, `description`, `purchase_date`, `file`, `observation`, `user_added`, `date_added`, `date_modify`, `user_modify`, `isStock`, `isDeleted`) VALUES
(2, 'Compra de sapatilhas da puma', '2020-05-30', 'resources/uploads/15702877034k_2515841.jpg', 'OBSERVATION', 7, '2019-10-05 14:52:47', '2020-08-26 19:37:50', 7, 0, 1),
(3, 'Compra de T-shirt adidas', '2020-08-26', 'resources/uploads/1570288841galaxy-2643089.jpg', 'OBS', 7, '2019-10-05 16:19:32', '2020-08-26 19:38:01', 7, 0, 1),
(19, 'First purchase', '2020-08-23', '4dbf3da2f9e53637bd881dc27be169e7PNG', NULL, 7, '2020-08-23 18:16:16', '2020-08-26 19:38:16', 7, 0, 1),
(22, 'First purchase', '2020-08-27', '6d1b704ded97ce274c70c16b566ae22dPNG', NULL, 7, '2020-08-23 18:23:00', '2020-08-27 19:44:18', 7, 1, 0),
(23, 'Second purchase', '2020-08-26', 'dac2df850eb956d206dd42734be31558PNG', NULL, 7, '2020-08-23 18:24:13', '2020-08-27 19:41:30', 7, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchase_item`
--

CREATE TABLE `purchase_item` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_unity` float NOT NULL,
  `purchase` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `purchase_item`
--

INSERT INTO `purchase_item` (`id`, `quantity`, `price_unity`, `purchase`, `stock`) VALUES
(36, 16, 150, 23, 33),
(37, 12, 1500, 23, 30),
(38, 25, 750, 23, 29),
(39, 200, 150, 23, 33),
(42, 30, 750, 3, 31),
(45, 12, 1500, 22, 30),
(46, 10, 750, 22, 29),
(47, 60, 800, 22, 31);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `discount` float NOT NULL,
  `discount_type` tinyint(4) NOT NULL,
  `tax_percentage` float NOT NULL,
  `observation` text NOT NULL,
  `user_modify` int(11) NOT NULL,
  `user_added` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sale`
--

INSERT INTO `sale` (`id`, `customer`, `discount`, `discount_type`, `tax_percentage`, `observation`, `user_modify`, `user_added`, `date_added`, `date_modify`, `isDeleted`) VALUES
(1, 2, 10, 1, 17, '', 7, 7, '2020-05-22 00:03:26', '2020-05-22 00:03:26', 1),
(2, 1, 0, 1, 17, '', 7, 7, '2020-05-23 00:59:46', '2020-05-23 00:59:46', 0),
(3, 1, 12, 1, 17, '', 7, 7, '2020-05-23 01:01:57', '2020-05-23 01:01:57', 0),
(4, 1, 10, 1, 17, '', 7, 7, '2020-06-17 10:11:37', '2020-06-17 10:11:37', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sale_stock`
--

CREATE TABLE `sale_stock` (
  `id` int(11) NOT NULL,
  `sale` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_sale` float NOT NULL,
  `price_purchase` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sale_stock`
--

INSERT INTO `sale_stock` (`id`, `sale`, `stock`, `quantity`, `price_sale`, `price_purchase`) VALUES
(117, 3, 31, 3, 600, 450),
(118, 3, 33, 1, 730, 600),
(254, 4, 30, 0, 600, 100),
(255, 4, 30, 2, 600, 100),
(256, 4, 30, 1, 600, 100),
(257, 4, 30, 1, 600, 100),
(281, 2, 30, 1, 600, 100),
(282, 2, 29, 7, 900, 600),
(283, 2, 29, 7, 900, 600),
(284, 2, 31, 1, 600, 450),
(285, 2, 30, 1, 600, 100),
(286, 2, 30, 1, 600, 100),
(287, 2, 31, 1, 600, 450),
(288, 2, 33, 1, 300, 200),
(289, 2, 31, 1, 600, 450),
(290, 2, 31, 1, 600, 450),
(291, 2, 31, 1, 600, 450),
(292, 2, 34, 0, 6000, 0),
(293, 2, 33, 1, 300, 200),
(294, 2, 33, 1, 300, 200),
(295, 2, 33, 1, 300, 200),
(296, 2, 33, 1, 300, 200),
(297, 2, 31, 1, 600, 450),
(298, 2, 31, 1, 600, 450),
(299, 2, 31, 1, 600, 450),
(300, 2, 30, 1, 600, 100),
(301, 2, 31, 1, 600, 450),
(302, 2, 33, 1, 300, 200),
(303, 2, 33, 1, 300, 200);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price_sell` float NOT NULL,
  `price_purchase` float NOT NULL,
  `quantity` mediumint(9) NOT NULL,
  `category` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `description` text,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_added` int(11) NOT NULL,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_modify` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`id`, `name`, `price_sell`, `price_purchase`, `quantity`, `category`, `type`, `warehouse`, `description`, `date_added`, `user_added`, `date_modify`, `user_modify`, `isDeleted`) VALUES
(29, 'Adidas T-shirt blue - large', 590, 360, 12, 7, 1, 2, '', '2019-10-04 23:41:39', 7, '2020-08-08 00:24:29', 7, 0),
(30, 'Tenis Puma - small', 1560, 1020, 6, 8, 1, 2, '', '2019-10-05 08:00:02', 0, '2020-06-21 01:54:32', 7, 0),
(31, 'Adidas t-shirt red small', 200, 150, 2, 9, 1, 1, '', '2020-02-21 17:54:11', 7, '2020-06-18 11:38:59', 7, 0),
(32, 'Cap Adidas - small', 0, 0, 12, 9, 1, 2, '', '2020-02-29 16:16:01', 7, '2020-05-05 08:53:30', 7, 1),
(33, 'Cap Adidas - small', 0, 0, 12, 9, 1, 2, 'Cap', '2020-02-29 16:21:23', 7, '2020-05-05 08:53:33', 7, 0),
(34, 'Limpeza de escritórios', 0, 0, 0, 13, 2, 1, '', '2020-06-21 22:50:57', 7, '2020-08-27 19:42:24', 7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock_category`
--

CREATE TABLE `stock_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `observation` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_added` int(11) NOT NULL,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_modify` int(11) NOT NULL,
  `isDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `stock_category`
--

INSERT INTO `stock_category` (`id`, `name`, `observation`, `date_added`, `user_added`, `date_modify`, `user_modify`, `isDeleted`) VALUES
(1, 'Laptops', '', '2018-12-04 23:32:41', 7, '2019-10-04 15:41:57', 0, 1),
(2, 'Computadores desktop', '', '2018-12-04 23:32:41', 7, '2019-10-04 15:42:00', 0, 1),
(3, 'Cartão de memória', '', '2018-12-04 23:56:16', 7, '2019-10-04 15:42:02', 0, 1),
(4, 'Disco rigido', '', '2018-12-04 23:57:00', 7, '2019-10-04 15:42:05', 0, 1),
(5, 'Tablets', '', '2018-12-10 12:19:53', 7, '2019-09-29 00:41:05', 7, 1),
(6, 'Edson', 'OBS', '2019-09-28 17:11:25', 0, '2019-09-29 00:58:35', 0, 1),
(7, 'Camisetes', '', '2019-10-04 15:42:52', 0, '2019-10-05 01:46:46', 0, 0),
(8, 'Calças', '', '2019-10-05 01:46:57', 0, '2020-02-29 15:50:02', 7, 0),
(9, 'Camisas', '', '2019-10-05 01:47:05', 0, '2019-10-05 01:47:05', 0, 0),
(10, 'Sapatilhas', '', '2019-10-05 01:47:15', 0, '2019-10-05 01:47:15', 0, 0),
(11, 'Sandalias', '', '2019-11-03 00:54:06', 7, '2019-11-03 00:54:06', 7, 0),
(12, 'Chinelos', '', '2019-11-03 01:08:39', 7, '2019-11-03 01:08:39', 7, 0),
(13, 'Serviços', '', '2020-08-08 00:27:38', 7, '2020-08-08 00:27:38', 7, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock_type`
--

CREATE TABLE `stock_type` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `stock_type`
--

INSERT INTO `stock_type` (`id`, `name`) VALUES
(1, 'Product'),
(2, 'Service');

-- --------------------------------------------------------

--
-- Estrutura da tabela `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact1` varchar(15) DEFAULT NULL,
  `contact2` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `observation` text,
  `user_modify` int(11) NOT NULL,
  `user_added` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `contact1`, `contact2`, `email`, `website`, `address`, `observation`, `user_modify`, `user_added`, `date_added`, `date_modify`, `isDeleted`) VALUES
(1, 'Minerva', '823026558', '849653559', 'supporte@minerva.co.mz', 'http://minerva.co.mz', 'Avenida Julius Nyerere', '', 7, 7, '2018-12-04 01:01:51', '2020-05-31 01:21:43', 0),
(3, 'Recheio', '824654890', '846568453', 'recheio@gmail.com', '', '', '', 0, 7, '2018-12-04 13:15:43', '2020-05-31 01:21:47', 0),
(4, 'Adidas', '850375093', '829707047', 'commercial@adidas.co.za', 'https://www.adidas.co.za', 'Mozambique, Maputo city, Av. Mozambique, Zimpeto', '', 0, 0, '2019-10-04 14:27:39', '2019-10-05 02:07:01', 0),
(5, 'e', '2', '2', '', '', '', '', 0, 0, '2019-10-04 14:30:46', '2019-10-04 14:47:09', 1),
(6, 'edd', '22', '8297', '', '', '', '', 0, 0, '2019-10-04 14:30:57', '2019-10-04 14:47:13', 1),
(7, 'Puma', '829707047', '850375093', 'commercial@puma.co.za', 'https://www.puma.co.za', 'RSA', '', 7, 7, '2019-10-05 07:51:09', '2019-10-05 07:51:09', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first` varchar(30) NOT NULL,
  `last` varchar(30) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picture` varchar(255) NOT NULL DEFAULT 'user.png',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `first`, `last`, `username`, `email`, `password`, `user_type`, `date_added`, `picture`, `status`) VALUES
(0, 'super', 'su', 'su', 'su@znbox.net', '$2y$10$uB4GO5jbEleAHxVwZsqHbeIOTHe4GIFSe72J83EmkUcBS.vEIdHRG', 1, '2019-02-16 14:33:36', '', 1),
(7, 'Edson', 'Magombe', 'emagombe', 'edson.patricio.39@gmail.com', '$2y$10$LOzULCPVCcwwH.yrnT5QuuzbVGAvdoPrFks2kKRurL11dIClvKI4W', 1, '2018-11-02 01:41:00', 'user.png', 1),
(8, 'Tania', 'Magombe', 'tmagombe', 'tmagombe@znbox.net', '$2y$10$S/ijr8lxH.far.BsEVOncuhlNCB/OkbCojigmxMJgkg5q6aO9EcgC', 2, '2018-11-02 01:41:30', '', 1),
(9, 'Manuel', 'Cossa', 'mcossa', 'mcossa@znbox.net', '$2y$10$X2P3xAzPDAqjaF/PLZnVvO/faqIvU.8B.X6fpC4I2tCEpOhf8e42K', 2, '2020-02-15 17:16:39', 'user.png', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  `observation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `user`, `permission`, `observation`) VALUES
(13, 7, 3, ''),
(15, 7, 4, ''),
(16, 7, 5, ''),
(17, 7, 6, ''),
(18, 7, 7, ''),
(19, 7, 8, ''),
(20, 7, 9, ''),
(21, 7, 10, ''),
(22, 7, 11, ''),
(23, 7, 12, ''),
(24, 7, 13, ''),
(25, 7, 14, ''),
(26, 7, 15, ''),
(27, 7, 16, ''),
(28, 7, 17, ''),
(29, 7, 18, ''),
(30, 7, 19, ''),
(32, 7, 21, ''),
(33, 7, 22, ''),
(34, 7, 23, ''),
(35, 7, 25, ''),
(36, 7, 24, ''),
(37, 7, 26, ''),
(38, 7, 27, ''),
(39, 7, 28, ''),
(40, 7, 29, ''),
(41, 7, 31, ''),
(42, 7, 30, ''),
(43, 7, 32, ''),
(44, 7, 33, ''),
(45, 7, 34, ''),
(46, 7, 35, ''),
(47, 7, 36, ''),
(48, 7, 37, ''),
(49, 7, 38, ''),
(50, 7, 39, ''),
(51, 7, 40, ''),
(52, 7, 41, ''),
(54, 7, 43, ''),
(55, 7, 44, ''),
(56, 7, 45, ''),
(57, 7, 46, ''),
(58, 7, 47, ''),
(59, 7, 48, ''),
(60, 7, 49, ''),
(61, 7, 50, ''),
(62, 7, 51, ''),
(63, 7, 52, ''),
(64, 7, 53, ''),
(65, 7, 54, ''),
(66, 7, 55, ''),
(67, 7, 56, ''),
(68, 7, 57, ''),
(69, 7, 58, ''),
(70, 7, 59, ''),
(71, 7, 60, ''),
(72, 7, 61, ''),
(73, 7, 62, ''),
(74, 7, 64, ''),
(75, 7, 63, ''),
(76, 7, 65, ''),
(77, 7, 66, ''),
(78, 7, 67, ''),
(79, 7, 68, ''),
(80, 7, 69, ''),
(81, 7, 70, ''),
(82, 7, 71, ''),
(83, 7, 72, ''),
(84, 7, 73, ''),
(85, 7, 74, ''),
(86, 7, 75, ''),
(87, 7, 77, ''),
(88, 7, 76, ''),
(89, 7, 78, ''),
(90, 7, 79, ''),
(91, 7, 80, ''),
(92, 8, 47, ''),
(95, 8, 11, ''),
(96, 8, 10, ''),
(97, 8, 9, ''),
(98, 7, 2, ''),
(99, 7, 1, ''),
(100, 7, 42, ''),
(103, 0, 1, ''),
(104, 0, 2, ''),
(105, 0, 4, ''),
(106, 0, 3, ''),
(107, 0, 5, ''),
(108, 0, 6, ''),
(109, 0, 7, ''),
(110, 0, 9, ''),
(111, 0, 8, ''),
(112, 0, 10, ''),
(113, 0, 11, ''),
(114, 0, 12, ''),
(115, 0, 13, ''),
(116, 0, 15, ''),
(117, 0, 14, ''),
(118, 0, 16, ''),
(119, 0, 17, ''),
(120, 0, 18, ''),
(121, 0, 19, ''),
(122, 0, 20, ''),
(123, 0, 21, ''),
(124, 0, 22, ''),
(125, 0, 24, ''),
(126, 0, 23, ''),
(127, 0, 25, ''),
(128, 0, 26, ''),
(129, 0, 27, ''),
(130, 0, 28, ''),
(131, 0, 29, ''),
(132, 0, 30, ''),
(133, 0, 31, ''),
(134, 0, 32, ''),
(135, 0, 33, ''),
(136, 0, 34, ''),
(137, 0, 35, ''),
(138, 0, 36, ''),
(139, 0, 37, ''),
(140, 0, 38, ''),
(141, 0, 39, ''),
(142, 0, 40, ''),
(143, 0, 41, ''),
(144, 0, 42, ''),
(145, 0, 43, ''),
(146, 0, 44, ''),
(147, 0, 45, ''),
(148, 0, 46, ''),
(149, 0, 47, ''),
(150, 0, 48, ''),
(151, 0, 49, ''),
(152, 0, 50, ''),
(153, 0, 51, ''),
(154, 0, 52, ''),
(155, 0, 53, ''),
(156, 0, 54, ''),
(157, 0, 55, ''),
(158, 0, 56, ''),
(159, 0, 57, ''),
(160, 0, 58, ''),
(161, 0, 59, ''),
(162, 0, 60, ''),
(163, 0, 61, ''),
(164, 0, 62, ''),
(165, 0, 63, ''),
(166, 0, 64, ''),
(167, 0, 65, ''),
(168, 0, 66, ''),
(169, 0, 67, ''),
(170, 0, 68, ''),
(171, 0, 69, ''),
(172, 0, 70, ''),
(173, 0, 71, ''),
(174, 0, 72, ''),
(175, 0, 73, ''),
(176, 0, 74, ''),
(177, 0, 75, ''),
(178, 0, 76, ''),
(179, 0, 77, ''),
(180, 0, 78, ''),
(181, 0, 79, ''),
(182, 0, 80, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user_type`
--

INSERT INTO `user_type` (`id`, `type`, `description`) VALUES
(1, 'Admin', NULL),
(2, 'Employee', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `description` text,
  `user_added` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_modify` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `address`, `description`, `user_added`, `date_added`, `date_modify`, `user_modify`, `isDeleted`) VALUES
(1, 'Armazém 1', 'Avenida de moçambique', 'DESC', 7, '2018-12-05 01:06:00', '2019-09-28 17:09:29', 7, 0),
(2, 'Armazém 2', 'Avenida Julius Nyerere', 'DESCRIÇÃO', 7, '2018-12-05 01:14:23', '2020-02-29 16:01:12', 7, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `_stock_supplier`
--

CREATE TABLE `_stock_supplier` (
  `id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `_stock_supplier`
--

INSERT INTO `_stock_supplier` (`id`, `stock`, `supplier`) VALUES
(62, 32, 4),
(69, 33, 4),
(70, 31, 4),
(73, 30, 7),
(74, 29, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_moldify` (`user_modify`),
  ADD KEY `user_created` (`user_added`);

--
-- Indexes for table `enterprise`
--
ALTER TABLE `enterprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_moldify` (`user_modify`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale` (`sale`),
  ADD KEY `user_modify` (`user_modify`),
  ADD KEY `user_added` (`user_added`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_created` (`user_added`),
  ADD KEY `user_moldify` (`user_modify`),
  ADD KEY `product` (`stock`);

--
-- Indexes for table `proforma`
--
ALTER TABLE `proforma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale` (`sale`),
  ADD KEY `user_modify` (`user_modify`),
  ADD KEY `user_added` (`user_added`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_created` (`user_added`),
  ADD KEY `user_moldify` (`user_modify`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase` (`purchase`),
  ADD KEY `stock` (`stock`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_added` (`user_added`),
  ADD KEY `user_modify` (`user_modify`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `sale_stock`
--
ALTER TABLE `sale_stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale` (`sale`),
  ADD KEY `stock` (`stock`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `warehouse` (`warehouse`),
  ADD KEY `user_created` (`user_added`),
  ADD KEY `user_moldify` (`user_modify`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `stock_category`
--
ALTER TABLE `stock_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_moldify` (`user_modify`),
  ADD KEY `user_created` (`user_added`);

--
-- Indexes for table `stock_type`
--
ALTER TABLE `stock_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_moldify` (`user_modify`),
  ADD KEY `user_created` (`user_added`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `date_creation` (`date_added`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `permission` (`permission`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_created` (`user_added`),
  ADD KEY `user_moldify` (`user_modify`);

--
-- Indexes for table `_stock_supplier`
--
ALTER TABLE `_stock_supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`stock`),
  ADD KEY `supplier` (`supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `proforma`
--
ALTER TABLE `proforma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_stock`
--
ALTER TABLE `sale_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `stock_category`
--
ALTER TABLE `stock_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stock_type`
--
ALTER TABLE `stock_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `_stock_supplier`
--
ALTER TABLE `_stock_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`sale`) REFERENCES `sale` (`id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`user_added`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`user_modify`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`stock`) REFERENCES `stock` (`id`),
  ADD CONSTRAINT `price_ibfk_2` FOREIGN KEY (`user_added`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `price_ibfk_3` FOREIGN KEY (`user_modify`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `proforma`
--
ALTER TABLE `proforma`
  ADD CONSTRAINT `proforma_ibfk_1` FOREIGN KEY (`sale`) REFERENCES `sale` (`id`),
  ADD CONSTRAINT `proforma_ibfk_2` FOREIGN KEY (`user_added`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `proforma_ibfk_3` FOREIGN KEY (`user_modify`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`user_modify`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`user_added`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD CONSTRAINT `purchase_item_ibfk_1` FOREIGN KEY (`purchase`) REFERENCES `purchase` (`id`),
  ADD CONSTRAINT `purchase_item_ibfk_2` FOREIGN KEY (`stock`) REFERENCES `stock` (`id`);

--
-- Limitadores para a tabela `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`user_added`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`user_modify`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`customer`) REFERENCES `customer` (`id`);

--
-- Limitadores para a tabela `sale_stock`
--
ALTER TABLE `sale_stock`
  ADD CONSTRAINT `sale_stock_ibfk_1` FOREIGN KEY (`stock`) REFERENCES `stock` (`id`),
  ADD CONSTRAINT `sale_stock_ibfk_2` FOREIGN KEY (`sale`) REFERENCES `sale` (`id`);

--
-- Limitadores para a tabela `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`category`) REFERENCES `stock_category` (`id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`warehouse`) REFERENCES `warehouse` (`id`),
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`user_added`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `stock_ibfk_4` FOREIGN KEY (`user_modify`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `stock_ibfk_5` FOREIGN KEY (`type`) REFERENCES `stock_type` (`id`);

--
-- Limitadores para a tabela `warehouse`
--
ALTER TABLE `warehouse`
  ADD CONSTRAINT `warehouse_ibfk_1` FOREIGN KEY (`user_added`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `warehouse_ibfk_2` FOREIGN KEY (`user_modify`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `_stock_supplier`
--
ALTER TABLE `_stock_supplier`
  ADD CONSTRAINT `_stock_supplier_ibfk_1` FOREIGN KEY (`stock`) REFERENCES `stock` (`id`),
  ADD CONSTRAINT `_stock_supplier_ibfk_2` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
