<?php ob_start(); ?>
<h1>Edit Blog Post</h1>
<form method="post" action="index.php?action=edit&id=<?= $post['id'] ?>" onsubmit="return validateForm(this);">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" id="tags" name="tags" value="<?= htmlspecialchars($post['tags']) ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php?action=view&id=<?= $post['id'] ?>" class="btn btn-secondary">Cancel</a>
</form>

<script>
function validateForm(form) {
    if (!form.title.value.trim() || !form.content.value.trim()) {
        Swal.fire({
            title: 'Error!',
            text: 'Title and content are required.',
            icon: 'error',
            confirmButtonColor: '#007bff'
        });
        return false;
    }
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');
    const status = urlParams.get('status');

    if (message) {
        Swal.fire({
            title: status === 'success' ? 'Success!' : 'Error!',
            text: decodeURIComponent(message),
            icon: status === 'success' ? 'success' : 'error',
            confirmButtonColor: '#007bff'
        });
    }
});
</script>
<?php
$content = ob_get_clean();
require 'header.php';
?>
