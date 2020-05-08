<?php
class Herramienta{
	private $conexion;

	function __construct(){
		require_once("conexion.php");
		$this->conexion = new conexion();
		$this->conexion->conectar();
	}

	public function ingresar_datos($temp, $hum, $mc, $estado_lluvia, $luz, $uv){
		$sql = " insert into sensor_temp_hum values (null, ?, ?, ?,?,?,?, now()) ";
		$stmt = $this->conexion->conexion->prepare($sql);

		$stmt->bindValue(1, $temp);
		$stmt->bindValue(2, $hum);
		$stmt->bindValue(3, $mc);
		$stmt->bindValue(4, $estado_lluvia);
		$stmt->bindValue(5, $luz);
		$stmt->bindValue(6, $uv);

		if($stmt->execute()){
			echo "Ingreso Exitoso";
		}else{
			echo "no se pudo registrar datos";
		}
	}
}
?>