<?php
require "../login/check.php"; 
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$title = 'Give Badge to User - GrenovateHub';
$message = '';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['user_id'], $_POST['badge_id'])) {
            $userId = $_POST['user_id'];
            $badgeId = $_POST['badge_id'];

            if (userHasBadge($pdo, $userId, $badgeId)) {
                $message = '<div class="alert alert-warning">This user already has this badge.</div>';
            } else {
                giveUserBadge($pdo, $userId, $badgeId);
                $message = '<div class="alert alert-success">Badge successfully given to the user!</div>';
            }
        } else {
            $message = '<div class="alert alert-danger">Please select a user and a badge.</div>';
        }
    }

    $users = getAllUsersForDropdown($pdo);
    $badges = getAllBadgesForDropdown($pdo);

    ob_start();
    include 'templates/giving_user_badge.html.php';
    $output = ob_get_clean();

} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = '<div class="alert alert-danger">Database error: ' . htmlspecialchars($e->getMessage()) . '</div>';
}

include 'templates/layout.html.php';
?>
