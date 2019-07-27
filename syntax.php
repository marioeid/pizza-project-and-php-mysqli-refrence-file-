<?php
 /* SESSIONS */
// if (isset($_POST['submit']))
// {
//         session_start();
//         setcookie('gender',$_POST['gender'],time+86400);
//         $_SESSION['name']=$_POST['name'];
//         echo $_SESSION['name'];
//         // you can now access this variable in any place in you website and in any webpage
//         // do the next steps in another page to get the session
//         if ($_SERVER['QUERY_STRING']=='noname')
//         {
//                 // unset single session
//                // unset($_SESSION['name']);
//                // unset all sessions
//                // session_unset();
//         }
//         //Null Coalescing 
//         $name=$_SESSION['name'] ?? 'GUEST';

//         // do the next steps in another pate to get the cookies
//         $gender=$_COOKIE['gender'] ?? 'unknown';

// }
?>
<?php
 /* files*/
// $quotes=readfile('readme.txt');
// echo $quotes;
$file='readme.txt';
if (file_exists($file))
{
//         // read file
//         echo readfile($file).'<br>';
//        // copy file
//        copy($file,'quotes.txt').'<br>';

//        // absolute path
//        echo realpath($file).'<br>';
       
//        // file size
//        echo filesize($file).'<br>';
//        // rename file 
//        rename($file,'testfff.txt');

}
else {
        echo 'file doesnot exist';

}
// when you echo it you will get the content in the end is number of bytes

// making folder
//mkdir('quotes');

// another way to opening the file
$file='quotes.txt';
// opening it for reading only
//$handle=fopen($file,'r');
// read the file
//echo fread($handle,filesize($file));
// let's read a 10 (bytes)
        //echo fread($handle,10);
// read a single line if used it twice the pointer will move to the second line and will give us another line the second one here
        //echo fgets($handle);
        //echo fgets($handle);
// read a single char will take the char after two lines
        //echo fgetc($handle);

// writing on a file
 // open file for writing and reading this will write from the first
 $handle=fopen($file,'r+');
fwrite($handle,"\n every thing popular is wrong");
// if you want to write in the end use a or a+ pointer in the handle function istead of r or r+ it will place the pointer to the end
// close 
fclose($handle);
// delete file 
unlink($file);
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


    <title>my first php page</title>
</head>

<body>
   <!-- st super globals -->
   <?php 
   //echo $_SERVER['SERVER_NAME'].'<br>';
   //echo $_SERVER['REQUEST_METHOD'].'<br>';
   //echo $_SERVER['SCRIPT_FILENAME'].'<br>';
   //echo $_SERVER['PHP_SELF'].'<br>';
  // echo $_SERVER['SERVER_NAME'].'<br>';

 


   
   ?>
   <div class="cookies_and_sessions">
   <!-- <form action="syntax.php" method="POST">
    <input type="text" name="name">
    <input type="submit" name="submit" value="submit">
    <select name="gender">
    <option value="male">male</option>
    <option value="female">female</option>
    </select>
 </form> -->
   </div>
  

   <!--en super globals -->
    <!-- st variables and constants -->
    <div class="vars_and_const_">
        <?php  
        /* variables */
                //$var='hi';
                //$var2=3;
        /* over right variables */
                //$var='hi';
                //echo $var;
                //echo $var2;
        /* constants */
        // all your constant are uppercase that's special
                //define('NAME',3);
                //echo NAME;
        /* overrighting constants will give me an error */
                // define('NAME',3);
                // NAME=3;
        /* boolians */
        // the browser converts false to empty string "" and true to string one "1"
        // number comparsions returns boolians
                // echo false;
                // echo true;
                // echo (5<10);
                // echo (1==10);
                // echo (1>10);
                // echo (2<10);
                // echo 5!=10;
                // echo 5<=10;
                // echo 10>=5;
                // echo 5>=5;
        // string comparison first length then chars to ascii code
                // echo 'shaun'<'yoshi';
                // echo 'sa'>'a';
                //echo 'S'>'s';
                //echo 'mario'=='mario';
                //echo 'mario'=='Mario';
        // loose comparison deosn't take care of datatype 
                //echo 5=='5';
        // strict comparison takes care of datatype
                //echo 5==='5';
                //echo 5===5;
                //echo 5==5;
                //echo true=="1";      
                //echo false=="";

?>
        <!-- en variables and constants -->
    </div>
    <!-- st strings -->
    <div class="strings">
        <?php 
                // $name="hello honey";
                // $name2="hello hone2";
        /* concatenate two strings */
                // echo $name.$name2;
                // echo $name;
                // echo $name[0];
                //echo $name."$name";
                // echo $name.'$name';
                //echo $name+'$name';
        /* en concatenate two strings */
        
        /* find length of string */
                //echo strlen($name);
                
        /* convert string to upper case or to lowercase */
               //echo strtoupper($name);
               //echo strtolower($name);

        /* replace every h with m in string name */
              // echo str_replace('h','M',$name);
        
 ?>
    </div>
    <!-- en strings -->

    <!-- st numbers -->
    <div class="numbers">
        <?php 
        // integer and float numbers 
                // $radius = 25;
                // $pi = 3.14;
        /* order of operations (B-I-D-M-A-S) */
        // ** this signs **2 means power of 2 */
                // echo $pi * $radius**2;
                // echo 2*(4+9)/3;
        /*  increment and decrement operations */
                // echo $radius++;
                // echo  ++$radius;
                // echo $radius--;
                // echo  --$radius;
        /* shorthand additoin and minus and any operator etc */
                // $age+=10;
                // $age-=10;
                // $age*=2;
                // $age/=2;
        /* number functions */
                // echo ceil($age);
                // echo floor($age);
                // echo pi();
        ?>
    </div>
    <!-- en numbers -->
   
    <!-- st if conditions -->
    <div class="if_conditions">
    <?php
                //     $price=0;
                //     if ($price<30&&$price>0)
                //     {
                //             echo 'the condition is met';
                        
                //     }
                //     else if ($price===0){echo 'what';}
                //     else  if ($price==30||$price==60){
                //             echo 'the condition is not met';
//     }
    ?>
    </div>
    <!-- en if conditions -->

    <!-- st arrays -->
    <div class="one_dimensional_arrays">
      <?php
     // indexed arrays
            //$manystr=['hello','are','you','here'];
            //$manystr2= array('hello','are','you','here');
            //echo $manystr[0].$manystr2[0];
            //$ages=[20,22,23];
            // echo $ages; 
     // print readeable
            // print_r($ages);
            // $ages[1]=40;
            // print_r($ages);
     // add a new elment to the end of the array
            // $ages[]=60;
            // array_push($ages,70);
            // print_r($ages);
     // length of the array
            // echo count($ages);
     // merge two arrays
           //$res=array_merge($manystr,$manystr2);
           //print_r($res);
     // associative arrays map (key & value) pairs
           //$ninjas=['mario'=>'anime','antonious'=>'database','salma'=>'nope'];
           //echo $ninjas['mario'];
           //print_r($ninjas);
           //$ninjas2=array('mario'=>'anime','antonious'=>'database','salma'=>'nope');
           //print_r($ninjas2);
     // add a new elment to the map or overright elment
           //$ninjas2['salmaa']='stillnope';
           //$ninjas2['salma2']='willalwaysbeanope';
           //print_r($ninjas2);
     // count the lenght
           // echo count($ninjas2);
      ?>
    </div>
    <!-- en arrays -->
    <!-- st multidimensional arrays and loops -->
    <div class="multidimensional_arrays_andloops">
    <?php
    // multidimensional arrays 
        // $blogs=[ 
            //['mario'=>'hasomething'],
            //['mario','mario2',30],
            //['mario','ka']
            //];
            //print_r($blogs);
            //print_r($blogs[1]);
            //echo $blogs[1][1];
            //echo count($blogs);
    // pop the last array (vector) elment
            //$lastelement=array_pop($blogs);
            //print_r($lastelement);
    // forloop through the vector of vectors and output all it's elments  
            // for ($i=0;$i<count($blogs);$i++)
            // {
            //      for ($j=0;$j<count($blogs[$i]);$j++)
            //      {
            //          echo 'hello world';
                
            //      }
            //      echo "<br>";

            // }        
            // foreach ($blogs as $blog)
            //  {
            //      foreach ($blog as $blogelment)
            //      {
            //          echo'hello world';
            //      }
            //      echo "<br>";
            //  }
    // while loop
            //    $i=0;  
            //   while($i<count($blogs))
            //   {
            //       echo 'hello world';
            //       echo "<br>";
            //       $i++;
            //   }
            
    ?>    
    </div>
    <!-- en multidimensional arrays and loops -->
    <!-- st printing dynamicly using loops -->
    <div class="printing_dynamicly_using_loops">
    <?php 
           //  $print_dynamicly=['first',30,30,4,'f'];
     ?>
    <?php
           //for ($i=0;$i<count($print_dynamicly);$i++)
           // {
    ?>
     <h3>
     <?php 
          // echo $print_dynamicly[$i]; 
     ?>
     </h3>
     <?php
    // }
    // your training print a map with an array of two keys every key has a value 
     ?>

   
    </div>
     <!-- en printing dynamicly using loops -->
     
     <!-- st break and continue -->
     <div class="break_and_continue">
     <?php 
                //      $products=[
                //      ['name'=>'me','price'=>20],
                //      ['name'=>'me2','price'=>30]
                //      ];
                //      for ($i=0;$i<count($products);$i++)
                //      {
                //              if ($products[$i]['name']==='me2'){continue;}
                //              if ($products[$i]['name']==='me2'){break;}
                //              echo $i;
                //      }
      ?>
     </div>
     <!-- en break and continue -->
      <div class="functions">
      <?php 
      // function with default value and without one 
                //        function myname($name='defualt')
                //        {
                //          echo $name;
                //        }
                //        myname();
                //        myname('hello');
      // function with variable put it in carly braceses to understand it 
                //        function myproduct($products)
                //        {
                //       //  echo "{$products['name']} costs {$products['price']}";
                //             return "{$products['name']} costs {$products['price']}";
                //         }   
                //        function ($first='me',$second='me')
                //        {
                //                echo $second;
                //                return $first;
                //        }
                //  //echo myproduct(['name'=>'hi','price'=>20]);
                //$formated=myproduct(['name'=>'hi','price'=>20]);
                    

      ?>
      </div>
      <div class="variable-scope">
      <?php 
                //       function myfunc()
                //       {
                //               // local vars
                //               $price=3;

                //       }
                //       function myfunc2($age)
                //       {
                //               // local var also
                
                //               return $age;
                //       }
                //       // global var
                         // $name='mario';
                //       function myfunc3()
                //       {
                //               $name='Shaun';
                //          echo "hello $name";
                //       }
                //       function myfunc4()
                //       {
                //        // use the global one all the function
                //         global $name;
                //         $name='me';
                //         echo "hello $name";
                //       }
                // //       
                //  function myfunc5($name)
                //  {
                //          $name='marrrrrio';
                //      echo "bye $name";
                //  }  
                //  myfunc5($name);
                //  echo $name;
                // pass by refrence
                // function myfunc6(&$name)
                // {
                //         $name='meeee';
                        
                // }
                // echo $name;

                ?>
      </div>
      <div class="include_and_require">
      
           <?php
           // include and require do the same but handles errors different
                //     include('ninjas.php');
                //     require('ninjas.php');
           //include error
                //     include('ninjass.php');
                //     echo 'end of php';
            // require error
                //       require('ninjass.php');
                //       echo 'end of php';
           // another way to write include and require
                // include 'ninjas.php';
                // require 'ninjas.php';
                // 
        ?>
      </div>
      <!-- st ternary-operators -->
      <div class="Ternary-Operators">
      
           <?php
          //   $score=40;
           // $val= $score>40 ? 'high score':'low';
           // echo $val;
         ?>
      </div>
      <!-- en ternary-operators -->
</body>

</html>
