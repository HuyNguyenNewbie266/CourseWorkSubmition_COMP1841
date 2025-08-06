<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$error = '';
try {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception('No module ID provided.');
    }
    $moduleID = $_GET['id'];

    if (isset($_POST['submit'])) {
        $moduleName = trim($_POST['module_name']);
        $description = trim($_POST['description']);
        if (empty($moduleName)) {
            $error = 'Module name is required.';
        } else {
            updateModule($pdo, $moduleID, $moduleName, $description);
            header('Location: show_modules.php');
            exit;
        }
    }

    $module = getModuleForEdit($pdo, $moduleID);
    if (!$module) {
        throw new Exception('Module not found.');
    }

    $title = 'Edit Module - GrenovateHub';
    ob_start();
    include 'templates/edit_module.html.php';
    $output = ob_get_clean();

} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
