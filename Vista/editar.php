<?php
if (!empty($_GET["id"])) {
    header("Location: formulario_editar.php?id=" . $_GET["id"]);
}
?>
