import { ProgBar } from "./prog-bar.js";
import { Fish } from "./fish.js";

$(document).ready(function() {
    let wrap = document.querySelector(".wrap");

    // preload
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

    // If it is a new user with no data, render empty fish
    if(Object.keys(fishData.length == 0 || fishData[0]).length <= 1){
        for (const i of colorStrings){
            newFormat[i] = 0;
        }
    }
    else {
        for (const i of colorStrings){
            newFormat[i] = fishData[0][i];
        }
    }
    

    // init progress bar and update
    let fishProgressBar = new ProgBar();
    fishProgressBar.update(newFormat);

    // Vertical offset init
    let verticalOffset = window.innerHeight / colorStrings.length;

    // Timer
    var t = 5000;
     
    // Function that changes the timer
    function changeTimer(){
        t = t * 1.3;
    }
    
    // Offset for the fish starting Pos
    function changeVerticalOffset(){
        verticalOffset += verticalOffset / 3;
    }
    
    // Generate all the fish
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
   
    // Help tooltip functionality
    let help = document.querySelector('.help');
    help.onclick = function() {
        var div = document.getElementById('tooltip');
        if (div.style.display !== 'none') {
            div.style.display = 'none';
        }
        else {
            div.style.display = 'block';
        }
    };

    // Scoreboard update
    let scoreboard = {
        streak: document.querySelector("#streak"),
        score: document.querySelector("#total-score"),
    }
    if (totalCount && streakCount){
        scoreboard.score.textContent = totalCount;
        scoreboard.streak.textContent = streakCount;
    }
    

    // wrap.onclick = function() {
    //     var div = document.getElementById('tooltip');
    //     if (div.style.display !== 'none') {
    //         div.style.display = 'none';
    //     };
    // }

});