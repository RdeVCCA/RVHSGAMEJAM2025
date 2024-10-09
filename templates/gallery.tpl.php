        <link rel = "stylesheet" href = "static/css/gallery.css">
        <!-- <script src = "static/js/library/gallery.js"></script> -->
    </head>
    
    <body>    
        <?php
            include "templates/navbar.tpl.php";
            include "backend/pastGames.inc.php";
        ?>
        <h1>Last Gamejam's Games</h1>
        <div id = "appendGames">
            <?php
            // sql query to select games from previous year only
            $sql = 'SELECT name, description, genre, creators, link, year FROM pastgames WHERE year = (SELECT MAX(year) FROM pastgames)';
            $games = ($conn->query($sql))->fetch_all();
            foreach ($games as $game) {
                $name = $game[0];
                $desc = $game[1];
                $genre = $game[2];
                $creators = $game[3];
                $link = $game[4];
                $year = $game[5];
                $thumbnail = convertToFileLink($name, $year, 1);
                echo "<div id='appendGame'>";
                    echo "<a class='game-logo-container' href='$link'><img id='gameLogo' class='grid' src='$thumbnail'></a>";
                    echo "<span id='name' class='grid'>$name</span>";
                    echo "<span id='creator' class='grid'>$creators</span>";
                    echo "<span id='genre' class='grid'>$genre</span>";
                echo "</div>";
            }
            ?>
        </div>
    </body>
<html>
