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

$cardType		= strip_tags($_POST["cardType"]);
$cardImage		= "Images/" . $cardType . ".png";

?>
<h3>Complete your Booking - Stage 3 of 4</h3>
<h2>Review your Details ...</h2>
<table>
	<tr><td>Given Name</td><td><?php echo $givenName; ?></td></tr>
	<tr><td>Family Name</td><td><?php echo $familyName; ?></td></tr>
	<tr><td>Address</td><td><?php echo $addressLine1; ?></td></tr>
	<tr><td></td><td><?php echo $addressLine2; ?></td></tr>
	<tr><td>Suburb</td><td><?php echo $suburb; ?></td></tr>
	<tr><td>State</td><td><?php echo $state; ?></td></tr>
	<tr><td>Postcode</td><td><?php echo $postcode; ?></td></tr>
	<tr><td>Country</td><td><?php echo $country." (".$country_code.")"; ?></td></tr>
	<tr><td>E-Mail</td><td><?php echo $email; ?></td></tr>
	<tr><td>Phone Numbers</td><td>
	<?php
		$phones = array($businessPhone, $workPhone, $mobilePhone);
		for($i = 0; $i < sizeof($phones); $i++)
			if(empty($phones[$i]))
				unset($phones[$i]);
		echo implode(", ", $phones);
	?></td></tr>
	<tr>
		<td>Payment Method</td>
		<td>Details Supplied<br />
			<img alt="<?php echo $cardType;?>" src="<?php echo $cardImage;?>" /></td></tr>
</table>

<h2>Review your Bookings ...</h2>
<div class="confirmDetailsBox" style="margin:0;">
  <?php
    $bookings = $_SESSION[Bookings::$BOOKINGS_SESSION_KEY];
    echo $bookings->printList(false);
  ?>

  <h3>Total Price: <?php echo $bookings->get_totalPrice_formatted(); ?></h3>
</div>

<h2>Complete your Order ...</h2>

<button class="neutralButton" id="button_back">&lt; Stage 1</button>
<button class="lumpyButton" id="button_placeOrder">Place Order &gt;</button>

<script type="text/javascript">

$("#button_back").click(function(event)
{
	event.preventDefault();
	loadCheckoutStage(1);
});

$("#button_placeOrder").click(function(event)
{
	event.preventDefault();
	loadCheckoutStage(4);
});

</script>