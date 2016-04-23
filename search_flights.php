<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Connect to the database ($sqli)
  require_once("Include/database_connect.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Search Flights";

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");

  // Flight listing object
  require_once("Include/flightList.php");
  $flightList = new FlightList(
  	$sqli, $_GET['from_city']?:null, $_GET['to_city']?:null, $_GET['min_price']?:null, $_GET['max_price']?:null);
?>

<div style="padding-top: 100px">
	<div class="fullWidthContainer">
		<form action="search_flights.php" method="GET">
			<b>City</b> <input type="text" name="from_city"> to
			<input type="text" name="to_city"> <br />

			<b>Price</b> <input type="text" name="min_price"> to
			<input type="text" name="max_price"> <br />

			<input type="submit" value="Search">
		</form>
	</div>
</div>

<ul>
<?php
	$flightList->PrintTable();
?>
</ul>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>