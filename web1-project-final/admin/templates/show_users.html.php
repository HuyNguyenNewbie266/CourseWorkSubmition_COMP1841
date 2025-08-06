<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>All Users</h2>
            </div>
            <p>Connect with peers in your course.</p>
        </div>
    </div>

    <?php foreach ($users as $user): ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card h-100" style="border: 1px solid var(--border); border-radius: var(--radius); transition: transform 0.2s;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="flex-1">
                                <h5 class="card-title" style="font-size: 1.125rem; font-weight: 600; color: var(--card-foreground); margin-bottom: 0.5rem;">
                                    <?php echo htmlspecialchars($user['username']); ?>
                                </h5>
                                <p class="card-text mb-3" style="color: var(--foreground); opacity: 0.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?php echo htmlspecialchars($user['email']); ?>
                                </p>
                                <div class="d-flex align-items-center text-muted fs-body2" style="font-size: 0.875rem;">
                                    <span class="me-3">Name: <span class="font-weight-bold text-primary"><?php echo htmlspecialchars($user['name'] ?? 'Not provided'); ?></span></span>
                                    <span class="me-3">Reputation: <span class="font-weight-bold badge bg-primary"><?php echo htmlspecialchars($user['reputation'] ?? 0); ?></span></span>
                                    <span>Joined: <?php echo htmlspecialchars(date('m/d/Y', strtotime($user['date_joined']))); ?></span>
                                </div>
                            </div>
                            <div class="ms-3 flex-shrink-0">
                                <div style="width: 80px; height: 80px; background: var(--accent); border-radius: var(--radius); display: flex; align-items: center; justify-content: center;">
                                    <?php if (!empty($user['image'])): ?>
                                        <img src="../upload/uploads/<?php echo htmlspecialchars($user['image']); ?>" alt="User Profile Picture" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius);">
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user" style="color: var(--foreground); opacity: 0.5;">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <form action="edit_user_info.php" method="GET" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Edit user">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                    </svg>
                                </button>
                            </form>
                            <form action="delete_user.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Delete user">
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

    <!-- Pagination -->
    <div class="mt-4" style="text-align: center; margin-top: 20px;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a 
                href="?page=<?= $i ?>" 
                class="btn btn-outline <?= $i == $page ? 'btn-primary' : '' ?>"
                style="margin: 4px;"
            ><?= $i ?></a>
        <?php endfor; ?>
    </div>
</div>
