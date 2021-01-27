CREATE TABLE `syst3mForms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sys_form_number` varchar(50) NOT NULL,
  `sys_form_name` varchar(50) NOT NULL,
  `sys_form_uri` varchar(50) NOT NULL,
  `sys_form_pretty_uri` varchar(50) NOT NULL,
  `sys_form_pre` varchar(10) NOT NULL,
  `sys_form_suf` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sys_form_uri` (`sys_form_uri`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1