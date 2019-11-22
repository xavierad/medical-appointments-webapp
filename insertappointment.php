<html>
  <body>
    <?php
    $host = "db.tecnico.ulisboa.pt";
    $user = "ist187136";
    $pass = "rbtc1601";
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
    $date_timestamp = $_REQUEST['datetimestamp'];
    $_description = $_REQUEST['_description'];
    $client = $_REQUEST['client'];
    $VAT_client = substr($client, strpos( $client, ', ' )+1);
    $sql = "INSERT INTO appointment VALUES ('$VAT_doctor', '$date_timestamp', '$_description', '$VAT_client')";
    echo("<p>$sql</p>");
    $nrows = $connection->exec($sql);
    echo("<p>Rows inserted: $nrows</p>");
    $connection = null;
    ?>
  </body>
</html>
