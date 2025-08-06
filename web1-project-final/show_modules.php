<?php
require "login/check.php";
$title = 'Modules - GrenovateHub';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';

try {
    // Fetch all modules with post and answer counts
    $modules = getAllModulesWithStats($pdo);

    ob_start();
    include 'templates/show_modules.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'notify.php';
include 'templates/layout.html.php';
?>
