<?php
require "login/check.php";
$title = 'GrenovateHub';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';

try {
    $admin_questions = getAdminQuestions($pdo, 3);
    $questions = getRecentQuestions($pdo, 25);

    ob_start();
    include 'templates/home.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = "Database error: " . $e->getMessage();
}
include 'notify.php';
include 'templates/layout.html.php';
?>
