<?php
include "functions.php";
session_start();

setlocale(LC_ALL, 'nld_nld');
    // Login configuration

    $conf["Username"]= '';
    $conf["Password"]= '';
    $conf["Host"]= 'localhost';
    $conf["Database"]= "dbims";

    // Connect with the server
    $mysqli = mysqli_connect($conf["Host"], $conf["Username"], $conf["Password"], $conf["Database"]);
    $db = new PDO('mysql:dbname=dbims; host:localhost;', $conf["Username"], $conf["Password"]);

    // If connection fails
    if($mysqli == false)
    {
        echo "Can't establish connection with the database server";
    }
    if ($db == false){
        echo "nope, something went wrong";
    }
	
		

