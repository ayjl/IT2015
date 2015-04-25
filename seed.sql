-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2015 at 09:49 AM
-- Server version: 5.5.42-cll
-- PHP Version: 5.5.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asocunsw_built`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_02_27_092946_create_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stock_number` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `available` tinyint(1) NOT NULL,
  `brian` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `geoffrey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ming` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `neil` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vansh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `stock_number`, `available`, `brian`, `geoffrey`, `ming`, `neil`, `vansh`, `created_at`, `updated_at`) VALUES
(1, 'Jaybird Bluebuds XA', '- Breakthrough exclusive technology doubles JayBird BlueBud X playtime to a solid 8 hours, offering a full week of workouts, or a full day of listening.\r\n- SignalPlus for skip-free music outdoors. Use your music device left/right side, above/below waist, doesn?t matter with SignalPlus.\r\n- Shift Premium Bluetooth Audio. By writing our own version of Bluetooth SBC codec we have rewritten the rules about how Bluetooth should sound. Shift delivers clear precise audio similar to wired audio performance\r\n- PureSound In-ear white noise and listener fatigue reduction. Eliminates the white noise and delivers a clean audio experience offering hours of pure enjoyment.\r\n- Lifetime Warranty Against Sweat', 129.88, '/images/54f15ddae830f.jpg', 'B00AIRUOI8', 1, '', '', '', '', '', '2015-02-27 19:13:18', '2015-04-21 16:58:17'),
(2, 'Seiko 5 SNK809', '- Stainless steel watch featuring round black dial with date window, sword-shape hands, and exhibition case back\r\n- Precise 21-jewel automatic movement with analog display\r\n- Durable Hardlex mineral crystal dial window\r\n- Features include luminosity, sweeping second hand, canvas band, and a date window that can be formatted in English or Spanish', 58.82, '/images/54f15e023dfe1.jpg', 'B002SSUQFG', 1, '', '', '', '', '', '2015-02-27 19:19:46', '2015-02-27 19:19:46'),
(3, 'Bellroy Leather Card Sleeve Wallet', '- The Card Sleeve is the slimmest style in the Bellroy arsenal. It can be used as a business card holder, or even as a full-time wallet for those who have a black belt in slimming their pocket contents. The main section features a pull tab for easy storage of cards and money, while the outside pockets can be used for quick-access items.\r\n- Our Card Sleeve is the perfect second wallet that allows you to carry overflow cards alongside your everyday wallet. Keep it in your bag or desk drawer and access those cards when you need.\r\n- Handing over a business card should include a nice little ritual. The pull-tab supplies this, eliminating that awkward action where you dig deep and fumble around in an old wallet slot.\r\n- Lots of our friends transition to Card Sleeves when they step out in a suit. Its slimline profile slides neatly into your inside jacket pocket meaning no more bulging pants or broken silhouettes.\r\n- Backed by our three year warranty', 54.95, '/images/54f15e32328ee.jpg', 'B00D8MP642', 0, '', '', '', '', '', '2015-02-27 19:20:34', '2015-03-01 11:27:23'),
(4, 'Logitech Wireless Performance Mouse MX', '- New Logitech Darkfield Laser Tracking works on more surfaces than other mice--even on glass\r\n- Tiny Logitech Unifying receiver stays in your computer--plug it in, forget it, even add compatible wireless devices without multiple USB receivers\r\n- Flexible recharging system for easy charging through your computer or a power outlet, even when you''re using your mouse\r\n- Hyper-fast scrolling lets you fly through long documents and web pages\r\n- Sculpted right-handed shape with stealth thumb controls for rapid-fire web browsing, application switching, zooming and more', 62.00, '/images/54f15e45eb572.jpg', 'B002HWRJBM', 1, '', '', '', '', '', '2015-02-27 19:20:53', '2015-02-27 19:20:53'),
(5, 'Canon Powershot SX280', '- Built-in Wi-Fi technology allows you to wirelessly transfer your images to social networking sites through CANON iMAGE GATEWAY\r\n- Upload virtually anywhere on your iOS or Android device with free download of the Canon Camera Window app\r\n- Capture breathtaking 1080p full HD video capture at 60fps\r\n- 12.1 megapixel, 1/2.3-inch CMOS sensor and Canon DIGIC 6 image processor for improved low-light performance up to ISO 6400 and enhanced image quality\r\n- Powerful 20x optical zoom and 25mm wide-angle lens with Optical Image Stabilizer', 218.95, '/images/54f15e5cad7d1.jpg', 'B00BW6LTG0', 0, '', '', '', '', '', '2015-02-27 19:21:16', '2015-02-27 19:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Adrian', 'adrian@example.com', '$2y$10$.22hJtfmtofkeJPRCDT.zOXwFhY21szhRfU2oXeavnbQ96oInQ/Ai', 'NafTeUNu686EQF86xQ3zClQq4yQwNIuLiFbK9b9VXBvpEV0NxSvRUOdIszl6', '2015-02-27 18:36:03', '2015-02-28 22:06:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `products_stock_number_unique` (`stock_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
