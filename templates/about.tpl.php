<section id="about">
    <link rel="stylesheet" href="static/css/about.css?<?php echo time(); ?>" />
    <h2>About</h2>
    <div class="cont-v-cv cont-v-g">
        <div class="cont-h-dh cont-h-g">
            <p id="about-text">
                Join the RVHS Gamejam! This holiday-long event by <b>RdeV</b> showcases
                student creativity in <b>game design</b>.
                <b>Learn or enhance</b> your programming skills with your friends
                through an exciting <b>game jam</b>!
            </p>
            <div id="carousel">
                <?php
                include_once 'backend/pastGames.inc.php';
                foreach ($pastGames as $year => $games) {
                    foreach ($games as $i => $game) {
                        if (!isset($game['logo'])) {
                            continue;
                        }
                        $thumbnail = $game['logo'];
                    ?>
                    <img class="carousel-image" src="<?php echo $thumbnail ?>">
                    <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="cont-v-cv">
            <video id="about-video" controls>
                <source src="static/videos/gamejamvid.mp4" type="video/mp4">
            </video>
            <p>
                What’s a game jam? A game jam is a <b>competition</b>
                where participants create games based on <b>a specific theme</b>.
            </p>
        </div>
    </div>
    <script>
        const carousel = document.getElementById("carousel");
        let displayedIndex = 0;
        carousel.children[0].classList.add("active");
        setInterval(() => {
            carousel.children[displayedIndex].classList.remove("active");
            displayedIndex = (displayedIndex + 1) % carousel.children.length;
            carousel.children[displayedIndex].classList.add("active");
        }, 3000);
    </script>
</section>
