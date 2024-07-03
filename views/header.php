<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog Engine</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="@@static/custom.js@@"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fas fa-blog mr-2"></i>My Blog Engine</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-home mr-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=add"><i class="fas fa-plus mr-1"></i>Add Post</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="material-icons" style="vertical-align: bottom;">build</span> Tools
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" onclick="post('@@reset@@');" style="cursor: pointer;">DB Reset</a>
                            <a class="dropdown-item" href="/phpliteadmin/index.php" target="_blank">DB Admin</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php echo $content ?>
    </div>

    <?php if (isset($errors) && !empty($errors)): ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger">
                Please fix the following errors:
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-success alert-dismissible flash-message" role="alert" id="flash">
        <?php echo $_SESSION['flash']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $("div.flash-message").fadeTo(1000,1).delay(2000).fadeOut(1000);
        });
    </script>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <?php include 'views/footer.html'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if there's a message in the URL
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            const status = urlParams.get('status');

            if (message) {
                Swal.fire({
                    title: status === 'success' ? 'Success!' : 'Oops...',
                    text: message,
                    icon: status === 'success' ? 'success' : 'error',
                    confirmButtonColor: '#007bff'
                });
            }

            // Handle delete confirmation
            const deleteLinks = document.querySelectorAll('a[href*="action=delete"]');
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = this.href;
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
