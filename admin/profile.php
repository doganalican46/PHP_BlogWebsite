<?php $customTitle = "Profile Page"; ?>
<?php include "../database/db_connection.php"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>
<?php include "pages/_message.php" ?>

<?php

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: ../login.php");
    exit();
}

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $fullname = $user['fullname'];
        $email = $user['email'];
        $image = $user['image'];
        $created_at = $user['created_at'];
    }
}

if (isset($_POST["updatebtn"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];

    $user_id = $_SESSION['user_id'];
    $query = "SELECT fullname, email, image FROM users WHERE id = $user_id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($fullname !== $user['fullname'] || $email !== $user['email']) {

            $updateQuery = "UPDATE users SET fullname = '$fullname', email = '$email' WHERE id = $user_id";

            if (mysqli_query($connection, $updateQuery)) {
                $_SESSION["message"] = "Profile updated successfully!";
                $_SESSION["type"] = "success";
            } else {
                echo "Error updating profile: " . mysqli_error($connection);
            }
        } else {
            $_SESSION["message"] = "No changes were made.";
            $_SESSION["type"] = "info";
        }


        if (!empty($_FILES['profile_image']['name'])) {
            $uploadDir = '../uploads/';
            $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
                $updateImageQuery = "UPDATE users SET image = '$uploadFile' WHERE id = $user_id";

                if (mysqli_query($connection, $updateImageQuery)) {
                    $_SESSION["message"] = "Profile photo updated";
                    $_SESSION["type"] = "success";
                    $user['image'] = $uploadFile;
                } else {
                    echo "Error updating image: " . mysqli_error($connection);
                }
            } else {
                echo "Error uploading image.";
            }
        }
    } else {
        echo "Error fetching user data: " . mysqli_error($connection);
    }
}


if (isset($_POST["delete_accountbtn"])) {
    $user_id = $_SESSION['user_id'];

    $deleteQuery = "DELETE FROM users WHERE id = $user_id";

    if (mysqli_query($connection, $deleteQuery)) {
        header("Location: logout.php");
        exit();
    } else {
        echo "Error deleting account: " . mysqli_error($connection);
    }
}






?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4 float-start">
            <div class="image">
                <?php
                if (isset($user['image']) && !empty($user['image'])) {
                    echo '<img src="' . $user['image'] . '" alt="Profile Image" width="250" height="250">';
                }
                ?>
            </div>
            <div class="col mt-2">
                <p class="text-muted">Created at: <?php echo $created_at ?></p>
            </div>
            <div class="col mt-2">
                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete your account?');">
                    <button type="submit" name="delete_accountbtn" class="btn btn-danger">Delete Account</button>
                </form>
            </div>


        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h1><?php echo $fullname; ?></h1>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="fullname">Fullname:</label>
                            <input type="text" class="form-control" name="fullname" value="<?php echo $fullname; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">E-Mail:</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="profile_image">Profile Image:</label>
                            <input type="file" class="form-control" name="profile_image">
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-end" type="submit" name="updatebtn">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mt-5">

        </div>
    </div>

</div>




<?php include "pages/_footer.php" ?>