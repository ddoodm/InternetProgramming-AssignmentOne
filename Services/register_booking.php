<?php

require_once("../Include/stdinc.php");
require_once("../Include/database_connect.php");
require_once("../Include/flight.php");
require_once("../Include/booking.php");

if(	!isset($_POST["seatCount"]) ||
	!isset($_POST["route_no"]))
	die("Missing parameter(s)");

$route_no = filter_var($_POST["route_no"], FILTER_VALIDATE_INT) or die("Bad route_no");
$seatCount = filter_var($_POST["seatCount"], FILTER_VALIDATE_INT) or die("Bad seatCount");

// Create the booking
$flight = Flight::CreateFromRouteNo($sqli, $route_no);
$booking = new Booking($flight, $seatCount);

// Update seat preferences
for($i = 0; $i < $booking->get_seatCount(); $i++)
{
	if(isset($_POST["wheelchair_".$i]))	$booking->seats[$i]->wheelchair = true;
	if(isset($_POST["child_".$i]))		$booking->seats[$i]->child 		= true;
	if(isset($_POST["diet_".$i]))		$booking->seats[$i]->diet 		= true;
}

session_start();

// Load from session / create bookings collection
if(empty($_SESSION[Bookings::$BOOKINGS_SESSION_KEY]))
	$bookings = new Bookings();
else
	$bookings = $_SESSION[Bookings::$BOOKINGS_SESSION_KEY];

// Add new booking to collection
$bookings->add($booking);

// Save bookings
$_SESSION[Bookings::$BOOKINGS_SESSION_KEY] = $bookings;

// Redirect to bookings page
header("Location: ../" . Constants::$PAGE_URL_MY_BOOKINGS);
die();

?>