<?php 
require "login/check.php"; 
$title = 'Search Results - GrenovateHub';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';

try {
    $perPage = 25;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;
    $searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
    $moduleFilter = isset($_GET['module']) ? trim($_GET['module']) : '';
    $userFilter = isset($_GET['user']) ? trim($_GET['user']) : '';

    // Fetch search results
    $questions = searchPosts($pdo, $searchQuery, $moduleFilter, $userFilter, $perPage, $offset);

    // Count total results for pagination
    $totalQuestions = countSearchedPosts($pdo, $searchQuery, $moduleFilter, $userFilter);
    $totalPages = ceil($totalQuestions / $perPage);

    // Fetch modules and users for filter dropdowns
    $modules = getAllModulesForFilter($pdo);
    $users = getAllUsersForFilter($pdo);

    ob_start();
    include 'templates/search.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'notify.php';
include 'templates/layout.html.php';
?>
