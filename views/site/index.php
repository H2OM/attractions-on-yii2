<?php

/** @var yii\web\View $this */
/** @var app\models\Slider  $model */
/** @var array $slider */
/** @var array $news */
/** @var array $ratingPlaces */
/** @var array $compilatePlaces */

$this->title = 'TopAttractions';
$this->params['meta_description'] = 'Достопримечательности Краснодарского края';
?>

<?= $this->render('blocks-index/slider', ['slider'=> $slider]) ?>
<?= $this->render('news', ['news'=>$news])?>
<?= $this->render('blocks-index/rating-places', ['ratingPlaces'=>$ratingPlaces])?>
<?= $this->render('blocks-index/compilate-places', ['compilatePlaces'=>$compilatePlaces])?>
<?= $this->render('blocks/form')?>
