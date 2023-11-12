//for instructions go to the "info.js" file
var rocket;
var rocketpng;
var rocketStates = [];
var rocketRT;
var rocketSize = 50;
//rocket boosters
var boostCount = 200;
//map
var cosmos = [];
var cosmosW, cosmosH;
//game is running?
var gamerun = false;
//you died?
var dieded;
//passed?
var passed;
//title screen img
var backgroundimg;
//obstacles
var obsTypes = [];
var obs_spriteSheet;
var obs_jupiter, obs_earth, obs_asteroid, obs_blackHole;
//fade out animation
var fadeout = false,
  fade = 255;
//heart sprite
var heartSprite;
//map rects
var rectWidth, rectHeight;
//target
var starImg;
var star;
//timer for the game
var selfDestructTime;
var selfDestruct;
var timerStart;
var selfDesStart;
//explosion
var explosionSheet;
var expAnimation = [];
var expFrame;
var c;
function preload() {
  rocketpng = loadImage("/static/submissions/Starr Hunt/game/miscellaneous/rocketSpriteSheet.png");
  rocketRT = loadImage("/static/submissions/Starr Hunt/game/miscellaneous/rocketSpriteReverseThrust.png");
  backgroundimg = loadImage(
    "https://as2.ftcdn.net/v2/jpg/04/36/65/21/1000_F_436652191_URWh34uDqxPzDlFjyt7nb0AzMjMqpgcA.jpg"
  );
  obs_spriteSheet = loadImage("/static/submissions/Starr Hunt/game/obstacles/planets.png");
  obs_jupiter = loadImage("/static/submissions/Starr Hunt/game/obstacles/jupiter.png");
  obs_earth = loadImage("/static/submissions/Starr Hunt/game/obstacles/earthSprite.png");
  obs_asteroid = loadImage("/static/submissions/Starr Hunt/game/obstacles/asteroidSprite.png");
  obs_blackHole = loadImage("/static/submissions/Starr Hunt/game/obstacles/blackhole.png");
  heartSprite = loadImage("/static/submissions/Starr Hunt/game/miscellaneous/heartSprite.png");
  starImg = loadImage("/static/submissions/Starr Hunt/game/miscellaneous/marioStar.png");
  explosionSheet = loadImage("/static/submissions/Starr Hunt/game/miscellaneous/explosion.png");
}
function setup() {
  createCanvas(windowWidth, windowHeight);
  angleMode(DEGREES);
  //get rocket sprites from spritesheet
  let w = rocketpng.width;
  let h = rocketpng.height / 4;
  for (let i = 0; i < 4; i++) {
    rocketStates[i] = rocketpng.get(0, i * h, w, h);
  }
  rocket = new Rocket();
  //background screen for game start
  let bw = backgroundimg.width;
  let bh = backgroundimg.height;
  backgroundimg = backgroundimg.get(bw - width, bh - height, width, height);
  backgroundimg.resize(width, 0);
  //load obstacle imgs
  let planetW = obs_spriteSheet.width / 3;
  let planetH = obs_spriteSheet.height;
  for (let i = 0; i < 3; i++) {
    obsTypes[i] = obs_spriteSheet.get(i * planetW, 0, planetW, planetH);
  }
  obsTypes.push(obs_jupiter, obs_earth, obs_asteroid, obs_blackHole);
  let expw = explosionSheet.width / 4;
  let exph = explosionSheet.height / 4;
  //explosionSheet.resize(width, 0);
  //image(explosionSheet, 0, 0)
  for (let i = 0; i < 4; i++) {
    for (let j = 0; j < 4; j++) {
      expAnimation.push(
        explosionSheet.get(j * expw + 1, i * exph + 1, expw - 1, exph - 1)
      );
    }
  }
  //image(expAnimation[4], 100, 100);
  //console.log(expAnimation)
}
function draw() {
  if (!gamerun) {
    background(0);
    if (dieded) {
      tint(255, 0, 0, fade);
    } else {
      tint(fade);
    }
    //background image
    imageMode(CENTER);
    image(backgroundimg, width / 2, height / 2);
    textSize(35);
    textStyle(BOLD);
    fill(0, 255, 0, fade);
    textAlign(CENTER);
    if (dieded) {
      text("YOU DIED!", width / 2, height / 3);
    } else if (passed) {
      text("YOU PASSED", width / 2, height / 3);
    } else {
      text("STARRHUNT", width / 2, height / 3);
    }
    fill(0, 150, 255, fade);
    textSize(25);
    if (dieded || passed) {
      text("Press SPACE to restart", width / 2, (height / 3) * 2);
    } else {
      text("Press SPACE to start", width / 2, (height / 3) * 2);
    }
    if (keyIsPressed && key === " ") {
      fadeout = true;
    }
    if (fadeout) {
      fade -= 5;
    }
    //end of fadeout animation
    if (fade < 0) {
      fade = 255;
      fadeout = false;
      gamerun = true;
      dieded = false;
      passed = false;
      rocket.health = 5;
      //set/reset rocket pos and vel
      rocket.mapX = 0;
      rocket.mapY = 0;
      rocket.pos.x = width / 2;
      rocket.pos.y = height / 2;
      rocket.vel.mult(0);
      rocket.acc.mult(0);
      rocket.heading = 0;
      rocket.headingV = 0;
      rocket.headingA = 0;
      //map generation;
      cosmosW = floor(random(4, 7));
      cosmosH = floor(random(4, 7));
      //cosmosW = 4;
      //cosmosH = 4;
      selfDestructTime = cosmosW * cosmosH * 15000;
      timerStart = millis();
      for (let i = 0; i < cosmosH; i++) {
        cosmos[i] = [];
        for (let j = 0; j < cosmosW; j++) {
          cosmos[i][j] = new Space(j, i);
        }
      }
      rectWidth = round(50 / cosmosW);
      rectHeight = round(50 / cosmosH);
      star = new Star();
      selfDesStart = false;
      expFrame = 0;
      c = 0;
      //console.log(rectWidth, rectHeight)
      //console.log(cosmosW, cosmosH);
    }
  } else {
    tint(255, 255);
    background(0, 150);
    //console.log(rocket.mapY, rocket.mapX);
    //console.log(rocket.pos.x, rocket.pos.y)
    cosmos[rocket.mapY][rocket.mapX].show();
    if (selfDesStart) {
      //self destruct animation
      push();
      translate(rocket.pos.x, rocket.pos.y);
      let frame = expAnimation[expFrame].get();
      //console.log(frame)
      frame.resize(rocketSize, 0);
      rotate(rocket.heading);
      image(frame, 0, 0);
      pop();
      c++;
    } else {
      rocket.show();
    }
    if (c >= 3) {
      expFrame++;
      c = 0;
    }
    rocket.update();
    star.show();
    rocket.wrapEdges();
    rocket.collision();
    rectMode(CENTER);
    fill(0, 0, 255);
    rect(width / 2, 25, width, 50);
    //heart sprites
    heartSprite.resize(0, 30);
    imageMode(CENTER);
    for (let i = 0; i < rocket.health; i++) {
      image(heartSprite, 18 * (i * 2 + 1), 25);
    }
    //self destruct timer
    selfDestruct = (selfDestructTime - millis() + timerStart).toFixed();
    noFill();
    strokeWeight(3);
    stroke(0);
    rectMode(CORNER);
    let timerWidth = width / 2 - 60;
    let rectFill = map(selfDestruct, 0, selfDestructTime, 0, timerWidth);
    rectFill = constrain(rectFill, 0, timerWidth);
    //lower the rectFill, the lower the green value
    //lower the rectFill, the higher the red value
    let rectRed, rectGreen;
    rectGreen = map(rectFill, 0, timerWidth / 2, 0, 255);
    rectRed = map(rectFill, timerWidth / 2, timerWidth, 255, 0);
    rect(timerWidth, 10, timerWidth, 30);
    noStroke();
    fill(rectRed, rectGreen, 0);
    rect(timerWidth + 1, 11, rectFill - 1, 28);
    //map of the cosmos(woah so cool)
    stroke(0, 0, 255);
    strokeWeight(1);
    for (let i = 0; i < cosmosH; i++) {
      for (let j = 0; j < cosmosW; j++) {
        if (j == rocket.mapX && i == rocket.mapY) {
          fill(255, 0, 0);
        } else {
          fill(255, 255, 0);
        }
        rect(width - 50 + rectWidth * j, rectHeight * i, rectWidth, rectHeight);
      }
    }
    if (keyIsDown(LEFT_ARROW)) {
      rocket.turn(-0.05);
    } else if (keyIsDown(RIGHT_ARROW)) {
      rocket.turn(0.05);
    }
    if (keyIsDown(32)) {
      boostCount--;
      if (boostCount < 0) {
        rocket.thrust(3);
      } else if (boostCount < 100) {
        rocket.thrust(2);
      } else {
        rocket.thrust(1);
      }
    } else {
      boostCount = 200;
      rocket.power = 0;
    }
    if (keyIsDown(90)) {
      //reverse thrust
      rocket.thrust(-1);
    }
    if (rocket.health <= 0) {
      gamerun = false;
      dieded = true;
    }
    if (rectFill <= 0) {
      selfDesStart = true;
    }
    if (expFrame >= 16) {
      gamerun = false;
      dieded = true;
    }
  }
}
//star obj
function Star() {
  this.r = random(50, 75);
  this.mapX = floor(random(1, cosmosW));
  this.mapY = floor(random(1, cosmosH));
  let map = cosmos[this.mapY][this.mapX].obstacles;
  this.x = random(this.r, width - this.r);
  this.y = random(this.r + 50, height - this.r);
  while (checkOverlapStar(map, this.x, this.y, this.r)) {
    this.r = random(50, 75);
    this.x = random(this.r, width - this.r);
    this.y = random(this.r + 50, height - this.r);
  }
  //console.log(this.mapX, this.mapY);
  //get a copy of the sprite img
  this.pic = starImg.get();
  this.pic.resize(this.r, 0);
  this.rotation = random(360);
  this.show = function () {
    if (rocket.mapX == star.mapX && rocket.mapY == star.mapY) {
      push();
      translate(this.x, this.y);
      rotate(this.rotation);
      image(this.pic, 0, 0);
      pop();
    }
  };
}
//copied from space.js
function checkOverlapStar(arr, x, y, r) {
  var overlap = false;
  for (let i = 0; i < arr.length; i++) {
    let other = arr[i];
    //distance from origin of other obstacle and this obstacle
    let d = dist(other.x, other.y, x, y);
    //hitbox of other obstacle
    let otherR = other.r / 2;
    if (other.id >= 0 && other.id < 3) {
      otherR -= other.r / 6;
    }
    //dist is less than sum of radius of obstacles
    if (d < otherR + r / 2) {
      overlap = true;
      break;
    }
  }
  return overlap;
}
