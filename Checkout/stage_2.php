<?php

require_once("../Include/stdinc.php");
require_once("../Include/booking.php");
require_once("../Include/flight.php");

if(
	empty($_POST["givenName"]) ||
	empty($_POST["familyName"]) || 
	empty($_POST["addressLine1"]) || 
	empty($_POST["suburb"]) || 
	empty($_POST["country"]) || 
	empty($_POST["email"]))
{
	die("Missing required POST parameters:<br />" . var_dump($_POST));
}

$givenName 		= strip_tags($_POST["givenName"]);
$familyName 	= strip_tags($_POST["familyName"]);
$addressLine1 	= strip_tags($_POST["addressLine1"]);
$addressLine2 	= strip_tags($_POST["addressLine2"]);
$suburb 		= strip_tags($_POST["suburb"]);
$state 			= strip_tags($_POST["state"]);
$postcode 		= strip_tags($_POST["postcode"]);
$country 		= strip_tags($_POST["country"]);
$country_code 	= strip_tags($_POST["country_code"]);
$email 			= strip_tags($_POST["email"]);
$businessPhone 	= strip_tags($_POST["businessPhone"]);
$workPhone 		= strip_tags($_POST["workPhone"]);
$mobilePhone 	= strip_tags($_POST["mobilePhone"]);

$country_code = strtoupper($country_code);

if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	die("Invalid E-Mail");

session_start();
$_SESSION[Constants::$CHECKOUT_STAGE1_SESSION] = $_POST;

?>
<h3>Complete your Booking - Stage 2 of 4</h3>
<p>Please review your details...</p>
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
</table>

<h3>Payment Details</h3>

<form id="form_stage2" action="Checkout/stage_3.php">
	<table>
		<tr>
			<td>Card Type</td>
			<td>
				<label class="imageRadio">
					<input type="radio" name="cardType" value="visa" checked />
					<img alt="Visa" src="Images/visa.png" />
				</label>
				<label class="imageRadio">
					<input type="radio" name="cardType" value="diners" />
					<img alt="Diners" src="Images/diners.png" />
				</label>
				<label class="imageRadio">
					<input type="radio" name="cardType" value="mastercard" />
					<img alt="Mastercard" src="Images/mastercard.png" />
				</label>
				<label class="imageRadio">
					<input type="radio" name="cardType" value="amex" />
					<img alt="American Express" src="Images/amex.png" />
				</label>
			</td>
		</tr>
		<tr>
			<td>Card Details</td>
			<td>
				<input required
				type="text"
				id="cardNumber" name="cardNumber"
				pattern="\d{12,}" title="Please enter a 12-digit card number" maxlength="12"
				placeholder="Card Number">
				<b class='requiredMarker'>*</b></td>
		</tr>
		<tr>
			<td></td>
			<td><input required type="text" id="nameOnCard" name="nameOnCard" placeholder="Cardholder Name"><b class='requiredMarker'>*</b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input required style="width: 30%;" type="number"
				id="expiryMonth" name="expiryMonth"
				maxlength="2" min="1" max="12"
				placeholder="Expiry Month">
				&nbsp;/&nbsp;
				<input required style="width: 30%;" type="number"
				id="expiryYear" name="expiryYear"
				maxlength="4" min="1"
				placeholder="Expiry Year">
				<b class='requiredMarker'>*</b>
				<p id="expiryFeedback" style="display: none; color: #F00;"></p>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input required
				style="width: 30%;" type="text"
				maxlength="3" size="3"
				pattern="\d{3,}" title="Please enter a 3-digit CVV"
				id="securityCode" name="securityCode"
				placeholder="Security Code">
				<b class='requiredMarker'>*</b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button class="neutralButton" id="button_back">&lt; Back</button>
				<button class="lumpyButton">Stage 3 &gt;</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">

function writeFeedback(element, message)
{
	$(element).text(message).show();
}

function clearMessages()
{
	$("#expiryFeedback").empty().hide();
}

function validateFields()
{
	// Check date fields
	var nowDate = new Date();
	var expiryDate = new Date(
		parseInt($("#expiryYear").val()),	// Year
		parseInt($("#expiryMonth").val()),	// Month
		1, 1, 1, 1, 1);						// Extra params

	// Check that the expiry date is in the future (or this month)
	if(expiryDate < nowDate)
	{
		writeFeedback("#expiryFeedback", "Please use a payment method that has not expired.");
		return false;
	}

	return true;
}

$("#button_back").click(function(event)
{
	event.preventDefault();
	loadCheckoutStage(1);
});

$("#form_stage2").submit(function(event)
{
  // Do not proceed with normal form submission
  event.preventDefault();

  clearMessages();
  if(!validateFields())
  	return;

  // Location of the contact handler
  var url = $(this).attr('action');

  // POST request with form data
  var request = $.post(url, $(this).serialize());

  postAndLoadPage(request);
});

</script>