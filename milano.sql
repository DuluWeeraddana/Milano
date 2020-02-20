-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2020 at 06:59 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milano`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` char(6) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`) VALUES
('ADM001', 'Madushan Sandaruwan');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Adidas'),
(2, 'Nike'),
(3, 'Odel'),
(4, 'DSI');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `image`) VALUES
(1, 'image/c1.jpeg'),
(2, 'image/c2.jpeg'),
(3, 'image/c3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` char(5) NOT NULL,
  `customer_id` char(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` char(1) NOT NULL,
  `type` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `type`) VALUES
('K', 'Kids'),
('M', 'Men'),
('W', 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `contactus_submissions`
--

CREATE TABLE `contactus_submissions` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` char(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` char(10) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `phone`, `district_id`) VALUES
('CUS001', 'Dulmini Sandunika', 'duluweeraddana143@gmail.com', '0717191967', 0),
('mas', 'Mashan', 'mas@gmail.com', '0771637551', 20);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(11) NOT NULL,
  `name` char(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `name`) VALUES
(1, 'Ampara'),
(2, 'Anuradhapura	'),
(3, 'Badulla'),
(4, 'Batticaloa'),
(5, 'Colombo'),
(6, 'Galle'),
(7, 'Gampaha'),
(8, 'Hambantota'),
(9, 'Jaffna'),
(10, 'Kalutara'),
(11, 'Kandy'),
(12, 'Kegalle'),
(13, 'Kilinochchi'),
(14, 'Kurunegala'),
(15, 'Mannar'),
(16, 'Matale'),
(17, 'Matara	'),
(18, 'Moneragala'),
(19, 'Mullaitivu'),
(20, 'Nuwara Eliya'),
(21, 'Polonnaruwa'),
(22, 'Puttalam'),
(23, 'Ratnapura'),
(24, 'Trincomalee'),
(25, 'Vavuniya');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` char(7) NOT NULL,
  `c_id` char(6) NOT NULL,
  `date` date NOT NULL,
  `amount` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` char(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category_id` char(1) NOT NULL,
  `weight` double NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `brand_id`, `image`, `price`, `category_id`, `weight`, `location`) VALUES
('M0001', 'RUNNING TYLO SHOES', 'Iconic look and superior performance makes it ideal for everyday runner Textile and Mesh upper for lightweight and breathability. Lightstrike IMEVA midsole with the rubber outsole provides best durability.', 1, 'image/product/M0001.jpg', 15411.6, 'M', 0, '0'),
('W0001', 'Nike Air Max 270', 'The bold silhouette of Nike Air lifts the Nike Air Max 270 React to new heights, while the Nike React foam midsole delivers exceptional cushioning. Imagine all-day comfort with unstoppable style.', 2, 'image/product/W0001.jpg', 7628.6, 'W', 0, '0'),
('K0001', 'T8036 Blck 31 - Odel', 'The Nike Air VaporMax 2019 is covered in a translucent layer that shows you the inner layers of the shoe. VaporMax Air cushioning is also translucent to let you see the air you\'re standing on.', 3, 'image/product/K0001.jpg', 5360, 'K', 0, '0'),
('W0002', 'Running shoes', 'Get it for 2016 Fashion Nike women running shoes Nike Elite Crew Basketball Sock - Dicks Sporting Goods', 1, 'image/product/W0002.jpg', 2600, 'W', 0, '0'),
('K002', 'DAME 6 SHOES', 'Fight for every possession with Damian Lillard style. These juniors\' adidas basketball shoes celebrate Dame\'s quiet leadership and bold charisma on and off the floor. Ultralight cushioning lets you create space in comfort. Start and stop on a dime.', 1, 'image/product/K0002.jpg', 3500, 'K', 0, '0'),
('M0002', 'Nike Air Vortex Mens', 'Fight for every possession with Damian Lillard style. These juniors\' adidas basketball shoes celebrate Dame\'s quiet leadership and bold charisma on and off the floor. Ultralight cushioning lets you create space in comfort. Start and stop on a dime.', 2, 'image/product/M0002.jpg', 5000, 'M', 0, '0'),
('K0003', 'Nike sandals slippers', 'Fight for every possession with Damian Lillard style. These juniors\' adidas basketball shoes celebrate Dame\'s quiet leadership and bold charisma on and off the floor. Ultralight cushioning lets you create space in comfort. Start and stop on a dime.', 2, 'image/product/K0003.jpg', 1200, 'K', 0, '0'),
('W0003', 'High Wedges', 'Tara High Wedge Crochet Shoes', 3, 'image/product/W0003.jpg', 3500, 'W', 0, '0'),
('M0003', 'Unisex\'s Crocband Clogs', 'Fight for every possession with Damian Lillard style. These juniors\' adidas basketball shoes celebrate Dame\'s quiet leadership and bold charisma on and off the floor. Ultralight cushioning lets you create space in comfort. Start and stop on a dime.', 2, 'image/product/M0003.jpeg', 5450, 'M', 0, '0'),
('K0004', 'KIDS FLIP FLOPS', 'UPPER :RUBBER\r\nSOLE :EVA', 4, 'image/product/K0004.jpg', 950, 'K', 0, '0'),
('M0004', 'Samsons Men’s Sandal', 'SKU: AA041106\r\nCategories: Men, Sandals\r\nBrand: Samsons', 4, 'image/product/M0004.jpg', 949, 'M', 0, '0'),
('W0004', 'Bata Comfit Ladies ', 'Disclaimer: There may be a slight color variation in the image from original product.', 4, 'image/product/W0004.jpg', 1500, 'W', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `p_id` char(5) NOT NULL,
  `u_id` char(6) NOT NULL,
  `r_num` int(11) NOT NULL,
  `r_text` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`p_id`, `u_id`, `r_num`, `r_text`) VALUES
('M0001', 'CUS001', 4, 'Good'),
('M0001', 'CUS002', 5, 'Excellent');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_price`
--

CREATE TABLE `shipping_price` (
  `location` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL,
  `max_distance` int(11) NOT NULL,
  `weight_price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` char(5) NOT NULL,
  `size` char(3) NOT NULL,
  `availabe` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `size`, `availabe`) VALUES
('M0001', '30', 15),
('M0001', '32', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` char(6) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `role`) VALUES
('ADM001', '202cb962ac59075b964b07152d234b70', 'admin'),
('CUS001', '202cb962ac59075b964b07152d234b70', 'customer'),
('mas', '202cb962ac59075b964b07152d234b70', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`product_id`),
  ADD KEY `c_id` (`customer_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus_submissions`
--
ALTER TABLE `contactus_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `location` (`location`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`p_id`,`u_id`);

--
-- Indexes for table `shipping_price`
--
ALTER TABLE `shipping_price`
  ADD PRIMARY KEY (`location`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`,`size`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `contactus_submissions`
--
ALTER TABLE `contactus_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
