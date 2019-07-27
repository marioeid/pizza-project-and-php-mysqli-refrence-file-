<?php

function get_pizzas()
{
$sql='SELECT title, ingredients, id, created_at, image FROM pizzas ORDER BY created_at';
// make query and get result
$result=mysqli_query($conn,$sql);
// fetch the resulting rows as an associative array
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);
// free from memory as you don't need it 
mysqli_free_result($result);  
return $pizzas;
}

function redirect($location)
{
    return header("Location:$location");
}
?>