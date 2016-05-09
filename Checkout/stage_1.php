  <h3>Complete your Booking - Stage 1 of 4</h3>
  <p>Please enter your details...</p>
  <form id="form_stage1" action="Checkout/stage_2.php">
    <table class="inputTable">
      <tr>
        <td>Your Name</td>
        <td>
          <input type="text" id="givenName" name="givenName" placeholder="Given Name"> <b class='requiredMarker' id='givenName_required'></b> <br />
          <input type="text" id="familyName" name="familyName" placeholder="Family Name"> <b class='requiredMarker' id='familyName_required'></b>
        </td>
      </tr>
      <tr>
        <td>Address</td>
        <td>
          <input type="text" id="addressLine1" name="addressLine1" placeholder="Address Line 1"> <b class='requiredMarker' id='addressLine1_required'></b> <br />
          <input type="text" id="addressLine2" name="addressLine2" placeholder="Address Line 2"> <b class='requiredMarker' id='addressLine2_required'></b> <br />
          <input type="text" id="suburb" name="suburb" placeholder="Suburb"> <b class='requiredMarker' id='suburb_required'></b> <br />
          <input type="text" id="state" name="state" placeholder="State"> <b class='requiredMarker' id='state_required'></b> <br />
          <input type="text" id="postcode" name="postcode" placeholder="Postcode"> <b class='requiredMarker' id='postcode_required'></b> <br />

          <!-- Open Source 'JQuery Country Select' plugin - mrmarkfrench/country-select-js -->
          <input type="text" name="country" id="country">
          <input type="hidden" name="country_code" id="country_code" /> <b class='requiredMarker' id='country_code_required'></b>
          <script src="Scripts/countrySelect.min.js"></script>
          <script>
            $("#country").countrySelect({
              defaultCountry: "au",
              preferredCountries: ['au', 'us', 'jp', 'gb', 'ca']
            });
          </script>
          <p>Note to markers: this is an open-source country selector,
            available at GitHub <a href="https://github.com/mrmarkfrench/country-select-js">here</a>.</p>

        </td>
      </tr>
      <tr>
        <td>Contact Details</td>
        <td>
          <input type="text" id="email" name="email" placeholder="E-Mail"> <b class='requiredMarker' id='email_required'></b> <br />
          <input type="text" id="mobilePhone" name="mobilePhone" placeholder="Mobile Phone"> <b class='requiredMarker' id='mobilePhone_required'></b> <br />
          <input type="text" id="businessPhone" name="businessPhone" placeholder="Business Phone"> <b class='requiredMarker' id='businessPhone_required'></b> <br />
          <input type="text" id="workPhone" name="workPhone" placeholder="Work Phone"> <b class='requiredMarker' id='workPhone_required'></b>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <button class="lumpyButton">Stage 2 &gt;</button>
        </td>
      </tr>
    </table>
  </form>

<script type="text/javascript">

var fields =
[
  "givenName", "familyName",
  "addressLine1", "addressLine2", "suburb", "state", "postcode", "country_code",
  "email", "mobilePhone", "businessPhone", "workPhone"
];

$(document).ready(function()
{
  setFieldsForAu();
});

$("#country_code").change(function()
{
  var code = $(this).val();
  if(code == "au")
    setFieldsForAu();
  else
    setFieldsForInternational();
});

function setFieldsForAu()
{
  setAllRequiredBut(fields, ["addressLine2", "mobilePhone", "businessPhone", "workPhone"]);
}

function setFieldsForInternational()
{
  setAllRequiredBut(fields, ["addressLine2", "state", "postcode", "mobilePhone", "businessPhone", "workPhone"]);
}

function setAllRequiredBut(fields, optionalFields)
{
  for(i = 0; i < fields.length; i++)
  {
    // If field [i] is NOT in the optional list, it is required
    setFieldRequired(
      fields[i],
      $.inArray(fields[i], optionalFields) == -1
      );
  }
}

function setFieldRequired(field, required)
{
  if(required)
    $("#"+field).attr("required", "true");
  else
    $("#"+field).removeAttr("required");

  $("#"+field + "_required").html(required? "*" : "");
}

$("#form_stage1").submit(function(event)
{
  // Do not proceed with normal form submission
  event.preventDefault();

  // Location of the contact handler
  var url = $(this).attr('action');

  // POST request with form data
  var request = $.post(url, $(this).serialize());

  postAndLoadPage(request);
});

</script>