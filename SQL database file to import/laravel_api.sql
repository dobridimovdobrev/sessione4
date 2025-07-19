-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2024 at 04:32 PM
-- Server version: 10.4.34-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `try2veri_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'action', 'action', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(2, 'comedy', 'comedy', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(3, 'adventure', 'adventure', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(4, 'thriller', 'thriller', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(5, 'crime', 'crime', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(6, 'drama', 'drama', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(7, 'documentary', 'documentary', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(8, 'romance', 'romance', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(9, 'war', 'war', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(10, 'western', 'western', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(11, 'fantasy', 'fantasy', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(12, 'family', 'family', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(13, 'horror', 'horror', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(14, 'animation', 'animation', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(15, 'reality', 'reality', '2024-11-01 13:27:16', '2024-11-01 13:27:52', '2024-11-01 13:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `continent` varchar(64) NOT NULL,
  `iso_char2` varchar(2) NOT NULL,
  `iso_char3` varchar(3) NOT NULL,
  `phone_prefix` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `name`, `continent`, `iso_char2`, `iso_char3`, `phone_prefix`, `created_at`, `updated_at`) VALUES
(1, 'Italia', 'EU', 'IT', 'ITA', '39', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(2, 'Emirati Arabi Uniti', 'AS', 'AE', 'ARE', '971', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(3, 'Afghanistan', 'AS', 'AF', 'AFG', '93', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(4, 'Antigua e Barbuda', 'NA', 'AG', 'ATG', '+1-268', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(5, 'Anguilla', 'NA', 'AI', 'AIA', '+1-264', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(6, 'Albania', 'EU', 'AL', 'ALB', '355', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(7, 'Armenia', 'AS', 'AM', 'ARM', '374', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(8, 'Angola', 'AF', 'AO', 'AGO', '244', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(9, 'Antartide', 'AN', 'AQ', 'ATA', '', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(10, 'Argentina', 'SA', 'AR', 'ARG', '54', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(11, 'Samoa Americane', 'OC', 'AS', 'ASM', '+1-684', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(12, 'Austria', 'EU', 'AT', 'AUT', '43', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(13, 'Australia', 'OC', 'AU', 'AUS', '61', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(14, 'Aruba', 'NA', 'AW', 'ABW', '297', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(15, 'Isole Åland', 'EU', 'AX', 'ALA', '+358-18', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(16, 'Azerbaigian', 'AS', 'AZ', 'AZE', '994', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(17, 'Bosnia ed Erzegovina', 'EU', 'BA', 'BIH', '387', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(18, 'Barbados', 'NA', 'BB', 'BRB', '+1-246', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(19, 'Bangladesh', 'AS', 'BD', 'BGD', '880', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(20, 'Belgio', 'EU', 'BE', 'BEL', '32', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(21, 'Burkina Faso', 'AF', 'BF', 'BFA', '226', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(22, 'Bulgaria', 'EU', 'BG', 'BGR', '359', '2024-10-18 16:01:24', '2024-10-18 16:14:06'),
(23, 'Bahrein', 'AS', 'BH', 'BHR', '973', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(24, 'Burundi', 'AF', 'BI', 'BDI', '257', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(25, 'Benin', 'AF', 'BJ', 'BEN', '229', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(26, 'Saint-Barthélemy', 'NA', 'BL', 'BLM', '590', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(27, 'Bermuda', 'NA', 'BM', 'BMU', '+1-441', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(28, 'Brunei', 'AS', 'BN', 'BRN', '673', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(29, 'Bolivia', 'SA', 'BO', 'BOL', '591', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(30, 'Isole BES', 'NA', 'BQ', 'BES', '599', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(31, 'Brasile', 'SA', 'BR', 'BRA', '55', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(32, 'Bahamas', 'NA', 'BS', 'BHS', '+1-242', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(33, 'Bhutan', 'AS', 'BT', 'BTN', '975', '2024-10-18 16:01:24', '2024-10-18 16:01:24'),
(34, 'Isola Bouvet', 'AN', 'BV', 'BVT', '', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(35, 'Botswana', 'AF', 'BW', 'BWA', '267', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(36, 'Bielorussia', 'EU', 'BY', 'BLR', '375', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(37, 'Belize', 'NA', 'BZ', 'BLZ', '501', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(38, 'Canada', 'NA', 'CA', 'CAN', '1', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(39, 'Isole Cocos e Keeling', 'AS', 'CC', 'CCK', '61', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(40, 'RD del Congo', 'AF', 'CD', 'COD', '243', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(41, 'Rep. Centrafricana', 'AF', 'CF', 'CAF', '236', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(42, 'Rep. del Congo', 'AF', 'CG', 'COG', '242', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(43, 'Svizzera', 'EU', 'CH', 'CHE', '41', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(44, 'Costa d\'Avorio', 'AF', 'CI', 'CIV', '225', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(45, 'Isole Cook', 'OC', 'CK', 'COK', '682', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(46, 'Cile', 'SA', 'CL', 'CHL', '56', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(47, 'Camerun', 'AF', 'CM', 'CMR', '237', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(48, 'Cina', 'AS', 'CN', 'CHN', '86', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(49, 'Colombia', 'SA', 'CO', 'COL', '57', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(50, 'Costa Rica', 'NA', 'CR', 'CRI', '506', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(51, 'Cuba', 'NA', 'CU', 'CUB', '53', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(52, 'Capo Verde', 'AF', 'CV', 'CPV', '238', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(53, 'Curaçao', 'NA', 'CW', 'CUW', '599', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(54, 'Isola di Natale', 'AS', 'CX', 'CXR', '61', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(55, 'Cipro', 'EU', 'CY', 'CYP', '357', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(56, 'Rep. Ceca', 'EU', 'CZ', 'CZE', '420', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(57, 'Germania', 'EU', 'DE', 'DEU', '49', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(58, 'Gibuti', 'AF', 'DJ', 'DJI', '253', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(59, 'Danimarca', 'EU', 'DK', 'DNK', '45', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(60, 'Dominica', 'NA', 'DM', 'DMA', '+1-767', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(61, 'Rep. Dominicana', 'NA', 'DO', 'DOM', '+1-809 and', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(62, 'Algeria', 'AF', 'DZ', 'DZA', '213', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(63, 'Ecuador', 'SA', 'EC', 'ECU', '593', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(64, 'Estonia', 'EU', 'EE', 'EST', '372', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(65, 'Egitto', 'AF', 'EG', 'EGY', '20', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(66, 'Sahara Occidentale', 'AF', 'EH', 'ESH', '212', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(67, 'Eritrea', 'AF', 'ER', 'ERI', '291', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(68, 'Spagna', 'EU', 'ES', 'ESP', '34', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(69, 'Etiopia', 'AF', 'ET', 'ETH', '251', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(70, 'Finlandia', 'EU', 'FI', 'FIN', '358', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(71, 'Figi', 'OC', 'FJ', 'FJI', '679', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(72, 'Isole Falkland', 'SA', 'FK', 'FLK', '500', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(73, 'Micronesia', 'OC', 'FM', 'FSM', '691', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(74, 'Isole FÃ¦r Ã˜er', 'EU', 'FO', 'FRO', '298', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(75, 'Francia', 'EU', 'FR', 'FRA', '33', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(76, 'Gabon', 'AF', 'GA', 'GAB', '241', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(77, 'Regno Unito', 'EU', 'GB', 'GBR', '44', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(78, 'Grenada', 'NA', 'GD', 'GRD', '+1-473', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(79, 'Georgia', 'AS', 'GE', 'GEO', '995', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(80, 'Guyana francese', 'SA', 'GF', 'GUF', '594', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(81, 'Guernsey', 'EU', 'GG', 'GGY', '+44-1481', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(82, 'Ghana', 'AF', 'GH', 'GHA', '233', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(83, 'Gibilterra', 'EU', 'GI', 'GIB', '350', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(84, 'Groenlandia', 'NA', 'GL', 'GRL', '299', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(85, 'Gambia', 'AF', 'GM', 'GMB', '220', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(86, 'Guinea', 'AF', 'GN', 'GIN', '224', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(87, 'Guadalupa', 'NA', 'GP', 'GLP', '590', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(88, 'Guinea Equatoriale', 'AF', 'GQ', 'GNQ', '240', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(89, 'Grecia', 'EU', 'GR', 'GRC', '30', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(90, 'Georgia del Sud e isole Sandwich meridionali', 'AN', 'GS', 'SGS', '', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(91, 'Guatemala', 'NA', 'GT', 'GTM', '502', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(92, 'Guam', 'OC', 'GU', 'GUM', '+1-671', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(93, 'Guinea-Bissau', 'AF', 'GW', 'GNB', '245', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(94, 'Guyana', 'SA', 'GY', 'GUY', '592', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(95, 'Hong Kong', 'AS', 'HK', 'HKG', '852', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(96, 'Isole Heard e McDonald', 'AN', 'HM', 'HMD', ' ', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(97, 'Honduras', 'NA', 'HN', 'HND', '504', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(98, 'Croazia', 'EU', 'HR', 'HRV', '385', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(99, 'Haiti', 'NA', 'HT', 'HTI', '509', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(100, 'Ungheria', 'EU', 'HU', 'HUN', '36', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(101, 'Indonesia', 'AS', 'ID', 'IDN', '62', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(102, 'Irlanda', 'EU', 'IE', 'IRL', '353', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(103, 'Israele', 'AS', 'IL', 'ISR', '972', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(104, 'Isola di Man', 'EU', 'IM', 'IMN', '+44-1624', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(105, 'India', 'AS', 'IN', 'IND', '91', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(106, 'Territorio britannico', 'AS', 'IO', 'IOT', '246', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(107, 'Iraq', 'AS', 'IQ', 'IRQ', '964', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(108, 'Iran', 'AS', 'IR', 'IRN', '98', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(109, 'Islanda', 'EU', 'IS', 'ISL', '354', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(110, 'Andorra', 'EU', 'AD', 'AND', '376', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(111, 'Jersey', 'EU', 'JE', 'JEY', '+44-1534', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(112, 'Giamaica', 'NA', 'JM', 'JAM', '+1-876', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(113, 'Giordania', 'AS', 'JO', 'JOR', '962', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(114, 'Giappone', 'AS', 'JP', 'JPN', '81', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(115, 'Kenya', 'AF', 'KE', 'KEN', '254', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(116, 'Kirghizistan', 'AS', 'KG', 'KGZ', '996', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(117, 'Cambogia', 'AS', 'KH', 'KHM', '855', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(118, 'Kiribati', 'OC', 'KI', 'KIR', '686', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(119, 'Comore', 'AF', 'KM', 'COM', '269', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(120, 'Saint Kitts e Nevis', 'NA', 'KN', 'KNA', '+1-869', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(121, 'Corea del Nord', 'AS', 'KP', 'PRK', '850', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(122, 'Corea del Sud', 'AS', 'KR', 'KOR', '82', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(123, 'Kosovo', 'EU', 'XK', 'XKX', '', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(124, 'Kuwait', 'AS', 'KW', 'KWT', '965', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(125, 'Isole Cayman', 'NA', 'KY', 'CYM', '+1-345', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(126, 'Kazakistan', 'AS', 'KZ', 'KAZ', '7', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(127, 'Laos', 'AS', 'LA', 'LAO', '856', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(128, 'Libano', 'AS', 'LB', 'LBN', '961', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(129, 'Santa Lucia', 'NA', 'LC', 'LCA', '+1-758', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(130, 'Liechtenstein', 'EU', 'LI', 'LIE', '423', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(131, 'Sri Lanka', 'AS', 'LK', 'LKA', '94', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(132, 'Liberia', 'AF', 'LR', 'LBR', '231', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(133, 'Lesotho', 'AF', 'LS', 'LSO', '266', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(134, 'Lituania', 'EU', 'LT', 'LTU', '370', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(135, 'Lussemburgo', 'EU', 'LU', 'LUX', '352', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(136, 'Lettonia', 'EU', 'LV', 'LVA', '371', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(137, 'Libia', 'AF', 'LY', 'LBY', '218', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(138, 'Marocco', 'AF', 'MA', 'MAR', '212', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(139, 'Monaco', 'EU', 'MC', 'MCO', '377', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(140, 'Moldavia', 'EU', 'MD', 'MDA', '373', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(141, 'Montenegro', 'EU', 'ME', 'MNE', '382', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(142, 'Saint-Martin', 'NA', 'MF', 'MAF', '590', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(143, 'Madagascar', 'AF', 'MG', 'MDG', '261', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(144, 'Isole Marshall', 'OC', 'MH', 'MHL', '692', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(145, 'Macedonia', 'EU', 'MK', 'MKD', '389', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(146, 'Mali', 'AF', 'ML', 'MLI', '223', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(147, 'Birmania', 'AS', 'MM', 'MMR', '95', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(148, 'Mongolia', 'AS', 'MN', 'MNG', '976', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(149, 'Macao', 'AS', 'MO', 'MAC', '853', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(150, 'Isole Marianne Settent', 'OC', 'MP', 'MNP', '+1-670', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(151, 'Martinica', 'NA', 'MQ', 'MTQ', '596', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(152, 'Mauritania', 'AF', 'MR', 'MRT', '222', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(153, 'Montserrat', 'NA', 'MS', 'MSR', '+1-664', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(154, 'Malta', 'EU', 'MT', 'MLT', '356', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(155, 'Mauritius', 'AF', 'MU', 'MUS', '230', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(156, 'Maldive', 'AS', 'MV', 'MDV', '960', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(157, 'Malawi', 'AF', 'MW', 'MWI', '265', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(158, 'Messico', 'NA', 'MX', 'MEX', '52', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(159, 'Malesia', 'AS', 'MY', 'MYS', '60', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(160, 'Mozambico', 'AF', 'MZ', 'MOZ', '258', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(161, 'Namibia', 'AF', 'NA', 'NAM', '264', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(162, 'Nuova Caledonia', 'OC', 'NC', 'NCL', '687', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(163, 'Niger', 'AF', 'NE', 'NER', '227', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(164, 'Isola Norfolk', 'OC', 'NF', 'NFK', '672', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(165, 'Nigeria', 'AF', 'NG', 'NGA', '234', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(166, 'Nicaragua', 'NA', 'NI', 'NIC', '505', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(167, 'Paesi Bassi', 'EU', 'NL', 'NLD', '31', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(168, 'Norvegia', 'EU', 'NO', 'NOR', '47', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(169, 'Nepal', 'AS', 'NP', 'NPL', '977', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(170, 'Nauru', 'OC', 'NR', 'NRU', '674', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(171, 'Niue', 'OC', 'NU', 'NIU', '683', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(172, 'Nuova Zelanda', 'OC', 'NZ', 'NZL', '64', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(173, 'Oman', 'AS', 'OM', 'OMN', '968', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(174, 'Panamá', 'NA', 'PA', 'PAN', '507', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(175, 'Perù', 'SA', 'PE', 'PER', '51', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(176, 'Polinesia francese', 'OC', 'PF', 'PYF', '689', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(177, 'Papua Nuova Guinea', 'OC', 'PG', 'PNG', '675', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(178, 'Filippine', 'AS', 'PH', 'PHL', '63', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(179, 'Pakistan', 'AS', 'PK', 'PAK', '92', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(180, 'Polonia', 'EU', 'PL', 'POL', '48', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(181, 'Saint-Pierre e Miquelon', 'NA', 'PM', 'SPM', '508', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(182, 'Isole Pitcairn', 'OC', 'PN', 'PCN', '870', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(183, 'Porto Rico', 'NA', 'PR', 'PRI', '+1-787 and', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(184, 'Palestina', 'AS', 'PS', 'PSE', '970', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(185, 'Portogallo', 'EU', 'PT', 'PRT', '351', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(186, 'Palau', 'OC', 'PW', 'PLW', '680', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(187, 'Paraguay', 'SA', 'PY', 'PRY', '595', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(188, 'Qatar', 'AS', 'QA', 'QAT', '974', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(189, 'Riunione', 'AF', 'RE', 'REU', '262', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(190, 'Romania', 'EU', 'RO', 'ROU', '40', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(191, 'Serbia', 'EU', 'RS', 'SRB', '381', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(192, 'Russia', 'EU', 'RU', 'RUS', '7', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(193, 'Ruanda', 'AF', 'RW', 'RWA', '250', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(194, 'Arabia Saudita', 'AS', 'SA', 'SAU', '966', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(195, 'Isole Salomone', 'OC', 'SB', 'SLB', '677', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(196, 'Seychelles', 'AF', 'SC', 'SYC', '248', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(197, 'Sudan', 'AF', 'SD', 'SDN', '249', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(198, 'Sudan del Sud', 'AF', 'SS', 'SSD', '211', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(199, 'Svezia', 'EU', 'SE', 'SWE', '46', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(200, 'Singapore', 'AS', 'SG', 'SGP', '65', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(201, 'Sant\'Elena', 'AF', 'SH', 'SHN', '290', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(202, 'Slovenia', 'EU', 'SI', 'SVN', '386', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(203, 'Svalbard e Jan Mayen', 'EU', 'SJ', 'SJM', '47', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(204, 'Slovacchia', 'EU', 'SK', 'SVK', '421', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(205, 'Sierra Leone', 'AF', 'SL', 'SLE', '232', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(206, 'San Marino', 'EU', 'SM', 'SMR', '378', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(207, 'Senegal', 'AF', 'SN', 'SEN', '221', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(208, 'Somalia', 'AF', 'SO', 'SOM', '252', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(209, 'Suriname', 'SA', 'SR', 'SUR', '597', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(210, 'SÃ£o TomÃ© e PrÃ­ncipe', 'AF', 'ST', 'STP', '239', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(211, 'El Salvador', 'NA', 'SV', 'SLV', '503', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(212, 'Sint Maarten', 'NA', 'SX', 'SXM', '599', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(213, 'Siria', 'AS', 'SY', 'SYR', '963', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(214, 'Swaziland', 'AF', 'SZ', 'SWZ', '268', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(215, 'Turks e Caicos', 'NA', 'TC', 'TCA', '+1-649', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(216, 'Ciad', 'AF', 'TD', 'TCD', '235', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(217, 'Terre australi e antar', 'AN', 'TF', 'ATF', '', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(218, 'Togo', 'AF', 'TG', 'TGO', '228', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(219, 'Thailandia', 'AS', 'TH', 'THA', '66', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(220, 'Tagikistan', 'AS', 'TJ', 'TJK', '992', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(221, 'Tokelau', 'OC', 'TK', 'TKL', '690', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(222, 'Timor Est', 'OC', 'TL', 'TLS', '670', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(223, 'Turkmenistan', 'AS', 'TM', 'TKM', '993', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(224, 'Tunisia', 'AF', 'TN', 'TUN', '216', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(225, 'Tonga', 'OC', 'TO', 'TON', '676', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(226, 'Turchia', 'AS', 'TR', 'TUR', '90', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(227, 'Trinidad e Tobago', 'NA', 'TT', 'TTO', '+1-868', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(228, 'Tuvalu', 'OC', 'TV', 'TUV', '688', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(229, 'Taiwan', 'AS', 'TW', 'TWN', '886', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(230, 'Tanzania', 'AF', 'TZ', 'TZA', '255', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(231, 'Ucraina', 'EU', 'UA', 'UKR', '380', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(232, 'Uganda', 'AF', 'UG', 'UGA', '256', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(233, 'Isole minori esterne degli Stati Uniti', 'OC', 'UM', 'UMI', '1', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(234, 'Stati Uniti', 'NA', 'US', 'USA', '1', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(235, 'Uruguay', 'SA', 'UY', 'URY', '598', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(236, 'Uzbekistan', 'AS', 'UZ', 'UZB', '998', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(237, 'Città del Vaticano', 'EU', 'VA', 'VAT', '379', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(238, 'Saint Vincent e Grenad', 'NA', 'VC', 'VCT', '+1-784', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(239, 'Venezuela', 'SA', 'VE', 'VEN', '58', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(240, 'Isole Vergini britanni', 'NA', 'VG', 'VGB', '+1-284', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(241, 'Isole Vergini americane', 'NA', 'VI', 'VIR', '+1-340', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(242, 'Vietnam', 'AS', 'VN', 'VNM', '84', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(243, 'Vanuatu', 'OC', 'VU', 'VUT', '678', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(244, 'Wallis e Futuna', 'OC', 'WF', 'WLF', '681', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(245, 'Samoa', 'OC', 'WS', 'WSM', '685', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(246, 'Yemen', 'AS', 'YE', 'YEM', '967', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(247, 'Mayotte', 'AF', 'YT', 'MYT', '262', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(248, 'Sudafrica', 'AF', 'ZA', 'ZAF', '27', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(249, 'Zambia', 'AF', 'ZM', 'ZMB', '260', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(250, 'Zimbabwe', 'AF', 'ZW', 'ZWE', '263', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(251, 'Serbia e Montenegro', 'EU', 'CS', 'SCG', '381', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(252, 'Antille Olandesi', 'NA', 'AN', 'ANT', '599', '2024-10-18 16:01:25', '2024-10-18 16:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `credit_id` bigint(20) UNSIGNED NOT NULL,
  `total_credits` int(11) NOT NULL,
  `spent_credits` int(11) NOT NULL,
  `remaining_credits` int(11) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`credit_id`, `total_credits`, `spent_credits`, `remaining_credits`, `update_date`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 100, 50, 50, '2024-10-19 13:13:36', '2024-10-19 11:13:36', '2024-10-19 11:13:36', 1),
(2, 70, 10, 60, '2024-10-19 13:13:36', '2024-10-19 11:13:36', '2024-10-19 11:13:36', 2),
(3, 90, 0, 90, '2024-10-19 13:13:36', '2024-10-19 11:13:36', '2024-10-19 11:13:36', 3),
(4, 200, 0, 200, '2024-11-07 14:31:44', '2024-11-07 13:31:44', '2024-11-07 13:31:44', 3),
(6, 200, 0, 200, '2024-11-11 15:04:13', '2024-11-11 14:04:13', '2024-11-11 14:04:13', 20);

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `season_id` bigint(20) UNSIGNED NOT NULL,
  `episode_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `episode_number` tinyint(3) UNSIGNED NOT NULL,
  `duration` smallint(5) UNSIGNED DEFAULT NULL,
  `status` enum('published','draft','scheduled','coming soon') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`season_id`, `episode_id`, `title`, `slug`, `description`, `episode_number`, `duration`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Pilot', 'pilot', 'Walter White begins his life of crime as a meth producer...', 1, 58, 'published', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(1, 2, 'Cat’s in the Bag...', 'cats-in-the-bag', 'Walter and Jesse face problems with disposing of the bodies...', 2, 48, 'published', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(1, 3, '...And the Bag’s in the River', 'and-the-bags-in-the-river', 'Walter is faced with a tough decision regarding Krazy-8...', 3, 48, 'published', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(2, 4, 'The Vanishing of Will Byers', 'the-vanishing-of-will-byers', 'A boy goes missing in the small town of Hawkins. His friends begin to search for him, uncovering dark secrets along the way.', 1, 55, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(2, 5, 'The Weirdo on Maple Street', 'the-weirdo-on-maple-street', 'The friends meet a strange girl with powers who might know what happened to Will. More mysterious events unfold.', 2, 50, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(2, 6, 'Holly, Jolly', 'holly-jolly', 'The kids begin to suspect that more is going on in Hawkins than they thought. Joyce believes she has made contact with Will.', 3, 55, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(2, 7, 'The Body', 'the-body', 'A body is discovered, but the truth might be darker than anyone imagines. The kids uncover more about Eleven\'s powers.', 4, 60, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(2, 8, 'The Flea and the Acrobat', 'the-flea-and-the-acrobat', 'The kids learn about parallel dimensions and realize that something terrible is lurking there.', 5, 58, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(3, 9, 'MADMAX', 'madmax', 'The kids are back, but new threats emerge in Hawkins. The town is still haunted by the events of last year.', 1, 54, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(3, 10, 'Trick or Treat, Freak', 'trick-or-treat-freak', 'It\'s Halloween in Hawkins, but the kids realize that things are far from normal as they deal with dangerous new threats.', 2, 52, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(3, 11, 'The Pollywog', 'the-pollywog', 'Dustin discovers a strange new creature, and the group works together to figure out what it is.', 3, 57, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(3, 12, 'Will the Wise', 'will-the-wise', 'Will\'s connection to the Upside Down grows stronger, causing the group to fear what\'s coming.', 4, 55, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(3, 13, 'Dig Dug', 'dig-dug', 'Hopper goes on a dangerous mission to uncover the truth about what\'s beneath Hawkins.', 5, 58, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(4, 14, 'Suzie, Do You Copy?', 'suzie-do-you-copy', 'The gang faces new dangers as they uncover a sinister plot tied to the Russians and the Upside Down.', 1, 55, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(4, 15, 'The Mall Rats', 'the-mall-rats', 'The new mall in Hawkins becomes the center of attention as strange things begin happening again.', 2, 52, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(4, 16, 'The Case of the Missing Lifeguard', 'the-case-of-the-missing-lifeguard', 'A local lifeguard goes missing, and the group starts to investigate.', 3, 60, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(4, 17, 'The Sauna Test', 'the-sauna-test', 'The gang tries to prove that a dangerous entity is controlling some of the residents.', 4, 57, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(4, 18, 'The Battle of Starcourt', 'the-battle-of-starcourt', 'The season concludes with a dramatic battle at the Starcourt Mall as the Upside Down invades.', 5, 61, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(5, 19, 'The Mandalorian', 'the-mandalorian', 'The Mandalorian begins his journey with a dangerous mission.', 1, 45, 'published', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(5, 20, 'The Child', 'the-child', 'The Mandalorian becomes the guardian of a mysterious child.', 2, 48, 'published', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(9, 30, 'A Shadow of the Past', 'a-shadow-of-the-past', 'As darkness rises in Middle-earth, unexpected alliances are forged. Familiar heroes and new faces come together to face the beginning of an ancient evil.', 1, 60, 'published', '2024-11-11 14:47:30', '2024-11-11 14:47:30', NULL),
(9, 31, 'Adrift', 'adrift', 'Galadriel and Halbrand find themselves stranded at sea, where they must work together to survive. Meanwhile, the elves and dwarves struggle to mend old wounds.', 2, 58, 'published', '2024-11-11 14:50:34', '2024-11-11 14:50:34', NULL),
(9, 32, 'The Great Wave', 'the-great-wave', 'As Númenor’s court tensions rise, Galadriel takes a bold step. The Southlands brace for an impending storm, unaware of the shadow’s return.', 3, 65, 'published', '2024-11-11 14:50:53', '2024-11-11 14:50:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `episode_image`
--

CREATE TABLE `episode_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `episode_id` bigint(20) UNSIGNED NOT NULL,
  `image_file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `episode_video_file`
--

CREATE TABLE `episode_video_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `episode_id` bigint(20) UNSIGNED NOT NULL,
  `video_file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_files`
--

CREATE TABLE `image_files` (
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `format` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_files`
--

INSERT INTO `image_files` (`image_id`, `url`, `title`, `description`, `format`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'https://example.com/onward-poster.jpg', 'Onward Poster', 'Official poster for Onward.', 'jpg', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(2, 'https://example.com/tenet-poster.jpg', 'Tenet Poster', 'Official poster for Tenet.', 'jpg', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(3, 'https://example.com/bad-boys-for-life-poster.jpg', 'Bad Boys for Life Poster', 'Official poster for Bad Boys for Life.', 'jpg', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(4, 'https://example.com/the-invisible-man-poster.jpg', 'The Invisible Man Poster', 'Official poster for The Invisible Man.', 'jpg', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(5, 'https://example.com/onward-poster.jpg', 'Onward Poster', 'Official poster for Onward.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(6, 'https://example.com/tenet-poster.jpg', 'Tenet Poster', 'Official poster for Tenet.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(7, 'https://example.com/bad-boys-for-life-poster.jpg', 'Bad Boys for Life Poster', 'Official poster for Bad Boys for Life.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(8, 'https://example.com/the-invisible-man-poster.jpg', 'The Invisible Man Poster', 'Official poster for The Invisible Man.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(9, 'https://example.com/american-murder-poster.jpg', 'American Murder: The Family Next Door Poster', 'Official poster for American Murder: The Family Next Door.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(10, 'https://example.com/the-half-of-it-poster.jpg', 'The Half of It Poster', 'Official poster for The Half of It.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(11, 'https://example.com/greyhound-poster.jpg', 'Greyhound Poster', 'Official poster for Greyhound.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(12, 'https://example.com/news-of-the-world-poster.jpg', 'News of the World Poster', 'Official poster for News of the World.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(13, 'https://example.com/the-witcher-nightmare-poster.jpg', 'The Witcher: Nightmare of the Wolf Poster', 'Official poster for The Witcher: Nightmare of the Wolf.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(14, 'https://example.com/the-grudge-poster.jpg', 'The Grudge Poster', 'Official poster for The Grudge.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(15, 'https://example.com/soul-poster.jpg', 'Soul Poster', 'Official poster for Soul.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(16, 'https://example.com/wonder-woman-1984-poster.jpg', 'Wonder Woman 1984 Poster', 'Official poster for Wonder Woman 1984.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(17, 'https://example.com/palm-springs-poster.jpg', 'Palm Springs Poster', 'Official poster for Palm Springs.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(18, 'https://example.com/the-call-of-the-wild-poster.jpg', 'The Call of the Wild Poster', 'Official poster for The Call of the Wild.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(19, 'https://example.com/extraction-poster.jpg', 'Extraction Poster', 'Official poster for Extraction.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(20, 'https://example.com/the-trial-of-the-chicago-7-poster.jpg', 'The Trial of the Chicago 7 Poster', 'Official poster for The Trial of the Chicago 7.', 'jpg', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(21, 'https://example.com/stranger-things-season1-poster.jpg', 'Stranger Things Season 1 Poster', 'Official poster for Stranger Things Season 1.', 'jpg', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(22, 'https://example.com/stranger-things-season2-poster.jpg', 'Stranger Things Season 2 Poster', 'Official poster for Stranger Things Season 2.', 'jpg', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(23, 'https://example.com/stranger-things-season3-poster.jpg', 'Stranger Things Season 3 Poster', 'Official poster for Stranger Things Season 3.', 'jpg', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(24, 'https://example.com/the-mandalorian-season1-poster.jpg', 'The Mandalorian Season 1 Poster', 'Official poster for The Mandalorian Season 1.', 'jpg', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(25, 'https://example.com/breaking-bad-season1-poster.jpg', 'Breaking Bad Season 1 Poster', 'Official poster for Breaking Bad Season 1.', 'jpg', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(74, 'https://static.hbo.com/game-of-thrones-1-1920x1080.jpg', 'Game of thrones', 'Game of Thrones describes a long struggle for power between noble families while a threat looms over their kingdoms, an external enemy that destroys everything in its path: the White Walkers', 'jpeg', '2024-11-06 18:21:56', '2024-11-06 18:21:56', NULL),
(80, 'https://example.com/rocky.jpeg', 'Rocky', 'A small-time boxer gets a rare chance to fight a heavyweight champion', 'jpeg', '2024-11-11 07:45:41', '2024-11-11 07:45:41', NULL),
(81, 'https://example.com/Sakra.jpg', 'Sakra', NULL, 'jpg', '2024-11-11 12:07:06', '2024-11-11 12:07:06', NULL),
(82, 'https://example.com/Sakra.jpg', 'Sakra', 'Qiao Feng is the respected leader of a roving band of martial artists', 'jpg', '2024-11-11 14:14:12', '2024-11-11 14:14:12', NULL),
(83, 'https://example.com/Sakra.jpg', 'Sakra', 'Qiao Feng is the respected leader of a roving band of martial artists', 'jpg', '2024-11-11 14:15:39', '2024-11-11 14:15:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_09_11_000001_create_countries_table', 1),
(3, '2024_09_11_000002_create_roles_table', 1),
(4, '2024_09_11_000004_create_image_files_table', 1),
(5, '2024_09_11_000005_create_categories_table', 1),
(6, '2024_09_12_000001_create_users_table', 1),
(7, '2024_09_12_000002_create_movies_table', 1),
(8, '2024_09_12_000003_create_tv_series_table', 1),
(9, '2024_09_12_000005_create_seasons_table', 1),
(10, '2024_09_12_000006_create_episodes_table', 1),
(11, '2024_09_12_000008_create_persons_table', 1),
(12, '2024_09_12_000009_create_trailers_table', 1),
(13, '2024_09_12_000010_create_video_files_table', 1),
(14, '2024_09_12_000012_create_my_lists_table', 1),
(15, '2024_09_12_000013_create_likes_table', 1),
(16, '2024_09_12_000014_create_views_table', 1),
(17, '2024_09_12_000016_create_notifications_table', 1),
(18, '2024_09_12_000017_create_credits_table', 1),
(19, '2024_09_12_000018_create_histories_table', 1),
(20, '2024_09_12_000020_create_permissions_table', 1),
(21, '2024_09_12_000021_create_role_permissions_table', 1),
(22, '2024_09_21_000001_create_content_persons_table', 1),
(23, '2024_10_06_000001_create_sessions_table', 1),
(24, '2024_10_22_000001_create_movie_person_table', 2),
(25, '2024_10_22_000002_create_movie_image_table', 2),
(26, '2024_10_22_000003_create_movie_trailer_table', 2),
(27, '2024_10_22_000004_create_movie_video_file_table', 2),
(28, '2024_10_22_000005_create_tv_series_trailer_table', 3),
(29, '2024_10_22_000006_create_season_trailer_table', 3),
(30, '2024_10_22_000007_create_tv_series_image_table', 3),
(31, '2024_10_22_000008_create_season_image_table', 3),
(32, '2024_10_22_000009_create_episode_image_table', 3),
(33, '2024_10_22_000010_create_episode_video_file_table', 3),
(34, '2024_10_22_000011_create_tv_series_person_table', 3),
(35, '2024_10_22_000012_create_season_person_table', 3),
(36, '2024_10_22_000013_create_episode_person_table', 3),
(37, '2024_10_22_000014_create_person_image_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(128) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `duration` smallint(5) UNSIGNED DEFAULT NULL,
  `imdb_rating` decimal(3,1) DEFAULT NULL,
  `status` enum('published','draft','scheduled','coming soon') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `slug`, `description`, `year`, `duration`, `imdb_rating`, `status`, `created_at`, `updated_at`, `deleted_at`, `category_id`) VALUES
(1, 'News of the World', 'news-of-the-world', 'A Civil War veteran embarks on a journey across Texas to return a young girl to her relatives, encountering challenges and rediscovering his own humanity.', 2020, 118, '6.8', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 10),
(2, 'The Witcher: Nightmare of the Wolf', 'the-witcher-nightmare-of-the-wolf', 'Vesemir escapes poverty to become a witcher and kill monsters for coin, but a new menace rises. The story delves into the origins of the Witcher universe.', 2020, 81, '7.5', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 11),
(3, 'The Grudge', 'the-grudge', 'A detective investigates a murder scene that has a connection to a supernatural curse. The curse spreads and haunts anyone who dares to enter the cursed house.', 2020, 94, '4.3', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 13),
(4, 'Soul', 'soul', 'A musician who\'s lost his passion for music is transported out of his body and must find his way back with the help of a young soul learning about life.', 2020, 100, '8.1', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 14),
(5, 'Wonder Woman 1984', 'wonder-woman-1984', 'Diana Prince comes into conflict with the Soviet Union during the Cold War in the 1980s. The film sees Wonder Woman battle villains in a colorful, retro setting.', 2020, 151, '5.4', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 1),
(6, 'Palm Springs', 'palm-springs', 'Stuck in a time loop, two wedding guests develop a budding romance as they relive the same day over and over. The film blends romance with sci-fi elements.', 2020, 90, '7.4', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 2),
(7, 'The Call of the Wild', 'the-call-of-the-wild', 'A domesticated dog embarks on an adventure in the Yukon during the Klondike Gold Rush. As the dog adapts to wilderness life, it learns to embrace its wild nature.', 2020, 100, '6.8', 'published', '2024-10-22 20:19:39', '2024-10-23 13:35:30', '2024-10-23 13:35:30', 3),
(8, 'Extraction', 'extraction', 'A black ops mercenary must rescue the kidnapped son of an international crime lord. As he battles his way through adversaries, he confronts his own demons.', 2020, 116, '6.7', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 4),
(9, 'The Trial of the Chicago 7', 'the-trial-of-the-chicago-7', 'The story of seven individuals charged with conspiracy and inciting a riot during the 1968 Democratic National Convention. The film focuses on the courtroom drama and political turbulence.', 2020, 130, '7.8', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 5),
(10, 'Onward', 'onward', 'Two brothers embark on a magical quest to bring their father back for one day. They encounter magical creatures and learn valuable lessons about life and family. Along the way, their bond strengthens as they face challenges.', 2020, 102, '7.4', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 3),
(11, 'Tenet', 'tenet', 'A secret agent embarks on a time-bending mission to prevent the start of World War III. Armed with one word—Tenet—he must navigate through a twilight world of international espionage. The film challenges concepts of time, perception, and loyalty.', 2020, 150, '7.5', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 4),
(12, 'Bad Boys for Life', 'bad-boys-for-life', 'The wife and son of a Mexican drug lord embark on a vengeful quest. Two Miami detectives must face their old foes, confronting danger and personal turmoil along the way. As their past catches up to them, they must make a choice: justice or revenge.', 2020, 124, '7.2', 'published', '2024-10-22 20:19:39', '2024-10-22 20:19:39', NULL, 5),
(13, 'The Invisible Man', 'the-invisible-man', 'A woman believes she\'s being hunted by her abusive ex-boyfriend who has become invisible. She fights to prove that she\'s being terrorized, but no one believes her. As the mystery unfolds, she realizes that the greatest threat might be her own mind.', 2020, 124, '7.1', 'published', '2024-10-22 20:19:40', '2024-10-22 20:19:40', NULL, 6),
(14, 'American Murder: The Family Next Door', 'american-murder-the-family-next-door', 'Using raw, firsthand footage, this documentary examines the disappearance of Shanann Watts and her children. The story explores the disturbing events that led to their tragic deaths and the psychological toll it took on those involved.', 2020, 83, '7.2', 'published', '2024-10-22 20:19:40', '2024-10-22 20:19:40', NULL, 7),
(15, 'The Half of It', 'the-half-of-it', 'A shy, introverted student helps the school jock woo a girl whom, secretly, they both want. The story explores love, friendship, and identity, and how sometimes, the most important lessons are those we learn about ourselves.', 2020, 104, '7.0', 'published', '2024-10-22 20:19:40', '2024-10-22 20:19:40', NULL, 8),
(16, 'Greyhound', 'greyhound', 'In the early days of World War II, an inexperienced U.S. Navy captain must lead an Allied convoy through dangerous waters. As the battle intensifies, the captain must make decisions that will determine the fate of his crew and the convoy.', 2020, 91, '7.0', 'published', '2024-10-22 20:19:40', '2024-10-22 20:19:40', NULL, 9),
(17, 'Rocky', 'rocky', 'A small-time boxer gets a rare chance to fight a heavyweight champion in a bout in which he strives to go the distance for his self-respect.', 1976, 120, '8.1', 'published', '2024-11-07 09:47:33', '2024-11-07 09:47:33', NULL, 10),
(18, 'Rambo: First Blood', 'rambo-first-blood', 'A Vietnam War veteran uses his combat skills against the law enforcement of a small town when he is abused by them.', 1982, 93, '7.7', 'coming soon', '2024-11-07 09:48:22', '2024-11-07 09:48:22', NULL, 11),
(19, 'The Expendables', 'the-expendables', 'A team of mercenaries takes on dangerous missions, only to be faced with betrayal and danger at every corner.', 2010, 103, '6.5', 'draft', '2024-11-07 09:48:57', '2024-11-07 09:48:57', NULL, 12),
(20, 'Die Hard', 'die-hard', 'An NYPD officer tries to save his wife and others taken hostage by German terrorists during a Christmas party in Los Angeles.', 1988, 132, '8.2', 'published', '2024-11-07 09:57:24', '2024-11-07 10:28:43', NULL, 1),
(25, 'Sacra', 'sakra', 'Qiao Feng is the respected leader of a roving band of martial artists. After he is wrongfully accused of murder and subsequently exiled, Qiao Feng goes on the run in search of answers about his own mysterious origin story—and the unknown enemies working to destroy him from the shadows.', 2023, 118, '7.4', 'published', '2024-11-11 14:15:39', '2024-11-11 14:16:48', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `movie_image`
--

CREATE TABLE `movie_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `image_file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie_image`
--

INSERT INTO `movie_image` (`id`, `movie_id`, `image_file_id`, `created_at`, `updated_at`) VALUES
(54, 2, 13, NULL, NULL),
(56, 1, 12, NULL, NULL),
(57, 3, 14, NULL, NULL),
(58, 4, 15, NULL, NULL),
(59, 5, 16, NULL, NULL),
(60, 6, 17, NULL, NULL),
(61, 8, 19, NULL, NULL),
(62, 9, 20, NULL, NULL),
(63, 10, 1, NULL, NULL),
(64, 11, 2, NULL, NULL),
(65, 12, 3, NULL, NULL),
(67, 13, 4, NULL, NULL),
(68, 14, 9, NULL, NULL),
(69, 15, 10, NULL, NULL),
(70, 17, 80, NULL, NULL),
(73, 25, 83, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_person`
--

CREATE TABLE `movie_person` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `person_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie_person`
--

INSERT INTO `movie_person` (`id`, `movie_id`, `person_id`, `created_at`, `updated_at`) VALUES
(69, 1, 11, NULL, NULL),
(70, 1, 12, NULL, NULL),
(71, 2, 13, NULL, NULL),
(72, 2, 14, NULL, NULL),
(73, 3, 15, NULL, NULL),
(74, 3, 16, NULL, NULL),
(75, 4, 17, NULL, NULL),
(76, 4, 18, NULL, NULL),
(77, 5, 19, NULL, NULL),
(78, 5, 20, NULL, NULL),
(79, 6, 21, NULL, NULL),
(80, 6, 22, NULL, NULL),
(81, 7, 23, NULL, NULL),
(82, 7, 24, NULL, NULL),
(83, 8, 25, NULL, NULL),
(84, 8, 26, NULL, NULL),
(85, 9, 27, NULL, NULL),
(86, 9, 28, NULL, NULL),
(87, 10, 1, NULL, NULL),
(88, 10, 2, NULL, NULL),
(89, 10, 3, NULL, NULL),
(90, 11, 107, NULL, NULL),
(91, 11, 108, NULL, NULL),
(92, 11, 109, NULL, NULL),
(93, 12, 110, NULL, NULL),
(94, 12, 111, NULL, NULL),
(95, 13, 112, NULL, NULL),
(96, 13, 113, NULL, NULL),
(97, 14, 112, NULL, NULL),
(98, 14, 114, NULL, NULL),
(99, 15, 115, NULL, NULL),
(100, 15, 116, NULL, NULL),
(101, 16, 117, NULL, NULL),
(102, 16, 118, NULL, NULL),
(103, 7, 12, NULL, NULL),
(104, 7, 13, NULL, NULL),
(105, 7, 14, NULL, NULL),
(106, 12, 14, NULL, NULL),
(107, 17, 1, NULL, NULL),
(108, 17, 11, NULL, NULL),
(109, 17, 12, NULL, NULL),
(110, 18, 1, NULL, NULL),
(111, 18, 13, NULL, NULL),
(112, 18, 14, NULL, NULL),
(113, 19, 1, NULL, NULL),
(114, 19, 15, NULL, NULL),
(115, 19, 16, NULL, NULL),
(116, 20, 250, NULL, NULL),
(117, 20, 17, NULL, NULL),
(118, 20, 18, NULL, NULL),
(136, 25, 251, NULL, NULL),
(137, 25, 252, NULL, NULL),
(138, 25, 253, NULL, NULL),
(139, 25, 254, NULL, NULL),
(140, 25, 255, NULL, NULL),
(141, 25, 256, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_trailer`
--

CREATE TABLE `movie_trailer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `trailer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie_trailer`
--

INSERT INTO `movie_trailer` (`id`, `movie_id`, `trailer_id`, `created_at`, `updated_at`) VALUES
(49, 17, 75, NULL, NULL),
(50, 18, 76, NULL, NULL),
(51, 19, 77, NULL, NULL),
(52, 20, 78, NULL, NULL),
(54, 2, 14, NULL, NULL),
(56, 1, 13, NULL, NULL),
(57, 3, 15, NULL, NULL),
(58, 4, 16, NULL, NULL),
(59, 5, 17, NULL, NULL),
(60, 6, 18, NULL, NULL),
(61, 8, 20, NULL, NULL),
(62, 9, 21, NULL, NULL),
(63, 10, 1, NULL, NULL),
(64, 11, 2, NULL, NULL),
(65, 12, 3, NULL, NULL),
(66, 13, 4, NULL, NULL),
(67, 14, 5, NULL, NULL),
(68, 15, 11, NULL, NULL),
(69, 16, 75, NULL, NULL),
(72, 25, 82, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_video_file`
--

CREATE TABLE `movie_video_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `video_file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie_video_file`
--

INSERT INTO `movie_video_file` (`id`, `movie_id`, `video_file_id`, `created_at`, `updated_at`) VALUES
(1, 2, 13, NULL, NULL),
(3, 1, 12, NULL, NULL),
(4, 3, 14, NULL, NULL),
(5, 4, 15, NULL, NULL),
(6, 5, 16, NULL, NULL),
(7, 6, 17, NULL, NULL),
(8, 8, 19, NULL, NULL),
(9, 9, 20, NULL, NULL),
(10, 10, 1, NULL, NULL),
(11, 11, 2, NULL, NULL),
(12, 12, 3, NULL, NULL),
(13, 13, 4, NULL, NULL),
(14, 14, 9, NULL, NULL),
(15, 15, 10, NULL, NULL),
(16, 17, 79, NULL, NULL),
(19, 25, 82, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `permission_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_name`, `created_at`, `updated_at`) VALUES
(1, 'read', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(2, 'create', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(3, 'update', '2024-10-18 16:01:25', '2024-10-18 16:01:25'),
(4, 'delete', '2024-10-18 16:01:25', '2024-10-18 16:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(20, 'App\\Models\\User', 2, 'auth_token', '63726ce8562f499b3d046aa94a749ee1a587e534732160010a3c646c2fd5ad70', '[\"read\",\"update-profile\",\"add-credits\"]', '2024-10-23 13:30:10', NULL, '2024-10-19 13:43:53', '2024-10-23 13:30:10'),
(27, 'App\\Models\\User', 13, 'auth_token', '294de65e33ea58efcf4e9ea4aada7713fc946540cb7418bf724cd09cffe30cea', '[\"read\",\"update-profile\",\"add-credits\"]', '2024-11-01 15:49:12', NULL, '2024-11-01 15:46:36', '2024-11-01 15:49:12'),
(28, 'App\\Models\\User', 14, 'auth_token', '58880740ba16a60fbeb3c73159ea796d66a85b09f299f1226ae5aaf7691f28e8', '[\"read\",\"update-profile\",\"add-credits\"]', '2024-11-02 11:42:56', NULL, '2024-11-01 15:52:29', '2024-11-02 11:42:56'),
(29, 'App\\Models\\User', 14, 'auth_token', 'd7150fd02b9f8cc3084481aeeddd40112b0f396449a67f9410ba620418d86638', '[\"read\",\"update-profile\",\"add-credits\"]', NULL, NULL, '2024-11-02 12:45:23', '2024-11-02 12:45:23'),
(34, 'App\\Models\\User', 3, 'auth_token', '1f6b1b33e436031bffbaa87d243b42dfc6c6186e669561a09ff2dddb719f6fb1', '[\"read\",\"update-profile\",\"add-credits\"]', NULL, NULL, '2024-11-04 14:28:23', '2024-11-04 14:28:23'),
(35, 'App\\Models\\User', 3, 'auth_token', '9e379426e8d8863a88a3b0a0c19b72dd7396ad0c5a4a96a1b5e2b0d36366db30', '[\"read\",\"update-profile\",\"add-credits\"]', NULL, NULL, '2024-11-04 15:38:05', '2024-11-04 15:38:05'),
(40, 'App\\Models\\User', 3, 'auth_token', '8dbed95d958473960d8646e65bc68f361a8f21d3d99b97936e054f9483e8c17f', '[\"read\",\"update-profile\",\"credits\"]', '2024-11-07 13:36:04', NULL, '2024-11-07 13:30:42', '2024-11-07 13:36:04'),
(42, 'App\\Models\\User', 15, 'auth_token', 'e4ffc50a04adf9aa6fe86a64005e12a080c4694902d2c23f9b27aef57dcb5279', '[\"read\",\"update-profile\",\"credits\"]', '2024-11-11 09:09:29', NULL, '2024-11-11 09:05:57', '2024-11-11 09:09:29'),
(44, 'App\\Models\\User', 3, 'auth_token', 'a75ae3a322015afeb46ce7430919134f877784e3a21f1b5d29aad3cbbcf0b997', '[\"read\",\"update-profile\",\"credits\"]', '2024-11-11 09:22:41', NULL, '2024-11-11 09:22:25', '2024-11-11 09:22:41'),
(45, 'App\\Models\\User', 18, 'auth_token', '01b263e1fa888ea854712d47d7b46fef27c846dc342b73a7d873b7663c28cff5', '[\"read\",\"update-profile\",\"credits\"]', NULL, NULL, '2024-11-11 11:07:04', '2024-11-11 11:07:04'),
(46, 'App\\Models\\User', 19, 'auth_token', '1b4241858c298ad25d82543e4348b20fd821350155d784ecb6981f85009bde1d', '[\"read\",\"update-profile\",\"credits\"]', '2024-11-11 12:37:57', NULL, '2024-11-11 11:22:58', '2024-11-11 12:37:57'),
(48, 'App\\Models\\User', 20, 'auth_token', 'eddf98beee2b6e813f6842d5adf7cc01776ca3af2c5febd4dca30e3189455072', '[\"read\",\"update-profile\",\"credits\"]', '2024-11-11 15:29:35', NULL, '2024-11-11 13:40:03', '2024-11-11 15:29:35'),
(51, 'App\\Models\\User', 1, 'auth_token', 'dead5094a61f383c8f73c876508aeaca513b04e36710f760b26c0866374b5cc9', '[\"*\"]', '2024-11-11 15:31:24', NULL, '2024-11-11 15:30:43', '2024-11-11 15:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sylvester Stallone', '2024-10-19 14:13:09', '2024-10-19 14:13:09', NULL),
(2, 'Bruce Lee', '2024-10-19 14:13:09', '2024-10-19 14:13:09', NULL),
(3, 'Mike Tyson', '2024-10-19 14:13:09', '2024-10-19 14:13:09', NULL),
(4, 'Steven Segal', '2024-10-19 14:13:09', '2024-10-19 14:13:09', NULL),
(5, 'Pamela Anderson', '2024-10-19 14:13:09', '2024-10-19 14:13:09', NULL),
(6, 'Henry Cavill', '2024-10-19 14:16:09', '2024-10-19 14:16:09', NULL),
(7, 'Jennifer Lopez\r\n', '2024-10-19 14:16:09', '2024-10-19 14:16:09', NULL),
(8, 'Timothée Chalamet', '2024-10-19 14:16:09', '2024-10-19 14:16:09', NULL),
(9, 'Florence Pugh', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(10, 'Michael B. Jordan', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(11, 'Robert De Niro', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(12, 'Al Pacino', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(13, 'Leonardo DiCaprio', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(14, 'Tom Hanks', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(15, 'Johnny Depp', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(16, 'Brad Pitt', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(17, 'Denzel Washington', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(18, 'Matt Damon', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(19, 'Morgan Freeman', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(20, 'Clint Eastwood', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(21, 'Will Smith', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(22, 'Christian Bale', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(23, 'Robert Downey Jr.', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(24, 'Chris Hemsworth', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(25, 'Chris Evans', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(26, 'Scarlett Johansson', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(27, 'Natalie Portman', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(28, 'Julia Roberts', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(29, 'Charlize Theron', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(30, 'Angelina Jolie', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(31, 'Meryl Streep', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(32, 'Emma Stone', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(33, 'Anne Hathaway', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(34, 'Jennifer Lawrence', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(35, 'Reese Witherspoon', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(36, 'Cate Blanchett', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(37, 'Tom Cruise', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(38, 'Keanu Reeves', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(39, 'Hugh Jackman', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(40, 'Ryan Reynolds', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(41, 'Mark Wahlberg', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(42, 'Jake Gyllenhaal', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(43, 'Ben Affleck', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(44, 'Matt Damon', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(45, 'Gerard Butler', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(46, 'Daniel Craig', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(47, 'Liam Neeson', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(48, 'Harrison Ford', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(49, 'Samuel L. Jackson', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(50, 'Anthony Hopkins', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(51, 'Michael Caine', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(52, 'Ian McKellen', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(53, 'Javier Bardem', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(54, 'Joaquin Phoenix', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(55, 'Adam Driver', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(56, 'Chris Pratt', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(57, 'Zoe Saldana', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(58, 'Vin Diesel', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(59, 'Dwayne Johnson', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(60, 'Ryan Gosling', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(61, 'Ethan Hawke', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(62, 'Paul Rudd', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(63, 'Jason Momoa', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(64, 'Tessa Thompson', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(65, 'Mahershala Ali', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(66, 'Chadwick Boseman', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(67, 'Jared Leto', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(68, 'Gal Gadot', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(69, 'Brie Larson', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(70, 'Margot Robbie', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(71, 'Nicole Kidman', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(72, 'Emily Blunt', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(73, 'Jessica Chastain', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(74, 'Amy Adams', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(75, 'Elizabeth Olsen', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(76, 'Kristen Stewart', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(77, 'Emma Watson', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(78, 'Sandra Bullock', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(79, 'Halle Berry', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(80, 'Michelle Pfeiffer', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(81, 'Renee Zellweger', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(82, 'Glenn Close', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(83, 'Sharon Stone', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(84, 'Uma Thurman', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(85, 'Monica Bellucci', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(86, 'Salma Hayek', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(87, 'Penélope Cruz', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(88, 'Sofia Vergara', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(89, 'Eva Mendes', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(90, 'Jessica Alba', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(91, 'Cameron Diaz', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(92, 'Drew Barrymore', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(93, 'Kate Winslet', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(94, 'Helen Mirren', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(95, 'Judi Dench', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(96, 'Keira Knightley', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(97, 'Emily Mortimer', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(98, 'Rosamund Pike', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(99, 'Gwyneth Paltrow', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(100, 'Winona Ryder', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(101, 'Dakota Johnson', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(102, 'Maggie Gyllenhaal', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(103, 'Zooey Deschanel', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(104, 'Kristen Bell', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(105, 'Alison Brie', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(106, 'Jennifer Garner', '2024-10-19 14:16:10', '2024-10-19 14:16:10', NULL),
(107, 'Tom Holland', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(108, 'John David Washington', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(109, 'Robert Pattinson', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(110, 'Martin Lawrence', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(111, 'Elisabeth Moss', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(112, 'Shanann Watts', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(113, 'Leah Lewis', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(114, 'Daniel Diemer', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(115, 'Helena Zengel', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(116, 'Theo James', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(117, 'Andrea Riseborough', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(118, 'Jamie Foxx', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(119, 'Tina Fey', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(120, 'Chris Pine', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(121, 'Andy Samberg', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(122, 'Cristin Milioti', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(123, 'Eddie Redmayne', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(124, 'Sacha Baron Cohen', '2024-10-21 13:18:35', '2024-10-21 13:18:35', NULL),
(125, 'Bryan Cranston', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(126, 'Aaron Paul', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(127, 'Scarlett Johansson', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(128, 'Henry Cavill', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(129, 'Emilia Clarke', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(130, 'Pedro Pascal', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(131, 'Gillian Anderson', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(132, 'David Duchovny', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(133, 'Millie Bobby Brown', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(134, 'Winona Ryder', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(135, 'Tom Hiddleston', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(136, 'Chris Hemsworth', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(137, 'Gal Gadot', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(138, 'Dwayne Johnson', '2024-10-21 15:04:14', '2024-10-21 15:04:14', NULL),
(139, 'Bryan Cranston', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(140, 'Aaron Paul', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(141, 'Scarlett Johansson', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(142, 'Henry Cavill', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(143, 'Emilia Clarke', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(144, 'Pedro Pascal', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(145, 'Gillian Anderson', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(146, 'David Duchovny', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(147, 'Millie Bobby Brown', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(148, 'Winona Ryder', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(149, 'Tom Hiddleston', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(150, 'Chris Hemsworth', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(151, 'Gal Gadot', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(152, 'Dwayne Johnson', '2024-10-21 15:05:57', '2024-10-21 15:05:57', NULL),
(153, 'Bryan Cranston', '2024-10-21 15:07:40', '2024-10-21 15:07:40', NULL),
(154, 'Aaron Paul', '2024-10-21 15:07:40', '2024-10-21 15:07:40', NULL),
(155, 'Scarlett Johansson', '2024-10-21 15:07:40', '2024-10-21 15:07:40', NULL),
(156, 'Henry Cavill', '2024-10-21 15:07:40', '2024-10-21 15:07:40', NULL),
(157, 'Emilia Clarke', '2024-10-21 15:07:40', '2024-10-21 15:07:40', NULL),
(158, 'Pedro Pascal', '2024-10-21 15:07:40', '2024-10-21 15:07:40', NULL),
(159, 'Gillian Anderson', '2024-10-21 15:07:40', '2024-10-21 15:07:40', NULL),
(160, 'David Duchovny', '2024-10-21 15:07:40', '2024-10-21 15:07:40', NULL),
(161, 'Millie Bobby Brown', '2024-10-21 15:07:41', '2024-10-21 15:07:41', NULL),
(162, 'Winona Ryder', '2024-10-21 15:07:41', '2024-10-21 15:07:41', NULL),
(163, 'Tom Hiddleston', '2024-10-21 15:07:41', '2024-10-21 15:07:41', NULL),
(164, 'Chris Hemsworth', '2024-10-21 15:07:41', '2024-10-21 15:07:41', NULL),
(165, 'Gal Gadot', '2024-10-21 15:07:41', '2024-10-21 15:07:41', NULL),
(166, 'Dwayne Johnson', '2024-10-21 15:07:41', '2024-10-21 15:07:41', NULL),
(167, 'Bryan Cranston', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(168, 'Aaron Paul', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(169, 'Scarlett Johansson', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(170, 'Henry Cavill', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(171, 'Emilia Clarke', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(172, 'Pedro Pascal', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(173, 'Gillian Anderson', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(174, 'David Duchovny', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(175, 'Millie Bobby Brown', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(176, 'Winona Ryder', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(177, 'Tom Hiddleston', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(178, 'Chris Hemsworth', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(179, 'Gal Gadot', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(180, 'Dwayne Johnson', '2024-10-21 15:11:54', '2024-10-21 15:11:54', NULL),
(181, 'Bryan Cranston', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(182, 'Aaron Paul', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(183, 'Scarlett Johansson', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(184, 'Henry Cavill', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(185, 'Emilia Clarke', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(186, 'Pedro Pascal', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(187, 'Millie Bobby Brown', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(188, 'David Harbour', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(189, 'Tom Hiddleston', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(190, 'Chris Hemsworth', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(191, 'Sean Bean', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(192, 'Kit Harington', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(193, 'Peter Dinklage', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(194, 'Maisie Williams', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(195, 'Lena Headey', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(196, 'Nikolaj Coster-Waldau', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(197, 'Sophie Turner', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(198, 'Isaac Hempstead Wright', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(199, 'Mark Addy', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(200, 'Jack Gleeson', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(201, 'Rory McCann', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(202, 'Aidan Gillen', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(203, 'Stephen Dillane', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(204, 'Alfie Allen', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(205, 'Gwendoline Christie', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(206, 'Conleth Hill', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(207, 'Natalie Dormer', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(208, 'John Bradley', '2024-11-06 13:07:52', '2024-11-06 13:07:52', NULL),
(209, 'Anna Gunn', '2024-11-06 14:28:38', '2024-11-06 14:28:38', NULL),
(210, 'Dean Norris', '2024-11-06 14:28:38', '2024-11-06 14:28:38', NULL),
(211, 'Betsy Brandt', '2024-11-06 14:28:38', '2024-11-06 14:28:38', NULL),
(212, 'RJ Mitte', '2024-11-06 14:28:38', '2024-11-06 14:28:38', NULL),
(213, 'Bob Odenkirk', '2024-11-06 14:28:38', '2024-11-06 14:28:38', NULL),
(214, 'Jonathan Banks', '2024-11-06 14:28:38', '2024-11-06 14:28:38', NULL),
(215, 'Giancarlo Esposito', '2024-11-06 14:28:38', '2024-11-06 14:28:38', NULL),
(216, 'Jesse Plemons', '2024-11-06 14:28:38', '2024-11-06 14:28:38', NULL),
(217, 'Finn Wolfhard', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(218, 'Gaten Matarazzo', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(219, 'Caleb McLaughlin', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(220, 'Natalia Dyer', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(221, 'Charlie Heaton', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(222, 'Cara Buono', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(223, 'Joe Keery', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(224, 'Noah Schnapp', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(225, 'Sadie Sink', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(226, 'Dacre Montgomery', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(227, 'Maya Hawke', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(228, 'Priah Ferguson', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(229, 'Matthew Modine', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(230, 'Paul Reiser', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(231, 'Brett Gelman', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(232, 'Sean Astin', '2024-11-06 14:31:15', '2024-11-06 14:31:15', NULL),
(233, 'Gina Carano', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(234, 'Carl Weathers', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(235, 'Emily Swallow', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(236, 'Omid Abtahi', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(237, 'Werner Herzog', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(238, 'Nick Nolte', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(239, 'Ming-Na Wen', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(240, 'Bill Burr', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(241, 'Amy Sedaris', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(242, 'Rosario Dawson', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(243, 'Katee Sackhoff', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(244, 'Timothy Olyphant', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(245, 'Temuera Morrison', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(246, 'Sasha Banks', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(247, 'Mark Hamill', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(248, 'Mercedes Moné', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(249, 'Taika Waititi', '2024-11-06 14:32:09', '2024-11-06 14:32:09', NULL),
(250, 'Bruce Willis', '2024-11-07 09:55:29', '2024-11-07 09:55:29', NULL),
(251, 'Donnie Yen', '2024-11-11 12:11:09', '2024-11-11 12:11:09', NULL),
(252, 'Kiu Fung', '2024-11-11 12:11:09', '2024-11-11 12:11:09', NULL),
(253, 'Yuqi Chen', '2024-11-11 12:11:09', '2024-11-11 12:11:09', NULL),
(254, 'Yase Liu', '2024-11-11 12:11:09', '2024-11-11 12:11:09', NULL),
(255, 'Yue Wu', '2024-11-11 12:11:09', '2024-11-11 12:11:09', NULL),
(256, 'Murong Fu', '2024-11-11 12:11:09', '2024-11-11 12:11:09', NULL),
(257, 'Morfydd Clark', '2024-11-11 14:52:24', '2024-11-11 14:52:24', NULL),
(258, 'Robert Aramayo', '2024-11-11 14:52:24', '2024-11-11 14:52:24', NULL),
(259, 'Markella Kavenagh', '2024-11-11 14:52:24', '2024-11-11 14:52:24', NULL),
(260, 'Ismael Cruz', '2024-11-11 14:52:24', '2024-11-11 14:52:24', NULL),
(261, 'Owain Arthur', '2024-11-11 14:52:24', '2024-11-11 14:52:24', NULL),
(262, 'Charlie Vickers', '2024-11-11 14:52:24', '2024-11-11 14:52:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `person_image`
--

CREATE TABLE `person_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `person_id` bigint(20) UNSIGNED NOT NULL,
  `image_file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'user', NULL, NULL),
(3, 'guest', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(1, 2, NULL, NULL),
(1, 3, NULL, NULL),
(1, 4, NULL, NULL),
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `tv_series_id` bigint(20) UNSIGNED NOT NULL,
  `season_id` bigint(20) UNSIGNED NOT NULL,
  `season_number` tinyint(3) UNSIGNED NOT NULL,
  `total_episodes` tinyint(3) UNSIGNED DEFAULT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `premiere_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`tv_series_id`, `season_id`, `season_number`, `total_episodes`, `year`, `premiere_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 7, 2008, '2008-01-20', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(2, 2, 1, 5, 2016, '2016-07-15', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(2, 3, 2, 5, 2017, '2017-10-27', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(2, 4, 3, 5, 2019, '2019-07-04', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(3, 5, 1, 5, 2019, '2019-11-12', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(7, 9, 1, 8, 2011, NULL, '2024-11-11 14:45:57', '2024-11-11 14:45:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `season_image`
--

CREATE TABLE `season_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `season_id` bigint(20) UNSIGNED NOT NULL,
  `image_file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `season_trailer`
--

CREATE TABLE `season_trailer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `season_id` bigint(20) UNSIGNED NOT NULL,
  `trailer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `last_activity`, `created_at`, `updated_at`, `user_id`) VALUES
(20, '127.0.0.1', '2024-10-19 13:43:53', '2024-10-19 13:43:53', '2024-10-19 13:43:53', 2),
(27, '151.34.13.120', '2024-11-01 15:46:36', '2024-11-01 15:46:36', '2024-11-01 15:46:36', 13),
(28, '151.34.13.120', '2024-11-01 15:52:29', '2024-11-01 15:52:29', '2024-11-01 15:52:29', 14),
(29, '151.34.13.120', '2024-11-02 12:45:23', '2024-11-02 12:45:23', '2024-11-02 12:45:23', 14),
(34, '151.34.78.252', '2024-11-04 14:28:23', '2024-11-04 14:28:23', '2024-11-04 14:28:23', 3),
(35, '151.34.78.252', '2024-11-04 15:38:05', '2024-11-04 15:38:05', '2024-11-04 15:38:05', 3),
(40, '151.38.42.87', '2024-11-07 13:30:42', '2024-11-07 13:30:42', '2024-11-07 13:30:42', 3),
(48, '151.36.41.254', '2024-11-11 13:40:03', '2024-11-11 13:40:03', '2024-11-11 13:40:03', 20),
(51, '151.36.41.254', '2024-11-11 15:30:43', '2024-11-11 15:30:43', '2024-11-11 15:30:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trailers`
--

CREATE TABLE `trailers` (
  `trailer_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trailers`
--

INSERT INTO `trailers` (`trailer_id`, `title`, `url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Onward', 'https://example.com/onward-trailer.mp4', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(2, 'Tenet', 'https://example.com/tenet-trailer.mp4', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(3, 'Bad Boys for Life', 'https://example.com/bad-boys-for-life-trailer.mp4', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(4, 'The Invisible Man', 'https://example.com/the-invisible-man-trailer.mp4', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(5, 'American Murder', 'https://example.com/american-murder-trailer.mp4', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(6, 'Onward', 'https://example.com/onward-trailer.mp4', '2024-10-21 14:11:57', '2024-11-07 13:27:54', '2024-11-07 13:27:54'),
(7, 'Tenet', 'https://example.com/tenet-trailer.mp4', '2024-10-21 14:11:57', '2024-11-07 13:27:59', '2024-11-07 13:27:59'),
(8, 'Bad Boys for Life', 'https://example.com/bad-boys-for-life-trailer.mp4', '2024-10-21 14:11:57', '2024-11-07 13:16:48', '2024-11-07 13:16:48'),
(9, 'The Invisible Man', 'https://example.com/the-invisible-man-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(10, 'American Murder', 'https://example.com/american-murder-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(11, 'The Half of It', 'https://example.com/the-half-of-it-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(12, 'Greyhound', 'https://example.com/greyhound-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(13, 'News of the World', 'https://example.com/news-of-the-world-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(14, 'The Witcher: Nightmare of the Wolf', 'https://example.com/the-witcher-nightmare-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(15, 'The Grudge', 'https://example.com/the-grudge-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(16, 'Soul', 'https://example.com/soul-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(17, 'Wonder Woman 1984', 'https://example.com/wonder-woman-1984-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(18, 'Palm Springs', 'https://example.com/palm-springs-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(19, 'The Call of the Wild', 'https://example.com/the-call-of-the-wild-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(20, 'Extraction', 'https://example.com/extraction-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(21, 'The Trial of the Chicago 7', 'https://example.com/the-trial-of-the-chicago-7-trailer.mp4', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(22, 'Stranger Things Season 1', 'https://example.com/stranger-things-season1-trailer.mp4', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(23, 'Stranger Things Season 2', 'https://example.com/stranger-things-season2-trailer.mp4', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(24, 'Stranger Things Season 3', 'https://example.com/stranger-things-season3-trailer.mp4', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(25, 'The Mandalorian Season 1', 'https://example.com/the-mandalorian-season1-trailer.mp4', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(26, 'Breaking Bad Season 1', 'https://example.com/breaking-bad-season1-trailer.mp4', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(75, 'Rocky', 'https://example.com/rocky-trailer.mp4', '2024-11-07 09:47:33', '2024-11-07 13:13:54', NULL),
(76, 'Rambo First Blood', 'https://example.com/rambo-trailer.mp4', '2024-11-07 09:48:22', '2024-11-07 13:14:32', NULL),
(77, 'The Expandables', 'https://example.com/expendables-trailer.mp4', '2024-11-07 09:48:57', '2024-11-07 13:15:07', NULL),
(78, '', 'https://example.com/die-hard-trailer.mp4', '2024-11-07 09:57:24', '2024-11-07 09:57:24', NULL),
(79, '', 'https://example.com/die-hard-trailer.mp4', '2024-11-07 09:58:26', '2024-11-07 09:58:26', NULL),
(80, 'Sakra', 'https://example.com/Sakra.mp4', '2024-11-11 12:07:06', '2024-11-11 12:07:06', NULL),
(81, 'Sakra', 'https://example.com/Sakra.mp4', '2024-11-11 14:14:12', '2024-11-11 14:14:12', NULL),
(82, 'Sakra', 'https://example.com/Sakra.mp4', '2024-11-11 14:15:39', '2024-11-11 14:15:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tv_series`
--

CREATE TABLE `tv_series` (
  `tv_series_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(128) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `imdb_rating` decimal(3,1) DEFAULT NULL,
  `total_seasons` tinyint(3) UNSIGNED DEFAULT NULL,
  `status` enum('published','draft','scheduled','coming soon') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tv_series`
--

INSERT INTO `tv_series` (`tv_series_id`, `category_id`, `title`, `slug`, `description`, `year`, `imdb_rating`, `total_seasons`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Breaking Bad', 'breaking-bad', 'A high school chemistry teacher turned methamphetamine manufacturer.', 2008, '9.5', 5, 'published', '2024-10-18 16:01:25', '2024-10-18 16:01:25', NULL),
(2, 1, 'Stranger Things', 'stranger-things', 'A group of kids uncover strange events in their small town while battling supernatural forces. They encounter a mysterious girl with supernatural powers. Together, they must stop the sinister forces threatening their town.', 2016, '8.7', 3, 'published', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(3, 2, 'The Mandalorian', 'the-mandalorian', 'A lone bounty hunter traverses the galaxy, taking dangerous missions and facing off with deadly foes.', 2019, '8.8', 3, 'published', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(5, 1, 'Game of Thrones', 'game-of-thrones', 'In the mythical land of Westeros, noble families vie for control of the Iron Throne. Alliances, betrayals, and battles reshape kingdoms as an ancient enemy awakens beyond the Wall.', 2017, '8.5', 8, 'published', '2024-11-06 11:53:02', '2024-11-06 11:56:28', NULL),
(7, 10, 'The Lord of the Rings', 'the-lord-of-the-rings', 'Beginning in a time of relative peace, we follow an ensemble cast of characters as they confront the re-emergence of evil to Middle-earth. From the darkest depths of the Misty Mountains, to the majestic forests of Lindon, to the breathtaking island kingdom of Númenor, to the furthest reaches of the map, these kingdoms and characters will carve out legacies that live on long after they are gone.', 2024, NULL, NULL, 'published', '2024-11-11 14:43:55', '2024-11-11 14:43:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tv_series_image`
--

CREATE TABLE `tv_series_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tv_series_id` bigint(20) UNSIGNED NOT NULL,
  `image_file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tv_series_image`
--

INSERT INTO `tv_series_image` (`id`, `tv_series_id`, `image_file_id`, `created_at`, `updated_at`) VALUES
(2, 1, 25, NULL, NULL),
(3, 2, 21, NULL, NULL),
(4, 3, 24, NULL, NULL),
(5, 5, 74, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tv_series_person`
--

CREATE TABLE `tv_series_person` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tv_series_id` bigint(20) UNSIGNED NOT NULL,
  `person_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tv_series_person`
--

INSERT INTO `tv_series_person` (`id`, `tv_series_id`, `person_id`, `created_at`, `updated_at`) VALUES
(1, 5, 191, NULL, NULL),
(2, 5, 192, NULL, NULL),
(3, 5, 129, NULL, NULL),
(4, 5, 193, NULL, NULL),
(5, 5, 194, NULL, NULL),
(6, 5, 195, NULL, NULL),
(7, 5, 196, NULL, NULL),
(8, 5, 197, NULL, NULL),
(9, 5, 198, NULL, NULL),
(10, 5, 199, NULL, NULL),
(11, 5, 200, NULL, NULL),
(12, 5, 201, NULL, NULL),
(13, 5, 202, NULL, NULL),
(14, 5, 203, NULL, NULL),
(15, 5, 204, NULL, NULL),
(16, 5, 205, NULL, NULL),
(17, 5, 63, NULL, NULL),
(18, 5, 206, NULL, NULL),
(19, 5, 207, NULL, NULL),
(20, 5, 208, NULL, NULL),
(21, 1, 125, NULL, NULL),
(22, 1, 126, NULL, NULL),
(23, 1, 209, NULL, NULL),
(24, 1, 210, NULL, NULL),
(25, 1, 211, NULL, NULL),
(26, 1, 212, NULL, NULL),
(27, 1, 213, NULL, NULL),
(28, 1, 214, NULL, NULL),
(29, 1, 215, NULL, NULL),
(30, 1, 216, NULL, NULL),
(31, 2, 100, NULL, NULL),
(32, 2, 188, NULL, NULL),
(33, 2, 217, NULL, NULL),
(34, 2, 133, NULL, NULL),
(35, 2, 218, NULL, NULL),
(36, 2, 219, NULL, NULL),
(37, 2, 220, NULL, NULL),
(38, 2, 221, NULL, NULL),
(39, 2, 222, NULL, NULL),
(40, 2, 223, NULL, NULL),
(41, 2, 224, NULL, NULL),
(42, 2, 225, NULL, NULL),
(43, 2, 226, NULL, NULL),
(44, 2, 227, NULL, NULL),
(45, 2, 228, NULL, NULL),
(46, 2, 229, NULL, NULL),
(47, 2, 230, NULL, NULL),
(48, 2, 231, NULL, NULL),
(49, 2, 232, NULL, NULL),
(50, 3, 130, NULL, NULL),
(51, 3, 233, NULL, NULL),
(52, 3, 234, NULL, NULL),
(53, 3, 215, NULL, NULL),
(54, 3, 235, NULL, NULL),
(55, 3, 236, NULL, NULL),
(56, 3, 237, NULL, NULL),
(57, 3, 238, NULL, NULL),
(58, 3, 239, NULL, NULL),
(59, 3, 240, NULL, NULL),
(60, 3, 241, NULL, NULL),
(61, 3, 242, NULL, NULL),
(62, 3, 243, NULL, NULL),
(63, 3, 244, NULL, NULL),
(64, 3, 245, NULL, NULL),
(65, 3, 246, NULL, NULL),
(66, 3, 247, NULL, NULL),
(67, 3, 248, NULL, NULL),
(68, 3, 249, NULL, NULL),
(69, 2, 130, NULL, NULL),
(70, 2, 233, NULL, NULL),
(71, 2, 234, NULL, NULL),
(72, 2, 215, NULL, NULL),
(73, 2, 235, NULL, NULL),
(74, 2, 236, NULL, NULL),
(75, 2, 237, NULL, NULL),
(76, 2, 238, NULL, NULL),
(77, 2, 239, NULL, NULL),
(78, 2, 240, NULL, NULL),
(79, 2, 241, NULL, NULL),
(80, 2, 242, NULL, NULL),
(81, 2, 243, NULL, NULL),
(82, 2, 244, NULL, NULL),
(83, 2, 245, NULL, NULL),
(84, 2, 246, NULL, NULL),
(85, 2, 247, NULL, NULL),
(86, 2, 248, NULL, NULL),
(87, 2, 249, NULL, NULL),
(88, 7, 257, NULL, NULL),
(89, 7, 258, NULL, NULL),
(90, 7, 259, NULL, NULL),
(91, 7, 260, NULL, NULL),
(92, 7, 261, NULL, NULL),
(93, 7, 262, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tv_series_trailer`
--

CREATE TABLE `tv_series_trailer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tv_series_id` bigint(20) UNSIGNED NOT NULL,
  `trailer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tv_series_trailer`
--

INSERT INTO `tv_series_trailer` (`id`, `tv_series_id`, `trailer_id`, `created_at`, `updated_at`) VALUES
(2, 1, 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `username` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `birthday` date NOT NULL,
  `user_status` enum('active','inactive','banned') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role_id`, `username`, `first_name`, `last_name`, `email`, `country_id`, `password`, `gender`, `birthday`, `user_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'dobri', 'Dobri', 'Dobrev', 'dobri_dobrev@yahoo.com', 22, '$2y$10$RLJf7MvSkHRcbe/xinU/weht7vxMlEOEVnWrI18EMtKO6OP1tLYp.', 'male', '1988-02-28', 'active', '2024-10-18 16:09:46', '2024-11-11 15:24:20', NULL),
(2, 2, 'badgirl', 'Jessica', 'Simpson', 'jess@gmail.com', 12, '$2y$10$8t1yWYd2/t7sF8VhNUF6Hexcgb4L8s8b4jovbs3a7W819ujZhe7xO', 'female', '2000-10-22', 'active', '2024-10-10 12:59:20', '2024-10-19 13:43:14', NULL),
(3, 2, 'test', 'Testone', 'Doe', 'johndoe@yahoo.com', 1, '$2y$10$UN9vcx45z9X7IQuAPCc.DudQfUq/EgUrgOEONzrJSA9lRWLuYyCWa', 'male', '1964-01-28', 'active', '2024-10-19 10:45:06', '2024-11-07 13:33:27', NULL),
(4, 2, 'peppapig', 'Peppa', 'Pig', 'peppapig@yahoo.com', 2, '$2y$10$ZxsXO1aya/iX3S8mU1ufaOqWP7KquK7f/ITVDbAT7FJeSHOCVTTt6', 'female', '1964-01-28', 'active', '2024-10-19 10:46:59', '2024-10-19 11:11:37', NULL),
(5, 2, 'tinkywinky', 'John', 'Wick', 'johnwick@gmail.com', 120, '$2y$10$88AHRoZE6Q9UGemOdf1r1uGgYf6R0QHM6bR.eTd0v4129Q9VcsDsm', 'male', '1914-12-31', 'active', '2024-10-19 10:49:31', '2024-10-19 11:11:37', NULL),
(6, 2, 'lollypop', 'Lolita', 'Bridgeston', 'lolly_girl@gmail.com', 140, '$2y$10$SF4/epAKyENX5.L71WT7O.5269wSo00bBCYbSgliI65oND4jzDXGq', 'female', '2004-06-20', 'active', '2024-10-19 10:51:01', '2024-10-19 11:11:37', NULL),
(7, 2, 'popcorn', 'Giuseppe', 'Miller', 'gigi@gmail.com', 1, '$2y$10$FyDK3VwvSDMDTtMNTOIe0OPWEQccnwFNqiRhHssjlb.p8ASHw8ADm', 'male', '2000-07-20', 'active', '2024-10-19 10:52:12', '2024-10-19 11:11:37', NULL),
(8, 2, 'badboy', 'Andrea', 'Celli', 'andrew@gmail.com', 1, '$2y$10$inBx/xc8iFc1DI.JodxRKe5V67s1e3HZqZrxQTNCKx.88gQBCuzjK', 'male', '1900-05-10', 'active', '2024-10-19 10:53:18', '2024-10-19 11:11:38', NULL),
(10, 2, 'batosai', 'Kenshin', 'Hiroshima', 'samurai@gmail.com', 114, '$2y$10$qMdEG7LgHzD1imHcz77IoO8dco4s.19rLJitcvLjrLP2JLNi7Am6.', 'male', '1900-05-10', 'active', '2024-10-19 10:55:43', '2024-10-19 11:11:38', NULL),
(11, 2, 'transformers', 'Optimus', 'Prime', 'optimus@gmail.com', 20, '$2y$10$eyND.jbbwMEUHQ6w3FxBOugxQvkSR9D7Hdkx8QPPxdS.U.DUptI/y', 'male', '1200-05-10', 'active', '2024-10-19 11:19:46', '2024-10-19 11:19:46', NULL),
(12, 2, 'ninja', 'Bumble', 'Bee', 'bumble@gmail.com', 24, '$2y$10$J/p3exafX5uKflwLLpDhk.9XJBMwSyYaBl8wUw7X4W2PvlUXpUAG2', 'male', '1280-05-30', 'active', '2024-10-19 11:22:23', '2024-10-19 11:22:23', NULL),
(13, 2, 'postman', 'Bob', 'Laravel', 'postman@yahoo.com', 180, '$2y$10$2WzI8p8sRgR4e81pyCavC.nIUmfs3wkWTCRXnKdvZvJY/lRA.Y9KW', 'male', '1928-06-28', 'active', '2024-11-01 13:24:57', '2024-11-01 15:42:38', NULL),
(14, 2, 'laravel', 'Jan', 'Claude', 'booo@abv.bg', 22, '$2y$10$VxY7XjxghI/vowPwRZomMuZi0iuc18TldIAZVhtTWLEVtR6jftdYm', 'male', '1900-01-22', 'active', '2024-11-01 15:52:05', '2024-11-01 15:52:05', NULL),
(20, 2, 'developer', 'Billy', 'Johnson', 'billyjohnson78@yahoo.com', 234, '$2y$10$tLzYzUT/MWFCNN3lQbTg3.Gky7oVU1kdAJPVoDkkb5rycpJcOIxkG', 'male', '1978-06-28', 'active', '2024-11-11 13:39:13', '2024-11-11 13:58:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `video_files`
--

CREATE TABLE `video_files` (
  `video_file_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(255) NOT NULL,
  `format` varchar(255) NOT NULL,
  `resolution` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_files`
--

INSERT INTO `video_files` (`video_file_id`, `title`, `url`, `format`, `resolution`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Onward ', 'https://example.com/onward-movie.mp4', 'mp4', '1080p', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(2, 'Tenet', 'https://example.com/tenet-movie.mp4', 'mp4', '1080p', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(3, 'Bad Boys for Life', 'https://example.com/bad-boys-for-life-movie.mp4', 'mp4', '1080p', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(4, 'The Invisible Man', 'https://example.com/the-invisible-man-movie.mp4', 'mp4', '1080p', '2024-10-21 14:06:41', '2024-10-21 14:06:41', NULL),
(5, 'Onward ', 'https://example.com/onward-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(6, 'Tenet', 'https://example.com/tenet-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(7, 'Bad Boys for Life ', 'https://example.com/bad-boys-for-life-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(8, 'The Invisible Man', 'https://example.com/the-invisible-man-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(9, 'American Murder', 'https://example.com/american-murder-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(10, 'The Half of It', 'https://example.com/the-half-of-it-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(11, 'Greyhound Poster', 'https://example.com/greyhound-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(12, 'News of the World', 'https://example.com/news-of-the-world-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(13, 'The Witcher: Nightmare of the Wolf', 'https://example.com/the-witcher-nightmare-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(14, 'The Grudge ', 'https://example.com/the-grudge-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(15, 'Soul', 'https://example.com/soul-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(16, 'Wonder Woman 1984', 'https://example.com/wonder-woman-1984-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(17, 'Palm Springs', 'https://example.com/palm-springs-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(18, 'The Call of the Wild', 'https://example.com/the-call-of-the-wild-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(19, 'Extraction', 'https://example.com/extraction-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(20, 'The Trial of the Chicago 7', 'https://example.com/the-trial-of-the-chicago-7-movie.mp4', 'mp4', '1080p', '2024-10-21 14:11:57', '2024-10-21 14:11:57', NULL),
(21, 'Stranger Things Season 1', 'https://example.com/stranger-things-season1.mp4', 'mp4', '1080p', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(22, 'Stranger Things Season 2', 'https://example.com/stranger-things-season2.mp4', 'mp4', '1080p', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(23, 'Stranger Things Season 3', 'https://example.com/stranger-things-season3.mp4', 'mp4', '1080p', '2024-10-21 15:43:01', '2024-10-21 15:43:01', NULL),
(24, 'The Mandalorian Season 1', 'https://example.com/the-mandalorian-season1.mp4', 'mp4', '1080p', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(25, 'Breaking Bad Season 1', 'https://example.com/breaking-bad-season1.mp4', 'mp4', '1080p', '2024-10-21 16:01:24', '2024-10-21 16:01:24', NULL),
(75, 'Rambo', 'https://example.com/rambo.mp4', 'mp4', '720p', '2024-11-07 09:48:22', '2024-11-11 08:52:33', NULL),
(76, 'Expendables', 'https://example.com/expendables.mp4', 'mp4', '720p', '2024-11-07 09:48:57', '2024-11-11 08:54:21', NULL),
(77, 'Die Hard', 'https://example.com/die-hard.mp4', 'mp4', '720p', '2024-11-07 09:57:24', '2024-11-11 08:54:52', NULL),
(79, 'Rocky', 'https://example.com/rocky-video-file.mp4', 'mp4', '4k', '2024-11-11 07:51:41', '2024-11-11 07:51:41', NULL),
(80, 'Sakra', 'https://example.com/Sakra.mp4', 'mp4', '4k', '2024-11-11 12:07:06', '2024-11-11 12:07:06', NULL),
(81, 'Sakra', 'https://example.com/Sakra.mp4', 'mp4', '4k', '2024-11-11 14:14:12', '2024-11-11 14:14:12', NULL),
(82, 'Sakra', 'https://example.com/Sakra.mp4', 'mp4', '4k', '2024-11-11 14:15:39', '2024-11-11 14:15:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_name_index` (`name`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`credit_id`),
  ADD KEY `credits_user_id_foreign` (`user_id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`episode_id`),
  ADD UNIQUE KEY `episodes_slug_unique` (`slug`),
  ADD KEY `episodes_season_id_foreign` (`season_id`),
  ADD KEY `episodes_title_index` (`title`),
  ADD KEY `episodes_episode_number_index` (`episode_number`);

--
-- Indexes for table `episode_image`
--
ALTER TABLE `episode_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episode_image_episode_id_foreign` (`episode_id`),
  ADD KEY `episode_image_image_file_id_foreign` (`image_file_id`);

--
-- Indexes for table `episode_video_file`
--
ALTER TABLE `episode_video_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episode_video_file_episode_id_foreign` (`episode_id`),
  ADD KEY `episode_video_file_video_file_id_foreign` (`video_file_id`);

--
-- Indexes for table `image_files`
--
ALTER TABLE `image_files`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD UNIQUE KEY `movies_slug_unique` (`slug`),
  ADD KEY `movies_category_id_foreign` (`category_id`),
  ADD KEY `movies_title_index` (`title`),
  ADD KEY `movies_year_index` (`year`),
  ADD KEY `movies_imdb_rating_index` (`imdb_rating`);

--
-- Indexes for table `movie_image`
--
ALTER TABLE `movie_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_image_movie_id_foreign` (`movie_id`),
  ADD KEY `movie_image_image_file_id_foreign` (`image_file_id`);

--
-- Indexes for table `movie_person`
--
ALTER TABLE `movie_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_person_movie_id_foreign` (`movie_id`),
  ADD KEY `movie_person_person_id_foreign` (`person_id`);

--
-- Indexes for table `movie_trailer`
--
ALTER TABLE `movie_trailer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_trailer_movie_id_foreign` (`movie_id`),
  ADD KEY `movie_trailer_trailer_id_foreign` (`trailer_id`);

--
-- Indexes for table `movie_video_file`
--
ALTER TABLE `movie_video_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_video_file_movie_id_foreign` (`movie_id`),
  ADD KEY `movie_video_file_video_file_id_foreign` (`video_file_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `permissions_permission_name_index` (`permission_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`),
  ADD KEY `persons_name_index` (`name`);

--
-- Indexes for table `person_image`
--
ALTER TABLE `person_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_image_person_id_foreign` (`person_id`),
  ADD KEY `person_image_image_file_id_foreign` (`image_file_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `roles_role_name_index` (`role_name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`season_id`),
  ADD KEY `seasons_tv_series_id_foreign` (`tv_series_id`),
  ADD KEY `seasons_year_index` (`year`);

--
-- Indexes for table `season_image`
--
ALTER TABLE `season_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `season_image_season_id_foreign` (`season_id`),
  ADD KEY `season_image_image_file_id_foreign` (`image_file_id`);

--
-- Indexes for table `season_trailer`
--
ALTER TABLE `season_trailer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `season_trailer_season_id_foreign` (`season_id`),
  ADD KEY `season_trailer_trailer_id_foreign` (`trailer_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `trailers`
--
ALTER TABLE `trailers`
  ADD PRIMARY KEY (`trailer_id`);

--
-- Indexes for table `tv_series`
--
ALTER TABLE `tv_series`
  ADD PRIMARY KEY (`tv_series_id`),
  ADD UNIQUE KEY `tv_series_slug_unique` (`slug`),
  ADD KEY `tv_series_category_id_foreign` (`category_id`),
  ADD KEY `tv_series_title_index` (`title`),
  ADD KEY `tv_series_year_index` (`year`),
  ADD KEY `tv_series_imdb_rating_index` (`imdb_rating`);

--
-- Indexes for table `tv_series_image`
--
ALTER TABLE `tv_series_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tv_series_image_tv_series_id_foreign` (`tv_series_id`),
  ADD KEY `tv_series_image_image_file_id_foreign` (`image_file_id`);

--
-- Indexes for table `tv_series_person`
--
ALTER TABLE `tv_series_person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tv_series_person_tv_series_id_foreign` (`tv_series_id`),
  ADD KEY `tv_series_person_person_id_foreign` (`person_id`);

--
-- Indexes for table `tv_series_trailer`
--
ALTER TABLE `tv_series_trailer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tv_series_trailer_tv_series_id_foreign` (`tv_series_id`),
  ADD KEY `tv_series_trailer_trailer_id_foreign` (`trailer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `video_files`
--
ALTER TABLE `video_files`
  ADD PRIMARY KEY (`video_file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `credit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `episode_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `episode_image`
--
ALTER TABLE `episode_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episode_video_file`
--
ALTER TABLE `episode_video_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_files`
--
ALTER TABLE `image_files`
  MODIFY `image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `movie_image`
--
ALTER TABLE `movie_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `movie_person`
--
ALTER TABLE `movie_person`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `movie_trailer`
--
ALTER TABLE `movie_trailer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `movie_video_file`
--
ALTER TABLE `movie_video_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `person_image`
--
ALTER TABLE `person_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `season_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `season_image`
--
ALTER TABLE `season_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `season_trailer`
--
ALTER TABLE `season_trailer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `trailers`
--
ALTER TABLE `trailers`
  MODIFY `trailer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tv_series`
--
ALTER TABLE `tv_series`
  MODIFY `tv_series_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tv_series_image`
--
ALTER TABLE `tv_series_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tv_series_person`
--
ALTER TABLE `tv_series_person`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tv_series_trailer`
--
ALTER TABLE `tv_series_trailer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `video_files`
--
ALTER TABLE `video_files`
  MODIFY `video_file_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credits`
--
ALTER TABLE `credits`
  ADD CONSTRAINT `credits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`season_id`) ON DELETE CASCADE;

--
-- Constraints for table `episode_image`
--
ALTER TABLE `episode_image`
  ADD CONSTRAINT `episode_image_episode_id_foreign` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`episode_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `episode_image_image_file_id_foreign` FOREIGN KEY (`image_file_id`) REFERENCES `image_files` (`image_id`) ON DELETE CASCADE;

--
-- Constraints for table `episode_video_file`
--
ALTER TABLE `episode_video_file`
  ADD CONSTRAINT `episode_video_file_episode_id_foreign` FOREIGN KEY (`episode_id`) REFERENCES `episodes` (`episode_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `episode_video_file_video_file_id_foreign` FOREIGN KEY (`video_file_id`) REFERENCES `video_files` (`video_file_id`) ON DELETE CASCADE;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `movie_image`
--
ALTER TABLE `movie_image`
  ADD CONSTRAINT `movie_image_image_file_id_foreign` FOREIGN KEY (`image_file_id`) REFERENCES `image_files` (`image_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_image_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;

--
-- Constraints for table `movie_person`
--
ALTER TABLE `movie_person`
  ADD CONSTRAINT `movie_person_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_person_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `movie_trailer`
--
ALTER TABLE `movie_trailer`
  ADD CONSTRAINT `movie_trailer_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_trailer_trailer_id_foreign` FOREIGN KEY (`trailer_id`) REFERENCES `trailers` (`trailer_id`) ON DELETE CASCADE;

--
-- Constraints for table `movie_video_file`
--
ALTER TABLE `movie_video_file`
  ADD CONSTRAINT `movie_video_file_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_video_file_video_file_id_foreign` FOREIGN KEY (`video_file_id`) REFERENCES `video_files` (`video_file_id`) ON DELETE CASCADE;

--
-- Constraints for table `person_image`
--
ALTER TABLE `person_image`
  ADD CONSTRAINT `person_image_image_file_id_foreign` FOREIGN KEY (`image_file_id`) REFERENCES `image_files` (`image_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `person_image_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`),
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_tv_series_id_foreign` FOREIGN KEY (`tv_series_id`) REFERENCES `tv_series` (`tv_series_id`) ON DELETE CASCADE;

--
-- Constraints for table `season_image`
--
ALTER TABLE `season_image`
  ADD CONSTRAINT `season_image_image_file_id_foreign` FOREIGN KEY (`image_file_id`) REFERENCES `image_files` (`image_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `season_image_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`season_id`) ON DELETE CASCADE;

--
-- Constraints for table `season_trailer`
--
ALTER TABLE `season_trailer`
  ADD CONSTRAINT `season_trailer_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`season_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `season_trailer_trailer_id_foreign` FOREIGN KEY (`trailer_id`) REFERENCES `trailers` (`trailer_id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `tv_series`
--
ALTER TABLE `tv_series`
  ADD CONSTRAINT `tv_series_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `tv_series_image`
--
ALTER TABLE `tv_series_image`
  ADD CONSTRAINT `tv_series_image_image_file_id_foreign` FOREIGN KEY (`image_file_id`) REFERENCES `image_files` (`image_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tv_series_image_tv_series_id_foreign` FOREIGN KEY (`tv_series_id`) REFERENCES `tv_series` (`tv_series_id`) ON DELETE CASCADE;

--
-- Constraints for table `tv_series_person`
--
ALTER TABLE `tv_series_person`
  ADD CONSTRAINT `tv_series_person_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tv_series_person_tv_series_id_foreign` FOREIGN KEY (`tv_series_id`) REFERENCES `tv_series` (`tv_series_id`) ON DELETE CASCADE;

--
-- Constraints for table `tv_series_trailer`
--
ALTER TABLE `tv_series_trailer`
  ADD CONSTRAINT `tv_series_trailer_trailer_id_foreign` FOREIGN KEY (`trailer_id`) REFERENCES `trailers` (`trailer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tv_series_trailer_tv_series_id_foreign` FOREIGN KEY (`tv_series_id`) REFERENCES `tv_series` (`tv_series_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
