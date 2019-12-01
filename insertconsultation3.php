<html>
  <body>
    <form action="selectclient.php" method="post">
    <?php
      $host = "db.tecnico.ulisboa.pt";
      $user = "ist187094";
      $pass = "stlk1710";
      $dsn = "mysql:host=$host;dbname=$user";
      try
      {
        $connection = new PDO($dsn, $user, $pass);


        $VAT_doctor = $_REQUEST['VAT_doctor'];
        $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
        $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
        $dcID = $_REQUEST['dcID'];
        $name = $_REQUEST['_name'];
        $dosage = $_REQUEST['dosage'];
        $description = $_REQUEST['_description'];

        $sql = "SELECT lab FROM medication WHERE _name = :name";

        $stmt = $connection->prepare($sql);

        if ($stmt== FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          exit();
        }
        else {
          $stmt->bindParam(':name', $name);

          $stmt->execute();

          foreach($stmt as $row)
          {
            $lab = $row['lab'];
          }
        }

        $sql = "INSERT INTO prescription VALUES (:name, :lab, :VAT_doctor, :date_timestamp, :dcID, :dosage, :description)";

        $stmt = $connection->prepare($sql);

        if ($stmt== FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          exit();
        }
        else {
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':lab', $lab);
          $stmt->bindParam(':VAT_doctor', $VAT_doctor);
          $stmt->bindParam(':date_timestamp', $date_timestamp);
          $stmt->bindParam(':dcID', $dcID);
          $stmt->bindParam(':dosage', $dosage);
          $stmt->bindParam(':description', $description);

          $stmt->execute();

          $nrows = $stmt->rowCount();
          if ($nrows==1) {
            echo("<strong>The prescription $name has been added to the consultation of $date_timestamp with the doctor $VAT_doctor</strong></div></div>");
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

      echo("<h3>Insert more information on the consultation:</h3>");

      echo("<td><a href=\"insertnurse.php?VAT_doctor=".$VAT_doctor."&date_timestamp=".$date_timestamp);
      echo("\">Add Nurse</a></p>\n");

      echo("<p><a href=\"insertdiagnostic.php?VAT_doctor=".$VAT_doctor."&date_timestamp=".$date_timestamp);
      echo("\">Add Diagnostic</a></p>\n");

      $connection = null;
    ?>
    <p><input type="submit" value="Finish"/></p>
  </form>
  </body>
</html>
