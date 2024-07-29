-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2024 at 01:12 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myda`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietgiohang`
--

CREATE TABLE `chitietgiohang` (
  `magiohang` int NOT NULL,
  `mahanghoa` int NOT NULL,
  `soluong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitietgiohang`
--

INSERT INTO `chitietgiohang` (`magiohang`, `mahanghoa`, `soluong`) VALUES
(7, 33, 1),
(7, 34, 1),
(7, 35, 1),
(8, 33, 2),
(8, 34, 1),
(8, 35, 2);

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `magiohang` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `thanhtoan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`magiohang`, `username`, `thanhtoan`) VALUES
(1, 'nguoidung', 0),
(7, 'tan', 1),
(8, 'tan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `mahanghoa` int NOT NULL,
  `maloai` int NOT NULL,
  `tenhanghoa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `soluong` int NOT NULL,
  `gia` int NOT NULL,
  `diachi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `xuatxu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hinh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`mahanghoa`, `maloai`, `tenhanghoa`, `mota`, `soluong`, `gia`, `diachi`, `xuatxu`, `hinh`) VALUES
(1, 9, 'Xi măng', 'Xi măng Nghi Sơn, Hà Tiên, Cần Thơ, Holcim', 45, 92000, 'Đồng Tháp', 'Việt Nam', 'Hinh1.jpg'),
(2, 10, 'Thảm bao bố', 'Bảo dưỡng bê tông và bảo vệ sàn', 50, 100000, 'Kiên Giang', 'Nhật Bản', 'Hinh2.jpg'),
(3, 3, 'Đá', 'Đá dùng trong xây dựng', 20, 1500000, 'TP.HCM', 'Việt Nam', 'Hinh3.jpg'),
(4, 7, 'Ống nhựa Polyetylen', 'Loại tốt dùng để cấp nước', 40, 570000, 'TP.HCM', 'Mỹ', 'Hinh4.jpg'),
(5, 1, 'Gạch ống', 'Loại gạch 6 lỗ, 4 lỗ, gạch cù', 45, 890000, 'Vĩnh Long', 'Trung Quốc', 'Hinh5.jpg'),
(6, 5, 'Tấm thạch cao', 'Loại cao cấp dùng trong xây dựng', 35, 257000, 'Thủ Đô Hà Nội', 'Trung Quốc', 'Hinh6.jpg'),
(7, 2, 'Sắt & thép', 'Loại tốt nhất trong trong xây dựng', 40, 1200000, 'Lâm Đồng', 'Thái Lan', 'Hinh7.jpg'),
(8, 4, 'Gạch lót sàn', 'Gạch bông, gạch tráng gương, gạch nhám,...', 55, 2300000, 'Tiền Giang', 'Việt Nam', 'Hinh8.jpg'),
(9, 8, 'Cát', 'Cát xây dựng, cát bê tông, cát xây tô, cát san lấp', 100, 2500000, 'An Giang', 'Việt Nam', 'Hinh9.jpg'),
(10, 6, 'Sơn tường', 'Sơn tường loại chống thấm', 90, 1450000, 'Long An', 'Hàn Quốc', 'Hinh10.jpg'),
(11, 1, 'Gạch 2 lỗ', 'Dùng trong xây dựng', 400, 1350000, 'TP.HCM', 'Thái Lan', 'Hinh11.jpg'),
(12, 2, 'Sắt thép phi 6,8', 'Được dùng trong xây dựng', 130, 1200000, 'Tiền Giang', 'Việt Nam', 'Hinh12.jpg'),
(13, 2, 'Vật liệu thép', 'Dùng trong xây dựng', 150, 850000, 'Kiên Giang', 'Việt Nam', 'Hinh13.jpg'),
(14, 3, 'Đá rối nhập', 'Dùng trong xây dựng', 150, 670000, 'Long An ', 'PhiLipPin', 'Hinh14.jpg'),
(15, 3, 'Đá cuội', 'Dùng trong xây dựng và trang trí hồ cá', 150, 1350000, 'Vũng Tàu', 'Việt Nam', 'Hinh15.jpg'),
(16, 3, 'Đá xây dựng', 'Dùng trong xây dựng', 200, 2100000, 'Đồng Tháp', 'Việt Nam', 'Hinh16.jpg'),
(17, 4, 'Gạch lát nền', 'Dùng để lát sàn nhà', 275, 850000, 'TP.HCM', 'Việt Nam', 'Hinh17.jpg'),
(18, 4, 'Gạch ốp tường', 'Dùng để ốp vào tường nhà', 320, 850000, 'Hậu Giang', 'Mỹ', 'Hinh18.jpg'),
(19, 4, 'Gạch lát sàn gỗ', 'Dùng để lát sàn nhà kiểu gạch hình gỗ', 450, 950000, 'Đồng Tháp', 'Hàn Quốc', 'Hinh19.jpg'),
(20, 5, 'Thạch cao chịu nước', 'Tấm thạch cao chịu nước mới nhất năm 2022', 230, 1240000, 'Cần Thơ', 'Hàn Quốc', 'Hinh20.jpg'),
(21, 5, 'Lót sàn', 'Dùng trong xây dựng để lót sàn nhà', 430, 2300000, 'Phú Yên', 'Ba Lan', 'Hinh21.jpg'),
(22, 6, 'Sơn trang trí', 'Dùng trong xây dựng để sơn trang trí nhà', 160, 925000, 'Bình Phước', 'Nhật Bản', 'Hinh22.jpg'),
(23, 6, 'Sơn Jotun', 'Dùng trong xây dựng để sơn tường nhà', 420, 760000, 'An Giang', 'Trung Quốc', 'Hinh23.jpg'),
(24, 6, 'Sơn lót', 'Dùng trong xây dựng để sơn tường nhà', 170, 840000, 'TP.HCM', 'Việt Nam', 'Hinh24.jpg'),
(25, 7, 'Ống luồn điện', 'Dùng trong xây dựng để luồn dẫn đường điện', 327, 429000, 'Cà Mau', 'Việt Nam', 'Hinh25.jpg'),
(26, 7, 'Ống nhựa HDPE', 'Dùng trong xây dựng', 130, 650000, 'Phú Yên', 'Việt Nam', 'Hinh26.jpg'),
(27, 7, 'Ống nhựa uPVC', 'Dùng trong xây dựng để dẫn đường nước trong nhà', 145, 350000, 'Tiền Giang', 'Việt ', 'Hinh27.jpg'),
(28, 8, 'Cát thạch anh', 'Dùng trong xây dựng', 60, 1600000, 'Kiên Giang', 'Hàn Quốc', 'Hinh28.jpg'),
(29, 8, 'Cát lọc nước', 'Dùng trong xây dựng, cát lọc nước 0,8 - 1,5mm', 234, 1890000, 'Hà Tiên', 'Thái Lan', 'Hinh29.jpg'),
(30, 8, 'Cát xây dựng', 'Dùng trong xây dựng', 85, 2350000, 'TP.HCM', 'Việt Nam', 'Hinh30.jpg'),
(31, 9, 'Xi măng trắng', 'Dùng trong xây dựng', 80, 2380000, 'Bạc Liêu', 'Nhật Bản', 'Hinh31.jpg'),
(32, 9, 'Xi măng PC', 'Dùng trong xây dựng', 95, 1650000, 'Đồng Nai', 'Thái Lan', 'Hinh32.jpg'),
(33, 9, 'Xi măng PCB40', 'Dùng trong xây dựng', 85, 1450000, 'TP.HCM', 'Việt Nam', 'Hinh33.jpg'),
(34, 10, 'Bố thô sợi đay', 'Vải bố thô sợi đay khổ 1m2, vải bao bố cao cấp, dày, mềm mại,...', 78, 560000, 'Bạc Liêu', 'Việt Nam', 'Hinh34.jpg'),
(35, 10, 'Bố thưa', '1 mét vải bố thưa kích thước khố vải 120cm', 115, 356000, 'Quảng Nam', 'Việt Nam', 'Hinh35.jpg'),
(36, 10, 'Bố canvas trắng', 'Vải bố canvas trắng - Xưởng may in túi canvas', 125, 682000, 'Quãng Ngải', 'Việt Nam', 'Hinh36.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `loaihang`
--

CREATE TABLE `loaihang` (
  `maloai` int NOT NULL,
  `tenloai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaihang`
--

INSERT INTO `loaihang` (`maloai`, `tenloai`) VALUES
(1, 'Gạch ống'),
(2, 'Sắt & thép'),
(3, 'Đá'),
(4, 'Gạch lót sàn'),
(5, 'Tấm thạch cao'),
(6, 'Sơn tường'),
(7, 'Ống nhựa Polyetylen (PE)'),
(8, 'Cát'),
(9, 'Xi măng'),
(10, 'Thảm bao bố');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', '$2y$10$qFA8ysjbvkpfgteqwTNs4OjKHbM/O0qVlf3NQzr181/V17Td4RWoa'),
('nguoidung', '$2y$10$qFA8ysjbvkpfgteqwTNs4OjKHbM/O0qVlf3NQzr181/V17Td4RWoa'),
('tan', '$2y$10$.s4DXiCoe2sM/SGAjHztcOni3qNrAcR0X2i9jquvo/Q5j7AfydkxO');

-- --------------------------------------------------------

--
-- Table structure for table `vanchuyen`
--

CREATE TABLE `vanchuyen` (
  `ngaylapdonhang` date NOT NULL,
  `magiohang` int NOT NULL,
  `diachi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tinhtrang` tinyint(1) NOT NULL,
  `sodienthoai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vanchuyen`
--

INSERT INTO `vanchuyen` (`ngaylapdonhang`, `magiohang`, `diachi`, `tinhtrang`, `sodienthoai`) VALUES
('2023-05-20', 7, 'Tiền Giang', 1, '0924224752');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD PRIMARY KEY (`magiohang`,`mahanghoa`),
  ADD KEY `mahanghoa` (`mahanghoa`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`magiohang`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`mahanghoa`),
  ADD KEY `maloai` (`maloai`);

--
-- Indexes for table `loaihang`
--
ALTER TABLE `loaihang`
  ADD PRIMARY KEY (`maloai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD PRIMARY KEY (`ngaylapdonhang`,`magiohang`),
  ADD KEY `magiohang` (`magiohang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `magiohang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `mahanghoa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `loaihang`
--
ALTER TABLE `loaihang`
  MODIFY `maloai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietgiohang`
--
ALTER TABLE `chitietgiohang`
  ADD CONSTRAINT `chitietgiohang_ibfk_1` FOREIGN KEY (`magiohang`) REFERENCES `giohang` (`magiohang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `chitietgiohang_ibfk_2` FOREIGN KEY (`mahanghoa`) REFERENCES `hanghoa` (`mahanghoa`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`maloai`) REFERENCES `loaihang` (`maloai`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `vanchuyen`
--
ALTER TABLE `vanchuyen`
  ADD CONSTRAINT `vanchuyen_ibfk_1` FOREIGN KEY (`magiohang`) REFERENCES `giohang` (`magiohang`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
