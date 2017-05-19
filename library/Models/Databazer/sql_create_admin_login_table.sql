--
-- Database: `g3tMArv3LL3cOre`
--

-- --------------------------------------------------------

--
-- Table structure for table `hgmAdminMembers`
--

CREATE TABLE IF NOT EXISTS `admin_members` (
  `adminMem_Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adminMem_Fname` varchar(50) NOT NULL,
  `adminMem_Lname` varchar(50) NOT NULL,
  `adminMem_PromoNumb` varchar(50) NOT NULL,
  `adminMem_E1` varchar(50) NOT NULL,
  `adminMem_Pw` varchar(15) NOT NULL,
  `adminMem_Account` enum('A','NA') NOT NULL,
  `adminMem_Date` varchar(25) NOT NULL,
  PRIMARY KEY (`adminMem_Id`),
  UNIQUE KEY `adminMem_E1` (`adminMem_E1`)
)