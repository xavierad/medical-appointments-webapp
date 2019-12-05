<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
  <div class="container">
  <br>
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
        $VAT_doctor = $tok;
      }
      if ($tok !== false) {
        $tok = strtok(",");
        $date_timestamp = $tok;
      }

      $sql = "SELECT * FROM appointment WHERE VAT_client = :VAT_client AND VAT_doctor = :VAT_doctor AND date_timestamp = :date_timestamp";
      $stmt = $connection->prepare($sql);
      if ($stmt == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      else {
        $stmt->bindParam(':VAT_client', $VAT_client);
        $stmt->bindParam(':VAT_doctor', $VAT_doctor);
        $stmt->bindParam(':date_timestamp', $date_timestamp);
        $stmt->execute();

        echo("<h3>Appointment Info:</h3>");
        echo("<br>");
        echo("<table border=\"1\" cellspacing=\"5\">\n");
        echo("<tr><td><center>VAT doctor</center></td><td><center>Date</center></td><td><center>Description</center></td><td><center>VAT client</center></td></tr>");
        foreach($stmt as $row)
        {
          echo("<tr>\n");
          echo("<td><center>{$row['VAT_doctor']}</center></td>\n");
          echo("<td><center>{$row['date_timestamp']}</center></td>\n");
          echo("<td><center>{$row['_description']}</center></td>\n");
          echo("<td><center>{$row['VAT_client']}</center></td>\n");
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
