<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrenovateHub Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="icon" href="../images/favicon.png" type="image/png">
    <style>
        /* Style for the blurred background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../images/illustration.jpg'); /* Your uploaded image */
            background-size: cover;
            background-position: center;
            filter: blur(5px);
            z-index: -1;
        }
     
    </style>
</head>
<body>
    <div class="container-fluid login-container vh-100 d-flex align-items-center justify-content-center">
        <div class="card p-4 shadow-lg">
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="../images/favicon.png" alt="GrenovateHub Logo" class="logo mb-3" width="80">
                    <h2 class="fw-bold">Create an Account</h2>
                    <p class="text-muted">Join GrenovateHub today</p>
                </div>
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <p class="mb-0"><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>
                <form method="post" action="validate.php">
                    <!--username  -->
                <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                    </div>
                    <!-- email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your FPT email" required>
                    </div>
                    <!-- Password-->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Confirm Password  -->
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password" required>
                             <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-4 rounded-pill">Register</button>
                </form>
                <p class="text-center">Already have an account? <a href="../login/login.html.php">Log in</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       
        function createPasswordToggler(toggleId, passwordId) {
            const toggleButton = document.querySelector(toggleId);
            const passwordInput = document.querySelector(passwordId);
            const eyeIcon = toggleButton.querySelector('i');

            toggleButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('bi-eye-slash');
            });
        }

        // Apply the toggler to both password fields
        createPasswordToggler('#togglePassword', '#password');
        createPasswordToggler('#toggleConfirmPassword', '#confirm_password');
    </script>
</body>
</html>
