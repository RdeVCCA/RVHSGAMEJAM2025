        <link rel = "stylesheet" href = "static/css/game.css">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&Josefin+Sans&display=swap" rel="stylesheet">
        <script src = "static/js/game.js"></script>
    </head>

    <body>
        <?php
            include 'templates/navbar.tpl.php';
            include 'backend/gameFileUtils.inc.php';
            include 'templates/stars.tpl.php';
            include 'backend/Defaults/connect.php';

            // there are 2 parts to this chunk of php:
            // the first chunk gets game info and displays it to the user
            // the second chunk runs on the server and handles POST requests for ratings

            $gameId = $_GET['gameId'];
            $userEmail = $_SESSION['userEmail'];

            // get game info
            $gameInfo = sqlQueryObject(
                $conn,
                'SELECT name, description, genre, creators, link, trailer, year FROM pastgames WHERE gameId = ?',
                [$gameId]
            );

            $thumbnail = convertToFileLink($gameInfo->name, $gameInfo->year, 1);

            $thumbnailExists = file_exists($thumbnail);
            $trailerExists = isset($gameInfo->trailer);

            // get comment info
            $commentInfo = sqlQueryAllObjects(
                $conn,
                'SELECT pfp, username, `comment` FROM comments LEFT JOIN users ON comments.userId = users.userId WHERE gameId = ?',
                [$gameId]
            );

            // handle POST requests from the 2 forms below
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $userId = sqlQueryObject(
                    $conn,
                    'SELECT userId FROM users WHERE email = ?',
                    [$userEmail]
                )->userId;

                // check if the POST request is for ratings
                $ratingOverall = $_POST['rating-overall'];
                $ratingRelated = $_POST['rating-related'];
                $ratingAesthetic = $_POST['rating-aesthetic'];
                $ratingFun = $_POST['rating-fun'];
                
                if (
                    isset($ratingOverall) && isset($ratingRelated) && isset($ratingAesthetic) && isset($ratingFun)
                    && $ratingOverall >= 1 && $ratingRelated >= 1 && $ratingAesthetic >= 1 && $ratingFun >= 1
                    && $ratingOverall <= 5 && $ratingRelated <= 5 && $ratingAesthetic <= 5 && $ratingFun <= 5
                ) {
                    // check if the user has already rated
                    $ratingExist = isset(
                        sqlQueryObject(
                            $conn,
                            'SELECT Id FROM ratings WHERE userId = (SELECT userId FROM users WHERE email = ?) AND gameId = ?',
                            [$userEmail, $gameId]
                        )
                        ->userId
                    );
                    // if a previous rating exists we overwrite that rating,
                    // if not we make a new rating
                    if (isset($ratingExist)) {
                        sqlQueryObject(
                            $conn,
                            'UPDATE ratings SET MainRating = ?, ThemeRating = ?, AestheticRating = ?, FunRating = ? WHERE userId = ? AND gameId = ?',
                            [$ratingOverall, $ratingRelated, $ratingAesthetic, $ratingFun, $userId, $gameId]
                        );
                    } else {
                        sqlQueryObject(
                            $conn,
                            'INSERT INTO ratings(userId, gameId, MainRating, ThemeRating, AestheticRating, FunRating) VALUES (?, ?, ?, ?, ?, ?)',
                            [$userId, $gameId, $ratingOverall, $ratingRelated, $ratingAesthetic, $ratingFun]
                        );
                    }
                    // redirect to prevent resending form data when the user refreshes the page
                    header("Location: index.php?filename=game&gameId=$gameId");
                    die();
                }

                // check if the POST request is for comments
                $comment = $_POST['comment'];
                if (isset($comment) && $comment !== '' && strlen(trim($comment)) !== 0) {
                    sqlQueryObject(
                        $conn,
                        'INSERT INTO comments(userId, comment, gameId) VALUES (?, ?, ?)',
                        [$userId, $comment, $gameId]
                    );
                }
                // redirect to prevent resending form data when the user refreshes the page
                header("Location: index.php?filename=game&gameId=$gameId");
                die();
            }
        ?>
        <div class="center">
            <div id='Header'>
                <h1><?php echo htmlspecialchars($gameInfo->name) ?></h1>
                <div><?php echo htmlspecialchars($gameInfo->genre) ?></div>
                <div>Created by <?php echo htmlspecialchars($gameInfo->creators) ?></div>
            </div>
            
            <div id='game-carousel'>
                <?php
                // show arrows only if both trailer and thumbnail exist
                if ($trailerExists && $thumbnailExists) {
                    ?>
                    <a href='javascript:void(0)' onclick='update()'><div id='startArrow'>&#x2190;</div></a>
                    <?php
                }
                
                if ($trailerExists) {
                    ?>
                    <iframe id='trailer' class='thumbnail' src='<?php echo $gameInfo->trailer ?>'></iframe>
                    <?php
                }
                if ($thumbnailExists) {
                    ?>
                    <img id='thumbnail' class='thumbnail' src='<?php echo $thumbnail ?>'>
                    <?php
                }
                
                // show arrows only if both trailer and thumbnail exist
                if ($trailerExists && $thumbnailExists) {
                    ?>
                    <a href='javascript:void(0)' onclick='update()'><div id='endArrow'>&#x2192;</div></a>

                    <!-- js to make the arrows functional -->
                    <script>
                    let trailer = document.getElementById("trailer");
                    let thumbnail = document.getElementById("thumbnail");
                    let leftArrow = document.getElementById("startArrow");
                    let rightArrow = document.getElementById("endArrow");
                
                    let trailerSelected = true;

                    function update() {
                        if (trailerSelected) {
                            leftArrow.style.display = "none";
                            thumbnail.style.display = "none";
                            rightArrow.style.display = "unset";
                            trailer.style.display = "unset";
                        } else {
                            leftArrow.style.display = "unset";
                            thumbnail.style.display = "unset";
                            rightArrow.style.display = "none";
                            trailer.style.display = "none";
                        }
                        trailerSelected = !trailerSelected;
                    }

                    update();
                    </script>
                    <?php
                }
                ?>
            </div>

            <a href="<?php echo $gameInfo->link ?>">
                <div id="gameButton">Play Game</div>
            </a>
        </div>
        
        <div id='Description'><?php echo $gameInfo->description ?></div>
        
        <div class = "margin">
            <?php
            if (isset($_SESSION['userEmail'])) {
                ?>
                <!-- review form -->
                <form action='<?php echo "index.php?filename=game&gameId=$gameId" ?>' method='POST'>
                    <h2>Rate</h2>
                    <?php
                    $rating = sqlQueryObject(
                        $conn,
                        'SELECT MainRating main, ThemeRating related, AestheticRating aesthetic, FunRating fun FROM ratings WHERE userId = (SELECT userId FROM users WHERE email = ?) AND gameId = ?',
                        [$userEmail, $gameId]
                    );
                    ?>
                    <div class="ratings"> 
                        <b>Overall</b>
                        <div id="overall">
                            <!-- name=rating-overall -->
                            <?php makeNewRating('overall', $rating->main) ?>
                        </div>
                        Relatedness to Theme
                        <div id="related">
                            <!-- name=rating-related -->
                            <?php makeNewRating('related', $rating->related) ?>
                        </div>
                        Aesthetic
                        <div id="aesthetic">
                            <!-- name=rating-aesthetic -->
                            <?php makeNewRating('aesthetic', $rating->aesthetic) ?>
                        </div>
                        Fun
                        <div id="fun">
                            <!-- name=rating-fun -->
                            <?php makeNewRating('fun', $rating->fun) ?>
                        </div>
                    </div>
                    <button class='submit' type='submit'>Submit ratings</button>
                </form>

                <!-- comment form -->
                <form action='<?php echo "index.php?filename=game&gameId=$gameId" ?>' method='POST'>
                    <h2>Comment</h2>
                    <label for="commentInput">Create a comment:</label>
                    <!-- name=comment -->
                    <textarea placeholder="Enter a comment" id="commentInput" name="comment"></textarea>
                    <button class='submit' type='submit'>Add comment</button>
                </form>
                <?php
            } else {
                ?>
                <div class='login-notice'><b>You must log in to leave a review.</b></div>
                <?php
            }
            ?>

            <!-- show all comments -->
            <h2>All Comments</h2>
            <div class="comment-container">
                <?php
                foreach ($commentInfo as $comment) {
                    // hide blank comments because for some reason there are a ton of them in the database
                    // TODO: hide whitespace comments also (comments that are made of spaces)
                    if ($comment->comment === '' || strlen(trim($comment->comment)) === 0) { continue; }
                    ?>
                    <div class="comment">
                        <div class="commenter">
                            <img class='pfp' src='<?php echo $comment->pfp ?>'>
                            <div><?php echo htmlspecialchars($comment->username) ?></div>
                        </div>
                        <div><?php echo htmlspecialchars($comment->comment) ?></div>
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
