<?php


$kony_sql = "CREATE DB burginconstruct
    (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";


$kony = new mysqli($wl_host, $wl_adminUser, $wl_adminEntry, $wl_Db);

// check connection
if($kony->connect_error){
    die("Connection failed: " . $kony->connect_error);
}


if($kony->query($kony_sql) === TRUE){
    echo "Database created successfully";
}
else{
    echo "Error while trying to create database: " . $kony->error;
}


$kony->close();


include_once 'wl_iScripts/iKony_Admin.php';

echo "hello";

echo "HI";

// Check connection
if (mysqli_connect_errno($wl_connect2_AdminDb))
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
    echo "You are connected";
}


/*
if(mysqli_num_rows(mysqli_query($wl_adminDb, "SHOW TABLES LIKE 'adminMembers'")) == 1){
     echo "You found the table";
}else{
    echo "You did not find the table";
}
*/

$show_table = mysqli_query($wl_adminDb, "SHOW TABLES LIKE adminMembers") or die(mysqli_error("LIKE NO TABLE NAME FOUND"));



while($row = mysqli_fetch_array($show_table)){

    if($row == $show_table){
        echo "You found the table";
    }
    else{
        echo "You did not find the table";
    }

} 


/*$adminMember_table =  adminMembers;

$sql_table_checker = "select * from $adminMember_table";

 while($row = mysqli_query($sql_table_checker)){
    
    if($row == $adminMember_table){
        echo "You found the table";
    }
    else{
        echo "You did not find the table";
    }
    
} */

?>