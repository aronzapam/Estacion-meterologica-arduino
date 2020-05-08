<?php
require_once("conexion.php");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <script type="text/javascript">
            setTimeout('document.location.reload()',400000)
        </script>
		<title>Highcharts Example</title>
                 
		<script type="text/javascript" src="../resources/jquery.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
		$(function () {
		    $('#container').highcharts({
		        title: {
		            text: 'Temperatura Y Humedad',
		            x: -20 //center
		        },
		        subtitle: {
		            text: '', // @p0fk
		            x: -20
		        },
		        xAxis: {
		            categories: [
		            <?php
		                $sql = "select fecha_hora from sensor_temp_hum order by id desc limit 10 ";
		                $result = mysqli_query($connection, $sql);
		                while($registros = mysqli_fetch_array($result)){
		                	$ctime = strtotime($registros["fecha_hora"]);
							$fecha = date("d/m/Y g:i A", $ctime); ?>
		                        '<?php echo htmlentities($fecha); ?>',
		                    <?php
		                }
		            ?>
		            ]
		        },
		        yAxis: {
		            title: {
		                text: 'Temperatura C'
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        tooltip: {
		            valueSuffix: ''
		        },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: [{
		            name: 'Humedad',
		            data: [
		            <?php
		                $query = " select humedad from sensor_temp_hum order by id desc limit 10 ";
		                $resultados = mysqli_query($connection, $query);
		                while($rows = mysqli_fetch_array($resultados)){
		                    ?>
		                        <?php echo $rows["humedad"]?>,
		                    <?php
		                }
		            ?>
		            ]
		        }, {
		            name: 'Temperatura',
		            data: [
		            <?php
		                $query = " select temperatura from sensor_temp_hum order by id desc limit 10 ";
		                $resultados = mysqli_query($connection, $query);
		                while($rows = mysqli_fetch_array($resultados)){
		                    ?>
		                        <?php echo $rows["temperatura"]?>,
		                    <?php
		                }
		            ?>
		            ]
		        }, {
		            name: 'Estado de lluvia',
		            data: [
		            <?php
		                $query = " select estado_lluvia from sensor_temp_hum order by id desc limit 10 ";
		                $resultados = mysqli_query($connection, $query);
		                while($rows = mysqli_fetch_array($resultados)){ 
		                    if ( $rows["estado_lluvia"] == 1 ) {
		                    	echo "{";
                				echo "y: 0,";
		                    	echo "marker: {";
                    			echo "symbol: 'url(https://www.highcharts.com/samples/graphics/snow.png)'";
                				echo "}";
                				echo "}";
		                    } else {
		                    	echo "{";
                				echo "y: 0,";
		                    	echo "marker: {";
                    			echo "symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'";
                				echo "}";
                				echo "}";
		                    } ?>
		                    ,
		                <?PHP
		                }
		            ?>
		            ]
		        }]
		    });

		    $('#monoxido').highcharts({
		        title: {
		            text: 'Monóxido De Carbono',
		            x: -20 //center
		        },
		        subtitle: {
		            text: '', // @p0fk
		            x: -20
		        },
		        xAxis: {
		            categories: [
		            <?php
		                $sql = "select fecha_hora from sensor_temp_hum order by id desc limit 10 ";
		                $result = mysqli_query($connection, $sql);
		                while($registros = mysqli_fetch_array($result)){
		                	$ctime = strtotime($registros["fecha_hora"]);
							$fecha = date("d/m/Y g:i A", $ctime); ?>
		                        '<?php echo htmlentities($fecha); ?>',
		                    <?php
		                }
		            ?>
		            ]
		        },
		        yAxis: {
		            title: {
		                text: 'Monóxido (ppm)'
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        tooltip: {
		            valueSuffix: 'ppm'
		        },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: [{
		            name: 'Monóxido',
		            data: [
		            <?php
		                $query = " select monoxido from sensor_temp_hum order by id desc limit 10 ";
		                $resultados = mysqli_query($connection, $query);
		                while($rows = mysqli_fetch_array($resultados)){
		                    ?>
		                        <?php echo $rows["monoxido"]?>,
		                    <?php
		                }
		            ?>
		            ]
		        }]
		    });

		    $('#luz').highcharts({
		        title: {
		            text: 'Estado de luz(%)',
		            x: -20 //center
		        },
		        subtitle: {
		            text: '', // @p0fk
		            x: -20
		        },
		        xAxis: {
		            categories: [
		            <?php
		                $sql = "select fecha_hora from sensor_temp_hum order by id desc limit 10 ";
		                $result = mysqli_query($connection, $sql);
		                while($registros = mysqli_fetch_array($result)){
		                	$ctime = strtotime($registros["fecha_hora"]);
							$fecha = date("d/m/Y g:i A", $ctime); ?>
		                        '<?php echo htmlentities($fecha); ?>',
		                    <?php
		                }
		            ?>
		            ]
		        },
		        yAxis: {
		            title: {
		                text: '% luz'
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        tooltip: {
		            valueSuffix: '%'
		        },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: [{
		            name: 'Estado de luz',
		            data: [
		            <?php
		                $query = " select estado_luz from sensor_temp_hum order by id desc limit 10 ";
		                $resultados = mysqli_query($connection, $query);
		                while($rows = mysqli_fetch_array($resultados)){
		                    switch ( $rows["estado_luz"] ) {
		                    	case 0:
		                    		echo "0";
                				break;

                				case 1:
		                    		echo "25";
                				break;

                				case 2:
		                    		echo "50";
                				break;

                				case 3:
		                    		echo "75";
                				break;

                				case 4:
		                    		echo "100";
                				break;
		                    } ?>
		                    ,
					<?PHP
		                }
		            ?>
		            ]
		        }]
		    });

		    $('#uv').highcharts({
		        title: {
		            text: 'Indice UV',
		            x: -20 //center
		        },
		        subtitle: {
		            text: '', // @p0fk
		            x: -20
		        },
		        xAxis: {
		            categories: [
		            <?php
		                $sql = "select fecha_hora from sensor_temp_hum order by id desc limit 10 ";
		                $result = mysqli_query($connection, $sql);
		                while($registros = mysqli_fetch_array($result)){
		                	$ctime = strtotime($registros["fecha_hora"]);
							$fecha = date("d/m/Y g:i A", $ctime); ?>
		                        '<?php echo htmlentities($fecha); ?>',
		                    <?php
		                }
		            ?>
		            ]
		        },
		        yAxis: {
		            title: {
		                text: 'Indice UV'
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        tooltip: {
		            valueSuffix: ' Indice'
		        },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: [{
		            name: 'Indice UV',
		            data: [
		            <?php
		                $query = " select uv from sensor_temp_hum order by id desc limit 10 ";
		                $resultados = mysqli_query($connection, $query);
		                while($rows = mysqli_fetch_array($resultados)){
		                    switch ( $rows["uv"] ) {
		                    	case 0:
                                                case 0:
		                    		echo "0";
                				break;

                				case 1:
		                    		echo "1";
                				break;

                				case 2:
		                    		echo "2";
                				break;

                				case 3:
		                    		echo "3";
                				break;

                				case 4:
		                    		echo "4";
                				break;
                                            
                                                case 6:
		                    		echo "6";
                				break;
                                            
                                                case 7:
		                    		echo "7";
                				break;
                                            
                                                case 8:
		                    		echo "8";
                				break;
                                            
                                                case 9:
		                    		echo "9";
                				break;
                                            
                                                case 10:
		                    		echo "10";
                				break;
                                            
                                                case 11:
		                    		echo "11";
                				break;
                                            
                                            
		                    } ?>
		                    ,
					<?PHP
		                }
		            ?>
		            ]
		        }]
		    });
                     
                    
		});
		</script>
	</head>
	<body>
<p align="right">
  <script src="../resources/highcharts.js"></script>
  <script src="../resources/exporting.js"></script><img src="../imagenes/logo.png" width="120" height="85" align="left"><img src="../imagenes/logo.png" width="120" height="85"></p>
<div id="container" style="min-width: 310px; height: 200px; margin: 0 auto"></div>
<div id="monoxido" style="min-width: 310px; height: 200px; margin: 0 auto"></div>
<div id="luz" iv>style="min-width: 310px; height: 200px; margin: 0 auto"></div>
<div id="uv" style="min-width: 310px; height: 200px; margin: 0 auto"></div>
<br >
<form action="../controller/descargar_informe.php"  target="_blank"/>
	<input style="padding:12px;background: black;color: white;font-weight: bold;" type="submit" value="Descargar Informe Excel" />
</form>

	</body>
</html>

