<html>
  <body>
  <form action="insertconsultation.php" method="post">
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
    echo("<p>Client (VAT): $VAT_client</p>\n");
    echo("<p>Doctor (VAT): $VAT_doctor</p>\n");
    echo("<p>Date: $date_timestamp</p>\n");
?>

  <p>Nurse (VAT): <input type="text" name="VAT_nurse"/></p>
  <p>SOAP S: <input type="text" name="SOAP_S"/></p>
  <p>SOAP O: <input type="text" name="SOAP_O"/></p>
  <p>SOAP A: <input type="text" name="SOAP_A"/></p>
  <p>SOAP P: <input type="text" name="SOAP_P"/></p>
  <p>Diagnostic code ID: <input type="text" name="dcID"/></p>
  <p>Diagnostic code description: <input type="text" name="dcDescription"/></p>
  <p>Prescription name: <input type="text" name="pName"/></p>
  <p>Prescription dosage: <input type="text" name="pDosage"/></p>
  <p>Prescription description: <input type="text" name="pDescription"/></p>

  <p><input type="submit" value="Submit"/></p>
  
  </body>
</html>
