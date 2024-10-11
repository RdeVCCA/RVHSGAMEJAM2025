<?php
include 'backend/gameFileUtils.inc.php';
include 'backend/Defaults/connect.php';

$pastGamesRaw = sqlQueryAllObjects(
    $conn,
    'SELECT * FROM pastgames ORDER BY year DESC'
);

$pastGames = [];
foreach ($pastGamesRaw as $game) {
    $year = $game->year;
    $gameInfo = [
        'title' => $game->name,
        'link' => $game->link,
        'description' => $game->description,
        'creators' => $game->creators
    ];
    $logo = convertToFileLink($game->name, $year, 2); // get logo
    if (file_exists($logo)) {
        $gameInfo['logo'] = $logo;
    }
    $video = convertToFileLink($game->name, $year, 0); // get video
    if (file_exists($video)) {
        $gameInfo['video'] = $video;
    }
    $thumbnail = convertToFileLink($game->name, $year, 1); // get thumbnail
    if (file_exists($thumbnail)) {
        $gameInfo['thumbnail'] = $thumbnail;
    }
    
    // if (!isset($pastGame[$year])){
    //     $pastGame[$year] = [];
    // }

    $pastGames[$year][$game->gameId] = $gameInfo;
}
?>
