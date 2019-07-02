-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2019 at 10:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `email` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`email`, `firstName`, `lastName`, `password`) VALUES
('ba@eraeno.ml', 'Lewis', 'Cohen', 'Carolyn7811'),
('badoni@finufeme.mk', 'Myrtie', 'Reed', 'Lewis9233'),
('besi@he.ee', 'Michael', 'Patterson', 'Troy6059'),
('bir@hacacdo.dk', 'Frederick', 'Ross', 'Sylvia7205'),
('butco@maso.kg', 'Blanche', 'McGee', 'Lilly2888'),
('daoce@kilhi.gr', 'Gordon', 'Schmidt', 'Myra7182'),
('dirkob@ew.gt', 'Lawrence', 'Bowman', 'Cameron3907'),
('dobwevu@hisu.gq', 'Lillian', 'Shelton', 'Lou3731'),
('egumobsev@nenuwumi.dz', 'Leonard', 'Boyd', 'Benjamin3481'),
('ekbe@wamro.cz', 'Micheal', 'Rowe', 'Minerva7254'),
('emi@hadoc.ad', 'Amanda', 'Horton', 'Leah5957'),
('eparde@rascooz.pm', 'Jorge', 'Potter', 'Louisa8348'),
('esura@ragjakaro.lt', 'Ian', 'Gibbs', 'Ronald8014'),
('fadod@fig.cu', 'Jayden', 'Paul', 'Edgar5974'),
('fe@cegcas.ck', 'Lelia', 'Daniels', 'Hattie7565'),
('feottuw@huc.ca', 'Jennie', 'Meyer', 'Alan3630'),
('fiksi@dud.lv', 'Jason', 'Torres', 'Polly7614'),
('fob@evwiguw.sl', 'Joshua', 'Drake', 'Louis7437'),
('gaceh@ofipo.dm', 'Polly', 'Fox', 'Micheal5619'),
('gafaddum@hu.cf', 'Lucinda', 'Harrington', 'Lulu5183'),
('govbusew@nitkaknu.vi', 'Alejandro', 'Simmons', 'Mattie3403'),
('hu@na.mw', 'Esther', 'Dunn', 'Bryan3709'),
('il@vojdu.kz', 'Winnie', 'Williamson', 'Gene6419'),
('imlimer@tapkudof.hn', 'Elva', 'Morgan', 'Connor9492'),
('jikagro@jicoca.gh', 'Ellen', 'Fisher', 'Ethel5076'),
('jimmulij@eciis.ch', 'Olga', 'Lyons', 'Ellen3700'),
('jimzecej@ju.org', 'Adeline', 'Walters', 'Nancy6669'),
('kemhadzul@esmismi.kp', 'Alejandro', 'Burke', 'Willie6343'),
('koat@huuta.so', 'Susan', 'Strickland', 'Bernard8705'),
('kobaivo@tojovhoh.na', 'Cora', 'Ross', 'Clarence9706'),
('kuhuob@vi.sd', 'Anne', 'Cook', 'Harold8763'),
('kuj@sa.ug', 'Curtis', 'Schultz', 'Jessie1679'),
('kuv@ufu.ca', 'Emilie', 'Francis', 'Mary1838'),
('ligmid@warak.tm', 'Juan', 'Roy', 'Dora2781'),
('loffec@so.kr', 'Brandon', 'Santiago', 'Lina7738'),
('logo@diuspi.cz', 'Chase', 'Frank', 'Adeline4586'),
('luap@fahiag.bb', 'Cole', 'Kim', 'Steve1754'),
('luwed@fofop.il', 'Katherine', 'Goodwin', 'Matthew1915'),
('mam@vebdobom.uz', 'Leah', 'Mills', 'Aiden5555'),
('mebepem@jed.es', 'Noah', 'Fox', 'Betty4324'),
('nailuja@riotlil.bj', 'Amanda', 'Higgins', 'Antonio5129'),
('ni@du.lc', 'Dominic', 'Rowe', 'Glenn6493'),
('nojog@fik.com', 'Joseph', 'Ramsey', 'Danny9664'),
('nosmev@wesa.mn', 'Derrick', 'Quinn', 'Chester6310'),
('nu@uco.az', 'Loretta', 'Marsh', 'Gordon3699'),
('nufze@tis.ch', 'Danny', 'Phelps', 'Ruby7759'),
('olitaw@hodaom.nl', 'Myra', 'Palmer', 'Mina3759'),
('on9@gmail.com', 'on9', 'on9', '12345678'),
('ovuki@wapanuf.ml', 'Lora', 'Banks', 'Craig5644'),
('ozac@akanac.hn', 'Gerald', 'Moody', 'Martin2743'),
('relin@ecu.bf', 'Sean', 'Burke', 'Margaret4268'),
('ropwiwaj@ujozaak.uz', 'Lura', 'Carson', 'Owen5181'),
('sa@pubuvoh.gd', 'Matilda', 'McGee', 'Jerry1617'),
('subni@ne.ly', 'Harriet', 'Moran', 'Dollie4880'),
('ta@tod.wf', 'Jennie', 'Fernandez', 'Douglas3460'),
('tas@tiknojaj.gi', 'Isabella', 'Lyons', 'Marion5574'),
('tu@cemwawoc.cm', 'Brent', 'Jacobs', 'Elva5240'),
('tuev@joali.us', 'Louise', 'Hawkins', 'Augusta5668'),
('ujuawco@voca.sa', 'Phoebe', 'Hamilton', 'Estella5081'),
('ula@gu.mq', 'Grace', 'Armstrong', 'Rachel9515'),
('up@cirov.nc', 'Lettie', 'Little', 'Landon6295'),
('upge@lop.gd', 'Mathilda', 'Knight', 'Maggie1136'),
('utko@puavab.tn', 'Vincent', 'Cruz', 'Justin8364'),
('vahaj@awmo.su', 'Warren', 'Parker', 'Harriet1762'),
('vajsoz@zecop.mr', 'Josie', 'Walton', 'Nelle3012'),
('vuolooba@ku.nr', 'Cornelia', 'Davidson', 'Amanda4876'),
('wugoltuc@ampulluk.ky', 'Dean', 'Miles', 'Elva1349'),
('zasig@pufviih.vn', 'Bernice', 'Todd', 'Etta7566'),
('zel@som.ae', 'Pauline', 'Shaw', 'Marcus7504'),
('zerkaw@vof.pr', 'Lizzie', 'Zimmerman', 'Minnie9115'),
('zizgirga@weucu.an', 'Bettie', 'Wise', 'Lucy5785'),
('zuzebaw@rodadek.kz', 'Mike', 'Meyer', 'Alejandro2499');

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `dealerID` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`dealerID`, `password`, `name`, `phoneNumber`, `address`) VALUES
('Bess', 'AAI3osh', 'AlmaHernandez', '65694226', 'Albania'),
('c010ur1355', '12345678', '213213123', '12333333', 'no'),
('Caroline', '1fZVnHq', 'JerryCurry', '73559656', 'Nauru'),
('Carrie', 'Saijv7Y3oQ', 'EdwardCraig', '29025608', 'Guinea-Bissau'),
('Cecelia', 'tSuPZs', 'LorettaWagner', '65430381', 'Romania'),
('Charlotte', 'FTOWDtaYF', 'RonnieFlores', '45875693', 'Antigua & Barbuda'),
('Clyde', '6CTFtCHekV6vvB4k', 'BertieBates', '23402716', 'Pitcairn Islands'),
('Donald', 'ILU3JhjA90dCwSX5OTz', 'EdithHall', '99542770', 'Canada'),
('Dorothy', 'gib9mebk7y', 'LeilaHardy', '45021391', 'U.S. Outlying Islands'),
('Elijah', '0vdKtqixJwfY', 'LeeChristensen', '61576386', 'Ecuador'),
('Ernest', 'aDA4nOepoTlmFn', 'OpheliaEstrada', '78487010', 'Gibraltar'),
('Franklin', 'jzpP4qfL', 'LoisSutton', '81770017', 'Ukraine'),
('fuckingshit', '12345678', 'shit', '852358323187', 'ldkajwlkdjlkwajdl'),
('Gene', 'ud3TcT5aTLIDyT', 'ElsieColeman', '81587568', 'Niue'),
('Gertrude', '4Wtbm', 'LuraErickson', '56756000', 'Puerto Rico'),
('Hannah', '2IzKbKMoDqk7hwMyDR8', 'EmilyBoyd', '43386078', 'Sweden'),
('Hester', '03imBU36gOz', 'GeneMcCarthy', '25057028', 'Christmas Island'),
('Ian', 'XpbPz', 'CalvinCross', '37613496', 'Afghanistan'),
('ilovedick', '12345678', 'no know you', '21908380912', 'ajwdljawldjlkaw'),
('Jacob', 'QbI1LQ0nEWvcAl3j5ohn', 'MabelKlein', '21310988', 'Tunisia'),
('Jeremiah', 'cdqkV0PtY2q0', 'DustinMendez', '72021416', 'Guadeloupe'),
('Jesse', 'm9uRIrC', 'IdaFrancis', '28007600', 'Kyrgyzstan'),
('Joshua', 'vOn5AC0jJz11C', 'JosiePowell', '20350648', 'Maldives'),
('Juan', 'nm0MIIMENs1', 'CalvinJacobs', '76440740', 'Ukraine'),
('Leo', 'Ji8jwRFpUVpOOBWCZL5S', 'EugenePage', '54080200', 'Cocos (Keeling) Islands'),
('Maude', 'yFDXVpPAWIO', 'MabelMarsh', '27082401', 'Martinique'),
('Maurice', 'xRZQqMI4DU86tYhm4HX', 'EthelNorton', '55006899', 'Indonesia'),
('Michael', 'qwhzgj', 'NoahCopeland', '46262202', 'Germany'),
('Minerva', 'FBdEL4Hvnf', 'HowardBates', '23160176', 'Guinea'),
('Nelle', 'ytR79NS084ZlwdsUrlL', 'ElijahNichols', '60390683', 'Romania'),
('on9', '87654321', 'fucking shit', '852933821971', 'changed'),
('Rena', 'gVARsprovVMdR', 'RoxieClark', '72129412', 'Sint Maarten'),
('Ronald', 'N5NQAabme5ShvMGpwL', 'CarrieWillis', '46131549', 'Niger'),
('Rose', 'ORuhk1RK39QHe', 'AdrianBowen', '96825138', 'Poland'),
('Rosetta', 'PgECQXJaI', 'GregoryBarnes', '24177627', 'Iraq'),
('Sophia', 'JfysNHyvSeahNkoAkt', 'VictorDrake', '81814541', 'Netherlands'),
('Todd', 'wqsIiWwyKjr', 'BertiePearson', '62596708', 'Ireland'),
('Warren', 'xmlhY6tPqQ3vUSjn9', 'FloraHart', '46542427', 'Taiwan');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderID` int(11) NOT NULL,
  `dealerID` varchar(50) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deliveryAddress` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderID`, `dealerID`, `orderDate`, `deliveryAddress`, `status`) VALUES
(19, 'on9', '2019-07-02 18:42:19', 'no', 0),
(20, 'on9', '2019-07-02 19:06:23', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderpart`
--

CREATE TABLE `orderpart` (
  `orderID` int(11) NOT NULL,
  `partNumber` int(11) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderpart`
--

INSERT INTO `orderpart` (`orderID`, `partNumber`, `quantity`) VALUES
(19, 8, 1),
(19, 10, 1),
(19, 15, 3),
(20, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `partNumber` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `partName` varchar(100) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `stockPrice` decimal(10,2) NOT NULL,
  `stockStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`partNumber`, `email`, `partName`, `stockQuantity`, `stockPrice`, `stockStatus`) VALUES
(1, 'on9@gmail.com', '1', 1, '123.00', 0),
(8, 'on9@gmail.com', 'testing', 13, '10.00', 1),
(10, 'on9@gmail.com', 'fuck', 4321, '1234.00', 1),
(15, 'on9@gmail.com', 'test', 4321, '123.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`dealerID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `FKOrders795865` (`dealerID`);

--
-- Indexes for table `orderpart`
--
ALTER TABLE `orderpart`
  ADD PRIMARY KEY (`orderID`,`partNumber`),
  ADD KEY `FKOrderPart106296` (`orderID`),
  ADD KEY `FKOrderPart737123` (`partNumber`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`partNumber`),
  ADD UNIQUE KEY `partName` (`partName`),
  ADD KEY `FKPart451022` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `partNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FKOrders795865` FOREIGN KEY (`dealerID`) REFERENCES `dealer` (`dealerID`);

--
-- Constraints for table `orderpart`
--
ALTER TABLE `orderpart`
  ADD CONSTRAINT `FKOrderPart106296` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`),
  ADD CONSTRAINT `FKOrderPart737123` FOREIGN KEY (`partNumber`) REFERENCES `part` (`partNumber`);

--
-- Constraints for table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `FKPart451022` FOREIGN KEY (`email`) REFERENCES `administrator` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
