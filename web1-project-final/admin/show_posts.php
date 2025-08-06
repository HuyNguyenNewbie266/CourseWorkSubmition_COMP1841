<?php 
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$title = 'Questions - GrenovateHub';

try {
    $perPage = 25;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;

    // Reusing existing functions
    $questions = getPaginatedQuestions($pdo, $perPage, $offset);
    $totalQuestions = countAllPosts($pdo);
    $totalPages = ceil($totalQuestions / $perPage);

    ob_start();
    include 'templates/show_posts.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>
