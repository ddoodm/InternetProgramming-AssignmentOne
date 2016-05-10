<?php

require_once("../Include/stdinc.php");
require_once("../Include/booking.php");
require_once("../Include/flight.php");

session_start();

if(!isset($_SESSION[Bookings::$BOOKINGS_SESSION_KEY]))
	die("<h3>Sorry! Your session has expired.</h3>");

$bookings = $_SESSION[Bookings::$BOOKINGS_SESSION_KEY];

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

// Configure the E-Mail
$subject	= "$givenName, your Bookings with Interprog Travel";

// Configure additional 'from' headers
$mailHeaders  = "From: sales@ddoodm.com\r\n";
$mailHeaders .= "Reply-To: sales@ddoodm.com\r\n";
$mailHeaders .= 'X-Mailer: PHP/' . phpversion();

// Configure HTML mail
$mailHeaders .= 'MIME-Version: 1.0' . "\r\n";
$mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Message (format)
$messageFormat =
"
<html>
	<body>
		<h1>Interprog Travel</h1>
		<h2>Thank you for your order, $givenName!</h2>
		<p>Your recent bookings with Interprog Travel have been processed.</p>
		<h2>Your Details</h2>
		<p>
			$givenName $familyName,<br/>
			$addressLine1<br />
			$addressLine2<br />
			%s<br />
			$country ($country_code)
		</p>
		<h2>Your Bookings</h2>
		<div style='background: #F8F8F8; width: 500px; margin: 25px; padding: 25px;'>
			%s
			<h3>Total Cost: %s</h3>
		</div>
	</body>
</html>
";

// Format the message
$mailMessage = sprintf(
	$messageFormat,
	empty($suburb . $state)? "" : "$suburb $state",
	$bookings->printList(false),
	$bookings->get_totalPrice_formatted());

// Deliver the E-Mail
$deliverySuccess = mail($email, $subject, $mailMessage, $mailHeaders);

// Finally, clear the session
session_destroy();

?>

<div id="contactFormSuccess">
	<img src="Style/UI/GreenSmiley.png" alt="Success!" />
	<span>Thank you!</span>
</div>

<p>
	Thank you for your business; we hope you enjoy your journey!
</p>

<?php if(!$deliverySuccess) { ?>
	<h2>E-Mail Delivery Failed! :O</h2>
<?php } else { ?>
	<p>
		We have delivered an E-Mail to your E-Mail address (<?php echo $email; ?>) detailing all of your booking information. Please retain it as a receipt. 
	</p>
<?php } ?>

<button class="neutralButton" onclick="location.href='index.php';">
	BACK TO HOME
</button>

<script type="text/javascript">

</script>