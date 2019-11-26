<html>
  <body>
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
    echo("<p>Client (VAT): $VAT_client</p>\n");
    echo("<p>Doctor (VAT): $VAT_doctor</p>\n");
    echo("<p>Date: $date_timestamp</p>\n");
?>
  <p><input type="hidden" name="VAT_client"
  value="<?=$VAT_client?>"/></p>
  <p><input type="hidden" name="VAT_doctor"
  value="<?=$VAT_doctor?>"/></p>
  <p><input type="hidden" name="date_timestamp"
  value="<?=$date_timestamp?>"/></p>

  <p>SOAP S: <input type="text" name="SOAP_S"/></p>
  <p>SOAP O: <input type="text" name="SOAP_O"/></p>
  <p>SOAP A: <input type="text" name="SOAP_A"/></p>
  <p>SOAP P: <input type="text" name="SOAP_P"/></p>

  <p><input type="submit" value="Continue"/></p>

  </body>
</html>
