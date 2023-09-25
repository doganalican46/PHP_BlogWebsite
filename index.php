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

        $deleteQuery = "DELETE FROM posts WHERE post_id = ?";
        $stmt = mysqli_prepare($connection, $deleteQuery);
        mysqli_stmt_bind_param($stmt, "i", $post_id);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error deleting post: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
    }


    ?>

    <form action="create_post.php" method="post">
        <button class="btn btn-primary mt-2"> Create a post </button>
    </form>

    <?php
    $post_owner = $_SESSION['user_id'];
    $query = "SELECT posts.*, users.fullname AS owner_name FROM posts JOIN users ON posts.post_owner = users.id WHERE post_owner = ? ORDER BY posts.post_id DESC";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $post_owner);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $post_owner_name = $row["owner_name"];
        $post_id = $row["post_id"];
        $post_title = $row["post_title"];
        $post_content = $row["post_content"];
        $post_image = $row["post_image"];
        $post_likes = $row["likes"];
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
                <span><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z" />
                    </svg></span>
                <span><?php echo $post_likes; ?> likes</span>
            </div>
        </div>
    <?php } ?>
</div>
<?php include "pages/_footer.php" ?>