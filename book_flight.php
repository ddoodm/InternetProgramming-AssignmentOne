<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Connect to the database ($sqli)
  require_once("Include/database_connect.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Book a Flight";

  // Flight class
  require_once("Include/flight.php");

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");

  // Handle 'no flight number' exceptional case
  if(!isset($_POST["route_no"]))
  {
    echo "<h1>This page cannot be accessed directly</h1>";
    require_once("Include/pageFooter.php");
    die();
  }

  // Filter route number
  if(!($route_no = filter_var($_POST["route_no"], FILTER_VALIDATE_INT))) die();
  $route_no = intval($route_no);

  // Query database
  $flight = Flight::CreateFromRouteNo($sqli, $route_no);
?>

<h2>Your Journey from <?php echo $flight->get_from_city(); ?> to <?php echo $flight->get_to_city(); ?></h2>

<div class='infoBox'>
<h3>Please review your flight details...</h3>
<table class="detailTable">
  <tr>
    <td>From</td><td><?php echo $flight->get_from_city(); ?></td>
  </tr>
  <tr>
    <td>To</td><td><?php echo $flight->get_to_city(); ?></td>
  </tr>
  <tr>
    <td>Price</td><td><?php echo $flight->get_price_formatted(); ?> per seat</td>
  </tr>
</table>
</div>

<h2>Seating Preferences</h2>
<form action="Services/register_booking.php" method="POST">
  <input type="hidden" name="route_no" value="<?php echo $route_no; ?>">
  <input id="seatCountField" type="hidden" name="seatCount">

  <table class="seatTable" id="seatTableBody">
    <thead>
      <tr>
        <th style="width:50%">Seat</th>
        <th style="width:16%">Child</th>
        <th style="width:16%">Wheelchair</th>
        <th style="width:16%">Special Diet</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <div style="text-align:right; margin: 10px auto; height:90px;">
    <div style="position:relative; float:left; height: 60px;">
      <button class="symbolButton" id="addSeatButton">+</button>
      <button class="symbolButton" id="removeSeatButton" style="color:#F40;">&#8211;</button>
      &nbsp;<i id="seatCountText"></i>
      <b style="font-size: 25px; vertical-align:middle; margin-left: 80px;">
        Total Price: <i id="totalPriceText"></i>
      </b>
    </div>
    <div style="position:relative; float:right; height: 60px;">
    <input
      class="lumpyButton"
      id="bookFormSubmit"
      type="submit"
      value="MAKE BOOKING >">
    </div>
  </div>
</form>

<script type="text/javascript">

var SEAT_ROW_FORMAT =
  "<tr id='seatRow_%(id)i'>" +
  "  <td>#%(idDisplay)i</td>" +
  "  <td><input type='checkbox' name='child_%(id)i'></td>" +
  "  <td><input type='checkbox' name='wheelchair_%(id)i'></td>" +
  "  <td><input type='checkbox' name='diet_%(id)i'></td>" +
  "</tr>";

var seatRowCount = 0;

var flightPrice = <?php echo $flight->get_price(); ?>;

// Disable extension function
$.fn.extend(
{
    disable: function(state)
    {
        return this.each( function()
        {
            this.disabled = state;
            $(this).toggleClass("disabledInput", state);
        });
    }
});

function addSeatRow_id(id)
{
  // Substitute ID into row format string
  var rowText = sprintf(SEAT_ROW_FORMAT, {id: id, idDisplay: id+1});

  $("#seatTableBody > tbody:last-child").append(rowText);
}

function addSeatRow()
{
  addSeatRow_id(seatRowCount++);
}

function removeSeatRow()
{
  if(seatRowCount <= 0)
    return;

  seatRowCount--;
  $("#seatTableBody > tbody > tr:last-child").remove();
}

$(document).ready(function()
{
  // Initialize with one seat row
  addSeatRow();
  updateControls();
});

function updateControls()
{
  // Do not allow booking of 0 seats
  $("#bookFormSubmit").disable(seatRowCount < 1);

  // Update seat count text
  $("#seatCountText").text(
    sprintf("%i seat%s selected", seatRowCount, seatRowCount==1? "" : "s"));

  // Update seat count hidden field
  $("#seatCountField").val(seatRowCount);

  $("#totalPriceText").text("$" + (flightPrice * seatRowCount).toFixed(2));
}

$("#addSeatButton").click(function(event)
{
  event.preventDefault();
  addSeatRow();
  updateControls();
});

$("#removeSeatButton").click(function(event)
{
  event.preventDefault();
  removeSeatRow();
  updateControls();
});

</script>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>