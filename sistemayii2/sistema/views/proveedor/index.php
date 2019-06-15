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
 

<h1>Lista de proveedores</h1>
<table class='table' style="margin-top: 80px">
    <tr>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Fecha registro</th>
        <th>Opcion</th>
    </tr>
    <?php foreach($model as $field){ ?>
    <tr>
        <td><?= $field->nombre; ?></td>
        <td><?= $field->direccion; ?></td>
        <td><?= $field->telefono; ?></td>
        <td><?= Yii::$app->formatter->format($field->fecha_registro, 'date'); ?></td>
        <td><?= Html::a("Editar", ['proveedor/edit', 'id' => $field->id] , ['class' => 'btn btn-success col-xs-3']); ?>   <?= Html::a("Borrar", ['proveedor/delete', 'id' => $field->id], ['class' => 'btn btn-danger col-xs-3']); ?></td>
    </tr>
    <?php }
    echo Html::a('Agregar nuevo proveedor', ['proveedor/create'], ['class' => 'btn btn-primary pull-right']);
    ?>
    
</table>