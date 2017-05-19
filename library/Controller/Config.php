<?php

// class is for db connections
class Config{
	
	public static function get($path = null)
	{
		if($path)
		{
			$config = $GLOBALS['config'];			
			$path = explode('/', $path);
			
			//print_r($path);
			
			foreach ($path as $bit)
			{
				// test $bit
				// echo '$bit';
			
				if(isset($config[$bit])){
					
					//test $bit inside the if
					// echo '$bit';
					
					$config = $config[$bit];
				}
			}
			
				return $config;
		
		}
		
			return false;
	}
	
}

?>