<?php
if (!empty($_GET["id"])) {
    include "../modelo/conexion.php";
    $id = $_GET["id"];

    // Primero, obtenemos los IDs relacionados para limpieza futura (opcional)
    $resultado = $conexion->query("SELECT direccion_id, estado_civil_id, sexo_id, telefono_id FROM personas WHERE id = $id");
    $relaciones = $resultado->fetch_assoc();

    // Eliminamos de la tabla personas
    $sql = $conexion->query("DELETE FROM personas WHERE id = $id");

    if ($sql === TRUE) {
        // Opcional: podrías eliminar los registros relacionados si no se usan en otras filas
        // Pero por seguridad, esto se omite en este ejemplo

        echo "<script>
            alert('Registro eliminado correctamente');
            window.location.href='../Vista/index.php';
        </script>";
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
}
?>
