<div class="container">
    <!-- Post Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div>
                <div class="card-body p-4 d-flex flex-column">
                    <div>
                        <h2  style="font-size: 1.5rem; font-weight: 600; color: var(--card-foreground); margin-bottom: 0.5rem;">
                            <?php echo htmlspecialchars($post['Title']); ?>
                        </h2>
                        <hr>
                        <p style="color: var(--foreground); opacity: 0.95;">
                            <?php echo nl2br(htmlspecialchars($post['Content'])); ?>
                        </p>
                        <?php if (!empty($post['Image'])): ?>
                            <img src="upload/uploads/<?php echo htmlspecialchars($post['Image']); ?>" alt="Post Image" class="img-fluid mb-3" style="max-height: 400px; object-fit: cover; border-radius: var(--radius);">
                        <?php endif; ?>
                        <div class="d-flex align-items-center text-muted fs-body2" style="font-size: 0.875rem;">
                            <span class="me-3">By: 
                                <?php if (isset($post['AuthorID'])): ?>
                                    <a href="view_user.php?id=<?php echo htmlspecialchars($post['AuthorID']); ?>">
                                <?php endif; ?>
                                <span class="font-weight-bold text-primary"><?php echo htmlspecialchars($post['Username'] ?? 'Anonymous'); ?></span>
                                <?php if (isset($post['AuthorID'])): ?>
                                    </a>
                                <?php endif; ?>
                            </span>
                            <span class="me-3">Module: 
                                <a href="search.php?module=<?php echo htmlspecialchars($post['ModuleName']); ?>"><span class="font-weight-bold badge bg-primary"><?php echo htmlspecialchars($post['ModuleName'] ?? 'Uncategorized'); ?></span></a>
                            </span>
                            <span><?php echo date('m/d/Y', strtotime($post['DateCreated'])); ?></span>
                        </div>
                    </div>

                    <!-- Edit and Delete Buttons for the Post -->
                    <?php if (isset($_SESSION['user_id']) && $post['AuthorID'] == $_SESSION['user_id']): ?>
                        <div class="justify-content-end gap-2 mt-auto pt-3">
                            <form action="edit_post.php" method="GET" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($postID); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary" aria-label="Edit post">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                    </svg>
                                    
                                </button>
                            </form>
                            <form action="delete_post.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($postID); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?');" aria-label="Delete post">
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Voting Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" class="me-2">
                        <input type="hidden" name="vote" value="up">
                        <button type="submit" class="btn btn-sm <?php echo $userVote == 'up' ? 'btn-primary' : 'btn-outline-primary'; ?>">
                            <i class="bi bi-arrow-up"></i> Upvote (<?php echo $upVotes; ?>)
                        </button>
                    </form>
                    <form method="POST" class="me-2">
                        <input type="hidden" name="vote" value="down">
                        <button type="submit" class="btn btn-sm <?php echo $userVote == 'down' ? 'btn-danger' : 'btn-outline-danger'; ?>">
                            <i class="bi bi-arrow-down"></i> Downvote (<?php echo $downVotes; ?>)
                        </button>
                    </form>
                <?php else: ?>
                    <p>Please <a href="login.php">log in</a> to vote.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Answers Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h3>Answers</h3>
            <?php if (empty($answers)): ?>
                <p>No answers yet.</p>
            <?php else: ?>
                <?php foreach ($answers as $answer): ?>
                    <div class="card mb-3" style="border: 1px solid var(--border); border-radius: var(--radius);">
                        <div class="card-body p-4 d-flex flex-column">
                           <div>
                                <p style="color: var(--foreground);">
                                    <?php echo nl2br(htmlspecialchars($answer['Content'])); ?>
                                </p>
                                <?php if (!empty($answer['Image'])): ?>
                                    <img src="upload/uploads/<?php echo htmlspecialchars($answer['Image']); ?>" alt="Answer Image" class="img-fluid mb-3" style="max-height: 200px; object-fit: cover; border-radius: var(--radius);">
                                <?php endif; ?>
                                <div class="d-flex align-items-center text-muted fs-body2" style="font-size: 0.875rem;">
                                    <span class="me-3">By: <span class="font-weight-bold text-primary"><?php echo htmlspecialchars($answer['Username'] ?? 'Anonymous'); ?></span></span>
                                    <span><?php echo date('m/d/Y', strtotime($answer['DateCreated'])); ?></span>
                                    <?php if ($answer['AcceptedAnswerID'] == $answer['ID']): ?>
                                        <span class="ms-3 badge bg-success">Accepted</span>
                                    <?php endif; ?>
                                </div>
                                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['AuthorID'] && $answer['AuthorID'] != $post['AuthorID']): ?>
                                    <form method="POST" class="d-inline mt-2">
                                        <?php if ($answer['AcceptedAnswerID'] == $answer['ID']): ?>
                                            <input type="hidden" name="unaccept_answer" value="1">
                                            <button type="submit" class="btn btn-sm btn-success">Accepted</button>
                                        <?php else: ?>
                                            <input type="hidden" name="accept_answer" value="1">
                                            <button type="submit" class="btn btn-sm btn-outline-success">Accept</button>
                                        <?php endif; ?>
                                        <input type="hidden" name="answer_id" value="<?php echo $answer['ID']; ?>">
                                    </form>
                                <?php endif; ?>
                           </div>
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $answer['AuthorID']): ?>
                                <div class="d-flex justify-content-end gap-2 mt-auto pt-3">
                                    <a href="edit_answer.php?id=<?php echo $answer['ID']; ?>" class="btn btn-sm btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path>
                                        </svg> </a>
                                    <form action="delete_answer.php" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $answer['ID']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this answer?');">
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
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Answer Submission Section -->
    <hr>
    <div class="row">
        <div class="col-12">
            <h3>Submit Your Answer</h3>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <textarea name="answer" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="answer_image" class="form-label">Upload Image (optional)</label>
                        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/gif">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Answer</button>
                </form>
            <?php else: ?>
                <p>Please <a href="login.php">log in</a> to submit an answer.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
