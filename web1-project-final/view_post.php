<?php
require "login/check.php";
$title = 'View Post - GrenovateHub';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';

if (!isset($_GET['id'])) {
    throw new Exception('No post ID provided.');
}
$postID = $_GET['id'];

// Fetch post details
$post = getPostDetails($pdo, $postID);

if (!$post) {
    $title = 'Post Not Found';
    $output = 'The requested post does not exist.';
    include 'templates/layout.html.php';
    exit;
}

// Fetch vote counts
$upVotes = getPostVoteCount($pdo, $postID, 'up');
$downVotes = getPostVoteCount($pdo, $postID, 'down');

// Fetch user's vote
$userVote = null;
if (isset($_SESSION['user_id'])) {
    $userVote = getUserVoteForPost($pdo, $postID, $_SESSION['user_id']);
}

// Fetch answers
$answers = getAnswersForPost($pdo, $postID);

// Handle accepting an answer
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accept_answer']) && isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['AuthorID']) {
    $answerID = $_POST['answer_id'];
    acceptAnswer($pdo, $answerID, $postID);
    header("Location: view_post.php?id=$postID");
    exit;
}

// Handle unaccepting an answer
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['unaccept_answer']) && isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['AuthorID']) {
    $answerID = $_POST['answer_id'];
    unacceptAnswer($pdo, $answerID);
    header("Location: view_post.php?id=$postID");
    exit;
}

// Handle voting
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vote']) && isset($_SESSION['user_id'])) {
    $voteType = $_POST['vote'];
    $voteTypeID = getVoteTypeId($pdo, $voteType);

    if ($voteTypeID) {
        if ($userVote) {
            updateVote($pdo, $voteTypeID, $postID, $_SESSION['user_id']);
        } else {
            insertVote($pdo, $voteTypeID, $postID, $_SESSION['user_id']);
        }
    }
    header("Location: view_post.php?id=$postID");
    exit;
}

// Handle answer submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer']) && isset($_SESSION['user_id'])) {
    $answerContent = $_POST['answer'];
    $imagePath = null;
    include 'upload/upload.php'; // This script should set $imagePath if an image is uploaded
    
    insertAnswer($pdo, $postID, $_SESSION['user_id'], $answerContent, $imagePath);

    // Create notification for the post author
    if ($post['AuthorID'] != $_SESSION['user_id']) {
        $notifiedUser = $post['AuthorID'];
        $notificationType = 'post';
        $relatedentityID = $postID;
        include 'notify.php';
    }

    header("Location: view_post.php?id=$postID");
    exit;
}

ob_start();
include 'templates/view_post.html.php';
$output = ob_get_clean();
include 'notify.php';
include 'templates/layout.html.php';
?>
