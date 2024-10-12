<nav class="header">
    <?php
    if (!isset($_GET['filename'])) {
        $currentPage = 'index';
    } else {
        switch ($_GET['filename']) {
            case 'gallery':
                $currentPage = 'gallery';
            break;

            case 'login':
                $currentPage = 'login';
            break;

            case 'game':
                $currentPage = 'game';
            break;
        }
    }
    ?>
    <a class="header-item" href="https://rdev.x10.mx" target="_blank">
        <img class="header-logo" src="static/img/rdev.webp" alt="RdeV Website"> 
    </a>
    <a class="header-item <?php if ($currentPage === 'index') { echo 'active'; } ?>" href="index.php">
        Home
    </a>
    <a class="header-item <?php if ($currentPage === 'gallery') { echo 'active'; } ?>" href="index.php?filename=gallery">
        Last Gamejam's Games
    </a>
    <a class="header-item <?php if ($currentPage === 'login') { echo 'active'; } ?>" href="index.php?filename=login">
        <?php
        if (isset($_SESSION['userPicture'])) {
            $userPicture = $_SESSION['userPicture'];
            echo "<img class='navbar-profile-picture' src='$userPicture'>";
        } else {
            echo 'Login';
        }
        ?>
    </a>
</nav>
