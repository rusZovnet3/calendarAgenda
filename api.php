<?php
# formato en json
header("Content-Type: application/json");

# conexion a la BD
$pdo = new PDO("mysql:host=localhost;dbname=f_agenda", "root", "localhost");
$sentenciaSQL = $pdo->prepare("SELECT * FROM tblEventos");
$sentenciaSQL->execute();

$resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

print_r(json_encode($resultado));
