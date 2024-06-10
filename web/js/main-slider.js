
document.addEventListener("DOMContentLoaded", ()=>{
   const WRAP = document.querySelector(".Movement__slider");
   const NAVS = document.querySelectorAll(".Movement__nav__point");

   let current = 0;

   NAVS.forEach((each,i)=>{
       if (i === current) each.classList.add('Movement__nav__point_select');

       each.addEventListener('click',(e)=>{
            NAVS[current].classList.remove('Movement__nav__point_select');
            NAVS[i].classList.add('Movement__nav__point_select');
            current = i;
            WRAP.style.transform = `translateX(-${100*current}%)`;
       });
   });
});


