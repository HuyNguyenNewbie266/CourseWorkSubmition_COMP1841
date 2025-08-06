<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

try {
    if (!isset($_GET['id'])) {
        throw new Exception('No post ID provided.');
    }
    $postID = $_GET['id'];

    $post = getPostForEdit($pdo, $postID);
    if (!$post) {
        throw new Exception('Post not found.');
    }

    if (isset($_POST['submit'])) {
        $currentImage = $post['Image'];
        

        $for_admin = true;
        include '../upload/upload.php';
        $for_admin = false;
        $imagePath = $imagePath ?? $currentImage;
        if ($imagePath !== $currentImage && $currentImage && file_exists('../upload/uploads/' . $currentImage)) {
            unlink('../upload/uploads/' . $currentImage);
        }
        
        $moduleId = $_POST['module_id'] === 'null' ? null : $_POST['module_id'];

        updatePost($pdo, $postID, $_POST['title'], $_POST['content'], $imagePath, $moduleId);

        header('Location: show_posts.php');
        exit;
    }

    $modules = getAllModules($pdo);
    $title = 'Edit Post - GrenovateHub';
    ob_start();
    include 'templates/edit_post.html.php';
    $output = ob_get_clean();

} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>
