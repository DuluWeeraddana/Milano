<?php

    session_start();

    require_once('../connection/connection.php');


        $err="";

        $mail="";
        $sub="";
        $msg="";
    

    if(isset($_POST['send'])){
        
        $mail=$_POST['mail'];
        $sub=$_POST['sub'];
        $msg=$_POST['msg'];
        
        $sql = "INSERT INTO `contactus_submissions`(`subject`, `message`, `email`) VALUES ('$sub', '$msg', '$mail')";
        
        if (mysqli_query($conn, $sql)) {
            $err="Your message has been sent successfully.";
        } else {
            $err="Your message not sent.";
        }
    }

    if(isset($_SESSION['current_user']))
    {
        $sql = "SELECT count(`id`) AS 'cartCount' FROM `cart` WHERE `customer_id` = '{$_SESSION['current_user']}'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $cartCount = $row['cartCount'];
            }
        } else {
            $cartCount = 0;
        }
    }

?>


<html>
  <head>
    
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">     
      <link href="../css/login.css" rel="stylesheet">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <!------ Include the above in your HEAD tag ---------->
      
      
       <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Contact Us | Milano</title>

        <!--title icon-->
        <link rel="icon" type="image/ico" href="../image/logo.png"/>

        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      
  </head>
    
<body id="LoginForm">
    
      <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php"><img src="../image/logo.png" style="height:50px;"> Milano</a>
                
                <h5 class="text-info lead"><?php if(isset($_SESSION['current_user'])){ echo "| Welcome back, ".$_SESSION['name']; } ?></h5>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto lead">
                    <li class="nav-item">
                            
                        <?php
                            if(isset($_SESSION['current_user'])){


                                ?>
                                <a class="nav-link" href="cart.php"><i class="fa fa-cart-plus" style="font-size:36px;color:orange"><?php 
                                    if($cartCount!=0){
                                        echo "<sup><span class='badge badge-pill badge-danger'>{$cartCount}</span></sup>";
                                    }
                                ?>
                                    </i></a>
                                <?php

                            }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="contactUs.php">Contact Us</a>
                    </li>
                        <li class="nav-item">
                            <?php
                                if(!isset($_SESSION['current_user'])){
                                    echo "<a class='nav-link' href='signup.php'>Sign Up</a>";
                                }
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                                if(isset($_SESSION['current_user'])){
                                    echo "<a class='nav-link' href='logout.php'>Logout</a>";
                                }
                                else {
                                        echo "<a class='nav-link' href='login.php'>Login</a>";
                                }
                            ?>
                        </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
    <div class="login-form">
    <div class="main-div">
        <div class="panel">
       <h2>Sign Up</h2>
       </div>
        <form id="Sign Up" method ="post" action="contactUs.php">
            
            <div class="form-group">
                <input type="email" class="form-control" name="mail" placeholder="Email Address" value="<?php
                                if(isset($_SESSION['current_user'])){
                                    echo $_SESSION['email'];
                                }
                            ?>" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="sub" placeholder="Subject" required>
            </div>
             <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Message" name="msg" required></textarea>
            </div>
            <button type="submit" name="send" class="btn btn-primary">Send</button>
            <div class="mt-3 text-primary">
             <p> <?php echo $err;?></p>
            </div>

        </form>
        </div>
    </div></div>
    
    <!-- Footer -->
        <footer class="py-5 bg-dark" style="bottom:0; width:100%;">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Milano 2020</p>
            </div>
            <!-- /.container -->
        </footer>


</body>
</html>