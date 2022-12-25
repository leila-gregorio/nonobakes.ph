-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2022 at 12:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nonobakes.ph`
--

-- --------------------------------------------------------

--
-- Table structure for table `add ons`
--

CREATE TABLE `add ons` (
  `addID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `maxQuantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add ons`
--

INSERT INTO `add ons` (`addID`, `name`, `price`, `maxQuantity`) VALUES
(1, 'Mini Candle (Free)', 0, 1),
(5, 'Detailed Design', 50, 1),
(6, 'Per Character Head', 70, 3),
(10, 'Rush Order', 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expiration` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `otp` int(11) NOT NULL,
  `otpExpiration` varchar(100) NOT NULL,
  `userType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`, `status`, `token`, `expiration`, `email`, `otp`, `otpExpiration`, `userType`) VALUES
(2, 'admin', 'f35a4fddb482203630e341915d25f919', 1, '814994', '2022-04-30 12:26:03', 'leipatg@gmail.com', 311387, '2022-05-01 08:12:43', 'SUPER ADMIN'),
(1, 'nonobakes', 'f35a4fddb482203630e341915d25f919', 1, '', '', 'nonobakes.ph.2@gmail.com', 330903, '2022-04-28 10:41:18', 'SUPER ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cakeSize` varchar(100) DEFAULT NULL,
  `cakeFlavor` varchar(100) DEFAULT NULL,
  `cakeFilling` varchar(100) DEFAULT NULL,
  `baseColor` varchar(100) DEFAULT NULL,
  `textColor` varchar(100) DEFAULT NULL,
  `dedication` varchar(100) DEFAULT NULL,
  `totalPrice` varchar(100) DEFAULT NULL,
  `designDescription` varchar(100) DEFAULT NULL,
  `designPicture` text DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `pinLocation` varchar(200) DEFAULT NULL,
  `deliveryDate` date DEFAULT NULL,
  `contactNo` varchar(100) DEFAULT NULL,
  `deliveryMode` varchar(100) DEFAULT NULL,
  `paymentMode` varchar(100) DEFAULT NULL,
  `cookieExpiration` varchar(100) DEFAULT NULL,
  `deliveryTime` time DEFAULT NULL,
  `cookieID` varchar(500) NOT NULL,
  `cartPrice` varchar(100) DEFAULT NULL,
  `cartItems` varchar(100) DEFAULT NULL,
  `cartQuantity` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `textStyle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cakeSize`, `cakeFlavor`, `cakeFilling`, `baseColor`, `textColor`, `dedication`, `totalPrice`, `designDescription`, `designPicture`, `name`, `address`, `pinLocation`, `deliveryDate`, `contactNo`, `deliveryMode`, `paymentMode`, `cookieExpiration`, `deliveryTime`, `cookieID`, `cartPrice`, `cartItems`, `cartQuantity`, `email`, `textStyle`) VALUES
('4\" Bento Cake,350', 'Red Velvet', 'Choco Ganache', 'Green', 'White', 'Happi Happi', '470', 'wewewewewewwww', 'upload/1649347392.jpg', 'Leila Gregorio', '49 wowowowoow', 'wowowowo', '2022-04-22', '0921381239821', 'Pick-Up', NULL, '2022-05-07 18:01:52', '17:00:00', '164934731219137638624f0af0a17b47.51808455', '[\"\\u20b1350\",\"\\u20b10\",\"\\u20b150\",\"\\u20b170\"]', '[\"4\\\" Bento Cake\",\"Mini Candle (Free)\",\"Detailed Design\",\"Per Character Head\"]', '[\"1\",\"1\",\"1\"]', 'nonobakes.ph2@gmail.com', 'UPPERCASE PLAIN'),
('4\" Bento Cake,300', 'Chocolate', 'Cream Cheese', 'yellow', 'black', 'wew', '410', 'wqdqwd', 'upload/1650942771.jpg', 'wdwqd', 'wqdqw', '231213', '2022-05-04', '0921821', 'Pick-Up', 'BPI Bank Transfer', '2022-05-23 20:54:26', '15:00:00', '1650740066127867167262644b628d23a1.23364128', '[\"\\u20b1300\",\"\\u20b10\",\"\\u20b170\",\"\\u20b140\"]', '[\"4\\\" Bento Cake\",\"Mini Candle (Free)\",\"Per Character Head\",\"Rush Order\"]', '[\"1\",\"1\",\"1\",\"1\"]', 'wdwqd@gmail.com', 'UPPERCASE PLAIN');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `expiration` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `otp` int(11) NOT NULL,
  `otpExpiration` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `password`, `token`, `status`, `expiration`, `email`, `otp`, `otpExpiration`) VALUES
('leila', 'f35a4fddb482203630e341915d25f919', '', 1, '', 'leilapatriciagregorio@gmail.com\r\n\r\n', 0, ''),
('wow', 'f35a4fddb482203630e341915d25f919', '', 1, '', 'leipatg@gmail.com', 274912, '2022-04-29 17:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `customer order`
--

CREATE TABLE `customer order` (
  `customerOrderID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `orderId` varchar(200) NOT NULL,
  `feedbackID` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer order`
--

INSERT INTO `customer order` (`customerOrderID`, `username`, `orderId`, `feedbackID`) VALUES
(1, 'wow', '16511668332080152812626ace71ed7a29.32715066', '1651171905257128672626ae241eeddc3.53936430'),
(2, 'wow', '16512470081867724800626c07a0f24501.31414733', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` varchar(200) NOT NULL,
  `orderSummaryID` varchar(500) NOT NULL,
  `feedback` text NOT NULL,
  `feedbackImage` text NOT NULL,
  `starRating` float NOT NULL,
  `feedbackDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `orderSummaryID`, `feedback`, `feedbackImage`, `starRating`, `feedbackDateTime`) VALUES
('1651171905257128672626ae241eeddc3.53936430', '16511668332080152812626ace71ed7a29.32715066', 'I\'m satisfied with the order and it arrived without any damages. ', 'feedback/1651171905.jpg', 3, '2022-04-28 20:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `formID` int(11) NOT NULL,
  `cakeFlavor` varchar(100) NOT NULL,
  `cakeFilling` text NOT NULL,
  `fontStyle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`formID`, `cakeFlavor`, `cakeFilling`, `fontStyle`) VALUES
(1, '', 'Plain Whipped Cream', 'UPPERCASE PLAIN'),
(2, 'Red Velvet', 'Choco Ganache', 'UPPERCASE 3D EFFECT'),
(3, '', 'Cream Cheese', 'lowercase plain'),
(4, '', '', 'lowercase 3d effect'),
(5, '', '', 'cursive plain'),
(6, '', '', 'cursive 3d effect'),
(51, 'Choco Moist', '', ''),
(71, 'Chocolate', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `galleryID` int(11) NOT NULL,
  `galleryImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`galleryID`, `galleryImage`) VALUES
(3, 'gallery/1648760111.jpg'),
(8, 'gallery/1648763981.jpg'),
(12, 'gallery/1648797715.jpg'),
(13, 'gallery/1648797726.jpg'),
(14, 'gallery/1649410922.jpg'),
(15, 'gallery/1649416543.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` varchar(200) NOT NULL,
  `orderBase` varchar(100) DEFAULT NULL,
  `orderFlavor` varchar(100) DEFAULT NULL,
  `orderText` varchar(100) DEFAULT NULL,
  `orderFilling` varchar(100) DEFAULT NULL,
  `orderInformation` varchar(100) DEFAULT NULL,
  `orderFont` varchar(100) DEFAULT NULL,
  `orderImage` text DEFAULT NULL,
  `orderTextColor` varchar(100) DEFAULT NULL,
  `orderItems` varchar(100) DEFAULT NULL,
  `orderPrices` varchar(100) DEFAULT NULL,
  `orderQuantity` varchar(100) DEFAULT NULL,
  `orderCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderId`, `orderBase`, `orderFlavor`, `orderText`, `orderFilling`, `orderInformation`, `orderFont`, `orderImage`, `orderTextColor`, `orderItems`, `orderPrices`, `orderQuantity`, `orderCount`) VALUES
('16511668332080152812626ace71ed7a29.32715066', 'pink', 'Choco Moist', 'happo', 'Cream Cheese', 'blue cake with gradient bg', 'UPPERCASE PLAIN', 'order/upload/1651166876.jpg', 'white', '[\"4\\\" Bento Cake\",\"Mini Candle (Free)\",\"Detailed Design\",\"Per Character Head\",\"Rush Order\"]', '[\"\\u20b1300\",\"\\u20b10\",\"\\u20b150\",\"\\u20b170\",\"\\u20b140\"]', '[\"1\",\"1\",\"1\",\"1\"]', 48),
('16512470081867724800626c07a0f24501.31414733', 'pink', 'Choco Moist', 'wew day', 'Plain Whipped Cream', 'Wew day', 'cursive plain', 'order/upload/1651247057.jpg', 'white', '[\"4\\\" Bento Cake\",\"Mini Candle (Free)\",\"Detailed Design\"]', '[\"\\u20b1300\",\"\\u20b10\",\"\\u20b150\"]', '[\"1\",\"1\"]', 51);

-- --------------------------------------------------------

--
-- Table structure for table `order summary`
--

CREATE TABLE `order summary` (
  `orderSummaryID` varchar(500) NOT NULL,
  `totalPrice` float NOT NULL,
  `status` varchar(100) NOT NULL,
  `deliveryTime` time NOT NULL,
  `deliveryMode` varchar(100) NOT NULL,
  `paymentMode` varchar(100) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerAddress` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactNumber` varchar(100) NOT NULL,
  `pinLocation` varchar(200) NOT NULL,
  `deliveryDate` date NOT NULL,
  `paymentProof` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order summary`
--

INSERT INTO `order summary` (`orderSummaryID`, `totalPrice`, `status`, `deliveryTime`, `deliveryMode`, `paymentMode`, `customerName`, `customerAddress`, `email`, `contactNumber`, `pinLocation`, `deliveryDate`, `paymentProof`) VALUES
('16511668332080152812626ace71ed7a29.32715066', 460, 'COMPLETE', '15:00:00', 'Own Booking', 'BPI Bank Transfer', 'Leila Gregorio', 'Wewland', 'leipatg@gmail.com', '093854378595', 'Kanto ng  UST', '2022-04-27', ''),
('16512470081867724800626c07a0f24501.31414733', 350, 'PENDING', '14:00:00', 'Pick-Up', 'BPI Bank Transfer', 'Kanae', 'Wewland', 'leipatg@gmail.com', '0982734745834', 'Kanto ng  UST', '2022-05-11', 'order/upload/receipt-1651247980.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productDescription` varchar(100) NOT NULL,
  `productPrice` float NOT NULL,
  `productCategory` varchar(100) NOT NULL,
  `productSlots` varchar(100) DEFAULT NULL,
  `productImage` text DEFAULT NULL,
  `productStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productDescription`, `productPrice`, `productCategory`, `productSlots`, `productImage`, `productStatus`) VALUES
(8, '4\" Bento Cake', 'BENTO CAKE', 300, '2022-07', '10', 'upload/1651320594.jpg', 'ACTIVE'),
(21, '7\" Bento cake', 'BENTO CAKE', 500, '2022-05', '10', 'upload/1651320619.jpg', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportID` varchar(200) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `revenue` float NOT NULL,
  `netIncome` float NOT NULL,
  `profitMargin` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportID`, `startDate`, `endDate`, `revenue`, `netIncome`, `profitMargin`) VALUES
('16513981901184674611626e562e51d2d8.59823694', '2022-04-01', '2022-05-31', 810, 710, 88),
('16513984071068036967626e57079bc9b1.58052546', '2022-05-01', '2022-05-31', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add ons`
--
ALTER TABLE `add ons`
  ADD PRIMARY KEY (`addID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cookieID`),
  ADD UNIQUE KEY `cookieID` (`cookieID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `customer order`
--
ALTER TABLE `customer order`
  ADD PRIMARY KEY (`customerOrderID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`),
  ADD UNIQUE KEY `orderSummaryID` (`orderSummaryID`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`formID`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`galleryID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`),
  ADD UNIQUE KEY `orderCount` (`orderCount`);

--
-- Indexes for table `order summary`
--
ALTER TABLE `order summary`
  ADD PRIMARY KEY (`orderSummaryID`),
  ADD UNIQUE KEY `orderSummaryID` (`orderSummaryID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add ons`
--
ALTER TABLE `add ons`
  MODIFY `addID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer order`
--
ALTER TABLE `customer order`
  MODIFY `customerOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `formID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `galleryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderCount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
