<html>
  <body>
  <form action="insertprescription.php" method="post">
    <?php

      $VAT_doctor = $_REQUEST['VAT_doctor'];
      $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
      $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);

      echo("<h3>Insert a diagnostic for the consultation:</h3>");

    ?>
    <p><input type="hidden" name="VAT_doctor"
    value="<?=$VAT_doctor?>"/></p>
    <p><input type="hidden" name="date_timestamp"
    value="<?=$date_timestamp?>"/></p>

    <p>Diagnostic (ID):
      <select name="ID">
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

    $sql = "SELECT DC.ID FROM diagnostic_code DC
            WHERE DC.ID NOT IN (SELECT CD.ID FROM consultation_diagnostic CD WHERE CD.VAT_doctor = '$VAT_doctor' AND CD.date_timestamp = '$date_timestamp')";

    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }

    foreach($result as $row)
    {
      $ID = $row['ID'];
      echo("<option value=\"$ID\">$ID</option>");
    }


    $connection = null;
  ?>
    </select>
    </p>


  <p><input type="submit" value="Add"/></p>
  </form>
  </body>
</html>
