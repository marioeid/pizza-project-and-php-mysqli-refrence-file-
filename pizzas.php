<?php
/* st connect to database */
$conn=mysqli_connect('localhost','marioeid','01006007990','pizzarita');
// check the connection
if (!$conn)
{
  echo 'Connection  error '.mysqli_connect_error();
  
}


$sql='SELECT title, ingredients, id, created_at, image,price FROM pizzas ORDER BY created_at';
// make query and get result
$result=mysqli_query($conn,$sql);
// fetch the resulting rows as an associative array
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);
// free from memory as you don't need it 
mysqli_free_result($result);
// close the connectoin
mysqli_close($conn);

?>
                <div class="row">
                    <?php foreach($pizzas as $pizza):?>
                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="card mx-2 my-2">
                            <img class="card-img-top" src="img/<?php echo $pizza['image'] ;?>">
                            
                            <div class="card-body">

                                <h4 class="card-title text-danger text-center">
                                    <?php echo htmlspecialchars($pizza['title']); ?>
                                </h4>
                                <h4 class="text-uppercase text-weight-bold text-center"> <?php echo htmlspecialchars($pizza['price']); ?>$</h4>

                                <ul class="list-group list-group-flush">
                                    <?php 
                                     foreach ( explode(',',$pizza['ingredients']) as $ing) :
                                     ?>
                                    <li class="list-group-item text-center"><?php echo htmlspecialchars($ing); ?></li>
                                    <?php 
                                     endforeach
                                    ?>
                                </ul>


                             
                            </div>

                        </div>

                    </div>
                    <?php endforeach?>
                </div>

 