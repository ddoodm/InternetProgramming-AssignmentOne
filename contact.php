<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Contact Us";

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");
?>

<h2>Contact Us</h2>

<form id="contactForm" action="Services/contact_handler.php" method="post">
	<label>CONTACT US</label>
	<p>Have a question or two about our flights? Please, contact us via this form; we'll be happy to read from you.</p>

	<label>YOUR NAME (optional)</label>
	<input type="text" id="name" name="name"><br />
	<div class="errorText" id="rsp_name"></div>

	<label>YOUR E-MAIL</label>
	<input type="text" id="email" name="email"><br />
	<div class="errorText" id="rsp_email"></div>

	<label>SUBJECT</label>
	<input type="text" id="subject" name="subject"><br />
	<div class="errorText" id="rsp_subject"></div>

	<label>YOUR MESSAGE (<a id="message_charCount"></a> characters remaining)</label>
	<textarea id="message" name="message" rows="10"></textarea>
	<div class="errorText" id="rsp_message"></div>

	<div class="errorText" id="rsp_form"></div>

	<input class="lumpyButton" id="contactFormSubmit" type="submit" value="SEND" >

	<div id="contactFormSuccess" class="hidden">
		<img src="Style/UI/GreenSmiley.png" alt="Success!" />
		<span>Thank you!</span>
	</div>
</form>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>

<script type="text/javascript">
// Disable extension function
$.fn.extend(
{
    disable: function(state)
    {
        return this.each( function()
        {
            this.disabled = state;
            $(this).toggleClass("disabledInput", state);
        });
    }
});

$(document).ready(function()
{
	// Configure character count feedback
	var MAX_MESSAGE_LENGTH = 2500;
	$("#message_charCount").html(MAX_MESSAGE_LENGTH);

	$("#message").keyup(function()
	{
		var messageLen = $(this).val().length;
		var countRemaining = Math.max(0, MAX_MESSAGE_LENGTH - messageLen);
		$("#message_charCount").html(countRemaining);
	});
});

function clearErrorMessages()
{
	$('.errorText').each(function()
		{ $(this).empty(); });
	$('#contactForm input, #contactForm textarea').each(function()
		{ $(this).toggleClass("errorField", false) });
}

function handleServerErrorMessages (messages)
{
	// There are errors, so re-enable the submit button
	$("#contactFormSubmit").disable(false);

	// Clear old error messages
	clearErrorMessages();

	// Re-populate errors
	for(var key in messages)
	{
		// Skip properties from prototype
		if (!messages.hasOwnProperty(key)) continue;

		// Skip success message
		if (key == "success") continue;

		// Set feedback message for each form element
		$("#rsp_" + key).empty().append(messages[key]);
		$("#" + key).toggleClass("errorField", true);
	}
}

function doSuccessAnimation()
{
	clearErrorMessages();

	// Get current form height for restoration
	var formHeight = $("#contactForm").height();

	$("#contactFormSubmit").fadeOut(400, function()
	{
		// Restore old height
		$("#contactForm").height(formHeight);

		$("#contactFormSuccess").fadeIn(400);
	});
}

$("#contactForm").submit(function(event)
{
	// Do not proceed with normal form submission
	event.preventDefault();

	// Disable submit button
	$("#contactFormSubmit").disable(true);

	// Location of the contact handler
	var url = $(this).attr('action');

	// POST request with form data
	var request = $.post(url, $(this).serialize());

	request.done(function(messages)
	{
		// If the server reported bad form input, show errors
		if(!messages.success)
			return handleServerErrorMessages(messages);

		// Otherwise, proceed with success animation
		doSuccessAnimation();
	});
});
</script>