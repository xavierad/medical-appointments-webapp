<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
    <?php
      $host = "db.tecnico.ulisboa.pt";
      $user = "ist187094";
      $pass = "stlk1710";
      $dsn = "mysql:host=$host;dbname=$user";
      try
      {
        $connection = new PDO($dsn, $user, $pass);

        $_name = "Dental charting";
        $VAT_doctor = $_REQUEST['VAT_doctor'];
        $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
        $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
        $_description = $_REQUEST['_description'];
        $insertions = $_REQUEST['insertions'];

        $connection->beginTransaction();

        $sql = "DELETE IGNORE FROM procedure_in_consultation WHERE _name = :_name AND VAT_doctor = :VAT_doctor AND date_timestamp = :date_timestamp";
        $stmt = $connection->prepare($sql);

        if ($stmt== FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          $connection->rollback();
          exit();
        }
        else{
          $stmt->bindParam(':_name', $_name);
          $stmt->bindParam(':VAT_doctor', $VAT_doctor);
          $stmt->bindParam(':date_timestamp', $date_timestamp);
          # execution
          $stmt->execute();
          $nrows = $stmt->rowCount();
        }

        $sql = "INSERT INTO procedure_in_consultation VALUES (:_name, :VAT_doctor, :date_timestamp, :_description)";
        $stmt = $connection->prepare($sql);

        if ($stmt== FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          $connection->rollback();
          exit();
        }
        else{
          $stmt->bindParam(':_name', $_name);
          $stmt->bindParam(':VAT_doctor', $VAT_doctor);
          $stmt->bindParam(':date_timestamp', $date_timestamp);
          $stmt->bindParam(':_description', $_description);
          # execution
          $stmt->execute();
          $nrows = $stmt->rowCount();
        }

        $sql = "DELETE IGNORE FROM procedure_charting WHERE VAT = :VAT_doctor AND date_timestamp = :date_timestamp";
        $stmt = $connection->prepare($sql);

        if ($stmt== FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          exit();
        }
        else{
          $stmt->bindParam(':VAT_doctor', $VAT_doctor);
          $stmt->bindParam(':date_timestamp', $date_timestamp);
          # execution
          $stmt->execute();
          $nrows = $stmt->rowCount();
        }

        $sql = "INSERT INTO procedure_charting VALUES (:_name, :VAT_doctor, :date_timestamp, :quadrant, :_number, :_desc, :measure)";
        $stmt = $connection->prepare($sql);
        $_nrows = 0;

        if ($stmt== FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          exit();
        }
        else{
          for($i=0; $i < $_REQUEST['insertions']; $i++){

            $quadrant = $_REQUEST["quadrant".$i];
            $_number = $_REQUEST["_number".$i];
            $measure = $_REQUEST["measure".$i];
            $_desc = $_REQUEST["_desc".$i];

          $stmt->bindParam(':_name', $_name);
          $stmt->bindParam(':VAT_doctor', $VAT_doctor);
          $stmt->bindParam(':date_timestamp', $date_timestamp);
          $stmt->bindParam(':quadrant', $quadrant);
          $stmt->bindParam(':_number', $_number);
          $stmt->bindParam(':measure', $measure);
          $stmt->bindParam(':_desc', $_desc);
          # execution
          $stmt->execute();
          $nrows = $stmt->rowCount();

          if ($nrows > 0){
            $_nrows = $_nrows + $nrows;
          }
          else {
            $connection->rollback();
            exit();
          }
          }
          if ($_nrows > 0){
            echo("<br><div class=\"container\">");
            echo("<div class=\"alert alert-success\">");
            echo("<strong>New dental charting procedure was created! (Rows inserted: $_nrows)</strong></div></div>");
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

      $connection->commit();
      $connection = null;
    ?>
  </body>
</html>
