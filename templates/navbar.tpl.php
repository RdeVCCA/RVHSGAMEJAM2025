<nav class="navbar">
    <link rel="stylesheet" href="static/css/navbar.css">
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
    <a class="navbar-item" href="/" target="_blank">
        <img class="navbar-logo" src="static/img/rdev.webp" alt="RdeV Website"> 
    </a>
    <a class="navbar-item <?php if ($currentPage === 'index') { echo 'active'; } ?>" href="index.php">
        Home
    </a>
    <a class="navbar-item <?php if ($currentPage === 'gallery') { echo 'active'; } ?>" href="index.php?filename=gallery">
        Last Gamejam's Games
    </a>
    <a class="navbar-item <?php if ($currentPage === 'login') { echo 'active'; } ?>" href="index.php?filename=login">
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
