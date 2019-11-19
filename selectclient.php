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
      $name = $_REQUEST['name'];
      $address = $_REQUEST['address'];
      $sql = "SELECT * FROM client WHERE VAT = $VAT "; # (VAT = $VAT) or (_name like '$name%') or (city like '%$address%') or (zip like '%$address%') or (street like '%$address%'
      echo("<p>$sql</p>");
      $result = $connection->query($sql);
      if ($result == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      $nrows = $result->rowCount();
      echo($nrows);
      if ($nrows == 0)
      {
        echo("<p>There is no client with such VAT number, name or address.</p>");
      }
      else
      {
        echo("<table border=\"1\">");
        echo("<tr><td>Client VAT</td><td>Client name</td></tr>");
        foreach($result as $row)
        {
          echo("<tr><td>");
          echo($row['VAT']);
          echo("</td><td>");
          echo($row['_name']);
          /*echo("</td><td>");
          echo($row['balance']);*/
          echo("</td></tr>");
        }
        echo("</table>");
      }
      $connection = null;
    ?>
  </body>
</html>
