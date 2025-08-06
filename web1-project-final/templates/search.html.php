<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Search Results</h2>
            <p>
                <?php if (empty($searchQuery) && empty($moduleFilter) && empty($userFilter)): ?>
                    There are <?php echo htmlspecialchars($totalQuestions); ?> results.
                <?php elseif (empty($searchQuery) && !empty($moduleFilter) && !empty($userFilter)): ?>
                    There are <?php echo htmlspecialchars($totalQuestions); ?> results in module "<?php echo htmlspecialchars($moduleFilter); ?>" by user "<?php echo htmlspecialchars($userFilter); ?>".
                <?php elseif (empty($searchQuery) && !empty($moduleFilter)): ?>
                    There are <?php echo htmlspecialchars($totalQuestions); ?> results in module "<?php echo htmlspecialchars($moduleFilter); ?>".
                <?php elseif (empty($searchQuery) && !empty($userFilter)): ?>
                    There are <?php echo htmlspecialchars($totalQuestions); ?> results by user "<?php echo htmlspecialchars($userFilter); ?>".
                <?php else: ?>
                    Found <?php echo htmlspecialchars($totalQuestions); ?> results for "<?php echo htmlspecialchars($searchQuery); ?>"
                    <?php echo !empty($moduleFilter) ? ' in module "' . htmlspecialchars($moduleFilter) . '"' : ''; ?>
                    <?php echo !empty($userFilter) ? ' by user "' . htmlspecialchars($userFilter) . '"' : ''; ?>.
                <?php endif; ?>
            </p>
            <form action="search.php" method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input class="form-control s-input" type="search" name="q" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search posts..." aria-label="Search">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="module" id="moduleSelect" style="width: 100%;">
                            <option value="">All Modules</option>
                            <?php foreach ($modules as $module): ?>
                                <option value="<?php echo htmlspecialchars($module['name']); ?>" <?php echo $module['name'] === $moduleFilter ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($module['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="user" id="userSelect" style="width: 100%;">
                            <option value="">All Users</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?php echo htmlspecialchars($user['name']); ?>" <?php echo $user['name'] === $userFilter ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($user['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary s-btn w-100" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if ($totalQuestions > 0): ?>
        <?php foreach ($questions as $question): ?>
            <div class="row mb-4">
                <a style="display: flex;" href="view_post.php?id=<?php echo htmlspecialchars($question['id']); ?>">
                    <div class="col-12">
                        <div class="card h-100" style="border: 1px solid var(--border); border-radius: var(--radius); transition: transform 0.2s;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="card-text flex-1">
                                        <h5 class="card-title" style="font-size: 1.125rem; font-weight: 600; color: var(--card-foreground); margin-bottom: 0.5rem;">
                                            <?php echo htmlspecialchars($question['title']); ?>
                                        </h5>
                                        <p class="card-text mb-3" style="color: var(--foreground); opacity: 0.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                            <?php echo htmlspecialchars($question['text']); ?>
                                        </p>
                                        <div class="d-flex align-items-center text-muted fs-body2" style="font-size: 0.875rem;">
                                            <span class="me-3">By: <span class="font-weight-bold text-primary"><?php echo htmlspecialchars($question['username'] ?? 'Anonymous'); ?></span></span>
                                            <span class="me-3">Module: <span class="font-weight-bold badge bg-primary"><?php echo htmlspecialchars($question['module'] ?? 'Uncategorized'); ?></span></span>
                                            <span><?php echo htmlspecialchars(date('m/d/Y', strtotime($question['date']))); ?></span>
                                        </div>
                                    </div>
                                    <?php if (!empty($question['image'])): ?>
                                <div class="ms-3 flex-shrink-0">
                                    
                                
                                    <div style="width: 80px; height: 80px; border-radius: var(--radius); display: flex; align-items: center; justify-content: center;">
                                            <img src="upload/uploads/<?php echo htmlspecialchars($question['image']); ?>" alt="Question Screenshot" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius);">
                                        
                                            
                                
                                </div>
                            </div>
                            <?php endif; ?>    
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                            <?php if ($question['username'] == $_SESSION['user_name']): ?>   
                            <form action="edit_post.php" method="GET" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($question['id']); ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-primary" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Edit post">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                        </svg>
                                    </button>
                                </form>
                                
                                    <form action="delete_post.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($question['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Delete post">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                <line x1="10" x2="10" y1="11" y2="17"></line>
                                                <line x1="14" x2="14" y1="11" y2="17"></line>
                                            </svg>
                                        </button>
                                    </form>
                                <?php endif; ?>
                        </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        
        <!-- Pagination -->
        <div class="mt-4" style="text-align: center; margin-top: 20px;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a 
                    href="?page=<?php echo $i; ?>&q=<?php echo urlencode($searchQuery); ?><?php echo !empty($moduleFilter) ? '&module=' . urlencode($moduleFilter) : ''; ?><?php echo !empty($userFilter) ? '&user=' . urlencode($userFilter) : ''; ?>" 
                    class="btn btn-outline <?php echo $i == $page ? 'btn-primary' : ''; ?>"
                    style="margin: 4px;"
                ><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>

<!-- Include Select2 for searchable dropdowns -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

    /* Adjust the clear button position for both light and dark modes */
.select2-container--default .select2-selection--single .select2-selection__clear {
    position: absolute;
    right: -2px; /* Adjust this value to move the button left/right */
    top: 41%; /* Center vertically */
    transform: translateY(-50%); /* Ensure vertical centering */
    font-size: 16px; /* Adjust size of the "x" if needed */
    padding: 0 5px; /* Add padding to make the button clickable */
    cursor: pointer;
}

/* Prevent text overlap by adding padding to the right of the selected text */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-right: 30px; /* Ensure enough space for the clear button */
}
</style>

<script>
$(document).ready(function() {
    // Initialize Select2 for the module dropdown
    $('#moduleSelect').select2({
        placeholder: "All Modules",
        allowClear: true
    });

    // Initialize Select2 for the user dropdown
    $('#userSelect').select2({
        placeholder: "All Users",
        allowClear: true
    });
});
</script>
