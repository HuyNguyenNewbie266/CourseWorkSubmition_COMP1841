<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$error = '';
try {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception('No badge ID provided.');
    }
    $badgeID = $_GET['id'];
// HANDLE POST REQUEST FOR UPDATING BADGE
    if (isset($_POST['submit'])) {
        $badgeName = trim($_POST['badge_name']);
        $description = trim($_POST['description']);
        if (empty($badgeName)) {
            $error = 'Badge name is required.';
        } else {
            updateBadge($pdo, $badgeID, $badgeName, $description);
            header('Location: show_badges.php');
            exit;
        }
    }

    $badge = getBadgeForEdit($pdo, $badgeID);
    if (!$badge) {
        throw new Exception('Badge not found.');
    }

    $title = 'Edit Badge - GrenovateHub';
    ob_start();
    include 'templates/edit_badge.html.php';
    $output = ob_get_clean();

} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
