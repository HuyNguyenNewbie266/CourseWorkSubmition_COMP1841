<?php
// Get current theme from cookie, default to 'light'
$current_theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';

// Toggle theme
$new_theme = $current_theme === 'light' ? 'dark' : 'light';

// Set cookie to persist theme for 30 days
setcookie('theme', $new_theme, time() + (30 * 24 * 60 * 60), '/');

// Redirect back to the previous page or index.php
$referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $referer");
exit;
?>