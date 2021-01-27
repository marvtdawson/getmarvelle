--
-- Database: `g3tMArv3LL3cOre`
--

-- --------------------------------------------------------

--
-- Table structure for table `regmember`
--

CREATE TABLE IF NOT EXISTS `regmember` (
  `regMem_Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `regMem_Type` varchar(25) NOT NULL,
  `regMem_Fname` varchar(50) NOT NULL,
  `regMem_Lname` varchar(50) NOT NULL,
  `regMem_Aname` varchar(50) NOT NULL,
  `regMem_E1` varchar(50) NOT NULL,
  `regMem_E2` varchar(50) NOT NULL,
  `regMem_Pw` varchar(15) NOT NULL,
  `regMem_Account` enum('A','NA') NOT NULL,
  `regMem_Date` varchar(25) NOT NULL,
  PRIMARY KEY (`regMem_Id`),
  UNIQUE KEY `regMem_E1` (`regMem_E1`)
)




