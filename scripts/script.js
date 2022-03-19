import { ProgBar } from "./prog-bar.js";
import { Fish } from "./fish.js";

$(document).ready(function() {
    let wrap = document.querySelector(".wrap");

    setTimeout(function(){
        $('body').addClass('loaded');
        $('h1').css('color','#222222'); // change text color back after preload
    }, 1000);

    var colorStrings = ["red", "orange", "yellow", "green", "bluePurple", "brown"];

    var format = {
        red: "red",
        orange: "orange",
        yellow: "yellow",
        green: "green", 
        bluePurple: "bluePurple", 
        brown: "brown",
    }

    var newFormat = {}

    for (const i of colorStrings){
        newFormat[i] = fishData[0][i];
    }

    console.log(newFormat)

    let fishProgressBar = new ProgBar();
    fishProgressBar.update(newFormat);

    var fishObjList = [];

    let verticalOffset = window.innerHeight / colorStrings.length;

    // Timer
    var t = 5000;
     
    // Function that changes the timer
    function changeTimer(){
        t = t * 1.4;
    }
     
    function changeVerticalOffset(){
        verticalOffset += verticalOffset / 3;
    }

    for (const key in newFormat) {
        let newFish = new Fish(key, 100, verticalOffset, wrap, newFormat[key]);
        newFish.createFish();
        newFish.animate();
        changeTimer();
        changeVerticalOffset();
        setInterval(() => {
            newFish.updateVector();
        }, t);
    }
    // let redFish = new Fish("red", 100, 100, wrap);
    // console.log(redFish)
    // redFish.createFish();
    // redFish.animate();
    // setInterval(() => {
    //     redFish.updateVector();
    // }, 5000);
});