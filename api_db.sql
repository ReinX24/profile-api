-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 04:39 PM
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
-- Database: `api_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `token_valid_until` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact_number`, `birthdate`, `address`, `photo`, `access_token`, `token_valid_until`, `created_at`, `updated_at`) VALUES
(1, 'Rein', 'rein@gmail.com', '$2y$10$rG5t68xAQKJXmzqM/1uXu.Q11b4pqVZN6cs6wKrj92hcSVZsrNx7S', '+63 9123 123 123', '2003-08-24', 'Philippines', 'images/V52nCTzu/Profile Photo.jpg', 'XfqbZvNg', '2024-06-20 22:06:18', '2024-06-17 10:26:58', '2024-06-19 14:06:18'),
(4, 'John Carmack', 'johncarmack@gmail.com', '$2y$10$0mL69SZNmxlZDcQpIyI8QeutItG54QFeBCIqF5HZbFPf/d9wxJHaa', '+63 9456 456 456', '1970-08-21', 'United States of America', 'images/tzaTQMkI/434757598_310348125231983_3422059153426297560_n.jpg', '5tBZnKAl', '2024-06-18 21:16:49', '2024-06-17 13:16:49', '2024-06-17 13:17:30'),
(5, 'Richard Stallman', 'richard@gmail.com', '$2y$10$NjRs7/lxpR6OZAM0IyIwUeIQ7MzKZonspbbJ4T19sVjBPDOsAcRG.', '+63 9456 456 456', '1953-03-16', 'Boston, Massachusetts', 'images/6rhur7yr/Richard_Stallman_at_LibrePlanet_2019.jpg', 'pVuaKm3R', '2024-06-18 21:36:30', '2024-06-17 13:36:30', '2024-06-17 13:42:25'),
(8, 'Jane', 'jane@gmail.com', '$2y$10$nZ1ax3nBvcIMMOkRsHopoeOCAKaRMYRz363fwDrUp0NwKtAyt4fR6', '+63 9123 123 123', '1987-08-24', 'United Kingdom', 'images/nqnOjvA4/jane.png', 'Eo55czi9', '2024-06-19 22:35:34', '2024-06-18 14:28:45', '2024-06-18 14:35:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
