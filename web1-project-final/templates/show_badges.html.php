<style>
.card-not-earned {
    background-color: var(--accent);
    color: var(--secondary);
}
</style>
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Badges</h2>
            <p>View all available badges and your progress.</p>
        </div>
    </div>
    <div class="grid-container">
        <?php foreach ($badges as $badge): ?>
            <div class="card <?php echo $badge['has_badge'] ? '' : 'card-not-earned'; ?>">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><?php echo htmlspecialchars($badge['BadgeName']); ?></span>
                    <?php if ($badge['has_badge']): ?>
                        <span class="badge bg-success">Earned</span>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo htmlspecialchars($badge['Description']); ?></p>
                </div>
                <?php if ($badge['has_badge']): ?>
                    <div class="card-footer text-muted">
                        Earned on <?php echo date('m/d/Y', strtotime($badge['DateEarned'])); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>