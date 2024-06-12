<?php
$dbhost      =   "localhost";
$dbuser      =   "ayeshmantha";
$dbpassword  =   "111111";
$dbname      =   "pureride _tours";

$connection =   mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$connection) {
    echo "Error";
}
