-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 06:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qllh`
--

-- --------------------------------------------------------

--
-- Table structure for table `baiviet`
--

CREATE TABLE `baiviet` (
  `IdBaiViet` int(11) NOT NULL,
  `Start` date NOT NULL,
  `End` date NOT NULL,
  `MoTa` text NOT NULL,
  `File` varchar(255) NOT NULL,
  `IdLop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `IdBinhLuan` int(11) NOT NULL,
  `NoiDung` int(11) NOT NULL,
  `IdNguoiDung` int(11) NOT NULL,
  `IdBaiViet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `IdLop` int(11) NOT NULL,
  `TenLop` varchar(255) NOT NULL,
  `Phong` varchar(10) NOT NULL,
  `Mon` varchar(50) NOT NULL,
  `HinhLop` varchar(255) NOT NULL,
  `MaLop` int(11) NOT NULL,
  `IdGV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lop`
--

INSERT INTO `lop` (`IdLop`, `TenLop`, `Phong`, `Mon`, `HinhLop`, `MaLop`, `IdGV`) VALUES
(5, 'web1', 'A0102', 'web', 'uploads/Screenshot (17).png', 17495, 0),
(7, 'web2', 'A0103', '0', 'uploads/Screenshot (6).png', 69401, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `IdNguoiDung` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Birth` date NOT NULL,
  `Role` int(11) NOT NULL,
  `Token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`IdNguoiDung`, `Name`, `Username`, `Password`, `Email`, `Birth`, `Role`, `Token`) VALUES
(5, 'Trần Minh Chiến', 'chientran', '$2y$10$dpfwvkqad2WfXLoRBgVVl.B4MDpdbnidm9f8fDxoVXcYD6Ryb8D96', 'chientranplus@gmail.com', '2000-01-01', 2, ''),
(6, 'Trần Minh Chiến', 'chien', '$2y$10$1qjIHKWKWXPqLmJBKeQXv.jW6hF4XxJRici/bBZ0EWI4z3VjG7OjK', 'chientranplus@gmail.co', '2000-01-01', 0, ''),
(7, 'admin', 'admin', '$2y$10$q1iZmtvdzyn335FsURkUPu/OD2qYeJ6CLzcvaPgQ6TAkigAqCu7zO', 'chientran@gmail.com', '2000-01-01', 0, ''),
(8, 'Nguyễn Ngọc Hiếu', 'hieutravinh', '$2y$10$5zq02aND3SThNn2cHdGE3.op1tqJqGZO.J2/x90I7.msma6a3pXBG', 'hieutravinhaxe@gmail.com', '2000-01-01', 2, ''),
(9, 'Nguyễn Ngọc', 'hieutravi', '$2y$10$DlNuvZ5wd.pno7fLImzEOe5xe8lLr.iRxzfbwlR7Zs1Mo1aoeKirK', 'hieutravinhaxe02@gmail.com', '2000-01-01', 2, ''),
(10, 'Nguyễn Ngọc H', 'hieuhieungoc', '$2y$10$wDB0yewfl/p59K9kpJ1Y0.zPJFa66G6HUyGmwkPF1m1lIXnbdndtG', 'hieutravinhaxe03@gmail.com', '2000-01-01', 2, ''),
(11, 'Nguyễn Ngọc Hiếu', 'ngocngoc', '$2y$10$Su01hSFZ6n5aUj4GPTjzkuz5F3rDaGTYNIYxiUHcq2OsKuzr8b9Vm', 'hieutravinh10@gmail.com', '2000-01-01', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `thanhvien`
--

CREATE TABLE `thanhvien` (
  `IdLop` int(11) NOT NULL,
  `IdNguoiDung` int(11) NOT NULL,
  `agree` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thanhvien`
--

INSERT INTO `thanhvien` (`IdLop`, `IdNguoiDung`, `agree`) VALUES
(5, 5, 0),
(5, 8, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`IdBaiViet`),
  ADD KEY `IdLop` (`IdLop`);

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD KEY `IdBaiViet` (`IdBaiViet`),
  ADD KEY `IdNguoiDung` (`IdNguoiDung`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`IdLop`),
  ADD UNIQUE KEY `IdLop` (`IdLop`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`IdNguoiDung`);

--
-- Indexes for table `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD KEY `IdLop` (`IdLop`),
  ADD KEY `IdNguoiDung` (`IdNguoiDung`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `IdBaiViet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `IdLop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `IdNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `baiviet`
--
ALTER TABLE `baiviet`
  ADD CONSTRAINT `baiviet_ibfk_1` FOREIGN KEY (`IdLop`) REFERENCES `lop` (`IdLop`);

--
-- Constraints for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`IdBaiViet`) REFERENCES `baiviet` (`IdBaiViet`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`IdNguoiDung`) REFERENCES `nguoidung` (`IdNguoiDung`);

--
-- Constraints for table `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD CONSTRAINT `thanhvien_ibfk_1` FOREIGN KEY (`IdLop`) REFERENCES `lop` (`IdLop`),
  ADD CONSTRAINT `thanhvien_ibfk_2` FOREIGN KEY (`IdNguoiDung`) REFERENCES `nguoidung` (`IdNguoiDung`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
