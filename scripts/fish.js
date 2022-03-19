export class Fish {
  #animateID;

  constructor(fishColor, xPos, yPos, wrap){
    this.fishElement = document.createElement("img");
    this.fishColor = fishColor;
    this.isColored = false;
    // Position
    this.xPos = xPos;
    this.yPos = yPos;
    this.currentVector;
    this.orientation = 0 + 'deg';
    this.createFish = function(fishColor){
      let newFishElement = document.createElement("img");
      newFishElement.setAttribute('src', './assets/red-filled.png');
      newFishElement.setAttribute('class', 'fish');
      wrap.appendChild(newFishElement);
    }
  }

  fillColor() {
    this.isColored = true;
  }

  // animate(){

  //   this.#animateID = document.requestAnimationFrame(self.animate())
  // }
}