<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
    <body>
     <div class="container">
      <form action="insertcharting.php" method="post">
        <br>
          <h3>Dental Charting</h3>
          <div class="form-row">
            <div class="form-group col-md-4">
          <p>Doctor: <?=$_REQUEST['VAT_doctor'].', '.$_REQUEST['date_timestamp']?>
            <input type="hidden" name="VAT_doctor" value="<?=$_REQUEST['VAT_doctor']?>"><p>
            <input type="hidden" name="date_timestamp" value="<?=$_REQUEST['date_timestamp']?>"></p>
            <input type="hidden" name="description" value="<?=$_REQUEST['description']?>"></p>
          </div>
          <div class="form-group col-md-4">
          <p>Number of insertions: <?=$_REQUEST['insertions']?>
            <input type="hidden" name="insertions" value="<?=$_REQUEST['insertions']?>"><p>
          </div>
          </div>
          <?php
            for($i=0; $i < $_REQUEST['insertions']; $i++){

              echo ("<div class=\"form-row\">");
              echo ("<div class=\"form-group col-md-1\">");
              echo ("<p><strong>Quadrant:</strong> <input type=\"number\" class=\"form-control\" name=\"quadrant".$i."\" min=\"1\" max=\"4\" required><p>");
              echo ("</div>");
              echo ("<div class=\"form-group col-md-1\">");
              echo ("<p><strong>Number:</strong> <input type=\"number\" class=\"form-control\" name=\"_number".$i."\" min=\"1\" max=\"8\" required><p>");
              echo ("</div>");
              echo ("<div class=\"form-group col-md-1.5\">");
              echo ("<p>Measure: <input type=\"text\" class=\"form-control\" name=\"measure".$i."\" required><p>");
              echo ("</div>");
              echo ("<div class=\"form-group col-md-4\">");
              echo ("<p>Description: <input type=\"text\" class=\"form-control\" name=\"_desc".$i."\"><p>");
              echo ("</div>");
              echo ("</div>");
              echo("<p>");

            }
          ?>
          <p><input type="submit" class="btn btn-primary" value="Submit"/></p>
      </form>
    </body>
</html>
