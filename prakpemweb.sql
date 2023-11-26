-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2023 at 05:16 PM
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
  `tahun` int NOT NULL,
  `direktor` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `writer` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `stars` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `durasi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `nama_film`, `gambar_film`, `deskripsi_film`, `tahun`, `direktor`, `writer`, `stars`, `durasi`) VALUES
(1, 'Habibie & Ainun', 'assets/image 36.png', 'This movie is based on the memoir written by the 3rd President of Indonesia and one of the world-famous engineer, B.J. Habibie about his wife, Hasri Ainun Habibie.', 2012, 'Faozan Rizal', 'B.J. Habiebie, Ifan Ismail, Gina S Noer', 'Reza Rahardian, Bunga Citra Lestari, Tio Pakusadewo', '2h '),
(2, 'Bumi Manusia', 'assets/image 36 (1).png', 'A native Javanese boy and a mixed-Dutch girl fall in love during the early 20th-century colonial turbulence in Dutch East Indies (now Indonesia).', 2019, 'Hanung Bramantyo, X. Jo', 'Pramoedya Ananta Toer, Salman Aristo', 'Iqbaal Dhiafakhri Ramadhan, Mawar Eva De Jongh', '3h 1m'),
(3, 'Kartini: Princess of Java', 'assets/image 36 (2).png', 'This movie follows the story of the Indonesian heroine named Kartini. In the early 1900s, when Indonesia was still a colony of the Netherlands, women weren\'t allowed to get higher education. Kartini grew up to fight for equality for women.', 2017, 'Hanung Bramayanto', 'Bagus Bramanti, Hanung Bramayanto, Robert Ronny ', 'Dian Sastrowardoyo, Ayushita, Acha Septriasa', '2h 2m'),
(4, 'Buya Hamka Vol. 1', 'assets/image 36 (3).png', 'This sweeping biopic captures the life of renowned Muslim scholar Buya Hamka, from his humble West Sumatra origins to his political achievements.', 2023, 'Fajar Bustomi', 'Cassandra Massardi, Alim Sudio', 'Vino G. Bastian, Laudya Chintya Bella,  Donny Damara', '1h 46m'),
(5, 'Soekarno', 'assets/image 36 (4).png', 'This movie follows the life of Soekarno, the first president of the Republic of Indonesia, from his childhood until he managed to proclaimed Indonesian freedom with M. Hatta in 1945.', 2013, 'Hanung Bramayanto', 'Ben Sihombing', 'Ario Bayu, Muhammad Abbe, Moch. Achir', '2h 17m'),
(6, 'Sultan Agung: Tahta, Perjuangan, Cinta', 'assets/image 37.png', 'The story about Sultan Agung of Mataram, how he ascended the throne and had to face VOC in great wars, the events that caused his people\'s misery.', 2018, 'Hanung Bramantyo, X. Jo', 'Ifan Ismail, Bagas Pudjilanksono, Mooryati Soedibyo', 'Ario Bayu, Marthino Lio, Adinia Wirasti', '2h 28m'),
(7, 'A Man Called Ahok', 'assets/image 36 (5).png', 'Depicts the life of the titular former governor of Jakarta before he ran for office, Ahok learned a lot about discipline from his father who ran a mining business in Belitung while dealing with various corrupt people.', 2018, 'Putrama Tuta', 'Danny Jaka Sembada, Ilya Sigma, Putrama Tuta', 'Daniel Mananta, Kin Wah Chew, Eric Febrian', '1h 42m'),
(8, 'Jokowi', 'assets/image 36 (6).png', 'Story of the Indonesian President\'s life before he become famous.', 2013, 'Azhar kinoi Lubis', 'Joko Nugroho, Azhar kinoi Lubis', 'T. Rifnu Wikana, Prisia Nasution, Susilo Badar', '1h 57m'),
(9, 'Merah Putih', 'assets/image 36 (7).png', 'A band of Indonesian men bond together as cadets, survive a massacre, and fight on as guerrilla soldiers against the Dutch despite their conflicts and deep differences in social class.', 2009, 'Yadi Sugandi', 'Conor Allyn, Rob Allyn', 'Donny Alamsyah, Rahayu Saraswati, Lukman Sardi', '1h 48m'),
(10, 'Guru Bangsa Tjokroaminoto', 'assets/image 36 (8).png', 'In 1912, Javanese activist Omar Said Tjokroaminoto (Reza Rahadian) co-founds the Sarekat Islam party to fight injustices of the Dutch East Indies\' colonial regime.', 2015, 'Garin Nugroho', 'Erik Supit, Ari M. Syarif', 'Reza Rahardian, Christoffer Nelwan, Putri Ayudya', '2h 41m'),
(11, 'Jendral Soedirman', 'assets/image 42.png', 'Tells the story of the war that took place in 1948 after Indonesia was declared independent. General Soerdirman, who at that time led the guerrilla war, made the island of Java strong and defeated the Dutch, marked by the Roem-Royen agreement.', 2015, 'Viva Westi', 'Tubagus Deddy, Viva Westi', 'Adipati Dolken, Ibnu Jamil, Gogot Suryanto', '2h 6m'),
(12, 'Soegija', 'assets/image 36 (9).png', 'This movie follows the story of Dutch East Indies\' (now Indonesia) first indigenous bishop, Albertus Soegijapranata SJ, from his inauguration until the end of Indonesia\'s independence war (1940-1949).', 2012, 'Garin Nugroho', 'Aramantono, Garin Nugroho', 'Nirwan Dewanto, Annisa Hertami, Wouter Braaf', '1h 55m');

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
(22, 1, 2);

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
(33, 'afiftharavi@gmail.com', 'as', 'ass', 'user');

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
  MODIFY `id_myfilm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `myfilm`
--
ALTER TABLE `myfilm`
  ADD CONSTRAINT `fk_myfilm_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_myfilm_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
