-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08 May 2015 la 21:49
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `galaxone`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `designs`
--

CREATE TABLE IF NOT EXISTS `designs` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `data` text NOT NULL,
  `t` int(11) NOT NULL,
  `design_json` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Salvarea datelor din tabel `designs`
--

INSERT INTO `designs` (`id`, `name`, `file`, `type`, `user_id`, `created`, `data`, `t`, `design_json`) VALUES
(6, 'GrayScale', 'GrayScale', 0, 1, 0, '{"title":"test Design test","copyright":"Cozy at 2015","mini_desc":"Test"}', 0, ''),
(7, 'test for my', 'testformy', 0, 1, 1, '', 0, ''),
(9, 'bagebuilder', 'bagebuilder', 0, 1, 1, '[{"x":0,"y":0,"width":2,"height":2,"module":11},{"x":2,"y":0,"width":4,"height":2},{"x":6,"y":0,"width":2,"height":4},{"x":1,"y":2,"width":4,"height":2}]', 1, ''),
(13, 'unu doi', 'unudoi', 0, 1, 1, '[\n    {\n        "x": 0,\n        "y": 0,\n        "width": 12,\n        "height": 2,\n        "module": "10",\n        "name": "Test module 1",\n        "id": "id-108"\n    }\n]', 1, '{"id-300":{"border-top":"ffffff","border-bottom":"fafafa","border-right":"b8aab8","padding-top":"10","padding-right":"10","border-left":"ffffff"},"ui-id-1":{"border-top":"4d334d","border-bottom":"705570","border-right":"2e2eff","padding-top":"7","padding-right":"1","padding-bottom":"1","padding-left":"1","font-size":"13","color":"000000","background-color":"e3e3e3"},"ui-id-2":{"border-top":"ffffff","border-bottom":"ad95ad","border-right":"626b80","padding-left":"10","border-left":"ffffff"},"id-108":{"background-color":"ffffff","border-top":"ffffff","border-bottom":"ffffff","border-right":"965796","border-left":"8c4c8c"}}'),
(41, 'Galaxone', 'Galaxone', 0, 1, 0, '', 0, ''),
(42, 'test', 'test', 0, 6, 1, '', 0, '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `settings` text NOT NULL,
  `default` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Salvarea datelor din tabel `groups`
--

INSERT INTO `groups` (`id`, `user_id`, `settings`, `default`, `name`) VALUES
(4, 1, '{"modules":{"10":1,"11":1,"13":0,"26":0}}', 0, 'test test');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `guestbook_modul`
--

CREATE TABLE IF NOT EXISTS `guestbook_modul` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `menu_modul`
--

CREATE TABLE IF NOT EXISTS `menu_modul` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `menu_modul`
--

INSERT INTO `menu_modul` (`id`, `user_id`, `data`) VALUES
(1, 1, 'a:3:{i:0;a:3:{s:2:"id";s:2:"20";s:5:"title";s:14:"Davor and Emil";s:7:"visible";s:7:"checked";}i:1;a:3:{s:2:"id";s:2:"24";s:5:"title";s:11:"Second page";s:7:"visible";s:7:"checked";}i:2;a:3:{s:2:"id";s:2:"25";s:5:"title";s:10:"Third page";s:7:"visible";s:7:"checked";}}');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
`id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `account` int(200) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Salvarea datelor din tabel `modules`
--

INSERT INTO `modules` (`id`, `type`, `title`, `file`, `account`, `data`) VALUES
(10, 0, 'Test module 1', 'testmodule1.php', 1, ''),
(11, 0, 'Test Module', 'testmodule.php', 1, ''),
(13, 1, 'Menu', 'menu', 0, ''),
(27, 1, 'GuestBook', 'guestbook', 0, ''),
(40, 0, 'Portfolio Galaxone', 'portofolio.php', 1, 'Galaxone'),
(41, 0, 'Three columns section Galaxone', 'three-column.php', 1, 'Galaxone'),
(42, 0, 'Two columns section Galaxone', 'two-column.php', 1, 'Galaxone');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(250) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `modules` text NOT NULL,
  `seo_name` varchar(200) NOT NULL,
  `index` int(11) NOT NULL,
  `visible` int(11) NOT NULL DEFAULT '1',
  `hits` int(11) NOT NULL,
  `design` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Salvarea datelor din tabel `pages`
--

INSERT INTO `pages` (`id`, `user_id`, `title`, `description`, `keywords`, `modules`, `seo_name`, `index`, `visible`, `hits`, `design`) VALUES
(20, 1, 'Davor and Emil', 'asdasdanull', 'test', '{"left":{},"right":{},"center":{"0":"10","1":"11"},"fixed":{"Menu":"13"}}', 'davorandemil', 1, 1, 591, 6),
(24, 1, 'Second page', 'nullasda', 'asda', '{"left":{},"right":{},"center":{"0":"10","1":"11"},"fixed":{"Menu":"13"}}', 'secondpage', 0, 1, 11, 41),
(27, 1, 'Third Page', 'description', 'keywords', '{"left":{},"right":{},"center":{},"fixed":{}}', 'thirdpage', 0, 1, 34, 13);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `data` varchar(12) NOT NULL,
  `group` int(2) NOT NULL,
  `rank` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `main_module` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `analytic_id` varchar(30) NOT NULL,
  `domain` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `data`, `group`, `rank`, `name`, `parent`, `main_module`, `status`, `analytic_id`, `domain`) VALUES
(1, 'cozy_junior@yahoo.com', 'b21zaWxlZG9t', 'cozy_junior', 0, 0, 'cozy_junior', 0, 13, 1, 'test', ''),
(5, 'cozy_junior2@yahoo.com', 'b21zaWxlZG9t', 'cozy_junior', 4, 1, 'cozy_junior', 1, 0, 1, '', ''),
(6, 'georgescu777@gmail.com', 'b21zaWxlZG9t', 'georgescu', 0, 0, 'georgescu', 0, 0, 1, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guestbook_modul`
--
ALTER TABLE `guestbook_modul`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_modul`
--
ALTER TABLE `menu_modul`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
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
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `guestbook_modul`
--
ALTER TABLE `guestbook_modul`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu_modul`
--
ALTER TABLE `menu_modul`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
