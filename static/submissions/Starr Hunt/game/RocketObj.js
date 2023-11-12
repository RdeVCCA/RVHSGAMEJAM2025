//damping to slow down rocket
//not affected by mass in this code as I can't code a proper physics engine
const damping = 0.996;
const topSpeed = 6;
class Rocket {
  constructor() {
    //basic velocity and acceleration
    this.pos = createVector(width / 2, height / 2);
    this.vel = createVector(0, 0);
    this.acc = createVector(0, 0);
    this.power = 0;
    //health affecting the mass
    //lesser health -> lower mass -> faster accleration
    this.health = 5;
    this.mass = this.health * 3;
    this.heading = 0;
    //angular velocity and acceleration
    this.headingV = 0;
    this.headingA = 0;
    //pos on map
    this.mapX = 0;
    this.mapY = 0;
    //immunity after hitting an obstacle
    this.immune = false;
  }
  show() {
    let state = rocketStates[this.power];
    if (this.power == -1) {
      state = rocketRT;
    }
    imageMode(CENTER);
    push();
    translate(this.pos.x, this.pos.y);
    rotate(this.heading + 90);
    state.resize(rocketSize, 0);
    image(state, 0, 0);
    pop();
  }
  update() {
    this.mass = this.health * 3;
    this.vel.add(this.acc);
    this.vel.mult(damping);
    this.vel.limit(topSpeed);
    this.pos.add(this.vel);
    this.acc.mult(0);
    //angular motion
    this.headingV += this.headingA;
    this.headingV *= damping;
    this.headingV = constrain(this.headingV, -10, 10);
    this.heading += this.headingV;
    this.headingA = 0;
    //reset immunity
    rocket.immune = false;
  }
  applyForce(force) {
    // A = F / M
    this.acc.add(force.div(this.mass));
  }
  turn(g) {
    this.headingA += g / 2;
  }
  thrust(power) {
    this.power = power;
    let angle = this.heading - PI / 2;
    //polar to cartesian for force vector
    let force = new createVector(cos(angle), sin(angle));
    force.mult(power / 10);
    this.applyForce(force);
  }
  wrapEdges() {
    let r = rocketSize;
    //edges of the map
    if (this.mapX == 0) {
      this.pos.x = constrain(this.pos.x, r / 2, Infinity);
    } else if (this.mapX >= cosmosW - 1) {
      this.pos.x = constrain(this.pos.x, -Infinity, width - r / 2);
    }
    if (this.mapY == 0) {
      this.pos.y = constrain(this.pos.y, 50 + r / 2, Infinity);
    } else if (this.mapY >= cosmosH - 1) {
      this.pos.y = constrain(this.pos.y, -Infinity, height - r / 2);
    }
    //deplete velocity when hit edge
    if (this.pos.x == r / 2 && this.mapX == 0) {
      this.vel.x = 0;
    } else if (this.pos.x == width - r / 2 && this.mapX >= cosmosW - 1) {
      this.vel.x = 0;
    }
    if (this.pos.y == 50 + r / 2 && this.mapY == 0) {
      this.vel.y = 0;
    } else if (this.pos.y == height - r / 2 && this.mapY >= cosmosH - 1) {
      this.vel.y = 0;
    }
    //change map coordinates
    if (this.pos.x > width + r / 2) {
      this.pos.x = -r / 2;
      this.mapX++;
    } else if (this.pos.x < -r / 2) {
      this.pos.x = width + r / 2;
      this.mapX--;
    }
    if (this.pos.y > height + r / 2) {
      this.pos.y = 50 - r / 2;
      this.mapY++;
    } else if (this.pos.y < 50 - r / 2) {
      this.pos.y = height + r / 2;
      this.mapY--;
    }
    //console.log(this.mapX, this.mapY)
  }
  collision() {
    for (let i = 0; i < cosmos[this.mapY][this.mapX].obstacles.length; i++) {
      let obs = cosmos[this.mapY][this.mapX].obstacles[i];
      let d = dist(this.pos.x, this.pos.y, obs.x, obs.y);
      let obsr = obs.r / 2;
      if (obs.id >= 0 && obs.id < 3) {
        obsr -= obs.r / 4;
      }
      if (d < rocketSize / 2 + obsr) {
        if (obs.id === 6) {
          this.health -= 2;
          //start from beginning
          rocket.mapX = 0;
          rocket.mapY = 0;
          rocket.pos.x = width / 2;
          rocket.pos.y = height / 2;
          rocket.vel.mult(0);
          rocket.acc.mult(0);
          rocket.heading = 0;
          rocket.headingV = 0;
          rocket.headingA = 0;
        } else {
          if (!this.immune) {
            this.health--;
            this.vel.mult(-1);
            this.acc.mult(-1);
            //console.log(this.health)
          }
          this.immune = true;
        }
      }
    }
    if (this.mapX == star.mapX && this.mapY == star.mapY) {
      let stard = dist(this.pos.x, this.pos.y, star.x, star.y);
      if (stard <= rocketSize / 2 + star.r / 2) {
        gamerun = false;
        passed = true;
      }
    }
  }
}
