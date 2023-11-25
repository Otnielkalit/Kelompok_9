-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 02:57 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tk_littlestar`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','guru','siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `nama`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator 1234', 'admin', '$2y$10$/4aRfoMudgSWHSyvD9Wbz.XOtzt.4XvhIIqxjUtBru7FrWjABVkUW', 'admin', '2023-05-09 06:32:26', '2023-06-16 19:30:33'),
(55, 'jensri sam', 'jensri jsam', '$2y$10$ZqoJtQYcm1/ecN2XJd1jkObBqoOLF.l1Fko6EkSS3Tyqnj.4deWH2', 'siswa', '2023-06-16 20:20:25', '2023-06-17 14:24:09'),
(62, 'smfmbjd', 'guru', '$2y$10$LuKOThf9oaIgDiBsQMv4kurkICaa3xAlBJtcbxixaGoAH0FjtDt7m', 'guru', '2023-06-17 16:24:35', '2023-06-17 16:25:18'),
(66, 'yennnnnnn', 'yen', '$2y$10$1IKaiA2EELB8R5rZWo/V/uQ9kIgMVPwBJYgeJq2eTlTenhbseTu6i', 'siswa', '2023-06-17 18:14:38', '2023-06-17 18:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `aspek`
--

CREATE TABLE `aspek` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_aspek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aspek`
--

INSERT INTO `aspek` (`id`, `nama_aspek`, `kode`, `kelas_id`, `created_at`, `updated_at`) VALUES
(27, 'Bahasa', 'BA1234', 2, '2023-06-11 03:34:59', '2023-06-11 03:36:36'),
(35, 'Seni', 'SE1234', NULL, '2023-06-15 07:11:54', '2023-06-15 07:11:54'),
(36, 'Olahragaa', 'O1234', NULL, '2023-06-15 19:38:05', '2023-06-16 14:49:04'),
(38, 'menggambar', '10045', 2, '2023-06-17 01:35:58', '2023-06-17 01:35:58'),
(39, 'test', 'T001', 124, '2023-06-17 05:24:51', '2023-06-17 05:24:51'),
(41, 'xyz', '1008', 125, '2023-06-17 16:56:03', '2023-06-17 16:56:03'),
(42, 'Olahragaaa', '1234', 126, '2023-06-17 18:05:54', '2023-06-17 18:11:51'),
(46, 'Olahraga', '5467', 126, '2023-06-17 18:11:18', '2023-06-17 18:11:18'),
(47, 'memancing', '1236', 124, '2023-06-17 18:24:34', '2023-06-17 18:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(12) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nip` bigint(18) NOT NULL,
  `tempat_lahir` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('p','l') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `user_id`, `nip`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `poto`, `agama`, `kelas_id`, `alamat`, `created_at`, `updated_at`) VALUES
(3, 62, 34254252, 'bdfjshj', '2023-06-21', 'l', '1687044275.png', 'islam', 124, 'sfsfgfffffffffffffffnbnbn', '2023-06-17 16:24:35', '2023-06-17 18:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `guru_nilaisiswa`
--

CREATE TABLE `guru_nilaisiswa` (
  `guru_id` int(12) UNSIGNED NOT NULL,
  `nilai_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `title`, `start`, `end`, `description`, `status`, `color`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Fieldtrip', '2023-06-17 09:00:00', '2023-06-17 11:30:00', 'Fieldtrip ke dinas pemadam kebakaran dan penyelamatan kota Medan', '2', '#1a6bc1', '2023-06-15 06:39:48', '2023-06-15 06:46:04', NULL),
(8, 'Fieldtrip pertama', '2023-06-18 03:00:00', '2023-06-18 04:30:00', 'filtrip ke kebun binatang', '2', '#c82828', '2023-06-15 19:30:54', '2023-06-15 19:36:18', NULL),
(9, 'xyz 1', '2023-06-19 02:00:00', '2023-06-19 03:30:00', 'zyx 1', NULL, '#563d7c', '2023-06-16 01:57:42', '2023-06-16 01:58:58', NULL),
(10, 'abcd', '2023-06-20 00:00:00', '2023-06-20 00:30:00', 'abc', NULL, '#563d7c', '2023-06-16 14:34:40', '2023-06-17 15:31:21', NULL),
(11, 'abc', '2023-06-19 00:00:00', '2023-06-19 00:30:00', 'abc', NULL, '#563d7c', '2023-06-17 15:12:15', '2023-06-17 15:12:15', NULL),
(12, 'abc 1', '2023-06-21 02:00:00', '2023-06-21 04:30:00', 'abc', NULL, '#563d7c', '2023-06-17 15:12:29', '2023-06-17 15:12:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(200) NOT NULL,
  `nama_kelas` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kode`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(2, '1001', 'Playgroup', '2023-06-15 13:36:03', '2023-06-15 06:36:03'),
(124, '1002', 'Toddler', '2023-06-16 21:33:43', '2023-06-16 14:33:43'),
(125, '1003', 'Kindy 1', '2023-06-15 06:35:45', '2023-06-15 06:35:45'),
(126, '1004', 'Kindy 2', '2023-06-15 06:35:55', '2023-06-15 06:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_aspek`
--

CREATE TABLE `kelas_aspek` (
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `aspek_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_09_05_024146_create_users_table', 1),
(3, '2022_09_05_024325_create_biodata_table', 1),
(4, '2022_09_06_024341_create_aspek_table', 1),
(5, '2022_09_06_024440_create_poin_aspek_table', 1),
(6, '2022_09_07_014837_create_nilai_siswa', 1),
(7, '2018_08_10_034632_create_events_table', 2),
(8, '2023_05_11_025104_create_events_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_siswa`
--

CREATE TABLE `nilai_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `poin_id` bigint(20) UNSIGNED NOT NULL,
  `semester` int(11) NOT NULL,
  `awal_ajaran` int(11) NOT NULL,
  `akhir_ajaran` int(11) NOT NULL,
  `nilai` enum('mb','bsh','bsb') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_siswa`
--

INSERT INTO `nilai_siswa` (`id`, `user_id`, `poin_id`, `semester`, `awal_ajaran`, `akhir_ajaran`, `nilai`, `created_at`, `updated_at`) VALUES
(98, 55, 12, 6, 2023, 2024, 'bsh', '2023-06-17 13:28:29', '2023-06-17 13:28:29'),
(99, 55, 12, 1, 2023, 2024, 'mb', '2023-06-17 13:30:25', '2023-06-17 13:30:25'),
(100, 55, 18, 2, 2023, 2024, 'mb', '2023-06-17 13:33:50', '2023-06-17 13:33:50'),
(104, 62, 19, 4, 2001, 2002, 'bsh', '2023-06-18 00:26:33', '2023-06-18 00:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poinaspek_nilaisiswa`
--

CREATE TABLE `poinaspek_nilaisiswa` (
  `poin_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `poin_aspek`
--

CREATE TABLE `poin_aspek` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_poin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aspek_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poin_aspek`
--

INSERT INTO `poin_aspek` (`id`, `nama_poin`, `aspek_id`, `created_at`, `updated_at`) VALUES
(12, 'bisa mengenal abjad', 27, '2023-06-11 03:37:27', '2023-06-11 03:37:44'),
(14, 'Dapat mewarnai gambar dengan baik', 35, '2023-06-15 07:12:38', '2023-06-16 14:51:51'),
(15, 'ketangkasan', 36, '2023-06-15 19:38:42', '2023-06-15 19:38:42'),
(16, 'kecepatan', 36, '2023-06-15 19:39:00', '2023-06-15 19:39:00'),
(18, 'bagus', 27, '2023-06-17 05:32:24', '2023-06-17 05:42:28'),
(19, 'abcdef', 39, '2023-06-17 13:42:00', '2023-06-17 13:42:00'),
(21, 'werty', 47, '2023-06-17 18:25:19', '2023-06-17 18:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nisn` bigint(20) NOT NULL,
  `tempat_lahir` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('p','l') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ayah` varchar(200) NOT NULL,
  `nama_ibu` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `user_id`, `nisn`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `poto`, `agama`, `kelas_id`, `alamat`, `nama_ayah`, `nama_ibu`, `created_at`, `updated_at`) VALUES
(1, 55, 324314524, 'dkjs', '2023-06-08', 'p', '1686972026.png', 'islam', 2, 'jdkjd', 'abc', 'abc', '2023-06-16 20:20:26', '2023-06-17 14:24:09'),
(8, 66, 1234, 'yeneenejdcksjd', '2023-06-06', 'p', '1687050879.png', 'kristen', 124, 'jkdkcbsdkyeyeye', 'yebehe', 'hjsdcjsd', '2023-06-17 18:14:39', '2023-06-17 18:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_nilaisiswa`
--

CREATE TABLE `siswa_nilaisiswa` (
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `nilai_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `aspek`
--
ALTER TABLE `aspek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aspek_kode_unique` (`kode`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `guru_nilaisiswa`
--
ALTER TABLE `guru_nilaisiswa`
  ADD KEY `nilai_id` (`nilai_id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `kelas_aspek`
--
ALTER TABLE `kelas_aspek`
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `aspek_id` (`aspek_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_siswa_user_id_index` (`user_id`),
  ADD KEY `nilai_siswa_poin_id_index` (`poin_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `poinaspek_nilaisiswa`
--
ALTER TABLE `poinaspek_nilaisiswa`
  ADD KEY `nilai_id` (`nilai_id`),
  ADD KEY `poin_id` (`poin_id`);

--
-- Indexes for table `poin_aspek`
--
ALTER TABLE `poin_aspek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_poin` (`nama_poin`),
  ADD KEY `poin_aspek_aspek_id_index` (`aspek_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `siswa_nilaisiswa`
--
ALTER TABLE `siswa_nilaisiswa`
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `nilai_id` (`nilai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `aspek`
--
ALTER TABLE `aspek`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poin_aspek`
--
ALTER TABLE `poin_aspek`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspek`
--
ALTER TABLE `aspek`
  ADD CONSTRAINT `aspek_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `akun` (`id`),
  ADD CONSTRAINT `guru_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `guru_nilaisiswa`
--
ALTER TABLE `guru_nilaisiswa`
  ADD CONSTRAINT `guru_nilaisiswa_ibfk_1` FOREIGN KEY (`nilai_id`) REFERENCES `nilai_siswa` (`id`),
  ADD CONSTRAINT `guru_nilaisiswa_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`);

--
-- Constraints for table `kelas_aspek`
--
ALTER TABLE `kelas_aspek`
  ADD CONSTRAINT `kelas_aspek_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `kelas_aspek_ibfk_2` FOREIGN KEY (`aspek_id`) REFERENCES `aspek` (`id`);

--
-- Constraints for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  ADD CONSTRAINT `nilai_siswa_poin_id_foreign` FOREIGN KEY (`poin_id`) REFERENCES `poin_aspek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_siswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poinaspek_nilaisiswa`
--
ALTER TABLE `poinaspek_nilaisiswa`
  ADD CONSTRAINT `poinaspek_nilaisiswa_ibfk_1` FOREIGN KEY (`nilai_id`) REFERENCES `nilai_siswa` (`id`),
  ADD CONSTRAINT `poinaspek_nilaisiswa_ibfk_2` FOREIGN KEY (`poin_id`) REFERENCES `poin_aspek` (`id`);

--
-- Constraints for table `poin_aspek`
--
ALTER TABLE `poin_aspek`
  ADD CONSTRAINT `poin_aspek_aspek_id_foreign` FOREIGN KEY (`aspek_id`) REFERENCES `aspek` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `akun` (`id`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `siswa_nilaisiswa`
--
ALTER TABLE `siswa_nilaisiswa`
  ADD CONSTRAINT `siswa_nilaisiswa_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`),
  ADD CONSTRAINT `siswa_nilaisiswa_ibfk_2` FOREIGN KEY (`nilai_id`) REFERENCES `nilai_siswa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
