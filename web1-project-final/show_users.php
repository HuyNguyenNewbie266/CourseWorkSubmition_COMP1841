<?php 
require "login/check.php"; 
$title = 'Users - GrenovateHub';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';

try {
    // Pagination settings
    $perPage = 10; 
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;

    // Fetch paginated users
    $users = getPaginatedUsers($pdo, $perPage, $offset);

    // Count total users for pagination
    $totalUsers = countAllUsers($pdo);
    $totalPages = ceil($totalUsers / $perPage);

    // Render the template
    ob_start();
    include 'templates/show_users.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'notify.php';
include 'templates/layout.html.php';
?>
