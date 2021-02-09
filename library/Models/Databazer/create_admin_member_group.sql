--
-- Database: `g3tMArv3LL3cOre`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `admin_member_group` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

<<<<<<< HEAD:library/Models/Databazer/sql_create_admin_member_group.sql
INSERT INTO `admin_member_group` (`id`, `name`, `permissions`) VALUES
(1, 'Standard_user', ''),
=======
INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard_User', ''),
>>>>>>> 8c02697de2afbf901a1dc48687c844693b3820d1:library/Models/Databazer/create_admin_member_group.sql
(2, 'Administrator', '{"admin": 1}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
