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
		<b>City</b> <input type="text" name="from_city" placeholder="Anywhere"> to
		<input type="text" name="to_city" placeholder="Anywhere"> <br />

		<b>Price</b> <input type="text" name="min_price" placeholder="$0.00"> to
		<input type="text" name="max_price" placeholder="$10,000.00+"> <br />

		<input type="submit" value="Search">
	</form>
</div>

<form id="flightListForm" action="book_flight.php" method="POST">
  <table id="flightTable" style="display: none" cellspacing="0" cellpadding="0">
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

<script type="text/javascript">

/* AJAX handler for "flight search" button */
$("#flightSearchForm").submit(function(event)
{
  // Do not proceed with normal form submission
  event.preventDefault();

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