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

        $VAT_doctor = $_REQUEST['VAT_doctor'];
        $date_timestamp_aux = strtotime($_REQUEST['datetimestamp']);
        $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);
        $_description = $_REQUEST['_description'];
        $VAT_client = $_REQUEST['VAT_client'];

        $sql = "INSERT INTO appointment VALUES (:VAT_doctor, :date_timestamp, :_description, :VAT_client)";

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
          $stmt->bindParam(':_description', $_description);
          $stmt->bindParam(':VAT_client', $VAT_client);;
          # execution
          $stmt->execute();
          $nrows = $stmt->rowCount();
          if ($nrows==1){
            echo("<br>");
            echo("<p>New appointment was created to $_REQUEST[client_name] and dr. $_REQUEST[doctorname]!</p>");
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
