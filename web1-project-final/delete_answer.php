<?php
require "login/check.php";
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

try {
    if (!isset($_POST['id'])) {
        throw new Exception('No answer ID provided.');
    }
    $answerID = $_POST['id'];

    // Fetch the answer details
    $answer = getAnswerDetailsForDeletion($pdo, $answerID);

    if (!$answer) {
        throw new Exception('Answer not found.');
    }

    // Ensure the logged-in user is the author
    if ($answer['AuthorID'] != $_SESSION['user_id']) {
        throw new Exception('You are not authorized to delete this answer.');
    }

    // Delete the image if it exists
    if ($answer['Image'] && file_exists('upload/uploads/' . $answer['Image'])) {
        unlink('upload/uploads/' . $answer['Image']);
    }

    // Delete the answer from the database
    deleteAnswer($pdo, $answerID);

    // Redirect to the post view page
    header('Location: view_post.php?id=' . $answer['PostID']);
    exit;
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
    include 'templates/layout.html.php';
}
?>
