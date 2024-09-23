<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProd = $_POST['idProd'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];

    $sql = "INSERT INTO productos (idProd, nombre, precio, existencia) VALUES ('$idProd', '$nombre', '$precio', '$existencia')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php?msg=Producto registrado correctamente&status=success");
    } else {
        header("Location: index.php?msg=Error al registrar el producto&status=error");
    }
}

$conexion->close();
?>
