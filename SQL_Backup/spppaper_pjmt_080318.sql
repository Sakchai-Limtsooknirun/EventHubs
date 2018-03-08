-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2018 at 11:22 PM
-- Server version: 5.5.31
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spppaper_pjmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `EventHandler`
--

CREATE TABLE `EventHandler` (
  `CardID` int(11) NOT NULL,
  `CardStatus` int(11) DEFAULT NULL,
  `TicketID` int(11) DEFAULT NULL,
  `CardSBuyTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CardToken` varchar(255) DEFAULT NULL,
  `OwnerID` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EventHandler`
--

INSERT INTO `EventHandler` (`CardID`, `CardStatus`, `TicketID`, `CardSBuyTime`, `CardToken`, `OwnerID`) VALUES
(1, 0, 3, '2018-03-08 15:42:20', '4550111fac2a50d30182d29439bfc672', 12),
(2, 0, 2, '2018-03-08 15:43:11', 'c66696066a6f77ff3980377c31266d2a', 12),
(3, 0, 7, '2018-03-08 15:55:06', '1358098a44f117fd09169236f599c454', 12);

-- --------------------------------------------------------

--
-- Table structure for table `EventOrganizers`
--

CREATE TABLE `EventOrganizers` (
  `ID` int(5) NOT NULL,
  `Role` varchar(45) CHARACTER SET latin1 NOT NULL,
  `EventNo` int(5) NOT NULL,
  `EventName` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Type` int(2) NOT NULL,
  `Detail` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Picture` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `TeaserVDO` varchar(45) CHARACTER SET latin1 NOT NULL,
  `DateStart` datetime NOT NULL,
  `DateEnd` datetime NOT NULL,
  `Location` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `MaximumCapacity` int(5) NOT NULL,
  `CapacityNow` int(5) NOT NULL,
  `PreCondition` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Code` varchar(15) CHARACTER SET latin1 NOT NULL,
  `Price` int(6) NOT NULL,
  `EventOwnerID` int(5) DEFAULT NULL,
  `ShortURL` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `EventStatus` int(2) DEFAULT NULL,
  `ColorTone` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `MapLat` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `MapLng` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `EventOrganizersName` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `EventContactTell` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `EventContactEmail` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `EventFacebook` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `EventOrganizers`
--

INSERT INTO `EventOrganizers` (`ID`, `Role`, `EventNo`, `EventName`, `Type`, `Detail`, `Picture`, `TeaserVDO`, `DateStart`, `DateEnd`, `Location`, `MaximumCapacity`, `CapacityNow`, `PreCondition`, `Code`, `Price`, `EventOwnerID`, `ShortURL`, `EventStatus`, `ColorTone`, `MapLat`, `MapLng`, `EventOrganizersName`, `EventContactTell`, `EventContactEmail`, `EventFacebook`) VALUES
(2, 'M', 2, 'BNK48', 0, 'asdasdasd', 'bnk48.png', '', '2017-04-01 13:00:00', '2015-05-25 12:00:00', ' Live Park (Rama 9), Bang Kapi, Huai Khwang, Bangkok, Thailand ', 100011, 200, 'แก้ได้แล้วโว้ยยย11', '00004', 999911, 8, 'bnk48', 0, 'pink', '13.6701019', '100.6088128', 'GenieRecord111', '0298722231111', 'rtp2018@genie.com', 'https://www.facebook.com/retrospectrock'),
(8, 'M', 0, 'Retrospect Heart of the Panther หัวใจเสือดำ', 1, 'cookie', 'rtp.jpg', 'e-X3R-sVXVE', '2018-03-10 08:00:00', '2018-03-10 18:00:00', ' Live Park (Rama 9), Bang Kapi, Huai Khwang, Bangkok, Thailand ', 20000, 0, '??', '', 200, 8, 'rtp', 1, '#350101', '13.750508', '100.600093', 'GenieRecord', '029872223', 'rtp2018@genie.com', 'https://www.facebook.com/retrospectrock'),
(15, 'M', 0, 'THE CONTENT CREATOR เฟ้นหานักสร้างสรรค์คอนเทนต์ตัวจริง', 3, 'sasses', 'Resize_ContentCreator-02.jpg', '', '2018-05-05 18:00:00', '0000-00-00 00:00:00', 'Like Me Co., Ltd., Bang Lamphu Lang, Khlong San, Bangkok, Thailand ', 50, 0, '', '', 100, 8, 'context-creator-1', 0, '', '13.720338', '100.501715', 'Infographic Thailand', '093-263-6926', 'thecontentcreator.th@gmail.com', 'https://www.facebook.com/infographic.thailand/'),
(16, 'M', 0, 'DND WATER CIRCUS', 4, '<p style="text-align: center;"><strong>Are You Ready for Songkran 2018?</strong></p><br /><p>คุณพร้อมรึยังที่จะเปียกไปกับพวกเรา และเหล่าศิลปินคนดังมากมาย ไม่ว่าจะเป็น</p><br /><p><em>Season 5</em></p><br /><p><em>Cocktail</em></p><br /><p><em>Tattoo Color</em></p><br /><p><em>Mild</em></p><br /><p><em>The Toys</em></p><br /><p><em>Two Poptorn</em></p><br /><p><em>UrboyTJ x Thaitanium</em></p><br /><p>&nbsp;</p><br /><p><strong>ซื้อบัตรได้ที่ eventhubs เท่านั้นนะจ้ะ ช้าหมดอดเปียก</strong></p>', 'dnd.jpg', '', '2018-04-15 12:00:00', '0000-00-00 00:00:00', 'DND คลองตันเหนือ, วัฒนา, Bangkok, Thailand ', 500, 0, '', '', 0, 4, 'dnd', 0, 'black', '13.73198', '100.585965', 'DND Club', '094-414-9266', 'dnd@dnd.com', 'https://www.facebook.com/donotdisturbclub/'),
(17, 'M', 0, 'CS in Taiwan ศึกษาดูงาน ณ ประเทศไต้หวัน', 3, '<p>รับสมัครนิสิตศึกษาดูงาน ณ ประเทศไต้หวัน</p>', 'cs.png', '', '2018-07-13 00:00:00', '0000-00-00 00:00:00', 'มหาวิทยาลักยเกษตรศาสตร์', 20, 0, '', '', 0, 4, 'cs-taiwan', 0, '', '13.8470283', '100.5696061', 'CS.SCI', '02-562-5444', 'ct@cs.sci.ku.ac.th', 'https://www.facebook.com/comsci.ku/?ref=br_rs'),
(18, 'M', 0, 'Halfmoon Festival at Koh Phangan, Thailand I 24th MAR 2018', 1, '<p>March 24th 2018... Koh Phangan, Thailand. The Half Moon is on the rise, time for the magical forest once again.</p><br /><p><strong>Join us</strong> for another Night of Legends HALFMOON FESTIVAL: 3 dance floors, in an amazing location, deep into the Tropical Forest. In legendary Koh Phangan, the Island of the Moon! UNCAGE YOUR SPIRIT</p>', 'Banner-2018-(Nico)-24-mar-banner.png', 'HR5AJ7VBZts', '2018-03-24 00:00:00', '0000-00-00 00:00:00', 'Ko Pha-ngan, Ko Pha-ngan District, Surat Thani, Thailand ', 200, 0, '', '', 0, 4, 'halfmoon-festival', 0, 'black', '9.731875', '100.013593', 'Halfmoonfestival', '66971644951', 'kae@eventpop.me', '#');

-- --------------------------------------------------------

--
-- Table structure for table `EventTicket`
--

CREATE TABLE `EventTicket` (
  `TicketID` int(11) NOT NULL,
  `TicketStatus` int(11) DEFAULT NULL,
  `EventID` int(5) DEFAULT NULL,
  `TicketName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `TicketPrice` varchar(255) DEFAULT NULL,
  `TicketNow` int(7) DEFAULT NULL,
  `TicketCapi` int(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EventTicket`
--

INSERT INTO `EventTicket` (`TicketID`, `TicketStatus`, `EventID`, `TicketName`, `TicketPrice`, `TicketNow`, `TicketCapi`) VALUES
(1, 0, 8, 'บัตรยืน', '800', 0, 1000),
(2, 0, 8, 'บัตรนั่ง', '1300', 2, 200),
(3, 0, 2, 'บัตรนั่งโซนหน้าสุด', '2500', 1, 200),
(4, 0, 2, 'บัตรนั่งโซนหน้าสุด Lady Only', '2500', 0, 100),
(5, 0, 2, 'บัตรนั่งโซนกลาง', '2000', 0, 300),
(6, 0, 2, 'บัตรนั่งโซนหลัง', '1500', 0, 300),
(7, 0, 2, 'บัตรยืน', '1000', 1, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `EventType`
--

CREATE TABLE `EventType` (
  `TypeID` int(11) NOT NULL,
  `TypeName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TypePic` varchar(255) DEFAULT NULL,
  `TypeURL` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EventType`
--

INSERT INTO `EventType` (`TypeID`, `TypeName`, `TypePic`, `TypeURL`) VALUES
(1, 'งานปาร์ตี้คอนเสิร์ตและเทศกาล', 'concert.jpg', 'party-concerts'),
(2, 'กีฬา', 'sport.jpg', 'sports'),
(3, 'การประชุมอบรมและสัมมนา', 'semi.jpg', 'seminars'),
(4, 'ชั้นเรียนและงานฝีมือ', 'workshop.jpg', 'workshops');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `FilesID` int(4) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `FilesName` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`FilesID`, `Name`, `FilesName`) VALUES
(1, 'Test1', 'timegraphics-82ec48bd53374b7356e9d27487ca6af0.png'),
(2, 'test2', '25997255778_f68d5a78bc_m.jpg'),
(3, 'test3', '25997255778_f68d5a78bc_m.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(5) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL DEFAULT '0000-00-00',
  `telephone` varchar(20) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `Picture` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `Firstname`, `Lastname`, `role`, `ts`, `email`, `dob`, `telephone`, `sex`, `Picture`) VALUES
(2, 'stamp', '$2y$10$skpSDv8wea0aQcIlZtMzZO8pAIO4hEZBmj9Rx5MeZ3Tbv9RZ.SA/C', 'stam', 'stamp', 'A', '2018-02-20 17:36:56', 'suphavich.c@gmail.com', '1995-03-23', '+66 33 243-2432', 'm', 'Screen Shot 2561-03-06 at 11.24.44.png'),
(1, 'admin', '$2y$10$.XQZ8fNKIP6iUa54D1uwrORDD8ZpfpM8zSzjvttE0sPkL09ITUNzq', 'Sakchai123', 'Limsuknirund', 'A', '2018-02-20 14:06:48', 'sakchai.l@ku.th', '0213-03-21', '+66 95 849-7639', 'm', 'fefefefefe.jpg'),
(4, 'stamper', '$2y$10$.SWVFBMnun81HQ8XtFCr8.kWdEbvI1g64uVJEuT7LNdx3nhPFPpQm', 'Suphavich Chanpi', 'Chanpi', 'O', '2018-02-24 11:10:35', 'suphavich.c@ku.th', '1996-08-15', '+66 80 454-8452', 'm', 'test.jpg'),
(10, 'abc1234', '$2y$10$vDYakzIsG9KT6KG6kbVKn.Fisp9V9180oSvOoheQzj4UBZaeOZgvC', 'wdada', 'dawdawd', 'M', '2018-03-05 17:00:00', 'dawdwa@gmail.com', '3213-03-21', '+66 95 849-7639', 'm', '1.jpg'),
(5, 'admin1', '$2y$10$VVXAGVYwLrgddLe6.fTssuocFKbHzQJz7LTJnjP1xEcqpx8D86lG6', 'sakchai limsuknirund', 'limsuknirunddwaddaw', 'M', '2018-02-28 22:13:21', '095849wadwa7639@gmail.com', '1997-01-23', '+66 95 849-7639', 'm', 'Screen Shot 2561-03-06 at 11.29.20.png'),
(6, 'admin12', '$2y$10$5A6uA15GdI/PFWkQDUVbOeEYZiKzuQSURHU1CGKI.lbM975kUOdO2', 'sakchai limsuknirund', 'limsuknirund', 'M', '2018-03-01 05:58:45', 'awdawd@gmail.com', '1997-12-23', '+66 95 849-7639', 'm', 'ddddd.jpg'),
(8, 'b5810451152', '$2y$10$yXRgkQZaH7NIUX.ApbeWeu1EQh2sXQSe34nd/O9aeCjNZbb6q8NqC', 'ควยบูม', 'มองไม่เหน', 'O', '2018-03-04 22:38:34', 'anaphat.i@ku.th', '4355-03-24', '+66 08 771-9925', 'm', 'egg.jpg'),
(11, 'abc12345', '$2y$10$3v5uj7SQdgK7/jZPiUMziO8LyX96.7YdDCm1qhGEdNP9aiBYMnKd2', 'wadawd', 'awdawdaw', 'M', '2018-03-05 17:00:00', 'dawdwad@live.com', '0012-12-12', '+66 12 121-1232', 'm', 'dawdawd.jpg'),
(12, 'kanapos', '$2y$10$KzOxpR2uObACpacTXGIDmOY63TNfInIGlqxY39qwdebUdKNNQvPoC', 'Kanapos', 'la', 'M', '2018-03-07 17:00:00', 'kanapas.l@ku.th', '1996-01-01', '+66 12 345-6788', 'm', 'ice.png');

-- --------------------------------------------------------

--
-- Table structure for table `Webboard`
--

CREATE TABLE `Webboard` (
  `wbID` int(11) NOT NULL,
  `eventID` int(5) NOT NULL,
  `ownerID` varchar(255) NOT NULL,
  `timeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wbType` int(1) DEFAULT NULL,
  `wbTitle` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `wbCat` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `wbDesc` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Webboard`
--

INSERT INTO `Webboard` (`wbID`, `eventID`, `ownerID`, `timeCreated`, `wbType`, `wbTitle`, `wbCat`, `wbDesc`) VALUES
(2, 2, 'stamp', '2018-03-01 19:33:04', 0, 'ตื่นเต้น', 'สนทนาทั่วไป', 'ตื่นเต้น'),
(3, 2, 'stamp', '2018-03-01 13:37:32', 0, 'สวัสดีครับ', 'สนทนาทั่วไป', 'สวัสดีครับ'),
(4, 2, 'stamp', '2018-03-01 20:02:27', 0, 'ไปด้วย BTS ยังไงครับ', 'สอบถามเกี่ยวกับสถานที่จัดงาน การเดินทาง', 'อยากทราบว่าสามารถเดินทางไปด้วย BTS ยังไงครับ ผ่านสถานีไหนมั้ง ?\nตอบหน่อยนะ'),
(5, 1, 'stamp', '2018-03-01 14:35:30', 0, 'ทดสอบ', 'สนทนาทั่วไป', 'Facebook ประกาศยกเลิก Explore Feed เหตุไม่ช่วยให้ผู้ใช้งานค้นพบคอนเทนต์น่าสนใจอย่างที่คาด\r\n'),
(6, 1, 'stamp', '2018-03-01 14:37:03', 1, '5', '-', 'จริงหรอจ้ะ'),
(7, 2, 'stamp', '2018-03-01 14:37:34', 1, '4', '-', 'BTS ศาลาแดงครับ\r\n'),
(8, 2, 'stamp', '2018-03-01 14:38:31', 1, '3', '-', 'สวัสดีค่ะ'),
(9, 2, 'stamp', '2018-03-01 14:38:52', 1, '2', '-', '-0-\r\n'),
(10, 2, 'stamp', '2018-03-01 20:45:50', 1, '4', '-', 'ทดสอบ\r\n'),
(11, 2, 'stamp', '2018-03-01 20:45:47', 1, '4', '-', 'เดินสองนาทีถึงครับ'),
(12, 2, 'stamp', '2018-03-01 20:45:56', 1, '5', '-', 'ทดสอบ'),
(13, 2, 'stamp', '2018-03-01 14:45:11', 1, '2', '-', 'sfsf'),
(15, 2, 'stamp', '2018-03-02 07:25:49', 1, '4', '-', 'ขอบคุณครับ'),
(16, 2, 'admin', '2018-03-05 02:14:54', 1, '4', '-', 'test'),
(17, 2, 'admin', '2018-03-05 02:15:06', 1, '4', '-', 'test2'),
(18, 2, 'admin', '2018-03-05 02:15:16', 1, '3', '-', 'โหลๆ'),
(19, 2, 'admin', '2018-03-05 02:15:24', 1, '2', '-', 'โหลๆ'),
(20, 8, 'stamp', '2018-03-05 04:02:53', 0, 'เดินทางไปยังไงให้สดวกที่สุดครับ', 'สนทนาทั่วไป', 'เดินทางไปยังไงให้สดวกที่สุดครับ รถแทกซี่หรือมีรถเมล์ผ่านมั้ยครับ'),
(21, 8, 'stamper', '2018-03-05 04:03:36', 1, '20', '-', 'แทกซี่ไปเลยครับ ง่ายสุด'),
(22, 1, 'admin', '2018-03-06 06:35:26', 1, '5', '-', 'หวัดดี'),
(23, 2, 'admin', '2018-03-07 03:04:55', 1, '3', '-', 'หวัดดี'),
(24, 2, 'admin', '2018-03-07 03:05:15', 1, '3', '-', 'หวัดดี'),
(25, 2, 'admin', '2018-03-07 03:05:32', 1, '3', '-', 'หวัดดี'),
(26, 2, 'admin', '2018-03-07 03:05:45', 1, '3', '-', 'หวัดดี'),
(27, 8, 'admin', '2018-03-08 02:09:51', 1, '20', '-', 'adsefesfes'),
(28, 18, 'admin', '2018-03-08 02:10:56', 0, 'hhhh', 'สนทนาทั่วไป', 'huhj'),
(29, 18, 'admin', '2018-03-08 02:11:23', 1, '28', '-', 'nbjkj');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EventHandler`
--
ALTER TABLE `EventHandler`
  ADD PRIMARY KEY (`CardID`);

--
-- Indexes for table `EventOrganizers`
--
ALTER TABLE `EventOrganizers`
  ADD PRIMARY KEY (`ID`,`Role`,`EventNo`);

--
-- Indexes for table `EventTicket`
--
ALTER TABLE `EventTicket`
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexes for table `EventType`
--
ALTER TABLE `EventType`
  ADD PRIMARY KEY (`TypeID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`FilesID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`,`Username`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `Webboard`
--
ALTER TABLE `Webboard`
  ADD PRIMARY KEY (`wbID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `EventHandler`
--
ALTER TABLE `EventHandler`
  MODIFY `CardID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `EventOrganizers`
--
ALTER TABLE `EventOrganizers`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `EventTicket`
--
ALTER TABLE `EventTicket`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `EventType`
--
ALTER TABLE `EventType`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `FilesID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `Webboard`
--
ALTER TABLE `Webboard`
  MODIFY `wbID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
