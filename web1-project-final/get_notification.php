<?php
require "login/check.php";
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $notification_id = $_GET['id'];

    // Mark the notification as read
    markNotificationAsRead($pdo, $notification_id, $user_id);

    // Get notification details for redirection
    $notification = getNotificationDetails($pdo, $notification_id, $user_id);
    
    if ($notification) {
        if ($notification['Type'] == 'post') {
            header('Location: view_post.php?id=' . $notification['RelatedEntityID']);
        } else { // Assumes any other type is 'chat'
            header('Location: chat.php?id=' . $notification['RelatedEntityID']);
        }
        exit;
    }
    
}

// Fetch all notifications for the current user to display on the page
$notifications = getAllUserNotifications($pdo, $user_id);

$title = 'Your Notifications';

ob_start();
include 'templates/get_notification.html.php';
$output = ob_get_clean();


include_once 'notify.php';
include 'templates/layout.html.php';
?>
