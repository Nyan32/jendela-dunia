-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 08:51 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `20212_wp3_412019037`
--
CREATE DATABASE IF NOT EXISTS `20212_wp3_412019037` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `20212_wp3_412019037`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(255) NOT NULL,
  `name` varchar(60) NOT NULL,
  `birthdate` date NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `birthdate`, `image`) VALUES
(1, 'Raditya Dika', '1984-12-28', 'penulis-1.jpg'),
(2, 'Faza Meonk', '1991-08-23', 'penulis-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(11) NOT NULL,
  `year` year(4) NOT NULL,
  `amount` int(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `publisher_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `category`, `year`, `amount`, `status`, `image`, `synopsis`, `publisher_id`) VALUES
(1, 'Marmut Merah Jambu', 'non-fiction', 2010, 10, 'available', 'buku-1.jpg', 'Suatu hari Dika (Raditya Dika) datang ke rumah Ina (Anjani Dina), cinta pertamanya sewaktu SMA, membawa seribu origami burung bangau di tangan kanannya, dan undangan pernikahan Ina di tangan kirinya. Besok, Ina akan menikah. Kedatangan Dika diterima oleh Bapak Ina (Tio Pakusadewo) yang curiga kedatangan Dika untuk kasus cinta lama yang belum selesai dan berpikir bahwa Dika ingin menggagalkan pernikahan anaknya. Dika menceritakan maksud sebenarnya, yang jauh dari tuduhan Bapak Ina.\r\n\r\nSeiring dengan Dika bercerita, kita melihat masa lalu Dika (Christoffer Nelwan), dia berteman akrab dengan Bertus (Julian Liberty). Pada masa ini, Dika SMA jatuh cinta diam-diam kepada Ina. Baik Dika dan Bertus sama-sama sadar, untuk mendapatkan cewek di sekolah, mereka harus populer. Dika dan Bertus sudah sering memecahkan masalah di sekolahnya, pada suatu ketika Dika dan Bertus bertemu Cindy dan akhirnya mereka bertiga membuat grup detektif. Bertus menyebut grup ini dengan Tiga Sekawan.\r\n\r\nSuatu ketika ada suatu kasus yang tidak bisa mereka pecahkan, kasusnya adalah grafiti di tembok sekolah. Mereka berfikir kalau grafiti itu dituju untuk mengancam kepala sekolah. Waktu terus berlalu hingga mereka lulus sekolah, dan setelah bertahun-tahun mereka menjalani hidup, Dika pun penasaran akan grafiti itu setelah Dika meneliti lagi ternyata gambar yang ada di grafiti itu bukanlah gambar iblis, melainkan gambar marmut yang mirip dengan gambar di handuk yang Dika terima dari Cindy. Dika juga ingat kalau yang memberitahukan tentang kasus itu pertama kali ialah Cindy, Dika juga membaca petunjuk yang ada pada grafiti itu ialah “untuk dibaca oleh dua orang”. Lalu Dika membacanya bersama Bertus dan membacanya juga per-dua kalimat.\r\n\r\nLalu Dika sudah menyimpulkan bahwa kalimat dalam grafiti itu adalah mengenai surat cinta yang dibuat oleh Cindy. Dika dan Cindy pun bertemu di acara pernikahan Ina dan Dika menjelaskan yang dia ketahui semua tentang grafiti itu, dan Cindy pun tersipu malu lalu Dika mengeluarkan handuk yang diberikan oleh Cindy dengan gambar Marmut Merah Jambu.', 1),
(2, 'Si Juki Anak Kosan', 'fiction', 2021, 1, 'available', 'buku-2.jpg', '“Engga bisa gini!! Dasar rezim ibu warteg zalim!”\r\n\r\n“Di manakah keadilan jika anak kos tidak boleh mengutang lagi!\r\n\r\n“Aduuuh...”\r\n\r\n“Kami ingin hidup.”\r\n\r\n“Kami sebagai cacing yang tinggal di perut berhak hidup. Tolong hargai kami!”\r\n\r\nSi Juki kembali dengan cerita bersama teman-teman kosan. Tidak hanya bercerita tentang lika-liku hidup sebagai anak kos, keseharian Juki di kampus juga tidak kalah menyenangkan. Kalau kalian penasaran, ayo bawa buku ini ke kasir dan bayar sekarang juga. Kalau uang abis, ya makan mie instan.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `id` int(255) NOT NULL,
  `book_id` int(255) NOT NULL,
  `author_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`id`, `book_id`, `author_id`) VALUES
(5, 1, 1),
(47, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_borrow`
--

CREATE TABLE `book_borrow` (
  `id` int(255) NOT NULL,
  `borrow_time` date NOT NULL,
  `return_time` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'NOT RETURNED',
  `fine` bigint(255) DEFAULT NULL,
  `book_id` int(255) NOT NULL,
  `user_email` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_borrow`
--

INSERT INTO `book_borrow` (`id`, `borrow_time`, `return_time`, `status`, `fine`, `book_id`, `user_email`) VALUES
(16, '2022-06-22', '2022-07-22', 'RETURNED', 23000, 1, 'oscar@gmail.com'),
(17, '2022-06-24', '2022-06-24', 'RETURNED', 0, 2, 'oscar@gmail.com'),
(18, '2022-06-24', '2022-06-24', 'RETURNED', 0, 2, 'dummy@gmail.com'),
(19, '2022-06-27', '2022-06-27', 'RETURNED', 0, 1, 'oscar@gmail.com'),
(20, '2022-06-27', '2022-06-27', 'RETURNED', 0, 1, 'oscar@gmail.com'),
(21, '2022-06-27', NULL, 'NOT RETURNED', NULL, 1, 'dummy@gmail.com'),
(25, '2022-06-28', '2022-06-28', 'RETURNED', 0, 1, 'oscar@gmail.com'),
(26, '2022-07-01', '2022-07-01', 'RETURNED', 0, 1, 'oscar@gmail.com'),
(27, '2022-07-01', NULL, 'NOT RETURNED', NULL, 1, 'oscar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `book_genre`
--

CREATE TABLE `book_genre` (
  `id` int(255) NOT NULL,
  `book_id` int(255) NOT NULL,
  `genre_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_genre`
--

INSERT INTO `book_genre` (`id`, `book_id`, `genre_id`) VALUES
(1, 1, 1),
(32, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_like`
--

CREATE TABLE `book_like` (
  `id` int(255) NOT NULL,
  `user_email` varchar(254) NOT NULL,
  `book_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_like`
--

INSERT INTO `book_like` (`id`, `user_email`, `book_id`) VALUES
(17, 'dummy@gmail.com', 2),
(21, 'dummy@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Comedy');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`, `address`, `image`) VALUES
(1, 'Bukune', 'Jl. H. Montong No. 57, Ciganjur, Jagakarsa, Jakarta Selatan 12630, Indonesia', 'penerbit-1.png'),
(2, 'Falcon Publishing', 'Jl. Duren Tiga No.35, RT.4/RW.1, Duren Tiga, Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12760, Indonesia', 'penerbit-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(254) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `status`) VALUES
('dummy@gmail.com', 'dono3232', 'enable'),
('oscar10@gmail.com', 'dono3232', 'enable'),
('oscar32@gmail.com', 'dono3232', 'enable'),
('oscar33@gmail.com', 'dono3232', 'enable'),
('oscar@gmail.com', 'jendeladunia', 'enable'),
('oscarpenabur@gmail.com', 'dono3232', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `email` varchar(254) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` mediumtext NOT NULL,
  `fine` bigint(255) DEFAULT NULL,
  `gender` varchar(1) NOT NULL,
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`email`, `name`, `phone`, `address`, `fine`, `gender`, `birthdate`) VALUES
('dummy@gmail.com', 'Dummy', '081219881023', 'Jl. Kebun Apel', 0, 'M', '2001-01-20'),
('oscar10@gmail.com', 'Oscar Deladas', '088203023902', 'Jl. Halo', 0, 'M', '2022-07-15'),
('oscar32@gmail.com', 'fdsfsd', '088129320234', 'rwerwrwerw', 0, 'M', '1122-02-23'),
('oscar33@gmail.com', 'Oscar', '088129291092', 'Jl. Pisang', 0, 'M', '3222-12-23'),
('oscar@gmail.com', 'Oscar Deladas', '081219701874', 'Jl. Durian Runtuh', 0, 'M', '2001-07-26'),
('oscarpenabur@gmail.com', 'Oscar Deladas', '88211023324', 'Jl. Tanjung Duren Raya No.4, RT.12/RW.2, Tj. Duren Utara, Kec. Grogol petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470, Indonesia', 0, 'M', '2001-01-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_borrow`
--
ALTER TABLE `book_borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_genre`
--
ALTER TABLE `book_genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_like`
--
ALTER TABLE `book_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `book_borrow`
--
ALTER TABLE `book_borrow`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `book_genre`
--
ALTER TABLE `book_genre`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `book_like`
--
ALTER TABLE `book_like`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
