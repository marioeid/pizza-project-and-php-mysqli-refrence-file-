<?php
session_start();
$conn=mysqli_connect('localhost','marioeid','01006007990','pizzarita');
if (!$conn)
{
  echo 'Connection  error '.mysqli_connect_error();
  
}
    // harmful sql check like special html chars

    // // mysqli_query( $conn,"DELETE FROM ordered_pizzas_id_orders_id" );
    // // mysqli_query( $conn,"DELETE FROM ordered_pizzas" );
    // // mysqli_query( $conn,"DELETE FROM orders" );


 if (isset($_GET['tx']))
  {
      $amount=mysqli_real_escape_string($conn,$_GET['amt']);
      $transaction=mysqli_real_escape_string($conn,$_GET['tx']);
      $status=mysqli_real_escape_string($conn,$_GET['st']);
      $currency=mysqli_real_escape_string($conn,$_GET['cc']);
      print_r($_GET);
      $sz=0;
      $pizzas_names=array();
      $pizzas_quantities=array();
      $pizzas_prices=array();
      $value="super superme";
      array_push($pizzas_names,$value);
      array_push($pizzas_quantities,3);
      array_push($pizzas_prices,30);
      $_SESSION['pizzas_names']=$pizzas_names;
      $_SESSION['pizzas_quantities']=$pizzas_quantities;
      $_SESSION['pizzas_prices']=$pizzas_prices;

      if (isset($_SESSION['pizzas_names'])){$sz=count($_SESSION['pizzas_names']);}
      
      if ($sz!=0)
      {
      $order_id="";
      $pizza_id="";
      $sql="INSERT INTO orders(order_amount,order_transaction,order_currency,order_status) VALUES('$amount','$transaction','$currency','$status')";
      if (mysqli_query($conn,$sql))
      {
      echo 'suc';
      $order_id = mysqli_insert_id($conn);
      }
      else {
      echo 'here';
        echo mysqli_error($conn,$sql);
      }

      for($i=0;$i<$sz;$i++)
      {
          $name=mysqli_real_escape_string($conn, $_SESSION['pizzas_names'][$i]); 
          $quantity=mysqli_real_escape_string($conn, $_SESSION['pizzas_quantities'][$i]); 
          $price=mysqli_real_escape_string($conn, $_SESSION['pizzas_prices'][$i]);
          $sql="INSERT INTO ordered_pizzas(pizza_name,pizza_price,pizza_quantity) VALUES('$name','$price','$quantity')";

          if (mysqli_query($conn,$sql))
          {
          $pizza_id = mysqli_insert_id($conn);
          }
          else {
              echo mysqli_error($conn,$sql);
              
          }
          $sql="INSERT INTO ordered_pizzas_id_orders_id(orders_id,ordered_pizzas_id) VALUES('$order_id','$pizza_id')";
          if (mysqli_query($conn,$sql))
          {
          }
          else {
            echo mysqli_error($conn,$sql);
            die();
          }

      }
      }
      


   }
   mysqli_close($conn);
   session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Document</title>
</head>
<body>
<div class="container"></div>

<script src="/mathscribe/jquery-1.4.3.min.js"></script>
    <script src="/mathscribe/jqmath-etc-0.4.6.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.js" integrity="sha256-MCmDSoIMecFUw3f1LicZ/D/yonYAoHrgiep/3pCH9rw=" crossorigin="anonymous">
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <script src="js/index.js"></script> 


 </body>
 
</html>