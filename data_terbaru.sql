-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2025 at 03:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mytpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `penyelenggara` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `judul`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `lokasi`, `penyelenggara`, `kategori`, `gambar`, `aktif`, `created_at`, `updated_at`) VALUES
(7, 'Seminar: Arsitektur Serverless untuk Aplikasi Skala Besar', 'Seminar mendalam mengenai implementasi arsitektur serverless, studi kasus di AWS Lambda dan Azure Functions, serta dampaknya terhadap DevOps dan biaya operasional. Wajib bagi mahasiswa semester akhir.', '2025-12-15 10:00:00', '2025-12-15 13:00:00', 'Gedung Auditorium Utama Lt. 5', 'Prodi TPL & Himpunan Mahasiswa', 'seminar', NULL, 1, '2025-11-25 06:41:44', '2025-11-25 06:41:44'),
(8, 'Workshop Intensif Pengembangan Aplikasi Berbasis Docker dan Kubernetes', 'Pelatihan praktis selama dua hari penuh bagi pengembang untuk menguasai containerization menggunakan Docker dan orkestrasi skala besar dengan Kubernetes.', '2026-01-10 09:00:00', '2026-01-11 17:00:00', 'Lab Komputer 301 (Gedung B)', 'Lab Komputasi Lanjut', 'workshop', NULL, 1, '2025-11-25 06:41:53', '2025-11-25 06:41:53'),
(9, 'Rapat Persiapan Akreditasi Program Studi', 'Rapat koordinasi mingguan tim akreditasi untuk mengevaluasi progres penyusunan dokumen LKPS dan LED. Semua anggota tim akreditasi diwajibkan hadir tepat waktu.', '2025-12-02 14:30:00', '2025-12-02 16:00:00', 'Ruang Rapat Dekanat', 'Ketua Prodi', 'rapat', NULL, 1, '2025-11-25 06:42:00', '2025-11-25 06:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `nim`, `created_at`, `updated_at`, `tahun_lulus`) VALUES
(50, '2020133003', '2025-11-25 05:48:53', '2025-11-25 05:51:05', '2024'),
(51, '2020133001', '2025-11-25 05:49:15', '2025-11-25 05:51:01', '2024'),
(52, '2020133005', '2025-11-25 05:49:20', '2025-11-25 05:50:56', '2024'),
(53, '2020133004', '2025-11-25 05:49:23', '2025-11-25 05:50:52', '2024'),
(54, '2020133002', '2025-11-25 05:49:31', '2025-11-25 05:50:48', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `is_prestasi` tinyint(1) NOT NULL DEFAULT 0,
  `nama_mahasiswa` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `program_studi` varchar(255) DEFAULT NULL,
  `tingkat_prestasi` varchar(255) DEFAULT NULL,
  `jenis_prestasi` varchar(255) DEFAULT NULL,
  `penyelenggara` varchar(255) DEFAULT NULL,
  `tanggal_prestasi` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `gambar`, `penulis`, `tanggal`, `is_prestasi`, `nama_mahasiswa`, `nim`, `program_studi`, `tingkat_prestasi`, `jenis_prestasi`, `penyelenggara`, `tanggal_prestasi`, `created_at`, `updated_at`) VALUES
(7, 'Prodi TPL Menjalin Kerja Sama Strategis dengan Perusahaan X', 'Universitas Universal melalui Program Studi Teknologi Perangkat Lunak (TPL) secara resmi menandatangani Memorandum of Understanding (MoU) dengan PT. Solusi Digital X. Kerjasama ini meliputi program magang, proyek riset bersama, dan pengembangan kurikulum yang relevan dengan kebutuhan industri 4.0.', 'berita/1764077747_02f2b5b1-7bcc-4481-9b9e-dbdb9c726924.jpeg', 'Humas TPL', '2025-11-25', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-25 06:35:47', '2025-11-25 06:35:47'),
(8, 'Mahasiswa TPL Raih Juara 1 Kompetisi Coding Tingkat Provinsi', 'Selamat kepada tim mahasiswa TPL yang berhasil meraih juara pertama dalam kompetisi \'Fast Coding Challenge 2025\' yang diselenggarakan oleh Asosiasi Programmer Lokal. Tim kami mengungguli 50 tim lainnya dari berbagai kampus.', 'berita/1764077801_I0U4CWof_400x400.jpg', 'Admin', '2025-11-20', 1, 'Budi Wirya', '2020133001', 'Teknologi Perangkat Lunak', 'Regional', 'Akademik (Programming)', 'Asosiasi Programmer Lokal', '2025-11-18', '2025-11-25 06:36:41', '2025-11-25 06:36:41'),
(9, 'Tim TPL Juara Inovasi UI/UX Tingkat Asia Tenggara di Singapore', 'Mahasiswa TPL memenangkan penghargaan Inovasi Terbaik pada ajang Southeast Asia Tech Innovation Summit berkat desain antarmuka pengguna yang inklusif dan ramah disabilitas untuk platform layanan publik digital.', 'berita/1764077838_3-9.jpg', 'Humas TPL', '2025-10-10', 1, 'Abelina Stevie Maria Trafin', '2023133006', 'Teknologi Perangkat Lunak', 'Internasional', 'Non-Akademik (Inovasi/Desain)', 'SEA Tech Innovation Summit', '2025-10-09', '2025-11-25 06:37:18', '2025-11-25 06:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) DEFAULT NULL,
  `bidang_keahlian` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `google_scholar_link` varchar(255) DEFAULT NULL,
  `sinta_link` varchar(255) DEFAULT NULL,
  `scopus_link` varchar(255) DEFAULT NULL,
  `prodi` varchar(255) NOT NULL DEFAULT 'Teknik Perangkat Lunak',
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `nama`, `email`, `no_hp`, `jenis_kelamin`, `jabatan`, `pendidikan_terakhir`, `bidang_keahlian`, `alamat`, `foto`, `google_scholar_link`, `sinta_link`, `scopus_link`, `prodi`, `status`, `created_at`, `updated_at`) VALUES
(28, '1008028803', 'Eka Lia Febrianti, S.Kom., M.Kom.', 'ekaliafebrianti@gmail.com', '081122334455', 'Perempuan', 'Ketua LPPM & Senat', 'S2', 'Komputer', 'Rumah Uvers', 'dosen/1764073203_citations.jpeg', 'https://scholar.google.com/citations?user=W3EYMosAAAAJ&hl=en', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6703208', NULL, 'Teknik Perangkat Lunak', 'Aktif', '2025-11-25 05:20:03', '2025-11-25 05:37:32'),
(29, '0427019401', 'Ilwan Syafrinal, S.Kom., M.Kom.', 'ilwansyayfrinal@uvers.ac.id', '081222123231', 'Laki-laki', 'Sekretaris', 'S2', 'Komputer', 'Rumah Uvers', 'dosen/1764073406_citations (1).jpeg', 'https://scholar.google.com/citations?user=BUh87A8AAAAJ&hl=id', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6719142', 'https://www.scopus.com/authid/detail.uri?authorId=57222625861', 'Teknik Perangkat Lunak', 'Aktif', '2025-11-25 05:23:26', '2025-11-25 05:35:32'),
(30, '1009059501', 'Kaharuddin, S.Kom., M.Kom.', 'kaharuddin@uvers.ac.id', '08122130123', 'Laki-laki', 'Koprodi', 'S2', 'Komputer', 'Rumah Uvers', 'dosen/1764073672_citations (2).jpeg', 'https://scholar.google.com/citations?user=BUh87A8AAAAJ&hl=id', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6753445', 'https://www.scopus.com/authid/detail.uri?authorId=57213687107', 'Teknik Perangkat Lunak', 'Aktif', '2025-11-25 05:27:52', '2025-11-25 05:36:52'),
(31, '1249069502', 'Masparudin. S.Kom., M.Kom.', 'masparudin@uvers.ac.id', '081281293129', 'Laki-laki', 'Dosen', 'S2', 'Komputer', 'Rumah Uvers', 'dosen/1764074454_citations (3).jpeg', 'https://scholar.google.com/citations?user=PDsq124AAAAJ&hl=id', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6975958', NULL, 'Teknik Perangkat Lunak', 'Aktif', '2025-11-25 05:40:54', '2025-11-25 05:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `fotografer` varchar(255) DEFAULT NULL,
  `tampilkan_di_home` tinyint(1) NOT NULL DEFAULT 0,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `foto`, `kategori`, `tanggal`, `fotografer`, `tampilkan_di_home`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 'Wisuda Sarjana Angkatan 2024', 'Prosesi wisuda sarjana program studi Teknik Informatika angkatan 2024 yang dihadiri oleh 150 lulusan berprestasi. Acara dilaksanakan di Gedung Auditorium Utama dengan khidmat dan meriah.', 'galeri/wisuda.jpg', 'akademik', '2024-10-15', 'Tim Humas', 1, 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(2, 'Laboratorium Komputer Terbaru', 'Fasilitas laboratorium komputer yang baru direnovasi dengan perangkat terkini. Dilengkapi dengan 50 unit komputer spesifikasi tinggi, AC, dan koneksi internet berkecepatan tinggi.', 'galeri/lab.jpg', 'fasilitas', '2024-09-20', 'Admin Lab', 1, 2, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(3, 'Pelatihan Leadership HMTI', 'Kegiatan pelatihan kepemimpinan untuk pengurus Himpunan Mahasiswa Teknik Informatika periode 2024/2025. Diikuti oleh 40 peserta dengan materi team building dan public speaking.', 'galeri/leadership.jpg', 'kemahasiswaan', '2024-09-10', 'Dokumentasi HMTI', 0, 3, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(4, 'Bakti Sosial di Desa Sukamaju', 'Kegiatan pengabdian masyarakat yang diikuti mahasiswa TI berupa pelatihan komputer dasar untuk warga desa. Kegiatan berlangsung selama 2 hari dengan antusias tinggi dari peserta.', 'galeri/baksos.jpg', 'kemahasiswaan', '2024-08-25', 'Panitia Baksos', 0, 4, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(5, 'Seminar Artificial Intelligence', 'Seminar nasional dengan tema \"AI for Better Future\" yang menghadirkan praktisi dan akademisi terkemuka. Dihadiri oleh 300 peserta dari berbagai universitas se-Indonesia.', 'galeri/seminar-ai.jpg', 'kegiatan', '2024-10-05', 'Tim Media', 1, 5, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(6, 'Workshop Cloud Computing', 'Workshop hands-on tentang implementasi cloud computing menggunakan AWS dan Google Cloud. Peserta mendapatkan sertifikat dan akses gratis cloud resources selama 3 bulan.', 'galeri/workshop-cloud.jpg', 'kegiatan', '2024-09-28', 'Lab Cloud Computing', 1, 6, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(7, 'Juara 1 Hackathon Nasional 2024', 'Tim mahasiswa TI meraih juara 1 dalam ajang Hackathon Indonesia 2024 dengan mengembangkan aplikasi smart farming berbasis AI. Mengalahkan 100+ tim dari seluruh Indonesia.', 'galeri/juara-hackathon.jpg', 'prestasi', '2024-10-10', 'Panitia Lomba', 1, 7, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(8, 'Medali Emas ACM ICPC Asia', 'Prestasi membanggakan tim programming TI yang meraih medali emas di kompetisi ACM ICPC regional Asia. Ini merupakan pencapaian terbaik dalam sejarah program studi.', 'galeri/medali-icpc.jpg', 'prestasi', '2024-10-03', 'Pendamping Tim', 1, 8, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(9, 'Perpustakaan Digital Modern', 'Perpustakaan digital dengan koleksi 10,000+ e-book dan jurnal internasional. Dilengkapi dengan ruang baca yang nyaman, AC, dan WiFi berkecepatan tinggi.', 'galeri/perpustakaan.jpg', 'fasilitas', '2024-08-15', 'Tim Perpustakaan', 0, 9, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(10, 'Ruang Co-working Space', 'Fasilitas co-working space untuk mahasiswa yang ingin bekerja tim atau mengerjakan project. Tersedia meeting room, whiteboard, dan fasilitas presentasi lengkap.', 'galeri/coworking.jpg', 'fasilitas', '2024-09-01', 'Admin Fasilitas', 0, 10, '2025-11-12 06:31:43', '2025-11-12 06:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `kisah_sukses`
--

CREATE TABLE `kisah_sukses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kisah` text NOT NULL,
  `pencapaian` varchar(255) DEFAULT NULL,
  `tahun_pencapaian` year(4) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Draft','Published') NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kisah_sukses`
--

INSERT INTO `kisah_sukses` (`id`, `nim`, `judul`, `kisah`, `pencapaian`, `tahun_pencapaian`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(4, '2020133001', 'Dari Kampus ke CEO: Kisah Budiwirya Mendirikan Tech Startup \'TPL Labs\'', 'Setelah lulus, saya menyadari peluang besar di pasar aplikasi edukasi berbasis AI. Ilmu rekayasa perangkat lunak yang didapat di TPL sangat fundamental, terutama dalam merancang arsitektur microservices dan mengelola tim pengembang. Tantangannya adalah funding, tapi berkat portofolio proyek di kampus, kami berhasil menarik investor awal.', 'CEO & Co-Founder, TPL Labs (Valuasi > 5 Miliar IDR)', '2025', 'kisah-sukses/L1efc6GYkUgxqFVzz0F1gcD70euyw4Z6PMV00dS4.png', 'Published', '2025-11-25 06:52:29', '2025-11-25 06:52:29'),
(5, '2020133002', 'Membangun Sistem Global: Pengalaman Budiwirya sebagai Senior Software Engineer di Singapura', 'Setelah lulus, saya langsung bekerja di Jakarta selama 2 tahun dan mendapatkan pengalaman yang cukup. Saya kemudian berhasil lolos sebagai Software Engineer di salah satu MNC di Singapura. Di sana, tantangannya adalah kolaborasi lintas budaya dan penggunaan teknologi bleeding edge. Kunci suksesnya adalah fondasi algoritma dan struktur data yang kuat dari TPL.', 'Senior Software Engineer di Perusahaan Tech Global X', '2024', 'kisah-sukses/kyJDjm043VwDW7ZnNsOWvmEeNEhfe6FGUpkfATeR.png', 'Published', '2025-11-25 06:55:13', '2025-11-25 06:55:57'),
(6, '2020133003', 'Melangkah ke Dunia Riset: Alumni TPL Raih Beasiswa Penuh Studi Lanjut ke Eropa', 'Latar belakang riset selama skripsi di TPL menjadi modal utama untuk mendapatkan beasiswa studi Master di Eropa. Saat ini fokus pada penelitian machine learning untuk optimasi alokasi sumber daya komputasi. Harapannya, ilmu ini bisa diterapkan kembali untuk memajukan pendidikan di Indonesia.', 'Peraih Beasiswa Penuh S2 di Technical University of Munich (TUM)', '2024', 'kisah-sukses/EuDKUD5tDjsi8apLnjDmDmbWAznq24XsXgBERru7.png', 'Published', '2025-11-25 06:55:46', '2025-11-25 06:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_matkul` varchar(255) NOT NULL,
  `nama_matkul` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL,
  `sks` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kurikulum`
--

INSERT INTO `kurikulum` (`id`, `kode_matkul`, `nama_matkul`, `semester`, `sks`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'TPL101', 'Dasar Pemrograman', 1, 4, 'Mata kuliah pengenalan konsep dasar pemrograman menggunakan bahasa C/C++, mencakup algoritma, struktur data dasar, dan logika pemrograman.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(2, 'TPL102', 'Matematika Diskrit', 1, 3, 'Mempelajari logika matematika, teori himpunan, relasi, fungsi, graf, dan pohon yang menjadi dasar ilmu komputer.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(3, 'TPL103', 'Pengantar Teknologi Informasi', 1, 3, 'Pengenalan konsep dasar TI, hardware, software, jaringan komputer, dan aplikasi teknologi informasi dalam kehidupan.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(4, 'TPL104', 'Bahasa Inggris Teknik', 1, 2, 'Meningkatkan kemampuan berbahasa Inggris dalam konteks teknik dan teknologi informasi.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(5, 'TPL201', 'Pemrograman Berorientasi Objek', 2, 4, 'Mempelajari paradigma OOP dengan Java, mencakup class, object, inheritance, polymorphism, encapsulation, dan abstraction.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(6, 'TPL202', 'Struktur Data dan Algoritma', 2, 4, 'Mempelajari struktur data lanjut (linked list, stack, queue, tree, graph) dan algoritma sorting, searching, dan graph traversal.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(7, 'TPL203', 'Basis Data', 2, 3, 'Konsep database relasional, normalisasi, SQL, ER diagram, dan implementasi database dengan MySQL/PostgreSQL.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(8, 'TPL204', 'Sistem Digital', 2, 3, 'Mempelajari logika digital, aljabar boolean, gerbang logika, flip-flop, dan rangkaian digital.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(9, 'TPL301', 'Pemrograman Web', 3, 4, 'Pengembangan aplikasi web menggunakan HTML, CSS, JavaScript, PHP, dan framework Laravel.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(10, 'TPL302', 'Desain dan Analisis Algoritma', 3, 3, 'Analisis kompleksitas algoritma, divide and conquer, dynamic programming, greedy algorithm, dan algoritma lanjutan.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(11, 'TPL303', 'Rekayasa Perangkat Lunak', 3, 3, 'SDLC, requirement engineering, software design, testing, dan project management dalam pengembangan software.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(12, 'TPL304', 'Sistem Operasi', 3, 3, 'Konsep OS, process management, memory management, file system, I/O, dan Linux system administration.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(13, 'TPL401', 'Pemrograman Mobile', 4, 4, 'Pengembangan aplikasi mobile native dengan Kotlin/Swift atau cross-platform dengan Flutter/React Native.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(14, 'TPL402', 'Jaringan Komputer', 4, 3, 'Protokol jaringan, TCP/IP, OSI layer, routing, switching, network security, dan wireless network.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(15, 'TPL403', 'Interaksi Manusia dan Komputer', 4, 3, 'Prinsip UI/UX design, user research, wireframing, prototyping, usability testing, dan design thinking.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(16, 'TPL404', 'Keamanan Informasi', 4, 3, 'Kriptografi, authentication, authorization, penetration testing, secure coding, dan cyber security best practices.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(17, 'TPL501', 'Cloud Computing', 5, 3, 'Konsep cloud, IaaS/PaaS/SaaS, deployment menggunakan AWS/Azure/GCP, containerization dengan Docker, dan orchestration dengan Kubernetes.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(18, 'TPL502', 'Kecerdasan Buatan', 5, 3, 'Konsep AI, search algorithms, knowledge representation, machine learning basics, neural networks, dan AI applications.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(19, 'TPL503', 'Manajemen Proyek TI', 5, 3, 'Project management methodologies (Agile, Scrum, Kanban), sprint planning, team collaboration, dan project tools (Jira, Trello).', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(20, 'TPL504', 'Data Mining', 5, 3, 'Data preprocessing, classification, clustering, association rules, text mining, dan implementasi dengan Python (scikit-learn, pandas).', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(21, 'TPL601', 'DevOps dan CI/CD', 6, 3, 'DevOps culture, continuous integration, continuous deployment, pipeline automation dengan Jenkins/GitLab CI, infrastructure as code.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(22, 'TPL602', 'Machine Learning', 6, 4, 'Supervised/unsupervised learning, regression, classification, neural networks, deep learning dengan TensorFlow/PyTorch.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(23, 'TPL603', 'Arsitektur Perangkat Lunak', 6, 3, 'Software architecture patterns (MVC, microservices, event-driven), design patterns, scalability, dan performance optimization.', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(24, 'TPL604', 'Etika Profesi TI', 6, 2, 'Kode etik profesi, intellectual property, privacy, hukum siber, dan tanggung jawab profesional di bidang TI.', '2025-11-12 06:31:43', '2025-11-12 06:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Aktif','Lulus','Cuti','DO') NOT NULL DEFAULT 'Aktif',
  `tahun_lulus` year(4) DEFAULT NULL,
  `prodi` varchar(255) NOT NULL DEFAULT 'Teknik Perangkat Lunak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `email`, `no_hp`, `jenis_kelamin`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `tahun_masuk`, `kelas`, `foto`, `status`, `tahun_lulus`, `prodi`, `created_at`, `updated_at`) VALUES
(62, '2023133001', 'Peter Pangaribuan', 'peterpangaribuan@uvers.ac.id', '0812831823', 'Laki-laki', 'Batam', 'Batam', '2000-10-10', '2023', 'TPL-A', NULL, 'Aktif', NULL, 'Teknik Perangkat Lunak', '2025-11-25 05:31:25', '2025-11-25 05:31:25'),
(63, '2023133003', 'Andrew Xu', 'andrewxu@uvers.ac.id', '081102902191', 'Laki-laki', 'Batam', 'Batam', NULL, '2023', 'TPL-A', NULL, 'Aktif', NULL, 'Teknik Perangkat Lunak', '2025-11-25 05:42:54', '2025-11-25 05:46:37'),
(64, '2023133004', 'Yifa Brayden', 'yifabrayden@uvers.ac.id', '08128123819', 'Laki-laki', 'Batam', 'Batam', NULL, '2023', 'TPL-A', NULL, 'Aktif', NULL, 'Teknik Perangkat Lunak', '2025-11-25 05:43:28', '2025-11-25 05:46:22'),
(65, '2023133005', 'Sidartha David Setia', 'sidarta@uvers.ac.id', '08128129319', 'Laki-laki', 'Batam', 'Batam', NULL, '2023', 'TPL-A', NULL, 'Aktif', NULL, 'Teknik Perangkat Lunak', '2025-11-25 05:43:58', '2025-11-25 05:46:30'),
(66, '2023133006', 'Abelina Stevie Maria Trafin', 'abelina@uvers.ac.id', '081293193112', 'Perempuan', 'Batam', 'Batam', NULL, '2023', 'TPL-A', NULL, 'Aktif', NULL, 'Teknik Perangkat Lunak', '2025-11-25 05:44:42', '2025-11-25 05:46:44'),
(67, '2020133001', 'Budiwirya', 'bud@uvers.ac.id', NULL, 'Laki-laki', NULL, NULL, NULL, '2020', NULL, NULL, 'Lulus', '2025', 'Teknik Perangkat Lunak', '2025-11-25 05:45:48', '2025-11-25 05:49:15'),
(68, '2020133002', 'Willya', 'w@uve.ac', NULL, 'Perempuan', NULL, NULL, NULL, '2020', NULL, NULL, 'Lulus', '2025', 'Teknik Perangkat Lunak', '2025-11-25 05:47:10', '2025-11-25 05:49:31'),
(69, '2020133003', 'Angel', 'a@u.ac', NULL, 'Perempuan', NULL, NULL, NULL, '2020', NULL, NULL, 'Lulus', '2025', 'Teknik Perangkat Lunak', '2025-11-25 05:47:46', '2025-11-25 05:48:53'),
(70, '2020133004', 'Michael', 'm@u.a', NULL, 'Laki-laki', NULL, NULL, NULL, '2020', NULL, NULL, 'Lulus', '2025', 'Teknik Perangkat Lunak', '2025-11-25 05:48:09', '2025-11-25 05:49:23'),
(71, '2020133005', 'Kevin', 'a@k.c', NULL, 'Laki-laki', NULL, NULL, NULL, '2020', NULL, NULL, 'Lulus', '2025', 'Teknik Perangkat Lunak', '2025-11-25 05:48:35', '2025-11-25 05:49:20'),
(72, '2020133006', 'Vivian', 'v@v.c', NULL, 'Perempuan', NULL, NULL, NULL, '2020', NULL, NULL, 'Aktif', NULL, 'Teknik Perangkat Lunak', '2025-11-25 05:49:51', '2025-11-25 05:49:51'),
(73, '2020133007', 'Rebina', 'r@s.c', NULL, 'Perempuan', NULL, NULL, NULL, '2020', NULL, NULL, 'Aktif', NULL, 'Teknik Perangkat Lunak', '2025-11-25 05:50:28', '2025-11-25 05:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `mk_id` bigint(20) UNSIGNED NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `program_studi` varchar(255) NOT NULL DEFAULT 'Teknik Perangkat Lunak',
  `kurikulum_tahun` year(4) DEFAULT NULL,
  `deskripsi_singkat` text DEFAULT NULL,
  `status_wajib` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`mk_id`, `kode_mk`, `nama_mk`, `sks`, `semester`, `program_studi`, `kurikulum_tahun`, `deskripsi_singkat`, `status_wajib`, `created_at`, `updated_at`) VALUES
(1, 'TPL101', 'Pemrograman Dasarn', 4, 1, 'Teknik Perangkat Lunak', '2024', 'Pengenalan konsep dasar pemrograman menggunakan Python', 1, '2025-11-12 06:31:43', '2025-11-18 06:30:14'),
(2, 'TPL102', 'Matematika Diskrit', 3, 1, 'Teknik Perangkat Lunak', '2024', 'Logika, himpunan, relasi, dan graf', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(3, 'TPL103', 'Algoritma dan Struktur Data', 4, 1, 'Teknik Perangkat Lunak', '2024', 'Konsep algoritma, kompleksitas, dan struktur data dasar', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(4, 'TPL104', 'Bahasa Inggris Teknik', 2, 1, 'Teknik Perangkat Lunak', '2024', 'Bahasa Inggris untuk komunikasi teknis', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(5, 'TPL201', 'Pemrograman Berorientasi Objek', 4, 2, 'Teknik Perangkat Lunak', '2024', 'Konsep OOP menggunakan Java', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(6, 'TPL202', 'Basis Data', 4, 2, 'Teknik Perangkat Lunak', '2024', 'Desain database, SQL, dan normalisasi', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(7, 'TPL203', 'Sistem Operasi', 3, 2, 'Teknik Perangkat Lunak', '2024', 'Konsep sistem operasi dan manajemen resource', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(8, 'TPL204', 'Statistika dan Probabilitas', 3, 2, 'Teknik Perangkat Lunak', '2024', 'Statistika deskriptif dan inferensial', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(9, 'TPL301', 'Pemrograman Web', 4, 3, 'Teknik Perangkat Lunak', '2024', 'HTML, CSS, JavaScript, dan PHP', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(10, 'TPL302', 'Rekayasa Perangkat Lunak', 4, 3, 'Teknik Perangkat Lunak', '2024', 'Software development lifecycle dan metodologi', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(11, 'TPL303', 'Jaringan Komputer', 3, 3, 'Teknik Perangkat Lunak', '2024', 'Protokol jaringan dan arsitektur TCP/IP', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(12, 'TPL304', 'Interaksi Manusia dan Komputer', 3, 3, 'Teknik Perangkat Lunak', '2024', 'UI/UX design principles', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(13, 'TPL401', 'Pemrograman Mobile', 4, 4, 'Teknik Perangkat Lunak', '2024', 'Pengembangan aplikasi Android/iOS', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(14, 'TPL402', 'Manajemen Proyek Perangkat Lunak', 3, 4, 'Teknik Perangkat Lunak', '2024', 'Project management dengan Agile/Scrum', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(15, 'TPL403', 'Keamanan Sistem Informasi', 3, 4, 'Teknik Perangkat Lunak', '2024', 'Security principles dan cryptography', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(16, 'TPL404', 'Machine Learning', 3, 4, 'Teknik Perangkat Lunak', '2024', 'Dasar-dasar ML dan AI', 0, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(17, 'TPL501', 'Framework Pengembangan Web', 4, 5, 'Teknik Perangkat Lunak', '2024', 'Laravel, React, Vue.js', 1, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(18, 'TPL502', 'Cloud Computing', 3, 5, 'Teknik Perangkat Lunak', '2024', 'AWS, Google Cloud, Azure', 0, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(19, 'TPL503', 'DevOps dan CI/CD', 3, 5, 'Teknik Perangkat Lunak', '2024', 'Docker, Kubernetes, Jenkins', 0, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(20, 'TPL504', 'Big Data dan Analytics', 3, 5, 'Teknik Perangkat Lunak', '2024', 'Hadoop, Spark, data processing', 0, '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(21, 'TPL1012', 'akajsdajkdj kern', 4, 5, 'Teknik Perangkat Lunak', '2025', 'loolo', 1, '2025-11-18 07:25:04', '2025-11-18 07:25:04');

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
(1, '2025_11_05_140217_create_new_mahasiswa_table', 1),
(2, '2025_11_05_140248_create_new_alumni_table', 1),
(3, '2025_11_05_140341_create_new_projects_table', 1),
(4, '2025_11_05_140352_create_new_kisah_sukses_table', 1),
(5, '2025_11_05_140414_create_new_tracer_study_table', 1),
(6, '2025_11_05_140914_create_users_table', 1),
(7, '2025_11_05_142056_create_dosen_table', 1),
(8, '2025_11_05_142131_create_penelitian_table', 1),
(9, '2025_11_05_142139_create_pkm_table', 1),
(10, '2025_11_05_142504_create_penelitian_mahasiswa_table', 1),
(11, '2025_11_05_142520_create_pkm_mahasiswa_table', 1),
(12, '2025_11_11_114519_create_sessions_table', 1),
(13, '2025_11_11_121015_create_matakuliah_table', 1),
(14, '2025_11_11_121025_create_agenda_table', 1),
(15, '2025_11_11_121025_create_berita_table', 1),
(16, '2025_11_11_121025_create_galeri_table', 1),
(17, '2025_11_11_121025_create_kurikulum_table', 1),
(18, '2025_11_11_121025_create_pengumuman_table', 1),
(19, '2025_11_11_121025_create_profil_prodi_table', 1),
(20, '2025_11_11_132224_create_peraturan_table', 1),
(21, '2025_11_11_134213_add_academic_links_to_tbl_dosen_table', 1),
(22, '2025_11_19_122600_simplify_alumni_table_remove_unused_fields', 2),
(23, '2025_11_19_124322_rename_tables_remove_tbl_prefix', 3);

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_penelitian` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tahun` year(4) NOT NULL,
  `jenis_penelitian` varchar(255) DEFAULT NULL,
  `sumber_dana` varchar(255) DEFAULT NULL,
  `dana` decimal(15,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Sedang Berjalan',
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `output` text DEFAULT NULL,
  `file_dokumen` varchar(255) DEFAULT NULL,
  `ketua_peneliti_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id`, `judul_penelitian`, `deskripsi`, `tahun`, `jenis_penelitian`, `sumber_dana`, `dana`, `status`, `tanggal_mulai`, `tanggal_selesai`, `output`, `file_dokumen`, `ketua_peneliti_id`, `created_at`, `updated_at`) VALUES
(32, 'Penerapan Machine Learning untuk Klasifikasi Teks Berbahasa Indonesia', 'Penelitian ini bertujuan untuk mengembangkan model machine learning yang efektif dalam mengklasifikasikan dokumen atau teks berbahasa Indonesia ke dalam kategori-kategori yang telah ditentukan.', '2025', 'Hibah Internal', 'Dana Penelitian Universitas', 15000000.00, 'Sedang Berjalan', '2025-01-10', '2025-06-30', 'Jurnal Nasional Sinta 3, Prosiding Seminar Internasional', 'penelitian/dokumen/j2vAJwrdL00EZBUfj65qRjSoW3AYgRa93Z4Shu6F.pdf', 28, '2025-11-25 06:28:26', '2025-11-25 06:28:26'),
(33, 'Pengembangan Aplikasi Mobile E-Learning Berbasis Microservices dengan React Native', 'Penelitian terapan ini berfokus pada implementasi arsitektur microservices untuk mendukung skalabilitas pada aplikasi pembelajaran seluler menggunakan kerangka kerja React Native.', '2026', 'Mandiri', 'Anggaran Dosen Pribadi', 8500000.00, 'Draft', '2026-03-01', '2026-12-31', 'Prototipe Aplikasi, Prosiding Konferensi Nasional', 'penelitian/dokumen/9CWGA4vhn7gaMczLfSG81TGfR6GOntmXyzW1MJws.pdf', 29, '2025-11-25 06:30:20', '2025-11-25 06:30:20'),
(34, 'Analisis dan Mitigasi Kerentanan SQL Injection pada Aplikasi Web Menggunakan Static Code Analysis', 'Penelitian eksploratif mengenai penggunaan tool Static Code Analysis untuk mengidentifikasi pola kerentanan SQL Injection pada kode sumber aplikasi web berbasis PHP dan upaya mitigasinya.', '2024', 'Hibah Dikti', 'Kementerian Pendidikan dan Kebudayaan', 45000000.00, 'Selesai', '2024-01-15', '2024-11-30', 'Jurnal Internasional Terindeks Scopus Q4', 'penelitian/dokumen/nbdMWqrYoHgRr1xYwi1AZeKyuPXOau7ZZLySX3tS.pdf', 31, '2025-11-25 06:31:00', '2025-11-25 06:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `penelitian_mahasiswa`
--

CREATE TABLE `penelitian_mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penelitian_id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `peran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `prioritas` varchar(255) NOT NULL DEFAULT 'normal',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `gambar`, `prioritas`, `tanggal_mulai`, `tanggal_selesai`, `penulis`, `aktif`, `created_at`, `updated_at`) VALUES
(7, 'Perubahan Jadwal Kuliah Semester Genap 2025/2026', 'Diberitahukan kepada seluruh Mahasiswa Program Studi TPL, bahwa terdapat penyesuaian jadwal kuliah untuk beberapa mata kuliah inti. Silakan unduh jadwal terbaru di laman SIAKAD. Perubahan ini efektif mulai lusa.', 'pengumuman/1764078036_02f2b5b1-7bcc-4481-9b9e-dbdb9c726924.jpeg', 'tinggi', '2025-11-26', '2025-12-05', 'Bagian Akademik TPL', 1, '2025-11-25 06:40:36', '2025-11-25 06:40:36'),
(8, 'Seminar Nasional: Masa Depan Pengembangan Software dengan AI Coding Assistant', 'Prodi TPL mengundang seluruh mahasiswa dan dosen untuk menghadiri seminar nasional dengan pembicara Dr. Inovasi (Praktisi AI). Acara ini terbuka untuk umum dan akan diadakan secara daring pada tanggal 10 Desember 2025.', NULL, 'sedang', '2025-11-25', '2025-12-11', 'Kepala Prodi TPL', 1, '2025-11-25 06:40:50', '2025-11-25 06:40:50'),
(9, 'Pengumuman: Maintenance Rutin Server Aplikasi Akademik', 'Akan dilakukan pemeliharaan rutin pada server aplikasi akademik setiap hari Sabtu pukul 03.00 - 05.00 WIB. Akses ke sistem mungkin terganggu dalam periode tersebut. Mohon maklum.', NULL, 'rendah', '2025-12-01', NULL, 'Tim IT TPL', 1, '2025-11-25 06:40:58', '2025-11-25 06:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `peraturan`
--

CREATE TABLE `peraturan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` enum('Akademik','Kemahasiswaan','Administratif','Keuangan') NOT NULL,
  `jenis` enum('Kalender Akademik','Panduan Studi','Skripsi','Magang','Tata Tertib','Kode Etik','Kegiatan','SOP','Surat Menyurat','Cuti Kuliah','Biaya Kuliah','Beasiswa','Denda Keterlambatan') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_size` int(11) DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peraturan`
--

INSERT INTO `peraturan` (`id`, `judul`, `deskripsi`, `kategori`, `jenis`, `file_path`, `file_name`, `file_size`, `urutan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Kalender Akademik 2025/2026', 'Kalender akademik tahun ajaran 2025/2026 yang berisi jadwal kegiatan akademik selama satu tahun.', 'Akademik', 'Kalender Akademik', 'peraturan/1764078366_kalender-akademik-20252026.pdf', 'KALENDAR AKADEMIK 2025:2026.pdf', 13366, 1, 1, '2025-11-12 06:31:43', '2025-11-25 06:46:06'),
(2, 'Panduan Studi Program Studi TPL', 'Panduan studi lengkap untuk mahasiswa Program Studi Teknik Perangkat Lunak.', 'Akademik', 'Panduan Studi', 'peraturan/1764079163_panduan-studi-program-studi-tpl.pdf', 'Panduan Studi Program Studi TPL .pdf', 13698, 2, 1, '2025-11-12 06:31:43', '2025-11-25 06:59:23'),
(3, 'Pedoman Skripsi dan Tugas Akhir', 'Pedoman penulisan skripsi dan tugas akhir untuk mahasiswa tingkat akhir.', 'Akademik', 'Skripsi', 'peraturan/1764079170_pedoman-skripsi-dan-tugas-akhir.pdf', 'Pedoman Skripsi dan Tugas Akhir    .pdf', 14163, 3, 1, '2025-11-12 06:31:43', '2025-11-25 06:59:30'),
(4, 'Panduan Magang dan PKL', 'Panduan pelaksanaan magang dan praktik kerja lapangan untuk mahasiswa.', 'Akademik', 'Magang', 'peraturan/1764079178_panduan-magang-dan-pkl.pdf', 'Panduan Magang dan PKL.pdf', 13169, 4, 1, '2025-11-12 06:31:43', '2025-11-25 06:59:38'),
(5, 'Tata Tertib Mahasiswa', 'Peraturan tata tertib yang harus dipatuhi oleh seluruh mahasiswa.', 'Kemahasiswaan', 'Tata Tertib', 'peraturan/1764079188_tata-tertib-mahasiswa.pdf', 'Tata Tertib Mahasiswa .pdf', 13309, 1, 1, '2025-11-12 06:31:43', '2025-11-25 06:59:48'),
(6, 'Kode Etik Mahasiswa', 'Kode etik dan perilaku yang harus dijunjung tinggi oleh mahasiswa.', 'Kemahasiswaan', 'Kode Etik', 'peraturan/1764079199_kode-etik-mahasiswa.pdf', 'Kode Etik Mahasiswa.pdf', 13437, 2, 1, '2025-11-12 06:31:43', '2025-11-25 06:59:59'),
(7, 'Panduan Kegiatan Organisasi Kemahasiswaan', 'Panduan pelaksanaan kegiatan organisasi dan UKM kampus.', 'Kemahasiswaan', 'Kegiatan', 'peraturan/1764079215_panduan-kegiatan-organisasi-kemahasiswaan.pdf', 'Panduan Kegiatan Organisasi Kemahasiswaan.pdf', 14004, 3, 1, '2025-11-12 06:31:43', '2025-11-25 07:00:15'),
(8, 'SOP Pelayanan Administrasi Akademik', 'Standar operasional prosedur pelayanan administrasi akademik.', 'Administratif', 'SOP', 'peraturan/1764079222_sop-pelayanan-administrasi-akademik.pdf', 'SOP Pelayanan Administrasi Akademik.pdf', 13812, 1, 1, '2025-11-12 06:31:43', '2025-11-25 07:00:22'),
(9, 'Format Surat Menyurat Resmi', 'Template dan format surat menyurat resmi kampus.', 'Administratif', 'Surat Menyurat', 'peraturan/1764079233_format-surat-menyurat-resmi.pdf', 'Format Surat Menyurat Resmi.pdf', 13754, 2, 1, '2025-11-12 06:31:43', '2025-11-25 07:00:33'),
(10, 'Prosedur Cuti Kuliah', 'Prosedur pengajuan cuti kuliah dan persyaratannya.', 'Administratif', 'Cuti Kuliah', 'peraturan/1764079244_prosedur-cuti-kuliah.pdf', 'Prosedur Cuti Kuliah    .pdf', 13587, 3, 1, '2025-11-12 06:31:43', '2025-11-25 07:00:44'),
(11, 'Rincian Biaya Kuliah 2025/2026', 'Rincian biaya pendidikan untuk tahun ajaran 2025/2026.', 'Keuangan', 'Biaya Kuliah', 'peraturan/1764079250_rincian-biaya-kuliah-20252026.pdf', 'Rincian Biaya Kuliah 2025:2026    .pdf', 13765, 1, 1, '2025-11-12 06:31:43', '2025-11-25 07:00:50'),
(12, 'Informasi Beasiswa dan Bantuan Pendidikan', 'Informasi lengkap tentang berbagai jenis beasiswa dan bantuan pendidikan.', 'Keuangan', 'Beasiswa', 'peraturan/1764079258_informasi-beasiswa-dan-bantuan-pendidikan.pdf', 'Informasi Beasiswa dan Bantuan Pendidikan.pdf', 13859, 2, 1, '2025-11-12 06:31:43', '2025-11-25 07:00:58');

-- --------------------------------------------------------

--
-- Table structure for table `pkm`
--

CREATE TABLE `pkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_pkm` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tahun` year(4) NOT NULL,
  `jenis_pkm` enum('PKM-R','PKM-K','PKM-M','PKM-T','PKM-KC','PKM-AI','PKM-GT') NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Proposal',
  `dana` decimal(15,2) DEFAULT NULL,
  `pencapaian` varchar(255) DEFAULT NULL,
  `file_dokumen` varchar(255) DEFAULT NULL,
  `dosen_pembimbing_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pkm`
--

INSERT INTO `pkm` (`id`, `judul_pkm`, `deskripsi`, `tahun`, `jenis_pkm`, `status`, `dana`, `pencapaian`, `file_dokumen`, `dosen_pembimbing_id`, `created_at`, `updated_at`) VALUES
(36, 'PKM-K: Startup Chatbot Layanan Pelanggan berbasis Teknologi GPT-3.5', 'Pengembangan prototipe produk chatbot AI untuk layanan pelanggan UMKM dengan fokus pada akurasi pemahaman Bahasa Indonesia dan integrasi mudah ke platform e-commerce.', '2025', 'PKM-K', 'Didanai', 12000000.00, 'Lolos PIMNAS (Tahap Presentasi)', NULL, 28, '2025-11-25 06:33:29', '2025-11-25 06:33:29'),
(37, 'PKM-M: Implementasi Sistem Informasi Manajemen Inventaris Berbasis Web untuk Karang Taruna', 'Memberikan pelatihan dan mengimplementasikan sistem manajemen aset berbasis web sederhana untuk membantu Karang Taruna dalam mencatat, melacak, dan mengelola inventaris kegiatan mereka secara efisien.', '2025', 'PKM-M', 'Didanai', 9500000.00, 'Diterima Jurnal Abdimas Sinta 4', NULL, 31, '2025-11-25 06:33:48', '2025-11-25 06:33:48'),
(38, 'PKM-R: Model Deep Learning untuk Prediksi Kualitas Kode Sumber (Code Quality Prediction)', 'Penelitian untuk membangun dan melatih model Convolutional Neural Network (CNN) untuk memprediksi metrik kualitas kode (seperti kepadatan bug atau kompleksitas) dari representasi visual kode sumber.', '2025', 'PKM-R', 'Proposal', 15000000.00, NULL, NULL, 30, '2025-11-25 06:34:11', '2025-11-25 06:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `pkm_mahasiswa`
--

CREATE TABLE `pkm_mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pkm_id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `peran` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pkm_mahasiswa`
--

INSERT INTO `pkm_mahasiswa` (`id`, `pkm_id`, `nim`, `peran`, `created_at`, `updated_at`) VALUES
(140, 36, '2023133003', 'Anggota', '2025-11-25 06:33:29', '2025-11-25 06:33:29'),
(141, 36, '2023133001', 'Anggota', '2025-11-25 06:33:29', '2025-11-25 06:33:29'),
(142, 37, '2020133001', 'Anggota', '2025-11-25 06:33:48', '2025-11-25 06:33:48'),
(143, 37, '2020133005', 'Anggota', '2025-11-25 06:33:48', '2025-11-25 06:33:48'),
(144, 37, '2020133003', 'Anggota', '2025-11-25 06:33:48', '2025-11-25 06:33:48'),
(145, 38, '2020133002', 'Anggota', '2025-11-25 06:34:11', '2025-11-25 06:34:11'),
(146, 38, '2023133004', 'Anggota', '2025-11-25 06:34:11', '2025-11-25 06:34:11'),
(147, 38, '2020133006', 'Anggota', '2025-11-25 06:34:11', '2025-11-25 06:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `profil_prodi`
--

CREATE TABLE `profil_prodi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prodi` varchar(255) NOT NULL DEFAULT 'Teknik Perangkat Lunak',
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `akreditasi` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `kontak_email` varchar(255) DEFAULT NULL,
  `kontak_telepon` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_prodi`
--

INSERT INTO `profil_prodi` (`id`, `nama_prodi`, `visi`, `misi`, `deskripsi`, `akreditasi`, `logo`, `kontak_email`, `kontak_telepon`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Perangkat Lunak', 'Menjadi Program Studi Teknik Perangkat Lunak yang unggul dan terkemuka dalam menghasilkan lulusan yang kompeten, inovatif, dan beretika tinggi di bidang rekayasa perangkat lunak pada tahun 2030.', '1. Menyelenggarakan pendidikan tinggi yang berkualitas dan berorientasi pada perkembangan teknologi perangkat lunak terkini.\r\n2. Mengembangkan penelitian dan pengabdian kepada masyarakat yang berdampak pada kemajuan teknologi informasi dan kesejahteraan masyarakat.\r\n3. Membangun kemitraan strategis dengan industri dan institusi pendidikan untuk meningkatkan kualitas pembelajaran dan relevansi lulusan.\r\n4. Menghasilkan lulusan yang memiliki kompetensi teknis, soft skills, dan jiwa kewirausahaan yang kuat.\r\n5. Menciptakan lingkungan akademik yang kondusif untuk pengembangan karakter, kreativitas, dan inovasi.', 'Program Studi Teknik Perangkat Lunak (TPL) melatih mahasiswa untuk merancang dan mengembangkan sistem perangkat lunak berkualitas tinggi (seperti aplikasi mobile dan web).\r\n\r\nKurikulum mencakup Pemrograman, Basis Data, Rekayasa Perangkat Lunak, AI/ML, dan metodologi Agile/DevOps.\r\n\r\nLulusan memiliki prospek karir cerah sebagai Software Developer, System Analyst, atau Data Scientist.', 'A (Unggul)', 'profil_prodi/r4btLpxjSbsKko5Kv7evm6gSK4FCkfKZDcO6YPWj.png', 'tpl@university.ac.id', '+62 21 1234 5678', 'Gedung Fakultas Teknik, Kampus Universitas ABC, Jl. Pendidikan No. 123, Jakarta 12345', '2025-11-12 06:31:43', '2025-11-18 07:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `judul_project` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tahun` year(4) NOT NULL,
  `tahun_selesai` year(4) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `teknologi` varchar(255) DEFAULT NULL,
  `dosen_pembimbing` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `galeri` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`galeri`)),
  `link_demo` varchar(255) DEFAULT NULL,
  `link_github` varchar(255) DEFAULT NULL,
  `status` enum('Draft','Published') NOT NULL DEFAULT 'Published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `nim`, `judul_project`, `deskripsi`, `tahun`, `tahun_selesai`, `kategori`, `teknologi`, `dosen_pembimbing`, `cover_image`, `galeri`, `link_demo`, `link_github`, `status`, `created_at`, `updated_at`) VALUES
(51, '2023133001', 'Accouting Software Xero', 'Membuat aplikasi berbaris web yang bisa digunakan cross platform untuk melakukan akunting.', '2023', '2025', 'Web Application', 'Laravel, Flutter', 'Ilwan Syafrinal, S.Kom., M.Kom.', 'projects/1764075342_product_xero-accounting-software_overview.1646877536652.webp', '[\"projects\\/1764075342_images.jpeg\"]', 'https://perpus-demo.com', 'https://github.com/ahmad/perpustakaan-app', 'Published', '2025-11-25 05:55:42', '2025-11-25 05:55:42'),
(53, '2023133003', 'Aplikasi Penggabung Social Media', 'Semua social media hanya dalam satu platform itulah yang disebut sebuah keajaiban', '2023', '2025', 'Mobile Application', 'Flutter', 'Kaharuddin, S.Kom., M.Kom.', 'projects/1764075683_images (2).jpeg', '[\"projects\\/1764075700_best-social-media-apps-for-iphone-animation-icons-with-phone-free-video.jpg\",\"projects\\/1764075700_images (1).jpeg\"]', 'https://demo-project1.vercel.app', 'https://github.com/ahmad/perpustakaan-app', 'Published', '2025-11-25 06:01:23', '2025-11-25 06:01:40'),
(54, '2020133003', 'Gemini AI', 'Mengalahkan segala benchmarking dari ChatGPT dan mengedepankan harga yang terjangkau!', '2020', '2025', 'Web Application', 'Laravel, MySQL, Bootstrap', 'Masparudin. S.Kom., M.Kom.', 'projects/1764075807_01j95v3amw9d2h6ngjq3mpmhyw.webp', '[\"projects\\/1764075807_Bard_Gemini_Hero.width-1200.format-webp-01_copy_7594x5055.jpg.webp\",\"projects\\/1764075807_images (3).jpeg\"]', 'https://demo-project1.vercel.app', 'https://github.com/ahmad/perpustakaan-app', 'Published', '2025-11-25 06:03:27', '2025-11-25 06:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CjqXR8OrjfllkuIKIONmpbxOFXtEMO2QtUypD2hi', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV3E1UDFFckRUMGNmS2lqaXpuc1VKRzQwTzMwcmFXVnJsam5PUlVmWiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdHJhY2VyLXN0dWR5LzkvZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1764079407);

-- --------------------------------------------------------

--
-- Table structure for table `tracer_study`
--

CREATE TABLE `tracer_study` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(20) NOT NULL,
  `tahun_survey` year(4) NOT NULL,
  `status_pekerjaan` enum('Bekerja Full Time','Bekerja Part Time','Wiraswasta','Melanjutkan Studi','Belum Bekerja','Freelancer') NOT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `posisi` varchar(255) DEFAULT NULL,
  `bidang_pekerjaan` varchar(255) DEFAULT NULL,
  `gaji` decimal(15,2) DEFAULT NULL,
  `waktu_tunggu_kerja` int(11) DEFAULT NULL COMMENT 'Dalam bulan',
  `kesesuaian_bidang_studi` enum('Sangat Sesuai','Sesuai','Cukup Sesuai','Kurang Sesuai','Tidak Sesuai') DEFAULT NULL,
  `kepuasan_prodi` int(11) DEFAULT NULL,
  `saran_prodi` text DEFAULT NULL,
  `kompetensi_didapat` text DEFAULT NULL,
  `saran_pengembangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tracer_study`
--

INSERT INTO `tracer_study` (`id`, `nim`, `tahun_survey`, `status_pekerjaan`, `nama_perusahaan`, `posisi`, `bidang_pekerjaan`, `gaji`, `waktu_tunggu_kerja`, `kesesuaian_bidang_studi`, `kepuasan_prodi`, `saran_prodi`, `kompetensi_didapat`, `saran_pengembangan`, `created_at`, `updated_at`) VALUES
(5, '2020133004', '2025', 'Bekerja Full Time', 'PT. Gojek Indonesia', 'Senior Backend Engineer', 'Software Engineering / Teknologi Transportasi', 18000000.00, 1, 'Sangat Sesuai', 5, 'Terus tingkatkan fokus pada Microservices dan Cloud Native development.', 'Kurikulum TPL yang fokus pada API Design dan Scalable Architecture adalah kunci utama saya sukses di industri tech unicorn.', 'Perbanyak hackathon dan lomba coding internal.', '2025-11-25 06:57:51', '2025-11-25 06:57:51'),
(6, '2020133001', '2025', 'Wiraswasta', 'Start-up Digital (Milik Sendiri)', 'CTO / Founder', 'Kewirausahaan Teknologi', 12000000.00, 0, 'Sangat Sesuai', 5, 'Perkenalkan mata kuliah legalitas startup dan perlindungan HAKI (Hak Kekayaan Intelektual) lebih awal.', 'Mata kuliah Project Management dan Software Testing dari prodi memberikan bekal fundamental untuk membangun produk dan memimpin tim pengembang.', 'Dorong mahasiswa untuk mengikuti program akselerasi bisnis berbasis teknologi.', '2025-11-25 06:58:09', '2025-11-25 06:58:09'),
(7, '2020133002', '2025', 'Bekerja Full Time', 'Bank Digital XYZ', 'DevOps Specialist', 'Infrastruktur & Otomasi', 15500000.00, 3, 'Sangat Sesuai', 4, 'Sediakan jalur spesialisasi di semester akhir, seperti jalur Data Science atau jalur Cybersecurity.', 'Mata kuliah jaringan komputer dan sistem operasi dari TPL adalah fondasi krusial yang memungkinkan saya masuk ke bidang DevOps.', 'Perbanyak simulasi wawancara kerja yang berfokus pada technical interview.', '2025-11-25 06:58:30', '2025-11-25 06:58:30'),
(8, '2020133003', '2025', 'Bekerja Full Time', 'Lembaga Riset Nasional', 'Junior Researcher (Software)', 'Riset Teknologi & Pengembangan', 9500000.00, 4, 'Sangat Sesuai', 5, 'Tingkatkan intensitas publikasi bersama mahasiswa di jurnal nasional terakreditasi.', 'Metodologi penelitian dan kemampuan menulis ilmiah yang diajarkan prodi menjadi dasar kuat dalam karir riset saya saat ini.', 'Fasilitasi pertukaran pelajar ke universitas yang fokus pada riset.', '2025-11-25 06:58:50', '2025-11-25 06:58:50'),
(9, '2020133005', '2025', 'Freelancer', 'Konsultan IT (Independent)', 'UI/UX Consultant', 'Desain & Antarmuka Aplikasi', 6000000.00, 2, 'Sesuai', 4, 'Tambahkan kolaborasi proyek antar-prodi (misal: dengan desain) untuk memperkaya portofolio mahasiswa.', 'Mata kuliah interaksi manusia dan komputer serta proyek akhir yang berfokus pada desain produk sangat aplikatif di pekerjaan freelance.', 'Sediakan pelatihan khusus untuk tools desain UI/UX terkini.', '2025-11-25 06:59:08', '2025-11-25 06:59:08');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-11-12 06:31:43', '$2y$12$UU78kjTBuM2QoNTYsZ18F.8MQqpXcLhln65FcwPSHphD2FE6yAmBS', 'iux2in5tzw', '2025-11-12 06:31:43', '2025-11-12 06:31:43'),
(2, 'Administrator', 'admin@gmail.com', NULL, '$2y$12$OKtjSszFKlEUROdOQfoIouFj0aC32u/okKYCmVudMJmU8arao7boC', NULL, '2025-11-12 06:31:43', '2025-11-12 06:31:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alumni_nim_unique` (`nim`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dosen_nidn_unique` (`nidn`),
  ADD UNIQUE KEY `dosen_email_unique` (`email`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kisah_sukses`
--
ALTER TABLE `kisah_sukses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kisah_sukses_nim_foreign` (`nim`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kurikulum_kode_matkul_unique` (`kode_matkul`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_nim_unique` (`nim`),
  ADD UNIQUE KEY `mahasiswa_email_unique` (`email`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`mk_id`),
  ADD UNIQUE KEY `tbl_matakuliah_kode_mk_unique` (`kode_mk`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penelitian_ketua_peneliti_id_foreign` (`ketua_peneliti_id`);

--
-- Indexes for table `penelitian_mahasiswa`
--
ALTER TABLE `penelitian_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penelitian_mahasiswa_penelitian_id_foreign` (`penelitian_id`),
  ADD KEY `penelitian_mahasiswa_nim_foreign` (`nim`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peraturan`
--
ALTER TABLE `peraturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pkm`
--
ALTER TABLE `pkm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pkm_dosen_pembimbing_id_foreign` (`dosen_pembimbing_id`);

--
-- Indexes for table `pkm_mahasiswa`
--
ALTER TABLE `pkm_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pkm_mahasiswa_pkm_id_foreign` (`pkm_id`),
  ADD KEY `pkm_mahasiswa_nim_foreign` (`nim`);

--
-- Indexes for table `profil_prodi`
--
ALTER TABLE `profil_prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_nim_foreign` (`nim`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tracer_study`
--
ALTER TABLE `tracer_study`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tracer_study_nim_foreign` (`nim`);

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
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kisah_sukses`
--
ALTER TABLE `kisah_sukses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `mk_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `penelitian_mahasiswa`
--
ALTER TABLE `penelitian_mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peraturan`
--
ALTER TABLE `peraturan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pkm`
--
ALTER TABLE `pkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pkm_mahasiswa`
--
ALTER TABLE `pkm_mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `profil_prodi`
--
ALTER TABLE `profil_prodi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tracer_study`
--
ALTER TABLE `tracer_study`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `alumni_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `kisah_sukses`
--
ALTER TABLE `kisah_sukses`
  ADD CONSTRAINT `kisah_sukses_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `alumni` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD CONSTRAINT `penelitian_ketua_peneliti_id_foreign` FOREIGN KEY (`ketua_peneliti_id`) REFERENCES `dosen` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `penelitian_mahasiswa`
--
ALTER TABLE `penelitian_mahasiswa`
  ADD CONSTRAINT `penelitian_mahasiswa_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE,
  ADD CONSTRAINT `penelitian_mahasiswa_penelitian_id_foreign` FOREIGN KEY (`penelitian_id`) REFERENCES `penelitian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pkm`
--
ALTER TABLE `pkm`
  ADD CONSTRAINT `pkm_dosen_pembimbing_id_foreign` FOREIGN KEY (`dosen_pembimbing_id`) REFERENCES `dosen` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pkm_mahasiswa`
--
ALTER TABLE `pkm_mahasiswa`
  ADD CONSTRAINT `pkm_mahasiswa_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE,
  ADD CONSTRAINT `pkm_mahasiswa_pkm_id_foreign` FOREIGN KEY (`pkm_id`) REFERENCES `pkm` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `tracer_study`
--
ALTER TABLE `tracer_study`
  ADD CONSTRAINT `tracer_study_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `alumni` (`nim`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
