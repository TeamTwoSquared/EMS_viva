-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2018 at 09:02 AM
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
-- Database: `ems2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(175) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilepic` varchar(255) NOT NULL DEFAULT 'noimage.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `email`, `password`, `profilepic`) VALUES
(1, 'EMSAdmin', 'admin@ems.dv', '43c7ccde32edd2953c918c3e0c60578b', 'sajun_1536069464.JPG'),
(2, 'EMSAdming', 'admin@ems.dv', '81dc9bdb52d04dc20036dbd8313ed055', 'noimage.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ad_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `isapprove` int(2) NOT NULL DEFAULT '0',
  `type` int(2) NOT NULL DEFAULT '0',
  `numberOfclicks` int(11) NOT NULL DEFAULT '0',
  `impressions` int(11) NOT NULL DEFAULT '0',
  `force_factor` int(2) NOT NULL DEFAULT '0',
  `service_provider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ads_images`
--

CREATE TABLE `ads_images` (
  `ad_id` int(11) NOT NULL,
  `imgurl` varchar(175) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `service_provider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `catergories`
--

CREATE TABLE `catergories` (
  `catergory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `numberOftemplates` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catergories`
--

INSERT INTO `catergories` (`catergory_id`, `name`, `numberOftemplates`) VALUES
(1, 'cat1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `catergory_templates`
--

CREATE TABLE `catergory_templates` (
  `catergory_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catergory_templates`
--

INSERT INTO `catergory_templates` (`catergory_id`, `template_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `massege` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chattings`
--

CREATE TABLE `chattings` (
  `service_provider_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chatting_customers`
--

CREATE TABLE `chatting_customers` (
  `customer_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `customer_id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `isverified` int(2) NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `profilepic` varchar(255) NOT NULL DEFAULT 'noimage.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_events`
--

CREATE TABLE `customer_events` (
  `customer_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `lastChangetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_event_templates`
--

CREATE TABLE `customer_event_templates` (
  `customer_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_task_payments`
--

CREATE TABLE `customer_task_payments` (
  `customer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_template_tasks`
--

CREATE TABLE `customer_template_tasks` (
  `customer_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `istemp` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_templates`
--

CREATE TABLE `event_templates` (
  `event_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_temps`
--

CREATE TABLE `event_temps` (
  `event_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `notification` text NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `to_whome` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `isrelease` int(2) NOT NULL DEFAULT '0',
  `ispaid` int(2) NOT NULL DEFAULT '0',
  `isdispute` int(2) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  `released_date` date DEFAULT NULL,
  `customer_feedback` int(2) NOT NULL DEFAULT '0',
  `service_provider_feedback` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviewings`
--

CREATE TABLE `reviewings` (
  `service_provider_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `numberOfstars` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_booking_services`
--

CREATE TABLE `serviceprovider_booking_services` (
  `service_provider_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_task_services`
--

CREATE TABLE `serviceprovider_task_services` (
  `service_provider_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `isavailable` int(2) NOT NULL DEFAULT '1',
  `service_provider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_customer_bookings`
--

CREATE TABLE `service_customer_bookings` (
  `service_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_daytimes`
--

CREATE TABLE `service_daytimes` (
  `service_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_images`
--

CREATE TABLE `service_images` (
  `service_id` int(11) NOT NULL,
  `imgurl` varchar(175) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_keywords`
--

CREATE TABLE `service_keywords` (
  `service_id` int(11) NOT NULL,
  `keyword` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_locations`
--

CREATE TABLE `service_locations` (
  `service_id` int(11) NOT NULL,
  `location` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `service_provider_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `level` int(2) NOT NULL DEFAULT '0',
  `isverified` int(2) NOT NULL DEFAULT '0',
  `isonline` int(2) NOT NULL DEFAULT '0',
  `isdeleted` int(2) NOT NULL DEFAULT '0',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT NULL,
  `profilepic` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `activation_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`service_provider_id`, `name`, `username`, `password`, `email`, `address`, `level`, `isverified`, `isonline`, `isdeleted`, `reg_date`, `last_login`, `profilepic`, `activation_link`) VALUES
(1, 'svp1', 'svp1', 'e10adc3949ba59abbe56e057f20f883e', 'svp1@gmail.com', NULL, 0, 0, 0, 0, '2018-08-31 07:32:08', '2018-08-31 13:02:08', 'noimage.jpg', 'bYpAHoy90udtIOYyAOIwRXyU87bk3i4GTd4VzPHG'),
(2, 'svp2', 'svp2', 'e10adc3949ba59abbe56e057f20f883e', 'svp2@gmail.com', NULL, 0, 0, 0, 0, '2018-09-04 08:05:30', NULL, 'noimage.jpg', 'wJX3tuHlLEtO0iQAXlWKj7o14RjxiyyWP7sCELFZ'),
(3, 'svp3', 'svp3', 'e10adc3949ba59abbe56e057f20f883e', 'svp3@gmail.com', NULL, 0, 1, 0, 0, '2018-09-04 08:07:07', NULL, 'noimage.jpg', 'DjETcI3ipJCNGkR4yttTq1SDK5X9QG10PXHA0Uot');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_keywords`
--

CREATE TABLE `service_provider_keywords` (
  `service_provider_id` int(11) NOT NULL,
  `keyword` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_tels`
--

CREATE TABLE `service_provider_tels` (
  `service_provider_id` int(11) NOT NULL,
  `tel` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_task_customers`
--

CREATE TABLE `service_task_customers` (
  `service_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `service_id` int(11) NOT NULL,
  `type` varchar(75) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_videos`
--

CREATE TABLE `service_videos` (
  `service_id` int(11) NOT NULL,
  `videourl` varchar(175) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `site_fees`
--

CREATE TABLE `site_fees` (
  `site_fee_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `ispaid` int(2) NOT NULL DEFAULT '0',
  `payment_date` date NOT NULL,
  `recurring_period` varchar(15) NOT NULL,
  `next_billing_date` date NOT NULL,
  `service_provider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `support_requests`
--

CREATE TABLE `support_requests` (
  `support_request_id` int(11) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `request` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `support_request_attachements`
--

CREATE TABLE `support_request_attachements` (
  `support_request_id` int(11) NOT NULL,
  `attachement_url` varchar(175) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `istemp` int(2) NOT NULL DEFAULT '0',
  `timeduration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_keywords`
--

CREATE TABLE `task_keywords` (
  `task_id` int(11) NOT NULL,
  `keyword` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_temps`
--

CREATE TABLE `task_temps` (
  `task_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `template_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `istemp` int(2) NOT NULL DEFAULT '0',
  `timeduration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`template_id`, `name`, `description`, `istemp`, `timeduration`) VALUES
(1, 'temp1', 'my first template', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_keywords`
--

CREATE TABLE `template_keywords` (
  `template_id` int(11) NOT NULL,
  `keyword` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `template_tasks`
--

CREATE TABLE `template_tasks` (
  `template_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `template_temps`
--

CREATE TABLE `template_temps` (
  `template_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `service_provider_id` (`service_provider_id`);

--
-- Indexes for table `ads_images`
--
ALTER TABLE `ads_images`
  ADD PRIMARY KEY (`ad_id`,`imgurl`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `booking_ibfk_1` (`service_provider_id`);

--
-- Indexes for table `catergories`
--
ALTER TABLE `catergories`
  ADD PRIMARY KEY (`catergory_id`);

--
-- Indexes for table `catergory_templates`
--
ALTER TABLE `catergory_templates`
  ADD PRIMARY KEY (`template_id`,`catergory_id`),
  ADD KEY `catergory_templates_ibfk_1` (`catergory_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chattings`
--
ALTER TABLE `chattings`
  ADD PRIMARY KEY (`service_provider_id`,`customer_id`,`chat_id`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `chatting_customers`
--
ALTER TABLE `chatting_customers`
  ADD PRIMARY KEY (`customer_id`,`chat_id`,`customer_id2`),
  ADD KEY `chat_id` (`chat_id`),
  ADD KEY `chatting2_ibfk_3` (`customer_id2`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_events`
--
ALTER TABLE `customer_events`
  ADD PRIMARY KEY (`customer_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `customer_event_templates`
--
ALTER TABLE `customer_event_templates`
  ADD PRIMARY KEY (`customer_id`,`event_id`,`template_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `customer_task_payments`
--
ALTER TABLE `customer_task_payments`
  ADD PRIMARY KEY (`customer_id`,`payment_id`,`service_id`,`service_provider_id`,`task_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `service_provider_id` (`service_provider_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `customer_template_tasks`
--
ALTER TABLE `customer_template_tasks`
  ADD PRIMARY KEY (`customer_id`,`template_id`,`task_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_templates`
--
ALTER TABLE `event_templates`
  ADD PRIMARY KEY (`event_id`,`template_id`),
  ADD KEY `event_template_ibfk_2` (`template_id`);

--
-- Indexes for table `event_temps`
--
ALTER TABLE `event_temps`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `reviewings`
--
ALTER TABLE `reviewings`
  ADD PRIMARY KEY (`service_provider_id`,`service_id`,`customer_id`,`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `review_id` (`review_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `serviceprovider_booking_services`
--
ALTER TABLE `serviceprovider_booking_services`
  ADD PRIMARY KEY (`service_provider_id`,`booking_id`,`service_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `serviceprovider_task_services`
--
ALTER TABLE `serviceprovider_task_services`
  ADD PRIMARY KEY (`service_provider_id`,`task_id`,`service_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `service_provider_id` (`service_provider_id`);

--
-- Indexes for table `service_customer_bookings`
--
ALTER TABLE `service_customer_bookings`
  ADD PRIMARY KEY (`service_id`,`customer_id`,`booking_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `service_daytimes`
--
ALTER TABLE `service_daytimes`
  ADD PRIMARY KEY (`service_id`,`day`,`stime`,`etime`);

--
-- Indexes for table `service_images`
--
ALTER TABLE `service_images`
  ADD PRIMARY KEY (`service_id`,`imgurl`);

--
-- Indexes for table `service_keywords`
--
ALTER TABLE `service_keywords`
  ADD PRIMARY KEY (`service_id`,`keyword`);

--
-- Indexes for table `service_locations`
--
ALTER TABLE `service_locations`
  ADD PRIMARY KEY (`service_id`,`location`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`service_provider_id`);

--
-- Indexes for table `service_provider_keywords`
--
ALTER TABLE `service_provider_keywords`
  ADD PRIMARY KEY (`service_provider_id`,`keyword`);

--
-- Indexes for table `service_provider_tels`
--
ALTER TABLE `service_provider_tels`
  ADD PRIMARY KEY (`service_provider_id`,`tel`);

--
-- Indexes for table `service_task_customers`
--
ALTER TABLE `service_task_customers`
  ADD PRIMARY KEY (`service_id`,`task_id`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`service_id`,`type`);

--
-- Indexes for table `service_videos`
--
ALTER TABLE `service_videos`
  ADD PRIMARY KEY (`service_id`,`videourl`);

--
-- Indexes for table `site_fees`
--
ALTER TABLE `site_fees`
  ADD PRIMARY KEY (`site_fee_id`),
  ADD KEY `service_provider_id` (`service_provider_id`);

--
-- Indexes for table `support_requests`
--
ALTER TABLE `support_requests`
  ADD PRIMARY KEY (`support_request_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `service_provider_id` (`service_provider_id`);

--
-- Indexes for table `support_request_attachements`
--
ALTER TABLE `support_request_attachements`
  ADD PRIMARY KEY (`support_request_id`,`attachement_url`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_keywords`
--
ALTER TABLE `task_keywords`
  ADD PRIMARY KEY (`task_id`,`keyword`);

--
-- Indexes for table `task_temps`
--
ALTER TABLE `task_temps`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `template_keywords`
--
ALTER TABLE `template_keywords`
  ADD PRIMARY KEY (`template_id`,`keyword`);

--
-- Indexes for table `template_tasks`
--
ALTER TABLE `template_tasks`
  ADD PRIMARY KEY (`template_id`,`task_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `template_temps`
--
ALTER TABLE `template_temps`
  ADD PRIMARY KEY (`template_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catergories`
--
ALTER TABLE `catergories`
  MODIFY `catergory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `service_provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_fees`
--
ALTER TABLE `site_fees`
  MODIFY `site_fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_requests`
--
ALTER TABLE `support_requests`
  MODIFY `support_request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ads_images`
--
ALTER TABLE `ads_images`
  ADD CONSTRAINT `ads_images_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`ad_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON UPDATE CASCADE;

--
-- Constraints for table `catergory_templates`
--
ALTER TABLE `catergory_templates`
  ADD CONSTRAINT `catergory_templates_ibfk_1` FOREIGN KEY (`catergory_id`) REFERENCES `catergories` (`catergory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catergory_templates_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chattings`
--
ALTER TABLE `chattings`
  ADD CONSTRAINT `chattings_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`chat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chattings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chattings_ibfk_3` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chatting_customers`
--
ALTER TABLE `chatting_customers`
  ADD CONSTRAINT `chatting_customers_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`chat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatting_customers_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatting_customers_ibfk_3` FOREIGN KEY (`customer_id2`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_events`
--
ALTER TABLE `customer_events`
  ADD CONSTRAINT `customer_events_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_event_templates`
--
ALTER TABLE `customer_event_templates`
  ADD CONSTRAINT `customer_event_templates_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_event_templates_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_event_templates_ibfk_3` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_task_payments`
--
ALTER TABLE `customer_task_payments`
  ADD CONSTRAINT `customer_task_payments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_task_payments_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_task_payments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_task_payments_ibfk_4` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_task_payments_ibfk_5` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_template_tasks`
--
ALTER TABLE `customer_template_tasks`
  ADD CONSTRAINT `customer_template_tasks_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_template_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_template_tasks_ibfk_3` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_templates`
--
ALTER TABLE `event_templates`
  ADD CONSTRAINT `event_templates_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_templates_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_temps`
--
ALTER TABLE `event_temps`
  ADD CONSTRAINT `event_temps_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_temps_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviewings`
--
ALTER TABLE `reviewings`
  ADD CONSTRAINT `reviewings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviewings_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviewings_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviewings_ibfk_4` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `serviceprovider_booking_services`
--
ALTER TABLE `serviceprovider_booking_services`
  ADD CONSTRAINT `serviceprovider_booking_services_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `serviceprovider_booking_services_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `serviceprovider_booking_services_ibfk_3` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `serviceprovider_task_services`
--
ALTER TABLE `serviceprovider_task_services`
  ADD CONSTRAINT `serviceprovider_task_services_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `serviceprovider_task_services_ibfk_2` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `serviceprovider_task_services_ibfk_3` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_customer_bookings`
--
ALTER TABLE `service_customer_bookings`
  ADD CONSTRAINT `service_customer_bookings_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_customer_bookings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_customer_bookings_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_daytimes`
--
ALTER TABLE `service_daytimes`
  ADD CONSTRAINT `service_daytimes_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_images`
--
ALTER TABLE `service_images`
  ADD CONSTRAINT `service_images_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_keywords`
--
ALTER TABLE `service_keywords`
  ADD CONSTRAINT `service_keywords_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_locations`
--
ALTER TABLE `service_locations`
  ADD CONSTRAINT `service_locations_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_provider_keywords`
--
ALTER TABLE `service_provider_keywords`
  ADD CONSTRAINT `service_provider_keywords_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_provider_tels`
--
ALTER TABLE `service_provider_tels`
  ADD CONSTRAINT `service_provider_tels_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_task_customers`
--
ALTER TABLE `service_task_customers`
  ADD CONSTRAINT `service_task_customers_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_task_customers_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_task_customers_ibfk_3` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_types`
--
ALTER TABLE `service_types`
  ADD CONSTRAINT `service_types_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_videos`
--
ALTER TABLE `service_videos`
  ADD CONSTRAINT `service_videos_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `site_fees`
--
ALTER TABLE `site_fees`
  ADD CONSTRAINT `site_fees_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `support_requests`
--
ALTER TABLE `support_requests`
  ADD CONSTRAINT `support_requests_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `support_requests_ibfk_2` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `support_request_attachements`
--
ALTER TABLE `support_request_attachements`
  ADD CONSTRAINT `support_request_attachements_ibfk_1` FOREIGN KEY (`support_request_id`) REFERENCES `support_requests` (`support_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_keywords`
--
ALTER TABLE `task_keywords`
  ADD CONSTRAINT `task_keywords_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_temps`
--
ALTER TABLE `task_temps`
  ADD CONSTRAINT `task_temps_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_temps_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template_tasks`
--
ALTER TABLE `template_tasks`
  ADD CONSTRAINT `template_tasks_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `template_tasks_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template_temps`
--
ALTER TABLE `template_temps`
  ADD CONSTRAINT `template_temps_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `template_temps_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
