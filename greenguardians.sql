-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 09:28 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenguardians`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `order_id` int NOT NULL,
  `user_ID` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postalcode` varchar(20) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`order_id`, `user_ID`, `fullname`, `address1`, `address2`, `city`, `state`, `postalcode`, `country`) VALUES
(1, 1, 'KAMBIRE OMKAR ANIL', 'NEAR YEDOBA MANDIR AT KAMBIRWADI TAL KARAD DIST SATARA', 'test', 'KAMBIRWADI', 'Maharashtra', '415106', 'IN'),
(2, 1, 'KAMBIRE OMKAR ANIL', 'NEAR YEDOBA MANDIR AT KAMBIRWADI TAL KARAD DIST SATARA', 'test', 'KAMBIRWADI', 'Maharashtra', '415106', 'IN'),
(3, 1, 'KAMBIRE OMKAR ANIL', 'NEAR YEDOBA MANDIR AT KAMBIRWADI TAL KARAD DIST SATARA', 'abc', 'KAMBIRWADI', 'Maharashtra', '415106', 'IN'),
(4, 1, 'KAMBIRE OMKAR ANIL', 'NEAR YEDOBA MANDIR AT KAMBIRWADI TAL KARAD DIST SATARA', 'abc', 'KAMBIRWADI', 'Maharashtra', '415106', 'IN'),
(5, 1, 'KAMBIRE OMKAR ANIL', 'NEAR YEDOBA MANDIR AT KAMBIRWADI TAL KARAD DIST SATARA', 'abc', 'KAMBIRWADI', 'Maharashtra', '415106', 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`product_id`, `ip_address`, `quantity`) VALUES
(1, '::1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cID` int NOT NULL,
  `cTitle` varchar(30) NOT NULL,
  `cDesc` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cID`, `cTitle`, `cDesc`) VALUES
(1, 'Fertilizers', 'It includes various types of fertilizers.'),
(2, 'Pesticides', 'It includes various types of fertilizers\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int NOT NULL,
  `user_ID` int NOT NULL,
  `invoice_number` int NOT NULL,
  `pID` int NOT NULL,
  `quantity` int NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_ID`, `invoice_number`, `pID`, `quantity`, `order_status`) VALUES
(1, 1, 1945919830, 2, 1, 'pending'),
(2, 1, 1871345375, 2, 1, 'pending'),
(3, 1, 1021225244, 1, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int NOT NULL,
  `order_id` int NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `razorpay_order_id` varchar(50) DEFAULT NULL,
  `razorpay_payment_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `payment_method`, `payment_amount`, `payment_date`, `payment_status`, `razorpay_order_id`, `razorpay_payment_id`) VALUES
(1, 0, 'Razorpay', '345.00', '2024-04-21 23:01:28', 'completed', 'order_O1Lvn9SZYx77TF', 'pay_O1Lw0Nr7QUmo2M'),
(2, 66254, 'Razorpay', '345.00', '2024-04-21 23:07:32', 'completed', 'order_O1MCxQRXOuHPui', 'pay_O1MDCuQT8AlhHJ'),
(3, 662556778, 'Razorpay', '345.00', '2024-04-21 23:39:59', 'completed', 'order_O1MlEBdyFIS3gV', 'pay_O1MlUmtZZgRnDD'),
(4, 66255, 'Razorpay', '1135.00', '2024-04-22 00:07:02', 'completed', 'order_O1NDoWBdXD0iA2', 'pay_O1NE4a39lsD9lH'),
(5, 662564, 'Razorpay', '1540.00', '2024-04-22 00:40:33', 'completed', 'order_O1NnCYXfCgm5EO', 'pay_O1NnSdN22S0mYp'),
(6, 662564, 'Razorpay', '1540.00', '2024-04-22 00:41:11', 'completed', 'order_O1Nntb92S5Ok8s', 'pay_O1No7jP61G2KS3'),
(7, 6625, 'Razorpay', '790.00', '2024-04-22 10:20:46', 'completed', 'order_O1Xe06N3tRPn9F', 'pay_O1XgL45UjhQcE3'),
(8, 6625, 'Razorpay', '345.00', '2024-04-22 10:47:52', 'completed', 'order_O1Y8d46Lq6C4Rg', 'pay_O1Y8yJfPzXVp9x'),
(9, 6625, 'Razorpay', '3900.00', '2024-04-22 11:24:41', 'completed', 'order_O1YlUsxI7X9Ohx', 'pay_O1YlsUcK8lb0N4'),
(10, 665089822, 'Razorpay', '895.00', '2024-05-24 18:05:14', 'completed', 'order_OEKg6KX4zzNac2', 'pay_OEKgtCwoTTXFyP'),
(11, 66508, 'Razorpay', '345.00', '2024-05-24 18:23:55', 'completed', 'order_OEL0HknG8gDfeZ', 'pay_OEL0d4giX8lMi5'),
(12, 6650917, 'Razorpay', '345.00', '2024-05-24 18:39:14', 'completed', 'order_OELGXoW4QmxSVC', 'pay_OELGoTpMoSmDST'),
(13, 6650, 'Razorpay', '550.00', '2024-05-24 20:15:37', 'completed', 'order_OEMuJoYxc5UqAv', 'pay_OEMucsmvRoFcYq'),
(14, 66517, 'Razorpay', '345.00', '2024-05-25 11:15:59', 'completed', 'order_OEcFH3cAFR85yC', 'pay_OEcFiJ8og4xbVd');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pID` int NOT NULL,
  `pName` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pDesc` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pKeywords` varchar(255) NOT NULL,
  `cID` int NOT NULL,
  `pPhoto` varchar(255) NOT NULL,
  `pPrice` varchar(100) NOT NULL,
  `pQuantity` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pID`, `pName`, `pDesc`, `pKeywords`, `cID`, `pPhoto`, `pPrice`, `pQuantity`, `date`, `status`) VALUES
(1, 'Cocopeat Block', 'Made of the inner fibres of coconut, coco peat is lightweight, well draining and retains moisture for longer without getting water logged.', 'cocopeat,Coco, Cocopeat', 1, '1-kg-cocopeat-block-32180447608964.jpg', '345', 30, '2024-04-01 19:16:13', 'true'),
(2, 'Cow Manure', 'Ugaoo Cow Manure is an excellent fertilizer rich in organic matter that helps to improve aeration and the breaking up of compact soils.', 'Ugaoo, Manure,organic', 1, '5-kg-cow-manure-31256517378180.jpg', '550', 25, '2024-04-01 19:16:37', 'true'),
(3, 'Vermicompost', 'Vermicompost is made by breaking down the organic material through the use of worms. Vermicompost improves biological, chemical, and physical properties of the soil.', 'Vermicompost, organic , compost', 1, '5-kg-vermicompost-31258231996548.jpg', '660', 30, '2024-04-01 19:21:15', 'true'),
(4, 'Neem Cake Powder - 1 kg', 'Made of dehydrated neem leaves, kernels, and bark, the neem cake powder works as an organic fertiliser with various micro and macro nutrients.', 'neem, cake powder', 1, 'neem-cake-powder-1-kg-31730858786948.jpg', '780', 40, '2024-04-01 19:21:46', 'true'),
(5, 'Plantic Superkiller 25', 'Plantic Total Plant Care 3 in 1 Dosage: 3ML to 5ML in 1 Litre of water and spray on the plants. For better results, use after every 7 days.', 'Plantic , fungicide , miticide', 2, 'shopping.jpg', '930', 45, '2024-04-01 19:25:51', 'true'),
(6, 'Tata Rallis Tafgor Dimethoate 30% EC Insecticide', '1. Tafgor is highly effective in controlling the sucking and caterpillar pests. 2. It is highly compatible with other insecticides and fungicides.', 'Tata, tata, tafgor , insecticide', 2, 'TafgorInsecticide-bharatAgriKrushidukan.jpg', '880', 30, '2024-04-01 13:54:01', 'true'),
(7, 'Humesol Humesol_100ml Pesticide', 'Brand Is Humesol. Form Factor Is Liquid. Type Is Pesticide. Net Quantitys Is 500 Ml. Model Name Is Humesol_100ml. Container Type Is Bottle.', 'Pesicide , humesol', 2, 'total-plant-care1.jpg', '870', 40, '2024-04-01 19:22:55', 'true'),
(8, 'Dhanuka SuperKiller 25% EC', 'MODE OF ACTION Superkiller controls the insects by its contact and stomach poison action.It can be applied as a foliar spray.', 'Dhanuka , superkiller', 2, 'dhanuka.jpg', '790', 20, '2024-04-01 19:23:24', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_pic` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `user_address` varchar(300) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_type` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `user_name`, `user_email`, `user_password`, `user_pic`, `user_ip`, `user_address`, `user_phone`, `user_type`) VALUES
(1, 'Omkar', 'omkar@gmail.com', '123456', 'Pune.jpg', '::1', 'Karad', '9876543210', 'user'),
(2, 'Paddy', 'paddy@gmail.com', '123456', 'Pune.jpg', '::1', 'Karad', '9876543210', 'admin'),
(3, 'Satish', 'satish@gmail.com', '123456', 'Shree_Ram.jpg', '::1', 'Karad', '9876543210', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int NOT NULL,
  `user_ID` int NOT NULL,
  `amount_due` int NOT NULL,
  `invoice_number` int NOT NULL,
  `total_products` int NOT NULL,
  `order_date` timestamp NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_ID`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 895, 1945919830, 2, '2024-05-24 13:13:28', 'pending'),
(2, 1, 550, 1871345375, 1, '2024-05-24 14:45:37', 'pending'),
(3, 1, 345, 1021225244, 1, '2024-05-25 05:45:59', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cID`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
