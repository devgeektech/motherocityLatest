-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2022 at 07:27 AM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webwiqpq_Motherocity`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_faqs`
--

CREATE TABLE `account_faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_faqs`
--

INSERT INTO `account_faqs` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'What are ISO standards and why are they important?', '<p>ISO standards in different areas, from pens to aircraft, are created to guarantee quality on a global level. Each of the standards was developed by the International Organization for Standardization (ISO) &mdash; an independent, nongovernmental, international organization that unites professionals in their areas to set the standards for the quality of goods or services.&nbsp;</p>\r\n<p>ISO 27001 is the only auditable certification in the world that defines the requirements of an information security management system (ISMS), and it&rsquo;s the foundation for the standards and rules we adhere to. It covers 14 domains of security to ensure all areas are adequately assessed.</p>', '2022-09-07 05:56:08', '2022-09-07 05:56:08'),
(2, 'Is ISO 27001 mandatory?', '<p>No. But since we are aware of the intimate nature of the data you trust us with, we are committed to being proactive when it comes to the security of this information. Therefore, obtaining ISO 27001 certification is the highest priority for Flo. We also believe that our example will empower the whole industry to raise the bar when it comes to security principles.</p>', '2022-09-07 05:56:56', '2022-09-07 05:56:56'),
(3, 'What does the company commit to doing while being ISO 27001 certified?', '<p>By obtaining the ISO 27001 certification, the company commits to protecting three aspects of information:</p>\r\n<ul>\r\n<li><strong>Confidentiality</strong>: Only authorized persons have the right to access information.</li>\r\n<li><strong>Integrity</strong>: Only authorized persons can change the information.</li>\r\n<li><strong>Availability</strong>: The information must be accessible to authorized persons whenever it is needed.</li>\r\n</ul>', '2022-09-07 05:57:19', '2022-09-07 05:57:19'),
(4, 'What has Flo done to obtain the ISO certification?', '<p>To become ISO 27001 certified, Flo created new guidelines around security, tested all of our controls across 14 domains, ran comprehensive training for all staff at Flo, and completed rigorous audits performed by external companies. The project took 9 months, and we are happy to say that Flo passed with a score of 100%.</p>', '2022-09-07 05:57:36', '2022-09-07 05:57:36'),
(5, 'What does this mean for me and my data?', '<p>Millions of women and people who menstruate around the world trust us with the most intimate information about their health and well-being. Achieving ISO 27001 certification means that Flo protects users&rsquo; data against information risks, such as cyberattacks, hacks, data leaks, and theft, at the highest standard possible.</p>', '2022-09-07 05:58:00', '2022-09-07 05:58:00'),
(6, 'What is ISO 27001?', '<p><a href=\"https://www.nqa.com/en-gb/certification/standards/iso-27001\"><u>ISO 27001</u></a>&nbsp;(Information Security Management) is an international standard and benchmark that audits and assesses all companies&rsquo; policies, processes, and safeguards when it comes to data security.</p>', '2022-09-07 05:58:24', '2022-09-07 05:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone`, `role_id`) VALUES
(1, 'admin', 'admin@gmail.com', '123456', '9856324760', NULL),
(2, 'sub admin', 'subadmin@gmail.com', '123456', '874874587', 1),
(3, 'neha', 'neha.webwiders@gmail.com', '123456', '8758745874', 1),
(6, 'Aliyan Javaid', 'helloaliyanj@gmail.com', 'Night-tonight-29', '3059242342', 1),
(7, 'Imran', 'imran.webwiders@gmail.com', '123456', '9827098270', 3),
(8, 'Davinder', 'davi.kaur003@gmail.com', 'change-i8', '+9111111111111', 3),
(9, 'Satinder', 'development.geektech@gmail.com', '123456', '+912323213', 1);

-- --------------------------------------------------------

--
-- Table structure for table `birth_type`
--

CREATE TABLE `birth_type` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `birth_type`
--

INSERT INTO `birth_type` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Cesarean Section Delivery', '2022-09-08 16:21:55', '0000-00-00 00:00:00'),
(2, 'Veginal Delivery', '2022-09-08 16:21:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog_management`
--

CREATE TABLE `blog_management` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=free,1=paid',
  `price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 = normal | 1 = primary | 2 = secondary | 3 = home picked',
  `related_content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog_management`
--

INSERT INTO `blog_management` (`id`, `title`, `description`, `category`, `subcategory`, `status`, `price`, `blog_type`, `related_content`, `created_at`, `updated_at`) VALUES
(21, 'Everything you should know and its Effects on Fertility during Postpartum', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 8, 0, 0, '0', 0, NULL, '2022-09-21 02:22:56', '0000-00-00 00:00:00'),
(22, 'Getting Your First Postpartum Period: Everything You Should Know', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 8, 0, 0, '0', 1, NULL, '2022-09-21 02:29:14', '0000-00-00 00:00:00'),
(23, 'Managing PCOS and Endometriosis during Postpartum ', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 8, 0, 0, '0', 1, NULL, '2022-09-21 02:29:24', '0000-00-00 00:00:00'),
(24, 'Postpartum Bleeding: What to Expect', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 8, 0, 0, '0', 2, NULL, '2022-09-21 02:29:06', '0000-00-00 00:00:00'),
(25, 'Vaginal Delivery vs C-Section Delivery', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 8, 0, 0, '0', 2, NULL, '2022-09-21 02:30:02', '0000-00-00 00:00:00'),
(26, 'Bladder Complications Associated With Postpartum: Signs, Causes, and Treatments', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum 11</p>', 9, 0, 0, '0', 0, NULL, '2022-09-30 02:05:21', '0000-00-00 00:00:00'),
(27, 'Bleeding After Childbirth: What You Need to Know', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsumrr</p>', 9, 0, 0, '0', 3, NULL, '2022-09-30 01:57:43', '0000-00-00 00:00:00'),
(28, 'Depression Disorder Postpartum: Signs, Causes, and Treatment', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsumjj</p>', 9, 0, 0, '0', 0, NULL, '2022-09-30 01:58:01', '0000-00-00 00:00:00'),
(29, 'Diabetic Complications in Postpartum – Signs, Causes, and Treatment', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 9, 0, 0, '0', 3, NULL, '2022-09-21 04:56:17', '0000-00-00 00:00:00'),
(30, 'High functioning depression', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 9, 0, 0, '0', 0, NULL, '2022-09-21 04:56:43', '0000-00-00 00:00:00'),
(31, 'High Risks Associated with Postpartum Complications', '<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 9, 0, 0, '0', 3, NULL, '2022-09-21 04:57:16', '0000-00-00 00:00:00'),
(32, 'hair transplant ', '<p>I your doctor would like to suggest some important tips</p>', 21, 0, 0, '0', 0, '30', '2022-09-30 00:56:27', '0000-00-00 00:00:00'),
(33, 'czcz', '<p>czcz</p>', 19, 0, 0, '0', 0, NULL, '2022-09-30 02:08:39', '0000-00-00 00:00:00'),
(34, 'Expect movement to be difficult today', '<p>Expect movement to be difficult today</p>', 19, 20, 0, '0', 0, '30,29', '2022-09-30 04:03:40', '0000-00-00 00:00:00'),
(35, 'czz', '<p>xzX</p>', 19, 20, 0, '0', 0, NULL, '2022-09-30 05:03:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `caretaker`
--

CREATE TABLE `caretaker` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `caretaker_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caretaker_relation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caretaker_permission` text COLLATE utf8_unicode_ci,
  `caretaker_number` bigint(20) DEFAULT NULL,
  `caretaker_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caretaker_note` text COLLATE utf8_unicode_ci,
  `is_caretaker_note_private` int(11) DEFAULT NULL COMMENT '1=Yes|0=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `caretaker`
--

INSERT INTO `caretaker` (`id`, `postpartum_id`, `postpartum_code`, `caretaker_name`, `caretaker_relation`, `caretaker_permission`, `caretaker_number`, `caretaker_email`, `caretaker_note`, `is_caretaker_note_private`, `created_at`, `updated_at`) VALUES
(1, 1, 312222, 'sdsad', 'sadsf', NULL, 874578745, '', 'dsadsdsad', 1, '2022-09-09 04:58:14', '0000-00-00 00:00:00'),
(2, 1, 312222, 'jsdhshd', '', NULL, 0, 'asd@gmail.com', 'adaasas', 0, '2022-09-09 04:58:14', '0000-00-00 00:00:00'),
(3, 2, 418134, 'sdsad', 'sadsf', NULL, 874578745, '', 'dsadsdsad', 1, '2022-09-09 05:14:24', '0000-00-00 00:00:00'),
(4, 2, 418134, 'jsdhshd', '', NULL, 0, 'asd@gmail.com', 'adaasas', 0, '2022-09-09 05:14:24', '0000-00-00 00:00:00'),
(5, 3, 354760, 'sdsad', 'sadsf', NULL, 874578745, '', 'dsadsdsad', 1, '2022-09-09 05:15:41', '0000-00-00 00:00:00'),
(6, 3, 354760, 'jsdhshd', '', NULL, 0, 'asd@gmail.com', 'adaasas', 0, '2022-09-09 05:15:41', '0000-00-00 00:00:00'),
(7, 4, 845495, 'sdsad', 'sadsf', NULL, 874578745, '', 'dsadsdsad', 1, '2022-09-09 05:37:30', '0000-00-00 00:00:00'),
(8, 4, 845495, 'jsdhshd', '', NULL, 0, 'asd@gmail.com', 'adaasas', 0, '2022-09-09 05:37:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `code_phrases`
--

CREATE TABLE `code_phrases` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `phrase` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meaning` text COLLATE utf8_unicode_ci,
  `timeline` text COLLATE utf8_unicode_ci,
  `frequency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `code_phrases`
--

INSERT INTO `code_phrases` (`id`, `postpartum_id`, `postpartum_code`, `phrase`, `meaning`, `timeline`, `frequency`, `created_at`, `updated_at`) VALUES
(1, 2, 418134, 'dsadds', 'adasdsdsd', NULL, NULL, '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(2, 3, 354760, 'dsadds', 'adasdsdsd', NULL, NULL, '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(3, 4, 845495, 'dsadds', 'adasdsdsd', NULL, NULL, '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `sender_id`, `category_id`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'check', 'sdafasfcasfcsc', '2022-09-27 17:34:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_category`
--

CREATE TABLE `contact_us_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_us_category`
--

INSERT INTO `contact_us_category` (`id`, `title`) VALUES
(1, 'Fake doctor'),
(2, 'Fake service'),
(3, 'New Contact'),
(4, 'Last Contact');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 = general | 1= primary | 2 = secondary',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=free,1=paid',
  `price` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0',
  `hand_picked` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `preview` text COLLATE utf8_unicode_ci NOT NULL,
  `related_content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `description`, `image`, `content_type`, `status`, `price`, `parent`, `hand_picked`, `preview`, `related_content`, `created_at`, `updated_at`) VALUES
(2, 'check', '<p>sdasd</p>', 'assets/content_image/2698049401662458498.png', 2, 0, '0', 0, 'sdad', 'sds', 'dsd', '2022-09-06 05:01:38', '2022-09-07 02:32:00'),
(3, 'subcate1', '<p>cscdsc1</p>', 'assets/content_image/20013055931662459586.png', 0, 0, '0', 5, 'gfdgg1', 'dscfsc1', 'dfsf1', '2022-09-06 05:19:46', '2022-09-07 02:32:33'),
(5, 'test11', '<p>sdad1</p>', 'assets/content_image/11778256111662460941.png', 0, 0, '123', 0, 'sds1', 'sadfas1', 'dsasd1', '2022-09-06 05:42:21', '2022-09-06 05:48:04'),
(6, 'test1', '<p>adad1</p>', 'assets/content_image/20832830811662461562.png', 2, 0, '1221', 0, 'sdad1', 'dsad1', 'sdad1', '2022-09-06 05:52:42', '2022-09-07 01:17:56'),
(7, 'tesdsds1', '<p>dsdasd1</p>', 'assets/content_image/8456630851662461706.png', 1, 0, '0', 6, 'sadad', 'sad', 'dasd1', '2022-09-06 05:55:06', '2022-09-07 02:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `content_blog`
--

CREATE TABLE `content_blog` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_blog`
--

INSERT INTO `content_blog` (`id`, `title`, `parent`, `created_at`, `updated_at`) VALUES
(8, 'Bleeding', 0, '2022-09-16 05:59:20', '0000-00-00 00:00:00'),
(9, 'High Risks', 0, '2022-09-16 05:59:35', '0000-00-00 00:00:00'),
(10, 'Hormones', 0, '2022-09-16 05:59:51', '0000-00-00 00:00:00'),
(11, 'Lactation', 0, '2022-09-16 06:00:02', '2022-09-16 06:00:08'),
(12, 'LGBTQ+', 0, '2022-09-16 06:00:25', '0000-00-00 00:00:00'),
(13, 'Mental Health', 0, '2022-09-16 06:01:07', '0000-00-00 00:00:00'),
(14, 'NICU', 0, '2022-09-16 06:01:36', '0000-00-00 00:00:00'),
(15, 'Nutrition', 0, '2022-09-16 06:02:05', '0000-00-00 00:00:00'),
(16, 'Pain', 0, '2022-09-16 06:02:15', '0000-00-00 00:00:00'),
(17, 'Sexual Health', 0, '2022-09-16 06:02:28', '0000-00-00 00:00:00'),
(18, 'Weight', 0, '2022-09-16 06:02:50', '0000-00-00 00:00:00'),
(19, 'Height', 0, '2022-09-19 01:15:20', '0000-00-00 00:00:00'),
(20, 'hair', 19, '2022-09-19 01:15:47', '2022-09-30 00:54:59'),
(21, 'colestrole1 i am specialist health care i am specialist health care i am specialist health care i am', 0, '2022-09-30 00:53:40', '2022-09-30 04:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `content_management`
--

CREATE TABLE `content_management` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tab1_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tab1_description` text COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_management`
--

INSERT INTO `content_management` (`id`, `page_name`, `tab1_title`, `tab1_description`, `updated_at`) VALUES
(1, 'privacy', 'Privacy Policy', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)hel s</p>', '2022-09-30 04:48:03'),
(2, 'about', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate1', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)123</p>', '2022-09-30 04:49:47'),
(3, 'Terms', 'Terms of Use', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)as sf dfd</p>', '2022-09-30 04:48:36'),
(4, 'why', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)</p>', '2022-09-07 23:54:09'),
(5, 'what', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)</p>', '2022-09-07 23:54:09'),
(6, 'who', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)</p>', '2022-09-07 23:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `faqs_management`
--

CREATE TABLE `faqs_management` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `screen` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `faq_about` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faqs_management`
--

INSERT INTO `faqs_management` (`id`, `title`, `description`, `created_at`, `updated_at`, `category`, `screen`, `faq_about`) VALUES
(1, 'What are ISO standards and why are they important?', '<p>ISO standards in different areas, from pens to aircraft, are created to guarantee quality on a global level. Each of the standards was developed by the International Organization for Standardization (ISO) — an independent, nongovernmental, international organization that unites professionals in their areas to set the standards for the quality of goods or services. </p>\r\n<p>ISO 27001 is the only auditable certification in the world that defines the requirements of an information security management system (ISMS), and it’s the foundation for the standards and rules we adhere to. It covers 14 domains of security to ensure all areas are adequately assessed.</p>', '2022-09-07 05:59:01.000000', '2022-09-28 01:17:19.000000', '1', '', 'Mom'),
(2, 'Is ISO 27001 mandatory?', '<p>No. But since we are aware of the intimate nature of the data you trust us with, we are committed to being proactive when it comes to the security of this information. Therefore, obtaining ISO 27001 certification is the highest priority for Flo. We also believe that our example will empower the whole industry to raise the bar when it comes to security principles.</p>', '2022-09-07 05:59:29.000000', '2022-09-28 01:17:12.000000', '2', '', 'Specialist'),
(3, 'What does the company commit to doing while being ISO 27001 certified?', '<p>By obtaining the ISO 27001 certification, the company commits to protecting three aspects of information:</p>\r\n<ul>\r\n<li><strong>Confidentiality</strong>: Only authorized persons have the right to access information.</li>\r\n<li><strong>Integrity</strong>: Only authorized persons can change the information.</li>\r\n<li><strong>Availability</strong>: The information must be accessible to authorized persons whenever it is needed.</li>\r\n</ul>', '2022-09-07 05:59:48.000000', '2022-09-28 01:17:05.000000', '3', '', 'Mom'),
(4, 'What has Flo done to obtain the ISO certification?', '<p>To become ISO 27001 certified, Flo created new guidelines around security, tested all of our controls across 14 domains, ran comprehensive training for all staff at Flo, and completed rigorous audits performed by external companies. The project took 9 months, and we are happy to say that Flo passed with a score of 100%.</p>', '2022-09-07 06:00:17.000000', '2022-09-28 01:16:51.000000', '4', '', 'Mom'),
(5, 'What does this mean for me and my data?', '<p>Millions of women and people who menstruate around the world trust us with the most intimate information about their health and well-being. Achieving ISO 27001 certification means that Flo protects users’ data against information risks, such as cyberattacks, hacks, data leaks, and theft, at the highest standard possible.</p>', '2022-09-07 06:00:35.000000', '2022-09-28 01:16:43.000000', '5', '', 'Both'),
(6, 'What is ISO 27001?', '<p><a href=\"https://www.nqa.com/en-gb/certification/standards/iso-27001\"><u>ISO 27001</u></a> (Information Security Management) is an international standard and benchmark that audits and assesses all companies’ policies, processes, and safeguards when it comes to data security.</p>', '2022-09-07 06:00:53.000000', '2022-09-28 01:16:35.000000', '6', '', 'Specialist'),
(9, 'What is ISO 27001?', '<p>What does this mean for me and my data?</p>', '2022-09-12 07:27:45.000000', '2022-09-28 01:16:24.000000', '7', '', 'Specialist'),
(10, 'Important information', '<p>Hello,&nbsp;</p>\r\n<p>dsmfomsdfksdmfklsdmf</p>', '2022-09-30 01:03:23.000000', '0000-00-00 00:00:00.000000', '4', '', 'Both');

-- --------------------------------------------------------

--
-- Table structure for table `faq_category`
--

CREATE TABLE `faq_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` int(1) NOT NULL DEFAULT '0' COMMENT '1 = Yes, 0 = No',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faq_category`
--

INSERT INTO `faq_category` (`id`, `name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Postpartum tips', 0, '2022-05-16 11:50:08', '2022-05-16 11:50:08'),
(2, 'Toolkits', 0, '2022-05-16 11:50:08', '2022-05-16 11:50:08'),
(3, 'Specialist Directory ', 0, '2022-05-16 11:50:08', '2022-05-16 11:50:08'),
(4, 'Community', 0, '2022-05-16 11:50:08', '2022-05-16 11:50:08'),
(5, 'Postpartum Plan', 0, '2022-05-16 11:50:08', '2022-05-16 11:50:08'),
(6, 'Health Tracker', 0, '2022-05-16 11:50:08', '2022-05-16 11:50:08'),
(7, 'Accountant', 0, '2022-05-16 11:50:08', '2022-05-16 11:50:08'),
(8, 'kya bat hai ed', 1, '2022-09-30 06:59:41', '2022-09-30 07:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `help_category`
--

CREATE TABLE `help_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `help_category`
--

INSERT INTO `help_category` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(3, 'E-commerce', '<p>Anything related to products and ingredients</p>', '2022-09-21 05:14:59', '2022-09-21 05:18:38'),
(4, 'Postpartum tips', '<p>Your postpartum journey</p>', '2022-09-21 05:16:16', '0000-00-00 00:00:00'),
(5, 'My toolkit', '<p>Basic Postpartum knowledge</p>', '2022-09-21 05:17:06', '0000-00-00 00:00:00'),
(6, 'Specialists directory', '<p>Specialist profiles, badges and levels</p>', '2022-09-21 05:17:56', '2022-09-21 05:23:22'),
(7, 'Lighthouse', '<p>The Motherocity community</p>', '2022-09-21 05:18:30', '0000-00-00 00:00:00'),
(8, 'Postpartum plan', '<p>Plan everything you need during postpartum</p>', '2022-09-21 05:19:13', '0000-00-00 00:00:00'),
(9, 'Health tracker', '<p>Track, analyze and improve your health</p>', '2022-09-21 05:20:04', '0000-00-00 00:00:00'),
(10, 'Account', '<p>Account and profile</p>', '2022-09-21 05:20:34', '0000-00-00 00:00:00'),
(11, 'Data and privacy', '<p>Your data, your choice</p>', '2022-09-21 05:20:57', '0000-00-00 00:00:00'),
(12, 'About Motherocity', '<p>World\'s first postpartum app</p>', '2022-09-21 05:21:44', '0000-00-00 00:00:00'),
(13, 'Ads and promotions', '<p>Specialists ads, promotional profiles and analytics</p>', '2022-09-21 05:22:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `help_list`
--

CREATE TABLE `help_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `help_list`
--

INSERT INTO `help_list` (`id`, `user_id`, `name`, `email`, `subject`, `message`, `category`, `created_at`, `updated_at`) VALUES
(1, 0, 'test', 'test@gmail.com', 'regarding for help', 'gjdbjadmnad am', 0, '2022-09-12 18:00:54', '0000-00-00 00:00:00'),
(2, 2, 'check this', 'as@gmail.com', 'for help', 'hello', 2, '2022-09-12 07:55:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `medical_contact`
--

CREATE TABLE `medical_contact` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `specialist_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialist_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialist_contact` bigint(20) DEFAULT NULL,
  `specialist_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialist_preference` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialist_notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medical_contact`
--

INSERT INTO `medical_contact` (`id`, `postpartum_id`, `postpartum_code`, `specialist_type`, `specialist_name`, `specialist_contact`, `specialist_email`, `specialist_preference`, `specialist_notes`, `created_at`, `updated_at`) VALUES
(1, 2, 418134, 'dsdds', 'dfdfd', 7457457454, 'as@gmail.com', NULL, NULL, '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(2, 3, 354760, 'dsdds', 'dfdfd', 7457457454, 'as@gmail.com', NULL, NULL, '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(3, 4, 845495, 'dsdds', 'dfdfd', 7457457454, 'as@gmail.com', NULL, NULL, '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `my_favorite`
--

CREATE TABLE `my_favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1= content, 2 = specilist, 3 = product',
  `item_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `my_favorite`
--

INSERT INTO `my_favorite` (`id`, `user_id`, `type`, `item_id`, `created_at`) VALUES
(1, 2, 2, 1, '2022-09-26 08:33:14'),
(2, 2, 1, 21, '2022-09-26 08:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `behalf_of` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `message` text COLLATE utf8_unicode_ci,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `other` text COLLATE utf8_unicode_ci,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `behalf_of`, `user_id`, `message`, `is_read`, `other`, `create_date`, `update_date`) VALUES
(4, 11, 2, 'Hello1', 1, 'sasda sadsad dasd', '2022-09-12 12:55:43', '2022-09-12 08:14:49'),
(5, 11, 2, 'Hi', 0, 'sasda sadsad dasd', '2022-09-12 12:55:43', '2022-09-12 08:11:40'),
(6, 11, 2, 'Hello', 0, 'sasda sadsad dasd', '2022-09-12 12:55:43', '2022-09-12 08:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_category`
--

CREATE TABLE `nutrition_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_type` int(11) NOT NULL DEFAULT '0' COMMENT '0=general | 1 = primary | 2 = secondary | 3 = home picked',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = free | 1 = paid',
  `price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hand_picked` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preview` text COLLATE utf8_unicode_ci NOT NULL,
  `related_content` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nutrition_category`
--

INSERT INTO `nutrition_category` (`id`, `title`, `description`, `parent`, `image`, `content_type`, `status`, `price`, `hand_picked`, `preview`, `related_content`, `created_at`, `updated_at`) VALUES
(2, 'sdasd1dd', '<p>sdda1</p>', 1, 'assets/nutrition_catimage/17256711071662534141.png', 1, 0, '0', 'fafas', 'jkknk', '9,7,3', '2022-09-07 02:02:21', '2022-09-12 07:43:46'),
(5, 'yguy', '<p>uyuyuyu</p>', 4, 'assets/nutrition_catimage/13514600701662983502.png', 2, 0, '0', NULL, 'tuyuy', '7,4', '2022-09-12 06:51:42', '2022-09-12 07:43:36'),
(7, 'Nutrition expert', '<p>hi i am your nutrition expert guy</p>', 0, 'assets/nutrition_catimage/6754391691664517173.png', 0, 0, '0', NULL, 'hello how are you ', '30', '2022-09-30 00:52:53', '0000-00-00 00:00:00'),
(8, 'Expect movement to be difficult today', '<p>Expect movement to be difficult today</p>', 0, 'assets/nutrition_catimage/17216420631664528775.png', 1, 0, '0', NULL, 'Expect movement to be difficult today', NULL, '2022-09-30 04:06:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_food`
--

CREATE TABLE `nutrition_food` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `food_preference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_preference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `food_allergies` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `food_locations` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `food_notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nutrition_food`
--

INSERT INTO `nutrition_food` (`id`, `postpartum_id`, `postpartum_code`, `food_preference`, `menu_preference`, `food_allergies`, `food_locations`, `food_notes`, `created_at`, `updated_at`) VALUES
(1, 2, 418134, 'sddsfdf', 'sdsdsd', 'sdasddss', 'ddddd', 'sdasdasdwrewr', '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(2, 3, 354760, 'sddsfdf', 'sdsdsd', 'sdasddss', 'ddddd', 'sdasdasdwrewr', '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(3, 4, 845495, 'sddsfdf', 'sdsdsd', 'sdasddss', 'ddddd', 'sdasdasdwrewr', '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_hydration`
--

CREATE TABLE `nutrition_hydration` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `hydration_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hydration_preference` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hydration_allergies` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hydration_locations` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hydration_notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nutrition_hydration`
--

INSERT INTO `nutrition_hydration` (`id`, `postpartum_id`, `postpartum_code`, `hydration_type`, `hydration_preference`, `hydration_allergies`, `hydration_locations`, `hydration_notes`, `created_at`, `updated_at`) VALUES
(1, 2, 418134, 'fdf', 'dfdf', NULL, NULL, 'sqas', '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(2, 3, 354760, 'fdf', 'dfdf', NULL, NULL, 'sqas', '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(3, 4, 845495, 'fdf', 'dfdf', NULL, NULL, 'sqas', '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_supplements`
--

CREATE TABLE `nutrition_supplements` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `supplement_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplement_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplement_freequency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplement_directions` text COLLATE utf8_unicode_ci,
  `supplement_take_with` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplement_notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nutrition_supplements`
--

INSERT INTO `nutrition_supplements` (`id`, `postpartum_id`, `postpartum_code`, `supplement_name`, `supplement_type`, `supplement_freequency`, `supplement_directions`, `supplement_take_with`, `supplement_notes`, `created_at`, `updated_at`) VALUES
(1, 2, 418134, 'dsadsadasd', 'asasas', 'dsadsd', 'sdsdsd', 'qwater', NULL, '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(2, 3, 354760, 'dsadsadasd', 'asasas', 'dsadsd', 'sdsdsd', 'qwater', NULL, '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(3, 4, 845495, 'dsadsadasd', 'asasas', 'dsadsd', 'sdsdsd', 'qwater', NULL, '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `plan_management`
--

CREATE TABLE `plan_management` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `free_trail_days` int(11) NOT NULL,
  `product_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan_management`
--

INSERT INTO `plan_management` (`id`, `title`, `description`, `price`, `discount`, `free_trail_days`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'Available for beta version only, followed by monthly subscription', '<p>30 days money back guarantee, Reoccurring billing </p>', '8.99', 0, 7, 'monthly', '2022-09-07 10:46:13', '2022-09-07 06:10:37'),
(2, 'Unlimited access for 12 months', '<p>30 day money back guarantee. one-time annual payment...</p>', '2.99', 67, 7, 'yearly1', '0000-00-00 00:00:00', '2022-09-30 02:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `postpartum`
--

CREATE TABLE `postpartum` (
  `id` int(11) NOT NULL,
  `postpartum_code` int(255) DEFAULT NULL,
  `maternity_start` date DEFAULT NULL,
  `maternity_end` date DEFAULT NULL,
  `is_maternity_private` int(11) DEFAULT NULL COMMENT '1=Yes | 0=No',
  `first_weeks` int(11) DEFAULT NULL,
  `patient_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_name_private` int(11) DEFAULT NULL COMMENT '1=Yes | 0=No',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `postpartum`
--

INSERT INTO `postpartum` (`id`, `postpartum_code`, `maternity_start`, `maternity_end`, `is_maternity_private`, `first_weeks`, `patient_name`, `is_name_private`, `created_at`, `updated_at`) VALUES
(1, 312222, '2022-10-10', '2023-02-10', 0, 7, 'user25', 1, '2022-09-09 04:58:14', '2022-09-09 09:58:14'),
(2, 418134, '2022-10-10', '2023-02-10', 0, 7, 'user25', 1, '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(3, 354760, '2022-10-10', '2023-02-10', 0, 7, 'user25', 1, '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(4, 845495, '2022-10-10', '2023-02-10', 0, 7, 'user25', 1, '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `precautions`
--

CREATE TABLE `precautions` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `guest_require` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `before_enter` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `for_holding_baby` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_work` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guest_helping_things` varchar(555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `not_visit_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `precautions`
--

INSERT INTO `precautions` (`id`, `postpartum_id`, `postpartum_code`, `guest_require`, `before_enter`, `for_holding_baby`, `code_work`, `guest_helping_things`, `not_visit_person`, `created_at`, `updated_at`) VALUES
(1, 1, 312222, 'call,text', 'call,knock', 'wash hands,weare mask', 'get lost', 'hold,feed', 'me,myself', '2022-09-09 04:58:14', '2022-09-09 09:58:14'),
(2, 2, 418134, 'call,text', 'call,knock', 'wash hands,weare mask', 'get lost', 'hold,feed', 'me,myself', '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(3, 3, 354760, 'call,text', 'call,knock', 'wash hands,weare mask', 'get lost', 'hold,feed', 'me,myself', '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(4, 4, 845495, 'call,text', 'call,knock', 'wash hands,weare mask', 'get lost', 'hold,feed', 'me,myself', '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `report_bug`
--

CREATE TABLE `report_bug` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report_bug`
--

INSERT INTO `report_bug` (`id`, `user_id`, `subject`, `message`, `category`, `created_at`, `updated_at`) VALUES
(1, 1, 'hfghfghgfhgfhfg', 'gfhgfhgfhfhgfhgf', 10, '2022-09-26 04:49:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `report_category`
--

CREATE TABLE `report_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report_category`
--

INSERT INTO `report_category` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Ads and promotions', '<p>Specialists ads, promotional profiles and analytics</p>', '2022-09-21 05:25:17', '0000-00-00 00:00:00'),
(4, 'About Motherocity', '<p>World\'s first postpartum app</p>', '2022-09-21 05:25:34', '0000-00-00 00:00:00'),
(5, 'Data and privacy', '<p>Your data, your choice</p>', '2022-09-21 05:25:50', '0000-00-00 00:00:00'),
(6, 'Account', '<p>Account and profile</p>', '2022-09-21 05:26:07', '0000-00-00 00:00:00'),
(7, 'Health tracker', '<p>Track, analyze and improve your health</p>', '2022-09-21 05:26:24', '0000-00-00 00:00:00'),
(8, 'Postpartum plan', '<p>Plan everything you need during postpartum</p>', '2022-09-21 05:27:02', '0000-00-00 00:00:00'),
(9, 'Lighthouse', '<p>The Motherocity community</p>', '2022-09-21 05:27:18', '0000-00-00 00:00:00'),
(10, 'Specialists directory', '<p>Specialist profiles, badges and levels</p>', '2022-09-21 05:27:33', '0000-00-00 00:00:00'),
(11, 'My toolkit', '<p>Basic Postpartum knowledge</p>', '2022-09-21 05:27:50', '0000-00-00 00:00:00'),
(12, 'Postpartum tips', '<p>Your postpartum journey</p>', '2022-09-21 05:28:05', '0000-00-00 00:00:00'),
(13, 'Content gallery', '<p>Everything postpartum and more,,,</p>', '2022-09-21 05:28:34', '2022-09-30 01:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `report_image`
--

CREATE TABLE `report_image` (
  `id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report_image`
--

INSERT INTO `report_image` (`id`, `report_id`, `image`, `created_at`) VALUES
(1, 3, '2991385721662988107.jpg', '0000-00-00 00:00:00'),
(2, 3, '16847788081662988107.jpg', '0000-00-00 00:00:00'),
(3, 4, '257012751662988238.png', '2022-09-12 08:10:38'),
(4, 4, '839210731662988238.png', '2022-09-12 08:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `rest_recovery`
--

CREATE TABLE `rest_recovery` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sleep_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sleep_place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sleep_start` datetime DEFAULT NULL,
  `sleep_end` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rest_recovery`
--

INSERT INTO `rest_recovery` (`id`, `postpartum_id`, `postpartum_code`, `name`, `room`, `sleep_type`, `sleep_place`, `sleep_start`, `sleep_end`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 418134, 'sdsdsd', '5', 'nap', 'bad', '2022-09-09 05:00:00', '1969-12-31 18:00:00', 'parent', '2022-09-09 10:38:01', '2022-09-09 10:14:24'),
(2, 2, 418134, 'sdsdsd', '5', 'nap', 'bad', '2022-09-09 05:00:00', '1969-12-31 18:00:00', 'baby', '2022-09-09 11:15:59', '2022-09-09 10:15:41'),
(3, 4, 845495, 'sdsdsd', '5', 'nap', 'bad', '2022-09-09 05:00:00', '2022-09-09 10:00:00', 'baby', '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Collaborators view', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(2, 'Verified Specialist user', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(3, 'Incoming Specialist user', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(4, 'Moms user', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(5, 'Membership view', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(6, 'Specialist category', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(7, 'Specialist subcategory', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(8, 'Nutrition category', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(9, 'Nutrition subcategory', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(10, 'Blog category', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(11, 'Blog subcategory', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(12, 'Blog List', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(13, 'Postpartum view', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(14, 'Content category', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(15, 'Content subcategory', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(16, 'Toolkit category', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(17, 'Toolkit subcategory', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(18, 'Help Faq', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(19, 'Privacy Policy', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(20, 'About', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(21, 'Report Bug list', '2022-09-07 08:01:32', '2022-09-07 08:01:32'),
(22, 'Account faq', '2022-09-07 11:52:38', '2022-09-07 11:52:38'),
(23, 'Terms', '2022-09-07 11:52:38', '2022-09-07 11:52:38'),
(24, 'Roles List', '2022-09-07 11:56:00', '2022-09-07 11:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Sub admin', '24,23,22,21,20,19,18,17,16,15,14,13,12,11,10,8,7,6,5,4,3,2,1', '2022-09-07 05:15:27', '2022-09-29 16:00:51'),
(3, 'Editor', '23,17,16,15,12,11,10', '2022-09-12 22:04:11', '2022-09-30 00:34:57'),
(4, 'Editor', '19,14,12,11,10', '2022-09-17 12:03:35', '2022-09-30 05:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `share_postpartum_plan`
--

CREATE TABLE `share_postpartum_plan` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `share_person_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_person_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1=with_public_details | 2=with_private_details',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `share_postpartum_plan`
--

INSERT INTO `share_postpartum_plan` (`id`, `postpartum_id`, `postpartum_code`, `share_person_name`, `share_person_email`, `share_type`, `created_at`, `updated_at`) VALUES
(1, 2, 418134, 'sdsadd', 'sadsdsd', '1', '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(2, 3, 354760, 'sdsadd', 'sadsdsd', 'baby', '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(3, 4, 845495, 'sdsadd', 'sadsdsd', '1', '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `specialist_category`
--

CREATE TABLE `specialist_category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT '0 = category | other is subcategory',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_type` int(11) NOT NULL DEFAULT '0' COMMENT '0=general | 1 = primary | 2 = secondary | 3= home picked',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = free | 1 = paid',
  `price` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `preview` text COLLATE utf8_unicode_ci,
  `related_content` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `specialist_category`
--

INSERT INTO `specialist_category` (`id`, `title`, `description`, `parent`, `image`, `content_type`, `status`, `price`, `preview`, `related_content`, `created_at`, `updated_at`) VALUES
(1, 'test', '<p>cfdsfcvdsfs</p>', 0, 'assets/specialist_catimage/13399438911662530361.png', 0, 0, '0', 'dfsfsf', 'dfsfsdf', '2022-09-07 00:59:21', '2022-09-07 02:30:14'),
(2, 'check1 ', '<p>sdad1</p>', 0, 'assets/specialist_catimage/20071738931662530488.png', 1, 0, '0', 'asdfafaf1', 'asfaf1', '2022-09-07 01:01:28', '2022-09-07 02:30:03'),
(3, 'testsubcat1', '<p>csacsac</p>', 2, 'assets/specialist_catimage/17837919921662532103.png', 1, 1, '12', 'sdad', 'sda', '2022-09-07 01:28:23', '2022-09-07 01:40:12'),
(4, 'sdad', '<p>sdad</p>', 1, 'assets/specialist_catimage/4829881821662532300.png', 0, 1, '3424', 'czxc', 'czxc', '2022-09-07 01:31:40', '0000-00-00 00:00:00'),
(8, 'check2', '<p>fdsfdsffd</p>', 0, 'assets/specialist_catimage/16981866301662985888.png', 0, 0, '0', NULL, NULL, '2022-09-12 07:31:04', '2022-09-12 07:31:28'),
(9, 'ACTION', '<p>ghghjghj</p>', 2, 'assets/specialist_catimage/7364691841662985944.jpg', 0, 0, '0', NULL, NULL, '2022-09-12 07:32:08', '2022-09-12 07:32:24'),
(11, 'subspeclaist', '<p>helol&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>I am subspecialist here&nbsp;</p>', 10, 'assets/specialist_catimage/901544801664516715.jpg', 0, 0, '0', NULL, NULL, '2022-09-30 00:45:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stage_management`
--

CREATE TABLE `stage_management` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `short_title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_days` int(11) NOT NULL,
  `end_days` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stage_management`
--

INSERT INTO `stage_management` (`id`, `title`, `short_title`, `description`, `start_days`, `end_days`, `created_at`, `updated_at`) VALUES
(1, 'Discovery', 'from 6 month to 9 months', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Massa fames elit, morbi eget purus facilisi amet.</p>', 180, 270, '2022-09-08 05:40:57', '2022-09-21 05:13:35'),
(2, 'Acceptance', 'from 3 month to 6 months', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Massa fames elit, morbi eget purus facilisi amet.</p>', 90, 180, '2022-09-08 05:46:13', '2022-09-21 05:13:29'),
(3, 'Connection', 'from 1 month to 3 months', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Massa fames elit, morbi eget purus facilisi amet.</p>', 30, 90, '2022-09-08 05:47:11', '2022-09-21 05:13:21'),
(4, 'Homecoming', 'from discharges to 1 months', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Massa fames elit, morbi eget purus facilisi amet.</p>', 0, 30, '2022-09-08 05:48:28', '2022-09-21 05:13:14'),
(5, 'Inspiration', 'from 9 months to 12 months', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Massa fames elit, morbi eget purus facilisi amet.das</p>', 270, 365, '2022-09-21 05:12:53', '2022-09-30 01:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionplaystore`
--

CREATE TABLE `subscriptionplaystore` (
  `id` int(111) NOT NULL,
  `name` varchar(111) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscriptionplaystore`
--

INSERT INTO `subscriptionplaystore` (`id`, `name`) VALUES
(1, '1664543023'),
(2, '1664543040'),
(3, '1664543043'),
(4, '1664544313');

-- --------------------------------------------------------

--
-- Table structure for table `support_person`
--

CREATE TABLE `support_person` (
  `id` int(11) NOT NULL,
  `postpartum_id` int(11) DEFAULT NULL,
  `postpartum_code` int(11) DEFAULT NULL,
  `supporter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supporter_relation` text COLLATE utf8_unicode_ci,
  `supporter_number` bigint(20) DEFAULT NULL,
  `supporter_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supporter_note` text COLLATE utf8_unicode_ci,
  `is_supporter_note_private` int(11) DEFAULT NULL COMMENT '1=yes|0=No',
  `supporter_permission` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `support_person`
--

INSERT INTO `support_person` (`id`, `postpartum_id`, `postpartum_code`, `supporter_name`, `supporter_relation`, `supporter_number`, `supporter_email`, `supporter_note`, `is_supporter_note_private`, `supporter_permission`, `created_at`, `updated_at`) VALUES
(1, 1, 312222, 'user22', 'friend', 7845784578, 'Admins@gmail.com', 'fdsafsdtyursdrtus', 1, 'dkhgf gfkjdgfd, gkjfgdksjf', '2022-09-09 04:58:14', '2022-09-09 09:58:14'),
(2, 2, 418134, 'user22', 'friend', 7845784578, 'Admins@gmail.com', 'fdsafsdtyursdrtus', 1, 'dkhgf gfkjdgfd, gkjfgdksjf', '2022-09-09 05:14:24', '2022-09-09 10:14:24'),
(3, 3, 354760, 'user22', 'friend', 7845784578, 'Admins@gmail.com', 'fdsafsdtyursdrtus', 1, 'dkhgf gfkjdgfd, gkjfgdksjf', '2022-09-09 05:15:41', '2022-09-09 10:15:41'),
(4, 4, 845495, 'user22', 'friend', 7845784578, 'Admins@gmail.com', 'fdsafsdtyursdrtus', 1, 'dkhgf gfkjdgfd, gkjfgdksjf', '2022-09-09 05:37:30', '2022-09-09 10:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `tips_management`
--

CREATE TABLE `tips_management` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `is_free` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '1=yes,0=no',
  `price` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `blog_id` int(10) NOT NULL,
  `week_no` int(11) NOT NULL,
  `days` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `preview` text COLLATE utf8_unicode_ci NOT NULL,
  `related_content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `tips_date` date NOT NULL DEFAULT '0000-00-00',
  `updated_at` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tips_management`
--

INSERT INTO `tips_management` (`id`, `title`, `description`, `is_free`, `price`, `blog_id`, `week_no`, `days`, `preview`, `related_content`, `created_at`, `tips_date`, `updated_at`) VALUES
(16, 'Expect movement to be difficult today', '', '', '', 0, 1, '1', 'Expect movement to be difficult today from hip, pelvis, and delivery site pain and discomfort.', NULL, '2022-09-30 04:02:59.000000', '0000-00-00', '0000-00-00 00:00:00.000000'),
(21, 'Bleeding is normal following delivery but', '', '', '', 0, 1, '2', 'Bleeding is normal following delivery but you should keep an eye out for clotting and the size of the clot. ', NULL, '2022-09-30 11:32:48.000000', '0000-00-00', '0000-00-00 00:00:00.000000'),
(22, 'Postpartum cramping happens as your uterus returns to its pre-pregnancy size. ', '', '', '', 0, 1, '3', 'Postpartum cramping happens as your uterus returns to its pre-pregnancy size. The cramps should disappear within 1-2 weeks.', NULL, '2022-09-30 11:34:28.000000', '0000-00-00', '0000-00-00 00:00:00.000000'),
(23, 'Change in Hormone Levels may be raising your body temps ', '', '', '', 0, 1, '4', 'Change in Hormone Levels may be raising your body temps and making you sweaty day and night. You will still need to avoid submerging in bath water.\r\nShowers and sponge baths are best for refreshing.', NULL, '2022-10-01 00:08:34.000000', '0000-00-00', '0000-00-00 00:00:00.000000'),
(24, 'Incisions and vagina may be more painful and itchy', '', '', '', 0, 2, '1', 'Incisions and vagina may be more painful and itchy than your first days after childbirth while you are healing.', NULL, '2022-10-01 00:10:02.000000', '0000-00-00', '0000-00-00 00:00:00.000000'),
(25, 'Breastfeeding may help reduce postpartum bleeding', '', '', '', 0, 2, '2', 'Breastfeeding may help reduce postpartum bleeding as the process releases natural Oxytocin that encourages uterine contraction and the uterus to return to its normal size.', NULL, '2022-10-01 00:16:14.000000', '0000-00-00', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `toolkit`
--

CREATE TABLE `toolkit` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `preview` text COLLATE utf8_unicode_ci NOT NULL,
  `related_content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `toolkit`
--

INSERT INTO `toolkit` (`id`, `title`, `description`, `parent`, `preview`, `related_content`, `created_at`, `updated_at`) VALUES
(1, 'tedtsd', 'sdfsf', 0, 'dsfsdf', 'dsfsdf', '2022-09-06 16:37:27', '0000-00-00 00:00:00'),
(2, 'check1', '<p>dsfs1</p>', 0, 'dfsfsdf1', 'fsfdsf1', '2022-09-06 06:15:58', '2022-09-06 06:21:56'),
(3, 'subcate1', '<p>cscdsc1</p>', 1, 'dscfsc1', 'dfsf1', '2022-09-06 06:29:23', '2022-09-06 06:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_id` text COLLATE utf8_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `plan_id`, `amount`, `transaction_id`, `start_date`, `end_date`, `created_at`) VALUES
(1, 67, 2, 3, '1234', '2022-09-23', '2022-10-23', '2022-09-23 06:19:02'),
(2, 66, 2, 3, '1234', '2022-09-23', '2022-10-23', '2022-09-23 06:19:02'),
(3, 69, 1, 9, '1234', '2022-09-23', '2022-10-23', '2022-09-23 09:00:00'),
(4, 1, 1, 9, '1234', '2022-09-26', '2022-10-26', '2022-09-26 02:20:54'),
(5, 4, 1, 9, '1234', '2022-09-27', '2022-10-27', '2022-09-27 02:49:39'),
(6, 8, 2, 3, '1234', '2022-09-27', '2023-09-27', '2022-09-27 07:13:16'),
(7, 8, 1, 9, '1234', '2022-09-27', '2022-10-27', '2022-09-27 07:15:36'),
(8, 8, 1, 9, '1234', '2022-09-27', '2022-10-27', '2022-09-27 07:16:27'),
(9, 9, 2, 3, '1234', '2022-09-28', '2023-09-28', '2022-09-28 00:19:42'),
(10, 10, 1, 9, '{\"product_id\":\"monthly\",\"purchaseId\":\"GPA.3397-2363-9939-29071\",\"serverVerificationData\":\"gioblbdbaaehkkgmoggfidbd.AO-J1OzajByhiPUcIKe6ZPk-ypFW7n4aaJENoVSySioMIfehzy6mT6l826L7RNIuFx_TYZDgZH0h2wP8XTWZ9', '2022-09-28', '2022-10-28', '2022-09-28 08:25:44'),
(11, 17, 1, 9, '{\"product_id\":\"monthly\",\"purchaseId\":\"GPA.3329-1577-4431-85828\",\"serverVerificationData\":\"biclmcofajdplfmgomgpemai.AO-J1OyQEvG49tjdIY2hEAU35co21lygVn0EodpvsOsw6rBAFY8OAEyo39H83sChYfQdT50uv-GWeVqT1iuKOY_35EKVqUu2fQ\",\"localVerificationData\":\"{\\\"orderId\\\":\\\"GPA.3329-1577-4431-85828\\\",\\\"packageName\\\":\\\"com.app.motherocity\\\",\\\"productId\\\":\\\"monthly\\\",\\\"purchaseTime\\\":1664543634926,\\\"purchaseState\\\":0,\\\"purchaseToken\\\":\\\"biclmcofajdplfmgomgpemai.AO-J1OyQEvG49tjdIY2hEAU35co21lygVn0EodpvsOsw6rBAFY8OAEyo39H83sChYfQdT50uv-GWeVqT1iuKOY_35EKVqUu2fQ\\\",\\\"quantity\\\":1,\\\"autoRenewing\\\":true,\\\"acknowledged\\\":false}\",\"source\":\"google_play\"}', '2022-09-30', '2022-10-30', '2022-09-30 08:14:02'),
(12, 11, 1, 9, '{\"product_id\":\"monthly\",\"purchaseId\":\"GPA.3374-6802-1399-86811\",\"serverVerificationData\":\"iilgnieegidfaipjlmahjghd.AO-J1OyGTwy5-Adq5p0oO7xwTnOEyEQqild2lcvTDWQgwRCdUkNwW0nL79TOwzWsRIhLsTBtodoLA4pf33_ZKiXgTNTb_iU9Dw\",\"localVerificationData\":\"{\\\"orderId\\\":\\\"GPA.3374-6802-1399-86811\\\",\\\"packageName\\\":\\\"com.app.motherocity\\\",\\\"productId\\\":\\\"monthly\\\",\\\"purchaseTime\\\":1664601841029,\\\"purchaseState\\\":0,\\\"purchaseToken\\\":\\\"iilgnieegidfaipjlmahjghd.AO-J1OyGTwy5-Adq5p0oO7xwTnOEyEQqild2lcvTDWQgwRCdUkNwW0nL79TOwzWsRIhLsTBtodoLA4pf33_ZKiXgTNTb_iU9Dw\\\",\\\"quantity\\\":1,\\\"autoRenewing\\\":true,\\\"acknowledged\\\":false}\",\"source\":\"google_play\"}', '2022-10-01', '2022-10-31', '2022-10-01 00:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'assets/profile_image/dummy-profile-pic.png',
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(110) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_withcode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_phone_verified` int(11) NOT NULL DEFAULT '0' COMMENT '0=pending,1=verified',
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `otp` int(11) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '1 = specialist | 2 = mom',
  `is_verified` int(10) NOT NULL DEFAULT '0' COMMENT '0=incoming,1=verified',
  `status` int(11) DEFAULT '1' COMMENT '0=block,1=active',
  `birth_type_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `your_expertise` int(11) NOT NULL DEFAULT '0',
  `your_speciality` int(11) NOT NULL DEFAULT '0',
  `year_experience` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_hours` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `office_days` text COLLATE utf8_unicode_ci,
  `office_area` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `your_website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `certification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fees` int(100) NOT NULL,
  `insurance` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_contact` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `few_word` text COLLATE utf8_unicode_ci NOT NULL,
  `why_should_call` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `residency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `was_your_birth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `via_baby_born` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_type` int(1) NOT NULL DEFAULT '1' COMMENT '1 = private, 2 = public',
  `profile_color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_profile_complete` int(1) NOT NULL DEFAULT '0' COMMENT '1 = Yes, 0 = No',
  `is_deactive` int(1) NOT NULL DEFAULT '0' COMMENT '1 = Yes, 0 = No',
  `is_delete` int(1) NOT NULL DEFAULT '0' COMMENT '1 = Yes, 0 = No',
  `current_week` int(11) NOT NULL DEFAULT '1',
  `week_start_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_image`, `password`, `country`, `phone`, `phone_withcode`, `is_phone_verified`, `token`, `otp`, `user_type`, `is_verified`, `status`, `birth_type_id`, `plan_id`, `your_expertise`, `your_speciality`, `year_experience`, `office_hours`, `office_days`, `office_area`, `your_website`, `certification`, `fees`, `insurance`, `primary_contact`, `few_word`, `why_should_call`, `residency`, `delivery_date`, `was_your_birth`, `via_baby_born`, `lang`, `lat`, `lng`, `profile_type`, `profile_color`, `is_profile_complete`, `is_deactive`, `is_delete`, `current_week`, `week_start_date`, `created_at`, `updated_at`) VALUES
(1, 'mizan rehman', 'mizan.webwiders@gmail.com', '', '123456', NULL, '9424081993', '+919424081993', 1, '718060c065d93b600f7fd16d4f935075', 0, 1, 1, 1, 0, 1, 2, 9, '3', '9:00-5:00', 'Mon - Sat', 'navlakha', 'https://www.webwiders.com', NULL, 500, 'Yes', 'Whatsapp', 'not workxcs', NULL, NULL, NULL, NULL, NULL, 'en', '0', '0', 1, NULL, 1, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'ameen', 'ameen.webwiders@gmail.com', '', '123456', NULL, '9200293078', '+919200293078', 1, '', 1234, 2, 1, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', 'hello test', 'Indore', '2022-08-08', 'birth your', 'baby born', 'en', '3.081826', '101.676613', 1, NULL, 1, 0, 0, 3, '2022-10-11', '2022-09-27 00:24:23', '0000-00-00 00:00:00'),
(4, 'Mizan check', 'mizannitdgp@gmail.com', 'assets/profile_image/dummy-profile-pic.png', '123456', NULL, '9424141414', '+919424141414', 1, 'dbe7f30c1b66a14a3d9263c7987a9a9f', 1234, 1, 0, 1, 0, 1, 2, 9, '4', '8:00 - 5:00', 'Tue - friday', 'Indore, Madhya Pradesh, India', 'https://www.facebook.com', 'mmbb', 500, 'Yes', 'Whatsapp', 'jdjdjdjdjdj idjdjd ', NULL, NULL, NULL, NULL, NULL, 'en', '22.7195687', '75.8577258', 1, NULL, 1, 0, 0, 1, NULL, '2022-09-27 02:49:09', '0000-00-00 00:00:00'),
(5, NULL, 'mizanTest@gmail.com', 'assets/profile_image/dummy-profile-pic.png', '12345678', NULL, '9494949494', '+919494949494', 0, '', 1234, 2, 0, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'en', NULL, NULL, 1, NULL, 0, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, NULL, 'mother@gmail.com', 'assets/profile_image/dummy-profile-pic.png', '12345678', NULL, '9424081995', '+919424081995', 0, '', 1234, 2, 0, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'en', NULL, NULL, 1, NULL, 0, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, NULL, 'mother@gmail.com', 'assets/profile_image/dummy-profile-pic.png', '12345678', NULL, '9424081996', '+919424081996', 0, '', 1234, 2, 0, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'hi', NULL, NULL, 1, NULL, 0, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'fsfsdsdfsfddsf', 'mother@gmail.com', 'https://dummyimage.com/600x600/E2EFFF/E2EFFF.png', '123456', NULL, '9494949495', '+919494949495', 1, '', 1234, 2, 1, 1, 0, 1, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, 'sdfds', '2022-09-27', 'sdfdsf', 'sdfsdf', 'hi', '0', '0', 1, NULL, 1, 0, 0, 1, '2022-09-27', '2022-09-27 07:08:04', '0000-00-00 00:00:00'),
(9, 'mizan 1 testing', 'mother1@gmail.com', 'https://dummyimage.com/600x600/B6EFBF/B6EFBF.png', '123456', NULL, '919491949194', '+91919491949194', 1, '', 1234, 2, 1, 1, 0, 2, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, 'navlakha', '2022-09-28', 'yes', 'noasd', 'en', '0', '0', 1, NULL, 1, 0, 0, 1, '2022-09-28', '2022-09-28 00:17:58', '0000-00-00 00:00:00'),
(10, 'mizan', 'mizan@gmail.com', 'https://dummyimage.com/600x600/E5DAFF/E5DAFF.png', '123456', NULL, '9494941212', '+919494941212', 1, '', 1234, 2, 1, 1, 0, 1, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, 'mizoram', '2022-09-16', 'kkkkk', 'mmmm', 'en', '0.0', '0.0', 1, NULL, 1, 0, 0, 1, '2022-09-28', '2022-09-28 08:25:03', '0000-00-00 00:00:00'),
(11, NULL, 'helloaliyanj@gmail.com', 'assets/profile_image/dummy-profile-pic.png', 'Maj4096453-9', NULL, '3057479465', '+923057479465', 0, '', 1234, 2, 0, 1, 0, 1, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'en', NULL, NULL, 1, NULL, 0, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, NULL, 'helloaliyanj@gmail.com', 'assets/profile_image/dummy-profile-pic.png', 'Maj4096453-9', NULL, '3057479465', '+923057479465', 0, '', 1234, 2, 0, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'en', NULL, NULL, 1, NULL, 0, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, NULL, 'helloaliyanj@gmail.com ', 'assets/profile_image/dummy-profile-pic.png', 'Maj4096453-9', NULL, '3057479465', '+923057479465', 0, '', 1234, 2, 0, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'en', NULL, NULL, 1, NULL, 0, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Aliyan', 'helloaliyanj@gmail.com', 'https://dummyimage.com/600x600/E5DAFF/E5DAFF.png', 'Maj4096453-9', NULL, '7878773709', '+447878773709', 1, '', 1234, 2, 1, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, 'london', '2022-07-25', 'Normal', 'C- Section', 'en', '0.0', '0.0', 2, NULL, 1, 0, 0, 1, '2022-09-30', '2022-09-30 07:51:27', '0000-00-00 00:00:00'),
(15, NULL, 'helloaliyanj@gmail.com', 'assets/profile_image/dummy-profile-pic.png', 'Maj4096453-9', NULL, '7878773709', '+447878773709', 0, '', 1234, 2, 0, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'en', NULL, NULL, 1, NULL, 0, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, NULL, 'ameen.webwihhders@gmail.com', 'assets/profile_image/dummy-profile-pic.png', '123456', NULL, '9200293078', '+919200293078', 0, '', 6460, 2, 0, 1, 0, 0, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 'en', NULL, NULL, 1, NULL, 0, 0, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Aliyan', 'helloaliyanj@gmail.com', 'https://dummyimage.com/600x600/E5DAFF/E5DAFF.png', 'Maj4096453-9', NULL, '7878773709', '+447878773709', 1, '', 9012, 2, 1, 1, 0, 1, 0, 0, NULL, '', NULL, NULL, '', NULL, 0, NULL, '', '', NULL, 'London, UK', '2022-07-25', 'Normal', 'C-Sections', 'en', '51.5072178', '-0.1275862', 1, NULL, 1, 0, 0, 1, '2022-09-30', '2022-09-30 08:13:21', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_faqs`
--
ALTER TABLE `account_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `birth_type`
--
ALTER TABLE `birth_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_management`
--
ALTER TABLE `blog_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `caretaker`
--
ALTER TABLE `caretaker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postpartum_key2` (`postpartum_id`);

--
-- Indexes for table `code_phrases`
--
ALTER TABLE `code_phrases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_category`
--
ALTER TABLE `contact_us_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_blog`
--
ALTER TABLE `content_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_management`
--
ALTER TABLE `content_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs_management`
--
ALTER TABLE `faqs_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_category`
--
ALTER TABLE `faq_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_category`
--
ALTER TABLE `help_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_list`
--
ALTER TABLE `help_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_contact`
--
ALTER TABLE `medical_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_favorite`
--
ALTER TABLE `my_favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_category`
--
ALTER TABLE `nutrition_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_food`
--
ALTER TABLE `nutrition_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_hydration`
--
ALTER TABLE `nutrition_hydration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_supplements`
--
ALTER TABLE `nutrition_supplements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_management`
--
ALTER TABLE `plan_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postpartum`
--
ALTER TABLE `postpartum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `precautions`
--
ALTER TABLE `precautions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postpartum_key1` (`postpartum_id`);

--
-- Indexes for table `report_bug`
--
ALTER TABLE `report_bug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_category`
--
ALTER TABLE `report_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_image`
--
ALTER TABLE `report_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_recovery`
--
ALTER TABLE `rest_recovery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_postpartum_plan`
--
ALTER TABLE `share_postpartum_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialist_category`
--
ALTER TABLE `specialist_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stage_management`
--
ALTER TABLE `stage_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptionplaystore`
--
ALTER TABLE `subscriptionplaystore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_person`
--
ALTER TABLE `support_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postpartum_key` (`postpartum_id`);

--
-- Indexes for table `tips_management`
--
ALTER TABLE `tips_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toolkit`
--
ALTER TABLE `toolkit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
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
-- AUTO_INCREMENT for table `account_faqs`
--
ALTER TABLE `account_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `birth_type`
--
ALTER TABLE `birth_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_management`
--
ALTER TABLE `blog_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `caretaker`
--
ALTER TABLE `caretaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `code_phrases`
--
ALTER TABLE `code_phrases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us_category`
--
ALTER TABLE `contact_us_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `content_blog`
--
ALTER TABLE `content_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `content_management`
--
ALTER TABLE `content_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `faqs_management`
--
ALTER TABLE `faqs_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faq_category`
--
ALTER TABLE `faq_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `help_category`
--
ALTER TABLE `help_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `help_list`
--
ALTER TABLE `help_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medical_contact`
--
ALTER TABLE `medical_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `my_favorite`
--
ALTER TABLE `my_favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nutrition_category`
--
ALTER TABLE `nutrition_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nutrition_food`
--
ALTER TABLE `nutrition_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nutrition_hydration`
--
ALTER TABLE `nutrition_hydration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nutrition_supplements`
--
ALTER TABLE `nutrition_supplements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plan_management`
--
ALTER TABLE `plan_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postpartum`
--
ALTER TABLE `postpartum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `precautions`
--
ALTER TABLE `precautions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `report_bug`
--
ALTER TABLE `report_bug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report_category`
--
ALTER TABLE `report_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `report_image`
--
ALTER TABLE `report_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rest_recovery`
--
ALTER TABLE `rest_recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `share_postpartum_plan`
--
ALTER TABLE `share_postpartum_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specialist_category`
--
ALTER TABLE `specialist_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stage_management`
--
ALTER TABLE `stage_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subscriptionplaystore`
--
ALTER TABLE `subscriptionplaystore`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_person`
--
ALTER TABLE `support_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tips_management`
--
ALTER TABLE `tips_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `toolkit`
--
ALTER TABLE `toolkit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `caretaker`
--
ALTER TABLE `caretaker`
  ADD CONSTRAINT `postpartum_key2` FOREIGN KEY (`postpartum_id`) REFERENCES `postpartum` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `precautions`
--
ALTER TABLE `precautions`
  ADD CONSTRAINT `postpartum_key1` FOREIGN KEY (`postpartum_id`) REFERENCES `postpartum` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `support_person`
--
ALTER TABLE `support_person`
  ADD CONSTRAINT `postpartum_key` FOREIGN KEY (`postpartum_id`) REFERENCES `postpartum` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
