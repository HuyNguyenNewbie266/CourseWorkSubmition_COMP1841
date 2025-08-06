<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Course Modules</h2>
                <a href="add_module.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Add Module
                </a>
            </div>
            <p>Explore the modules available in your course.</p>
        </div>
    </div>

    <?php foreach ($modules as $module): ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card h-100" style="border: 1px solid var(--border); border-radius: var(--radius); transition: transform 0.2s;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="flex-1">
                                <h5 class="card-title" style="font-size: 1.125rem; font-weight: 600; color: var(--card-foreground); margin-bottom: 0.5rem;">
                                    <?php echo htmlspecialchars($module['name']); ?>
                                </h5>
                                <p class="card-text mb-3" style="color: var(--foreground); opacity: 0.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?php echo htmlspecialchars($module['description'] ?? 'Description of the module goes here.'); ?>
                                </p>
                                <div class="d-flex align-items-center text-muted fs-body2" style="font-size: 0.875rem;">
                                    <span class="me-3">Questions Asked: <span class="font-weight-bold badge bg-primary"><?php echo htmlspecialchars($module['questions_asked'] ?? '0'); ?></span></span>
                                    <span>Questions Answered: <span class="font-weight-bold badge bg-primary"><?php echo htmlspecialchars($module['questions_answered'] ?? '0'); ?></span></span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0">
                                <div style="width: 80px; height: 80px; background: var(--accent); border-radius: var(--radius); display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book" style="color: var(--foreground); opacity: 0.5;">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <form action="edit_module.php" method="GET" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($module['id']); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Edit module">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                    </svg>
                                </button>
                            </form>
                            <form action="delete_module.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($module['id']); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Delete module">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2">
                                        <path d="M3 6h18"></path>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                        <line x1="10" x2="10" y1="11" y2="17"></line>
                                        <line x1="14" x2="14" y1="11" y2="17"></line>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
