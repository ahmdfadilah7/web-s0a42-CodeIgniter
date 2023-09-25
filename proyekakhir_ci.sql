-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 04:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyekakhir_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `judul`, `deskripsi`, `gambar`) VALUES
(1, 'About 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure', 'assets/images/about-1691857040-813.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` int(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_alumni` varchar(100) NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `angkatan` int(4) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `status` varchar(50) NOT NULL,
  `c1` varchar(225) DEFAULT NULL,
  `c2` varchar(225) DEFAULT NULL,
  `c3` varchar(225) DEFAULT NULL,
  `c4` varchar(225) DEFAULT NULL,
  `c5` varchar(225) DEFAULT NULL,
  `c6` varchar(225) DEFAULT NULL,
  `c7` varchar(225) DEFAULT NULL,
  `c8` varchar(225) DEFAULT NULL,
  `c9` varchar(225) DEFAULT NULL,
  `c10` varchar(225) DEFAULT NULL,
  `c11` varchar(225) DEFAULT NULL,
  `c12` varchar(225) DEFAULT NULL,
  `c13` varchar(225) DEFAULT NULL,
  `c14` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `id_user`, `nama_alumni`, `nisn`, `jk`, `id_jurusan`, `angkatan`, `tahun_lulus`, `status`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `c8`, `c9`, `c10`, `c11`, `c12`, `c13`, `c14`) VALUES
(19, 3, ' Adriyan Fata Fitrah', '0032514983', 'Laki-Laki', 4, 2020, 2022, 'Tidak/Belum Bekerja', 'Bengkulu', '3 Jt', 'Programmer', 'Banten', 'Banten', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 2, 'Muhammad Bintang', '0034306196', 'Laki-Laki', 2, 2019, 2024, 'Bekerja', 'Kantor Kejaksaan', '2 Jt - 3 Jt', 'Programmer', 'Banda Aceh', 'Aceh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 4, 'Muhammad Faiz Putra', '0033650412', 'Laki-Laki', 2, 2017, 2023, 'Kuliah Sambil Bekerja', 'Kantor Kejaksaan', '3 Jt', 'Programmer', 'Univ. Kepulauan Riau', 'Sistem Informasi', 'Kepulauan Riau', 'Kepulauan Riau', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 6, 'Adolf Alfa', '0010388415', 'Laki-Laki', 2, 2017, 2024, 'Tidak/Belum Bekerja', 'Jambi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_posting` date NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `deskripsi`, `tanggal_posting`, `gambar`) VALUES
(6, 'Test 1', '<p>Berhasil 1</p>\r\n', '2023-08-13', 'assets/images/Berita-1691845884-342.jpg'),
(7, 'Test 2', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n', '2023-07-13', 'assets/images/Berita-1691917537-775.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(2, 'TEKNIK KOMPUTER'),
(4, 'TEKNIK INFORMATIKA');

-- --------------------------------------------------------

--
-- Table structure for table `kusioner`
--

CREATE TABLE `kusioner` (
  `id` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `urutan` int(11) NOT NULL,
  `kusioner` varchar(250) NOT NULL,
  `tag_input` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kusioner`
--

INSERT INTO `kusioner` (`id`, `status`, `urutan`, `kusioner`, `tag_input`) VALUES
(1, 'Bekerja', 1, 'Tempat Bekerja', 'input'),
(2, 'Bekerja', 2, 'Gaji', 'select-gaji'),
(3, 'Bekerja', 3, 'Jabatan', 'input'),
(4, 'Bekerja', 4, 'Kota', 'input'),
(5, 'Bekerja', 5, 'Provinsi', 'input'),
(6, 'Kuliah', 1, 'Universitas', 'input'),
(7, 'Kuliah', 2, 'Jurusan Kuliah', 'input'),
(8, 'Kuliah', 3, 'Kota', 'input'),
(9, 'Kuliah', 4, 'Provinsi', 'input'),
(10, 'Kuliah Sambil Bekerja', 1, 'Tempat Bekerja', 'input'),
(11, 'Kuliah Sambil Bekerja', 2, 'Gaji', 'input'),
(12, 'Kuliah Sambil Bekerja', 3, 'Jabatan', 'input'),
(13, 'Kuliah Sambil Bekerja', 4, 'Universitas', 'input'),
(14, 'Kuliah Sambil Bekerja', 5, 'Jurusan Kuliah', 'input'),
(15, 'Kuliah Sambil Bekerja', 6, 'Kota', 'input'),
(16, 'Kuliah Sambil Bekerja', 7, 'Provinsi', 'input'),
(17, 'Tidak/Belum Bekerja', 1, 'Provinsi', 'input');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(11) NOT NULL,
  `nama_provinsi` varchar(35) DEFAULT NULL,
  `lat` varchar(10) DEFAULT NULL,
  `long` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama_provinsi`, `lat`, `long`) VALUES
(2, 'Provinsi Aceh', '4.695135', '96.7493993'),
(3, 'Provinsi Sumatera Utara', '2.1153547', '99.5450974'),
(4, 'Provinsi Sumatera Barat', '-0.7399397', '100.800005'),
(5, 'Provinsi Riau', '0.2933469', '101.706829'),
(6, 'Provinsi Jambi', '-1.4851831', '102.438058'),
(7, 'Provinsi Sumatera Selatan', '-3.3194374', '103.914399'),
(8, 'Provinsi Bengkulu', '-3.5778471', '102.346387'),
(9, 'Provinsi Lampung', '-4.5585849', '105.406807'),
(10, 'Provinsi Kepulauan Bangka Belitung', '-2.7410513', '106.440587'),
(11, 'Provinsi Kepulauan Riau', '3.9456514', '108.142866'),
(12, 'Provinsi DKI Jakarta', '-6.211544', '106.845172'),
(13, 'Provinsi Jawa Barat', '-7.090911', '107.668887'),
(14, 'Provinsi Jawa Tengah', '-7.150975', '110.140259'),
(15, 'Provinsi DI Yogyakarta', '-7.8753849', '110.426208'),
(16, 'Provinsi Jawa Timur', '-7.5360639', '112.238401'),
(17, 'Provinsi Banten', '-6.4058172', '106.064017'),
(18, 'Provinsi Bali', '-8.4095178', '115.188916'),
(19, 'Provinsi Nusa Tenggara Barat', '-8.6529334', '117.361647'),
(20, 'Provinsi Nusa Tenggara Timur', '-8.6573819', '121.079370'),
(21, 'Provinsi Kalimantan Barat', '-0.2787808', '111.475285'),
(22, 'Provinsi Kalimantan Tengah', '-1.6814878', '113.382354'),
(23, 'Provinsi Kalimantan Selatan', '-3.0926415', '115.283758'),
(24, 'Provinsi Kalimantan Timur', '1.6406296', '116.419389'),
(25, 'Provinsi Sulawesi Utara', '0.6246932', '123.975001'),
(26, 'Provinsi Sulawesi Tengah', '-1.4300254', '121.445617'),
(27, 'Provinsi Sulawesi Selatan', '-3.6687994', '119.974053'),
(28, 'Provinsi Sulawesi Tenggara', '-4.14491', '122.174605'),
(29, 'Provinsi Gorontalo', '0.6999372', '122.446723'),
(30, 'Provinsi Sulawesi Barat', '-2.8441371', '119.232078'),
(31, 'Provinsi Maluku', '-3.2384616', '130.145273'),
(32, 'Provinsi Maluku Utara', '1.5709993', '127.808769'),
(33, 'Provinsi Papua Barat', '-1.3361154', '133.174716'),
(34, 'Provinsi Papua', '-4.269928', '138.080352');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Humas'),
(2, 'Alumni'),
(3, 'Kepala Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `nama_website` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `no_telp` varchar(250) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `nama_website`, `alamat`, `email`, `no_telp`, `logo`, `favicon`) VALUES
(1, 'Tracer Study', '<p>Alamat 2</p>\r\n', 'tracerstudy@example.com', '08123123123', 'assets/images/Logo-1691921132-605.png', 'assets/images/Favicon-1691921139-683.png');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `judul`, `deskripsi`, `gambar`) VALUES
(1, 'The Best Learning 1', '<p>Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>\r\n', 'assets/images/Slider-1691856530-768.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `taginput`
--

CREATE TABLE `taginput` (
  `id` int(11) NOT NULL,
  `tag_input` varchar(250) NOT NULL,
  `isi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taginput`
--

INSERT INTO `taginput` (`id`, `tag_input`, `isi`) VALUES
(1, 'select-gaji', '1 Jt - 2 jt'),
(2, 'select-gaji', '2 Jt - 3 Jt'),
(3, 'radio', 'Ya'),
(4, 'radio', 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `foto`, `username`, `password`, `role`) VALUES
(1, 'Admin', 'assets/images/User-1691921170-667.png', 'admin', '$2y$10$mdiof/fEa811KOySQuHLKOEunhAHZo0RbVlvkp./EZN8anJgfVyIm', 'admin'),
(2, 'MUHAMMAD BINTANG', NULL, '0034306196', '$2y$10$IsBzoaZcZqumJ4ieiu2uS.hrPbDEziuvKe6uZE5ntO8VsPNXwHwQO', 'alumni'),
(3, 'Adriyan Fata Fitrah', NULL, '0032514983', '$2y$10$D9yOCuWy/mRhoLzXqjMDMO7uBGUwXaVjd9LkL3PDGZyWMaRGuQx.i', 'alumni'),
(4, 'Muhammad Faiz Putra', NULL, '0033650412', '$2y$10$kNaG7v/Lo23iA1I0WRjxs.o57tEcKedARwSDu8ZEzxRTlwFYZHr9G', 'alumni'),
(5, 'Aji Sahap', NULL, '0019696179', '$2y$10$8MFOjiI10AGwWf8HyjG6MeNBe.eI5IJuLlIMEuPOiuwz1/go4bxDG', 'alumni'),
(6, 'ADOLF ALFA SAHPUTRA HARAHAP', NULL, '0010388415', '$2y$10$eMh2qaduhoC8cv2QSnBlhONycy2UGOiFU11ehnPBKZ5djm31Bj.Hu', 'alumni'),
(7, 'Habib Arifin', NULL, '0020699203', '$2y$10$RPwAIZwj1t1NtDlZvh0MHufcG.auN6g/nPR/8uAaMmBY3JxNmfxIy', 'alumni'),
(8, 'Jefri Simanjuntak', NULL, '0016402902', '$2y$10$rXzj8nKEOS1DzR2.Ww6Ai.am84rSqx0pFMKQFclSWmx31sjdRTkvK', 'alumni'),
(9, 'M. Dika Laksmana', NULL, '0039771555', '$2y$10$weJYKz95NJIaq7o.ibdZ9O1UwpHWP14Gen97dV/bYyVy41.IO1r92', 'alumni'),
(11, 'Randi Andika', NULL, '0018699258', '$2y$10$EsHcxHn8Nig4vIXpLOIhreBsAtmFx/29t.yqTMwvbipWi.fMZAnpW', 'alumni'),
(12, 'Bernando Sinaga', NULL, '0027946258', '$2y$10$15oSCmZVSNu4bOP3wRBxJeSA/GgUscPeHwyQOsXbEDDerwvZysq16', 'alumni'),
(13, 'Doni Hermanto', NULL, '0032495095', '$2y$10$wUSbW1IGWN5vWeZqI/XxWOD0DMMnuoih23DWdgQOTpkLDr4nnSpiq', 'alumni'),
(14, 'Balian Martin', NULL, '0015254291', '$2y$10$VQbDlsL0Yay3p5XUO.OP9OUJCWooS/W4BNKtajyxu9qNOROTGxXbW', 'alumni'),
(15, 'M. Haikal Fiqri Harahap', NULL, '0031069703', '$2y$10$vJ8I1d93aI6MdbJsM6L9wOeJzPH0KQuKRX3LGuMjTV86qjBhXJzi.', 'alumni'),
(16, 'Muhammad Rozi', NULL, '0015476959', '$2y$10$NsejM8G8id8hE8jYJUqLF.Y6AVnJbWqfWA5MO5VOj2LLhyrvH2vrC', 'alumni'),
(17, 'Wahyu Adi Sanjaya', NULL, '0033993608', '$2y$10$9Aas3OVNUqIWvFHF6Xai5OkLqqwS74IRYqDNKF7wDjbp77yyyUIii', 'alumni');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jurusan` (`id_jurusan`) USING BTREE;

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kusioner`
--
ALTER TABLE `kusioner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taginput`
--
ALTER TABLE `taginput`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kusioner`
--
ALTER TABLE `kusioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=545;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taginput`
--
ALTER TABLE `taginput`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `id_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
