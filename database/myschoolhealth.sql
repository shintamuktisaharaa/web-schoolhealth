-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2026 pada 07.16
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myschoolhealth`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `health_info`
--

CREATE TABLE `health_info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `health_info`
--

INSERT INTO `health_info` (`id`, `title`, `content`) VALUES
(8, 'Waspada Demam Berdarah Dangue!', 'Apa Gejala Demam Berdarah Dangue?\r\nGejala ditandai dengan demam mendadak dengan suhu tinggi 39°C sampai 40°C, sakit kepala, nyeri belakang bola mata, mual dan manifestasi pendarahan seperti mimisan atau gusi berdarah serta adanya kemerahan di bagian permukaan tubuh pada penderita.'),
(9, 'Pentingnya Pola Makan Sehat', 'Sarapan Pagi: Jangan melewatkan sarapan. Sarapan sehat seperti nasi, roti gandum, telur, atau buah-buahan memberikan energi untuk belajar.\r\n\r\nCukupi Gizi: Konsumsi makanan yang mengandung karbohidrat, protein, vitamin, dan mineral secara seimbang.\r\n\r\nHindari Junk Food Berlebihan: Makanan cepat saji tinggi garam, gula, dan lemak dapat menyebabkan obesitas dan gangguan kesehatan lainnya.'),
(10, 'Kesehatan Mental dan Istirahat yang Cukup', 'Tidur yang Cukup, Pastikan tidur 7-9 jam setiap malam. Kurang tidur dapat memengaruhi konsentrasi dan kesehatan.\r\n\r\n\r\nAtasi Stres, Jika merasa tertekan dengan tugas sekolah, coba teknik relaksasi seperti meditasi, mendengarkan musik, atau berbicara dengan teman/keluarga.\r\nJangan ragu untuk mencari bantuan dari guru BK jika merasa sulit menghadapi masalah.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `id_obat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kunjungan`
--

INSERT INTO `kunjungan` (`id_kunjungan`, `nama_siswa`, `kelas`, `tanggal`, `keluhan`, `id_obat`) VALUES
(1, 'Jeon Wonwoo', 'XII IPA 5', '1996-07-17', 'Gratitis', 1),
(2, 'malfa', '12 sija', '2026-10-27', 'sakit kepala', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`email`, `username`, `password`) VALUES
('shintamuktisahara@gmail.com', 'shinta', '$2y$10$mRVsUr7eciav0f419Cf98uf/a.Nh8Rk2mgJ6O39LFhHXa2cThOOxK'),
('kholifahahayyyyyyymuach@gmail.com', 'i love you', '$2y$10$kKvFjtaiyj7iKQ17dC07eeSr9F0HEg5rvdW0vXXjDM4mb/codhkru'),
('sukafiksi77@gmail.com', 'pacar mingyu', '$2y$10$Y92o6YbWUmfaSXfGdLqqQeNrNJgTWTrCPI5cuCOSvCMLnllwR2krG'),
('smkn1cilegon.pmr@gmail.com', 'PMR SMK Negeri 1 Cilegon', '$2y$10$Xf9Q6xWV5Q7pmDIQ.dLsQeEQgKAAKfICpyl2tJymfGEENWO/857AO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_obat`
--

CREATE TABLE `stok_obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `stok_obat` int(11) NOT NULL,
  `deskripsi_obat` varchar(255) NOT NULL,
  `tanggal_kadaluwarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok_obat`
--

INSERT INTO `stok_obat` (`id_obat`, `nama_obat`, `stok_obat`, `deskripsi_obat`, `tanggal_kadaluwarsa`) VALUES
(1, 'Promag', 49, 'untuk sakit maag', '2027-09-12'),
(2, 'Narkoba', 12, 'Untuk mabok', '2026-10-23'),
(3, 'panadol', 60, 'buat org yg g py duit', '2027-10-27');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `health_info`
--
ALTER TABLE `health_info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`);

--
-- Indeks untuk tabel `stok_obat`
--
ALTER TABLE `stok_obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `health_info`
--
ALTER TABLE `health_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stok_obat`
--
ALTER TABLE `stok_obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
