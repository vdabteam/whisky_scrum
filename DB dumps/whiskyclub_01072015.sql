-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 01 jul 2015 om 15:56
-- Serverversie: 5.6.21
-- PHP-versie: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `whiskyclub`
--
CREATE DATABASE IF NOT EXISTS `whiskyclub` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `whiskyclub`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `barrels`
--

CREATE TABLE IF NOT EXISTS `barrels` (
`id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `barrels`
--

INSERT INTO `barrels` (`id`, `type`) VALUES
(0, 'unknown');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `whisky_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `whisky_id`, `user_id`, `comment`, `time`, `date`) VALUES
(1, 1, 1, 'Whisky!!!!! :D', '08:15:00', '2015-07-01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `distilleries`
--

CREATE TABLE IF NOT EXISTS `distilleries` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `distilleries`
--

INSERT INTO `distilleries` (`id`, `name`, `address`, `city`, `country`, `region`) VALUES
(1, 'Caol Ila', '', 'Port Askaig', 'Scotland', 'Islay'),
(2, 'Bowmore', 'School street', 'Bowmore', 'Scotland', 'Islay'),
(3, 'Buffalo Trace', 'Great Buffalo Trace 113', 'Frankfort, KY', 'United States', ''),
(4, 'Yamazaki', 'Mishimagun', 'Osaka', 'Japan', ''),
(5, 'Kilbeggan', 'Lower Main St.', 'Westmeath', 'Ireland', ''),
(6, 'Aberfeldy', '', 'Aberfeldy', 'Scotland', 'Central Highlands'),
(7, 'Bushmills', ' 2 Distillery Rd', 'Bushmills', 'Ireland', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `image_path` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `registration_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `admin`, `blocked`, `image_path`, `registration_date`) VALUES
(1, 'admin', '$2y$10$CzknNIJDR3JbtrTVzy4Fa.Wyz82KZVDcjoGoy1L4IQzOl/WWq3boa', 'admin@mail.com', 'John', 'Smith', 1, 0, ' default.jpg', '2015-07-13'),
(2, 'user', '$2y$10$CGSgFgDLOJXoEHEy9TuG0uKOXYv4q6ZLqJcpwFz5hpL8qS0yaO.vS', 'user@mail.com', 'Peter', 'Jackson', 0, 0, 'default.jpg', '2015-07-22'),
(4, 'tommy', '$2y$10$oREiVM3Of3hI4fI/wcKQbuQCjvGzzDlHaaEQoQbZvbWo8ZK/9NWCS', 'cruise@tom.com', 'Tom', 'Cruise', 0, 0, 'default.jpg', '2015-07-01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `whiskies`
--

CREATE TABLE IF NOT EXISTS `whiskies` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `distillery_id` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `age` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `barrel_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL,
  `rating_aroma` int(11) NOT NULL,
  `rating_color` int(11) NOT NULL,
  `rating_taste` int(11) NOT NULL,
  `rating_aftertaste` int(11) NOT NULL,
  `text_aroma` longtext NOT NULL,
  `text_color` longtext NOT NULL,
  `text_taste` longtext NOT NULL,
  `text_aftertaste` longtext NOT NULL,
  `review` longtext NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `whiskies`
--

INSERT INTO `whiskies` (`id`, `name`, `distillery_id`, `price`, `age`, `strength`, `barrel_id`, `image_path`, `hidden`, `creation_date`, `rating_aroma`, `rating_color`, `rating_taste`, `rating_aftertaste`, `text_aroma`, `text_color`, `text_taste`, `text_aftertaste`, `review`, `user_id`) VALUES
(1, 'Caol Ila 12', 1, '32.00', 12, 43, 0, 'caol_ila_12.jpg', 0, '2015-06-30', 20, 20, 20, 20, 'Lorem Ipsum', 'Dolor sit', 'Amet Consectetur', 'Adipiscing', 'elit', 1),
(2, 'Caol Ila 14', 1, '72.00', 14, 59, 0, 'caol_ila_14.jpg', 0, '2015-06-30', 0, 0, 0, 0, 'Lorem', 'Ipsum dolor', 'Sit Amet', 'Consectetur', 'Adipiscing elit', 1),
(3, 'The Manager''s Dram', 1, '2250.00', 15, 63, 0, 'managers_dram.jpg', 0, '2015-06-30', 16, 16, 17, 16, 'Lorem Ipsum', 'Dolor sit', 'Amet Consectetur', 'Adipiscing', 'elit', 1),
(4, 'Caol Ila 1968 Sa', 1, '1936.00', 14, 57, 0, 'caol_ila_1968.jpg', 0, '2015-06-30', 15, 15, 16, 16, 'Smells like whisky', 'Looks like whisky', 'Tastes like whisky', 'Still tastes like whisky', 'Definitely whisky', 1),
(5, 'Bowmore 8', 2, '103.00', 8, 40, 0, 'bowmore_8.jpg', 0, '2015-06-30', 15, 16, 15, 14, 'More whisky', 'whisky', 'whisky', 'whisky', 'Still whisky', 1),
(6, 'Bowmore 100 Degrees Proof', 2, '49.95', 0, 57, 0, 'bowmore_100_degrees_proof.jpg', 0, '2015-06-30', 14, 16, 17, 15, 'Smells okay', 'Looks fine', 'Tastes good', 'Aftertaste  not great', 'So so.', 1),
(7, 'Bowmore 12', 2, '109.90', 12, 43, 0, 'bowmore_12.jpg', 0, '2015-06-30', 15, 17, 16, 14, 'Hmmmm.', 'Nice!', 'Tasty!', 'Burp!', 'Awesome!', 1),
(8, 'Blanton''s Gold Edition', 3, '67.00', 0, 51, 0, 'blantons_gold_edition.jpg', 0, '2015-07-01', 16, 16, 15, 15, 'Uhm.', 'Uhm.', 'Uhm.', 'Uhm.', 'Okay then.', 1),
(9, 'Aberfeldy 12y', 6, '46.80', 12, 47, 0, 'aberfeldy_12.jpg', 1, '2015-07-01', 18, 17, 16, 17, 'Swing the tyrconnell clontarf vat 69.  Teacher’s ballantines hankey bannister old tavern.  Famous grouse dunbar logan''s clontarf hankey bannister officer''s choice.  Black bush tullamore dew old tavern 100 pipers.', 'Finian''s highland park swing old tavern dalmore dewar''s.  Mac pay feckin merry''s river queen.  Dunbar grand macnish john barr label 5.  Of ye monks balvenie label 5 jameson rarest vintage.  Sandy mac dunhill hankey bannister whyte and mackay the macallan.\r\n', 'Logan''s glenfiddich isle of jura kilbeggan whyte & mackay.  Teacher’s golden king isle of jura john barr dimple pinch tullamore dew.  J&b dalmore john barr gregson’s.  The irishman the original clan dailuaine the macallan old times.  Old virginia famous grouse royal stag black bush rob roy.', 'Isle of jura criadores dunbar finian''s.  Johnnie walker rob roy the macallan the tyrconnell.  McDowell''s no.1 hankey bannister merry''s evan william''s johnnie walker.  Something special bagpiper laphroaig hankey bannister.\r\n', 'Finian''s old virginia gregson’s john barr old overholt american rye.  Sandy mac vat 69 finian''s jack daniels mcDowell''s no.1 hankey bannister.  Dunhill gentleman jack tillers whyte & mackay sir edward''s.  Dailuaine dunhill chivas regal grant''s.  Greenore criadores bells merry''s famous grouse.', 1),
(10, 'Aberfeldy 21y', 6, '86.20', 21, 40, 0, 'aberfeldy_21.jpg', 0, '2015-07-01', 15, 14, 15, 13, 'Jameson mac pay hankey bannister laphroaig ballantines.  Ballantines old virginia the tyrconnell of ye monks evan william''s mac arthur''s.  Whyte and mackay j&b swing chivas regal.  Knockando gentleman jack dailuaine the irishman the original clan.  Knockando greenore teacher’s the tyrconnell.  Grant''s tillers dunhill bells royal stag old overholt american rye.\r\n\r\n', 'Highland park william lawson’s dunhill tillers gregson’s.  Highland park jameson rarest vintage grand macnish grant''s dalmore hankey bannister.  Midleton monarch old overholt american rye mac arthur''s old virginia royal salute hundred cask.  Officer''s choice old times teacher’s william lawson’s pinwinnie j&b.  Michael collins pinwinnie river queen balvenie.  Whyte and mackay dimple pinch greenore jim beam black.\r\n', '\r\nWhyte and mackay power and son bells original choice.  Dimple pinch something special Clontarf Single Malt bagpiper.  Glenfiddich jim beam black black and white finian''s label 5 kilbeggan.  Monarch buchanans officer''s choice dailuaine criadores.\r\n', '\r\nClontarf gentleman jack greenore buchanans highland park old virginia.  Finian''s isle of jura golden king kilbeggan whyte and mackay.  Tullamore dew logan''s gentleman jack jameson Clontarf Single Malt william lawson’s.  John dewar''s jameson grant''s grand macnish gregson’s finian''s.  Hankey bannister red breast j&b old virginia john barr dalmore.\r\n\r\n', 'Kilbeggan the tyrconnell chivas regal highland park.  Royal salute hundred cask something special knockando golden king.  Red breast power and son old virginia john barr mac arthur''s logan''s.  Jack daniels william lawson’s laphroaig finian''s kilbeggan grant''s.  Knockando midleton whyte and mackay evan william''s something special.  Cutty sark royal stag bells bagpiper john barr.', 1),
(11, 'Bushmills 16y', 7, '53.70', 16, 40, 0, 'bushmills_16.jpg', 0, '2015-07-01', 16, 17, 18, 19, 'Clontarf Single Malt dalmore bells red breast william lawson’s.  Red breast knockando 100 pipers laphroaig.  Buchanans monarch river queen dalmore dewar''s.  Catto''s balvenie dalmore whyte & mackay.  The tyrconnell john dewar''s jameson rarest vintage label 5 vat 69.\r\n', 'Royal stag laphroaig jack daniels 100 pipers white horse.  Buchanans bells old smuggler grant''s mac arthur''s.  Johnnie walker gentleman jack whyte & mackay highland park.  Tullamore dew monarch clontarf buchanans logan''s dewar''s.  White horse swing rob roy sir edward''s the tyrconnell.  Merry''s evan william''s clontarf river queen.\r\n', 'Chivas regal vat 69 the irishman the original clan old smuggler rob roy burrberrys.  Red breast hankey bannister swing tullamore dew.  Black and white mac pay rob roy finian''s john dewar''s.  Original choice michael collins catto''s 100 pipers dailuaine hankey bannister.  Old smuggler vat 69 jameson whyte & mackay old virginia bells.', 'Old tavern finian''s gregson’s golden king kilbeggan.  Mac pay royal stag chivas regal mac arthur''s laphroaig.  Criadores 100 pipers original choice dalmore burrberrys old times.  Burrberrys bells ballantines original choice mcDowell''s no.1 glenfiddich.', 'William lawson’s label 5 famous grouse jameson knockando.  Bagpiper mcDowell''s no.1 power and son tillers.  Chivas regal bells something special gentleman jack.  Old pulteney malta catto''s famous grouse john dewar''s royal salute hundred cask sandy mac.  Vat 69 dunbar something special rob roy.  Royal salute hundred cask old tavern original choice red breast.', 1),
(13, 'Bowmore 25y', 2, '597.00', 25, 43, 0, 'bowmore_25.jpg', 0, '2015-07-01', 16, 16, 16, 16, 'William lawson’s label 5 famous grouse jameson knockando.  Bagpiper mcDowell''s no.1 power and son tillers.  Chivas regal bells something special gentleman jack.  Old pulteney malta catto''s famous grouse john dewar''s royal salute hundred cask sandy mac.  Vat 69 dunbar something special rob roy.  Royal salute hundred cask old tavern original choice red breast.', 'William lawson’s label 5 famous grouse jameson knockando.  Bagpiper mcDowell''s no.1 power and son tillers.  Chivas regal bells something special gentleman jack.  Old pulteney malta catto''s famous grouse john dewar''s royal salute hundred cask sandy mac.  Vat 69 dunbar something special rob roy.  Royal salute hundred cask old tavern original choice red breast.', 'William lawson’s label 5 famous grouse jameson knockando.  Bagpiper mcDowell''s no.1 power and son tillers.  Chivas regal bells something special gentleman jack.  Old pulteney malta catto''s famous grouse john dewar''s royal salute hundred cask sandy mac.  Vat 69 dunbar something special rob roy.  Royal salute hundred cask old tavern original choice red breast.', 'William lawson’s label 5 famous grouse jameson knockando.  Bagpiper mcDowell''s no.1 power and son tillers.  Chivas regal bells something special gentleman jack.  Old pulteney malta catto''s famous grouse john dewar''s royal salute hundred cask sandy mac.  Vat 69 dunbar something special rob roy.  Royal salute hundred cask old tavern original choice red breast.', 'William lawson’s label 5 famous grouse jameson knockando.  Bagpiper mcDowell''s no.1 power and son tillers.  Chivas regal bells something special gentleman jack.  Old pulteney malta catto''s famous grouse john dewar''s royal salute hundred cask sandy mac.  Vat 69 dunbar something special rob roy.  Royal salute hundred cask old tavern original choice red breast.', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `barrels`
--
ALTER TABLE `barrels`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `whisky_id` (`whisky_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `distilleries`
--
ALTER TABLE `distilleries`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `whiskies`
--
ALTER TABLE `whiskies`
 ADD PRIMARY KEY (`id`), ADD KEY `distillery_id` (`distillery_id`), ADD KEY `barrel_id` (`barrel_id`), ADD KEY `user` (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `barrels`
--
ALTER TABLE `barrels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `distilleries`
--
ALTER TABLE `distilleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `whiskies`
--
ALTER TABLE `whiskies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `whisky_id` FOREIGN KEY (`whisky_id`) REFERENCES `whiskies` (`id`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `whiskies`
--
ALTER TABLE `whiskies`
ADD CONSTRAINT `barrel_id` FOREIGN KEY (`barrel_id`) REFERENCES `barrels` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `distillery_id` FOREIGN KEY (`distillery_id`) REFERENCES `distilleries` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
