<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Admin Dashboard - Totals</h1>
        </div>
    </div>

    <div class="row">
        <?php foreach ($counts as $entity => $total): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100" style="border: 1px solid var(--border); border-radius: var(--radius); transition: transform 0.2s;">
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars(ucfirst($entity)); ?></h5>
                        <p class="card-text fs-4 fw-bold"><?php echo number_format($total); ?></p>
                        <div class="mt-auto">
                            </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>