<html>
  <body>
  <form action="insertconsultation4.php" method="post">

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
    }
    catch(PDOException $exception)
    {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
      exit();
    }

    $sql = "INSERT INTO consultation_diagnostic VALUES ('$VAT_doctor', '$date_timestamp', '$dcID')";
    echo("<p>$sql</p>");
    $nrows = $connection->exec($sql);
    if ($nrows == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }
    echo("<p>Rows inserted in (consultation_diagnostic): $nrows</p>");
    $connection = null;

    echo("<h3>Insert a prescription for the diagnostic:</h3>");
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
    }
    catch(PDOException $exception)
    {
      echo("<p>Error: ");
      echo($exception->getMessage());
      echo("</p>");
      exit();
    }

    $sql = "SELECT _name FROM medication ORDER BY _name";
    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }

    foreach($result as $row)
    {
      $_name = $row['_name'];
      echo("<option value=\"$_name\">$_name</option>");
    }


    $connection = null;
  ?>
    </select>
    </p>

    <p>Dosage: <input type="text" name="dosage" required/></p>
    <p>Description: <input type="text" name="_description" required/></p>




  <p><input type="submit" value="Add"/></p>
  </form>

  <form action="insertconsultation5.php" method="post">
  <input type="submit" value="No prescription">
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

  </body>
</html>
