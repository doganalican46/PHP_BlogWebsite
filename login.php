<?php $customTitle = "Login Page"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form>
                <h2 class="mb-4">Login Form</h2>
                <div class="form-group mb-2">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter e-mail">
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
                <p class="mt-3">Don't have an account? <a href="register.php">Register now!</a></p>
            </form>
        </div>
    </div>
</div>

<?php include "pages/_footer.php" ?>