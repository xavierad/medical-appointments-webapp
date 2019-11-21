<html>
  <body>
    <form action="selectdoctor.php?" method="post">
    <h3>Insert a new appointment</h3>
    <p>Client: <?$_REQUEST['client']?></p>
    <p>Date: <input type="datetime-local" name="datetime" min=<?= date("Y-m-d\TH:i")?> min='09:00:00' max='17:00:00'></p>
    <p><input type="submit" value="Submit"/></p>
    </form>
  </body>
</html>
