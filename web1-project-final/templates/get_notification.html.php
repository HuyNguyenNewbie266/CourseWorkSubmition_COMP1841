<div class="container mt-4">
    <h2>Your Notifications</h2>
    <?php if (empty($notifications)): ?>
        <div class="alert alert-info" role="alert">
            You have no new notifications.
        </div>
    <?php else: ?>
        <?php foreach ($notifications as $notification): ?>
            <?php
            // Determine styles based on read status
            $card_class = $notification['is_read'] ? 'alert-secondary' : 'border-primary shadow-sm';
            $text_weight = $notification['is_read'] ? 'fw-normal' : 'fw-bold';
            ?>
            <div class="card mb-3 <?php echo $card_class; ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title <?php echo $text_weight; ?>">
                                <?php if (!$notification['is_read']): ?>
                                    <span class="badge bg-primary me-2">New</span>
                                <?php endif; ?>
                                <?php echo htmlspecialchars($notification['title']); ?>
                            </h5>
                            <p class="card-text mb-0">
                                <small class="text-muted">
                                    Received: <?php echo date('F j, Y, g:i a', strtotime($notification['date'])); ?>
                                </small>
                            </p>
                        </div>
                        <div class="align-self-center">
                            <a href="get_notification.php?id=<?= $notification['id'] ?>" class="btn btn-outline-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>