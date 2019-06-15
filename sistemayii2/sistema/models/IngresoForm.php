<?php

namespace app\models;
 
use Yii;
use app\models\Usuario;

class IngresoForm extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'usuarios';
    }

    public function rules()
    {
        return [
            [['nombre', 'clave'], 'required']
        ];
    }

    public function ingresar($nombre,$clave) {
        $usuario = Usuario::find()->where("nombre = :nombre and clave = :clave", ["nombre"=>$nombre,"clave"=>$clave])->all();
        if($usuario) {
            return true;
        } else {
            return false;
        }
    }

    public function es_admin($nombre) {
        $usuario = Usuario::find()->where("nombre = :nombre and id_tipo = 1", ["nombre"=>$nombre])->all();
        if($usuario) {
            return true;
        } else {
            return false;
        }
    }

}
