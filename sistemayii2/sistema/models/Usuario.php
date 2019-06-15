<?php

namespace app\models;
 
use Yii;
 
class Usuario extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'usuarios';
    }
    
    public function rules()
    {
        return [
            [['nombre', 'clave', 'id_tipo'], 'required']
        ];
    }  

    public function buscarTipo($id)
    {
        $tipo = TiposUsuario::findOne($id);
        return $tipo->nombre;
    }

    public function buscarIdPorNombre($nombre)
    {
        $usuario = Usuario::find()->where("nombre = :nombre", ["nombre"=>$nombre])->all();
        return $usuario[0]->id;
    }

    public function verificar_usuario_crear($nombre) {
        $usuario = Usuario::find()->where("nombre = :nombre", ["nombre"=>$nombre])->all();
        if($usuario) {
            return true;
        } else {
            return false;
        }
    }

    public function verificar_usuario_editar($nombre,$id) {
        $usuario = Usuario::find()->where("nombre = :nombre and id != :id", ["nombre"=>$nombre,"id"=>$id])->all();
        if($usuario) {
            return true;
        } else {
            return false;
        }
    }

    public function cambiar_usuario($usuario,$nuevo_usuario,$clave) {
        $buscar_usuario = Usuario::find()->select(["id","nombre","clave"])->where("nombre = :usuario", [":usuario"=>$usuario])->One();
        $id = $buscar_usuario->id;
        $usuario = Usuario::findOne($id);
        $usuario->nombre = $nuevo_usuario;
        $usuario->save();
    }

    public function cambiar_clave($usuario,$nueva_clave,$clave) {
        $buscar_usuario = Usuario::find()->select(["id","nombre","clave"])->where("nombre = :usuario", [":usuario"=>$usuario])->One();
        $id = $buscar_usuario->id;
        $usuario = Usuario::findOne($id);
        $usuario->clave = $nueva_clave;
        $usuario->save();     
    }

}
