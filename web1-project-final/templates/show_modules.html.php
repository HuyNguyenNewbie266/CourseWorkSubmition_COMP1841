<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Course Modules</h2>
            <p>Explore the modules available in your course.</p>
        </div>
    </div>
    <div class="grid-container">
        <?php foreach ($modules as $module): ?>
            <div class="card">
                <a href="search.php?q=&module=<?php echo htmlspecialchars($module['name']); ?>&user">          
                    <div class="card-header">
                        <span class="font-weight-bold badge bg-primary"><?php echo htmlspecialchars($module['name']); ?></span>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo htmlspecialchars($module['description'] ?? 'No description available.'); ?></p>
                        <div class="d-flex justify-content-between text-muted fs-body2" style="font-size: 0.875rem;">
                            <span>Questions Asked: <?php echo htmlspecialchars($module['questions_asked']); ?></span>
                            <span>Questions Answered: <?php echo htmlspecialchars($module['questions_answered']); ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>