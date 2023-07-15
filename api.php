<?php
# formato en json
header("Content-Type: application/json");

# conexion a la BD
$pdo = new PDO("mysql:host=localhost;dbname=f_agenda", "root", "localhost");

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : 'leer';

switch ($accion) {
	case 'leer':  // muestra la lista bd en lectura
		$sentenciaSQL = $pdo->prepare("SELECT * FROM tblEventos");
		$sentenciaSQL->execute();

		$resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

		print_r(json_encode($resultado));
		break;

	case 'agregar':  // muestra el envio de todo los post cargado del form

		$sentenciaSQL = $pdo->prepare("INSERT INTO `tbleventos`(`title`,`descripcion`,`color`,`start`,`end`) VALUES (:title, :descripcion, :color, :start, :end)");

		$sentenciaSQL->execute( array(
			"title" 		=> $_POST['title'],
			"descripcion" 	=> $_POST['descripcion'],
			"color" 		=> $_POST['color'],
			"start" 		=> $_POST['fecha']. " ". $_POST['hora'],
			"end" 			=> $_POST['fecha']. " ". $_POST['hora'],
		));

		print_r($_POST);  // insertar evento
		break;
}




