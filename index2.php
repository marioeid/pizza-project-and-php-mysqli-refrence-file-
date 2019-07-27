<!DOCTYPE html>
<?php
 include('templates/header.php');
?>
 <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
    <div class="container">
    <form class="col-6" method="POST" action="checkout.php">
  <div class="form-group">
    <label for="product">product</label>
    <input type="text" class="form-control"  placeholder="Example input" name="product">
  </div>
  <div class="form-group">
    <label for="amount">price</label>
    <input type="text" class="form-control" placeholder="Another input" name="price">
  </div>
  <button type="submit" class="btn btn-primary" name="submit" value="pay">submit</button>

</form>
        
    </div>
    </body>
    <?php
 include('templates/footer.php');

?>
