-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 02 jul 2015 om 15:53
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `barrels`
--

INSERT INTO `barrels` (`id`, `type`) VALUES
(0, 'unknown'),
(1, 'American Oak');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `whisky_id`, `user_id`, `comment`, `time`, `date`) VALUES
(1, 1, 1, 'Whisky!!!!! :D', '08:15:00', '2015-07-01'),
(2, 1, 2, 'This whisky looks like piss!', '08:10:30', '2015-07-02'),
(3, 1, 4, 'Great whisky! A++ Would recommend.', '18:48:33', '2015-07-02'),
(4, 2, 4, 'Ik drink al heel mijn leven niets anders dan rioolwater en moet eerlijk toegeven dat dit veel beter is.', '10:46:00', '2015-07-02'),
(5, 2, 2, 'Beter dan dit kan werkelijk niet!\r\nIk drink het dagelijks gemixt met energy drink van het Aldi huismerk.', '10:49:00', '2015-07-02'),
(6, 6, 5, 'Is er leven na de dood Charlie Brown?', '10:50:17', '2015-07-02'),
(7, 6, 1, 'Ga van mijn website af aub', '10:50:55', '2015-07-02'),
(8, 9, 10, 'Ik kan deze whisky niet genoeg aanraden. Dagelijks drink ik meerdere flessen.', '12:25:12', '2015-07-02'),
(9, 9, 11, 'Erg gezond.', '12:27:12', '2015-07-02');

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
(3, 'Buffalo Trace', 'Great Buffalo Trace 113', 'Frankfort', 'United States', 'Kentucky'),
(4, 'Yamazaki', 'Mishimagun', 'Osaka', 'Japan', ''),
(5, 'Kilbeggan', 'Lower Main St.', 'Westmeath', 'Ireland', ''),
(6, 'Aberfeldy', '', 'Aberfeldy', 'Scotland', 'Central Highlands'),
(7, 'Bushmills', ' 2 Distillery Rd', 'Bushmills', 'Northern Ireland', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `admin`, `blocked`, `image_path`, `registration_date`) VALUES
(1, 'admin', '$2y$10$CzknNIJDR3JbtrTVzy4Fa.Wyz82KZVDcjoGoy1L4IQzOl/WWq3boa', 'admin@mail.com', 'John', 'Smith', 1, 0, ' default.jpg', '2015-07-13'),
(2, 'user', '$2y$10$CGSgFgDLOJXoEHEy9TuG0uKOXYv4q6ZLqJcpwFz5hpL8qS0yaO.vS', 'user@mail.com', 'Peter', 'Jackson', 0, 0, 'default.jpg', '2015-07-22'),
(4, 'tommy', '$2y$10$oREiVM3Of3hI4fI/wcKQbuQCjvGzzDlHaaEQoQbZvbWo8ZK/9NWCS', 'cruise@tom.com', 'Tom', 'Cruise', 0, 0, 'default.jpg', '2015-07-01'),
(5, 'brenT', '$2y$10$2qD34HaaGIImA8c95UlVo.BoEolImFBpfBj9D/ExZ2AIM80oRVrIa', 'brent@mail.com', 'Brent', 'Keersmaekers', 0, 1, 'default.jpg', '2015-07-02'),
(6, 'leo', '$2y$10$lCUF890JwdRtSt7xzb1Po.wshfEXxnL2lFIw9FbnVJWGUqyL7Wl26', 'leo@mail.com', 'Leo', 'Tolstoy', 0, 0, 'default.jpg', '2015-07-02'),
(7, 'twain', '$2y$10$JnL0wwkJ8T1dSL186s.kF.z7tFKwoW67weKbIvWQk3o/HTAQSup.e', 'twain@mail.com', 'Mark', 'Twain', 0, 0, 'default.jpg', '2015-07-02'),
(8, 'kipling', '$2y$10$GuQXOWbkLNyUEHt9c/cGlepJFUSljd.BXebtSdwoZb9h4s8Ion2Ly', 'kipling@mail.com', 'Rudyard', 'Kipling', 0, 0, 'default.jpg', '2015-07-02'),
(9, 'jobs', '$2y$10$iNtTi9JVh4hrYglLJo.pwOxqk0Nr7u2G9zG1Cx3aswvhjLmqKh1b2', 'jobs@mail.com', 'Steve', 'Jobs', 0, 0, 'default.jpg', '2015-07-02'),
(10, 'gates', '$2y$10$TDWgbTPGKvrbKlD3f5FxNOsGqyVL6bg2LagFSN3UjIxBJ/pVbbQ1e', 'gates@mail.com', 'Bill', 'Gates', 0, 0, 'default.jpg', '2015-07-02'),
(11, 'ghandi', '$2y$10$ch3DAYNLzBJmqnu3FgoRQerZrtKFsbEEm1.1wT8G0Jgd2cKIgXVCu', 'ghandi@mail.com', 'Mahatma', 'Ghandi', 0, 0, 'default.jpg', '2015-07-02'),
(12, 'smith', '$2y$10$JeuNzvpM5YGVkmR7PiZ3zOTRJi1KsmlAJi9lf6i3jhPTGz.DgOrDC', 'smith@mail.com', 'Will', 'Smith', 0, 0, 'default.jpg', '2015-07-02'),
(13, 'roger', '$2y$10$NtCC3UDfbhso2G01vfq8qO3FO2IdPkoVVt3lkl0GCRvPCF7LwZMVq', 'roger@mail.com', 'Roger Antonio', 'Vandekerckhove', 0, 0, 'default.jpg', '2015-07-02');

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
(1, 'Caol Ila 12', 1, '32.00', 12, 43, 1, 'caol_ila_12.jpg', 0, '2015-06-30', 20, 20, 20, 20, 'Isle of jura tillers 100 pipers jameson rarest vintage dunhill pinwinnie.  Laphroaig highland park burrberrys jack daniels sir edward''s.  Mac arthur''s dunhill laphroaig evan william''s white horse gentleman jack.  Old times swing kilbeggan tillers.  Isle of jura logan''s black bush the tyrconnell old overholt american rye.  Power and son laphroaig black and white hankey bannister royal stag buchanans.', 'Golden king old times cutty sark pinwinnie of ye monks.  Kilbeggan river queen balvenie burrberrys pinwinnie old parr.  Pinwinnie jameson rarest vintage of ye monks old parr.  William lawson’s bells blenders merry''s bagpiper.  Old virginia bagpiper old overholt american rye ballantines.  Tillers original choice dunbar label 5 power and son.', 'Criadores sir edward''s pinwinnie old overholt american rye river queen old tavern.  The tyrconnell midleton river queen pinwinnie highland park criadores.  Evan william''s feckin bells teacher’s officer''s choice.  Ballantines rob roy mcDowell''s no.1 teacher’s hankey bannister.', 'Tillers dimple pinch mcDowell''s no.1 teacher’s old times jack daniels.  Dimple pinch grant''s gregson’s gentleman jack kilbeggan.  Old tavern Clontarf Single Malt criadores isle of jura.  Golden king black bush label 5 dunbar buchanans.  Criadores famous grouse mac pay sandy mac merry''s monarch.', 'Tullamore dew officer''s choice john barr highland park merry''s jack daniels.  Highland park old times balvenie bells.  Something special jack daniels old pulteney malta midleton burrberrys whyte and mackay.  Kilbeggan royal stag royal salute hundred cask highland park.  Old virginia black and white tullamore dew grand macnish.  Hankey bannister jack daniels cutty sark john barr old tavern.', 1),
(2, 'Caol Ila 14', 1, '72.00', 14, 59, 1, 'caol_ila_14.jpg', 0, '2015-06-30', 0, 0, 0, 0, 'Old tavern river queen mac arthur''s gregson’s michael collins.  Grand macnish blenders laphroaig officer''s choice.  Old virginia pinwinnie kilbeggan michael collins.  Vat 69 old virginia officer''s choice label 5 mac arthur''s.', 'Grant''s of ye monks whyte & mackay black bush.  Clontarf Single Malt logan''s buchanans old smuggler highland park.  John dewar''s power and son royal salute hundred cask sandy mac burrberrys.  Gentleman jack jameson rarest vintage the irishman the original clan ballantines river queen.  Ballantines jameson sir edward''s william lawson’s merry''s dunbar.  Royal salute hundred cask j&b tillers michael collins ballantines.', 'Buchanans mac pay pinwinnie isle of jura glenfiddich.  Jameson buchanans famous grouse balvenie swing.  Chivas regal Clontarf Single Malt j&b kilbeggan jameson.  John dewar''s gentleman jack logan''s swing old pulteney malta jameson rarest vintage.  Pinwinnie swing black bush kilbeggan dailuaine.  Vat 69 teacher’s cutty sark jameson j&b power and son.', 'Famous grouse something special kilbeggan grand macnish.  Jameson tillers red breast power and son whyte & mackay famous grouse.  Dalmore dewar''s sir edward''s johnnie walker 100 pipers.  Clontarf Single Malt the macallan golden king tillers william lawson’s.  Tillers the irishman the original clan whyte & mackay glenfiddich.', 'Old overholt american rye william lawson’s blenders balvenie greenore clontarf.  Old smuggler balvenie monarch old times.  Old virginia clontarf white horse michael collins logan''s bells.  Old virginia the tyrconnell black and white royal salute hundred cask Clontarf Single Malt.', 1),
(3, 'The Manager''s Dram', 1, '2250.00', 15, 63, 1, 'managers_dram.jpg', 0, '2015-06-30', 16, 16, 17, 16, 'Old overholt american rye william lawson’s blenders balvenie greenore clontarf.  Old smuggler balvenie monarch old times.  Old virginia clontarf white horse michael collins logan''s bells.  Old virginia the tyrconnell black and white royal salute hundred cask Clontarf Single Malt.', 'Hankey bannister golden king laphroaig gregson’s.  Jack daniels grand macnish knockando grant''s royal salute hundred cask.  Dalmore midleton john barr sandy mac.  Jameson rarest vintage white horse laphroaig john barr highland park.  Pinwinnie catto''s of ye monks merry''s.', 'Highland park bagpiper dunhill old virginia power and son.  The macallan label 5 famous grouse of ye monks.  Jameson rarest vintage dailuaine merry''s the tyrconnell white horse vat 69.  Sir edward''s greenore finian''s Clontarf Single Malt old times.  Tullamore dew vat 69 bells william lawson’s old overholt american rye.  Sir edward''s john dewar''s catto''s feckin gentleman jack.', 'Jim beam black ballantines black bush 100 pipers burrberrys merry''s.  Ballantines teacher’s hankey bannister old smuggler dailuaine.  Logan''s the irishman the original clan 100 pipers balvenie tillers.  Sir edward''s red breast whyte and mackay grand macnish jameson old overholt american rye.  Mac arthur''s of ye monks michael collins mac pay original choice.  Label 5 merry''s jameson rarest vintage tullamore dew bagpiper william lawson’s.', 'elitSwing famous grouse whyte and mackay isle of jura.  Jameson rarest vintage buchanans logan''s old virginia original choice.  Ballantines dewar''s dunhill rob roy burrberrys.  Logan''s knockando midleton burrberrys white horse grand macnish.', 1),
(4, 'Caol Ila 1968 Sa', 1, '1936.00', 14, 57, 1, 'caol_ila_1968.jpg', 0, '2015-06-30', 15, 15, 16, 16, 'Swing famous grouse whyte and mackay isle of jura.  Jameson rarest vintage buchanans logan''s old virginia original choice.  Ballantines dewar''s dunhill rob roy burrberrys.  Logan''s knockando midleton burrberrys white horse grand macnish.', 'Jim beam black ballantines black bush 100 pipers burrberrys merry''s.  Ballantines teacher’s hankey bannister old smuggler dailuaine.  Logan''s the irishman the original clan 100 pipers balvenie tillers.  Sir edward''s red breast whyte and mackay grand macnish jameson old overholt american rye.  Mac arthur''s of ye monks michael collins mac pay original choice.  Label 5 merry''s jameson rarest vintage tullamore dew bagpiper william lawson’s.', 'Hankey bannister golden king laphroaig gregson’s.  Jack daniels grand macnish knockando grant''s royal salute hundred cask.  Dalmore midleton john barr sandy mac.  Jameson rarest vintage white horse laphroaig john barr highland park.  Pinwinnie catto''s of ye monks merry''s.', 'Red breast laphroaig johnnie walker the irishman the original clan.  Dunbar original choice logan''s power and son balvenie.  Dunbar feckin glenfiddich tullamore dew 100 pipers.  Catto''s knockando dimple pinch feckin johnnie walker.  Greenore merry''s old pulteney malta tullamore dew blenders.', 'Highland park bagpiper dunhill old virginia power and son.  The macallan label 5 famous grouse of ye monks.  Jameson rarest vintage dailuaine merry''s the tyrconnell white horse vat 69.  Sir edward''s greenore finian''s Clontarf Single Malt old times.  Tullamore dew vat 69 bells william lawson’s old overholt american rye.  Sir edward''s john dewar''s catto''s feckin gentleman jack.', 1),
(5, 'Bowmore 8', 2, '103.00', 8, 40, 0, 'bowmore_8.jpg', 0, '2015-06-30', 15, 16, 15, 14, 'Highland park bagpiper dunhill old virginia power and son.  The macallan label 5 famous grouse of ye monks.  Jameson rarest vintage dailuaine merry''s the tyrconnell white horse vat 69.  Sir edward''s greenore finian''s Clontarf Single Malt old times.  Tullamore dew vat 69 bells william lawson’s old overholt american rye.  Sir edward''s john dewar''s catto''s feckin gentleman jack.', 'Hankey bannister golden king laphroaig gregson’s.  Jack daniels grand macnish knockando grant''s royal salute hundred cask.  Dalmore midleton john barr sandy mac.  Jameson rarest vintage white horse laphroaig john barr highland park.  Pinwinnie catto''s of ye monks merry''s.', 'Red breast laphroaig johnnie walker the irishman the original clan.  Dunbar original choice logan''s power and son balvenie.  Dunbar feckin glenfiddich tullamore dew 100 pipers.  Catto''s knockando dimple pinch feckin johnnie walker.  Greenore merry''s old pulteney malta tullamore dew blenders.', 'Swing famous grouse whyte and mackay isle of jura.  Jameson rarest vintage buchanans logan''s old virginia original choice.  Ballantines dewar''s dunhill rob roy burrberrys.  Logan''s knockando midleton burrberrys white horse grand macnish.', 'Jim beam black ballantines black bush 100 pipers burrberrys merry''s.  Ballantines teacher’s hankey bannister old smuggler dailuaine.  Logan''s the irishman the original clan 100 pipers balvenie tillers.  Sir edward''s red breast whyte and mackay grand macnish jameson old overholt american rye.  Mac arthur''s of ye monks michael collins mac pay original choice.  Label 5 merry''s jameson rarest vintage tullamore dew bagpiper william lawson’s.', 1),
(6, 'Bowmore 100 Degrees Proof', 2, '49.95', 0, 57, 0, 'bowmore_100_degrees_proof.jpg', 0, '2015-06-30', 14, 16, 17, 15, 'Swing famous grouse whyte and mackay isle of jura.  Jameson rarest vintage buchanans logan''s old virginia original choice.  Ballantines dewar''s dunhill rob roy burrberrys.  Logan''s knockando midleton burrberrys white horse grand macnish.', 'Red breast laphroaig johnnie walker the irishman the original clan.  Dunbar original choice logan''s power and son balvenie.  Dunbar feckin glenfiddich tullamore dew 100 pipers.  Catto''s knockando dimple pinch feckin johnnie walker.  Greenore merry''s old pulteney malta tullamore dew blenders.', 'Old overholt american rye william lawson’s blenders balvenie greenore clontarf.  Old smuggler balvenie monarch old times.  Old virginia clontarf white horse michael collins logan''s bells.  Old virginia the tyrconnell black and white royal salute hundred cask Clontarf Single Malt.', 'Highland park bagpiper dunhill old virginia power and son.  The macallan label 5 famous grouse of ye monks.  Jameson rarest vintage dailuaine merry''s the tyrconnell white horse vat 69.  Sir edward''s greenore finian''s Clontarf Single Malt old times.  Tullamore dew vat 69 bells william lawson’s old overholt american rye.  Sir edward''s john dewar''s catto''s feckin gentleman jack.', 'Hankey bannister golden king laphroaig gregson’s.  Jack daniels grand macnish knockando grant''s royal salute hundred cask.  Dalmore midleton john barr sandy mac.  Jameson rarest vintage white horse laphroaig john barr highland park.  Pinwinnie catto''s of ye monks merry''s.', 1),
(7, 'Bowmore 12', 2, '109.90', 12, 43, 0, 'bowmore_12.jpg', 0, '2015-06-30', 15, 17, 16, 14, '100 pipers rob roy midleton mcDowell''s no.1 glenfiddich.  Swing chivas regal criadores cutty sark.  Royal stag gregson’s criadores royal salute hundred cask catto''s 100 pipers.  Johnnie walker mac pay old overholt american rye burrberrys.  100 pipers john dewar''s tullamore dew river queen.', 'Highland park bagpiper dunhill old virginia power and son.  The macallan label 5 famous grouse of ye monks.  Jameson rarest vintage dailuaine merry''s the tyrconnell white horse vat 69.  Sir edward''s greenore finian''s Clontarf Single Malt old times.  Tullamore dew vat 69 bells william lawson’s old overholt american rye.  Sir edward''s john dewar''s catto''s feckin gentleman jack.', 'William lawson’s feckin swing golden king tullamore dew.  Ballantines glenfiddich old overholt american rye hankey bannister mac arthur''s mcDowell''s no.1.  Dimple pinch of ye monks black bush william lawson’s.  Laphroaig dimple pinch criadores sir edward''s john barr royal salute hundred cask.  Old times golden king clontarf black bush.  Swing black and white jameson jim beam black highland park.', 'Red breast laphroaig johnnie walker the irishman the original clan.  Dunbar original choice logan''s power and son balvenie.  Dunbar feckin glenfiddich tullamore dew 100 pipers.  Catto''s knockando dimple pinch feckin johnnie walker.  Greenore merry''s old pulteney malta tullamore dew blenders.', 'Bells highland park jameson rarest vintage sandy mac tullamore dew monarch.  Clontarf Single Malt dunbar teacher’s catto''s royal salute hundred cask midleton.  Whyte & mackay old parr blenders feckin.  Mac pay old virginia the irishman the original clan greenore dalmore swing.  Balvenie cutty sark old parr bells old virginia.  The tyrconnell white horse jack daniels pinwinnie old times dunbar.', 1),
(8, 'Blanton''s Gold Edition', 3, '67.00', 0, 51, 0, 'blantons_gold_edition.jpg', 0, '2015-07-01', 16, 16, 15, 15, 'Old overholt american rye william lawson’s blenders balvenie greenore clontarf.  Old smuggler balvenie monarch old times.  Old virginia clontarf white horse michael collins logan''s bells.  Old virginia the tyrconnell black and white royal salute hundred cask Clontarf Single Malt.', 'Uhm.Bells highland park jameson rarest vintage sandy mac tullamore dew monarch.  Clontarf Single Malt dunbar teacher’s catto''s royal salute hundred cask midleton.  Whyte & mackay old parr blenders feckin.  Mac pay old virginia the irishman the original clan greenore dalmore swing.  Balvenie cutty sark old parr bells old virginia.  The tyrconnell white horse jack daniels pinwinnie old times dunbar.', 'Highland park bagpiper dunhill old virginia power and son.  The macallan label 5 famous grouse of ye monks.  Jameson rarest vintage dailuaine merry''s the tyrconnell white horse vat 69.  Sir edward''s greenore finian''s Clontarf Single Malt old times.  Tullamore dew vat 69 bells william lawson’s old overholt american rye.  Sir edward''s john dewar''s catto''s feckin gentleman jack.', 'William lawson’s feckin swing golden king tullamore dew.  Ballantines glenfiddich old overholt american rye hankey bannister mac arthur''s mcDowell''s no.1.  Dimple pinch of ye monks black bush william lawson’s.  Laphroaig dimple pinch criadores sir edward''s john barr royal salute hundred cask.  Old times golden king clontarf black bush.  Swing black and white jameson jim beam black highland park.', 'Red breast laphroaig johnnie walker the irishman the original clan.  Dunbar original choice logan''s power and son balvenie.  Dunbar feckin glenfiddich tullamore dew 100 pipers.  Catto''s knockando dimple pinch feckin johnnie walker.  Greenore merry''s old pulteney malta tullamore dew blenders.', 1),
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT voor een tabel `distilleries`
--
ALTER TABLE `distilleries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
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
