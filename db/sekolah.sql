-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 03:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupchat`
--

CREATE TABLE `groupchat` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbguru`
--

CREATE TABLE `tbguru` (
  `id_user` varchar(20) NOT NULL,
  `nm_guru` varchar(100) NOT NULL,
  `masuk_tahun` int(20) NOT NULL,
  `keluar_tahun` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbguru`
--

INSERT INTO `tbguru` (`id_user`, `nm_guru`, `masuk_tahun`, `keluar_tahun`) VALUES
('1234', 'Edward Hartantod', 2007, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbjawab_kuis`
--

CREATE TABLE `tbjawab_kuis` (
  `id_kuis` varchar(200) NOT NULL,
  `id_user` varchar(200) NOT NULL,
  `jawaban` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`jawaban`)),
  `status` varchar(50) NOT NULL,
  `nilai` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbkelas`
--

CREATE TABLE `tbkelas` (
  `id_kelas` int(225) NOT NULL,
  `nm_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkelas`
--

INSERT INTO `tbkelas` (`id_kelas`, `nm_kelas`) VALUES
(15, 'XIII TKJ');

-- --------------------------------------------------------

--
-- Table structure for table `tbkuis`
--

CREATE TABLE `tbkuis` (
  `id_kuis` int(225) NOT NULL,
  `id_mapel_dtl` int(225) NOT NULL,
  `nm_kuis` varchar(50) NOT NULL,
  `mulai` varchar(50) NOT NULL,
  `selesai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkuis`
--

INSERT INTO `tbkuis` (`id_kuis`, `id_mapel_dtl`, `nm_kuis`, `mulai`, `selesai`) VALUES
(2, 2, 'UTS 1', '2024-08-29 06:25', '2024-08-29 23:02'),
(3, 1, 'UTS 1', '2024-08-29 06:40', '2024-08-29 23:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbkuisdtl`
--

CREATE TABLE `tbkuisdtl` (
  `id_kuis` int(225) NOT NULL,
  `no` int(100) NOT NULL,
  `soal` varchar(225) NOT NULL,
  `a` varchar(100) NOT NULL,
  `b` varchar(100) NOT NULL,
  `c` varchar(100) NOT NULL,
  `d` varchar(100) NOT NULL,
  `kunci` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkuisdtl`
--

INSERT INTO `tbkuisdtl` (`id_kuis`, `no`, `soal`, `a`, `b`, `c`, `d`, `kunci`) VALUES
(1, 1, '1', '1', '1', '1', '1', 'A'),
(2, 1, '1', '1', '1', '1', '1', 'B'),
(3, 1, '1', '1', '1', '1', '1', 'A'),
(3, 2, '2', '2', '2', '2', '2', 'B'),
(3, 3, '3', '3', '3', '3', '3', 'C'),
(3, 4, '4', '4', '4', '4', '4', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `tbkuisjawab`
--

CREATE TABLE `tbkuisjawab` (
  `id_kuis` int(225) NOT NULL,
  `id_siswa` int(225) NOT NULL,
  `nilai` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbmapel`
--

CREATE TABLE `tbmapel` (
  `id_mapel` int(225) NOT NULL,
  `nm_mapel` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmapel`
--

INSERT INTO `tbmapel` (`id_mapel`, `nm_mapel`, `tahun_ajaran`) VALUES
(1, 'Matematika3', '2020.1'),
(2, 'Fisika', '2024.1'),
(3, 'Kimia', '2024.1'),
(4, 'Biologi', '2024.1'),
(5, 'Pendidikan Kewarganegaraan (PKN)', '2024.1'),
(6, 'Bahasa Indonesia', '2024.1'),
(7, 'Bahasa Inggris', '2024.1'),
(8, 'Ekonomi', '2024.1'),
(9, 'Geografi', '2024.1'),
(10, 'Sosiologi', '2024.1'),
(11, 'Sejarah', '2024.1'),
(12, 'Seni Budaya', '2024.1'),
(13, 'Pendidikan Jasmani', '2024.1'),
(14, 'Matematika', '2024.2'),
(15, 'Fisika', '2024.2'),
(16, 'Kimia', '2024.2'),
(17, 'Biologi', '2024.2'),
(18, 'Pendidikan Kewarganegaraan (PKN)', '2024.2'),
(19, 'Bahasa Indonesia', '2024.2'),
(20, 'Bahasa Inggris', '2024.2'),
(21, 'Ekonomi', '2024.2'),
(22, 'Geografi', '2024.2'),
(23, 'Sosiologi', '2024.2'),
(24, 'Sejarah', '2024.2'),
(25, 'Seni Budaya', '2024.2'),
(26, 'Pendidikan Jasmani', '2024.2'),
(27, 'Matematika', '2023.1'),
(28, 'Fisika', '2023.1'),
(29, 'Kimia', '2023.1'),
(30, 'Biologi', '2023.1'),
(31, 'Pendidikan Kewarganegaraan (PKN)', '2023.1'),
(32, 'Bahasa Indonesia', '2023.1'),
(33, 'Bahasa Inggris', '2023.1'),
(34, 'Ekonomi', '2023.1'),
(35, 'Geografi', '2023.1'),
(36, 'Sosiologi', '2023.1'),
(37, 'Sejarah', '2023.1'),
(38, 'Seni Budaya', '2023.1'),
(39, 'Pendidikan Jasmani', '2023.1'),
(40, 'Matematika', '2023.2'),
(41, 'Fisika', '2023.2'),
(42, 'Kimia', '2023.2'),
(43, 'Biologi', '2023.2'),
(44, 'Pendidikan Kewarganegaraan (PKN)', '2023.2'),
(45, 'Bahasa Indonesia', '2023.2'),
(46, 'Bahasa Inggris', '2020.1'),
(47, 'Ekonomi', '2023.2'),
(48, 'Geografi', '2023.2'),
(49, 'Sosiologi', '2023.2'),
(50, 'Sejarah', '2023.2'),
(51, 'Seni Budaya', '2023.2'),
(52, 'Pendidikan Jasmani', '2023.2'),
(53, 'Matematika', '2022.1'),
(54, 'Fisika', '2022.1'),
(55, 'Kimia', '2022.1'),
(56, 'Biologi', '2022.1'),
(57, 'Pendidikan Kewarganegaraan (PKN)', '2022.1'),
(58, 'Bahasa Indonesia', '2022.1'),
(59, 'Bahasa Inggris', '2022.1'),
(60, 'Ekonomi', '2022.1'),
(61, 'Geografi', '2022.1'),
(62, 'Sosiologi', '2022.1'),
(63, 'Sejarah', '2022.1'),
(64, 'Seni Budaya', '2022.1'),
(65, 'Pendidikan Jasmani', '2022.1'),
(66, 'Matematika', '2022.2'),
(67, 'Fisika', '2022.2'),
(68, 'Kimia', '2022.2'),
(69, 'Biologi', '2022.2'),
(70, 'Pendidikan Kewarganegaraan (PKN)', '2022.2'),
(71, 'Bahasa Indonesia', '2022.2'),
(72, 'Bahasa Inggris', '2022.2'),
(73, 'Ekonomi', '2022.2'),
(74, 'Geografi', '2022.2'),
(75, 'Sosiologi', '2022.2'),
(76, 'Sejarah', '2022.2'),
(77, 'Seni Budaya', '2022.2'),
(78, 'Pendidikan Jasmani', '2022.2'),
(79, 'Programming++', '2025.1');

-- --------------------------------------------------------

--
-- Table structure for table `tbmapeldtl`
--

CREATE TABLE `tbmapeldtl` (
  `id_mapel_dtl` int(225) NOT NULL,
  `id_guru` int(200) NOT NULL,
  `id_mapel` int(225) NOT NULL,
  `id_kelas` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmapeldtl`
--

INSERT INTO `tbmapeldtl` (`id_mapel_dtl`, `id_guru`, `id_mapel`, `id_kelas`) VALUES
(1, 123, 2, 1),
(2, 123, 1, 1),
(3, 123, 3, 3),
(4, 5, 26, 5),
(5, 32451, 19, 6),
(6, 1234, 79, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbmateri`
--

CREATE TABLE `tbmateri` (
  `id_materi` int(225) NOT NULL,
  `id_mapel_dtl` int(225) NOT NULL,
  `no` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmateri`
--

INSERT INTO `tbmateri` (`id_materi`, `id_mapel_dtl`, `no`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbmateridtl`
--

CREATE TABLE `tbmateridtl` (
  `id_materidtl` int(225) NOT NULL,
  `id_materi` int(225) NOT NULL,
  `nm_materi` varchar(50) NOT NULL,
  `dtl_materi` varchar(50) NOT NULL,
  `dokumen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbmateridtl`
--

INSERT INTO `tbmateridtl` (`id_materidtl`, `id_materi`, `nm_materi`, `dtl_materi`, `dokumen`) VALUES
(1, 1, 'Pengenalan 1', 'Pengenalan 1', 'http://localhost/sekolah/assets/materi/1723686578.pdf'),
(2, 2, 'Pengenalan 2', 'Pengenalan 2', 'http://localhost/sekolah/assets/materi/1723764498.pdf'),
(3, 3, 'hrdrhs', 'sgfs', 'http://localhost/sekolah/assets/materi/1732793192.pdf'),
(4, 4, 'konsep awal', 'gsfadhsfhs', 'http://localhost/sekolah/assets/materi/1732795274.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbsiswa`
--

CREATE TABLE `tbsiswa` (
  `id_user` varchar(20) NOT NULL,
  `id_kelas` varchar(20) NOT NULL,
  `nm_siswa` varchar(100) NOT NULL,
  `tahun_ajaran` varchar(100) NOT NULL,
  `masuk_tahun` int(10) NOT NULL,
  `lulus_tahun` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbsiswa`
--

INSERT INTO `tbsiswa` (`id_user`, `id_kelas`, `nm_siswa`, `tahun_ajaran`, `masuk_tahun`, `lulus_tahun`) VALUES
('9839134174', '13', ' Edwud Hartantod', '2024.2', 2024, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbtahunajaran`
--

CREATE TABLE `tbtahunajaran` (
  `id_tahunajaran` int(20) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbtugas`
--

CREATE TABLE `tbtugas` (
  `id_tugas` int(225) NOT NULL,
  `id_mapel_dtl` int(225) NOT NULL,
  `no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbtugas`
--

INSERT INTO `tbtugas` (`id_tugas`, `id_mapel_dtl`, `no`) VALUES
(1, 1, ''),
(2, 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbtugasdtl`
--

CREATE TABLE `tbtugasdtl` (
  `id_tugasdtl` int(225) NOT NULL,
  `id_tugas` int(225) NOT NULL,
  `nm_tugas` varchar(50) NOT NULL,
  `dtl_tugas` varchar(50) NOT NULL,
  `dokumen` varchar(100) NOT NULL,
  `mulai` varchar(50) NOT NULL,
  `selesai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbtugasdtl`
--

INSERT INTO `tbtugasdtl` (`id_tugasdtl`, `id_tugas`, `nm_tugas`, `dtl_tugas`, `dokumen`, `mulai`, `selesai`) VALUES
(1, 1, 'UTS 1', '', 'http://localhost/sekolah/assets/tugas/1723990897.pdf', '2024-08-23 21:32', '2024-08-23 21:32'),
(2, 2, 'Tugas FISIKA 2', 'Pengenalan Fisika Dasar', 'http://localhost/sekolah/assets/tugas/1723990675.pdf', '2024-08-19 04:40', '2024-09-19 06:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbtugasjawab`
--

CREATE TABLE `tbtugasjawab` (
  `id_tugasjawab` int(225) NOT NULL,
  `id_tugas` int(225) NOT NULL,
  `id_siswa` int(200) NOT NULL,
  `dokumen` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `nilai` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbtugasjawab`
--

INSERT INTO `tbtugasjawab` (`id_tugasjawab`, `id_tugas`, `id_siswa`, `dokumen`, `status`, `nilai`) VALUES
(6, 1, 111, 'http://localhost/sekolah/assets/jawab/1724017852.pdf', 3, 95);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `uid` int(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(3) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `otp_expiration` datetime DEFAULT NULL,
  `status` enum('used','unused') NOT NULL DEFAULT 'unused'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`uid`, `email`, `password`, `level`, `otp`, `otp_expiration`, `status`) VALUES
(1, 'edwardhartanto05@gmail.com', 'admin', 1, '456398', '0000-00-00 00:00:00', 'unused'),
(2, 'a78758498@gmail.com', 'admin123', 1, '', NULL, 'unused');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupchat`
--
ALTER TABLE `groupchat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbkelas`
--
ALTER TABLE `tbkelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tbkuis`
--
ALTER TABLE `tbkuis`
  ADD PRIMARY KEY (`id_kuis`);

--
-- Indexes for table `tbkuisdtl`
--
ALTER TABLE `tbkuisdtl`
  ADD PRIMARY KEY (`id_kuis`,`no`);

--
-- Indexes for table `tbkuisjawab`
--
ALTER TABLE `tbkuisjawab`
  ADD PRIMARY KEY (`id_kuis`,`id_siswa`);

--
-- Indexes for table `tbmapel`
--
ALTER TABLE `tbmapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `tbmapeldtl`
--
ALTER TABLE `tbmapeldtl`
  ADD PRIMARY KEY (`id_mapel_dtl`);

--
-- Indexes for table `tbmateri`
--
ALTER TABLE `tbmateri`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `tbmateridtl`
--
ALTER TABLE `tbmateridtl`
  ADD PRIMARY KEY (`id_materidtl`);

--
-- Indexes for table `tbsiswa`
--
ALTER TABLE `tbsiswa`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbtugas`
--
ALTER TABLE `tbtugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `tbtugasdtl`
--
ALTER TABLE `tbtugasdtl`
  ADD PRIMARY KEY (`id_tugasdtl`);

--
-- Indexes for table `tbtugasjawab`
--
ALTER TABLE `tbtugasjawab`
  ADD PRIMARY KEY (`id_tugasjawab`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupchat`
--
ALTER TABLE `groupchat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbkelas`
--
ALTER TABLE `tbkelas`
  MODIFY `id_kelas` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbkuis`
--
ALTER TABLE `tbkuis`
  MODIFY `id_kuis` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbmapeldtl`
--
ALTER TABLE `tbmapeldtl`
  MODIFY `id_mapel_dtl` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbmateri`
--
ALTER TABLE `tbmateri`
  MODIFY `id_materi` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbmateridtl`
--
ALTER TABLE `tbmateridtl`
  MODIFY `id_materidtl` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbtugas`
--
ALTER TABLE `tbtugas`
  MODIFY `id_tugas` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbtugasdtl`
--
ALTER TABLE `tbtugasdtl`
  MODIFY `id_tugasdtl` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbtugasjawab`
--
ALTER TABLE `tbtugasjawab`
  MODIFY `id_tugasjawab` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
