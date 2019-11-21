<html>
  <body>
  <h3>Clients</h3>
    <?php
      $host = "db.tecnico.ulisboa.pt";
      $user = "ist187136";
      $pass = "xx";
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
      $sql = "SELECT * FROM client WHERE (_name like '%$name%') "; # (VAT = $VAT) or (_name like '%$name%') or (city like '%$address%') or (zip like '%$address%') or (street like '%$address%'
      echo("<p>$sql</p>");
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
        echo("<tr><td>Client VAT</td><td>Client name</td><td>Birth date</td></tr>");
        foreach($result as $row)
        {
          echo("<tr><td>");
          echo($row['VAT']);
          echo("</td><td>");
          echo($row['_name']);
          echo("</td><td>");
          echo($row['birth_date']);
          /*echo($row['street']);
          echo("</td><td>");
          echo($row['city']);
          echo("</td><td>");
          echo($row['zip']);
          echo("</td><td>");
          echo($row['gender']);
          echo("</td><td>");
          echo($row['age']);*/
          echo("<td><a href=\"newappointment.php?client="); # alterar account_number!
          echo($row['_name']. ", " .$row['VAT']);
          echo("\">New appointment</a></td>\n");
          echo("</td></tr>");
        }
        echo("</table>");
        echo("<td><a href=\"newclient.php?"); # alterar account_number!
        # echo($row['account_number']); # alterar account_number!
        echo("\"><p>New client</p></a></td>\n");
      }
      $connection = null;
    ?>
  </body>
</html>
