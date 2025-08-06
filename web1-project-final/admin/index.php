<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$title = 'Admin Dashboard - Totals';

try {
    $tables = ['Badges', 'Users', 'Posts', 'Modules', 'Roles'];
    $counts = [];

    foreach ($tables as $table) {
        $counts[$table] = getTableCount($pdo, $table);
    }

    ob_start();
    include 'templates/home.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
