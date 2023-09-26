-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Sze 26. 21:01
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `mozaik`
--
CREATE DATABASE IF NOT EXISTS `mozaik` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mozaik`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `competition`
--

CREATE TABLE `competition` (
  `name` varchar(200) NOT NULL,
  `year` year(4) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `competition`
--

INSERT INTO `competition` (`name`, `year`, `location`) VALUES
('Summer Olympics Games', '2016', 'London'),
('Summer Olympics Games', '2021', 'Tokio');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `competitor`
--

CREATE TABLE `competitor` (
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `round_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_09_20_080635_create_user', 1),
(3, '2023_09_26_110533_create_competition_table', 1),
(4, '2023_09_26_110550_create_round_table', 1),
(5, '2023_09_26_110552_create_competitor_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `round`
--

CREATE TABLE `round` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `competition_name` varchar(200) NOT NULL,
  `competition_year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `round`
--

INSERT INTO `round` (`id`, `name`, `location`, `date`, `competition_name`, `competition_year`) VALUES
(1, 'Archery', 'National Stadium', '2021-06-28', 'Summer Olympics Games', '2021');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`name`, `email`, `age`) VALUES
('Alice Johnson', 'alice.johnson@example.com', 25),
('Balogh Roland', 'balogh.roland@gmail.com', 22),
('Bob Brown', 'bob.brown@example.com', 35),
('Eva Williams', 'eva.williams@example.com', 29),
('Jane Smith', 'jane.smith@example.com', 28),
('John Doe', 'john.doe@example.com', 30);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`name`,`year`);

--
-- A tábla indexei `competitor`
--
ALTER TABLE `competitor`
  ADD PRIMARY KEY (`name`,`email`),
  ADD KEY `competitor_round_id_foreign` (`round_id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `round`
--
ALTER TABLE `round`
  ADD PRIMARY KEY (`id`),
  ADD KEY `round_competition_name_competition_year_foreign` (`competition_name`,`competition_year`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`name`,`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `round`
--
ALTER TABLE `round`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `competitor`
--
ALTER TABLE `competitor`
  ADD CONSTRAINT `competitor_round_id_foreign` FOREIGN KEY (`round_id`) REFERENCES `round` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `round`
--
ALTER TABLE `round`
  ADD CONSTRAINT `round_competition_name_competition_year_foreign` FOREIGN KEY (`competition_name`,`competition_year`) REFERENCES `competition` (`name`, `year`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
