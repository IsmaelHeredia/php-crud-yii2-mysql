<h1 align="center">Usuarios</h1>
 
<div class="doble-espacio"></div>

<div class="panel contenedor panel-primary">
  <div class="panel-heading">Agregar usuario</div>
  <div class="panel-body">
	<?= $this->render('_form', [
	    'model' => $model,
	]) ?>
  </div>
</div>