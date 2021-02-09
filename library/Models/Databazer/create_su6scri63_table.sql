CREATE TABLE IF NOT EXISTS `su6scri63` (
  `id` int(15) DEFAULT NULL,
  `memId` int(15) DEFAULT NULL,
  `memName` varchar(100) DEFAULT NULL,
  `memEmail` varchar(100) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `subscriptionStatus` enum('S','UNS') DEFAULT NULL,
  `signupMonth` varchar(25) DEFAULT NULL,
  `signupDay` varchar(25) DEFAULT NULL,
  `signupYear` varchar(25) DEFAULT NULL,
  `unsubcribeMonth` varchar(25) DEFAULT NULL,
  `unsubscribeDay` varchar(25) DEFAULT NULL,
  `unsubscribeYear` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='blog, vlog, show subscriptions'