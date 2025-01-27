-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 03:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini-library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(125) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(125) NOT NULL,
  `status` varchar(15) NOT NULL,
  `genre` varchar(125) NOT NULL,
  `sinopsis` text NOT NULL,
  `tgl_mulai_baca` date NOT NULL,
  `tgl_selesai_baca` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `judul`, `penulis`, `status`, `genre`, `sinopsis`, `tgl_mulai_baca`, `tgl_selesai_baca`) VALUES
(1, 'Naruto', 'Masashi Kishimoto', 'Selesai Dibaca', '', 'Sebuah serial manga karya Masashi Kishimoto yang diadaptasi menjadi serial anime. Serial ini menceritakan perjalanan Naruto Uzumaki, seorang ninja muda dengan impian menjadi Hokage atau pemimpin desa ninja. Anime ini menyajikan campuran aksi, petualangan, humor, dan pertemanan yang kuat. ', '2025-01-23', '2025-01-26'),
(2, 'Sakamoto Days', 'Yuto Suzuki', 'Sedang Dibaca', '', 'Sakamoto adalah seorang pembunuh bayaran yang sangat ditakuti. Seluruh penjahat dan yakuza di Jepang tidak ada yang berani melawannya. Hingga akhirnya ia jatuh cinta dengan seorang perempuan sederhana, memutuskan meninggalkan dunia kriminal, lalu menikah hingga punya anak.', '2025-01-12', '0000-00-00'),
(3, 'One Punch Man', 'One', 'Sedang Dibaca', '', 'Mengisahkan tentang perjalanan Saitama yang mempunyai mimpi besar menjadi seorang pahlawan.', '2024-12-29', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `books_genres`
--

CREATE TABLE `books_genres` (
  `book_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books_genres`
--

INSERT INTO `books_genres` (`book_id`, `genre_id`) VALUES
(1, 9),
(1, 10),
(2, 2),
(2, 9),
(2, 10),
(3, 9),
(3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(125) NOT NULL,
  `nama_genre` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `nama_genre`) VALUES
(1, 'Sci-Fi'),
(2, 'Fantasy'),
(3, 'Mystery'),
(4, 'Thriller'),
(5, 'Romance'),
(6, 'Horror'),
(7, 'History'),
(8, 'Biography'),
(9, 'Action'),
(10, 'Manga');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`) VALUES
(4, 'Robert', 'robert@gmail.com', '$2y$10$t6V2/DC.aXFNpaUf22tv7udJrKW7PaNwNGEzcClHBZ2MqSUKTm.7u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books_genres`
--
ALTER TABLE `books_genres`
  ADD PRIMARY KEY (`book_id`,`genre_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(125) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(125) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books_genres`
--
ALTER TABLE `books_genres`
  ADD CONSTRAINT `books_genres_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `books_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
