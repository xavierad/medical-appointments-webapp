<html>
  <body>
    <form action="insertappointment.php" method="post">
    <h3>Insert a new appointment</h3>
    <p>Client: <?=$_REQUEST['client']?></p>
    <p>Date: <?=$datetimestamp = date('Y-m-d H:i:s', strtotime($_REQUEST['datetime']));?></p>
    <p>Doctor:
    <select name="name">
      <?php
        $host = "db.ist.utl.pt";
        $user = "ist187136";
        $pass = "xxx";
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
        # falta ver se a data de input tem um desfasamento de 1h das da base de dados e entre as 9h e as 17h
        $sql = "SELECT * FROM employee natural join doctor
                where '$datetimestamp' not in (select appointment.date_timestamp
                                             from doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor)
                order by _name";
        $result = $connection->query($sql);
        if ($result == FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          exit();
        }
        foreach($result as $row)
        {
          $name = $row['_name'];
          echo("<option value=\"$name\">$name</option>");
        }

        $connection = null;
      ?>
    </select>
    </p>
    <p><input type="submit" value="Submit"/></p>
    </form>
  </body>
</html>
