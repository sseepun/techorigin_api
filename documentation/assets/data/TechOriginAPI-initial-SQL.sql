-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2021 at 09:45 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_logs`
--

CREATE TABLE `action_logs` (
  `id` int(13) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `target_user_id` int(11) DEFAULT NULL,
  `action` varchar(32) NOT NULL,
  `url` varchar(256) DEFAULT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-09-26-074402', 'App\\Database\\Migrations\\UserRoles', 'default', 'App', 1612254848, 1),
(2, '2020-09-26-080753', 'App\\Database\\Migrations\\Users', 'default', 'App', 1612254848, 1),
(3, '2020-10-13-055315', 'App\\Database\\Migrations\\UserTemp', 'default', 'App', 1612254848, 1),
(4, '2020-11-07-114125', 'App\\Database\\Migrations\\UserDetails', 'default', 'App', 1612254848, 1),
(5, '2020-11-13-163123', 'App\\Database\\Migrations\\Modules', 'default', 'App', 1612254848, 1),
(6, '2020-11-13-172951', 'App\\Database\\Migrations\\ModulePermissions', 'default', 'App', 1612254848, 1),
(7, '2020-12-28-062850', 'App\\Database\\Migrations\\ActionLogs', 'default', 'App', 1612254849, 1),
(8, '2020-12-28-080752', 'App\\Database\\Migrations\\TrafficLogs', 'default', 'App', 1612254849, 1),
(9, '2021-01-13-124001', 'App\\Database\\Migrations\\UserTypes', 'default', 'App', 1612254849, 1),
(10, '2021-01-23-163442', 'App\\Database\\Migrations\\UserCustomColumns', 'default', 'App', 1612254849, 1),
(11, '2021-01-23-172056', 'App\\Database\\Migrations\\UserCustomDetails', 'default', 'App', 1612254849, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(64) NOT NULL,
  `order` int(2) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `code`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Content Management System', 'cms', 0, 1, '2021-02-02 00:34:12', '2021-02-02 00:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `module_permissions`
--

CREATE TABLE `module_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(5) UNSIGNED DEFAULT NULL,
  `role_id` int(5) UNSIGNED DEFAULT NULL,
  `create` int(1) NOT NULL DEFAULT 0,
  `read` int(1) NOT NULL DEFAULT 0,
  `update` int(1) NOT NULL DEFAULT 0,
  `delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `traffic_logs`
--

CREATE TABLE `traffic_logs` (
  `id` int(13) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `role_id` int(5) UNSIGNED DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(512) NOT NULL,
  `is_password_set` int(1) NOT NULL DEFAULT 1,
  `profile` varchar(256) DEFAULT NULL,
  `thai_id` varchar(256) DEFAULT NULL,
  `thai_id_path` varchar(256) DEFAULT NULL,
  `code` varchar(64) DEFAULT NULL,
  `facebook_id` varchar(48) DEFAULT NULL,
  `google_id` varchar(48) DEFAULT NULL,
  `last_ip` varchar(32) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `firstname`, `lastname`, `email`, `password`, `is_password_set`, `profile`, `thai_id`, `thai_id_path`, `code`, `facebook_id`, `google_id`, `last_ip`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'SuperAdmin', 'Super', 'Admin', 'sarun.seepun@gmail.com', '$2y$10$PkYq/kmaU7C9hsvv9JzkM.YWgQjqy6nS4CZftDgxkAqMHz.htxZaG', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(2, 2, 'Admin', 'General', 'Admin', 'sarun_sla@hotmail.com', '$2y$10$6kPKVVzUbfJ...HBOAewye6msxsVOxbMa52EGbui.T1S4HB9mPKMi', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-02-02 00:34:12', '2021-02-02 00:34:12'),
(3, 3, 'Member', 'General', 'Member', 'a@a.com', '$2y$10$QKRX9zi1lEpeTMtftNqFKuEDD0ohW2p2S.H1GZV/e65MpWoCtPJje', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-02-02 00:34:12', '2021-02-02 00:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_custom_columns`
--

CREATE TABLE `user_custom_columns` (
  `id` int(4) UNSIGNED NOT NULL,
  `column_id` int(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_custom_details`
--

CREATE TABLE `user_custom_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `column_1` varchar(256) DEFAULT NULL,
  `column_2` varchar(256) DEFAULT NULL,
  `column_3` varchar(256) DEFAULT NULL,
  `column_4` varchar(256) DEFAULT NULL,
  `column_5` varchar(256) DEFAULT NULL,
  `column_6` varchar(256) DEFAULT NULL,
  `column_7` varchar(256) DEFAULT NULL,
  `column_8` varchar(256) DEFAULT NULL,
  `column_9` varchar(256) DEFAULT NULL,
  `column_10` varchar(256) DEFAULT NULL,
  `column_11` varchar(256) DEFAULT NULL,
  `column_12` varchar(256) DEFAULT NULL,
  `column_13` varchar(256) DEFAULT NULL,
  `column_14` varchar(256) DEFAULT NULL,
  `column_15` varchar(256) DEFAULT NULL,
  `column_16` varchar(256) DEFAULT NULL,
  `column_17` varchar(256) DEFAULT NULL,
  `column_18` varchar(256) DEFAULT NULL,
  `column_19` varchar(256) DEFAULT NULL,
  `column_20` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `user_type_id` int(5) UNSIGNED DEFAULT NULL,
  `user_subtype_id` int(5) UNSIGNED DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `company` varchar(256) DEFAULT NULL,
  `company_address` varchar(512) DEFAULT NULL,
  `company_phone` varchar(64) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT 0,
  `is_super_admin` int(1) NOT NULL DEFAULT 0,
  `is_default` int(1) NOT NULL DEFAULT 0,
  `order` int(2) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `is_admin`, `is_super_admin`, `is_default`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 0, 1, 0, 99, 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(2, 'Admin', 1, 0, 0, 98, 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(3, 'Member', 0, 0, 1, 0, 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(4, 'Employee', 0, 0, 0, 1, 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(5, 'HR', 0, 0, 0, 2, 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_temp`
--

CREATE TABLE `user_temp` (
  `id` int(13) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `action` varchar(128) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `is_used` int(1) NOT NULL DEFAULT 0,
  `ip` varchar(32) DEFAULT NULL,
  `used_ip` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(5) UNSIGNED NOT NULL,
  `parent_id` int(5) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `parent_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'นักเรียนระดับประถมต้น', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(2, 1, 'ประถมศึกษาปีที่ 1', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(3, 1, 'ประถมศึกษาปีที่ 2', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(4, 1, 'ประถมศึกษาปีที่ 3', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(5, NULL, 'นักเรียนระดับประถมปลาย', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(6, 5, 'ประถมศึกษาปีที่ 4', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(7, 5, 'ประถมศึกษาปีที่ 5', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(8, 5, 'ประถมศึกษาปีที่ 6', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(9, NULL, 'นักเรียนระดับมัธยมต้น', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(10, 9, 'มัธยมศึกษาปีที่ 1', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(11, 9, 'มัธยมศึกษาปีที่ 2', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(12, 9, 'มัธยมศึกษาปีที่ 3', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(13, NULL, 'นักเรียนระดับมัธยมปลาย', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(14, 13, 'มัธยมศึกษาปีที่ 4', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(15, 13, 'มัธยมศึกษาปีที่ 5', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(16, 13, 'มัธยมศึกษาปีที่ 6', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(17, NULL, 'นักเรียนระดับปริญญาตรี', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(18, NULL, 'นักเรียนระดับปริญญาโท', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(19, NULL, 'นักเรียนระดับปริญญาเอก', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(20, NULL, 'คุณครู', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11'),
(21, NULL, 'อาจารย์มหาวิทยาลัย', 1, '2021-02-02 00:34:11', '2021-02-02 00:34:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_permissions_module_id_foreign` (`module_id`),
  ADD KEY `module_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `traffic_logs`
--
ALTER TABLE `traffic_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `traffic_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_custom_columns`
--
ALTER TABLE `user_custom_columns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_custom_details`
--
ALTER TABLE `user_custom_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `user_details_user_type_id_foreign` (`user_type_id`),
  ADD KEY `user_details_user_subtype_id_foreign` (`user_subtype_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_temp`
--
ALTER TABLE `user_temp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salt` (`salt`),
  ADD KEY `user_temp_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `id` int(13) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module_permissions`
--
ALTER TABLE `module_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `traffic_logs`
--
ALTER TABLE `traffic_logs`
  MODIFY `id` int(13) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_custom_columns`
--
ALTER TABLE `user_custom_columns`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_custom_details`
--
ALTER TABLE `user_custom_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_temp`
--
ALTER TABLE `user_temp`
  MODIFY `id` int(13) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD CONSTRAINT `action_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD CONSTRAINT `module_permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `module_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `traffic_logs`
--
ALTER TABLE `traffic_logs`
  ADD CONSTRAINT `traffic_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `user_custom_details`
--
ALTER TABLE `user_custom_details`
  ADD CONSTRAINT `user_custom_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_details_user_subtype_id_foreign` FOREIGN KEY (`user_subtype_id`) REFERENCES `user_types` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_details_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `user_temp`
--
ALTER TABLE `user_temp`
  ADD CONSTRAINT `user_temp_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
