<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "account";

    $conn = mysqli_connect($server, $username, $password, $database);
    // echo var_dump($conn);
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }
?>