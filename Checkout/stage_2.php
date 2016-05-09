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

session_start();
$_SESSION[Constants::$CHECKOUT_STAGE1_SESSION] = $_POST;

?>
<h3>Complete your Booking - Stage 2 of 4</h3>
<p>Please review your details...</p>
<table>
	<tr><td>Given Name</td><td><?php echo $_POST["givenName"]; ?></td></tr>
	<tr><td>Family Name</td><td><?php echo $_POST["familyName"]; ?></td></tr>
	<tr><td>Address</td><td><?php echo $_POST["addressLine1"]; ?></td></tr>
	<tr><td></td><td><?php echo $_POST["addressLine2"]; ?></td></tr>
	<tr><td>Suburb</td><td><?php echo $_POST["suburb"]; ?></td></tr>
	<tr><td>State</td><td><?php echo $_POST["state"]; ?></td></tr>
	<tr><td>Postcode</td><td><?php echo $_POST["postcode"]; ?></td></tr>
	<tr><td>Country</td><td><?php echo $_POST["country"]." (".$_POST["country_code"].")"; ?></td></tr>
	<tr><td>E-Mail</td><td><?php echo $_POST["email"]; ?></td></tr>
	<tr><td>Business Phone</td><td><?php echo $_POST["businessPhone"]; ?></td></tr>
	<tr><td>Mobile Phone</td><td><?php echo $_POST["mobilePhone"]; ?></td></tr>
	<tr><td>Work Phone</td><td><?php echo $_POST["workPhone"]; ?></td></tr>
</table>

<h3>Payment Details</h3>

<form action="Checkout/stage_3.php">
	<table>
		<tr>
			<td>Card Type</td>
			<td>
				<label class="imageRadio">
					<input type="radio" name="cardType" value="visa" checked />
					<img alt="Visa" src="Images/visa.png" />
				</label>
				<label class="imageRadio">
					<input type="radio" name="cardType" value="dimers" />
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
			<td><input required type="text" id="cardNumber" name="cardNumber" placeholder="Card Number"><b class='requiredMarker'>*</b></td>
		</tr>
		<tr>
			<td></td>
			<td><input required type="text" id="nameOnCard" name="nameOnCard" placeholder="Cardholder Name"><b class='requiredMarker'>*</b></td>
		</tr>
		<tr>
			<td></td>
			<td><input required type="text" id="cardNumber" name="cardNumber" placeholder="Card Number"><b class='requiredMarker'>*</b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input required style="width: 30%;" type="text" id="expiryMonth" name="expiryMonth" placeholder="Expiry Month"><b class='requiredMarker'>*</b>
				<input required style="width: 30%;" type="text" id="expiryYear" name="expiryYear" placeholder="Expiry Year"><b class='requiredMarker'>*</b>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input required style="width: 30%;" type="text" maxlength="3" size="3" id="securityCode" name="securityCode" placeholder="Security Code"><b class='requiredMarker'>*</b></td>
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

$("#button_back").click(function(event)
{
	event.preventDefault();
	loadCheckoutStage(1);
});

</script>