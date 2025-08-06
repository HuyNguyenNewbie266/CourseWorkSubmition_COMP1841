<div class="container mt-4" style="max-width: 1000px;">
    <div class="col-lg-10 mx-auto py-4 px-5">
        <h2 class="h3 fw-bold mb-2">Edit Module</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="" method="POST" class="space-y-4">
            <!-- Module Name -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 fw-bold">Module Name</h3>
                </div>
                <div class="card-body">
                    <input type="text" name="module_name" id="module_name" class="form-control" required maxlength="50" value="<?php echo htmlspecialchars($module['ModuleName']); ?>">
                </div>
            </div>
            <br>
            <!-- Description -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 fw-bold">Description</h3>
                </div>
                <div class="card-body">
                    <textarea name="description" id="description" class="form-control" rows="6"><?php echo htmlspecialchars($module['Description'] ?? ''); ?></textarea>
                </div>
            </div>
            <br>
            <!-- Submit Button -->
            <div class="d-flex justify-content-start">
                <button type="submit" name="submit" class="btn btn-primary px-4 py-2">Update Module</button>
            </div>
        </form>
    </div>
</div>
