-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 03:53 PM
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
-- Database: `second_hand`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profile_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `full_name`, `contact`, `email_address`, `username`, `password`, `profile_image`) VALUES
(1, 'Tanui Kipngetich Sila', '0742178644', 'silatanuikipngetich@gmail.com', 'admin', 'admin123', 'PICTURE1.jpg'),
(2, 'ELIJAH GATHITU', '', 'elijahgathitu@gmail.com', 'Elijah', '4532', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Id` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `Amount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Id`, `customer_id`, `Amount`) VALUES
(176, 10, '850');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `Id` int(11) NOT NULL,
  `day` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`Id`, `day`, `amount`) VALUES
(9, 'Monday 23/ 05/2022', '2120'),
(10, 'Tuesday 24/ 05/2022', '3290'),
(11, 'Thursday 26/ 05/2022', '7500'),
(12, 'Friday 27/ 05/2022', '6500'),
(13, 'Saturday 28/ 05/2022', '10000'),
(21, 'Sunday 29/ 05/2022', '12000'),
(22, 'Monday 30/ 05/2022', '11200'),
(23, 'Tuesday 31/ 05/2022', '13270'),
(24, 'Wednesday 01/ 06/2022', '15000'),
(25, 'Thursday 02/ 06/2022', '16950'),
(26, 'Friday 03/ 06/2022', '70800');

-- --------------------------------------------------------

--
-- Table structure for table `orderstable`
--

CREATE TABLE `orderstable` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `cart_id` int(100) NOT NULL,
  `Amount` varchar(100) NOT NULL,
  `payment_date` varchar(100) NOT NULL,
  `Payment_Time` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `processed_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderstable`
--

INSERT INTO `orderstable` (`order_id`, `customer_id`, `product_id`, `product_name`, `product_price`, `Quantity`, `cart_id`, `Amount`, `payment_date`, `Payment_Time`, `order_status`, `processed_by`) VALUES
(418, 10, 4, 'Wooden Chair', '800', 1, 174, '800', 'Friday 03/ 06/2022', '03:42:01pm', 'Received', 0),
(419, 10, 10, 'Coffee Table Rectangle', '1200', 1, 174, '1200', 'Friday 03/ 06/2022', '03:42:01pm', 'Received', 0),
(420, 10, 9, 'Coffee Table Rounded', '600', 1, 175, '600', 'Friday 03/ 06/2022', '03:45:33pm', 'Received', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Design` varchar(100) NOT NULL,
  `Price` varchar(100) NOT NULL,
  `File` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `Name`, `Category`, `Description`, `Design`, `Price`, `File`) VALUES
(2, 'Bed', 'Furniture', '3X6, Wooden', 'Korean', '3200', 'Bed2.webp'),
(4, 'Wooden Chair', 'Furniture', 'Wooden', 'Wooden', '800', 'Wooden Chair.webp'),
(6, 'Bed Japanese Design', 'Furniture', 'Wooden Bed Japanese', 'Wooden', '5400', 'Wooden Bed.jpg'),
(7, 'Bed Special', 'Furniture', 'Wooden 3 X 6', 'Wooden, Japanese', '5600', 'Bed.jpg'),
(8, 'MDF Table', 'Furniture', '2X1', 'MDF', '1000', 'MDF Table.webp'),
(9, 'Coffee Table Rounded', 'Furniture', 'Rounded', 'Rounded, Wooden', '600', 'Coffee Table.jpg'),
(10, 'Coffee Table Rectangle', 'Furniture', 'Rectangular 3X1', 'Wooden', '1200', 'Coffee Table Rectangle.png'),
(11, 'Wooden Table', 'Furniture', 'Rectangular 3X1', 'Wooden', '700', 'Wooden Table.jpg'),
(12, 'Aluminium Sufuria', 'Utensils', 'Aluminum ', '', '300', 'Alumunium cooking Sufuria.jpg'),
(13, 'Electric Kettle Red Cherry', 'Utensils', 'Electric, Red Cherry', '', '850', 'Electric Kettle Red Cherry.jpg'),
(14, 'Kettle Electric 1.7 L ', 'Utensils', 'Electric, 1.7Liters', '', '560', 'Kettle Electric Kettle 1.7 liters.jpeg'),
(15, 'Loud Speaker', 'Electronics', 'Black, 5000Watz', '', '5000', 'Loud Speaker.jpg'),
(16, 'Modern TV set', 'Electronics', '32\" Inches', '', '7600', 'Modern Tv Set.jpg'),
(17, 'Ceramic Plates', 'Utensils', 'Red', '', '320', 'Red Ceramic Plates.jpg'),
(18, 'Cup Red', 'Utensils', 'Red', '', '320', 'Red Cup Pictures.jpg'),
(19, 'Television Set 33\"', 'Electronics', '33\" Inches', '', '7600', 'Television Set.jpg'),
(20, 'Vardagen Cofee Cup', 'Utensils', '3 sets', '', '320', 'Vardagen Coffee.avif'),
(21, 'Electric Kettle Cordless ', 'Utensils', 'Electric, 5000 Wats', '', '1240', 'Electric Cordless Kettle.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `Id` int(11) NOT NULL,
  `Sales` varchar(100) NOT NULL,
  `Day` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`Id`, `Sales`, `Day`) VALUES
(1, '5', 'Thursday 02/ 06/2022'),
(2, '6', 'Wednesday 01/ 06/2022'),
(3, '5', 'Tuesday 31/ 05/2022'),
(4, '3', 'Monday 30/ 05/2022'),
(5, '2', 'Sunday 29/ 05/2022'),
(6, '3', 'Friday 03/ 06/2022');

-- --------------------------------------------------------

--
-- Table structure for table `site_traffic`
--

CREATE TABLE `site_traffic` (
  `Id` int(100) NOT NULL,
  `Logged_in` int(100) NOT NULL,
  `Booked` int(100) NOT NULL,
  `Paid` int(100) NOT NULL,
  `Date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_traffic`
--

INSERT INTO `site_traffic` (`Id`, `Logged_in`, `Booked`, `Paid`, `Date`) VALUES
(28, 2, 3, 1, 'Friday 27/ 05/2022'),
(30, 10, 7, 6, 'Thursday 26/ 05/2022'),
(31, 6, 2, 2, 'Wednesday 25/ 05/2022'),
(34, 19, 17, 16, 'Saturday 28/ 05/2022'),
(36, 6, 5, 2, 'Sunday 29/ 05/2022'),
(37, 3, 3, 2, 'Monday 30/ 05/2022'),
(38, 5, 2, 1, 'Tuesday 31/ 05/2022'),
(39, 4, 1, 1, 'Wednesday 01/ 06/2022'),
(40, 2, 6, 5, 'Thursday 02/ 06/2022'),
(41, 0, 6, 5, 'Friday 03/ 06/2022');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_price` varchar(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `cart_id` int(100) NOT NULL,
  `Amount` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `processed_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`order_id`, `customer_id`, `product_id`, `product_name`, `order_date`, `product_price`, `Quantity`, `cart_id`, `Amount`, `order_status`, `processed_by`) VALUES
(579, 10, 13, 'Electric Kettle Red Cherry', '2022-06-03 13:45:51', '850', 1, 176, '850', 'Received', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `payment_id` int(11) NOT NULL,
  `payment_voucher` varchar(100) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `paid_by` varchar(50) NOT NULL,
  `payment_date` varchar(100) NOT NULL,
  `processed_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayment`
--

INSERT INTO `tblpayment` (`payment_id`, `payment_voucher`, `cart_id`, `amount`, `payment_status`, `paid_by`, `payment_date`, `processed_by`) VALUES
(188, 'F8DI14S', 174, 2000, 'Paid, Not Verified', '10', 'Friday 03/ 06/2022', 0),
(189, 'GOT8FY3', 175, 600, 'Paid, Not Verified', '10', 'Friday 03/ 06/2022', 0),
(190, 'ERCT6L4', 176, 0, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(255) NOT NULL,
  `Customer Name` varchar(100) NOT NULL,
  `Customer Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone Number` varchar(100) NOT NULL,
  `Date Of Birth` varchar(100) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `File` varchar(100) NOT NULL,
  `Date Ragistered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Customer Name`, `Customer Username`, `Email`, `Address`, `Phone Number`, `Date Of Birth`, `Password`, `File`, `Date Ragistered`) VALUES
(8, 'Mercy Muchiri', 'Mercy', 'mercymuchiri@gmail.com', 'Kutus', '0742178644', '2000-02-02', '1234', 'PICTURE8.jpg', '2022-03-23 15:37:02'),
(9, 'Martha Wangui', 'Martha', 'martha@gmail.com', 'Kutus', '0734343434', '2000-07-03', '1234', 'PICTURE1.jpg', '2022-03-26 15:24:10'),
(10, 'RACHAEL MUEMA ', 'Rachael', 'rachaelmuema@gmail.com', 'Kutus', '0734343434', '1998-12-12', '1234', 'PICTURE8.jpg', '2022-03-28 05:18:03'),
(12, 'Elijah Gathitu Ndungu', 'Elijah', 'gathitundungu97@gmail.com', 'Kerugoya', '0712345654', '', '4532', 'PICTURE12.jpg', '2022-06-03 09:19:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orderstable`
--
ALTER TABLE `orderstable`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`,`processed_by`),
  ADD KEY `processed_by` (`processed_by`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `site_traffic`
--
ALTER TABLE `site_traffic`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`,`processed_by`),
  ADD KEY `processed_by` (`processed_by`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`cart_id`,`processed_by`),
  ADD KEY `processed_by` (`processed_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orderstable`
--
ALTER TABLE `orderstable`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_traffic`
--
ALTER TABLE `site_traffic`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=580;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
