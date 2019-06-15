<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\IngresoForm;
use app\models\ContactForm;
use yii\web\Session;

class SitioController extends Controller
{
    public $session = "";

    public function beforeAction($action)
    {
        $this->layout = 'main_ingreso';
        $this->session = Yii::$app->session;
        return parent::beforeAction($action);
    }

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
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            return $this->render('index');
        } else {
            return $this->render('index');
        }
    }

    public function actionIngreso()
    {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            return $this->redirect(['producto/index']);
        }

        $model = new IngresoForm();
        
        if ($model->load(Yii::$app->request->post())) {
            
            $nombre = $model->nombre;
            $clave = md5($model->clave);

            if($model->ingresar($nombre,$clave)) {
                $session = Yii::$app->session;
                $contenido = base64_encode($nombre."@".$clave);
                $session->set('ingreso', $contenido);
                Yii::$app->session->setFlash('success', 'Bienvenido al panel de administración');
                return $this->redirect(['producto/index']);
            } else {
                Yii::$app->session->setFlash('danger', 'El usuario o contraseña son incorrectos');
            }
        }

        $model->clave = '';
        return $this->render('ingreso', [
            'model' => $model,
        ]);
    }

    public function actionSalir()
    {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            $this->session->removeAll();
            return $this->goHome();
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }
}
