<?php $customTitle = "Create Post"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>
<?php include "database/db_connection.php" ?>

<?php

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["create_postbtn"])) {
    $post_title = $_POST["post_title"];
    $post_content = $_POST["post_content"];
    $post_owner = $_SESSION['user_id'];

    if (isset($_FILES["post_image"])) {
        $file_name = $_FILES["post_image"]["name"];
        $file_tmp_name = $_FILES["post_image"]["tmp_name"];
        $file_size = $_FILES["post_image"]["size"];
        $file_error = $_FILES["post_image"]["error"];

        if ($file_error === 0) {
            $upload_directory = "uploads/";
            $file_destination = $upload_directory . $file_name;

            if (move_uploaded_file($file_tmp_name, $file_destination)) {
                $insertQuery = "INSERT INTO posts (post_owner, post_title, post_content, post_image) VALUES ('$post_owner', '$post_title', '$post_content', '$file_destination')";

                if (mysqli_query($connection, $insertQuery)) {
                    echo "Post created successfully!";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($connection);
                }
            } else {
                echo "Error uploading the image.";
            }
        } else {
            echo "Error: " . $file_error;
        }
    }
}

?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Creating new post</h4>
                </div>
                <form action="create_post.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="post_title">Post Title:</label>
                            <input type="text" class="form-control" name="post_title" placeholder="Enter post title">
                        </div>
                        <div class="form-group mb-2">
                            <label for="post_content">Post Content:</label>
                            <textarea class="form-control" name="post_content" placeholder="Enter post content"></textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="post_image">Post Image:</label>
                            <input type="file" class="form-control" name="post_image">
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="index.php" class="btn btn-danger">Cancel</a>
                        <button class="btn btn-primary" name="create_postbtn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "pages/_footer.php" ?>