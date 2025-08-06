<?php
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

// Check if variables are provided to create a new notification
if (isset($notifiedUser) && isset($notificationType) && isset($relatedentityID)) {
    $title = '';
    if ($notificationType == 'post') {
        $title = "You’ve got a new answer on your post";
    } elseif ($notificationType == 'chat') {
        $title = "You've got a new message";
    } else {
        // Stop execution if the notification type is not valid
        die("Invalid notification type");
    }
    
    // Call the database function with all required parameters
    createNotification($pdo, $notifiedUser, $title, $notificationType, $relatedentityID);

} else {
    // Count unread notifications for the current user
    if (isset($_SESSION['user_id'])) {
        $current_userid = $_SESSION['user_id'];
        $unread_count = countUnreadNotifications($pdo, $current_userid);
    } else {
        $unread_count = 0;
    }
}
?>
