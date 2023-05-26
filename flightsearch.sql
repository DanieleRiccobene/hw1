-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 26, 2023 alle 16:20
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flightsearch`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bagagli`
--

CREATE TABLE `bagagli` (
  `utente` int(11) DEFAULT NULL,
  `prenotazione` int(11) DEFAULT NULL,
  `bagaglio_a_mano` int(11) DEFAULT NULL,
  `bagaglio_stiva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `bagagli`
--

INSERT INTO `bagagli` (`utente`, `prenotazione`, `bagaglio_a_mano`, `bagaglio_stiva`) VALUES
(3, 31, 2, 1),
(3, 33, 2, 1),
(4, 34, 2, 1),
(3, 35, 2, 0),
(3, 36, 2, 1),
(3, 37, 0, 1),
(3, 38, 2, 1),
(3, 40, 2, 0);

--
-- Trigger `bagagli`
--
DELIMITER $$
CREATE TRIGGER `update_prezzo_after_insert` AFTER INSERT ON `bagagli` FOR EACH ROW BEGIN
    DECLARE new_prezzo DECIMAL(10,2);
    DECLARE num1 INTEGER;
    DECLARE num2 INTEGER;
    SET num1 = (SELECT bagaglio_a_mano FROM bagagli WHERE prenotazione=NEW.prenotazione);
    SET num2 = (SELECT bagaglio_stiva FROM bagagli WHERE prenotazione=NEW.prenotazione);
    SET new_prezzo = (SELECT prezzo FROM prenotazione WHERE prenotazione = NEW.prenotazione);
    SET new_prezzo = new_prezzo + (num1*30) + (num2*15);
    
    UPDATE prenotazione SET prezzo = new_prezzo WHERE prenotazione = NEW.prenotazione;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `prenotazione` int(11) NOT NULL,
  `utente` int(11) DEFAULT NULL,
  `partenza` varchar(10) DEFAULT NULL,
  `destinazione` varchar(10) DEFAULT NULL,
  `dataPartenza` datetime DEFAULT NULL,
  `dataRitorno` datetime DEFAULT NULL,
  `passeggeri` int(11) DEFAULT NULL,
  `classe` varchar(50) DEFAULT NULL,
  `prezzo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`prenotazione`, `utente`, `partenza`, `destinazione`, `dataPartenza`, `dataRitorno`, `passeggeri`, `classe`, `prezzo`) VALUES
(31, 3, 'FCO', 'CTA', '2023-05-26 08:15:00', '2023-05-30 19:10:00', 3, 'ECONOMY', 263.28),
(33, 3, 'CTA', 'LIN', '2023-05-24 20:05:00', '2023-05-25 17:35:00', 1, 'ECONOMY', 162.98),
(34, 4, 'CTA', 'BLQ', '2023-05-24 20:45:00', '2023-05-30 06:30:00', 3, 'ECONOMY', 441.03),
(35, 3, 'FCO', 'LIN', '2023-05-26 10:00:00', '2023-05-30 11:00:00', 3, 'ECONOMY', 333.81),
(36, 3, 'CTA', 'BLQ', '2023-05-25 20:45:00', '2023-05-30 06:30:00', 4, 'ECONOMY', 663.04),
(37, 3, 'BLQ', 'FCO', '2023-05-26 06:30:00', '2023-05-30 13:20:00', 1, 'ECONOMY', 138.08),
(38, 3, 'CTA', 'FCO', '2023-05-25 14:10:00', '2023-05-26 08:15:00', 1, 'ECONOMY', 219.76),
(40, 3, 'LIN', 'CTA', '2023-05-25 17:35:00', '2023-05-26 06:00:00', 1, 'ECONOMY', 197.98);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `name`, `surname`, `email`, `password`) VALUES
(3, 'Daniele', 'Riccobene', 'daniele@email.com', 'Ciao2023@'),
(4, 'Filippo', 'Costanzo', 'filippo@email.com', 'Filippo2023@!'),
(5, 'Andrea', 'Rossi', 'andrea@email.com', 'Andrea2022@'),
(6, 'Rosanna', 'Panna', 'rosanna@email.com', 'Rosanna222'),
(7, 'Andrea', 'Spi', 'andrew@email.com', 'Andreasuper23');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bagagli`
--
ALTER TABLE `bagagli`
  ADD KEY `utente` (`utente`),
  ADD KEY `prenotazione` (`prenotazione`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`prenotazione`),
  ADD KEY `utente` (`utente`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `prenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bagagli`
--
ALTER TABLE `bagagli`
  ADD CONSTRAINT `bagagli_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bagagli_ibfk_2` FOREIGN KEY (`prenotazione`) REFERENCES `prenotazione` (`prenotazione`) ON DELETE CASCADE;

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `prenotazione_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
