    <link rel="stylesheet" href="static/css/home.css" />
</head>

<body>
    <!-- this file is only for the content that comes after the past games section -->
    <?php
        // include_once 'backend/pastGames.inc.php';
        include_once "templates/navbar.tpl.php";
        include_once 'templates/hero.tpl.php';
        include_once 'templates/about.tpl.php';
        include_once 'templates/pastGames.tpl.php';

        if (isset($_SESSION['accountRestricted'])) {
            echo '<script>alert("As this is a non-RVHS account, we would need to manually approve your email account before your reviews are shown to others. You may contact us to speed up this process; our contact details can be found at the bottom.");</script>';
            $_SESSION['accountRestricted'] = null;
        }
    ?>
    
    <div id="home" class="cont-v-cv cont-v-g">
        <!-- eligibility and team formation -->
        <h1>Details</h1>
        <div class="cont-h-dh cont-h-g">
            <div class="cont-v">
                <h2>Eligibility and Team Formation</h2>
                <p>
                    Open to all <b>River Valley High School students</b>,
                    you can participate <b>individually</b> or in <b>teams of up to five members</b>.
                    Feel free to choose your teammates or opt for <b>random assignment</b>.
                </p>
            </div>
            <div class="cont-v-c">
                <img id="image-team" src="static/img/team.webp" class="home-img">
                <a href="https://docs.google.com/forms/d/1h3gkT--djiwWKIUULAtXa8ufNEUbG3Il0vwT_ukjXsA" target="_blank" class="anchor-button hover">Sign Up</a>
            </div>
        </div>

        <!-- competition timeline -->
        <div class="cont-h-dh cont-h-g cont-h-r">
            <div class="cont-v">
                <h2>Competition Timeline</h2>
                <p>
                    The Gamejam runs from <b>November 8th to December 31st</b>,
                    which includes the December holidays.
                </p>
            </div>
            <div class="cont-v-c">
                <!-- <img src="static/img/calendar.webp" class="home-img"> -->
            </div>
        </div>

        <!-- theme -->
        <div class="cont-h-dh cont-h-g">
            <div class="cont-v">
                <h2>Theme</h2>
                <p>
                    The Gamejam features <b>one main topic</b>,
                    along with <b>multiple optional sub-topics</b>,
                    which will boost your score.
                </p>
                <p>
                    The game's theme will be announced at the start
                    of the competition on <b>November 8th</b> via <b>social media</b>.
                </p>
            </div>
            <a href="https://www.instagram.com/rv.devs/" target="_blank" class="hover">
                <img src="static/img/ig.webp" class="home-img">
            </a>
        </div>

        <!-- the stumped part -->
        <!-- <div class="cont-h-dh cont-h-g cont-h-r">
            <div class="cont-v">
                <h2>Stumped?</h2>
                <p>
                    If you're stumped by the main theme, you may choose to focus <b>solely on the sub-topics</b>,
                    but be aware this will result in a <b>lower score</b>.
                </p>
            </div>
            <div class="cont-v-c">
                TODO: find a better image (this one is just one of the gmtk topics)
                <img src="static/img/gmtkTheme.webp" class="home-img">
            </div>
        </div> -->

        <hr>

        <!-- coding tools -->
        <h1>Software</h1>
        <div class="cont-h-ch cont-h-g">
            <div class="cont-v">
                <h2>Coding Tools</h2>
                <p>
                    Participants can use <b>any coding software or engine</b>,
                    including <b>AI tools</b> like ChatGPT for <b>coding purposes</b>.
                </p>
            </div>
            <div class="cont-v-c">
                <img src="static/img/tool.webp" class="home-img">
            </div>
        </div>

        <!-- asset creation -->
        <!-- <div class="cont-h-dh cont-h-g cont-h-r">
            <div class="cont-v">
                <h2>Asset Creation</h2>
                <p>
                    While <b>AI-generated assets</b> is allowed, it <b>must be declared</b>.
                    We encourage you to <b>create your own assets</b>.
                </p>
            </div>
            <div class="cont-v-c">
                TODO: maybe can stack the logos like for the tools image
                <img src="static/img/assets.webp" class="home-img">
            </div>
        </div> -->

        <!-- recommended software -->
        <h2>Recommended Software</h2>
        <div class="cont-h-ch cont-h-g cont-w">
            <div class="cont-v-cv">
                <a href="https://www.gimp.org/" target="_blank"><img src="static/img/gimps.webp" class="home-img hover"></a>
            </div>
            <div class="cont-v-cv">
                <a href="https://www.piskelapp.com/" target="_blank"><img src="static/img/piskel.webp" class="home-img hover"></a>
            </div>
            <div class="cont-v-cv">
                <a href="https://www.reaper.fm/" target="_blank"><img src="static/img/reaper.webp" class="home-img hover"></a>
            </div>
        </div>

        <hr>
        
        <!-- game showcasing -->
        <div class="cont-h-dh cont-h-g">
            <div class="cont-v">
                <h2>Game Showcasing</h2>
                <p>
                    All entries will be available for playtesting and voting on our Gamejam website in
                    <b>January 2025</b>; find the <b>link in the header</b>.
                </p>
            </div>
            <div class="cont-v-c">
                <img src="static/img/playtest.webp" class="home-img">
            </div>
        </div>

        <hr>

        <!-- submission guidelines section -->
        <div class="cont-v">
            <h1>Submission Guidelines</h1>
            <table>
                <tr>
                    <th>Submission deadline</th>
                    <th>Submission format</th>
                </tr>
                <tr>
                    <td>
                        Upload your game to the website before the <b>31st December</b> for public display.
                        Late entries are allowed but will incur a <b>scoring penalty</b>.
                    </td>
                    <td>
                        Submit your game via a <b>Google Drive link</b> on the website's submission page.
                    </td>
                </tr>
                <tr>
                    <th>Game description</th>
                    <th>Image/video</th>
                </tr>
                <tr>
                    <td>
                        Include a <b>100-word description</b> to outline your game's features or controls.
                        In-game tutorials are also encouraged to enhance user experience.
                    </td>
                    <td>
                        Submit <b>3-4 Screenshots</b> of your game’s content, and a logo.
                        <b>Optionally</b>, submit a <b>one-minute video</b> (up to 16MB) to showcase
                        your game's mechanics and thematic relevance.
                    </td>
                </tr>
            </table>
        </div>
        
        <hr>
        
        <!-- judging process -->
        <div class="cont-v-cv">
            <h1>Judging Process</h1>
            <div class="cont-h-ch">
                <p>
                    Judging will be done by both the <b>general public</b>
                    and <b>RdeV Exco</b>. Be sure to vote for your favourite games!
                </p>
                <div class="cont-v-c">
                    <!-- TODO: the picture is 100% ai generated and looks ugly, can we just remove it -->
                    <img src="static/img/judging.webp" class="home-img">
                </div>
            </div>
        </div>
        <div class="cont-v-cv">
            <h2>Judging Rubrics</h2>
            <div id="judging-rubrics">
                <table>
                    <tr>
                        <th>Main Criteria</th>
                        <th>6-5</th>
                        <th>4-3</th>
                        <th>2-1</th>
                    </tr>
                    <tr>
                        <td>Relatedness to Theme</td>
                        <td>
                            Game integrates elements of the theme very well
                            and much effort is put into implementing the topic into the game.
                        </td>
                        <td>Elements of the theme are found in the game, but feel forced.</td>
                        <td>Elements of the theme not found in the game, or only present as visuals or sprites.</td>
                    </tr>
                    <tr>
                        <td>Uniqueness</td>
                        <td>Game has many unique gameplay elements.</td>
                        <td>Game is somewhat unique, but has many generic gameplay mechanics.</td>
                        <td>Game looks generic with no unique elements.</td>
                    </tr>
                    <tr>
                        <th>Secondary Criteria</th>
                        <th>3</th>
                        <th>2</th>
                        <th>1</th>
                    </tr>
                    <tr>
                        <td>Aesthetics</td>
                        <td>Game sprites are original and complement the theme well.</td>
                        <td>
                            Attempt made at making game aesthetically pleasing,
                            but is either directly copied from online sources,
                            or does not complement the theme well.
                        </td>
                        <td>Little to no sprites added to the game.</td>
                    </tr>
                    <tr>
                        <td>Gameplay smoothness</td>
                        <td>Game is smooth and easy to play.</td>
                        <td>
                            Game is playable, but lacks user-friendly elements.
                            Games with buggy physics may also end up in this category.
                        </td>
                        <td>Game is buggy, hardly playable or very unenjoyable due to messy or delayed controls.</td>
                    </tr>
                    <tr>
                        <td>Ease of Learning</td>
                        <td>Game is easily understood with clear instructions.</td>
                        <td>Game is can be easily understood for most people, but instructions are sometimes unclear.</td>
                        <td>Game is hard to understand and learn, often leaving users confused on what to do and how the game works.
                        </td>
                    </tr>
                    <tr>
                        <td>Relatedness to Subtheme</td>
                        <td>
                            Subtheme is intricately woven into the gameplay and narrative,
                            enhancing the overall game experience.
                        </td>
                        <td>Subtheme is present but does not significantly influence the gameplay or story.</td>
                        <td>Subtheme is barely noticeable or irrelevant to the game's core elements.</td>
                    </tr>
                </table>
            </div>
        </div>

        <hr>

        <!-- miscellaneous -->
        <div class="cont-v-cv cont-v-g">
            <h1>Miscellaneous</h1>
            <div>
                <h2>Whatsapp Group</h2>
                <p>
                    You may join the <b>Gamejam Whatsapp chat</b> included in the <b>sign up Google Form</b>.
                    This group chat will be used to <b>communicate between all participants</b>,
                    to <b>ask questions regarding the event</b> as well as to ask for help from others.
                </p>
            </div>

            <!-- contact -->
            <div>
                <h2>Contact</h2>
                <div class="cont-h-ch cont-h-g">
                    <a class="cont-v-ch hover" href="mailto:rdevcca@gmail.com" target="_blank">
                        <img class="icon" src="static/img/gmail.webp">
                        <p>rdevcca@gmail.com</p> <!-- TODO: replace the <p> tags with something more suitable -->
                    </a>
                    <a class="cont-v-ch hover" href="https://www.instagram.com/rv.devs/" target="_blank">
                        <img class="icon" src="static/img/ig_contact.webp">
                        <p>rv.devs</p>
                    </a>
                    <div class="cont-v-ch">
                        <img class="icon" src="static/img/call.webp">
                        <p>+65 9025 6233<br>(President, Yue Han)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- sign up button -->
    </div>
    <footer class="cont-h-ch">	
        <a href="https://docs.google.com/forms/d/1h3gkT--djiwWKIUULAtXa8ufNEUbG3Il0vwT_ukjXsA" class="anchor-button hover" target="_blank"><span>Sign Up</span></a>
    </footer>

    <script>
        const pastGames = <?php echo json_encode($pastGames) ?>;
    </script>
    <script src="static/js/home.js"></script>
