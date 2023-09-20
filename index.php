<?php
session_start();
if (isset($_SESSION["message"])) {
    echo "<div class='alert alert-danger mb-0 text-center'> " . $_SESSION["message"] . "</div>";
    unset($_SESSION["message"]);
}

?>

<?php include "pages/_header.php" ?>
<?php include "pages/_navbar.php" ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-8">
            <h2>TITLE HEADING</h2>
            <h5>Title description, Dec 7, 2020</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
    </div>
</div>

<?php include "pages/_footer.php" ?>