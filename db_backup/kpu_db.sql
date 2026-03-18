-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2026 at 04:46 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_banners`
--

DROP TABLE IF EXISTS `about_banners`;
CREATE TABLE IF NOT EXISTS `about_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_banners`
--

INSERT INTO `about_banners` (`id`, `pages_id`, `title`, `image`, `button_text`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'About KPU Hospital', NULL, 'Who we are', 'active', '2026-02-12 13:41:01', '2026-02-13 11:38:57'),
(4, 3, 'About KPU Hospital', NULL, 'Who we are', 'active', '2026-03-03 04:04:18', '2026-03-03 04:04:18'),
(5, 3, 'About KPU Hospital', NULL, 'Who we are', 'active', '2026-03-03 09:47:00', '2026-03-03 09:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `about_blogs`
--

DROP TABLE IF EXISTS `about_blogs`;
CREATE TABLE IF NOT EXISTS `about_blogs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` int NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_blogs`
--

INSERT INTO `about_blogs` (`id`, `pages_id`, `heading`, `title`, `image`, `button_text`, `button_link`, `sub_heading`, `description`, `icon`, `icon_heading`, `icon_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Choose the Best', 'Empowering Business with Expertise.', 'images/about/blogs/1770984367.jpg', NULL, NULL, 'Dedicated Support', 'Our team is always available for address expert concerns, providing quick and effective solution to keep your business', 'tji-award', 'Award-Winning Expertise', 'Recognized by industry leaders, our award-winning team has a proven record of delivering excellence across projects.', 1, '2026-02-13 02:42:23', '2026-02-13 12:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `about_blog_sections`
--

DROP TABLE IF EXISTS `about_blog_sections`;
CREATE TABLE IF NOT EXISTS `about_blog_sections` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_id` int NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `about_blog_sub_sections`
--

DROP TABLE IF EXISTS `about_blog_sub_sections`;
CREATE TABLE IF NOT EXISTS `about_blog_sub_sections` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_blog_section_id` int NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `about_contents`
--

DROP TABLE IF EXISTS `about_contents`;
CREATE TABLE IF NOT EXISTS `about_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` int NOT NULL,
  `logo_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_contents`
--

INSERT INTO `about_contents` (`id`, `pages_id`, `logo_image`, `heading`, `content`, `created_at`, `updated_at`) VALUES
(1, 3, 'images/about/content/1771046252.png', 'From Humble Beginnings toHealthcare Excellence', '<p>our mission is empower businesses through innovate best solution, exceptional service.Our vision is to become a global leader in providing transformative business solutions.Our vision is to become a global leader in providing transformative business solutions.our mission is empower businesses through innovate best solution, exceptional service.Our vision is to become a global leader in providing transformative business solutions.</p><p>our mission is empower businesses through innovate best solution, exceptional service.Our vision is to become a global leader in providing transformative business solutions.Our vision is to become a global leader in providing transformative business solutions.our mission is empower businesses through innovate best solution, exceptional service.Our vision is to become a global leader in providing transformative business solutions.</p><p>Our vision is to become a global leader in providing transformative business solutions.our mission is empower businesses through innovate best solution, exceptional service.Our vision is to become a global leader in providing transformative business solutions.</p><p>our mission is empower businesses through innovate best solution, exceptional service.Our vision is to become a global leader in providing transformative business solutions.Our vision is to become a global leader in providing transformative business solutions.our mission is empower businesses through innovate best solution, exceptional service.Our vision is to become a global leader in providing transformative business solutions.</p>', '2026-02-13 03:01:16', '2026-02-14 05:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `about_features`
--

DROP TABLE IF EXISTS `about_features`;
CREATE TABLE IF NOT EXISTS `about_features` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_features`
--

INSERT INTO `about_features` (`id`, `pages_id`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, 3, 'Empowering Business with Expertise.', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', '2026-02-13 03:42:41', '2026-02-13 03:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `about_feature_contents`
--

DROP TABLE IF EXISTS `about_feature_contents`;
CREATE TABLE IF NOT EXISTS `about_feature_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_feature_id` bigint UNSIGNED DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_feature_contents`
--

INSERT INTO `about_feature_contents` (`id`, `about_feature_id`, `icon`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'tji-innovative', 'Innovative Solutions', 'We stay ahead of the curve, leveraging cutting-edge technologies and strategies to keep you competitive in a marketplace.', '2026-02-13 03:42:41', '2026-02-13 03:42:41'),
(2, 1, 'tji-award', 'Award-Winning Expertise', 'Recognized by industry leaders, our award-winning team has a proven record of delivering excellence across projects.', '2026-02-13 03:42:41', '2026-02-13 03:42:41'),
(3, 1, 'tji-support', 'Dedicated Support', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', '2026-03-03 05:24:03', '2026-03-03 05:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `about_mid_contents`
--

DROP TABLE IF EXISTS `about_mid_contents`;
CREATE TABLE IF NOT EXISTS `about_mid_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_mid_contents`
--

INSERT INTO `about_mid_contents` (`id`, `pages_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 3, 'Scalable business services', '2026-02-13 05:03:49', '2026-02-14 06:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `about_mid_sub_contents`
--

DROP TABLE IF EXISTS `about_mid_sub_contents`;
CREATE TABLE IF NOT EXISTS `about_mid_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_mid_content_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_mid_sub_contents`
--

INSERT INTO `about_mid_sub_contents` (`id`, `about_mid_content_id`, `title`, `icon`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Business Strategy Development', 'tji-service-1', 'Recognize that exceptional customer experiences are at the heart of every successful business. Our Customer Experience Solutions are crafted to help you transform every interaction your customers have with your brand busin.', 'images/about/mid_content/1771051214_0.jpg', '2026-02-13 05:03:49', '2026-02-14 06:40:14'),
(2, 1, 'Customer Experience Solutions', 'tji-service-2', 'Recognize that exceptional customer experiences are at the heart of every successful business. Our Customer Experience Solutions are crafted to help you transform every interaction your customers have with your brand busin.', 'images/about/mid_content/1771051214_1.jpg', '2026-02-13 05:03:49', '2026-02-14 06:40:14'),
(5, 1, 'Sustainability and ESG Consulting', 'tji-service-3', 'Recognize that exceptional customer experiences are at the heart of every successful business. Our Customer Experience Solutions are crafted to help you transform every interaction your customers have with your brand busin.', 'images/about/mid_content/1771051214_2.jpg', '2026-02-14 06:40:14', '2026-02-14 06:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `about_sections`
--

DROP TABLE IF EXISTS `about_sections`;
CREATE TABLE IF NOT EXISTS `about_sections` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` int NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_sections`
--

INSERT INTO `about_sections` (`id`, `pages_id`, `heading`, `title`, `created_at`, `updated_at`) VALUES
(1, 3, 'Our Solutions', 'Tailor Business Solutions for Corporates.', '2026-02-13 09:29:52', '2026-02-13 09:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `about_sub_contents`
--

DROP TABLE IF EXISTS `about_sub_contents`;
CREATE TABLE IF NOT EXISTS `about_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_sub_contents`
--

INSERT INTO `about_sub_contents` (`id`, `pages_id`, `title`, `sub_title`, `description`, `created_at`, `updated_at`) VALUES
(1, 3, 'Scalable business services', 'Powering Innovation Through Partnerships with our Brands and Many Companies.', 'Recognized by industryaward leaders, award winning team has be a proven record.', '2026-02-13 04:05:53', '2026-03-03 08:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `about_sub_sections`
--

DROP TABLE IF EXISTS `about_sub_sections`;
CREATE TABLE IF NOT EXISTS `about_sub_sections` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `about_section_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_sub_sections`
--

INSERT INTO `about_sub_sections` (`id`, `about_section_id`, `title`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Business Strategy Development', 'tji-service-1', 'Through a combination of data-driven insights and innovative approaches, we work closely with you to develop customized.', '2026-02-13 09:29:52', '2026-02-13 09:29:52'),
(2, 1, 'Sustainability and ESG Consulting', 'tji-service-3', 'Provide tailored strategies that not only drive long-term value but also build trust with stakeholders, investors.', '2026-02-14 06:55:06', '2026-02-14 06:55:06'),
(3, 1, 'Sustainability and ESG Consulting', 'tji-service-3', 'Provide tailored strategies that not only drive long-term value but also build trust with stakeholders, investors.', '2026-03-03 09:46:41', '2026-03-03 09:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_banners`
--

DROP TABLE IF EXISTS `ambulance_banners`;
CREATE TABLE IF NOT EXISTS `ambulance_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambulance_banners`
--

INSERT INTO `ambulance_banners` (`id`, `pages_id`, `title`, `image`, `button_text`, `description`, `created_at`, `updated_at`) VALUES
(1, 7, 'Ambulance', 'images/ambulance/banner/1772427663.jpg', 'About KPU Hospital', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', '2026-02-17 03:36:58', '2026-03-02 05:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_contents`
--

DROP TABLE IF EXISTS `ambulance_contents`;
CREATE TABLE IF NOT EXISTS `ambulance_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambulance_contents`
--

INSERT INTO `ambulance_contents` (`id`, `pages_id`, `title`, `description`, `sub_title`, `sub_description`, `image`, `number`, `created_at`, `updated_at`) VALUES
(1, 7, 'Transforming Customer: Tailored Solutions for Experiences.', '<p>Recognize that exceptional customer experiences are at the heart of every successful business. Our Customer Experience Solutions are crafted to help you transform every interaction your customers have with your brand into a meaningful and positive experience. We believe that understanding the customer journey and providing personalized, seamless experiences can significantly enhance customer loyalty, satisfaction, and lifetime value.Our approach to customer experience is comprehensive and data-driven.</p><p>Our approach to customer experience is comprehensive and data-driven. We begin by assessing your current customer touchpoints, identifying areas for improvement, and using insights to develop strategies that meet your customers’ evolving needs. From optimizing digital platforms.</p>', 'Our Range of Customer Service', 'At Bexon, we don\'t just focus on solving customer problems—we focus on creating experiences that delight and build lasting relationships. Whether it\'s through improving customer service operations, leveraging technology, or designing more engaging digital experiences, our team is here to help you exceed your customers\' expectations every time. We help you understand your customers deeply, optimize their experience.', 'images/ambulance/content/1771304836.webp', '+8 (321) 890-640s', '2026-02-17 05:07:16', '2026-03-02 05:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_sub_contents`
--

DROP TABLE IF EXISTS `ambulance_sub_contents`;
CREATE TABLE IF NOT EXISTS `ambulance_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ambulance_contents_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambulance_sub_contents`
--

INSERT INTO `ambulance_sub_contents` (`id`, `ambulance_contents_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Increased Customer Satisfaction', 'By prov consistent, personalized experience, customers are more likely to feel valued a satisfied, which directly.', '2026-02-17 05:07:16', '2026-03-02 05:26:40'),
(2, 1, 'Improved Operational Efficiency', 'With our tools and strategies, your customer support teams can handle inquiries faster, while automated systems.', '2026-02-17 05:07:16', '2026-03-02 05:26:40'),
(3, 1, 'Insights for Continuous Improvement', 'Our data-driven approach provides team with valuable insights into customer behavior, enabling to continual.', '2026-02-17 05:07:16', '2026-03-02 05:26:40'),
(4, 1, 'Insights for Continuous Improvement', 'Our data-driven approach provides team with valuable insights into customer behavior, enabling to continual.', '2026-02-17 06:09:57', '2026-03-02 05:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `issue_id` bigint UNSIGNED DEFAULT NULL,
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image_url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published','archived') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_articles_category` (`category_id`),
  KEY `idx_articles_author` (`author_id`),
  KEY `idx_articles_status` (`status`),
  KEY `idx_articles_published_at` (`published_at`),
  KEY `fk_articles_issue` (`issue_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `category_id`, `author_id`, `issue_id`, `summary`, `content`, `featured_image_url`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Test', 1, 1, NULL, 'Building a Platform Without Spectacle\nThe magazine itself was never part of the original plan—but it solved a problem.\nBishop Sanders needed a way to share global stories without navigating time zones, internet lags, or the unpredictability of live interviews.\nMore importantly, she needed a tool to train and elevate emerging Christian writers—especially those whose names wouldn’t automatically land them a seat at the table.\n“People assume platforms are about being seen,” she says. “But sometimes platforms are about seeing others.”\nEach issue became a sacred space. Whether highlighting overlooked entrepreneurs, spotlighting powerful testimonies of healing, or amplifying the quiet strength of men in the Fathers of Faith issue, the magazine began to carve out its own distinct voice—intimate, intelligent, and deeply rooted in faith.\nThere were practical wins, of course. Discovering that the site had to upgrade its servers after crashing due to heavy traffic. Seeing readership expand across continents. Watching unknown names find their voice and their audience.\nBut for Bishop Sanders, the most significant moments were never on a screen.\n“It was when the writers would message us and say, ‘I know God sent you.’ That’s when I knew—this is it. This is what it’s supposed to be.”', 'Bishop Dr. Loretta Sanders does not introduce herself through titles or accolades. When asked who she is beyond credentials, she speaks first about character, loyalty, commitment, ambition, and a willingness to take risks.\r\nThose values have quietly shaped her leadership, guiding her into unconventional spaces, challenging familiar church systems, and giving rise to YuKanFaith as something far deeper than a publication and a Christian Education Company.\r\nBishop Dr. Loretta Sanders never intended to found a magazine. She wasn’t chasing influence, and she certainly wasn’t trying to create yet another Christian platform. What she did want—what she needed—was something far rarer: a way to build people, not just content.\r\n“When you’re bold enough to change your life,” she says, “you have to be brave enough to walk in it.”\r\nThat simple phrase has quietly become the spine of everything YuKanFaith stands for. As the publication marks its one-year anniversary, it’s not simply celebrating articles or readership metrics. It celebrates an act of obedience that became a movement and a new beginning, not just for the readers but for the visionary herself.\r\n\r\n\r\nThe Vision That Waited\r\nThe idea didn’t come wrapped in bright lights or thunderclaps. In fact, the first iteration of what would one day become YuKanFaith Magazine began humbly—in the spring of 2010, scribbled out with pen and paper in a Foot Locker parking lot.\r\n“It started as Empowering Through Knowledge,” Sanders recalls. “God gave me the vision, but it didn’t move right away. It was tarrying.”\r\nAt the time, Sanders was deep into her doctoral studies in curriculum and instruction. She had begun to notice that while sermons were plentiful—on television, in churches, across media—true understanding among believers was often painfully shallow.\r\n“People weren’t being taught,” she says. “They were being spoken at. And there’s a difference.”\r\nIt was this educator’s lens that gave rise to the blueprint: courses, conferences, books—all centered on instructional excellence within the church. But life moved. Sanders took a job in Abu Dhabi. She planted a church. The vision lingered but remained in the background-waiting for the right season.\r\n\r\n\r\nA Shift in the Soil\r\nWhen the vision resurfaced years later, it had matured—and so had she.\r\nAt first, it returned as Bold & Brave, a platform designed to reach people with a message of transformation that didn’t carry overt Christian branding. In a Muslim-majority country like the UAE, subtlety often created more access than declaration. But even as the initiative grew, something felt misaligned.\r\n“I could do it,” Sanders says. “It was successful enough. But it wasn’t what I was called to do.”\r\nAnd so she did the unthinkable, she shut it down.\r\nInstead of rebranding for popularity, she chose alignment. She returned to what God had shown her in the beginning. The result was YuKanFaith, a name drawn from the Japanese phrase for “bold and brave.” The new name was more than a title. It was a declaration of purpose. A recommitment. A reset.\r\nAnd that’s when things began to move.', NULL, 'draft', NULL, '2026-02-02 21:32:48', '2026-02-04 16:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active,0=inactive',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Bringing Quality Healthcare Service to You', 'images/banners/1771306100.jpg', 1, NULL, '2026-02-10 05:55:11', '2026-02-17 05:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `banner_sliders`
--

DROP TABLE IF EXISTS `banner_sliders`;
CREATE TABLE IF NOT EXISTS `banner_sliders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_sliders`
--

INSERT INTO `banner_sliders` (`id`, `category_id`, `image`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/category/banner_sliders/slider_1770607736_0.jpg', 'https://yukanfaithmagazine.com//', '2026-02-06 10:34:42', '2026-02-09 03:28:56'),
(2, 1, 'images/category/banner_sliders/slider_1770607397_1.jpg', 'https://yukanfaithmagazine.com', '2026-02-06 10:34:42', '2026-02-09 03:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `blood_banks`
--

DROP TABLE IF EXISTS `blood_banks`;
CREATE TABLE IF NOT EXISTS `blood_banks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood_banks`
--

INSERT INTO `blood_banks` (`id`, `pages_id`, `title`, `image`, `button_text`, `description`, `created_at`, `updated_at`) VALUES
(1, 8, 'Blood Bank', 'images/blood/banner/1771319135.jpg', 'For Ambulance Call: 011 4055 4051', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', '2026-02-17 09:05:35', '2026-02-17 11:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank_contents`
--

DROP TABLE IF EXISTS `blood_bank_contents`;
CREATE TABLE IF NOT EXISTS `blood_bank_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood_bank_contents`
--

INSERT INTO `blood_bank_contents` (`id`, `pages_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 8, 'OUR COMPANY', 'Our approach to customer experience is comprehensive and data-driven. We begin by assessing your current customer touchpoints, our identifying areas for improvement, and using insights to develop.', '2026-02-17 09:29:20', '2026-02-17 11:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank_sub_contents`
--

DROP TABLE IF EXISTS `blood_bank_sub_contents`;
CREATE TABLE IF NOT EXISTS `blood_bank_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `blood_bank_contents_id` bigint UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood_bank_sub_contents`
--

INSERT INTO `blood_bank_sub_contents` (`id`, `blood_bank_contents_id`, `heading`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'Increased Customer Satisfaction', 'By prov consistent, personalized experience.', '2026-02-17 09:29:20', '2026-03-02 11:11:37'),
(2, 1, 'Improved Operational Efficiency', 'With our tools and strategies.', '2026-02-17 09:29:20', '2026-03-02 11:11:37'),
(3, 1, 'Insights for Continuous Improvements', 'Our data-driven approach provides', '2026-02-17 09:29:20', '2026-03-02 11:11:37'),
(4, 1, 'Insights for Continuous Improvement', 'Our data-driven approach provides.', '2026-02-17 09:29:20', '2026-03-02 11:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

DROP TABLE IF EXISTS `blood_groups`;
CREATE TABLE IF NOT EXISTS `blood_groups` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `blood_group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for available, 0 for not available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood_groups`
--

INSERT INTO `blood_groups` (`id`, `pages_id`, `blood_group`, `status`, `created_at`, `updated_at`) VALUES
(1, 8, 'O+', 1, '2026-02-17 10:09:52', '2026-02-17 10:09:52'),
(2, 8, 'B+', 1, '2026-02-17 10:09:52', '2026-02-17 10:09:52'),
(3, 8, 'AB+', 1, '2026-02-17 10:09:52', '2026-02-17 12:02:49'),
(4, 8, 'A+', 1, '2026-02-17 12:03:02', '2026-02-17 12:03:02'),
(5, 8, 'B-', 1, '2026-03-02 11:24:14', '2026-03-02 11:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@123gmail.com|127.0.0.1:timer', 'i:1771045811;', 1771045811),
('laravel-cache-admin@123gmail.com|127.0.0.1', 'i:1;', 1771045811),
('laravel-cache-admin123@gmail.comadnib@123|127.0.0.1:timer', 'i:1771989786;', 1771989786),
('laravel-cache-admin123@gmail.comadnib@123|127.0.0.1', 'i:1;', 1771989786);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `career_banners`
--

DROP TABLE IF EXISTS `career_banners`;
CREATE TABLE IF NOT EXISTS `career_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `career_banners`
--

INSERT INTO `career_banners` (`id`, `pages_id`, `button_text`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, '4', 'About KPU Hospitals', 'Second Opinions', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.s', 'images/career/banner/1772415279.jpg', '2026-02-14 09:39:46', '2026-03-02 01:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `career_contents`
--

DROP TABLE IF EXISTS `career_contents`;
CREATE TABLE IF NOT EXISTS `career_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_min` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_max` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `career_contents`
--

INSERT INTO `career_contents` (`id`, `pages_id`, `title`, `job_type`, `work_mode`, `salary_min`, `salary_max`, `salary_type`, `location`, `icon`, `created_at`, `updated_at`) VALUES
(1, 4, 'Business Strategy Consultant', 'Full time job', 'on site', '$400', '$550', 'week', 'London,UK', 'tji-strategy', '2026-02-14 10:51:07', '2026-03-02 02:05:31'),
(5, 4, 'Management Consultant', 'Full time job', 'on site', '$400', '$550', 'week', 'London,UK', 'tji-manage', '2026-02-15 04:29:27', '2026-03-02 02:05:31');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subtitle_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_category`, `description`, `banner_image`, `category_subtitle`, `subtitle_description`, `created_at`, `updated_at`) VALUES
(1, 'heloo', NULL, 'des-cription', 'images/category/banner_image/1770607397.jpg', 'category-sub', 'hello-description', '2026-02-06 10:34:42', '2026-02-09 03:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'blood checkup', '2026-02-19 08:29:41', '2026-02-19 08:29:41'),
(2, 'Haemogram', '2026-02-19 08:38:10', '2026-02-19 08:38:10'),
(3, 'sugar', '2026-02-19 08:43:41', '2026-02-19 08:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Cardiology', 'Emergency Medicine Department at Vijaya Hospital is a team of well-equipped, dedicated and skilled doctors who', 1, '2026-02-10 10:48:03', '2026-02-10 10:56:33'),
(2, 'Dermatology', 'Emergency Medicine Department at Vijaya Hospital is a team of well-equipped, dedicated and skilled doctors who', 1, '2026-02-23 07:10:51', '2026-02-23 07:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `director_banners`
--

DROP TABLE IF EXISTS `director_banners`;
CREATE TABLE IF NOT EXISTS `director_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `director_banners`
--

INSERT INTO `director_banners` (`id`, `pages_id`, `title`, `button_text`, `image`, `created_at`, `updated_at`) VALUES
(1, 9, 'About KPU Hospital', 'Our Directors', 'images/directors/banner/1771394534.jpg', '2026-02-18 04:09:01', '2026-02-18 06:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `director_blogs`
--

DROP TABLE IF EXISTS `director_blogs`;
CREATE TABLE IF NOT EXISTS `director_blogs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `director_contents_id` bigint UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `director_blogs`
--

INSERT INTO `director_blogs` (`id`, `director_contents_id`, `heading`, `designation`, `image`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'Interactive', 'Business', 'images/directors/blog/1771391942_0.webp', 'Innovative Solutions for every Business Success.', '2026-02-18 05:19:02', '2026-02-18 05:19:02'),
(2, 1, 'Interactive', 'Business', 'images/directors/blog/1771391942_1.webp', 'Harnessing Digital Transform a Roadmap Businesses.', '2026-02-18 05:19:02', '2026-02-18 05:19:02'),
(3, 1, 'Interactive', 'Business', 'images/directors/blog/1771391942_2.webp', 'Mastering Change Management Lessons for Businesses.', '2026-02-18 05:19:02', '2026-02-18 05:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `director_contents`
--

DROP TABLE IF EXISTS `director_contents`;
CREATE TABLE IF NOT EXISTS `director_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `director_contents`
--

INSERT INTO `director_contents` (`id`, `pages_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 9, 'The Ultimate Resource.', 'We stay ahead of the leveraging cutting-edge technologies and strategies to keep. We stay ahead of the leveraging cutting-edge technologies and strategies to keep.', '2026-02-18 05:19:02', '2026-02-18 05:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `description`, `created_by`, `designation`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Savannah Ngueen', 'Emergency Medicine Department at Vijaya Hospital is a team of well-equipped, dedicated and skilled doctors who', 1, 'Operations Head', 'images/doctors/1771298376.jpg', 'active', '2026-02-10 13:15:06', '2026-02-23 07:20:31'),
(2, 'Eade Marren', 'Emergency Medicine Department at Vijaya Hospital is a team of well-equipped, dedicated and skilled doctors who', 1, 'surgery head', 'images/doctors/1771830738.jpg', 'active', '2026-02-23 07:12:18', '2026-02-23 07:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_departments`
--

DROP TABLE IF EXISTS `doctor_departments`;
CREATE TABLE IF NOT EXISTS `doctor_departments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_departments`
--

INSERT INTO `doctor_departments` (`id`, `doctor_id`, `department_id`, `created_at`, `updated_at`) VALUES
(5, 1, 1, '2026-02-23 07:20:31', '2026-02-23 07:20:31'),
(4, 2, 2, '2026-02-23 07:19:55', '2026-02-23 07:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, 'Proud Projects', 'Breaking Boundaries,Building Dreams.', '2026-02-24 09:28:35', '2026-02-24 10:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `facility_contents`
--

DROP TABLE IF EXISTS `facility_contents`;
CREATE TABLE IF NOT EXISTS `facility_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `facilities_id` bigint UNSIGNED DEFAULT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facility_contents`
--

INSERT INTO `facility_contents` (`id`, `facilities_id`, `heading`, `image`, `button_text`, `created_at`, `updated_at`) VALUES
(2, 1, 'Interactive Learning Platform', '1771916418_0.webp', 'Bussiness', '2026-02-24 07:00:18', '2026-02-24 07:00:18'),
(3, 1, 'Environmental Impact Dashboard', '1771916418_1.webp', 'Bussiness', '2026-02-24 07:00:18', '2026-02-24 07:00:18'),
(4, 1, 'Event Management Platform', '1771916418_2.webp', 'Bussiness', '2026-02-24 07:00:18', '2026-02-24 07:00:18'),
(5, 1, 'Rebranding Strategy for a Growing', '1771927691_3.webp', 'Bussiness', '2026-02-24 10:08:11', '2026-02-24 10:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, 'Empowering Business with Expertise.', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', '2026-02-24 04:50:09', '2026-02-24 04:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `feature_contents`
--

DROP TABLE IF EXISTS `feature_contents`;
CREATE TABLE IF NOT EXISTS `feature_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `feature_id` bigint UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_contents`
--

INSERT INTO `feature_contents` (`id`, `feature_id`, `icon`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'tji-innovative', 'Innovative Solutions', 'We stay ahead of the curve, leveraging cutting-edge technologies and strategies to keep you competitive in a marketplace.', '2026-02-24 04:50:46', '2026-02-24 04:50:46'),
(2, 1, 'tji-award', 'Award-Winning Expertise', 'Recognized by industry leaders, our award-winning team has a proven record of delivering excellence across projects.', '2026-02-24 04:50:46', '2026-02-24 04:50:46'),
(3, 1, 'tji-support', 'Dedicated Support', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', '2026-02-24 04:52:39', '2026-02-24 04:52:39'),
(4, 1, 'tji-support', 'Dedicated Support', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', '2026-02-24 04:52:39', '2026-02-24 04:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `feature_services`
--

DROP TABLE IF EXISTS `feature_services`;
CREATE TABLE IF NOT EXISTS `feature_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_services`
--

INSERT INTO `feature_services` (`id`, `pages_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 18, 'Innovating Today', 'Our approach to customer experience is comprehensive and data-driven. We begin by assessing your current customer touchpoints, our identifying areas for improvement, and using insights to develop.', 'images/service/content/1772102920.webp', '2026-02-26 10:48:40', '2026-02-26 10:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `feature_sub_services`
--

DROP TABLE IF EXISTS `feature_sub_services`;
CREATE TABLE IF NOT EXISTS `feature_sub_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `feature_services_id` bigint UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_sub_services`
--

INSERT INTO `feature_sub_services` (`id`, `feature_services_id`, `heading`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Intraoperative MRI', 'Our approach to customer experience is comprehensive and data-driven. We begin by assessing your current customer touchpoints, our identifying areas for improvement, and using insights to develop.', '2026-02-26 10:48:40', '2026-02-26 10:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `health_packagecontents`
--

DROP TABLE IF EXISTS `health_packagecontents`;
CREATE TABLE IF NOT EXISTS `health_packagecontents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_packagecontents`
--

INSERT INTO `health_packagecontents` (`id`, `pages_id`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, 11, 'Latest Projects', 'Breaking Boundaries, Building Dreams.', '2026-02-19 08:55:11', '2026-02-19 08:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `health_package_blogs`
--

DROP TABLE IF EXISTS `health_package_blogs`;
CREATE TABLE IF NOT EXISTS `health_package_blogs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_package_blogs`
--

INSERT INTO `health_package_blogs` (`id`, `pages_id`, `category_id`, `title`, `sub_title`, `name`, `designation`, `image`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'Innovative Solutions', 'Innovative Solutions for every Business Success.', 'By Ellinien Loma', 'Business', 'images/health_package/blog/1771494588_0.webp', '2026-02-19 09:49:48', '2026-02-19 09:49:48'),
(2, 11, 2, 'Innovative Solutions', 'Harnessing Digital Transform a Roadmap Businesses.', 'By Ellinien Loma', 'Business', 'images/health_package/blog/1771494983_0.webp', '2026-02-19 09:56:23', '2026-02-19 09:56:23'),
(3, 11, 3, 'Innovative Solutions', 'Mastering Change Management Lessons for Businesses.', 'By Ellinien Loma', 'Business', 'images/health_package/blog/1771495017_0.webp', '2026-02-19 09:56:57', '2026-02-19 09:56:57');

-- --------------------------------------------------------

--
-- Table structure for table `health_pakage_banners`
--

DROP TABLE IF EXISTS `health_pakage_banners`;
CREATE TABLE IF NOT EXISTS `health_pakage_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_pakage_banners`
--

INSERT INTO `health_pakage_banners` (`id`, `pages_id`, `image`, `title`, `description`, `button_text`, `created_at`, `updated_at`) VALUES
(1, 11, 'images/health_package/banner/1771475633.jpg', 'Health Packages', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'About KPU Hospital', '2026-02-19 04:33:53', '2026-02-19 04:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `icus`
--

DROP TABLE IF EXISTS `icus`;
CREATE TABLE IF NOT EXISTS `icus` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `icus`
--

INSERT INTO `icus` (`id`, `pages_id`, `image`, `title`, `description`, `button_text`, `created_at`, `updated_at`) VALUES
(1, 12, 'images/icu/banner/1772072523.jpg', 'Intensive Care Units', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'About KPU Hospital', '2026-02-21 03:45:28', '2026-02-26 02:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_banners`
--

DROP TABLE IF EXISTS `insurance_banners`;
CREATE TABLE IF NOT EXISTS `insurance_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurance_banners`
--

INSERT INTO `insurance_banners` (`id`, `pages_id`, `image`, `title`, `description`, `button_text`, `created_at`, `updated_at`) VALUES
(1, 10, 'images/insurance/banner/1771482867.jpg', 'Insurance TPA', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'For Ambulance Call: 011 4055 4051', '2026-02-19 05:59:25', '2026-02-19 06:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_contents`
--

DROP TABLE IF EXISTS `insurance_contents`;
CREATE TABLE IF NOT EXISTS `insurance_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurance_contents`
--

INSERT INTO `insurance_contents` (`id`, `pages_id`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, 10, 'Choose the Bests', 'Empowering Business with Expertise.', '2026-02-19 06:18:46', '2026-02-19 06:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_sub_contents`
--

DROP TABLE IF EXISTS `insurance_sub_contents`;
CREATE TABLE IF NOT EXISTS `insurance_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `insurance_contents_id` bigint UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurance_sub_contents`
--

INSERT INTO `insurance_sub_contents` (`id`, `insurance_contents_id`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'tji-innovative', 'We stay ahead of the curve', '2026-02-19 06:18:46', '2026-02-19 06:43:37'),
(2, 1, 'tji-award', 'Recognized by industry leaders', '2026-02-19 06:18:46', '2026-02-19 06:43:37'),
(3, 1, 'tji-support', 'Our team is always available to', '2026-02-19 06:18:46', '2026-02-19 06:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `internationalbanners`
--

DROP TABLE IF EXISTS `internationalbanners`;
CREATE TABLE IF NOT EXISTS `internationalbanners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `internationalbanners`
--

INSERT INTO `internationalbanners` (`id`, `pages_id`, `title`, `button_text`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 21, 'International Patient Services', 'About KPU Hospital', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'images/International/banner/1772176359.jpg', '2026-02-27 07:12:39', '2026-02-27 07:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `magazine_issues`
--

DROP TABLE IF EXISTS `magazine_issues`;
CREATE TABLE IF NOT EXISTS `magazine_issues` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_media_id` bigint UNSIGNED DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `pdf_url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_media_uploaded_by` (`uploaded_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_trips`
--

DROP TABLE IF EXISTS `medical_trips`;
CREATE TABLE IF NOT EXISTS `medical_trips` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_trips`
--

INSERT INTO `medical_trips` (`id`, `pages_id`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, 20, 'Plan Your Medical Trip', 'A step-by-step guide to help you plan your medical journey to KPU Hospital.', '2026-02-27 06:27:20', '2026-02-27 06:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `medical_trip_contents`
--

DROP TABLE IF EXISTS `medical_trip_contents`;
CREATE TABLE IF NOT EXISTS `medical_trip_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `medical_trips_id` bigint UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_trip_contents`
--

INSERT INTO `medical_trip_contents` (`id`, `medical_trips_id`, `heading`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Send Your Medical Reports', 'Share your medical history, reports, and diagnosis with our team for evaluation.', '2026-02-27 06:27:20', '2026-02-27 06:27:20'),
(2, 1, 'Receive Treatment Plan & Estimate', 'Our specialists will review your case and provide a detailed treatment plan with cost estimate.', '2026-02-27 06:27:20', '2026-02-27 06:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `medical_trip_sub_contents`
--

DROP TABLE IF EXISTS `medical_trip_sub_contents`;
CREATE TABLE IF NOT EXISTS `medical_trip_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `medical_trip_contents_id` bigint UNSIGNED NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_trip_sub_contents`
--

INSERT INTO `medical_trip_sub_contents` (`id`, `medical_trip_contents_id`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'Upload reports via our website or', '2026-02-27 06:27:20', '2026-02-27 06:27:20'),
(2, 1, 'Include recent test results', '2026-02-27 06:27:20', '2026-02-27 06:27:20'),
(3, 1, 'Share your medical history', '2026-02-27 06:27:20', '2026-02-27 06:27:20'),
(4, 1, 'Describe your current symptoms', '2026-02-27 06:27:20', '2026-02-27 06:27:20'),
(5, 2, 'Doctor\'s opinion within 48 hours', '2026-02-27 06:27:20', '2026-02-27 06:27:20'),
(6, 2, 'Transparent cost breakdown', '2026-02-27 06:27:20', '2026-02-27 06:27:20'),
(7, 2, 'Detailed treatment protocol', '2026-02-27 06:27:20', '2026-02-27 06:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `pages_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 16, 'Customer Experience', '2026-02-26 03:20:31', '2026-02-26 03:20:31'),
(2, 16, 'Training Programs', '2026-02-26 03:20:31', '2026-02-26 03:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_20_141210_create_categories_table', 1),
(5, '2026_01_20_141324_create_magazine_issues_table', 1),
(6, '2026_01_20_141335_create_articles_table', 1),
(7, '2026_01_20_141345_create_media_table', 1),
(8, '2026_02_03_170705_create_banners_table', 2),
(9, '2026_02_06_101439_add_status_to_categories_table', 3),
(10, '2026_02_06_101551_add_multiple_columns_to_categories_table', 3),
(11, '2026_02_06_141022_create_banner_sliders_table', 4),
(12, '2026_02_06_155110_create_banner_sliders_table', 5),
(13, '2026_02_09_103156_create_plans_table', 6),
(14, '2026_02_09_103911_create_subscriptions_table', 7),
(15, '2026_02_10_095730_create_roles_table', 8),
(16, '2026_02_10_100324_create_role_users_table', 8),
(17, '2026_02_10_115154_create_features_table', 8),
(18, '2026_02_10_134056_create_feature_contents_table', 9),
(19, '2026_02_10_155327_create_departments_table', 10),
(20, '2026_02_10_162949_create_doctors_table', 11),
(21, '2026_02_10_163947_create_doctor_departments_table', 11),
(22, '2026_02_10_165026_add_status_to_doctors_table', 12),
(23, '2026_02_12_111255_create_pages_table', 13),
(24, '2026_02_12_115744_create_sliders_table', 14),
(25, '2026_02_12_141626_create_about_banners_table', 15),
(26, '2026_02_12_142902_create_about_blogs_table', 16),
(27, '2026_02_12_143731_create_about_contents_table', 17),
(28, '2026_02_12_143944_create_about_features_table', 18),
(29, '2026_02_12_144138_create_about_feature_contents_table', 19),
(30, '2026_02_12_144529_create_about_sub_contents_table', 20),
(31, '2026_02_12_144828_create_about_mid_contents_table', 21),
(32, '2026_02_12_144843_create_about_mid_sub_contents_table', 21),
(33, '2026_02_12_145541_create_about_sections_table', 21),
(34, '2026_02_12_145751_create_about_sub_sections_table', 22),
(35, '2026_02_12_150104_create_about_mid_sub_contents_table', 23),
(36, '2026_02_12_151108_create_about_blog_sections_table', 23),
(37, '2026_02_12_151116_create_about_blog_sub_sections_table', 23),
(38, '2026_02_14_142203_add_slug_to_pages_table', 24),
(39, '2026_02_14_144037_create_career_banners_table', 25),
(40, '2026_02_14_152708_create_career_contents_table', 26),
(41, '2026_02_14_160656_create_career_contents_table', 27),
(42, '2026_02_16_095729_create_pharmacy_banners_table', 28),
(43, '2026_02_16_102824_create_pharmacy_contents_table', 29),
(44, '2026_02_16_103023_create_pharmacy_sub_contents_table', 29),
(45, '2026_02_16_151259_create_pharmacy_plans_contents_table', 30),
(46, '2026_02_16_151541_create_pharmacy_plans_table', 30),
(47, '2026_02_17_084824_create_ambulance_banners_table', 31),
(48, '2026_02_17_092222_create_ambulance_contents_table', 32),
(49, '2026_02_17_092554_create_ambulance_sub_contents_table', 32),
(50, '2026_02_17_142418_create_blood_banks_table', 33),
(51, '2026_02_17_143954_create_blood_bank_contents_table', 34),
(52, '2026_02_17_144015_create_blood_bank_sub_contents_table', 34),
(53, '2026_02_17_152618_create_blood_groups_table', 35),
(54, '2026_02_18_092028_create_director_banners_table', 36),
(55, '2026_02_18_094452_create_director_contents_table', 37),
(56, '2026_02_18_094513_create_director_blogs_table', 37),
(57, '2026_02_19_095139_create_health_pakage_banners_table', 38),
(58, '2026_02_19_112129_create_insurance_banners_table', 39),
(59, '2026_02_19_113436_create_insurance_contents_table', 40),
(60, '2026_02_19_113445_create_insurance_sub_contents_table', 40),
(61, '2026_02_19_141942_create_health_packagecontents_table', 41),
(62, '2026_02_19_150350_create_health_package_blogs_table', 42),
(63, '2026_02_21_090557_create_icus_table', 43),
(64, '2026_02_21_091752_create_menus_table', 44),
(65, '2026_02_23_072815_create_icu_contents_table', 45),
(66, '2026_02_23_073218_create_icu_sub_contents_table', 45),
(67, '2026_02_23_073354_create_icu_features_table', 45),
(68, '2026_02_23_103046_create_opinion_banners_table', 46),
(69, '2026_02_23_110133_create_opinion_contents_table', 47),
(70, '2026_02_24_111130_create_facilities_table', 48),
(71, '2026_02_24_111138_create_facility_contents_table', 48),
(72, '2026_02_25_100341_create_spacialities_table', 49),
(73, '2026_02_25_100357_create_spaciality_banners_table', 49),
(74, '2026_02_25_112117_create_spaciality_contents_table', 50),
(75, '2026_02_25_112126_create_spaciality_sub_contents_table', 50),
(76, '2026_02_25_152244_create_spaciality_blogs_table', 51),
(77, '2026_02_26_080849_create_service_contents_table', 52),
(78, '2026_02_26_115547_create_rehab_banners_table', 53),
(79, '2026_02_26_144636_create_ot_banners_table', 54),
(80, '2026_02_26_153322_create_feature_services_table', 55),
(81, '2026_02_26_153341_create_feature_sub_services_table', 55),
(82, '2026_02_26_170204_create_testing_banners_table', 56),
(83, '2026_02_26_175422_create_turism_banners_table', 57),
(84, '2026_02_27_085225_create_turism_contents_table', 58),
(85, '2026_02_27_085251_create_turism_sub_contents_table', 58),
(86, '2026_02_27_095436_create_medical_trips_table', 59),
(87, '2026_02_27_100532_create_medical_trip_contents_table', 60),
(88, '2026_02_27_100738_create_medical_trip_sub_contents_table', 60),
(89, '2026_02_27_123106_create_internationalbanners_table', 61);

-- --------------------------------------------------------

--
-- Table structure for table `opinion_banners`
--

DROP TABLE IF EXISTS `opinion_banners`;
CREATE TABLE IF NOT EXISTS `opinion_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opinion_banners`
--

INSERT INTO `opinion_banners` (`id`, `pages_id`, `image`, `title`, `description`, `button_text`, `created_at`, `updated_at`) VALUES
(1, 13, 'images/opinion/banner/1771843161.jpg', 'second Opinion', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'About KPU Hospital', '2026-02-23 05:23:35', '2026-03-02 02:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `opinion_contents`
--

DROP TABLE IF EXISTS `opinion_contents`;
CREATE TABLE IF NOT EXISTS `opinion_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opinion_contents`
--

INSERT INTO `opinion_contents` (`id`, `pages_id`, `heading`, `description`, `created_at`, `updated_at`) VALUES
(1, 13, 'Discovery & Planning', 'The first step in our process is understanding your unique business needs, objectives, and our cutomes challenges.', '2026-02-23 05:59:14', '2026-03-02 02:35:01'),
(2, 13, 'Execution & Delivery', 'Once the plan is in place, our team moves forward with execution, turning strategies into actiony to deliver.', '2026-02-23 05:59:14', '2026-03-02 02:35:01'),
(3, 13, 'Review & Support', 'After project completion, we conduct a thorough review to ensure everything aligns with your goals and requirements.', '2026-02-23 05:59:14', '2026-03-02 02:35:01'),
(4, 13, 'Review & Support', 'After project completion, we conduct a thorough review to ensure everything aligns with your goals and requirements.', '2026-02-23 05:59:14', '2026-03-02 02:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `ot_banners`
--

DROP TABLE IF EXISTS `ot_banners`;
CREATE TABLE IF NOT EXISTS `ot_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ot_banners`
--

INSERT INTO `ot_banners` (`id`, `pages_id`, `title`, `button_text`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 18, 'Hospital Ot', 'About KPU Hospital', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'images/ot/banner/1772098013.jpg', '2026-02-26 09:26:53', '2026-02-26 09:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(6, 'Pharmacy', 'pharmacy', '2026-02-16 04:21:25', '2026-03-03 11:24:44'),
(3, 'About', 'about', '2026-02-12 08:37:35', '2026-03-03 11:24:53'),
(4, 'Career', 'career', '2026-02-14 08:57:46', '2026-03-03 11:25:02'),
(7, 'Ambulance', 'ambulance', '2026-02-17 03:14:21', '2026-03-03 11:25:17'),
(8, 'Blood Bank', 'blood_bank', '2026-02-17 08:51:51', '2026-02-17 08:51:51'),
(9, 'Directors', 'directors', '2026-02-18 03:47:49', '2026-03-03 11:25:30'),
(10, 'Insurance', 'insurance', '2026-02-19 06:22:07', '2026-02-19 06:22:07'),
(11, 'Health Packages', 'health-packages', '2026-02-19 08:19:11', '2026-02-19 08:19:11'),
(12, 'Icu', 'icu', '2026-02-21 03:34:01', '2026-02-21 03:34:01'),
(13, 'Second Opinion', 'second-opinion', '2026-02-23 05:18:23', '2026-02-23 05:18:23'),
(15, 'Spaciality', 'spaciality', '2026-02-25 04:27:57', '2026-02-25 04:27:57'),
(16, 'Service', 'service', '2026-02-26 02:35:58', '2026-02-26 02:35:58'),
(17, 'Rehabilitation', 'rehabilitation', '2026-02-26 06:22:50', '2026-02-26 06:22:50'),
(18, 'Hospital Ot', 'hospital-ot', '2026-02-26 09:15:49', '2026-02-26 09:15:49'),
(19, 'Hospital Testing', 'hospital-testing', '2026-02-26 11:30:52', '2026-02-26 11:30:52'),
(20, 'Medical Turism', 'medical-turism', '2026-02-26 12:19:32', '2026-02-26 12:19:32'),
(21, 'Hospital International', 'hospital-international', '2026-02-27 06:57:53', '2026-02-27 06:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_access', '2025-10-18 02:22:44', '2025-10-18 02:22:44', NULL),
(2, 'user_create', '2025-10-18 02:22:44', '2025-10-18 02:22:44', NULL),
(3, 'user_edit', '2025-10-18 02:22:44', '2025-10-18 02:22:44', NULL),
(4, 'user_show', '2025-10-18 02:22:44', '2025-10-18 02:22:44', NULL),
(5, 'user_delete', '2025-10-18 02:22:44', '2025-10-18 02:22:44', NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'permission_edit', NULL, NULL, NULL),
(8, 'permission_show', NULL, NULL, NULL),
(9, 'permission_delete', NULL, NULL, NULL),
(10, 'permission_create', NULL, NULL, NULL),
(11, 'role_create', '2025-10-18 03:16:40', '2025-10-18 03:16:40', NULL),
(12, 'role_edit', '2025-10-18 03:17:05', '2025-10-18 03:17:05', NULL),
(13, 'role_show', NULL, NULL, NULL),
(14, 'role_delete', NULL, NULL, NULL),
(15, 'role_access', NULL, NULL, NULL),
(16, 'profile_password_edit', NULL, NULL, NULL),
(77, 'user_manage_access', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 1, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 1, 13, NULL, NULL),
(14, 1, 14, NULL, NULL),
(15, 1, 15, NULL, NULL),
(16, 1, 16, NULL, NULL),
(17, 1, 77, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_banners`
--

DROP TABLE IF EXISTS `pharmacy_banners`;
CREATE TABLE IF NOT EXISTS `pharmacy_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_banners`
--

INSERT INTO `pharmacy_banners` (`id`, `pages_id`, `title`, `button_text`, `image`, `created_at`, `updated_at`) VALUES
(1, 6, 'Pharmacy', 'About KPU Hospital', 'images/pharmacy/banner/banner.jpg', '2026-02-16 04:53:29', '2026-03-02 03:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_contents`
--

DROP TABLE IF EXISTS `pharmacy_contents`;
CREATE TABLE IF NOT EXISTS `pharmacy_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_contents`
--

INSERT INTO `pharmacy_contents` (`id`, `pages_id`, `title`, `sub_title`, `description`, `button_text`, `created_at`, `updated_at`) VALUES
(1, 6, 'Our Commitment', 'Innovating Today', '<p>Our approach to customer experience is comprehensive and data-driven. We begin by assessing your current customer touchpoints, our identifying areas for improvement, and using insights to develop.</p><p>Our approach to customer experience is comprehensive and data-driven. We begin by assessing your current customer touchpoints, our identifying areas for improvement, and using insights to develop.</p>', 'Growth', '2026-02-16 09:28:34', '2026-02-16 09:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_plans`
--

DROP TABLE IF EXISTS `pharmacy_plans`;
CREATE TABLE IF NOT EXISTS `pharmacy_plans` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_plans`
--

INSERT INTO `pharmacy_plans` (`id`, `pages_id`, `title`, `sub_title`, `from_time`, `to_time`, `created_at`, `updated_at`) VALUES
(1, 6, 'Main Pharmacy', 'Through a combination', '8 AM', '9PM', '2026-02-19 02:09:08', '2026-03-02 04:34:14'),
(2, 6, 'Customer Experience', 'Customer Experience .', '8 AM', '9PM', '2026-02-19 02:09:08', '2026-03-02 04:34:14'),
(3, 6, 'ESG Consulting', 'Provide tailored .', '8 AM', '9PM', '2026-02-19 02:09:08', '2026-03-02 04:34:14'),
(4, 6, 'Training and', 'Training and', '8 AM', '9PM', '2026-02-19 02:09:08', '2026-02-19 02:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_plans_contents`
--

DROP TABLE IF EXISTS `pharmacy_plans_contents`;
CREATE TABLE IF NOT EXISTS `pharmacy_plans_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `basic_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standard_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_plans_contents`
--

INSERT INTO `pharmacy_plans_contents` (`id`, `pages_id`, `basic_plan`, `standard_plan`, `created_at`, `updated_at`) VALUES
(1, 6, 'All features in Basic Plan', 'All features in Standard Plan', '2026-02-19 02:09:08', '2026-03-02 04:49:14'),
(2, 6, 'Priority customer support', 'Dedicated account manager', '2026-02-19 02:09:08', '2026-03-02 04:49:14'),
(3, 6, 'Up to 3 projects per month', 'Tailored strategy sessions', '2026-02-19 02:09:08', '2026-03-02 04:49:14'),
(4, 6, 'Monthly performance reviews', 'Quarterly performance audits', '2026-02-19 02:09:08', '2026-03-02 04:49:14'),
(5, 6, 'Collaboration tools for team', 'Priority support', '2026-02-19 02:09:08', '2026-03-02 04:49:14'),
(6, 6, 'All features in Basic Plan', 'All features in Standard Plan', '2026-02-19 02:09:08', '2026-03-02 04:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_sub_contents`
--

DROP TABLE IF EXISTS `pharmacy_sub_contents`;
CREATE TABLE IF NOT EXISTS `pharmacy_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pharmacy_contents_id` bigint UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacy_sub_contents`
--

INSERT INTO `pharmacy_sub_contents` (`id`, `pharmacy_contents_id`, `icon`, `heading`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'tji-innovative', 'Innovative Solutions', 'We stay ahead of the curve, leveraging cutting-edge technologies and strategies to keep you competitive in a marketplace.', '2026-02-16 09:28:34', '2026-03-02 04:14:08'),
(2, 1, 'tji-award', 'Award-Winning Expertise', 'Recognized by industry leaders, our award-winning team has a proven record of delivering excellence across projects.', '2026-02-16 09:28:34', '2026-03-02 04:14:08'),
(9, 1, 'tji-support', 'Dedicated Support', 'We stay ahead of the curve, leveraging cutting-edge technologies and strategies to keep you competitive in a marketplace.', '2026-02-16 12:31:07', '2026-03-02 04:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE IF NOT EXISTS `plans` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `duration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rehab_banners`
--

DROP TABLE IF EXISTS `rehab_banners`;
CREATE TABLE IF NOT EXISTS `rehab_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rehab_banners`
--

INSERT INTO `rehab_banners` (`id`, `pages_id`, `title`, `button_text`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 17, 'Rehabilitation', 'About KPU Hospital', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'images/rehab/banner/1772088821.jpg', '2026-02-26 06:44:46', '2026-02-26 06:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_title_unique` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', NULL, '2025-10-18 02:22:44', '2025-10-18 02:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_contents`
--

DROP TABLE IF EXISTS `service_contents`;
CREATE TABLE IF NOT EXISTS `service_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED DEFAULT NULL,
  `menus_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_contents`
--

INSERT INTO `service_contents` (`id`, `pages_id`, `menus_id`, `title`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 16, 1, 'Transforming Customer: Tailored Solutions for Experiences.', NULL, 'Recognize that exceptional customer experiences are at the heart of every successful business. Our Customer Experience Solutions are crafted to help you transform every interaction your customers have with your brand into a meaningful and positive experience. We believe that understanding the customer journey and providing personalized, seamless experiences can significantly enhance customer loyalty, satisfaction, and lifetime value.Our approach to customer experience is comprehensive and data-driven.', '2026-02-26 04:38:27', '2026-02-26 04:38:27'),
(2, 16, 2, 'Training Customer: Tailored Solutions for Experiences.', NULL, 'Our approach to customer experience is comprehensive and data-driven. We begin by assessing your current customer touchpoints, identifying areas for improvement, and using insights to develop strategies that meet your customers’ evolving needs. From optimizing digital platforms.', '2026-02-26 04:38:27', '2026-02-26 04:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qRjLmfwXqy78sQHVTZqyAKJqH88VFIbsJIODGgOj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiT29IOWROaGR2YXd3TjNDQ2lsZDRRR2pXWXVoazJkVWx0NGtIUld3bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzczMjgzOTY3O319', 1773295386);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spacialities`
--

DROP TABLE IF EXISTS `spacialities`;
CREATE TABLE IF NOT EXISTS `spacialities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spaciality_banners`
--

DROP TABLE IF EXISTS `spaciality_banners`;
CREATE TABLE IF NOT EXISTS `spaciality_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spaciality_banners`
--

INSERT INTO `spaciality_banners` (`id`, `pages_id`, `title`, `button_text`, `description`, `image`, `text`, `created_at`, `updated_at`) VALUES
(1, 15, 'Dedicated Support', 'About KPU Hospital', 'We stay ahead of the leveraging cutting-edge technologies and strategies to keep. We stay ahead of the leveraging cutting-edge technologies and strategies to keep.', 'images/spaciality/banner/1772011665.jpg', 'Call us +91 234524678', '2026-02-25 05:03:05', '2026-02-25 09:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `spaciality_blogs`
--

DROP TABLE IF EXISTS `spaciality_blogs`;
CREATE TABLE IF NOT EXISTS `spaciality_blogs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spaciality_blogs`
--

INSERT INTO `spaciality_blogs` (`id`, `pages_id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 15, 'tji-service-1', 'Business Strategy Development', 'Through a combination of data-driven insights and innovative approaches business.', '2026-02-25 13:29:51', '2026-02-25 13:30:28'),
(2, 15, 'tji-service-2', 'Customer Experience Solutions', 'Through a combination of data-driven insights and innovative approaches business.', '2026-02-25 13:29:51', '2026-02-25 13:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `spaciality_contents`
--

DROP TABLE IF EXISTS `spaciality_contents`;
CREATE TABLE IF NOT EXISTS `spaciality_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spaciality_contents`
--

INSERT INTO `spaciality_contents` (`id`, `pages_id`, `title`, `sub_title`, `image`, `created_at`, `updated_at`) VALUES
(1, 15, 'Dedicated Support', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'images/spaciality/content/1772012805.webp', '2026-02-25 06:24:41', '2026-02-25 09:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `spaciality_sub_contents`
--

DROP TABLE IF EXISTS `spaciality_sub_contents`;
CREATE TABLE IF NOT EXISTS `spaciality_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `spaciality_contents_id` bigint UNSIGNED NOT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spaciality_sub_contents`
--

INSERT INTO `spaciality_sub_contents` (`id`, `spaciality_contents_id`, `heading`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'What services does Bexon offer to clients?', 'Getting started is easy! Simply reach out to us through our contact form or give us a call, and we’ll schedule a consultation to discuss your project and how we can best assist you. Our team keeps you informed throughout the process, ensuring quality control and timely delivery.', '2026-02-25 06:24:41', '2026-02-26 10:22:45'),
(2, 1, 'sHow do I get started with Corporate Business?', 'Getting started is easy! Simply reach out to us through our contact form or give us a call, and we’ll schedule a consultation to discuss your project and how we can best assist you. Our team keeps you informed throughout the process, ensuring quality control and timely delivery.', '2026-02-25 06:24:41', '2026-02-26 10:22:45'),
(3, 1, 'How do you ensure the success of a project?', 'Getting started is easy! Simply reach out to us through our contact form or give us a call, and we’ll schedule a consultation to discuss your project and how we can best assist you. Our team keeps you informed throughout the process, ensuring quality control and timely delivery.', '2026-02-25 06:24:41', '2026-02-26 10:22:45'),
(4, 1, 'How long will it take to complete my project?', 'Getting started is easy! Simply reach out to us through our contact form or give us a call, and we’ll schedule a consultation to discuss your project and how we can best assist you. Our team keeps you informed throughout the process, ensuring quality control and timely delivery.', '2026-02-25 09:47:21', '2026-02-26 10:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `plan_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active,0=inactive',
  `payment_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=success,0=failed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_user_id_foreign` (`user_id`),
  KEY `subscriptions_plan_id_foreign` (`plan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testing_banners`
--

DROP TABLE IF EXISTS `testing_banners`;
CREATE TABLE IF NOT EXISTS `testing_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testing_banners`
--

INSERT INTO `testing_banners` (`id`, `pages_id`, `title`, `button_text`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 19, 'Hospital Testing', 'About KPU Hospital', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'images/testing/banner/1772106344.jpg', '2026-02-26 11:45:44', '2026-02-26 11:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `turism_banners`
--

DROP TABLE IF EXISTS `turism_banners`;
CREATE TABLE IF NOT EXISTS `turism_banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `turism_banners`
--

INSERT INTO `turism_banners` (`id`, `pages_id`, `title`, `button_text`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 20, 'Medical Tourism', 'About KPU Hospital', 'Our team is always available to address your concerns, providing quick and effective solution to keep your business.', 'images/turism/banner/1772109811.jpg', '2026-02-26 12:43:31', '2026-02-26 12:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `turism_contents`
--

DROP TABLE IF EXISTS `turism_contents`;
CREATE TABLE IF NOT EXISTS `turism_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pages_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `turism_contents`
--

INSERT INTO `turism_contents` (`id`, `pages_id`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, 20, 'Why Choose India for Medical Treatment?', 'India has emerged as a global leader in medical tourism, attracting millions of patients annually.', '2026-02-27 03:52:05', '2026-02-27 03:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `turism_sub_contents`
--

DROP TABLE IF EXISTS `turism_sub_contents`;
CREATE TABLE IF NOT EXISTS `turism_sub_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `turism_contents_id` bigint UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `turism_sub_contents`
--

INSERT INTO `turism_sub_contents` (`id`, `turism_contents_id`, `icon`, `heading`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'tji-innovative', 'World-Class Care', 'JCI & NABH accredited hospitals with internationally trained doctors', '2026-02-27 03:52:06', '2026-02-27 03:52:06'),
(2, 1, 'tji-award', 'Cost Savings', 'Save 60-90% compared to US, UK, and other developed countries', '2026-02-27 03:52:06', '2026-02-27 03:52:06'),
(3, 1, 'tji-support', 'No Wait Times', 'Immediate appointments and treatments without long waiting periods', '2026-02-27 03:52:06', '2026-02-27 03:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','editor','author','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'author',
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `bio`, `image`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin User', 'admin123@gmail.com', '$2y$12$kwlNtaeMrqfxoW3B3YTKbe5SyRuW640GCyK89E98npqzhVi2KaTzi', 'author', NULL, NULL, NULL, NULL, '2026-02-12 03:40:48', '2026-02-12 03:40:48', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
