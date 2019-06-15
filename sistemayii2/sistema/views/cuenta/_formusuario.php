<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
 
<?= Html::beginForm(['/cuenta/cambiar_usuario'], 'POST'); ?>
 
	<?= Html::label('Nuevo usuario :', 'lblnuevousuario', ['class' => 'control-label']) ?>
	<?= Html::textInput('nuevo_usuario', '', ['id' => 'nuevo_usuario', 'class' => 'form-control'])
	?>
	<?= Html::label('Clave :', 'lblclave', ['class' => 'control-label']) ?>
	<?= Html::passwordInput('clave', '', ['id' => 'clave', 'class' => 'form-control'])
	?>

	<div class="espacio"></div>

	<?= Html::submitButton('Guardar', ['class' => 'btn btn-primary center-block']); ?>
 
<?= Html::endForm(); ?>