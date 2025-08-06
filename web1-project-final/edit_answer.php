<?php
require "login/check.php";
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

try {
    if (!isset($_GET['id'])) {
        throw new Exception('No answer ID provided.');
    }
    $answerID = $_GET['id'];

    // Fetch the answer from the database
    $answer = getAnswerForEdit($pdo, $answerID);

    if (!$answer) {
        throw new Exception('Answer not found.');
    }

    // Ensure the logged-in user is the author
    if ($answer['AuthorID'] != $_SESSION['user_id']) {
        throw new Exception('You are not authorized to edit this answer.');
    }

    // Handle form submission
    if (isset($_POST['submit'])) {
        $currentImage = $answer['Image'];
        
        include 'upload/upload.php'; 
        $imagePath= $imagePath ?? $currentImage; // Ensure $imagePath is set
        // If a new image was uploaded, the upload script sets $imagePath.
        // If it's different from the current one, delete the old image.
        if ($imagePath !== $currentImage && $currentImage && file_exists('upload/uploads/' . $currentImage)) {
            unlink('upload/uploads/' . $currentImage);
        }

        // Update the answer in the database
        updateAnswer($pdo, $answerID, $_POST['content'], $imagePath);

        header('Location: view_post.php?id=' . $answer['PostID']);
        exit;
    } else {
        // Display the edit form
        $title = 'Edit Answer - GrenovateHub';
        ob_start();
        include 'templates/edit_answer.html.php';
        $output = ob_get_clean();
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include_once 'notify.php';
include 'templates/layout.html.php';
?>
