<?php 
// May 12, 2014
// Clean data in for
	$userInfo = "";
	function keepItClean($userInfo)
		{		
			$userInfo = ltrim($userInfo);
			$userInfo = rtrim($userInfo);
			$userInfo = stripslashes($userInfo);
			$userInfo = strip_tags($userInfo);
			$userInfo = htmlentities($userInfo);
			$userInfo = preg_replace('#[^A-Za-z0-9.-_""@]#','', $userInfo);
			mysql_real_escape_string($userInfo);
			return($userInfo);	
		}

?>