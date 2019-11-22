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
    $date_timestamp = $_REQUEST['date_timestamp'];

    echo("Search for: $VAT_client\n");
    echo("Search for: $date_timestamp\n");

    $sql = "SELECT * FROM appointment WHERE VAT_client = '$VAT_client' AND date_timestamp = '$date_timestamp'";
    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }
    echo("<h3>Appointment Info:</h3>");
    echo("<table border=\"1\">");
    echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>_description</td><td>VAT_client</td></tr>");
    foreach($result as $row)
    {
      echo("<tr>\n");
      echo("<td>{$row['VAT_doctor']}</td>\n");
      echo("<td>{$row['date_timestamp']}</td>\n");
      echo("<td>{$row['_description']}</td>\n");
      echo("<td>{$row['VAT_client']}</td>\n");
      echo("</tr>\n");
    }
    echo("</table>\n\n");
    $connection = null;
?>
  </body>
</html>
