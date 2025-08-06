<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Admin Search</h2>
            <p>Search across modules, badges, users, and questions for easy management.</p>
            <form action="search.php" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input
                            class="form-control s-input"
                            type="text"
                            name="q"
                            value="<?php echo htmlspecialchars($searchQuery); ?>"
                            placeholder="Search..."
                            aria-label="Search">
                    </div>
                    <div class="col-md-3">
                        <select
                            class="form-select s-input"
                            name="type"
                            id="typeSelect"
                            aria-label="Entity type filter">
                            <option value="modules"   <?php echo $entityType === 'modules'   ? 'selected' : ''; ?>>Modules</option>
                            <option value="badges"    <?php echo $entityType === 'badges'    ? 'selected' : ''; ?>>Badges</option>
                            <option value="users"     <?php echo $entityType === 'users'     ? 'selected' : ''; ?>>Users</option>
                            <option value="questions" <?php echo $entityType === 'questions' ? 'selected' : ''; ?>>Questions</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary s-btn w-100" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (empty($results)): ?>
        <p>No results found for your query in "<?php echo ucfirst(htmlspecialchars($entityType)); ?>".</p>
    <?php else: ?>
        <h3>Results for "<?php echo ucfirst(htmlspecialchars($entityType)); ?>"</h3>
        <?php foreach ($results as $item): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div
                        class="card h-100"
                        style="border: 1px solid var(--border); border-radius: var(--radius); transition: transform 0.2s;">
                        <div class="card-body p-4 d-flex flex-column">
                            <?php if ($entityType === 'modules'): ?>
                                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($item['description'] ?? 'No description'); ?></p>
                                <div class="d-flex justify-content-end gap-2 mt-auto">
                                    <form action="edit_module.php" method="GET" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Edit module">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="delete_module.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Delete module" onclick="return confirm('Are you sure you want to delete this module?');">
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

                            <?php elseif ($entityType === 'badges'): ?>
                                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($item['description'] ?? 'No description'); ?></p>
                                <div class="d-flex justify-content-end gap-2 mt-auto">
                                    <form action="edit_badge.php" method="GET" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                         <button type="submit" class="btn btn-sm btn-outline-primary" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Edit badge">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="delete_badge.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Delete badge" onclick="return confirm('Are you sure you want to delete this badge?');">
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

                            <?php elseif ($entityType === 'users'): ?>
                                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($item['email']); ?></p>
                                <div class="d-flex justify-content-end gap-2 mt-auto">
                                    <form action="edit_user_info.php" method="GET" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Edit user">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="delete_user.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Delete user" onclick="return confirm('Are you sure you want to delete this user?');">
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

                            <?php elseif ($entityType === 'questions'): ?>
                                <h5 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($item['content'], 0, 100) . '...'); ?></p>
                                <div class="d-flex justify-content-end gap-2 mt-auto">
                                    <form action="edit_post.php" method="GET" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Edit post">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="delete_post.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Delete post" onclick="return confirm('Are you sure you want to delete this question?');">
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Pagination -->
        <div class="mt-4" style="text-align: center; margin-top: 20px;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a 
                    href="?page=<?= $i ?>&q=<?= urlencode($searchQuery) ?>&type=<?= $entityType ?>" 
                    class="btn btn-outline-primary <?= $i == $page ? 'active' : '' ?>"
                    style="margin: 4px;"
                ><?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>


<style>
    /* Light Mode Styles for Select2 */
    .select2-container--default .select2-selection--single {
        background-color: var(--input);
        border: 1px solid var(--border);
        height: 38px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: var(--foreground);
        line-height: 36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    .select2-dropdown {
        background-color: var(--card);
        border: 1px solid var(--border);
    }
    .select2-search--dropdown .select2-search__field {
        background-color: var(--input);
        color: var(--foreground);
    }
    .select2-results__option {
        color: var(--foreground);
    }
    .select2-results__option--highlighted[aria-selected] {
        background-color: var(--primary);
        color: var(--primary-foreground);
    }

    /* Dark Mode Styles for Select2 */
    [data-bs-theme="dark"] .select2-container--default .select2-selection--single {
        background-color: var(--input);
        border: 1px solid var(--border);
    }
    [data-bs-theme="dark"] .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: var(--foreground);
    }
    [data-bs-theme="dark"] .select2-dropdown {
        background-color: var(--card);
        border: 1px solid var(--border);
    }
    [data-bs-theme="dark"] .select2-search--dropdown .select2-search__field {
        background-color: var(--input);
        color: var(--foreground);
    }
    [data-bs-theme="dark"] .select2-results__option {
        color: var(--foreground);
    }
     [data-bs-theme="dark"] .select2-results__option--highlighted[aria-selected] {
        background-color: var(--primary);
        color: var(--primary-foreground);
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#typeSelect').select2({
            minimumResultsForSearch: Infinity
        });
    });
</script>
