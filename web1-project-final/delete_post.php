<?php
require "login/check.php";
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

try {
    if (isset($_POST['id'])) {
        $postID = $_POST['id'];


        // Fetch the post to get the image path
        $post = getPostImage($pdo, $postID);

        if ($post && !empty($post['Image'])) {
            $imagePath = 'upload/uploads/' . $post['Image'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
        }

        // Delete the post from the database
        deletePost($pdo, $postID);

        header('Location: show_questions.php');
        exit;
    } else {
        throw new Exception('No post ID provided.');
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete post: ' . $e->getMessage();
    include 'templates/layout.html.php';
    exit;
}
?>
