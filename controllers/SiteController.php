<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ProdutoSearch;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\BadRequestHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
        $searchModel = new ProdutoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $clientes =  \app\models\ClienteModel::find()->All();
        Yii::$app->view->registerJsFile('@web/js/site/index.js', ['depends' => [\app\assets\AppAsset::className()]]);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'clientes' => $clientes]);
    }

    /**
     * Recupera e trata dados do formulário de venda
     * 
     * */
    public function actionVenda() 
    {
        if(!Yii::$app->request->isAjax)
            throw new BadRequestHttpException("Formato de requisição inválido!");

        $ids = Yii::$app->request->post('ids');

        $produtos = \app\models\ProdutoModel::find()->where(['id' => $ids])->All();
        $total = 0;

        foreach ($produtos as $p) {
            $total += $p->preco;
        }

        $model = new \app\models\VendaModel;

        $model->total =  $total;

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if($model->save()){
            return [
                'message' => 'success',
                'code' => '200'
            ];
        }
        return [
            'message' => 'error'.$model->getErrors(),
            'code' => '400'
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
