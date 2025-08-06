<?php 
require "login/check.php"; 
$title = 'Questions - GrenovateHub';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';

try {
    $perPage = 25;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;

    // Fetch paginated questions
    $questions = getPaginatedQuestions($pdo, $perPage, $offset);

    // Count total questions for pagination
    $totalQuestions = countAllPosts($pdo);
    $totalPages = ceil($totalQuestions / $perPage);

    ob_start();
    // Send to HTML
    include 'templates/show_questions.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'notify.php';
include 'templates/layout.html.php';
?>
