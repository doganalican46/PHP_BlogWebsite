<?php

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $fullname = $_SESSION['auth_user'];
}
$current_url = $_SERVER['REQUEST_URI'];

?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link<?php echo (strpos($current_url, 'discover.php') !== false) ? ' active' : ''; ?>" href="discover.php">Discover</a>
            </li>

            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) : ?>
                <li class="nav-item">
                    <a class="nav-link<?php echo (strpos($current_url, 'index.php') !== false) ? ' active' : ''; ?>" href="index.php">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php echo (strpos($current_url, 'profile.php') !== false) ? ' active' : ''; ?>" href="profile.php"><?php echo $fullname; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </li>

            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link<?php echo (strpos($current_url, 'login.php') !== false) ? ' active' : ''; ?>" href="login.php">Log In</a>
                </li>

            <?php endif; ?>

        </ul>
    </div>
</nav>