<?php ob_start(); ?>
<h1><?= htmlspecialchars($post['title']) ?></h1>
<p><small><i class="far fa-calendar-alt mr-2"></i>Posted on <?= $post['date'] ?></small></p>
<div class="card mb-3">
    <div class="card-body">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>
</div>
<p><strong><i class="fas fa-tags mr-2"></i>Tags:</strong> <?= htmlspecialchars($post['tags']) ?></p>
<div class="btn-group" role="group">
    <a href="index.php" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    <a href="index.php?action=edit&id=<?= $post['id'] ?>" class="btn btn-secondary"><i class="fas fa-edit mr-2"></i>Edit</a>
    <a href="index.php?action=delete&id=<?= $post['id'] ?>" class="btn btn-danger delete-post"><i class="fas fa-trash-alt mr-2"></i>Delete</a>
</div>
<?php
$content = ob_get_clean();
require 'header.php';
?>