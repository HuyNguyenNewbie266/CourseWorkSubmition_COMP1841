<?php
require "login/check.php";
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

try {
    // Fetch the user's current information first
    $user = getUserInfoForEdit($pdo, $_SESSION['user_id']);

    // Handle form submission
    if (isset($_POST['submit'])) {
        $currentImage = $user['ProfilePicture'];
        
        
        include 'upload/upload.php'; // This script may set a new $imagePath
        $imagePath = $imagePath ?? $currentImage;
        if ($imagePath !== $currentImage && $currentImage && file_exists('upload/uploads/' . $currentImage)) {
            unlink('upload/uploads/' . $currentImage);
        }

        $params = [
            'name' => trim($_POST['name']),
            'about' => trim($_POST['about']),
            'password' => $_POST['password'],
            'imagePath' => $imagePath
        ];

        updateUserInfo($pdo, $_SESSION['user_id'], $params);

        header('Location: view_user.php?id=' . $_SESSION['user_id']);
        exit;
    }
    
    $title = 'Edit Profile - GrenovateHub';
    ob_start();
    include 'templates/edit_user_info.html.php';
    $output = ob_get_clean();

} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include_once 'notify.php';
include 'templates/layout.html.php';
?>
