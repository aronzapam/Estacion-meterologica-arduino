<?php
require_once("../views/conexion.php");

$fecha 	  = date("d/m/Y g:i A");

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Informe_sensores_$fecha.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<table border=1>
<tr>
	<th>Fecha</th>
	<th>Temperatura Celsius</th>
	<th>Humedad %</th>
	<th>Monoxido MPP</th>
	<th>Estado de lluvia</th>
	<th>Indice luminosidad</th>
	<th>Indice UV</th>
</tr>
<?PHP
$sql = "select * from sensor_temp_hum order by fecha_hora desc";
$result = mysqli_query($connection, $sql);

while($registros = mysqli_fetch_object($result)){
	$ctime = strtotime($registros->fecha_hora);
	$fecha = date("d/m/Y g:i A", $ctime);
	$registros->fecha_hora = $fecha; ?>
	<tr>
		<td><?PHP echo $registros->fecha_hora; ?></td>
		<td><?PHP echo $registros->temperatura; ?></td>
		<td><?PHP echo $registros->humedad; ?></td>
		<td><?PHP echo $registros->monoxido; ?></td>
		<td>
		<?PHP
		switch($registros->estado_lluvia) {
			case 0:
				echo "No se detecta lluvia";
				break;

			case 1:
				echo "Detectada lluvia";
				break;
		}
		?>
		</td>
		<td>
		<?PHP 
		switch ($registros->estado_luz) {
			case 0:
				echo "Oscuridad total";
				break;
			
			case 1:
				echo "Oscuro";
				break;

			case 2:
				echo "Luz Tenue";
				break;

			case 3:
				echo "Luz Brillante";
				break;

			case 4:
				echo "Luz Muy Brillante";
				break;
		}
		?>
		<td>
	    <?PHP 
		switch ($registros->uv) {
			case 0:
				echo "Indice UV 0 MUY BAJO";
				break;
			
			case 1:
				echo "Indice UV 1 BAJO";
				break;

			case 2:
				echo "Indice UV 2 BAJO";
				break;

			case 3:
				echo "Indice UV 3 MEDIO";
				break;

			case 4:
				echo "Indice UV 4 MEDIO";
				break;
                            
                            
			case 5:
				echo "Indice UV 5 MEDIO";
				break;
                            
			case 6:
				echo "Indice UV 6 ALTO";
				break;
                            
			case 7:
				echo "Indice UV 7 ALTO";
				break;
                            
			case 8:
				echo "Indice UV 8 MUY ALTO";
				break;
                            
			case 9:
				echo "Indice UV 9 MUY ALTO";
				break;
                            
			case 10:
				echo "Indice UV 10 MUL ALTO";
				break;
                            
			case 11:
				echo "Indice UV 11 EXTREMO";
				break;
                            
		}
		?>
		</td>
	</tr>
	<?PHP
}
?>
</table>;
