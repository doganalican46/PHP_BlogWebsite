<?php $customTitle = "Login Page"; ?>
<?php include "database/db_connection.php"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>

<?php
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["loginbtn"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if ($user['password'] == $password) {
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = $user['fullname'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['image'] = $user['image'];
                $_SESSION['user_role'] = $user['user_role'];

                if ($user['user_role'] == 0) {
                    // User is not an admin, redirect to index.php
                    header("Location: index.php");
                    exit();
                } elseif ($user['user_role'] == 1) {
                    // User is an admin, redirect to admin/index.php
                    header("Location: admin/index.php");
                    exit();
                }

                exit();
            } else {
                echo "Wrong Password!";
            }
        } else {
            echo "No user found with this email.";
        }
    } else {
        echo "Query failed: " . mysqli_error($connection);
    }
}

?>

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