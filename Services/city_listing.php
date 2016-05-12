<?php

// 'stdinc' for JSON encoder
require_once("../Include/stdinc.php");

// Search term is 'term' GET parameter
if(!isset($_GET['term'])) die();

// Connect to the database ($sqli)
require_once("../Include/database_connect.php");

// Filter input parameter
$term = $sqli->escape_string($_GET["term"]);

$query = 
"SELECT to_city
FROM flights
WHERE to_city LIKE '%$term%'
UNION
SELECT from_city
FROM flights
WHERE from_city LIKE '%$term%'";

$result = $sqli->query($query);

// Print errors
if($sqli->errno)
{	echo $sqli->error . " --IN QUERY-- " . $query;	exit();	}

// Store result into an array
$arrayResult = array();
while($row = $result->fetch_array())
	array_push($arrayResult, $row[0]);

// Output the array as JSON
header('Content-Type: application/json');
echo DJsonHelper::json_encode($arrayResult);
die();

?>