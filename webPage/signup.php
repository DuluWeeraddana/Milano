<?php

    session_start();

    require_once('../connection/connection.php');


        $err="";

        $name="";
        $pno="";
        $user="";
        $mail="";
        $pwd="";
        $repwd="";
    

    if(isset($_POST['submit'])){
        
        $name=$_POST['name'];
        $pno=$_POST['pno'];
        $district=$_POST['district'];
        $user=$_POST['user'];
        $mail=$_POST['mail'];
        $pwd=$_POST['pwd'];
        $hpwd = md5($pwd);
        $repwd=$_POST['repwd'];
        
        if(empty($name) || empty($user) || empty($mail) || empty($pno) || empty($pwd) || empty($repwd))
        {
            $err="Please enter all fields";
        }
     
        else
        {
            if($pwd!=$repwd)
            {
                $err="Password not matching";
            }
            else
            {
                $sql="INSERT INTO customer (id,name,email,phone,district_id) VALUES ('$user','$name','$mail','$pno','$district')";

                if (mysqli_query($conn, $sql)) {
                    $sql="INSERT INTO user (id,password,role) VALUES ('$user','$hpwd','customer')";
                    
                    if (mysqli_query($conn, $sql)) {
                        
                        $sql = "SELECT * FROM customer c,user u where c.id=u.id and u.id='{$user}' limit 1";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                
                        $sql = "SELECT * FROM customer c,user u where c.id=u.id and u.id='{$user}' and  u.password='{$hpwd}' limit 1";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    
                        $_SESSION['current_user'] = $row['id']; 
                        $_SESSION['pWord'] = $row['password'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['pno'] = $row['phone'];
                        $_SESSION['district'] = $row['district_id'];
                            
                        header('location:../index.php');
                            }
                        }
                    }
                    else {
                        $err = mysqli_error($conn);
                    }
                }
                else {
                    $err =  mysqli_error($conn);
                }
            }
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

        <title>Home Page | Milano</title>

        <!--title icon-->
        <link rel="icon" type="image/ico" href="../image/logo.png"/>

        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

      
  </head>
    
<body id="LoginForm">
    
      <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php"><img src="../image/logo.png" style="height:50px;"> Milano</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto lead">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactUs.php">Contact Us</a>
                    </li>
                        <li class="nav-item active">
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
        <form id="Sign Up" method ="post" action="signup.php">

            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $name;?>">
            </div>
            
              <div class="form-group">
                <input type="text" class="form-control" name="pno" placeholder="Phone Number" value="<?php echo $pno;?>">
            </div>
            <div class="form-group">
                <select name="district" class="form-control input_user">
                    <?php

                        $sql = "SELECT * FROM `district`";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                            }
                        } else {
                            echo "<option disabled>Empty list</option>";
                        }

                    ?>
                </select>

            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="user" placeholder="User Name" value="<?php echo $user;?>">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="mail" placeholder="Email Address" value="<?php echo $mail;?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pwd" placeholder="Password">
            </div>
             <div class="form-group">
                <input type="password" class="form-control" name="repwd" placeholder="Re-enter Password">
            </div>
            <div class="forgot">
          
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
            <div class="mt-3 text-danger">
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