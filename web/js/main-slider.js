
document.addEventListener("DOMContentLoaded", ()=>{

    //Slider for main slider
    Slider({
        wrapSelector: '#sliderWrap',
        navsSelector: '[data-slider="main-slider"]',
        slidesSelector: '#sliderWrap > .Slider__slider__slide'
    });

    //Slider for compilate slider
    Slider({
        wrapSelector: '#compilateWrap',
        navsSelector: '[data-slider="compilateSlider"]',
        slidesSelector: '.Compilate__blocks__block',
        eachPointEqualThreeSlides: true}
    );

   function Slider({wrapSelector, navsSelector, slidesSelector, eachPointEqualThreeSlides = false}) {

       const WRAP = document.querySelector(`${wrapSelector}`);
       const SLIDES = document.querySelectorAll(`${slidesSelector}`);
       const NAVS = document.querySelectorAll(`${navsSelector}`);

       let current = 0;

       NAVS.forEach((each,i)=>{

           if (i === current) each.classList.add('Movement__nav__point_select');

           NAVS[i].addEventListener('click',(e)=>{

               NAVS[current].classList.remove('Movement__nav__point_select');

               NAVS[i].classList.add('Movement__nav__point_select');

               current = i;

               let translateX = "";

               if (eachPointEqualThreeSlides && current > 0) {

                   translateX = `translateX(calc(-${100*current}% - ${(((current+1) * 3) === SLIDES.length) ? '160px' : '80px'}))`;

               } else {
                   translateX = `translateX(-${100*current}%)`;
               }

               WRAP.style.transform = translateX;
           });
       });
   }
});


