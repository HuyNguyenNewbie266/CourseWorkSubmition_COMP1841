<?php
require "login/check.php";
include_once 'includes/DatabaseConnection.php';
include_once 'includes/DatabaseFunction.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message_id'])) {
        $message_id = $_POST['message_id'];
        $person_id = $_POST['person_id'];

     
        deleteChatMessage($pdo, $message_id);

        header("Location: chat.php?id=$person_id");
        exit;
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Unable to delete message: ' . $e->getMessage();
    include 'templates/layout.html.php';
    exit;
}
?>
