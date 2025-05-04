<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario y Tabla - CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/93927056be.js" crossorigin="anonymous"></script>
</head>
<body class="m-0 p-0">

<div class="row m-0 p-0" style="height: 100vh;">
  
  <div class="col-md-6 d-flex justify-content-center pt-4">
  <form action="../controlador/insertar.php" method="POST" class="row g-3 w-75">
  <h2>Formulario de Registro</h2>

      <div class="col-12">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion" required>
      </div>

      <div class="col-12">
        <label for="estadocivil" class="form-label">Estado Civil</label>
        <select class="form-select" id="estadocivil" name="estadocivil" required>
          <option selected disabled>Seleccione...</option>
          <option value="Soltero">Soltero</option>
          <option value="Casado">Casado</option>
          <option value="Divorciado">Divorciado</option>
          <option value="Viudo">Viudo</option>
        </select>
      </div>

      <div class="col-12">
        <label for="persona" class="form-label">Persona</label>
        <input type="text" class="form-control" id="persona" name="persona" required>
      </div>

      <div class="col-12">
        <label for="sexo" class="form-label">Sexo</label>
        <select class="form-select" id="sexo" name="sexo" required>
          <option selected disabled>Seleccione...</option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
          <option value="Otro">Otro</option>
        </select>
      </div>

      <div class="col-12">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" required>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary w-100" name="btnguardar" value="ok">Guardar</button>
      </div>
    </form>
  </div>

  <!-- Tabla a la derecha -->
  <div class="col-md-6 bg-light d-flex justify-content-center pt-4">
    <div class="w-90">
      <h2>Datos Registrados</h2>
      <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Dirección</th>
            <th>Estado Civil</th>
            <th>Persona</th>
            <th>Sexo</th>
            <th>Teléfono</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
include_once __DIR__ . '/../modelo/conexion.php';
$sql = $conexion->query("
    SELECT 
        p.id,
        d.descripcion AS direcciones,
        ec.descripcion AS estado_civil,
        pe.nombre AS persona,
        s.descripcion AS sexo,
        t.numero AS telefono
    FROM personas p
    INNER JOIN direccion d ON p.id_direccion = d.id
    INNER JOIN estado_civil ec ON p.id_estado_civil = ec.id
    INNER JOIN persona pe ON p.id_persona = pe.id
    INNER JOIN sexo s ON p.id_sexo = s.id
    INNER JOIN telefono t ON p.id_telefono = t.id
");
?>

<tbody>
<?php
// Consulta SQL con alias para las columnas
$sql = $conexion->query("SELECT p.id, p.nombre AS persona, d.descripcion AS direccion, ec.descripcion AS estado_civil, s.descripcion AS sexo, t.numero AS telefono
                         FROM personas p
                         JOIN direccion d ON p.id_direccion = d.id
                         JOIN estado_civil ec ON p.id_estado_civil = ec.id
                         JOIN sexo s ON p.id_sexo = s.id
                         JOIN telefono t ON p.id_telefono = t.id");

while($datos = $sql->fetch_object()) {
?>
<tr>
    <td><?= $datos->id ?></td>
    <td><?= $datos->direccion ?></td> <!-- Aquí usamos el alias 'direccion' -->
    <td><?= $datos->estado_civil ?></td> <!-- Aquí usamos el alias 'estado_civil' -->
    <td><?= $datos->persona ?></td> <!-- Aquí usamos el alias 'persona' -->
    <td><?= $datos->sexo ?></td> <!-- Aquí usamos el alias 'sexo' -->
    <td><?= $datos->telefono ?></td> <!-- Aquí usamos el alias 'telefono' -->
    <td>
        <a href="../controlador/editar.php?id=<?= $datos->id ?>"><i class="fa-solid fa-user-pen" title="Editar"></i></a>
        <a href="../controlador/eliminar.php?id=<?= $datos->id ?>" onclick="return confirm('¿Estás seguro de eliminar este registro?');">
            <i class="fa-solid fa-trash" title="Eliminar"></i>
        </a>
    </td>
</tr>
<?php } ?>

</tbody>


         
        </tbody>
      </table>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
