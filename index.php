<?php
header('Strict-Transport-Security: max-age=63072000; includeSubDomains; preload');
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Content-Security-Policy: worker-src https:');

include('templates/defaults/header.tpl.php');

include('templates/home.tpl.php');

include('templates/defaults/end.tpl.php');

?>