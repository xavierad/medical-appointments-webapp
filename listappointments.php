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


      $VAT = $_REQUEST['VAT'];

      $sql = "SELECT A.VAT_doctor, A.date_timestamp, A._description, A.VAT_client
              FROM  appointment A
              LEFT JOIN consultation C
              ON A.date_timestamp = C.date_timestamp
              AND A.VAT_doctor = C.VAT_doctor
              WHERE C.date_timestamp is null
              AND C.VAT_doctor is null
              AND A.VAT_client = :VAT";

      $stmt = $connection->prepare($sql);

      if ($stmt == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      else {
        $stmt->bindParam(':VAT', $VAT);
        $stmt->execute();
        $nrows = $stmt->rowCount();
        echo("<h3>Free appointments:</h3>");
        if($nrows==0){
          echo("<p><strong>There is no appointments for this client</strong></p>");
        }
        else {
          echo("<h3>Free appointments:</h3>");
          echo("<br>");
          echo("<table cellpadding=\"5\" border=\"1\" cellspacing=\"2\">\n");
          echo("<tr><td><center>VAT doctor</center></td><td><center>Date</center></td><td><center>Description</center></td><td><center>VAT client</center></td></tr>");
          foreach($stmt as $row)
          {
            echo("<tr>\n");
            echo("<td><center>{$row['VAT_doctor']}</center></td>\n");
            echo("<td><center>{$row['date_timestamp']}</center></td>\n");
            echo("<td><center>{$row['_description']}</center></td>\n");
            echo("<td><center>{$row['VAT_client']}</center></td>\n");
            echo("<td><a href=\"newconsultation.php?appointment=");
            echo($row['VAT_client']. ",".$row['VAT_doctor']. "," .$row['date_timestamp']);
            echo("\"><center>Add Consultation info</center></a></td>\n");
            echo("</tr>\n");
          }
          echo("</table>\n\n");
        }
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
