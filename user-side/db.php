<?php
    // Establish connection
    $conn = mysqli_connect("localhost", "root", "", "travellocadb");

   // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
