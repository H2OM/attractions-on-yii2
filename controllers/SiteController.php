<?php

namespace app\controllers;

use app\models\Catalog\Catalog;
use app\models\Catalog\Repository\CatalogRepository;
use app\models\Incoming;
use app\models\News;
use app\models\Slider;
use app\services\formValidator;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $slider = Slider::getSlides();
        $news = News::getLastNews();
        $ratingPlaces = CatalogRepository::getRatingCatalog();
        $compilatePlaces = CatalogRepository::getCompilateCatalog();
        $model = new Incoming();

        return $this->render('index', [
            'slider'=> $slider,
            'news'=>$news,
            'ratingPlaces'=>$ratingPlaces,
            'compilatePlaces'=>$compilatePlaces,
            'model'=> $model
        ]);
    }
    public function actionContacts()
    {
        return $this->render('contacts');
    }
    public function actionNews(int $count = 3)
    {
        $news = News::getNews($count);
        return $this->render('news', [
            'news'=>$news
        ]);
    }
    public function actionCatalog()
    {
        $query = Catalog::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $catalog = $query->orderBy('title')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('catalog', [
            'catalog'=>$catalog,
            'pagination'=>$pagination
        ]);
    }

    /**
//     * @throws BadRequestHttpException
     */
    public function actionForm()
    {
        if(Yii::$app->request->isAjax) {

            $incoming = new Incoming();

            $request = Yii::$app->request->post()['Incoming'];

            $isAllInputExists = (count(array_diff_key(array_flip(['name', 'mail', 'agreement', 'number', 'text']), $request)) === 0);

            $incoming->setAll($request);

            if(!$isAllInputExists || !FormValidator::validate($request)) {

                return $this->render('blocks/form', ['model'=>$incoming, 'success'=>false]);

//              throw new \yii\web\BadRequestHttpException();
            }

            try {

                $incoming->save();

                $incoming = new Incoming();

                return $this->render('blocks/form', ['model'=>$incoming, 'success'=>true]);

            } catch (\yii\db\Exception $e) {
                return $this->render('blocks/form', ['model'=>$incoming, 'success'=>false]);
            }

        } else {
            return $this->redirect('/');
        }
    }
}
