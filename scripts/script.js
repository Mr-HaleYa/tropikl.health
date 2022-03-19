$(document).ready(function() {
    setTimeout(function(){
        $('body').addClass('loaded');
        $('h1').css('color','#222222'); // change text color back after preload
    }, 1000);
});