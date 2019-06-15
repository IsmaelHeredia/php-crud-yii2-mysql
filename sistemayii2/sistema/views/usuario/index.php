<?php
use yii\helpers\Html;
?>
 
<style>
a
{
    margin-right: 10px;
    margin-left: 10px;
}
</style>
 

<h1>Lista de usuarios</h1>
<table class='table' style="margin-top: 80px">
    <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Fecha registro</th>
        <th>Opcion</th>
    </tr>
    <?php foreach($model as $field){ ?>
    <tr>
        <td><?= $field->nombre; ?></td>
        <td><?= $field->buscarTipo($field->id_tipo); ?></td>
        <td><?= Yii::$app->formatter->format($field->fecha_registro, 'date'); ?></td>
        <td><?= Html::a("Editar", ['usuario/edit', 'id' => $field->id] , ['class' => 'btn btn-success col-xs-3']); ?>   <?= Html::a("Borrar", ['usuario/delete', 'id' => $field->id], ['class' => 'btn btn-danger col-xs-3']); ?></td>
    </tr>
    <?php }
    echo Html::a('Agregar nuevo usuario', ['usuario/create'], ['class' => 'btn btn-primary pull-right']);
    ?>
    
</table>