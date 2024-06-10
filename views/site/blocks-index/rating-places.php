<?php

    use yii\helpers\Html;

    /** @var array $ratingPlaces */

    ?>


<section class="Main">
    <div class="container">
        <h2 class="title Uptitle_full">Главные в рейтинге</h2>
        <div class="Main__blocks">
            <?php if(is_array($ratingPlaces)):?>
                <?php foreach ($ratingPlaces as $place):?>
                    <div class="Main__blocks__block">
                        <?=Html::a(Html::img('web/images/' . $place->image, ['alt'=>'image', 'class'=>'Main__blocks__block__image']), '/site/catalog/'. $place->article)?>
                        <div class="Main__blocks__block__split">
                            <div class="Main__blocks__block__split__up">
                                <div class="Main__blocks__block__split__up__ontitle">
                                    <h3 class="subtitle"><?=$place->title?></h3>
<!--                                        addToFav-->
                                </div>
<!--                                        RatingBar-->
                            </div>
                            <div class="Main__blocks__block__desc"><?=$place->text?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else:?>
                <div class="Error">Ошибка загрузки</div>
            <?php endif; ?>
        </div>
        <?=Html::a('<button class="Main__button">Смотреть еще</button>','/site/catalog')?>
    </div>
</section>
