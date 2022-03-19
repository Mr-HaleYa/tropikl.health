export class Fish {
  #animateID;

  constructor(fishColor, xPos, yPos, wrap){
    this.fishElement;
    this.fishColor = fishColor;
    this.isColored = false;
    // Position
    this.xPos = xPos;
    this.yPos = yPos;
    this.currentVector;
    this.orientation = 0 + 'deg';

    this.createFish = function(fishColor){
      this.fishElement = document.createElement("img");
      this.fishElement.setAttribute('src', './assets/red-filled.png');
      this.fishElement.setAttribute('class', 'fish');
      wrap.appendChild(this.fishElement);
    }

    this.xIncrement = .5;
    this.yIncrement = .5;

    this.#animateID = requestAnimationFrame(() => { this.animate(); });

    this.animate = function(){
        // Keep in bounds
        if(this.xPos > window.innerWidth - this.fishElement.offsetWidth || this.xPos < 0){
          this.xIncrement = this.xIncrement * -1
        }

        if(this.yPos > window.innerHeight - this.fishElement.offsetHeight || this.yPos < 0){
          this.yIncrement = this.yIncrement * -1
        }

        this.xPos += this.xIncrement;
        this.yPos += this.yIncrement;

        
        this.fishElement.style.transform = `translateX(${this.xPos}px) translateY(${this.yPos}px)`;
      this.#animateID = requestAnimationFrame(() => { this.animate(); });
    }

    this.getRandomVector = () => {
      let vector = {
        xDiff: 30,
        yDiff: 30, 
        angle: Math.atan2(this.yDiff, this.xDiff) / Math.PI * 180,
      }

      return vector;
    }

    console.log(this.getRandomVector());
  }

  fillColor() {
    this.isColored = true;
  }


}