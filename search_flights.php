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

<table id="flightTable">
  <thead>
    <tr><th>From</th> <th>To</th> <th>Price</th> <th>Book</th></tr>
  </thead>
  <tbody>

  </tbody>
</table>

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

  request.done(function(response)
  {
    // Clear flight table
    $("#flightTable > tbody").empty();

    var xmlDoc = $(response).find('flights');
    var flightRows = xmlDoc.find('flight');

    $(flightRows).each(function()
    {
        var from_city = $(this).attr("from_city");
        var to_city = $(this).attr("to_city");
        var price = $(this).attr("price");

        $('#flightTable > tbody:last-child')
          .append('<tr><td>'+from_city+'</td><td>'+to_city+'</td><td>'+price+'</td><td>Book</td></tr>');
    });
  });
});

</script>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>