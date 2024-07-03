<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'include/util.php';

// Include the model file for database functions
require_once 'models/post.php';

// Fetch recent posts
$posts = getPosts();

// Start output buffering
ob_start();
?>

<div class="container mt-5">
    <h1 class="mb-4">Recent posts</h1>
    <?php if (empty($posts)): ?>
        <p>No posts available.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title"><a href="index.php?action=view&id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                    <p class="card-text">
                        <?= htmlspecialchars(substr($post['content'], 0, 500)) ?>
                        <?php if (strlen($post['content']) > 500): ?>
                            <a href="index.php?action=view&id=<?= $post['id'] ?>" class="text-primary">Read more...</a>
                        <?php endif; ?>
                    </p>
                    <p class="card-text"><small class="text-muted">Posted <?= time2str($post['date']) ?></small></p>
                    <p class="card-text"><small class="text-muted">Filed under: <?= htmlspecialchars($post['tags']) ?></small></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <a href="index.php?action=add" class="btn btn-primary mt-3"><i class="fas fa-plus mr-1"></i>Add a post</a>
</div>

<?php
$content = ob_get_clean();
require 'header.php';
?>
