-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 08 2023 г., 12:34
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sola`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attachmentable`
--

CREATE TABLE `attachmentable` (
  `id` int(10) UNSIGNED NOT NULL,
  `attachmentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachmentable_id` int(10) UNSIGNED NOT NULL,
  `attachment_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attachmentable`
--

INSERT INTO `attachmentable` (`id`, `attachmentable_type`, `attachmentable_id`, `attachment_id`) VALUES
(1, 'App\\Models\\User', 5, 2),
(2, 'App\\Models\\User', 6, 3),
(3, 'App\\Models\\User', 4, 5),
(4, 'App\\Models\\User', 4, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `hash` text COLLATE utf8mb4_unicode_ci,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attachments`
--

INSERT INTO `attachments` (`id`, `name`, `original_name`, `mime`, `extension`, `size`, `sort`, `path`, `description`, `alt`, `hash`, `disk`, `user_id`, `group`, `created_at`, `updated_at`) VALUES
(1, '4dea90379e36f88a39ba70e71b70beec1d4a8af9', 'Danaaaaa.txt', 'text/plain', 'txt', 2893, 0, '2023/07/08/', NULL, NULL, 'a4e91adfc0a688846a1e02eb9482204162fe6e43', 'local', 1, NULL, '2023-07-08 06:50:39', '2023-07-08 06:50:39'),
(2, '4dea90379e36f88a39ba70e71b70beec1d4a8af9', 'Danaaaaa.txt', 'text/plain', 'txt', 2893, 0, '2023/07/08/', NULL, NULL, 'a4e91adfc0a688846a1e02eb9482204162fe6e43', 'local', 1, NULL, '2023-07-08 06:51:59', '2023-07-08 06:51:59'),
(3, '4dea90379e36f88a39ba70e71b70beec1d4a8af9', 'Danaaaaa.txt', 'text/plain', 'txt', 2893, 0, '2023/07/08/', NULL, NULL, 'a4e91adfc0a688846a1e02eb9482204162fe6e43', 'local', 1, NULL, '2023-07-08 06:52:53', '2023-07-08 06:52:53'),
(4, '4dea90379e36f88a39ba70e71b70beec1d4a8af9', 'Danaaaaa.txt', 'text/plain', 'txt', 2893, 0, '2023/07/08/', NULL, NULL, 'a4e91adfc0a688846a1e02eb9482204162fe6e43', 'local', 1, NULL, '2023-07-08 12:16:05', '2023-07-08 12:16:05'),
(5, '4dea90379e36f88a39ba70e71b70beec1d4a8af9', 'Danaaaaa.txt', 'text/plain', 'txt', 2893, 0, '2023/07/08/', NULL, NULL, 'a4e91adfc0a688846a1e02eb9482204162fe6e43', 'local', 1, NULL, '2023-07-08 12:16:24', '2023-07-08 12:16:24'),
(6, '4dea90379e36f88a39ba70e71b70beec1d4a8af9', 'Danaaaaa.txt', 'text/plain', 'txt', 2893, 0, '2023/07/08/', NULL, NULL, 'a4e91adfc0a688846a1e02eb9482204162fe6e43', 'local', 1, NULL, '2023-07-08 12:16:56', '2023-07-08 12:16:56');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `city_id`, `city_name`, `city_area`, `city_country`, `created_at`, `updated_at`) VALUES
(1, 1, 'Алматы', NULL, 'Казахстан', NULL, NULL),
(2, 2, 'Астана', NULL, 'Казахстан', NULL, NULL),
(3, 3, 'Шымкент', NULL, 'Казахстан', NULL, NULL),
(4, 4, 'Караганды', NULL, 'Казахстан', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `contragents`
--

CREATE TABLE `contragents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `histories`
--

CREATE TABLE `histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `overhead_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `history_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_show` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `histories`
--

INSERT INTO `histories` (`id`, `status_id`, `overhead_id`, `user_id`, `history_name`, `is_show`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Новая заявка', 1, '2023-07-08 06:38:40', '2023-07-08 06:38:40'),
(2, 2, 1, 1, 'В обработке', 1, '2023-07-08 06:38:44', '2023-07-08 06:38:44'),
(3, 3, 1, 1, 'Заявка обработан', 1, '2023-07-08 06:40:18', '2023-07-08 06:40:18'),
(4, 4, 1, 1, 'Назначен на водителя', 1, '2023-07-08 07:34:50', '2023-07-08 07:34:50'),
(5, 6, 1, 9, 'Заявку забрал', 1, '2023-07-08 07:54:47', '2023-07-08 07:54:47'),
(6, 8, 1, 1, 'Обработан складом', 1, '2023-07-08 08:11:27', '2023-07-08 08:11:27'),
(7, 9, 1, 1, 'На доставке', 1, '2023-07-08 08:13:22', '2023-07-08 08:13:22'),
(8, 2, 1, 1, 'В обработке', 1, '2023-07-08 11:52:19', '2023-07-08 11:52:19');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(33, '2015_04_12_000000_create_orchid_users_table', 1),
(34, '2015_10_19_214424_create_orchid_roles_table', 1),
(35, '2015_10_19_214425_create_orchid_role_users_table', 1),
(36, '2016_08_07_125128_create_orchid_attachmentstable_table', 1),
(37, '2017_09_17_125801_create_notifications_table', 1),
(38, '2019_08_19_000000_create_failed_jobs_table', 1),
(39, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(40, '2023_06_17_043429_create_overheads_table', 1),
(41, '2023_06_17_043435_create_cities_table', 1),
(42, '2023_06_17_043441_create_histories_table', 1),
(43, '2023_06_17_043446_create_statuses_table', 1),
(44, '2023_06_18_164050_create_drivers_table', 1),
(45, '2023_06_18_164258_create_transports_table', 1),
(46, '2023_06_18_212501_create_registries_table', 1),
(47, '2023_07_08_073114_create_contragents_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `overheads`
--

CREATE TABLE `overheads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overhead_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_city` int(11) DEFAULT '1',
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_city` int(11) DEFAULT '1',
  `to_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo_details` text COLLATE utf8mb4_unicode_ci,
  `counterparty` int(11) DEFAULT NULL,
  `company_type` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_package` int(11) DEFAULT NULL,
  `need_movers` int(11) DEFAULT NULL,
  `mass` double(8,2) DEFAULT '0.00',
  `volume` double(8,2) DEFAULT '0.00',
  `width` double(8,2) DEFAULT '0.00',
  `height` double(8,2) DEFAULT '0.00',
  `length` double(8,2) DEFAULT '0.00',
  `price` double(8,2) DEFAULT '0.00',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `last_status` int(11) DEFAULT NULL,
  `driver` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `registry_id` int(11) DEFAULT NULL,
  `order_start_date` timestamp NULL DEFAULT NULL,
  `order_end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `overheads`
--

INSERT INTO `overheads` (`id`, `order_code`, `overhead_code`, `from_city`, `from_name`, `from_company`, `from_address`, `from_phone`, `to_city`, `to_name`, `to_company`, `to_address`, `to_phone`, `cargo_details`, `counterparty`, `company_type`, `user_id`, `is_package`, `need_movers`, `mass`, `volume`, `width`, `height`, `length`, `price`, `comment`, `description`, `last_status`, `driver`, `transport_id`, `registry_id`, `order_start_date`, `order_end_date`, `created_at`, `updated_at`) VALUES
(1, 'KZKZ100000', '100000', 2, 'Almaty Woman Shop.', 'TOO Testov', 'фывфыв', '87073729565', 1, 'фывфыв', 'фывфыв', 'Южный Городок 30/41 кв', '87785595731', NULL, 4, 1, 1, 1, 2, 3.00, 264.00, 22.00, 4.00, 3.00, 0.00, 'фыв', 'фывasdasd', 2, 9, 1, 1, '2023-07-08 06:38:40', NULL, '2023-07-08 06:38:40', '2023-07-08 11:52:19');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `registries`
--

CREATE TABLE `registries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `registries`
--

INSERT INTO `registries` (`id`, `from_city`, `to_city`, `user_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, '1', '3', 1, 14, '2023-07-08 08:13:22', '2023-07-08 08:13:22');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'operator', 'Оператор', '{\"platform.index\": \"1\", \"platform.store\": \"0\", \"platform.super\": \"0\", \"platform.track\": \"0\", \"platform.driver\": \"0\", \"platform.logistic\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}', '2023-07-08 12:22:56', '2023-07-08 12:22:56'),
(2, 'manager', 'Менеджер Логист', '{\"platform.index\": \"1\", \"platform.store\": \"0\", \"platform.super\": \"0\", \"platform.track\": \"1\", \"platform.driver\": \"0\", \"platform.logistic\": \"0\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}', '2023-07-08 12:23:11', '2023-07-08 12:23:11'),
(3, 'store', 'Склад', '{\"platform.index\": \"1\", \"platform.store\": \"1\", \"platform.super\": \"0\", \"platform.track\": \"0\", \"platform.driver\": \"0\", \"platform.logistic\": \"0\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}', '2023-07-08 12:23:27', '2023-07-08 12:23:27'),
(4, 'driver', 'Водитель', '{\"platform.index\": \"1\", \"platform.store\": \"0\", \"platform.super\": \"0\", \"platform.track\": \"0\", \"platform.driver\": \"1\", \"platform.logistic\": \"0\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}', '2023-07-08 12:23:39', '2023-07-08 12:23:39'),
(5, 'super', 'Супер Администратор', '{\"platform.index\": \"1\", \"platform.store\": \"0\", \"platform.super\": \"1\", \"platform.track\": \"0\", \"platform.driver\": \"0\", \"platform.logistic\": \"0\", \"platform.systems.roles\": \"1\", \"platform.systems.users\": \"1\", \"platform.systems.attachment\": \"1\"}', '2023-07-08 12:24:03', '2023-07-08 12:24:03');

-- --------------------------------------------------------

--
-- Структура таблицы `role_users`
--

CREATE TABLE `role_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`) VALUES
(11, 1),
(10, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `status_name`, `status_code`, `created_at`, `updated_at`) VALUES
(1, 'Новая заявка', NULL, NULL, NULL),
(2, 'В обработке', NULL, NULL, NULL),
(3, 'Обработан', NULL, NULL, NULL),
(4, 'Назначен на водителя', NULL, NULL, NULL),
(5, 'Водитель принял заявку', NULL, NULL, NULL),
(6, 'Водитель забрал', NULL, NULL, NULL),
(7, 'Прибыл в центр', NULL, NULL, NULL),
(8, 'Обработан складом', NULL, NULL, NULL),
(9, 'На доставке', NULL, NULL, NULL),
(10, 'Переадресован', NULL, NULL, NULL),
(11, 'Доставлен', NULL, NULL, NULL),
(12, 'Отменен', NULL, NULL, NULL),
(13, 'Обновлен', NULL, NULL, NULL),
(14, 'Реестр создан', NULL, NULL, NULL),
(15, 'Реестр в обработке', NULL, NULL, NULL),
(16, 'Реестр обработан', NULL, NULL, NULL),
(17, 'Новая заявка', NULL, NULL, NULL),
(18, 'В обработке', NULL, NULL, NULL),
(19, 'Обработан', NULL, NULL, NULL),
(20, 'Назначен на водителя', NULL, NULL, NULL),
(21, 'Водитель принял заявку', NULL, NULL, NULL),
(22, 'Водитель забрал', NULL, NULL, NULL),
(23, 'Прибыл в центр', NULL, NULL, NULL),
(24, 'Обработан складом', NULL, NULL, NULL),
(25, 'На доставке', NULL, NULL, NULL),
(26, 'Переадресован', NULL, NULL, NULL),
(27, 'Доставлен', NULL, NULL, NULL),
(28, 'Отменен', NULL, NULL, NULL),
(29, 'Обновлен', NULL, NULL, NULL),
(30, 'Реестр создан', NULL, NULL, NULL),
(31, 'Реестр в обработке', NULL, NULL, NULL),
(32, 'Реестр обработан', NULL, NULL, NULL),
(33, 'Новая заявка', NULL, NULL, NULL),
(34, 'В обработке', NULL, NULL, NULL),
(35, 'Обработан', NULL, NULL, NULL),
(36, 'Назначен на водителя', NULL, NULL, NULL),
(37, 'Водитель принял заявку', NULL, NULL, NULL),
(38, 'Водитель забрал', NULL, NULL, NULL),
(39, 'Прибыл в центр', NULL, NULL, NULL),
(40, 'Обработан складом', NULL, NULL, NULL),
(41, 'На доставке', NULL, NULL, NULL),
(42, 'Переадресован', NULL, NULL, NULL),
(43, 'Доставлен', NULL, NULL, NULL),
(44, 'Отменен', NULL, NULL, NULL),
(45, 'Обновлен', NULL, NULL, NULL),
(46, 'Реестр создан', NULL, NULL, NULL),
(47, 'Реестр в обработке', NULL, NULL, NULL),
(48, 'Реестр обработан', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `transports`
--

CREATE TABLE `transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transport_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transports`
--

INSERT INTO `transports` (`id`, `user_id`, `transport_name`, `transport_code`, `transport_type`, `created_at`, `updated_at`) VALUES
(1, NULL, 'До 500кг(Малый)', NULL, NULL, NULL, NULL),
(2, NULL, 'До 2.5тн(Средний)', NULL, NULL, NULL, NULL),
(3, NULL, 'До 5тн', NULL, NULL, NULL, NULL),
(4, NULL, 'До 10тн', NULL, NULL, NULL, NULL),
(5, NULL, 'Фура', NULL, NULL, NULL, NULL),
(6, NULL, 'Спец техника', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_real_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `visible_password`, `from_company`, `from_city`, `from_phone`, `from_address`, `from_site`, `type`, `company_type`, `iin`, `payment_type`, `company_name`, `company_address`, `company_real_address`, `bin`, `bik`, `payment_card`, `bank_name`, `director_name`, `phone`, `remember_token`, `created_at`, `updated_at`, `permissions`) VALUES
(1, 'admin', NULL, 'admin@admin.com', NULL, '$2y$10$hVXrJAJa8rWTZkBLIjZr6OGC4OAc5EO0TwqRMVi269BDEpGDYvStG', NULL, NULL, '1', NULL, NULL, NULL, 'superadmin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9zPpwW4gDpiXjGw7LvMDYcERhgd80ogomjg5wR7GcP6eGS9WPHUNBX52wfh3', '2023-07-08 04:39:16', '2023-07-08 12:26:21', '{\"platform.index\": \"1\", \"platform.store\": \"0\", \"platform.super\": \"0\", \"platform.track\": \"0\", \"platform.driver\": \"0\", \"platform.logistic\": \"0\", \"platform.systems.roles\": \"1\", \"platform.systems.users\": \"1\", \"platform.systems.attachment\": \"1\"}'),
(2, 'hello Moto', 'фывфывфыв', 'nurzhanduisenbaev500@gmail.com', NULL, '$2y$10$aMJRJn4J2f0a0MPMFXceoO9IPfi1cPXVGDbCH8Iv6ni27FRZz6QLq', NULL, NULL, '1', NULL, NULL, NULL, 'driver', NULL, NULL, NULL, 'hello Moto', 'Южный Городок 30/41 кв', 'Южный Городок 30/41 кв', '123fgh', '123rty', 'asdfgh', 'kaspi', 'nureke', '87785595731', NULL, '2023-07-08 06:34:22', '2023-07-08 12:10:12', '[]'),
(4, 'TOO AlexMan', 'asdasdsa', 'nurzhanduisenbaev460@gmail.com', NULL, '$2y$10$gMhD1AasDcXsdq1Poalzcu1xjkkgeDUlSfk6KqIMx/Na3EPztaiJq', NULL, 'sadasd', '1', 'asdasd', 'sadasd', NULL, 'counterparty', NULL, NULL, NULL, 'TOO AlexMan', 'Южный Городок 30/41 кв', 'Южный Городок 30/41 кв', '123fgh', '123rty', 'asdfgh', 'kaspi', 'nureke', '87785595731', NULL, '2023-07-08 06:36:27', '2023-07-08 12:13:09', '[]'),
(5, 'Nurzhan Duisenbaev', 'asdasdasd', 'nurzhanduisenbaev@cabes.com', NULL, '$2y$10$zFGcWrkdSTl1zM5IPqtPJ.rEhvlLLqVtS2NzKVW5J0LT.hBxCmu7i', NULL, NULL, '1', NULL, NULL, NULL, 'driver', NULL, '080814655046', 'Карта', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-08 06:52:01', '2023-07-08 12:11:41', '[]'),
(6, 'hello ffff', 'фывфыв', 'helloffff@cabes.com', NULL, '$2y$10$xvZQj3GtddA3hYZ0FLR16ulAUUtCfJ3S.EgwSblQMTEz0SxdzqXqq', NULL, NULL, '1', NULL, NULL, NULL, 'driver', NULL, NULL, NULL, 'hello ffff', 'Южный Городок 30/41 кв', 'Южный Городок 30/41 кв', '123fgh', '123rty', 'asdfgh', NULL, NULL, '87785595731', NULL, '2023-07-08 06:53:08', '2023-07-08 12:09:54', '[]'),
(7, 'admin@admin.com', NULL, 'nurzhanduisenbaev480@gmail.com', NULL, '$2y$10$NdEzz4hmsAy2o0zOFh.YiuUbc2S3riXH09L7HdB54VJRvvh08cxCy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-08 07:24:35', '2023-07-08 07:24:35', '{\"platform.index\": \"0\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"0\"}'),
(8, 'driver', NULL, 'driver@admin.com', NULL, '$2y$10$v7HnbtyflMSShCt0UGx9Tue7HUTUGRd1Ky0lLOmLAesV2hiommmYu', NULL, NULL, NULL, NULL, NULL, NULL, 'driver', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-08 07:26:01', '2023-07-08 07:26:01', '{\"platform.index\": \"0\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(9, 'driver2', NULL, 'driver2@admin.com', NULL, '$2y$10$wecGqM6DZeSc0Lrj6MmAdevYeJVsL4kgzfdsyAZl26Mo.l1k.KA/q', NULL, NULL, NULL, NULL, NULL, NULL, 'driver', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9x2U8xqCrCjb1Hhyz5A5vw1o1HzDaElKj7vaZGHl5pbQgAO8JB3aA7PskAlC', '2023-07-08 07:27:43', '2023-07-08 07:27:43', '{\"platform.index\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(10, 'driver3', 'driver3', 'driver3@mail.com', NULL, '$2y$10$bGXnEJ80GPZjHlH3qhkPjeHz1Ng44aIJPgwPNdkUejXrfKmZn17d2', NULL, NULL, '3', NULL, NULL, NULL, 'driver', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-08 07:34:19', '2023-07-08 12:24:15', '{\"platform.index\": \"1\", \"platform.store\": \"0\", \"platform.super\": \"0\", \"platform.track\": \"0\", \"platform.driver\": \"1\", \"platform.logistic\": \"0\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(11, 'manager1', 'manager1', 'manager1@mail.com', NULL, '$2y$10$G.S9Ifk4x0DsatTxDHaeFODMffOovMnzhbIWHv54QozUX6jHJnYbi', NULL, 'manager1', '1', '87785595731', 'Южный Городок 30/41 кв', NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NVwKuvYui5IccqRoURILkbnbT0FG2IUtQKRTlOYi1Og1Z8rBFFzxwsRwzo2N', '2023-07-08 12:28:54', '2023-07-08 12:28:54', '{\"platform.index\": \"1\", \"platform.store\": \"0\", \"platform.super\": \"0\", \"platform.track\": \"0\", \"platform.driver\": \"0\", \"platform.logistic\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachmentable_attachmentable_type_attachmentable_id_index` (`attachmentable_type`,`attachmentable_id`),
  ADD KEY `attachmentable_attachment_id_foreign` (`attachment_id`);

--
-- Индексы таблицы `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contragents`
--
ALTER TABLE `contragents`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Индексы таблицы `overheads`
--
ALTER TABLE `overheads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `overheads_order_code_unique` (`order_code`),
  ADD UNIQUE KEY `overheads_overhead_code_unique` (`overhead_code`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `registries`
--
ALTER TABLE `registries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Индексы таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `contragents`
--
ALTER TABLE `contragents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `overheads`
--
ALTER TABLE `overheads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `registries`
--
ALTER TABLE `registries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  ADD CONSTRAINT `attachmentable_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
