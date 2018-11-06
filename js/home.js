// home imgaes slider interactivity
$(document).ready(function(){

let slides = document.querySelectorAll('.slide'),
    arrowRight = document.querySelector('#arrow-right'),
    arrowLeft = document.querySelector('#arrow-left'),
    current = 0;


    // Set all the imgs slide to display none
    function reset(){
        for(let i =0; i<slides.length; i++){
            slides[i].style.display = "none";
        }
    }

    // init slide
    function startSlide(){
        reset();
        slides[0].style.display = 'block';
    }

    function slideRight(){
        reset();
        slides[(current + 1)].style.display = 'block';
        current++;
    }

    function slideLeft(){
        reset();
        slides[current - 1].style.display = 'block';
        current--;
    }

    if(arrowRight){
        arrowRight.addEventListener('click', function(){
            if(current >= slides.length - 1 ) current = -1;
            slideRight();
        });
    }

    if(arrowLeft){
        arrowLeft.addEventListener('click', function(){
            if(current <= 0) current = slides.length;
            slideLeft()
        });
    }


    setInterval(function(){
        console.log(current);
        if (current >= slides.length - 1) current = -1;

        slideRight();
    }, 10000);


    startSlide();


});
