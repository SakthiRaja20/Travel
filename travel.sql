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
  `room_id` int(11) NOT NULL,
  `hotelName` longtext NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `userID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `peopleValue` int(11) NOT NULL,
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

INSERT INTO `book` (`id`, `hotelID`, `room_id`, `hotelName`, `room_type`, `startDate`, `endDate`, `userID`, `price`, `peopleValue`, `nights`, `discount`, `bookingName`, `bookingEmail`, `bookingPhone`, `type`, `create_at`) VALUES
(5, 40, 15, 'Radisson Blu Jaipur', 'Business Room', '2025-04-06', '2025-04-12', 11, 60000, 2, 6, 18, 'jahid', 'jahid@gmail.com', '7894561230', 'Reject', '2025-04-06 09:33:40'),
(6, 53, 21, 'Park Hyatt Goa Resort', 'Ocean View Suite', '2025-04-23', '2025-04-25', 11, 36000, 2, 2, 18, 'kdscoder', 'kdscoder@gmail.com', '789456123', 'Pending', '2025-04-06 16:08:00'),
(7, 40, 16, 'Radisson Blu Jaipur', 'Club Room', '2025-05-31', '2025-06-02', 12, 20000, 2, 2, 18, 'Jahid Khan', 'jahidsofficials@gmail.com', '23534465656456', 'Accept', '2025-05-31 10:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT 2,
  `price_per_night` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `available_rooms` int(11) NOT NULL DEFAULT 0,
  `total_rooms` int(11) NOT NULL DEFAULT 0,
  `images` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel_id`, `room_type`, `capacity`, `price_per_night`, `description`, `amenities`, `available_rooms`, `total_rooms`, `images`, `created_at`) VALUES
-- Hotel Amber Palace (ID: 31)
(1, 31, 'Deluxe Room', 2, 12000.00, 'Spacious deluxe room with city view', 'Wi-Fi, AC, TV, Mini Bar, Balcony', 15, 20, 'amber_deluxe1.jpg,amber_deluxe2.jpg', '2025-02-21 18:17:20'),
(2, 31, 'Executive Suite', 4, 18000.00, 'Luxury suite with separate living area', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Balcony, Jacuzzi', 8, 10, 'amber_suite1.jpg,amber_suite2.jpg', '2025-02-21 18:17:20'),
(3, 31, 'Presidential Suite', 6, 25000.00, 'Ultimate luxury with panoramic views', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Balcony, Jacuzzi, Private Pool', 2, 5, 'amber_presidential1.jpg,amber_presidential2.jpg', '2025-02-21 18:17:20'),

-- Rajputana Palace Bikaner (ID: 32)
(4, 32, 'Standard Room', 2, 4500.00, 'Comfortable standard room with traditional decor', 'Wi-Fi, AC, TV, Tea/Coffee Maker', 12, 15, 'rajputana_standard1.jpg,rajputana_standard2.jpg', '2025-02-21 18:17:20'),
(5, 32, 'Deluxe Room', 3, 6500.00, 'Spacious deluxe with heritage elements', 'Wi-Fi, AC, TV, Mini Bar, Balcony', 8, 10, 'rajputana_deluxe1.jpg,rajputana_deluxe2.jpg', '2025-02-21 18:17:20'),

-- Pink City Hotel (ID: 33)
(6, 33, 'Budget Room', 1, 2500.00, 'Basic comfortable room for budget travelers', 'Wi-Fi, AC, TV', 25, 30, 'pinkcity_budget1.jpg,pinkcity_budget2.jpg', '2025-02-21 18:17:20'),
(7, 33, 'Standard Room', 2, 4000.00, 'Standard room with modern amenities', 'Wi-Fi, AC, TV, Mini Fridge', 20, 25, 'pinkcity_standard1.jpg,pinkcity_standard2.jpg', '2025-02-21 18:17:20'),
(8, 33, 'Family Room', 4, 6000.00, 'Spacious room perfect for families', 'Wi-Fi, AC, TV, Mini Fridge, Extra Beds', 15, 20, 'pinkcity_family1.jpg,pinkcity_family2.jpg', '2025-02-21 18:17:20'),

-- Trident Jaipur (ID: 34)
(9, 34, 'Superior Room', 2, 15000.00, 'Elegant room with premium amenities', 'Wi-Fi, AC, TV, Mini Bar, Work Desk', 12, 15, 'trident_superior1.jpg,trident_superior2.jpg', '2025-02-21 18:17:20'),
(10, 34, 'Deluxe Suite', 4, 22000.00, 'Luxury suite with separate areas', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Balcony', 6, 8, 'trident_suite1.jpg,trident_suite2.jpg', '2025-02-21 18:17:20'),

-- The Lalit Jaipur (ID: 35)
(11, 35, 'Classic Room', 2, 11000.00, 'Elegant room with classic decor', 'Wi-Fi, AC, TV, Mini Bar, Tea/Coffee', 18, 20, 'lalit_classic1.jpg,lalit_classic2.jpg', '2025-02-21 18:17:20'),
(12, 35, 'Premium Suite', 3, 16000.00, 'Premium suite with luxury amenities', 'Wi-Fi, AC, TV, Mini Bar, Balcony, Jacuzzi', 10, 12, 'lalit_premium1.jpg,lalit_premium2.jpg', '2025-02-21 18:17:20'),

-- Holiday Inn Jaipur (ID: 36)
(13, 36, 'Comfort Room', 2, 7500.00, 'Comfortable room with essential amenities', 'Wi-Fi, AC, TV, Coffee Maker', 14, 15, 'holidayinn_comfort1.jpg,holidayinn_comfort2.jpg', '2025-02-21 18:17:20'),
(14, 36, 'Executive Room', 2, 9500.00, 'Executive room with work facilities', 'Wi-Fi, AC, TV, Work Desk, Mini Bar', 8, 10, 'holidayinn_executive1.jpg,holidayinn_executive2.jpg', '2025-02-21 18:17:20'),

-- Radisson Blu Jaipur (ID: 40)
(15, 40, 'Business Room', 2, 10000.00, 'Modern business room', 'Wi-Fi, AC, TV, Work Desk, Coffee', 22, 25, 'radisson_business1.jpg,radisson_business2.jpg', '2025-02-21 18:17:20'),
(16, 40, 'Club Room', 3, 14000.00, 'Club room with lounge access', 'Wi-Fi, AC, TV, Mini Bar, Lounge Access', 15, 18, 'radisson_club1.jpg,radisson_club2.jpg', '2025-02-21 18:17:20'),

-- The Imperial Delhi (ID: 41)
(17, 41, 'Heritage Room', 2, 18000.00, 'Colonial style heritage room', 'Wi-Fi, AC, TV, Mini Bar, Colonial Decor', 12, 15, 'imperial_heritage1.jpg,imperial_heritage2.jpg', '2025-02-21 18:17:20'),
(18, 41, 'Royal Suite', 4, 28000.00, 'Luxury suite with royal amenities', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Balcony', 4, 6, 'imperial_royal1.jpg,imperial_royal2.jpg', '2025-02-21 18:17:20'),

-- ITC Maurya (ID: 42)
(19, 42, 'Luxury Room', 2, 22000.00, 'World-class luxury room', 'Wi-Fi, AC, TV, Mini Bar, Premium Amenities', 16, 20, 'itc_luxury1.jpg,itc_luxury2.jpg', '2025-02-21 18:17:20'),
(20, 42, 'Grand Suite', 6, 35000.00, 'Grand suite for special occasions', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Jacuzzi, Private Butler', 3, 5, 'itc_grand1.jpg,itc_grand2.jpg', '2025-02-21 18:17:20'),

-- Sajjan Niwas (ID: 37) - Budget Jaipur hotel
(21, 37, 'Standard Room', 2, 4500.00, 'Comfortable traditional room', 'Wi-Fi, AC, TV, Traditional Decor', 20, 25, 'sajjan_standard1.jpg,sajjan_standard2.jpg', '2025-02-21 18:17:20'),
(22, 37, 'Deluxe Room', 3, 6500.00, 'Spacious room with heritage elements', 'Wi-Fi, AC, TV, Mini Bar, Balcony', 12, 15, 'sajjan_deluxe1.jpg,sajjan_deluxe2.jpg', '2025-02-21 18:17:20'),

-- Oberoi Rajvilas (ID: 38) - Luxury Jaipur hotel
(23, 38, 'Palatial Suite', 4, 25000.00, 'Luxury suite with royal heritage', 'Wi-Fi, AC, TV, Mini Bar, Private Pool, Butler Service', 6, 8, 'oberoi_suite1.jpg,oberoi_suite2.jpg', '2025-02-21 18:17:20'),
(24, 38, 'Royal Villa', 6, 40000.00, 'Private villa with royal amenities', 'Wi-Fi, AC, TV, Mini Bar, Private Pool, Kitchen, Butler', 3, 4, 'oberoi_villa1.jpg,oberoi_villa2.jpg', '2025-02-21 18:17:20'),

-- Le Meridien Jaipur (ID: 39) - Luxury Jaipur hotel
(25, 39, 'Executive Room', 2, 13000.00, 'Modern executive room', 'Wi-Fi, AC, TV, Work Desk, Mini Bar', 18, 22, 'meridien_executive1.jpg,meridien_executive2.jpg', '2025-02-21 18:17:20'),
(26, 39, 'Presidential Suite', 4, 22000.00, 'Luxury suite with city views', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Balcony, Jacuzzi', 5, 7, 'meridien_suite1.jpg,meridien_suite2.jpg', '2025-02-21 18:17:20'),

-- Leela Palace New Delhi (ID: 43) - Luxury Delhi hotel
(27, 43, 'Deluxe Room', 2, 20000.00, 'Luxurious deluxe room with palace views', 'Wi-Fi, AC, TV, Mini Bar, Tea/Coffee Maker, Balcony, City View', 15, 18, 'leela_deluxe1.jpg,leela_deluxe2.jpg', '2025-02-21 18:17:20'),
(28, 43, 'Executive Suite', 4, 35000.00, 'Spacious executive suite with living area', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Balcony, Jacuzzi, Living Room', 8, 10, 'leela_suite1.jpg,leela_suite2.jpg', '2025-02-21 18:17:20'),
(29, 43, 'Presidential Suite', 6, 50000.00, 'Ultimate luxury with panoramic city views', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Balcony, Jacuzzi, Private Butler, City View', 3, 4, 'leela_presidential1.jpg,leela_presidential2.jpg', '2025-02-21 18:17:20'),

-- Shangri-La Hotel (ID: 44) - Luxury Delhi hotel
(30, 44, 'Horizon Room', 2, 15000.00, 'Room with panoramic city views', 'Wi-Fi, AC, TV, Mini Bar, City View', 14, 18, 'shangrila_horizon1.jpg,shangrila_horizon2.jpg', '2025-02-21 18:17:20'),
(31, 44, 'Executive Suite', 4, 25000.00, 'Executive suite with premium amenities', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Lounge Access', 8, 10, 'shangrila_executive1.jpg,shangrila_executive2.jpg', '2025-02-21 18:17:20'),

-- Taj Mahal Hotel (ID: 45) - Luxury Delhi hotel
(32, 45, 'Luxury Room', 2, 20000.00, 'Iconic luxury room', 'Wi-Fi, AC, TV, Mini Bar, Premium Service', 16, 20, 'taj_luxury1.jpg,taj_luxury2.jpg', '2025-02-21 18:17:20'),
(33, 45, 'Grand Presidential Suite', 6, 45000.00, 'Ultimate luxury suite', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Jacuzzi, Private Butler', 2, 3, 'taj_grand1.jpg,taj_grand2.jpg', '2025-02-21 18:17:20'),

-- Radisson Blu Dwarka (ID: 46) - Mid-range Delhi hotel
(34, 46, 'Comfort Room', 2, 8500.00, 'Comfortable modern room', 'Wi-Fi, AC, TV, Coffee Maker', 20, 25, 'radissonblu_comfort1.jpg,radissonblu_comfort2.jpg', '2025-02-21 18:17:20'),
(35, 46, 'Business Suite', 3, 12000.00, 'Suite for business travelers', 'Wi-Fi, AC, TV, Work Desk, Mini Bar', 12, 15, 'radissonblu_business1.jpg,radissonblu_business2.jpg', '2025-02-21 18:17:20'),

-- Hyatt Centric (ID: 47) - Mid-range Delhi hotel
(36, 47, 'Contemporary Room', 2, 12000.00, 'Trendy contemporary room', 'Wi-Fi, AC, TV, Mini Bar, Modern Design', 18, 22, 'hyatt_contemporary1.jpg,hyatt_contemporary2.jpg', '2025-02-21 18:17:20'),
(37, 47, 'Studio Suite', 4, 18000.00, 'Spacious studio suite', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Living Area', 10, 12, 'hyatt_studio1.jpg,hyatt_studio2.jpg', '2025-02-21 18:17:20'),

-- Novotel New Delhi (ID: 48) - Mid-range Delhi hotel
(38, 48, 'Superior Room', 2, 9500.00, 'Superior room with great amenities', 'Wi-Fi, AC, TV, Mini Bar, Coffee', 16, 20, 'novotel_superior1.jpg,novotel_superior2.jpg', '2025-02-21 18:17:20'),
(39, 48, 'Family Suite', 4, 14000.00, 'Perfect for families', 'Wi-Fi, AC, TV, Mini Bar, Extra Beds, Kitchen', 8, 10, 'novotel_family1.jpg,novotel_family2.jpg', '2025-02-21 18:17:20'),

-- Holiday Inn Mayur Vihar (ID: 49) - Budget Delhi hotel
(40, 49, 'Standard Room', 2, 5500.00, 'Comfortable standard room', 'Wi-Fi, AC, TV, Coffee Maker', 22, 28, 'holidayinn_standard1.jpg,holidayinn_standard2.jpg', '2025-02-21 18:17:20'),
(41, 49, 'Deluxe Room', 3, 7500.00, 'Spacious deluxe room', 'Wi-Fi, AC, TV, Mini Bar, Balcony', 14, 18, 'holidayinn_deluxe1.jpg,holidayinn_deluxe2.jpg', '2025-02-21 18:17:20'),

-- The Park New Delhi (ID: 50) - Mid-range Delhi hotel
(42, 50, 'Park Room', 2, 13000.00, 'Elegant room with modern amenities', 'Wi-Fi, AC, TV, Mini Bar, Premium Bedding', 15, 18, 'park_room1.jpg,park_room2.jpg', '2025-02-21 18:17:20'),
(43, 50, 'Executive Suite', 4, 20000.00, 'Executive suite with work facilities', 'Wi-Fi, AC, TV, Mini Bar, Work Desk, Lounge Access', 6, 8, 'park_executive1.jpg,park_executive2.jpg', '2025-02-21 18:17:20'),

-- Taj Exotica Resort & Spa (ID: 51) - Luxury Goa resort
(44, 51, 'Beach Villa', 4, 22000.00, 'Luxury villa with beach access', 'Wi-Fi, AC, TV, Mini Bar, Beach Access, Private Balcony', 8, 12, 'taj_exotica_villa1.jpg,taj_exotica_villa2.jpg', '2025-02-21 18:17:20'),
(45, 51, 'Overwater Suite', 6, 35000.00, 'Exclusive overwater suite', 'Wi-Fi, AC, TV, Mini Bar, Private Pool, Ocean View', 4, 6, 'taj_exotica_overwater1.jpg,taj_exotica_overwater2.jpg', '2025-02-21 18:17:20'),

-- The Leela Goa (ID: 52) - Luxury Goa resort
(46, 52, 'Garden Villa', 4, 25000.00, 'Beautiful garden villa', 'Wi-Fi, AC, TV, Mini Bar, Garden View, Private Terrace', 10, 14, 'leela_goa_garden1.jpg,leela_goa_garden2.jpg', '2025-02-21 18:17:20'),
(47, 52, 'Presidential Villa', 8, 45000.00, 'Ultimate luxury villa', 'Wi-Fi, AC, TV, Mini Bar, Private Pool, Butler Service', 2, 3, 'leela_goa_presidential1.jpg,leela_goa_presidential2.jpg', '2025-02-21 18:17:20'),

-- Park Hyatt Goa Resort (ID: 53) - Luxury Goa resort
(48, 53, 'Ocean View Room', 2, 18000.00, 'Room with stunning ocean views', 'Wi-Fi, AC, TV, Mini Bar, Ocean View, Balcony', 12, 16, 'parkhyatt_ocean1.jpg,parkhyatt_ocean2.jpg', '2025-02-21 18:17:20'),
(49, 53, 'Beachfront Suite', 4, 28000.00, 'Suite right on the beach', 'Wi-Fi, AC, TV, Mini Bar, Beach Access, Private Terrace', 6, 8, 'parkhyatt_beachfront1.jpg,parkhyatt_beachfront2.jpg', '2025-02-21 18:17:20'),

-- Holiday Inn Resort Goa (ID: 54) - Mid-range Goa resort
(50, 54, 'Garden Room', 2, 9500.00, 'Comfortable room with garden views', 'Wi-Fi, AC, TV, Coffee Maker, Garden View', 18, 24, 'holidayinn_garden1.jpg,holidayinn_garden2.jpg', '2025-02-21 18:17:20'),
(51, 54, 'Beach Suite', 4, 14000.00, 'Suite with beach access', 'Wi-Fi, AC, TV, Mini Bar, Beach Access', 10, 12, 'holidayinn_beach1.jpg,holidayinn_beach2.jpg', '2025-02-21 18:17:20'),

-- Alila Diwa Goa (ID: 55) - Luxury Goa resort
(52, 55, 'Cliff Villa', 4, 17000.00, 'Villa perched on cliffs', 'Wi-Fi, AC, TV, Mini Bar, Ocean View, Private Pool', 8, 10, 'alila_cliff1.jpg,alila_cliff2.jpg', '2025-02-21 18:17:20'),
(53, 55, 'Presidential Cliff Villa', 6, 28000.00, 'Ultimate cliff villa experience', 'Wi-Fi, AC, TV, Mini Bar, Infinity Pool, Butler Service', 3, 4, 'alila_presidential1.jpg,alila_presidential2.jpg', '2025-02-21 18:17:20'),

-- Goa Marriott Resort & Spa (ID: 56) - Luxury Goa resort
(54, 56, 'Deluxe Room', 2, 16000.00, 'Spacious deluxe room', 'Wi-Fi, AC, TV, Mini Bar, Pool View', 14, 18, 'marriott_deluxe1.jpg,marriott_deluxe2.jpg', '2025-02-21 18:17:20'),
(55, 56, 'Executive Suite', 4, 24000.00, 'Executive suite with amenities', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Lounge Access', 7, 9, 'marriott_executive1.jpg,marriott_executive2.jpg', '2025-02-21 18:17:20'),

-- Radisson Blu Resort Goa (ID: 57) - Mid-range Goa resort
(56, 57, 'Superior Room', 2, 14000.00, 'Superior room with resort amenities', 'Wi-Fi, AC, TV, Mini Bar, Pool Access', 16, 20, 'radissonblu_superior1.jpg,radissonblu_superior2.jpg', '2025-02-21 18:17:20'),
(57, 57, 'Family Suite', 5, 20000.00, 'Perfect for families', 'Wi-Fi, AC, TV, Mini Bar, Extra Beds, Kitchen', 6, 8, 'radissonblu_family1.jpg,radissonblu_family2.jpg', '2025-02-21 18:17:20'),

-- W Goa (ID: 58) - Luxury Goa resort
(58, 58, 'Wonderful Room', 2, 13000.00, 'Stylish room with vibrant design', 'Wi-Fi, AC, TV, Mini Bar, Beach Access', 12, 15, 'w_goa_wonderful1.jpg,w_goa_wonderful2.jpg', '2025-02-21 18:17:20'),
(59, 58, 'Spectacular Suite', 4, 22000.00, 'Suite with spectacular views', 'Wi-Fi, AC, TV, Mini Bar, Ocean View, Private Terrace', 5, 7, 'w_goa_spectacular1.jpg,w_goa_spectacular2.jpg', '2025-02-21 18:17:20'),

-- Vivanta by Taj - Panaji (ID: 59) - Mid-range Goa hotel
(60, 59, 'Deluxe Room', 2, 15000.00, 'Modern deluxe room', 'Wi-Fi, AC, TV, Mini Bar, City View', 14, 18, 'vivanta_deluxe1.jpg,vivanta_deluxe2.jpg', '2025-02-21 18:17:20'),
(61, 59, 'Executive Suite', 3, 21000.00, 'Executive suite for business travelers', 'Wi-Fi, AC, TV, Mini Bar, Work Desk, Lounge', 8, 10, 'vivanta_executive1.jpg,vivanta_executive2.jpg', '2025-02-21 18:17:20'),

-- Marbella Beach Resort (ID: 60) - Budget Goa resort
(62, 60, 'Standard Room', 2, 11000.00, 'Comfortable beachside room', 'Wi-Fi, AC, TV, Beach Access', 20, 25, 'marbella_standard1.jpg,marbella_standard2.jpg', '2025-02-21 18:17:20'),
(63, 60, 'Beachfront Suite', 4, 16000.00, 'Suite with direct beach access', 'Wi-Fi, AC, TV, Mini Bar, Beach Access, Balcony', 10, 12, 'marbella_beachfront1.jpg,marbella_beachfront2.jpg', '2025-02-21 18:17:20'),

-- The Taj Mahal Palace (ID: 61) - Luxury Mumbai hotel
(64, 61, 'Heritage Room', 2, 25000.00, 'Iconic room with heritage charm', 'Wi-Fi, AC, TV, Mini Bar, Sea View, Butler Service', 15, 18, 'taj_mumbai_heritage1.jpg,taj_mumbai_heritage2.jpg', '2025-02-21 18:17:20'),
(65, 61, 'Presidential Suite', 4, 45000.00, 'Ultimate luxury with Gateway views', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Jacuzzi, Private Butler', 3, 5, 'taj_mumbai_presidential1.jpg,taj_mumbai_presidential2.jpg', '2025-02-21 18:17:20'),

-- The Oberoi Mumbai (ID: 62) - Luxury Mumbai hotel
(66, 62, 'Sea View Room', 2, 22000.00, 'Room with stunning Arabian Sea views', 'Wi-Fi, AC, TV, Mini Bar, Sea View, Balcony', 18, 22, 'oberoi_mumbai_sea1.jpg,oberoi_mumbai_sea2.jpg', '2025-02-21 18:17:20'),
(67, 62, 'Executive Suite', 4, 35000.00, 'Luxury suite with panoramic views', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Jacuzzi, Living Room', 6, 8, 'oberoi_mumbai_executive1.jpg,oberoi_mumbai_executive2.jpg', '2025-02-21 18:17:20'),

-- ITC Grand Central (ID: 63) - Luxury Mumbai hotel
(68, 63, 'Grand Room', 2, 16000.00, 'Elegant room with modern amenities', 'Wi-Fi, AC, TV, Mini Bar, Work Desk, City View', 20, 25, 'itc_mumbai_grand1.jpg,itc_mumbai_grand2.jpg', '2025-02-21 18:17:20'),
(69, 63, 'Imperial Suite', 6, 28000.00, 'Spacious suite for special occasions', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Jacuzzi, Private Dining', 4, 6, 'itc_mumbai_imperial1.jpg,itc_mumbai_imperial2.jpg', '2025-02-21 18:17:20'),

-- JW Marriott Mumbai (ID: 64) - Luxury Mumbai hotel
(70, 64, 'Premier Room', 2, 14000.00, 'Premium room with airport convenience', 'Wi-Fi, AC, TV, Mini Bar, Work Desk, Airport Transfer', 22, 28, 'marriott_mumbai_premier1.jpg,marriott_mumbai_premier2.jpg', '2025-02-21 18:17:20'),
(71, 64, 'Executive Suite', 4, 24000.00, 'Executive suite with business facilities', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Work Desk, Lounge Access', 8, 10, 'marriott_mumbai_executive1.jpg,marriott_mumbai_executive2.jpg', '2025-02-21 18:17:20'),

-- Hotel Marine Plaza (ID: 65) - Mid-range Mumbai hotel
(72, 65, 'Art Deco Room', 2, 10000.00, 'Charming room with Art Deco design', 'Wi-Fi, AC, TV, Mini Bar, Sea View', 16, 20, 'marine_artdeco1.jpg,marine_artdeco2.jpg', '2025-02-21 18:17:20'),
(73, 65, 'Beach View Suite', 4, 15000.00, 'Suite with direct beach views', 'Wi-Fi, AC, TV, Mini Bar, Beach Access, Balcony', 10, 12, 'marine_beach1.jpg,marine_beach2.jpg', '2025-02-21 18:17:20'),

-- Trident Nariman Point (ID: 66) - Mid-range Mumbai hotel
(74, 66, 'Business Room', 2, 12000.00, 'Modern business room', 'Wi-Fi, AC, TV, Work Desk, Coffee Maker', 18, 22, 'trident_mumbai_business1.jpg,trident_mumbai_business2.jpg', '2025-02-21 18:17:20'),
(75, 66, 'Club Suite', 3, 18000.00, 'Club room with lounge benefits', 'Wi-Fi, AC, TV, Mini Bar, Lounge Access, City View', 12, 15, 'trident_mumbai_club1.jpg,trident_mumbai_club2.jpg', '2025-02-21 18:17:20'),

-- The Leela Mumbai (ID: 67) - Luxury Mumbai hotel
(76, 67, 'Deluxe Room', 2, 20000.00, 'Luxury room with premium amenities', 'Wi-Fi, AC, TV, Mini Bar, Airport Transfer, Spa Access', 16, 20, 'leela_mumbai_deluxe1.jpg,leela_mumbai_deluxe2.jpg', '2025-02-21 18:17:20'),
(77, 67, 'Royal Suite', 6, 38000.00, 'Royal suite with world-class service', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Jacuzzi, Private Butler', 3, 4, 'leela_mumbai_royal1.jpg,leela_mumbai_royal2.jpg', '2025-02-21 18:17:20'),

-- Hyatt Regency Mumbai (ID: 68) - Mid-range Mumbai hotel
(78, 68, 'Regency Room', 2, 8500.00, 'Comfortable room with modern design', 'Wi-Fi, AC, TV, Coffee Maker, Work Desk', 20, 25, 'hyatt_mumbai_regency1.jpg,hyatt_mumbai_regency2.jpg', '2025-02-21 18:17:20'),
(79, 68, 'Executive Suite', 4, 13000.00, 'Suite with executive amenities', 'Wi-Fi, AC, TV, Mini Bar, Kitchen, Lounge Access', 10, 12, 'hyatt_mumbai_executive1.jpg,hyatt_mumbai_executive2.jpg', '2025-02-21 18:17:20'),

-- Novotel Mumbai (ID: 69) - Mid-range Mumbai hotel
(80, 69, 'Superior Room', 2, 7000.00, 'Stylish room with great views', 'Wi-Fi, AC, TV, Mini Bar, Beach View', 18, 24, 'novotel_mumbai_superior1.jpg,novotel_mumbai_superior2.jpg', '2025-02-21 18:17:20'),
(81, 69, 'Family Suite', 5, 11000.00, 'Perfect for families', 'Wi-Fi, AC, TV, Mini Bar, Extra Beds, Kitchen', 8, 10, 'novotel_mumbai_family1.jpg,novotel_mumbai_family2.jpg', '2025-02-21 18:17:20'),

-- Fariyas Hotel Mumbai (ID: 70) - Budget Mumbai hotel
(82, 70, 'Standard Room', 2, 5500.00, 'Comfortable budget room', 'Wi-Fi, AC, TV, Tea/Coffee Maker', 22, 28, 'fariyas_standard1.jpg,fariyas_standard2.jpg', '2025-02-21 18:17:20'),
(83, 70, 'Deluxe Room', 3, 7500.00, 'Spacious room with extra amenities', 'Wi-Fi, AC, TV, Mini Bar, Balcony', 14, 18, 'fariyas_deluxe1.jpg,fariyas_deluxe2.jpg', '2025-02-21 18:17:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `password`, `gender`, `timestamp`) VALUES
(9, 'kdscoder', '456123789', 'kdscoder@example.com', '202cb962ac59075b964b07152d234b70', 'Male', '2025-03-20 18:25:09'),
(10, 'jahid khan', '1234567890', 'jahid.khan@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '2025-03-20 18:34:58'),
(11, 'Amit', '789456123', 'amit@example.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Female', '2025-03-20 19:06:05'),
(12, 'KdscoderNew', '7894561230', 'kdscodernew@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '2025-05-31 09:31:41');

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