<?php
include "../modelo/conexion.php";

if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->query("SELECT * FROM personas WHERE id = $id");

    if ($sql->num_rows > 0) {
        $datos = $sql->fetch_object();
    } else {
        echo "Registro no encontrado";
        exit;
    }
} else {
    echo "ID no proporcionado";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnguardar"])) {
    if (
        !empty($_POST["direccion"]) &&
        !empty($_POST["estado_civil"]) &&
        !empty($_POST["persona"]) &&
        !empty($_POST["sexo"]) &&
        !empty($_POST["telefono"])
    ) {
        $direccion = $_POST["direccion"];
        $estado_civil = $_POST["estado_civil"];
        $persona = $_POST["persona"];
        $sexo = $_POST["sexo"];
        $telefono = $_POST["telefono"];

        $update = $conexion->query("UPDATE personas SET 
            direccion = '$direccion',
            estado_civil = '$estado_civil',
            persona = '$persona',
            sexo = '$sexo',
            telefono = '$telefono'
            WHERE id = $id
        ");

        if ($update) {
            echo "<script>alert('Registro actualizado exitosamente'); window.location.href='index.php';</script>";
            exit;
        } else {
            echo "Error al actualizar: " . $conexion->error;
        }
    } else {
        echo "Todos los campos son obligatorios";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container pt-5">

    <h2>Editar Registro</h2>
    <form method="POST" class="row g-3">

        <div class="col-12">
            <label class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" value="<?= $datos->direccion ?>" required>
        </div>

        <div class="col-12">
            <label class="form-label">Estado Civil</label>
            <select class="form-select" name="estado_civil" required>
                <option <?= $datos->estado_civil == "Soltero" ? "selected" : "" ?> value="Soltero">Soltero</option>
                <option <?= $datos->estado_civil == "Casado" ? "selected" : "" ?> value="Casado">Casado</option>
                <option <?= $datos->estado_civil == "Divorciado" ? "selected" : "" ?> value="Divorciado">Divorciado</option>
                <option <?= $datos->estado_civil == "Viudo" ? "selected" : "" ?> value="Viudo">Viudo</option>
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Persona</label>
            <input type="text" class="form-control" name="persona" value="<?= $datos->persona ?>" required>
        </div>

        <div class="col-12">
            <label class="form-label">Sexo</label>
            <select class="form-select" name="sexo" required>
                <option <?= $datos->sexo == "Masculino" ? "selected" : "" ?> value="Masculino">Masculino</option>
                <option <?= $datos->sexo == "Femenino" ? "selected" : "" ?> value="Femenino">Femenino</option>
                <option <?= $datos->sexo == "Otro" ? "selected" : "" ?> value="Otro">Otro</option>
            </select>
        </div>

        <div class="col-12">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" value="<?= $datos->telefono ?>" required>
        </div>

        <div class="col-12">
            <button type="submit" name="btnguardar" class="btn btn-success">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>

    </form>

</body>
</html>
