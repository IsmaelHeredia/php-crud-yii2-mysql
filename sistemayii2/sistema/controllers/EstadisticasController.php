<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Session;
use yii\db\Query;
use app\models\Producto;

class EstadisticasController extends Controller {

    public $session = "";

    public function beforeAction($action)
    {
        $this->session = Yii::$app->session;
        return parent::beforeAction($action);
    }

    public function actionIndex() {
        if(Yii::$app->funciones->verificar_ingreso($this->session->get('ingreso'))) {

            $array_textos_grafico1 = array();
            $array_series_grafico1 = array();

            $array_textos_grafico2 = array();
            $array_series_grafico2 = array();

            $productos = Producto::find()->all();
            $cantidad_productos = count($productos);

            foreach($productos as $producto) {
                $nombreProducto = $producto->nombre;
                $precio = $producto->precio;
                $serie  = array(
                    'name' => $nombreProducto,
                    'y' => (int) $precio
                );
                array_push($array_textos_grafico1,$nombreProducto);
                array_push($array_series_grafico1,$serie);
            }

            $textos_grafico1 = json_encode($array_textos_grafico1);
            $series_grafico1 =  json_encode($array_series_grafico1);

            $resultados = Yii::$app->db->createCommand('SELECT prov.nombre, COUNT(prod.id_proveedor) as cantidad FROM productos prod, proveedores prov WHERE prod.id_proveedor = prov.id GROUP BY nombre')
            ->queryAll();

            foreach($resultados as $resultado) {
                $nombreEmpresa = $resultado['nombre'];
                $cantidad = $resultado['cantidad'];
                $serie  = array(
                    'name' => $nombreEmpresa,
                    'y' => (int) $cantidad
                );
                array_push($array_textos_grafico2,$nombreEmpresa);
                array_push($array_series_grafico2,$serie);
            }

            $textos_grafico2 = json_encode($array_textos_grafico2);
            $series_grafico2 =  json_encode($array_series_grafico2);

            return $this->render('index', ['productos' => $productos, 'cantidad_productos' => $cantidad_productos, 'textos_grafico1' => $textos_grafico1, 'series_grafico1' => $series_grafico1, 'textos_grafico2' => $textos_grafico2, 'series_grafico2' => $series_grafico2]);
        } else {
            return $this->redirect(['sitio/ingreso']);
        }
    }

}