<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
   <div class="container">
    <form action="newcharting.php" method="post">
      <br>
      <h3>Insert a new procedure</h3>
      <div class="form-row">
        <div class="form-group col-md-4">
        <p>Doctor: <?=$_REQUEST['VAT_doctor'].', '.$_REQUEST['date_timestamp']?>
          <input type="hidden" name="VAT_doctor" value="<?=$_REQUEST['VAT_doctor']?>"><p>
          <input type="hidden" name="date_timestamp" value="<?=$_REQUEST['date_timestamp']?>"></p>
        </div>
       </div>
        <div class="form-row">
        <div class="form-group col-md-4">
        <p>Description: <input type=text name="_description"/></p>
        </div>
        <div class="form-group col-md-4">
        <p>Number of insertions: <input type=number name="insertions" min="1" max="32" required/></p>
        </div>
        </div>
        <p><input type="submit" class="btn btn-primary" value="Start"/></p>
    </form>
  </body>
</html>
