<?php

    use yii\helpers\Html;
    use yii\bootstrap5\ActiveForm;
    use yii\widgets\Pjax;
    /** @var app\models\Incoming $model */
    /** @var boolean $success */
    ?>


<section class="Form">
    <div class="container">
        <h2 class="title Uptitle_full">Форма для связи</h2>
        <?php Pjax::begin()?>

            <?php $form = ActiveForm::begin([
                    'action'=>'/form',
                    'options'=>['data'=>['pjax'=>true], 'class'=>'Form__form'],
                    'fieldConfig'=>['enableLabel'=>false]
            ]);?>

                <?= $form->field($model, 'name')
                    ->input('text', ['placeholder'=>'Ваше имя', 'class'=>'Form__form__input'])?>

                <?= $form->field($model, 'mail')
                    ->input('email', ['placeholder'=>'Ваша почта', 'class'=>'Form__form__input'])?>

                <?= $form->field($model, 'number')
                    ->input('text', ['placeholder'=>'Номер телефона', 'class'=>'Form__form__input'])?>

                <?= $form->field($model, 'text')
                    ->textarea(['cols'=>30, 'rows'=>10, 'placeholder'=>'Какой у вас вопрос?', 'class'=>'Form__form__input Form__form__input_area'])?>
                <div class="Form__form__radio">
                    <label for="agreement-input" class="Form__form__radio__label">Подтверждение обработки данных</label>
                    <input type="checkbox" id="agreement-input" name="Incoming[agreement]" class="Form__form__input Form__form__input_radio" required/>
                </div>

                <?= Html::submitButton('Отправить',  ['class'=>'Form__form__submit'])?>

            <?php ActiveForm::end()?>
            <div class="Notification__blackout <?=(isset($success) ? "Notification__blackout_show" : "" )?>">
                <div class="Notification <?=(isset($success) ? ($success ? "Notification_show " : "Notification_show Notification_red")  : "")?>">
                    <div class="Notification__message">
                        <?=(isset($success) ? ($success ? "Ваша обращение зарегистрировано" : "Ошибка отправки")  : "")?>
                    </div>
                </div>
            </div>
        <?php Pjax::end()?>
    </div>
</section>
