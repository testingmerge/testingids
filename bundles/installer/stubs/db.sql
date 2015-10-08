-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2014 at 10:32 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rigola21`
--

-- --------------------------------------------------------

--
-- Table structure for table `abuse_reports`
--

CREATE TABLE IF NOT EXISTS `abuse_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) CHARACTER SET latin1 NOT NULL,
  `reporting_user_id` int(11) NOT NULL,
  `reported_user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `html_code` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_user`
--

CREATE TABLE IF NOT EXISTS `blocked_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `block_user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `bots`
--

CREATE TABLE IF NOT EXISTS `bots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `gender` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `age` int(11) NOT NULL,
  `joining` datetime NOT NULL,
  `photo_id` varchar(255) NOT NULL,
  `enable` int(11) NOT NULL,
  `user_ids` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `notify_status` int(11) NOT NULL,
  `message` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=202 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `credithistory`
--

CREATE TABLE IF NOT EXISTS `credithistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `type` varchar(200) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `transaction_id` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=356 ;

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE IF NOT EXISTS `credits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21042 ;

-- --------------------------------------------------------

--
-- Table structure for table `czars`
--

CREATE TABLE IF NOT EXISTS `czars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `last_ip` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `encounters`
--

CREATE TABLE IF NOT EXISTS `encounters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=76 ;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(10) unsigned NOT NULL,
  `to_user` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE IF NOT EXISTS `gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `icon_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE IF NOT EXISTS `interests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `interest_categories`
--

CREATE TABLE IF NOT EXISTS `interest_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `meetme`
--

CREATE TABLE IF NOT EXISTS `meetme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `notify_status` int(11) NOT NULL,
  `type` varchar(200) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=377 ;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo_id` varchar(100) CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `no_users` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- Table structure for table `photo_rater`
--

CREATE TABLE IF NOT EXISTS `photo_rater` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `photo_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `relationshipstatus` int(11) NOT NULL DEFAULT '0',
  `bodytype` int(11) NOT NULL DEFAULT '0',
  `haircolor` int(11) NOT NULL DEFAULT '0',
  `eyecolor` int(11) NOT NULL DEFAULT '0',
  `living` int(11) NOT NULL DEFAULT '0',
  `smoking` int(11) NOT NULL DEFAULT '0',
  `drinking` int(11) NOT NULL DEFAULT '0',
  `education` int(11) NOT NULL DEFAULT '0',
  `children` int(11) NOT NULL DEFAULT '0',
  `aboutme` varchar(255) CHARACTER SET latin1 NOT NULL,
  `interestedin` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `popularity` int(11) NOT NULL,
  `whyamihere` int(11) NOT NULL,
  `preferred_gender` int(1) NOT NULL,
  `preferred_age` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21056 ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(40) CHARACTER SET latin1 NOT NULL,
  `last_activity` int(11) NOT NULL,
  `data` text CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `value` varchar(200) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Table structure for table `spotlights`
--

CREATE TABLE IF NOT EXISTS `spotlights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `superpowers`
--

CREATE TABLE IF NOT EXISTS `superpowers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(64) CHARACTER SET latin1 DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `photo_id` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `role` int(11) NOT NULL,
  `city` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `country` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `verified` int(11) NOT NULL,
  `verification_no` varchar(16) CHARACTER SET latin1 NOT NULL,
  `language` varchar(3) CHARACTER SET latin1 NOT NULL,
  `profile_score` int(11) NOT NULL,
  `album_count` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21095 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_gifts`
--

CREATE TABLE IF NOT EXISTS `user_gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

CREATE TABLE IF NOT EXISTS `user_interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interest_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `value` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `photo_comments`
--

CREATE TABLE IF NOT EXISTS `photo_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `album_id` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `credits` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `credits`, `cost`, `created_at`, `updated_at`) VALUES
(12, 50, 50, '2014-02-23 15:19:48', '2014-02-23 15:19:48'),
(16, 10, 10, '2014-02-23 15:21:24', '2014-02-23 15:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `reward_packages`
--

CREATE TABLE IF NOT EXISTS `reward_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) CHARACTER SET latin1 NOT NULL,
  `credits` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `reward_packages`
--

INSERT INTO `reward_packages` (`id`, `reason`, `credits`, `status`, `created_at`, `updated_at`) VALUES
(1, 'user.visit.profile', 20, 1, '0000-00-00 00:00:00', '2014-03-29 21:42:31'),
(2, 'user.profile.visited', 10, 1, '0000-00-00 00:00:00', '2014-03-29 21:42:31'),
(3, 'message.request.send', 10, 1, '0000-00-00 00:00:00', '2014-03-29 21:42:31'),
(5, 'user.encounter.yes', 20, 1, '0000-00-00 00:00:00', '2014-03-29 21:42:31'),
(6, 'album.photo.upload', 10, 1, '0000-00-00 00:00:00', '2014-03-29 21:42:31'),
(7, 'profile.photo.upload', 15, 1, '0000-00-00 00:00:00', '2014-03-29 21:42:31'),
(8, 'user.login', 5, 1, '0000-00-00 00:00:00', '2014-03-29 21:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `value` varchar(200) CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=148 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(4, 'language', 'en', '2013-09-07 15:50:28', '2013-12-09 02:09:55'),
(5, 'title', 'Rigola', '2013-09-07 16:12:40', '2014-02-22 11:22:59'),
(8, 'fbid', '', '2013-10-02 13:00:47', '2014-03-27 22:55:33'),
(9, 'fbsecret', '', '2013-10-02 13:00:47', '2014-03-27 22:55:33'),
(10, 'defaultcredits', '6', '2013-10-02 13:28:21', '2014-02-23 15:21:43'),
(11, 'isenabled', '-1', '2013-10-02 13:28:21', '2014-03-24 15:49:09'),
(12, 'iscredits', '-1', '2013-10-02 13:32:59', '2014-03-24 15:49:09'),
(13, 'isspotlight', '0', '2013-10-02 14:01:49', '2014-03-28 10:53:42'),
(14, 'issuperpower', '0', '2013-10-02 14:01:49', '2014-03-28 10:53:42'),
(15, 'theme', 'metronic', '2013-10-03 16:28:41', '2013-10-03 16:41:22'),
(16, 'paypalusername', '', '2013-10-05 08:43:12', '2014-03-29 22:34:51'),
(17, 'paypalidentitytoken', '', '2013-10-05 08:43:12', '2013-12-25 15:56:58'),
(46, 'email_notification_disable_user', '1', '2013-11-06 23:59:16', '2014-03-28 12:16:43'),
(22, 'encounters_without_pic', '-1', '2013-10-18 02:06:06', '2014-03-24 15:49:09'),
(23, 'email_host', '', '2013-10-28 12:24:44', '2014-03-28 08:53:17'),
(24, 'email_port', '465', '2013-10-28 12:24:44', '2013-10-28 12:24:44'),
(25, 'email_username', '', '2013-10-28 12:24:44', '2014-03-28 09:25:38'),
(26, 'email_password', '', '2013-10-28 12:24:44', '2014-03-28 08:53:17'),
(27, 'email_encryption', 'ssl', '2013-10-28 12:24:44', '2013-10-28 12:24:44'),
(28, 'email_notification_profile_visitor', '1', '2013-10-28 13:12:12', '2014-03-28 12:16:43'),
(31, 'email_notification_meetme', '1', '2013-10-28 13:12:51', '2014-03-28 12:16:43'),
(30, 'email_notification_message', '1', '2013-10-28 13:12:12', '2014-03-28 12:16:52'),
(32, 'email_content_profile_visitor', '[from_username] just visited your profile.\r\n\r\nCheckout their profile -> [from_user_profile_link]', '2013-10-28 15:21:29', '2014-03-28 08:54:22'),
(33, 'email_content_message', '[from_username] sent you a message!\r\n\r\n[message]', '2013-10-29 08:19:25', '2014-03-28 10:58:40'),
(34, 'email_content_meetme', '[from_username] wants to meet you.\r\n\r\nThis is the profile  [from_user_profile_link]', '2013-10-29 08:19:31', '2014-03-28 09:47:35'),
(35, 'email_content_forgot_password', '', '2013-10-29 08:19:38', '2013-10-29 08:19:38'),
(36, 'email_content_email_verification', 'Verify your email\r\n\r\n[verification_no]', '2013-10-29 08:19:43', '2014-03-29 09:57:04'),
(37, 'widget_profile_right_1', '', '2013-10-29 13:06:59', '2013-10-29 13:35:07'),
(38, 'widget_profile_right_2', '', '2013-10-29 13:06:59', '2013-10-29 13:35:07'),
(39, 'widget_profile_right_3', '', '2013-10-29 13:06:59', '2013-10-29 13:35:07'),
(40, 'widget_encounter_right_1', '', '2013-10-29 13:06:59', '2013-10-29 13:47:37'),
(41, 'widget_encounter_right_2', '', '2013-10-29 13:06:59', '2013-10-29 13:47:37'),
(42, 'widget_above_spot_light', '', '2013-10-29 13:06:59', '2013-10-29 15:05:47'),
(43, 'widget_below_left_side_menu', '', '2013-10-29 13:06:59', '2013-10-29 15:05:47'),
(45, 'from_email', '', '2013-10-30 12:04:20', '2014-03-28 08:53:17'),
(47, 'email_notification_delete_photo', '0', '2013-11-06 23:59:16', '2013-11-28 17:15:28'),
(48, 'email_notification_delete_user', '1', '2013-11-07 00:26:07', '2014-03-28 12:16:43'),
(49, 'email_notification_profile_visitor', '-1', '2013-11-07 04:29:56', '2014-03-24 15:49:09'),
(50, 'email_notification_want_to_meet', '-1', '2013-11-07 04:29:56', '2014-03-24 15:49:09'),
(51, 'email_notification_message', '-1', '2013-11-07 04:29:56', '2014-03-24 15:49:09'),
(52, 'email_notification_profile_visitor', '-1', '2013-11-07 04:30:33', '2014-03-24 15:49:09'),
(53, 'email_notification_want_to_meet', '-1', '2013-11-07 04:30:33', '2014-03-24 15:49:09'),
(54, 'email_notification_message', '-1', '2013-11-07 04:30:33', '2014-03-24 15:49:09'),
(55, 'email_notification_profile_visitor', '0', '2013-11-07 04:30:46', '2013-11-07 04:30:46'),
(56, 'email_notification_message', '0', '2013-11-07 04:30:46', '2013-11-07 04:30:46'),
(57, 'email_notification_want_to_meet', '0', '2013-11-07 04:30:46', '2013-11-07 04:30:46'),
(58, 'email_notification_profile_visitor', '-1', '2013-11-07 04:32:05', '2014-03-24 15:49:09'),
(59, 'email_notification_want_to_meet', '-1', '2013-11-07 04:32:05', '2014-03-24 15:49:09'),
(60, 'email_notification_message', '-1', '2013-11-07 04:32:05', '2014-03-24 15:49:09'),
(61, 'email_notification_profile_visitor', '0', '2013-11-07 04:32:09', '2013-11-07 04:32:09'),
(62, 'email_notification_message', '-1', '2013-11-07 04:32:09', '2014-03-24 15:49:09'),
(63, 'email_notification_want_to_meet', '-1', '2013-11-07 04:32:09', '2014-03-24 15:49:09'),
(64, 'email_notification_profile_visitor', '-1', '2013-11-07 04:32:09', '2014-03-24 15:49:09'),
(65, 'email_notification_want_to_meet', '-1', '2013-11-07 04:32:09', '2014-03-24 15:49:09'),
(66, 'email_notification_message', '-1', '2013-11-07 04:32:09', '2014-03-24 15:49:09'),
(67, 'email_notification_profile_visitor', '-1', '2013-11-07 04:32:18', '2014-03-24 15:49:09'),
(68, 'email_notification_message', '-1', '2013-11-07 04:32:18', '2014-03-24 15:49:09'),
(69, 'email_notification_want_to_meet', '0', '2013-11-07 04:32:18', '2013-11-07 04:32:18'),
(70, 'email_notification_profile_visitor', '-1', '2013-11-07 04:32:18', '2014-03-24 15:49:09'),
(71, 'email_notification_want_to_meet', '-1', '2013-11-07 04:32:18', '2014-03-24 15:49:09'),
(72, 'email_notification_message', '-1', '2013-11-07 04:32:18', '2014-03-24 15:49:09'),
(73, 'email_notification_send_message_request', '-1', '2013-11-07 06:36:27', '2014-03-24 15:49:09'),
(74, 'email_notification_accept_message_request', '-1', '2013-11-07 06:36:27', '2014-03-24 15:49:09'),
(75, 'isrewards', '1', '2013-11-07 11:57:32', '2014-03-28 10:54:37'),
(76, 'istopup', '-1', '2013-11-07 12:35:40', '2014-03-24 15:49:09'),
(78, 'encounters_min_album_pics', '0', '2013-11-17 09:38:29', '2013-11-17 09:38:29'),
(79, 'photorater_min_photo_to_rate', '0', '2013-11-17 09:38:29', '2013-11-17 09:38:29'),
(80, 'photorater_min_photo_to_get_rated', '-1', '2013-11-17 09:38:29', '2014-03-24 15:49:09'),
(81, 'email_notification_comment_photo', '1', '2013-11-17 12:07:28', '2014-03-28 12:16:43'),
(82, 'email_notification_rate_photo', '1', '2013-11-17 12:07:28', '2014-03-28 12:16:43'),
(83, 'email_content_rate_photo', '[from_username] rated your photo', '2013-11-17 12:12:48', '2014-03-29 16:56:20'),
(84, 'email_subject_rate_photo', 'Rated your photo', '2013-11-17 12:12:48', '2014-03-29 16:56:20'),
(85, 'email_content_comment_photo', '', '2013-11-17 12:12:55', '2013-11-17 12:12:55'),
(86, 'email_subject_comment_photo', '', '2013-11-17 12:12:55', '2013-11-17 12:12:55'),
(104, 'search_engine_access', '0', '2013-12-25 15:52:17', '2014-02-22 13:05:41'),
(87, 'email_content_delete_user', '', '2013-11-28 16:02:03', '2013-11-28 16:02:03'),
(88, 'email_subject_delete_user', '', '2013-11-28 16:02:03', '2013-11-28 16:02:03'),
(89, 'email_content_disable_user', '', '2013-11-28 16:09:26', '2013-11-28 16:09:26'),
(90, 'email_subject_disable_user', '', '2013-11-28 16:09:26', '2013-11-28 16:09:26'),
(91, 'email_subject_email_verification', 'Verify Your Email', '2013-11-28 17:00:47', '2014-03-29 09:57:04'),
(92, 'email_subject_meetme', 'Someone wants to meet you', '2013-11-28 17:01:12', '2014-03-28 09:47:35'),
(93, 'email_content_accept_message_request', '', '2013-11-28 17:01:17', '2013-11-28 17:01:17'),
(94, 'email_subject_accept_message_request', '', '2013-11-28 17:01:17', '2013-11-28 17:01:17'),
(95, 'email_subject_profile_visitor', 'Someone visited your profile', '2013-11-28 17:01:23', '2014-03-28 08:54:22'),
(96, 'email_content_send_message_request', 'm', '2013-11-28 17:01:29', '2014-03-09 14:31:46'),
(97, 'email_subject_send_message_request', '', '2013-11-28 17:01:29', '2013-11-28 17:01:29'),
(98, 'email_content_delete_photo', '', '2013-11-28 17:08:45', '2013-11-28 17:08:45'),
(99, 'email_subject_delete_photo', '', '2013-11-28 17:08:45', '2013-11-28 17:08:45'),
(100, 'email_subject_forgot_password', '', '2013-11-28 17:14:57', '2013-11-28 17:14:57'),
(102, 'meta_keywords', '', '2013-12-25 15:20:59', '2014-03-29 22:35:03'),
(103, 'meta_description', '', '2013-12-25 15:20:59', '2013-12-25 15:56:58'),
(118, 'favicon', '0', '2014-02-22 12:39:25', '2014-03-29 22:34:31'),

(114, 'debug_mode', '-1', '2014-02-22 11:15:37', '2014-03-24 15:49:09'),
(119, 'description', '', '2014-02-22 13:05:14', '2014-02-22 13:06:58'),
(120, 'google_ua', '', '2014-02-23 16:13:16', '2014-02-23 16:13:21'),
(121, 'spotlight_cost', '40', '2014-02-23 17:50:16', '2014-02-23 17:50:16'),
(122, 'riseup_cost', '22', '2014-02-23 17:50:16', '2014-02-23 17:51:17'),
(123, 'superpower_cost', '30', '2014-02-23 17:50:16', '2014-02-23 17:50:16'),
(124, 'user_languages', '', '2014-03-09 09:08:37', '2014-03-09 09:08:37'),
(125, 'default_language', 'en', '2014-03-09 00:00:00', '2014-03-29 22:24:52'),
(126, 'facebook_share', '0', '2014-03-09 15:00:48', '2014-03-29 22:36:03'),
(127, 'no_bot', '0', '2014-03-12 21:59:37', '2014-03-29 22:37:04'),
(128, 'bot_gender', '0', '2014-03-12 21:59:37', '2014-03-29 22:37:04'),
(129, 'banner_top_bar', '-1', '2014-03-24 15:49:01', '2014-03-24 15:56:51'),
(130, 'banner_bottom_bar', '-1', '2014-03-24 15:49:01', '2014-03-24 15:49:01'),
(131, 'banner_left_side_bar', '-1', '2014-03-24 15:49:01', '2014-03-24 15:49:01'),
(141, 'email_notification_mutual_attraction', '1', '2014-03-28 12:16:43', '2014-03-28 12:16:43'),
(138, 'email_content_add_contact', '[from_username] added you as contact', '2014-03-28 10:58:15', '2014-03-28 10:58:15'),
(132, 'show_superpowers', '1', '2014-03-24 16:32:05', '2014-03-28 10:05:51'),
(133, 'show_riseup_msg', '1', '2014-03-24 16:32:05', '2014-03-28 10:05:51'),
(134, 'show_fb_invite', '1', '2014-03-24 16:32:05', '2014-03-28 10:05:51'),
(135, 'show_photo_rater', '1', '2014-03-24 16:32:05', '2014-03-24 16:32:05'),
(136, 'show_encounters', '1', '2014-03-24 16:32:05', '2014-03-24 16:32:05'),
(137, 'frontbackgroundimage', '', '2014-03-27 20:54:25', '2014-03-29 22:37:12'),
(139, 'email_subject_add_contact', 'Added you as contact', '2014-03-28 10:58:15', '2014-03-28 10:58:15'),
(140, 'email_subject_message', 'Sent you a message', '2014-03-28 10:58:40', '2014-03-28 10:58:40'),
(142, 'email_notification_add_contact', '1', '2014-03-28 12:16:43', '2014-03-28 12:16:43'),
(143, 'email_notification_send_gift', '1', '2014-03-28 12:16:43', '2014-03-28 12:16:43'),
(144, 'email_content_send_gift', '[from_username] sent you a gift!', '2014-03-29 17:14:58', '2014-03-29 17:14:58'),
(145, 'email_subject_send_gift', 'You received a gift', '2014-03-29 17:14:58', '2014-03-29 17:14:58'),
(146, 'email_content_mutual_attraction', '[from_username] wants to meet you too!!', '2014-03-29 18:44:00', '2014-03-29 18:44:00'),
(147, 'email_subject_mutual_attraction', 'Mutual Attraction', '2014-03-29 18:45:59', '2014-03-29 18:45:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

