<?php

// Database configuration
define ('DB_HOST', "localhost");
define ('DB_USER', "potiro");
define ('DB_PASSWORD', "pcXZb(kL");
define ('DB_DATABASE', "poti");

// Connect to the POTI database
$sqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

// Check connection
if($sqli->connect_errno)
{
	printf("Failed to connect to the database: %s\n", $sqli->connect_error);
	exit();
}

?>