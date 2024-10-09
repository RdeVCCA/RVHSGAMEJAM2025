        <link rel = "stylesheet" href = "static/css/game.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&Josefin+Sans&display=swap" rel="stylesheet">
        <script src = "static/js/game.js"></script>
    </head>


    <body>
        <?php
            include 'templates/navbar.tpl.php';
            include 'backend/pastGames.inc.php';
            $gameId = $_GET['gameId'];

            $gameSql = 'SELECT name, description, genre, creators, link, trailer, year FROM pastgames WHERE gameId = ?';
            $gamePrepared = $conn->prepare($gameSql);
            $gamePrepared->bind_param('i', $gameId);
            $gamePrepared->execute();
            $gamePrepared->bind_result($name, $desc, $genre, $creators, $link, $trailer, $year);
            $gamePrepared->fetch();
            $gamePrepared->free_result();

            $thumbnail = convertToFileLink($name, $year, 1);

            $commentSql = 'SELECT pfp, username, `comment` FROM comments LEFT JOIN users ON comments.userId = users.userId WHERE gameId = ?';
            $commentPrepared = $conn->prepare($commentSql);
            $commentPrepared->bind_param('i', $gameId);
            $commentPrepared->execute();
            $commentPrepared->bind_result($pfp, $username, $comment);
            $comments = [];
            while ($commentPrepared->fetch()) {
                $comments[] = [
                        'pfp' => $pfp,
                        'username' => $username,
                        'comment' => $comment,
                    ];
            }
            $commentPrepared->free_result();
        ?>
        <div class="center">
            <div id='Header'>
                <h1><?php echo $name ?></h1>
                <div><?php echo $genre ?></div>
                <div>Created by <?php echo $creators ?></div>
            </div>
            
            <div id='game-carousel'>
                <a href='index.php?filename=game&gameId=1'><div id='startArrow'>&#x2190;</div></a>
                <?php
                if ($trailer) {
                    ?>
                    <iframe width='560' height='315' src='<?php echo $trailer ?>'></iframe>
                    <?php
                } else {
                    ?>
                    <img class='thumbnail' src='<?php echo $thumbnail ?>'>
                    <?php
                }
                ?>
                <a href='index.php?filename=game&gameId=1'><div id='endArrow'>&#x2192;</div></a>
            </div>

            <a href="<?php echo $link ?>">
                <div id="gameButton">Play Game</div>
            </a>
        </div>
        
        <div id='Description'><?php echo $desc ?></div>
        
        <div class = "margin">
            <form action = 'index.php?filename=game&game=$gameId&PV=$PV_index' method = 'POST'>
                <h2>Rate</h2>
                <img src = "static/img/star.png" class = "Stars" id = "Star1" onmouseover="highlightStar(1)" onmouseout="unhighlightStar(1)" onclick="permanentHighlight(1), calculateRatings(1)">
                <img src = "static/img/star.png" class = "Stars" id = "Star2" onmouseover="highlightStar(2)" onmouseout="unhighlightStar(2)" onclick="permanentHighlight(2), calculateRatings(2)">
                <img src = "static/img/star.png" class = "Stars" id = "Star3" onmouseover="highlightStar(3)" onmouseout="unhighlightStar(3)" onclick="permanentHighlight(3), calculateRatings(3)">
                <img src = "static/img/star.png" class = "Stars" id = "Star4" onmouseover="highlightStar(4)" onmouseout="unhighlightStar(4)" onclick="permanentHighlight(4), calculateRatings(4)">
                <img src = "static/img/star.png" class = "Stars" id = "Star5" onmouseover="highlightStar(5)" onmouseout="unhighlightStar(5)" onclick="permanentHighlight(5), calculateRatings(5)">
                <div class = "ratings"> 
                    <div id = "Criteria1">Relatedness to Theme</div>
                    <div id = "Theme">
                        <img src = "static/img/star.png" class = "Star" id = "Star6" onmouseover="highlightStar(6)" onmouseout="unhighlightStar(6)" onclick=" permanentHighlight(6), calculateRatings(1)">
                        <img src = "static/img/star.png" class = "Star" id = "Star7" onmouseover="highlightStar(7)" onmouseout="unhighlightStar(7)" onclick="permanentHighlight(7), calculateRatings(2)">
                        <img src = "static/img/star.png" class = "Star" id = "Star8" onmouseover="highlightStar(8)" onmouseout="unhighlightStar(8)" onclick="permanentHighlight(8), calculateRatings(3)">
                        <img src = "static/img/star.png" class = "Star" id = "Star9" onmouseover="highlightStar(9)" onmouseout="unhighlightStar(9)" onclick="permanentHighlight(9), calculateRatings(4)">
                        <img src = "static/img/star.png" class = "Star" id = "Star10" onmouseover="highlightStar(10)" onmouseout="unhighlightStar(10)" onclick="permanentHighlight(10), calculateRatings(5)">
                    </div>
                    <div id = "Criteria2">Aesthetic</div>
                    <div id = "Aesthetic">
                        <img src = "static/img/star.png" class = "Star" id = "Star11" onmouseover="highlightStar(11)" onmouseout="unhighlightStar(11)" onclick="permanentHighlight(11), calculateRatings(1)">
                        <img src = "static/img/star.png" class = "Star" id = "Star12" onmouseover="highlightStar(12)" onmouseout="unhighlightStar(12)" onclick="permanentHighlight(12), calculateRatings(2)">
                        <img src = "static/img/star.png" class = "Star" id = "Star13" onmouseover="highlightStar(13)" onmouseout="unhighlightStar(13)" onclick="permanentHighlight(13), calculateRatings(3)">
                        <img src = "static/img/star.png" class = "Star" id = "Star14" onmouseover="highlightStar(14)" onmouseout="unhighlightStar(14)" onclick="permanentHighlight(14), calculateRatings(4)">
                        <img src = "static/img/star.png" class = "Star" id = "Star15" onmouseover="highlightStar(15)" onmouseout="unhighlightStar(15)" onclick="permanentHighlight(15), calculateRatings(5)">
                    </div>
                    <div id = "Criteria3">Fun</div>
                    <div id = "Fun">
                        <img src = "static/img/star.png" class = "Star" id = "Star16" onmouseover="highlightStar(16)" onmouseout="unhighlightStar(16)" onclick="permanentHighlight(16), calculateRatings(1)">
                        <img src = "static/img/star.png" class = "Star" id = "Star17" onmouseover="highlightStar(17)" onmouseout="unhighlightStar(17)" onclick="permanentHighlight(17), calculateRatings(2)">
                        <img src = "static/img/star.png" class = "Star" id = "Star18" onmouseover="highlightStar(18)" onmouseout="unhighlightStar(18)" onclick="permanentHighlight(18), calculateRatings(3)">
                        <img src = "static/img/star.png" class = "Star" id = "Star19" onmouseover="highlightStar(19)" onmouseout="unhighlightStar(19)" onclick="permanentHighlight(19), calculateRatings(4)">
                        <img src = "static/img/star.png" class = "Star" id = "Star20" onmouseover="highlightStar(20)" onmouseout="unhighlightStar(20)" onclick="permanentHighlight(20), calculateRatings(5)">
                    </div>
                    <input type = 'hidden' id = 'currentRatings' name = 'R'>
                    <button class = 'submit' type = 'submit'>Submit ratings</button>
                </div>
            </form>
                <h2>Comments</h2>
                <label for = "commentInput">Create a comment:</label>
                <textarea placeholder = "Enter a comment" id = "commentInput" name = "comment"></textarea>
                <button class = 'submit' type = 'submit'>Add Comment</button>
            </form>
            <div class="comment-container">
                <?php
                foreach ($comments as $comment) {
                    ?>
                    <div class="comment">
                        <div class="commenter">
                            <img class='pfp' src='<?php echo $comment['pfp']?>'>
                            <div><?php echo $comment['username'] ?></div>
                        </div>
                        <div><?php echo $comment['comment'] ?></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>

<!-- Database instructions
comments(Id, UserEmail, comment, GameName)
*Identify comment through unique id
*Identify the person who gave the comment to retrieve pfp and username
*Identify comment to append to page
*Identify GameName to append to the correct game page

games(Id, Thumbnail, GameName, Author, Genre, Descriptions, GameFiles, Trailer)
*Identify game through unique id
*Identify Thumbnail to append to page
*Identify GameName to append to page
*Identify Author to append to page
*Identify Genre to append to papge
*Identify Descriptions to append to page
*Identify GameFiles for downloading when press 'play game'
*Includes Trailer and pictures of gameplay to append on game page

ratings(Id, userEmail, GameName, MainRating, ThemeRating, AestheticRating, FunRating
*Identify ratings through unique id
*Identify who gave the rating to save their rating on the page when they login
*Identify GameName to know which gamepage to save the rating at
*Identify MainRating to save the rating on page and calculate average rating
*Identify ThemeRating to save the rating on page and calculate average theme rating
*Identify AestheticRating to save the rating on page and calculate average aesthetic rating
*Identify FunRating to save the rating on page and calculate average fun rating

users(UserEmail, username, pfp)
*Identify a user based on their email
*Username is used for referring to a user on the page and to append to page
*Identify pfp to append to comment section-->
