<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
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
        $VAT_nurse = $_REQUEST['VAT_nurse'];

        $sql = "INSERT INTO consultation_assistant VALUES (:VAT_doctor, :date_timestamp, :VAT_nurse)";

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
          $stmt->bindParam(':VAT_nurse', $VAT_nurse);

          $stmt->execute();

          $nrows = $stmt->rowCount();
          if ($nrows==1) {
            echo("<br><div class=\"container\">");
            echo("<div class=\"alert alert-success\">");
            echo("<strong>The nurse $VAT_nurse has been added to the consultation of $date_timestamp with the doctor $VAT_doctor</strong></div>");
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

      echo("<br><div class=\"container\">");
      echo("<h3>Insert more information on the consultation:</h3>");
      echo("<br>");
      echo("<td><a href=\"insertnurse.php?VAT_doctor=".$VAT_doctor."&date_timestamp=".$date_timestamp);
      echo("\">Add Nurse</a></p>\n");

      echo("<p><a href=\"insertdiagnostic.php?VAT_doctor=".$VAT_doctor."&date_timestamp=".$date_timestamp);
      echo("\">Add Diagnostic</a></p>\n");
      echo("<br><br>");


      $connection = null;
    ?>
    <p><button class="btn btn-primary" type="submit"/>Finish</button></p>
    </div>
  </div>
  </body>
</html>
