<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>

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

    <div class="row">
        <div class="col">

        statisticsss


        </div>
    </div>
</div>

<?php include "pages/_footer.php" ?>