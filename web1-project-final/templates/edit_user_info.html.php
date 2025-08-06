<div class="container mt-4" style="max-width: 1000px;">
    <div class="col-lg-10 mx-auto py-4 px-5">
        <h2 class="h3 font-weight-bold mb-2">Edit Your Profile</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4" id="edit-user-form">
            <!-- Name -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Name</h3>
                </div>
                <div class="card-body">
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($user['Name'] ?? ''); ?>" maxlength="100">
                </div>
            </div>
            <br>
            <!-- Password -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Password</h3>
                    <p class="text-muted small">Leave blank to keep current password</p>
                </div>
                <div class="card-body">
                    <input type="password" name="password" id="password" class="form-control" minlength="8">
                </div>
            </div>
            <br>
            <!-- About -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">About</h3>
                </div>
                <div class="card-body">
                    <textarea name="about" id="about" class="form-control" rows="6"><?php echo htmlspecialchars($user['About'] ?? ''); ?></textarea>
                </div>
            </div>
            <br>
            <!-- Profile Picture -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Profile Picture</h3>
                    <p class="text-muted small">Current image: <?php echo $user['ProfilePicture'] ? htmlspecialchars($user['ProfilePicture']) : 'None'; ?></p>
                </div>
                <div class="card-body">
                    <?php if ($user['ProfilePicture']): ?>
                        <img src="upload/uploads/<?php echo htmlspecialchars($user['ProfilePicture']); ?>" alt="Current Profile Picture" style="max-width: 200px; margin-bottom: 10px;">
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control" accept="image/jpeg, image/png, image/gif">
                </div>
            </div>
            <br>
            <!-- Submit Button -->
            <div class="d-flex justify-content-start">
                <button type="submit" name="submit" class="btn btn-primary px-4 py-2">Update Profile</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('edit-user-form').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value.trim();
    if (password && password.length < 8) {
        event.preventDefault();
        alert('Password must be at least 8 characters long if provided.');
        return;
    }
});
</script>
