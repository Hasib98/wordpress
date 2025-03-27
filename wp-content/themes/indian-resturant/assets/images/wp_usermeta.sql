-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 10:58 AM
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
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'root'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', ''),
(15, 1, 'show_welcome_panel', '1'),
(16, 1, 'session_tokens', 'a:5:{s:64:\"b9f4273f13448a7b91abda7b9954b946ea87154307df1f35f3e996c04b9efe97\";a:4:{s:10:\"expiration\";i:1743090978;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36\";s:5:\"login\";i:1742918178;}s:64:\"a23ee7297560479a239cfba70a9f691f82b1678e7806360e2a436f1cdab82166\";a:4:{s:10:\"expiration\";i:1743154964;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36\";s:5:\"login\";i:1742982164;}s:64:\"894a46ab342036672272dcf0c364908f0a90a058e1db3f3bb7851753f26eef38\";a:4:{s:10:\"expiration\";i:1743232532;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36\";s:5:\"login\";i:1743059732;}s:64:\"6cd1ad967366fb1d1e2a91e3264b57aa231de081863bf13d509d36abfcf45778\";a:4:{s:10:\"expiration\";i:1743239703;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36\";s:5:\"login\";i:1743066903;}s:64:\"0791f22e9a7ccf3c1fd7eb0e47cd8442e1e243930c2df18d333da91d55520745\";a:4:{s:10:\"expiration\";i:1743242220;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:111:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36\";s:5:\"login\";i:1743069420;}}'),
(17, 1, 'wp_user-settings', 'libraryContent=browse&editor=html'),
(18, 1, 'wp_user-settings-time', '1741952682'),
(19, 1, 'wp_dashboard_quick_press_last_post_id', '259'),
(20, 1, 'manageedit-acf-post-typecolumnshidden', 'a:1:{i:0;s:7:\"acf-key\";}'),
(21, 1, 'acf_user_settings', 'a:3:{s:19:\"post-type-first-run\";b:1;s:20:\"taxonomies-first-run\";b:1;s:23:\"options-pages-first-run\";b:1;}'),
(22, 1, 'closedpostboxes_acf-post-type', 'a:0:{}'),
(23, 1, 'metaboxhidden_acf-post-type', 'a:1:{i:0;s:7:\"slugdiv\";}'),
(24, 1, 'manageedit-acf-taxonomycolumnshidden', 'a:1:{i:0;s:7:\"acf-key\";}'),
(25, 1, 'closedpostboxes_acf-field-group', 'a:0:{}'),
(26, 1, 'metaboxhidden_acf-field-group', 'a:1:{i:0;s:7:\"slugdiv\";}'),
(27, 1, 'manageedit-acf-ui-options-pagecolumnshidden', 'a:1:{i:0;s:7:\"acf-key\";}'),
(28, 1, 'closedpostboxes_acf-ui-options-page', 'a:0:{}'),
(29, 1, 'metaboxhidden_acf-ui-options-page', 'a:2:{i:0;s:21:\"acf-advanced-settings\";i:1;s:7:\"slugdiv\";}'),
(30, 1, 'closedpostboxes_acf-taxonomy', 'a:0:{}'),
(31, 1, 'metaboxhidden_acf-taxonomy', 'a:2:{i:0;s:21:\"acf-advanced-settings\";i:1;s:7:\"slugdiv\";}'),
(32, 1, 'meta-box-order_acf-field-group', 'a:3:{s:4:\"side\";s:0:\"\";s:6:\"normal\";s:54:\"acf-field-group-fields,acf-field-group-options,slugdiv\";s:8:\"advanced\";s:0:\"\";}'),
(33, 1, 'screen_layout_acf-field-group', '1'),
(34, 1, 'closedpostboxes_page', 'a:0:{}'),
(35, 1, 'metaboxhidden_page', 'a:5:{i:0;s:12:\"revisionsdiv\";i:1;s:16:\"commentstatusdiv\";i:2;s:11:\"commentsdiv\";i:3;s:7:\"slugdiv\";i:4;s:9:\"authordiv\";}'),
(76, 1, 'my_login_otp', '123'),
(77, 1, 'custom_login_otp', '12'),
(78, 1, 'custom_login_otp_expiry', '1743069715');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
