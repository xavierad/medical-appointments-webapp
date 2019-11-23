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

    if ($tok !== false) {
      $tok = strtok($_REQUEST['consultation'], ",");
      $VAT_doctor = $tok;
    }
    if ($tok !== false) {
      $tok = strtok(",");
      $date_timestamp = $tok;
    }

    $sql = "SELECT * FROM consultation WHERE VAT_doctor = '$VAT_doctor' AND date_timestamp = '$date_timestamp'";
    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }
    echo("<h3>Consultation Info:</h3>");
    echo("<table border=\"1\">");
    echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>SOAP_S</td><td>SOAP_O</td><td>SOAP_A</td><td>SOAP_P</td></tr>");
    foreach($result as $row)
    {
      echo("<tr>\n");
      echo("<td>{$row['VAT_doctor']}</td>\n");
      echo("<td>{$row['date_timestamp']}</td>\n");
      echo("<td>{$row['SOAP_S']}</td>\n");
      echo("<td>{$row['SOAP_O']}</td>\n");
      echo("<td>{$row['SOAP_A']}</td>\n");
      echo("<td>{$row['SOAP_P']}</td>\n");
      echo("</tr>\n");
    }
    $connection = null;
?>
  </body>
</html>
