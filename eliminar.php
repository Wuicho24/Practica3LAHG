<?php
include 'conexion.php';

if (isset($_GET['idProd'])) {
    $idProd = $_GET['idProd'];

    $sql = "DELETE FROM productos WHERE idProd = '$idProd'";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php?msg=Producto eliminado correctamente&status=success");
    } else {
        header("Location: index.php?msg=Error al eliminar el producto&status=error");
    }
}

$conexion->close();
?>
