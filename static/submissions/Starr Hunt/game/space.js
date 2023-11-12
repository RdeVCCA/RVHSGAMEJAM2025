//check "info.js" for instructions
function checkOverlap(arr, obs) {
  var overlap = false;
  var obsr = obs.r / 2;
  //get hitboxes
  if (obs.id >= 0 && obs.id < 3) {
    obsr -= obs.r / 6;
  }
  //distance from origin of rocket and obstacle
  let rocketd = dist(rocket.pos.x, rocket.pos.y, obs.x, obs.y);
  for (let i = 0; i < arr.length; i++) {
    let other = arr[i];
    //distance from origin of other obstacle and this obstacle
    let d = dist(other.x, other.y, obs.x, obs.y);
    //hitbox of other obstacle
    let otherR = other.r / 2;
    //dist is less than sum of radius of obstacles
    if (d < otherR + obs.r / 2) {
      overlap = true;
      break;
    }
  }
  //dist is less than sum of radius of rocket and obstacles
  if (rocketd < rocketSize / 2 + obsr) {
    overlap = true;
  }
  return overlap;
}
class Space {
  constructor(x, y) {
    this.x = x;
    this.y = y;
    this.obstacles = [];
    this.number = floor(random(3, 5));
    for (let i = 0; i < this.number; i++) {
      let obs = new Obstacle(this.x, this.y);
      let overlap = checkOverlap(this.obstacles, obs);
      if (!overlap) {
        this.obstacles.push(obs);
      } else {
        i--;
      }
    }
  }
  show() {
    this.obstacles.forEach((x) => {
      x.show();
    });
  }
}
class Obstacle {
  constructor(x, y) {
    this.mapX = x;
    this.mapY = y;
    let r;
    if (this.mapY < (cosmosH - 1) / 2) {
      r = random(0.8);
      //console.log(this.mapX, this.mapY)
    } else {
      r = random();
    }
    //id selection(type of obstacle)
    //console.log(r)
    if (r > 0.4 && r < 0.6) {
      //planet with rings ~20%
      this.id = 0;
    } else if (r <= 0.4 && r > 0.2) {
      //blue planet ~20%
      this.id = 1;
    } else if (r >= 0.6 && r < 0.8) {
      //sun like star ~20%
      this.id = 2;
    } else if (r <= 0.2 && r > 0) {
      //jupiter like planet ~20%
      this.id = 3;
    } else if (r >= 0.8 && r < 0.9) {
      //earth like planet ~10%
      this.id = 4;
    } else if (r >= 0.9 && r < 0.95) {
      //asteroid ~5%
      this.id = 5;
    } else if (r >= 0.95) {
      //black hole ~5%
      this.id = 6;
    }
    if (this.id > 4) {
      this.r = random(30, 50);
    } else {
      this.r = random(100, 150);
    }
    var obsr = this.r / 2;
    //get hitboxes
    if (this.id >= 0 && this.id < 3) {
      obsr -= this.r / 6;
    }
    this.x = random(obsr, width - obsr);
    this.y = random(50 + obsr, height - obsr);
    this.angle = random(360);
    this.pic = obsTypes[this.id].get();
    this.pic.resize(this.r, 0);
  }
  show() {
    imageMode(CENTER);
    push();
    translate(this.x, this.y);
    rotate(this.angle);
    image(this.pic, 0, 0);
    //fill(0, 255, 0);
    //ellipse(0, 0, this.r)
    pop();
    if (this.mapX == rocket.mapX && this.mapY == rocket.mapY && this.id == 6) {
      //gravitational force of black hole
      let xdiff = this.x - rocket.pos.x;
      let ydiff = this.y - rocket.pos.y;
      //lower abs(diff) -> higher diff -> higher force
      let xforce = ((width - abs(xdiff)) * Math.sign(xdiff)) / 10000;
      let yforce = ((height - abs(ydiff)) * Math.sign(ydiff)) / 10000;
      let force = createVector(xforce, yforce);
      rocket.applyForce(force);
    }
  }
}
