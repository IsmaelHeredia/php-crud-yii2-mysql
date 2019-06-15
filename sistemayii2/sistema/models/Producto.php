<?php

namespace app\models;
 
use Yii;
 
class Producto extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'productos';
    }

    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'precio','id_proveedor'], 'required']
        ];
    }   

    public function buscarProveedor($id)
    {
        $proveedor = Proveedor::findOne($id);
        return $proveedor->nombre;
    }

    public function verificar_producto_crear($nombre) {
        $producto = Producto::find()->where("nombre = :nombre", ["nombre"=>$nombre])->all();
        if($producto) {
            return true;
        } else {
            return false;
        }
    }

    public function verificar_producto_editar($nombre,$id) {
        $producto = Producto::find()->where("nombre = :nombre and id != :id", ["nombre"=>$nombre,"id"=>$id])->all();
        if($producto) {
            return true;
        } else {
            return false;
        }
    }

}
