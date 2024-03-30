-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 06:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Pizza'),
(2, 'Hamburger'),
(3, 'Sandwich'),
(4, 'Fries');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `food_price` varchar(100) NOT NULL,
  `food_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `category_id`, `food_price`, `food_image`) VALUES
(1, 'Beef Pizza', 1, '12000', 'Beef Pizza.png'),
(2, 'Veggie Pizza', 1, '10000', 'Veggie Pizza.png'),
(3, 'Supreme Pizza', 1, '15000', 'Supreme Pizza.png'),
(4, 'Chicken Burger', 2, '5000', 'chicken burger.png'),
(5, 'Double Cheese Burger', 2, '8000', 'Double-Cheese-Burger.png'),
(6, 'Premium Chicken Burger', 2, '10000', 'double-premium-chicken-burger.png'),
(7, 'Chicken Quesadilla Sandwich', 3, '7500', 'Chicken Quesadilla.png'),
(8, 'Cheese Sandwich', 3, '3500', 'Cheese Sandwich.png'),
(9, 'Bacon & Cheese (Fries)', 4, '6000', 'Bacon & Cheese.png'),
(10, 'Curly Fries', 4, '4500', 'Curly fries.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `orderlist_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `food_qty` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_lists`
--

CREATE TABLE `order_lists` (
  `orderlist_id` int(11) NOT NULL,
  `order_no` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `card_no` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `send_date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `password`, `phone`, `address`, `profile_image`, `role`) VALUES
(1, 'Nitar Ye', 'nitar1111@gmail.com', 'nitar123', '0', '', '', 'Admin'),
(2, 'Leonel', 'leonel2244@gmail.com', 'db54cf49a4fb092e9e283eec1a3690', '', '', '', 'Admin'),
(3, 'David', 'david123@gmail.com', '52c0cf259947cc595ab23063af2db0', '', '', '', 'Customer'),
(4, 'Justin', 'Justin1414@gmail.com', '44e34029603250468d67ed678896a7', '', '', '', 'Customer'),
(5, 'John', 'john7878@gmail.com', '3f8b7e476c1f81bcd82c9f28259c20', '', '', '', 'Customer'),
(6, 'User 6', 'user6666@gmail.com', '75eeca98a3fa2036f1b249ae6525a6', '', '', '', 'Customer'),
(7, 'User 7', 'user7777@gmail.com', 'a0e98c3f116f663f4905d9e9a0dd73', '', '', '', 'Customer'),
(8, 'User 8', 'user8888@gmail.com', '8c32e815616d5affaaec2b65ac9a5f', '', '', '', 'Customer'),
(9, 'User 9', 'user9999@gmail.com', '014012eff1d911f8d8a6b625d439c1', '', '', '', 'Customer'),
(10, 'User 10', 'u1010@gmail.com', '6ea75f7f079b4f5e2a66e703b28db2', '', '', '', 'Customer'),
(11, 'User 11', 'u0111@gmail.com', 'd548e70d293d9fc979ca29a6e2a2f6', '', '', '', 'Customer'),
(12, 'User 12', 'u012@gmail.com', 'bb2e898c41893305569a42600e38ca', '', '', '', 'Customer'),
(13, 'User 13', 'u013@gmail.com', '187860dacb7168463df40f1f8cff43', '', '', '', 'Customer'),
(14, 'User 14', 'u014@gmail.com', '4a88a2a5c4672fc8224b68fcba6df5', '', '', '', 'Customer'),
(15, 'User 15', 'u015@gmail.com', '1017b8fae6c6e59dd5f9f03e691041', '', '', '', 'Customer'),
(16, 'User 16', 'u016@gmail.com', '42bd6ea606ef1165d0f4af9b809ddd', '', '', '', 'Customer'),
(17, 'User 17', 'u017@gmail.com', '52612ec1d7a91e54bdda83fec21a19', '', '', '', 'Customer'),
(18, 'User 18', 'u018@gmail.com', '7f0db6f2e0dab9703ef6d63dda44a6', '', '', '', 'Customer'),
(19, 'User 19', 'u019@gmail.com', '1e9d8015ef403db47441354c6d48fe', '', '', '', 'Customer'),
(20, 'User 20', 'u2020@gmail.com', '6c595d70b84f930b3a8a4ae4663c5c', '', '', '', 'Customer'),
(21, 'User 21', 'u2121@gmail.com', '4a4ec1c3a0a5542b906e76693b6ae8', '', '', '', 'Customer'),
(22, 'User 22', 'u0022@gmail.com', '373965f60b4cb3a771f416ddf04e44', '', '', '', 'Customer'),
(23, 'User 23', 'u2323@gmail.com', '94fa2432d72368c2733b481f86bad1', '', '', '', 'Customer'),
(24, 'User 24', 'u2424@gmail.com', '8f4d2bdbcb065a3b12640d13fa903d', '', '', '', 'Customer'),
(25, 'User 25', 'u2525@gmail.com', 'aca882d640600f1ceda762fd40e785', '', '', '', 'Customer'),
(26, 'User 26', 'u2626@gmail.com', 'b48c65ac1ad32aa8a1139788f6765b', '', '', '', 'Customer'),
(27, 'User 27', 'u2727@gmail.com', '3b4942da18cd5a13ec1308bdcab414', '', '', '', 'Customer'),
(28, 'User 28', 'u2828@gmail.com', '6123311f8ca6c7ee142a0d91e245d6', '', '', '', 'Customer'),
(29, 'User 29', 'u2929@gmail.com', '33f2bc98f768c57756e789b0b34f3f', '', '', '', 'Customer'),
(30, 'User 30', 'u3030@gmail.com', '301d9aeaff2dd1dd7da824f599b517', '', '', '', 'Customer'),
(31, 'User 31', 'u3131@gmail.com', '1d7e50fe812f675a743c5eed40caf7', '', '', '', 'Customer'),
(32, 'User 32', 'u3232@gmail.com', 'e3c6fff611c3269684c176a6e0ed8a', '', '', '', 'Customer'),
(33, 'User 33', 'u3333@gmal.com', 'u3333', '', '', '', 'Customer'),
(34, 'User 34', 'u3434@gmail.com', 'b53e5d0c981bc6659ebabfd593790f', '', '', '', 'Customer'),
(35, 'User 35', 'u3535@gmail.com', 'c74085ebc94d6eb47f2cba1f913e2c', '', '', '', 'Customer'),
(36, 'Nitar', 'ni1818@gmail.com', '114a701a99a2152c7426ddd7371e7d', '', '', '', 'Admin'),
(37, 'Victor', 'victor2244@gmail.com', 'a5d72dac4eb04eded5cf5a9cc34e6c', '', '', '', 'Admin'),
(38, 'User 38', 'u3838@gmail.com', '7906b7174f3a1082dfb0ded0ca0c4d', '', '', '', 'Customer'),
(39, 'User Test 1', 'ut0011@gmail.com', '884bf9e95ce748810aa7a10352b152', '0922335566', 'Mandalay', '', 'Customer'),
(40, 'Test 2', 'test2@gmail.com', 'ad0234829205b9033196ba818f7a87', '0944335566', 'Yangon', '', 'Customer'),
(41, 'Test 3', 'test3@gamil.com', '9cb45d54b2ccdc1c486e2f3eb87fbe', '0989898989', 'Yangon', '', 'Customer'),
(42, 'Test 4', 'test4@gmail.com', 'fd196d87b9d4752fa86a3ddf148141', '095656889', 'Pyin Oo Lwin', '', 'Customer'),
(43, 'Carl', 'carl22@gmail.com', '59192bfb8cfa4d0f1c2dceaf51acad', '0945665478', 'Thailand', '', 'Customer'),
(44, 'Peter', 'peter77@gmail.com', 'f765e7730eb9ddd0b469dc4f9649b1', '0924777724', 'London', '', 'Customer'),
(45, 'Herry', 'herry77@gmail.com', '0b9efda3c16e667e83dcc22a2ddef6', '0934666643', 'New York', '', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `order_lists`
--
ALTER TABLE `order_lists`
  ADD PRIMARY KEY (`orderlist_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_lists`
--
ALTER TABLE `order_lists`
  MODIFY `orderlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
