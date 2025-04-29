<?php
if (!empty($_POST["btnguardar"])) {
    if (!empty($_POST["direccion"]) && !empty($_POST["estadocivil"]) && !empty($_POST["persona"]) && !empty($_POST["sexo"]) && !empty($_POST["telefono"])) {

        include "../modelo/conexion.php"; // Asegúrate que esta ruta sea correcta según tu estructura

        $direccion = $_POST["direccion"];
        $estadocivil = $_POST["estadocivil"];
        $persona = $_POST["persona"];
        $sexo = $_POST["sexo"];
        $telefono = $_POST["telefono"];

        $sql = $conexion->query("INSERT INTO personas(direccion, estado_civil, persona, sexo, telefono) 
                                 VALUES('$direccion', '$estadocivil', '$persona', '$sexo', '$telefono')");

        if ($sql === TRUE) {
            echo "<script>alert('Registro guardado correctamente'); window.location.href='index.php';</script>";
        } else {
            echo "Error al guardar: " . $conexion->error;
        }

    } else {
        echo "<script>alert('Faltan datos por llenar'); window.history.back();</script>";
    }
}
?>
