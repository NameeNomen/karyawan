-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2026 pada 07.31
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
-- Database: `db_registrasiKaryawan`
--
CREATE DATABASE IF NOT EXISTS `db_registrasiKaryawan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_registrasiKaryawan`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) PRIMARY key AUTO_INCREMENT NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `gaji_pokok` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) AUTO_INCREMENT PRIMARY key NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum(`L`,`P`) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  CONSTRAINT fk_karyawan_jabatan foreign key (id_jabatan) references jabatan(id_jabatan) on delete cascade on update cascade,
  `status` enum(`aktif`,`nonaktif`) NOT NULL,
  `tanggal_masuk` date not null,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

-- CREATE TABLE `role` (
--   `id_role` int(11) NOT NULL,
--   `nama_role` varchar(50) NOT NULL,
--   `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) PRIMARY key AUTO_INCREMENT NOT NULL,
  `id_karyawan` int(11) NOT NULL,
   CONSTRAINT fk_user_karyawan  foreign key (id_karyawan) references karyawan(id_karyawan) on delete cascade on update cascade,
  `username` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table `departemen`(
  `id_departement` int(20) primary key AUTO_INCREMENT not null,
  `nama_departement` varchar(100) not null,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

create table `riwayatInput`(
  `id_riwayat` int(20) primary key,
  `id_karyawan` int(11) not null,
  CONSTRAINT fk_riwayatInput_karyawan foreign key (id_karyawan) references karyawan(id_karyawan) on delete cascade on update cascade,
  `id_user` int(11) not null,
  CONSTRAINT fk_riwayatInput_user foreign key (id_user) references user(id_user) on delete cascade on update cascade,
  `tanggal_input` DATETIME not null,
  `aksi` varchar(50) not null,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jabatan`
--


--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
