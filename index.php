<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>
<?php include "database/db_connection.php" ?>


<div class="container mt-5 mb-5">
    <?php
    session_regenerate_id();

    if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
        header("Location: login.php");
        exit();
    }
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
        $fullname = $_SESSION['auth_user'];
        echo '<h1>Hello ' . $fullname . ',</h1>';
    }

    if (isset($_POST["delete_postbtn"])) {
        $post_id = $_POST['post_id'];

        $deleteQuery = "DELETE FROM posts WHERE post_id = $post_id";

        if (mysqli_query($connection, $deleteQuery)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error deleting post: " . mysqli_error($connection);
        }
    }
    ?>

    <form action="create_post.php" method="post">
        <button class="btn btn-primary mt-2"> Create a post </button>
    </form>

    <?php
    $post_owner = $_SESSION['user_id'];
    $query = "SELECT posts.*, users.fullname AS owner_name FROM posts JOIN users ON posts.post_owner = users.id WHERE post_owner='$post_owner' ORDER BY posts.post_id DESC";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $post_owner_name = $row["owner_name"];
        $post_id = $row["post_id"];
        $post_title = $row["post_title"];
        $post_content = $row["post_content"];
        $post_image = $row["post_image"];
        $created_at = $row["created_at"];
        $status = $row["status"];

        $statusText = ($status == 1) ? '<span class="text-success">Approved</span>' : '<span class="text-danger">Pending Approval</span>';
    ?>

        <div class="card post-card mt-5">
            <div class="card-header">
                <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete your post?');">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <h3><?php echo $post_title; ?> <button type="submit" name="delete_postbtn" class="btn btn-danger float-end">Delete</button>
                    </h3>
                </form>
                <hr>
                <h6>Post owner: <?php echo $post_owner_name; ?><p class="float-end">Status: <?php echo $statusText; ?></p>
                </h6>
                <label class="text-muted">Created at <?php echo $created_at; ?></label>

            </div>
            <div class="card-body">
                <?php
                if (!empty($post_image)) {
                    echo "<div class='post-image'><img src='$post_image' alt='Post Image' class='img-fluid'></div>";
                }
                ?>
                <hr>
                <div class="post-content"><?php echo $post_content; ?></div>
            </div>
            <div class="card-footer">
                <i class="fas fa-heart"></i>
            </div>
        </div>


    <?php }
    ?>

</div>




<?php include "pages/_footer.php" ?>