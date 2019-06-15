<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\IngresoForm;
use app\models\Usuario;
use yii\web\Session;

class CuentaController extends Controller
{
    public $session = "";

    public function beforeAction($action)
    {
        $this->session = Yii::$app->session;
        return parent::beforeAction($action);
    }

    public function actionCambiar_usuario()
    {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            if (Yii::$app->request->post()) {
                $data = Yii::$app->request->post();
                $usuario = Yii::$app->funciones->buscarNombre($this->session->get('ingreso'));
                $nuevo_usuario = $data["nuevo_usuario"];
                $clave = md5($data["clave"]);
                $model_ingreso = new IngresoForm();
                if($model_ingreso->ingresar($usuario,$clave)) {
                    $model_usuario = new Usuario();
                    $id_usuario = $model_usuario->buscarIdPorNombre($usuario);
                    if($model_usuario->verificar_usuario_editar($nuevo_usuario,$id_usuario)) {
                        Yii::$app->session->setFlash('danger', 'El nombre de usuario ya esta siendo utilizado');                        
                        return $this->render('cambiar_usuario');
                    } else {
                        $model_usuario->cambiar_usuario($usuario,$nuevo_usuario,$clave);
                        $this->session->removeAll();
                        Yii::$app->session->setFlash('success', 'El usuario fue cambiado correctamente');
                        return $this->redirect(['sitio/ingreso']);
                    }
                } else {
                    Yii::$app->session->setFlash('danger', 'La clave actual es incorrecta');
                    return $this->redirect(['cambiar_usuario']);                    
                }
            }
            return $this->render('cambiar_usuario');
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

    public function actionCambiar_clave()
    {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {
            if (Yii::$app->request->post()) {
                $data = Yii::$app->request->post();
                $usuario = Yii::$app->funciones->buscarNombre($this->session->get('ingreso'));
                $nueva_clave = md5($data["nueva_clave"]);
                $clave = md5($data["clave"]);
                $model_ingreso = new IngresoForm();
                if($model_ingreso->ingresar($usuario,$clave)) {
                    $model_usuario = new Usuario();
                    $model_usuario->cambiar_clave($usuario,$nueva_clave,$clave);
                    $this->session->removeAll();
                    Yii::$app->session->setFlash('success', 'La clave fue cambiada correctamente');
                    return $this->redirect(['sitio/ingreso']);
                } else {
                    Yii::$app->session->setFlash('danger', 'La clave actual es incorrecta');
                    return $this->redirect(['cambiar_clave']);    
                }
            }
            return $this->render('cambiar_clave');
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }
}
