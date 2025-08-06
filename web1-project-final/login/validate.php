<?php
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $user = getUserByEmailForLogin($pdo, $email);
        
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['Authorised'] = 'Y';
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'] ?? 'User'; 
            
            if ($user['role'] == 'Admin') {
                header('Location: ../admin/index.php');
            } else {
                header('Location: ../index.php');
            }
            exit();
        } else {
            header("Location: ../login/wrongpassword.php");
            exit();
        }
    } catch (PDOException $e) {
        // In a production environment, you would log this error instead of echoing it.
        $title = 'Login Error';
        $output = 'Database error during login. Please try again later.';
        include '../templates/layout.html.php';
        exit();
    }
}
?>
