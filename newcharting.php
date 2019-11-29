<html>
  <body>
    <form action="insertcharting.php" method="post">
    <h3>Dental Charting</h3>
    <p>Doctor: <?=$_REQUEST['VAT_doctor'].', '.$_REQUEST['date_timestamp']?>
      <input type="hidden" name="VAT_doctor" value="<?=$_REQUEST['VAT_doctor']?>"><p>
      <input type="hidden" name="date_timestamp" value="<?=$_REQUEST['date_timestamp']?>"></p>
      <input type="hidden" name="description" value="<?=$_REQUEST['description']?>"></p>
    <p> Number of insertions: <?=$_REQUEST['insertions']?>
      <input type="hidden" name="insertions" value="<?=$_REQUEST['insertions']?>"><p>
    <?php
      for($i=0; $i < $_REQUEST['insertions']; $i++){

        echo ("<p><strong>Quadrant:</strong> <input type=\"number\" name=\"quadrant".$i."\" min=\"1\" max=\"4\">");
        echo ("<strong> Number:</strong> <input type=\"number\" name=\"_number".$i."\" min=\"1\" max=\"8\">");
        echo (" Measure: <input type=\"text\" name=\"measure".$i."\"><p>");
        echo ("<p>Description: <input type=\"text\" name=\"_desc".$i."\"><p>");
        echo("<p>");

      }
    ?>
    <p><input type="submit" value="Submit"/></p>
    </form>
  </body>
</html>
