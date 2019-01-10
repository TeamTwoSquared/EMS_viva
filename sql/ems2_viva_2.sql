-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2019 at 06:20 PM
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
(1, 'EMSAdmin', 'admin@ems.dv', '43c7ccde32edd2953c918c3e0c60578b', 'admin_2_1546870664.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ad_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` text,
  `isapprove` int(2) NOT NULL DEFAULT '0',
  `type` int(2) NOT NULL DEFAULT '0',
  `numberOfclicks` int(11) NOT NULL DEFAULT '0',
  `impressions` int(11) NOT NULL DEFAULT '0',
  `force_factor` int(2) NOT NULL DEFAULT '1',
  `service_provider_id` int(11) NOT NULL,
  `ispaid` int(2) NOT NULL DEFAULT '0',
  `price` int(11) DEFAULT NULL,
  `position` int(2) DEFAULT NULL,
  `ad_url` text,
  `last_payment_date` date DEFAULT NULL,
  `last_payment_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ads_images`
--

CREATE TABLE `ads_images` (
  `ad_id` int(11) NOT NULL,
  `imgurl` varchar(175) NOT NULL,
  `position` int(2) NOT NULL,
  `isbottom` int(2) NOT NULL DEFAULT '0',
  `isright` int(2) NOT NULL DEFAULT '0'
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
  `service_provider_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `catergories`
--

CREATE TABLE `catergories` (
  `catergory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `numberOftemplates` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catergories`
--

INSERT INTO `catergories` (`catergory_id`, `name`, `description`, `numberOftemplates`) VALUES
(14, 'Weddings', 'Normal weddings', 0),
(15, 'Party', 'Typical Party', 0),
(20, 'RELIGIOUS FESTIVALS', 'religious festivals happening in sri lanka', 0),
(21, 'OTHER EVENTS', 'More other events', 0);

-- --------------------------------------------------------

--
-- Table structure for table `catergory_images`
--

CREATE TABLE `catergory_images` (
  `catergory_id` int(11) NOT NULL,
  `imgurl` varchar(175) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catergory_images`
--

INSERT INTO `catergory_images` (`catergory_id`, `imgurl`) VALUES
(14, 'download (3)_1546935686_1547002265.jpg'),
(14, 'images_1546935687_1547002265.jpg'),
(15, 'part2_1546684761_1547002084.jpg'),
(15, 'party3_1546684968_1547002084.jpg'),
(20, 'download (1)_1546934809_1547002372.jpg'),
(20, 'download_1546934809_1547002372.jpg'),
(21, '5_1546935143_1547002418.jpg'),
(21, 'download (2)_1546934958_1547002419.jpg');

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
(14, 3),
(14, 4),
(15, 5),
(15, 6),
(15, 7),
(20, 8);

-- --------------------------------------------------------

--
-- Table structure for table `chatboxs`
--

CREATE TABLE `chatboxs` (
  `chat_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `feedback_no` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` int(15) DEFAULT NULL,
  `messege` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(75) DEFAULT NULL,
  `isverified` int(2) NOT NULL DEFAULT '0',
  `isonline` int(2) NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `profilepic` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `activation_link` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `username`, `password`, `email`, `address`, `address2`, `city`, `isverified`, `isonline`, `last_login`, `profilepic`, `activation_link`, `google_id`) VALUES
(1, 'sajun', 'sajun', '43c7ccde32edd2953c918c3e0c60578b', 'sajunsandaruwan@gmail.com', 'nugegoda', 'delkanda', 'Sss', 1, 0, NULL, 'cl_1_1547034438.jpeg', NULL, NULL);

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `set_customer_id_invitations` AFTER INSERT ON `customers` FOR EACH ROW UPDATE invitations SET invitations.customer_id=NEW.customer_id
WHERE NEW.email=invitations.email
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_events`
--

CREATE TABLE `customer_events` (
  `customer_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `lastChangetime` datetime DEFAULT NULL
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `stime` time DEFAULT NULL,
  `etime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_template_tasks`
--

CREATE TABLE `event_template_tasks` (
  `event_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `israted` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `help_and_comment`
--

CREATE TABLE `help_and_comment` (
  `comment_id` int(20) NOT NULL,
  `support_request_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `service_provider_id` int(11) DEFAULT NULL,
  `from_whome` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `invitation_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `invitations`
--
DELIMITER $$
CREATE TRIGGER `insert_to_customer_event` AFTER INSERT ON `invitations` FOR EACH ROW BEGIN
DECLARE c_id INT DEFAULT 0;
SET c_id = NEW.customer_id;
IF(c_id != 0) THEN
INSERT INTO `customer_events`(`customer_id`, `event_id`, `lastChangetime`) VALUES (NEW.customer_id,NEW.event_id,CURRENT_TIMESTAMP);
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_to_customer_event_update` AFTER UPDATE ON `invitations` FOR EACH ROW BEGIN
DECLARE c_id INT DEFAULT 0;
SET c_id = NEW.customer_id;
IF(c_id != 0) THEN
INSERT INTO `customer_events`(`customer_id`, `event_id`, `lastChangetime`) VALUES (NEW.customer_id,NEW.event_id,CURRENT_TIMESTAMP);
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_customer_id_exist` BEFORE INSERT ON `invitations` FOR EACH ROW set new.customer_id=(Select customer_id from customers
where customers.email = new.email)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `notification` varchar(256) NOT NULL,
  `support_request_id` int(11) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `to_whome` int(2) NOT NULL DEFAULT '0',
  `from_whome` int(2) DEFAULT NULL,
  `is_read` int(2) NOT NULL DEFAULT '0',
  `customer_id` int(11) DEFAULT NULL,
  `service_provider_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `package_and_their_services`
--

CREATE TABLE `package_and_their_services` (
  `package_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_keywords`
--

CREATE TABLE `package_keywords` (
  `package_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_location`
--

CREATE TABLE `package_location` (
  `package_id` int(11) NOT NULL,
  `location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_service`
--

CREATE TABLE `package_service` (
  `package_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` int(10) NOT NULL,
  `description` varchar(256) NOT NULL,
  `imgurl` varchar(256) DEFAULT NULL,
  `videourl` varchar(256) DEFAULT NULL,
  `service_provider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_type`
--

CREATE TABLE `package_type` (
  `package_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `description`, `numberOfstars`) VALUES
(20, 'good', 4),
(21, 'hsape', 3),
(22, 'cdcd', 2),
(23, 'aaa', 4),
(24, 'dd', 5);

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
  `service_provider_id` int(11) NOT NULL,
  `is_package` int(2) NOT NULL DEFAULT '0',
  `is_add_to_package` int(2) NOT NULL DEFAULT '0'
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
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `city` varchar(75) DEFAULT NULL,
  `level` int(2) NOT NULL DEFAULT '0',
  `star` float NOT NULL DEFAULT '5',
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

INSERT INTO `service_providers` (`service_provider_id`, `name`, `firstname`, `lastname`, `username`, `password`, `email`, `address`, `address2`, `phone`, `city`, `level`, `star`, `isverified`, `isonline`, `isdeleted`, `reg_date`, `last_login`, `profilepic`, `activation_link`) VALUES
(12, '1234', 'Sajun', 'Sandaruwan', 'SajunSan', '43c7ccde32edd2953c918c3e0c60578b', 'wemssandaruwan@gmail.com', 'NO 13', 'Delkanda', 714223146, 'Nugegoda', 0, 4.35, 1, 0, 0, '2018-10-01 15:43:55', NULL, 'svp_1_1547034463.jpg', 'dzUsVqif6JCc2W0yknMa11hMYlSbgfNR6StijAQr');

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL,
  `property` varchar(75) NOT NULL,
  `value` int(11) DEFAULT '0',
  `value_string` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `property`, `value`, `value_string`) VALUES
(1, 'site_status', 1, NULL),
(2, 'bottom_ad_price', 1000, NULL),
(3, 'right_ad_price', 2000, NULL),
(4, 'merchant_id', 1212072, NULL),
(5, 'merchant_secret', 1212072, NULL),
(6, 'payhere_action', NULL, 'https://sandbox.payhere.lk/pay/checkout'),
(7, 'max_right_ads', 4, NULL),
(8, 'max_bottom_ads', 3, NULL);

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
  `request` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `service_provider_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `from_whome` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `support_request_attachements`
--

CREATE TABLE `support_request_attachements` (
  `support_request_id` int(11) NOT NULL,
  `attachement_url` varchar(175) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `support_request_type`
--

CREATE TABLE `support_request_type` (
  `type_id` int(11) NOT NULL,
  `type` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support_request_type`
--

INSERT INTO `support_request_type` (`type_id`, `type`) VALUES
(7, 'System Issue'),
(9, 'Site Advertisement Issue'),
(10, 'Other Issue');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `istemp` int(2) NOT NULL DEFAULT '0',
  `timeduration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `name`, `description`, `istemp`, `timeduration`) VALUES
(1, 'Poruwa Ceremony', 'Poruwa Ceremony', 0, 2),
(89, 'Church wedding Task 1', 'Task 1', 0, NULL),
(90, 'Sounds', 'sounds', 2, NULL),
(94, 'Welcome Dance', 'The beginning dance', 0, NULL),
(99, 'Hall booking', 'Booking of the hall', 0, NULL),
(100, 'Sound', 'Testing', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks_svps`
--

CREATE TABLE `tasks_svps` (
  `task_id` int(11) NOT NULL,
  `service_provider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_keywords`
--

CREATE TABLE `task_keywords` (
  `task_id` int(11) NOT NULL,
  `keyword` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_keywords`
--

INSERT INTO `task_keywords` (`task_id`, `keyword`) VALUES
(1, 'ceramony'),
(1, 'provide'),
(89, 'church'),
(89, 'wedding'),
(90, 'sound'),
(94, 'dance'),
(94, 'welcome'),
(99, 'hall'),
(100, 'sound');

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
(1, 'notdefine', 'notdefine', 2, NULL),
(2, 'userdefined', 'userdefined', 0, NULL),
(3, 'Sinhala Wedding', 'This is a sinhala traditional wedding. Incuding poruwa cermony. A Poruwa ceremony is a traditional Sinhalese wedding ceremony. The ceremony takes place on a \"Poruwa\", a beautifully decorated, traditional wooden platform. The ceremony involves a series of rituals.', 0, NULL),
(4, 'Church wedding', 'A church wedding is the way many couples choose to begin their lives together as man and wife. Whether planning a Christian service or a Jewish ceremony, many couples feel that a religious wedding adds meaning and reverence to the day.', 0, NULL),
(5, 'Bachelor\'s party', 'Bachelor\'s party', 0, NULL),
(6, 'Birth day party', 'Normal b\'day party', 0, NULL),
(7, 'CHRISTMAS PARTY', 'CHRISTMAS PARTY', 0, NULL),
(8, 'PIRITH CEREMONY', 'Normal Pirith Ceremony', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template_images`
--

CREATE TABLE `template_images` (
  `template_id` int(11) NOT NULL,
  `imgurl` varchar(175) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template_images`
--

INSERT INTO `template_images` (`template_id`, `imgurl`) VALUES
(2, 'userdefined_1546077840.jpg'),
(3, '02-susatabarana_1546303944.jpg'),
(3, 'sinhala 2_1546685385.jpg'),
(3, 'sinhala wedding_1546685385.jpg'),
(4, 'church weddings_1546685167.jpg'),
(4, 'church2_1546685167.jpg'),
(5, 'images (3)_1546936152_1547002546.jpg'),
(6, 'images (1)_1546935995_1547002675.jpg'),
(6, 'images (2)_1546935995_1547002675.jpg'),
(7, 'images (4)_1546936249_1547002752.jpg'),
(7, 'images (5)_1546936249_1547002752.jpg'),
(8, 'download (1)_1546936321_1547032126.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `template_keywords`
--

CREATE TABLE `template_keywords` (
  `template_id` int(11) NOT NULL,
  `keyword` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template_keywords`
--

INSERT INTO `template_keywords` (`template_id`, `keyword`) VALUES
(2, 'userdefined'),
(3, 'sinhala'),
(3, 'wedding'),
(4, 'church,,wedding,'),
(5, 'bachelor'),
(5, 'party'),
(6, 'birthday'),
(6, 'party'),
(7, 'christmas,party,'),
(8, 'pirith,');

-- --------------------------------------------------------

--
-- Table structure for table `template_tasks`
--

CREATE TABLE `template_tasks` (
  `template_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template_tasks`
--

INSERT INTO `template_tasks` (`template_id`, `task_id`) VALUES
(3, 1),
(3, 90),
(3, 94),
(3, 99),
(3, 100),
(4, 89),
(4, 99),
(5, 90),
(5, 100);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`) VALUES
(1, 'l'),
(2, 'a'),
(3, 'b'),
(4, 'c'),
(5, 'd'),
(6, 'h'),
(7, NULL),
(8, 'y'),
(9, 't'),
(10, 'p'),
(11, 't'),
(12, 'oooo'),
(13, 'cccc'),
(14, 'iiii'),
(15, '444'),
(16, '555');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  ADD PRIMARY KEY (`ad_id`,`imgurl`,`position`,`isbottom`,`isright`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `booking_ibfk_1` (`service_provider_id`),
  ADD KEY `bookings_ibfk_2` (`service_id`);

--
-- Indexes for table `catergories`
--
ALTER TABLE `catergories`
  ADD PRIMARY KEY (`catergory_id`);

--
-- Indexes for table `catergory_images`
--
ALTER TABLE `catergory_images`
  ADD PRIMARY KEY (`catergory_id`,`imgurl`);

--
-- Indexes for table `catergory_templates`
--
ALTER TABLE `catergory_templates`
  ADD PRIMARY KEY (`template_id`,`catergory_id`),
  ADD KEY `catergory_templates_ibfk_1` (`catergory_id`);

--
-- Indexes for table `chatboxs`
--
ALTER TABLE `chatboxs`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `event_id` (`event_id`);

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
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`feedback_no`);

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
-- Indexes for table `customer_task_payments`
--
ALTER TABLE `customer_task_payments`
  ADD PRIMARY KEY (`customer_id`,`payment_id`,`service_id`,`service_provider_id`,`task_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `service_provider_id` (`service_provider_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `template_id` (`template_id`);

--
-- Indexes for table `event_template_tasks`
--
ALTER TABLE `event_template_tasks`
  ADD PRIMARY KEY (`event_id`,`task_id`),
  ADD KEY `event_template_tasks_ibfk_2` (`task_id`),
  ADD KEY `event_template_tasks_ibfk_3` (`service_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `help_and_comment`
--
ALTER TABLE `help_and_comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `service_provider_id` (`service_provider_id`),
  ADD KEY `support_request_id` (`support_request_id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`invitation_id`),
  ADD KEY `email` (`email`(191)),
  ADD KEY `invitations_ibfk_1` (`event_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `support_request_id` (`support_request_id`);

--
-- Indexes for table `package_and_their_services`
--
ALTER TABLE `package_and_their_services`
  ADD PRIMARY KEY (`package_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `package_keywords`
--
ALTER TABLE `package_keywords`
  ADD PRIMARY KEY (`package_id`,`keyword`);

--
-- Indexes for table `package_location`
--
ALTER TABLE `package_location`
  ADD PRIMARY KEY (`package_id`,`location`);

--
-- Indexes for table `package_service`
--
ALTER TABLE `package_service`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `service_provider_id` (`service_provider_id`);

--
-- Indexes for table `package_type`
--
ALTER TABLE `package_type`
  ADD PRIMARY KEY (`package_id`,`type`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

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
  ADD KEY `service_provider_id` (`service_provider_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `support_request_attachements`
--
ALTER TABLE `support_request_attachements`
  ADD PRIMARY KEY (`support_request_id`,`attachement_url`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `support_request_type`
--
ALTER TABLE `support_request_type`
  ADD PRIMARY KEY (`type_id`);

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
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `template_images`
--
ALTER TABLE `template_images`
  ADD PRIMARY KEY (`template_id`,`imgurl`);

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
-- Indexes for table `test`
--
ALTER TABLE `test`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `catergories`
--
ALTER TABLE `catergories`
  MODIFY `catergory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chatboxs`
--
ALTER TABLE `chatboxs`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `feedback_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `help_and_comment`
--
ALTER TABLE `help_and_comment`
  MODIFY `comment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `invitation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `package_service`
--
ALTER TABLE `package_service`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `service_provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_fees`
--
ALTER TABLE `site_fees`
  MODIFY `site_fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_requests`
--
ALTER TABLE `support_requests`
  MODIFY `support_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `support_request_type`
--
ALTER TABLE `support_request_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

--
-- Constraints for table `catergory_images`
--
ALTER TABLE `catergory_images`
  ADD CONSTRAINT `catergory_images_ibfk_1` FOREIGN KEY (`catergory_id`) REFERENCES `catergories` (`catergory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `catergory_templates`
--
ALTER TABLE `catergory_templates`
  ADD CONSTRAINT `catergory_templates_ibfk_1` FOREIGN KEY (`catergory_id`) REFERENCES `catergories` (`catergory_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catergory_templates_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chatboxs`
--
ALTER TABLE `chatboxs`
  ADD CONSTRAINT `chatboxs_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatboxs_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `customer_task_payments`
--
ALTER TABLE `customer_task_payments`
  ADD CONSTRAINT `customer_task_payments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_task_payments_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_task_payments_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_task_payments_ibfk_4` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_task_payments_ibfk_5` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_template_tasks`
--
ALTER TABLE `event_template_tasks`
  ADD CONSTRAINT `event_template_tasks_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_template_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_template_tasks_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `event_template_tasks_ibfk_4` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `help_and_comment`
--
ALTER TABLE `help_and_comment`
  ADD CONSTRAINT `help_and_comment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `help_and_comment_ibfk_2` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `help_and_comment_ibfk_3` FOREIGN KEY (`support_request_id`) REFERENCES `support_requests` (`support_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`support_request_id`) REFERENCES `support_requests` (`support_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_and_their_services`
--
ALTER TABLE `package_and_their_services`
  ADD CONSTRAINT `package_and_their_services_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_and_their_services_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `package_service` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_keywords`
--
ALTER TABLE `package_keywords`
  ADD CONSTRAINT `package_keywords_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package_service` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_location`
--
ALTER TABLE `package_location`
  ADD CONSTRAINT `package_location_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package_service` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_service`
--
ALTER TABLE `package_service`
  ADD CONSTRAINT `package_service_ibfk_1` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_type`
--
ALTER TABLE `package_type`
  ADD CONSTRAINT `package_type_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package_service` (`package_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `support_requests_ibfk_2` FOREIGN KEY (`service_provider_id`) REFERENCES `service_providers` (`service_provider_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `support_requests_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `support_request_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `support_request_attachements`
--
ALTER TABLE `support_request_attachements`
  ADD CONSTRAINT `support_request_attachements_ibfk_1` FOREIGN KEY (`support_request_id`) REFERENCES `support_requests` (`support_request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `support_request_attachements_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `support_request_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_keywords`
--
ALTER TABLE `task_keywords`
  ADD CONSTRAINT `task_keywords_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template_images`
--
ALTER TABLE `template_images`
  ADD CONSTRAINT `template_images_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template_keywords`
--
ALTER TABLE `template_keywords`
  ADD CONSTRAINT `template_keywords_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `template_tasks`
--
ALTER TABLE `template_tasks`
  ADD CONSTRAINT `template_tasks_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `template_tasks_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `templates` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
