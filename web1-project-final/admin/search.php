<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$title = 'Admin Search - GrenovateHub';

try {
    $perPage = 10;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;
    $searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

    $entityTypes = ['modules', 'badges', 'users', 'questions'];
    $entityType = isset($_GET['type']) && in_array($_GET['type'], $entityTypes) ? trim($_GET['type']) : 'questions';

    // Fetch search results
    $results = searchAdminEntities($pdo, $entityType, $searchQuery, $perPage, $offset);
    
    // Count total results for pagination
    $totalResults = countAdminSearchedEntities($pdo, $entityType, $searchQuery);
    $totalPages = ceil($totalResults / $perPage);

    ob_start();
    include 'templates/search.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
