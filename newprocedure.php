<html>
  <body>
    <form action="newcharting.php" method="post">
    <h3>Insert a new procedure</h3>
    <p>Doctor: <?=$_REQUEST['VAT_doctor'].', '.$_REQUEST['date_timestamp']?>
      <input type="hidden" name="VAT_doctor" value="<?=$_REQUEST['VAT_doctor']?>"><p>
      <input type="hidden" name="date_timestamp" value="<?=$_REQUEST['date_timestamp']?>"></p>
    <p>Description: <input type=text name="_description"/></p>
    <p>Number of insertions: <input type=number name="insertions" min="1" max="32"/></p>
    <p><input type="submit" value="Start"/></p>
    </form>
  </body>
</html>
