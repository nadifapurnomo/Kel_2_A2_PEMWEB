-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 03:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_akhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(12) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role` enum('pelanggan','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(4, 'hai', '123', 'pelanggan'),
(5, 'nadifasbl_', '123', 'pelanggan'),
(6, 'gading', 'gading', 'pelanggan'),
(7, 'dhya', 'dhya', 'pelanggan'),
(8, 'agsel', 'agsel', 'pelanggan'),
(11, 'rifan', '12345', 'pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `kritik`
--

CREATE TABLE `kritik` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `id_akun` int(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number_phone` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `jasa` varchar(50) NOT NULL,
  `date_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `id_akun`, `name`, `number_phone`, `address`, `jasa`, `date_order`) VALUES
(1, 8, 'Agsel Falana Suparlan Putra', '082220984653', 'pramuka', 'Cleaning Home', '2023-11-16'),
(3, 8, 'dimas anjay mabar', '9273927392', 'smd seberang', 'fogging service', '2023-12-01'),
(4, 11, 'rifan keren', '2932937922', 'ks tubun', 'ac service', '2023-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_jasa` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_jasa`, `nama`, `deskripsi`, `harga`, `gambar`) VALUES
(4, 'Cleaning Home', 'rumah kinclong anti noda', 400000, '2023-11-15.cleaning home-file.png'),
(8, 'ac service', 'membersihkan ac anda', 250000, '2023-11-16.ac service-file.png'),
(9, 'fogging service', 'jasa fogging dengan kualitas terbaik', 500000, '2023-11-16.fogging service-file.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `kritik`
--
ALTER TABLE `kritik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_akun`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_jasa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kritik`
--
ALTER TABLE `kritik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
