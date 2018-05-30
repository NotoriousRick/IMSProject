<?php

/* Database credentials.*/
define('DB_SERVER', '192.168.2.100');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'dbIMS');

/* Attempt to connect to MySQL database.*/
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

/* Check connection.*/
if($link === false)
    {
    die("ERROR: Could not connect to database. " . mysqli_connect_error());
    }

?>