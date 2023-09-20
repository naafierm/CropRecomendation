-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 02:31 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `dss_profile_matching`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_pelamar`
--

CREATE TABLE `master_pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `nama_pelamar` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pelamar`
--

INSERT INTO `master_pelamar` (`id_pelamar`, `nama_pelamar`, `no_hp`, `email`) VALUES
(1, 'padi', '', ''),
(2, 'jagung', '0', 'rfanPriyadiNurfauzi@gmail.comI'),
(3, 'kacang', '0', 'MuhamadFirdaus@gmail.com'),
(10, 'apel', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `tgl_dibuat` datetime NOT NULL,
  `diubah_oleh` int(11) NOT NULL,
  `tgl_diubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id_user`, `username`, `nama`, `password`, `level`, `dibuat_oleh`, `tgl_dibuat`, `diubah_oleh`, `tgl_diubah`) VALUES
(1, 'HRD', 'Muhamad Fikri Rahmat', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2020-08-25 22:05:05', 0, '0000-00-00 00:00:00'),
(2, 'admin', 'iqbal', '21232f297a57a5a743894a0e4a801fc3', 1, 0, '2023-09-17 14:41:28', 0, '2023-09-17 14:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `pm_aspek`
--

CREATE TABLE `pm_aspek` (
  `id_aspek` tinyint(3) UNSIGNED NOT NULL,
  `aspek` varchar(100) NOT NULL,
  `prosentase` float NOT NULL,
  `bobot_core` float NOT NULL,
  `bobot_secondary` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_aspek`
--

INSERT INTO `pm_aspek` (`id_aspek`, `aspek`, `prosentase`, `bobot_core`, `bobot_secondary`) VALUES
(1, 'kondisi tanah', 40, 60, 40),
(2, 'kondisi lingkungan', 60, 60, 40);

-- --------------------------------------------------------

--
-- Table structure for table `pm_bobot`
--

CREATE TABLE `pm_bobot` (
  `selisih` tinyint(3) NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_bobot`
--

INSERT INTO `pm_bobot` (`selisih`, `bobot`, `keterangan`) VALUES
(0, 4, '7'),
(1, 3.5, '6'),
(-1, 3, '5'),
(2, 2.5, '4'),
(-2, 2, '3'),
(3, 1.5, '2'),
(-3, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `pm_faktor`
--

CREATE TABLE `pm_faktor` (
  `id_faktor` tinyint(3) UNSIGNED NOT NULL,
  `id_aspek` tinyint(3) UNSIGNED NOT NULL,
  `faktor` varchar(30) NOT NULL,
  `target` tinyint(3) NOT NULL,
  `type` set('core','secondary') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_faktor`
--

INSERT INTO `pm_faktor` (`id_faktor`, `id_aspek`, `faktor`, `target`, `type`) VALUES
(1, 1, 'Nitrogen (N)', 4, 'core'),
(6, 2, 'Nilai pH Tanah', 2, 'secondary'),
(5, 2, 'Kelembapan Tanah', 3, 'secondary'),
(4, 2, 'Suhu Tanah', 4, 'secondary'),
(2, 1, 'Potassium', 4, 'core'),
(3, 1, 'Phosporous', 4, 'core'),
(7, 2, 'Curah Hujan', 1, 'secondary');

-- --------------------------------------------------------

--
-- Table structure for table `pm_ranking`
--

CREATE TABLE `pm_ranking` (
  `id_pelamar` int(11) NOT NULL,
  `nilai_akhir` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_ranking`
--

INSERT INTO `pm_ranking` (`id_pelamar`, `nilai_akhir`) VALUES
(1, '1.38'),
(2, '1.24'),
(3, '1.06'),
(10, '1.41');

-- --------------------------------------------------------

--
-- Table structure for table `pm_sample`
--

CREATE TABLE `pm_sample` (
  `id_sample` int(11) UNSIGNED NOT NULL,
  `id_pelamar` tinyint(3) UNSIGNED NOT NULL,
  `id_faktor` tinyint(3) UNSIGNED NOT NULL,
  `value` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_sample`
--

INSERT INTO `pm_sample` (`id_sample`, `id_pelamar`, `id_faktor`, `value`) VALUES
(766, 3, 8, 0),
(628, 4, 12, 1),
(765, 3, 7, 3),
(764, 3, 6, 3),
(763, 3, 5, 2),
(627, 4, 11, 3),
(762, 3, 4, 2),
(761, 2, 8, 0),
(626, 4, 10, 3),
(625, 4, 9, 4),
(760, 2, 7, 4),
(759, 2, 6, 4),
(758, 2, 5, 1),
(624, 3, 12, 4),
(757, 2, 4, 4),
(623, 3, 11, 3),
(622, 3, 10, 3),
(621, 3, 9, 3),
(620, 2, 12, 4),
(619, 2, 11, 3),
(618, 2, 10, 4),
(617, 2, 9, 4),
(616, 1, 12, 2),
(748, 3, 3, 2),
(747, 3, 2, 1),
(746, 3, 1, 2),
(615, 1, 11, 3),
(745, 2, 3, 2),
(744, 2, 2, 4),
(756, 1, 8, 0),
(614, 1, 10, 2),
(743, 2, 1, 2),
(742, 1, 3, 4),
(755, 1, 7, 4),
(613, 1, 9, 4),
(741, 1, 2, 2),
(740, 1, 1, 3),
(754, 1, 6, 3),
(753, 1, 5, 3),
(752, 1, 4, 2),
(749, 10, 1, 3),
(750, 10, 2, 4),
(751, 10, 3, 2),
(767, 10, 4, 3),
(768, 10, 5, 4),
(769, 10, 6, 3),
(770, 10, 7, 4),
(771, 10, 8, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_pelamar`
--
ALTER TABLE `master_pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pm_aspek`
--
ALTER TABLE `pm_aspek`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indexes for table `pm_bobot`
--
ALTER TABLE `pm_bobot`
  ADD PRIMARY KEY (`selisih`);

--
-- Indexes for table `pm_faktor`
--
ALTER TABLE `pm_faktor`
  ADD PRIMARY KEY (`id_faktor`);

--
-- Indexes for table `pm_sample`
--
ALTER TABLE `pm_sample`
  ADD PRIMARY KEY (`id_sample`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_pelamar`
--
ALTER TABLE `master_pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pm_aspek`
--
ALTER TABLE `pm_aspek`
  MODIFY `id_aspek` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pm_faktor`
--
ALTER TABLE `pm_faktor`
  MODIFY `id_faktor` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pm_sample`
--
ALTER TABLE `pm_sample`
  MODIFY `id_sample` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=772;
COMMIT;
