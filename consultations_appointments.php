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
        $nrows = $stmt->rowCount();
        echo("<h3>Appointments:</h3>");
        if($nrows==0){
          echo("<p><strong>There is no appointments for this client</strong></p>");
        }
        else{
          echo("<table cellpadding=\"5\" border=\"1\" cellspacing=\"2\">\n");
          echo("<tr><td><center>VAT doctor</center</td><td><center>Date</center</td><td><center>Description</center</td><td><center>VAT client</center</td></tr>");
          foreach($stmt as $row)
          {
            echo("<tr>\n");
            echo("<td><center>{$row['VAT_doctor']}</center</td>\n");
            echo("<td><center>{$row['date_timestamp']}</center</td>\n");
            echo("<td><center>{$row['_description']}</center</td>\n");
            echo("<td><center>{$row['VAT_client']}</center</td>\n");
            echo("<td><a href=\"appointment.php?appointment=");
            echo($row['VAT_client']. "," .$row['date_timestamp']);
            echo("\"><center>Appointment Info</center</a></td>\n");
            echo("</tr>\n");
          }
          echo("</table>\n\n");
        }
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
        $nrows = $stmt->rowCount();
        echo("<br><br>");
        echo("<h3>Consultations:</h3>");
        if($nrows==0){
          echo("<p><strong>There is no consultations for this client</strong></p>");
        }
        else{
          echo("<table cellpadding=\"5\" border=\"1\" cellspacing=\"2\">\n");
          echo("<tr><td><center>VAT doctor</center></td><td><center>Date</center></td><td><center>SOAP S</center></td><td><center>SOAP O</center></td><td><center>SOAP A</center></td><td><center>SOAP P</center></td></tr>");
          foreach($stmt as $row)
          {
            echo("<tr>\n");
            echo("<td><center>{$row['VAT_doctor']}</center></td>\n");
            echo("<td><center>{$row['date_timestamp']}</center></td>\n");
            echo("<td><center>{$row['SOAP_S']}</center></td>\n");
            echo("<td><center>{$row['SOAP_O']}</center></td>\n");
            echo("<td><center>{$row['SOAP_A']}</center></td>\n");
            echo("<td><center>{$row['SOAP_P']}</center></td>\n");
            echo("<td><a href=\"consultation.php?consultation=");
            echo($row['VAT_doctor']. "," .$row['date_timestamp']);
            echo("\"><center>Consultation Info</center></a></td>\n");
            echo("</tr>\n");
          }
          echo("</table>\n");
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

    echo("<td><a href=\"listappointments.php?VAT=$VAT");
    echo("\"><p>New consultation</p></a></td>\n");

    $connection = null;
?>
  </body>
</html>
