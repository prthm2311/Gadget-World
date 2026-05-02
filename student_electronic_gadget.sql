-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 02:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_electronic_gadget`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_mobile` bigint(20) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_photo` text DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `insert_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_mobile`, `admin_password`, `admin_photo`, `is_active`, `is_delete`, `insert_datetime`, `update_datetime`) VALUES
(1, 'Admin', 'test.akashtechnolabs@gmail.com', 9909901234, 'admin123', '16431991911642825317user.png', 1, 0, '2020-05-12 01:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(1, 'HP'),
(2, 'LG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `user_id`, `seller_id`, `product_id`, `product_qty`) VALUES
(2, 0, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(150) NOT NULL DEFAULT 'noimage.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_image`) VALUES
(1, 'Mobile Accessories', 'noimage.png'),
(2, 'Smartphones & Basic Mobiles', 'noimage.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_person`
--

CREATE TABLE `tbl_delivery_person` (
  `delivery_person_id` int(11) NOT NULL,
  `delivery_person_name` varchar(200) NOT NULL,
  `delivery_person_email` varchar(200) NOT NULL,
  `delivery_person_mobile` bigint(20) NOT NULL,
  `delivery_person_password` varchar(200) NOT NULL,
  `delivery_person_address` text DEFAULT NULL,
  `delivery_person_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_delivery_person`
--

INSERT INTO `tbl_delivery_person` (`delivery_person_id`, `delivery_person_name`, `delivery_person_email`, `delivery_person_mobile`, `delivery_person_password`, `delivery_person_address`, `delivery_person_image`) VALUES
(1, 'pankaj', 'test.akashtechnolabs@gmail.com', 5461562556, 'admin123', 'xzxzx', 'noimage.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `seller_id` int(11) NOT NULL DEFAULT 0,
  `feedback_date` date DEFAULT NULL,
  `feedback_subject` varchar(200) NOT NULL,
  `feedback_rating` int(11) NOT NULL,
  `feedback_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mail_setting`
--

CREATE TABLE `tbl_mail_setting` (
  `mail_setting_id` int(11) NOT NULL,
  `mail_smtp_secure` varchar(200) NOT NULL,
  `mail_host` varchar(200) NOT NULL,
  `mail_port` varchar(200) NOT NULL,
  `mail_username` varchar(200) NOT NULL,
  `mail_password` varchar(100) NOT NULL,
  `mail_email_send` varchar(200) NOT NULL,
  `mail_title` varchar(200) NOT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_details_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT 0,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_details_id`, `order_id`, `product_id`, `product_qty`, `seller_id`, `total_amount`) VALUES
(1, 1, 5, 1, 1, 69),
(2, 2, 2, 5, 1, 1745),
(3, 2, 1, 3, 1, 1137),
(4, 2, 4, 1, 1, 129),
(5, 3, 4, 1, 1, 129),
(6, 4, 3, 1, 1, 9499),
(7, 5, 5, 1, 1, 69);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_master`
--

CREATE TABLE `tbl_order_master` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `order_status` varchar(100) DEFAULT 'Pending',
  `view_order` int(11) NOT NULL DEFAULT 1,
  `cancel_reason` text DEFAULT NULL,
  `payment_method` varchar(200) DEFAULT NULL,
  `razor_pay_payment_id` varchar(200) DEFAULT NULL,
  `delivery_person_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order_master`
--

INSERT INTO `tbl_order_master` (`order_id`, `order_date`, `order_time`, `user_id`, `total_amount`, `order_status`, `view_order`, `cancel_reason`, `payment_method`, `razor_pay_payment_id`, `delivery_person_id`) VALUES
(2, '2022-02-28', '15:40:01', 1, '3011', 'Ongoing', 1, NULL, '1', NULL, 1),
(3, '2022-03-24', '15:58:17', 1, '129', 'Pending', 1, NULL, '1', NULL, 0),
(4, '2022-03-26', '10:23:23', 1, '9499', 'Pending', 1, NULL, '1', NULL, 0),
(5, '2022-03-31', '17:17:04', 1, '69', 'Pending', 1, NULL, '1', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_method`
--

CREATE TABLE `tbl_payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_master`
--

CREATE TABLE `tbl_product_master` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_details` varchar(300) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_image` varchar(150) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_seller_all` int(11) NOT NULL DEFAULT 0,
  `brand_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_master`
--

INSERT INTO `tbl_product_master` (`product_id`, `product_name`, `product_details`, `product_price`, `product_image`, `product_quantity`, `category_id`, `is_seller_all`, `brand_id`) VALUES
(1, 'boAt Bassheads 100 in Ear Wired Earphones with Mic(Black)', 'The perfect way to add some style and stand out from the crowd with the boAt BassHeads 100 \"Hawk\" inspired earphones. Impedance 16?, Sensitivity (dB) 92db ±3db, Frequency Response 20Hz-20KHz\r\nThe stylish BassHeads 100 superior coated wired earphones are a definite fashion statement - wear your attit', 379, '1646041112719elVA3FvL._SL1500_.jpg', 3, 1, 1, 1),
(2, 'boAt Bassheads 102 in Ear Wired Earphones with Mic(Jazzy Blue)', 'Has a durable PVC Cable which is tangle free. Impedance : 18?. Sensitivity (dB) : 104db ±3db. Frequency Response : 20Hz-20KHz\r\nCompatibility and Connectivity: Compatible with Android/iOS and connectivity via 3.5mm AUX cable\r\nIPX Rating: NA\r\nActive Noise Cancellation: NA\r\nMic: In line Mic\r\nOther Incl', 349, '164604115261JtJL6Q9oL._SL1500_.jpg', 23, 1, 1, 2),
(3, 'Samsung Galaxy M12 (Blue,4GB RAM, 64GB Storage) 6000 mAh with 8nm Processor | True 48 MP Quad Camera', '48MP+5MP+2MP+2MP Quad camera setup- True 48MP (F 2.0) main camera + 5MP (F2.2) Ultra wide camera+ 2MP (F2.4) depth camera + 2MP (2.4) Macro Camera| 8MP (F2.2) front came\r\n6000mAH lithium-ion battery, 1 year manufacturer warranty for device and 6 months manufacturer warranty for in-box accessories in', 9499, '164604120081QsZ3U4GfL._SL1500_.jpg', 1, 2, 1, 1),
(4, 'Amazon Brand - Solimo Protective Mobile Cover (Soft & Flexible Back Case) for Samsung Galaxy M12 (Bl', 'Snug fit for Samsung Galaxy M12, with perfect cut-outs for volume buttons, audio and charging ports\r\nCompatible with Samsung Galaxy M12\r\nDurable, soft and flexible back case, Slip Resistant\r\nRaised upper lip build design to help protect the screen against fall on a flat surface\r\nProtects phone from ', 129, '164604123881MDj7qnJoL._SL1500_.jpg', 1, 2, 1, 1),
(5, 'Amazon Brand - Solimo Mobile Cover (Soft & Flexible Back case) for Samsung Galaxy M10 (Transparent)', 'Easy to put and take off\r\nCompatible with Samsung Galaxy M10\r\nTear and slip-resistant\r\nRaised upper lip build design to help protect the screen against fall on a flat surface\r\nProtects phone from scratches, fingerprints and sweat\r\nDurable, soft and flexible back case\r\nNo Warranty', 69, '164604128061iU0P8HoeL._SL1300_.jpg', 1, 2, 1, 2),
(6, 'Mangalsutra', 'sdsdd', 23, '16487275111.png', 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_photo`
--

CREATE TABLE `tbl_product_photo` (
  `product_photo_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `photo_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_refund`
--

CREATE TABLE `tbl_refund` (
  `refund_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `refund_description` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `seller_id` int(11) NOT NULL,
  `seller_first_name` varchar(200) NOT NULL,
  `seller_last_name` varchar(250) DEFAULT NULL,
  `seller_dob` date DEFAULT NULL,
  `seller_email` varchar(200) NOT NULL,
  `seller_mobile_no` bigint(20) NOT NULL,
  `seller_password` varchar(100) NOT NULL,
  `seller_gender` varchar(200) NOT NULL,
  `seller_address` text DEFAULT NULL,
  `seller_image` text DEFAULT NULL,
  `is_verify` int(11) DEFAULT 0,
  `state` text DEFAULT NULL,
  `city` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`seller_id`, `seller_first_name`, `seller_last_name`, `seller_dob`, `seller_email`, `seller_mobile_no`, `seller_password`, `seller_gender`, `seller_address`, `seller_image`, `is_verify`, `state`, `city`) VALUES
(1, 'pankaj', NULL, NULL, 'test.akashtechnolabs@gmail.com', 7056457815, 'admin123', 'Male', 'asas', 'noimage.png', 1, NULL, NULL),
(2, 'Dhimanginee', 'Shah', NULL, 'hotel@23gamil.com', 7069425146, '123456', 'Male', '', 'noimage.png', 0, 'Gujarat', 'Ahmadabad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller_product`
--

CREATE TABLE `tbl_seller_product` (
  `seller_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `seller_product_price` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_seller_product`
--

INSERT INTO `tbl_seller_product` (`seller_product_id`, `product_id`, `seller_id`, `seller_product_price`) VALUES
(1, 1, 1, 0),
(2, 2, 1, 0),
(3, 3, 1, 0),
(4, 4, 1, 0),
(6, 5, 1, 0),
(7, 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_master`
--

CREATE TABLE `tbl_user_master` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(100) NOT NULL,
  `user_last_name` varchar(250) DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_gender` varchar(30) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_mobile` bigint(12) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_address` varchar(250) NOT NULL,
  `state` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `user_photo` varchar(100) NOT NULL DEFAULT 'noimage.png',
  `mobile_otp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_master`
--

INSERT INTO `tbl_user_master` (`user_id`, `user_first_name`, `user_last_name`, `user_dob`, `user_gender`, `user_email`, `user_mobile`, `user_password`, `user_address`, `state`, `city`, `user_photo`, `mobile_otp`) VALUES
(1, 'Dhimanginee ', 'Rana', '2022-02-28', 'Female', 'test.akashtechnolabs@gmail.com', 2323212334, 'admin123', 'sasas', 'Gujarat', 'Ahmadabad', 'noimage.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_delivery_person`
--
ALTER TABLE `tbl_delivery_person`
  ADD PRIMARY KEY (`delivery_person_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_mail_setting`
--
ALTER TABLE `tbl_mail_setting`
  ADD PRIMARY KEY (`mail_setting_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_details_id`);

--
-- Indexes for table `tbl_order_master`
--
ALTER TABLE `tbl_order_master`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_payment_method`
--
ALTER TABLE `tbl_payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `tbl_product_master`
--
ALTER TABLE `tbl_product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_product_photo`
--
ALTER TABLE `tbl_product_photo`
  ADD PRIMARY KEY (`product_photo_id`);

--
-- Indexes for table `tbl_refund`
--
ALTER TABLE `tbl_refund`
  ADD PRIMARY KEY (`refund_id`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `tbl_seller_product`
--
ALTER TABLE `tbl_seller_product`
  ADD PRIMARY KEY (`seller_product_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tbl_user_master`
--
ALTER TABLE `tbl_user_master`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_delivery_person`
--
ALTER TABLE `tbl_delivery_person`
  MODIFY `delivery_person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_mail_setting`
--
ALTER TABLE `tbl_mail_setting`
  MODIFY `mail_setting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_order_master`
--
ALTER TABLE `tbl_order_master`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payment_method`
--
ALTER TABLE `tbl_payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product_master`
--
ALTER TABLE `tbl_product_master`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_product_photo`
--
ALTER TABLE `tbl_product_photo`
  MODIFY `product_photo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_refund`
--
ALTER TABLE `tbl_refund`
  MODIFY `refund_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_seller_product`
--
ALTER TABLE `tbl_seller_product`
  MODIFY `seller_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_master`
--
ALTER TABLE `tbl_user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
