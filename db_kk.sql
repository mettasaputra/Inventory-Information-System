-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2021 at 04:37 PM
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
(1, 'A', 'Ajinomoto', 1, 'Pcs', 89, '0000-00-00 00:00:00', '2021-05-13 13:15:32'),
(2, 'AKP', 'Air Kelapa', 1, 'Liter', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'ANG', 'ANGCIU', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'AQC', 'Air Mineral Cup', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ASJ', 'Asam Jawa', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'ASP', 'ASPARAGUS', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Air Galon', 'Air Galon', 1, 'Pcs', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(8, 'Asam', 'Asam Jawa', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Asam Kandis', 'Asam Kandis', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Ayam Fillet', 'Ayam Fillet', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Ayam Jantan', 'Ayam Jantan', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Ayam Potong', 'Ayam Potong', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'B.Ayam', 'Bakso Ayam', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'B.Gohyong', 'Bumbu Gohyong', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'B.Ikan', 'Bakso Ikan', 1, 'Kg', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(16, 'BB', 'Bebek', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'BBM-Bumbu Nasi', 'Bumbu Nasi Kebuli', 1, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'BBM-KAPRI', 'Kapri (Jgn Pakai)', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'BBM-KCR', 'Kencur', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'BBM-SW', 'Sawi Putih', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'BBPC', 'Bumbu Pecel', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'BBR', 'Bumbu Racik', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'BBRN', 'Bumbu Rendang', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'BCS', 'Buncis', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'BJD', 'Biji Delima', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'BKP', 'Baking Powder', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'BKS', 'Bakso', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'BKSD', 'Baking Soda', 1, 'Pcs', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(29, 'BNC', 'Buncis', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'BRK', 'Beras Kencur', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'BT', 'Buntut Sapi', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Babas', 'Babas', 1, 'Bks', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(33, 'Bawang Bombay', 'Bawang Bombay', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Bawang Goreng', 'Bawang Goreng', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Bawang Merah', 'Bawang Merah', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Bawang Putih', 'Bawang Putih', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Beras', 'Beras', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Brk', 'Brokoli', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Buah Macang', 'Buah Macang', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Buah Pepaya', 'Buah Pepaya', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Bumbu Tempe', 'Bumbu Tempe', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'C.Nugget', 'Nugget Chicken', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'C.P', 'Chicken Powder (Ajm)', 1, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'CAISIM', 'CAISIM', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'CD', 'Cuka Dixxi', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'CK', 'Chicken Knorr', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'CKLT BBK', 'Coklat Vanhaunten', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'CM', 'Cumi-cumi', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'CRNT', 'Cornet', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Cabe Burung', 'Cabe Burung', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Cabe Hijau Besar', 'Cabe Hijau Besar', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Cabe Merah Besar', 'Cabe Merah Besar', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Cabe Merah Keriting', 'Cabe Merah Keriting', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Cabe Rawit', 'Cabe Rawit', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Cabe Rawit Jengki', 'Cabe Rawit Jengki', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Cabe Rawit Merah', 'Cabe Rawit Merah', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Cengkeh', 'Cengkeh', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Cln', 'Clink', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Cung Kediro', 'Cung Kediro', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'DE', 'Daging SOP', 1, 'Kg', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(61, 'DK', 'Daging Kambing', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'Daun Bawang', 'Daun Bawang', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Daun Jeruk', 'Daun Jeruk', 1, 'Ons', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Daun Kunyit', 'Daun Kunyit', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'Daun Melinjo', 'Daun Melinjo', 1, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'Daun Pandan', 'Daun Pandan', 1, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'Daun Pisang', 'Daun Pisang', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Daun Salam', 'Daun Salam', 1, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'Daun Selada', 'Daun Selada', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Daun Tangkil', 'Daun Tangkil', 1, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'EB', 'Ebi', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'EMP', 'Empek-empek', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Emping', 'Emping', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'FF', 'French Fries (Kentang Potong)', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'FVTA', 'Forvita', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'GM', 'Gula Merah', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'GMB', 'Gula Merah Batok', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'GP', 'Gula Pasir', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'GR', 'Garam', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'GI Trop', 'Gula Tropicana', 1, 'Ktk', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'GIT', 'Gula Tropikana', 1, 'Ktk', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'HBD', 'Herba Drink', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'HSD', 'Has Dalam', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'HTSP', 'Hati Sapi', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Hati E', 'Hati Empela', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Hrd', 'Hercules', 1, 'Klg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'IKD', 'INTRA KENCUR DOS', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'ITJW', 'INTRA JAHE WANGI', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Iga Kambing', 'Iga Kambing', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Iga Sapi', 'Iga Sapi', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Ikan Asin', 'Ikan Asin', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Ikan Dori', 'Ikan Dori', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Ikan Gurame Fillet', 'Ikan Gurame Fillet', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Ikan Gurame Utuh', 'Ikan Gurame Utuh', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Ikan Kakap', 'Ikan Kakap', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Ikan Lele', 'Ikan Lele', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Ikan Patin', 'Ikan Patin', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'Ikan Teri', 'Ikan Teri', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'JGJ', 'Jungle Jus', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'JMRK', 'Jamur Kaleng', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'JN', 'Jinten', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Jagung Kaleng', 'Jagung Kaleng', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Jagung Manis', 'Jagung Manis', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Jagung Muda', 'Jagung Muda', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'Jahe', 'Jahe', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Jamur Kuping', 'Jamur Kuping', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Jamur Shitake', 'Jamur Shitake', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'Jamur Tiram', 'Jamur Tiram', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Jamur Tungku', 'Jamur Tungku', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Jengkol', 'Jengkol', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'K', 'Kemiri', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'KB', 'Ketumbar', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'KKL', 'Kikil', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'KKOL', 'Kembang Kol', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'KL', 'Kapulaga', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'KLA', 'Kailan', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'KN', 'Kunyit', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'KNB', 'Kunyit Bubuk', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'KPR', 'Kapri', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'KRM', 'KURMA', 1, 'Dus', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'KTP', 'Kue Tampah', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'Kacang Hijau', 'Kacang Hijau', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Kacang Kapri', 'Kacang Kapri', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Kacang Kedele', 'Kacang Kedele', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Kacang Panjang', 'Kacang Panjang', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Kacang Tanah', 'Kacang Tanah', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Kaki Kambing', 'Kaki Kambing', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Kaki Sapi', 'Kaki Sapi', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Kangkung', 'Kangkung', 1, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Kecap Asin', 'Kecap Asin', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Kecap Hitam', 'Kecap Hitam', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Kecap Inggris', 'Kecap Inggris', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Kecap Maggi', 'Kecap Maggi', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Kecap Manis', 'Kecap Manis', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'Kecombrang', 'Kecombrang', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Kem', 'Kem', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Kentang', 'Kentang', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'Kerupuk Udang', 'Kerupuk Udang', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'Kol', 'Kol', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Kptk', 'Kepiting Kaleng', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Kulit Pangsit', 'Kulit Pangsit', 1, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'KyM', 'Kayu Manis', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'LB', 'Lada Bubuk', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'LDJ', 'Lada Jawa', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'LDS', 'Lidah Sapi', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'Labu', 'Labu Siam', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'Lps', 'Lea Perrins Sauce', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Ls', 'Laos', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'MNC', 'Mini Cheace Boat', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'MSmm', 'Minyak Samin', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Mie Aceh', 'Mie Aceh', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Mie Atom', 'Mie Atom', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Minyak Fortune', 'Minyak Fortune', 1, 'Liter', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Minyak Goreng', 'Minyak Goreng', 1, 'Liter', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Minyak Wijen', 'Minyak Wijen', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'Mk', 'Makaroni', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Mus', 'Mushroom Kancing', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'Oncom', 'Oncom', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'P', 'Pare', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'PHK', 'Paha Kambing', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'PHS', 'Paha Sapi', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'PL', 'Pala', 1, 'Ons', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'PLD', 'Pelembut Daging', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'PSGKPK', 'Pisang Kepok', 1, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'PSPT', 'Pisang Putri', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'PT', 'Pete', 1, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Pakcoy', 'Pakcoy', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Pap K', 'Paprika Kuning', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Paprika Powder', 'Paprika Powder', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Pewarna', 'Pewarna Makanan', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Ph', 'Paprika Hijau', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Pk', 'Pk', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Plo', 'Polo Kulit', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Pm', 'Paprika Merah', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'RCAY', 'Royco Ayam', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'RCSP', 'Royco Sapi', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'RSST', 'Risol Segitiga', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'S.FN', 'Susu F & N', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'SK', 'Santan Kara', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'SLD', 'Selada', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'SPG', 'Spageti', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'SS', 'Saos Sambal', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'SSTR', 'Saus Tiram', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'ST', 'Saos Tomat', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Sbngk', 'Sambal Bangkok', 1, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Sel', 'Seledri', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Ser', 'Sereh', 1, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Sosis', 'Sosis', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Soun', 'Soun', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'TC', 'Tauco', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'TG', 'Tauge', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'TGS', 'Tauge Soto', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'TIK', 'TULANG IGA KAMBING', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'TJ', 'Tunjang', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'TKS', 'Tulang Kaki Sapi', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'TLKM', 'Tulang Kambing', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'TLSP', 'Tulang Sapi', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'TMD', 'Teri Medan', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'TSESP', 'Tulang Sengkel Sapi', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'Tahu', 'Tahu', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'Telur Asin', 'Telur Asin', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Telur Ayam', 'Telur Ayam', 1, 'Kg', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(203, 'Telur Puyuh', 'Telur Puyuh', 1, 'Pcs', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(204, 'Tempe', 'Tempe', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'Tempoyak', 'Tempoyak', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'Tepung Beras', 'Tepung Beras', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'Tepung MZ', 'Tepung MZ', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'Tepung Sagu Tani', 'Tepung Sagu Tani', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Tepung Terigu', 'Tepung Terigu', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Terong', 'Terong', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Terong Lalap', 'Terong Lalap', 1, 'kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Tim Lap', 'Timun Lalap', 1, 'kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'Timun Besar', 'Timun Besar', 1, 'kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Tofu', 'Tofu', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'Tomat', 'Tomat', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Trs', 'Terasi', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'UDG', 'Udang Gadis', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'UDGT', 'Udang Tiger', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'UPC', 'Udang Peci', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'Uk', 'Ubi Kayu', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'Ur', 'Ubi Rambat', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'V', 'Vainili', 1, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'WH', 'Wijen Hitam', 1, 'Kg', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(224, 'WP', 'Wijen Putih', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'WT', 'Wortel', 1, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, '330ML', 'Air Mineral 330ML', 2, 'Dus', 81, '0000-00-00 00:00:00', '2021-05-13 13:15:19'),
(227, 'AGAR-AGAR', 'AGAR-AGAR', 2, 'Pcs', 71, '0000-00-00 00:00:00', '2021-05-09 13:40:43'),
(228, 'BBM-PR', 'Prima 600', 2, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'Buah Alpukat', 'Buah Alpukat', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'Buah Belimbing', 'Buah Belimbing', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'Buah Bengkoang', 'Buah Bengkoang', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'Buah Jambu', 'Buah Jambu', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'Buah Kedondong', 'Buah Kedondong', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'Buah Mangga', 'Buah Mangga', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'Buah Melon', 'Buah Melon', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 'Buah Naga', 'Buah Naga', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 'Buah Nanas', 'Buah Nanas', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 'Buah Nangka', 'Buah Nangka', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 'Buah Semangka', 'Buah Semangka', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 'Buah Sirsak', 'Buah Sirsak', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 'Buah Strawberry', 'Buah Strawberry', 2, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 'CAPUCINO', 'CAPUCINO', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 'CCPNDN', 'Coco Pandan', 2, 'Dus', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 'CCW', 'Cincaw', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 'CNDL', 'Cendol', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 'DWT', 'Dawet', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 'Es Batu', 'Es Batu', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 'GC', 'Gula Cair', 2, 'Liter', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 'Gelas TKW', 'Gelas TKW', 2, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(250, 'Grand', 'Grand Air Mineral 600ML', 2, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(251, 'Gula Cair', 'Gula Cair', 2, 'Liter', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(252, 'HS', 'Handsoap', 2, 'Liter', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(253, 'JHWGI', 'Jahe Wangi', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(254, 'Jahe Kopi', 'Anget Sari Kopi Jahe', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(255, 'Jeruk Kunci', 'Jeruk Kunci', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(256, 'Jeruk Lemon', 'Jeruk Lemon', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(257, 'Jeruk Manis', 'Jeruk Manis', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(258, 'Jeruk Nipis', 'Jeruk Nipis', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(259, 'KH', 'Kopi Hitam', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(260, 'KJ', 'Keju Kraf', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(261, 'Kacang Merah', 'Kacang Merah', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(262, 'Kacang T.Kupas', 'Kacang Tanah Kupas', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(263, 'Kelapa Muda', 'Kelapa Muda', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(264, 'Ketan Hitam', 'Ketan Hitam', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(265, 'KKL', 'Kolang-Kaling', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(266, 'MJW', 'Mekar Jahe Wangi', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(267, 'MSC', 'Meses Ceres', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(268, 'Manisan Kiamboy', 'Manisan Kiamboy', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(269, 'Nata', 'Nata De Coco', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(270, 'PSA', 'PSA', 2, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(271, 'Pacar', 'Pacar Cina', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(272, 'Pms', 'Pemanis', 2, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(273, 'Pr', 'Prima 600ML', 2, 'Pcs', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(274, 'R.GD GRM MENTOL', 'Rokok Gudang Garam Mentol', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(275, 'R.GG', 'Rokok GG International', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(276, 'R.GGM', 'Rokok GG MOVE 12', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(277, 'R.GIGI MILD', 'Rokok Gigi Mild', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(278, 'R.GUDANG GARAM', 'Rokok Gudang Garam', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(279, 'R.SIGNATURE', 'Rokok 16 GG Signature Biru', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(280, 'R.SUR.EXCLUSIVE', 'Rokok Surya Exclusive', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(281, 'R.SURYA 12', 'Rokok 12 Filter Surya Coklat', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(282, 'R.SURYA 16', 'Rokok 16 Filter Surya Coklat', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(283, 'R.SURYA GP', 'Rokok Surya GP (12 Fil)', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(284, 'R.SURYA MENTOL', 'Rokok Surya Mentol (16 GMDLEP)', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(285, 'R.SURYA PRO', 'Rokok Surya Pro Merah', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(286, 'R.SURYA PROMILD', 'Rokok Surya Promild', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(287, 'R.SURYA SHIVER', 'Rokok Surya Shiver', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(288, 'ROTI TAWAR', 'ROTI TAWAR', 2, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(289, 'S.Mrj', 'Sirup Marjan', 2, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(290, 'SLSI', 'Selasi', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(291, 'SSC', 'Susu Coklat', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(292, 'STMJ', 'STMJ Ginseng Susu', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(293, 'Santan Pasar', 'Santan Pasar', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(294, 'Susu Carnation', 'Susu Carnation', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(295, 'TAJ', 'The Arjuna', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(296, 'TMwr', 'Teh Mawar', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(297, 'TPE', 'TAPE', 2, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(298, 'VIT', 'VIT 600 ML', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(299, 'WDANK', 'WDANK NUTRISARI', 2, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(300, 'BP-KLIP', 'Klip Uk.8.7x13', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(301, 'Bom', 'Boom Deterjen Bubuk', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(302, 'CT', 'CLIP + TUTUP', 3, 'Bks', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(303, 'Custard Powder', 'Custard Powder', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(304, 'GSEI', 'Gas Elpiji Isi Ulang', 3, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(305, 'Harpic', 'Harpic', 3, 'Botol', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(306, 'Hit', 'Hit/Baygon', 3, 'Klng', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(307, 'K.1 Kg', 'Kantong Plastik 1 kg (Hd Pluit uk.28x48)', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(308, 'K.1/4 KG', 'Kantong Plastik 1/4 Kg (10*18)', 3, 'Ikat', 0, '0000-00-00 00:00:00', '2021-05-08 14:26:59'),
(309, 'K.A 1/2 KG', 'Kantong Plastik 1/2 Kg (12*22)', 3, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(310, 'K.A 19', 'Kantong Asoy Susu (Uk.19)', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(311, 'K.A 24', 'Kantong Asoy Susu (Uk.24)', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(312, 'K.A 28', 'Kantong Asoy Susu (Uk.28)', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(313, 'K.A UK.15', 'Kantong Kresek Bening Uk.15', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(314, 'K.Assoy B', 'Kantong Asoy besar (kupu2 uk.50)', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(315, 'K.Assoy Sd', 'Kantong Plastik 2 Kg (20*30)', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(316, 'K.Cup Sambel', 'Cup Sambel', 3, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(317, 'K.Sampah Htm', 'Kantong Sampah Hitam (90*120)', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(318, 'K.Sampah Putih', 'Kantong Sampah Putih (75*105)', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(319, 'K.Susu', 'Kantong Asoy Susu Kupu2 uk.40', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(320, 'KA.5 KG 14*28', 'Kantong Plastik 5 Kg HD Pluit 14*28', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(321, 'KLL', 'Kaki Lilin', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(322, 'KLP', 'Klip 5*8', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(323, 'KRA', 'Korek Api', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(324, 'KRTMRH', 'Karet Merah', 3, 'Kg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(325, 'KTA', 'Kotak Take Away', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(326, 'Kapur Barus', 'Kapur Barus', 3, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(327, 'Karbol Lv', 'Karbol Lantai Lavender', 3, 'Drijen', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(328, 'Kertas Nasi', 'Kertas Nasi', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(329, 'Kertas Nasi Kembang', 'Kertas Nasi Kembang', 3, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(330, 'Kotak Nasi Paket', 'Kotak Nasi Paket', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(331, 'Krbl', 'Karbol Lantai Lavender', 3, 'Drijen', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(332, 'Liquid Meja', 'Liquid Pembersih Meja', 3, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(333, 'M.G 2', 'Mika Goesyen 2', 3, 'Ball', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(334, 'M.G 3', 'Mika Goesyen 3', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(335, 'Mika Sekat 18*18', 'Mika Sekat 18*18', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(336, 'PB', 'Plastic Bag', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(337, 'Pipet', 'Pipet Kecil', 3, 'Ball', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(338, 'Pipet Besar', 'Pipet Besar', 3, 'Ball', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(339, 'Pipet Bengkok', 'Pipet Bengkok', 3, 'Ball', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(340, 'RT', 'Racun Tikus', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(341, 'SCP', 'Sabun Cuci Piring', 3, 'Liter', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(342, 'SDKP', 'Sendok Plastik', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(343, 'SKK', 'Sikat Kawat', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(344, 'SKR', 'Skrap', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(345, 'SL', 'Sumbu Lilin', 3, 'Bks', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(346, 'SPON', 'Spon Cuci', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(347, 'Spritus', 'Spritus', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(348, 'T OL', 'TISSUE ROLL', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(349, 'T.LTR', 'Tisue LIVI TOIL ROLL', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(350, 'TLPU', 'Tisue Livi POP UP', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(351, 'TLTW', 'Tisue Livi Towel', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(352, 'TLVPU', 'Tisue Livi F.POP UP KILOAN 5150', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(353, 'TLVSN', 'Tisue Livi Sendok (T.4133)', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(354, 'TSWF', 'Tisue Wastafel', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(355, 'Tst', 'Tusuk Sate', 3, 'Ikat', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(356, 'Tusuk Gigi', 'Tusuk Gigi', 3, 'Pcs', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(23, 7, 226, 100, '', '2021-05-08 16:59:55', '2021-05-08 16:59:55'),
(24, 7, 1, 89, '', '2021-05-08 16:59:56', '2021-05-08 16:59:56'),
(25, 7, 227, 90, '', '2021-05-08 16:59:56', '2021-05-08 16:59:56'),
(26, 8, 226, 9, '', '2021-05-08 17:01:00', '2021-05-08 17:01:00'),
(27, 8, 1, 19, '', '2021-05-08 17:01:00', '2021-05-08 17:01:00');

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
(3, 3, 226, 10, '', '2021-05-08 17:00:17', '2021-05-08 17:00:17'),
(4, 3, 1, 8, '', '2021-05-08 17:00:17', '2021-05-08 17:00:17'),
(5, 4, 226, 18, '', '2021-05-08 17:03:08', '2021-05-08 17:03:08'),
(6, 4, 1, 11, '', '2021-05-08 17:03:08', '2021-05-08 17:03:08'),
(7, 5, 227, 1, '', '2021-05-09 12:57:41', '2021-05-09 12:57:41'),
(8, 6, 227, 18, '', '2021-05-09 13:40:43', '2021-05-09 13:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan`
--

CREATE TABLE `detail_permintaan` (
  `id_detail_permintaan` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_permintaan`
--

INSERT INTO `detail_permintaan` (`id_detail_permintaan`, `id_permintaan`, `id_barang`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(13, 12, 226, 11, '', '2021-05-09 13:10:52', '2021-05-09 13:10:52'),
(15, 13, 226, 10, '', '2021-05-09 13:31:53', '2021-05-09 13:31:53'),
(16, 14, 1, 1, '', '2021-05-09 13:32:26', '2021-05-09 13:32:26');

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
(16, 4, 'Ryan', '2021-03-30 15:28:45', '2021-03-30 15:29:21'),
(17, 1, 'Metta Saputra', '2021-04-28 13:31:53', '2021-04-28 13:31:53'),
(18, 5, 'Calvin M', '2021-05-08 16:47:37', '2021-05-08 16:47:37');

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
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerimaan`
--

INSERT INTO `penerimaan` (`id_penerimaan`, `tanggal`, `id_supplier`, `id_karyawan`, `jenis_penerimaan`, `keterangan`, `created_at`, `updated_at`) VALUES
(7, '2021-04-30', 3, NULL, 'Penerimaan Barang dari Supplier', '', '2021-05-08 16:59:55', '2021-05-08 16:59:55'),
(8, '2021-05-09', 3, NULL, 'Penerimaan Barang dari Supplier', '', '2021-05-08 17:01:00', '2021-05-08 17:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `request_by` int(11) DEFAULT NULL,
  `jenis_pengeluaran` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `request_by`, `jenis_pengeluaran`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, '2021-04-30', 1, 'Permintaan Karyawan', '', '2021-05-08 17:00:17', '2021-05-08 17:00:17'),
(4, '2021-05-09', NULL, 'Pengeluaran Opsional', '', '2021-05-08 17:03:08', '2021-05-08 17:03:08'),
(5, '2021-05-09', 17, 'Permintaan Karyawan', '', '2021-05-09 12:57:41', '2021-05-09 12:57:41'),
(6, '2021-05-18', 17, 'Permintaan Karyawan', '', '2021-05-09 13:40:42', '2021-05-09 13:40:42');

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

--
-- Dumping data for table `permintaan_karyawan`
--

INSERT INTO `permintaan_karyawan` (`id_permintaan`, `tanggal_kebutuhan`, `request_by`, `keterangan`, `created_at`, `updated_at`) VALUES
(12, '2021-05-10', 4, '', '2021-05-09 13:10:52', '2021-05-09 13:10:52'),
(13, '2021-05-20', 4, '', '2021-05-09 13:31:53', '2021-05-09 13:31:53'),
(14, '2021-05-20', 4, '', '2021-05-09 13:32:26', '2021-05-09 13:32:26');

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
(2, 'PT ABC', 'William', '08973051987', 'Tangerang', '2021-03-30 16:41:32', '2021-03-30 16:41:32'),
(3, 'PT. XYZ', 'Metta Saputra', '08973051987', 'Celentang', '2021-05-04 12:15:51', '2021-05-04 12:15:51'),
(4, 'Celentang', 'Celentang', '08973051987', 'Celentang', '2021-05-04 12:16:03', '2021-05-04 12:16:03');

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
(1, 'Metta Saputra', '0220m2a', 2, '2021-03-28 16:26:37', '2021-05-08 16:52:12'),
(2, 'Siti Mulyati', 'SITIMULY', 3, '2021-03-30 15:45:30', '2021-04-23 10:38:40'),
(4, 'Yudhistira', '', 3, '2021-03-30 16:18:23', '2021-03-30 16:18:23'),
(5, 'Verawati', 'YDHS1234', 3, '2021-03-30 16:21:21', '2021-03-30 16:21:21'),
(6, 'Calvin M', 'CM0143', 2, '2021-05-08 16:47:55', '2021-05-08 16:47:55'),
(7, 'Polyanski', 'POLY1234', 1, '2021-05-08 16:52:30', '2021-05-08 16:52:30');

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `detail_penerimaan`
--
ALTER TABLE `detail_penerimaan`
  MODIFY `id_detail_penerimaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  MODIFY `id_detail_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  MODIFY `id_detail_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `id_penerimaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permintaan_karyawan`
--
ALTER TABLE `permintaan_karyawan`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
