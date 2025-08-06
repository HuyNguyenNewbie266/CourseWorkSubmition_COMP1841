<?php
require "login/check.php";
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

$user_id = $_SESSION['user_id'];
$person_id = $_GET['id'] ?? null;

// Prevent chatting with oneself or invalid ID
if (!$person_id || $person_id == $user_id) {
    die("Invalid user ID or you cannot chat with yourself. <a href='show_users.php'>Go back</a>");
}

// Verify the recipient exists
$other_user = getChatRecipient($pdo, $person_id);

if (!$other_user) {
    die("User not found. <a href='show_users.php'>Go back</a>");
}

// Handle sending a new message
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty(trim($_POST['content'] ?? ''))) {
    $content = trim($_POST['content']);
    insertChatMessage($pdo, $user_id, $person_id, $content);

    // Create a notification for the other user
    $notifiedUser = $person_id;
    $notificationType = 'chat';
    $relatedentityID = $user_id; 
    include 'notify.php'; // This script handles the notification logic

    header("Location: chat.php?id=$person_id");
    exit;
}

// Fetch chat history
$messages = getChatHistory($pdo, $user_id, $person_id);

$title = 'Chat with ' . htmlspecialchars($other_user['Username']);

ob_start();
include 'templates/chat.html.php';
$output = ob_get_clean();
include_once 'notify.php';
include 'templates/layout.html.php';
?>
