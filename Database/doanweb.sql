-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2020 at 10:50 AM
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
-- Database: `doanweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `IdBT` int(11) NOT NULL,
  `Start` date NOT NULL,
  `Finish` date NOT NULL,
  `File` varchar(100) NOT NULL,
  `IdLop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `IdLop` int(11) NOT NULL,
  `TenLop` varchar(50) NOT NULL,
  `Phong` char(5) NOT NULL,
  `Mon` varchar(50) NOT NULL,
  `HinhLop` varchar(50) NOT NULL,
  `MaLop` int(11) NOT NULL,
  `IdGV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`IdLop`, `TenLop`, `Phong`, `Mon`, `HinhLop`, `MaLop`, `IdGV`) VALUES
(1, 'Web18', 'A0001', 'web', 'uploads/Screenshot (28).png', 2537, 0),
(3, 'lập trình angular', 'b0203', 'web', 'uploads/Screenshot (180).png', 43550, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `IdLop` int(11) NOT NULL,
  `TenLop` varchar(255) NOT NULL,
  `Phong` varchar(10) NOT NULL,
  `IdMon` int(11) NOT NULL,
  `HinhLop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `IdMon` int(11) NOT NULL,
  `TenMon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `IdNguoiDung` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` char(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`IdNguoiDung`, `UserName`, `Password`, `Email`, `Role`) VALUES
(1, 'hieutravinh', 'billgates', 'hieutravinhaxe@gmail.com', 2),
(2, 'hieutravinh02', 'billgates\r\n', 'hieutravinhaxe02@gmail.com', 2),
(3, 'hieutravinhaxe03', 'billgates', 'hieutravinhaxe03', 2),
(4, 'hieutravinh111', 'billgates', 'hieutravinh10@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `thanhvien`
--

CREATE TABLE `thanhvien` (
  `IdLop` int(11) NOT NULL,
  `IdNguoiDung` int(11) NOT NULL,
  `argree` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`IdLop`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`IdLop`),
  ADD KEY `IdMon` (`IdMon`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`IdMon`);

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
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `IdLop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `IdLop` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monhoc`
--
ALTER TABLE `monhoc`
  MODIFY `IdMon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `IdNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`IdMon`) REFERENCES `monhoc` (`IdMon`);

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
