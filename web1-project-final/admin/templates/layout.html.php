<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="index_admin.css" rel="stylesheet">
    <link rel="icon" href="../images/favicon.png" type="image/png">
    <title><?=$title?></title>
</head>
<body data-bs-theme="<?php echo $_COOKIE['theme'] ?? 'light'; ?>">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">GrenovateHub Admin</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="show_posts.php"><i class="bi bi-question-circle me-2"></i>Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="show_users.php"><i class="bi bi-people me-2"></i>Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="show_modules.php"><i class="bi bi-book me-2"></i>Modules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="show_contact.php"><i class="bi bi-envelope me-2"></i>Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="show_roles.php"><i class="bi bi-shield-check me-2"></i>Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="show_badges.php"><i class="bi bi-award me-2"></i>Badges</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="giving_user_badge.php"><i class="bi bi-patch-check-fill me-2"></i>Give Badge</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="search.php"><i class="bi bi-search me-2"></i>Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../index.php"><i class="bi bi-person me-2"></i>User Page</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <div class="dropdown ">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>Profile
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item text-danger" href="../login/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>   
                        </ul>
                    </div>
    
                    <a href="../toggle_theme.php" class="btn btn-outline-light ms-2" id="themeToggle">
                        <i class="bi bi-moon-stars"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <?=$output;?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleTheme() {
            const body = document.body;
            const icon = document.querySelector('#themeToggle i');
            if (body.getAttribute('data-bs-theme') === 'light') {
                body.setAttribute('data-bs-theme', 'dark');
                icon.classList.remove('bi-moon-stars');
                icon.classList.add('bi-sun');
            } else {
                body.setAttribute('data-bs-theme', 'light');
                icon.classList.remove('bi-sun');
                icon.classList.add('bi-moon-stars');
            }
        }
    </script>
</body>
</html>