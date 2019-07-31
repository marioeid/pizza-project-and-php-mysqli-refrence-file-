<?php

function show_reports()
{

  $conn=mysqli_connect('localhost','marioeid','01006007990','pizzarita');

$sql='SELECT orders_id FROM orders';
// make query and get result
$result=mysqli_query($conn,$sql);
// fetch the resulting rows as an associative array
$orders=mysqli_fetch_all($result,MYSQLI_ASSOC);
// free from memory as you don't need it 
 
 for ($i=0;$i<count($orders);$i++)
 {
    
    $orders[$i]['orders_id']=mysqli_real_escape_string($conn, $orders[$i]['orders_id']);
    $cur_order=$orders[$i]['orders_id'];
   
    $sql="SELECT ordered_pizzas_id FROM ordered_pizzas_id_orders_id WHERE orders_id='$cur_order'";
    $result=mysqli_query($conn,$sql);
    $pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);
    ?>
    <div class="col-sm-6 col-lg-4">
    <div class="card row mt-2 mb-2 ml-2 mr-2">
  <div class="card-body">
  <table class="table table-md">
  <thead>
    <tr class="font-weight-bold">
      <th scope="col">
      <i class="fas fa-pizza-slice text-secondary fa-lg"></i>
      </th>
      <th scope="col">
      <i class="fas fa-dollar-sign text-success fa-lg"></i>
      </th>
      <th scope="col">
      <i class="fas fa-shopping-cart text-warning fa-lg"></i>
      </th>
    </tr>
  </thead>
  <tbody>

    <?php
    
    for ($j=0;$j<count($pizzas);$j++)
    {
        $cur_pizza=mysqli_real_escape_string($conn,$pizzas[$j]['ordered_pizzas_id']);
        $sql="SELECT * FROM ordered_pizzas WHERE pizza_id='$cur_pizza'";
        $result=mysqli_query($conn,$sql);
        $pizza=mysqli_fetch_all($result,MYSQLI_ASSOC);
        for ($k=0;$k<count($pizza);$k++)
        {

  
     ?>
      <tr class="font-weight-bold">
      <td><?php echo $pizza[$k]['pizza_name'];?></td>
      <td><?php echo $pizza[$k]['pizza_price'];?></td>
      <td><?php echo $pizza[$k]['pizza_quantity'];?></td>
    </tr>
      <?php
        }
    }
    ?>
      </tbody>
</table>
  </div>
</div>
    </div>


    <?php

 }
 mysqli_close($conn);
}

 
?>

<div class="container-fluid">
<div class="row">
<?php show_reports();?>
</div>

</div>
</div>

</html>