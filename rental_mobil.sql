-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Okt 2024 pada 17.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `nopol` varchar(8) NOT NULL,
  `nama_pemilik` varchar(20) NOT NULL,
  `alamat` varchar(35) NOT NULL,
  `merk` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `tahun_pembuatan` int(4) DEFAULT NULL,
  `warna` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`nopol`, `nama_pemilik`, `alamat`, `merk`, `type`, `jenis`, `tahun_pembuatan`, `warna`) VALUES
('AD2222UI', 'Jaka', 'Jl.Panjalu', 'Honda', 'Civic', 'Sport', 2023, 'Putih'),
('AD9090OR', 'Damar', 'Jl.Arif', 'Hyundai', 'Palisade', 'MVP', 2001, 'Merah Metalik'),
('B0011TWP', 'Tita', 'Jl.Coba 2', 'Honda', 'Xenia', 'Sport', 2011, 'Hitam'),
('F6666QQ', 'Popo', 'Jl.Ciamis', 'Daihatsu', 'Ayla', 'LCGC', 2019, 'Biru'),
('W1289LL', 'Tata', 'Jl.Ciamis', 'Daihatsu', 'Sigra', 'LCGC', 2022, 'Hijau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` varchar(4) NOT NULL,
  `nama_pemilik` varchar(20) NOT NULL,
  `alamat` varchar(35) NOT NULL,
  `telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nama_pemilik`, `alamat`, `telp`) VALUES
('p1', 'damar', 'panjalu', '2147483647'),
('p2', 'jaka', 'palestina', '089283982911'),
('p3', 'tri', 'wonogiri', '08219284729021'),
('q', 'hahaha', 'ahaha', '2147483647'),
('q1', 'maman', 'ja', '2147483647'),
('ww1', 'aaaa', 'aaa', '2147483647111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan_backup`
--

CREATE TABLE `pelanggan_backup` (
  `kode_pelanggan` varchar(4) NOT NULL,
  `nama_pemilik` varchar(20) NOT NULL,
  `alamat` varchar(35) NOT NULL,
  `telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan_backup`
--

INSERT INTO `pelanggan_backup` (`kode_pelanggan`, `nama_pemilik`, `alamat`, `telp`) VALUES
('p1', 'damar', 'panjalu', '2147483647'),
('q1', 'maman', 'ja', '2147483647'),
('ww1', 'aaaa', 'aaa', '2147483647111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `nopol` varchar(8) NOT NULL,
  `kode_pelanggan` varchar(4) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `nopol`, `kode_pelanggan`, `tgl_pinjam`, `tgl_kembali`) VALUES
(3, 'AD9090OR', 'p1', '2024-10-03', '2024-10-25'),
(4, 'W1289LL', 'q1', '2024-10-01', '2024-10-31'),
(5, 'F6666QQ', 'ww1', '2024-10-01', '2024-10-02'),
(7, 'AD2222UI', 'p3', '2024-10-12', '2024-10-19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`nopol`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `nopol` (`nopol`),
  ADD KEY `kode_pelanggan` (`kode_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`nopol`) REFERENCES `mobil` (`nopol`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode_pelanggan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
