<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Style/main.css"/>
    <link rel="stylesheet" type="text/css" href="Style/mobile.css" media="only screen and (max-device-width: 480px)" />
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>

    <title><?php echo($pageTitle); ?></title>
  </head>

  <body>
  	<!-- Head Spacer -->
  	<div id="headBar">
  		<img id="headerLogo" src="Style/UI/ITLogo.png" alt="<?php echo(Constants::$SITE_TITLE); ?>" />
  	</div>

  	<!-- Navigation Bar -->
  	<div id="navBar">
      <div id="navBarWrapper">
        <a href="index.php">Home</a>
        <a href="bookings.php">Your Bookings</a>
        <a href="#">Find Flights</a>
        <a href="contact.php">Contact</a>
      </div>
    </div>

  	<!-- Main Body -->
  	<div id="bodyWrapper">
      <div id="content">