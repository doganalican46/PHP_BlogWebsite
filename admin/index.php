<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>
<?php include "../database/db_connection.php" ?>


<div class="container mt-5 mb-5">
    <?php
    if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
        header("Location: ../login.php");
        exit();
    }
    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
        $fullname = $_SESSION['auth_user'];
        echo '<h1>Hello admin ' . $fullname . ',</h1>';
    }
    ?>

    <div class="row mt-5">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Users

                    <?php
                    $query = "SELECT * FROM users";
                    $query_run = mysqli_query($connection, $query);
                    if ($total_users = mysqli_num_rows($query_run)) {
                        echo '<h4 class="mb-0">' . $total_users . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">No Data</h4>';
                    }
                    ?>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="users_setting.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>



        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Total Admin
                    <?php
                    $query = "SELECT * FROM users WHERE user_role='1'";
                    $query_run = mysqli_query($connection, $query);
                    if ($total_admin = mysqli_num_rows($query_run)) {
                        echo '<h4 class="mb-0">' . $total_admin . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">No Data</h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="users_setting.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Posts
                    <?php
                    $query = "SELECT * FROM posts";
                    $query_run = mysqli_query($connection, $query);
                    if ($total_posts = mysqli_num_rows($query_run)) {
                        echo '<h4 class="mb-0">' . $total_posts . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">No Data</h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="posts.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Posts waiting for approve
                    <?php
                    $query = "SELECT status FROM posts WHERE status=0";
                    $query_run = mysqli_query($connection, $query);
                    if ($unvisible_posts = mysqli_num_rows($query_run)) {
                        echo '<h4 class="mb-0">' . $unvisible_posts . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">No Data</h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="posts.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Approved posts
                    <?php
                    $query = "SELECT status FROM posts WHERE status=1";
                    $query_run = mysqli_query($connection, $query);
                    if ($visible_posts = mysqli_num_rows($query_run)) {
                        echo '<h4 class="mb-0">' . $visible_posts . '</h4>';
                    } else {
                        echo '<h4 class="mb-0">No Data</h4>';
                    }
                    ?>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="posts.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>


    </div>
</div>

<?php include "pages/_footer.php" ?>