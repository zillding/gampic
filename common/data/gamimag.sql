-- Host: localhost

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `gamimag`
--
DROP DATABASE IF EXISTS gamimag;
CREATE DATABASE gamimag;
USE gamimag;

-- table for lookup

CREATE TABLE tbl_lookup
(
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(128) NOT NULL,
  code INTEGER NOT NULL,
  type VARCHAR(128) NOT NULL,
  position INTEGER NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- table for tag
CREATE TABLE tbl_tag
(
  id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(128) NOT NULL,
  frequency INTEGER DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Table structure for table `comment`
CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_content` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Dumping data for table `comment`
-- INSERT INTO `comment` (`comment_id`, `comment_time`, `comment_content`, `user_id`, `image_id`) VALUES
-- (1, '2012-10-19 19:26:22', 'testing content aaa123123', 1, 1);

-- Table structure for table `image`
CREATE TABLE IF NOT EXISTS `tbl_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_title` varchar(127) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_extension` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_thumb_height` int(11) NOT NULL DEFAULT '0',
  `image_likes` int(11) NOT NULL DEFAULT '0',
  `image_upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `image`
--

INSERT INTO `tbl_image` (`image_id`, `image_title`, `image_extension`, `image_thumb_height`, `image_likes`, `image_upload_time`, `user_id`) VALUES
(1, 'adfasdfasf', 'jpg', 30, 0, '2012-10-09 21:01:53', 1),
(2, 'Defalut', 'png', 40, 0, '2012-10-09 21:37:28', 1),
(3, 'Defalut', 'jpg', 30, 0, '2012-10-09 21:39:21', 1),
(4, 'Test', 'jpg', 20, 0, '2012-10-09 21:46:03', 1),
(5, 'Yes!', 'jpeg', 30, 0, '2012-10-09 21:48:53', 1),
(6, 'TestTest', 'jpeg', 30, 0, '2012-10-11 10:35:44', 1),
(7, 'Cool', 'jpg', 30, 0, '2012-10-11 16:59:34', 1),
(8, 'sdfs', 'jpg', 50, 0, '2012-10-11 17:02:42', 1),
(9, 'sdfs', 'jpg', 30, 0, '2012-10-11 17:10:06', 1),
(10, 'sdfs', 'jpg', 30, 0, '2012-10-11 17:15:16', 1),
(11, 'sdfs', 'jpg', 40, 0, '2012-10-11 17:26:03', 1),
(12, 'sdfs', 'jpg', 40, 0, '2012-10-11 17:27:50', 1),
(13, 'sdfs', 'jpg', 30, 0, '2012-10-11 17:29:30', 1),
(14, 'sdfs', 'jpg', 20, 0, '2012-10-11 17:32:47', 1),
(15, 'sdfs', 'jpg', 30, 0, '2012-10-11 17:35:16', 1),
(16, 'sdfs', 'jpg', 50, 0, '2012-10-11 17:41:09', 1),
(17, 'Characters', 'jpg', 30, 0, '2012-10-11 17:56:32', 1);
-- (18, '', 'jpg', 0, '2012-10-15 02:33:51', 1),
-- (19, '', 'jpg', 0, '2012-10-15 02:34:54', 1),
-- (20, 'This is me', 'jpg', 0, '2012-10-23 12:16:29', 1),
-- (21, 'A small boss', 'jpg', 0, '2012-10-23 12:16:47', 1),
-- (22, 'Night Eleves', 'jpeg', 0, '2012-10-23 12:17:08', 1),
-- (23, 'Rare2', 'png', 0, '2012-10-23 12:18:30', 1),
-- (24, 'Rare Axe', 'png', 0, '2012-10-23 12:18:47', 1),
-- (25, 'Undead Hero', 'jpg', 0, '2012-10-23 12:19:19', 1),
-- (26, 'Start Craft II', 'jpg', 0, '2012-10-23 12:19:49', 1),
-- (27, 'So much money', 'jpg', 0, '2012-10-23 12:22:10', 1),
-- (28, 'Diablo III', 'jpeg', 0, '2012-10-23 12:22:48', 1),
-- (29, 'The battleship', 'jpeg', 0, '2012-10-23 12:23:08', 1),
-- (30, 'Holy place', 'jpeg', 0, '2012-10-23 12:23:36', 1),
-- (31, 'Dota All Stars', 'jpg', 0, '2012-10-23 12:24:15', 1),
-- (32, 'Blizzard logo', 'jpeg', 0, '2012-10-23 12:24:48', 1),
-- (33, 'Xmas party', 'jpeg', 0, '2012-10-23 12:25:04', 1),
-- (34, 'Monster', 'jpg', 0, '2012-10-23 12:27:37', 1),
-- (35, 'Diablo 3 Paragon System', 'png', 0, '2012-10-23 12:27:58', 1),
-- (36, 'diablo_3', 'jpg', 0, '2012-10-23 12:28:15', 1),
-- (37, 'Group fight', 'jpeg', 0, '2012-10-23 12:28:37', 1),
-- (38, 'diablo_3_collectors_edition_angel_wings1', 'jpg', 0, '2012-10-23 12:28:58', 1),
-- (39, 'Gate Place', 'jpeg', 0, '2012-10-23 12:29:32', 1),
-- (40, 'I love this girl', 'jpg', 0, '2012-10-23 15:02:56', 1),
-- (41, 'Ah, it''s so cool!', 'jpg', 0, '2012-10-23 15:03:20', 1),
-- (42, 'I''m the super man!', 'jpg', 0, '2012-10-23 15:03:48', 1),
-- (43, 'Give this boss a shit', 'jpg', 0, '2012-10-23 15:04:39', 1),
-- (44, 'You know the light is everything!', 'jpg', 0, '2012-10-23 15:05:14', 1),
-- (45, 'I kill it! I kill it! I kill it1', 'jpg', 0, '2012-10-23 15:05:48', 1),
-- (46, 'Diablo!!!', 'jpeg', 0, '2012-10-23 15:06:23', 1),
-- (47, 'My new gear!!!', 'jpg', 0, '2012-10-23 15:06:45', 1),
-- (48, 'War Cry!!!!', 'jpg', 0, '2012-10-23 15:07:27', 1),
-- (49, 'That''s me, super cool, right?', 'jpg', 0, '2012-10-23 15:07:58', 1),
-- (50, 'I made it', 'jpg', 0, '2012-10-23 15:08:22', 1),
-- (51, 'Is this female look cool?', 'jpg', 0, '2012-10-23 15:08:56', 1),
-- (52, 'I''m firing!', 'jpg', 0, '2012-10-23 15:09:35', 1),
-- (53, 'I got it', 'jpg', 0, '2012-10-23 15:10:05', 1),
-- (54, 'Take a guess!', 'jpg', 0, '2012-10-23 15:10:30', 1),
-- (55, 'New gear', 'jpg', 0, '2012-10-23 15:12:21', 1),
-- (56, 'So many items', 'jpg', 0, '2012-10-23 15:12:58', 1),
-- (57, 'It''s raining!!!', 'jpg', 0, '2012-10-23 16:05:16', 1),
-- (58, 'That''s the holy place!!!', 'jpg', 0, '2012-10-23 16:19:50', 1),
-- (59, 'I''m super cool!', 'jpg', 0, '2012-10-23 16:20:24', 1),
-- (60, 'Bloody boss!', 'jpg', 0, '2012-10-23 16:21:03', 1),
-- (61, 'I''m sexy', 'jpg', 0, '2012-10-23 16:21:24', 1),
-- (62, 'Enlightenment!', 'jpg', 0, '2012-10-23 16:21:56', 1),
-- (63, 'He is roaring!', 'jpg', 0, '2012-10-23 16:23:42', 1),
-- (64, '1 beat 4', 'jpg', 0, '2012-10-23 16:24:28', 1),
-- (65, 'Super fast', 'jpg', 0, '2012-10-23 16:24:52', 1),
-- (66, 'Dota ', 'jpg', 0, '2012-10-23 16:25:59', 1),
-- (67, 'All scores', 'jpg', 0, '2012-10-23 16:26:24', 1),
-- (68, 'This armor', 'jpg', 0, '2012-10-23 16:27:27', 1),
-- (69, 'For the lich king!', 'jpg', 0, '2012-10-23 16:27:47', 1),
-- (70, 'Blind Faith', 'png', 0, '2012-10-23 16:28:12', 1),
-- (71, 'In the midnight', 'jpg', 0, '2012-10-23 16:28:50', 1),
-- (72, 'Starcraft I', 'jpeg', 0, '2012-10-23 16:29:18', 1),
-- (73, 'It destroys everything!', 'jpeg', 0, '2012-10-23 16:30:06', 1),
-- (74, 'It''s coming up!', 'jpg', 0, '2012-10-23 16:30:56', 1),
-- (75, 'It''s the starting point', 'jpg', 0, '2012-10-23 16:36:16', 1),
-- (76, 'Wow!', 'jpg', 0, '2012-10-23 16:37:02', 1),
-- (77, 'Laser bean!', 'jpg', 0, '2012-10-23 16:37:44', 1),
-- (78, 'Diablo ESP', 'jpg', 0, '2012-10-23 16:38:05', 1),
-- (79, 'Arrogant', 'jpg', 0, '2012-10-23 16:39:55', 1),
-- (80, 'The anchor', 'jpg', 0, '2012-10-23 16:41:31', 1),
-- (81, 'Holy Shit', 'jpeg', 0, '2012-10-23 16:41:50', 1),
-- (82, 'Warcraft III', 'jpg', 0, '2012-10-23 16:42:10', 1);

-- Table structure for table `like`
CREATE TABLE IF NOT EXISTS `tbl_like` (
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`image_id`),
  KEY `user_id` (`user_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `user`
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_provider` enum('gamimag','facebook','twitter') NOT NULL DEFAULT 'gamimag',
  `user_authid` int(11) NOT NULL,
  `user_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Gamer',
  `user_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `tbl_user` (`user_id`, `user_provider`, `user_authid`, `user_name`, `user_email`, `user_password`, `salt`, `user_reg_time`) VALUES
(1, 'gamimag', 1, 'tester', 'aaa', '89897ab8c87ce67532acbc9fb78e2c29', 'salt', '2012-10-08 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `tbl_image` (`image_id`);

--
-- Constraints for table `image`
--
ALTER TABLE `tbl_image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `like`
--
ALTER TABLE `tbl_like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `tbl_image` (`image_id`);
