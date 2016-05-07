<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Your Bookings";

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");

  require_once("Include/flight.php");
  require_once("Include/booking.php");
  session_start();
?>

<h2>Your Bookings</h2>

<?php
if(!isset($_SESSION[Bookings::$BOOKINGS_SESSION_KEY]))
	{ ?>
		<div class="infoBox">
		  <h3>You have no bookings.</h3>
      <button class="lumpyButton" style="margin-top:0;" onclick="location.href='search_flights.php';">
        Book Now
      </button>
		</div>
	<?php
	require_once("Include/pageFooter.php");
	die();
} ?>

<div class="confirmDetailsBox">
  <?php
    $bookings = $_SESSION[Bookings::$BOOKINGS_SESSION_KEY];
    echo $bookings;
  ?>

  <h3>Total Price: <?php echo $bookings->get_totalPrice_formatted(); ?></h3>
</div>

<ul class="buttonBar" style="margin-top: 30px;">
  <li style="float: left;">
    <button class="negativeButton" onclick="location.href='Services/clear_bookings.php';">
      <img alt="Trash" src="Style/UI/trash.png" style="vertical-align: middle;" />
      Clear Bookings
    </button>
  </li>
  <li style="float: left;">
    <button class="neutralButton" onclick="location.href='search_flights.php';">
      Book More Flights
    </button>
  </li>
  <li style="float: right;">
    <button class="lumpyButton" onclick="location.href='#';">
      Checkout >
    </button>
  </li>
</ul>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>