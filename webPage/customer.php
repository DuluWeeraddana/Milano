<?php

    require_once('../connection/connection.php');

?>


<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Home Page | Milano</title>

        <!--title icon-->
        <link rel="icon" type="image/ico" href="../image/logo.png"/>

        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="../css/home.css" rel="stylesheet">

    </head>

<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../webPage/index.php"><img src="../image/logo.png" style="height:50px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto lead">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="../webPage/logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <div class="col-lg-3">
                <h1 class="my-4">Milano</h1>
                <div class="list-group">
                    <a href='index.php?cat=all' class='list-group-item category'>All Category</a>
                    <?php
                    $sql = "SELECT * FROM `category`";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<a href='index.php?cat=" . $row['id']. "' class='list-group-item category'>" . $row['type']. "</a>";
                        }
                    } else {
                        echo "<a href='#' class='list-group-item'>No Category</a>";
                    }
                    ?>
                </div>

            </div>
            <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="../image/c1.jpeg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="../image/c2.jpeg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="../image/c3.jpeg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">

            <?php
            
                if(isset($_GET['cat'])) {
                    if($_GET['cat'] == 'all') {
                        $sql = "SELECT * FROM `product`";
                    } else {
                        $sql = "SELECT * FROM `product` WHERE `category_id` = '{$_GET['cat']}'";
                    }
                } else {
                    $sql = "SELECT * FROM `product`";
                }

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-lg-4 col-md-6 mb-4'>
                                <div class='card h-100'>
                                  <a href='#'><img class='card-img-top' src='" . $row['image']. "' alt=''></a>
                                  <div class='card-body'>
                                    <h4 class='card-title'>
                                      <a href='#'>" . $row['name']. "</a>
                                    </h4>
                                    <h5>LKR " . $row['price']. "</h5>
                                    <p class='card-text'>" . $row['description']. "</p>
                                  </div>
                                  <div class='card-footer'>
                                    <small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                  </div>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<a href='#' class='list-group-item'>No Product</a>";
                }
            
            ?>
            
        </div>
          
          <div class="row">
            <input type="button" class="btn btn-warning my-3" value="Load More" onclick="loadDoc()">
          </div>
          
          <script>
              function showHint(str) {
                  var xhttp;
                  if (str.length == 0) { 
                      document.getElementById("txtHint").innerHTML = "";
                      return;
                  }
                  xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("txtHint").innerHTML = this.responseText;
                      }
                  };
                  xhttp.open("GET", "index.php?q="+str, true);
                  xhttp.send();   
              }
          </script>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Milano 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>