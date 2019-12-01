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


      $VAT = $_REQUEST['VAT'];

      $sql = "SELECT * FROM appointment WHERE VAT_client = :VAT ORDER BY date_timestamp";

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

        echo("<h3>Appointments:</h3>");
        echo("<table border=\"1\">");
        echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>_description</td><td>VAT_client</td></tr>");
        foreach($stmt as $row)
        {
          echo("<tr>\n");
          echo("<td>{$row['VAT_doctor']}</td>\n");
          echo("<td>{$row['date_timestamp']}</td>\n");
          echo("<td>{$row['_description']}</td>\n");
          echo("<td>{$row['VAT_client']}</td>\n");
          echo("<td><a href=\"appointment.php?appointment=");
          echo($row['VAT_client']. "," .$row['date_timestamp']);
          echo("\">Appointment Info</a></td>\n");
          echo("</tr>\n");
        }
        echo("</table>\n\n");
      }

      $sql = "SELECT C.VAT_doctor, C.date_timestamp, C.SOAP_S, C.SOAP_O, C.SOAP_A, C.SOAP_P FROM consultation as C, appointment as A WHERE C.VAT_doctor = A.VAT_doctor AND C.date_timestamp = A.date_timestamp AND A.VAT_client = :VAT ORDER BY C.date_timestamp";

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

        echo("<h3>Consultations:</h3>");
        echo("<table border=\"1\">");
        echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>SOAP_S</td><td>SOAP_O</td><td>SOAP_A</td><td>SOAP_P</td></tr>");
        foreach($stmt as $row)
        {
          echo("<tr>\n");
          echo("<td>{$row['VAT_doctor']}</td>\n");
          echo("<td>{$row['date_timestamp']}</td>\n");
          echo("<td>{$row['SOAP_S']}</td>\n");
          echo("<td>{$row['SOAP_O']}</td>\n");
          echo("<td>{$row['SOAP_A']}</td>\n");
          echo("<td>{$row['SOAP_P']}</td>\n");
          echo("<td><a href=\"consultation.php?consultation=");
          echo($row['VAT_doctor']. "," .$row['date_timestamp']);
          echo("\">Consultation Info</a></td>\n");
          echo("</tr>\n");
        }
        echo("</table>\n");
      }
    }

    catch(PDOException $exception)
    {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
      exit();
    }

    echo("<td><a href=\"listappointments.php?VAT=$VAT");
    echo("\"><p>New consultation</p></a></td>\n");

    $connection = null;
?>
  </body>
</html>
