<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrenovateHub Login</title>
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
            background-image: url('../images/illustration.jpg');
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
        <h2 class="fw-bold">Welcome Back</h2>
        <p class="text-muted">Sign in to continue to GrenovateHub</p>
      </div>

      <form method="post" action="../login/validate.php">
    <!-- show wrong message if exists  -->
      <?php if (isset($wrong)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $wrong; ?>
            </div>
        <?php endif; ?>
      

        <div class="input-group mb-3">
          <span class="input-group-text bg-transparent border-end-0">
            <i class="bi bi-envelope"></i>
          </span>
          <input  type="email" name="email" class="form-control border-start-0 ps-2" placeholder="Enter your email"  required>
        </div>
        <div class="input-group mb-4">
          <span class="input-group-text bg-transparent border-end-0">
            <i class="bi bi-lock"></i>
          </span>
          
          <input type="password" name="password" id="password" class="form-control border-start-0 border-end-0 ps-2" placeholder="Enter password" required>
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-4 rounded-pill">Get Started</button>
      </form>
      <p class="text-center">Don't have an account? <a href="../registration/register.html.php">Register</a></p>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // JavaScript to toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = togglePassword.querySelector('i');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        eyeIcon.classList.toggle('bi-eye-slash');
    });
</script>
</body>
</html>
