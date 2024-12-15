<?php
include 'config.php';

// Fetch messages from the database
$query = "SELECT username, message, timestamp FROM groupchat ORDER BY timestamp DESC LIMIT 10";
$result = $conn->query($query);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// Return messages in JSON format
echo json_encode(array_reverse($messages));  // Reverse order to show most recent messages at the bottom
?>
