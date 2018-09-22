-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2015 at 03:55 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ceidweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(255) NOT NULL,
  `newName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`catName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catName`, `newName`) VALUES
(1, 'Arts/Entertainment/Nightlife', 'Entertainment'),
(27, 'Local Business', 'Local Business');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fbId` varchar(30) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `photo` varchar(255) NOT NULL,
  `place` longtext NOT NULL,
  `date` datetime NOT NULL,
  `show` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fbId` (`fbId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `fbId`, `catName`, `owner`, `name`, `description`, `photo`, `place`, `date`, `show`) VALUES
(4, '486553804884727', 'Arts/Entertainment/Nightlife', 'Θέατρο Λιθογραφείον / Lithografion Theatre', '"Το Πανεπιστήμιο στην πόλη" by UP FM & Θέατρο Λιθογραφείον', 'Ο UP FM, ο σταθμός του Πανεπιστημίου Πατρών και το θέατρο Λιθογραφείον, οργανώνουν διήμερο εκδηλώσεων για το καλωσόρισμα των φοιτητών στη Πάτρα!\n\nΗ καρδιά του πανεπιστημίου Πάτρας, χτυπάει δυνατά στο Θέατρο Λιθογραφείον, Τετάρτη 7 και Πέμπτη 8 Οκτώβρη.\n\nΤετάρτη 7 Οκτώβρη\n\n6μμ  This is Patras!\nvideo, έκθεση φωτογραφίας\n\n8μμ Digilove\nΠαρουσίαση του διαδραστικού μυθιστορήματος του Γιώργου Περισανίδη\n\n10μμ WELCOME PARTY\nμε  dj set από τους παραγωγούς του UP FM\n\nΕΙΣΟΔΟΣ ΕΛΕΥΘΕΡΗ\n\n\nΠέμπτη 8 Οκτώβρη\n9μμ Warm up dj set\nμε τον Γιώργο Νικολόπουλο\n10μμ Cyanna Mercury Live!\n\nΕΝΙΑΙΟ ΕΙΣΙΤΗΡΙΟ 8€\n\n\nΤετάρτη 7 και Πέμπτη 8 Οκτώβρη!\nΘέατρο Λιθογραφείον, Μαιζώνος 172 & Τριών Ναυάρχων\nΠερισσότερες πληροφορίες στο 2610 328 394 και με μήνυμα στην σελίδα μας.', 'https://scontent.xx.fbcdn.net/hphotos-xft1/t31.0-8/s720x720/12027275_10153649858192743_7400511777409258845_o.jpg', '{"name":"u0398u03adu03b1u03c4u03c1u03bf u039bu03b9u03b8u03bfu03b3u03c1u03b1u03c6u03b5u03afu03bfu03bd / Lithografion Theatre","location":{"city":"Patras","country":"Greece","latitude":38.242485,"longitude":21.7294102,"street":"Maizonos 172b","zip":"26222"},"id":"107168247742"}', '2015-10-07 18:00:00', 1),
(22, '1650675425216976', 'Local Business', 'MAGENDA*** meeting point***', 'SHAKE YOUR BOOTY *Dance Show: Anastasia Giousef || 30 /09 || @ Magenda', 'Mετά τη σειρά πολλών επιτυχημένων events & μια season γεμάτη δώρα & εκπλήξεις ..το Shake your Booty party αλλάζει κλίμα , γίνεται ομορφότερο, μεγαλύτερο .. & πιο ανανεωμένο απο ποτέ ! \nΚάθε Τετάρτη το Magenda θα γιορτάζει & μας υπόσχεται πολλες συγκινήσεις με νεα φρέσκα πρόσωπα & ένα Team που θα γραψει ιστορία με τις πιο sexy παρουσιες από Αθηνα, Θεσσαλονικη & όχι μονο !! \n\n✔️Sexy Dance Show : Anastasia Giousef\n\n✔️Djs :: Stam & Luigi\n\n✔️Guest models - celebritys \n\n✔️Free Tshirts by Liberta DArte clothing\n\n✔️ Special effects show\n\n✔️Covered by patrasevents / nightstories ©\n\nHosted By : Kostas Negkas \n\n& many more surprises that you cant miss!\n\nLets Dance Party People !!!!!', 'https://scontent.xx.fbcdn.net/hphotos-xfp1/v/t1.0-9/s720x720/12038055_949604528418623_1878677935594641394_n.jpg?oh=5a6c97a8f4b3ee5e68e032109d78e570&oe=568CD579', '{"name":"MAGENDA*** meeting point***","location":{"city":"Patras","country":"Greece","latitude":38.2486305,"longitude":21.7354355,"street":"Ag. Nikolaou 11"},"id":"180126065366477"}', '2015-09-30 23:00:00', 1),
(24, '1493810430933332', 'Local Business', 'MAGENDA*** meeting point***', '#HASHTAG# - The Party - Every Friday @ Magenda', 'Every Friday We Party @ Hashtag The Party \nMagenda *** meeting point ***', 'https://scontent.xx.fbcdn.net/hphotos-xaf1/v/t1.0-9/s720x720/11217665_940165589362517_1792515095346645992_n.jpg?oh=c79239a5f0c72bb595d8f9649dddd05a&oe=56ABDE83', '{"name":"MAGENDA*** meeting point***","location":{"city":"Patras","country":"Greece","latitude":38.2486305,"longitude":21.7354355,"street":"Ag. Nikolaou 11"},"id":"180126065366477"}', '2015-10-02 23:00:00', 1),
(25, '165682230431961', 'Local Business', 'MAGENDA*** meeting point***', 'REVOLUTION PARTY @ MAGENDA || THU 1/10 ||', 'EVERY THURSDAY\n*** REVOLUTION PARTY *** \n@ MAGENDA ***meeting point *** \n\n======================================\nIndoor & Outdoor Firework Show \nLive Mc Show \nMany Surprises\n--------------------------------------------------------------\nΤηλέφωνο Επικοινωνίας\n69 43400745', 'https://scontent.xx.fbcdn.net/hphotos-xpl1/v/t1.0-9/s720x720/11987147_939809229398153_1545643790317845992_n.jpg?oh=2f86c58858bc0600e0677989a2497da3&oe=568C6688', '{"name":"MAGENDA*** meeting point***","location":{"city":"Patras","country":"Greece","latitude":38.2486305,"longitude":21.7354355,"street":"Ag. Nikolaou 11"},"id":"180126065366477"}', '2015-10-01 23:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageId` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `pageId`, `name`) VALUES
(1, '107168247742', 'Lithografion Theatre'),
(2, 'MagendaMeetingPoint', 'Magenda Meeting Point');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
