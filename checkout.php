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
  // Animate scroll-to-top
  $("html, body").animate({ scrollTop: 0 }, "slow");

  var content = $("#checkoutContainerContent");
  content.fadeOut(400, function()
  {
    content.html("<h2>Loading...</h2>").show();
    request.done(function(response)
    {
      content.hide().html(response);
      content.fadeIn(400, null);
    });
  });
}

</script>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>