<?php
function show_orders_table()
{
/* st connect to database */
$conn=mysqli_connect('localhost','marioeid','01006007990','pizzarita');
// check the connection
if (!$conn)
{
  echo 'Connection  error '.mysqli_connect_error();
  
}

$sql='SELECT * FROM orders';
// make query and get result
$result=mysqli_query($conn,$sql);
// fetch the resulting rows as an associative array
$orders=mysqli_fetch_all($result,MYSQLI_ASSOC);
// free from memory as you don't need it 
if (count($orders)){
  ?>
  <table class="table mt-5 mx-2 table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">amount</th>
      <th scope="col">transaction</th>
      <th scope="col">currency</th>
      <th scope="col">status</th>
    </tr>
  </thead>
  <tbody>
  <?php
for($i=0;$i<count($orders);$i++)
{
  ?>
  <tr>
  <th scope="row"><?php echo  $orders[$i]['orders_id'];?></th>
  <td><?php echo $orders[$i]['order_amount'];?></td>
  <td><?php echo $orders[$i]['order_transaction'];?></td>
  <td><?php echo $orders[$i]['order_currency'];?></td>
  <td><?php echo $orders[$i]['order_status'];?></td>

</tr>
<?php  
}
?>
</tbody>
</table>


<?php
}

mysqli_free_result($result);
// close the connectoin
mysqli_close($conn);
}
?>

<div class="container-fluid">
<div class="row">
 <div class="col-md-3 col-lg-3">
  <div class="card text-white bg-success mt-2 mb-2 font-it py-2">
    <div class="card-body py-2">
      <div class="row">
       <div class="col-6">
        <div class="row fa-2x">
          <p class="col-2 text-center fa-1x font-weight-bold">4</p>
         </div>
       <div class="row">
       <div class="col-12 font-weight-bold">finished orders</div>
        </div>
    </div>
      <p class="card-text col-6 text-center"><i class="fas fa-user-slash fa-5x"></i></p>
    </div>
  </div>
</div>

</div>
<div class="col-md-3 col-lg-3">
<div class="card text-white bg-danger mt-2 mb-2 font-it py-2">
  <div class="card-body py-2">
    <div class="row">
    <div class="col-6">
    <div class="row fa-2x">
    <p class="col-2 text-center fa-1x font-weight-bold">4</p>
    </div>
    <div class="row">
    <div class="col-12 font-weight-bold">binding orders</div>
    </div>
    </div>
    <p class="card-text col-6 text-center"><i class="fas fa-user-clock fa-5x"></i></p>

    </div>
  </div>
</div>

</div>
<div class="col-md-3 col-lg-3">
<div class="card text-white bg-dark mt-2 mb-2 font-it py-2">
  <div class="card-body py-2">
    <div class="row">
    <div class="col-6">
    <div class="row fa-2x">
    <p class="col-2 text-center fa-1x font-weight-bold">4</p>
    </div>
    <div class="row">
    <div class="col-12 font-weight-bold">all today's orders</div>
    </div>
    </div>
    <p class="card-text col-6 text-center"><i class="fas fa-shopping-cart fa-5x"></i></p>

    </div>
  </div>
</div>

</div>
<div class="col-md-3 col-lg-3">
<div class="card text-white bg-secondary mt-2 mb-2 font-it py-2">
  <div class="card-body py-2">
    <div class="row">
    <div class="col-6">
    <div class="row fa-2x">
    <p class="col-2 text-center fa-1x font-weight-bold">4</p>
    </div>
    <div class="row">
    <div class="col-12 font-weight-bold">new customers</div>
    </div>
    </div>
    <p class="card-text col-6 text-center"><i class="fas fa-users fa-5x"></i></p>

    </div>
  </div>
</div>

</div>

</div>
 
 <?php show_orders_table();?>
 
</div>
<!-- /#page-content-wrapper -->


