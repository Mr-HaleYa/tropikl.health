export class Fish {
  #animateID;
  vectorXMin = -1.2;
  vectorXMax = 1.2;
  vectorYMin = -.3;
  vectorYMax = .3;
  

  constructor(fishColor, xPos, yPos, wrap){
    this.fishElement;
    this.fishColor = fishColor;
    this.isColored = false;
    // Position
    this.xPos = xPos;
    this.yPos = yPos;
    this.orientation = Math.PI;

    this.createFish = function(fishColor){
      this.fishElement = document.createElement("img");
      this.fishElement.setAttribute('src', './assets/red-filled.png');
      this.fishElement.setAttribute('class', 'fish');
      wrap.appendChild(this.fishElement);
    }

    this.getRandomVector = function(){
      let vector = {
        xDiff: 0,
        yDiff: 0, 
        angle: 0,
      }

      vector.yDiff = Math.random() * (this.vectorYMax - this.vectorYMin) + this.vectorYMin;
      vector.xDiff = Math.random() * (this.vectorXMax - this.vectorXMin) + this.vectorXMin;
      
      console.log("\n");
      console.log("xDiff " + vector.xDiff)
      console.log("yDiff " + vector.yDiff)
      if(Math.abs(vector.xDiff) <= Math.abs(vector.yDiff)){
        console.log("less than")
        if(vector.xDiff < 0){
          vector.xDiff -= Math.abs(vector.yDiff)
        }
        else if(vector.xDiff >= 0){
          vector.xDiff += Math.abs(vector.yDiff)
        }
        console.log("NEWxDiff " + vector.xDiff)
        console.log("NEWyDiff " + vector.yDiff)
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

        this.xPos += this.xIncrement;
        this.yPos += this.yIncrement;
        this.updateAngle();
        
        this.fishElement.style.transform = `translateX(${this.xPos}px) translateY(${this.yPos}px) rotate(${this.orientation}rad)`;
      this.#animateID = requestAnimationFrame(() => { this.animate(); });
    }


  }

  fillColor() {
    this.isColored = true;
  }

  updateVector() {
    this.currentVector = this.getRandomVector()
    this.xIncrement = this.currentVector.xDiff;
    this.yIncrement = this.currentVector.yDiff;
    this.updateAngle()
  }

  updateAngle() {
    this.orientation =  Math.atan2(this.yIncrement,  this.xIncrement) + Math.PI;
  }


}