
<div class="container col-lg-10 mx-auto py-4 px-5">
        <h2 class="h3 font-weight-bold mb-2">Contact Admin</h2>
        <p class="text-muted mb-4">Send a message to the site administrator</p>

        <?php if (isset($success) && $success): ?>
            <div class="alert alert-success" role="alert">
                Your message has been sent to the admin.
            </div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-4" id="contact-form">
            <!-- Guidelines Card -->
            <div class="card bg-info bg-opacity-10 border-info">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold text-info">Contacting the Admin</h3>
                </div>
                <div class="card-body text-sm">
                    <p class="mb-3">
                        Use this form to send a message to the site administrator.
                    </p>
                    <p class="mb-3">
                        Please provide as much detail as possible to help us assist you.
                    </p>
                    <p class="mb-3">
                        If you are reporting a post, please include the URL of the post in your message.
                    </p>
                </div>
            </div>
            <br>
            <!-- Message Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="h5 font-weight-bold">Message</h3>
                    <p class="text-muted small">
                        Write your message to the admin.
                    </p>
                </div>
                <div class="card-body">
                    <textarea
                        name="message"
                        id="message"
                        class="form-control"
                        rows="6"
                        placeholder="Type your message here..."
                        required
                    ></textarea>
                </div>
            </div>
            <br>
            <!-- Submit Button -->
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-primary px-4 py-2" aria-label="Send message">Send message</button>
            </div>
        </form>
    </div>
