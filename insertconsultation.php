<html>
  <body>
    <?php
      $host = "db.tecnico.ulisboa.pt";
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
      $VAT_client = $_REQUEST['VAT_client'];
      $VAT_doctor = $_REQUEST['VAT_doctor'];
      $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
      $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
      $VAT_nurse = $_REQUEST['VAT_nurse'];
      $SOAP_S = $_REQUEST['SOAP_S'];
      $SOAP_O = $_REQUEST['SOAP_O'];
      $SOAP_A = $_REQUEST['SOAP_A'];
      $SOAP_P = $_REQUEST['SOAP_P'];
      $dcID = $_REQUEST['dcID'];
      $dcDescription = $_REQUEST['dcDescription'];
      $pName = $_REQUEST['pName'];
      $pLab = $_REQUEST['pLab'];
      $pDosage = $_REQUEST['pDosage'];
      $pDescription = $_REQUEST['pDescription'];

      echo("<p>VAT Client: $VAT_client</p>");
      echo("<p>VAT Doctor: $VAT_doctor</p>");
      echo("<p>Date: $date_timestamp</p>");
      echo("<p>VAT Nurse: $VAT_nurse</p>");
      echo("<p>SOAP S: $SOAP_S</p>");
      echo("<p>SOAP O: $SOAP_O</p>");
      echo("<p>SOAP A: $SOAP_A</p>");
      echo("<p>SOAP P: $SOAP_P</p>");
      echo("<p>Diagnostic ID: $dcID</p>");
      echo("<p>Diagnostic Description: $dcDescription</p>");
      echo("<p>Prescription Name: $pName</p>");
      echo("<p>Prescription Lab: $pLab</p>");
      echo("<p>Prescription Dosage: $pDosage</p>");
      echo("<p>Prescription Description: $pDescription</p>");

      $sql = "INSERT INTO consultation VALUES ('$VAT_doctor', '$date_timestamp', '$SOAP_S', '$SOAP_O', '$SOAP_A', '$SOAP_P')";
      echo("<p>$sql</p>");
      $nrows = $connection->exec($sql);
      if ($nrows == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      echo("<p>Rows inserted in (consultation): $nrows</p>");

      $sql = "INSERT INTO consultation_assistant VALUES ('$VAT_doctor', '$date_timestamp', '$VAT_nurse')";
      echo("<p>$sql</p>");
      $nrows = $connection->exec($sql);
      if ($nrows == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      echo("<p>Rows inserted in (consultation_assistant): $nrows</p>");

      $sql = "INSERT INTO consultation_diagnostic VALUES ('$VAT_doctor', '$date_timestamp', '$dcID')";
      echo("<p>$sql</p>");
      $nrows = $connection->exec($sql);
      if ($nrows == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      echo("<p>Rows inserted in (consultation_diagnostic): $nrows</p>");

      $sql = "INSERT INTO prescription VALUES ('$pName', '$pLab', '$VAT_doctor', '$date_timestamp', '$dcID', '$pDosage', '$pDescription')";
      echo("<p>$sql</p>");
      $nrows = $connection->exec($sql);
      if ($nrows == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      echo("<p>Rows inserted in (prescription): $nrows</p>");

      /*$sql = "INSERT INTO appointment VALUES ('$VAT_doctor', '$date_timestamp', '$_description', '$VAT_client')";
      echo("<p>$sql</p>");
      $nrows = $connection->exec($sql);
      if ($nrows == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      echo("<p>Rows inserted: $nrows</p>");*/
      $connection = null;
    ?>
  </body>
</html>
