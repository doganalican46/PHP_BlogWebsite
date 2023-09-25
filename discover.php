<?php $customTitle = "Discover"; ?>

<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>
<?php include "database/db_connection.php" ?>

<div class="container mt-5 mb-5">

    <?php
    $query = "SELECT posts.*, users.fullname AS owner_name FROM posts JOIN users ON posts.post_owner = users.id ORDER BY posts.post_id DESC";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $post_owner_name = $row["owner_name"];
        $post_title = $row["post_title"];
        $post_content = $row["post_content"];
        $post_image = $row["post_image"];
        $post_likes = $row["likes"];
        $created_at = $row["created_at"];
        $status = $row["status"]; 

        if ($status == 1) {
    ?>
            <div class="card post-card mt-5">
                <div class="card-header">
                    <h3><?php echo $post_title; ?></h3>
                    <hr>
                    <h6>Post owner: <?php echo $post_owner_name; ?></h6>
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
                    <i class="fas fa-heart like-btn"></i>
                    <span class="like-count"><?php echo $post_likes; ?></span>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>


<?php include "pages/_footer.php" ?>