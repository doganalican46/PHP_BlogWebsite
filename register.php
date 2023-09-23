<?php include "database/db_connection.php"; ?>
<?php


if (isset($_POST["registerbtn"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if (empty($fullname) || empty($email) || empty($password) || empty($cpassword)) {
        echo "All fields are required.";
    } elseif ($password !== $cpassword) {
        echo "Passwords do not match.";
    } else {
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "Email already exists. Please choose a different one.";
        } else {
            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $insertQuery = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

            if (mysqli_query($connection, $insertQuery)) {
                echo "Registration successful!";
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        }
    }
}
?>




<?php $customTitle = "Register Page"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="register.php" method="post">
                <h2 class="mb-4">Register Form</h2>
                <div class="form-group mb-2">
                    <label for="fullname">Fullname:</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Enter fullname" value="<?php echo isset($fullname) ? htmlspecialchars($fullname) : ''; ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter e-mail" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
                <div class="form-group mb-2">
                    <label for="cpassword">Confirm Password:</label>
                    <input type="password" class="form-control" name="cpassword" placeholder="Rewrite password">
                </div>
                <button type="submit" name="registerbtn" class="btn btn-primary btn-block mt-4">Register</button>
                <p class="mt-3">Already have an account? <a href="login.php">Login now!</a></p>
            </form>
        </div>
    </div>
</div>


<?php include "pages/_footer.php" ?>