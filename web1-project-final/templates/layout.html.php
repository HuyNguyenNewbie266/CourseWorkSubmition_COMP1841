<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.png" type="image/png">

    <title><?=$title?></title>
</head>
<body data-bs-theme="<?php echo  $_COOKIE['theme']??  'light'; ?>">
    <nav class="navbar navbar-expand-lg bg-primary" style="position: sticky; top: 0; z-index: 1000;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">GrenovateHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
           <!-- nav bar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link text-white hover-effect active" href="show_questions.php">Questions</a></li>
                    <li class="nav-item"><a class="nav-link text-white hover-effect" href="show_users.php">Users</a></li>
                    <li class="nav-item"><a class="nav-link text-white hover-effect" href="show_modules.php">Modules</a></li>
                    <li class="nav-item"><a class="nav-link text-white hover-effect" href="contact_admin.php">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
    <!-- Search form -->
    <form class="d-flex" action="search.php" method="GET">
        <input class="form-control s-input me-2 hide-on-phone" type="search" name="q" placeholder="Search posts..." aria-label="Search" style="width: 200px;">
        <button class="btn btn-outline-light s-btn" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
    <!-- Notification icon -->
    
        <a href="get_notification.php" class="btn btn-outline-light position-relative" type="button" aria-expanded="false">
            <i class="bi bi-bell"></i>
            <?php if (isset($unread_count) && $unread_count > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationCount"><?= $unread_count ?></span>
            <?php endif; ?>
        </a>

  
    <!-- Profile dropdown -->
    <div class="dropdown">
        <button class="btn btn-outline-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            
            <li><a class="dropdown-item" href="view_user.php?id=<?=$_SESSION['user_id']; ?>"><i class="bi bi-info-circle me-2"></i>Information</a></li>
            <li><a class="dropdown-item" href="show_badges.php"><i class="bi bi-trophy me-2"></i>Achievements</a></li>
            
            <?php if ($_SESSION['role'] == 'Admin'): ?>
            <li><a class="dropdown-item" href="admin/index.php"><i class="bi bi-shield-lock"></i>Admin Page</a></li>
            <?php endif; ?>
          
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="login/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
        </ul>
    </div>
    <!-- Theme toggle -->
    <a href="toggle_theme.php"class="btn btn-outline-light" id="themeToggle" >
        <i class="bi bi-moon-stars"></i>
            </a>
</div>
            </div>
        </div>
    </nav>

    <main style="min-height: 82.95vh; min-width: 100%;">
    <?=$output;?>
    </main>
    
    <footer class="footer mt-5 py-4 bg-primary text-white ">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; Huy Tan Nguyen - 001419305. All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline mb-0 text-end">
                        <li class="list-inline-item"><a href="https://www.facebook.com/nguyen.tan.huy.259851" class="text-white text-decoration-none hover-effect">Contact Me</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>