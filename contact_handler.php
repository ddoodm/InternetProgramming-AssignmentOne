<?php

const MAX_NAME_LENGTH = 32;
const MIN_MESSAGE_LENGTH = 10;

function exitWithResponse($response)
{
	header('Content-Type: application/json');
	echo json_encode($response);
	die();
}

// Hash table of field-error pairs
$response = array();

// Result
$success = true;

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
	$success = false;
}

// Validate email
if(strlen($email) < 1)
{
	$response['email'] =
		"Please supply an E-Mail address.";
	$success = false;
}

// Validate subject
if(strlen($subject) < 1)
{
	$response['subject'] =
		"Please supply a subject message.";
	$success = false;
}

// Validate message
if(strlen($message) < MIN_MESSAGE_LENGTH)
{
	$response['message'] =
		"Please write a meaningful message.<br/>(More than ". MIN_MESSAGE_LENGTH ." characters, please.";
	$success = false;
}

if(!$success)
{
	$response['form'] =
		"Your message could not be delivered because some fields were entered incorrectly. Please correct the errors and try again.";
}

// Finally, deliver the field feedback, or post a success
$response["success"] = $success;
exitWithResponse($response);

?>