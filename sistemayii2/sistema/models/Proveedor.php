<?php

namespace app\models;
 
use Yii;
 
class Proveedor extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'proveedores';
    }
    
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'telefono'], 'required']
        ];
    }   

    public function verificar_proveedor_crear($nombre) {
        $proveedor = Proveedor::find()->where("nombre = :nombre", ["nombre"=>$nombre])->all();
        if($proveedor) {
            return true;
        } else {
            return false;
        }
    }

    public function verificar_proveedor_editar($nombre,$id) {
        $proveedor = Proveedor::find()->where("nombre = :nombre and id != :id", ["nombre"=>$nombre,"id"=>$id])->all();
        if($proveedor) {
            return true;
        } else {
            return false;
        }
    }

}
