-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 04:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komputer`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `img_path`) VALUES
(1, 'Laptop Asus VIVOBOOK S K3402ZA-OLEDS555 I8 12500H ', 4000000, 1, 'img/asus.jpeg'),
(2, 'ACER NITRO 5 AN515-57-5534 I5 11400H', 6500000, 2, 'img/acer.jpg'),
(3, 'ACER SWIFT 3 SF314-43-R9D3 RYZEN 7 5700U', 8000000, 5, 'img/acer.jpg'),
(4, 'ACER ASPIRE 5 SLIM A514-55-55P5 I5 1235U', 5600000, 13, 'img/acer.jpg'),
(5, 'Apple Macbook Air MGND3ID/A M1 2020 8GB', 23000000, 16, 'img/macbook.jpg'),
(6, 'APPLE MACBOOK PRO MNEJ3ID/A M2 8-core CPU and 10-c', 15000000, 0, 'img/macbook.jpg'),
(7, 'ASUS ROG FLOW X13 GV301RA-R7RADA6T-O RYZEN 7 6800H', 30000000, 6, 'img/asus.jpeg'),
(8, 'ASUS TUF GAMING DASH FX517ZC-I535B6T-O I5 12450H', 23000000, 5, 'img/asus.jpeg'),
(9, 'ASUS VIVOBOOK 13 SLATE T3304GA-OLED321 I3 N300 8GB', 12000000, 9, 'img/asus.jpeg'),
(10, 'ASUS VIVOBOOK S K3402ZA-OLEDS756 I7 12700H 16GB', 15100000, 0, 'img/asus.jpeg'),
(11, 'MSI MODERN 14 C11M 9S7-14J312-004 I5 1155G7 8GB', 35000000, 3, 'img/MSI.png'),
(12, 'MSI PRESTIGE 14 A11SC 957-14C512-206 I7-1195G7 16G', 23000000, 14, 'img/MSI.png'),
(13, 'MSI CYBORG 15 A12VE 9S7-15K111-074 I7 12650H 16GB', 9000000, 8, 'img/MSI.png'),
(14, 'MSI GF63 THIN 11UD 9S7-16R612-1096ID I7 11800H 8GB', 1700000, 15, 'img/MSI.png'),
(15, 'LENOVO LEGION 5i 15IAH7H-F6ID I7 12700H 16GB', 6000000, 13, 'img/lenovo.jpg'),
(16, 'LENOVO IDEAPAD SLIM 3i 14ITL6-J1ID I3 1115G4 8GB', 2300000, 45, 'img/lenovo.jpg'),
(17, 'LENOVO IDEAPAD SLIM 1 14AMN7-6TID ATHLON SILVER 71', 10000000, 12, 'img/lenovo.jpg'),
(18, 'AXIOO HP 14S-FQ2003AU RYZEN 7 5825U 8GB', 5000000, 13, 'img/axioo.jpeg'),
(19, 'AXIOO HP 14S-DQ3110TU N4500 4GB', 7000000, 10, 'img/axioo.jpeg'),
(20, 'AXIOO SLIMBOOK 14 RYZEN 3 3200 8GB', 15000000, 5, 'img/axioo.jpeg'),
(4536, 'Asus X415', 14000000, 8, 'img/download(2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `id_user`, `nama_lengkap`, `email`, `nomor_hp`, `alamat`) VALUES
(23, 4, 'awang levy', 'awang@gmail.com', '08567894567', 'Jl Melawai IV PD Psr Jaya Blok M AKS 3/3, Dki Jakarta'),
(24, 5, 'Ajeng Nuris Rahmadianty', 'ajengnuris@gmail.com', '085390979791', 'Jalan Pangeran Antasari Gang Mawar 16A, Kalimantan Timur');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `total_bayar` float NOT NULL,
  `tanggal_transaksi` date DEFAULT current_timestamp(),
  `status` enum('Belum Dikirim','Telah Dikirim') DEFAULT 'Belum Dikirim'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_barang`, `jumlah_barang`, `alamat`, `total_bayar`, `tanggal_transaksi`, `status`) VALUES
(1, 4, 10, 1, ' Jl Panjaitan IV PD Psr Jaya Blok M AKS 3/3, Dki Jakarta', 15100000, '2023-05-11', 'Telah Dikirim'),
(22, 5, 10, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 15100000, '2023-05-11', 'Telah Dikirim'),
(23, 5, 9, 3, 'Jalan Gerilya Gg. Sepakat RT 50', 36000000, '2023-05-11', 'Belum Dikirim'),
(24, 5, 1, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 4000000, '2023-05-11', 'Belum Dikirim'),
(25, 5, 4, 4, 'Jalan Gerilya Gg. Sepakat RT 50', 22400000, '2023-05-11', 'Belum Dikirim'),
(26, 5, 4, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 5600000, '2023-05-11', 'Belum Dikirim'),
(27, 5, 4, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 5600000, '2023-05-11', 'Belum Dikirim'),
(28, 5, 4, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 5600000, '2023-05-11', 'Belum Dikirim'),
(29, 5, 4, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 5600000, '2023-05-11', 'Belum Dikirim'),
(30, 5, 4, 3, 'Jalan Gerilya Gg. Sepakat RT 50', 16800000, '2023-05-11', 'Belum Dikirim'),
(31, 5, 4, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 5600000, '2023-05-11', 'Belum Dikirim'),
(32, 5, 4, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 5600000, '2023-05-11', 'Belum Dikirim'),
(33, 5, 3, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 8000000, '2023-05-11', 'Belum Dikirim'),
(34, 5, 3, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 8000000, '2023-05-11', 'Belum Dikirim'),
(35, 5, 4, 1, 'Jalan Pangeran Antasari Gang Mawar No 16A Rt 041 Kalimantan Timur Samarinda', 5600000, '2023-05-11', 'Belum Dikirim'),
(36, 5, 4, 1, 'Jalan Gerilya Gg. Sepakat RT 50', 5600000, '2023-05-11', 'Belum Dikirim'),
(37, 4, 4, 2, 'Jalan Pangeran Antasari Gang Mawar No 16A Rt 041 Kalimantan Timur Samarinda', 11200000, '2023-05-11', 'Belum Dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hak_akses` enum('user','karyawan','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `hak_akses`) VALUES
(2, 'admin', 'admin', 'admin'),
(3, 'karyawan', 'karyawan', 'karyawan'),
(4, 'user', 'user', 'user'),
(5, 'user2', 'user2', 'user'),
(6, 'karyawan2', '123', 'karyawan'),
(12, 'karyawan3', '123', 'karyawan'),
(13, 'user3', '123', 'user'),
(14, 'kasir', 'kasir', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
