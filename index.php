<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Home";

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");
?>

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

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>