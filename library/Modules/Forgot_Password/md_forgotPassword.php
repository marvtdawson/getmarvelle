<?php
session_start(); // start session control for continual log in
                 
// Initiate all necessary variables
$errMsg = "";
$md_E = $_POST['md_Email'];

if (isset($md_E)) { // Check to see if the field are set
    
    if (empty($md_E)) // Check to see if Email field is not empty
{
        $errMsg = "Please Enter Your Email";
    } 

    elseif (! empty($md_E)) { // If both fields have content continue
                           
        // Clean data
        $md_E = htmlentities($md_E); // clean all htlm markup language from field
        $md_E = strip_tags($md_E); // strip any open tags from field
        $md_E = stripslashes($md_E); // strip any slashes from field
                                     // mysql_real_escape_string($cf_Email);
        
        require_once 'bcKnxs/bcHolePunch.php'; // include file to connect to database
                                               
        // Create database query to check that info enter into the fields match what is in the database
                                               // Instead of checking for one field (email & password) at a time,
                                               // the code checks that both fields info matches what is in the database at the same time
        $bc_InDb = mysql_query("SELECT * FROM mc_Clients WHERE md_cEmail='$md_E' LIMIT 1");
        $bcInfo_Chkr = mysql_num_rows($bc_InDb); // initate variable for table row
        
        if ($bcInfo_Chkr < 1) { // if no info was in the database table
            $errMsg = "Sorry That Info Was Not Found";
        } elseif ($bcInfo_Chkr == 1) { // else if info is in the database table get all info and set them into a SESSION variable
            
            while ($rows = mysql_fetch_array($bc_InDb)) { // while loop checks each column in database table row.
                                                        
                // Set all info in database table rows into session.
                
                $bc_val_E = $rows['bc_Admin_E'];
                // $_SESSION['bc_E'] = $bc_val_E;
                
                $bc_val_F = $rows['bc_Admin_Fn'];
                $_SESSION['bc_Fn'] = $bc_val_F;
                
                $bc_val_P = $rows['bc_Admin_P'];
                $_SESSION['bc_P'] = $bc_val_P;
                
                $bc_val_D = $rows['bc_Admin_D'];
                $_SESSION['bc_Date'] = $bc_val_D;
                
                $to = "$bc_val_E";
                $from = "auto_responder@burginconstructionmn.com";
                $subject = 'Burgin Construction Password Request';
                $message = '<!DOCTYPE html>
					<html>
					<head><meta charset="utf-8">
					<title>' . $bc_val_F . '\'s Password</title>
					</head>
					<body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;">
					<div style="padding:24px; font-size:17px;">
                    <div><img src="http://www.burginconstruction.com/images/BClogo_32x32.fw.png"> Burgin Construction MN</div><br />					
					Hello <font color="#FF0000">' . $bc_val_F . '</font>,<br /><br />
					You requested your password.<br /><br />
					Your password is: <font color="#FF0000">' . $bc_val_P . '</font><br /><br />
					If you received this message by error and you did not request your password,<br />
					please contact the Burgin Construction web site administrator immediately regarding this website request<br />
					at mdawson@burginconstructionmn.com<br /><br />
					Thank you,<br /><br />
					To log in now, <a href="http://www.burginconstructionmn.com/bcMn_Admin.php">Click Here</a><br /><br />					
                    <div align="center">A Burgin Construction MN LLC Company &copy; 2013</div>
                    </div>
					</body>
					</html>';
                
                $headers = "From: $from\n";
                $headers .= "MIME-Version: 1.0\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\n";
                mail($to, $subject, $message, $headers);
                
                mysql_close(); // close mysql_close
                               
                // Begin HTML message
                $passMsg = '
							<div style="padding:12px; font-size:17px;">
							Hello <font color="#FF0000">' . $bc_val_F . '</font>,<br /><br />
							We just sent your password to your email address at <font color="#FF0000"> ' . $bc_val_E . '</font>.<br /><br />	
							Please log into your email account to retrieve your password.<br /><br /> 
							Thank you,								
							</div>';
                // End Message
                
                // include html page to show above message.
                header("location: resltMessage.php");
            } // close while
                  
            // info was found and confirm therefore send the user to the control panel page
                  // header("location: http://www.marvintdawson.com/cfMinistries/cfAdmin.php");
        } // close else if
    } // close elseif(!empty($cf_Email) && !empty($cf_Pass))
} // close if (isset($cf_Email) && isset($cf_Pass))
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password Request</title>
<link rel="shortcut icon" href="images/BCfav_icon.ico"
	type="image/x-icon" />
<link rel="icon" href="images/BCfav_icon.ico" type="image/x-icon" />
<link href="css/bcMainCss.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<!-- Start Mast Head --------------------->
<?php include_once "HdFt/hd_2.php" ;?>
<!-- #end mast head 
---------------->
	<!-- Start Page Title Bar --------------->
<?php include_once "title_Bar.php" ;?>
<!-- #end page title bar
 ----------------->
	<table width="900" height="400" align="center">
		<tr>
			<div style="margin-top: 20px">
				<td align="left" valign="top"><br /> <span
					class="client_page_txt_color">Forgot Password</span><br /> <br />
					<div>
						<font color="#FF0000" style="margin-top: 25px"><?php echo $errMsg ?></font>
					</div> <br />
					<div align="left">
						<!-- Create Form -->
						<form action="md_forgotPassword.php" method="post">
							<span class="client_page_txt_color">Email:</span> <input
								name="md_Email" type="text" id="md_Email"
								placeholder=" ex: john_doe@yahoo.com"
								value="<?php echo $md_E ?>" size="25" /> <br /> <br />

							<div align="left">
								<input type="submit" value="Get Password" />
							</div>
						</form>
						<!-- Close Form -->
					</div></td>
			</div>
		</tr>
	</table>
	<!-- #end Page Content 
-------------->
	<!-- INSERT PAGE FOOTER-->
<?php include_once "HdFt/ft.php"; ?>
<!-- #end page footer 
---------------->
</body>
</html>