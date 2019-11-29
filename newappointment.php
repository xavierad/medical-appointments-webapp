<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <br>
      <form action="selectdoctor.php" method="post">
        <h3>Insert a new appointment:</h3>
        <p>Client:
          <?=$_REQUEST['client_name'].', '.$_REQUEST['VAT_client']?>
          <input type="hidden" class="form-control" name="client_name" value="<?=$_REQUEST['client_name']?>">
          <input type="hidden" class="form-control" name="VAT_client" value="<?=$_REQUEST['VAT_client']?>"></p>
        <div class="form-row">
          <div class="form-group col-md-2">
            <p>Date: <input type="date" class="form-control" name="date" min=<?=date("Y-m-d")?> required></p>
          </div>
          <div class="form-group col-md-1.5">
            <p>Time (9h-17h): <input type="time" class="form-control" name="time" step="3600" min='09:00:00' max='17:00:00'required></p>
          </div>
          <div class="form-group col-md-5">
            <p>Description: <input type=text class="form-control" name="_description" placeholder="Enter a description for this appointment" required/></p>
          </div>
        </div>
        <p><input type="submit" class="btn btn-primary"  value="View available doctors"/></p>
      </form>
    </div>
  </body>
</html>
