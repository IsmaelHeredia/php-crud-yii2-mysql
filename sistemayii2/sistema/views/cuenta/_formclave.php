<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
 
<?= Html::beginForm(['/cuenta/cambiar_clave'], 'POST'); ?>
 
	<?= Html::label('Nueva clave :', 'lblnuevaclave', ['class' => 'control-label']) ?>
	<?= Html::passwordInput('nueva_clave', '', ['id' => 'nueva_clave', 'class' => 'form-control'])
	?>
	<?= Html::label('Clave :', 'lblclave', ['class' => 'control-label']) ?>
	<?= Html::passwordInput('clave', '', ['id' => 'clave', 'class' => 'form-control'])
	?>
    
    <div class="espacio"></div>

    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary center-block']); ?>
 
<?= Html::endForm(); ?>