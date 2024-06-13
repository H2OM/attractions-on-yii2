<?php

namespace app\controllers;

use app\models\Catalog\Catalog;
use app\models\Catalog\Repository\CatalogRepository;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class AdminController extends Controller
{
    public $layout = 'admin';
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

    public function actionIndex()
    {
        if(Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->request->hostInfo . '/admin/authorization');
        }

        return $this->render('index');

    }

    public function actionAuthorization()
    {
        if(!Yii::$app->user->isGuest) {
            $this->redirect( Yii::$app->request->hostInfo . '/admin');
        }

        $this->layout = 'authorization';

        if(Yii::$app->request->isPost) {

            $request = Yii::$app->request->post();

            $isAllInputExists = (count(array_diff_key(array_flip(['login', 'password']), $request)) === 0);

            if($isAllInputExists) {

                $user = new User();

                $user->setPassword($request['password']);
                $user->setUsername($request['login']);

                if($user->compare()) {
                    Yii::$app->user->login($user->getUsername(), 3600*24*30);
                }
            }
        }

        return $this->render('authform');
    }

    public function actionEdit(string $id = null)
    {
        if(Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->request->hostInfo . '/admin/authorization');
        }

        $catalog = null;

        $message = null;

        if(Yii::$app->request->isPost) {

            $request = Yii::$app->request->post();

            $isAllInputExists = (count(array_diff_key(array_flip(['image', 'title', 'article', 'text', 'city']), $request)) === 0);

            if($isAllInputExists) {

                $catalog = (isset($request['id']) ? CatalogRepository::finByPk($request['id']) : new Catalog());

                $catalog->setAll($request);

                $catalog->save();

                $catalog->refresh();

                $message['message'] = isset($request['id']) ? "Успешное обновление записи" : "Успешное добавление записи";

                $message=['status'=>true];

                Yii::$app->request->setQueryParams(['id'=>$catalog->getId()]);

            } else {
                $message=['message'=>'Не удалось сохранить изменения', 'status'=>false];
            }
        }

        if(Yii::$app->request->isGet) {
            if($id !== null) {
                $catalog = Catalog::find()
                    ->select('*')
                    ->where(['id'=>$id])
                    ->one();
            }
        }

        return $this->render('edit', ['current'=>$catalog, 'message'=>$message]);
    }

    public function actionCatalog(string $count = '0')
    {
        if(Yii::$app->user->isGuest) {
            $this->redirect(Yii::$app->request->hostInfo . '/admin/authorization');
        }

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
}
