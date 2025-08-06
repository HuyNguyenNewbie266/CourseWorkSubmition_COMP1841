<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$title = 'Modules - GrenovateHub';

try {
    // Reusing existing function from previous batch
    $modules = getAllModulesWithStats($pdo);

    ob_start();
    include 'templates/show_modules.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
