-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Set-2020 às 19:08
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
(1, 'znbox', 'Av. Moçambique', 'support@znbox.net', '+258 829707047', '+258 850375093', 1111, '7196ce63bb359e2aaba7267ebb62d885.png', 4674423454, 7, '2020-08-29 09:01:49', '');

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
(1, 1, 300, 200, 33, NULL, 7, '2020-02-29 16:21:23', '2020-09-16 18:29:29', 7, 0),
(7, 0, 600, 450, 31, 'Most prefered price', 7, '2020-03-07 17:01:17', '2020-09-16 18:25:58', 7, 0),
(8, 0, 600, 100, 30, '', 7, '2020-03-07 17:16:37', '2020-09-16 18:25:58', 7, 0),
(9, 0, 750, 100, 30, '', 7, '2020-03-07 17:16:47', '2020-06-21 01:24:48', 7, 0),
(10, 0, 730, 600, 33, 'OBS', 7, '2020-03-16 14:18:40', '2020-09-16 18:29:14', 7, 0),
(11, 0, 900, 600, 29, '', 7, '2020-03-18 19:13:23', '2020-09-16 18:25:58', 7, 0),
(12, 0, 250, 120, 31, '', 7, '2020-09-16 18:27:33', '2020-09-16 18:33:05', 7, 1),
(13, 0, 12, 0, 31, '', 7, '2020-09-16 18:32:21', '2020-09-16 18:32:51', 7, 1);

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price_sell` float NOT NULL,
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
(1, 'Edson', 'Magombe', 'emagombe', 'edson.patricio.39@gmail.com', '$2y$10$ZfZ.oFsaXOzPaXS9R/eaHuwZldlX3MhSTj0qpkjHzSwXgqLgRD9.u', 1, '2018-11-02 01:41:00', 'c4a6744fde5e91fafb69252a1132aacc.jpg', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `proforma`
--
ALTER TABLE `proforma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_stock`
--
ALTER TABLE `sale_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_category`
--
ALTER TABLE `stock_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_type`
--
ALTER TABLE `stock_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `_stock_supplier`
--
ALTER TABLE `_stock_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
