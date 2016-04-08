<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Your Bookings";

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");
?>

<h2>Your Bookings</h2>

<div class="infoBox">
  <h3>You have no bookings.</h3>
</div>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>