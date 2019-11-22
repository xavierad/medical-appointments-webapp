<html>
  <body>
    <form method="post">
    <h3>Insert a new appointment</h3>
    <p>Client: <?=$_REQUEST['client_name'].', '.$_REQUEST['VAT_client']?>
      <input type="hidden" name="client_name" value="<?=$_REQUEST['client_name']?>">
      <input type="hidden" name="VAT_client" value="<?=$_REQUEST['VAT_client']?>"></p>
    <p>Date: <?=$datetimestamp = $_REQUEST['date'].' '.$_REQUEST['time']?>
      <input type="hidden" name="datetimestamp" value="<?=$datetimestamp?>"></p>
    <p>Description: <?=$_REQUEST['_description']?>
      <input type="hidden" name="_description" value="<?=$_REQUEST['_description']?>"></p>
    <p>Doctor:
      <?php
        $host = "db.ist.utl.pt";
        $user = "ist187136";
        $pass = "rbtc1601";
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
        $time = $_REQUEST['time'];
        $sql = "SELECT * FROM employee natural join doctor
                where '$datetimestamp' not in (select appointment.date_timestamp
                                             from doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor)
                      or '$time' not in (select time(appointment.date_timestamp)
                                                   from doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor)

                order by _name";
        $result = $connection->query($sql);
        if ($result == FALSE)
        {
          $info = $connection->errorInfo();
          echo("<p>Error: {$info[2]}</p>");
          exit();
        }
        echo("<table border=\"1\" cellspacing=\"2\">\n");
        echo("<tr><td>Doctor's VAT</td><td>Doctor's name</td><td>Status</td></tr>");
        foreach($result as $row)
        {
          echo("<tr>\n");
          echo("<td>{$row['VAT']}</td>\n");
          echo("<td>{$row['_name']}</td>\n");
          echo("<td><a href=\"insertappointment.php?VAT_doctor=".$row['VAT']."&VAT_client=".$_REQUEST['VAT_client']."&datetimestamp=".$datetimestamp."&_description=".$_REQUEST['_description']);
          echo("\">Free</a></td>\n");
          echo("</tr>\n");
        }
        echo("</table>\n");

        $connection = null;
      ?>
    </select>
    </p>
    </form>
  </body>
</html>
