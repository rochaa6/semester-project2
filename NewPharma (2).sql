-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2021 at 10:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `NewPharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `AddressId` int(3) NOT NULL,
  `UserId` int(3) DEFAULT NULL,
  `Fname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Minitial` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Lname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AddrL1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AddrL2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `State` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Zip` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`AddressId`, `UserId`, `Fname`, `Minitial`, `Lname`, `Phone`, `AddrL1`, `AddrL2`, `City`, `State`, `Zip`) VALUES
(1, 1, 'Adam', 'J', 'Fielding', '2138932133', '4 Rocky Lane', 'Apt 7', 'Verona', 'CA', '99032'),
(2, 2, 'Leslie', '', 'Smith', '9383241334', '7 House Street', '', 'Franklin', 'ID', '83947'),
(3, 3, 'Hello', 'Y', 'Helloa', '9876542356', 'High 3', '', 'Hightown', 'ME', '98746');

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `User_Id` int(4) NOT NULL,
  `Product_Id` int(4) DEFAULT NULL,
  `Quantity` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demologin`
--

CREATE TABLE `demologin` (
  `id` int(11) NOT NULL,
  `password` char(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `demologin`
--

INSERT INTO `demologin` (`id`, `password`) VALUES
(1, 'demopass');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(3) NOT NULL,
  `userid` int(3) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `addrl1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `addrl2` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(9,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `card_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `card_num` varchar(19) COLLATE utf8_unicode_ci NOT NULL,
  `card_expMonth` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `card_expYear` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `card_cvv` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'Ready'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`id`, `userid`, `name`, `addrl1`, `addrl2`, `city`, `state`, `zip`, `total`, `order_date`, `card_name`, `card_num`, `card_expMonth`, `card_expYear`, `card_cvv`, `status`) VALUES
(1, 2, 'eee tttt', 'jei', '', 'ufdg', 'NC', '57465', '23.99', '2021-05-14 01:55:58', 'sadasd asdsf', '9875 3216 4567 2136', '05', '21', '985', 'Ready'),
(2, 2, 'henry man', 'jei', '', 'toledo', 'AR', '57465', '46.00', '2021-05-14 01:57:17', 'test my', '9875 3216 5468 3215', '08', '24', '412', 'Delivered'),
(3, 1, 'e w h', 'jei', '', 'ufdg', 'NM', '57465', '76.00', '2021-05-14 01:58:58', 'sad uytyu', '1235 1233 5465 1231', '01', '25', '215', 'Cancelled'),
(4, 1, 'sdfsdf sfdoili', 'dsfsdf 23', '', 'ddsf', 'ND', '89451', '50.48', '2021-05-17 01:45:04', 'Sam Hold', '9875 4562 3216 6548', '06', '26', '856', 'Ready'),
(5, 3, 'Hello Games', '4 high', '', 'vernon', 'CA', '98756', '19.00', '2021-05-17 02:16:02', 'Hello H', '9875 6543 3216 6548', '09', '25', '987', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `Order_Items`
--

CREATE TABLE `Order_Items` (
  `itemid` int(6) NOT NULL,
  `orderid` int(6) NOT NULL,
  `price` double(9,2) NOT NULL,
  `quantity` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Order_Items`
--

INSERT INTO `Order_Items` (`itemid`, `orderid`, `price`, `quantity`) VALUES
(8, 1, 5.00, 1),
(2, 1, 11.99, 1),
(1, 1, 7.00, 1),
(13, 2, 12.00, 1),
(1, 2, 7.00, 3),
(9, 2, 13.00, 1),
(12, 3, 20.00, 1),
(14, 3, 13.00, 2),
(10, 3, 15.00, 2),
(3, 4, 11.99, 2),
(18, 4, 26.50, 1),
(8, 5, 5.00, 1),
(1, 5, 7.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageUrl` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Category` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Price` decimal(5,2) DEFAULT NULL,
  `Amount_Available` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ID`, `Name`, `Description`, `ImageUrl`, `Category`, `Price`, `Amount_Available`) VALUES
(1, 'Sudafed', '24 tablets. 325mg. Used for sinus pressure and pain. NON-DROWSY.', '../Images/sudafed.png', 'Decongestant', '7.00', 13),
(2, 'NyQuil', '12 FL OZ (354 ml) Original Flavor Nighttime Relief for headache, fever, sore throat, minor aches, and pains. Sneezing, runny nose, and cough.', '../Images/nyquil.png', 'Decongestant', '11.99', 38),
(3, 'DayQuil', '12 FL OZ (354 ml) Original Flavor Daytime Relief for headache, fever, sore throat, minor aches, and pains. Sneezing, runny nose, and cough. NON-DROWSY', '../Images/dayquil.png', 'Decongestant', '11.99', 48),
(4, 'Advil', '50 coated tablets, 200mg. (NSAID)Ibuprofen tablets for pain relief and fever reduction.', '../Images/advil.png', 'Headache', '6.50', 30),
(5, 'Aleve', '100 caplets, 220mg (NSAID) Pain reliever/fever reducer. Lasts up to 12 hours.', '../Images/aleve.png', 'Headache', '12.00', 90),
(6, 'Tylenol', '100 tablets, 325mg. Regular strength tylenol used for pain relief and reducing fever.', '../Images/tylenol.png', 'Headache', '8.50', 89),
(7, 'MiraLAX', '17.9 oz (510g) 30 once daily doses of unflavored MiraLAX. Relieves occasional constipation and softens stool.', '../Images/miralax.png', 'General', '20.00', 70),
(8, 'TUMS', '96 chewable tablets. Extra Strength 750mg. Used to relieve heartburn and sour stomach. ', '../Images/tums.png', 'General', '5.00', 18),
(9, 'Natures Bounty Probiotic', '100 tablets, 0.5 mg. Promotes a healthy intestinal system, helps relieve constipation, gas, and bloating.', '../Images/natures_bounty_probiotic.png', 'General', '13.00', 39),
(10, 'Claritin-D', 'Claritin Indoor & Outdoor Allergies, Allergy & Congestion, 24 Hour, 10 Extended Release Tablets', '../Images/Claritin-D.jpg', 'Decongestant', '15.00', 38),
(11, 'Sinex', 'Vicks Sinex Severe Original Nasal Spray twin pack helps relieve the sinus and nasal congestion that often accompany colds, hay fever, or upper respiratory allergies. ', '../Images/sinex.png', 'Decongestant', '17.00', 50),
(12, 'Tylenol Cold Max', '24-count of Tylenol Cold Max non-drowsy cold and flu medicine with acetaminophen for multi-symptom relief', '../Images/tylenol_coldmax.png', 'Decongestant', '20.00', 79),
(13, 'Vanquish', '100 count. Intended to temporarily relieve minor pains due to frequent headache, backache, muscle aches, menstrual cramps, colds and arthritis.\r\n', '../Images/Vanquish.png', 'Headache', '12.00', 89),
(14, 'Excedrin PM', 'Excedrin PM Headache 100 count gives temporary relief of occasional headaches at night, and minor aches & pains with accompanying sleeplessness.', '../Images/Excedrin.png', 'Headache', '13.00', 28),
(16, 'Nature\'s Bounty Fish Oil', 'Nature\'s Bounty Fish Oil Omega-3, 1200mg - 60 ct', '../Images/Fish-oil.png', 'General', '23.00', 40),
(17, 'Omega-3 Vitamins', '60 Count Purity Products - Omega-3 Plus Vitamin C & D', '../Images/Omega-3.png', 'General', '30.00', 90),
(15, 'Motrin Liquid Gels Super Strength\r\n', 'For adults and children over 12 years of age, each liquid gel contains 400 milligrams of ibuprofen.', '../Images/Motrin.png', 'Headache', '17.00', 20),
(18, 'Centrum MultiGummies Men 50+', 'Contains 100% or more of the daily value of essential micronutrients, vitamins D3, B6, and B12. 90 count', '../Images/Centrum.png', 'General', '26.50', 39);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `User_Type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `User_Type`) VALUES
(1, 'Admin1', '$2y$10$lJzohbdKKMy7JrzDsvokqO5g7tyHi9QU6BSkL7HiU1yrwafAsrQby', 'admin@gmail.com', '2021-05-12 19:46:24', 'Admin'),
(2, 'Leslie1', '$2y$10$RWfw5Fb8bNeHCTVjse7UTe2.h244wfiaC7WpWFw7E8b5kIqExVFHa', 'leslie@yahoo.com', '2021-05-12 20:10:25', 'Customer'),
(3, 'HelloGames', '$2y$10$5MOR2YRa12TclzEC.h9i8O9VXzFuZuAIjYvri.3nfYzxlN7SoPaDK', 'hello@gmail.com', '2021-05-16 22:12:06', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`AddressId`),
  ADD UNIQUE KEY `AddressId` (`AddressId`);

--
-- Indexes for table `demologin`
--
ALTER TABLE `demologin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `AddressId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `demologin`
--
ALTER TABLE `demologin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
