<?php
include "functions.php";
session_start();

setlocale(LC_ALL, 'nld_nld');
    // Login configuration

    $conf["Username"]= 'Vlad';
    $conf["Password"]= 'ihatesushi';
    $conf["Host"]= 'localhost';
    $conf["Database"]= "dbims";

    // Connect with the server
    $mysqli = mysqli_connect($conf["Host"], $conf["Username"], $conf["Password"], $conf["Database"]);
    $db = new PDO('mysql:dbname=dbims;host:localhost;', 'Vlad', 'ihatesushi');

    // If connection fails
    if($mysqli == false)
    {
        echo "Can't establish connection with the database server";
    }

