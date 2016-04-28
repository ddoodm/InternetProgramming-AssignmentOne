<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Connect to the database ($sqli)
  require_once("Include/database_connect.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Search Flights";

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");

  // Handle 'no flight number' exceptional cases
  if(!isset($_POST["route_no"]))
  {
    echo "<h1>This page cannot be accessed directly</h1>";
    require_once("Include/pageFooter.php");
    die();
  }

  // Filter route number
  if(!($route_no = filter_var($_POST["route_no"], FILTER_VALIDATE_INT))) die();
  $route_no = intval($route_no);

  $query = "SELECT * FROM flights WHERE route_no=$route_no;";
  $result = $sqli->query($query);
  // Print errors
  if($sqli->errno)
  { echo $sqli->error . " --IN QUERY-- " . $query;  exit(); }
  $flight = $result->fetch_object();
?>

<h2>Your Journey from <?php echo $flight->from_city; ?> to <?php echo $flight->to_city; ?></h2>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>