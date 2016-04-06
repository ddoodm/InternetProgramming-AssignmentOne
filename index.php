<?php require_once("Include/stdinc.php"); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Style/main.css"/>
    <link rel="stylesheet" type="text/css" href="Style/mobile.css" media="only screen and (max-device-width: 480px)" />
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>

    <title><?php echo(Constants::$SITE_TITLE); ?></title>
  </head>

  <body>
  	<!-- Head Spacer -->
  	<div id="headBar">
  		<img id="headerLogo" src="Style/UI/ITLogo.png" alt="<?php echo(Constants::$SITE_TITLE); ?>" />
  	</div>

  	<!-- Navigation Bar -->
  	<div id="navBar"></div>

  	<!-- Main Body -->
  	<div id="bodyWrapper">
      <div id="content">
        <h2>Start planning your next adventure today, with Interprog Travel!</h2>

        <!-- Promo Image -->
        <img class="fullBodyPromoImage" src="Images/PromoPic_00.jpg" alt="Promotion Image">

        <div class="infoBox">
          <h3>
            Book your flight now for the best deals !<br />
            Don't wait !
          </h3>
          <button class="lumpyButton" onclick="location.href='#';">
            Book Now
          </button>
        </div>

        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dolor ante, laoreet in metus eu, pharetra ultrices ante. Suspendisse non interdum orci. Sed accumsan mi ut erat pulvinar congue. Nullam neque ipsum, porta non fringilla sed, egestas at quam. Donec hendrerit ante in rutrum pellentesque. Aliquam a quam a lectus placerat consectetur. Sed a mauris at erat maximus lobortis luctus vitae urna. Donec a lorem a diam vestibulum sagittis. Vestibulum at mi diam. Fusce non diam convallis, malesuada quam et, tristique lacus. Aliquam erat volutpat. Maecenas suscipit tempus turpis, ac pellentesque eros fermentum at.
        </p>
        <p class="rightJustify">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dolor ante, laoreet in metus eu, pharetra ultrices ante. Suspendisse non interdum orci. Sed accumsan mi ut erat pulvinar congue. Nullam neque ipsum, porta non fringilla sed, egestas at quam. Donec hendrerit ante in rutrum pellentesque. Aliquam a quam a lectus placerat consectetur. Sed a mauris at erat maximus lobortis luctus vitae urna. Donec a lorem a diam vestibulum sagittis. Vestibulum at mi diam. Fusce non diam convallis, malesuada quam et, tristique lacus. Aliquam erat volutpat. Maecenas suscipit tempus turpis, ac pellentesque eros fermentum at.
        </p>
      </div>

  		<!-- Footer -->
  		<div id="footer">
        <div id="footerContent">
          <a>
            <img src="Images/HTML5_Logo_64.png" alt="W3C Valid HTML 5" />
            <p>W3C Valid HTML5 Markup</p>
          </a>
        </div>
      </div>
  	</div>

  </body>
</html>
