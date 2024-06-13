<?php



use yii\widgets\LinkPager;
use yii\helpers\Html;

/** @var array $catalog */
/** @var yii\data\Pagination $pagination */
/** @var yii\web\View $this */

$this->title = 'Каталог';
?>

<section class="Catalog">
    <div class="container">
        <h1 class="title Uptitle_full"><?=Html::encode($this->title)?></h1>
        <div class="Catalog__grid">
            <?php foreach($catalog as $each):?>
                <div class="Catalog__grid__cart">
                    <?=Html::img('web/images/' . $each->image, ['alt'=>'image', 'class'=>'Catalog__grid__cart__image'])?>
                    <div class="Catalog__grid__cart__desc">
                        <div class="Catalog__grid__cart__desc__up">
                            <h3 class="subtitle"><?=Html::encode($each->title)?></h3>
                        </div>
                        <p class="Catalog__grid__cart__desc__text"><?=substr($each->text, 0, 1200). '...'?></p>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <?= LinkPager::widget(['pagination'=>$pagination])?>
    </div>

</section>

