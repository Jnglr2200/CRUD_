<?php 
if (!empty($_POST["btnguardar"])) {
    if (!empty($_POST["direccion"]) && !empty($_POST["estadocivil"]) && !empty($_POST["persona"]) && !empty($_POST["sexo"]) && !empty($_POST["telefono"])) {

        include "../modelo/conexion.php";

        $direccion = $_POST["direccion"];
        $estadocivil = $_POST["estadocivil"];
        $persona = $_POST["persona"];
        $sexo = $_POST["sexo"];
        $telefono = $_POST["telefono"];

        // Insertar dirección y obtener ID
        $conexion->query("INSERT INTO direccion(descripcion) VALUES ('$direccion')");
        $direccion_id = $conexion->insert_id;

        // Insertar estado civil y obtener ID
        $conexion->query("INSERT INTO estado_civil(descripcion) VALUES ('$estadocivil')");
        $estado_civil_id = $conexion->insert_id;

        // Insertar sexo y obtener ID
        $conexion->query("INSERT INTO sexo(descripcion) VALUES ('$sexo')");
        $sexo_id = $conexion->insert_id;

        // Insertar teléfono y obtener ID
        $conexion->query("INSERT INTO telefono(numero) VALUES ('$telefono')");
        $telefono_id = $conexion->insert_id;

        // Insertar persona (antes de la tabla 'personas')
        $conexion->query("INSERT INTO persona(nombre) VALUES ('$persona')");
        $persona_id = $conexion->insert_id;

        // Insertar en la tabla 'personas' usando el ID de la persona
        $sql = $conexion->query("INSERT INTO personas(nombre, id_direccion, id_estado_civil, id_persona, id_sexo, id_telefono) 
                                 VALUES ('$persona', $direccion_id, $estado_civil_id, $persona_id, $sexo_id, $telefono_id)");

        if ($sql === TRUE) {
            echo "<script>
                alert('Registro guardado correctamente');
                window.location.href='../Vista/index.php';
            </script>";
        } else {
            echo "Error al guardar: " . $conexion->error;
        }

    } else {
        echo "<script>alert('Faltan datos por llenar'); window.history.back();</script>";
    }
}
?>
