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
  <p><input type="hidden" name="VAT_client"
  value="<?=$VAT_client?>"/></p>
  <p><input type="hidden" name="VAT_doctor"
  value="<?=$VAT_doctor?>"/></p>
  <p><input type="hidden" name="date_timestamp"
  value="<?=$date_timestamp?>"/></p>

  <p>Nurse (VAT):
    <select name="VAT_nurse">
<?php
  $host = "db.ist.utl.pt";
  $user = "ist187094";
  $pass = "stlk1710";
  $dsn = "mysql:host=$host;dbname=$user";
  try
  {
    $connection = new PDO($dsn, $user, $pass);
  }
  catch(PDOException $exception)
  {
    echo("<p>Error: ");
    echo($exception->getMessage());
    echo("</p>");
    exit();
  }

  $sql = "SELECT VAT FROM nurse ORDER BY VAT";
  $result = $connection->query($sql);
  if ($result == FALSE)
  {
    $info = $connection->errorInfo();
    echo("<p>Error: {$info[2]}</p>");
    exit();
  }

  foreach($result as $row)
  {
    $VAT_nurse = $row['VAT'];
    echo("<option value=\"$VAT_nurse\">$VAT_nurse</option>");
  }

  $connection = null;
?>
  </select>
  </p>


  <p>SOAP S: <input type="text" name="SOAP_S"/></p>
  <p>SOAP O: <input type="text" name="SOAP_O"/></p>
  <p>SOAP A: <input type="text" name="SOAP_A"/></p>
  <p>SOAP P: <input type="text" name="SOAP_P"/></p>
  <p>Diagnostic code ID: <input type="text" name="dcID"/></p>
  <p>Diagnostic code description: <input type="text" name="dcDescription"/></p>
  <p>Prescription name: <input type="text" name="pName"/></p>
  <p>Prescription lab: <input type="text" name="pLab"/></p>
  <p>Prescription dosage: <input type="text" name="pDosage"/></p>
  <p>Prescription description: <input type="text" name="pDescription"/></p>

  <p><input type="submit" value="Submit"/></p>

  </body>
</html>
