-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 11:40 AM
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
  `MaHinhThucPhanLoai` int(11) NOT NULL,
  `DiemSo` int(11) NOT NULL
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

--
-- Dumping data for table `hinhthucphanloai`
--

INSERT INTO `hinhthucphanloai` (`MaHinhThucPhanLoai`, `MaTieuChiDanhGia`, `NoiDungHinhThucPhanLoai`, `Diem`) VALUES
(1, 1, 'RD', 5),
(2, 1, 'D', 4),
(3, 1, 'TDD', 3),
(4, 1, 'KD', 2),
(5, 1, 'RKD', 1),
(6, 2, 'RD', 5),
(7, 2, 'D', 4),
(8, 2, 'TDD', 3),
(9, 2, 'KD', 2),
(10, 2, 'RKD', 1),
(11, 3, 'RD', 5),
(12, 3, 'D', 4),
(13, 3, 'TDD', 3),
(14, 3, 'KD', 2),
(15, 3, 'RKD', 1),
(16, 4, 'RD', 5),
(17, 4, 'D', 4),
(18, 4, 'TDD', 3),
(19, 4, 'KD', 2),
(20, 4, 'RKD', 1),
(21, 5, 'RD', 5),
(22, 5, 'D', 4),
(23, 5, 'TDD', 3),
(24, 5, 'KD', 2),
(25, 5, 'RKD', 1),
(26, 6, 'RD', 5),
(27, 6, 'D', 4),
(28, 6, 'TDD', 3),
(29, 6, 'KD', 2),
(30, 6, 'RKD', 1),
(31, 7, 'RD', 5),
(32, 7, 'D', 4),
(33, 7, 'TDD', 3),
(34, 7, 'KD', 2),
(35, 7, 'RKD', 1),
(36, 8, 'RD', 5),
(37, 8, 'D', 4),
(38, 8, 'TDD', 3),
(39, 8, 'KD', 2),
(40, 8, 'RKD', 1),
(41, 9, 'RD', 5),
(42, 9, 'D', 4),
(43, 9, 'TDD', 3),
(44, 9, 'KD', 2),
(45, 9, 'RKD', 1),
(46, 10, 'RD', 5),
(47, 10, 'D', 4),
(48, 10, 'TDD', 3),
(49, 10, 'KD', 2),
(50, 10, 'RKD', 1),
(51, 11, 'RD', 5),
(52, 11, 'D', 4),
(53, 11, 'TDD', 3),
(54, 11, 'KD', 2),
(55, 11, 'RKD', 1),
(56, 12, 'RD', 5),
(57, 12, 'D', 4),
(58, 12, 'TDD', 3),
(59, 12, 'KD', 2),
(60, 12, 'RKD', 1),
(61, 13, 'RD', 5),
(62, 13, 'D', 4),
(63, 13, 'TDD', 3),
(64, 13, 'KD', 2),
(65, 13, 'RKD', 1),
(66, 14, 'RD', 5),
(67, 14, 'D', 4),
(68, 14, 'TDD', 3),
(69, 14, 'KD', 2),
(70, 14, 'RKD', 1),
(71, 15, 'RD', 5),
(72, 15, 'D', 4),
(73, 15, 'TDD', 3),
(74, 15, 'KD', 2),
(75, 15, 'RKD', 1),
(76, 16, 'RHL', 5),
(77, 16, 'KHL', 4),
(78, 16, 'THL', 3),
(79, 16, 'KHHL', 2),
(80, 16, 'RKHHL', 1),
(81, 17, 'GioiTinh', 1),
(82, 18, '80', 1),
(83, 18, '50', 1),
(84, 18, 'DUOI50', 1),
(85, 19, 'XS', 5),
(86, 19, 'GIOI', 4),
(87, 19, 'KHA', 3),
(88, 19, 'TB', 2),
(89, 19, 'YEU', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hoatdongkhaosat`
--

CREATE TABLE `hoatdongkhaosat` (
  `MaHoatDong` int(11) NOT NULL,
  `TenHoatDong` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoatdongkhaosat`
--

INSERT INTO `hoatdongkhaosat` (`MaHoatDong`, `TenHoatDong`) VALUES
(1, 'ĐÁNH GIÁ HỌC PHẦN'),
(2, 'ĐÁNH GIÁ GIẢNG DẠY');

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `MaHocKy` int(11) NOT NULL,
  `TenHocKy` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hocky`
--

INSERT INTO `hocky` (`MaHocKy`, `TenHocKy`) VALUES
(1, '1'),
(2, '2'),
(3, 'summer');

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `MaHocPhan` int(11) NOT NULL,
  `TenHocPhan` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hocphan`
--

INSERT INTO `hocphan` (`MaHocPhan`, `TenHocPhan`) VALUES
(1, 'Lập trình hướng đối tượng'),
(2, 'Cấu trúc dữ liệu và giải thuật'),
(3, 'Toán rời rạc'),
(4, 'Tiếng anh chuyên ngành');

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

--
-- Dumping data for table `loaiphieu`
--

INSERT INTO `loaiphieu` (`MaLoaiPhieu`, `TenLoaiPhieu`) VALUES
(1, 'PHIẾU THU THẬP THÔNG TIN DẠY VÀ HỌC'),
(2, 'PHIẾU THU THẬP THÔNG TIN SINH VIÊN');

-- --------------------------------------------------------

--
-- Table structure for table `lophocphan`
--

CREATE TABLE `lophocphan` (
  `MaLopHocPhan` int(11) NOT NULL,
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
  `ThoiGian` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `namhoc`
--

INSERT INTO `namhoc` (`MaNamHoc`, `ThoiGian`) VALUES
(1, '2020'),
(2, '2021'),
(3, '2022'),
(4, '2023');

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

--
-- Dumping data for table `nhomhocphan`
--

INSERT INTO `nhomhocphan` (`MaNhomHocPhan`, `TenNhomHocPhan`) VALUES
(1, '01'),
(2, '02'),
(3, '03'),
(4, '04');

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
-- Dumping data for table `tieuchidanhgia`
--

INSERT INTO `tieuchidanhgia` (`MaTieuChi`, `NoiDung`, `MaNhomTIeuChi`) VALUES
(1, 'GV có phương pháp truyền đạt rõ ràng dễ hiểu.', 1),
(2, 'GV có tác phong và cách cư xử chuẩn mực.', 1),
(3, 'GV đảm bảo giờ lên lớp đúng theo thời khóa biểu.', 1),
(4, 'GV giới thiệu đầy đủ giáo trình/bài giảng và các tài liệu tham khảo.', 1),
(5, ' GV giới thiệu đề cương chi tiết học phần với đầy đủ thông tin.', 1),
(6, 'GV nhiệt tình và có trách nhiệm trong giảng dạy.', 1),
(7, 'GV phối hợp hiệu quả các phương pháp giảng dạy.', 1),
(8, 'GV thường xuyên có sự liên hệ giữa lý thuyết và thực tiễn trong giảng dạy.', 1),
(9, 'GV thường xuyên kiểm tra kết quả tự học, tự nghiên cứu của SV.', 1),
(10, 'SV cảm thấy hứng thú trong giờ học.', 1),
(11, 'SV được GV tư vấn học tập ngoài giờ lên lớp (thông qua gặp gỡ hoặc email).', 1),
(12, 'SV được kiểm tra-đánh giá công bằng, đúng thực chất trong quá trình học.', 1),
(13, 'SV được kiểm tra-đánh giá theo đúng kế hoạch và nội dung đã công bố.', 1),
(14, 'SV được tạo nhiều cơ hội để chia sẻ ý kiến, quan điểm, hiểu biết.', 1),
(15, 'SV nhận được nhiều kiến thức, kỹ năng cần thiết từ học phần.', 1),
(16, 'Cảm nhận chung của anh/chị về học phần này.', 1),
(17, 'Giới tính.', 1),
(18, 'Tỷ lệ thời gian tham dự lớp học của anh/chị đối với HP này.', 1),
(19, 'Xếp loại học lực của anh/chị trong học kỳ vừa qua (nếu có).', 1);

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
  ADD PRIMARY KEY (`MaChiTietKhaoSatPhieu`),
  ADD KEY `fk_ChitietKhaoSatPhieu_PhieuKhaoSat` (`MaPhieuKhaoSat`),
  ADD KEY `fk_ChiTietKhaoSatPhieu_TieuChiDanhGia` (`MaTieuChiDanhGia`),
  ADD KEY `fk_ChitTietKhaoSatPhieu_MaHinhThucPhanLoai` (`MaHinhThucPhanLoai`);

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
  ADD PRIMARY KEY (`MaHinhThucPhanLoai`),
  ADD KEY `fk_HinhThucPhanLoai_TieuChiDanhGia` (`MaTieuChiDanhGia`);

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
  ADD KEY `fk_LopHocPhan_HocKy` (`MaHocKy`),
  ADD KEY `fk_lopHocPhan_GiaoVien` (`MaGiaoVien`);

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
  ADD KEY `fk_PhieuKhaoSat_LopHocPhan` (`MaLopHocPhan`),
  ADD KEY `fk_PhieuKhaoSat_LoaiPhieu` (`MaLoaiPhieu`),
  ADD KEY `fk_PhieuKhaoSat_HoatDongKhaoSat` (`MaHoatDongKhaoSat`);

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
  MODIFY `MaHinhThucPhanLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `hoatdongkhaosat`
--
ALTER TABLE `hoatdongkhaosat`
  MODIFY `MaHoatDong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hocky`
--
ALTER TABLE `hocky`
  MODIFY `MaHocKy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hocphan`
--
ALTER TABLE `hocphan`
  MODIFY `MaHocPhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `khoa`
--
ALTER TABLE `khoa`
  MODIFY `MaKhoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loaiphieu`
--
ALTER TABLE `loaiphieu`
  MODIFY `MaLoaiPhieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lophocphan`
--
ALTER TABLE `lophocphan`
  MODIFY `MaLopHocPhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `namhoc`
--
ALTER TABLE `namhoc`
  MODIFY `MaNamHoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhomhocphan`
--
ALTER TABLE `nhomhocphan`
  MODIFY `MaNhomHocPhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `MaTieuChi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bomon`
--
ALTER TABLE `bomon`
  ADD CONSTRAINT `fk_bomon_khoa` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`);

--
-- Constraints for table `chitietkhaosatphieu`
--
ALTER TABLE `chitietkhaosatphieu`
  ADD CONSTRAINT `fk_ChiTietKhaoSatPhieu_TieuChiDanhGia` FOREIGN KEY (`MaTieuChiDanhGia`) REFERENCES `tieuchidanhgia` (`MaTieuChi`),
  ADD CONSTRAINT `fk_ChitTietKhaoSatPhieu_MaHinhThucPhanLoai` FOREIGN KEY (`MaHinhThucPhanLoai`) REFERENCES `hinhthucphanloai` (`MaHinhThucPhanLoai`),
  ADD CONSTRAINT `fk_ChitietKhaoSatPhieu_PhieuKhaoSat` FOREIGN KEY (`MaPhieuKhaoSat`) REFERENCES `phieukhaosat` (`MaPhieuKhaoSat`);

--
-- Constraints for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `fk_giaovien_bomon` FOREIGN KEY (`MaBoMon`) REFERENCES `bomon` (`MaBoMon`),
  ADD CONSTRAINT `fk_giaovien_chucvu` FOREIGN KEY (`MaChucVu`) REFERENCES `chucvu` (`MaChucVu`);

--
-- Constraints for table `hinhthucphanloai`
--
ALTER TABLE `hinhthucphanloai`
  ADD CONSTRAINT `fk_HinhThucPhanLoai_TieuChiDanhGia` FOREIGN KEY (`MaTieuChiDanhGia`) REFERENCES `tieuchidanhgia` (`MaTieuChi`);

--
-- Constraints for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD CONSTRAINT `fk_LopHocPhan_HocKy` FOREIGN KEY (`MaHocKy`) REFERENCES `hocky` (`MaHocKy`),
  ADD CONSTRAINT `fk_LopHocPhan_HocPhan` FOREIGN KEY (`MaHocPhan`) REFERENCES `hocphan` (`MaHocPhan`),
  ADD CONSTRAINT `fk_LopHocPhan_NhomHocPhan` FOREIGN KEY (`MaNhomHocPhan`) REFERENCES `nhomhocphan` (`MaNhomHocPhan`),
  ADD CONSTRAINT `fk_lopHocPhan_GiaoVien` FOREIGN KEY (`MaGiaoVien`) REFERENCES `giaovien` (`MaGiaoVien`),
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
  ADD CONSTRAINT `fk_PhieuKhaoSat_HoatDongKhaoSat` FOREIGN KEY (`MaHoatDongKhaoSat`) REFERENCES `hoatdongkhaosat` (`MaHoatDong`),
  ADD CONSTRAINT `fk_PhieuKhaoSat_LoaiPhieu` FOREIGN KEY (`MaLoaiPhieu`) REFERENCES `loaiphieu` (`MaLoaiPhieu`),
  ADD CONSTRAINT `fk_PhieuKhaoSat_LopHocPhan` FOREIGN KEY (`MaLopHocPhan`) REFERENCES `lophocphan` (`MaLopHocPhan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
