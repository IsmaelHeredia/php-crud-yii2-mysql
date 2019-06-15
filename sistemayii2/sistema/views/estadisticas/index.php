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
 
<script type="text/javascript">
    $(function () {
        $('#grafico1').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Reporte de productos y sus precios'
            },
            xAxis: {
                categories: <?php echo $textos_grafico1; ?>,
                title: {
                text: 'Productos'
                }
            },
                    
            yAxis: {
                min: 0,
                title: {
                    text: 'Precios',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
            useHTML: true,
            formatter: function() {
                return '<b>Precio : </b>$'+this.point.y;
            }},
            plotOptions: {
            
            series: {
                dataLabels:{
                    //enabled:true,
                },events: {
                    legendItemClick: function () {
                            return false; 
                    }
                }
            }
              },
            legend: {
                reversed: true
            },
            credits: {
                enabled: false
            },
            series: [{
            name:'Precios',
            data: <?php echo $series_grafico1; ?>
            }]
        });
        $('#grafico2').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Reporte de cantidad de productos por proveedores'
            },
            xAxis: {
                categories: <?php echo $textos_grafico2; ?>,
                title: {
                text: 'Empresas'
                }
            },
                    
            yAxis: {
                min: 0,
                title: {
                    text: 'Productos',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
            useHTML: true,
            formatter: function() {
                return '<b>Cantidad de productos : </b>'+this.point.y;
            }},
            plotOptions: {
            
            series: {
                dataLabels:{
                    //enabled:true,
                },events: {
                    legendItemClick: function () {
                            return false; 
                    }
                }
            }
              },
            legend: {
                reversed: true
            },
            credits: {
                enabled: false
            },
            series: [{
            name:'Productos',
            data: <?php echo $series_grafico2; ?>
            }]
        });
    });
</script> 

<h1 class="text-center">Estadísticas</h1>

<div class="doble-espacio"></div>

<div class="panel contenedor panel-primary">
      <div class="panel-heading">Productos encontrados : <?php echo $cantidad_productos; ?></div>
      <div class="panel-body">
        <table class='table'>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Proveedor</th>
                <th>Fecha registro</th>
            </tr>
            <?php foreach($productos as $producto){ ?>
            <tr>
                <td><?= $producto->nombre; ?></td>
                <td><?= $producto->descripcion; ?></td>
                <td><?= $producto->precio; ?></td>
                <td><?= $producto->buscarProveedor($producto->id_proveedor); ?></td>
                <td><?= Yii::$app->formatter->format($producto->fecha_registro, 'date'); ?></td>
            </tr>
            <?php }
            ?>
        </table>
      </div>
</div>

<div class="doble-espacio"></div>

<div class="panel panel-primary grafico">
    <div class="panel-heading">Gráfico 1</div>
    <div class="panel-body">
        <div id="grafico1" style="width: 800px; height: 400px;"></div>
    </div>
</div>

<div class="doble-espacio"></div>

<div class="panel panel-primary grafico">
    <div class="panel-heading">Gráfico 2</div>
    <div class="panel-body">
        <div id="grafico2" style="width: 800px; height: 400px;"></div>
    </div>
</div>
