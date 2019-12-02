<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
  <div class="container">
  <br>
  <h3>Clients</h3>
    <?php
      $host = "db.tecnico.ulisboa.pt";
      $user = "ist187094";
      $pass = "stlk1710";
      $dsn = "mysql:host=$host;dbname=$user";
      try
      {
        $connection = new PDO($dsn, $user, $pass);

        $VAT = $_REQUEST['VAT'];
        $name = $_REQUEST['name'];
        $city = $_REQUEST['city'];
        $street = $_REQUEST['street'];
        $zip = $_REQUEST['zip'];
        $sql = "SELECT * FROM client
                WHERE 1";
        if (!empty($VAT)) {
         $sql .= " AND VAT = :VAT";
        }
        if (!empty($name)) {
         $sql .= " AND _name like  CONCAT('%',:name,'%')";
        }
        if (!empty($city)) {
         $sql .= " AND (city like CONCAT('%',:city,'%'))";
        }
        if (!empty($street)) {
         $sql .= " AND (street like CONCAT('%',:street,'%'))";
        }
        if (!empty($zip)) {
         $sql .= " AND (zip like CONCAT('%',:zip,'%'))";
        }

        $stmt = $connection->prepare($sql);
        if ($stmt == FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          exit();
        }
        else {
          if (!empty($VAT)) {
           $stmt->bindParam(':VAT', $VAT);;
          }
          if (!empty($name)) {
           $stmt->bindParam(':name', $name);
          }
          if (!empty($city)) {
           $stmt->bindParam(':city', $city);
          }
          if (!empty($street)) {
           $stmt->bindParam(':street', $street);
          }
          if (!empty($zip)) {
           $stmt->bindParam(':zip', $zip);
          }
          # execution
          $stmt->execute();
          $nrows = $stmt->rowCount();
          echo("<p>$nrows client(s) matched</p>");
          if ($nrows == 0)
          {
            echo("<p>There is no client with such VAT number, name or address. Click de link below to create a new client</p>");
          }
          else
          {
            echo("<table cellpadding=\"5\" border=\"1\" cellspacing=\"2\">\n");
            echo("<tr><td><center>VAT</center></td><td><center>Name</center></td><td><center>Birth date</center></td><td><center>Street</center></td><td><center>City</center></td><td><center>Zip</center></td><td><center>Gender</center></td><td><center>Age</center></td></tr>");
            foreach($stmt as $row)
            {
              echo("<tr>");
              echo("<td><center>{$row['VAT']}</center></td>");
              echo("<td><center>{$row['_name']}</center></td>");
              echo("<td><center>{$row['birth_date']}</center></td>");
              echo("<td><center>{$row['street']}</center></td>");
              echo("<td><center>{$row['city']}</center></td>");
              echo("<td><center>{$row['zip']}</center></td>");
              echo("<td><center>{$row['gender']}</center></td>");
              echo("<td><center>{$row['age']}</center></td>");
              echo("<td><a href=\"consultations_appointments.php?VAT=");
              echo($row['VAT']);
              echo("\"><center>Consultations/Appointments</center></a></td>");
              echo("<td><a href=\"newappointment.php?VAT_client=".$row['VAT']."&client_name=".$row['_name']);
              echo("\"><center>New appointment</center></a></td>\n");
              echo("</tr>\n");
            }
            echo("</table>\n");
          }
          echo("<td><a href=\"newclient.php?");
          echo("\"><p>New client</p></a></td>\n");
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
