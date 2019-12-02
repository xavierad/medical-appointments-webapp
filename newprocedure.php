<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
   <div class="container">
     <br>
     <form action="newcharting.php" method="post">
      <h3>Insert a new procedure</h3>
      <p>Doctor:
          <?=$_REQUEST['VAT_doctor'].', '.$_REQUEST['date_timestamp']?>
          <input type="hidden" name="VAT_doctor" value="<?=$_REQUEST['VAT_doctor']?>">
          <input type="hidden" name="date_timestamp" value="<?=$_REQUEST['date_timestamp']?>"></p>
      <div class="form-row">
        <div class="form-group col-md-5">
          <p>Description: <input type=text class="form-control" name="_description" placeholder="Enter a description for this appointment" required/></p>
        </div>
        <div class="form-group col-md-1.5">
          <p>Number of insertions: <input type=number class="form-control" name="insertions" min="1" max="32" required/></p>
        </div>
      </div>
      <p><input type="submit" class="btn btn-primary" value="Start"/></p>
    </form>
   </div>
  </body>
</html>
