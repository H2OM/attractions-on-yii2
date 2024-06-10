<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="Header">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('web/images/logo_small.png', ['alt'=>'Logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions'=>['class'=>'Header__flex__logo'],
        'options' => ['class'=> 'Header__flex container container_head navbar-expand-lg']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'Header__flex__links'],
        'items' => [
            ['label' => 'каталог', 'url' => ['/site/catalog'], 'options'=>['class'=>'smalltitle Header__flex__links__link']],
            ['label' => 'новости', 'url' => ['/site/news'], 'options'=>['class'=>'smalltitle Header__flex__links__link']],
            ['label' => 'контакты', 'url' => ['/site/contacts'], 'options'=>['class'=>'smalltitle Header__flex__links__link']],
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" role="main">
    <?= Alert::widget() ?>
    <?= $content ?>
</main>

<footer class="footer">
    <div class="container Footer__grid">
        <div class="Footer__block">
            <?= Html::img('web/images/logo_medium.png', ['alt'=>'logo', 'class'=>'Footer__logo'])?>
            <div class="Footer__block__section">
                <h3 class="subtitle">Контакты</h3>
                <div role='info' class="Footer__block__section__desc">TopAttractions@gmail.com</div>
                <div role='info' class="Footer__block__section__desc">+7 900 111-11-11</div>
                <div class="Footer__block__section__icons">
                    <?= Html::img('web/svg/icon_telegram.svg', ['alt'=>'tg', 'class'=>'Footer__block__section__icons__icon'])?>
                    <?= Html::img('web/svg/icon_vk.svg', ['alt'=>'tg', 'class'=>'Footer__block__section__icons__icon'])?>
                </div>
            </div>
            <div class="Footer__block__section">
                <h3 class="subtitle">Подпишитесь на новости</h3>
<!--                форма-->
            </div>
        </div>
        <div class="Footer__block Footer__block_second">
            <?=Html::a('Политика конфиденциальности', Yii::$app->homeUrl, ['class'=>"Footer__block__link"])?>
            <?=Html::a('© TopAttractions, 2024', Yii::$app->homeUrl, ['class'=>"Footer__block__section__desc", 'role'=>'info'])?>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
