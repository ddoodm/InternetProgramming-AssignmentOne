<?php
  // Site-wide dependencies
  require_once("Include/stdinc.php");

  // Connect to the database ($sqli)
  require_once("Include/database_connect.php");

  // Page title
  $pageTitle = Constants::$SITE_TITLE . " - Search Flights";

  // Insert header, navigation, and content div
  require_once("Include/pageHeader.php");
?>

<h2>Search Our Flights</h2>

<div class="fullWidthContainer">
	<form id="flightSearchForm" action="Services/flight_retriever.php" method="POST">
    <table>
      <tr>
    		<td><b>City</b></td>
        <td><input type="text" class="city_input" id="from_city" name="from_city" placeholder="Anywhere"></td>
        <td>to</td>
    		<td><input type="text" class="city_input" id="to_city" name="to_city" placeholder="Anywhere"></td>
      </tr>

      <tr>
    		<td><b>Price</b></td>
        <td><input type="text" name="min_price" pattern="^\d+((\.|\,)\d{1,2})?$" placeholder="$0.00"></td>
        <td>to</td>
    		<td><input type="text" name="max_price" pattern="^\d+((\.|\,)\d{1,2})?$" placeholder="$10,000.00+"></td>
      </tr>
    </table>
    <input type="submit" value="Search...">
	</form>
</div>

<form id="flightListForm" action="book_flight.php" method="POST">
  <table id="flightTable" class="flightListTable" style="display: none" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th style="width: 30%">From</th>
        <th style="width: 30%">To</th>
        <th style="width: 20%">Price</th>
        <th style="width: 20%">Book</th>
      </tr>
    </thead>
    <tbody> </tbody>
  </table>
</form>

<div id="errorMessage" class="infoBox" style="display:none;">
  <p></p>
</div>

<script type="text/javascript">

$(document).ready(function()
{
  // Configure autocomplete using the JSON service
  $(".city_input").autocomplete({
    source: "Services/city_listing.php"
  });
});

/* AJAX handler for "flight search" button */
$("#flightSearchForm").submit(function(event)
{
  // Do not proceed with normal form submission
  event.preventDefault();

  // Check that at least one parameter is supplied
  if(("" + $("#from_city").val() + $("#to_city").val()) == "")
    { showNullParameterMessage(); return; }

  // Clear message
  $("#errorMessage").fadeOut(250, null);

  // Location of the contact handler
  var url = $(this).attr('action');

  // POST request with form data
  var request = $.post(url, $(this).serialize());

  // If the table is hidden, just fade in
  if(!$("#flightTable").is(":visible"))
  {
    request.done(PopulateTableWithAJAXResponse);
    return;
  }

  // Otherwise, start table animation
  $("#flightTable").fadeOut(250, function()
  {
    // On animation complete, make the query
    request.done(PopulateTableWithAJAXResponse);
  });
});

function PopulateTableWithAJAXResponse(response)
{
    // Clear flight table
    $("#flightTable > tbody").empty();

    var xmlDoc = $(response).find('flights');
    var flightRows = xmlDoc.find('flight');

    if(flightRows.length < 1)
      { showEmptyResult(); return; }

    $(flightRows).each(function()
    {
        var from_city = HtmlTableCol($(this).attr("from_city"));
        var to_city = HtmlTableCol($(this).attr("to_city"));
        var price = HtmlTableCol("$" + $(this).attr("price"));
        var bookButton = HtmlTableCol(
          GenerateBookButton($(this).attr("route_no")));

        $('#flightTable > tbody:last-child').append(
          HtmlTableRow(from_city + to_city + price + bookButton));
    });

    // Re-open table animation
    $("#flightTable").fadeIn(250, null);
}

function showEmptyResult()
{
  $("#errorMessage")
    .html("<p>We could not find any flights matching your search.</p>")
    .fadeIn(250, null);
}

function showNullParameterMessage()
{
  $("#errorMessage")
    .html("<p>Please specify either the destination or origin of your flight, or both.</p>")
    .fadeIn(250, null);
}

function HtmlTableCol(content)
{
  return "<td>" + content + "</td>";
}

function HtmlTableRow(content)
{
  return "<tr>" + content + "</tr>";
}

function GenerateBookButton(route_no)
{
  return "<button name='route_no' type='submit' value='"+route_no+"' class='bookButton'>Book</button>";
}

</script>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>