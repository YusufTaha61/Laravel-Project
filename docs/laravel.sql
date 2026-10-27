-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Eki 2026, 14:40:39
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `laravel`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(22, 2, 2, 1, 120.00, '2026-06-17 12:37:29', '2026-06-17 12:37:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `keywords`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Sıcak Kahveler', NULL, NULL, NULL, 0, '2026-06-09 10:06:43', '2026-06-09 10:06:43'),
(2, 0, 'Soğuk Kahveler', NULL, NULL, NULL, 0, '2026-06-09 10:06:43', '2026-06-09 10:06:43');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_01_01_000000_create_categories_table', 1),
(6, '2026_05_23_220551_create_products_table', 1),
(7, '2026_06_04_003144_add_role_to_users_table', 1),
(8, '2026_06_08_103456_create_carts_table', 1),
(9, '2026_06_08_103503_create_orders_table', 1),
(10, '2026_06_08_103507_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_method` varchar(255) NOT NULL DEFAULT 'Free Shipping',
  `payment_method` varchar(255) NOT NULL DEFAULT 'Cash / Bank Transfer',
  `status` enum('New','Accepted','Cancelled','Onshipping','Completed') NOT NULL DEFAULT 'New',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `city`, `country`, `zip_code`, `subtotal`, `shipping_price`, `total`, `shipping_method`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, 'Ali Güntan', 'ali@test.com', '494', 'fdvfv', 'svsvs', 'Türkiye', '8484', 470.00, 0.00, 470.00, 'Free Shipping', 'Cash on Delivery', 'Accepted', '2026-06-09 18:18:58', '2026-06-09 18:21:34'),
(7, 2, 'Ali Güntan', 'ali@test.com', '6444', 'khkh', 'kjbkhb', 'Türkiye', '484', 220.00, 0.00, 220.00, 'Free Shipping', 'Cash on Delivery', 'Cancelled', '2026-06-09 18:19:46', '2026-06-09 18:21:43'),
(8, 2, 'Ali Güntan', 'ali@test.com', '5111', 'jbjkhb', 'hkhb', 'Türkiye', '499', 215.00, 0.00, 215.00, 'Free Shipping', 'Cash on Delivery', 'Onshipping', '2026-06-09 18:20:13', '2026-06-09 18:27:53'),
(9, 2, 'Ali Güntan', 'ali@test.com', '644', 'lnjjbjb', 'kjbkjb', 'Türkiye', '4848', 120.00, 0.00, 120.00, 'Free Shipping', 'Cash on Delivery', 'Completed', '2026-06-09 18:25:37', '2026-06-09 18:28:04'),
(10, 2, 'Ali Güntan', 'ali@test.com', '114', 'kjbkbhk', 'hvjvh', 'Türkiye', '4848', 250.00, 0.00, 250.00, 'Free Shipping', 'Cash on Delivery', 'Accepted', '2026-06-09 18:26:07', '2026-06-09 18:28:12'),
(11, 2, 'Ali Güntan', 'ali@test.com', '4548', 'kjbjkhb', 'jhjvjh', 'Türkiye', '848', 200.00, 0.00, 200.00, 'Free Shipping', 'Cash on Delivery', 'Cancelled', '2026-06-09 18:26:32', '2026-06-09 18:28:29'),
(12, 2, 'Ali Güntan', 'ali@test.com', '84848', 'kjjbkb', 'khjbkh', 'Türkiye', '4848', 345.00, 0.00, 345.00, 'Free Shipping', 'Cash on Delivery', 'Completed', '2026-06-09 18:27:01', '2026-06-09 18:28:56'),
(13, 2, 'Ali Güntan', 'ali@test.com', '8818', 'kjbkhb', 'jbjkhb', 'Türkiye', '448', 85.00, 0.00, 85.00, 'Free Shipping', 'Cash on Delivery', 'New', '2026-06-09 18:27:20', '2026-06-09 18:27:20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_title`, `price`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(7, 6, 2, 'Cold Brew', 120.00, 3, 360.00, '2026-06-09 18:18:58', '2026-06-09 18:18:58'),
(8, 6, 4, 'Iced Americano', 110.00, 1, 110.00, '2026-06-09 18:18:58', '2026-06-09 18:18:58'),
(9, 7, 6, 'Iced Latte', 110.00, 2, 220.00, '2026-06-09 18:19:46', '2026-06-09 18:19:46'),
(10, 8, 10, 'Lime Breeze', 85.00, 1, 85.00, '2026-06-09 18:20:13', '2026-06-09 18:20:13'),
(11, 8, 11, 'Sky', 130.00, 1, 130.00, '2026-06-09 18:20:13', '2026-06-09 18:20:13'),
(12, 9, 2, 'Cold Brew', 120.00, 1, 120.00, '2026-06-09 18:25:37', '2026-06-09 18:25:37'),
(13, 10, 12, 'Affogato', 125.00, 2, 250.00, '2026-06-09 18:26:07', '2026-06-09 18:26:07'),
(14, 11, 3, 'Caramel Macchiato', 110.00, 1, 110.00, '2026-06-09 18:26:32', '2026-06-09 18:26:32'),
(15, 11, 8, 'Turkish Coffee', 90.00, 1, 90.00, '2026-06-09 18:26:32', '2026-06-09 18:26:32'),
(16, 12, 7, 'Iced Mocha', 115.00, 3, 345.00, '2026-06-09 18:27:01', '2026-06-09 18:27:01'),
(17, 13, 10, 'Lime Breeze', 85.00, 1, 85.00, '2026-06-09 18:27:20', '2026-06-09 18:27:20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `minstock` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `category_id`, `user_id`, `title`, `keywords`, `description`, `detail`, `image`, `price`, `stock`, `minstock`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Filter Coffee', NULL, 'Özenle seçilmiş çekirdeklerden taze demlenmiş, yumuşak içimli filtre kahve.', NULL, '202606091309Filter_Coffee.webp', 85.00, 49, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 10:17:59'),
(2, 2, 1, 'Cold Brew', NULL, '16 saat boyunca soğuk suda demlenmiş, asiditesi düşük, yoğun ve pürüzsüz kahve deneyimi.', NULL, '202606091309Cold_Brew.webp', 120.00, 71, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:25:37'),
(3, 1, 1, 'Caramel Macchiato', NULL, 'Karamel şurubu, sıcak süt ve espressonun tatlı uyumu.', NULL, '202606091309Caramel_Macchiato.webp', 110.00, 69, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:26:32'),
(4, 2, 1, 'Iced Americano', NULL, 'Buzlu suyun üzerine eklenen taze espresso shotları ile ferahlatıcı, sert ve net bir tat.', NULL, '202606091309Iced_Americano.jpg', 110.00, 57, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:18:58'),
(5, 1, 1, 'Flat White', NULL, 'İnce köpüklü sıcak süt ve yoğun espressonun mükemmel dengesi.', NULL, '202606091310Flat_White.webp', 95.00, 44, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 10:17:32'),
(6, 2, 1, 'Iced Latte', NULL, 'Buz gibi taze süt ve yoğun espressonun ferahlatıcı buluşması.', NULL, '202606091310Iced_Latte.jpg', 110.00, 53, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:19:46'),
(7, 2, 1, 'Iced Mocha', NULL, 'Zengin çikolata sosu, espresso ve soğuk sütün enfes karışımı.', NULL, '202606091310Iced_Mocha.jpg', 115.00, 34, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:27:01'),
(8, 1, 1, 'Turkish Coffee', NULL, 'Geleneksel usullerle ağır ağır pişirilmiş bol köpüklü Türk kahvesi.', NULL, '202606091310Turkish_Coffee.webp', 90.00, 72, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:26:32'),
(9, 1, 1, 'Hot Chocolate', NULL, 'Gerçek çikolata parçacıkları ve buharla ısıtılmış sütün içinizi ısıtan kıvamı.', NULL, '202606091310Hot_Chocolate.jpg', 80.00, 60, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 10:10:47'),
(10, 2, 1, 'Lime Breeze', NULL, 'Taze misket limonu ve kahvenin şaşırtıcı derecede uyumlu, buz gibi ferahlatıcı lezzeti.', NULL, '202606091310Lime_Breeze.png', 85.00, 47, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:27:20'),
(11, 2, 1, 'Sky', NULL, 'Özel reçetemizle hazırlanan, görseli ve tadıyla sizi bulutların üzerine çıkaracak imza soğuk içeceğimiz.', NULL, '202606091311Sky.jpg', 130.00, 38, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:20:13'),
(12, 2, 1, 'Affogato', NULL, 'Bir top vanilyalı dondurma üzerine dökülen sıcak espresso ile tatlı ve kahve krizine son.', NULL, '202606091311Affogato.jpg', 125.00, 63, 0, 0, 1, '2026-06-09 10:06:43', '2026-06-09 18:26:07');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yusuf Taha Çebi', 'yusuf@test.com', NULL, '$2y$10$XuSOKxGoGrz.gs89LsJVI.W2d4Lf6RKl861Q/a6vqSjp4x8Z/vCNS', 'admin', NULL, '2026-06-09 10:06:43', '2026-06-09 10:06:43'),
(2, 'Ali Güntan', 'ali@test.com', NULL, '$2y$10$pgZtoyjAXOT0xPqR/0x1euDe0W/Jcn/0mZ.yC9ZsHd3j0Sc3qTr.q', 'user', NULL, '2026-06-09 10:16:09', '2026-06-09 18:13:12');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
