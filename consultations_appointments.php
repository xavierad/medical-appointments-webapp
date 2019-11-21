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
    $sql = "SELECT * FROM appointment ORDER BY date_timestamp";
    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }
    echo("<h3>Table <em>Appointment</em></h3>");
    echo("<table border=\"1\">");
    echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>_description</td><td>VAT_client</td></tr>");
    foreach($result as $row)
    {
      echo("<tr><td>");
      echo($row['VAT_doctor']);
      echo("</td><td>");
      echo($row['date_timestamp']);
      echo("</td><td>");
      echo($row['_description']);
      echo("</td><td>");
      echo($row['VAT_client']);
      echo("</td></tr>");
    }
    echo("</table>");
    $connection = null;
?>
  </body>
</html>
