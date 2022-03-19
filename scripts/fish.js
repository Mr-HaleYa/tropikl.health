export class Fish {
  #animateID;
  vectorXMin = -1.2;
  vectorXMax = 1.2;
  vectorYMin = -.3;
  vectorYMax = .3;
  

  constructor(fishColor, xPos, yPos, wrap, isColored){
    this.fishElement;
    this.fishColor = fishColor;
    this.imgPath = "-dull.png";
    this.isColored = isColored;

    // Position
    this.xPos = xPos;
    this.yPos = yPos;
    this.orientation = Math.PI;
    this.isFlip = 1;

    // Creates DOM element
    this.createFish = function(fishColor){
      if(this.fishColor == "rainbow"){
        this.fishElement = document.createElement("img");
        this.fishElement.setAttribute('src', './assets/rainbow2.png');
        this.fishElement.setAttribute('class', 'fish');
        this.fishElement.setAttribute('id', 'rainbow');
        this.fishElement.style.transform = `translateX(${this.xPos}px) translateY(${this.yPos}px) rotate(${this.orientation}rad) scaleY(${this.isFlip})`;
        wrap.appendChild(this.fishElement);
      } 
      else {
        this.fishElement = document.createElement("img");
        this.fillColor();
        this.fishElement.setAttribute('src', `./assets/${this.fishColor}${this.imgPath}`);
        this.fishElement.setAttribute('class', 'fish');
        this.fishElement.style.transform = `translateX(${this.xPos}px) translateY(${this.yPos}px) rotate(${this.orientation}rad) scaleY(${this.isFlip})`;
        wrap.appendChild(this.fishElement);
      }
    }

    this.getRandomVector = function(){
      let vector = {
        xDiff: 0,
        yDiff: 0, 
        angle: 0,
      }

      vector.yDiff = Math.random() * (this.vectorYMax - this.vectorYMin) + this.vectorYMin;
      vector.xDiff = Math.random() * (this.vectorXMax - this.vectorXMin) + this.vectorXMin;
      
      if(Math.abs(vector.xDiff) <= Math.abs(vector.yDiff)){
        if(vector.xDiff < 0){
          vector.xDiff -= Math.abs(vector.yDiff)
        }
        else if(vector.xDiff >= 0){
          vector.xDiff += Math.abs(vector.yDiff)
        }
        
      }
      
      vector.angle =  Math.atan2(vector.yDiff,  vector.xDiff);
      return vector;
    }

    this.currentVector = this.getRandomVector();
    this.xIncrement = this.currentVector.xDiff;
    this.yIncrement = this.currentVector.yDiff;

    this.#animateID = requestAnimationFrame(() => { this.animate(); });

    this.animate = function(){
        // Keep in bounds
        if(this.xPos > window.innerWidth - this.fishElement.offsetWidth || this.xPos < 0){
          this.xIncrement = this.xIncrement * -1;
        }

        if(this.yPos > window.innerHeight - this.fishElement.offsetHeight || this.yPos < 0){
          this.yIncrement = this.yIncrement * -1;
        }

        // Increment move Counters
        this.xPos += this.xIncrement;
        this.yPos += this.yIncrement;
        this.updateAngle();
        
        // Orient Fish Upright
        if(-Math.PI <= this.orientation && this.orientation <= -Math.PI / 2 || Math.PI / 2 <= this.orientation && this.orientation <= Math.PI){
          this.isFlip = -1;
        }
        else {
          this.isFlip = 1;
        }
        
        // Actually move transform the elements
        this.fishElement.style.transform = `translateX(${this.xPos}px) translateY(${this.yPos}px) rotate(${this.orientation}rad) scaleY(${this.isFlip})`;
      this.#animateID = requestAnimationFrame(() => { this.animate(); });
    }


  }

  fillColor() {
    if(this.isColored == 1) {
      this.imgPath = "-colored.png";
    }
    else {
      this.imgPath ="-dull.png";
    }
  }

  updateVector() {
    this.currentVector = this.getRandomVector()
    this.xIncrement = this.currentVector.xDiff;
    this.yIncrement = this.currentVector.yDiff;
    this.updateAngle()
  }

  updateAngle() {
    this.orientation =  Math.atan2(this.yIncrement,  this.xIncrement);
  }


}