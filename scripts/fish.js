export class Fish {
  #animateID;
  vectorSize = 100;

  constructor(fishColor, xPos, yPos, wrap){
    this.fishElement;
    this.fishColor = fishColor;
    this.isColored = false;
    // Position
    this.xPos = xPos;
    this.yPos = yPos;
  
    this.orientation = 0 + 'deg';

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
      }

      vector.xDiff = Math.floor(Math.random() * this.vectorSize)
      vector.yDiff = Math.floor(Math.random() * this.vectorSize)

      return vector;
    }

    this.currentVector = this.getRandomVector();
    this.xIncrement = this.currentVector.xDiff / this.currentVector.yDiff;
    this.yIncrement = this.currentVector.yDiff / this.currentVector.xDiff;;

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


    console.log(this.getRandomVector());
  }

  fillColor() {
    this.isColored = true;
  }


}