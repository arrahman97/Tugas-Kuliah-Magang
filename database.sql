DROP DATABASE IF EXISTS `dbistec`;
CREATE DATABASE IF NOT EXISTS `dbistec`;
USE `dbistec`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bayar`
--

DROP TABLE IF EXISTS `tbl_bayar`;
CREATE TABLE IF NOT EXISTS `tbl_bayar` (
  `idbayar` bigint(255) Not Null AUTO_INCREMENT,
  `kd_byr` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `spp` bigint(8) NOT NULL,
  `dpp` bigint(8) NOT NULL,
  `makan` bigint(8) NOT NULL,
  `snack` bigint(8) NOT NULL,
  `pomg` bigint(8) NOT NULL,
  `eks_eng` bigint(8) NOT NULL,
  `eks_rob` bigint(8) NOT NULL,
  `eks_fut` bigint(8) NOT NULL,
  `eks_arc` bigint(8) NOT NULL,
  `eks_kar` bigint(8) NOT NULL,
  `smt_1` bigint(8) NOT NULL,
  `smt_2` bigint(8) NOT NULL,
  `buku` bigint(8) NOT NULL,
  `srgm` bigint(8) NOT NULL,
  `lain` double NOT NULL,
  `keterangan` longtext NOT NULL,
  primary key (`idbayar`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bayar`
--

INSERT INTO `tbl_bayar` (`kd_byr`, `nama`, `status`, `bulan`, `spp`, `dpp`, `makan`, `snack`, `pomg`, `eks_eng`, `eks_rob`, `eks_fut`, `eks_arc`, `eks_kar`, `smt_1`, `smt_2`, `buku`, `srgm`, `lain`, `keterangan`) VALUES
(1234, 'fadhil', 'L', '9', 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 0,'sudah lunas semua');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

DROP TABLE IF EXISTS `tbl_siswa`;
CREATE TABLE IF NOT EXISTS `tbl_siswa` (
  `idsiswa` bigint(255) Not Null AUTO_INCREMENT,
  `kd_byr` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jns_klmn` varchar(1) NOT NULL,
  `spp` bigint(8) NOT NULL,
  `dpp` bigint(8) NOT NULL,
  `makan` bigint(8) NOT NULL,
  `snack` bigint(8) NOT NULL,
  `pomg` bigint(8) NOT NULL,
  `eks_eng` bigint(8) NOT NULL,
  `eks_rob` bigint(8) NOT NULL,
  `eks_fut` bigint(8) NOT NULL,
  `eks_arc` bigint(8) NOT NULL,
  `eks_kar` bigint(8) NOT NULL,
  `smt_1` bigint(8) NOT NULL,
  `smt_2` bigint(8) NOT NULL,
  `buku` bigint(8) NOT NULL,
  `srgm` bigint(8) NOT NULL,
  `lain` double NOT NULL,
  primary key (`idsiswa`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`kd_byr`, `nama`, `jns_klmn`, `spp`, `dpp`, `makan`, `snack`, `pomg`, `eks_eng`, `eks_rob`, `eks_fut`, `eks_arc`, `eks_kar`, `smt_1`, `smt_2`, `buku`, `srgm`, `lain`) VALUES
(1234, 'fadhil', 'L', 100, 100, 100, 100, 100, 100, 0, 100, 0, 100, 100, 100, 100, 100, 0);


DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `idkeluar` bigint(255) Not Null AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `jumlahkeluar` bigint(8) NOT NULL,
  `keterangan` longtext NOT NULL,
  primary key (`idkeluar`)
  ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `pengeluaran` (`tanggal`, `jumlahkeluar`, `keterangan`) VALUES
('2019-10-09 10:11:08', 10000, 'Beli Pulsa');