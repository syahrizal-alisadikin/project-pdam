-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2020 at 10:36 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` bigint(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'iqbal', 'iqbal@iqbal.com', '$2y$10$.XUWoJJjgYWm2xuB5dq5eepYYbOa0OSc1twSKqdGCUkLs7mFglZG6', '2020-09-01 17:00:30', '2020-09-01 17:00:25', '2020-09-01 17:00:16'),
(4, 'admin', 'admin@admin.com', '$2y$10$i00h6vAIh/ZOncRRrbE8Xu67bDSxvyF5fwEclR6eiGGgUAfBpEWk.', NULL, '2020-09-01 18:52:07', '2020-09-01 18:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_08_30_024448_create_tbl_rw_table', 2),
(6, '2020_08_30_112917_create_kelurahans_table', 3),
(7, '2020_08_30_113318_create_tbl_kelurahan_table', 4),
(8, '2020_08_30_120910_create_tbl_kecamatan_table', 5),
(9, '2020_08_30_120922_create_tbl_kota_table', 5),
(10, '2020_08_30_120930_create_tbl_provinsi_table', 5),
(11, '2020_08_30_142342_add_fk_provinsi_id_to_tbl_kota', 6),
(12, '2020_08_30_143527_add_fk_kota_id_to_tbl_kecamatan', 7),
(13, '2020_08_30_144944_add_fk_kecamatan_id_to_tbl_kelurahan', 8),
(14, '2020_08_31_035711_create_warga_table', 9),
(15, '2020_09_01_144917_create_admins_table', 10),
(16, '2020_09_08_012503_add_edit_post_to_tbl_warga', 11),
(17, '2020_09_08_012708_add_edit_post_to_tbl_rw', 12),
(18, '2020_09_08_013159_create_tbl_tagihan_table', 13),
(19, '2020_09_08_013707_create_tbl_pembayaran_table', 13),
(20, '2020_09_08_014602_create_tbl_param_kejadian_table', 14),
(21, '2020_09_08_014740_create_tbl_kejadian_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\User', 2, 'ApiToken', '45484bb91c7cc090d12495d45e7490f629b32c551d489fb337534b96e743455f', '[\"*\"]', '2020-08-30 01:32:58', '2020-08-29 18:55:48', '2020-08-30 01:32:58'),
(2, 'App\\User', 2, 'ApiToken', '197c21385485dd07df34eedf74f9e8681636160e36962da990622b855cda8593', '[\"*\"]', NULL, '2020-08-29 18:57:50', '2020-08-29 18:57:50'),
(3, 'App\\User', 2, 'ApiToken', 'e62ce517c6573a03d3a026f1b0c612e38c617a58ac65943d39f300c01cf70c00', '[\"*\"]', NULL, '2020-08-29 18:58:10', '2020-08-29 18:58:10'),
(4, 'App\\User', 2, 'ApiToken', '5f7eb920658a0917b5aa3a52df0d7294a7c84f2caebdba52c84acd67b91a0360', '[\"*\"]', NULL, '2020-08-29 18:58:16', '2020-08-29 18:58:16'),
(5, 'App\\User', 2, 'ApiToken', '9e3dfed80dc5775bdbad5c60b9146bd78651493aed5d076d1f21cf7d7496de5c', '[\"*\"]', NULL, '2020-08-29 19:15:20', '2020-08-29 19:15:20'),
(6, 'App\\User', 2, 'ApiToken', '836f29472f3d3232587d375968ec50fb63bf533e08abd878a859b1acdf0d3296', '[\"*\"]', NULL, '2020-08-30 01:17:00', '2020-08-30 01:17:00'),
(7, 'App\\User', 2, 'ApiToken', '8dd60e01827db454c5a3e48fae986e492877603398135005ac8e4a856664ee20', '[\"*\"]', NULL, '2020-08-30 01:32:33', '2020-08-30 01:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kecamatan`
--

CREATE TABLE `tbl_kecamatan` (
  `kecamatan_id` int(11) NOT NULL,
  `fk_kota_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_kecamatan`
--

INSERT INTO `tbl_kecamatan` (`kecamatan_id`, `fk_kota_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jatinangor', NULL, '2020-08-30 05:35:24', '2020-08-30 05:35:51'),
(2, 2, 'Kayuringin', NULL, '2020-08-30 05:41:31', '2020-08-30 05:41:31'),
(3, 0, 'Kaliabang', '2020-08-30 05:41:47', '2020-08-30 05:41:38', '2020-08-30 05:41:47'),
(4, 0, 'Kaliabang', '2020-08-30 05:41:51', '2020-08-30 05:41:39', '2020-08-30 05:41:51'),
(5, 3, 'kaliabang', NULL, '2020-08-30 05:41:58', '2020-08-30 05:41:58'),
(6, 1, 'Sumedang', NULL, '2020-08-30 07:41:00', '2020-08-30 07:41:00'),
(7, 1, 'Dayeh Kolot', NULL, '2020-08-30 07:48:17', '2020-08-30 07:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kejadian`
--

CREATE TABLE `tbl_kejadian` (
  `kejadian_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_rw_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kejadian` date NOT NULL,
  `nama_kejadian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelurahan`
--

CREATE TABLE `tbl_kelurahan` (
  `kelurahan_id` int(11) NOT NULL,
  `fk_kecamatan_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_kelurahan`
--

INSERT INTO `tbl_kelurahan` (`kelurahan_id`, `fk_kecamatan_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 'Kayuringin', '2020-08-30 04:51:18', '2020-08-30 04:50:48', '2020-08-30 04:51:18'),
(3, 2, 'Kayuringin', NULL, '2020-08-30 04:51:36', '2020-08-30 04:51:36'),
(4, 5, 'Tambun', NULL, '2020-08-30 05:42:09', '2020-08-30 05:42:09'),
(5, 6, 'Cikarang', NULL, '2020-08-30 05:42:17', '2020-08-30 05:42:17'),
(6, 1, 'Jatiroke', NULL, '2020-08-30 07:58:32', '2020-08-30 07:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kota`
--

CREATE TABLE `tbl_kota` (
  `kota_id` int(11) NOT NULL,
  `fk_provinsi_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_kota`
--

INSERT INTO `tbl_kota` (`kota_id`, `fk_provinsi_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bandung', NULL, '2020-08-30 05:40:36', '2020-08-30 05:40:42'),
(2, 2, 'jakarta', NULL, '2020-08-30 05:40:59', '2020-08-30 05:40:59'),
(3, 3, 'Bekasi', NULL, '2020-08-30 05:41:08', '2020-08-30 05:41:08'),
(4, 2, 'Jakarta Selatan', NULL, '2020-08-30 07:31:49', '2020-08-30 07:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_param_kejadian`
--

CREATE TABLE `tbl_param_kejadian` (
  `param_id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_param_kejadian`
--

INSERT INTO `tbl_param_kejadian` (`param_id`, `nama`, `edit_post`, `create_post`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Kehujanan', NULL, NULL, '2020-09-11 01:35:46', '2020-09-11 01:21:08', '2020-09-11 01:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `fk_tagihan_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `jumlah_bayar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`pembayaran_id`, `fk_tagihan_id`, `tanggal_bayar`, `jumlah_bayar`, `status`, `edit_post`, `create_post`, `deleted_at`, `created_at`, `updated_at`) VALUES
(24, '911', NULL, NULL, 'Pending', NULL, '4', NULL, '2020-09-11 00:58:57', '2020-09-11 00:58:57'),
(25, '912', NULL, NULL, 'Pending', NULL, '4', NULL, '2020-09-11 00:58:57', '2020-09-11 00:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_provinsi`
--

CREATE TABLE `tbl_provinsi` (
  `provinsi_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_provinsi`
--

INSERT INTO `tbl_provinsi` (`provinsi_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Jawa Barat', NULL, '2020-08-30 05:48:54', '2020-08-30 05:48:54'),
(2, 'Dki Jakarta', NULL, '2020-08-30 05:49:03', '2020-08-30 05:49:03'),
(3, 'Jawa Tengah', NULL, '2020-08-30 05:49:12', '2020-08-30 05:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rw`
--

CREATE TABLE `tbl_rw` (
  `rw_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_kelurahan_id` int(11) NOT NULL,
  `fk_kecamatan_id` int(11) NOT NULL,
  `fk_kota_id` int(11) NOT NULL,
  `fk_provinsi_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `edit_post` int(11) DEFAULT NULL,
  `no_rw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longtitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_rw`
--

INSERT INTO `tbl_rw` (`rw_id`, `name`, `email`, `password`, `alamat`, `fk_kelurahan_id`, `fk_kecamatan_id`, `fk_kota_id`, `fk_provinsi_id`, `deleted_at`, `created_at`, `updated_at`, `edit_post`, `no_rw`, `longtitude`, `latitude`) VALUES
('203', 'izalStore', 'alisadikinsyahrizal@gmail.com', '$2y$10$egl2Yw8vQmS.8ZyCDNbz7OH6/2Cc2gXTSJGWsFyIaCuLm6MO4q2RK', 'bekasi', 6, 6, 1, 1, NULL, '2020-09-09 08:20:33', '2020-09-09 08:20:33', NULL, NULL, NULL, NULL),
('648', 'Syahrizal', 'alisadikinsyahrizalww@gmail.com', '$2y$10$4FPmLuw.lVcqYuGQ7s1Vx.Zlw9HWiDA4ZCwl5DjpTTBM82wARvuoS', 'caaac', 3, 2, 2, 2, NULL, '2020-09-09 08:19:38', '2020-09-09 08:19:38', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tagihan`
--

CREATE TABLE `tbl_tagihan` (
  `tagihan_id` int(11) NOT NULL,
  `fk_rw_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_tagihan` date NOT NULL,
  `jumlah_tagihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edit_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_tagihan`
--

INSERT INTO `tbl_tagihan` (`tagihan_id`, `fk_rw_id`, `nama`, `tanggal_tagihan`, `jumlah_tagihan`, `tarif`, `edit_post`, `create_post`, `deleted_at`, `created_at`, `updated_at`) VALUES
(911, '203', 'Bayar Air', '2020-09-18', '300000', '5000000', NULL, '4', NULL, '2020-09-11 00:58:57', '2020-09-11 00:58:57'),
(912, '648', 'Bayar Air', '2020-09-18', '300000', '5000000', NULL, '4', NULL, '2020-09-11 00:58:57', '2020-09-11 00:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warga`
--

CREATE TABLE `tbl_warga` (
  `warga_id` bigint(20) UNSIGNED NOT NULL,
  `fk_rw_id` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `edit_post` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longtitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_warga`
--

INSERT INTO `tbl_warga` (`warga_id`, `fk_rw_id`, `nama`, `email`, `password`, `phone`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `user_id`, `foto_ktp`, `foto_kk`, `foto_profile`, `created_at`, `updated_at`, `edit_post`, `status`, `longtitude`, `latitude`) VALUES
(2, '001', 'iqbal nw', 'iqbal@gmail.com', '$2y$10$mCuHQNRaU.f3zlRkCeJPluzbTQ1/YffUgMbrsIVDDRvLViWVnQPBK', '08982882', '1231', '1231', 'laki', 'jakarta', '001', '3P06rOFMA', 'AHfCze4wE', 'uIclBGKO4', '2020-08-31 01:50:26', '2020-08-31 09:31:59', NULL, NULL, NULL, NULL),
(4, '001', 'izal', 'izal@izal.com', '$2y$10$.XUWoJJjgYWm2xuB5dq5eepYYbOa0OSc1twSKqdGCUkLs7mFglZG6', '08982882', '1231', '1231', 'laki', 'Bekasi', '001', 'k4KE82R4g', 'mxOd5u9LT', 'zsdMm3J1o', '2020-08-31 01:53:53', '2020-08-31 10:21:48', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_rw_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fk_rw_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, '003', 'test', 'izal@izal.com', NULL, '$2y$10$pLZVxqTEfjppNicq.Mwv0uw5XD5N3DS1BO9pebgXdIOFMNxBNCrlK', NULL, '2020-08-29 01:21:21', '2020-08-31 01:36:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  ADD PRIMARY KEY (`kecamatan_id`);

--
-- Indexes for table `tbl_kelurahan`
--
ALTER TABLE `tbl_kelurahan`
  ADD PRIMARY KEY (`kelurahan_id`);

--
-- Indexes for table `tbl_kota`
--
ALTER TABLE `tbl_kota`
  ADD PRIMARY KEY (`kota_id`);

--
-- Indexes for table `tbl_param_kejadian`
--
ALTER TABLE `tbl_param_kejadian`
  ADD PRIMARY KEY (`param_id`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`);

--
-- Indexes for table `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  ADD PRIMARY KEY (`provinsi_id`);

--
-- Indexes for table `tbl_rw`
--
ALTER TABLE `tbl_rw`
  ADD PRIMARY KEY (`rw_id`);

--
-- Indexes for table `tbl_tagihan`
--
ALTER TABLE `tbl_tagihan`
  ADD PRIMARY KEY (`tagihan_id`);

--
-- Indexes for table `tbl_warga`
--
ALTER TABLE `tbl_warga`
  ADD PRIMARY KEY (`warga_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  MODIFY `kecamatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_kelurahan`
--
ALTER TABLE `tbl_kelurahan`
  MODIFY `kelurahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kota`
--
ALTER TABLE `tbl_kota`
  MODIFY `kota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_param_kejadian`
--
ALTER TABLE `tbl_param_kejadian`
  MODIFY `param_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_provinsi`
--
ALTER TABLE `tbl_provinsi`
  MODIFY `provinsi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_tagihan`
--
ALTER TABLE `tbl_tagihan`
  MODIFY `tagihan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=913;

--
-- AUTO_INCREMENT for table `tbl_warga`
--
ALTER TABLE `tbl_warga`
  MODIFY `warga_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
