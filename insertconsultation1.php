<html>
  <body>
    <form action="selectclient.php" method="post">
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
      $SOAP_S = $_REQUEST['SOAP_S'];
      $SOAP_O = $_REQUEST['SOAP_O'];
      $SOAP_A = $_REQUEST['SOAP_A'];
      $SOAP_P = $_REQUEST['SOAP_P'];


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

      echo("<h3>Insert more information on the consultation:</h3>");

      echo("<td><a href=\"insertnurse.php?VAT_doctor=".$VAT_doctor."&date_timestamp=".$date_timestamp);
      echo("\">Add Nurse</a></p>\n");

      echo("<p><a href=\"insertdiagnostic.php?VAT_doctor=".$VAT_doctor."&date_timestamp=".$date_timestamp);
      echo("\">Add Diagnostic</a></p>\n");

      $connection = null;
    ?>
    <p><input type="submit" value="Finish"/></p>
  </body>
</html>