<?php 
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$title = 'Users - GrenovateHub';

try {
    $perPage = 8; 
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;

    // Reusing existing functions
    $users = getPaginatedUsers($pdo, $perPage, $offset);
    $totalUsers = countAllUsers($pdo);
    $totalPages = ceil($totalUsers / $perPage);

    ob_start();
    include 'templates/show_users.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>
