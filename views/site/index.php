<?php

/** @var yii\web\View $this */
/** @var app\models\Slider  $model */
/** @var array $slider */
/** @var array $news */

$this->title = 'TopAttractions';
$this->params['meta_description'] = 'Достопримечательности Краснодарского края';
?>

<?= $this->render('blocks-index/slider', ['slider'=> $slider]) ?>
<?= $this->render('news', ['news'=>$news]);