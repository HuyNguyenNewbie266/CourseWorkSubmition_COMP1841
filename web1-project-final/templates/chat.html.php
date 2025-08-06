<div class="container mt-4">
    <div class="d-flex align-items-center mb-3">
        <?php if (!empty($other_user['ProfilePicture'])): ?>
            <img src="upload/uploads/<?php echo htmlspecialchars($other_user['ProfilePicture']); ?>" alt="Profile Picture" class="rounded-circle me-2" style="width: 40px; height: 40px;">
        <?php else: ?>
            <div class="rounded-circle me-2" style="width: 40px; height: 40px; background: var(--accent); display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user" style="color: var(--foreground); opacity: 0.5;">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
        <?php endif; ?>
        <h2 class="mb-0"><?php echo htmlspecialchars($other_user['Username']); ?></h2>
    </div>
    <div class="chat-history" style="height: 550px; overflow-y: scroll; border: 1px solid var(--border); padding: 10px; background: var(--card);">
    <?php if (empty($messages)): ?>
        <p style="color: var(--foreground); opacity: 0.7;">No messages yet. Start the conversation!</p>
    <?php else: ?>
        <?php foreach ($messages as $message): ?>
            <div class="d-flex mb-2 <?php echo $message['SenderID'] == $user_id ? 'justify-content-end' : 'justify-content-start'; ?>">
                <div style="background: <?php echo $message['SenderID'] == $user_id ? 'var(--primary)' : 'var(--accent)'; ?>; color: <?php echo $message['SenderID'] == $user_id ? 'var(--primary-foreground)' : 'var(--accent-foreground)'; ?>; padding: 10px; border-radius: var(--radius); max-width: 70%; position: relative;word-wrap: break-word;">
                    <p class="mb-1"><?php echo htmlspecialchars($message['Content']); ?></p>
                    
                    <?php if ($message['SenderID'] == $user_id): ?>
                        <form method="POST" action="delete_chat.php" style="bottom: 5px; left: 5px; display: inline;">
                            <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($message['ID']); ?>">
                            <input type="hidden" name="person_id" value="<?php echo htmlspecialchars($person_id); ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger p-1" aria-label="Delete message">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <?php endif; ?>
                        <small style="opacity: 0.8;"><?php echo date('m/d/Y H:i', strtotime($message['SentAt'])); ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
    <form method="POST" class="mt-3">
        <div class="input-group">
            <textarea name="content" class="form-control" rows="3" required style="background: var(--input); border-color: var(--border); color: var(--foreground);"></textarea>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var chatHistory = document.querySelector('.chat-history');
        chatHistory.scrollTop = chatHistory.scrollHeight;
    });
</script>
