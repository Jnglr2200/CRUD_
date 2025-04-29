<?php
if (!empty($_GET["id"])) {
    include "../modelo/conexion.php";
    $id = $_GET["id"];

    $sql = $conexion->query("DELETE FROM personas WHERE id=$id");

    if ($sql === TRUE) {
        echo "<script>alert('Registro eliminado correctamente'); window.location.href='index.php';</script>";
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
}
?>
