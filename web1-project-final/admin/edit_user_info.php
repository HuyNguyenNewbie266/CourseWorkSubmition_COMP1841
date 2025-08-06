<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

try {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception('Invalid user ID.');
    }
    $user_id = $_GET['id'];
   
    $user = getAdminUserInfoForEdit($pdo, $user_id);

    if (!$user) {
        throw new Exception('User not found.');
    }

    if (isset($_POST['submit'])) {
        $currentImage = $user['ProfilePicture'];
        

        $for_admin = true;
        include '../upload/upload.php'; // This script may set a new $imagePath
        $for_admin = false;
        $imagePath = $imagePath ?? $currentImage;
        if ($imagePath !== $currentImage && $currentImage && file_exists('../upload/uploads/' . $currentImage)) {
            unlink('../upload/uploads/' . $currentImage);
        }

        $params = [
            'name' => trim($_POST['name']),
            'about' => trim($_POST['about']),
            'password' => $_POST['password'],
            'role_id' => $_POST['role_id'] ?? $user['RoleID'],
            'imagePath' => $imagePath
        ];

        updateAdminUserInfoAndRole($pdo, $user_id, $params);

        header('Location: show_users.php');
        exit;
    }

    $roles = getAllRoles($pdo);
    
    $title = 'Edit User Profile - GrenovateHub';
    ob_start();
    include 'templates/edit_user_info.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>
