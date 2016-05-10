<?php

require_once("../Include/stdinc.php");
require_once("../Include/booking.php");
require_once("../Include/flight.php");

session_start();
$stage1 = $_SESSION[Constants::$CHECKOUT_STAGE1_SESSION];

$givenName 		= strip_tags($stage1["givenName"]);
$familyName 	= strip_tags($stage1["familyName"]);
$addressLine1 	= strip_tags($stage1["addressLine1"]);
$addressLine2 	= strip_tags($stage1["addressLine2"]);
$suburb 		= strip_tags($stage1["suburb"]);
$state 			= strip_tags($stage1["state"]);
$postcode 		= strip_tags($stage1["postcode"]);
$country 		= strip_tags($stage1["country"]);
$country_code 	= strip_tags($stage1["country_code"]);
$email 			= strip_tags($stage1["email"]);
$businessPhone 	= strip_tags($stage1["businessPhone"]);
$workPhone 		= strip_tags($stage1["workPhone"]);
$mobilePhone 	= strip_tags($stage1["mobilePhone"]);

$country_code = strtoupper($country_code);

if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	die("Invalid E-Mail");

?>

<div id="contactFormSuccess">
	<img src="Style/UI/GreenSmiley.png" alt="Success!" />
	<span>Thank you!</span>
</div>

<script type="text/javascript">


</script>