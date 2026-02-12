-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Feb 2026 pada 06.17
-- Versi server: 8.0.30
-- Versi PHP: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petmatch`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `aktivitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `adopsis`
--

CREATE TABLE `adopsis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `hewan_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `adopsis`
--

INSERT INTO `adopsis` (`id`, `user_id`, `hewan_id`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'pending', NULL, '2026-01-12 17:45:49', '2026-01-12 17:45:49'),
(2, 1, 8, 'pending', NULL, '2026-01-12 17:48:48', '2026-01-12 17:48:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `nama`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Kucing', 'categories/NXnZ5X7Ld3T39pCsc4yZ2tSk0OFIN6lJwMyx1tLJ.jpg', '2026-01-06 23:57:40', '2026-01-06 23:57:40'),
(3, 'Kelinci', 'categories/bOOxv7g4pS2dNOvjIdxkwRo9NPewN22iWXPsoqEk.jpg', '2026-01-06 23:58:01', '2026-01-06 23:58:01'),
(4, 'Sugar Glider', 'categories/KQn3nHxXJMjxQLvIMhsXsc8uQfw0tyxmWbGGcIpg.jpg', '2026-01-06 23:58:26', '2026-01-06 23:58:26'),
(5, 'Landak Mini', 'categories/dFLriGMpInDaEhEC0bRxzHbJzfk5Ksx9h2PGfO7R.jpg', '2026-01-06 23:58:45', '2026-01-06 23:58:45'),
(6, 'Hamster', 'categories/i1uIB2gm2KjAi3eMjSsRWiZMC9fyrHmzwBfmXEZC.jpg', '2026-01-06 23:59:04', '2026-01-06 23:59:04'),
(7, 'Anjing', 'categories/qR0AWpZFqGaZYzfPMFpNRmL41XdQpwYGytHvzNEx.jpg', '2026-01-07 00:00:29', '2026-01-07 00:00:29'),
(9, 'Lovebird', 'categories/qfwIaMw1WHw5OeGKcCYUJwDKXbzCw2PJpZrJZhgA.jpg', '2026-01-07 21:42:15', '2026-01-07 21:42:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `details`
--

CREATE TABLE `details` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_hewan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `umur` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_hewan`
--

CREATE TABLE `detail_hewan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` int NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hewan`
--

CREATE TABLE `hewan` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('jantan','betina') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` enum('Baik','Sakit') COLLATE utf8mb4_unicode_ci DEFAULT 'Baik',
  `status` enum('tersedia','diadopsi') COLLATE utf8mb4_unicode_ci DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hewan`
--

INSERT INTO `hewan` (`id`, `category_id`, `nama`, `jenis`, `umur`, `gender`, `deskripsi`, `foto`, `kondisi`, `status`, `created_at`, `updated_at`) VALUES
(4, NULL, 'Kuky', 'Neva Masquerade', '2 Tahun', 'betina', 'Ras ini berasal dari Rusia dan dikenal cerdas, lincah, dan penuh kasih sayang.', '1767507314.jpeg', 'Baik', 'tersedia', '2026-01-03 22:54:40', '2026-01-15 21:38:22'),
(5, NULL, 'Tubbi', 'Domestik atau tabby', '1 tahun', 'betina', 'Kucing ini memiliki mata hijau dan pola tabi makarel (bergaris) berwarna abu-abu/coklat.', '1767506338.jpeg', 'Baik', 'tersedia', '2026-01-03 22:58:44', '2026-01-15 21:37:35'),
(6, NULL, 'Shep', 'German Shepherd', '2 Tahun', 'betina', 'Shep adalah anjing yang dikenal sebagai anjing paling cerdas, setia.', '1767507289.jpeg', 'Baik', 'tersedia', '2026-01-03 23:14:49', '2026-01-15 21:37:18'),
(7, NULL, 'Kai', 'Miniature Siberian Husky', '1/2 Tahun', 'jantan', 'Anak anjing ini memiliki penampilan khas anjing utara, dengan bulu tebal dan pola warna hitam putih yang mirip dengan serigala atau husky.', '1767510089.jpeg', 'Baik', 'tersedia', '2026-01-04 00:01:29', '2026-01-15 21:38:08'),
(8, NULL, 'Cogi', 'Pembroke Welsh Corgi', '1 tahun', 'jantan', 'Ras ini adalah anjing penggembala kecil yang kokoh dengan kaki pendek, telinga tegak besar, dan ekor yang dipotong pendek.', '1767511228.jpeg', 'Baik', 'tersedia', '2026-01-04 00:20:28', '2026-01-04 00:20:28'),
(11, NULL, 'River', 'Golden Retriever', '1/2 Tahun', 'jantan', 'Dikenal karena sifatnya yang ramah, cerdas, dan penuh kasih sayang, membuatnya cocok sebagai hewan peliharaan keluarga.', '1768538212.jpeg', 'Baik', 'tersedia', '2026-01-15 21:36:52', '2026-01-15 21:36:52'),
(12, NULL, 'Shi', 'Shiba Inu', '1 Tahun', 'jantan', 'Mereka termasuk dalam jenis anjing Spitz yang kokoh, berukuran sedang, dengan telinga tajam dan ekor melengkung.', '1768538426.jpeg', 'Baik', 'tersedia', '2026-01-15 21:40:26', '2026-01-15 21:40:26'),
(13, NULL, 'Unaa', 'Pomeranian', '1 Tahun', 'betina', 'Tubuh nya yang pendek dan mungil, dengan ekor lebat yang biasanya melengkung di belakang punggung.', '1768538570.jpeg', 'Baik', 'tersedia', '2026-01-15 21:42:50', '2026-01-15 21:42:50'),
(14, NULL, 'Kuma', 'Fischer Lovebird', '1 Tahun', 'jantan', 'burung ini terkenal karena sifatnya monogaminya, yang berarti mereka hanya memiliki satu pasangan seumur hidup.', '1768539037.jpeg', 'Baik', 'tersedia', '2026-01-15 21:50:37', '2026-01-15 21:50:37'),
(15, NULL, 'Askar', 'Agapornis Roseicollis/peach-faced lovebird', '1 Tahun', 'jantan', 'Burung ini sangat sosial dan sering berkumpul dalam kelompok besar di alam liar. Mereka dikenal karena kicauannya yang keras dan konstan.', '1768539228.jpeg', 'Baik', 'tersedia', '2026-01-15 21:53:14', '2026-01-15 21:53:48'),
(16, NULL, 'Koko', 'Black-masked lovebird', '1 Tahun', 'jantan', 'Burung ini adalah Lovebird kacamata topeng berwarna biru atau violet. Dikenal karena sifatnya yang berpasangan dan ekspresif.', '1768539376.jpeg', 'Baik', 'tersedia', '2026-01-15 21:56:16', '2026-01-15 21:56:16'),
(17, NULL, 'Kana', 'Peach-faced lovebird', '1 Tahun', 'betina', 'Lovebird muka salem variasi warna pastel blue atau violet albino. Burung ini populer sebagai hewan peliharaan karena warna bulunya yang menarik dan sifatnya yang penyayang.', '1768539689.jpeg', 'Baik', 'tersedia', '2026-01-15 22:01:29', '2026-01-15 22:01:29'),
(18, NULL, 'Babs', 'Hamster Kerdil Campbell', '1/2 Tahun', 'jantan', 'Hamster Campbell bersifat krepuskular (aktif saat fajar dan senja) dan aktif sepanjang tahun. Mereka adalah hewan sosial meskipun pengawasan tetap dilakukan untuk mencegah agresi teritorial.', '1768540337.jpeg', 'Baik', 'tersedia', '2026-01-15 22:12:17', '2026-01-15 22:12:17'),
(19, NULL, 'Lin', 'Hamster Roborovski', '1 Tahun', 'betina', 'Dikenal karena kecepatan dan kelincahannya, mereka jarang menggigit tetapi cenderung takut dan cepat.', '1768540654.jpeg', 'Baik', 'tersedia', '2026-01-15 22:17:34', '2026-01-15 22:17:34'),
(20, NULL, 'Lala', 'Landak Kerdil Afrika', '2 Tahun', 'betina', 'Landak ini adalah hewan noktural yang artinya aktif di malam hari. Lala adalah omnivora, memakan serangga, katak, buah-buahan.', '1768540932.jpeg', 'Baik', 'tersedia', '2026-01-15 22:22:12', '2026-01-15 22:22:12'),
(21, NULL, 'Len', 'Landak Mini Hedgehog', '2 Tahun', 'jantan', 'Walaupun ukurannya kecil, landak mini dikenal sebagai penjelajah yang luar biasa. Mereka menggunakan moncong panjang dan indra penciuman yang kuat untuk mencari makan di tempat tersembunyi.', '1768541228.jpeg', 'Baik', 'tersedia', '2026-01-15 22:27:08', '2026-01-15 22:27:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `chat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_read` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `is_admin`, `chat`, `status_read`, `created_at`, `updated_at`) VALUES
(31, 13, 0, 'halo min', 1, '2026-02-10 00:38:23', '2026-02-10 18:24:16'),
(32, 13, 1, 'halo kak, ada yang bisa saya bantu?', 0, '2026-02-10 00:38:46', '2026-02-10 00:38:46'),
(33, 13, 0, 'saya ingin donasi kak', 1, '2026-02-10 00:39:03', '2026-02-10 18:24:16'),
(34, 13, 1, 'baik kak, silahkan di halaman pembayaran ya! Terimakasih', 0, '2026-02-10 00:39:30', '2026-02-10 00:39:30'),
(35, 1, 0, 'halo', 0, '2026-02-10 18:24:14', '2026-02-10 18:24:14'),
(36, 16, 0, 'halol', 1, '2026-02-10 18:29:13', '2026-02-10 18:33:06'),
(37, 16, 0, 'haloo', 1, '2026-02-10 18:29:23', '2026-02-10 18:33:06'),
(38, 16, 0, 'halo', 1, '2026-02-10 18:32:59', '2026-02-10 18:33:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_02_050308_create_hewan_table', 1),
(5, '2025_12_02_051002_create_sessions_table', 1),
(6, '2025_12_10_082010_create_admins_table', 1),
(7, '2025_12_10_101414_create_activity_logs_table', 1),
(8, '2025_12_13_054100_create_permintaans_table', 1),
(9, '2025_12_13_054332_create_pembayaran_table', 1),
(10, '2025_12_13_054751_create_pelanggan_table', 1),
(11, '2025_12_13_055303_create_chat_table', 1),
(12, '2025_12_17_060418_add_foto_to_hewan_table', 2),
(13, '2025_12_27_062109_add_role_to_users_table', 3),
(14, '2025_12_29_073231_create_detail_hewan_table', 4),
(15, '2025_12_31_144853_create_messages_table', 5),
(16, '2026_01_07_062251_create_categories_table', 1),
(17, '2026_01_09_023646_create_permintaans_table', 6),
(18, '2026_01_09_025955_create_adopsis_table', 6),
(19, '2026_01_14_030721_add_identitas_to_permintaans_table', 7),
(20, '2026_01_14_071824_alter_payments_table_add_columns', 8),
(21, '2026_01_14_073830_create_pembayaran_table', 9),
(22, '2026_01_15_041706_add_fields_to_users_table', 10),
(24, '2026_01_16_150635_create_detail_hewan_table', 11),
(25, '2026_01_19_025031_create_transactions_table', 11),
(26, '2026_01_19_055302_create_pembayarans_table', 11),
(27, '2026_02_01_013238_create_messages_table', 12),
(28, '2026_02_01_041526_create_messages_table', 13),
(29, '2026_02_01_064713_create_chats_table', 14),
(30, '2026_02_02_021416_create_riwayats_table', 15),
(31, '2026_02_03_115319_create_messages_table', 16),
(32, '2026_02_05_004657_add_metode_pembayaran_to_pembayarans_table', 17),
(33, '2026_02_06_021346_add_category_id_to_hewan_table', 18),
(34, '2026_02_07_104500_add_alasan_to_permintaans_table', 19),
(35, '2026_02_07_051532_create_messages_table', 20),
(36, '2026_02_07_062055_fix_user_id_in_messages_table', 21),
(37, '2026_02_09_071300_update_permintaan_id_nullable_in_pembayarans_table', 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `metode_pembayaran` enum('transfer','tunai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'transfer',
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('diajukan','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permintaan_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `user_id`, `kode_pembayaran`, `jumlah`, `metode_pembayaran`, `bukti`, `status`, `created_at`, `updated_at`, `permintaan_id`) VALUES
(17, 12, 'PAY-ZWSWT49E', 2000000, 'transfer', 'bukti_pembayaran/Ai76Q46AFX5NVFDnWU6fda0BipyeFNnYd0giz2HB.png', 'diterima', '2026-02-02 19:07:18', '2026-02-02 19:07:25', NULL),
(22, 14, 'PAY-8ZNI63MS', 100000, 'transfer', 'bukti_pembayaran/7Bdbck6AAtAqAHeqJrszprASoJQZyLLJrhmNoQeJ.png', 'diterima', '2026-02-03 07:46:05', '2026-02-03 07:46:18', NULL),
(23, 14, 'PAY-R98LNTM5', 987000, 'transfer', 'bukti_pembayaran/GL7C7YGP2f8yOsPWK1PtTth9xWKP5xrII7xeiCj3.png', 'diterima', '2026-02-03 08:37:41', '2026-02-03 08:38:01', NULL),
(24, 14, 'PAY-X8W5YLWK', 876000, 'transfer', 'bukti_pembayaran/CPC40hVq3k1OPlnN3UVc3qkslMEuUV3Y32Pwm7jJ.png', 'diterima', '2026-02-03 17:41:10', '2026-02-03 17:41:25', NULL),
(25, 15, 'PAY-C7OLHUN9', 200000, 'transfer', 'bukti_pembayaran/X5dRlx8WsXfoYgXNhPwRKs4bCZjPVM2UjLfVWclY.png', 'diterima', '2026-02-03 18:12:58', '2026-02-03 18:13:17', NULL),
(26, 15, 'PAY-GEVSXK2V', 200000, 'transfer', 'bukti_pembayaran/smqUX6jTwlJRNmPRLOyzlRdAEqeLi4GRjUpzFJag.png', 'diterima', '2026-02-03 18:40:03', '2026-02-03 19:13:15', NULL),
(27, 15, 'PAY-VCHR76GG', 900000, 'tunai', NULL, 'diterima', '2026-02-04 17:55:50', '2026-02-04 17:55:50', NULL),
(28, 15, 'PAY-NSRSQYTL', 987000, 'tunai', 'bukti_pembayaran/GyM8k1laJuVZ4QTYiTtUPDzvwxBvYhRGsxC66PiC.png', 'diterima', '2026-02-04 19:21:34', '2026-02-04 19:21:56', NULL),
(29, 1, 'PAY-HVK1PZIF', 569000, 'tunai', NULL, 'ditolak', '2026-02-05 18:49:20', '2026-02-05 18:56:48', NULL),
(30, 13, 'PAY-BZ53ZJ3J', 710000, 'transfer', 'bukti_pembayaran/HGGQEaGxmkVZTUVt4BAcZONWW4U3Uf8A77PBDKux.png', 'diterima', '2026-02-06 20:36:38', '2026-02-06 22:04:18', NULL),
(31, 1, 'PAY-OKT9XYGN', 654900, 'tunai', NULL, 'diterima', '2026-02-07 02:33:03', '2026-02-07 02:33:16', NULL),
(32, 16, 'PAY-1JHSIOPO', 111000, 'tunai', NULL, 'diterima', '2026-02-08 18:05:19', '2026-02-08 18:05:34', NULL),
(33, 16, 'PAY-GHNE6VN6', 1000000, 'tunai', NULL, 'diterima', '2026-02-09 00:25:56', '2026-02-09 00:26:34', NULL),
(34, 16, 'PAY-WILO0XXZ', 1220000, 'transfer', NULL, 'diterima', '2026-02-09 00:34:35', '2026-02-09 00:34:55', NULL),
(35, 16, 'PAY-HIKUFYBD', 550000, 'transfer', 'bukti_pembayaran/QWZwckV0ZMmdKsC1aebUWMWoxFj5CGd9gPDR9l0D.png', 'diterima', '2026-02-09 00:35:38', '2026-02-09 00:35:46', 38),
(36, 13, 'PAY-U4E1ZMXO', 1000000, 'tunai', NULL, 'diterima', '2026-02-10 00:46:51', '2026-02-10 00:47:03', NULL),
(37, 16, 'PAY-W7ZMLABH', 1000000, 'tunai', NULL, 'diterima', '2026-02-10 18:32:02', '2026-02-10 18:32:11', 38),
(38, 16, 'PAY-HE8TZ1OC', 1000000, 'transfer', NULL, 'diterima', '2026-02-10 18:32:25', '2026-02-10 18:32:30', NULL),
(39, 16, 'PAY-OHNYTRUC', 1000000, 'transfer', 'bukti_pembayaran/MvPHy5mVuHdUqB3DAeEAbzf5qTktWRi7tGWOGaqo.png', 'diterima', '2026-02-10 20:49:08', '2026-02-10 20:54:12', NULL),
(40, 16, 'PAY-AYFA5G00', 2124000, 'transfer', 'bukti_pembayaran/i2PY6EvYZTbGoZ2e5vfFNurh8Qt0EEvKMHpNSC6J.png', 'diterima', '2026-02-10 20:56:47', '2026-02-10 20:56:59', 38),
(41, 1, 'PAY-RDGZKXY2', 890000, 'tunai', NULL, 'diterima', '2026-02-11 00:05:23', '2026-02-11 00:05:30', NULL),
(42, 16, 'PAY-PXIXZWHB', 999000, 'transfer', 'bukti_pembayaran/Nn6oGfRzvYRAxWNQtzBJZDhD7SxflYVReDxafzZP.png', 'diterima', '2026-02-11 00:06:49', '2026-02-11 00:06:57', NULL),
(43, 16, 'PAY-LKS3QARR', 100000, 'tunai', 'bukti_pembayaran/hbfbkE1iTF5CExFJrl9eR8t5CsDOyTngIsouaoby.png', 'diterima', '2026-02-11 00:36:23', '2026-02-11 00:36:44', 38);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaans`
--

CREATE TABLE `permintaans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `hewan_id` bigint UNSIGNED NOT NULL,
  `status` enum('diajukan','diterima','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permintaans`
--

INSERT INTO `permintaans` (`id`, `user_id`, `hewan_id`, `status`, `catatan`, `created_at`, `updated_at`, `nama_lengkap`, `no_hp`, `pekerjaan`, `alamat`, `alasan`) VALUES
(6, 2, 5, 'ditolak', NULL, '2026-01-13 20:08:44', '2026-01-13 20:09:19', 'Siti', '0895622635498', 'pelajar', 'JL. GAJAH MADA II, KEL MAGERSARI, KEC MAGERSARI, KOTA MOJOKERTO, JATIM', NULL),
(7, 2, 6, 'diterima', NULL, '2026-01-13 20:09:01', '2026-01-13 20:09:23', 'Siti', '0895622635498', 'pelajar', 'JL. GAJAH MADA II, KEL MAGERSARI, KEC MAGERSARI, KOTA MOJOKERTO, JATIM', NULL),
(8, 2, 7, 'ditolak', NULL, '2026-01-13 23:01:16', '2026-01-13 23:01:25', 'Siti', '0895622635498', 'pelajar', 'JL. GAJAH MADA II, KEL MAGERSARI, KEC MAGERSARI, KOTA MOJOKERTO, JATIM', NULL),
(24, 12, 4, 'diterima', NULL, '2026-02-02 19:05:03', '2026-02-02 19:05:29', 'sofi', '089519761166', 'pelajar', 'JL. GAJAH MADA II', NULL),
(25, 13, 7, 'ditolak', NULL, '2026-02-02 21:56:31', '2026-02-03 08:31:22', 'izza', '089519761166', 'pelajar', 'gh', NULL),
(26, 13, 15, 'diterima', NULL, '2026-02-02 21:57:55', '2026-02-02 21:58:06', 'Complaint Handling_Izza Aulia', '089519761166', 'pelajar', 'JL. GAJAH MADA 2, KEC MAGERSARI, KEL MAGERSARI,  KOTA MOJOKERTO', NULL),
(27, 14, 13, 'diterima', NULL, '2026-02-03 07:40:59', '2026-02-03 07:41:08', 'Complaint Handling_Izza Aulia', '089519761166', 'pelajar', 'JL. GAJAH MADA 2, KEC MAGERSARI, KEL MAGERSARI,  KOTA MOJOKERTO', NULL),
(28, 14, 8, 'diterima', NULL, '2026-02-03 17:38:23', '2026-02-03 17:38:41', 'Complaint Handling_Izza Aulia', '089519761166', 'pelajar', 'Kost AG 40, kalirungkut, kec Rungkut, surabaya', NULL),
(29, 15, 19, 'diterima', NULL, '2026-02-03 18:12:02', '2026-02-03 18:12:19', 'Sofi', '0895622635498', 'pelajar', 'Kost AG 40, kalirungkut, kec Rungkut, surabaya', NULL),
(30, 15, 12, 'diterima', NULL, '2026-02-03 18:29:51', '2026-02-03 18:30:05', 'Sofi', '0895622635498', 'pelajar', 'JL. GAJAH MADA 2, KEC MAGERSARI, KEL MAGERSARI,  KOTA MOJOKERTO', NULL),
(31, 15, 20, 'diterima', NULL, '2026-02-03 18:39:16', '2026-02-03 18:39:32', 'Sofi', '0895622635498', 'pelajar', 'JL. GAJAH MADA 2, KEC MAGERSARI, KEL MAGERSARI,  KOTA MOJOKERTO', NULL),
(32, 1, 20, 'diterima', NULL, '2026-02-04 18:58:13', '2026-02-04 18:58:23', 'sofi', '0895622635498', 'pelajar', 'Kost AG 40, kalirungkut, kec Rungkut, surabaya', NULL),
(33, 15, 6, 'diterima', NULL, '2026-02-04 18:59:01', '2026-02-04 18:59:11', 'Sofi', '0895622635498', 'pelajar', 'Kost AG 40, kalirungkut, kec Rungkut, surabaya', NULL),
(34, 13, 11, 'diterima', NULL, '2026-02-06 20:46:26', '2026-02-06 20:46:43', 'Aulia', '089519761166', 'pelajar', 'JL. GAJAH MADA 2, KEC MAGERSARI, KEL MAGERSARI,  KOTA MOJOKERTO', NULL),
(35, 13, 11, 'ditolak', NULL, '2026-02-06 21:31:58', '2026-02-06 22:01:06', 'sofi', '0895622635498', 'tes', 'Kost AG 40, kalirungkut, kec Rungkut, surabaya', NULL),
(36, 13, 14, 'diterima', NULL, '2026-02-06 22:00:56', '2026-02-06 22:01:10', 'lia', '0895622635498', 'tes', 'Kost AG 40, kalirungkut, kec Rungkut, surabaya', 'tes'),
(37, 13, 11, 'ditolak', NULL, '2026-02-06 22:01:39', '2026-02-08 18:22:11', 'revy', '0895622635498', 'pelajar', 'Kost AG 40, kalirungkut, kec Rungkut, surabaya', 'ingin'),
(38, 16, 11, 'diterima', NULL, '2026-02-08 18:04:37', '2026-02-08 18:04:51', 'bunga', '0895622635498', 'pelajar', 'SMK NEGERI 2 Kota Mojokerto', 'Ingin memeilhara teman baru dirumah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayats`
--

CREATE TABLE `riwayats` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `hewan_id` bigint UNSIGNED NOT NULL,
  `status` enum('selesai','batal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_adopsi` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('89oaII7SsnBsdepW8tcESXCNERvxhJx1es59qrMK', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia1h5dnpScFhlbXVQdGdmTGk2N1A1UDN3UktaRHRScDVEQjQwUE9hZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sYXBvcmFuLWtldWFuZ2FuP2Zyb209JmplbmlzPWFkb3BzaSZ0bz0iO3M6NToicm91dGUiO3M6MjI6ImFkbWluLmxhcG9yYW4ta2V1YW5nYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNjt9', 1770876533),
('S3wraKzTACkjCmdI2ER2bO2mtKa1gqQzY922cxtx', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibDg2MFBvV3hTdnlJQ1VCR3BhRjQ1R0VGZWg0QU9PVHltWVFUWklUZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyIjtzOjU6InJvdXRlIjtzOjEwOiJ1c2VyLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTY7fQ==', 1770795448);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, '', 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$12$52VwgBYqLjarsSMP6CGTve3Ff2P4ZPwAfuaGIAYa0JJEZM9iL9RQ6', NULL, NULL, '2025-12-16 19:57:42', 'admin'),
(2, '', 'user', 'User', 'user@gmail.com', NULL, '$2y$12$vUTb5YGJTJYOL.zek8TMj.7rA46038T1eEb1/JcZH0Wrj.zic2D/e', NULL, '2025-12-27 06:29:08', '2025-12-26 23:39:05', 'user'),
(12, 'sofi', 'sofi', 'sofi', 'sofi@gmail.com', NULL, '$2y$12$AqkE/FojLCvDvi9kqxYlQO./bfmo4SxYYbj39uAuKdhO6ywfqRuba', NULL, '2026-02-02 19:03:41', '2026-02-02 19:03:41', 'user'),
(13, 'Revy', 'Revy', 'Revy', 'revy@gmail.com', NULL, '$2y$12$1UfGuW.HFz7FUFptBTGImuODUzBQQRQgZvd1MBk/Tb8rmTSDmxeMa', NULL, '2026-02-02 21:27:09', '2026-02-02 21:27:09', 'user'),
(14, 'cika', 'cika', 'cika', 'cika@gmail.com', NULL, '$2y$12$i2aNFw/RZJtO46x6tbuNBuxVBISZM3MUSrajt4elcH5H7FZVOJdo2', NULL, '2026-02-02 22:51:25', '2026-02-02 22:51:25', 'user'),
(15, 'koko', 'koko', 'koko', 'koko@gmail.com', NULL, '$2y$12$FhgWeG8133WN6JT7BuA8e.BP34CiL19LwnG3emgkQ2882yTLwwD7C', NULL, '2026-02-03 17:36:20', '2026-02-03 17:36:20', 'user'),
(16, 'bunga', 'bunga', 'bunga', 'bunga@gmail.com', NULL, '$2y$12$bNJx3kpwH7gQa71QtSSVPe61.p3COdmnffOMfQVhU4AJnBLr0oRNa', NULL, '2026-02-08 18:02:58', '2026-02-08 18:02:58', 'user'),
(17, 'naura', 'naura', 'naura', 'naura@gmail.com', NULL, '$2y$12$WDU61EFGTwiVDDogNR0bfOl9WZXLl/6xx.8KQp3QedCpYAAncJ1.K', NULL, '2026-02-10 18:22:11', '2026-02-10 18:22:11', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indeks untuk tabel `adopsis`
--
ALTER TABLE `adopsis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adopsis_user_id_foreign` (`user_id`),
  ADD KEY `adopsis_hewan_id_foreign` (`hewan_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_hewan`
--
ALTER TABLE `detail_hewan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_hewan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hewans_category` (`category_id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembayarans_kode_pembayaran_unique` (`kode_pembayaran`),
  ADD KEY `pembayarans_user_id_foreign` (`user_id`),
  ADD KEY `pembayarans_permintaan_id_foreign` (`permintaan_id`);

--
-- Indeks untuk tabel `permintaans`
--
ALTER TABLE `permintaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaans_user_id_foreign` (`user_id`),
  ADD KEY `permintaans_hewan_id_foreign` (`hewan_id`);

--
-- Indeks untuk tabel `riwayats`
--
ALTER TABLE `riwayats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayats_user_id_foreign` (`user_id`),
  ADD KEY `riwayats_hewan_id_foreign` (`hewan_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `adopsis`
--
ALTER TABLE `adopsis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `details`
--
ALTER TABLE `details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_hewan`
--
ALTER TABLE `detail_hewan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hewan`
--
ALTER TABLE `hewan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `permintaans`
--
ALTER TABLE `permintaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `riwayats`
--
ALTER TABLE `riwayats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `adopsis`
--
ALTER TABLE `adopsis`
  ADD CONSTRAINT `adopsis_hewan_id_foreign` FOREIGN KEY (`hewan_id`) REFERENCES `hewan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adopsis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_hewan`
--
ALTER TABLE `detail_hewan`
  ADD CONSTRAINT `detail_hewan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hewan`
--
ALTER TABLE `hewan`
  ADD CONSTRAINT `fk_hewans_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_permintaan_id_foreign` FOREIGN KEY (`permintaan_id`) REFERENCES `permintaans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pembayarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permintaans`
--
ALTER TABLE `permintaans`
  ADD CONSTRAINT `permintaans_hewan_id_foreign` FOREIGN KEY (`hewan_id`) REFERENCES `hewan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permintaans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayats`
--
ALTER TABLE `riwayats`
  ADD CONSTRAINT `riwayats_hewan_id_foreign` FOREIGN KEY (`hewan_id`) REFERENCES `hewan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
