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
      $VAT_doctor = $_REQUEST['VAT_doctor'];
      $date_timestamp_aux = strtotime($_REQUEST['datetimestamp']);
      $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
      $_description = $_REQUEST['_description'];
      $VAT_client = $_REQUEST['VAT_client'];
      $sql = "INSERT INTO appointment VALUES ('$VAT_doctor', '$date_timestamp', '$_description', '$VAT_client')";
      $nrows = $connection->exec($sql);
      if ($nrows == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      else{
        echo("<p>New appointment was created to $_REQUEST[client_name] and dr. $_REQUEST[doctorname]</p>");
      }
      $connection = null;
    ?>
  </body>
</html>
