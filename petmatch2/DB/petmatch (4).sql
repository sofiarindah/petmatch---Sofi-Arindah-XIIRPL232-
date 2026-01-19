-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jan 2026 pada 08.02
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
(21, NULL, 'Len', 'Landak Mini Hedgehog', '2 Tahun', 'jantan', 'Walaupun ukurannya kecil, landak mini dikenal sebagai penjelajah yang luar biasa. Mereka menggunakan moncong panjang dan indra penciuman yang kuat untuk mencari makan di tempat tersembunyi.', '1768541228.jpeg', 'Baik', 'tersedia', '2026-01-15 22:27:08', '2026-01-15 22:27:08'),
(22, NULL, 'Kima', 'Ragdoll', '1 Tahun', 'betina', 'Sifatnya ramah', '1768541394.jpeg', 'Baik', 'tersedia', '2026-01-15 22:29:54', '2026-01-15 22:29:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_read` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `chat`, `status_read`, `created_at`, `updated_at`) VALUES
(13, '4', '..', 0, '2026-01-18 19:43:11', '2026-01-18 19:43:11'),
(14, '8', '.', 0, '2026-01-18 19:58:38', '2026-01-18 19:58:38'),
(15, '8', '.', 0, '2026-01-18 20:12:23', '2026-01-18 20:12:23'),
(16, '8', ',', 0, '2026-01-18 20:17:56', '2026-01-18 20:17:56'),
(17, '9', 'halo', 0, '2026-01-18 21:36:02', '2026-01-18 21:36:02');

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
(26, '2026_01_19_055302_create_pembayarans_table', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('diajukan','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `user_id`, `kode_pembayaran`, `jumlah`, `bukti`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, 'PAY-JEXKRCSJ', 600000, 'bukti_pembayaran/Rr2XtMZswfW4o4DUmd2SSFUEZgzgf5Qt2CY9jiLg.jpg', 'diajukan', '2026-01-18 23:04:58', '2026-01-18 23:04:58'),
(2, 9, 'PAY-MDQSTNCT', 10000, NULL, 'diajukan', '2026-01-18 23:10:15', '2026-01-18 23:10:15'),
(3, 9, 'PAY-MZAY6AGT', 126000, 'bukti_pembayaran/EZM5DcP00plaJ62VBmb6ncKa3GFGHp12v493gTVv.jpg', 'diajukan', '2026-01-18 23:12:59', '2026-01-18 23:12:59'),
(4, 9, 'PAY-KHCTWWZS', 50000, NULL, 'diajukan', '2026-01-18 23:20:32', '2026-01-18 23:20:32'),
(5, 9, 'PAY-FQFDP5AC', 50000, NULL, 'diajukan', '2026-01-18 23:36:11', '2026-01-18 23:36:11'),
(6, 9, 'PAY-TSS0D4ED', 800000, 'bukti_pembayaran/9o9LbPChZDXRcZegYQzsGBUBdpjnnQ1SCrc0K3Hv.jpg', 'diajukan', '2026-01-18 23:40:00', '2026-01-18 23:40:00'),
(7, 9, 'PAY-KCBUMK8V', 800000, 'bukti_pembayaran/xnQiJfuzw6gtcukhwKktTUKpJwjB1tExlgwoDFak.jpg', 'diajukan', '2026-01-18 23:42:20', '2026-01-18 23:42:20'),
(8, 9, 'PAY-U9I5AMSP', 40000, NULL, 'diajukan', '2026-01-18 23:42:30', '2026-01-18 23:42:30'),
(9, 9, 'PAY-2FJWHHPL', 859000, 'bukti_pembayaran/DuDkVZdbkUJsuf5HNXjThCbVbTY5shvONyyxbtFx.jpg', 'diajukan', '2026-01-18 23:51:29', '2026-01-18 23:51:29'),
(10, 9, 'PAY-EBM82ZX6', 859000, 'bukti_pembayaran/WJyT4C5zftppgxltbtH9kP17mr4Rjn2FMV7oPE59.jpg', 'diterima', '2026-01-19 00:08:58', '2026-01-19 00:35:50');

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
(15, 9, 11, 'diterima', NULL, '2026-01-18 22:37:46', '2026-01-18 22:38:04', 'okta', '0895622635498', 'pelajar', 'Kost AG 40, kalirungkut, kec Rungkut, surabaya', NULL);

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
('JDpWHDHKBA9ELj9gC4gvil1Y4vI40DtKjxGUixn9', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRTYzaHF5U3MxU05nSHZKSWl5WG9SbW11MmlxbUJQNW4wdVlMbVRNUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyLXBlbWJheWFyYW4vMTAvbm90YSI7czo1OiJyb3V0ZSI7czoyMDoidXNlci1wZW1iYXlhcmFuLm5vdGEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=', 1768808504);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int NOT NULL,
  `status` enum('diajukan','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(8, 'sofi', 'sofi', 'sofi', 'sofi@gmail.com', NULL, '$2y$12$S8921LxzEJwQRUq6dIWIG.9dvDAHJKQPZx.IpsGIXvgjDRt92.wHC', NULL, '2026-01-18 19:55:21', '2026-01-18 19:55:21', 'user'),
(9, 'riris', 'riris', 'riris', 'riris@gmail.com', NULL, '$2y$12$WQuCNm7iRw/NFTzwUOYFXOj1GL4vldfAOvcUD1wU6ddV2pJaehsm.', NULL, '2026-01-18 21:32:40', '2026-01-18 21:32:40', 'user');

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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `pembayarans_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `permintaans`
--
ALTER TABLE `permintaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaans_user_id_foreign` (`user_id`),
  ADD KEY `permintaans_hewan_id_foreign` (`hewan_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `permintaans`
--
ALTER TABLE `permintaans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Ketidakleluasaan untuk tabel `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permintaans`
--
ALTER TABLE `permintaans`
  ADD CONSTRAINT `permintaans_hewan_id_foreign` FOREIGN KEY (`hewan_id`) REFERENCES `hewan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permintaans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
