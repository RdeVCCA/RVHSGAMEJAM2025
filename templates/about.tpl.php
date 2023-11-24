<section class="about">
    <h2 class="header-section">About</h2>
    <div class="container-sub">
        <div class="container-content center-h order-reverse">
            <div class="carousel fade-right paused">
                <?php
                $active = true;
                foreach ($pastGame["2022"] as $i => $game) {
                    if (!isset($game['thumbnail'])) {
                        continue;
                    }
                    $thumbnail = $game['thumbnail'];
                    ?>
                    <div class="carousel-item <?php if ($active)
                        echo "active" ?>">
                            <img class="carousel-image" src="<?php echo $thumbnail ?>">
                    </div>
                    <?php
                    $active = false;
                } ?>
            </div>
            <div class="container-text fade-left paused">
                <p class="header-content text-align-left">Join the RVHS GameJam! This month-long event by RdeV showcases
                    student creativity in game design. Learn or enhance your programming skills through an exciting
                    gamejam!</p>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="container-sub center-items">
        <video class="center-h fade-bottom paused" id="about-video" controls>
            <source src="static/videos/gamejamvid.mp4" type="video/mp4">
        </video>
        <p class="header-content fade-top paused">What’s a gamejam? A GameJam is a competition where participants create games based on
            a specific theme.</p>
    </div>
</section>