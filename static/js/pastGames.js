"use strict";
const selectYear = document.querySelectorAll('.select-year');
const selectGame = document.querySelectorAll('.select-game');
var selectedYear = document.querySelector('.select-year[data-selected="true"]');
var selectedGame = document.querySelector('.select-game[data-selected="true"]');
var gameData;
fetch('static/pastGames/gameDetails.json')
.then(response => {
// Check if the response is OK (status 200-299)
if (!response.ok) {
    throw new Error('Network response was not ok');
}
return response.json(); // Parse the response as JSON
})
.then(data => {
    gameData = data;
})

function updateGameDetails(id) {
    const gameDetails = document.querySelector('.game-details-container');
    const description = gameDetails.querySelector('.description');
    const img = gameDetails.querySelector('.game-image');
    const title = gameDetails.querySelector('.game-title');
    const visitButton = gameDetails.querySelector('.game-visit');
    const game = gameData[id];
    description.textContent = game.description;
    img.src = game.previewImg;
    title.textContent = game.title;
    visitButton.href = game.link;

}
for (let i = 0; i < selectYear.length; i++) {
    
    selectYear[i].addEventListener('click', function() {
        selectedYear.removeAttribute('data-selected');
        this.setAttribute('data-selected', 'true');
        selectedYear = this;
    });
}

for (let i = 0; i < selectGame.length; i++) {
    selectGame[i].index = i
    selectGame[i].addEventListener('click', function() {
        selectedGame.removeAttribute('data-selected');
        this.setAttribute('data-selected', 'true');
        selectedGame = this;
        updateGameDetails(this.index);
    });
}