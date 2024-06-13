<?php
    use yii\bootstrap5\ActiveForm;
    use yii\helpers\Html;

    /** @var array $current */
    /** @var array|null $message */

?>

<section class="Edit">
    <div class="container">

        <?php if ($message !== null && isset($message['message'])):?>
            <div class="Edit__message <?=$message['status'] ? "Edit__message_success" : "Edit__message_error"?>">
                <?=$message['message']?>
            </div>
        <?php endif;?>

        <h1 class="title Uptitle_full"><?= ($current === null ? "Добавление новой записи" : 'Редактирование <br/>' . '"' . $current['title'].'"')?></h1>

        <?php ActiveForm::begin([
            'enableClientValidation'=> false,
            'fieldConfig'=>['enableLabel'=>false]
        ]);?>

            <?php if(isset($current['id'])):?>
                <input name="id" value="<?=$current['id']?>" type="text" hidden="hidden"/>
            <?php endif;?>

            <label for="title">Заголовок:</label>
            <input id="title" name="title" class="Form__form__input" value="<?= $current['title'] ?? ""?>" type="text"/>

            <label for="article">Артикль:</label>
            <input id="article" name="article" class="Form__form__input" value="<?=$current['article'] ?? ""?>" type="text"/>

            <label for="image">Изображение:</label>
            <input id="image" name="image" class="Form__form__input" value="<?=$current['image'] ?? ""?>" type="text"/>

            <label for="city">Город:</label>
            <input id="city" name="city" class="Form__form__input" value="<?=$current['city'] ?? ""?>" type="text"/>

            <label for="text">Текст:</label>
            <textarea id="text" cols="30" rows="10" name="text" class="Form__form__input" type="text"><?=$current['text'] ?? ""?></textarea>

            <?= Html::submitButton('Отправить',  ['class'=>'Form__form__submit', 'style'=>'width: 100%;'])?>
        <?php ActiveForm::end()?>

    </div>
</section>
