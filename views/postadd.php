<?php ob_start(); ?>
<div class="container mt-5">
    <h1 class="mb-4">Add a Blog Post</h1>
    <form method="post" action="index.php?action=add" onsubmit="return validateForm(this);" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
            <div class="invalid-feedback">
                Please provide a title.
            </div>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
            <div class="invalid-feedback">
                Please provide content.
            </div>
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="Separate tags with commas">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="index.php" class="btn btn-secondary me-md-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
(function () {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

function validateForm(form) {
    if (!form.checkValidity()) {
        return false;
    }
    
    if (!form.title.value.trim() || !form.content.value.trim()) {
        Swal.fire({
            title: 'Error!',
            text: 'Title and content are required.',
            icon: 'error',
            confirmButtonColor: '#0d6efd'
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
            confirmButtonColor: '#0d6efd'
        });
    }
});
</script>

<?php 
$content = ob_get_clean();
require 'header.php';
?>