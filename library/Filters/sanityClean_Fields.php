<?php 
// May 5, 2014
//Create a function to clean field data before db submission
function sanityClean($fldVar)
		{
			//$fldVar = trim($fldVar);
			//$fldVar = ltrim($fldVar);
			//$fldVar = rtrim($fldVar);
			$fldVar = stripslashes($fldVar);
			$fldVar = strip_tags($fldVar);
			$fldVar = htmlentities($fldVar);
			$fldVar = htmlspecialchars($fldVar);
			$fldVar = preg_replace('#[^A-Za-z0-9.-_" "@]#', '', $fldVar);
			$fldVar = mysql_real_escape_string($fldVar);			
			return ($fldVar);			
		}		
function sanityClean_PropFld($fldVar)
		{
			$fldVar = trim($fldVar);
			$fldVar = stripslashes($fldVar);
			$fldVar = strip_tags($fldVar);
			$fldVar = htmlentities($fldVar);
			$fldVar = htmlspecialchars($fldVar);
			$fldVar = preg_replace('#[^A-Za-z0-9]#', '', $fldVar);
			$fldVar = mysql_real_escape_string($fldVar);					
			return ($fldVar);			
		}
function sanityClean_Len_BasicFlds($fldVar) // zip code and building number field length checker
		{
			$fldVar = strlen(($fldVar) < 3);  // field info less than 3
			$fldVar = strlen(($fldVar) > 55);  // field info greater than 55
			return ($fldVar);	
		}		
function sanityClean_Len_ZipBldNumb($fldVar) // zip code and building number field length checker
		{
			$fldVar = strlen(($fldVar) < 3);  // field info less than 3
			$fldVar = strlen(($fldVar) > 6);  // field info greater than 6
			return ($fldVar);	
		}
function sanityClean_Apart_Length($fldVar) // apartment field length checker
		{
			$fldVar = strlen(($fldVar) < 1);  // field info less than 1
			$fldVar = strlen(($fldVar) > 5);  // field info greater than 5
			return ($fldVar);	
		}
// September 1st 2014, this function sanityClean_Email throws a serious error
// probably the preg_match code, do not use.
/*
function sanityClean_Email($fldVar){
			$fldVar = ltrim($fldVar);
			$fldVar = rtrim($fldVar);
			$fldVar = stripslashes($fldVar);
			$fldVar = strip_tags($fldVar);
			//$fldVar = htmlentities($fldVar);
			$fldVar = preg_replace('#[^A-Za-z0-9.-_""@]#', '',  $fldVar);
			mysql_real_escape_string($fldVar);	
			if(!preg_match("/\b@\b/", '',  $fldVar)){	
				// Check Email Format 
				$errMsg = "Email Format Not Recognized";
				exit();
			}
				return ($fldVar);			
}*/
function sanityClean_Bd($fldVar)// For Birthday Preg Match function
		{
			$fldVar = trim($fldVar);
			$fldVar = stripslashes($fldVar);
			$fldVar = strip_tags($fldVar);
			$fldVar = htmlentities($fldVar);
			$fldVar = preg_replace('#[^A-Za-z0-9.-_""@]#', '',  $fldVar);
			$fldVar = preg_match('', $fldVar);
			mysql_real_escape_string($fldVar);			
			return ($fldVar);			
		}	
		
?>