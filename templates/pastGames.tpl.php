<link rel="stylesheet" href="static/css/pastGames.css" />
<link rel="stylesheet" href="static/css/shared.css" />
<div class="past-games">
    <h2>Past GameJams</h2>
    <div class="select-year-container">
        <button class="select-year" data-selected="true">2021</button>
        <button class="select-year">2022</button>
    </div>
    <div class="select-game-container">
        <input type="image" class="select-game" data-selected="true"/>
    </div>
    <div class="game-details-container">
        <h3 class="game-title">Game Title</h3>
        <div class="game-showcase">
            <img class="game-image" />
            <video class="game-video" controls>
                <source src="" type="video/mp4">
            </video>
        </div>
        <button class="game-visit">Visit</button>
        <p class="game-description">
            <span class ='description'></span>
            <!-- <span class="read-more">(Read More...)</span> -->
        </p>
    </div>
</div>
<script defer src="static/js/pastGames.js"></script>

