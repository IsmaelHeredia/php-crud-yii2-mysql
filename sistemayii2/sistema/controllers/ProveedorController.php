<?php

namespace app\controllers;

use Yii;
use app\models\Proveedor;
use yii\web\Controller;
use yii\web\Session;

class ProveedorController extends Controller {

    public $session = "";

    public function beforeAction($action)
    {
        $this->session = Yii::$app->session;
        return parent::beforeAction($action);
    }

    public function actionCreate() {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            $model = new Proveedor();
            $model->fecha_registro = date("Y-m-d");
            if($model->load(Yii::$app->request->post())) {
                $nombre = $model->nombre;
                if($model->verificar_proveedor_crear($nombre)) {
                    Yii::$app->session->setFlash('danger', 'El nombre del proveedor ya existe en la base de datos');
                    return $this->render('create', ['model' => $model]);
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'El proveedor fue registrado correctamente');
                        return $this->redirect(['index']);
                    }
                }
            }
            return $this->render('create', ['model' => $model]);
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

    public function actionIndex() {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            $proveedor = Proveedor::find()->all();
            return $this->render('index', ['model' => $proveedor]);
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

    public function actionEdit($id) {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            $model = Proveedor::find()->where(['id' => $id])->one();
            if ($model === null) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            if($model->load(Yii::$app->request->post())) {
                $nombre = $model->nombre;
                $id_proveedor = $model->id;
                if($model->verificar_proveedor_editar($nombre,$id_proveedor)) {
                    Yii::$app->session->setFlash('danger', 'El nombre del proveedor ya existe en la base de datos');
                    return $this->render('create', ['model' => $model]);
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'El proveedor fue editado correctamente');
                        return $this->redirect(['index']);
                    }
                }
            }
            return $this->render('edit', ['model' => $model]);
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

    public function actionDelete($id) {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            $model = Proveedor::findOne($id);
            if ($model === null)
                throw new NotFoundHttpException('The requested page does not exist.');
            Yii::$app->session->setFlash('success', 'El proveedor fue borrado correctamente');
            $model->delete();
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

}