<?php

    /** @var yii\web\View $this */
    /** @var array $news */
    use yii\helpers\Html;

    if(Yii::$app->controller->action->id == 'news') {
        $this->title = 'Новости';
    }
?>

<section class="News">
    <div class="container">
        <h2 class="title Uptitle_full"><?=Html::encode($this->title)?></h2>
        <div class="News__blocks">
            <?php if(is_array($news)):?>
                <?php foreach($news as $each):?>
                    <div class="News__blocks__block">
                        <div class="News__blocks__block__split">
                            <div class="subtitle"><?=$each->title?></div>
                            <div class="News__blocks__block__date"><?=$each->date?></div>
                        </div>
                        <div class="News__blocks__block__split">
                            <div class="News__blocks__block__desc"><?=$each->text?></div>
                            <?=Html::img('web/images/' . $each->image,['alt'=>'image', 'class'=>'News__blocks__block__image'])?>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <div class="Error">Ошибка загрузки</div>
            <?php endif;?>
        </div>
        <?php if(Yii::$app->controller->action->id == 'news'):?>

        <?php else:?>
            <div class="News__end">
                <?=Html::a('Смотреть все новости','/site/news', ['class'=>'News__end__link'])?>
                <?=Html::img('web/svg/vector_arrow.svg',
                    [
                        'alt'=>'-->',
                        'class'=>'News__end__arrow',
                        'style'=>'width:20px; height:13px;',
                        'role'=>'arrow'
                    ])?>
            </div>
        <?php endif;?>
    </div>
</section>

