<?php

define("DBURL","[empty]");

define("DBUSR","[empty]");

define("DBPWD","[empty]");

define("DBNAM","[empty]");

if( (DBURL == "[empty]") or
    (DBURL == "[empty]") or
    (DBURL == "[empty]") or
    (DBURL == "[empty]")){
    echo "Before testing this website locally, please fill out the database variables in the database.php file.";
    exit();
}

?>