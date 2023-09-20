<?php include "database/db_connection.php"; ?>
<?php
session_start();

if (isset($_POST["loginbtn"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if ($user['password'] == $password) {
                $_SESSION["message"] = $user["username"]." Successfully login...";
                $_SESSION["auth"]=$user["username"];
                header("Location: index.php");
                exit(); 
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "No user found with this email.";
        }
    } else {
        echo "Query failed: " . mysqli_error($connection);
    }
}
?>



<?php $customTitle = "Login Page"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="post">
                <h2 class="mb-4">Login Form</h2>
                <div class="form-group mb-2">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter e-mail">
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
                <button type="submit" name="loginbtn" class="btn btn-primary btn-block mt-4">Login</button>
                <p class="mt-3">Don't have an account? <a href="register.php">Register now!</a></p>
            </form>
        </div>
    </div>
</div>

<?php include "pages/_footer.php" ?>