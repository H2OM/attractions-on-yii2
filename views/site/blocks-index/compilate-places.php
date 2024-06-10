<?php

    use yii\helpers\Html;

    /** @var array $compilatePlaces */

    ?>


<section class="Compilate">
    <div class="container">
        <h2 class="title Uptitle_full">Подборка <br /> достопримечательностей</h2>
        <div class="Movement__wrap">
            <div id="compilateWrap" class="Movement__blocks">
                <?php if(is_array($compilatePlaces)):?>
                    <?php foreach ($compilatePlaces as $place):?>
                        <div>
                            <div class="Compilate__blocks__block">
                                <?=Html::a(Html::img('web/images/' . $place->image, ['alt'=>'image', 'class'=>'Compilate__blocks__block__image']), '/site/catalog/'. $place->article)?>
                                <div class="Compilate__blocks__block__split">
                                    <div class="Compilate__blocks__block__split__up">
                                        <div class="Compilate__blocks__block__split__up__ontitle">
                                            <h3 class="subtitle"><?=$place->title?>></h3>
                                            <!--                                    AddToFav-->
                                        </div>
                                        <!--                                        RatingBar-->
                                    </div>
                                    <div class="Compilate__blocks__block__desc"><?=$place->text?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else:?>
                    <div class="Error">Ошибка загрузки</div>
                <?php endif; ?>
            </div>
            <nav class="Movement__nav" style="bottom: -90px">
                <?= str_repeat("<div data-slider='compilateSlider' class='Movement__nav__point'></div>", count($compilatePlaces)/3)?>
            </nav>
        </div>
    </div>
</section>
