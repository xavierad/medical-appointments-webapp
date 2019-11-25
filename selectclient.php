<html>
  <body>
  <h3>Clients</h3>
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
      $name = $_REQUEST['name'];
      $address = $_REQUEST['address'];
      $sql = "SELECT * FROM client
              WHERE 1";
      if (!empty($VAT)) {
       $sql .= " AND VAT = $VAT";
      }
      if (!empty($name)) {
       $sql .= " AND _name like '%$name%'";
      }
      if (!empty($address)) {
       $sql .= " AND (city like '%$address%' or zip like '%$address%' or street like '%$address%')";
      }
      $result = $connection->query($sql);
      if ($result == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      $nrows = $result->rowCount();
      echo("<p>$nrows client(s) matched</p>");
      if ($nrows == 0)
      {
        echo("<p>There is no client with such VAT number, name or address.</p>");
      }
      else
      {
        echo("<table border=\"1\" cellspacing=\"2\">\n");
        echo("<tr><td>Client's VAT</td><td>Client's name</td><td>Birth date</td><td>Street</td><td>City</td><td>Zip</td><td>Gender</td><td>Age</td></tr>");
        foreach($result as $row)
        {
          echo("<tr>\n");
          echo("<td>{$row['VAT']}</td>\n");
          echo("<td>{$row['_name']}</td>\n");
          echo("<td>{$row['birth_date']}</td>\n");
          echo("<td>{$row['street']}</td>");
          echo("<td>{$row['city']}</td>");
          echo("<td>{$row['zip']}</td>");
          echo("<td>{$row['gender']}</td>");
          echo("<td>{$row['age']}</td>");
          echo("</td><td>");
          echo("<td><a href=\"consultations_appointments.php?VAT=");
          echo($row['VAT']);
          echo("\">Consultations/Appointments</a></td>\n");
          echo("<td><a href=\"newappointment.php?VAT_client=".$row['VAT']."&client_name=".$row['_name']);
          # echo($row['_name']. ", " .$row['VAT']);
          echo("\">New appointment</a></td>\n");
          echo("</tr>\n");
        }
        echo("</table>\n");
        echo("<td><a href=\"newclient.php?");
        echo("\"><p>New client</p></a></td>\n");
      }
      $connection = null;
    ?>
  </body>
</html>
