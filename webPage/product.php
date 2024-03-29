<?php

    require_once('../connection/connection.php');

    session_start();

    if(isset($_GET['proId'])) {
	    
        $sql = "SELECT p.`id`, p.`name` AS 'pname', p.`description`,b.`name` AS 'bname', p.`image`, p.`price`, c.`type`, p.`weight`, p.`location` FROM `product` p, `brand` b, `category` c WHERE p.`brand_id` = b.`id` AND p.`category_id` = c.`id` AND p.`id` = '{$_GET['proId']}' LIMIT 1";

        $result = mysqli_query($conn, $sql);

        $rowProId = mysqli_fetch_assoc($result);
        
        $sql = "SELECT * FROM `stock` WHERE id= '{$_GET['proId']}' ";

        $resultSizes = mysqli_query($conn, $sql);
        
        $sql = "SELECT SUM(`available`) AS 'count' FROM `stock` WHERE `id`= '{$_GET['proId']}'";

        $result = mysqli_query($conn, $sql);

        $rowStockCount = mysqli_fetch_assoc($result);
    
    }

    if(isset($_GET['add'])) {
	    
        $sql = "INSERT INTO `cart`(`product_id`, `customer_id`) VALUES ('{$_GET['add']}','{$_SESSION['current_user']}')";
        
        mysqli_query($conn, $sql);
    
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

        <title>Product | Milano</title>

        <!--title icon-->
        <link rel="icon" type="image/ico" href="../image/logo.png"/>

        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link href="../css/home.css" rel="stylesheet">
        
        <script src="../vendor/jquery/jquery.min.js"></script>
        
        <script>
            function showSizeDetails(str) {
                var xhttp;
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
                
                xhttp = new XMLHttpRequest();
                
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                        var input = document.getElementById ("sizeInput");
                        input.max = this.responseText;
                        input.value = 1;
                    }
                };
                
                xhttp.open("GET", "productSize.php?size="+str, true);
                xhttp.send();
            }
        </script>
        
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
                    <div class="shadow-sm p-3 mb-5 bg-white rounded-lg "><h2><?php echo $rowProId['pname']; ?></h2></div>
                    
                    

                </div>
                
                

            </div>
            
            <div class="row">

                <div class="col-lg-4">
                    <div class="shadow-sm p-3 mb-5 bg-white rounded-lg "><img src="../<?php echo $rowProId['image']; ?>" width="100%"></div>
                    
                    

                </div>
                
                 <div class="col-lg-8">
                    <div class="shadow-sm p-3 mb-5 bg-white rounded-lg ">
                        
                        <table class="table">
                            <tr>
                                <th class="p-4">Description</th>
                                <td class="text-success"><?php echo $rowProId['description']; ?></td>    
                            </tr>
                            <tr>
                                 <th class="p-4">Price</th>
                                <td class="text-success"><b>LKR <?php echo $rowProId['price']; ?></b></td>
                            </tr>
                            <tr>
                                 <th class="p-4">Size</th>
                                <td class="text-success">
                                    <?php 
                                        while($rowSizes = mysqli_fetch_assoc($resultSizes)) {
                                            echo "<button name='size' value='{$rowSizes['size']}' onclick='showSizeDetails(this.value)' class='btn btn-outline-success m-1'>{$rowSizes['size']}</button>";
                                        } ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="p-4">Quantity</th>
                                <td class="text-success">
                                    <input type="number" value="1" min="1" max="10" step="1">
                                    <?php echo "<font id='txtHint'>".$rowStockCount['count']."</font>"; ?> Available
                                </td>
                            </tr>
                            <tr>
                                <th class="p-4">Product Code</th>
                                <td class="text-success"><?php echo $rowProId['id']; ?></td>
                            </tr>
                             <tr>
                                <th class="p-4">Brand</th>
                                <td class="text-success"><?php echo $rowProId['bname']; ?></td>
                            </tr>
                             <tr>
                                <th class="p-4">Category</th>
                                <td class="text-success"><?php echo $rowProId['type']; ?></td>
                            </tr>
                             <tr>
                                <td style="width:250px">
                                    
                                    <?php
                                        if(isset($_SESSION['current_user'])){
                                            echo "<a href='index.php?add={$row['id']}' class='btn btn-success mx-3'>Add Cart</a>";
                                            
                                            echo "<a href='webPage/buy.php?buy={$row['id']}' class='btn btn-danger mx-3'>Buy</a>";
                                        }
                                        else {
                                            echo "<a href='webPage/login.php' class='btn btn-danger'>Buy</a>";
                                        }
                                    ?>
                                 </td>
                            </tr>
                        </table>        
                    </div>
                    

                </div>
           

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
