<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

try {
    if (!isset($_POST['id'])) {
        throw new Exception('Missing user ID.');
    }
    $id = $_POST['id'];

    // This function handles deleting the user and their associated images
    deleteUserAndContent($pdo, $id);

    header("Location: show_users.php");
    exit;
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete user: ' . $e->getMessage();
    include 'templates/layout.html.php';
    exit;
}
?>
