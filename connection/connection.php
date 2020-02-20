<?php

    $conn = mysqli_connect('localhost', 'root', '', 'milano');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>