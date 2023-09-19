<?php $customTitle = "Profile Page"; ?>
<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4">
            <div class="image">
                <img src="" alt="Profile Image..." name="pp">
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h1> Username </h1>
                </div>
                <div class="card-body">
                    <p>

                        Name: <br>
                        Surname: <br>
                        Phone: <br>
                        E-Mail: <br>
                        About: <br>

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