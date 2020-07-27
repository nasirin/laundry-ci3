-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 22, 2020 at 06:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ship2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `name`) VALUES
('01', 'January'),
('02', 'February'),
('03', 'March'),
('04', 'April'),
('05', 'May'),
('06', 'June'),
('07', 'July'),
('08', 'August'),
('09', 'September'),
('10', 'October'),
('11', 'November'),
('12', 'December');

-- --------------------------------------------------------

--
-- Table structure for table `detail_product`
--

CREATE TABLE `detail_product` (
  `id_detail` int(10) NOT NULL,
  `id_detail_product_kiloan` int(10) DEFAULT NULL,
  `id_detail_product_satuan` int(3) DEFAULT NULL,
  `id_detail_inventory` int(3) NOT NULL,
  `jumlah_inventory` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_product`
--

INSERT INTO `detail_product` (`id_detail`, `id_detail_product_kiloan`, `id_detail_product_satuan`, `id_detail_inventory`, `jumlah_inventory`) VALUES
(95, 74, NULL, 11, 5),
(98, NULL, 2, 11, 5),
(99, 75, NULL, 11, 5),
(100, 75, NULL, 10, 6),
(103, 76, NULL, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id_inventory` int(3) NOT NULL,
  `kode_inventory` varchar(30) NOT NULL,
  `id_karyawan` int(3) DEFAULT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `varian_inventory` varchar(15) NOT NULL,
  `quantity_inventory` int(5) NOT NULL,
  `harga_beli` int(16) NOT NULL,
  `supplier_inventory` varchar(30) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id_inventory`, `kode_inventory`, `id_karyawan`, `nama_barang`, `varian_inventory`, `quantity_inventory`, `harga_beli`, `supplier_inventory`, `created`, `updated`) VALUES
(10, 'INV-0120-003', 67, 'inventory 3', 'apple', 12, 12312, 'nyi dah', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'INV-0120-004', 67, 'cuci piring', 'jambu air', 12, 12312, 'nyi puk', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'INV-0120-005', 67, 'sabun colek', 'melati', 12, 121221, '121212', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(5) NOT NULL,
  `NIP` varchar(30) NOT NULL,
  `id_level` int(11) DEFAULT NULL COMMENT '1: admin, 2: kasir, 3:pelanggan',
  `nama_karyawan` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `notelp_karyawan` varchar(16) DEFAULT NULL,
  `branch` int(2) NOT NULL COMMENT '1 : toko 1, 2: toko 2',
  `alamat_karyawan` text DEFAULT NULL,
  `photo_karyawan` varchar(100) DEFAULT NULL,
  `status_karyawan` int(11) NOT NULL COMMENT '1: aktif, 2: non aktif',
  `created` varchar(10) NOT NULL,
  `updated` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `NIP`, `id_level`, `nama_karyawan`, `email`, `password`, `notelp_karyawan`, `branch`, `alamat_karyawan`, `photo_karyawan`, `status_karyawan`, `created`, `updated`) VALUES
(67, 'dasfda', 1, 'Nasirin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '', 0, '', NULL, 1, '', '18-01-2020'),
(74, 'KAR-2-0120-001', 2, 'susanto', 'susanto@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1312 3123 1231', 2, 'sdafasfas', 'KAR-012020-9a86dc0891.jpg', 1, '19-01-2020', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(10) NOT NULL,
  `salary` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `salary`) VALUES
(1, 'admin', NULL),
(2, 'kasir', NULL),
(3, 'member', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(5) NOT NULL,
  `kode_member` varchar(15) NOT NULL,
  `id_level` int(2) NOT NULL,
  `nama_member` varchar(30) NOT NULL,
  `gender_member` enum('laki','perempuan','','') NOT NULL,
  `notelp_member` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status_member` int(2) NOT NULL,
  `photo_member` varchar(100) DEFAULT NULL,
  `alamat_member` text NOT NULL,
  `created` varchar(100) NOT NULL,
  `updated` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `kode_member`, `id_level`, `nama_member`, `gender_member`, `notelp_member`, `email`, `password`, `status_member`, `photo_member`, `alamat_member`, `created`, `updated`) VALUES
(10, 'MB-0120-001', 3, 'wildan', 'laki', '1212 1212 1212', 'pelanggan@gmail.com', '7f78f06d2d1262a0a222ca9834b15d9d', 1, 'MB-012020-8c9f5fc169.jpg', 'dfsafadf fdsafasfdas', '20-01-2020', NULL),
(11, 'MB-0120-002', 3, 'kucluk', 'laki', '1212 1212 1212', 'kucluk@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'MB-012020-6032fb2090.jpg', 'dsfasfa', '20-01-2020', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_kiloan`
--

CREATE TABLE `order_kiloan` (
  `id_order_kiloan` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_product_kiloan` int(11) NOT NULL,
  `id_inventory` int(11) DEFAULT NULL,
  `id_promo` int(11) DEFAULT NULL,
  `kode_order_kiloan` varchar(30) NOT NULL,
  `nama_pelanggan_kiloan` varchar(30) DEFAULT NULL,
  `berat_kiloan` int(11) NOT NULL,
  `keterangan_kiloan` varchar(100) DEFAULT NULL,
  `total_harga_kiloan` int(11) NOT NULL,
  `tanggal_masuk_kiloan` date NOT NULL,
  `tanggal_keluar_kiloan` varchar(30) DEFAULT NULL,
  `status_kiloan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_kiloan`
--

INSERT INTO `order_kiloan` (`id_order_kiloan`, `id_member`, `id_product_kiloan`, `id_inventory`, `id_promo`, `kode_order_kiloan`, `nama_pelanggan_kiloan`, `berat_kiloan`, `keterangan_kiloan`, `total_harga_kiloan`, `tanggal_masuk_kiloan`, `tanggal_keluar_kiloan`, `status_kiloan`, `id_karyawan`) VALUES
(26, 10, 74, 11, 12, 'DS', 'coba', 43, 'keterangan', 1000, '2019-02-01', '2019-01-02', 0, 67),
(27, 10, 74, 11, 12, 'DS', 'coba', 43, 'keterangan', 1000, '2019-02-01', '2019-01-02', 0, 67),
(28, 10, 74, 11, 12, 'DS', 'coba', 43, 'keterangan', 3000, '2019-08-07', '2019-01-02', 0, 67),
(29, 10, 74, 11, 12, 'DS', 'coba', 43, 'keterangan', 3000, '2019-06-05', '2019-01-02', 0, 67),
(30, 10, 74, 11, 12, 'DS', 'coba', 43, 'keterangan', 3000, '2019-01-02', '2019-01-02', 0, 67);

-- --------------------------------------------------------

--
-- Table structure for table `order_satuan`
--

CREATE TABLE `order_satuan` (
  `id_order_satuan` int(11) NOT NULL,
  `kode_order_satuan` varchar(30) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_product_satuan` int(11) NOT NULL,
  `id_inventory` int(11) DEFAULT NULL,
  `id_promo` int(11) DEFAULT NULL,
  `nama_pelanggan_satuan` varchar(30) DEFAULT NULL,
  `jumlah_satuan` int(5) NOT NULL,
  `keterangan_satuan` text DEFAULT NULL,
  `total_harga_satuan` int(16) NOT NULL,
  `tanggal_masuk_satuan` varchar(30) NOT NULL,
  `tanggal_keluar_satuan` varchar(30) DEFAULT NULL,
  `status_satuan` int(1) NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_satuan`
--

INSERT INTO `order_satuan` (`id_order_satuan`, `kode_order_satuan`, `id_member`, `id_product_satuan`, `id_inventory`, `id_promo`, `nama_pelanggan_satuan`, `jumlah_satuan`, `keterangan_satuan`, `total_harga_satuan`, `tanggal_masuk_satuan`, `tanggal_keluar_satuan`, `status_satuan`, `id_karyawan`) VALUES
(5, 'KDSA', 11, 2, 10, 12, 'irman', 12, 'teks panjang', 90000, '2019-11-11', '2019-11-11', 1, 74),
(6, 'KDSA', 11, 2, 10, 12, 'irman', 12, 'teks panjang', 90000, '2019-11-11', '2019-11-11', 1, 74),
(7, 'KDSA', 11, 2, 10, 12, 'irman', 12, 'teks panjang', 90000, '2019-11-11', '2019-11-11', 1, 74);

-- --------------------------------------------------------

--
-- Table structure for table `product_kiloan`
--

CREATE TABLE `product_kiloan` (
  `id_product_kiloan` int(11) NOT NULL,
  `kode_product_kiloan` varchar(30) NOT NULL,
  `nama_product_kiloan` varchar(30) NOT NULL,
  `harga_product_kiloan` int(16) NOT NULL,
  `durasi_kiloan` int(5) NOT NULL,
  `status_kiloan` int(2) NOT NULL,
  `created` date NOT NULL,
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_kiloan`
--

INSERT INTO `product_kiloan` (`id_product_kiloan`, `kode_product_kiloan`, `nama_product_kiloan`, `harga_product_kiloan`, `durasi_kiloan`, `status_kiloan`, `created`, `updated`) VALUES
(74, 'PROD/K-0120-003', 'reguler aja', 7000, 3, 2, '0000-00-00', '0000-00-00'),
(75, 'PROD/K-0120-004', 'express', 10000, 1, 1, '0000-00-00', NULL),
(76, 'PROD/K-0120-005', 'kilat', 15000, 1, 1, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `product_satuan`
--

CREATE TABLE `product_satuan` (
  `id_product_satuan` int(11) NOT NULL,
  `kode_product_satuan` varchar(30) NOT NULL,
  `nama_product_satuan` varchar(30) NOT NULL,
  `harga_product_satuan` int(16) NOT NULL,
  `durasi_satuan` int(3) NOT NULL,
  `status_satuan` int(1) NOT NULL,
  `created` date NOT NULL,
  `updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_satuan`
--

INSERT INTO `product_satuan` (`id_product_satuan`, `kode_product_satuan`, `nama_product_satuan`, `harga_product_satuan`, `durasi_satuan`, `status_satuan`, `created`, `updated`) VALUES
(2, 'PROD/S-0120-002', 'baju muslim pendek / gaun pend', 14999, 1, 1, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(3) NOT NULL,
  `kode_promo` varchar(30) NOT NULL,
  `nama_promo` varchar(30) NOT NULL,
  `value_jenis_promo` int(11) DEFAULT NULL,
  `keterangan_promo` varchar(100) NOT NULL,
  `status_promo` int(2) NOT NULL COMMENT '1: aktif, 2: tidak aktif',
  `mulai_promo` varchar(10) DEFAULT NULL,
  `akhir_promo` varchar(10) DEFAULT NULL,
  `photo_promo` varchar(30) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `kode_promo`, `nama_promo`, `value_jenis_promo`, `keterangan_promo`, `status_promo`, `mulai_promo`, `akhir_promo`, `photo_promo`, `created`, `updated`) VALUES
(12, 'ADS-0120-001', 'promo menarik', 12, 'dafasdfasdfa', 1, '12/12/2020', '12/12/2020', 'ADS-012020-85861e2205.jpg', '0000-00-00 00:00:00', NULL),
(14, 'ADS-0120-001', 'promo menarik', 12, 'dafasdfasdfa', 1, '12/12/2020', '12/12/2020', 'ADS-012020-85861e2205.jpg', '0000-00-00 00:00:00', NULL),
(15, 'ADS-0120-001', 'promo menarik banget', 12, 'dafasdfasdfa', 1, '12/12/2020', '12/12/2020', 'ADS-012020-85861e2205.jpg', '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `detail_product`
--
ALTER TABLE `detail_product`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_product` (`id_detail_product_kiloan`),
  ADD KEY `detail_product_ibfk_3` (`id_detail_inventory`),
  ADD KEY `id_detail_product_satuan` (`id_detail_product_satuan`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id_inventory`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `order_kiloan`
--
ALTER TABLE `order_kiloan`
  ADD PRIMARY KEY (`id_order_kiloan`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_product` (`id_product_kiloan`),
  ADD KEY `id_promo` (`id_promo`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_inventory` (`id_inventory`);

--
-- Indexes for table `order_satuan`
--
ALTER TABLE `order_satuan`
  ADD PRIMARY KEY (`id_order_satuan`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_product_satuan` (`id_product_satuan`),
  ADD KEY `id_inventory` (`id_inventory`),
  ADD KEY `id_promo` (`id_promo`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `product_kiloan`
--
ALTER TABLE `product_kiloan`
  ADD PRIMARY KEY (`id_product_kiloan`);

--
-- Indexes for table `product_satuan`
--
ALTER TABLE `product_satuan`
  ADD PRIMARY KEY (`id_product_satuan`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_product`
--
ALTER TABLE `detail_product`
  MODIFY `id_detail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id_inventory` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_kiloan`
--
ALTER TABLE `order_kiloan`
  MODIFY `id_order_kiloan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_satuan`
--
ALTER TABLE `order_satuan`
  MODIFY `id_order_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_kiloan`
--
ALTER TABLE `product_kiloan`
  MODIFY `id_product_kiloan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `product_satuan`
--
ALTER TABLE `product_satuan`
  MODIFY `id_product_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_product`
--
ALTER TABLE `detail_product`
  ADD CONSTRAINT `detail_product_ibfk_2` FOREIGN KEY (`id_detail_product_kiloan`) REFERENCES `product_kiloan` (`id_product_kiloan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_product_ibfk_3` FOREIGN KEY (`id_detail_inventory`) REFERENCES `inventory` (`id_inventory`),
  ADD CONSTRAINT `detail_product_ibfk_4` FOREIGN KEY (`id_detail_product_satuan`) REFERENCES `product_satuan` (`id_product_satuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);

--
-- Constraints for table `order_kiloan`
--
ALTER TABLE `order_kiloan`
  ADD CONSTRAINT `order_kiloan_ibfk_1` FOREIGN KEY (`id_inventory`) REFERENCES `inventory` (`id_inventory`),
  ADD CONSTRAINT `order_kiloan_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `order_kiloan_ibfk_3` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  ADD CONSTRAINT `order_kiloan_ibfk_4` FOREIGN KEY (`id_product_kiloan`) REFERENCES `product_kiloan` (`id_product_kiloan`),
  ADD CONSTRAINT `order_kiloan_ibfk_5` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`);

--
-- Constraints for table `order_satuan`
--
ALTER TABLE `order_satuan`
  ADD CONSTRAINT `order_satuan_ibfk_1` FOREIGN KEY (`id_inventory`) REFERENCES `inventory` (`id_inventory`),
  ADD CONSTRAINT `order_satuan_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `order_satuan_ibfk_3` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  ADD CONSTRAINT `order_satuan_ibfk_4` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`),
  ADD CONSTRAINT `order_satuan_ibfk_5` FOREIGN KEY (`id_product_satuan`) REFERENCES `product_satuan` (`id_product_satuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
