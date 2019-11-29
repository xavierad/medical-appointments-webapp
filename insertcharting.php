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
      $_name = "Dental charting";
      $VAT_doctor = $_REQUEST['VAT_doctor'];
      $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
      $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
      $_description = $_REQUEST['_description'];
      $insertions = $_REQUEST['insertions'];

      $connection->beginTransaction();

      $sql = "INSERT IGNORE INTO procedure_in_consultation VALUES ('$_name', '$VAT_doctor', '$date_timestamp', '$_description')";
      echo("<p>$sql</p>");
      $nrows = $connection->exec($sql);

      echo("<p>Rows inserted: $nrows</p>");

      $sql = "DELETE IGNORE FROM procedure_charting WHERE VAT = '$VAT_doctor' AND date_timestamp = '$date_timestamp'";
      echo("<p>$sql</p>");
      $nrows = $connection->exec($sql);
      if ($nrows == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        #exit();
      }
      echo("<p>Rows deleted: $nrows</p>");

      for($i=0; $i < $_REQUEST['insertions']; $i++){

        $quadrant = $_REQUEST["quadrant".$i];
        $_number = $_REQUEST["_number".$i];
        $measure = $_REQUEST["measure".$i];
        $_desc = $_REQUEST["_desc".$i];

        $sql = "INSERT INTO procedure_charting VALUES ('$_name', '$VAT_doctor', '$date_timestamp', '$quadrant', '$_number', '$_desc', '$measure')";
        echo("<p>$sql</p>");
        $nrows = $connection->exec($sql);
        if ($nrows == FALSE)
        {
          $info = $connection->errorInfo();
          $connection->rollback();
          echo("<p>Error: {$info[2]}</p>");
          exit();
        }
        echo("<p>Rows inserted: $nrows</p>");
      }

      echo("<td><a href=\"consultation.php?consultation=");
      echo($VAT_doctor. "," .$date_timestamp);
      echo("\">Back to Consultation Info</a></td>\n");

      $connection->commit();
      $connection = null;
    ?>
  </body>
</html>
