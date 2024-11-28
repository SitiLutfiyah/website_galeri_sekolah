-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 08:35 AM
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
-- Database: `ujikom_gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `created_at`, `updated_at`) VALUES
(3, 'Informasi Terkini', '2024-11-14 00:16:28', '2024-11-16 20:41:17'),
(4, 'Agenda Sekolah', '2024-11-14 00:16:41', '2024-11-14 00:16:41'),
(5, 'Galeri Sekolah', '2024-11-14 00:17:28', '2024-11-24 18:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `post_id`, `position`, `status`, `created_at`, `updated_at`) VALUES
(12, 17, 1, 'aktif', '2024-11-18 01:03:06', '2024-11-18 01:18:36'),
(13, 18, 2, 'aktif', '2024-11-18 01:11:01', '2024-11-18 01:11:01'),
(14, 19, 3, 'aktif', '2024-11-18 17:47:42', '2024-11-18 17:47:42'),
(19, 20, 4, 'aktif', '2024-11-18 19:23:55', '2024-11-18 19:23:55'),
(20, 21, 5, 'aktif', '2024-11-18 19:24:46', '2024-11-18 19:24:46'),
(21, 22, 6, 'aktif', '2024-11-18 19:25:01', '2024-11-18 19:25:01'),
(24, 29, 5, 'aktif', '2024-11-27 20:25:47', '2024-11-27 20:25:47'),
(25, 30, 2, 'aktif', '2024-11-27 23:23:29', '2024-11-27 23:23:29'),
(26, 24, 12, 'aktif', '2024-11-28 00:15:06', '2024-11-28 00:15:06'),
(27, 23, 12, 'aktif', '2024-11-28 00:16:37', '2024-11-28 00:16:37');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `gallery_id`, `file`, `title`, `created_at`, `updated_at`) VALUES
(37, 12, '1731917415.jpg', '1', '2024-11-18 01:04:22', '2024-11-18 01:10:15'),
(38, 12, '1731917111.jpg', '2', '2024-11-18 01:05:11', '2024-11-18 01:05:11'),
(39, 12, '1731917128.jpg', '3', '2024-11-18 01:05:28', '2024-11-18 01:05:28'),
(40, 12, '1731917427.jpg', '4', '2024-11-18 01:10:27', '2024-11-18 01:10:27'),
(41, 12, '1731917436.jpg', '5', '2024-11-18 01:10:36', '2024-11-18 01:10:36'),
(49, 13, '1731986150.jpg', '1', '2024-11-18 20:15:50', '2024-11-18 20:15:50'),
(50, 13, '1731986170.jpg', '2', '2024-11-18 20:16:10', '2024-11-18 20:16:10'),
(51, 13, '1731986187.jpg', '3', '2024-11-18 20:16:27', '2024-11-18 20:16:27'),
(52, 13, '1731986202.jpg', '4', '2024-11-18 20:16:42', '2024-11-18 20:16:42'),
(53, 13, '1731986235.jpg', '5', '2024-11-18 20:17:15', '2024-11-18 20:17:15'),
(54, 13, '1731986254.jpg', '6', '2024-11-18 20:17:34', '2024-11-18 20:17:34'),
(55, 13, '1731986276.jpg', '7', '2024-11-18 20:17:56', '2024-11-18 20:17:56'),
(56, 13, '1731986297.jpg', '8', '2024-11-18 20:18:17', '2024-11-18 20:18:17'),
(57, 13, '1731986321.jpg', '9', '2024-11-18 20:18:41', '2024-11-18 20:18:41'),
(58, 13, '1731986346.jpg', '10', '2024-11-18 20:19:06', '2024-11-18 20:19:06'),
(59, 13, '1731986359.jpg', '11', '2024-11-18 20:19:19', '2024-11-18 20:19:19'),
(60, 13, '1731986376.jpg', '12', '2024-11-18 20:19:36', '2024-11-18 20:19:36'),
(61, 13, '1731986389.jpg', '13', '2024-11-18 20:19:49', '2024-11-18 20:19:49'),
(62, 14, '1732005618.jpg', '1', '2024-11-19 01:40:18', '2024-11-19 01:40:18'),
(63, 14, '1732005632.jpg', '2', '2024-11-19 01:40:32', '2024-11-19 01:40:32'),
(64, 14, '1732005678.jpg', '3', '2024-11-19 01:41:18', '2024-11-19 01:41:18'),
(65, 14, '1732005691.jpg', '4', '2024-11-19 01:41:31', '2024-11-19 01:41:31'),
(66, 14, '1732005707.jpg', '5', '2024-11-19 01:41:47', '2024-11-19 01:41:47'),
(67, 14, '1732005708.jpg', '5', '2024-11-19 01:41:48', '2024-11-19 01:41:48'),
(68, 19, '1732005736.jpg', '1', '2024-11-19 01:42:16', '2024-11-19 01:42:16'),
(69, 19, '1732005758.jpg', '2', '2024-11-19 01:42:38', '2024-11-19 01:42:38'),
(71, 19, '1732005777.jpg', '3', '2024-11-19 01:42:57', '2024-11-19 01:42:57'),
(72, 19, '1732005795.jpg', '4', '2024-11-19 01:43:15', '2024-11-19 01:43:15'),
(73, 19, '1732005808.jpg', '5', '2024-11-19 01:43:28', '2024-11-19 01:43:28'),
(75, 20, '1732006404.jpg', '1', '2024-11-19 01:53:24', '2024-11-19 01:53:24'),
(76, 20, '1732006418.jpg', '2', '2024-11-19 01:53:38', '2024-11-19 01:53:38'),
(77, 20, '1732006431.jpg', '3', '2024-11-19 01:53:51', '2024-11-19 01:53:51'),
(78, 20, '1732006457.jpg', '4', '2024-11-19 01:54:17', '2024-11-19 01:54:17'),
(79, 20, '1732006472.jpg', '5', '2024-11-19 01:54:32', '2024-11-19 01:54:32'),
(80, 21, '1732006498.jpg', '1', '2024-11-19 01:54:58', '2024-11-19 01:54:58'),
(81, 21, '1732006509.jpg', '2', '2024-11-19 01:55:09', '2024-11-19 01:55:09'),
(82, 21, '1732006524.jpg', '3', '2024-11-19 01:55:24', '2024-11-19 01:56:03'),
(83, 21, '1732006540.jpg', '4', '2024-11-19 01:55:40', '2024-11-19 01:55:40'),
(84, 21, '1732006556.jpg', '5', '2024-11-19 01:55:56', '2024-11-19 01:55:56'),
(85, 12, '1732089052.jpg', '6', '2024-11-20 00:50:52', '2024-11-20 00:50:52'),
(112, 24, '1732778055.jpg', '1', '2024-11-28 00:14:15', '2024-11-28 00:14:15'),
(113, 26, '1732778168.jpg', '1', '2024-11-28 00:16:08', '2024-11-28 00:16:08'),
(114, 27, '1732778227.jpg', '1', '2024-11-28 00:17:07', '2024-11-28 00:17:07'),
(115, 25, '1732778522.jpg', '2', '2024-11-28 00:22:02', '2024-11-28 00:22:02'),
(116, 25, '1732778530.jpg', '3', '2024-11-28 00:22:10', '2024-11-28 00:22:10'),
(117, 25, '1732778543.jpg', '4', '2024-11-28 00:22:23', '2024-11-28 00:22:23'),
(118, 25, '1732778568.jpg', '5', '2024-11-28 00:22:48', '2024-11-28 00:22:48'),
(119, 25, '1732778577.jpg', '6', '2024-11-28 00:22:57', '2024-11-28 00:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(49, '2014_10_12_000000_create_users_table', 1),
(50, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(51, '2014_10_12_100000_create_password_resets_table', 1),
(64, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(65, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(66, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(67, '2016_06_01_000004_create_oauth_clients_table', 2),
(68, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(69, '2019_08_19_000000_create_failed_jobs_table', 2),
(70, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(71, '2024_10_04_040409_create_categories_table', 2),
(72, '2024_10_29_031606_create_posts_table', 3),
(73, '2024_10_30_053533_create_galleries_table', 4),
(74, '2024_11_01_013226_create_images_table', 4),
(75, '2024_11_13_035231_create_profiles_table', 4),
(76, '2024_11_14_050122_add_profile_photo_to_users_table', 5),
(77, '2024_11_14_050549_add_profile_photo_to_users_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 1, 'auth-token', '539b0fcf6681f9d1337760c12590743855a368a8a7dcb49c0906da9e381546c9', '[\"*\"]', NULL, NULL, '2024-11-17 20:03:57', '2024-11-17 20:03:57'),
(3, 'App\\Models\\User', 1, 'auth-token', '4543d6c2d5ea7ecd617c970fd8c9ffc1f001f722f30256b65ef6416f98811209', '[\"*\"]', '2024-11-17 20:20:06', NULL, '2024-11-17 20:06:13', '2024-11-17 20:20:06'),
(4, 'App\\Models\\User', 2, 'auth-token', '4a9d89d9080d0b098eb6051a865dc7e6b7ecbafacc4c5c4a5e31009295f96126', '[\"*\"]', NULL, NULL, '2024-11-17 20:23:22', '2024-11-17 20:23:22'),
(5, 'App\\Models\\User', 2, 'auth-token', '17e900fbe3bc821dfcee73e8711c10c6fde1f08b61c7b3705cc6b9a64dac744a', '[\"*\"]', '2024-11-17 22:36:35', NULL, '2024-11-17 21:25:49', '2024-11-17 22:36:35'),
(6, 'App\\Models\\User', 2, 'auth-token', 'f7d2e09c9ca2ce1043c50a0cf9a1621097e9e5497c24d792109d30de5af9bbd1', '[\"*\"]', '2024-11-18 19:23:13', NULL, '2024-11-18 17:58:55', '2024-11-18 19:23:13'),
(7, 'App\\Models\\User', 2, 'auth-token', 'bc0837d6add20bbe79d06f96adb71f4f05a9135ea9a5779c79b0a46802d7d39a', '[\"*\"]', '2024-11-19 10:19:49', NULL, '2024-11-19 10:19:23', '2024-11-19 10:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `category_id`, `content`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(17, 'Kegiatan Upacara Bendera Hari Senin', 3, 'Kegiatan Upacara Bendera yang dilaksanakan di lapangan SMK Negeri 4 Bogor pada Senin, 07 Oktober 2024', 2, 'publish', '2024-11-17 21:46:33', '2024-11-18 00:58:23'),
(18, 'Kegiatan Lomba Fruit Tea School To School', 3, 'Kegiatan Lomba Fruit Tea School To school SMKN 4 Bogor. Kegiatan ini dilaksanakan di lapangan SMK Negeri 4 Bogor pada Rabu, 06 November 2024', 2, 'publish', '2024-11-17 21:59:59', '2024-11-18 01:02:00'),
(19, 'Kegiatan Asesmen Bakat Dan Minat Kelas XII Day 1', 3, 'Kegiatan Asesmen Bakat Dan Minat Kelas XII Hari Pertama. Kegiatan ini dilaksanakan pada hari Senin, 11 November 2024.', 2, 'publish', '2024-11-17 22:32:04', '2024-11-18 19:24:17'),
(20, 'Kegiatan Asesmen Bakat Dan Minat Kelas XII Day 2', 3, 'Kegiatan Asesmen Bakat Dan Minat Kelas XII Hari Kedua. Kegiatan ini dilaksanakan pada hari Selasa, 12 November 2024.', 2, 'publish', '2024-11-18 01:00:52', '2024-11-18 01:00:52'),
(21, 'Kegiatan Pelaksanaan P5 Kamis Bersih', 3, 'Kegiatan Pelaksanaan P5 Kamis Bersih. Kegiatan ini diikuti oleh seluruh warga sekolah dan dilaksanakan pada hari Kamis, 14 November 2024.', 2, 'publish', '2024-11-18 01:01:31', '2024-11-18 01:01:31'),
(22, 'Kegiatan Workshop Kesehatan Mental Remaja', 3, 'Kegiatan Workshop Kesehatan Mental Remaja. Kegiatan Ini dilaksanakan di Aula SMKN 4 Bogor dan diikuti oleh Siswa/Siswi SMKN 4 Bogor pada hari Kamis, 14 November 2024.', 2, 'publish', '2024-11-18 01:02:56', '2024-11-18 01:17:42'),
(23, 'Uji Kompetensi Keahlian Kelas XII', 4, 'ajhshdjd', 2, 'publish', '2024-11-19 01:57:06', '2024-11-19 01:57:06'),
(24, 'Rapat Kegiatan Belajar Mengajar', 4, 'Tanggal: 29 November 2024\r\nWaktu: 09:00 - 11:00 WIB\r\nTempat: Ruang Rapat', 2, 'publish', '2024-11-19 01:57:29', '2024-11-27 20:15:54'),
(29, 'Acara TransforKr4b 2025', 4, 'acara akan di laksanakan pada bulan September mendatang', 2, 'publish', '2024-11-27 20:24:30', '2024-11-27 20:24:30'),
(30, 'Acara TransforKr4b 2024', 5, 'Acara TransforKr4b 2024 sangat meriah sekali', 2, 'publish', '2024-11-27 22:41:36', '2024-11-28 00:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `judul`, `isi`, `created_at`, `updated_at`) VALUES
(1, 'SMKN 4 BOGOR', 'Merupakan sekolah kejuruan berbasis Teknologi Informasi dan Komunikasi. Sekolah ini didirikan dan dirintis pada tahun 2008 kemudian dibuka pada tahun 2009 yang saat ini terakreditasi A. Terletak di Jalan Raya Tajur Kp. Buntar, Muarasari, Bogor, sekolah ini berdiri di atas lahan seluas 12.724 m2 dengan berbagai fasilitas pendukung di dalamnya. Terdapat 54 staff pengajar dan 22 orang staff tata usaha, dikepalai oleh Drs. Mulya Mulprihartono, M. Si, sekolah ini merupakan investasi pendidikan yang tepat untuk putra/putri anda.', '2024-11-14 00:02:05', '2024-11-17 19:16:55'),
(2, 'Visi :', 'Terwujudnya SMK Pusat Keunggulan melalui terciptanya pelajar pancasila yang berbasis teknologi, berwawasan lingkungan dan berkewirausahaan.', '2024-11-14 18:58:22', '2024-11-14 19:25:30'),
(3, 'Misi  :', '1. Mewujudkan karakter pelajar pancasila beriman dan bertaqwa kepada Tuhan Yang Maha Esa dan berakhlak mulia, berkebhinekaan global, gotong royong, mandiri, kreatif dan bernalar kritis.\r\n2. Mengembangkan pembelajaran dan pengelolaan sekolah berbasis Teknologi Informasi dan Komunikasi.\r\n3. Mengembangkan sekolah yang berwawasan Adiwiyata Mandiri.\r\n4. Mengembangkan usaha dalam berbagai bidang secara optimal sehingga memiliki kemandirian dan daya saing tinggi.', '2024-11-14 19:17:09', '2024-11-26 01:58:17'),
(8, 'Drs. Mulya Murprihartono, M.Si.', 'Sejak satu tahun lalu SMKN 4 Kota Bogor dipimpin oleh seseorang yang membawa warna baru, tahun pertama sejak dilantik, tepatnya pada tanggal 10 Juli 2020, inovasi dan kebijakan-kebijakan baru pun mulai dirancang. Bukan tanpa kesulitan, penuh tantangan tapi beliau meyakinkan untuk selalu optimis pada harapan dengan bersinergi mewujudkan visi misi SMKN 4 Bogor ditengah kesulitan pandemi ini. Strategi baru pun dimunculkan, beberapa program sudah terealisasikan diantaranya mengembangkan aplikasi LMS (Learning Management System) sebagai solusi dalam pelaksanaan program BDR (Belajar dari Rumah), untuk mengoptimalkan hubungan kerjasama antara sekolah dengan Industri dan Dunia Kerja (IDUKA), dan juga untuk pengalaman praktek belajar jarak jauh agar tetap berjalan dengan optimal.', '2024-11-14 21:56:47', '2024-11-14 21:56:47'),
(10, 'Pengembangan Perangkat Lunak dan Gim', 'Pengembangan Perangkat Lunak dan Gim merupakan kompetensi keahlian yang awal mulanya bernama Rekayasa Perangkat Lunak (RPL). Sesuai dengan namanya keahlian yang dipelajari pada kompetensi ini pun berkisar seputar pembuatan perangkat lunak (software) dan pembuatan gim.', '2024-11-19 06:44:38', '2024-11-19 06:44:38'),
(11, 'Teknik Jaringan Komputer dan Telekomunikasi', 'Teknik Jaringan Komputer dan Telekomunikasi awalnya bernama Teknik Komputer dan Jaringan (TKJ). Awalnya kompetensi keahlian ini berada pada satu bidang keahlian yang sama dengan kompetensi keahlian RPL. Namun setelah adanya perubahan di kurikulum merdeka, kompetensi keahlian ini memiliki bidang yang berbeda dengan kompetensi keahlian RPL. Sesuai dengan namanya kompetensi keahlian TKJ berfokus pada pembuatan jaringan untuk layanan komunikasi dan perakitan komputer.', '2024-11-19 06:45:27', '2024-11-19 06:45:27'),
(12, 'Teknik Kendaraan Ringan', 'Teknik Otomotif merupakan kompetensi keahlian yang berfokus untuk melakukan perbaikan pada berbagai kendaraan roda empat. Semula jurusan ini bernama Teknik Kendaraan Ringan (TKR), namun kini berganti nama seiring dengan perubahan kurikulum merdeka.', '2024-11-19 06:46:09', '2024-11-19 06:46:09'),
(13, 'Teknik Pengelasan dan Fabrikasi Logam', 'Teknik Pengelasan dan Fabrikasi Logam, merupakan jurusan yang di dominasi oleh kaum laki-laki. Seperti namanya, kompetensi keahlian ini berfokus pada pembuatan perangkat dengan meggunakan bahan dasar logam, seperti halnya rak sepatu, tralis, lemari besi, dan lain sebagainya.', '2024-11-19 06:46:50', '2024-11-19 06:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Administrator', 'admin@gmail.com', '1732117048.jpg', NULL, '$2y$10$FFWzEFYKC7ZzZ3jcwviaReTdDrRd4YCaFxxtYMzY.hWHPrAFgGch.', NULL, '2024-11-13 20:44:52', '2024-11-20 08:37:28'),
(6, 'Admin Baru', 'admin2@example.com', NULL, NULL, '$2y$10$EMBIpsMBtuoJZrbN5QXP9.qr59pd70IiEumKi.R/xYuJa/snXuN/K', NULL, '2024-11-17 20:10:29', '2024-11-17 20:10:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_post_id_foreign` (`post_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_gallery_id_foreign` (`gallery_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
