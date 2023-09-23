<?php $customTitle = "Update User"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>
<?php include "../database/db_connection.php"; ?>

<?php


if (isset($_POST["update_userbtn"])) {
    $user_id = $_POST["user_id"];
    $newfullname = $_POST["fullname"];
    $newemail = $_POST["email"];
    $newuser_role = $_POST["user_role"];

    $updateQuery = "UPDATE users SET fullname = ?, email = ?, user_role = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $updateQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssi", $fullname, $email, $user_role, $user_id);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['auth_user'] = $newfullname;
            $_SESSION['email'] = $newemail;
            $_SESSION['user_role'] = $newuser_role;
            header("Location: users_setting.php");
            exit();
        } else {
            echo "Error updating user: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error creating prepared statement: " . mysqli_error($connection);
    }
}
?>


<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col">
            <?php
            if (isset($_POST["edit_userbtn"])) {

                $user_id = $_POST["user_id"];


                $editQuery = "SELECT * FROM users WHERE id = ?";
                $stmt = mysqli_prepare($connection, $editQuery);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);

                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);

                        if ($user = mysqli_fetch_assoc($result)) {
            ?>

                            <div class="card">
                                <div class="card-header">
                                    <h2>Edit User: <?php echo $user['fullname'] ?> </h2>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <div class="form-group">
                                            <label for="fullname">Full Name:</label>
                                            <input type="text" class="form-control" name="fullname" value="<?php echo $user['fullname']; ?>"><br>
                                        </div>

                                        <div class="form-group ">
                                            <label for="email">Email:</label>
                                            <input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>"><br>
                                        </div>
                                        <div class="form-group ">
                                            <label for="user_role">Role:</label>
                                            <input type="text" class="form-control" name="user_role" value="<?php echo $user['user_role']; ?>"><br>
                                        </div>


                                </div>
                                <div class="card-footer">
                                    <a href="users_setting.php" class="btn btn-danger">Cancel</a>
                                    <button type="submit" name="update_userbtn" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>

            <?php
                        } else {
                            echo "User not found.";
                        }
                    } else {
                        echo "Error executing query: " . mysqli_error($connection);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error creating prepared statement: " . mysqli_error($connection);
                }
            }

            ?>

        </div>
    </div>
</div>











<?php include "pages/_footer.php" ?>