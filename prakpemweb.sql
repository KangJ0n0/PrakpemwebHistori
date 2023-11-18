-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2023 at 02:04 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prakpemweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id_film` int NOT NULL,
  `nama_film` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gambar_film` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_film` varchar(2500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `nama_film`, `gambar_film`, `deskripsi_film`, `tahun`) VALUES
(1, 'Jujur Kasihan', 'assets/jujur kasihan.jpg', 'Berikut alasan penggemar merubah judul anime Jujutsu Kaisen menjadi Jujur Kasian:\r\n\r\nKarakter utama kurang mendapat perhatian\r\nHal ini disebabkan oleh Satoru Gojo yang mendapatkan lebih banyak perhatian dibandingkan Yuji Itadori selaku karakter utama Jujutsu Kaisen.\r\n', 2023),
(2, 'Jenderal Soedirman', 'assets/jenderal soedirman.jpg', 'Film ini bercerita tentang seorang tokoh yang bernama Soedirman, seorang jenderal yang menderita penyakit paru-paru dan hanya memiliki satu paru-paru namun begitu gigih berjuang dan berperang gerilya melawan penjajahan Belanda.\r\n\r\nMovie Time kala itu diadakan pada Kamis, 16 Agustus 2018, dimulai pada Pkl. 13.00 – 15.00 wib dan bertempat di Library Lounge, Universitas Ciputra 3, Lantai 2.\r\n\r\nFilm yang dibintangi oleh Adipatiu dolken ini menceritakan tentang Belanda menyatakan secara sepihak sudah tidak terikat dengan perjanjian Renville, sekaligus menyatakan penghentian gencatan senjata. Pada tanggal 19 Desember 1948, Jenderal Simons Spoor Panglima Tentara Belanda memimpin Agresi militer ke II menyerang Yogyakarta yang saat itu menjadi ibukota Republik..\r\n\r\nSoekarno-Hatta ditangkap dan diasingkan ke Pulau Bangka. Jenderal Soedirman yang sedang didera sakit berat melakukan perjalanan ke arah selatan dan memimpin perang gerilya selama tujuh bulan.\r\n\r\nBelanda menyatakan Indonesia sudah tidak ada. Dari kedalaman hutan, Jenderal Soedirman menyiarkan bahwa Republik Indonesia masih ada, kokoh berdiri bersama Tentara Nasionalnya yang kuat.\r\n\r\nSoedirman membuat Jawa menjadi medan perang gerilya yang luas, membuat Belanda kehabisan logistik dan waktu.\r\n\r\nKemanunggalan TNI dan rakyat lah akhirya memenangkan perang. Dengan ditanda tangani Perjanjian Roem-Royen, Kerajaan Belanda mengakui kedaulatan RI seutuhnya.\r\n\r\n', 2015),
(10, 'Tendangan si Madun Returns', 'assets/madun.jpg', 'Madun anak berusia 12 tahun ini, sehari hari tinggal bersama ibunya, Bu Marni. Madun bekerja sebagai Pembersih di lapangan Futsal milik Pak Darmawan dan Ibu Shinta. Suatu hari Pak Darmawan dan Bu Shinta yang menginginkan tanah milik Panti Asuhan, sengaja menagih hutang ibu Panti demi mendapatkan tanah tersebut. Karena upayanya gagal, lalu mereka memutuskan mengadakan pertandingan sepak bola antara team Pak Darmawan bersama anaknya, Juki, melawan team Panti Asuhan. Saat pertandingan berlangsung, team Panti Asuhan nyaris kalah. Melihat itu Madun tidak rela, karena tidak ingin Panti Asuhan di ambil paksa oleh Pak Darmawan, Maka diam diam ia menyamar menjadi pemain bola bertopeng demi membantu team panti Asuhan, hingga akhirnya meraih kemenangan.\r\n\r\nPak Darmawan tidak rela menerima kekalahan itu, lalu diam diam melakukan perjanjian lagi dengan Bang Jebret untuk mengadakan ulang pertandingan dengan iming iming jika team panti kembali memenangkan pertandingan, dia akan merelakan Panti Asuhan sekaligus juga akan memperbaiki fasilitas panti asuhan. Bang Jebret yang tergiur diam diam menyetujui usul Pak Darmawan tanpa membicarakannya terlebih dahulu dengan Ibu Panti. Bang Jebret juga berharap tim panti akan kembali mendapat bantuan dari Pemain Bertopeng alias Madun.\r\n\r\nTanpa disangka, Bu Marni yang tahu Madun dekat dengan Panti Asuhan menjadi cemas. Dia takut rahasia nya terbongkar, kalau Madun bukan anak kandungnya, melainkan anak yang diambil dari panti asuhan. Bu Marni pun akhirnya meminta ke Madun untuk berjanji tidak lagi berhubungan dengan team Panti dan juga tidak lagi bermain bola. Madun yang tidak bisa melihat Ibunya sedih itu menyetujui perjanjian tersebut, walau sebenarnya bingung dan sedih bila tidak boleh bermain bola lagi, lalu bagaimana dengan nasib team Panti? Maka Madun pun dengan berat hati menolak ketika Dodo CS meminta bantuannya untuk bergabung bertanding melawan team Pak Darmawan.\r\n\r\nDalam kebingungannya itu dia bertemu seorang Kakek Tua, yang kemudian banyak mengajarinya teknik bermain bola. Sampai akhirnya Madun tahu kalau ternyata kakek itu sedang mencari cucu nya yang hilang karena diambil oleh lawan tanding anaknya sesama pemain sepak bola. Tanpa di ketahui oleh kakek tua kalau sebenarnya cucu yang dicarinya itu adalah Madun.\r\n', 2014);

-- --------------------------------------------------------

--
-- Table structure for table `myfilm`
--

CREATE TABLE `myfilm` (
  `id_myfilm` int NOT NULL,
  `id_user` int NOT NULL,
  `id_film` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myfilm`
--

INSERT INTO `myfilm` (`id_myfilm`, `id_user`, `id_film`) VALUES
(11, 29, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user','manager') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `username`, `password`, `role`) VALUES
(1, 'jonomabokastagfirullahcapekanjing@gmail.com', 'jono', '123', 'admin'),
(29, 'afiftharavi@gmail.com', 'afif', '123', 'user'),
(30, 'ahmadsamsudin@gmail.com', 'ahmad', '123', 'user'),
(31, 'rizkisamsudin@gmail.com', 'rizki', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `myfilm`
--
ALTER TABLE `myfilm`
  ADD PRIMARY KEY (`id_myfilm`),
  ADD KEY `fk_myfilm_user` (`id_user`),
  ADD KEY `fk_myfilm_film` (`id_film`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `myfilm`
--
ALTER TABLE `myfilm`
  MODIFY `id_myfilm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `myfilm`
--
ALTER TABLE `myfilm`
  ADD CONSTRAINT `fk_myfilm_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  ADD CONSTRAINT `fk_myfilm_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
