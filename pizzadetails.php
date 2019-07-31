<?php

// connect to database
$pizza=""; 
$conn=mysqli_connect('localhost','marioeid','01006007990','pizzarita');
// check the connection
if (!$conn)
{
  echo 'Connection  error '.mysqli_connect_error();
  
}

if (isset($_POST['delete']))
{
 $id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);
 $sql="DELETE FROM pizzas WHERE id=$id_to_delete";
 if (mysqli_query($conn,$sql))
 {
   header('Location: index.php');
 }
 else {
   echo 'query error'.mysqli_error($conn);

 }
}
// check get request id parameter
if (isset($_GET['id']))
{
 $id=mysqli_real_escape_string($conn,$_GET['id']);
 // make sql
 $sql="SELECT * FROM pizzas WHERE id=$id";
 // get 
 $result=mysqli_query($conn,$sql);
 // fetch the result 
 $pizza=mysqli_fetch_assoc($result);
 mysqli_free_result($result);
 mysqli_close($conn);
 //print_r($pizza);
}

?>
<!DOCTYPE html>
<html lang="en">


<?php
 include('templates/back/header.php');
?>
<div class="pizza">
    <div class="container">
        <?php if ($pizza): ?>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($pizza['title']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Created at <?php echo date($pizza['created_at']);?></h6>

                    <p class="card-title">Created by: <?php echo htmlspecialchars($pizza['email']);?> </p>
                    <p><?php echo htmlspecialchars($pizza['ingredients']);?></p>
                    <form action="pizzadetails.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ;?>">
                        <input type="submit" name="delete" value="Delete" class="btn btn-primary">
                    </form>

                </div>
                <!-- delete pizza -->

            </div>

        </div>
        <?php else: ?>
        <div class="row text-danger text-uppercase">
            <p>no such pizza exist</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php
 include('templates/back/footer.php');

?>

</body>

</html>