-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 06:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+06:30";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzamarui`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `ContactusID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `Message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`ContactusID`, `Name`, `Email`, `Phone`, `Message`) VALUES
(1, 'Willian', 'willian@gmail.com', '09123456789', 'Testing Message'),
(2, 'Test Name', 'test@email.com', '00123456789', 'No Acc Test Message');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `ProfilePicture` varchar(255) NOT NULL,
  `Address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `Email`, `Password`, `DateOfBirth`, `Phone`, `Gender`, `ProfilePicture`, `Address`) VALUES
(1, 'John', 'johnsmith@gmail.com', 'John@123', '2022-08-11', '09123456789', 'Male', '', 'Yangon'),
(5, 'Will', 'willsmith@gmail.com', 'Will@123', '2000-07-22', '09234567891', 'Female', 'CustomerProfile/477e9b8562ee5e5bdf9004d6df296f1a.jpg', 'YGN'),
(8, 'Willian', 'willian@gmail.com', 'Will@123', '1999-08-01', '09123456789', 'Female', 'Profile/Profile.png', 'SanChaung Tsp, Yangon.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `OrderQty` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `OrderDate` varchar(30) NOT NULL,
  `PaymentType` varchar(50) NOT NULL,
  `Screenshot` varchar(255) NOT NULL,
  `DeliveryType` varchar(50) NOT NULL,
  `DeliveryAddress` varchar(255) NOT NULL,
  `ContactPhone` varchar(11) NOT NULL,
  `PizzaID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderQty`, `TotalAmount`, `OrderDate`, `PaymentType`, `Screenshot`, `DeliveryType`, `DeliveryAddress`, `ContactPhone`, `PizzaID`, `CustomerID`) VALUES
(1, 10, 95000, '2022-09-17', 'cod/Cash', '', 'current', 'SanChaung Tsp, Yangon.', '09123456789', 3, 8),
(2, 5, 37500, '2022-09-18', 'online/CBpay-09123456789', 'Payment/2022-09-18-CBpay.png', 'current', 'SanChaung Tsp, Yangon.', '09123456789', 4, 8),
(3, 5, 47500, '2022-09-18', 'cod/Cash', '', 'new', 'KyiMyinDine Tsp, Yangon.', '09123498765', 3, 8),
(4, 5, 42500, '2022-09-18', 'online/Wave-09123456789', 'Payment/2022-09-18-Wave.png', 'new', 'Lathar Tsp, Yangon.', '09123459876', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `PizzaID` int(11) NOT NULL,
  `PizzaName` varchar(50) NOT NULL,
  `UnitPrice` int(11) NOT NULL,
  `TotalQuantities` int(11) NOT NULL,
  `PizzaPicture` varchar(255) NOT NULL,
  `Ingredients` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`PizzaID`, `PizzaName`, `UnitPrice`, `TotalQuantities`, `PizzaPicture`, `Ingredients`) VALUES
(1, 'Chicken Tender Pizza', 9500, 25, 'Pizza/chiken-tender-pizza.jpg', 'Chicken Tender, Onion, Mushroom, Corn,\r\nBlack Olive, Paprika, Steak Bulgalbi Sauce, Mayonnaise, Mozzarella Cheese.'),
(2, 'Double Cheese Pizza', 8500, 5, 'Pizza/DoubleCheese.jpeg', 'Flour, Egg, Milk, Tomato-paste, Mozzarella Cheese, Mayonnaise.'),
(3, 'Hawaiian Pizza', 9500, 0, 'Pizza/Hawaiian_Pizza.jpg', 'Bacon, Chicken, Mushroon, Lemon Basil, Cherry Tomato, Green Pepper, Flour, Egg, Milk, Tomato-paste, Mozzarella Cheese.'),
(4, 'Bulgogi Pizza', 7500, 25, 'Pizza/Bulgogi-pizza-2.jpg', 'Onion, Mushroom, Spinach, Black Olive,\r\nPaprika, Mozzarella Cheese, Tomato Sauce, Sweet Ranch Sauce.'),
(5, 'Korea Surf Turf Pizza', 10000, 10, 'Pizza/korea_surf_turf.jpg', 'Korean-style Beef, Shrimp, Pickle,\r\nRed Chilli Flake, Onion,  Mushroom, Pizza Maru Hot Seasoning, Paprika, Sweet Ranch Sauce, Sour Cream Sauce, Potato ,Mozzarella Cheese.'),
(6, 'Mango Pizza', 8500, 13, 'Pizza/mango_pizza.jpg', 'Tomato Sauce, Onion, Mushroom, Mango,\r\nScallop, Shrimp, Squid, Pilaf Sauce, Broccoli, Topping Cheese, Black Olive, Barbecue Sauce.'),
(7, 'Potato Pizza', 7500, 25, 'Pizza/potato-pizza.jpg', 'Ham, Onion, Potato Wedge, Bacon, Corn, Mayonnaise, Mozzarella Cheese.'),
(8, 'Tropical Seafood Pizza', 11000, 15, 'Pizza/TorpicalSeafood.jpeg', 'Shrimp, Squid, Crab Stick, Clam, Pineapple, Mayonnaise, Mozzarella Cheese.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`ContactusID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`PizzaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `ContactusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `PizzaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
