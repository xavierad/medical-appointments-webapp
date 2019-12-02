<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
    <br>
    <form method="post">
    <h3>Insert a new appointment:</h3>
    <p>Client:
      <?=$_REQUEST['client_name'].', '.$_REQUEST['VAT_client']?>
      <input type="hidden" class="form-control" name="client_name" value="<?=$_REQUEST['client_name']?>">
      <input type="hidden" class="form-control" name="VAT_client" value="<?=$_REQUEST['VAT_client']?>"></p>
    <p>Date: <?=$datetimestamp = $_REQUEST['date'].' '.$_REQUEST['time']?>
      <input type="hidden" name="datetimestamp" value="<?=$datetimestamp?>"></p>
    <p>Description: <?=$_REQUEST['_description']?>
      <input type="hidden" name="_description" value="<?=$_REQUEST['_description']?>"></p>
    <p>Doctor:
      <?php
        $host = "db.ist.utl.pt";
        $user = "ist187094";
        $pass = "stlk1710";
        $dsn = "mysql:host=$host;dbname=$user";
        try
        {
          $connection = new PDO($dsn, $user, $pass);

          $time = $_REQUEST['time'];
          $sql = "SELECT * FROM employee natural join doctor
                  where VAT not in (select VAT from doctor left outer join appointment on doctor.VAT=appointment.VAT_doctor
                                  where :datetimestamp between date_sub(appointment.date_timestamp, interval 1 hour) and date_add(appointment.date_timestamp, interval 1 hour))
                  group by VAT
                  order by _name";
          $stmt = $connection->prepare($sql);

          if ($stmt == FALSE)
          {
            $info = $connection->errorInfo();
            echo("<p>Error: {$info[2]}</p>");
            exit();
          }
          else {
            $stmt->bindParam(':datetimestamp', $datetimestamp);
            # execution
            $stmt->execute();
            $nrows = $stmt->rowCount();
            echo("<p>$nrows client(s) matched</p>");
            if ($nrows == 0)
            {
              echo("<p>There is no doctor available!</p>");
            }
            else
            {
              echo("<table cellpadding=\"5\" border=\"1\" cellspacing=\"2\">\n");
              echo("<tr><td><center<Doctor's VAT</center></td><td><center>Doctor's name</center></td><td><center>Status</center></td></tr>");
              foreach($stmt as $row)
              {
                echo("<tr>\n");
                echo("<td><center>{$row['VAT']}</center></td>\n");
                echo("<td><center>{$row['_name']}</center></td>\n");
                echo("<td><a href=\"insertappointment.php?VAT_doctor=".$row['VAT']."&doctorname=".$row['_name']."&VAT_client=".$_REQUEST['VAT_client']."&client_name=".$_REQUEST['client_name']."&datetimestamp=".$datetimestamp."&_description=".$_REQUEST['_description']);
                echo("\"><center>Available</center></a></td>\n");
                echo("</tr>\n");
              }
              echo("</table>\n");
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
    </select>
    </p>
    </form>
  </body>
</html>
