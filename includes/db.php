<?php

// alternate way to connect database
//
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

foreach ($db as $key => $value) {
	# code...
	define(strtoupper($key), $value);
	// strtoupper return every key of $db array as value
	// and return as a upper case value
	// also define them as their predefined name
	// for ex: 'db_host' returns as DB_HOST
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection) {

	echo "Connected";
}

/*
// Common way to connect database

$connection = mysqli_connect('localhost','root','','cms');

if($connection) {

	echo "Connected";
}
*/
?>