<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use yii\web\Controller;
use yii\web\Session;

class ProductoController extends Controller {

    public $session = "";

    public function beforeAction($action)
    {
        $this->session = Yii::$app->session;
        return parent::beforeAction($action);
    }

    public function actionCreate() {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            $model = new Producto();
            $model->fecha_registro = date("Y-m-d");
            if($model->load(Yii::$app->request->post())) {
                $nombre = $model->nombre;
                if($model->verificar_producto_crear($nombre)) {
                    Yii::$app->session->setFlash('danger', 'El nombre del producto ya existe en la base de datos');
                    return $this->render('create', ['model' => $model]);
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'El producto fue registrado correctamente');
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
            $producto = Producto::find()->all();
            return $this->render('index', ['model' => $producto]);
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

    public function actionEdit($id) {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            $model = Producto::find()->where(['id' => $id])->one();
            if ($model === null) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            if($model->load(Yii::$app->request->post())) {
                $id_producto = $model->id;
                $nombre = $model->nombre;
                if($model->verificar_producto_editar($nombre,$id_producto)) {
                    Yii::$app->session->setFlash('danger', 'El nombre del producto ya existe en la base de datos');
                    return $this->render('edit', ['model' => $model]);
                } else {
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'El producto fue actualizado correctamente');
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
            $model = Producto::findOne($id);
            if ($model === null)
                throw new NotFoundHttpException('The requested page does not exist.');
            Yii::$app->session->setFlash('success', 'El producto fue borrado correctamente');
            $model->delete();
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

}