<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 
<?php $form = ActiveForm::begin(); ?>
 
    <?= $form->field($model, 'nombre'); ?>
    <?= $form->field($model, 'direccion'); ?>
    <?= $form->field($model, 'telefono'); ?>
     
    <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success center-block' : 'btn btn-primary center-block']); ?>
 
<?php ActiveForm::end(); ?>