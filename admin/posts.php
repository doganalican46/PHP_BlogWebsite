<?php $customTitle = "Posts"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>
<?php include "../database/db_connection.php" ?>


<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col">
            <?php
            if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
                header("Location: ../login.php");
                exit();
            }

            if (isset($_POST["delete_postbtn"])) {
                $post_id = $_POST['post_id'];

                $deleteQuery = "DELETE FROM posts WHERE post_id = $post_id";

                if (mysqli_query($connection, $deleteQuery)) {
                    header("Location: posts.php");
                    exit();
                } else {
                    echo "Error deleting post: " . mysqli_error($connection);
                }
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_statusbtn'])) {
                $post_id = $_POST['post_id'];
                $currentStatus = $_POST['current_status'];

                $newStatus = ($currentStatus == 1) ? 0 : 1;

                $updateQuery = "UPDATE posts SET status = $newStatus WHERE post_id = $post_id";
                mysqli_query($connection, $updateQuery);
            }

            $query = "SELECT posts.*, users.fullname AS owner_name FROM posts JOIN users ON posts.post_owner = users.id ORDER BY posts.post_id DESC";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $post_owner_name = $row["owner_name"];
                $post_id = $row["post_id"];
                $post_title = $row["post_title"];
                $post_content = $row["post_content"];
                $post_image = $row["post_image"];
                $post_likes=$row["likes"];
                $created_at = $row["created_at"];
                $status = $row["status"];
            ?>
                <div class="card post-card mt-5">
                    <div class="card-header">
                        <h3>
                            <form action="" method="post">

                                <?php echo $post_title; ?>
                                <button class="btn <?php echo $status == 1 ? 'btn-success' : 'btn-danger'; ?> float-end" name="change_statusbtn" value="Change Status">
                                    <?php echo $status == 1 ? 'Visible' : 'Unvisible'; ?>
                                </button>
                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                <input type="hidden" name="current_status" value="<?php echo $status; ?>">
                            </form>
                        </h3>
                        <hr>
                        <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete your post?');">
                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                            <h6>Post owner: <?php echo $post_owner_name; ?><button type="submit" name="delete_postbtn" class="btn btn-danger float-end">Delete</button></h6>
                            <label class="text-muted">Created at <?php echo $created_at; ?>
                            </label>
                        </form>
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty($post_image)) {
                            $imagePath = "../" . $post_image;
                            echo "<div class='post-image'><img src='$imagePath' alt='Post Image' class='img-fluid'></div>";
                        }
                        ?>
                        <hr>
                        <div class="post-content"><?php echo $post_content; ?></div>
                    </div>
                    <div class="card-footer">
                        <i class="fas fa-heart like-btn"></i>
                        <span class="like-count"><?php echo $post_likes; ?></span>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>




<?php include "pages/_footer.php" ?>