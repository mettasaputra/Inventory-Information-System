-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 07:59 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kk`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `kartustock` (IN `ids` INT)  NO SQL
begin
declare stoks double default 0;
declare tanggals date;
declare keterangans varchar(255);
declare qtys double;
declare idmsk int;
declare countss int default 0;
declare jmlrow int;
declare jmlrowterima int;
declare jmlrowkeluar int;
declare keluar int default 0;
declare counts int default 0;
declare countsss int default 0;
declare countssss int default 0;
declare jmlrowinven int default 0;
declare countsssss int default 0;
CREATE TEMPORARY TABLE stoking(
    stok double,
    tanggal date,
    keterangan varchar(255),
    qty double
);

set jmlrow = (select count(*) from (select p.tanggal as a FROM penerimaan p join detail_penerimaan on p.id_penerimaan = detail_penerimaan.id_penerimaan where detail_penerimaan.id_barang = ids GROUP BY a UNION SELECT date(w.tanggal) as c from pengeluaran w join detail_pengeluaran on detail_pengeluaran.id_pengeluaran = w.id_pengeluaran where detail_pengeluaran.id_barang =ids group by c)t);
while counts<jmlrow do 
    set countss = 0 ;
    set countsss =0;
    set tanggals = (select a from (select p.tanggal as a FROM penerimaan p join detail_penerimaan on p.id_penerimaan = detail_penerimaan.id_penerimaan where id_barang = ids GROUP BY a UNION SELECT date(w.tanggal) as c from pengeluaran w join detail_pengeluaran on detail_pengeluaran.id_pengeluaran = w.id_pengeluaran where id_barang =ids group by c)t order by a limit 1 offset counts);
    set jmlrowterima = (Select count(*) from (select w.* from penerimaan w join detail_penerimaan on w.id_penerimaan = detail_penerimaan.id_penerimaan where date(w.tanggal) = tanggals and id_barang = ids group by w.id_penerimaan)b);
    set jmlrowkeluar = (Select count(*) from (select w.* from pengeluaran w join detail_pengeluaran on w.id_pengeluaran = detail_pengeluaran.id_pengeluaran where date(w.tanggal) = tanggals and id_barang = ids group by w.id_pengeluaran)b);
    while countss < jmlrowterima do
        set countssss = 0 ;
        set idmsk = (Select penerimaan.id_penerimaan from penerimaan join detail_penerimaan on penerimaan.id_penerimaan = detail_penerimaan.id_penerimaan where penerimaan.tanggal = tanggals and detail_penerimaan.id_barang = ids group by penerimaan.id_penerimaan limit 1 offset countss);
        set jmlrowinven = (Select count(*) from detail_penerimaan where detail_penerimaan.id_penerimaan = idmsk and detail_penerimaan.id_barang = ids);
        set keterangans = (select jenis_penerimaan from penerimaan where id_penerimaan = idmsk);
        while countssss < jmlrowinven do
            set qtys = (Select jumlah from detail_penerimaan where detail_penerimaan.id_barang =ids and detail_penerimaan.id_penerimaan=idmsk limit 1 offset countssss);
            set stoks = (ROUND(stoks,2) + qtys);
            insert into stoking values (ROUND(stoks,2),tanggals,keterangans,qtys);
            set countssss = countssss +1;
        end while;
        set countss = countss +1;
    end while;
    while countsss < jmlrowkeluar do
        set countsssss =0; 
        set idmsk = (Select pengeluaran.id_pengeluaran from pengeluaran join `detail_pengeluaran` on pengeluaran.id_pengeluaran = detail_pengeluaran.id_pengeluaran where date(pengeluaran.tanggal) = tanggals and id_barang = ids group by pengeluaran.id_pengeluaran limit 1 offset countsss);
        set keterangans =(select jenis_pengeluaran from pengeluaran where id_pengeluaran = idmsk);
        set jmlrowinven = (Select count(*) from `detail_pengeluaran` where detail_pengeluaran.id_pengeluaran = idmsk and detail_pengeluaran.id_barang = ids);
        while countsssss < jmlrowinven DO    
            set qtys = (Select -(jumlah) from `detail_pengeluaran` where detail_pengeluaran.id_barang =ids and detail_pengeluaran.id_pengeluaran=idmsk limit 1 offset countsssss);
            set stoks = (ROUND(stoks,2)+qtys);
            insert into stoking values (ROUND(stoks,2),tanggals,keterangans,qtys);
            set countsssss = countsssss +1;
        end while;
        set countsss = countsss +1;
        end while;
    set counts = counts+1;
end while;
select * from stoking;
drop temporary table if exists stoking;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `stok` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `id_kategori`, `satuan`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Ajinomoto', 1, 'Pcs', 285, '2021-03-28 12:08:43', '2021-04-24 17:51:53'),
(2, 'AO', 'Ajinomotoo', 1, 'Kaleng', 90, '2021-03-28 12:08:43', '2021-04-24 17:51:53'),
(4, 'ABC', 'Sambal ABC', 1, 'Botol', 98, '2021-04-04 10:48:33', '2021-04-24 17:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penerimaan`
--

CREATE TABLE `detail_penerimaan` (
  `id_detail_penerimaan` int(11) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penerimaan`
--

INSERT INTO `detail_penerimaan` (`id_detail_penerimaan`, `id_penerimaan`, `id_barang`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(23, 33, 1, 100, 'logistik', '2021-04-07 11:41:57', '2021-04-07 11:41:57'),
(24, 34, 1, 250, '', '2021-04-07 11:42:12', '2021-04-07 11:42:12'),
(25, 35, 4, 100, '', '2021-04-15 16:18:37', '2021-04-15 16:18:37'),
(26, 36, 4, 19, '', '2021-04-15 16:20:59', '2021-04-15 16:20:59'),
(27, 37, 4, 9, '', '2021-04-15 16:23:13', '2021-04-15 16:23:13'),
(28, 38, 2, 100, '', '2021-04-23 13:57:21', '2021-04-23 13:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengeluaran`
--

CREATE TABLE `detail_pengeluaran` (
  `id_detail_pengeluaran` int(11) NOT NULL,
  `id_pengeluaran` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pengeluaran`
--

INSERT INTO `detail_pengeluaran` (`id_detail_pengeluaran`, `id_pengeluaran`, `id_barang`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(8, 7, 1, 11, '', '2021-04-07 11:42:26', '2021-04-07 11:42:26'),
(9, 8, 1, 10, '', '2021-04-07 11:42:40', '2021-04-07 11:42:40'),
(10, 9, 1, 29, '', '2021-04-07 11:47:26', '2021-04-07 11:47:26'),
(11, 10, 4, 20, '', '2021-04-15 16:21:13', '2021-04-15 16:21:13'),
(12, 20, 1, 3, '', '2021-04-21 15:55:08', '2021-04-21 15:55:08'),
(13, 20, 2, 1, '', '2021-04-21 15:55:08', '2021-04-21 15:55:08'),
(14, 20, 4, 2, '', '2021-04-21 15:55:08', '2021-04-21 15:55:08'),
(15, 21, 2, 2, 'test', '2021-04-23 10:25:05', '2021-04-23 10:25:05'),
(16, 22, 1, 3, '', '2021-04-23 10:26:22', '2021-04-23 10:26:22'),
(17, 22, 2, 1, '', '2021-04-23 10:26:23', '2021-04-23 10:26:23'),
(18, 22, 4, 2, '', '2021-04-23 10:26:23', '2021-04-23 10:26:23'),
(19, 23, 1, 3, '', '2021-04-23 10:26:38', '2021-04-23 10:26:38'),
(20, 23, 2, 1, '', '2021-04-23 10:26:38', '2021-04-23 10:26:38'),
(21, 23, 4, 2, '', '2021-04-23 10:26:38', '2021-04-23 10:26:38'),
(22, 24, 1, 3, '', '2021-04-23 10:31:37', '2021-04-23 10:31:37'),
(23, 24, 2, 1, '', '2021-04-23 10:31:37', '2021-04-23 10:31:37'),
(24, 24, 4, 2, '', '2021-04-23 10:31:37', '2021-04-23 10:31:37'),
(25, 25, 2, 1, 'h', '2021-04-23 10:32:51', '2021-04-23 10:32:51'),
(26, 26, 2, 2, 'test', '2021-04-23 10:36:51', '2021-04-23 10:36:51'),
(27, 27, 1, 3, 'u', '2021-04-24 17:51:53', '2021-04-24 17:51:53'),
(28, 27, 2, 1, '', '2021-04-24 17:51:53', '2021-04-24 17:51:53'),
(29, 27, 4, 2, '', '2021-04-24 17:51:53', '2021-04-24 17:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan`
--

CREATE TABLE `detail_permintaan` (
  `id_detail_permintaan` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `created_at`, `updated_at`) VALUES
(1, 'Kerja Praktik', '2021-03-30 14:49:55', '2021-03-30 14:59:47'),
(2, 'Service', '2021-03-30 14:58:46', '2021-03-30 14:58:46'),
(3, 'Barista', '2021-03-30 14:58:57', '2021-03-30 14:58:57'),
(4, 'Kitchen', '2021-03-30 14:59:33', '2021-03-30 14:59:33'),
(5, 'Purchasing', '2021-03-30 14:59:33', '2021-03-30 14:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_divisi`, `nama_karyawan`, `created_at`, `updated_at`) VALUES
(1, 2, 'Yudhistira', '2021-03-30 15:28:45', '2021-03-30 15:28:50'),
(2, 2, 'Verawati', '2021-03-30 15:28:45', '2021-03-30 15:29:01'),
(3, 2, 'Ike', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(4, 2, 'Siti Mulyati', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(5, 2, 'Rini', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(6, 2, 'Anggi', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(7, 2, 'Rio ', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(8, 2, 'David', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(9, 3, 'Agus', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(10, 3, 'Aan', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(11, 3, 'Hafiz', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(12, 4, 'Rifai', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(13, 4, 'Gunawan', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(14, 4, 'Akbar', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(15, 4, 'Putri', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(16, 4, 'Ryan', '2021-03-30 15:28:45', '2021-03-30 15:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Bahan Baku Makanan', '2021-03-28 11:54:14', '2021-03-28 11:54:14'),
(2, 'Bahan Baku Minuman', '2021-03-28 11:54:49', '2021-03-28 11:54:49'),
(3, 'Bahan Penolong', '2021-03-28 11:55:04', '2021-03-28 11:55:04'),
(4, 'Lain-Lain', '2021-03-28 11:55:23', '2021-03-28 11:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE `penerimaan` (
  `id_penerimaan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `jenis_penerimaan` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerimaan`
--

INSERT INTO `penerimaan` (`id_penerimaan`, `tanggal`, `id_supplier`, `id_karyawan`, `jenis_penerimaan`, `keterangan`, `created_at`, `updated_at`) VALUES
(33, '2021-03-01', NULL, 1, 'Supplier', '', '2021-04-07 11:41:57', '2021-04-10 10:45:45'),
(34, '2021-04-07', 2, NULL, 'Supplier', '', '2021-04-07 11:42:12', '2021-04-07 11:42:12'),
(35, '2021-04-15', NULL, 5, 'Penerimaan Opsional', '', '2021-04-15 16:18:37', '2021-04-15 16:18:37'),
(36, '2021-03-11', NULL, 5, 'Penerimaan Opsional', '', '2021-04-15 16:20:59', '2021-04-15 16:20:59'),
(37, '2021-03-01', NULL, 4, 'Penerimaan Opsional', '', '2021-04-15 16:23:13', '2021-04-15 16:23:13'),
(38, '2021-04-23', 2, NULL, 'Penerimaan Barang dari Supplier', '', '2021-04-23 13:57:21', '2021-04-23 13:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `request_by` int(11) DEFAULT NULL,
  `jenis_pengeluaran` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `request_by`, `jenis_pengeluaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(7, '2021-03-11', 4, 'permintaan', '', '2021-04-07 11:42:26', '2021-04-07 11:42:26'),
(8, '2021-03-19', 3, 'permintaan', '', '2021-04-07 11:42:40', '2021-04-07 11:42:40'),
(9, '2021-04-07', 3, 'permintaan', '', '2021-04-07 11:47:25', '2021-04-07 11:47:25'),
(10, '2021-04-22', NULL, 'Pengeluaran Opsional', '', '2021-04-15 16:21:13', '2021-04-15 16:21:13'),
(20, '2021-04-16', 4, 'Permintaan Karyawan', '', '2021-04-21 15:55:08', '2021-04-21 15:55:08'),
(21, '2021-04-09', 2, 'Permintaan Karyawan', 'test', '2021-04-23 10:25:05', '2021-04-23 10:25:05'),
(22, '2021-04-16', 4, 'Permintaan Karyawan', '', '2021-04-23 10:26:22', '2021-04-23 10:26:22'),
(23, '2021-04-16', 4, 'Permintaan Karyawan', '', '2021-04-23 10:26:38', '2021-04-23 10:26:38'),
(24, '2021-04-16', 4, 'Permintaan Karyawan', '', '2021-04-23 10:31:37', '2021-04-23 10:31:37'),
(25, '2021-04-09', 1, 'Permintaan Karyawan', 'h', '2021-04-23 10:32:51', '2021-04-23 10:32:51'),
(26, '2021-04-09', 2, 'Permintaan Karyawan', 'test', '2021-04-23 10:36:51', '2021-04-23 10:36:51'),
(27, '2021-04-16', 4, 'Permintaan Karyawan', '', '2021-04-24 17:51:53', '2021-04-24 17:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_karyawan`
--

CREATE TABLE `permintaan_karyawan` (
  `id_permintaan` int(11) NOT NULL,
  `tanggal_kebutuhan` date NOT NULL,
  `request_by` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `contact_person`, `no_telp`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 'PT ABC', 'William', '08973051987', 'Tangerang', '2021-03-30 16:41:32', '2021-03-30 16:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `personal_id` varchar(100) NOT NULL,
  `level_akses` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `personal_id`, `level_akses`, `created_at`, `updated_at`) VALUES
(1, 'Metta Saputra', '0220m2a', 1, '2021-03-28 16:26:37', '2021-03-30 14:49:42'),
(2, 'Siti Mulyati', 'SITIMULY', 3, '2021-03-30 15:45:30', '2021-04-23 10:38:40'),
(4, 'Yudhistira', '', 3, '2021-03-30 16:18:23', '2021-03-30 16:18:23'),
(5, 'Verawati', 'YDHS1234', 3, '2021-03-30 16:21:21', '2021-03-30 16:21:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `kategori` (`id_kategori`);

--
-- Indexes for table `detail_penerimaan`
--
ALTER TABLE `detail_penerimaan`
  ADD PRIMARY KEY (`id_detail_penerimaan`),
  ADD KEY `id_penerimaan` (`id_penerimaan`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD PRIMARY KEY (`id_detail_pengeluaran`),
  ADD KEY `id_pengeluaran` (`id_pengeluaran`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  ADD PRIMARY KEY (`id_detail_permintaan`),
  ADD KEY `id_pengeluaran` (`id_permintaan`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id_penerimaan`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `request_by` (`request_by`);

--
-- Indexes for table `permintaan_karyawan`
--
ALTER TABLE `permintaan_karyawan`
  ADD PRIMARY KEY (`id_permintaan`),
  ADD KEY `request_by` (`request_by`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_penerimaan`
--
ALTER TABLE `detail_penerimaan`
  MODIFY `id_detail_penerimaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  MODIFY `id_detail_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  MODIFY `id_detail_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `id_penerimaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `permintaan_karyawan`
--
ALTER TABLE `permintaan_karyawan`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_penerimaan`
--
ALTER TABLE `detail_penerimaan`
  ADD CONSTRAINT `detail_penerimaan_ibfk_1` FOREIGN KEY (`id_penerimaan`) REFERENCES `penerimaan` (`id_penerimaan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penerimaan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD CONSTRAINT `detail_pengeluaran_ibfk_1` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pengeluaran_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON UPDATE CASCADE;

--
-- Constraints for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `penerimaan_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`request_by`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
