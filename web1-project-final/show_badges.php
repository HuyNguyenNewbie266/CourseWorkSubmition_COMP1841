<?php
require "login/check.php";
$title = 'Badges - GrenovateHub';
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';

$user_id = $_SESSION['user_id'];

$badges = getUserBadges($pdo, $user_id);

ob_start();
include 'templates/show_badges.html.php';
$output = ob_get_clean();
include 'notify.php';
include 'templates/layout.html.php';
?>
