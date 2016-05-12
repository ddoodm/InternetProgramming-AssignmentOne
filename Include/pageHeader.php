<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Style/main.css?<?php echo rand(); ?>"/>
    <link rel="stylesheet" type="text/css" href="Style/mobile.css" media="only screen and (max-device-width: 480px)" />
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>

    <!-- Country Select JQuery Plugin stylesheet -->
    <link rel="stylesheet" href="Style/countrySelect.min.css"/>

    <!-- JQuery Library -->
    <script src="Scripts/jquery-1.12.3.min.js"></script>
    
    <!-- JQuery UI Library -->
    <link href="Scripts/jquery-ui/jquery-ui.css" rel="stylesheet" />
    <script src="Scripts/jquery-ui/jquery-ui.min.js"></script>

    <!-- sprintf (string format) function -->
    <script src="Scripts/sprintf.min.js"></script>

    <title><?php echo($pageTitle); ?></title>
  </head>

  <body>
  	<!-- Head Spacer -->
  	<div id="headBar">
  		<img id="headerLogo" src="Style/UI/ITLogo.png" alt="<?php echo(Constants::$SITE_TITLE); ?>" />
  	</div>

  	<!-- Navigation Bar -->
  	<div id="navBar">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="search_flights.php">Find Flights</a></li>
        <li><a href="bookings.php">Your Bookings</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>

  	<!-- Main Body -->
  	<div id="bodyWrapper">
      <div id="content">