<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
  <div class="container">
  <br>
  <form action="insertconsultation3.php" method="post">

    <?php
    $VAT_doctor = $_REQUEST['VAT_doctor'];
    $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
    $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
    $dcID = $_REQUEST['ID'];

    $host = "db.ist.utl.pt";
    $user = "ist187094";
    $pass = "stlk1710";
    $dsn = "mysql:host=$host;dbname=$user";
    try
    {
      $connection = new PDO($dsn, $user, $pass);


      $sql = "INSERT INTO consultation_diagnostic VALUES (:VAT_doctor, :date_timestamp, :dcID)";

      $stmt = $connection->prepare($sql);

      if ($stmt== FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      else {
        $stmt->bindParam(':VAT_doctor', $VAT_doctor);
        $stmt->bindParam(':date_timestamp', $date_timestamp);
        $stmt->bindParam(':dcID', $dcID);

        $stmt->execute();

        $nrows = $stmt->rowCount();
        if ($nrows==1) {
          echo("<br><div class=\"container\">");
          echo("<div class=\"alert alert-success\">");
          echo("<strong>The diagnostic $dcID has been added to the consultation of $date_timestamp with the doctor $VAT_doctor</strong></div>");
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

    echo("<br>");
    echo("<h3>Insert a prescription for the diagnostic:</h3>");
    echo("<br>");
    ?>

    <p><input type="hidden" name="VAT_doctor"
    value="<?=$VAT_doctor?>"/></p>
    <p><input type="hidden" name="date_timestamp"
    value="<?=$date_timestamp?>"/></p>
    <p><input type="hidden" name="dcID"
    value="<?=$dcID?>"/></p>

    <p>Name:
      <select name="_name">
    <?php
    $host = "db.ist.utl.pt";
    $user = "ist187094";
    $pass = "stlk1710";
    $dsn = "mysql:host=$host;dbname=$user";
    try
    {
      $connection = new PDO($dsn, $user, $pass);


      $sql = "SELECT _name FROM medication ORDER BY _name";

      $stmt = $connection->prepare($sql);

      if ($stmt== FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      else {
        $stmt->execute();

        foreach($stmt as $row)
        {
          $_name = $row['_name'];
          echo("<option value=\"$_name\">$_name</option>");
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
    </select>
    </p>

    <p>Dosage: <input type="text" name="dosage" required/></p>
    <p>Description: <input type="text" name="_description" required/></p>



  <br><br>
  <p><button class="btn btn-primary" type="submit"/>Add</button></p>
  </form>

  <form action="insertconsultation4.php" method="post">
  <input type="submit" class="btn btn-primary" value="No prescription">
  <?php
  $VAT_doctor = $_REQUEST['VAT_doctor'];
  $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
  $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
  ?>
  <p><input type="hidden" name="VAT_doctor"
  value="<?=$VAT_doctor?>"/></p>
  <p><input type="hidden" name="date_timestamp"
  value="<?=$date_timestamp?>"/></p>
  </form>
  </div>
  </body>
</html>
