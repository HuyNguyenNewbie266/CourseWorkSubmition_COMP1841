<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$error = '';
if (isset($_POST['submit'])) {
    $moduleName = trim($_POST['module_name']);
    $description = trim($_POST['description']);
    if (empty($moduleName)) {
        $error = 'Module name is required.';
    } else {
        try {
            addModule($pdo, $moduleName, $description);
            header('Location: show_modules.php');
            exit;
        } catch (PDOException $e) {
            $error = 'Error adding module: ' . $e->getMessage();
        }
    }
}

$title = 'Add Module - GrenovateHub';
ob_start();
include 'templates/add_module.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>
