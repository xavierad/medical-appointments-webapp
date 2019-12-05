<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
  <div class="container">
  <br>
  <h3>Consultation Info:</h3>
  <br>

<?php

    if ($tok !== false) {
      $tok = strtok($_REQUEST['consultation'], ",");
      $VAT_doctor = $tok;
    }
    if ($tok !== false) {
      $tok = strtok(",");
      $date_timestamp = $tok;
    }

    $host = "db.tecnico.ulisboa.pt";
    $user = "ist187094";
    $pass = "stlk1710";
    $dsn = "mysql:host=$host;dbname=$user";
    try
    {
      $connection = new PDO($dsn, $user, $pass);



      $sql = "SELECT C.VAT_doctor, C.date_timestamp, C.SOAP_S, C.SOAP_O, C.SOAP_A, C.SOAP_P
              FROM consultation C
              WHERE (C.VAT_doctor NOT IN (SELECT CD.VAT_doctor FROM consultation_diagnostic CD)
                OR C.date_timestamp NOT IN (SELECT CD.date_timestamp FROM consultation_diagnostic CD))
              AND C.VAT_doctor = :VAT_doctor
              AND C.date_timestamp = :date_timestamp";

      $stmt = $connection->prepare($sql);
      if ($stmt == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }
      else {
        $stmt->bindParam(':VAT_doctor', $VAT_doctor);
        $stmt->bindParam(':date_timestamp', $date_timestamp);
        $stmt->execute();

        echo("<table cellpadding=\"5\" border=\"1\" cellspacing=\"2\">");
        echo("<tr><td><center>VAT doctor</center></td><td><center>Date</center></td><td><center>SOAP S</center></td><td><center>SOAP O</center></td><td><center>SOAP A</center></td><td><center>SOAP P</center></td><td><center>Diagnostic ID</center></td><td><center>Diagnostic Description</center></td><td><center>Prescription Name</center></td><td><center>Prescription Lab</center></td><td><center>Prescription Dosage</center></td><td><center>Prescription Description</center></td></tr>");

        foreach($stmt as $row)
        {
          echo("<tr>\n");
          echo("<td><center>{$row['VAT_doctor']}</center></td>\n");
          echo("<td><center>{$row['date_timestamp']}</center></td>\n");
          echo("<td><center>{$row['SOAP_S']}</center></td>\n");
          echo("<td><center>{$row['SOAP_O']}</center></td>\n");
          echo("<td><center>{$row['SOAP_A']}</center></td>\n");
          echo("<td><center>{$row['SOAP_P']}</center></td>\n");
          echo("<td><center></center></td>\n");
          echo("<td><center></center></td>\n");
          echo("<td><center></center></td>\n");
          echo("<td><center></center></td>\n");
          echo("<td><center></center></td>\n");
          echo("<td><center></center></td>\n");
          echo("</tr>\n");
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

<?php
    $host = "db.tecnico.ulisboa.pt";
    $user = "ist187094";
    $pass = "stlk1710";
    $dsn = "mysql:host=$host;dbname=$user";
    try
    {
      $connection = new PDO($dsn, $user, $pass);


      $sql = "SELECT C.VAT_doctor, C.date_timestamp, C.SOAP_S, C.SOAP_O, C.SOAP_A, C.SOAP_P, CD.ID, DC._description
              FROM consultation C, consultation_diagnostic CD, diagnostic_code DC
              WHERE CD.ID  NOT IN (SELECT P.ID FROM prescription P WHERE P.VAT_doctor=:VAT_doctor AND P.date_timestamp=:date_timestamp)
              AND C.VAT_doctor = :VAT_doctor
              AND C.date_timestamp = :date_timestamp
              AND C.VAT_doctor = CD.VAT_doctor
              AND C.date_timestamp = CD.date_timestamp
              AND CD.ID = DC.ID";

      $stmt = $connection->prepare($sql);
      if ($stmt == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }

      else {
        $stmt->bindParam(':VAT_doctor', $VAT_doctor);
        $stmt->bindParam(':date_timestamp', $date_timestamp);
        $stmt->execute();

        foreach($stmt as $row)
        {
          echo("<tr>\n");
          echo("<td><center>{$row['VAT_doctor']}</center></td>\n");
          echo("<td><center>{$row['date_timestamp']}</center></td>\n");
          echo("<td><center>{$row['SOAP_S']}</center></td>\n");
          echo("<td><center>{$row['SOAP_O']}</center></td>\n");
          echo("<td><center>{$row['SOAP_A']}</center></td>\n");
          echo("<td><center>{$row['SOAP_P']}</center></td>\n");
          echo("<td><center>{$row['ID']}</center></td>\n");
          echo("<td><center>{$row[7]}</center></td>\n");
          echo("<td><center></center></td>\n");
          echo("<td><center></center></td>\n");
          echo("<td><center></center></td>\n");
          echo("<td><center></center></td>\n");
          echo("</tr>\n");
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

<?php
    $host = "db.tecnico.ulisboa.pt";
    $user = "ist187094";
    $pass = "stlk1710";
    $dsn = "mysql:host=$host;dbname=$user";
    try
    {
      $connection = new PDO($dsn, $user, $pass);


      $sql = "SELECT C.VAT_doctor, C.date_timestamp, C.SOAP_S, C.SOAP_O, C.SOAP_A, C.SOAP_P, DC.ID, DC._description, P._name, P.lab, P.dosage, P._description
              FROM consultation C, consultation_diagnostic CD, diagnostic_code DC, prescription P
              WHERE C.VAT_doctor = :VAT_doctor
              AND C.date_timestamp = :date_timestamp
              AND C.VAT_doctor = CD.VAT_doctor
              AND C.date_timestamp = CD.date_timestamp
              AND CD.ID = DC.ID
              AND CD.VAT_doctor = P.VAT_doctor
              AND CD.date_timestamp = P.date_timestamp
              AND CD.ID = P.ID";

      $stmt = $connection->prepare($sql);
      if ($stmt == FALSE)
      {
        $info = $connection->errorInfo();
        echo("<p>Error: {$info[2]}</p>");
        exit();
      }

      else {
        $stmt->bindParam(':VAT_doctor', $VAT_doctor);
        $stmt->bindParam(':date_timestamp', $date_timestamp);
        $stmt->execute();

        foreach($stmt as $row)
        {
          echo("<tr>\n");
          echo("<td><center>{$row['VAT_doctor']}</center></td>\n");
          echo("<td><center>{$row['date_timestamp']}</center></td>\n");
          echo("<td><center>{$row['SOAP_S']}</center></td>\n");
          echo("<td><center>{$row['SOAP_O']}</center></td>\n");
          echo("<td><center>{$row['SOAP_A']}</center></td>\n");
          echo("<td><center>{$row['SOAP_P']}</center></td>\n");
          echo("<td><center>{$row['ID']}</center></td>\n");
          echo("<td><center>{$row[7]}</center></td>\n");
          echo("<td><center>{$row['_name']}</center></td>\n");
          echo("<td><center>{$row['lab']}</center></td>\n");
          echo("<td><center>{$row['dosage']}</center></td>\n");
          echo("<td><center>{$row['_description']}</center></td>\n");
          echo("</tr>\n");
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

    echo("</table>\n\n");
    echo("<td><a href=\"newprocedure.php?VAT_doctor=".$row['VAT_doctor']."&date_timestamp=".$row['date_timestamp']);
    echo("\"><p>Insert Dental Charting Procedure</p></a></td>\n");

    $connection = null;
?>

  </body>
</html>
