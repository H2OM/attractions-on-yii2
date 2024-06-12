document.addEventListener("DOMContentLoaded", ()=>{

    const FORM_CONTAINER = document.querySelector('.Form');

    let SUBMIT_BTN = FORM_CONTAINER.querySelector('.Form__form__submit');
    let FORM = FORM_CONTAINER.querySelector('.Form__form');

    FORM.addEventListener('input', reactiveInputValidation);
    SUBMIT_BTN.addEventListener('click', baseFormValidation);

    //Скрытие показанного уведомления об отправке
    let observer = new MutationObserver(()=>{

        FORM.removeEventListener('input', reactiveInputValidation);
        SUBMIT_BTN.removeEventListener('click', baseFormValidation);

        const NOTIFICATION = FORM_CONTAINER.querySelector('.Notification');

        FORM = FORM_CONTAINER.querySelector('.Form__form');
        SUBMIT_BTN = FORM_CONTAINER.querySelector('.Form__form__submit');

        FORM.addEventListener('input', reactiveInputValidation);
        SUBMIT_BTN.addEventListener('click', baseFormValidation);

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


    function reactiveInputValidation({target}) {

    }

    //Валидация основной формы
    function baseFormValidation (e) {

        console.log("аафа");

        const formData = new FormData(FORM_CONTAINER.querySelector('.Form__form'));

        let isSuccess = true;

        if(!formData.has('Incoming[agreement]') || formData.get('Incoming[agreement]') !== 'on') isSuccess = false;

        if(!formData.has('Incoming[name]') || !checkNameInput(formData.get('Incoming[name]'))) {

            //отображение ошибки
            //...
            isSuccess = false;
        }
        if(!formData.has('Incoming[mail]') || !checkMailInput(formData.get('Incoming[mail]'))) {

            //отображение ошибки
            //...
            isSuccess = false;
        }
        if(!formData.has('Incoming[number]') || !checkNumberInput(formData.get('Incoming[number]'))) {

            //отображение ошибки
            //...
            isSuccess = false;
        }
        if(!formData.has('Incoming[text]') || !checkTextInput(formData.get('Incoming[text]'))) {

            //отображение ошибки
            //...
            isSuccess = false;
        }

        if (!isSuccess) {

            e.preventDefault();

        } else {
            FORM_CONTAINER.querySelector('.Notification__blackout').classList.add('Notification__blackout_show');
        }
    }

    //Проверка имени
    function checkNameInput(value) {return (value.length > 2 && value.length <= 70 && value.match(/^(([А-я]+[ ]?)+)$/) !== null);}

    //Проверка почты
    function checkMailInput(value) {return (value.length !== '' && value.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g) !== null);}

    //Проверка телефона
    function checkNumberInput(value) {return ((value.length === 10 && value.match(/\D/g) === null) || value.length === 0);}

    //Проверка текст-бокса
    function checkTextInput(value) {return (value.length >= 10 && value.length <= 1200);}
});