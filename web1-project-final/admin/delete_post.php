<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

try {
    if (!isset($_POST['id'])) {
        throw new Exception('Missing post ID.');
    }
    $id = $_POST['id'];

    $post = getPostImage($pdo, $id);
    if ($post && !empty($post['Image'])) {
        $imagePath = '../upload/uploads/' . $post['Image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    deletePost($pdo, $id);

    header("Location: show_posts.php");
    exit;
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete post: ' . $e->getMessage();
    include 'templates/layout.html.php';
    exit;
}
?>
