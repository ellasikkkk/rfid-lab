-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 02:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rfid-lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_keluar` datetime DEFAULT NULL,
  `statuswaktu` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `siswa_id`, `jadwal_id`, `jam_masuk`, `jam_keluar`, `statuswaktu`, `created_at`, `updated_at`) VALUES
(10, 13, NULL, '2025-09-27 18:34:30', '2025-09-27 18:36:24', 'Tepat Waktu', NULL, NULL),
(11, 11, NULL, '2025-09-27 18:46:23', '2025-09-27 18:46:37', 'Tepat Waktu', NULL, NULL),
(12, 13, NULL, '2025-09-27 18:58:19', '2025-09-27 19:07:36', 'Tepat Waktu', NULL, NULL),
(14, 15, NULL, '2025-09-27 19:18:52', '2025-09-27 19:19:17', 'Terlambat', NULL, NULL),
(15, 16, NULL, '2025-09-27 19:19:04', '2025-09-27 19:19:14', 'Terlambat', NULL, NULL),
(16, 16, NULL, '2025-09-29 09:10:18', '2025-09-29 09:10:32', 'Tepat Waktu', NULL, NULL),
(17, 16, NULL, '2025-09-29 09:12:27', NULL, 'Tepat Waktu', NULL, NULL),
(18, 16, NULL, '2025-10-05 13:38:23', '2025-10-05 14:31:35', 'Tepat Waktu', NULL, NULL),
(19, 16, 40, '2025-10-11 01:08:32', '2025-10-11 01:08:45', 'Tepat Waktu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `absensi_jurnal`
--

CREATE TABLE `absensi_jurnal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jurnal_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `waktu_hadir` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi_jurnal`
--

INSERT INTO `absensi_jurnal` (`id`, `jurnal_id`, `siswa_id`, `waktu_hadir`) VALUES
(5, 3, 16, '2025-10-05 07:51:23'),
(6, 3, 13, '2025-10-05 07:51:23'),
(7, 4, 16, '2025-10-10 16:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `nama_perangkat` varchar(255) NOT NULL,
  `lab_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `unique_id`, `nama_perangkat`, `lab_id`, `created_at`, `updated_at`) VALUES
(1, 'LAB-TKJ-deyar', 'Reader Pintu Masuk Lab TKJ deyar', 1, '2025-09-27 11:09:50', '2025-09-27 11:56:06'),
(2, 'LAB-TKJ-sukur', 'Reader Pintu Masuk Lab TKJ sukur', 2, '2025-09-27 11:56:23', '2025-09-27 11:56:23');

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
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id`, `nama_guru`, `nip`, `created_at`, `updated_at`) VALUES
(1, 'deyar cipta', '12345678876543234545954', '2025-10-10 17:25:31', '2025-10-10 17:25:31'),
(2, 'sukur', 'awdasda', '2025-10-10 17:53:40', '2025-10-10 17:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam_ke` varchar(50) DEFAULT NULL,
  `mapel` varchar(255) NOT NULL,
  `nama_guru` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lab_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `hari`, `jam_ke`, `mapel`, `nama_guru`, `kelas`, `jurusan`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`, `lab_id`) VALUES
(36, 'Sunday', '1 s/d 2', 'telekomunikasi', 'deyar cipta', 'X TKJ', 'TKJ', '14:26:00', '15:26:00', '2025-10-05 07:26:34', '2025-10-10 17:44:46', 1),
(37, 'Monday', '1 s/d 2', 'telekinesis', 'deyar cipta', 'X TKJ', 'TKJ', '00:45:00', '00:46:00', '2025-10-10 17:51:38', '2025-10-10 17:51:38', 1),
(38, 'Tuesday', '1 s/d 2', 'telekinesis', 'deyar cipta', 'XII TKJ', 'TKJ', '00:51:00', '00:53:00', '2025-10-10 17:52:04', '2025-10-10 18:01:17', 2),
(39, 'Monday', '1 s/d 3', 'telekinesis', 'sukur', 'XI TKJ', 'TKJ', '00:54:00', '00:55:00', '2025-10-10 17:54:07', '2025-10-10 17:54:07', 2),
(40, 'Saturday', '1 s/d 2', 'telekinesis', 'deyar cipta', 'X TKJ', 'TKJ', '01:08:00', '01:09:00', '2025-10-10 18:08:29', '2025-10-10 18:08:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jurnals`
--

CREATE TABLE `jurnals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `mata_pelajaran` varchar(255) NOT NULL,
  `materi` text NOT NULL,
  `foto_kegiatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurnals`
--

INSERT INTO `jurnals` (`id`, `tanggal`, `jam_mulai`, `jam_selesai`, `nama_guru`, `kelas`, `mata_pelajaran`, `materi`, `foto_kegiatan`, `created_at`, `updated_at`) VALUES
(3, '2025-10-05', '14:52:00', '15:51:00', 'deyar cipta', 'X TKJ', 'pengalaman jaringan', 'awds', 'public/jurnal_photos/CyNoBEu4G06bb0YQRvjxKEBaSDHGfAmdlGFSMJUB.png', '2025-10-05 07:51:20', '2025-10-05 07:53:30'),
(4, '2025-10-10', '23:41:00', '23:57:00', 'deyar cipta', 'X TKJ', 'apa', 'awdaswda', 'public/jurnal_photos/Iq6hFwR9rXvcHPmQCW7vuSI9UcyvjxssYFCHhTNd.png', '2025-10-10 16:41:47', '2025-10-10 16:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lab` varchar(255) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `nama_lab`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'Lab Tkj Deyar', 'gedung b lantai 3', NULL, '2025-09-27 11:44:48'),
(2, 'Lab Tkj Sukur', 'abcd', NULL, '2025-09-27 11:44:58'),
(3, 'Lab boga', 'gatau dimana', '2025-09-27 11:45:19', '2025-09-27 11:45:19'),
(4, 'lab perhotelan', 'au dah', '2025-09-27 11:45:49', '2025-09-27 11:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `nama_mapel`, `jurusan`, `created_at`, `updated_at`) VALUES
(1, 'telekinesis', 'TKJ', '2025-10-10 17:05:30', '2025-10-10 17:05:30');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_22_163559_create_tambah_table', 1),
(6, '2025_07_25_092343_add_status_to_rfid_table', 2),
(7, '2025_09_21_172717_create_jadwals_table', 3),
(8, '2025_09_25_144156_create_labs_table', 4),
(9, '2025_09_25_150600_create_devices_table', 5),
(10, '2025_09_25_150832_add_lab_id_to_jadwals_table', 6),
(11, '2025_10_05_134207_add_nama_guru_to_jadwals_table', 7),
(12, '2025_10_05_143537_create_jurnals_table', 8),
(13, '2025_10_05_143605_create_absensi_jurnal_table', 8),
(14, '2025_10_10_234728_create_mata_pelajarans_table', 9),
(15, '2025_10_10_234921_create_gurus_table', 9);

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

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `uid`, `nama`, `kelas`, `created_at`, `updated_at`) VALUES
(11, 'A39463A0', 'pin biru', 'XI Boga', NULL, NULL),
(13, 'B176281D', 'kartu putih', 'X TKJ', NULL, NULL),
(15, 'BOTT1234', 'bot4', 'X Perhotelan', NULL, NULL),
(16, 'BOTT12345', 'bot5', 'X TKJ', NULL, NULL),
(17, 'BOTT123', 'botol', 'XI Perhotelan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tambah`
--

CREATE TABLE `tambah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL DEFAULT 'siswa',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Admin Utama', 'admin@gmail.com', NULL, '$2y$10$/z13YUg1gVPUfNjdZs6lh..O9GL/P5rzSymKWdaHhRqf52OpbiEe.', 'admin', NULL, '2025-09-14 06:36:24', '2025-09-14 06:36:24'),
(5, 'Guru Satu', 'guru@gmail.com', NULL, '$2y$10$/z13YUg1gVPUfNjdZs6lh..O9GL/P5rzSymKWdaHhRqf52OpbiEe.', 'guru', NULL, '2025-09-14 06:36:24', '2025-09-14 06:36:24'),
(6, 'Siswa Pertama', 'siswa@gmail.com', NULL, '$2y$10$/z13YUg1gVPUfNjdZs6lh..O9GL/P5rzSymKWdaHhRqf52OpbiEe.', 'siswa', NULL, '2025-09-14 06:36:24', '2025-09-14 06:36:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_siswa_id_foreign` (`siswa_id`),
  ADD KEY `absensi_jadwal_id_foreign` (`jadwal_id`);

--
-- Indexes for table `absensi_jurnal`
--
ALTER TABLE `absensi_jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_jurnal_jurnal_id_foreign` (`jurnal_id`),
  ADD KEY `absensi_jurnal_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `devices_unique_id_unique` (`unique_id`),
  ADD KEY `devices_lab_id_foreign` (`lab_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gurus_nama_guru_unique` (`nama_guru`),
  ADD UNIQUE KEY `gurus_nip_unique` (`nip`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwals_lab_id_foreign` (`lab_id`);

--
-- Indexes for table `jurnals`
--
ALTER TABLE `jurnals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mata_pelajarans_nama_mapel_unique` (`nama_mapel`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_uid_unique` (`uid`);

--
-- Indexes for table `tambah`
--
ALTER TABLE `tambah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tambah_tag_unique` (`tag`);

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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `absensi_jurnal`
--
ALTER TABLE `absensi_jurnal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `jurnals`
--
ALTER TABLE `jurnals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tambah`
--
ALTER TABLE `tambah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwals` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `absensi_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `absensi_jurnal`
--
ALTER TABLE `absensi_jurnal`
  ADD CONSTRAINT `absensi_jurnal_jurnal_id_foreign` FOREIGN KEY (`jurnal_id`) REFERENCES `jurnals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_jurnal_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_lab_id_foreign` FOREIGN KEY (`lab_id`) REFERENCES `labs` (`id`);

--
-- Constraints for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD CONSTRAINT `jadwals_lab_id_foreign` FOREIGN KEY (`lab_id`) REFERENCES `labs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
