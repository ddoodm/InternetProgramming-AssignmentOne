<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Style/main.css"/>
    <link rel="stylesheet" type="text/css" href="Style/mobile.css" media="only screen and (max-device-width: 480px)" />
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>

    <!-- JQuery Library -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

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
        <li><a href="bookings.php">Your Bookings</a></li>
        <li><a href="search_flights.php">Find Flights</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>

  	<!-- Main Body -->
  	<div id="bodyWrapper">
      <div id="content">