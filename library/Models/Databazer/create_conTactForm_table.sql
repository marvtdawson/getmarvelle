CREATE TABLE IF NOT EXISTS `conTactForm` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_Name` varchar(50) NOT NULL,
  `contact_Email` varchar(50) NOT NULL,
  `contact_State` varchar(25) NOT NULL,
  `contact_City` varchar(50) NOT NULL,
  `contact_Message` varchar(255) NOT NULL,
  `contact_Month` varchar(25) NOT NULL,
  `contact_Day` varchar(45) NOT NULL,
  `contact_Year` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1