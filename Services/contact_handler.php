<?php

require_once("../Include/stdinc.php");

const RECEIVER_ADDRESS = "deinyon.davies@student.uts.edu.au";
const MAX_NAME_LENGTH = 50;
const MAX_SUBJECT_LENGTH = 50;
const MIN_MESSAGE_LENGTH = 10;
const MAX_MESSAGE_LENGTH = 2500;

function exitWithResponse($response)
{
	header('Content-Type: application/json');
	//echo json_encode($response);
	echo DJsonHelper::json_encode($response);
	die();
}

// Hash table of field-error pairs
$response = array();

// Result
$formValid = true;

// Check that all fields were delivered
if( !isset($_REQUEST['name']) ||
	!isset($_REQUEST['email']) ||
	!isset($_REQUEST['subject']) ||
	!isset($_REQUEST['message']))
{
	$response['form_feedback'] = 
		"An internal server error has occurred.";
	exitWithResponse($response);
}

// Strip form fields
$name = htmlspecialchars($_REQUEST['name']);
$email = htmlspecialchars($_REQUEST['email']);
$subject = htmlspecialchars($_REQUEST['subject']);
$message = htmlspecialchars($_REQUEST['message']);

// Validate name
if(strlen($name) > MAX_NAME_LENGTH)
{
	$response['name'] =
		"Please supply a name less than ". MAX_NAME_LENGTH ." charaters long.";
	$formValid = false;
}

// Validate email
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	$response['email'] =
		"Please supply a valid E-Mail address.";
	$formValid = false;
}

// No E-Mail address supplied
if(strlen($email) < 1)
{
	$response['email'] =
		"Please supply an E-Mail address.";
	$formValid = false;
}

// Validate subject
if(strlen($subject) < 1)
{
	$response['subject'] =
		"Please supply a subject message.";
	$formValid = false;
}

// Subject too long
if(strlen($subject) > MAX_SUBJECT_LENGTH)
{
	$response['subject'] =
		"Please provide a subject less than ". MAX_SUBJECT_LENGTH ." characters long.";
	$formValid = false;
}

// Validate message
if(strlen($message) < MIN_MESSAGE_LENGTH)
{
	$response['message'] =
		"Please write a meaningful message.<br/>(More than ". MIN_MESSAGE_LENGTH ." characters, please)";
	$formValid = false;
}

// Message too long
if(strlen($message) > MAX_MESSAGE_LENGTH)
{
	$response['message'] =
		"Please constrain your message to ". MAX_MESSAGE_LENGTH ." characters.";
	$formValid = false;
}

// If form data was entered incorrectly, exit now and tell the user.
if(!$formValid)
{
	$response['form'] =
		"Your message could not be delivered because some fields were entered incorrectly. Please correct the errors and try again.";

	$response["success"] = false;
	exitWithResponse($response);
}

// Configure additional 'from' headers
$mailHeaders  = 'From: '. $email ."\r\n";
$mailHeaders .= 'Reply-To: '. $email ."\r\n";
$mailHeaders .= 'X-Mailer: PHP/' . phpversion();

// Configure HTML mail
$mailHeaders .= 'MIME-Version: 1.0' . "\r\n";
$mailHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Message (format)
$messageFormat =
"
<html>
	<body>
		<h1>Interprog Travel Contact Form Message from %s</h1>
		<p>E-Mail: <a href='mailto:%s'>%s</a></p>
		<p>%s</p>
	</body>
</html>
";

// Format the message
$mailMessage = sprintf(
	$messageFormat,
	$name===""? "an Anonymous Mailer" : $name, $email, $email, $message);

// Deliver the E-Mail to the webmaster
$deliverySuccess = mail(RECEIVER_ADDRESS, $subject, $mailMessage, $mailHeaders);

// If the message was not delivered, tell the user
if(!$deliverySuccess)
{
	$response['form'] =
		"An internal server occurred which is preventing the message from being delivered. Please try again later.";
	$response["success"] = false;

	exitWithResponse($response);
}

// Finally, deliver to the client
mail($email, $subject, $mailMessage, $mailHeaders);

// Otherwise, exit with a success flag
$response["success"] = true;
exitWithResponse($response);
?>