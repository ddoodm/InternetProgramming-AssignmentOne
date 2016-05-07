<?php

require_once("../Include/stdinc.php");
require_once("../Include/flight.php");
require_once("../Include/booking.php");

if(!isset($_GET["id"]))
	die("No ID");

if($_GET["id"] == "0")
	$id = 0;
else
	$id = filter_var($_GET["id"], FILTER_VALIDATE_INT) or die("Bad ID");

session_start();

// Load bookings from session
if(empty($_SESSION[Bookings::$BOOKINGS_SESSION_KEY]))
	die("No booking session data");
$bookings = $_SESSION[Bookings::$BOOKINGS_SESSION_KEY];

$bookings->remove($id);

// Clear session if there are no more bookings
if($bookings->isEmpty())
	session_destroy();

// Redirect to bookings page
header("Location: ../" . Constants::$PAGE_URL_MY_BOOKINGS);
die();

?>