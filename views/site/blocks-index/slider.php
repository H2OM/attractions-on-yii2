<?php

    use yii\helpers\Html;

    /** @var array $slider */

    ?>


<section class="Slider">
    <div id="sliderWrap" class="Movement__wrap">
        <div class="Movement__slider">
            <?php if(is_array($slider)):?>
                <?php foreach ($slider as $slide):?>
                    <div class="Slider__slider__slide">
                        <div class="container">
                            <h1 class="title title_slide"><?=Html::encode($slide->title)?></h1>
                        </div>
                        <?= Html::img('web/images/' . $slide->image, ['alt' =>$slide->id, 'class'=>'Slider__slider__slide__image'])?>
                    </div>
                <?php endforeach; ?>
            <?php else:?>
                <div class="Error">Ошибка загрузки</div>
            <?php endif; ?>
        </div>
        <nav class="Movement__nav">
            <?= str_repeat("<div data-slider='main-slider' class='Movement__nav__point'></div>", count($slider))?>
        </nav>
    </div>
</section>
