<div class="container mt-4">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <?php if (!empty($user['ProfilePicture'])): ?>
                        <img src="upload/uploads/<?php echo htmlspecialchars($user['ProfilePicture']); ?>" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <i class="bi bi-person-circle" style="font-size: 5rem; color: var(--foreground);"></i>
                    <?php endif; ?>
             
                </div>
                <div class="col-md-8">
                    <h5 class="card-title"><strong>Username:</strong> <?php echo htmlspecialchars($user['Username']); ?></h5>
                    <p class="card-text"><strong>Name:</strong> <?php echo htmlspecialchars($user['Name'] ?? 'N/A'); ?></p>
                    <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
                    <?php if ($userID == $_SESSION['user_id']): ?>
                        <p class="card-text"><strong>Password:</strong> ********</p>
                    <?php endif; ?>
                    <p class="card-text"><strong>Joined:</strong> <?php echo date('F j, Y', strtotime($user['DateJoined'])); ?></p>
                    <p class="card-text"><strong>About:</strong> <?php echo htmlspecialchars($user['About'] ?? "N/A"); ?></p>
                    
                </div>
                <?php if ($userID != $_SESSION['user_id']): ?>
                    <div class="col-md-12 text-end">
                        <a href="chat.php?id=<?=$userID?>" class="btn btn-primary">Chat</a>
                    </div>
                <?php endif; ?>
            
                <?php if ($userID == $_SESSION['user_id']): ?>
                    <div class="col-md-12 text-end">
                        <a href="edit_user_info.php" class="btn btn-primary">Edit Profile</a>
                    </div>
                <?php endif; ?>
            </div>
            
        </div>
       
    </div>

    <!-- Badges Section -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Badges</h5>
            <?php if (empty($badges)): ?>
                <p>No badges earned yet.</p>
            <?php else: ?>
                <div class="d-flex flex-wrap gap-2" style="max-height: 200px; overflow-y: auto;">
                    <?php foreach ($badges as $badge): ?>
                        <span class="badge bg-primary" title="<?php echo htmlspecialchars($badge['Description']); ?>">
                            <?php echo htmlspecialchars($badge['BadgeName']); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Posts Section -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Posts</h5>
            <?php if (empty($posts)): ?>
                <p>No posts yet.</p>
            <?php else: ?>
                <ul class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                    <?php foreach ($posts as $post): ?>
                        <li class="list-group-item">
                            <a href="view_post.php?id=<?php echo $post['ID']; ?>" class="text-decoration-none">
                                <?php echo htmlspecialchars($post['Title']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <!-- Answers Section -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Answers</h5>
            <?php if (empty($answers)): ?>
                <p>No answers yet.</p>
            <?php else: ?>
                <ul class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                    <?php foreach ($answers as $answer): ?>
                        <li class="list-group-item">
                            <a href="view_post.php?id=<?php echo $answer['ID']; ?>" class="text-decoration-none">
                                <?php echo htmlspecialchars($answer['Content']); ?> 
                                (on "<?php echo htmlspecialchars($answer['Title']); ?>")
                              
                            </a>
                            <?php if (!empty($answer['Image'])): ?>
                                <img src="upload/uploads/<?php echo htmlspecialchars($answer['Image']); ?>" alt="Answer Image" class="img-fluid mt-2" style="max-height: 100px; object-fit: cover;">
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>