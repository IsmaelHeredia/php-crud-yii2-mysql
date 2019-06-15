<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\TiposUsuario;
?>
 
<?php $form = ActiveForm::begin(); ?>
 
    <?= $form->field($model, 'nombre'); ?>
     
	<?= $form->field($model, 'id_tipo')
    ->dropDownList(ArrayHelper::map(TiposUsuario::find()->all(),
        'id',
        'nombre'
    ))->label('Tipo') ?>

    <?= Html::submitButton($model->isNewRecord ? 'Agregar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success center-block' : 'btn btn-primary center-block']); ?>
 
<?php ActiveForm::end(); ?>