<?php
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $errors = [];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }
    if (!preg_match('/^[A-Za-z0-9._%+-]+@fpt\.edu\.vn$/', $email)) {
        $errors[] = 'Email must be an @fpt.edu.vn address.';
    }
    if (checkUsernameExists($pdo, $username)) {
        $errors[] = 'Username already exists.';
    }
    if (checkEmailExists($pdo, $email)) {
        $errors[] = 'Email already exists.';
    }
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }
    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }

    if ($errors) {
        session_start();
        $_SESSION['errors'] = $errors;
        header('Location: register.html.php');
        exit();
    }

    try {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user_id = registerUser($pdo, $username, $hashed_password, $email);

        session_start();
        $_SESSION['Authorised'] = 'Y';
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'User'; // Default role upon registration

        header('Location: ../index.php');
        exit();
    } catch (PDOException $e) {
        $errors[] = 'Registration failed. Please try again later.';
        session_start();
        $_SESSION['errors'] = $errors;
        header('Location: register.html.php');
        exit();
    }
}
?>
