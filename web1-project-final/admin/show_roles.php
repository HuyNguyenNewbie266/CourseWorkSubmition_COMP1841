<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$title = 'Roles - GrenovateHub';

try {
    $roles = getAllRoles($pdo);

    ob_start();
    include 'templates/show_roles.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
