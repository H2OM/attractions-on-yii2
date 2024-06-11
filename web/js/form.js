document.addEventListener("DOMContentLoaded", ()=>{

    const FORM_CONTAINER = document.querySelector('.Form');

    let observer = new MutationObserver(mutationRecords=>{

        const NOTIFICATION = FORM_CONTAINER.querySelector('.Notification');

       if(NOTIFICATION.classList.contains('Notification_show')) {

           setTimeout(()=> {

               NOTIFICATION.classList.remove('Notification_show', 'Notification_red');

               setTimeout(()=> {

                   NOTIFICATION.parentElement.classList.remove('Notification__blackout_show');

                   NOTIFICATION.firstElementChild.textContent = "";

               }, 200);

           },3000);
       }
    });

    observer.observe(FORM_CONTAINER, {childList: true, subtree: true});
});