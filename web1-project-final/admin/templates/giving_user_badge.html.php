<div class="container mt-4">
    <h2>Give a Badge to a User</h2>
    
    <?php if (!empty($message)): ?>
        
        <?php echo $message; ?>

    <?php endif; ?>

    <form action="giving_user_badge.php" method="POST" class="mt-4">

        <div class="mb-3">
            <label for="userSelect" class="form-label">Select User</label>
            <select class="form-select" id="userSelect" name="user_id" required style="width: 100%;">
                <option value="">Search for a user...</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo htmlspecialchars($user['ID']); ?>">
                        <?php echo htmlspecialchars($user['Username']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="badgeSelect" class="form-label">Select Badge</label>
            <select class="form-select" id="badgeSelect" name="badge_id" required style="width: 100%;">
                <option value="">Search for a badge...</option>
                <?php foreach ($badges as $badge): ?>
                    <option value="<?php echo htmlspecialchars($badge['ID']); ?>">
                        <?php echo htmlspecialchars($badge['BadgeName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Give Badge</button>
    </form>
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
$(document).ready(function() {
    // Initialize Select2 for the user dropdown
    $('#userSelect').select2({
        placeholder: "Search for a user...",
        allowClear: true
    });

    // Initialize Select2 for the badge dropdown
    $('#badgeSelect').select2({
        placeholder: "Search for a badge...",
        allowClear: true
    });
});
</script>
