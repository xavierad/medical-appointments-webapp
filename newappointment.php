<html>
  <body>
    <form action="selectdoctor.php" method="post">
    <h3>Insert a new appointment</h3>
    <p>Client: <?=$_REQUEST['client_name'].', '.$_REQUEST['VAT_client']?>
      <input type="hidden" name="client_name" value="<?=$_REQUEST['client_name']?>">
      <input type="hidden" name="VAT_client" value="<?=$_REQUEST['VAT_client']?>"></p>
    <p>Date: <input type="date" name="date" min=<?=date("Y-m-d")?> required></p>
    <p>Time: <input type="time" name="time" min='09:00:00' max='17:00:00'required></p>
    <p>Description: <input type=text name="_description" required/></p>
    <p><input type="submit" value="View free doctors"/></p>
    </form>
  </body>
</html>
