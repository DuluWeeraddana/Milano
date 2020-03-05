<?php

    require_once('../connection/connection.php');

    session_start();

    if(isset($_GET['remove'])) {
	    
        $sql = "DELETE FROM `cart` WHERE `id` = {$_GET['remove']}";
        
        mysqli_query($conn, $sql);
    
    }

    if(isset($_GET['proId'])) {
	    
        $sql = "SELECT p.`id`, p.`name`, p.`description`,b.`name`, p.`image`, p.`price`, c.`type`, p.`weight`, p.`location` FROM `product` p, `brand` b, `category` c WHERE p.`brand_id` = b.`id` AND p.`category_id` = c.`id` AND p.`id` = '{$_GET['proId']}' LIMIT 1";

        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
    
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


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Cart | Milano</title>

        <!--title icon-->
        <link rel="icon" type="image/ico" href="../image/logo.png"/>

        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link href="../css/home.css" rel="stylesheet">
        
        <script src="../vendor/jquery/jquery.min.js"></script>
        
        <style>
            body {
                /*background-image: url('image/back.gif');*/
                background-image: url('../image/background.jpg');
            }
        </style>

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php"><img src="../image/logo.png" style="height:50px;"> Milano</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto lead">
                        <li class="nav-item active">
                            <?php
                                if(isset($_SESSION['current_user'])){
                            ?>
                            <a class="nav-link" href="cart.php"><i class="fa fa-cart-plus" style="font-size:36px;color:orange">
                                <?php 
                                    if($cartCount!=0){
                                        echo "<sup><span class='badge badge-pill badge-danger'>{$cartCount}</span></sup>";
                                    }
                                ?>
                                </i>
                            </a>
                            <?php } ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
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

        <!-- Page Content -->
        <div class="container">
            <div class="row mt-3">

                <div class="col-lg-8">
                    <div class="shadow-sm p-3 mb-5 bg-white rounded-lg "><h2>Shopping Cart (<?php echo $cartCount; ?>)</h2></div>
                    
                    <?php if($cartCount <= 0){
                                echo "<div class='shadow-sm p-3 mb-5 bg-danger rounded-lg text-white'><h5>Cart is Empty</h5></div>";
                            }
                    ?>
                                    

                    <div class="row" id="product-container">

                        <?php 

                            $query2 = "SELECT c.`id` AS 'cartId',p.* FROM `cart` c, `product` p WHERE c.`product_id` = p.`id` AND c.`customer_id` = '{$_SESSION['current_user']}'";

                            $result = $conn->query($query2);

                            while ($row = $result->fetch_assoc()) { 

                        ?>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top" src="../<?php echo $row['image'] ?>" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#"><?php echo $row['name']?></a>
                                    </h4>
                                    <h5>LKR <?php echo number_format($row['price'],2); ?></h5>
                                    <p class="card-text"><?php echo $row['description']?></p>
                                    <?php
                                        if(isset($_SESSION['current_user'])){
                                            echo "<p class='text-success'>Price: LKR ".number_format($row['price'],2)."</p>";
                                            echo "<p class='text-success'>Shipping Price: LKR ".number_format($row['price'],2)."</p>";
                                        }
                                        else {
                                            echo "<p class='text-success'>Please <a href='login.php'>login/Signup</a> to show the shipping cost</p>";
                                        }
                                    ?>
                                </div>
                                <div class="card-footer" style="text-align: center;">
                                    <?php
                                        echo "<a href='cart.php?remove={$row['cartId']}' class='btn btn-danger mx-2'>Remove</a>";
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php } ?>

                    </div>

                </div>
                
                <div class="shadow-sm p-4 mb-5 bg-white rounded-lg col-lg-4 h-100">
                    
                    <?php
                        $sql = "SELECT SUM(p.`price`) AS 'subTotal' FROM `cart` c, `product` p WHERE c.`product_id` = p.`id` AND c.`customer_id` = '{$_SESSION['current_user']}'";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $subTotal = $row['subTotal'];
                                if($subTotal==0){
                                    $shipping = 0;
                                } else {
                                    $shipping = 100;
                                }
                            }
                        } else {
                            $subTotal = 0;
                            $shipping = 0;
                        }
                    ?>
                    
                    <h2>Order Summary</h2>
                    <div class="d-flex">
                        <div class="mr-auto p-2">Subtotal</div>
                        <div class="p-2">LKR <?php echo number_format($subTotal,2); ?></div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="mr-auto p-2">Shipping</div>
                        <div class="p-2">LKR <?php echo number_format($shipping,2); ?></div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex">
                        <div class="mr-auto p-2"><h5>Total</h5></div>
                        <div class="p-2"><h5>LKR <?php echo number_format($subTotal+$shipping,2); ?></h5></div>
                    </div>
                    
                    <button type="submit" name="msgSend" class="btn btn-danger w-100 mt-3">Buy (<?php echo $cartCount; ?>)</button>

                </div>

            </div>

            <br>

        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark" style="bottom:0; width:100%;">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Oh-la-la 2020</p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    </body>

</html>
