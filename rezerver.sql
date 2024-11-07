-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 07. lis 2024, 08:35
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `rezerver`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` datetime NOT NULL,
  `author` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `created_date`, `author`) VALUES
(5, 's', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec vitae arcu. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Phasellus rhoncus. Aliquam ornare wisi eu metus. Fusce suscipit libero eget elit. Cras elementum. Nunc tincidunt ante vitae massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean fermentum risus id tortor. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Morbi leo mi, nonummy eget tristique non, rhoncus non leo. Aenean fermentum risus id tortor. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim.', '2024-11-04 00:00:00', 'kajfosz'),
(6, 'new', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec vitae arcu. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Phasellus rhoncus. Aliquam ornare wisi eu metus. Fusce suscipit libero eget elit. Cras elementum. Nunc tincidunt ante vitae massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean fermentum risus id tortor. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Morbi leo mi, nonummy eget tristique non, rhoncus non leo. Aenean fermentum risus id tortor. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim.', '2024-11-04 00:00:00', 'new'),
(7, 'new', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec vitae arcu. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Phasellus rhoncus. Aliquam ornare wisi eu metus. Fusce suscipit libero eget elit. Cras elementum. Nunc tincidunt ante vitae massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean fermentum risus id tortor. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Morbi leo mi, nonummy eget tristique non, rhoncus non leo. Aenean fermentum risus id tortor. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim.', '2024-11-04 00:00:00', 'new');

-- --------------------------------------------------------

--
-- Struktura tabulky `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contacts_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `timeslot_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = Pending, 1 = Confirmed, 2 = Canceled',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `number` int(11) NOT NULL,
  `note` varchar(1024) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `number`, `note`, `created_date`) VALUES
(1, 'daw', 'matejkajfosz@gmail.com', 212312, '124', '0000-00-00 00:00:00'),
(2, 's', 's@s', 123, '213', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `price` int(11) NOT NULL,
  `cut_time` int(11) NOT NULL COMMENT 'Duration of the service in minutes',
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `timeslot`
--

CREATE TABLE `timeslot` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Available, 0 = Not Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `is_admin`, `email`, `phone`, `created_date`) VALUES
(1, 'root', '$2y$10$YXyDiuH7h35J475LgtFPjO2BN0a7pErIbwG8cRKfEUtk9PG8kLU32', 1, 'matejkajfosz@gmail.com', '', '2024-10-21 20:12:53'),
(5, 'daw', '$2y$10$RHrbogSvOEKaplU/V8chGe6E43gVluzDMMLyXYC4mVcbNg4JdTd22', 0, 'ea@seznam.cz', '', '2024-10-21 20:33:13'),
(6, 'zabijak', '$2y$10$OIrcBF5u6FX3BZXtrvBQE.jUBGAOMttdK6Wxf1N3bI7zGhVWdwInS', 0, 'post@post.cz', '', '2024-11-04 20:16:34');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `timeslot_id` (`timeslot_id`),
  ADD KEY `contacts_id` (`contacts_id`);

--
-- Indexy pro tabulku `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`contacts_id`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `booking_service_fk` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_timeslot_fk` FOREIGN KEY (`timeslot_id`) REFERENCES `timeslot` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
