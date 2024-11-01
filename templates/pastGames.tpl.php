<link rel="stylesheet" href="static/css/pastGames.css" />
<link rel="stylesheet" href="static/css/shared.css" />

<section id="past-games">
    <h2>All Games</h2>
    <div>
        <?php
            include_once 'backend/pastGames.inc.php';
            $first = true;
            foreach ($pastGames as $year => $value) {
                ?>
                <div class="cont-h">
                <?php
                    if ($first) {
                        echo "<button class='select-year' data-selected='true'>$year</button>";
                        $first = false;
                    } else {
                        echo "<button class='select-year'>$year</button>";
                    }
                ?>
                </div>
                <div class="cont-h">
                    <?php
                        foreach ($pastGames[$year] as $gameId => $game) {
                            ?>
                            <img class="select-game" src="<?php echo $game['logo'] ?>">
                            <?php
                        }
                    ?>
                </div>
                <?php
            }
        ?>
    </div>
</section>

<!--
<div class="past-games">
    <div class="select-game-container">
        <input type="image" class="select-game" data-selected="true"/>
    </div>
    <div class="game-details-container">
        <h3 class="game-title">Game Title</h3>
        <div class="game-showcase">
            <img class="game-image" />
            <video class="game-video" controls>
                <source src="" type="video/mp4">
            </video>
        </div>
        <button class="game-visit">Visit</button>
        <p class="game-description">
            <span class ='description'></span>
        </p>
    </div>
</div>
<script defer src="static/js/pastGames.js"></script>
-->
