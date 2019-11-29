<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <br>
      <h3>Search for a client</h3>
      <form action="selectclient.php" method="post">
      <div class="form-row">
          <div class="form-group col-md-4">
            <p>VAT: <input type="text" class="form-control" name="VAT" placeholder="Enter client's VAT"/></p>
          </div>
          <div class="form-group col-md-4">
            <p>Name: <input type="text" class="form-control" name="name" placeholder="Enter client's name"/></p>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <p>City: <input type="text"class="form-control" name="city" placeholder="Enter city"/></p>
          </div>
          <div class="form-group col-md-4">
            <p>Street: <input type="text" class="form-control" name="street" placeholder="Enter street"/></p>
          </div>
          <div class="form-group col-md-4">
            <p>Zip code: <input type="text"class="form-control" name="zip" placeholder="Enter zip code"/></p>
          </div>
        </div>
        <button class="btn btn-primary" type="submit"/>Search</button>
      </form>
    </div>
  </body>
</html>
