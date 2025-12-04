-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 01:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simb`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(10) NOT NULL,
  `nama_buku` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `nama_penulis` varchar(100) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `tanggal_input` datetime NOT NULL DEFAULT current_timestamp(),
  `gambar` varchar(100) NOT NULL,
  `isbn` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `kategori`, `nama_penulis`, `tahun_terbit`, `tanggal_input`, `gambar`, `isbn`) VALUES
(1, 'Hujan', 'Fiksi', 'Tere Liye', '2016-01-06', '2025-11-29 10:00:00', '9786020324784_Hujan.jpg', '9786020324784'),
(2, 'Kamus Inggris-Indonesia', 'Non Fiksi', 'John M. Echols & Hassan Shadily', '2017-10-17', '2025-11-29 10:05:00', '9796864525_Kamus Inggris-Indonesia.jpg', '9796864525'),
(3, 'Sherlock Holmes', 'Fiksi', 'Sir Arthur Conan Doyle', '2015-02-04', '2025-11-29 10:10:00', '9786020312910_Sherlock Holmes.jpg', '9786020312910'),
(4, 'To Sleep in A Sea of Stars', 'Fiksi', 'Christoper Paolini', '2020-09-15', '2025-11-29 10:15:00', '9781529046526_To Sleep in A Sea of Stars.jpg', '9781529046526'),
(5, 'Summer in Seoul', 'Fiksi', 'Ilana Tan', '2006-11-29', '2025-11-28 21:18:21', '9792224602_Summer in Seoul.jpg', '9792224602'),
(6, 'Dear J', 'Fiksi', 'L. Lullaby', '2021-03-14', '2025-11-28 21:19:36', '9879927503_Dear J.jpg', '9879927503'),
(7, 'Laut Bercerita', 'Fiksi', 'Leila S. Chudori', '2017-10-23', '2025-11-28 21:22:14', '9786024246945_Laut Bercerita.jpg', '9786024246945'),
(8, 'Filosofi Teras', 'Non Fiksi', 'Henry Manampiring', '2018-11-26', '2025-11-28 21:26:47', '9786024125189_Filosofi Teras.jpg', '9786024125189');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`) VALUES
(1, 'natty', 'natty@gmail.com', '$2y$10$C.GvZQY4Q7IENf2LXYR3O.OFx29l3fox6OqIxJ0Ywc7Hw5lB5CVXK'),
(2, 'dooshik', 'dooshik@gmail.com', '$2y$10$YNfdCxmjBckeBRi7Fudi.echaFvoWeBKBTI/cBgfbH8gwJZg0KzPC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
