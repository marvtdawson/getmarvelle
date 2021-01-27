--
-- Database: `g3tMArv3LL3cOre`
--

-- --------------------------------------------------------

--
-- Table structure for table `system_forms`
--

CREATE TABLE IF NOT EXISTS `system_forms` (
  `sys_form_id` int(11) NOT NULL AUTO_INCREMENT,
  `sys_form_number` varchar(50) NOT NULL,
  `sys_form_name` varchar(50) NOT NULL,
  `sys_form_uri` varchar(50) NOT NULL,
  `sys_form_pretty_uri` varchar(50) NOT NULL,
  `sys_form_pre` varchar(10) NOT NULL,
  `sys_form_suf` varchar(10) NOT NULL,
  PRIMARY KEY (`sys_form_id`),
  UNIQUE KEY `sys_form_uri` (`sys_form_uri`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `system_forms`
--

INSERT INTO `system_forms` (`sys_form_id`, `sys_form_number`, `sys_form_name`, `sys_form_uri`, `sys_form_pretty_uri`, `sys_form_pre`, `sys_form_suf`) VALUES
(1, '20', 'test_form', 'testForm.php', 'testForm', '$test94', 'd8&test'),
(2, '21', 'admin_Form', 'admin_login.php', 'admin_login', '', ''),
(3, '22', 'contact_Form', 'contact.php', 'contact', '', ''),
(4, '23', 'login_Form', 'login.php', 'login', '', ''),
(5, '24', 'register_Form', 'register.php', 'register', '', ''),
(6, '25', 'subscribe_Form', 'subscribe.php', 'subscribe', '', ''),
(7, '26', 'forgot_password_Form', 'forgot_password.php', 'forgot_password', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
