<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.png" type="image/png">

    <title>
      Welcome to GrenovateHub
    </title>
</head>

<body data-bs-theme="<?php echo  $_COOKIE['theme']??  'light'; ?>">
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="../templates/welcome.html.php">GrenovateHub</a>
        
           
                
            <a href="../toggle_theme.php"class="btn btn-outline-light" id="themeToggle">
        <i class="bi bi-moon-stars"></i>
            </a>
                </div>
            </div>
        </div>
    </nav>


    <section class="hero" style="margin-top: 56px;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold">Welcome to GrenovateHub</h1>
                    <p class="lead">Transform your ideas into reality with our innovative solutions</p>
                    <a href="../index.php" class="btn btn-primary btn-lg">Get Started</a>
                </div>
               
                



                <div class="col-lg-6 position-relative">
                  <br>
                  <br>
    <!-- Video -->
    <video id="welcomeVideo" class="w-100 rounded-4 shadow" autoplay muted loop playsinline style="transform: scale(1.1); transform-origin: center;">
        <source src="../videos/welcome.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Sound Toggle Button -->
    <button id="soundBtn" onclick="toggleSound()" class="btn btn-sm btn-light position-absolute bottom-0 end-0 m-2 shadow-sm">
        <i id="soundIcon" class="bi bi-volume-mute"></i>
    </button>
</div>


            </div>
        </div>
    </section>

    <section class="features py-5"  style="min-height: 56.15vh;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <svg width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2L1 21h22L12 2zm0 3.45l8.4 14.55H3.6L12 5.45z"/></svg>
                            </div>
                            <h3>Innovation</h3>
                            <p>Cutting-edge solutions for modern challenges</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <svg width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                            </div>
                            <h3>Excellence</h3>
                            <p>Committed to delivering quality results</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <svg width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                            </div>
                            <h3>Community</h3>
                            <p>Building strong relationships that last</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer mt-5 py-4 bg-primary text-white">
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
    <script>
 
function toggleSound() {
    const video = document.getElementById('welcomeVideo');
    const icon = document.getElementById('soundIcon');

    if (video.muted) {
        video.muted = false;
        icon.classList.remove('bi-volume-mute');
        icon.classList.add('bi-volume-up');
    } else {
        video.muted = true;
        icon.classList.remove('bi-volume-up');
        icon.classList.add('bi-volume-mute');
    }
}


    </script>
</body>
</html>