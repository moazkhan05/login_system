<?php
    $host = 'localhost';
    $dbname = 'testing_db';
    $username = 'root';
    $password = 'root';

    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>