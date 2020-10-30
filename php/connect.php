<?php

    $server = "localhost";

    $username = "kaccfunsitecz";

    $password = "Endy54321";

    $db = "charita";



    $conn = mysqli_connect($server, $username, $password, $db);



    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

    }

?>