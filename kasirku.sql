-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 01:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasirku`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kodebarang` varchar(20) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `hargabeli` int(30) NOT NULL,
  `hargajual` int(30) NOT NULL,
  `stok` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kodebarang`, `namabarang`, `hargabeli`, `hargajual`, `stok`) VALUES
('B01', 'HP1', 10000, 15000, 20),
('B02', 'Mukena', 175000, 500000, 93),
('B03', 'sarung', 65000, 80000, 190),
('B04', 'kaos', 50000, 60000, 993),
('B05', 'Kujang Baru', 20000, 10000, 25);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_user`, `nama`, `username`, `password`, `image`, `role`) VALUES
(1, 'admin', 'admin', 'admin', 'ssadha.png', 'kasir'),
(2, 'owner', 'owner', 'owner', 'Screenshot_2021-09-13_155020.png', 'pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `kodebarang` varchar(20) NOT NULL,
  `jumlah_masuk` int(50) NOT NULL,
  `kodesupplier` varchar(10) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `tanggal_transaksi`, `kodebarang`, `jumlah_masuk`, `kodesupplier`, `id_user`) VALUES
(17, '2021-11-16 21:11:14', 'B02', 4, 'S654', 1),
(21, '2021-11-16 21:11:14', 'B01', 55, 'S654', 1),
(23, '2021-11-20 03:14:00', 'B02', 3, 'S002', 1),
(24, '2021-11-24 22:14:00', 'B02', 3, 'S2385', 1),
(26, '2021-11-25 11:04:00', 'B01', 3, 'S654', 1),
(27, '2021-11-25 11:05:00', 'B04', 3, 'S2385', 1),
(28, '2021-12-07 05:24:00', 'B01', 10, 'S879', 1),
(30, '2022-05-30 11:36:00', 'B01', 5, 'S879', 1),
(31, '2022-06-05 19:45:00', 'B05', 5, 'S002', 1),
(32, '2022-06-06 00:09:00', 'B05', 5, 'S879', 2),
(33, '2022-06-06 00:10:00', 'B05', 10, 'S928', 2),
(34, '2022-06-07 17:34:00', 'B01', 5, 'S2385', 2),
(35, '2022-06-15 17:36:00', 'B01', 5, 'S002', 2),
(36, '2022-06-07 17:37:00', 'B01', 5, 'S002', 2),
(37, '2022-06-07 17:38:00', 'B01', 5, 'S002', 2),
(38, '2022-06-13 17:38:00', 'B01', 2, 'S002', 2),
(39, '2022-06-07 17:40:00', 'B01', 4, 'S002', 2),
(40, '2022-06-07 17:40:00', 'B01', 5, 'S002', 2),
(41, '2022-06-07 17:41:00', 'B01', 2, 'S002', 2),
(42, '2022-06-07 17:42:00', 'B03', 6, 'S654', 2);

--
-- Triggers `pembelian`
--
DELIMITER $$
CREATE TRIGGER `stokmasuk` AFTER INSERT ON `pembelian` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok + new.jumlah_masuk
WHERE kodebarang = new.kodebarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `nohp_supplier` varchar(20) NOT NULL,
  `alamat_supplier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `nohp_supplier`, `alamat_supplier`) VALUES
('S002', 'Koko', '086278', 'Kota Malang Barat'),
('S2385', 'Budia', '072629', 'Kota Malang '),
('S654', 'Coki', '666', 'Cirebon Mantap'),
('S879', 'Andi', '098658', 'Kabupaten Wakatobi'),
('S928', 'Ronaldo', '02623', 'Kabupaten Madrid');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `jumlah_uang` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `nota` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`id`, `tanggal`, `kodebarang`, `quantity`, `total_bayar`, `jumlah_uang`, `diskon`, `nota`, `id_user`) VALUES
(44, '2021-12-07 04:24:00', 'B02', '1', 500000, 500000, 0, 'EBQG0HOUVE', 1),
(45, '2021-12-06 05:10:00', 'B02,B01', '3,1', 1700000, 700000, 1000000, 'C0BWJF3URP', 1),
(46, '2021-12-06 05:14:00', 'B01,B04', '1,1', 260000, 300000, 0, 'W0SS8YTZU3', 1),
(47, '2021-12-06 05:15:00', 'B03', '1', 190000, 200000, 0, '8WDCSSFX50', 1),
(48, '2021-12-07 05:25:00', 'B01,B04', '5,2', 570000, 600000, 300000, '4PEG614OXW', 1),
(49, '2021-12-07 05:26:00', 'B02,B03', '1,1', 690000, 700000, 0, '09BIVKF2GG', 1),
(50, '2022-05-30 11:37:00', 'B04', '4', 240000, 300000, 0, 'IFJBCVULGG', 1),
(51, '2022-05-29 08:38:00', 'B01', '5', 750000, 800000, 0, 'UL863T7LD8', 1),
(52, '2022-06-06 00:04:00', 'B05', '1', 120000, 150000, 0, '7NO44JCQSA', 1),
(53, '2022-06-06 00:11:00', 'B05,B01', '5,5', 1350000, 1350000, 0, '6ZU1IAJ8Z0', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kodebarang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangmasuk_ibfk_1` (`kodebarang`),
  ADD KEY `barangmasuk_ibfk_2` (`kodesupplier`),
  ADD KEY `barangmasuk_ibfk_3` (`id_user`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iduser` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12313;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`kodesupplier`) REFERENCES `supplier` (`kode_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `pegawai` (`id_user`);

--
-- Constraints for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`id_user`) REFERENCES `pegawai` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
