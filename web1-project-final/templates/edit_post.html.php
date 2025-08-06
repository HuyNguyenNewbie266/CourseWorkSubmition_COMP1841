<div class="container mt-4" style="max-width: 1000px;">
    <div class="col-lg-10 mx-auto py-4 px-5">
        <h2 class="h3 font-weight-bold mb-2">Edit your post</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4" id="edit-post-form">
            <!-- Title -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Title</h3>
                </div>
                <div class="card-body">
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($post['Title']); ?>" required minlength="10" maxlength="255">
                </div>
            </div>
            <br>
            <!-- Content -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Content</h3>
                </div>
                <div class="card-body">
                    <textarea name="content" id="content" class="form-control" rows="6" required minlength="20"><?php echo htmlspecialchars($post['Content']); ?></textarea>
                </div>
            </div>
            <br>
            <!-- Module -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Module</h3>
                </div>
                <div class="card-body">
                    <select name="module_id" class="form-control">
                        <option value="null">Select Module (Optional)</option>
                        <?php foreach ($modules as $module): ?>
                            <option value="<?php echo $module['id']; ?>" <?php echo $module['id'] == $post['ModuleID'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($module['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br>
            <!-- Image -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Image</h3>
                    <p class="text-muted small">Current image: <?php echo $post['Image'] ? htmlspecialchars($post['Image']) : 'None'; ?></p>
                </div>
                <div class="card-body">
                    <?php if ($post['Image']): ?>
                        <img src="upload/uploads/<?php echo htmlspecialchars($post['Image']); ?>" alt="Current Image" style="max-width: 200px; margin-bottom: 10px;">
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control" accept="image/jpeg, image/png, image/gif">
                </div>
            </div>
            <br>
            <!-- Submit Button -->
            <div class="d-flex justify-content-start">
                <button type="submit" name="submit" class="btn btn-primary px-4 py-2">Update Post</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('edit-post-form').addEventListener('submit', function(event) {
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();
    if (title.length < 10) {
        event.preventDefault();
        alert('Title must be at least 10 characters long.');
        return;
    }
    if (content.length < 20) {
        event.preventDefault();
        alert('Content must be at least 20 characters long.');
        return;
    }
});
</script>
