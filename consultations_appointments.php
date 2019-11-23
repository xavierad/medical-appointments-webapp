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

    $VAT = $_REQUEST['VAT'];

    $sql = "SELECT * FROM appointment WHERE VAT_client = '$VAT' ORDER BY date_timestamp";
    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }
    echo("<h3>Appointments:</h3>");
    echo("<table border=\"1\">");
    echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>_description</td><td>VAT_client</td></tr>");
    foreach($result as $row)
    {
      echo("<tr>\n");
      echo("<td>{$row['VAT_doctor']}</td>\n");
      echo("<td>{$row['date_timestamp']}</td>\n");
      echo("<td>{$row['_description']}</td>\n");
      echo("<td>{$row['VAT_client']}</td>\n");
      echo("<td><a href=\"appointment.php?appointment=");
      echo($row['VAT_client']. "," .$row['date_timestamp']);
      //echo($row['VAT_client']);
      //echo($row['date_timestamp']);
      echo("\">Appointment Info</a></td>\n");
      echo("</tr>\n");
    }
    echo("</table>\n\n");

    $sql = "SELECT C.VAT_doctor, C.date_timestamp, C.SOAP_S, C.SOAP_O, C.SOAP_A, C.SOAP_P FROM consultation as C, appointment as A WHERE C.VAT_doctor = A.VAT_doctor AND C.date_timestamp = A.date_timestamp and A.VAT_client = '$VAT' ORDER BY C.date_timestamp";
    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }
    echo("<h3>Consultations:</h3>");
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
    echo("</table>\n");
    $connection = null;
?>
  </body>
</html>
