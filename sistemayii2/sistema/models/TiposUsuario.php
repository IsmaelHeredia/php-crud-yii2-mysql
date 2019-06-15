<?php

namespace app\models;
 
use Yii;
 
class TiposUsuario extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tipos_usuarios';
    }
    
    public function rules()
    {
        return [
            [['nombre'], 'required']
        ];
    }   
}
