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
    $age = date_diff(date_create('1970-02-01'), date_create('today'))->y;

    $sql = "INSERT INTO client VALUES ('$VAT', '$name', '$birth_date', '$street', '$city', '$zip', '$gender', $age)";
    $nrows = $connection->exec($sql);
    echo("<p>A new client, $name ($VAT) was added!</p>");
    $connection = null;
  ?>
  </body>
</html>
