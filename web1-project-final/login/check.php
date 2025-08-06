<?php
session_start();
if (!isset($_SESSION['Authorised']) || $_SESSION['Authorised'] !== 'Y') {
    header("Location: login/notauthorised.php");
    
}
?>