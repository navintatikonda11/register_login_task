<?php
require 'templates/header.php';
?>

<div class="container">
    <h2>Login</h2>
    <form id="loginForm" action="process_login.php" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-success">Login</button>
        <button type="button" class="btn btn-primary" id="registerPage">Register</button>
    </form>
</div>

<!-- Bootstrap 3 Modal for Error Message -->
<div id="errorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login Error</h4>
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