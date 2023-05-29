-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 04:57 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gamifikasi`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `comments` (IN `idPost` INT)  BEGIN
	SELECT a.*, b.username, b.photo_profile FROM tb_comment_post AS a LEFT JOIN tb_user as b ON a.id_user = b.id WHERE a.id_post = idPost;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `likes` (IN `idPost` INT)  BEGIN
	SELECT a.*, b.username, b.name, b.photo_profile FROM tb_like_post AS a  LEFT JOIN tb_user as b ON a.id_user = b.id WHERE a.id_post = idPost;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `like_comment` (IN `idUser` INT, IN `idPost` INT, OUT `liked` INT, OUT `likes` INT, OUT `comments` INT)  BEGIN
    DECLARE result DECIMAL(10,2) DEFAULT 0;

    SELECT COUNT(*) INTO result FROM tb_like_post WHERE id_user = idUser AND id_post = idPost;
    IF(result>0) THEN
        SET liked = 1;
    ELSE
        SET liked = 0;
    END IF;

    SELECT COUNT(*) INTO likes FROM tb_like_post WHERE id_post = idPost;
    
    SELECT COUNT(*) INTO comments FROM tb_comment_post WHERE id_post = idPost;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_comment_post`
--

CREATE TABLE `tb_comment_post` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_comment_post`
--

INSERT INTO `tb_comment_post` (`id`, `id_user`, `id_post`, `comment`, `created_at`) VALUES
(5, 15, 1, 'Hello', '2023-05-19 02:01:45'),
(6, 15, 1, 'HEllo', '2023-05-19 02:14:39'),
(7, 15, 9, 'Jerapah, Gajah, Singa', '2023-05-19 15:38:09'),
(8, 15, 5, 'Ihh menyeramkan', '2023-05-19 15:38:31'),
(9, 15, 8, 'i love u more than u love me', '2023-05-19 17:14:35'),
(11, 16, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent luctus est leo, sed lobortis lectus ultrices nec ðŸ˜‚ðŸ˜‚ðŸ˜‚ðŸ˜‚ðŸ˜‚ðŸ˜‚ðŸ˜ŠðŸ¤·â€â™‚ï¸', '2023-05-19 18:13:26'),
(12, 16, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent luctus est leo, sed lobortis lectus ultrices nec ðŸ˜ŠðŸ˜ŠðŸ˜ŠðŸ˜‚ðŸ˜‚ðŸ˜‚ðŸ¤£', '2023-05-19 18:16:50'),
(13, 16, 11, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, rem, saepe esse, vel earum optio quos modi nemo iure perferendis numquam reiciendis cumque!  ðŸ¤£ðŸ¤£ðŸ˜‚ðŸ˜‚ðŸ˜‚ðŸ˜‚ðŸ˜ŠðŸ˜Š', '2023-05-19 18:29:11'),
(14, 15, 11, 'hahahahh  lol wkwkwkwk 55555555 jajajajajajaj', '2023-05-19 21:36:44'),
(15, 15, 9, 'What the hell animals do u think they are???', '2023-05-19 23:15:24'),
(16, 15, 11, 'I remember you said', '2023-05-20 22:12:31'),
(17, 1, 11, 'V', '2023-05-21 06:06:08'),
(18, 2, 5, 'Check', '2023-05-21 06:08:00'),
(19, 15, 11, 'Check', '2023-05-21 06:15:53'),
(20, 1, 11, 'FK', '2023-05-21 06:16:13'),
(21, 15, 11, 'cjkck', '2023-05-21 06:16:45'),
(22, 1, 11, 'check', '2023-05-21 06:27:39'),
(23, 15, 11, 'check', '2023-05-21 06:28:33'),
(24, 15, 11, 'flog', '2023-05-21 06:35:18'),
(25, 15, 11, 'hi', '2023-05-21 06:36:35'),
(26, 15, 4, 'Hi', '2023-05-21 06:37:06'),
(27, 15, 8, 'HI', '2023-05-21 06:37:22'),
(28, 16, 5, 'Hallo ahmad', '2023-05-21 19:33:13'),
(29, 15, 9, 'Jerapah', '2023-05-21 19:34:42'),
(30, 15, 5, 'Hallo ahmad', '2023-05-21 19:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_courses`
--

CREATE TABLE `tb_courses` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `curr_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_courses`
--

INSERT INTO `tb_courses` (`id`, `id_user`, `curr_course`) VALUES
(1, 15, 6),
(2, 16, 3),
(3, 17, 5),
(5, 19, 1),
(6, 20, 0),
(7, 21, 0),
(8, 22, 0),
(9, 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_course_names`
--

CREATE TABLE `tb_course_names` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_course_names`
--

INSERT INTO `tb_course_names` (`id`, `name`) VALUES
(1, 'gSvyiQ39XHNmFWJWrGSs'),
(2, 'wKDOjoKffRY057NBkdOK'),
(3, 'rNsjlOIJF0BDFmkMdNKL'),
(4, 'Fb4OK8Q25gcHBmaQichk'),
(5, '2XHs4EqPyBj4ZYKUZKkb'),
(6, 'UU7JEm3dGSbgSgEepCBY');

-- --------------------------------------------------------

--
-- Table structure for table `tb_course_rewards`
--

CREATE TABLE `tb_course_rewards` (
  `id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_course_rewards`
--

INSERT INTO `tb_course_rewards` (`id`, `id_course`, `point`, `xp`) VALUES
(1, 1, 0, 100),
(2, 2, 0, 100),
(3, 3, 0, 100),
(4, 4, 0, 100),
(5, 5, 0, 0),
(6, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_history`
--

CREATE TABLE `tb_history` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `achieved_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_levelup_history`
--

CREATE TABLE `tb_levelup_history` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_like_post`
--

CREATE TABLE `tb_like_post` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_like_post`
--

INSERT INTO `tb_like_post` (`id`, `id_user`, `id_post`) VALUES
(34, 15, 8),
(35, 15, 9),
(37, 16, 5),
(39, 16, 4),
(40, 16, 4),
(41, 16, 11),
(43, 15, 4),
(44, 15, 11),
(47, 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_post`
--

CREATE TABLE `tb_post` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `status` int(1) NOT NULL,
  `challenge` int(11) NOT NULL DEFAULT '0',
  `accepted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_post`
--

INSERT INTO `tb_post` (`id`, `id_user`, `content`, `status`, `challenge`, `accepted_at`, `created_at`) VALUES
(4, 15, '<p><img src=\"http://localhost/skripsi/user/user_trans/../../images/user-posts/16dfcb58fae2bf4193eb146215ca736d1f7d882a.jpg\" style=\"width: 349px;\" class=\"fr-fic fr-dib\"></p><p style=\"text-align: center;\">Ini adalah film berjudul<strong>&nbsp;DEEP WATER</strong></p>', 1, 0, '2023-05-06 18:32:34', '2023-02-05 22:10:23'),
(5, 16, '<p><img src=\"http://localhost/skripsi/user/user_trans/../../images/user-posts/3676e8a2f80035ee0dc6ee440ddaa22d77de2a2d.jpg\" style=\"width: 313px;\" class=\"fr-fic fr-dib\"></p><p>Mahasiswa jurusan psychology menemui seorang pasien sakit jiwa untuk materi research skripsi mereka. Bermula dari masalah kejiwaan Nina yang akhirnya berkembang menjadi hal-hal mistis yang diluar logika. Tahayul, Mistis dan Budaya bertabrakan dengan science dan pengetahuan mereka selama ini.</p>', 1, 0, '2023-05-06 18:31:05', '2023-02-10 16:41:17'),
(7, 15, '<p>sdkjskdjskjdkjsdnaksdkjansdkaksmdaskdmaksdnkma</p>', 2, 0, '2023-05-06 18:48:06', '2023-05-05 15:09:28'),
(8, 15, '<p><img src=\"http://localhost/skripsi/user/user_trans/../../images/user-posts/51b5aba3c1e7be1719f39258959d5538677a9bf2.png\" style=\"width: 375px;\" class=\"fr-fic fr-dib\"></p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent luctus est leo, sed lobortis lectus ultrices nec. Morbi eleifend varius aliquam. Suspendisse odio eros, scelerisque in eleifend vel, accumsan et lorem. Maecenas velit quam, pellentesque sed ultricies at, consectetur eget lectus. Nunc at ipsum eu orci sagittis convallis. Curabitur ultricies nunc vel laoreet convallis. Nam tempus risus lectus, eget pulvinar lectus dapibus quis. Aenean lectus sem, varius in metus a, pretium congue erat.</p>', 1, 0, '2023-05-06 18:31:02', '2023-05-05 15:10:56'),
(9, 15, '<p><img src=\"http://localhost/skripsi/user/user_trans/../../images/user-posts/9b5432ff63f836962b90a4ba4b64fc62001aebc4.JPG\" style=\"width: 339px;\" class=\"fr-fic fr-dib\"></p><p>Ini adalah nama-nama hewan yang ada di kebun binatang. Apa saja nama-nama hewan yang ada di atas?</p>', 1, 0, '2023-05-06 18:50:17', '2023-05-06 18:49:41'),
(11, 15, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, rem, saepe esse, vel earum optio quos modi nemo iure perferendis numquam reiciendis cumque! Autem blanditiis distinctio quae nobis sed eos!</p>', 1, 0, '2023-05-19 18:26:34', '2023-05-19 18:26:06'),
(16, 15, '<p><img src=\"http://localhost/skripsi/user/user_trans/../../images/user-posts/e2fbe24d53127f176c6c4eaf341c07fe16b4f842.png\" style=\"width: 300px;\" class=\"fr-fic fr-dib\"></p><p id=\"isPasted\">Permasalahan : Menampilkan bilangan ganjil dari 1 - 10</p><p>Langkah-langkah menyelesaikan permasalahan:</p><ol><li>Start</li><li>Pesiapkan bilangan</li><li>Inisialisasi bilangan dengan nilai 1</li><li>Periksa apakah nilai bilangan dimoduluskan hasilnya akan 1. Jika iya, maka tampilkan lalu lanjutkan ke langkah berikutnya. Jika tidak, langsung ke langkah berikutnya.</li><li>Periksa apakah bilangan kurang dari atau sama dengan 10. Jika iya, bilangan ditambah satu kemudian kembali ke langkah 4. Jika tidak, lanjut ke langkah berikutnya.</li><li>Selesai</li></ol>', 0, 1, '0000-00-00 00:00:00', '2023-05-29 21:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_quiz`
--

CREATE TABLE `tb_quiz` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `grade` varchar(1) NOT NULL,
  `quiz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_quiz`
--

INSERT INTO `tb_quiz` (`id`, `id_user`, `benar`, `salah`, `xp`, `points`, `nilai`, `grade`, `quiz`) VALUES
(16, 16, 5, 0, 388, 25, 100, 'A', 1),
(20, 15, 5, 0, 412, 25, 100, 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(256) NOT NULL,
  `password` mediumtext NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `photo_profile` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `point` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `email`, `username`, `name`, `password`, `kelas`, `admin`, `photo_profile`, `level`, `point`, `xp`, `created_at`, `updated_at`) VALUES
(13, 'admin@gmail.com', 'admin', 'Fauzan Fiqriansyah', 'YWRtaW4xMjM0', '', 1, '../images/avatar.jpg', 1, 0, 0, '2023-05-05 13:38:43', '0000-00-00 00:00:00'),
(14, 'admin1234', 'admin1234', 'Admin', 'YWRtaW4xMjM0', '', 1, '../images/avatar.jpg', 1, 0, 0, '2023-02-13 06:41:52', '0000-00-00 00:00:00'),
(15, 'fauzanfiqriansyah@upi.edu', 'ffiqriansyah', 'Fauzan Fiqriansyah', 'dXphbjc4MjE=', '', 0, '../images/usr-img/storm_trooper.jpg', 1, 25, 812, '2023-05-26 15:55:43', '0000-00-00 00:00:00'),
(16, 'ahmadwahyu@gmail.com', 'ahmadwhyd', 'Ahmad Wahyudin Suryono', 'YWhtYWR3aHlk', '', 0, '../images/avatar.jpg', 1, 0, 0, '2023-05-26 15:53:57', '0000-00-00 00:00:00'),
(17, 'adhihidayat@gmail.com', 'adhihidayat', 'Adhi Hidayat', 'YWRoaWhpZGF5YXQxMjM=', '', 0, '../images/avatar.jpg', 1, 0, 0, '2023-02-13 06:41:52', '0000-00-00 00:00:00'),
(19, 'rezaanggana@gmail.com', 'rezaanggana', 'Reza Anggana Putra', 'cmV6YWFuZ2dhbmExMjM=', '', 0, '../images/avatar.jpg', 1, 0, 0, '2023-02-13 06:41:52', '0000-00-00 00:00:00'),
(20, 'willysurya@gmail.com', 'willysurya', 'Willy Surya', 'd2lsbHlzdXJ5YQ==', '', 0, '../images/avatar.jpg', 1, 0, 0, '2023-02-13 06:41:52', '0000-00-00 00:00:00'),
(21, 'fauzanfiqriansyah127@gmail.com', 'ffiqriansyah.07', 'Fauzan Fiqriansyah', 'dXphbjc4MjE=', 'X RPL 2', 0, '../images/avatar.jpg', 1, 0, 0, '2023-02-13 06:41:52', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_comment_post`
--
ALTER TABLE `tb_comment_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_courses`
--
ALTER TABLE `tb_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_course_names`
--
ALTER TABLE `tb_course_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_course_rewards`
--
ALTER TABLE `tb_course_rewards`
  ADD PRIMARY KEY (`id`,`id_course`);

--
-- Indexes for table `tb_history`
--
ALTER TABLE `tb_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_history` (`id_user`);

--
-- Indexes for table `tb_levelup_history`
--
ALTER TABLE `tb_levelup_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_like_post`
--
ALTER TABLE `tb_like_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_foreign` (`id_user`),
  ADD KEY `post_foreign` (`id_post`);

--
-- Indexes for table `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indexes for table `tb_quiz`
--
ALTER TABLE `tb_quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_user` (`id_user`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_comment_post`
--
ALTER TABLE `tb_comment_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_courses`
--
ALTER TABLE `tb_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_course_names`
--
ALTER TABLE `tb_course_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_course_rewards`
--
ALTER TABLE `tb_course_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_history`
--
ALTER TABLE `tb_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_levelup_history`
--
ALTER TABLE `tb_levelup_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_like_post`
--
ALTER TABLE `tb_like_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_quiz`
--
ALTER TABLE `tb_quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_history`
--
ALTER TABLE `tb_history`
  ADD CONSTRAINT `fk_user_history` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);

--
-- Constraints for table `tb_like_post`
--
ALTER TABLE `tb_like_post`
  ADD CONSTRAINT `post_foreign` FOREIGN KEY (`id_post`) REFERENCES `tb_post` (`id`),
  ADD CONSTRAINT `user_foreign` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);

--
-- Constraints for table `tb_post`
--
ALTER TABLE `tb_post`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
