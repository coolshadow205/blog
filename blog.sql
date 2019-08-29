-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2018 at 05:38 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, ' Javascripts'),
(3, 'c++'),
(5, '  PHP'),
(7, ' Music'),
(8, 'Ruby');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 8, 'Javascript Author', 'jsauthor@gmail.com', 'Do veniam pariatur reprehenderit ne sed noster c', 'approved', '2017-12-28'),
(2, 9, 'Jay', 'youremailid@gmail.com', 'This is my first comment', 'approved', '2017-12-28'),
(3, 10, 'HMMM', 'some@gmail.com', 'lkashshkjlashdkhklasdlhsadhd', 'unapproved', '2017-12-28'),
(6, 8, 'This is me', 'iuasgkjasd@gmail.com', 'hkjldhasdh', 'unapproved', '2017-12-28'),
(9, 8, 'Dont no', 'hakjhasdj@gmail.com', 'My Second Comment', 'unapproved', '2017-12-28'),
(10, 8, 'Jay Ashra', 'jay.@gmail.com', 'This is jay\r\n', 'unapproved', '2017-12-28'),
(11, 8, 'Noob', 'noob@gmail.com', 'THIS IS NOOB', 'approved', '2017-12-28'),
(12, 8, 'Noob', 'noob@gmail.com', 'THIS IS NOOB', 'approved', '2017-12-28'),
(13, 10, 'kjaskj', 'kjhashjka@gmail.com', 'kjsdhjkaksdhljasdjkhasdjkk\r\nasdlajskhdasldkjklasjd\r\nasdkjashdasjdklasdj\r\nasdhasjdlkasd', 'approved', '2017-12-28'),
(14, 12, 'Suraj', 'suraj@gmail.com', 'I hate you', 'unapproved', '2017-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(8, 2, 'Javascripts', 1, '2017-12-27', 'music.JPG', 'Dolore cernantur ad incididunt. Et consequat in iudicem, irure occaecat do \r\nsummis irure nam minim sed doctrina ex lorem, quo summis proident consequat. \r\nvoluptate est officia, occaecat anim labore aut nulla ad velit appellat \r\nproident, in magna duis summis offendit ut e ipsum eiusmod, minim mentitum ex \r\nnostrud in labore senserit ea illustriora qui quorum a eu elit laboris. Officia \r\nsint o pariatur despicationes, velit excepteur hic excepteur. Sint deserunt \r\npariatur. Irure aut laborum si nostrud tamen anim cupidatat tamen. Sed cillum \r\noccaecat, si proident philosophari ita o hic sempiternum, esse e quo nulla \r\nincididunt quo appellat ea sunt aliquip do aute eu aliquip, excepteur id quem, \r\nnostrud esse esse o velit. An nisi efflorescere, ne arbitror voluptatibus.', 'Javascripts', 6, 'published'),
(9, 8, 'Java', 6, '2017-12-27', 'CSS.jpg', 'ahskjasj', 'Java', 1, 'published'),
(10, 8, 'Music', 1, '2017-12-27', 'js.jpeg', 'qwerty', 'PHP , Java', 2, 'draft'),
(11, 5, 'Dont no', 7, '2017-12-28', 'tower.JPG', 'This is me noob', 'Dont no', 0, 'published'),
(12, 7, 'Hmm', 6, '2017-12-28', 'html.jpg', 'ghjagsdhgahdssdjadsh', 'Yaaaa', 1, 'published'),
(13, 7, 'Hmm', 6, '2017-12-28', '7.jpg', 'ghjagsdhgahdssdjadsh', 'Yaaaa', 0, 'published'),
(14, 3, 'This', 6, '2017-12-28', 'js.jpeg', 'jhasgajdsgjasd', 'augsjasd', 0, 'draft'),
(15, 3, 'kjhasdjas', 1, '2017-12-30', '9.jpg', 'jhsajdhadksh', 'jkhsd', 0, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `token`) VALUES
(1, 'Jay Ashra', '$2y$10$MRd2oAxpWK6rcBQbcmh.wumKEywivnX5rzSUdM4K7XBpmQhsjtwN2', 'Jay', 'Ashra', 'jay.ashra@somaiya.edu', '2.jpg', 'admin', '65df2c7423464c39ee8e979f10ccbf086b34aaff66dc0156f9b934dc233b10ba80dd46388d239a6feb036681659ea54e27d5'),
(6, 'Alex Craft', '$2y$10$KZRc9y69uMM7STRXwAM1Z.AjuDvi/o1itQ3fPm9NMb20Q66qunrOG', 'Alex', 'Craft', 'alex@gmail.com', '4.jpg', 'subscriber', ''),
(7, 'Suraj', '$2y$10$yoChZdyC4CFflVb7s4.7q.TruZnxCS2kYKjdUkD1groXO/7qz9Tfu', 'Suraj', 'Kakad', 'suraj@gmail.com', '21.jpg', 'subscriber', ''),
(11, 'Smith', '$2y$10$VFYS5G9Yd/J1HOp7AFoRx.OcNh2KJjSGr/s5Vs6Apq9C9KCXn3ytu', 'Price', 'Smith', 'smith@gmail.com', 'user-male.png', 'subscriber', ''),
(12, 'aniket', '$2y$10$e8IZQpYAHqmPPwOK9fMXjuI2Yw3.hJYA/.03IpmTe5xv.ayeW6Izi', 'Aniket', 'Konkar', 'aniket@gmail.com', 'Aaad.jpg', 'subscriber', ''),
(13, 'Trith', '$2y$10$..ZQoyfDEG6izQtYPlsysuJIgIdFhE1xc2cCG6caMLHRjee8D02vy', 'Trith', 'Shah', 'trith@gmail.com', '2013-06-18-11-52-32.png', 'subscriber', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`, `user_id`) VALUES
(33, 'c50d5hf6e64b7pmdnkeq0ahap3', '1515086082', 1),
(37, '4jdgrgbn7hapolacajtc3ophg1', '1515151597', 1),
(40, 'j933d4ukdcsmedpb4t6aoicvn6', '1515163513', 6),
(41, 'lmiphipt21dtoo48sbj6sbl335', '1515174093', 1),
(42, 'e2jcgi3rb5jq3voh6g6qurcra3', '1515677279', 1),
(44, '8gj10gtch7330576ifl2jqnhc5', '1515936843', 6),
(45, '537keosurrplgtve85a6g2bdr4', '1516187965', 1),
(46, 'u3s0tuq0p7a80r8gnul36dtpm2', '1519413904', 1),
(47, 'lrjrbja69b8f8srqcjbkak12br', '1519564455', 1),
(48, 'usft91bp23q6huhcgvvgotm911', '1519659236', 1),
(49, '4jbqee1dig63p6oupk9k64j4gq', '1519745454', 1),
(50, '4ndiahvk8265i2cqjtsk25n13o', '1519830588', 1),
(51, 'u88q7lcuplmrr6nnmlfkad0t8a', '1520242097', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
