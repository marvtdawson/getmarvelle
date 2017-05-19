<?php 
// This file is for State Swapping on 9/22/2014.
/*
function stateSwapper($swapState){
	
	$statePost = array("Alabama","Alaska","California","Minnesota");
	
	$stateVars = array("wl_aflz_Alabama","wl_aflz_Alaska","wl_aflz_California","wl_aflz_Minnesota");	
	
	$swapState = str_ireplace($statePost, $stateVars, $swapState);
	return $swapState;	
}
*/
#####################################################################################################
if(!empty($wlRP_S)){		
	    			switch($wlRP_S):
							case "Alabama":
									$wl_aflzState = "wl_aflz_Alabama";													
										break;							
							case "Alaska":
									$wl_aflzState = "wl_aflz_Alaska";											
										break;									
							case "Arizona":
									$wl_aflzState = "wl_aflz_Arizona";													
										break;	
							case "Arkansas":
									$wl_aflzState = "wl_aflz_Arkansas";													
										break;
							case "California":
									$wl_aflzState = "wl_aflz_California";											
										break;									
							case "Colorado":
									$wl_aflzState = "wl_aflz_Colorado";													
										break;	
							case "Connecticut":
									$wl_aflzState = "wl_aflz_Connecticut";													
										break;	
							case "Delaware":
									$wl_aflzState = "wl_aflz_Delaware";													
										break;	
							case "District of Columbia":
									$wl_aflzState = "wl_aflz_DC";													
										break;				
							case "Florida":
									$wl_aflzState = "wl_aflz_Florida";													
										break;	
							case "Georgia":
									$wl_aflzState = "wl_aflz_Georgia";													
										break;	
							case "Hawaii":
									$wl_aflzState = "wl_aflz_Hawaii";													
										break;	
							case "Idaho":
									$wl_aflzState = "wl_aflz_Idaho";													
										break;				
							case "Illinois":
									$wl_aflzState = "wl_aflz_Illinois";													
										break;	
							case "Indiana":
									$wl_aflzState = "wl_aflz_Indiana";													
										break;	
							case "Iowa":
									$wl_aflzState = "wl_aflz_Iowa";													
										break;
							case "Kansas":
									$wl_aflzState = "wl_aflz_Kansas";													
										break;	
							case "Kentucky":
									$wl_aflzState = "wl_aflz_Kentucky";													
										break;	
							case "Louisiana":
									$wl_aflzState = "wl_aflz_Louisiana";													
										break;	
							case "Maine":
									$wl_aflzState = "wl_aflz_Maine";													
										break;	
							case "Maryland":
									$wl_aflzState = "wl_aflz_Maryland";													
										break;				
							case "Michigan":
									$wl_aflzState = "wl_aflz_Michigan";													
										break;	
							case "Minnesota":
									$wl_aflzState = "aflz_Minnesota_Propz";													
										break;	
							case "Mississippi":
									$wl_aflzState = "wl_aflz_Mississippi";													
										break;
							case "Missouri":
									$wl_aflzState = "wl_aflz_Missouri";													
										break;	
							case "Montanna":
									$wl_aflzState = "wl_aflz_Montanna";													
										break;	
							case "Nebraska":
									$wl_aflzState = "wl_aflz_Nebraska";													
										break;	
							case "Nevada":
									$wl_aflzState = "wl_aflz_Nevada";													
										break;				
							case "New Hampshire":
									$wl_aflzState = "wl_aflz_New_Hampshire";													
										break;	
							case "New Jersey":
									$wl_aflzState = "wl_aflz_New_Jersey";													
										break;	
							case "New Mexico":
									$wl_aflzState = "wl_aflz_New_Mexico";													
										break;
							case "New York":
									$wl_aflzState = "wl_aflz_New_York";													
										break;	
							case "North Carolina":
									$wl_aflzState = "wl_aflz_North_Carolina";													
										break;	
							case "North Dakota":
									$wl_aflzState = "wl_aflz_North_Dakota";													
										break;
							case "Ohio":
									$wl_aflzState = "wl_aflz_Ohio";													
										break;	
							case "Oklahoma":
									$wl_aflzState = "wl_aflz_Oklahoma";													
										break;
							case "Oregon":
									$wl_aflzState = "wl_aflz_Oregon";													
										break;	
							case "Pennsylannia":
									$wl_aflzState = "wl_aflz_Pennsylannia";													
										break;	
							case "Rhode Island":
									$wl_aflzState = "wl_aflz_Rhode_Island";													
										break;	
							case "South Carolina":
									$wl_aflzState = "wl_aflz_South_Carolina";													
										break;	
							case "South Dakota":
									$wl_aflzState = "wl_aflz_South_Dakota";													
										break;	
							case "Tennessee":
									$wl_aflzState = "wl_aflz_Tennessee";													
										break;
							case "Texas":
									$wl_aflzState = "wl_aflz_Texas";													
										break;	
							case "Utah":
									$wl_aflzState = "wl_aflz_Utah";													
										break;	
							case "Vermont":
									$wl_aflzState = "wl_aflz_Vermont";													
										break;
							case "Virginia":
									$wl_aflzState = "wl_aflz_Virginia";													
										break;	
							case "Washington":
									$wl_aflzState = "wl_aflz_Washington";													
										break;
							case "West Virginia":
									$wl_aflzState = "wl_aflz_West_Virginia";													
										break;	
							case "Wisconsin":
									$wl_aflzState = "wl_aflz_Wisconsin";													
										break;	
							case "Wyoming":
									$wl_aflzState = "wl_aflz_Wyoming";													
										break;																																
							endswitch;	
} // close if !empty($wlRP_S)
?>