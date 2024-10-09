<nav class="header">
    <p class="header-item">
        <?php echo $_GET['page']; ?>
    </p>
    <a class="header-item" href="https://rdev.x10.mx" target="_blank">
        <img class="header-logo" src="static/img/rdev.webp" alt="RdeV Website"> 
    </a>
    <a class="header-item <?php if (!isset($_GET['filename'])) { echo 'active'; } ?>" href="index.php">
        Home
    </a>
    <a class="header-item <?php if ($_GET['filename'] == 'gallery') { echo 'active'; } ?>" href="index.php?filename=gallery">
        Last Gamejam's Games
    </a>
</nav>
