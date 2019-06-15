<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Proveedor;
?>
 
<?php $form = ActiveForm::begin(); ?>
 
    <?= $form->field($model, 'nombre'); ?>
    <?= $form->field($model, 'descripcion'); ?>
    <?= $form->field($model, 'precio'); ?>
     
	<?= $form->field($model, 'id_proveedor')
    ->dropDownList(ArrayHelper::map(Proveedor::find()->all(),
        'id',
        'nombre'
    ))->label('Proveedor') ?>

    <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success center-block' : 'btn btn-primary center-block']); ?>
 
<?php ActiveForm::end(); ?>