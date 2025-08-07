<div class="container mt-4" >
    <!-- Main Content -->
    <div class="col-lg-10 mx-auto py-4 px-5">
        <h2 class="h3 font-weight-bold mb-2">Ask a public question</h2>
        <p class="text-muted mb-4">Get help from peers in your course</p>

        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4" id="question-form">
            <!-- Guidelines Card -->
            <div class="card bg-info bg-opacity-10 border-info">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold text-info">Writing a good question</h3>
                </div>
                <div class="card-body text-sm">
                    <p class="mb-3">
                        You're ready to <span class="font-weight-bold text-primary">ask a course-related question</span> and this form will help guide you through the process.
                    </p>
                    <p class="mb-4">
                        Looking to ask a non-course question? Contact your instructor or check the help section.
                    </p>
                    <div>
                        <p class="font-weight-bold mb-2">Steps:</p>
                        <ul class="list-disc pl-4 space-y-1 text-muted">
                            <li>Summarize your problem in a one-line title.</li>
                            <li>Describe your problem in more detail.</li>
                            <li>Describe what you tried and what you expected to happen.</li>
                            <li>Add "module" to categorize your question.</li>
                            <li>Review your question and post it to the site.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            
            <!-- Title Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Title</h3>
                    <p class="text-muted small">
                        Be specific and imagine you're asking a question to another person.
                    </p>
                </div>
                <div class="card-body">
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="form-control"
                        placeholder="e.g. How to use PDO in PHP for secure database connections?"
                        required
                        minlength="10"
                        maxlength="255"
                    >
                </div>
            </div>
            <br>
            <!-- Problem Details Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">What are the details of your problem?</h3>
                    <p class="text-muted small">
                        Introduce the problem and expand on what you put in the title. Minimum 20 characters.
                    </p>
                </div>
                <div class="card-body">
                    <textarea
                        name="content"
                        id="content"
                        class="form-control"
                        rows="6"
                        placeholder="Describe your problem in detail..."
                        required
                        minlength="20"
                    ></textarea>
                </div>
            </div>
            <br>
            <!-- What Tried Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">What did you try and what were you expecting?</h3>
                    <p class="text-muted small">
                        Describe what you tried, what you expected to happen, and what actually resulted. Minimum 20 characters.
                    </p>
                </div>
                <div class="card-body">
                    <textarea
                        name="what_tried"
                        id="what_tried"
                        class="form-control"
                        rows="6"
                        placeholder="Describe what you tried and what you expected..."
                        required
                        minlength="20"
                    ></textarea>
                </div>
            </div>
            <br>
            <!-- Module Selection -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Module</h3>
                    <p class="text-muted small">
                        Select the course module related to your question (optional).
                    </p>
                </div>
                <div class="card-body">
                    <select name="module_id" class="form-control">
                        <option value="null">Select Module (Optional)</option>
                        <?php foreach ($modules as $module): ?>
                            <option value="<?php echo $module['id']; ?>">
                                <?php echo htmlspecialchars($module['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br>
            <!-- Image Upload (Optional) -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Image (Optional)</h3>
                    <p class="text-muted small">
                        Upload an image or screenshot related to your question.
                    </p>
                </div>
                <div class="card-body">
                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept="image/jpeg, image/png, image/gif"
                    >
                </div>
            </div>
            <br>
            <!-- Submit Button -->
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-primary px-4 py-2" aria-label="Post your question" name="submit">Post your question</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('question-form').addEventListener('submit', function(event) {
    const title = document.getElementById('title').value.trim();
    const content = document.getElementById('content').value.trim();
    const whatTried = document.getElementById('what_tried').value.trim();
    if (title.length < 10) {
        event.preventDefault();
        alert('Title must be at least 10 characters long.');
        return;
    }
    if (content.length < 20) {
        event.preventDefault();
        alert('Problem details must be at least 20 characters long.');
        return;
    }
    if (whatTried.length < 20) {
        event.preventDefault();
        alert('What you tried must be at least 20 characters long.');
        return;
    }
});

</script>
