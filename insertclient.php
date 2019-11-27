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

      $VAT = $_REQUEST['VAT'];
      $name = $_REQUEST['name'];
      $birth_date = $_REQUEST['birth_date'];
      $street = $_REQUEST['street'];
      $city = $_REQUEST['city'];
      $zip = $_REQUEST['zip'];
      $gender = $_REQUEST['gender'];
      $age = date_diff(date_create($birth_date), date_create('today'))->y;

      $sql = "INSERT INTO client VALUES (:VAT, :name, :birth_date, :street, :city, :zip, :gender, :age)";

      $stmt = $connection->prepare($sql);

      if ($stmt== FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      else{
        $stmt->bindParam(':VAT', $VAT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':birth_date', $birth_date);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':zip', $zip);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':age', $age);
        # execution
        $stmt->execute();
        $nrows = $stmt->rowCount();
        if ($nrows==1){
          echo("<p>A new client, $name ($VAT) was added!</p>");
        }
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
