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

        $time = $_REQUEST['time'];
        $sql = "SELECT * FROM employee natural join doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor
                where VAT not in (select VAT from doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor
                                where'2020-12-23 12:20:00' between date_sub(appointment.date_timestamp, interval 1 hour) and date_add(appointment.date_timestamp, interval 1 hour))
                group by VAT
                order by _name";
                  /* SELECT * FROM employee natural join doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor
                    where time('2020-12-24 12:20:00') >= all(select addtime(time(appointment.date_timestamp),'1:00:00')
                                                   from doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor
                                                   where date('2020-12-24 12:20:00')=date(appointment.date_timestamp))
                    and '2020-12-23 12:20:00' <= all(select select subtime(time(appointment.date_timestamp),'1:00:00')
                                                 from doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor
                                                 where date('2020-12-24 12:20:00')=date(appointment.date_timestamp))

                        order by _name;*/
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
