-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2025 at 07:59 PM
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
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `hotelID` int(11) NOT NULL,
  `hotelName` longtext NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `userID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `pepoleValue` int(11) NOT NULL,
  `nights` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `bookingName` varchar(255) NOT NULL,
  `bookingEmail` varchar(255) NOT NULL,
  `bookingPhone` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Pending',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `hotelID`, `hotelName`, `startDate`, `endDate`, `userID`, `price`, `pepoleValue`, `nights`, `discount`, `bookingName`, `bookingEmail`, `bookingPhone`, `type`, `create_at`) VALUES
(5, 40, 'Radisson Blu Jaipur', '2025-04-06', '2025-04-12', 11, 60000, 2, 6, 18, 'jahid', 'jahid@gmail.com', '7894561230', 'Reject', '2025-04-06 09:33:40'),
(6, 53, 'Park Hyatt Goa Resort', '2025-04-23', '2025-04-25', 11, 36000, 2, 2, 18, 'kdscoder', 'kdscoder@gmail.com', '789456123', 'Pending', '2025-04-06 16:08:00'),
(7, 40, 'Radisson Blu Jaipur', '2025-05-31', '2025-06-02', 12, 20000, 2, 2, 18, 'Jahid Khan', 'jahidsofficials@gmail.com', '23534465656456', 'Accept', '2025-05-31 10:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `lat` decimal(9,6) DEFAULT NULL,
  `log` decimal(9,6) DEFAULT NULL,
  `services` text DEFAULT NULL,
  `food` text DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `room_andHotelImages` text DEFAULT NULL,
  `rooms` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `description`, `city`, `rate`, `mrp`, `discount`, `location`, `lat`, `log`, `services`, `food`, `poster`, `room_andHotelImages`, `rooms`, `timestamp`) VALUES
(31, 'Hotel Amber Palace', 'Luxury hotel near Amber Fort', 'Jaipur', 4.80, 12000.00, 15.00, 'Amber Road, Jaipur', 26.985700, 75.851000, 'Swimming Pool, Gym, Spa', 'Breakfast, Buffet, Indian Cuisine', 'amber_poster.jpg', 'amber_room1.jpg, amber_room2.jpg', 50, '2025-02-21 18:17:20'),
(32, 'Rajputana Palace Bikaner', 'Heritage hotel with royal decor', 'Jaipur', 4.50, 4500.00, 10.00, 'M.I. Road, Jaipur', 26.913500, 75.813000, 'Bar, Conference Hall', 'Buffet, Continental, Vegan Options', 'rajputana_poster.jpg', 'rajputana_room1.jpg,rajputana_room2.jpg', 40, '2025-02-21 18:17:20'),
(33, 'Pink City Hotel', 'Affordable stay with modern amenities', 'Jaipur', 4.20, 4000.00, 20.00, 'Bapu Bazaar, Jaipur', 26.919600, 75.819000, 'Wi-Fi, Parking, Elevator', 'Breakfast, Indian, Vegetarian', 'pinkcity_poster.jpg', 'pinkcity_room1.jpg, pinkcity_room2.jpg', 120, '2025-02-21 18:17:20'),
(34, 'Trident Jaipur', 'Sophisticated hotel with luxury services', 'Jaipur', 4.70, 15000.00, 12.00, 'Amber Fort Road, Jaipur', 26.991800, 75.844800, 'Free Wi-Fi, Outdoor Pool', 'Buffet, Vegan, Indian Cuisine', 'trident_poster.jpg', 'trident_room1.jpg, trident_room2.jpg', 60, '2025-02-21 18:17:20'),
(35, 'The Lalit Jaipur', 'Elegant hotel with fine dining options', 'Jaipur', 4.60, 11000.00, 18.00, 'Jagatpura, Jaipur', 26.822000, 75.817000, 'Spa, Gym, 24-Hour Room Service', 'Continental, Buffet, Vegan', 'lalit_poster.jpg', 'lalit_room1.jpg, lalit_room2.jpg', 90, '2025-02-21 18:17:20'),
(36, 'Holiday Inn Jaipur', 'Comfortable hotel with easy access to major attractions', 'Jaipur', 4.40, 7500.00, 14.00, 'Raja Park, Jaipur', 26.902100, 75.808500, 'Free Parking, Room Service', 'Indian, Breakfast, Vegetarian', 'holidayinn_poster.jpg', 'holidayinn_room1.jpg, holidayinn_room2.jpg', 70, '2025-02-21 18:17:20'),
(37, 'Sajjan Niwas', 'Traditional Rajasthani style hotel', 'Jaipur', 4.30, 4500.00, 25.00, 'Sindhi Camp, Jaipur', 26.924400, 75.824300, 'Bar, Laundry', 'Buffet, Vegetarian, Indian', 'sajjan_poster.jpg', 'sajjan_room1.jpg, sajjan_room2.jpg', 50, '2025-02-21 18:17:20'),
(38, 'Oberoi Rajvilas', 'Palatial hotel with royal heritage', 'Jaipur', 5.00, 25000.00, 10.00, 'Kookas, Jaipur', 27.004500, 75.864700, 'Spa, Tennis Court, Pool', 'Buffet, International, Indian', 'oberoi_poster.jpg', 'oberoi_room1.jpg, oberoi_room2.jpg', 30, '2025-02-21 18:17:20'),
(39, 'Le Meridien Jaipur', 'Chic and modern hotel with exquisite amenities', 'Jaipur', 4.70, 13000.00, 13.00, 'Mansarovar, Jaipur', 26.917400, 75.776300, 'Spa, Indoor Pool', 'Continental, Vegan, Buffet', 'meridien_poster.jpg', 'meridien_room1.jpg, meridien_room2.jpg', 100, '2025-02-21 18:17:20'),
(40, 'Radisson Blu Jaipur', 'Stylish hotel with easy access to the city center', 'Jaipur', 4.50, 10000.00, 18.00, 'Tonk Road, Jaipur', 26.896700, 75.803500, 'Wi-Fi, Gym', 'Indian, Breakfast, Continental', 'radisson_poster.jpg', 'radisson_room1.jpg, radisson_room2.jpg', 110, '2025-02-21 18:17:20'),
(41, 'The Imperial Delhi', 'Luxury colonial style hotel', 'Delhi', 4.90, 18000.00, 20.00, 'Janpath, New Delhi', 28.628000, 77.215200, 'Free Wi-Fi, Outdoor Pool', 'Continental, Buffet, Vegan', 'imperial_poster.jpg', 'imperial_room1.jpg, imperial_room2.jpg', 60, '2025-02-21 18:17:20'),
(42, 'ITC Maurya', 'World-class luxury hotel with fine dining', 'Delhi', 4.80, 22000.00, 12.00, 'Sardar Patel Marg, New Delhi', 28.581300, 77.179900, 'Bar, Spa, Pool', 'Buffet, Indian, Continental', 'itcmaurya_poster.jpg', 'itcmaurya_room1.jpg, itcmaurya_room2.jpg', 80, '2025-02-21 18:17:20'),
(43, 'Leela Palace New Delhi', 'Elegant and grand hotel with world-class service', 'Delhi', 4.90, 25000.00, 15.00, 'Diplomatic Enclave, New Delhi', 28.569700, 77.185500, 'Spa, Gym, Pool', 'Buffet, Vegan, Indian', 'leela_poster.jpg', 'leela_room1.jpg, leela_room2.jpg', 70, '2025-02-21 18:17:20'),
(44, 'Shangri-La Hotel', 'Luxury hotel with panoramic views of the city', 'Delhi', 4.60, 15000.00, 10.00, 'Connaught Place, New Delhi', 28.623800, 77.219400, 'Pool, Wi-Fi', 'Breakfast, Continental, Indian', 'shangrila_poster.jpg', 'shangrila_room1.jpg, shangrila_room2.jpg', 90, '2025-02-21 18:17:20'),
(45, 'Taj Mahal Hotel', 'Iconic hotel known for its magnificent service', 'Delhi', 4.80, 20000.00, 10.00, 'Man Singh Road, New Delhi', 28.616900, 77.219000, '24-Hour Room Service, Spa', 'Continental, Vegan, Indian', 'taj_poster.jpg', 'taj_room1.jpg, taj_room2.jpg', 110, '2025-02-21 18:17:20'),
(46, 'Radisson Blu Dwarka', 'Modern hotel with convenient transportation access', 'Delhi', 4.30, 8500.00, 20.00, 'Dwarka, New Delhi', 28.592000, 77.072800, 'Gym, Conference Room', 'Breakfast, Continental, Indian', 'radissonblu_poster.jpg', 'radissonblu_room1.jpg, radissonblu_room2.jpg', 120, '2025-02-21 18:17:20'),
(47, 'Hyatt Centric', 'Contemporary hotel with trendy amenities', 'Delhi', 4.50, 12000.00, 15.00, 'Janakpuri, New Delhi', 28.609000, 77.035300, 'Bar, Wi-Fi, Spa', 'Continental, Buffet, Vegan', 'hyattcentric_poster.jpg', 'hyattcentric_room1.jpg, hyattcentric_room2.jpg', 100, '2025-02-21 18:17:20'),
(48, 'Novotel New Delhi', 'Chic hotel with great dining options', 'Delhi', 4.40, 9500.00, 10.00, 'Saket, New Delhi', 28.514000, 77.201100, 'Wi-Fi, Pool', 'Indian, Buffet, Continental', 'novotel_poster.jpg', 'novotel_room1.jpg, novotel_room2.jpg', 70, '2025-02-21 18:17:20'),
(49, 'Holiday Inn Mayur Vihar', 'Comfortable stay with great accessibility', 'Delhi', 4.20, 5500.00, 15.00, 'Mayur Vihar, New Delhi', 28.553100, 77.299000, 'Laundry, Free Wi-Fi', 'Breakfast, Indian, Vegetarian', 'holidayinn_mayur_poster.jpg', 'holidayinn_mayur_room1.jpg, holidayinn_mayur_room2.jpg', 90, '2025-02-21 18:17:20'),
(50, 'The Park New Delhi', 'A blend of modern luxury and traditional service', 'Delhi', 4.30, 13000.00, 18.00, 'Connaught Place, New Delhi', 28.626400, 77.215100, 'Spa, Gym', 'Buffet, Vegan, Indian', 'park_poster.jpg', 'park_room1.jpg, park_room2.jpg', 80, '2025-02-21 18:17:20'),
(51, 'Taj Exotica Resort & Spa', 'Luxury resort with beachside views', 'Goa', 4.90, 22000.00, 15.00, 'Benaulim, Goa', 15.261700, 73.941500, 'Pool, Spa, Beach Access', 'Indian, Seafood, Buffet', 'taj_exotica_poster.jpg', 'taj_exotica_room1.jpg, taj_exotica_room2.jpg', 50, '2025-02-21 18:17:20'),
(52, 'The Leela Goa', 'Beautiful resort with serene surroundings', 'Goa', 4.80, 25000.00, 12.00, 'Cavelossim Beach, Goa', 15.199100, 73.957900, 'Spa, Beach Access, Gym', 'Continental, Vegan, Buffet', 'leela_goa_poster.jpg', 'leela_goa_room1.jpg, leela_goa_room2.jpg', 60, '2025-02-21 18:17:20'),
(53, 'Park Hyatt Goa Resort', 'A luxurious beach resort with world-class amenities', 'Goa', 4.70, 18000.00, 18.00, 'Arossim Beach, Goa', 15.298600, 73.998200, 'Outdoor Pool, Spa', 'Indian, Seafood, Breakfast', 'parkhyatt_poster.jpg', 'parkhyatt_room1.jpg, parkhyatt_room2.jpg', 70, '2025-02-21 18:17:20'),
(54, 'Holiday Inn Resort Goa', 'Relaxing resort with beach access', 'Goa', 4.30, 9500.00, 10.00, 'Cavelossim Beach, Goa', 15.202700, 73.938100, 'Wi-Fi, Spa', 'Breakfast, Continental, Vegan', 'holidayinn_resort_poster.jpg', 'holidayinn_resort_room1.jpg, holidayinn_resort_room2.jpg', 100, '2025-02-21 18:17:20'),
(55, 'Alila Diwa Goa', 'Luxury resort with breathtaking views', 'Goa', 4.80, 17000.00, 15.00, 'Majorda, Goa', 15.278600, 73.986600, 'Pool, Restaurant, Bar', 'Indian, Continental, Vegan', 'alila_poster.jpg', 'alila_room1.jpg, alila_room2.jpg', 90, '2025-02-21 18:17:20'),
(56, 'Goa Marriott Resort & Spa', 'A waterfront resort offering a relaxing getaway', 'Goa', 4.70, 16000.00, 12.00, 'Miramar, Goa', 15.517100, 73.803100, 'Gym, Pool, Beach Access', 'Breakfast, Indian, Vegan', 'marriott_goa_poster.jpg', 'marriott_goa_room1.jpg, marriott_goa_room2.jpg', 120, '2025-02-21 18:17:20'),
(57, 'Radisson Blu Resort Goa', 'Contemporary beachfront hotel with luxury amenities', 'Goa', 4.60, 14000.00, 10.00, 'Cavelossim Beach, Goa', 15.242500, 73.952100, 'Spa, Conference Room', 'Continental, Seafood, Indian', 'radissonblu_goa_poster.jpg', 'radissonblu_goa_room1.jpg, radissonblu_goa_room2.jpg', 80, '2025-02-21 18:17:20'),
(58, 'W Goa', 'Stylish and vibrant hotel for a fun experience', 'Goa', 4.50, 13000.00, 20.00, 'Vagator Beach, Goa', 15.550400, 73.741400, 'Outdoor Pool, Bar', 'Vegan, Buffet, Continental', 'w_goa_poster.jpg', 'w_goa_room1.jpg, w_goa_room2.jpg', 60, '2025-02-21 18:17:20'),
(59, 'Vivanta by Taj - Panaji', 'Modern hotel with great views of the river', 'Goa', 4.60, 15000.00, 18.00, 'Panaji, Goa', 15.498700, 73.823100, 'Bar, Spa, Pool', 'Buffet, Continental, Vegan', 'vivanta_poster.jpg', 'vivanta_room1.jpg, vivanta_room2.jpg', 110, '2025-02-21 18:17:20'),
(60, 'Marbella Beach Resort', 'A charming resort with serene surroundings', 'Goa', 4.40, 11000.00, 15.00, 'Cavelossim, Goa', 15.242700, 73.929400, 'Pool, Restaurant', 'Indian, Seafood, Continental', 'marbella_poster.jpg', 'marbella_room1.jpg, marbella_room2.jpg', 90, '2025-02-21 18:17:20'),
(61, 'The Taj Mahal Palace', 'Iconic luxury hotel overlooking the Gateway of India', 'Mumbai', 4.90, 28000.00, 12.00, 'Apollo Bunder, Colaba, Mumbai', 18.921700, 72.833100, 'Spa, Pool, Fine Dining', 'Continental, Indian, Seafood', 'taj_mumbai_poster.jpg', 'taj_mumbai_room1.jpg, taj_mumbai_room2.jpg', 85, '2025-02-21 18:17:20'),
(62, 'The Oberoi Mumbai', 'Contemporary luxury with stunning sea views', 'Mumbai', 4.80, 25000.00, 15.00, 'Nariman Point, Mumbai', 18.925700, 72.823300, 'Gym, Spa, Rooftop Bar', 'Buffet, Indian, Continental', 'oberoi_mumbai_poster.jpg', 'oberoi_mumbai_room1.jpg, oberoi_mumbai_room2.jpg', 90, '2025-02-21 18:17:20'),
(63, 'ITC Grand Central', 'Elegant hotel in the heart of Mumbai', 'Mumbai', 4.70, 18000.00, 18.00, 'Parel, Mumbai', 19.010800, 72.837900, 'Pool, Spa, Business Center', 'Indian, Continental, Vegan', 'itc_mumbai_poster.jpg', 'itc_mumbai_room1.jpg, itc_mumbai_room2.jpg', 100, '2025-02-21 18:17:20'),
(64, 'JW Marriott Mumbai', 'Luxury hotel near the airport', 'Mumbai', 4.60, 16000.00, 14.00, 'Juhu, Mumbai', 19.102300, 72.828800, 'Outdoor Pool, Gym', 'Buffet, Seafood, Continental', 'marriott_mumbai_poster.jpg', 'marriott_mumbai_room1.jpg, marriott_mumbai_room2.jpg', 110, '2025-02-21 18:17:20'),
(65, 'Hotel Marine Plaza', 'Beachfront hotel with Art Deco charm', 'Mumbai', 4.40, 12000.00, 20.00, 'Marine Drive, Mumbai', 18.943200, 72.823400, 'Rooftop Restaurant, Bar', 'Indian, Continental, Chinese', 'marine_poster.jpg', 'marine_room1.jpg, marine_room2.jpg', 80, '2025-02-21 18:17:20'),
(66, 'Trident Nariman Point', 'Business hotel with elegant interiors', 'Mumbai', 4.50, 14000.00, 16.00, 'Nariman Point, Mumbai', 18.926500, 72.823000, 'Spa, Pool, Wi-Fi', 'Indian, Vegan, Buffet', 'trident_mumbai_poster.jpg', 'trident_mumbai_room1.jpg, trident_mumbai_room2.jpg', 95, '2025-02-21 18:17:20'),
(67, 'The Leela Mumbai', 'Luxurious hotel near the airport', 'Mumbai', 4.70, 22000.00, 10.00, 'Andheri East, Mumbai', 19.113700, 72.868800, 'Spa, Fine Dining, Pool', 'Continental, Indian, Pan-Asian', 'leela_mumbai_poster.jpg', 'leela_mumbai_room1.jpg, leela_mumbai_room2.jpg', 75, '2025-02-21 18:17:20'),
(68, 'Hyatt Regency Mumbai', 'Modern hotel with great connectivity', 'Mumbai', 4.30, 10000.00, 15.00, 'Santacruz East, Mumbai', 19.089100, 72.865500, 'Gym, Pool, Restaurant', 'Buffet, Indian, Continental', 'hyatt_mumbai_poster.jpg', 'hyatt_mumbai_room1.jpg, hyatt_mumbai_room2.jpg', 105, '2025-02-21 18:17:20'),
(69, 'Novotel Mumbai', 'Stylish hotel in the business district', 'Mumbai', 4.20, 8500.00, 18.00, 'Juhu Beach, Mumbai', 19.105900, 72.828300, 'Pool, Bar, Wi-Fi', 'Indian, Continental, Seafood', 'novotel_mumbai_poster.jpg', 'novotel_mumbai_room1.jpg, novotel_mumbai_room2.jpg', 120, '2025-02-21 18:17:20'),
(70, 'Fariyas Hotel Mumbai', 'Comfortable stay near business hubs', 'Mumbai', 4.10, 7000.00, 20.00, 'Colaba, Mumbai', 18.921200, 72.829600, 'Restaurant, Room Service', 'Indian, Continental, Chinese', 'fariyas_poster.jpg', 'fariyas_room1.jpg, fariyas_room2.jpg', 90, '2025-02-21 18:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `password`, `gender`, `timestamp`) VALUES
(9, 'kdscoder', '456123789', '202cb962ac59075b964b07152d234b70', 'Male', '2025-03-20 18:25:09'),
(10, 'jahid khan', '1234567890', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '2025-03-20 18:34:58'),
(11, 'Amit', '789456123', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', '2025-03-20 19:06:05'),
(12, 'KdscoderNew', '7894561230', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '2025-05-31 09:31:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
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
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;