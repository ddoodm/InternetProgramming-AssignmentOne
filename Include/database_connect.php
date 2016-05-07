<?php

// Database configuration
define ('DB_HOST', "localhost");
define ('DB_USER', "potiro");
define ('DB_PASSWORD', "pcXZb(kL");
define ('DB_DATABASE', "poti");

// Connect to the POTI database
// UTS has an issue with their MySQL installation,
// so we need to suppress warnings.
$err_level = error_reporting(0);  
$sqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
error_reporting($err_level); 

// Check connection
if($sqli->connect_errno)
{
	printf("Failed to connect to the database: %s\n", $sqli->connect_error);
	exit();
}

?>