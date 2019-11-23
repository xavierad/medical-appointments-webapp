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
    $name = $_REQUEST['name'];
    $birth_date = $_REQUEST['birth_date'];
    $street = $_REQUEST['street'];
    $city = $_REQUEST['city'];
    $zip = $_REQUEST['zip'];
    $gender = $_REQUEST['gender'];
    $age = $_REQUEST['age'];

    $sql = "INSERT INTO client VALUES ('$VAT', '$name', '$birth_date', '$street', '$city', '$zip', '$gender', $age)";
    echo("<p>$sql</p>");
    $nrows = $connection->exec($sql);
    echo("<p>Rows inserted: $nrows</p>");
    $connection = null;
  ?>
  </body>
</html>
