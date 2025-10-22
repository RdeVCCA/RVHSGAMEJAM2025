<?php
    require_once 'Private\rvhsgamejam_secrets.inc.php';
    require_once 'backend/Defaults/connect.php';
    require_once 'includes/google-api-php-client--PHP7.4/vendor/autoload.php';
    
    // $redirectUri = 'http://localhost/RVHSGAMEJAM2025/index.php?filename=login';
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

        // DO NOT attempt to merge the next 2 lines into one, because `end()` NEEDS parameters passed by reference!
        // https://stackoverflow.com/questions/4636166/only-variables-should-be-passed-by-reference
        $exploded = explode(' ', rtrim($userName, ' '));
        $lastExploded = end($exploded);
        $fromRvhs = strtoupper($lastExploded) === '(RVHS)';

        $_SESSION['userEmail'] = $userEmail;
        $_SESSION['userPicture'] = $userPicture;

        // add user to database if user isn't already inside
        $userExist = sqlQueryObject(
            $conn,
            'SELECT userId FROM users WHERE email = ?',
            [$userEmail]
        ) !== null;

        if (!$userExist) {
            if (($googleInfo['hd'] == 'students.edu.sg' && $fromRvhs) || $googleInfo['hd'] == 'moe.edu.sg') {
                // account is RVHS, put on whitelist
                sqlQueryObject(
                    $conn,
                    'INSERT INTO users(email, username, pfp, whitelisted) VALUES (?, ?, ?, ?)',
                    [$userEmail, $userName, $userPicture, 1]
                );
            } else {
                $_SESSION['accountRestricted'] = true;
                sqlQueryObject(
                    $conn,
                    'INSERT INTO users(email, username, pfp, whitelisted) VALUES (?, ?, ?, ?)',
                    [$userEmail, $userName, $userPicture, 0]
                );
            }
        } else {
            // user exists, now check if it's whitelisted. if it isn't, we set $_SESSION['accountRestricted'] = true
            $userRestricted = sqlQueryObject(
                $conn,
                'SELECT whitelisted FROM users WHERE email = ?',
                [$userEmail]
            )->whitelisted == 0;
            if ($userRestricted) {
                $_SESSION['accountRestricted'] = true;
            }
        }

        header('Location: index.php');
    } else {
        header("Location: $googleUrl");
        die();
    }
?>
