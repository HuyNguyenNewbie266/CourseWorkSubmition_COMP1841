<div class="container mt-4" style="max-width: 1000px;">
    <div class="col-lg-10 mx-auto py-4 px-5">
        <h2 class="h3 font-weight-bold mb-2">Edit your answer</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4" id="edit-answer-form">
            <!-- Content -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Content</h3>
                </div>
                <div class="card-body">
                    <textarea name="content" id="content" class="form-control" rows="6" required minlength="20"><?php echo htmlspecialchars($answer['Content']); ?></textarea>
                </div>
            </div>
            <br>
            <!-- Image -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Image</h3>
                    <?php if ($answer['Image']): ?>
                        <p class="text-muted small">Current image: <?php echo htmlspecialchars($answer['Image']); ?></p>
                    <?php else: ?>
                        <p class="text-muted small">No image uploaded.</p>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if ($answer['Image']): ?>
                        <img src="upload/uploads/<?php echo htmlspecialchars($answer['Image']); ?>" alt="Current Image" style="max-width: 200px; margin-bottom: 10px;">
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control" accept="image/jpeg, image/png, image/gif">
                </div>
            </div>
            <br>
            <!-- Submit Button -->
            <div class="d-flex justify-content-start">
                <button type="submit" name="submit" class="btn btn-primary px-4 py-2">Update Answer</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('edit-answer-form').addEventListener('submit', function(event) {
    const content = document.getElementById('content').value.trim();
    if (content.length < 20) {
        event.preventDefault();
        alert('Content must be at least 20 characters long.');
    }
});
</script>
