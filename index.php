<?php

include("functions.php");
/* start a new session or cookies */
session_start();
/* st connect to database */
$conn=mysqli_connect('localhost','marioeid','01006007990','pizzarita');
// check the connection
if (!$conn)
{
  echo 'Connection  error '.mysqli_connect_error();
  
}

/* en connect to database */

// if (isset($_GET['submit'])){
//     echo $_GET['email'];
//     echo $_GET['title'];
//     echo $_GET['ingredients'];
$email=$user_name=$title=$ingredients=$file=$password="";
$check=0;
$errors=['email'=>'','title'=>'','ingredients'=>'','file'=>'','user_name'=>'','password'=>'','email_username'=>''];

if (isset($_GET['add']))
{
$_SESSION['pizza_id'.$_GET['add']]++;
//echo $_SESSION['pizza_id'.$_GET['add']];
}
else if (isset($_GET['remove']))
{
 if ($_SESSION['pizza_id'.$_GET['remove']]>0)
 {
    $_SESSION['pizza_id'.$_GET['remove']]--;

 }
    //echo $_SESSION['pizza_id'.$_GET['remove']];

}
else if (isset($_GET['delete']))
{
    
    
    $_SESSION['pizza_id'.$_GET['delete']]='0';
  //  echo  $_SESSION['pizza_id'.$_GET['delete']];
}
else if (isset($_POST['submit_cart']))
{
 // echo 'any thing';
}
else if (isset($_POST['submit'])){
      // for xss attacks use special chars
        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['title']);
        // echo htmlspecialchars($_POST['ingredients']);
    // form validation
    // check email
    $file=$_FILES['file'];
    //print_r($file);
    $file_name=$_FILES['file']['name'];
    $file_tmp_name=$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];
    $file_error=$_FILES['file']['error'];
    $file_size=$_FILES['file']['size'];
    $file_ext=explode('.',$file_name);
    $file_actual_ext=strtolower(end($file_ext));
    $allowed=array('jpg','jpeg','png');
    if (in_array($file_actual_ext,$allowed))
    {
         if (!$file_error)
         {
               if ($file_size<=8000000)
               {
                $file_new_name=uniqid('',true).".".$file_actual_ext;
                 $file_destination='img/'.$file_new_name;
                 $file=$file_new_name;
                 move_uploaded_file($file_tmp_name,$file_destination);
               }
               else {
                $errors['file']='your file is bigger than 8 mg';
               
               }          
         }
         else {
          print_r($_FILES['file']['error']);
            $errors['file']='there was an error uploading your file';
         }
    }
    else {
        $errors['file']='you cannot upload files of this type'; 
    }
    if (empty($_POST['email']))
    {
      $errors['email']= 'An email is required <br>';

    }
    else {
         $email=$_POST['email'];
         if (!filter_var($email,FILTER_VALIDATE_EMAIL))
         {
            $errors['email']='email must be a valid email address <br>';
         }
         //echo htmlspecialchars($_POST['email']);
    }
    // check title
    if (empty($_POST['title']))
    {
      $errors['title']='A title is required <br>';

    }
    else {
        $title=$_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/',$title))
        {
          $errors['title']='title must be letters and spaces only <br>';
        }
     //    echo htmlspecialchars($_POST['title']);
    }
    // check ingredients
    if (empty($_POST['ingredients']))
    {
      $errors['ingredients']= 'At least one ingredient is required <br>';

    }
    else{
        $ingredients=$_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients']= 'Ingredients must be a comma separated list';
         }
    }
   if (!array_filter($errors))
   {
    // harmful sql check like special html chars
    $email=mysqli_real_escape_string($conn, $_POST['email']); 
    $title=mysqli_real_escape_string($conn, $_POST['title']); 
    $ingredients=mysqli_real_escape_string($conn, $_POST['ingredients']); 
    $image=$file;
    $sql="INSERT INTO pizzas(title,email,ingredients,image) VALUES('$title','$email','$ingredients','$image')";
    if (mysqli_query($conn,$sql))
    {

    }
    else {
      echo mysqli_error($conn,$sql);
    }
  }
  
}
 // end of the post check
else if (isset($_POST['submit_signup']))
{
  $email=mysqli_real_escape_string($conn, $_POST['email']); 
  $user_name=mysqli_real_escape_string($conn, $_POST['user_name']); 
  $password=mysqli_real_escape_string($conn, $_POST['password']); 
  if (empty($_POST['email']))
  {
    $errors['email']='An email is required <br>';
    
  
  }
  else {
    $user_check_query = "SELECT * FROM registration WHERE user_name='$user_name' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user)
    {
      if ($user_name==$user['user_name'])
      {
        $errors['user_name']='your user name already exits';

      }
      else {
        $errors['email']='this email already exits';
      }
    }
  }
  if (empty($_POST['password']))
  {
    $errors['password']='a password is required <br>';
  }
  if (empty($_POST['user_name']))
  {
    $errors['user_name']='A user name is required <br>';

  }
  if (!array_filter($errors))
  {
    
   // harmful sql check like special html chars
   $email=mysqli_real_escape_string($conn, $_POST['email']); 
   $user_name=mysqli_real_escape_string($conn, $_POST['user_name']); 
   $password=mysqli_real_escape_string($conn, $_POST['password']); 
   $sql="INSERT INTO users(user_name,user_email,user_password) VALUES('$user_name','$email','$password')";
   if (mysqli_query($conn,$sql))
   {
      header('location: index.php');

   }
   else {
     echo mysqli_error($conn,$sql);
   }
 } 
}
else if (isset($_POST['submit_login']))
{

  if (empty($_POST['password']))
  {
    $errors['password']='a password is required <br>';
  }
  if (empty($_POST['email_username']))
  {
    
    $errors['email_username']='A user name or email is required <br>';
  }

 if (!array_filter($errors))
 {
    
  $email_username=mysqli_real_escape_string($conn, $_POST['email_username']);  
  $password=mysqli_real_escape_string($conn, $_POST['password']);
  $sql="SELECT * FROM  users WHERE user_name='$email_username' AND user_password='$password'";
  if (mysqli_query($conn,$sql))
  {
    setcookie('user_name',$email_username,time()+86400);

     header('location: index.php');

  }
  else {
    
   echo 'you went wrong ';
  }
 
 }
 

}
function cart()
{
    $total=0;
    $cnt=0;
    $allcnt=0;
    foreach ($_SESSION as $name=>$value):
     
        if ($value>0&substr($name,0,8)=='pizza_id')
     {
         $allcnt++;
         $cnt+=$value;
        $length=strlen($name);
        $length-=8;
        $id=substr($name, 8 , $length);  
        $conn=mysqli_connect('localhost','marioeid','01006007990','pizzarita');
        $id=mysqli_real_escape_string($conn,$id);
        $sql="SELECT * FROM  pizzas WHERE id='$id'";
        $result=mysqli_query($conn,$sql);
        $in=mysqli_fetch_all($result,MYSQLI_ASSOC);
        $total+=($value*$in[0]['price']);
        mysqli_close($conn);
        ?>
            <tr>
      <th scope="row"><?php echo $in[0]['title'] ;?></th>
      <td><?php echo $in[0]['price'] ;?></td>
      <td><?php echo $value ;?></td>
      <td><?php echo $in[0]['price']*$value ?></td>
      <td class="row">
      <a href="index.php?add=<?php echo $in[0]['id']?>" class="btn btn-success">
      <i class="text-white fas fa-plus"></i>
      </a>
      <a href="index.php?remove=<?php echo $in[0]['id']?>" class="btn btn-warning"><i class="fas fa-minus text-white"></i></a>
      <a href="index.php?delete=<?php echo $in[0]['id'] ?>" class="btn btn-danger">
      <i class="fas fa-times"></i>
      </a>
      
      </td>

    </tr>
    <input type="hidden" name="item_name_<?php echo $allcnt?>" value="<?php echo $in[0]['title'];?>">
    <input type="hidden" name="item_number_<?php echo $allcnt?>" value="<?php echo $in[0]['id'];?>">
    <input type="hidden" name="amount_<?php echo $allcnt?>" value="<?php echo $in[0]['price'];?>">
    <input type="hidden" name="quantity_<?php echo $allcnt?>" value="<?php echo $value;?>">
    <?php 
      }
    

    endforeach;
    $_SESSION['total_price']=$total;
    $_SESSION['total_pizzas']=$cnt;
}

// write query for all pizzas
$sql='SELECT title, ingredients, id, created_at, image,price FROM pizzas ORDER BY created_at';
// make query and get result
$result=mysqli_query($conn,$sql);
// fetch the resulting rows as an associative array
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);
// free from memory as you don't need it 
mysqli_free_result($result);
// close the connectoin
mysqli_close($conn);

//print_r($pizzas);
//print_r($errors);
?>

<?php
// how to redirect a user 
//header('location: index.php');
?>
<!DOCTYPE html>
<html lang="en">


<?php
 if (array_filter($errors))
 {

  ?>
<div class="bg-primary text-white text-center">
    <?php echo "Your form didn't sumbit successfully please try again"?>
</div>
<?php
   }
?>
<?php
 include('templates/header.php');
?>



<!--st Modal and add pizza-->
<div class="add_pizza_form">
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ADD PIZZA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="addpizza">
                        <div class="container">
                            <div class="row">
                                <form class="col-12" action="index.php" method="POST" enctype="multipart/form-data" >

                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-2">
                                                <i class="fa fa-envelope grey-text fa-3x"></i>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" class="form-control" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="text-danger">
                                        <?php echo $errors['email'];?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-2">
                                                <i class="fas fa-pizza-slice grey-text fa-3x"></i>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>" class="form-control" placeholder="pizza title">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="text-danger">
                                        <?php echo $errors['title'];?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-2">
                                                <i class="fas fa-mortar-pestle grey-text fa-3x"></i>

                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>" class="form-control" placeholder="ingredients">

                                            </div>
                                        </div>
                                        <small class="form-text text-muted">follow this format "1, 2, 3, 4" with a space seperation</small>
                                    </div>
                                    <div class="text-danger">
                                        <?php echo $errors['ingredients'];?>
                                    </div>
                                    <div class="form-group">

                                        <input type="file" name="file" id="file" class="inputfile" />
                                        <label for="file" class="btn btn-danger">
                                            <i class="fas fa-upload"></i>
                                            Choose a pizza image</label>
                                        <small class="form-text text-muted">please choose an image less than 8 mg.</small>
                                        <div class="text-danger">
                                            <?php echo $errors['file'];?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <button type="submit" name="submit" class="col-4 btn btn-primary">Submit</button>
                                        <div class="col-4"></div>
                                        <button type="button" class="col-4 btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
<!--en Modal and add pizza-->


<!-- st signup modal -->
<div class="signup">

    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle2">SIGN UP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="col-12" action="index.php" method="POST">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <i class="fas fa-pizza-slice grey-text fa-3x"></i>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="user_name" value="<?php echo htmlspecialchars($title) ?>" class="form-control" placeholder="enter user name">
                                </div>
                                <div class="text-danger">
                                    <?php echo $errors['user_name'];?>
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="row">

                                <div class="col-2">
                                    <i class="fa fa-envelope grey-text fa-3x"></i>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" class="form-control" placeholder="Enter email">
                                </div>
                            </div>
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="text-danger">
                            <?php echo $errors['email'];?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <i class="fas fa-mortar-pestle grey-text fa-3x"></i>

                                </div>
                                <div class="col-10">
                                    <input type="password" name="password" value="<?php echo htmlspecialchars($ingredients)?>" class="form-control" placeholder="enter password">

                                </div>
                            </div>
                            <small class="form-text text-muted">please choose strong password (special letters and numbers )</small>
                        </div>
                        <div class="text-danger">
                            <?php echo $errors['password'];?>
                        </div>

                        <div class="row">
                            <button type="submit" name="submit_signup" class="col-4 btn btn-primary">Submit</button>
                            <div class="col-4"></div>
                            <button type="button" class="col-4 btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


</div>
<!-- en signup modal -->

<!-- st login modal -->
<div class="login">

    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle3">LOGIN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="col-12" action="index.php" method="POST">



                        <div class="form-group">
                            <div class="row">

                                <div class="col-2">
                                    <i class="fa fa-envelope grey-text fa-3x"></i>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="email_username" value="<?php echo htmlspecialchars($title) ?>" class="form-control" placeholder="Enter email">
                                </div>
                            </div>
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="text-danger">
                            <?php echo $errors['email_username'];?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <i class="fas fa-mortar-pestle grey-text fa-3x"></i>

                                </div>
                                <div class="col-10">
                                    <input type="password" name="password" value="<?php echo htmlspecialchars($title) ?>" class="form-control" placeholder="enter password">

                                </div>
                            </div>
                            <small class="form-text text-muted">follow this format "1, 2, 3, 4" with a space seperation</small>
                        </div>
                        <div class="text-danger">
                            <?php echo $errors['password'];?>
                        </div>

                        <div class="row">
                            <button type="submit" name="submit_login" class="col-4 btn btn-primary">Submit</button>
                            <div class="col-4"></div>
                            <button type="button" class="col-4 btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


</div>
<!-- en login modal -->

<!-- st cart modal -->
<div class="cart">


    <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle4" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle4 text-center font-weight-bold text-danger">Your recipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                    <form class="paypal row"  action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                        <input type='hidden' name='business' value='marioeid0106007990@gmail.com'>
                        <input type='hidden' name='currency_code' value='USD'>
                        <input type="hidden" name="return" value="http://demo.itsolutionstuff.com/paypal/success.php">  
						<input type="hidden" name="cancel_return" value="http://demo.itsolutionstuff.com/paypal/cancel.php">
                        <input type="hidden" name="cmd" value="_cart">

                         <input type="hidden" name="upload" value="1">
                        <table class="table">
                        <thead>
                            <tr>
                            <th >pizza</th>
                            <th >price</th>
                            <th>quantity</th>
                            <th>total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php cart();?>
                            </tbody>
                        </table>
                        <table class="float-right table table-sm col-12 text-center">
                        <thead>
                            <tr>
                            <th scope="col">pizzas number</th>
                            <th scope="col">total price</th>
                            </tr>
                        </thead>
                        <tbody>
                        <th scope="row"><?php echo isset($_SESSION['total_pizzas'])? $_SESSION['total_pizzas']:"";   ?></th>
                        <th scope="row"><?php echo isset($_SESSION['total_price'])? $_SESSION['total_price']:""; ?></th>
                           </tbody>
                        </table>
                        <div class="center-it">
            

                        <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-small.png" alt="PayPal Logo" name="submit" name="continue_payment" value="Pay Now">
                      
                        </div>
                      
                  </form>

                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- en cart modal -->

<!--st show_pizzas-->

<div class="show_pizzas">

    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <img class="card-img-top" src="css/adult-bake-baker-724212.jpg" alt="Card image cap">

                </div>
                <div class="card">

                    <img class="card-img-top" src="img/5c8033dc469054.10988500.jpg" alt="Card image cap">

                </div>
                <div class="card">
                    <div class="card-body">

                        <ul class="list-group">
                            <li class="list-group-item text-uppercase">TOT</li>
                            <li class="list-group-item text-uppercase">unique taste </li>

                        </ul>
                    </div>


                </div>

            </div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                <div class="row">
                    <?php foreach($pizzas as $pizza):?>
                    <div class="col-sm-6 col-md-6 col-lg-6">

                        <div class="card">
                            <img class="card-img-top" src="img/<?php echo $pizza['image'] ;?>">
                            
                            <div class="card-body">

                                <h4 class="card-title text-uppercase text-danger">
                                    <?php echo htmlspecialchars($pizza['title']); ?>
                                </h4>
                                <h4 class="text-uppercase text-weight-bold"> <?php echo htmlspecialchars($pizza['price']); ?>$</h4>

                                <ul class="list-group list-group-flush">
                                    <?php 
                                     foreach ( explode(',',$pizza['ingredients']) as $ing) :
                                     ?>
                                    <li class="list-group-item"><?php echo htmlspecialchars($ing); ?></li>
                                    <?php 
                                     endforeach
                                    ?>
                                </ul>


                                <div class="row">
                                    <div class="col-md-5">
                                        <a href="pizzadetails.php?id=<?php echo $pizza['id'] ?>" class="card-link btn btn-primary text-uppercase font-weight-bold">Read More</a>

                                    </div>
                                    <div class="col-md-1"></div>
                                    <a href="index.php?add=<?php echo $pizza['id'] ?>" class="card-link btn btn-danger text-uppercase font-weight-bold">Add to cart</a>

                                      


                                </div>
                            </div>

                        </div>

                    </div>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--en show_pizzas-->
<!-- st delivery -->
<div class="trading-services bg-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center"><i class="fas fa-shipping-fast fa-4x text-white"></i></h5>
                        <h3 class="text-center">fast delivery</h3>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center"><i class="fas fa-check fa-4x text-white"></i></h5>
                        <h3 class="text-center">health check</h3>

                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center"><i class="fas fa-fire fa-4x text-white"></i></h5>
                        <h3 class="text-center">hot taste</h3>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card">
                    <div class="card-body">

                        <h5 class="text-center"><i class="fas fa-suitcase fa-4x text-white"></i></h5>
                        <h3 class="text-center">client support</h3>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- en delivery -->

<div class=contact_us>
<div class="container">
     
    

               
     <form class="contact-us-form" action="post">
     <h3 class="header">
     Your feed back is important to us
     </h3>   
     <div class="row">
     <div class="col-md-6">

     <div class="form-group">
     <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                     
      </div>
      <div class="form-group">
      <input type="text" name="email" class="form-control" placeholder="Your email *" value="" />
                     
      </div>
      <div class="form-group">
      <input type="text" name="number" class="form-control" placeholder="Your number *" value="" />
                     
      </div>
     </div>
     
     <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                        <button name="submit" class="btn btn-secondary">submit</button>
                    </div>

    </div>
   
    </form>

 </div>
 </div>
<?php
 include('templates/footer.php');

?>

</body>

</html>
