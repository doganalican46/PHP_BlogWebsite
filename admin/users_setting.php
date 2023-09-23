<?php $customTitle = "Users Setting"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>
<?php include "../database/db_connection.php"; ?>


<?php
if (isset($_POST["delete_userbtn"])) {
    $user_id = $_POST["user_id"];

    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connection, $deleteQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: users_setting.php");
            exit();
        } else {
            echo "Error deleting account: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error creating prepared statement: " . mysqli_error($connection);
    }
}


?>


<?php
$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);
?>
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <form action="addnewuser.php" method="post">
                        <h1>User List <button class="btn btn-primary float-end" type="submit">Add New User</button></h1>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['fullname']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['user_role']; ?></td>
                                    <td>
                                        <form action="" method="post" onsubmit="return confirmDelete();">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <button type="submit" name="delete_userbtn" class="btn btn-danger mb-1">Delete</button>
                                        </form>

                                        <form action="update_user.php" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <button class="btn btn-primary" type="submit" name="edit_userbtn">Edit</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <!-- <button class="btn btn-primary">Print</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this account?");
    }
</script>









<?php include "pages/_footer.php" ?>