<?php
require_once 'backend/Defaults/connect.php';
// handle POST requests from the 2 forms below
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userEmail'])) {
    $gameId = $_GET['gameId'];
    $userEmail = $_SESSION['userEmail'];
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
        if ($ratingExist) {
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
