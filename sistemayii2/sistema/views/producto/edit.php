<h1 align="center">Productos</h1>
 
<div class="doble-espacio"></div>

<div class="panel contenedor panel-primary">
  <div class="panel-heading">Editar producto</div>
  <div class="panel-body">
	<?= $this->render('_form', [
	    'model' => $model,
	]) ?>
  </div>
</div>