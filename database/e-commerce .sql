-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 03:44 PM
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
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat_pengiriman`
--

CREATE TABLE `alamat_pengiriman` (
  `id_alamat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `no_hp` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alamat_pengiriman`
--

INSERT INTO `alamat_pengiriman` (`id_alamat`, `id_user`, `nama`, `no_hp`, `alamat`, `kode_pos`) VALUES
(1, 5, 'dila', '08364832', 'jl. sutomo no 4 kota padang', 738794);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_bank` varchar(250) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id_delivery` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `no_resi` varchar(250) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id_favourite` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`id_favourite`, `id_user`, `id_produk`) VALUES
(1, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Novel'),
(2, 'Komik'),
(4, 'Dongeng'),
(5, 'Biografi'),
(7, 'Pelajaran'),
(10, 'Cerita Pendek');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pembayaran`
--

CREATE TABLE `konfirmasi_pembayaran` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `bukti_bayar` varchar(250) NOT NULL,
  `keterangan` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `kurir` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_alamat` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `total_bayar` int(100) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'pesanan dikemas',
  `metode_pembayaran` varchar(250) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `id_alamat`, `id_produk`, `jumlah`, `total_bayar`, `status`, `metode_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 6, 2, 138000, 'pesanan dikemas', 'cash', '2024-06-19', '2024-06-19'),
(4, 1, 1, 6, 1, 69000, 'pesanan dikemas', 'cash', '2024-06-19', '2024-06-19'),
(7, 5, 1, 6, 1, 69000, 'pesanan dikemas', 'cash', '2024-06-19', '2024-06-19'),
(10, 1, 1, 6, 1, 69000, 'pesanan dikemas', 'cash', '2024-06-19', '2024-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(250) NOT NULL,
  `harga` varchar(250) NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` varchar(250) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga`, `stok`, `berat`, `keterangan`, `gambar`) VALUES
(6, 2, 'Ketika Cinta Bertasbih', '69000', 3, '1', 'Judul :Ketika Cinta Bertasbih Penulis :Habiburrahman El Shirazy Penerbit :Republika-Basmalah Tahun terbit : 2007 Dimensi :20,5 cm x 13,5 cm Tebal :477 halaman Harga :Rp69.000,00 Ilustrasi sampul :Disampul terdapat sebuah Masjid dan suasana langit Bermega merah.', 'gambar_1717256172.jpg'),
(7, 1, 'Singkat Saja, Terima Kasih.', '75000', 4, '1', 'Singkat Saja, Terima Kasih.\r\nPenulis : Elvania N\r\nUkuran : 14 x 21 cm\r\nTerbit : Juni 2021\r\nHarga : Rp 75000\r\nwww.guepedia.com\r\n\r\nSinopsis :\r\n\r\nBuku Singkat saja, Terima kasih. Buku ini menceritakan tentang tentang saya yang merasa bersyukur dan berterima kasih karena mempunyai sosok ayah yang tegas namun penyayang dan ibu yang baik dan lembut, membuatku seolah berada dalam satu ruang kebahagiaan yang utuh, berterima kasih juga kepada Illahi yang masih memberi kesempatan kepada diri untuk bisa berkumpul dengan orang-orang yang diri cintai. Hanya kata terima kasih, karena tidak ada kata yang bisa diungkapkan kepada Ibu dan Ayah selain kata terima kasih. Terima kasih telah menyayangi saya selama ini, mendidik saya sampai saya beranjak dewasa. Mungkin banyak sekali suka dan duka yang mewarnai setiap letihnya perjuangan kalian untuk membuat semua anak-anakmu bahagia dan mesa aman. Kasih sayang yang tak pernah padam, dari balik dua figur yang saling menggenggam lalu mengingatkan. Terima kasih karena selalu menjadi penguat dalam hidup saya, terima kasih selalu memberikan perhatian kepada saya dan terima kasih juga kepada orang-orang hebat yang selalu memberi pelajaran dari setiap letihnya pijakan kalian dibumi ini. Terima kasih “Selalu ada.”\r\n\r\nwww.guepedia.com\r\nEmail : guepedia@gmail.com\r\nWA di 081287602508\r\nHappy shopping & reading\r\nEnjoy your day, guys', 'gambar_1717296717.jpg'),
(8, 1, 'Doraemon', '1', 1, '1', '1', 'gambar_1717397770.jpg'),
(9, 2, 'Naruto', '8', 8, '8', '8', 'gambar_1717397897.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_hp` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `verified_code` int(11) NOT NULL,
  `is_verified` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `password_asli` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `fullname`, `jenis_kelamin`, `no_hp`, `alamat`, `email`, `role`, `verified_code`, `is_verified`, `password`, `password_asli`, `created`, `updated`) VALUES
(1, 'fizaa', 'ilfizaaa', '', '083562572', 'jl binatu 2', 'mutiaa@gmail.com', 'admin', 0, '', '6cbd862a6b6b03a025e8cbc47ece2f9e', 'LOvK8', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'bangpaik', 'Muhammad Fadli', 'L', '081277785227', 'Mungo', 'bangpaik1@gmail.com', 'admin', 0, '', 'a7c980f77c1d95b01a0bf08110354ccc', 'e96k1', '2024-05-29 09:05:43', NULL),
(5, 'mutia', 'ilfizaaa', '', '083562572', 'jl binatu 2', 'mutia@gmail.com', 'customers', 0, '', '25d55ad283aa400af464c76d713c07ad', '', '2024-06-07 10:02:52', '2024-06-07 10:02:52'),
(6, 'mut', 'ilfizaaa', 'P', '083562572', 'jl binatu 2', 'mut@gmail.com', 'customers', 0, '', '25d55ad283aa400af464c76d713c07ad', '', '2024-06-16 12:31:43', '2024-06-16 12:31:43'),
(7, 'tiaa', 'ilfizaaa', '', '083562572', 'jl binatu 2', 'ilfiza.mutiarahmi@gmail.com', 'customers', 3159, 'verified', '25d55ad283aa400af464c76d713c07ad', '', '2024-06-20 15:06:22', '2024-06-20 15:06:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat_pengiriman`
--
ALTER TABLE `alamat_pengiriman`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id_delivery`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id_favourite`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  ADD PRIMARY KEY (`id_konfirmasi`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_alamat` (`id_alamat`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat_pengiriman`
--
ALTER TABLE `alamat_pengiriman`
  MODIFY `id_alamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id_delivery` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id_favourite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat_pengiriman`
--
ALTER TABLE `alamat_pengiriman`
  ADD CONSTRAINT `alamat_pengiriman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  ADD CONSTRAINT `konfirmasi_pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_alamat`) REFERENCES `alamat_pengiriman` (`id_alamat`),
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
