
--
-- Database: `g3tMArv3LL3cOre`
--

-- --------------------------------------------------------

--
-- Table structure for table `core_pages`
--

CREATE TABLE IF NOT EXISTS `core_pages` (
  `corePages_Id` int(11) NOT NULL AUTO_INCREMENT,
  `corePages_N` int(4) NOT NULL,
  `corePages_U` varchar(100) NOT NULL,
  `corePages_SU` varchar(50) NOT NULL,
  PRIMARY KEY (`corePages_Id`),
  UNIQUE KEY `corePages_U` (`corePages_U`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `core_pages`
--

INSERT INTO `core_pages` (`corePages_Id`, `corePages_N`, `corePages_U`, `corePages_SU`) VALUES
(1, 1114, 'index.phtml', 'index'),
(2, 1115, 'about.phtml', 'about'),
(3, 1116, 'services.phtml', 'services'),
(4, 1117, 'products.phtml', 'products'),
(5, 1118, 'contact.phtml', 'contact'),
(6, 1119, 'login.phtml', 'login'),
(7, 1120, 'register.phtml', 'register'),
(8, 1121, 'privacy.phtml', 'privacy'),
(9, 1122, 'terms.phtml', 'terms'),
(10, 1123, 'socials.phtml', 'socials'),
(11, 1124, 'gallery.phtml', 'gallery'),
(12, 1125, 'clients.phtml', 'clients'),
(14, 1126, 'blog.phtml', 'blog'),
(15, 1127, 'vlog.phtml', 'vlog'),
(16, 1128, 'history.phtml', 'history'),
(17, 1129, 'video.phtml', 'video'),
(18, 1130, 'music.phtml', 'music'),
(19, 1131, 'admin.phtml', 'admin'),
(20, 1132, 'logout.phtml', 'logout');
