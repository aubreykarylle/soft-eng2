<?php
    // Establish connection
    $conn = mysqli_connect("localhost", "root", "1234", "traveloca");

   // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
