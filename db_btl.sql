-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 03:23 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_btl`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MaChiTietDonHang` int(11) NOT NULL,
  `MaDonHang` int(11) NOT NULL,
  `MaSanPham` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `ThanhTien` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaChiTietDonHang`, `MaDonHang`, `MaSanPham`, `SoLuong`, `ThanhTien`) VALUES
(76, 85, 0, 2, 63800000),
(77, 86, 86, 1, 31900000),
(78, 86, 81, 1, 4400000),
(83, 88, 97, 1, 16890000),
(84, 88, 1, 1, 24000000),
(85, 88, 13, 1, 30900000),
(86, 89, 97, 1, 16890000),
(87, 90, 97, 1, 16890000),
(88, 91, 93, 1, 14990000),
(89, 91, 86, 1, 31900000),
(90, 92, 97, 1, 16890000),
(91, 92, 95, 1, 9889000),
(92, 93, 93, 1, 14990000),
(93, 93, 94, 1, 6990000),
(94, 94, 95, 1, 9889000),
(95, 94, 94, 1, 6990000),
(96, 95, 0, 3, 50670000),
(97, 96, 0, 3, 92700000),
(98, 96, 86, 1, 31900000),
(99, 96, 79, 1, 13900000),
(100, 96, 16, 1, 16900000),
(105, 100, 1, 2, 48000000),
(106, 100, 44, 1, 16600000),
(107, 101, 1, 1, 24000000),
(108, 102, 1, 1, 24000000),
(109, 103, 43, 1, 11890000),
(110, 103, 44, 1, 16600000),
(111, 105, 1, 1, 24000000),
(112, 106, 1, 1, 24000000),
(113, 107, 10, 1, 5590000),
(114, 109, 1, 1, 24000000),
(115, 109, 10, 1, 5590000),
(116, 109, 13, 1, 39000000),
(117, 110, 16, 1, 16900000),
(118, 110, 15, 1, 22900000),
(119, 111, 44, 1, 16600000),
(120, 111, 43, 1, 11890000),
(121, 112, 10, 1, 5590000),
(122, 112, 97, 1, 16890000),
(123, 112, 78, 1, 2190000),
(124, 113, 57, 1, 3790000),
(125, 113, 44, 2, 33200000),
(126, 113, 15, 1, 22900000),
(127, 114, 10, 1, 5590000),
(128, 115, 0, 3, 68700000),
(129, 116, 44, 1, 16600000),
(130, 116, 15, 1, 22900000),
(131, 117, 10, 1, 5590000),
(132, 118, 10, 1, 5590000),
(133, 119, 15, 1, 22900000),
(134, 119, 1, 1, 24000000),
(135, 119, 16, 1, 16900000),
(136, 119, 13, 1, 39000000),
(137, 120, 10, 1, 5590000);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `MaDonHang` int(11) NOT NULL,
  `thanhvien_id` int(11) NOT NULL,
  `TenKhachHang` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `NgayLap` datetime NOT NULL,
  `DiaChiGiaoHang` varchar(255) NOT NULL,
  `TongTien` int(20) NOT NULL,
  `TinhTrang` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`MaDonHang`, `thanhvien_id`, `TenKhachHang`, `Email`, `Phone`, `NgayLap`, `DiaChiGiaoHang`, `TongTien`, `TinhTrang`) VALUES
(120, 0, 'Phan Đình Trung', 'pdt@gmail.com', '0123456789', '2022-03-16 20:40:19', 'Hà Nội', 5590000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MaLoaiSP` int(11) NOT NULL,
  `TenLoaiSP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`MaLoaiSP`, `TenLoaiSP`) VALUES
(1, 'Ti Vi, Loa - Âm thanh'),
(2, 'Tủ Lạnh, Tủ Đông, Tủ Mát'),
(3, 'Máy Giặt, Máy Sấy Quần Áo'),
(4, 'Điều Hòa Nhiệt Độ'),
(5, 'Lò Vi Sóng'),
(7, 'Bình Tắm Nóng Lạnh');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSanPham` int(11) NOT NULL,
  `MaLoaiSP` int(11) NOT NULL,
  `HinhAnh` text NOT NULL,
  `TenSanPham` varchar(255) NOT NULL,
  `MoTa` text NOT NULL,
  `SoLuongSP` int(11) NOT NULL,
  `GiaSanPham` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSanPham`, `MaLoaiSP`, `HinhAnh`, `TenSanPham`, `MoTa`, `SoLuongSP`, `GiaSanPham`) VALUES
(1, 1, 'https://cdn.mediamart.vn/images/product/smart-tivi-samsung-4k-55-inch-55au9000-crystal-uhd-JyY5Qd.jpg', 'Smart Tivi Samsung 4K 55 inch', 'Thương hiệu: Samsung/Kích thước màn hình: 55 inch/Độ phân giải: 4K Ultra HD (3840 x 2160px)/Bluetooth: Có/Kết nối Internet: Wifi, Cổng LAN/Cổng AV: Cổng Composite/Cổng HDMI: 3 cổng/Cổng USB: 2 cổng', 50, 24000000),
(10, 2, 'https://cdn.mediamart.vn/thumb/images/product/-q4I5dm.jpg', 'Tủ đông 100L Sanaky', 'Dung tích: Dưới 300 lít/Dung tích thực: 100 lít/Số cửa: 1 cửa/Số ngăn: 1 ngăn/Loại Gas: R600a/Kích thước (DXRXC) mm: 615 x 620 x 845', 11, 5590000),
(13, 2, 'https://cdn.mediamart.vn/thumb/images/product/-cwVNea.png', 'Tủ lạnh 4 cánh Sharp 626 Lít', 'Thương hiệu: Sharp/Mã sản phẩm: SJ-FX630V-ST/Tổng dung tích:	626 Lít/Tổng dung tích sử dụng:	556 lít/Số người sử dụng thích hợp: Trên 7 người (Trên 350 lít)/Dung tích ngăn đông + ngăn đá: 211 lít/Dung tích ngăn lạnh: 345 lít/Kiểu tủ lạnh: Ngăn đá dưới/Chất liệu khay Tủ lạnh: Khay kính', 10, 39000000),
(14, 1, 'https://cdn.mediamart.vn/thumb/images/product/-JB3U35.jpg', 'Smart Tivi 4K Sony 50 inch 4K HDR Android TV', 'Thương hiệu: Sony/Kích thước màn hình: 50 inch/Độ phân giải: 4K Ultra HD (3840 x 2160px)/Bluetooth: Có/Kết nối Internet: Wifi, Cổng LAN/Cổng AV: Cổng Composite/Cổng HDMI: 3 cổng/Cổng USB2: 2 cổng', 27, 16400000),
(15, 1, 'https://cdn.mediamart.vn/thumb/images/product/-Jlp9I9.jpg', 'Smart Tivi 4K LG 55 inch NanoCell HDR ThinQ AI', 'Thương hiệu: LG/Kích thước màn hình: 50 inch/Độ phân giải: 4K Ultra HD (3840 x 2160px)/Bluetooth: Có/Kết nối Internet: Wifi, Cổng LAN/Cổng AV: Cổng Component, Cổng Composite/Cổng HDMI: 3 cổng/Cổng USB2: 2 cổng', 30, 22900000),
(16, 1, 'https://cdn.mediamart.vn/thumb/images/product/smart-tivi-lg-4k-50-inch-50up7550ptc-thinq-ai-k1S78V.jpg', 'Smart Tivi LG 4K 50 inch ThinQ AI', 'Thương hiệu: LG/Kích thước màn hình: 50 inch/Độ phân giải: 4K Ultra HD (3840 x 2160px)/Bluetooth: Có/Kết nối Internet: Wifi, Cổng LAN/Cổng AV: Cổng Composite/Cổng HDMI: 2 cổng/Cổng USB: 1 cổng', 19, 16900000),
(43, 2, 'https://cdn.mediamart.vn/thumb/images/product/-3b07y5.png', 'Tủ lạnh Samsung Inverter 300L', 'Thương hiệu: Samsung/Tổng dung tích: 308 lít/Tổng dung tích sử dụng: 300 Lít/Số người sử dụng thích hợp: 5-7 người (250-350 lít)/Dung tích ngăn đông + ngăn đá: 72 lít/Dung tích ngăn lạnh: 228 lít/Kiểu tủ lạnh: Ngăn đá trên/Chất liệu khay Tủ lạnh: Khay kính', 34, 11890000),
(44, 3, 'https://cdn.mediamart.vn/thumb/images/product/may-giat-long-ngang-samsung-inverter-10kg-ww10ta046aesv-LGu7v8.png', 'Máy giặt lồng ngang Samsung Inverter 10Kg', 'Thương hiệu: Samsung/Kiểu máy giặt: Cửa ngang/Kiểu lồng giặt: Lồng ngang/Khối lượng giặt: 10Kg/Tốc độ quay vắt (vòngphút): 1400 vòngphút/Truyền động: Bằng dây Curoa/Công nghệ giặt: Eco Buble/Thiết kế lồng giặt: Lồng giặt kim cương/Tính năng: Giặt bằng nước nóng, Chức năng giặt hơi nước, Tiết kiệm nước, Hẹn giờ, Khóa trẻ em, Tự động vệ sinh lồng giặt , Vệ sinh lồng giặt, Giặt nước nóng/Số người sử dụng: trên 6 người (trên 8.5 Kg)', 10, 16600000),
(57, 7, 'https://cdn.mediamart.vn/thumb/images/product/-1FF8e7.png', 'Bình nóng lạnh gián tiếp Roler 20L', 'Thương hiệu: ROLER/Loại Bình nóng lạnh: Gián tiếp/Chủng loại: Cơ/Dung tích chính xác: 20 lít/Công suất (W): 2500(W)/Hệ thống an toàn: Vỏ chống thấm nước IPX1, Hệ thống an toàn đồng bộ TSS/Chất liệu thanh đốt: Thanh đốt bằng đồng/Đặc điểm nổi bật: Lòng bình được tráng lớp men TITAN ngăn chặn nước ăn mòn và gây rò rỉ bên trong bình chứa, Công nghệ ion bạc kháng khuẩn làm sạch nước, Đèn báo đang đun nước và đèn báo nước đã sẵn sàng dùng/Kích thước: 633 x 315 x 318 (mm)/Khối lượng: 11.50 kg', 10, 3790000),
(74, 0, 'https://cdn.mediamart.vn/thumb/images/product/may-loc-nuoc-ro-8-cap-coex-wp7114-SfXy45.png', 'Máy Lọc Nước RO 8 cấp Coex', '', 23, 5260000),
(78, 5, 'https://cdn.mediamart.vn/thumb/images/product/-PzHIiD.png', 'Lò vi sóng cơ 20L Roler', 'Lò Vi Sóng', 16, 2190000),
(79, 0, 'https://cdn.mediamart.vn/thumb/images/product/may-rua-bat-bosch-sms63l02ea-0tVfJ3.jpg', 'Máy rửa bát Bosch', '', 5, 19900000),
(80, 5, 'https://cdn.mediamart.vn/thumb/images/product/lo-vi-song-co-electrolux-23l-emm23k18gw-ni6WAB.png', 'Lò vi sóng cơ Electrolux 23L', '', 21, 2590000),
(81, 7, 'https://cdn.mediamart.vn/thumb/images/product/-P2HwZg.png', 'Bình nóng lạnh 20L Ariston', 'Thương hiệu: Ariston/Loại Bình nóng lạnh: Gián tiếp/Dung tích chính xác: 20 lít/Công suất (W): 2500(W)/Hệ thống an toàn: ELCB/Nhiệt độ tối đa: 80 độ/Đặc điểm nổi bật: Lòng bình tráng Titanium chống rò rỉ nước/Kích thước: 704 x 301 x 282 mm ( DxRxC)', 11, 4400000),
(86, 1, 'https://cdn.mediamart.vn/thumb/images/product/qled-tivi-4k-samsung-55q60a-55-inch-smart-tv-dHQvDl.jpg', 'QLED Tivi 4K Samsung 55 inch Smart TV', 'Thương hiệu: Samsung/Kích thước màn hình: 55 inch/Độ phân giải: 4K Ultra HD (3840 x 2160px)/Bluetooth: Có/Kết nối Internet: Wifi, Cổng LAN/Cổng AV: Cổng Component, Cổng Composite/Cổng HDMI: 3 cổng/Cổng USB: 2 cổng', 26, 31900000),
(93, 3, 'https://cdn.mediamart.vn/thumb/images/product/may-giat-long-ngang-lg-inverter-9kg-fv1409s3w-92eu81.png', 'Máy giặt lồng ngang thông minh LG AI DD 9kg', 'Thương hiệu: LG/Kiểu máy giặt:Cửa ngang/Kiểu lồng giặt:Lồng ngang/Khối lượng giặt: 9Kg/Tốc độ quay vắt (vòng phút): 1400 vòngphút/Truyền động: Chuyển động DD/Bảng điều khiển: Tiếng Việt/Chế độ giặt: 14 chương trình giặt/Công nghệ giặt: AI Direct Drive: Tự động tối ưu hóa chuyển động giặt qua cảm biến tự động xác định chất liệu đồ giặt/Tính năng: Chức năng giặt hơi nước, Tiết kiệm nước, Tiết kiệm điện, Khóa trẻ em, Tự động vệ sinh lồng giặt , Vệ sinh lồng giặt, Công nghệ thông minh Smart ThinQ, Kết nối Wifi, Lồng giặt lớn, Máy chạy êm & bền', 22, 14990000),
(94, 4, 'https://cdn.mediamart.vn/thumb/images/product/dieu-hoa-midea-1-chieu-9000btu-msma310crn1-291nZR.png', 'Điều hòa Midea 1 chiều 9.000BTU', 'Thương hiệu: Midea/Mã sản phẩm: MSMA3-10CRN1/Loại máy: Điều hòa một chiều/Kiểu máy: Treo tường/Công suất: 9000 BTU/Tấm lọc: Màng lọc bụi/Chế độ lọc: Kháng bụi/Công nghệ làm lạnh nhanh: Super Cool /Tính năng: Thổi gió dễ chịu (cho trẻ em, người già), Làm lạnh nhanh tức thì, Chức năng làm sạch/Sử dụng ga: R410A', 30, 6990000),
(95, 4, 'https://cdn.mediamart.vn/thumb/images/product/-z0u0F6.jpg', 'Điều hòa Sharp 1 chiều Inverter 9000BTU', 'Thương hiệu: Sharp/Loại máy: Điều hòa một chiều/Kiểu máy: Treo tường/Tính năng nổi bật: Công nghệ Inverter/Công suất: 9000 BTU/Tấm lọc: Polypropylene/Chế độ lọc: Kháng bụi/Công nghệ làm lạnh nhanh: Powerful Jet/Tính năng: Thổi gió dễ chịu (cho trẻ em, người già), Tự khởi động lại khi có điện, Hẹn giờ bật tắt máy, Làm lạnh nhanh tức thì/Sử dụng ga: R32', 35, 9889000),
(97, 2, 'https://cdn.mediamart.vn/thumb/images/product/-FZYft8.png', 'Tủ lạnh Samsung 380 Lít, Inverter, 2 dàn lạnh độc lập', 'Thương hiệu: Samsung/Tổng dung tích: 394 lít/Tổng dung tích sử dụng: 380 lít/Số người sử dụng thích hợp: Trên 7 người (Trên 350 lít)/Dung tích ngăn đông + ngăn đá: 86 lít/Dung tích ngăn lạnh: 294 Lít/Kiểu tủ lạnh: Ngăn đá trên/Chất liệu khay Tủ lạnh: Khay kính', 15, 16890000),
(99, 1, 'https://cdn.mediamart.vn/thumb/images/product/-9rR3LP.png', 'Ti vi', 'Ti vi Sony', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `thanhvien`
--

CREATE TABLE `thanhvien` (
  `thanhvien_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `DateJoined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thanhvien`
--

INSERT INTO `thanhvien` (`thanhvien_id`, `username`, `email`, `phone`, `password`, `level`, `DateJoined`) VALUES
(1, 'admin', '', '', 'admin', 1, '2021-11-09'),
(2, 'canhan', 'canhan@gmail.com', '0123456789', 'canhan', 0, '0000-00-00'),
(6, 'abcxyz', '', '', 'abcxyz', 0, '0000-00-00'),
(76, 'test123', 'test@gmail.com', '0123456789', 'test123', 0, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MaChiTietDonHang`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `fk_dh_mnv` (`thanhvien_id`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`MaLoaiSP`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSanPham`);

--
-- Indexes for table `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`thanhvien_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `MaChiTietDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `MaLoaiSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSanPham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `thanhvien`
--
ALTER TABLE `thanhvien`
  MODIFY `thanhvien_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
