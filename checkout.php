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
  <h3>Complete your Booking - Stage 1 of 4</h3>
  Please enter your details...
  <form>
    <table>
      <tr>
        <td>Your Name</td>
        <td>
          <input type="text" id="givenName" name="givenName" placeholder="Given Name"> <br />
          <input type="text" id="familyName" name="familyName" placeholder="Family Name">
        </td>
      </tr>
      <tr>
        <td>Address</td>
        <td>
          <input type="text" id="addressLine1" name="addressLine1" placeholder="Line 1"> <br />
          <input type="text" id="addressLine2" name="addressLine2" placeholder="Line 2"> <br />
          <input type="text" id="suburb" name="suburb" placeholder="Suburb"> <br />
          <input type="text" id="state" name="state" placeholder="State"> <br />
          <input type="text" id="postcode" name="postcode" placeholder="Postcode"> <br />
          <input type="text" id="country" name="country" placeholder="Country">
        </td>
      </tr>
      <tr>
        <td>Contact Details</td>
        <td>
          <input type="text" id="email" name="email" placeholder="E-Mail"> <br />
          <input type="text" id="mobilePhone" name="mobilePhone" placeholder="Mobile Phone"> <br />
          <input type="text" id="businessPhone" name="businessPhone" placeholder="Business Phone"> <br />
          <input type="text" id="workPhone" name="workPhone" placeholder="Work Phone">
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <button class="lumpyButton">
            Stage 2 >
          </button>
        </td>
      </tr>
    </table>
  </form>
</div>

<?php
  // Common footer content
  require_once("Include/pageFooter.php");
?>