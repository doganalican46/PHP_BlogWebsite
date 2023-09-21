<?php $customTitle = "Profile Page"; ?>
<?php include "database/db_connection.php"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>

<?php
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $fullname = $user['fullname'];
        $email = $user['email'];
        $image = $user['image'];
    }
}

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4">
            <div class="image">
                <img src="<?php echo $image; ?>" alt="Profile Image..." name="pp">
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h1><?php echo $fullname; ?></h1>
                </div>
                <div class="card-body">
                    <p>
                        Name: <?php echo $fullname; ?><br>
                        E-Mail: <?php echo $email; ?><br>
                    </p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "pages/_footer.php" ?>