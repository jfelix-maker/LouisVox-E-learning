<?php
require_once "config.php";
session_start();

// Initialize chat history if not set
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    unset($_SESSION['chat_history']);
}

if (count($_SESSION['chat_history']) == 0) {
    // Start the conversation when the page is loaded
    start_conversation();
}

// Function to greet the user
function greet_user() {
    $greetings = ["Hi there!", "Hello!", "Hey! How’s it going?", "Good day!"];
    return $greetings[array_rand($greetings)];
}

// Function to ask a follow-up question
function ask_question() {
    $questions = [
        "How can I assist you today?", 
        "What do you want to know here today?", 
        "Is there anything you'd like to know?"
    ];
    return $questions[array_rand($questions)];
}


// Main function to start the conversation
function start_conversation() {
    unset($_SESSION['chat_history']);
    // Greeting
    $greetings = greet_user() . "";
    
    // Ask question
    $questions  = ask_question() . "";
    $_SESSION['chat_history'][] = "Bot:  ". $greetings." ".$questions;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input and trim whitespace
    $user_input = trim($_POST['user_input']);
    $response = '';
    $lwcase_uinput = strtolower($user_input); // Convert string to lowercase
    // Handle user input
    if ($lwcase_uinput === 'exit') {
        $response = "Thank You, you can start a new conversation later.";
        unset($_SESSION['chat_history']);
        start_conversation();
    }
    elseif ($lwcase_uinput === '') {
        $response = "I don't understand what you're saying? 1";
    }
    elseif ($lwcase_uinput === 'hi') {
        $response = "Hi, I'm chatbot, how can I help you? You can type 1 to 5.";
    }
    elseif ($lwcase_uinput === 'FAQ') {
        $response = "You can type 1 to 5.";
    }
    // Check if the input is a word and handle options
    elseif ($lwcase_uinput === "hi" || "hello"){
        $user_option = $user_input;
        switch ($user_option) {
            case 1:
                $response = "1. What is the E-learning about?"; 
                break;
            case 2:
                $response = "1. Where should I upload my assignment? 2. Where should I go to register for a new e-learning course?";
                break;
            case 3:
                $response = "1. When was this e-learning created? <br> 2. When can I access the course materials on the e-learning platform?";
                break;
            case 4:
                $response = "1. Who can I contact for support? <br> 2. Who are the instructors?";
                 break;
            case 5:
                $response = "1. Why is E-learning important? <br> 2. Why should I choose this course?";
                 break;
            case 6:
                $response = "1. How to recovery My account? <br> 2. Where I Can Recovery My Account Safety?";
                break;
            default:
                $response = "I don't understand what you're saying? 2";
                break;
                }
            }
    
    // Store user and bot messages in chat history
    $_SESSION['chat_history'][] = "User:  " . htmlspecialchars($user_input);
    $_SESSION['chat_history'][] = "Bot:  " . $response;
    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-learning Chatbot</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .chat-container { width: 50%; margin: auto; }
            .chat-box { border: 1px solid #ccc; padding: 10px; height: 300px; overflow-y: scroll; }
                .input-box { margin-top: 10px; }
            </style>
        </head>
        <body>
        <div class="chat-container">
            <h1>Welcome to E-learning Bot</h1>
            <div class="chat-box">
                <?php
                    // Display chat history
                    foreach($_SESSION['chat_history'] as $message){
                        echo "<p>" . htmlspecialchars($message) . "</p>";
                    }
                ?>
            </div>
            <form method="POST" class="input-box">
                <input type="text" name="user_input" placeholder="Please Input the Text" required>
                <button type="submit">Send</button>
            </form>
        </div> 
    </body>
</html>