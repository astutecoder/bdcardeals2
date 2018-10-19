
-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `album_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cars_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `album_name`, `folder_name`, `cars_id`, `created_at`, `updated_at`) VALUES
(14, 'AUDI v8 2015', 'audi_v8_2015', 12, '2018-10-18 06:24:57', '2018-10-18 06:24:57'),
(15, 'BMW abc 2015', 'bmw_abc_2015', 11, '2018-10-18 06:37:02', '2018-10-18 06:37:02'),
(18, 'BMW sonata 2018', 'bmw_sonata_2018', 9, '2018-10-18 06:53:51', '2018-10-18 06:53:51'),
(19, 'BMW rav4 2018', 'bmw_rav4_2018', 8, '2018-10-18 06:54:25', '2018-10-18 06:54:25'),
(20, 'BMW no model 2010', 'bmw_no model_2010', 6, '2018-10-18 06:56:01', '2018-10-18 06:56:01'),
(21, 'HONDA civic 2018', 'honda_civic_2018', 10, '2018-10-18 07:02:24', '2018-10-18 07:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `body_types`
--

CREATE TABLE `body_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `body_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `body_types`
--

INSERT INTO `body_types` (`id`, `body_type`, `created_at`, `updated_at`) VALUES
(1, 'sedan', '2018-10-02 10:28:23', '2018-10-02 10:28:23'),
(2, 'jeep', '2018-10-08 12:44:56', '2018-10-08 12:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 'bmw', '2018-10-02 10:28:16', '2018-10-02 10:28:16'),
(2, 'honda', '2018-10-08 12:44:51', '2018-10-08 12:44:51'),
(4, 'audi', '2018-10-16 09:48:52', '2018-10-16 09:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'eg: 5.7L V8',
  `transmission` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'eg: AUTO 8-SPEED',
  `mileage` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'eg: 20,300MI',
  `doors` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'eg: 4/5',
  `features` text COLLATE utf8mb4_unicode_ci,
  `safety` text COLLATE utf8mb4_unicode_ci,
  `comfort` text COLLATE utf8mb4_unicode_ci,
  `price` int(11) NOT NULL,
  `offer_price` int(11) DEFAULT NULL,
  `is_negotiable_price` int(11) NOT NULL DEFAULT '0' COMMENT '1=yes, 0=no',
  `is_featured` int(11) NOT NULL DEFAULT '0' COMMENT '1=yes, 0=no',
  `brands_id` int(10) UNSIGNED NOT NULL,
  `body_types_id` int(10) UNSIGNED NOT NULL,
  `source_id` int(10) UNSIGNED NOT NULL,
  `car_condition` enum('used','recondition','new') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `save_complete` int(11) NOT NULL DEFAULT '0' COMMENT '1=yes, 0=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `title`, `subtitle`, `model_no`, `year`, `engine`, `transmission`, `mileage`, `doors`, `features`, `safety`, `comfort`, `price`, `offer_price`, `is_negotiable_price`, `is_featured`, `brands_id`, `body_types_id`, `source_id`, `car_condition`, `save_complete`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, NULL, 'This is a subtitle example', 'vezel', '2017', '4.9L', 'Semi Automatic', '10000mi', NULL, NULL, NULL, NULL, 360000, NULL, 1, 1, 2, 2, 1, 'new', 0, '2018-10-08 12:45:37', '2018-10-12 09:58:22', NULL),
(6, NULL, NULL, 'no model', '2010', '5.4L', 'Automatic', '36000mi', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 1500000, 1499999, 0, 0, 1, 1, 1, 'new', 0, '2018-10-09 21:05:00', '2018-10-13 12:38:48', NULL),
(8, NULL, NULL, 'rav4', '2018', '6.1L', 'Semi Automatic', '36589mi', '4', NULL, NULL, NULL, 5899999, 5599999, 1, 1, 1, 2, 1, 'new', 0, '2018-10-14 09:21:51', '2018-10-14 14:47:32', NULL),
(9, NULL, NULL, 'sonata', '2018', '6.3L', 'Semi Auto', '45112mi', '5', NULL, NULL, NULL, 7895660, NULL, 1, 1, 1, 1, 1, 'used', 0, '2018-10-14 10:48:35', '2018-10-14 10:48:35', NULL),
(10, NULL, NULL, 'civic', '2018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 456897, NULL, 0, 0, 2, 2, 1, 'recondition', 0, '2018-10-14 11:18:44', '2018-10-14 11:20:03', NULL),
(11, NULL, NULL, 'abc', '2015', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 452134, NULL, 1, 0, 1, 2, 1, 'used', 0, '2018-10-14 14:18:46', '2018-10-14 14:18:46', NULL),
(12, NULL, NULL, 'v8', '2015', 'asdf', 'asdf', 'asdf', NULL, NULL, NULL, NULL, 4450000, NULL, 1, 1, 4, 1, 1, 'new', 0, '2018-10-16 09:49:26', '2018-10-18 18:45:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cars_colors`
--

CREATE TABLE `cars_colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `cars_id` int(10) UNSIGNED NOT NULL,
  `colors_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars_colors`
--

INSERT INTO `cars_colors` (`id`, `cars_id`, `colors_id`, `created_at`, `updated_at`) VALUES
(16, 5, 2, '2018-10-12 09:58:22', '2018-10-12 09:58:22'),
(24, 6, 1, '2018-10-13 14:41:50', '2018-10-13 14:41:50'),
(25, 6, 2, '2018-10-13 14:41:50', '2018-10-13 14:41:50'),
(28, 9, 1, '2018-10-14 10:48:35', '2018-10-14 10:48:35'),
(29, 9, 2, '2018-10-14 10:48:35', '2018-10-14 10:48:35'),
(30, 9, 3, '2018-10-14 10:48:35', '2018-10-14 10:48:35'),
(34, 10, 1, '2018-10-14 11:20:03', '2018-10-14 11:20:03'),
(35, 11, 2, '2018-10-14 14:18:46', '2018-10-14 14:18:46'),
(36, 8, 1, '2018-10-14 14:47:32', '2018-10-14 14:47:32'),
(37, 8, 3, '2018-10-14 14:47:32', '2018-10-14 14:47:32'),
(44, 12, 1, '2018-10-18 18:45:41', '2018-10-18 18:45:41'),
(45, 12, 2, '2018-10-18 18:45:41', '2018-10-18 18:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `cars_fuel_types`
--

CREATE TABLE `cars_fuel_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `cars_id` int(10) UNSIGNED NOT NULL,
  `fuel_types_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars_fuel_types`
--

INSERT INTO `cars_fuel_types` (`id`, `cars_id`, `fuel_types_id`, `created_at`, `updated_at`) VALUES
(5, 5, 2, '2018-10-08 12:45:37', '2018-10-08 12:45:37'),
(6, 6, 2, '2018-10-09 21:05:00', '2018-10-09 21:05:00'),
(8, 8, 1, '2018-10-14 09:21:51', '2018-10-14 09:21:51'),
(9, 9, 3, '2018-10-14 10:48:35', '2018-10-14 10:48:35'),
(10, 10, 3, '2018-10-14 11:18:44', '2018-10-14 11:18:44'),
(11, 11, 1, '2018-10-14 14:18:46', '2018-10-14 14:18:46'),
(12, 12, 3, '2018-10-16 09:49:26', '2018-10-16 09:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `created_at`, `updated_at`) VALUES
(1, 'blue', '2018-10-02 10:28:35', '2018-10-02 10:28:35'),
(2, 'pearl white', '2018-10-08 12:45:14', '2018-10-08 12:45:14'),
(3, 'red', '2018-10-14 09:19:06', '2018-10-14 09:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

CREATE TABLE `fuel_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`id`, `fuel_type`, `created_at`, `updated_at`) VALUES
(1, 'hybrid', '2018-10-02 10:28:30', '2018-10-02 10:28:30'),
(2, 'disel', '2018-10-08 12:45:04', '2018-10-08 12:45:04'),
(3, 'OCTEN', '2018-10-14 10:47:36', '2018-10-18 06:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_20_163107_create_sources_table', 1),
(4, '2018_09_21_154000_create_brands_table', 1),
(5, '2018_09_21_154001_create_body_types_table', 1),
(6, '2018_09_21_154100_create_cars_table', 1),
(7, '2018_09_22_041454_create_colors_table', 1),
(8, '2018_09_22_041536_create_fuel_types_table', 1),
(9, '2018_09_22_041701_create_cars_colors_table', 1),
(10, '2018_09_22_041724_create_cars_fuel_types_table', 1),
(11, '2018_10_01_093416_create_albums_table', 1),
(12, '2018_10_01_163930_create_photos_table', 1),
(13, '2018_10_04_120123_update_users_table', 2),
(15, '2018_10_09_225833_update_cars_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('azad.webdev@gmail.com', '$2y$10$dEu9xgGwsov81kIEV6EaBeDnRWQPGXxsK9xBgzPeFDhBxQA9m0P7G', '2018-10-17 10:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` int(11) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `cars_id` int(10) UNSIGNED NOT NULL,
  `album_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `file_name`, `is_featured`, `cars_id`, `album_id`, `created_at`, `updated_at`) VALUES
(81, 'download (3)_1539807897.jpeg', 0, 12, 14, '2018-10-18 06:24:57', '2018-10-18 06:29:42'),
(82, 'download_1539807897.jpeg', 0, 12, 14, '2018-10-18 06:24:57', '2018-10-18 06:30:13'),
(83, 'images_1539807897.jpeg', 1, 12, 14, '2018-10-18 06:24:57', '2018-10-18 06:30:13'),
(85, 'download (1)_1539808622.jpeg', 0, 11, 15, '2018-10-18 06:37:02', '2018-10-18 06:37:02'),
(86, 'download (2)_1539808622.jpeg', 1, 11, 15, '2018-10-18 06:37:02', '2018-10-19 03:51:19'),
(87, 'download (3)_1539808622.jpeg', 0, 11, 15, '2018-10-18 06:37:02', '2018-10-18 06:37:02'),
(88, 'download_1539808622.jpeg', 0, 11, 15, '2018-10-18 06:37:02', '2018-10-19 03:51:19'),
(89, 'images_1539808622.jpeg', 0, 11, 15, '2018-10-18 06:37:02', '2018-10-18 06:37:02'),
(100, 'download (3)_1539809631.jpeg', 0, 9, 18, '2018-10-18 06:53:51', '2018-10-18 06:53:51'),
(101, 'download_1539809631.jpeg', 1, 9, 18, '2018-10-18 06:53:51', '2018-10-18 06:53:51'),
(102, 'images_1539809631.jpeg', 0, 9, 18, '2018-10-18 06:53:51', '2018-10-18 06:53:51'),
(103, 'download (1)_1539809665.jpeg', 1, 8, 19, '2018-10-18 06:54:25', '2018-10-18 06:54:25'),
(104, 'download (2)_1539809665.jpeg', 0, 8, 19, '2018-10-18 06:54:25', '2018-10-18 06:54:25'),
(105, 'download (3)_1539809665.jpeg', 0, 8, 19, '2018-10-18 06:54:25', '2018-10-18 06:54:25'),
(106, 'download (2)_1539809761.jpeg', 0, 6, 20, '2018-10-18 06:56:01', '2018-10-18 06:56:01'),
(107, 'download (3)_1539809761.jpeg', 0, 6, 20, '2018-10-18 06:56:01', '2018-10-18 06:56:01'),
(108, 'download_1539809761.jpeg', 1, 6, 20, '2018-10-18 06:56:01', '2018-10-18 06:56:01'),
(112, 'download (3)_1539810144.jpeg', 1, 10, 21, '2018-10-18 07:02:24', '2018-10-18 07:02:24'),
(113, 'download_1539810144.jpeg', 0, 10, 21, '2018-10-18 07:02:24', '2018-10-18 07:02:24'),
(114, 'images_1539810144.jpeg', 0, 10, 21, '2018-10-18 07:02:24', '2018-10-18 07:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE `sources` (
  `id` int(10) UNSIGNED NOT NULL,
  `source_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `source_name`, `source_code`, `contact`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, NULL, 'abc123', '01750413177', NULL, NULL, '2018-10-02 10:27:59', '2018-10-02 10:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Astute Coder', 'azad.webdev@gmail.com', NULL, '$2y$10$nHN7kA2hWJsMhk2s9AimHeAXYDYbwhckXj9gh1sEDd5MpYiwvk9Li', 'sRtJFj0ZQiAX6mvwqVZL4VvAodnfmhMCa8aobAE4yvkmxuIXBZh8g2ABUwtH', '03ArWRckJh22ltDgRl6tPdjSpRDMeQHC9pozMWJOay2VwG6Wa3qeQyPPcqCN', '2018-10-04 10:04:49', '2018-10-04 10:04:49'),
(2, 'Mr. Bari', 'badhontrading@gmail.com', NULL, '$2y$10$2GOyQQlFmQQ6/4oDk4Ya3.yCL8k8549rWfIFZh/SyAHP2stNlEkpe', NULL, 'HKhsZcULGjZv3z3CDadjujnjouJOBLV0y8jjA62wDsTAS6I4TCdUZPwGklYS', '2018-10-05 13:40:51', '2018-10-05 13:40:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_cars_id_foreign` (`cars_id`);

--
-- Indexes for table `body_types`
--
ALTER TABLE `body_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cars_brands_id_foreign` (`brands_id`),
  ADD KEY `cars_body_types_id_foreign` (`body_types_id`),
  ADD KEY `cars_source_id_foreign` (`source_id`);

--
-- Indexes for table `cars_colors`
--
ALTER TABLE `cars_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cars_colors_cars_id_foreign` (`cars_id`),
  ADD KEY `cars_colors_colors_id_foreign` (`colors_id`);

--
-- Indexes for table `cars_fuel_types`
--
ALTER TABLE `cars_fuel_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cars_fuel_types_cars_id_foreign` (`cars_id`),
  ADD KEY `cars_fuel_types_fuel_types_id_foreign` (`fuel_types_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_types`
--
ALTER TABLE `fuel_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_cars_id_foreign` (`cars_id`),
  ADD KEY `photos_album_id_foreign` (`album_id`);

--
-- Indexes for table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `body_types`
--
ALTER TABLE `body_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cars_colors`
--
ALTER TABLE `cars_colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cars_fuel_types`
--
ALTER TABLE `cars_fuel_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fuel_types`
--
ALTER TABLE `fuel_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_cars_id_foreign` FOREIGN KEY (`cars_id`) REFERENCES `cars` (`id`);

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_body_types_id_foreign` FOREIGN KEY (`body_types_id`) REFERENCES `body_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cars_brands_id_foreign` FOREIGN KEY (`brands_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cars_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `sources` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cars_colors`
--
ALTER TABLE `cars_colors`
  ADD CONSTRAINT `cars_colors_cars_id_foreign` FOREIGN KEY (`cars_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `cars_colors_colors_id_foreign` FOREIGN KEY (`colors_id`) REFERENCES `colors` (`id`);

--
-- Constraints for table `cars_fuel_types`
--
ALTER TABLE `cars_fuel_types`
  ADD CONSTRAINT `cars_fuel_types_cars_id_foreign` FOREIGN KEY (`cars_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `cars_fuel_types_fuel_types_id_foreign` FOREIGN KEY (`fuel_types_id`) REFERENCES `fuel_types` (`id`);

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `photos_cars_id_foreign` FOREIGN KEY (`cars_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
