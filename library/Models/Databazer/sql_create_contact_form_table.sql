--
-- Database: `g3tMArv3LL3cOre`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_Form`
--

CREATE TABLE IF NOT EXISTS `contact_Form` (
  `contact_Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_FirstName` varchar(50) NOT NULL,
  `contact_LastName` varchar(50) NOT NULL,
  `contact_Email` varchar(50) NOT NULL,
  `contact_State` varchar(25) NOT NULL,
  `contact_City` varchar(50) NOT NULL,
  `contact_Message` varchar(255) NOT NULL,
  `contact_Date` varchar(25) NOT NULL,
  PRIMARY KEY (`contact_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;