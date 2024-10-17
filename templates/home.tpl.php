    <!--
    <link rel="stylesheet" href="static/css/hero.css?<?php echo time(); ?>" />
    <link rel="stylesheet" href="static/css/about.css?<?php echo time(); ?>" />
    -->
    <link rel="stylesheet" href="static/css/components.css" />
    <link rel="stylesheet" href="static/css/home.css" />
</head>

<body style="height: 100%;">
    <!-- this file is only for the content that comes after the past games section -->
    <?php
        include_once 'backend/pastGames.inc.php';
        include "templates/navbar.tpl.php";
        include "templates/hero.tpl.php";
        // include "templates/about.tpl.php";
        include "templates/pastGames.tpl.php";

        if (isset($_SESSION['loginNotAllowed'])) {
            echo '<script>alert("Sorry! Only students and staff from RVHS can signup!");</script>';
            $_SESSION['loginNotAllowed'] = null;
        }
    ?>
    
    <div id="home" class="container-v">
        <!-- eligibility and team formation -->
        <h1>Details</h1>
        <div class="container-h-distribute-h-same-size">
            <div class="container-v">
                <h2>Eligibility and Team Formation</h2>
                <p>
                    Open to all <b>River Valley High School students</b>,
                    you can participate <b>individually</b> or in <b>teams of up to four members</b>.
                    Feel free to choose your teammates or opt for <b>random assignment</b>. <!-- is random assignment actually a thing -->
                </p>
            </div>
            <div class="container-v-center">
                <img id="image-team" src="static/img/team.webp">
                <a href="https://forms.gle/Va3WKpSuwXPjFjSS8" class="anchor-button">Sign Up</a>
            </div>
        </div>

        <!-- competition timeline -->
        <div class="container-h-distribute-h-same-size">
            <div class="container-v">
                <h2>Competition Timeline</h2>
                <p>
                    The Gamejam runs from <b>November 1st to December 31st</b>,
                    which includes the December holidays.
                </p>
            </div>
            <div class="container-v-center">
                <img src="static/img/calendar.webp">
            </div>
        </div>

        <!-- theme -->
        <div class="container-h-distribute-h-same-size">
            <div class="container-v">
                <h2>Theme</h2>
                <p>
                    The Gamejam features <b>one main topic</b>,
                    along with <b>three optional sub-topics</b>,
                    which will boost your score.
                </p>
            </div>
            <div id="theme-display" class="relative">
                <img id="theme1" class="absolute anim-fade-in-tilt-ccw" src="static/img/oldTheme1.webp">
                <img id="theme2" class="absolute anim-fade-in-tilt-cw" src="static/img/oldTheme2.webp">
            </div>
        </div>

        <!-- the stumped part -->
        <div class="container-h-distribute-h-same-size">
            <div class="container-v">
                <h2>Stumped?</h2>
                <p>
                    If you're stumped by the main theme, you may choose to focus <b>solely on the sub-topics</b>,
                    but be aware this will result in a <b>lower score</b>.
                </p>
            </div>
            <div class="container-v-center">
                <!-- TODO: find a better image (this one is just one of the gmtk topics) -->
                <img src="static/img/gmtkTheme.webp">
            </div>
        </div>

        <!-- the section with the instagram logo -->
        <div class="container-v-center-h">
            <p>
                The game's theme will be announced at the start of the competition on <b>November 16th</b>,
                via <b>this website</b> and <b>social media</b>.
            </p>
            <a href="https://www.instagram.com/rv.devs/">
                <img src="static/img/ig.webp">
            </a>
        </div>

        <!-- coding tools -->
        <div class="container-h-distribute-h-same-size">
            <div class="container-v">
                <h2>Coding Tools</h2>
                <p>
                    Participants can use <b>any coding software or engine</b>,
                    including <b class="white">AI tools</b> like ChatGPT for <b class="">coding purposes</b>.
                </p>
            </div>
            <div class="container-v-center">
                <img src="static/img/tool.webp">
            </div>
        </div>

        <!-- asset creation -->
        <div class="container-h-distribute-h-same-size">
            <div class="container-v">
                <h2>Asset Creation</h2>
                <p>
                    While <b>AI-generated assets</b> is allowed, it <b class="">must be declared</b>.
                    We encourage you to <b>create your own assets</b>.
                </p>
            </div>
            <div class="container-v-center">
                <!-- TODO: maybe can stack the logos like for the tools image -->
                <img src="static/img/assets.webp">
            </div>
        </div>

        <!-- recommended software -->
        <h2>Recommended Software</h2>
        <div class="container-h-distribute-h">
            <div class="container-v-center-v">
                <a href="https://www.gimp.org/"><img src="static/img/gimps.webp"></a>
            </div>
            <div class="container-v-center-v">
                <a href="https://www.piskelapp.com/"><img src="static/img/piskel.webp"></a>
            </div>
            <div class="container-v-center-v">
                <a href="https://www.reaper.fm/"><img src="static/img/reaper.webp"></a>
            </div>
        </div>

        <!-- game showcasing -->
        <div class="container-h-distribute-h-same-size">
            <div class="container-v">
                <h2>Game Showcasing</h2>
                <p>
                    All entries will be available for playtesting and voting on our Gamejam website in
                    <b>January 2025</b>; find the <b>link in the header</b>.
                </p>
            </div>
            <div>
                <img src="static/img/playtest.webp">
            </div>
        </div>

        <!-- submission guidelines section -->
        <!-- TODO: personally i think the pictures are a bit too random, maybe can remove them -->
        <h1>Submission Guidelines</h1>
        <div class="container-v-center-v">
            <h2>Deadline</h2>
            <div class="container-h-center-h">
                <p>
                    Upload your game to the website before the <b>31st December</b> for public display.
                    Late entries are allowed but will incur a <b>scoring penalty</b>.
                </p>
                <div class="container-v-center">
                    <img src="static/img/upload.webp">
                </div>
            </div>
        
            <h2>Submission Format</h2>
            <p>
                Submit your game via a <b>Google Drive link</b> on the website's submission page.
            </p>
            
            <h2>Game Description</h2>
            <p>
                Include a <b>100-word description</b> to outline your game's features or controls.
                In-game tutorials are also encouraged to enhance user experience.
            </p>
        
            <h2>Image/Video Graphics</h2>
            <div class="container-h-center-h">
                <p>
                    Submit <b>3-4 Screenshots</b> of your game’s content, and a logo.<br><br>
                    <b>Optionally</b>, submit a <b>one-minute video</b> (up to 16MB) to showcase
                    your game's mechanics and thematic relevance.
                </p>
                <div class="container-v-center">
                    <img src="static/img/screenshot.webp">
                </div>
            </div>
        </div>
        
        <!-- judging process -->
        <!--
        <h2 class="">Judging</h2>
        -->
        <h1>Judging Process</h1>
        <div class="container-v-center-v">
            <div class="container-h-center-h">
                <p>
                    Judging will be done by both the <b>general public</b>
                    and <b>RdeV Exco</b>. Be sure to vote for your favourite games!
                </p>
                <div class="container-v-center">
                    <!-- TODO: the picture is 100% ai generated and looks ugly, can we just remove it -->
                    <img src="static/img/judging.webp">
                </div>
            </div>

            <!-- judging rubrics (its not spelt rubrix) -->
            <div>
                <h2>Judging Rubrics</h2>
                <?php require "templates/judgingRubrix.tpl.php"?>
            </div>
        </div>

        <!-- miscellaneous -->
        <h1>Miscellaneous</h1>
        <div class="container-v-center-v">
            <h2>Whatsapp Group</h2>
            <p>
                You may join the <b>Gamejam Whatsapp chat</b> included in the <b>sign up Google Form</b>.
                This group chat will be used to <b>communicate between all participants</b>,
                to <b>ask questions regarding the event</b> as well as to ask for help from others.
            </p>

            <!-- contact -->
            <h2>Contact</h2>

            <div class="container-h-distribute-h">
                <a class="container-v-center-h" href="mailto:rdevcca@gmail.com">
                    <img class="icon" src="static/img/gmail.webp">
                    <p>rdevcca@gmail.com</p> <!-- TODO: replace the <p> tags with something more suitable -->
                </a>
                <a class="container-v-center-h" href="https://www.instagram.com/rv.devs/">
                    <img class="icon" src="static/img/ig_contact.webp">
                    <p>rv.devs</p>
                </a>
                <div class="container-v-center-h">
                    <img class="icon" src="static/img/call.webp">
                    <p>+65 8511 8746<br>(President, Natalie)</p>
                </div>
            </div>
        </div>

        <!-- sign up button -->
    </div>
    <footer class="container-h-center-h">
        <a href="https://forms.gle/Va3WKpSuwXPjFjSS8" class="anchor-button"><span>Sign Up</span></a>
    </footer>

    <script>
        const pastGames = <?php echo json_encode($pastGames) ?>;
    </script>
    <script src = "static/js/home.js"></script>
