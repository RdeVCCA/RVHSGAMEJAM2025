<link rel="stylesheet" href="static/css/pastGames.css" />
<link rel="stylesheet" href="static/css/shared.css" />

<section id="past-games">
    <h2>All Games</h2>
    <div class="cont-v-ch cont-v-g">
        <?php
        include_once 'backend/pastGames.inc.php';
        $firstYear = null;
        echo '<div class="cont-h cont-h-g cont-nr">';

        // make the year buttons
        foreach ($pastGames as $year => $value) {
            // auto select the first year
            if (!isset($firstYear)) {
                echo "<button class=\"year-button selected\" year=\"$year\">$year</button>";
                $firstYear = $year;
            } else {
                echo "<button class=\"year-button\" year=\"$year\">$year</button>";
            }
        }
        echo '</div>';

        // make the game icons
        $firstGameId = null;
        foreach ($pastGames as $year => $value) {
            // show only the first year's icons
            if ($firstYear === $year) {
                echo "<div class=\"cont-h cont-h-g cont-nr year-div selected\" year=\"$year\">";
            } else {
                echo "<div class=\"cont-h cont-h-g cont-nr year-div\" year=\"$year\">";
            }
            // add the icons
            foreach ($pastGames[$year] as $gameId => $game) {
                if (!isset($firstGameId)) {
                    $firstGameId = $gameId;
                    $logo = $game['logo'];
                    echo "<img class=\"game-button selected\" game-id=\"$gameId\" src=\"$logo\">";
                } else {
                    $logo = $game['logo'];
                    echo "<img class=\"game-button\" game-id=\"$gameId\" src=\"$logo\">";
                }
            }
            echo '</div>';
        }

        // make the game details
        foreach ($pastGames as $year => $value) {
            foreach ($pastGames[$year] as $gameId => $game) {
                if ($gameId === $firstGameId) {
                    echo "<div class=\"cont-v-ch selected\" game-id=\"$gameId\">";
                } else {
                    echo "<div class=\"cont-v-ch\" game-id=\"$gameId\">";
                }
                
                // title
                $title = htmlspecialchars($game['title']);
                echo "<h2>$title</h2>";

                // creators
                $creators = htmlspecialchars($game['creators']);
                echo "<p>by $creators</p>";

                // video/thumbnail
                if (isset($game['video'])) {
                    $videoSrc = $game['video'];
                    echo '<video class="game-video" controls="">';
                    echo "<source src=\"$videoSrc\" type=\"video/mp4\">";
                    echo '</video>';
                } else {
                    $imageSrc = $game['thumbnail'] ?? '';
                    echo "<img class=\"game-thumbnail\" src=\"$imageSrc\">";
                }

                // description
                $description = $game['description'];
                echo "<p>$description</p>";

                // link
                $link = $game['link'];
                echo "<a class=\"anchor-button hover\" target=\"_blank\" href=\"$link\">Visit</a>";

                echo '</div>';
            }
        }
        ?>

    </div>
    <script>
        let yearButtons = document.querySelectorAll(".year-button");
        let selectedYear = document.querySelector(".year-button.selected");
        let yearDivs = document.querySelectorAll(".year-div");

        let gameButtons = document.querySelectorAll(".game-button");
        let selectedGame = document.querySelector(".game-button.selected");
        let gameDivs = document.querySelectorAll("div[game-id]");

        function updateYearDivs() {
            let year = selectedYear.getAttribute("year");
            yearDivs.forEach(elem => {
                if (elem.getAttribute("year") === year) {
                    elem.classList.add("selected");                    
                } else {
                    elem.classList.remove("selected");
                }
            });
        }

        function updateGameDivs() {
            let game = selectedGame.getAttribute("game-id");
            gameDivs.forEach(elem => {
                if (elem.getAttribute("game-id") === game) {
                    elem.classList.add("selected");
                } else {
                    elem.classList.remove("selected");
                }
            });
        }
        
        yearButtons.forEach(elem => {
            elem.addEventListener("click", event => {
                selectedYear.classList.remove("selected");
                selectedYear = event.target;
                selectedYear.classList.add("selected");

                updateYearDivs();
            });
        });

        gameButtons.forEach(elem => {
            elem.addEventListener("click", event => {
                selectedGame.classList.remove("selected");
                selectedGame = event.target;
                selectedGame.classList.add("selected");

                updateGameDivs();
            });
        })
    </script>
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
