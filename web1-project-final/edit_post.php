<?php
require "login/check.php";
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

try {
    if (!isset($_GET['id'])) {
        throw new Exception('No post ID provided.');
    }
    $postID = $_GET['id'];

    // Fetch the post from the database
    $post = getPostForEdit($pdo, $postID);

    if (!$post) {
        throw new Exception('Post not found.');
    }
    // Authorization: Ensure the logged-in user is the post's author
    if ($post['AuthorID'] != $_SESSION['user_id']) {
        throw new Exception('You are not authorized to edit this post.');
    }

    // Handle form submission
    if (isset($_POST['submit'])) {
        $currentImage = $post['Image'];
    
        include 'upload/upload.php'; 
        $imagePath= $imagePath ?? $currentImage; // Ensure $imagePath is set

        if ($imagePath !== $currentImage && $currentImage && file_exists('upload/uploads/' . $currentImage)) {
            unlink('upload/uploads/' . $currentImage);
        }
        
        $moduleId = $_POST['module_id'] === 'null' ? null : $_POST['module_id'];

        // Update the post in the database
        updatePost($pdo, $postID, $_POST['title'], $_POST['content'], $imagePath, $moduleId);

        header('Location: view_post.php?id=' . $postID);
        exit;
    } else {
        // Fetch all modules for the dropdown
        $modules = getAllModules($pdo);

        $title = 'Edit Post - GrenovateHub';
        ob_start();
        include 'templates/edit_post.html.php';
        $output = ob_get_clean();
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include_once 'notify.php';
include 'templates/layout.html.php';
?>
