-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 03:58 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlydanhgia`
--

-- --------------------------------------------------------

--
-- Table structure for table `bomon`
--

CREATE TABLE `bomon` (
  `MaBoMon` int(11) NOT NULL,
  `MaKhoa` int(11) NOT NULL,
  `TenBoMon` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bomon`
--

INSERT INTO `bomon` (`MaBoMon`, `MaKhoa`, `TenBoMon`) VALUES
(1, 1, 'Lập trình hướng đối tượng'),
(2, 2, 'Toán siêu cao cấp');

-- --------------------------------------------------------

--
-- Table structure for table `chitietkhaosatcauhoimo`
--

CREATE TABLE `chitietkhaosatcauhoimo` (
  `MaChiTietPhieuCauHoiMo` int(11) NOT NULL,
  `MaLopHocPhan` int(11) NOT NULL,
  `MaTieuChiDanhGia` int(11) NOT NULL,
  `MaHoatDongKhaoSat` int(11) NOT NULL,
  `NoiDungGopY` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitietkhaosatphieu`
--

CREATE TABLE `chitietkhaosatphieu` (
  `MaChiTietKhaoSatPhieu` int(11) NOT NULL,
  `MaPhieuKhaoSat` int(11) NOT NULL,
  `MaTieuChiDanhGia` int(11) NOT NULL,
  `MaHinhThucPhanLoai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `MaChucVu` int(11) NOT NULL,
  `TenChucVu` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`MaChucVu`, `TenChucVu`) VALUES
(1, 'admin'),
(2, 'giaovien'),
(3, 'nhanvien');

-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE `giaovien` (
  `MaGiaoVien` int(11) NOT NULL,
  `TenGiaoVien` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MaChucVu` int(11) NOT NULL,
  `MaBoMon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`MaGiaoVien`, `TenGiaoVien`, `MatKhau`, `MaChucVu`, `MaBoMon`) VALUES
(1, 'abc', '123', 2, 1),
(2, 'John', '1233', 2, 2),
(3, 'Nguyễn Văn A', '123123', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hinhthucphanloai`
--

CREATE TABLE `hinhthucphanloai` (
  `MaHinhThucPhanLoai` int(11) NOT NULL,
  `MaTieuChiDanhGia` int(11) NOT NULL,
  `NoiDungHinhThucPhanLoai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Diem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoatdongkhaosat`
--

CREATE TABLE `hoatdongkhaosat` (
  `MaHoatDong` int(11) NOT NULL,
  `TenHoatDong` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `MaHocKy` int(11) NOT NULL,
  `TenHocKy` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `MaHocPhan` int(11) NOT NULL,
  `TenHocPhan` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `MaKhoa` int(11) NOT NULL,
  `TenKhoa` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`MaKhoa`, `TenKhoa`) VALUES
(1, 'CNTT'),
(2, 'KT');

-- --------------------------------------------------------

--
-- Table structure for table `loaiphieu`
--

CREATE TABLE `loaiphieu` (
  `MaLoaiPhieu` int(11) NOT NULL,
  `TenLoaiPhieu` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lophocphan`
--

CREATE TABLE `lophocphan` (
  `MaLopHocPhan` int(11) NOT NULL,
  `TenLopHocPhan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MaHocPhan` int(11) NOT NULL,
  `MaNamHoc` int(11) NOT NULL,
  `MaHocKy` int(11) NOT NULL,
  `MaGiaoVien` int(11) NOT NULL,
  `MaNhomHocPhan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `namhoc`
--

CREATE TABLE `namhoc` (
  `MaNamHoc` int(11) NOT NULL,
  `KhoangThoiGian` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TenNhanVien` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MaChucVu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `TenNhanVien`, `MatKhau`, `MaChucVu`) VALUES
('NV00', 'Admin', '123', 1),
('NV01', 'Long', '123', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nhomhocphan`
--

CREATE TABLE `nhomhocphan` (
  `MaNhomHocPhan` int(11) NOT NULL,
  `TenNhomHocPhan` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhomtieuchi`
--

CREATE TABLE `nhomtieuchi` (
  `MaNhomTieuChi` int(11) NOT NULL,
  `TenNhom` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phieukhaosat`
--

CREATE TABLE `phieukhaosat` (
  `MaPhieuKhaoSat` int(11) NOT NULL,
  `MaLoaiPhieu` int(11) NOT NULL,
  `MaLopHocPhan` int(11) NOT NULL,
  `MaHoatDongKhaoSat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tieuchidanhgia`
--

CREATE TABLE `tieuchidanhgia` (
  `MaTieuChi` int(11) NOT NULL,
  `NoiDung` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `MaNhomTIeuChi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bomon`
--
ALTER TABLE `bomon`
  ADD PRIMARY KEY (`MaBoMon`),
  ADD KEY `fk_bomon_khoa` (`MaKhoa`);

--
-- Indexes for table `chitietkhaosatcauhoimo`
--
ALTER TABLE `chitietkhaosatcauhoimo`
  ADD PRIMARY KEY (`MaChiTietPhieuCauHoiMo`);

--
-- Indexes for table `chitietkhaosatphieu`
--
ALTER TABLE `chitietkhaosatphieu`
  ADD PRIMARY KEY (`MaChiTietKhaoSatPhieu`);

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`MaChucVu`);

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`MaGiaoVien`),
  ADD KEY `fk_giaovien_chucvu` (`MaChucVu`),
  ADD KEY `fk_giaovien_bomon` (`MaBoMon`);

--
-- Indexes for table `hinhthucphanloai`
--
ALTER TABLE `hinhthucphanloai`
  ADD PRIMARY KEY (`MaHinhThucPhanLoai`);

--
-- Indexes for table `hoatdongkhaosat`
--
ALTER TABLE `hoatdongkhaosat`
  ADD PRIMARY KEY (`MaHoatDong`);

--
-- Indexes for table `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`MaHocKy`);

--
-- Indexes for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`MaHocPhan`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`MaKhoa`);

--
-- Indexes for table `loaiphieu`
--
ALTER TABLE `loaiphieu`
  ADD PRIMARY KEY (`MaLoaiPhieu`);

--
-- Indexes for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD PRIMARY KEY (`MaLopHocPhan`),
  ADD KEY `fk_LopHocPhan_NhomHocPhan` (`MaNhomHocPhan`),
  ADD KEY `fk_LopHocPhan_HocPhan` (`MaHocPhan`),
  ADD KEY `fk_lopHocPhan_NamHoc` (`MaNamHoc`),
  ADD KEY `fk_LopHocPhan_HocKy` (`MaHocKy`);

--
-- Indexes for table `namhoc`
--
ALTER TABLE `namhoc`
  ADD PRIMARY KEY (`MaNamHoc`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`),
  ADD KEY `fk_nhanvien_chucvu` (`MaChucVu`);

--
-- Indexes for table `nhomhocphan`
--
ALTER TABLE `nhomhocphan`
  ADD PRIMARY KEY (`MaNhomHocPhan`);

--
-- Indexes for table `nhomtieuchi`
--
ALTER TABLE `nhomtieuchi`
  ADD PRIMARY KEY (`MaNhomTieuChi`);

--
-- Indexes for table `phieukhaosat`
--
ALTER TABLE `phieukhaosat`
  ADD PRIMARY KEY (`MaPhieuKhaoSat`),
  ADD KEY `fk_PhieuKhaoSat_LopHocPhan` (`MaLopHocPhan`);

--
-- Indexes for table `tieuchidanhgia`
--
ALTER TABLE `tieuchidanhgia`
  ADD PRIMARY KEY (`MaTieuChi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bomon`
--
ALTER TABLE `bomon`
  MODIFY `MaBoMon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chitietkhaosatcauhoimo`
--
ALTER TABLE `chitietkhaosatcauhoimo`
  MODIFY `MaChiTietPhieuCauHoiMo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chitietkhaosatphieu`
--
ALTER TABLE `chitietkhaosatphieu`
  MODIFY `MaChiTietKhaoSatPhieu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `MaChucVu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `giaovien`
--
ALTER TABLE `giaovien`
  MODIFY `MaGiaoVien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hinhthucphanloai`
--
ALTER TABLE `hinhthucphanloai`
  MODIFY `MaHinhThucPhanLoai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoatdongkhaosat`
--
ALTER TABLE `hoatdongkhaosat`
  MODIFY `MaHoatDong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hocky`
--
ALTER TABLE `hocky`
  MODIFY `MaHocKy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hocphan`
--
ALTER TABLE `hocphan`
  MODIFY `MaHocPhan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khoa`
--
ALTER TABLE `khoa`
  MODIFY `MaKhoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loaiphieu`
--
ALTER TABLE `loaiphieu`
  MODIFY `MaLoaiPhieu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lophocphan`
--
ALTER TABLE `lophocphan`
  MODIFY `MaLopHocPhan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `namhoc`
--
ALTER TABLE `namhoc`
  MODIFY `MaNamHoc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhomhocphan`
--
ALTER TABLE `nhomhocphan`
  MODIFY `MaNhomHocPhan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhomtieuchi`
--
ALTER TABLE `nhomtieuchi`
  MODIFY `MaNhomTieuChi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phieukhaosat`
--
ALTER TABLE `phieukhaosat`
  MODIFY `MaPhieuKhaoSat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tieuchidanhgia`
--
ALTER TABLE `tieuchidanhgia`
  MODIFY `MaTieuChi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bomon`
--
ALTER TABLE `bomon`
  ADD CONSTRAINT `fk_bomon_khoa` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`);

--
-- Constraints for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `fk_giaovien_bomon` FOREIGN KEY (`MaBoMon`) REFERENCES `bomon` (`MaBoMon`),
  ADD CONSTRAINT `fk_giaovien_chucvu` FOREIGN KEY (`MaChucVu`) REFERENCES `chucvu` (`MaChucVu`);

--
-- Constraints for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD CONSTRAINT `fk_LopHocPhan_HocKy` FOREIGN KEY (`MaHocKy`) REFERENCES `hocky` (`MaHocKy`),
  ADD CONSTRAINT `fk_LopHocPhan_HocPhan` FOREIGN KEY (`MaHocPhan`) REFERENCES `hocphan` (`MaHocPhan`),
  ADD CONSTRAINT `fk_LopHocPhan_NhomHocPhan` FOREIGN KEY (`MaNhomHocPhan`) REFERENCES `nhomhocphan` (`MaNhomHocPhan`),
  ADD CONSTRAINT `fk_lopHocPhan_NamHoc` FOREIGN KEY (`MaNamHoc`) REFERENCES `namhoc` (`MaNamHoc`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `fk_nhanvien_chucvu` FOREIGN KEY (`MaChucVu`) REFERENCES `chucvu` (`MaChucVu`);

--
-- Constraints for table `phieukhaosat`
--
ALTER TABLE `phieukhaosat`
  ADD CONSTRAINT `fk_PhieuKhaoSat_LopHocPhan` FOREIGN KEY (`MaLopHocPhan`) REFERENCES `lophocphan` (`MaLopHocPhan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
