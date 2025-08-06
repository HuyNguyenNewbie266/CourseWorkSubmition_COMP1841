<?php
require "login/check.php";
$title = 'Contact Admin - GrenovateHub';
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

try {
    $success = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $message = trim($_POST['message'] ?? '');
        if (empty($message)) {
            $error = 'Message cannot be empty.';
        } else {
            insertAdminMessage($pdo, $message);
            $success = true;
        }
    } 
    ob_start();
    include 'templates/contact_admin.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include_once 'notify.php';
include 'templates/layout.html.php';
?>
