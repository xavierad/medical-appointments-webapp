<html>
  <body>
  <form action="insertconsultation4.php" method="post">

    <?php
    $VAT_doctor = $_REQUEST['VAT_doctor'];
    $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
    $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
    $dcID = $_REQUEST['dcID'];

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
    ?>

    <p><input type="hidden" name="VAT_doctor"
    value="<?=$VAT_doctor?>"/></p>
    <p><input type="hidden" name="date_timestamp"
    value="<?=$date_timestamp?>"/></p>


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
      $dcID = $row['ID'];
      echo("<option value=\"$Pname\">$Pname</option>");
    }

    $connection = null;
  ?>
    </select>
    </p>


  <p><input type="submit" value="Add"/></p>

  </body>
</html>
