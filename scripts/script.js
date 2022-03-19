import { ProgBar } from "./prog-bar.js";

$(document).ready(function() {

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

    console.log(typeof ProgBar)
    let fishProgressBar = new ProgBar();
    fishProgressBar.update(testData);
});