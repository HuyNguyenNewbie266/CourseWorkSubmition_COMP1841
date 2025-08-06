<div class="container mt-4">
    <h2>Messages to Admin</h2>
    <?php if (empty($messages)): ?>
        <p>No messages found.</p>
    <?php else: ?>
        <?php foreach ($messages as $message): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card h-100" style="border: 1px solid var(--border); border-radius: var(--radius);">
                        <div class="card-body p-4">
                            <h5 class="card-title" style="font-size: 1.125rem; font-weight: 600; color: var(--card-foreground);">
                                <?php echo htmlspecialchars($message['Content']); ?>
                            </h5>
                            <div class="d-flex align-items-center text-muted fs-body2" style="font-size: 0.875rem;">
                                <span><?php echo htmlspecialchars(date('m/d/Y H:i', strtotime($message['Timestamp']))); ?></span>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
            
                                <form action="delete_contact.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($message['MessageID']); ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="padding: 0.5rem; border-radius: var(--radius);" aria-label="Delete message">
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
    <?php endif; ?>
</div>
