<?php

$kony= "";
$kony_sql = "CREATE DB g3tMArv3LL3cOre";

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
?>