<?php
session_start();
include "config.php";
 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $cemail = htmlspecialchars(trim($_POST["username"]));
}
$stmt = $conn->prepare("SELECT * FROM tbuser WHERE username = ? ");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Chat</title>
    <style>
        #chat-box {
            width: 500px;
            height: 300px;
            border: 1px solid #ccc;
            overflow-y: scroll;
            padding: 10px;
            margin-bottom: 10px;
        }
        .message {
            padding: 5px;
            border-bottom: 1px solid #eee;
        }
        .message span {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Group Chat</h1>

    <div id="chat-box"></div>

    <form id="chat-form">
        <input type="text" id="username" value= <?= htmlspecialchars($username) ?>>
        <textarea id="message" placeholder="Type your message" required></textarea>
        <button type="submit">Send</button>
    </form>
    

    <script>
        // Function to load messages dynamically
        function loadMessages() {
            const chatBox = document.getElementById('chat-box');
            
            // Make AJAX request to get latest messages
            fetch('get_message.php')
                .then(response => response.json())
                .then(messages => {
                    chatBox.innerHTML = '';  // Clear the chat box
                    messages.forEach(message => {
                        // Append each message to the chat box
                        const messageDiv = document.createElement('div');
                        messageDiv.classList.add('message');
                        messageDiv.innerHTML = `<span>${message.username}</span>: ${message.message} <br><small>${message.timestamp}</small>`;
                        chatBox.appendChild(messageDiv);
                    });

                    // Scroll to the bottom to show the latest message
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        }

        // Function to send message
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();  // Prevent form from reloading the page

            const username = document.getElementById('username').value;
            const message = document.getElementById('message').value;

            // Make AJAX request to send message
            fetch('send_message.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `username=${encodeURIComponent(username)}&message=${encodeURIComponent(message)}`
            })
            .then(() => {
                document.getElementById('message').value = '';  // Clear message input
                loadMessages();  // Reload the chat
            });
        });

        // Initially load the messages
        loadMessages();

        // Refresh messages every 3 seconds
        setInterval(loadMessages, 3000);
    </script>

</body>
</html>
