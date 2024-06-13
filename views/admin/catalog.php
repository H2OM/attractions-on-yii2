<?php
    use yii\widgets\LinkPager;
    use yii\helpers\Html;
    /** @var array $catalog */
    /** @var yii\data\Pagination $pagination */
?>

<section class="Catalog">
    <div class="container">
        <h1 class="title Uptitle_full">Просмотр каталога</h1>
        <div class="Catalog__grid">
            <?php foreach($catalog as $each):?>
            <div class="Catalog__grid__cart" style="cursor:auto;">
                <?=Html::img( Yii::$app->request->hostInfo . '/web/images/' . $each->image,
                    ['alt'=>'image', 'class'=>'Catalog__grid__cart__image', 'style'=>'height: 150px; width: 190px;'])
                ?>
                <div class="Catalog__grid__cart__desc">
                    <div class="Catalog__grid__cart__desc__up" style="justify-content: space-between;">
                        <h3 class="smalltitle">Заголовок: <?=Html::encode($each->title)?></h3>
                        <h4 class="smalltitle">Артикль: <?=Html::encode($each->article)?></h4>
                        <h4 class="smalltitle">Город: <?=Html::encode($each->city)?></h4>
                        <?=Html::a('Редактировать', '/admin/edit?id=' . $each->id, ['style'=>'text-decoration: underline;'])?>
                    </div>
                    <p class="Catalog__grid__cart__desc__text" style="margin-top: 20px"><?=Html::encode($each->text)?></p>
                </div>
            </div>
            <?php endforeach;?>
        </div>

        <?= LinkPager::widget(['pagination'=>$pagination])?>
    </div>
</section>
