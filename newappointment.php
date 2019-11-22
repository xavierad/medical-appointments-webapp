<html>
  <body>
    <form action="selectdoctor.php" method="post">
    <h3>Insert a new appointment</h3>
    <p>Client: <?=$_REQUEST['client']?> <input type="hidden" name="client" value="<?=$_REQUEST['client']?>"></p>
    <p>Date: <input type="date" name="date" min=<?= date("Y-m-d")?>></p>
    <p>Time: <input type="time" name="time" min='09:00:00' max='17:00:00'></p>
    <p><input type="submit" value="Submit"/></p>
    </form>
  </body>
</html>
