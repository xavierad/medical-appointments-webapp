<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
  <div class="container">
  <br>
  <form action="insertconsultation1.php" method="post">
<?php
    if ($tok !== false) {
      $tok = strtok($_REQUEST['appointment'], ",");
      $VAT_client = $tok;
    }
    if ($tok !== false) {
      $tok = strtok(",");
      $VAT_doctor = $tok;
    }
    if ($tok !== false) {
      $tok = strtok(",");
      $date_timestamp = $tok;
    }

    echo("<h3>Insert a new consultation:</h3>");
    echo("<br>");
    echo("<p>Client (VAT): $VAT_client</p>\n");
    echo("<p>Doctor (VAT): $VAT_doctor</p>\n");
    echo("<p>Date: $date_timestamp</p>\n");
    echo("<br>");
?>
  <p><input type="hidden" name="VAT_client"
  value="<?=$VAT_client?>"/></p>
  <p><input type="hidden" name="VAT_doctor"
  value="<?=$VAT_doctor?>"/></p>
  <p><input type="hidden" name="date_timestamp"
  value="<?=$date_timestamp?>"/></p>


    <div class="form-group row">
      <label for="SOAP_S" class="col-sm-1.5 col-form-label">SOAP S</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="SOAP_S" placeholder="Enter SOAP" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="SOAP_O" class="col-sm-1.5 col-form-label">SOAP O</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="SOAP_O" placeholder="Enter SOAP" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="SOAP_A" class="col-sm-1.5 col-form-label">SOAP A</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="SOAP_A" placeholder="Enter SOAP" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="SOAP_P" class="col-sm-1.5 col-form-label">SOAP P</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="SOAP_P" placeholder="Enter SOAP" required>
      </div>
    </div>


  <br>

  <p><button class="btn btn-primary" type="submit"/>Continue</button></p>
  </form>
  </div>
  </body>
</html>
