<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\IngresoForm;
 
class Funciones extends Component
{
	public function verificar_ingreso($session)
	{
		$contenido = base64_decode($session);
		if($contenido != "") {
			$split = explode("@", $contenido);
			$nombre = $split[0];
			$clave = $split[1];
			$model = new IngresoForm();
			if($model->ingresar($nombre,$clave)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function es_admin($session)
	{
		$contenido = base64_decode($session);
		if($contenido != "") {
			$split = explode("@", $contenido);
			$nombre = $split[0];
			$clave = $split[1];
			$model = new IngresoForm();
			if($model->es_admin($nombre,$clave)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function buscarNombre($session)
	{
		$nombre = "";
		$contenido = base64_decode($session);
		if($contenido != "") {
			$split = explode("@", $contenido);
			$nombre = $split[0];
		}
		return $nombre;
	}

}

?>