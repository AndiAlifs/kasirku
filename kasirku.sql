-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 02:38 AM
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
('B01', 'Baju', 100000, 150000, 115),
('B02', 'Mukena', 175000, 500000, 101),
('B03', 'sarung', 65000, 190000, 184),
('B04', 'kaos', 50000, 60000, 997);

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `kodebarang` varchar(20) NOT NULL,
  `jumlah_masuk` int(50) NOT NULL,
  `kodesupplier` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`id`, `tanggal_transaksi`, `kodebarang`, `jumlah_masuk`, `kodesupplier`) VALUES
(17, '2021-11-16 21:11:14', 'B02', 4, 'S654'),
(21, '2021-11-16 21:11:14', 'B01', 55, 's654'),
(23, '2021-11-20 03:14:00', 'B02', 3, 'S002'),
(24, '2021-11-24 22:14:00', 'B02', 3, 'S2385'),
(26, '2021-11-25 11:04:00', 'B01', 3, 'S654'),
(27, '2021-11-25 11:05:00', 'B04', 3, 'S2385'),
(28, '2021-12-07 05:24:00', 'B01', 10, 'S879');

--
-- Triggers `barangmasuk`
--
DELIMITER $$
CREATE TRIGGER `stokmasuk` AFTER INSERT ON `barangmasuk` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok + new.jumlah_masuk
WHERE kodebarang = new.kodebarang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barangterjual`
--

CREATE TABLE `barangterjual` (
  `id` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `kodebarang` varchar(20) NOT NULL,
  `jumlah_keluar` int(50) NOT NULL,
  `kodenota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangterjual`
--

INSERT INTO `barangterjual` (`id`, `tanggal_transaksi`, `kodebarang`, `jumlah_keluar`, `kodenota`) VALUES
(1, '2021-12-07 04:24:00', 'B02', 1, 'EBQG0HOUVE'),
(2, '2021-12-06 05:10:00', 'B02', 3, 'C0BWJF3URP'),
(3, '2021-12-06 05:10:00', 'B01', 1, 'C0BWJF3URP'),
(4, '2021-12-06 05:14:00', 'B01', 1, 'W0SS8YTZU3'),
(5, '2021-12-06 05:14:00', 'B04', 1, 'W0SS8YTZU3'),
(6, '2021-12-06 05:15:00', 'B03', 1, '8WDCSSFX50'),
(7, '2021-12-07 05:25:00', 'B01', 5, '4PEG614OXW'),
(8, '2021-12-07 05:25:00', 'B04', 2, '4PEG614OXW'),
(9, '2021-12-07 05:26:00', 'B02', 1, '09BIVKF2GG'),
(10, '2021-12-07 05:26:00', 'B03', 1, '09BIVKF2GG');

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
('S002', 'Koko', '086278', 'Kota Malang Selatan'),
('S2385', 'Budia', '072629', 'Kota Malang '),
('S654', 'Coki', '666', 'Cirebon Mantap'),
('S879', 'Andi', '098658', 'Kabupaten Wakatobi'),
('S928', 'Ronaldo', '02623', 'Kabupaten Madrid');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `jumlah_uang` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `nota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `kodebarang`, `quantity`, `total_bayar`, `jumlah_uang`, `diskon`, `nota`) VALUES
(44, '2021-12-07 04:24:00', 'B02', '1', 500000, 500000, 0, 'EBQG0HOUVE'),
(45, '2021-12-06 05:10:00', 'B02,B01', '3,1', 1700000, 700000, 1000000, 'C0BWJF3URP'),
(46, '2021-12-06 05:14:00', 'B01,B04', '1,1', 260000, 300000, 0, 'W0SS8YTZU3'),
(47, '2021-12-06 05:15:00', 'B03', '1', 190000, 200000, 0, '8WDCSSFX50'),
(48, '2021-12-07 05:25:00', 'B01,B04', '5,2', 570000, 600000, 300000, '4PEG614OXW'),
(49, '2021-12-07 05:26:00', 'B02,B03', '1,1', 690000, 700000, 0, '09BIVKF2GG');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `image`) VALUES
(1, 'admin', 'admin', 'Screenshot_(93).png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kodebarang`);

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangmasuk_ibfk_1` (`kodebarang`),
  ADD KEY `barangmasuk_ibfk_2` (`kodesupplier`);

--
-- Indexes for table `barangterjual`
--
ALTER TABLE `barangterjual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kodebarang` (`kodebarang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `barangterjual`
--
ALTER TABLE `barangterjual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barangmasuk_ibfk_2` FOREIGN KEY (`kodesupplier`) REFERENCES `supplier` (`kode_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barangterjual`
--
ALTER TABLE `barangterjual`
  ADD CONSTRAINT `barangterjual_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
