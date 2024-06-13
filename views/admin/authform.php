<?php

    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;

    /** @var string|null $errorMessage */
?>

<section class="Auth">
    <div class="container" style="width: 900px">
        <h1 class="title Uptitle_full">Авторизация</h1>
        <?php
        if($errorMessage !== null):?>
            <h2 style="color: red;" ><?= Html::encode($errorMessage)?></h2>
        <?php endif;?>
        <?php ActiveForm::begin([
            'enableClientValidation'=> false,
            'fieldConfig'=>['enableLabel'=>false],
            'options'=>['style'=>'margin-top: 60px']
        ]);?>

            <input id="loginInput" style="padding: 10px 25px;" class="Form__form__input" name="username" type="text">
            <input id="passwordInput" style="padding: 10px 25px;" class="Form__form__input" name="password" type="password">

            <?= Html::submitButton('Авторизация', ['class'=>'Form__form__submit', 'style'=>'width: 100%; height: 50px'])?>

        <?php ActiveForm::end()?>
    </div>
</section>
