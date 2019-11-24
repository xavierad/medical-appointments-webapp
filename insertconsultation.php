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
      $date_timestamp_aux = strtotime($_REQUEST['datetimestamp']);
      $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
      $SOAP_S = $_REQUEST['SOAP_S'];
      $SOAP_O = $_REQUEST['SOAP_O'];
      $SOAP_A = $_REQUEST['SOAP_A'];
      $SOAP_P = $_REQUEST['SOAP_P'];
      $dcID = $_REQUEST['dcID'];
      $dcDescription = $_REQUEST['dcDescription'];
      $pName = $_REQUEST['pName'];
      $pDosage = $_REQUEST['pDosage'];
      $pDescription = $_REQUEST['pDescription'];

      echo("<p>$VAT_client</p>");

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
