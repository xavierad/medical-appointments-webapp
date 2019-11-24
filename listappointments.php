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

    $VAT = $_REQUEST['VAT'];

    $sql = "SELECT A.VAT_doctor, A.date_timestamp, A._description, A.VAT_client
            FROM  appointment A
            LEFT JOIN consultation C
            ON A.date_timestamp = C.date_timestamp
            AND A.VAT_doctor = C.VAT_doctor
            WHERE C.date_timestamp is null
            AND C.VAT_doctor is null
            AND A.VAT_client = $VAT";

    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }
    echo("<h3>Free appointments:</h3>");
    echo("<table border=\"1\">");
    echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>_description</td><td>VAT_client</td></tr>");
    foreach($result as $row)
    {
      echo("<tr>\n");
      echo("<td>{$row['VAT_doctor']}</td>\n");
      echo("<td>{$row['date_timestamp']}</td>\n");
      echo("<td>{$row['_description']}</td>\n");
      echo("<td>{$row['VAT_client']}</td>\n");
      echo("<td><a href=\"newconsultation.php?appointment=");
      echo($row['VAT_client']. ",".$row['VAT_doctor']. "," .$row['date_timestamp']);
      echo("\">Add Consultation info</a></td>\n");
      echo("</tr>\n");
    }
    echo("</table>\n\n");
    $connection = null;
?>
  </body>
</html>
