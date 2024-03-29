<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
  <div class="container">
  <br>
  <form action="insertconsultation2.php" method="post">
    <?php

      $VAT_doctor = $_REQUEST['VAT_doctor'];
      $date_timestamp_aux = strtotime($_REQUEST['date_timestamp']);
      $date_timestamp = date("Y-m-d H:i:s", $date_timestamp_aux);

      echo("<h3>Insert a nurse for the consultation:</h3>");
      echo("<br>");


    ?>

    <p><input type="hidden" name="VAT_doctor"
    value="<?=$VAT_doctor?>"/></p>
    <p><input type="hidden" name="date_timestamp"
    value="<?=$date_timestamp?>"/></p>

  <?php
    $host = "db.ist.utl.pt";
    $user = "ist187094";
    $pass = "stlk1710";
    $dsn = "mysql:host=$host;dbname=$user";
    try
    {
      $connection = new PDO($dsn, $user, $pass);


      $sql = "SELECT VAT FROM nurse N
              WHERE N.VAT NOT IN (SELECT CA.VAT_nurse FROM consultation_assistant CA WHERE CA.VAT_doctor = :VAT_doctor AND CA.date_timestamp = :date_timestamp)";

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

        $stmt->execute();
        $nrows = $stmt->rowCount();
        if($nrows==0){
          echo("<br><div class=\"container\">");
          echo("<div class=\"alert alert-warning\">");
          echo("<strong>There is no more nurses available!</strong></div></div>");
        }
        else{
          echo("<p>Nurse (VAT):");
          echo("<select name=\"VAT_nurse\">");
          foreach($stmt as $row)
          {
            $VAT_nurse = $row['VAT'];
            echo("<option value=\"$VAT_nurse\">$VAT_nurse</option>");
          }
          echo("</select>");
          echo("</p><br><br><p><button class=\"btn btn-primary\" type=\"submit\"/>Add</button></p>");
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


  </div>
  </body>
</html>
