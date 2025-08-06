<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

try {
    if (!isset($_POST['id'])) {
        throw new Exception('Missing badge ID.');
    }
    $id = $_POST['id'];

    deleteBadge($pdo, $id);

    header("Location: show_badges.php");
    exit;
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete badge: ' . $e->getMessage();
    include 'templates/layout.html.php';
    exit;
}
?>
