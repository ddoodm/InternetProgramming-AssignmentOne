<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Checkout";

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");

  require_once("Include/flight.php");
  require_once("Include/booking.php");
  session_start();
?>

<h2>Checkout</h2>

<div id="checkoutContainer">
  <div id="checkoutContainerContent">
    <h2>Loading...</h2>
  </div>
</div>

<script type="text/javascript">

var stage = 1;

$(document).ready(function()
{
  // Load first stage
  loadCheckoutStage(stage);
});

function loadCheckoutStage(id)
{
  postAndLoadPage($.ajax(
  {
    url: sprintf("Checkout/stage_%i.php", id)
  }));
}

function postAndLoadPage(request)
{
  var content = $("#checkoutContainerContent");
  content.fadeOut(400, function()
  {
    request.done(function(response)
    {
      content.html(response);
      content.fadeIn(400, null);
    });
  });
}

</script>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>