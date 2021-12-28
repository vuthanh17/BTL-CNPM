-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 28, 2021 lúc 07:58 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlyts`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diem`
--

CREATE TABLE `diem` (
  `SBD` int(11) NOT NULL,
  `Mon1` float DEFAULT NULL,
  `Mon2` float DEFAULT NULL,
  `Mon3` float DEFAULT NULL,
  `Mon4` float DEFAULT NULL,
  `TongDiem` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `diem`
--

INSERT INTO `diem` (`SBD`, `Mon1`, `Mon2`, `Mon3`, `Mon4`, `TongDiem`) VALUES
(1, 8, 9, 10, 8, 35),
(2, 10, 9.5, 4, 6, 32.5),
(3, 5, NULL, NULL, NULL, 5),
(4, 3, 3, 3, NULL, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sobaodanh`
--

CREATE TABLE `sobaodanh` (
  `SBD` int(10) NOT NULL,
  `CCCD` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `PhongThi` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sobaodanh`
--

INSERT INTO `sobaodanh` (`SBD`, `CCCD`, `PhongThi`) VALUES
(1, '123456789001', '1'),
(2, '123456789002', '1'),
(3, '123456789012', '1'),
(4, '123456789045', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `UserName` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`UserName`, `Password`) VALUES
('admin', '1234');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thisinh`
--

CREATE TABLE `thisinh` (
  `CCCD` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `HoTen` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `DanToc` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NoiSinh` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DCThuongTru` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DCHienTai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MonTuChon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DCThi` int(11) NOT NULL,
  `DCNghe` int(11) NOT NULL,
  `Anh` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TTThi` int(11) NOT NULL,
  `TTDo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thisinh`
--

INSERT INTO `thisinh` (`CCCD`, `HoTen`, `NgaySinh`, `GioiTinh`, `DanToc`, `NoiSinh`, `DCThuongTru`, `DCHienTai`, `MonTuChon`, `DCThi`, `DCNghe`, `Anh`, `TTThi`, `TTDo`) VALUES
('123456789001', 'Đỗ Văn Nam', '2007-01-07', 'Nam', 'Kinh', 'Hà Nội', 'Số 43, Phố Huế, Hà Nội', 'Số 43, Phố Huế, Hà Nội', 'Không thi chuyên', 0, 0, 'img/Nam.png', 1, 0),
('123456789002', 'Nguyễn Minh Anh', '2007-06-12', 'Nữ', 'Kinh', 'Hà Nội', '12 Hàng Trống, Hoàn Kiếm, Hà Nội', '12 Hàng Trống, Hoàn Kiếm, Hà Nội', 'Sử - chuyên', 2, 1, 'img/Nu.png', 1, 0),
('123456789012', 'Đỗ Văn Minh', '2007-01-07', 'Nam', 'Kinh', 'Hà Nội', 'Số 43, Phố Huế, Hà Nội', 'Số 43, Phố Huế, Hà Nội', 'Không thi chuyên', 0, 0, 'img/Nam.png', 1, 0),
('123456789045', 'Nguyễn Minh Ngọc', '2007-06-12', 'Nữ', 'Kinh', 'Hà Nội', '12 Hàng Trống, Hoàn Kiếm, Hà Nội', '12 Hàng Trống, Hoàn Kiếm, Hà Nội', 'Sử - chuyên', 2, 1, 'img/Nu.png', 1, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `diem`
--
ALTER TABLE `diem`
  ADD KEY `sobaodanh.SBD-diem.SBD` (`SBD`);

--
-- Chỉ mục cho bảng `sobaodanh`
--
ALTER TABLE `sobaodanh`
  ADD PRIMARY KEY (`SBD`),
  ADD KEY `thising.CCCD-sobaodanh.CCCD` (`CCCD`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`UserName`);

--
-- Chỉ mục cho bảng `thisinh`
--
ALTER TABLE `thisinh`
  ADD PRIMARY KEY (`CCCD`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `diem`
--
ALTER TABLE `diem`
  ADD CONSTRAINT `sobaodanh.SBD-diem.SBD` FOREIGN KEY (`SBD`) REFERENCES `sobaodanh` (`SBD`);

--
-- Các ràng buộc cho bảng `sobaodanh`
--
ALTER TABLE `sobaodanh`
  ADD CONSTRAINT `thising.CCCD-sobaodanh.CCCD` FOREIGN KEY (`CCCD`) REFERENCES `thisinh` (`CCCD`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
