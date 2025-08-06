<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

try {
    if (!isset($_POST['id'])) {
        throw new Exception('Missing module ID.');
    }
    $id = $_POST['id'];

    deleteModule($pdo, $id);

    header("Location: show_modules.php");
    exit;
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete module: ' . $e->getMessage();
    include 'templates/layout.html.php';
    exit;
}
?>
