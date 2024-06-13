<?php

    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

?>

<section class="Auth">
    <div class="container" style="width: 900px">
        <h1 class="title Uptitle_full">Авторизация</h1>
        <?php ActiveForm::begin([
            'enableClientValidation'=> false,
            'fieldConfig'=>['enableLabel'=>false],
            'options'=>['style'=>'margin-top: 60px']
        ]);?>

            <input id="loginInput" style="padding: 10px 25px;" class="Form__form__input" name="login" type="text">
            <input id="passwordInput" style="padding: 10px 25px;" class="Form__form__input" name="password" type="text">

            <?= Html::submitButton('Авторизация', ['class'=>'Form__form__submit', 'style'=>'width: 100%; height: 50px'])?>

        <?php ActiveForm::end()?>
    </div>
</section>
