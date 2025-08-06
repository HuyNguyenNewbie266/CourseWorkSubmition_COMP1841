<?php 
require "login/check.php"; 
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

if (isset($_POST['title'])) {
    try {
        $moduleId = $_POST['module_id'] === 'null' ? null : $_POST['module_id'];
        
        $authorID = $_SESSION['user_id'];
       
        include 'upload/upload.php'; // Handle image upload, sets $imagePath
        
        $text = $_POST['content'] . "\n\n" . $_POST['what_tried'];

        insertPost($pdo, $_POST['title'], $text, $authorID, $imagePath, $moduleId);

        header('Location: show_questions.php');
        exit;

    } catch (Exception $e) {
        $title = 'An error has occurred';
        $output = 'General error: ' . $e->getMessage();
        include 'templates/layout.html.php';
        exit;
    }
} else {
    $title = 'Ask a Question - GrenovateHub';
    $modules = getAllModules($pdo); // Re-using existing function

    ob_start();
    include 'templates/add_Post.html.php';
    $output = ob_get_clean();
}
include_once 'notify.php';
include 'templates/layout.html.php';
?>
