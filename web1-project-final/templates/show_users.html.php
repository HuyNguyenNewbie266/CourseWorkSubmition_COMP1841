<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>All Users</h2>
            </div>
            <p>Connect with peers in your course.</p>
        </div>
    </div>

    <div class="grid-container">
        <?php foreach ($users as $user): ?>
            <div class="card">
            <a href="view_user.php?id=<?php echo htmlspecialchars($user['id']); ?>">        
            <div class="card-body p-4 text-center">
            <?php if (!empty($user['image'])): ?>
                <img src="upload/uploads/<?php echo htmlspecialchars($user['image']); ?>" alt="User Image" class="img-fluid mb-3" style="width: 100px; height: 100px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
            <?php else: ?>        
            <div class="mb-3">
                        <div style="width: 100px; height: 100px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="bi bi-person-circle" style="font-size: 5rem; color: var(--foreground);"></i>
                        </div>
                    </div>
            <?php endif; ?>
            
                    <h5 class="card-title" style="font-size: 1rem; font-weight: 600; color: var(--card-foreground); margin-bottom: 0.5rem;">
                        <?php echo htmlspecialchars($user['username']); ?>
                    </h5>
                    <p class="card-text" style="font-size: 0.855rem; color: var(--foreground); opacity: 0.7;">
                        <?php echo htmlspecialchars($user['email']); ?>
                    </p>
                </div>
                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                    
                <div class="card-footer text-center">
                    <a href="chat.php?id=<?= $user['id']?>" class="btn btn-primary">Chat</a>
                </div>
                <?php endif; ?>
            </a>
            </div>
        <?php endforeach; ?>
    </div>

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