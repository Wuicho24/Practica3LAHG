<?php

// Conexion por miarroba
$host = 'mysql.webcindario.com'; // Dominio
$user = 'practica3lahg';       // Usuario
$password = 'Hola123456789Ghos';// Contra
$db = '	practica3lahg'; //NombreDB

$conexion = new mysqli($host, $user, $password, $db);

// Verificar la conexion
if ($conexion->connect_error) {
    die("Error de conexion: " . $conexion->connect_error);
}

 /*
$host = 'localhost'; 
$user = 'root'; 
$password = ''; // En XAMPP contra
$db = 'inventario';
 
$conexion = new mysqli($host, $user, $password, $db);
 
// Verificar la conexion
if ($conexion->connect_error) {
    die("Error de conexin: " . $conexion->connect_error);
}*/

?>
