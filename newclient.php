<html>
  <body>
  <form action="insertclient.php" method="post">
  <h3>Insert a new client</h3>
  <p>VAT: <input type="text" name="VAT"/></p>
  <p>Name: <input type="text" name="name"/></p>
  <p>Birth date (AAAA-MM-DD): <input type="text" name="birth_date"/></p>
  <p>Street: <input type="text" name="street"/></p>
  <p>City: <input type="text" name="city"/></p>
  <p>Zip: <input type="text" name="zip"/></p>
  <p>Gender: <input type="text" name="gender"/></p>
  <p>Age: <input type="text" name="age"/></p>
  <?php
    $host = "db.ist.utl.pt";
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

    $connection = null;
  ?>
  </select>
  </p>
  <p><input type="submit" value="Submit"/></p>
  </form>
  </body>
</html>
