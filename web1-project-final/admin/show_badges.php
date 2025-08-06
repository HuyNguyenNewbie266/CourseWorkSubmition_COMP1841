<?php
require "../login/check.php";
include_once '../includes/DatabaseConnection.php';
include_once '../includes/DatabaseFunction.php';

$title = 'Badges - GrenovateHub';

try {
    $perPage = 10;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;

    // Count total badges
    $totalBadges = getTableCount($pdo, 'Badges');
    $totalPages = ceil($totalBadges / $perPage);

    // Fetch paginated badges
    $badges = fetchAll($pdo, 'SELECT ID AS id, BadgeName AS name, Description AS description FROM badges ORDER BY ID ASC LIMIT :limit OFFSET :offset', [':limit' => $perPage, ':offset' => $offset]);

    ob_start();
    include 'templates/show_badges.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>
