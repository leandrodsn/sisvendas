<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
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
        $searchModel = new \app\models\Produto;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        Yii::$app->view->registerJsFile('@web/js/site/index.js', ['depends' => [\app\assets\AppAsset::className()]]);

        return $this->render('index', ['provider'=>$dataProvider, 'model'=>$dataProvider->models]);
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

    public function actionCadastroProduto()
    {

        $productForm = new \app\models\Produto;

        return $this->render('cadastrar-produto', ['productForm' => $productForm]);
    }
}
