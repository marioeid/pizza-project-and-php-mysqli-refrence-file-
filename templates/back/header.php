<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>piZZA project</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <!-- st navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">KILLER PIZZA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav ml-auto mx-auto">
            <?php 
                    if (isset($_COOKIE['user_name']))
                    {
                    ?>
                   <li class="nav-item">
                    <a class="navbar-link text-dark font-weight-bold">WElCOME <?php echo htmlspecialchars($_COOKIE['user_name']);?></a>
                    </li>

                    <?php } ?>
                    </ul>
                    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link text-primary font-weight-bold">contact us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger font-weight-bold">services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white font-weight-bold btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter4">
                            <i class="fas fa-shopping-cart fa-1x text-white"></i> Cart
                        </a>
                    </li>
                    <?php 
                    if(!isset($_COOKIE['user_name'])) {

                    ?>
                    <li class="nav-item">
                        <a class="nav-link btn text-white font-weight-bold btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter3">
                            <i class="fas fa-user fa-1x text-white"></i> log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white font-weight-bold btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter2">
                            <i class="fas fa-user-plus fa-1x text-white"></i> Sign up
                        </a>
                    </li>
                    <?php   }?>
                    <?php
                    if (isset($_COOKIE['user_name'])&&$_COOKIE['user_name']=='marioeid')
                    {
                    ?>
                     <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold btn btn-dark" href="index2.php">
                    <i class="fas fa-user-shield"></i>
                    order page</a>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white font-weight-bold" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fas fa-plus-square"></i>
                        Add Pizza</a>
                    </li>
                    </li>
                    <?php }?>
                    <?php 
                    if (isset($_COOKIE['user_name']))
                    {
                    ?>
                  

                   <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold btn btn-secondary" href="index.php?logout">
                    <i class="fas fa-sign-out-alt"></i>
                    log out</a>
                    </li>

                    <?php } ?>


                </ul>
            </div>
        </div>
    </nav>
    <!-- en navbar -->
