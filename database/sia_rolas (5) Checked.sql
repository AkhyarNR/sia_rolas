-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2020 at 03:40 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia_rolas`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_apotek`
--

CREATE TABLE `m_apotek` (
  `id` int(11) NOT NULL,
  `nama_apotek` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_apotek`
--

INSERT INTO `m_apotek` (`id`, `nama_apotek`) VALUES
(1, 'KIMIA FARMA 121'),
(2, 'KIMIA FARMA GAJAH MADA'),
(3, 'BIMA APOTEK'),
(4, 'MANJUR APOTEK'),
(5, 'DEWI KASIH APOTEK'),
(6, 'KIMIA FARMA 241'),
(7, 'JEMBER APOTEK'),
(8, 'APOTEK FARMASI 99'),
(9, 'APOTEK WALUYO'),
(10, 'APOTEK SEMESTA GROUP'),
(11, 'IBI APOTEK'),
(12, 'TALANGSARI APOTEK'),
(13, 'APOTEK SEHAT');

-- --------------------------------------------------------

--
-- Table structure for table `m_dosis`
--

CREATE TABLE `m_dosis` (
  `id` int(11) NOT NULL,
  `konsumsi_obat` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_dosis`
--

INSERT INTO `m_dosis` (`id`, `konsumsi_obat`) VALUES
(1, '1x1 Sebelum Makan'),
(2, '1x1 Sesudah Makan'),
(3, '1x2 Sebelum Makan'),
(4, '1x2 Sesudah Makan'),
(5, '1x3 Sebelum Makan'),
(6, '1x3 Sesudah Makan');

-- --------------------------------------------------------

--
-- Table structure for table `m_jabatan`
--

CREATE TABLE `m_jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jabatan`
--

INSERT INTO `m_jabatan` (`id`, `nama_jabatan`) VALUES
(1, 'KEPALA APOTEK'),
(2, 'DOKTER'),
(3, 'PETUGAS APOTEK');

-- --------------------------------------------------------

--
-- Table structure for table `m_jenis_obat`
--

CREATE TABLE `m_jenis_obat` (
  `id` int(11) NOT NULL,
  `jenis_obat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_jenis_obat`
--

INSERT INTO `m_jenis_obat` (`id`, `jenis_obat`) VALUES
(1, 'PULV'),
(2, 'KAP'),
(3, 'TAB'),
(4, 'SUPOSITURI'),
(5, 'GEL'),
(6, 'SALEP'),
(7, 'FLASH'),
(8, 'DROP'),
(9, 'INJ'),
(10, 'EMULSI'),
(11, 'SIRUP');

-- --------------------------------------------------------

--
-- Table structure for table `m_obat`
--

CREATE TABLE `m_obat` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(8) NOT NULL,
  `nama_obat` varchar(35) NOT NULL,
  `id_jenis_obat` int(11) NOT NULL,
  `total_qty` int(7) NOT NULL DEFAULT '0',
  `id_satuan_obat` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_obat`
--

INSERT INTO `m_obat` (`id`, `kode_obat`, `nama_obat`, `id_jenis_obat`, `total_qty`, `id_satuan_obat`, `status`) VALUES
(1, 'OBT00001', 'Betadine', 11, 4120, 3, 1),
(3, 'OBT00003', 'Panadol Exxtra', 2, 890, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_pasien`
--

CREATE TABLE `m_pasien` (
  `id` int(11) NOT NULL,
  `no_pasien` varchar(7) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `no_bpjs` varchar(20) DEFAULT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `jenis` enum('UMUM','BPJS') NOT NULL,
  `jenis_kelamin` enum('Perempuan','Laki-Laki') NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pasien`
--

INSERT INTO `m_pasien` (`id`, `no_pasien`, `no_ktp`, `no_bpjs`, `nama_pasien`, `jenis`, `jenis_kelamin`, `no_hp`, `alamat`) VALUES
(1, 'PX00001', '3511110901980001', '3511110901980001', 'Akhyar Nur Rahmadhan', 'UMUM', 'Laki-Laki', '085334802042', 'Jl.Dr.Sutomo'),
(3, 'PX00003', '3511110901980003', '3511110901980003', 'Sumiati Yolo', 'BPJS', 'Perempuan', '08523545141', 'Jl. Karawang yuhu');

-- --------------------------------------------------------

--
-- Table structure for table `m_satuan_obat`
--

CREATE TABLE `m_satuan_obat` (
  `id` int(11) NOT NULL,
  `satuan_obat` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_satuan_obat`
--

INSERT INTO `m_satuan_obat` (`id`, `satuan_obat`) VALUES
(1, 'pcs'),
(2, 'box'),
(3, 'botol'),
(4, 'pack'),
(5, 'strip'),
(6, 'sct');

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `id` int(11) NOT NULL,
  `kode_supplier` varchar(6) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`id`, `kode_supplier`, `nama_supplier`) VALUES
(1, 'SUP001', 'ANTAR MITRA SEMBADA, PT'),
(2, 'SUP002', 'ANUGERAH PHARMINDO LESTARI, PT'),
(3, 'SUP003', 'ANUGRAH ARGON MEDIKA, PT'),
(4, 'SUP004', 'ANUGRAH MITRA JAYA, PT'),
(5, 'SUP005', 'BINA SAN PRIMA, PT'),
(6, 'SUP006', 'DHARMA INTAN MEDIKA, CV'),
(7, 'SUP007', 'DOS NI ROHA, PT'),
(8, 'SUP008', 'INTI SUMBER HASIL SEMPURNA, PT'),
(9, 'SUP009', 'KEBAYORAN PHARMA, PT'),
(10, 'SUP010', 'DAKONAN MAS, PT'),
(11, 'SUP011', 'ENSEVAL PUTERA MEGATRADING, PT'),
(12, 'SUP012', 'MILLENIUM PHARMACON INT, PT'),
(13, 'SUP013', 'KIMIA FARMA, PT'),
(14, 'SUP014', 'MITRA MEDITAMA ABADI, PT'),
(15, 'SUP015', 'MULTI MEDIKA MAKMUR, PT'),
(16, 'SUP016', 'MERAPI UTAMA PHARMA, PT'),
(17, 'SUP017', 'RAJAWALI NUSINDO, PT'),
(18, 'SUP018', 'SAKAJAJA MAKMUR ABADI, PT'),
(19, 'SUP019', 'SURYA SINERGI SEMESTA, PT'),
(20, 'SUP020', 'MEGAH MEDIKA PHARMA, PT'),
(21, 'SUP021', 'BERKAT KURNIA FARMA, PT'),
(22, 'SUP022', 'PARIT PADANG GLOBAL, PT'),
(23, 'SUP023', 'FARMAHUSADA MILLENNIA, PT'),
(24, 'SUP024', 'AWET MUDA, PT');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(5) DEFAULT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id`, `kode_user`, `nama_user`, `username`, `password`, `id_jabatan`) VALUES
(1, 'USR01', 'Dr. Akhyar Nur, Yoi.', 'imyarrr', '25d55ad283aa400af464c76d713c07ad', 1),
(2, 'USR02', 'Dr. Errica Rostia Loren, Mm. Md.', 'errica', '0192023a7bbd73250516f069df18b500', 2),
(12, 'USR12', 'Dr. Sumiati, Sgm. Milo', 'sumiaticuy', '25d55ad283aa400af464c76d713c07ad', 2),
(13, 'USR13', 'Dr. Joko Andwar, Sksd', 'wetesjok', '25d55ad283aa400af464c76d713c07ad', 3);

--
-- Triggers `m_user`
--
DELIMITER $$
CREATE TRIGGER `auto_kode_user` BEFORE INSERT ON `m_user` FOR EACH ROW BEGIN
	IF NEW.id < 10 THEN
		SET NEW.kode_user = CONCAT("USR0",NEW.id);
	ELSE
		SET NEW.kode_user = CONCAT("USR",NEW.id);
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_obat`
--

CREATE TABLE `t_detail_obat` (
  `id` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `exp_date` date NOT NULL,
  `harga_beli` int(8) DEFAULT '0',
  `harga_ecer` int(8) NOT NULL DEFAULT '0',
  `harga_grosir` int(8) NOT NULL DEFAULT '0',
  `qty` int(6) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_pembelian`
--

CREATE TABLE `t_detail_pembelian` (
  `id` int(11) NOT NULL,
  `id_pembelian_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `exp_date` date NOT NULL,
  `qty` int(5) NOT NULL,
  `harga` int(8) NOT NULL,
  `sub_total` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_penjualan`
--

CREATE TABLE `t_detail_penjualan` (
  `id` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_detail_obat` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `harga` int(8) NOT NULL,
  `sub_total` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_resep`
--

CREATE TABLE `t_detail_resep` (
  `id` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `id_dosis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_detail_retur`
--

CREATE TABLE `t_detail_retur` (
  `id` int(11) NOT NULL,
  `id_retur` int(11) NOT NULL,
  `kode_obat` varchar(5) NOT NULL,
  `id_satuan_obat` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `sub_total` bigint(13) NOT NULL,
  `keterangan` enum('RUSAK','EXP') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian`
--

CREATE TABLE `t_pembelian` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(9) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_qty` int(8) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `bukti_pembelian` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(10) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `id_resep` int(11) DEFAULT NULL,
  `id_apotek` int(11) DEFAULT NULL,
  `total_qty` int(8) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_resep`
--

CREATE TABLE `t_resep` (
  `id` int(11) NOT NULL,
  `no_resep` varchar(9) NOT NULL,
  `tgl_resep` date NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_retur`
--

CREATE TABLE `t_retur` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(8) NOT NULL,
  `total_qty` int(8) NOT NULL,
  `total_harga` bigint(13) NOT NULL,
  `bukti_retur` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_apotek`
--
ALTER TABLE `m_apotek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_dosis`
--
ALTER TABLE `m_dosis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jenis_obat`
--
ALTER TABLE `m_jenis_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_obat`
--
ALTER TABLE `m_obat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_obat` (`kode_obat`),
  ADD KEY `id_jenis_obat` (`id_jenis_obat`),
  ADD KEY `id_satuan_obat` (`id_satuan_obat`);

--
-- Indexes for table `m_pasien`
--
ALTER TABLE `m_pasien`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_pasien` (`no_pasien`);

--
-- Indexes for table `m_satuan_obat`
--
ALTER TABLE `m_satuan_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_supplier`
--
ALTER TABLE `m_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `kode_user` (`kode_user`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `t_detail_obat`
--
ALTER TABLE `t_detail_obat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_obat` (`id_obat`) USING BTREE,
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `t_detail_pembelian`
--
ALTER TABLE `t_detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembelian_obat` (`id_pembelian_obat`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `t_detail_penjualan`
--
ALTER TABLE `t_detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_detail_obat` (`id_detail_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `t_detail_resep`
--
ALTER TABLE `t_detail_resep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_resep` (`id_resep`),
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_dosis` (`id_dosis`);

--
-- Indexes for table `t_detail_retur`
--
ALTER TABLE `t_detail_retur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_transaksi` (`no_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_transaksi` (`no_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_resep`
--
ALTER TABLE `t_resep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `t_retur`
--
ALTER TABLE `t_retur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_apotek`
--
ALTER TABLE `m_apotek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `m_dosis`
--
ALTER TABLE `m_dosis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_jabatan`
--
ALTER TABLE `m_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_jenis_obat`
--
ALTER TABLE `m_jenis_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `m_obat`
--
ALTER TABLE `m_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_pasien`
--
ALTER TABLE `m_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_satuan_obat`
--
ALTER TABLE `m_satuan_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_supplier`
--
ALTER TABLE `m_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_detail_obat`
--
ALTER TABLE `t_detail_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_detail_pembelian`
--
ALTER TABLE `t_detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_detail_penjualan`
--
ALTER TABLE `t_detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_detail_resep`
--
ALTER TABLE `t_detail_resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_detail_retur`
--
ALTER TABLE `t_detail_retur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_resep`
--
ALTER TABLE `t_resep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_retur`
--
ALTER TABLE `t_retur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_obat`
--
ALTER TABLE `m_obat`
  ADD CONSTRAINT `m_obat_ibfk_1` FOREIGN KEY (`id_jenis_obat`) REFERENCES `m_jenis_obat` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_obat_ibfk_2` FOREIGN KEY (`id_satuan_obat`) REFERENCES `m_satuan_obat` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
