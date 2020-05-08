<?php

require_once("../models/herramienta.php");

$herramienta = new Herramienta();
/*if($_GET["temp"] == null or $_GET["hum"]== null){
echo "No se pudo obtener valores temperatura y humedad desde arduino";exit;
}else{*/
$ingresar_dato = $herramienta->ingresar_datos($_GET["temp"],$_GET["hum"],$_GET["mc"],$_GET["lluvia"],$_GET["luz"],$_GET["uv"]);
	
//}

?>
