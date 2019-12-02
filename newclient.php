<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <form action="insertclient.php" method="post">
        <br>
        <h3>Insert a new client</h3>
        <div class="form-row">
          <div class="form-group col-md-4">
            <p>VAT (max. 10 digits): <input type="text" class="form-control" name="VAT" maxlength="10" placeholder="Enter client's VAT" required/></p>
          </div>
          <div class="form-group col-md-4">
            <p>Name: <input type="text" class="form-control" name="name" placeholder="Enter client's name" required/></p>
          </div>
          <div class="form-group col-md-2">
            <p>Birth-date: <input type="date" class="form-control" name="birth_date" max=<?=date("Y-m-d")?> required></p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <p>City: <input type="text"class="form-control" name="city" placeholder="Enter city" required/></p>
          </div>
          <div class="form-group col-md-4">
            <p>Street: <input type="text" class="form-control" name="street" placeholder="Enter street" required/></p>
          </div>
          <div class="form-group col-md-2">
            <p>Zip code: <input type="text"class="form-control" name="zip" placeholder="Enter zip code" required/></p>
          </div>
        </div>
        <p>Gender:
          <input type="radio" name="gender" value="M" required> Male
          <input type="radio" name="gender" value="F" required> Female</p>
        <p><input type="submit" class="btn btn-primary" value="Insert this client"/></p>
      </form>
  </body>
</html>
