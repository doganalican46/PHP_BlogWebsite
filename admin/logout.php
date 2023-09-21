<?php
session_start();
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    session_unset();
    session_destroy();
    unset($_SESSION["auth"]);
    header("Location: ../discover.php");
    exit();
} else {
    header("Location: ../discover.php");
    exit();
}
