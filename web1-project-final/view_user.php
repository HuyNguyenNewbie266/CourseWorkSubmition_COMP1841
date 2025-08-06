<?php
require "login/check.php";
$title = 'User Profile - GrenovateHub';
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$userID = $_GET['id'];

// Fetch user details, badges, posts, and answers
$user = getUserDetails($pdo, $userID);

if (!$user) {
    $title = 'User Not Found';
    $output = 'The requested user does not exist.';
    include 'templates/layout.html.php';
    exit;
}

$badges = getEarnedUserBadges($pdo, $userID);
$posts = getUserPosts($pdo, $userID);
$answers = getUserAnswers($pdo, $userID);

$title = 'Profile of ' . htmlspecialchars($user['Username']) . ' - GrenovateHub';
ob_start();
include 'templates/view_user.html.php';
$output = ob_get_clean();
include_once 'notify.php';
include 'templates/layout.html.php';
?>
