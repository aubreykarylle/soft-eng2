<?php
    // Establish connection
    $conn = mysqli_connect("localhost", "root", "", "travellocadb");

    // Check for connection errors
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
