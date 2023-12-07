-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Gru 2023, 18:01
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wypozyczalniasamochodow`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `availability` varchar(50) NOT NULL,
  `car_value` varchar(50) NOT NULL,
  `pricefor1day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `cars`
--

INSERT INTO `cars` (`car_id`, `brand`, `model`, `year`, `availability`, `car_value`, `pricefor1day`) VALUES
(1, 'Toyota', 'Corolla', 2022, 'Dostepne', 'niski', 200),
(2, 'Peugot', '2005', 2019, 'Niedostepny', 'sredni', 300),
(3, 'Ford', 'Mustang', 2020, 'Niedostepny', 'niski', 200),
(6, 'BMW', 'X5', 2021, 'Niedostepny', 'sredni', 300),
(7, 'Mercedes-Benz', 'C-Class', 2020, 'Niedostepny', 'wysoki', 500);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `price`
--

CREATE TABLE `price` (
  `ID` int(11) NOT NULL,
  `car_value` text NOT NULL,
  `pricefor1day` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `price`
--

INSERT INTO `price` (`ID`, `car_value`, `pricefor1day`) VALUES
(1, 'niski', 200),
(2, 'sredni', 300),
(3, 'wysoki', 500);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `rental_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `days_difference` int(11) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rentals`
--

INSERT INTO `rentals` (`rental_id`, `user_id`, `car_id`, `rental_date`, `return_date`, `days_difference`, `total_cost`) VALUES
(1, 1, 7, '2023-12-03', '2023-12-13', 10, 5000),
(2, 5, 2, '2023-12-03', '2024-03-11', 99, 29700),
(3, 1, 3, '2023-12-03', '2023-12-22', 19, 3800);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `user_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`) VALUES
(1, 'janek', '$2y$10$o5QMv5k0ncGa.TRD8/2P7ed8CVTpHrIUNhmHbNG4vvIMmj8FxrYkK', 'user'),
(2, 'admin', '$2y$10$9dVXQPyp2HV9vCFWVzMrZemiVhM44zdcRqMLu7dM.cKgmHUVPktSu', 'admin'),
(3, 'karol', '$2y$10$.VT.m9EWYgL.BhhppwevaO/PYm7FMycfeQ61UvHNBVTjw/wFiVd4S', 'user'),
(4, 'karol1', '$2y$10$8kFUmKTMCBNcoQDRyByxRONCZXyb.XZF6dnR.6azTSv3jkB3Kx0bi', 'user'),
(5, 'miki', '$2y$10$FPyEyFb8Kee/Ke8tazPzWuDtcee87ZoWaVVnk/Nkuiz5j2rCt8cKK', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indeksy dla tabeli `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`) USING HASH;

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `price`
--
ALTER TABLE `price`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
