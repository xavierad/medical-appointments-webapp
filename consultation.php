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

    if ($tok !== false) {
      $tok = strtok($_REQUEST['consultation'], ",");
      $VAT_doctor = $tok;
    }
    if ($tok !== false) {
      $tok = strtok(",");
      $date_timestamp = $tok;
    }

    $sql = "SELECT C.VAT_doctor, C.date_timestamp, C.SOAP_S, C.SOAP_O, C.SOAP_A, C.SOAP_P, DC.ID, DC._description, P._name, P.lab, P.dosage, P._description
            FROM consultation C, consultation_diagnostic CD, diagnostic_code DC, prescription P
            WHERE C.VAT_doctor = '$VAT_doctor'
            AND C.date_timestamp = '$date_timestamp'
            AND C.VAT_doctor = CD.VAT_doctor
            AND C.date_timestamp = CD.date_timestamp
            AND CD.ID = DC.ID
            AND CD.VAT_doctor = P.VAT_doctor
            AND CD.date_timestamp = P.date_timestamp
            AND CD.ID = P.ID";

    $result = $connection->query($sql);
    if ($result == FALSE)
    {
      $info = $connection->errorInfo();
      echo("<p>Error: {$info[2]}</p>");
      exit();
    }
    echo("<h3>Consultation Info:</h3>");
    echo("<table border=\"1\">");
    echo("<tr><td>VAT_doctor</td><td>date_timestamp</td><td>SOAP_S</td><td>SOAP_O</td><td>SOAP_A</td><td>SOAP_P</td><td>Diagnostic ID</td><td>Diagnostic Description</td><td>Prescription Name</td><td>Prescription Dosage</td><td>Prescription Description</td></tr>");
    foreach($result as $row)
    {
      echo("<tr>\n");
      echo("<td>{$row['VAT_doctor']}</td>\n");
      echo("<td>{$row['date_timestamp']}</td>\n");
      echo("<td>{$row['SOAP_S']}</td>\n");
      echo("<td>{$row['SOAP_O']}</td>\n");
      echo("<td>{$row['SOAP_A']}</td>\n");
      echo("<td>{$row['SOAP_P']}</td>\n");
      echo("<td>{$row['ID']}</td>\n");
      echo("<td>{$row[7]}</td>\n");
      echo("<td>{$row['_name']}</td>\n");
      echo("<td>{$row['dosage']}</td>\n");
      echo("<td>{$row['_description']}</td>\n");
      echo("</tr>\n");
    }
    $connection = null;
?>
  </body>
</html>
