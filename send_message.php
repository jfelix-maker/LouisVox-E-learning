<?php
include 'config.php'; // Include the database connection

// Check if a message was posted
if (isset($_POST['message']) && isset($_POST['username'])) {
    $username = $_POST['username'];
    $message = $_POST['message'];

    // Insert message into the database
    $stmt = $conn->prepare("INSERT INTO groupchat (username, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
    $stmt->close();
}
?>
