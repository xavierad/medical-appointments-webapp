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


      if ($tok !== false) {
        $tok = strtok($_REQUEST['appointment'], ",");
        $VAT_client = $tok;
      }
      if ($tok !== false) {
        $tok = strtok(",");
        $date_timestamp = $tok;
      }

      $sql = "SELECT * FROM appointment WHERE VAT_client = ':VAT_client' AND date_timestamp = ':date_timestamp'";
      $stmt = $connection->prepare($sql);
      if ($stmt == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      else {
        $stmt->bindParam(':VAT_client', $VAT_client);
        $stmt->bindParam(':date_timestamp', $date_timestamp);
        $stmt->execute();

        echo("<h3>Appointment Info:</h3>");
        echo("<table border=\"1\">");
        echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>_description</td><td>VAT_client</td></tr>");
        foreach($stmt as $row)
        {
          echo("<tr>\n");
          echo("<td>{$row['VAT_doctor']}</td>\n");
          echo("<td>{$row['date_timestamp']}</td>\n");
          echo("<td>{$row['_description']}</td>\n");
          echo("<td>{$row['VAT_client']}</td>\n");
          echo("</tr>\n");
        }
        echo("</table>\n\n");
      }
    }
    catch(PDOException $exception)
    {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
      exit();
    }

    $connection = null;
?>
  </body>
</html>
