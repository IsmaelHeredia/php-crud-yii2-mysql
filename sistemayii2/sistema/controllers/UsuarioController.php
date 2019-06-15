<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\TiposUsuario;
use yii\web\Controller;
use yii\web\Session;

class UsuarioController extends Controller {

    public $session = "";

    public function beforeAction($action)
    {
        $this->session = Yii::$app->session;
        return parent::beforeAction($action);
    }

    public function actionCreate() {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            if(Yii::$app->funciones->es_admin($this->session->get('ingreso'))) {
                $model = new Usuario();
                if ($model->load(Yii::$app->request->post())) {
                    if($model->load(Yii::$app->request->post())) {
                        $nombre = $model->nombre;
                        if($model->verificar_usuario_crear($nombre)) {
                            Yii::$app->session->setFlash('danger', 'El nombre del usuario ya existe en la base de datos');
                            return $this->render('create', ['model' => $model]);
                        } else {
                            $model->clave = md5($model->clave);
                            $model->fecha_registro = date("Y-m-d");
                            $model->save();
                            Yii::$app->session->setFlash('success', 'El usuario fue registrado correctamente');
                            return $this->redirect(['index']);
                        }
                    }
                }
                return $this->render('create', ['model' => $model]);
            } else {
                Yii::$app->session->setFlash('danger', 'Solo el administrador tiene acceso a esta area');
                return $this->redirect(['producto/index']);
            }
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

    public function actionIndex() {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            if(Yii::$app->funciones->es_admin($this->session->get('ingreso'))) {
                $usuario = Usuario::find()->all();
                return $this->render('index', ['model' => $usuario]);
            } else {
                Yii::$app->session->setFlash('danger', 'Solo el administrador tiene acceso a esta area');
                return $this->redirect(['producto/index']);
            }
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

    public function actionEdit($id) {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            if(Yii::$app->funciones->es_admin($this->session->get('ingreso'))) {
                $model = Usuario::find()->where(['id' => $id])->one();
                if ($model === null) {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    Yii::$app->session->setFlash('success', 'El usuario fue editado correctamente');
                    return $this->redirect(['index']);
                }
                return $this->render('edit', ['model' => $model]);
            } else {
                Yii::$app->session->setFlash('danger', 'Solo el administrador tiene acceso a esta area');
                return $this->redirect(['producto/index']);
            }
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

    public function actionDelete($id) {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            if(Yii::$app->funciones->es_admin($this->session->get('ingreso'))) {
                $model = Usuario::findOne($id);
                if ($model === null)
                    throw new NotFoundHttpException('The requested page does not exist.');
                $model->delete();
                Yii::$app->session->setFlash('success', 'El usuario fue borrado correctamente');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('danger', 'Solo el administrador tiene acceso a esta area');
                return $this->redirect(['producto/index']);
            }
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

}