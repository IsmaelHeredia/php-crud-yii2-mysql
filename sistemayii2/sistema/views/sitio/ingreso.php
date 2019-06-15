<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\IngresoForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Ingreso';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel contenedor panel-primary">
  <div class="panel-heading">Ingreso</div>
  <div class="panel-body">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal'
    ]); ?>

        <?= $form->field($model, 'nombre')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'clave')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary center-block', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>

