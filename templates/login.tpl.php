<?php
    include '../../../private/rvhsgamejam_secrets.inc.php';
    include 'backend/Defaults/connect.php';
    require_once 'includes/google-api-php-client--PHP7.4/vendor/autoload.php';
    
    // $redirectUri = 'http://localhost/RVHSGAMEJAM2024/index.php?filename=login';
    // $redirectUri = 'https://rvhsgamejam.x10.mx/index.php?filename=login';

    $client = new Google_Client();
    $client->setClientId(GOOGLE_CLIENT_ID);
    $client->setClientSecret(GOOGLE_CLIENT_SECRET);
    $client->setRedirectUri(GOOGLE_REDIRECT_URI);
    $client->addScope("email");
    $client->addScope("profile");
    $googleUrl = $client->createAuthUrl();

    // check if we are coming back from the Google login
    // if yes, then this is true
    if (isset($_GET['code'])) {
        // reset session variables
        session_destroy();
        session_start();

        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            header("Location: index.php");
            die();
        }
        $client->setAccessToken($token);
        $gAuth = new Google_Service_Oauth2($client);
        $googleInfo = $gAuth->userinfo->get();

        $userEmail = $googleInfo->email;
        $userName = $googleInfo->name;
        $userPicture = $googleInfo->picture;

        $lastExploded = end(explode(' ', rtrim($userName, ' ')));
        $fromRvhs = strtoupper($lastExploded) === '(RVHS)';

        if (($googleInfo['hd'] == 'students.edu.sg' && $fromRvhs) || $googleInfo['hd'] == 'moe.edu.sg') {
            $_SESSION['userEmail'] = $userEmail;
            $_SESSION['userPicture'] = $userPicture;

            // add user to database if user isn't already inside
            $userExist = sqlQueryObject(
                $conn,
                'SELECT userId FROM users WHERE email = ?',
                [$userEmail]
            )->userId;

            if (!isset($userExist)) {
                sqlQueryObject(
                    $conn,
                    'INSERT INTO users(email, username, pfp) VALUES (?, ?, ?)',
                    [$userEmail, $userName, $userPicture]
                );
            }
        } else {
            $_SESSION['loginNotAllowed'] = true;
        }
        header('Location: index.php');
    } else {
        header("Location: $googleUrl");
        die();
    }
?>
