<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$error = '';
if (isset($_POST['submit'])) {
    $badgeName = trim($_POST['badge_name']);
    $description = trim($_POST['description']);
    if (empty($badgeName)) {
        $error = 'Badge name is required.';
    } else {
        try {
            addBadge($pdo, $badgeName, $description);
            header('Location: show_badges.php');
            exit;
        } catch (PDOException $e) {
            $error = 'Error adding badge: ' . $e->getMessage();
        }
    }
}

$title = 'Add Badge - GrenovateHub';
ob_start();
include 'templates/add_badge.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
