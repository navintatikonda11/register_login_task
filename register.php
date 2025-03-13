<?php
require 'templates/header.php';
?>
<div class="container">

    <h2>Register</h2>
    <form id="registerForm" action="process_register.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="file">Upload File</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <button type="button" class="btn btn-success" id="loginPage">Login</button>
    </form>
</div>

<!-- Bootstrap 3 Modal for Error Message -->
<div id="errorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register Error</h4>
            </div>
            <div class="modal-body">
                <p id="errorMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var errorMsg = "<?php echo isset($_SESSION['error']) ? $_SESSION['error'] : ''; ?>";
        if (errorMsg) {
            $("#errorMessage").text(errorMsg);
            $("#errorModal").modal("show");
            <?php unset($_SESSION['error']); ?>
        }
    });
</script>

<?php require 'templates/footer.php'; ?>