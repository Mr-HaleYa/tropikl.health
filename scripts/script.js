import { ProgBar } from "./prog-bar.js";
import { Fish } from "./fish.js";

$(document).ready(function() {
    let wrap = document.querySelector(".wrap");
    let testData = {
        "red": 0, 
        "orange": 1,
        "yellow": 0, 
        "green": 1,
        "bluePurple": 0,
        "brown": 1,
    };

    setTimeout(function(){
        $('body').addClass('loaded');
        $('h1').css('color','#222222'); // change text color back after preload
    }, 1000);

    let fishProgressBar = new ProgBar();
    fishProgressBar.update(testData);

    let redFish = new Fish("red", 100, 100, wrap);
    console.log(redFish)
    redFish.createFish();
    redFish.animate();
    setInterval(() => {
        console.log("interval");
        console.log("xIncrement:" + redFish.xIncrement)
        console.log("yIncrement:" + redFish.yIncrement)
        redFish.updateVector();
    }, 2000);
});