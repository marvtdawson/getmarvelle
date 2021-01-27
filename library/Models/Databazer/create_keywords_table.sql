--
-- Database: `g3tMArv3LL3cOre`
--

-- --------------------------------------------------------

--
-- Table structure for table `k3yWOrdz`
--

CREATE TABLE IF NOT EXISTS `k3yWOrdz` (
  `reg_Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keywords_Type` ENUM('corePages', 'cPanPages') NOT NULL,
  `page_Keywords` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`reg_Id`),
  UNIQUE KEY `reg_Id` (`reg_Id`)
)




