document.addEventListener("DOMContentLoaded", ()=>{

    const FORM_CONTAINER = document.querySelector('.Form');

    let SUBMIT_BTN = FORM_CONTAINER.querySelector('.Form__form__submit');
    let FORM = FORM_CONTAINER.querySelector('.Form__form');



    FORM.addEventListener('input', reactiveInputValidation);
    SUBMIT_BTN.addEventListener('click', baseFormValidation);

    // numberMask({form: FORM, input: '[name="Incoming[number]"]'});

    //Скрытие показанного уведомления об отправке
    let observer = new MutationObserver((mutations)=>{
        console.log(mutations[0].addedNodes);
        FORM.removeEventListener('input', reactiveInputValidation);
        SUBMIT_BTN.removeEventListener('click', baseFormValidation);

        const NOTIFICATION = FORM_CONTAINER.querySelector('.Notification');

        FORM = FORM_CONTAINER.querySelector('.Form__form');
        SUBMIT_BTN = FORM_CONTAINER.querySelector('.Form__form__submit');

        FORM.addEventListener('input', reactiveInputValidation);
        SUBMIT_BTN.addEventListener('click', baseFormValidation);

        // numberMask({form: FORM, input: '[name="Incoming[number]"]'});

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

    observer.observe(FORM_CONTAINER, {subtree: true, childList: true});

    function reactiveInputValidation({target}) {

        switch (target.attributes.name.value) {

            case "Incoming[name]":
                if (!checkNameInput(target.value, false)) {

                    target.value = target.value.slice(0, -1);

                } else if(target.value.length > 2) {
                    //Убрать ошибку
                    removeException({element: target});
                }
                break;

            case "Incoming[mail]":
                if (!checkMailInput(target.value)) {

                    if(target.value.length > 4) {
                        //Показать ошибку
                        createException({
                            element: target,
                            message: "Неверный формат почты"
                        });
                    }
                } else {
                    //Убрать ошибку
                    removeException({element: target});
                }
                break;

            case "Incoming[text]":
                if(!checkTextInput(target.value)) {

                    //Показать ошибку
                    createException({
                        element: target,
                        message: "Длинна сообщения должна составлять от 10 до 1200 символов"
                    });
                } else {
                    //Убрать ошибку
                    removeException({element: target});
                }
                break;

            default:
                break;
        }
    }

    //Валидация основной формы
    function baseFormValidation (e) {

        const formData = new FormData(FORM);

        let isSuccess = true;

        let number = (formData.has('Incoming[number]') ? formData.get('Incoming[number]') : null);

        if(number !== null && number.length > 0 && number.match(/\d+/g)) {
            //+7 (555) 111-22-33 --> 5551112233
            number = number.match(/\d+/g).join('').slice(1);
        }

        if(!formData.has('Incoming[agreement]') || formData.get('Incoming[agreement]') !== 'on') isSuccess = false;

        if(!formData.has('Incoming[name]') || !checkNameInput(formData.get('Incoming[name]'))) {

            let message = (formData.get('Incoming[name]').length > 2 ? "Неверный формат имени" : "Поле должно содержать от 3 до 70 символов");

            //отображение ошибки
            createException({
                element: FORM.querySelector('[name="Incoming[name]"]'),
                message:  message
            });

            isSuccess = false;
        }
        if(!formData.has('Incoming[mail]') || !checkMailInput(formData.get('Incoming[mail]'))) {

            //отображение ошибки
            createException({
                element: FORM.querySelector('[name="Incoming[mail]"]'),
                message: "Неверный формат почты"
            });

            isSuccess = false;
        }
        if(number === null || !checkNumberInput(number)) {

            //отображение ошибки
            createException({
                element: FORM.querySelector('[name="Incoming[number]"]'),
                message: "Неверное значение"
            });

            isSuccess = false;
        }
        if(!formData.has('Incoming[text]') || !checkTextInput(formData.get('Incoming[text]'))) {

            //отображение ошибки
            createException({
                element: FORM.querySelector('[name="Incoming[text]"]'),
                message: "Длинна сообщения должна составлять от 10 до 1200 символов"
            });

            isSuccess = false;
        }

        if (!isSuccess) {

            e.preventDefault();

        } else {
            FORM_CONTAINER.querySelector('.Notification__blackout').classList.add('Notification__blackout_show');
        }
    }

    //Создать label ошибку
    function createException({element, message}) {

        if(element.previousElementSibling === null) {

            const label = document.createElement('label');

            label.setAttribute('htmlFor', element.getAttribute('name'));

            label.classList.add('Form__form__input__error', 'Form__form__input__error_show');

            label.textContent = message;

            element.before(label);
        }
    }

    //Удалить ошибку
    function removeException({element}) { if(element.previousElementSibling !== null) element.previousElementSibling.remove(); }

    //Проверка имени
    function checkNameInput(value, checkMinLength = true) {

        let minLength = (checkMinLength ? (value.length > 2) : true);

        return (minLength && value.length <= 70 && value.match(/^(([А-я]+[ ]?)+)$/) !== null);
    }

    //Проверка почты
    function checkMailInput(value) {return (value.length !== '' && value.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g) !== null);}

    //Проверка телефона
    function checkNumberInput(value) {return ((value.length === 10 && value.match(/\D/g) === null) || value.length === 0);}

    //Проверка текст-бокса
    function checkTextInput(value) {return (value.length >= 10 && value.length <= 1200);}

});

function numberMask ({form,input,always=false}) {
        let phoneMask = {
            mask: "+7 (___) ___-__-__",
            lastNumber:''
        };
        let phoneInput = form.querySelector(input);

        always ? phoneInput.value = phoneMask.mask : phoneInput.value = '';

        phoneInput.addEventListener('focus',(e)=>{
            e.target.value = phoneMask.mask;
        });
        phoneInput.addEventListener('click',(e)=>{
            e.target.setSelectionRange(phoneMask.mask.indexOf('_'),phoneMask.mask.indexOf('_'));
        });
        phoneInput.addEventListener('keydown',(e)=>{

            if (e.key === "Backspace" && phoneMask.lastNumber !== "(") {
                e.preventDefault();
                phoneMask.mask = phoneMask.mask.split('');
                let indexLastNumber = phoneMask.mask.lastIndexOf(phoneMask.lastNumber);

                for( let i = indexLastNumber-1;i>0;i--) {
                    phoneMask.lastNumber = phoneMask.mask[i];
                    if(phoneMask.lastNumber === '-' || phoneMask.lastNumber === ' ' ||  phoneMask.lastNumber === ')') {
                        continue;
                    } else {
                        break;
                    }
                }
                phoneMask.mask[indexLastNumber] = '_';
                phoneMask.mask = phoneMask.mask.join('');

            } else if(e.key !== undefined && RegExp(/_/).test(phoneMask.mask) && (e.key).replace(/([^\d]|\,)/gi, '') !== '') {
                phoneMask.mask = phoneMask.mask.replace(/_/, e.key);
                phoneMask.lastNumber = e.key;
            }
            setTimeout(()=>{
                e.target.value = phoneMask.mask;
                e.target.setSelectionRange(phoneMask.mask.indexOf('_'),phoneMask.mask.indexOf('_'));
            });
        });
}