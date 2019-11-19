<html>
  <body>
    <?php
      $host = "db.tecnico.ulisboa.pt";
      $user = "ist187136";
      $pass = "xxx";
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
      $VAT = $_REQUEST['name'];
      $VAT = $_REQUEST['address'];
      $sql = "SELECT _name FROM client WHERE VAT='$VAT' or _name='%$name'
        or street='%$address' or zip='%$address' or city='%$address'";
      echo("<p>$sql</p>");
      $result = $connection->query($sql);
      $nrows = $result->rowCount();
      if ($nrows == 0)
      {
        echo("<p>There is no client with such VAT number, name or address.</p>");
      }
      else
      {
        $row = $result->fetch();
        $_name = $row['_name'];
        echo("<p>The name of $account_number is: $_name</p>");
      }
      $connection = null;
    ?>
  </body>
</html>
